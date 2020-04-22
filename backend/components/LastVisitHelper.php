<?php


namespace backend\components;


class LastVisitHelper
{
    public static function todayCount($posts)
    {
        if (!empty($posts)){

            $count = 0;

            foreach ($posts as $post){

                if(\date('w', $post['created_at']) == \date('w', \time()) ) $count++;

            }

            return $count;

        }

        return 0;
    }
}