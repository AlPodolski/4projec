<?php
namespace chat\controllers;

use common\models\BlackList;
use common\models\CountMessage;
use common\models\PromoRegister;
use common\models\User;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'restart', 'all', 'promo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $messageCount = CountMessage::find()
            ->where(['date' => $date = date('Y-m-d', \time() - (3600 * 24))])
            ->orderBy('count DESC')
            ->all();

        return $this->render('main',[
            'date' => $date,
            'messageCount' => $messageCount,
        ] );
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionAll()
    {
        $blackList = BlackList::find()->select('user_id')->asArray()->all();

        $blackListIds = ArrayHelper::getColumn($blackList, 'user_id');

        $usersFromPromoRegister = Profile::find()
            ->where(['in', 'id', ArrayHelper::getColumn(PromoRegister::find()->asArray()->all(), 'user_id')])
            ->andWhere(['<', 'created_at', \time() - (3600 * 24 * 7)])
            ->asArray()
            ->select('id')
            ->all();

        $usersFromPromoRegister = ArrayHelper::getColumn($usersFromPromoRegister, 'id');

        $fakeUsers = ArrayHelper::getColumn(Profile::find()->asArray()->where(['fake' => 0])
            ->andWhere(['not in' , 'id', $blackListIds])
            ->andWhere(['not in' , 'id', $usersFromPromoRegister])
            ->select('id')->asArray()->all(), 'id');

        return $this->render('index' , [
            'fakeUsers' => $fakeUsers,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPromo()
    {

        $usersFromPromoRegister = ArrayHelper::getColumn(PromoRegister::find()->asArray()->all(), 'user_id');

        $fakeUsers = ArrayHelper::getColumn(Profile::find()->asArray()->where(['in', 'id', $usersFromPromoRegister])
            ->andWhere(['>', 'created_at', \time() - (3600 * 24 * 7)])
            ->select('id')->asArray()->all(), 'id');

        return $this->render('index' , [
            'fakeUsers' => $fakeUsers,
        ]);
    }

    public function actionRestart()
    {
        return \shell_exec('systemctl restart 4dosug');
    }

    public function actionError()
    {
        
    }
}
