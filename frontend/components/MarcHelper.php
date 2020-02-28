<?php


namespace frontend\components;


use Yii;

class MarcHelper
{
    public static function AddMarc($params){

        $path = Yii::$app->request->pathInfo;

        $url = array();

        if (!empty($params)){

            foreach ($params as $param){

                $marck_url = '';

                $marck_url = rtrim(str_replace(trim($param['url'], '/'), '', $path), '/');

                $close = '<span><i class="fa fa-times" aria-hidden="true"></i></span>';

                $url[] = str_replace('//', '/','<a class="marc" href="/'.$marck_url.'"> <span class="marc-text"> '.$param['label'].' </span> '.$close.'  </a>');

            }

        }

        Yii::$app->view->params['marks'] = implode('', $url);

    }
}