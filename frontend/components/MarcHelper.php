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

                if ($param['label']){

                    $marck_url = '';

                    if (\in_array(\trim($param['url'], '/'), Yii::$app->params['sort_url'])) $marck_url = $param['url'] ;

                    else $marck_url = rtrim(str_replace(trim($param['url'], '/'), '', $path), '/');

                    $close = '<span><i class="fa fa-times" aria-hidden="true"></i></span>';

                    if ($marck_url == '/znakomstva' or $marck_url == 'znakomstva') $marck_url = '';

                    if ($param['label'] == 'знакомства') $param['label'] = 'Главная';

                    $url[] = str_replace('//', '/','<a class="marc" href="/'.$marck_url.'"> <span class="marc-text"> '.$param['label'].' </span> '.$close.'  </a>');

                }

            }

        }

        Yii::$app->view->params['marks'] = implode('', $url);

    }
}