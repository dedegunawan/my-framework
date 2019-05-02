<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 8:17 PM
 */

namespace DedeGunawan\MyFramework\Helper;


class Url
{
    protected static function is_http($url) {
        return substr(strtolower($url), 0, 4)=='http';
    }
}