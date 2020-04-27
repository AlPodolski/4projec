<?php


namespace frontend\modules\user\components;
use common\models\City;
use common\models\User;
use frontend\models\UserPol;
use yii\authclient\ClientInterface;
use Yii;
use frontend\modules\user\models\Auth;
use yii\helpers\ArrayHelper;
use function Composer\Autoload\includeFile;

class AuthHandler
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        if (!Yii::$app->user->isGuest) {
            return;
        }

        $attributes = $this->client->getUserAttributes();

        $auth = $this->findAuth($attributes);
        if ($auth) {
            /* @var User $user */
            $user = $auth->user;
            return Yii::$app->user->login($user);
        }
        if ($user = $this->createAccount($attributes)) {
            return Yii::$app->user->login($user);
        }
    }

    /**
     * @param array $attributes
     * @return Auth
     */
    private function findAuth($attributes)
    {
        $id = ArrayHelper::getValue($attributes, 'id');
        $params = [
            'source_id' => $id,
            'source' => $this->client->getId(),
        ];
        return Auth::find()->where($params)->one();
    }

    /**
     *
     * @param type $attributes
     * @return User|null
     */
    private function createAccount($attributes)
    {
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $sex = ArrayHelper::getValue($attributes, 'sex');
        $name = ArrayHelper::getValue($attributes, 'first_name'). ' '. ArrayHelper::getValue($attributes, 'last_name');

        if (!User::find()->where(['email' => $email])->exists()) {
            return;
        }

        $cityInfo = City::find()->where(['url' => Yii::$app->controller->actionParams['city']])->asArray()->one() ;

        $user = $this->createUser($email, $name, $cityInfo['url']);

        $transaction = User::getDb()->beginTransaction();
        if ($user->save()) {
            
            $auth = $this->createAuth($user->id, $id);
            if ($auth->save()) {

                if (isset($sex) and !empty($sex)){
                    if ($sex == 1) $this->savePol($user->id, 2,$cityInfo['id'] );
                    else $this->savePol($user->id, 1,$cityInfo['id'] );
                }

                $transaction->commit();
                return $user;
            }
        }
        $transaction->rollBack();
    }

    private function createUser($email, $name, $city)
    {
        return new User([
            'username' => $name,
            'email' => $email,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
            'created_at' => $time = time(),
            'updated_at' => $time,
            'fake' => 1,
            'status' => 10,
            'sort' => time(),
            'city' => $city,
        ]);
    }
    
    private function savePol($user_id, $pol, $city_id){
        
        $userPol = new UserPol();
        $userPol->city_id = $city_id;
        $userPol->user_id = $user_id;
        $userPol->pol_id = $pol;

        return $userPol->save();
        
        
    }

    private function createAuth($userId, $sourceId)
    {
        return new Auth([
            'user_id' => $userId,
            'source' => $this->client->getId(),
            'source_id' => (string) $sourceId,
        ]);
    }

}
