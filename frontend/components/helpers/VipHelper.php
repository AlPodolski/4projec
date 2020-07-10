<?php

namespace frontend\components\helpers;

class VipHelper
{
    public static function checkVip($time)
    {
        if ($time > \time()) return true;
        return false;
    }
    
}