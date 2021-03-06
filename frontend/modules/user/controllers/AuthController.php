<?php


namespace frontend\modules\user\controllers;

use common\models\LoginForm;
use common\models\PromoRegister;
use common\models\PromoRegisterCount;
use common\models\RegisterCount;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\VerifyEmailForm;
use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\user\models\forms\SignupForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class AuthController extends Controller
{

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($city)
    {
        $model = new SignupForm();

        $model->city = $city;

        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            Yii::$app->user->login($user,  3600 * 24 * 30 );
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно, проверьте свой Email');
            RegisterCount::addRegister(\date('d-m-Y'));
            $cookies = Yii::$app->request->cookies;

            if (isset($cookies['promo'])){

                $promoRegister = new PromoRegister();

                $promoRegister->user_id = $user->id;

                $promoRegister->save();

                PromoRegisterCount::addRegister(\date('d-m-Y'));

            }

            if (isset($cookies['chat_info'])){

                $data = \json_decode($cookies['chat_info']->value);

                $messageModel = new SendMessageForm();

                $messageModel->from_id = $data[0]->profile_id;
                $messageModel->created_at = \time();
                $messageModel->status = 1;
                $messageModel->text = $data[0]->inv_message;
                $messageModel->user_id = $user->id;

                if ($messageModel->validate() and $chat_id = $messageModel->save()){

                    $userMessage = new SendMessageForm();

                    $userMessage->from_id = $user->id;
                    $userMessage->created_at = \time() + 3;
                    $userMessage->text = $data[0]->message;
                    $userMessage->chat_id = $chat_id;

                    $cookies = Yii::$app->response->cookies;

                    $cookies->remove('chat_info');

                    if ($userMessage->save()) return $this->redirect('/user/chat');

                }

            }


            return $this->redirect('/user');
        }

        if ($model->hasErrors()){

            Yii::$app->session->setFlash('warning', $model->getFirstErrors());

        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     * @param $city string
     * @return mixed
     */
    public function actionLogin($city)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $model->city = $city;

        if ($model->load(Yii::$app->request->post()) and $model->login()) {
            Yii::$app->response->redirect(['/user'], 301, false);

        } else {
            $model->password = '';

            Yii::$app->response->redirect(['/'], 301, false);

        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->response->redirect(['/'], 301, false);
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset($city)
    {

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте Вашу почту');

                Yii::$app->response->redirect(['/'], 301, false);

            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword( $token)
    {

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен');

            Yii::$app->response->redirect(['/'], 301, false);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Ваша почта подтверждена!');
                return Yii::$app->response->redirect('/user/setting/anket', 301, false);
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                Yii::$app->response->redirect(['/'], 301, false);
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}