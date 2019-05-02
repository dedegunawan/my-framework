<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 4:36 PM
 */

namespace DedeGunawan\MyFramework\CoreController;


class NeedLoginController extends \MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->redirect_if_not_login();
    }

    public function is_login()
    {
        return parent::is_login();
    }

    public function is_not_login()
    {
        return parent::is_not_login();
    }
}