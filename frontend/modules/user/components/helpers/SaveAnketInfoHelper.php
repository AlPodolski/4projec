<?php


namespace frontend\modules\user\components\helpers;

class SaveAnketInfoHelper
{
    public static function save($id, $user_id, $class_name, $column_param_name){

        if (\is_array($id)){

            foreach ($id as $item){

                $model = new $class_name();

                $model->$column_param_name = \strip_tags($item);
                $model->user_id = $user_id;

                if(!$model->save()) return false;

            }

            return true;

        }else{

            $model = new $class_name();

            $model->$column_param_name = $id;
            $model->user_id = $user_id;

            if ($model->save()) return true;

        }

    }
}