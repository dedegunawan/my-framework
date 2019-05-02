<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 8:19 PM
 */

namespace DedeGunawan\MyFramework\Helper;


class Profile
{
    protected static $user=null;
    protected static $profiles=null;

    /**
     * @return null
     */
    public static function getUser()
    {
        return self::$user;
    }

    /**
     * @param null $user
     */
    public static function setUser($user)
    {
        self::$user = $user;
    }

    /**
     * @return null
     */
    public static function getProfiles()
    {
        return self::$profiles;
    }

    /**
     * @param null $profiles
     */
    public static function setProfiles($profiles)
    {
        self::$profiles = $profiles;
    }

    public static function get_auth_user() {
        if (self::$user == null) self::setUser(get_instance()->ion_auth->user()->row_array());
        return self::$user;
    }

    public static function get_auth_profile($key) {
        if ($key=='full_name') {
            $key = 'nama_lengkap';
        }
        $data = @self::get_auth_user()[$key];

        $profiles = self::getProfiles();

        if (!$data && strpos($key, "+")) {
            $keys = explode("+", $key);
            $end_data = array();
            foreach ($keys as $ckey) {
                $cdata = @self::get_auth_user()[$ckey];
                if (!$cdata) {
                    if ($profiles && is_array($profiles)) {
                        if (strpos($ckey, "_____")) {
                            $dy = explode("_____", $ckey);
                            if (isset($profiles[@$dy[0]][@$dy[1]])) $cdata = $profiles[@$dy[0]][@$dy[1]];
                        }
                    }
                }
                if (!$cdata) {
                    if ($profiles && is_array($profiles)) {
                        foreach ($profiles as $profile) {
                            $dd = @$profile[$ckey];
                            if ($dd) $cdata = $dd;
                        }
                    }
                }
                if ($cdata) $end_data[] = $cdata;
            }
            if (!empty($end_data)) $data = implode(" ", $end_data);
        }

        if (!$data) {
            if ($profiles && is_array($profiles)) {
                if (strpos($key, "_____")) {
                    $dy = explode("_____", $key);
                    if (isset($profiles[@$dy[0]][@$dy[1]])) $data = $profiles[@$dy[0]][@$dy[1]];
                }
            }
        }
        if (!$data) {
            if ($profiles && is_array($profiles)) {
                foreach ($profiles as $profile) {
                    $dd = @$profile[$key];
                    if ($dd) $data = $dd;
                }
            }
        }
        return $data;
    }
}