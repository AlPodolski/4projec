<?php
namespace frontend\modules\user\models\forms;

use common\models\City;
use common\models\Pol;
use frontend\models\UserPol;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $city;
    public $pol;

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'city' => 'Город',
            'pol' => 'Пол',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'common\models\User', 'message' => 'Такая почта уже используется'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['pol', 'integer']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if ($user->save() && $this->sendEmail($user)){

            $city_id = City::find()->where(['url' => $this->city])->select('id')->asArray()->one();

            $userPol = new UserPol();

            $userPol->user_id = $user->id;
            $userPol->city_id =$city_id['id'];
            $userPol->pol_id = $this->pol;

            return $userPol->save();

        }

        return false;

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' '])
            ->setTo($this->email)
            ->setSubject('Регистрация ' . Yii::$app->name)
            ->send();
    }
}
