<?php
namespace backend\controllers;

use backend\components\LastVisitHelper;
use common\models\CountMessage;
use common\models\PromoRegister;
use common\models\PromoRegisterCount;
use common\models\UserCashPay;
use frontend\modules\user\models\Profile;
use Yii;
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        $profiles = Profile::find()->where(['>', 'created_at' , \time() - (3600 * 24)])->asArray()->all();
        $profilesCount = Profile::find()->count();

        $realProfileCount = Profile::find()->where(['fake' => 1])->count();

        $userCountWhoRegister24HourAgo = LastVisitHelper::todayCount($profiles);

        $userCashPay = UserCashPay::find()->orderBy('id DESC')->asArray()->limit(7)->all();

        $promoRegisterWeek = PromoRegisterCount::find()->orderBy('id DESC')->asArray()->limit(7)->all();

        $promoRegisterCount = PromoRegister::find()->count();

        $messageCount = CountMessage::find()
            ->where(['date' => $date = date('Y-m-d', \time() - (3600 * 24))])
            ->orderBy('count DESC')
            ->all();

        return $this->render('index' , [
            'userCountWhoRegister24HourAgo' => $userCountWhoRegister24HourAgo,
            'profilesCount' => $profilesCount,
            'userCashPay' => $userCashPay,
            'realProfileCount' => $realProfileCount,
            'promoRegisterWeek' => $promoRegisterWeek,
            'promoRegisterCount' => $promoRegisterCount,
            'date' => $date,
            'messageCount' => $messageCount,
        ]);
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
}
