<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 10:52 AM
 */

namespace DedeGunawan\MyFramework\CoreController;


class SuperAdminController extends \MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->redirect_if_not_login();
    }

    public function is_login()
    {
        return parent::is_login() && $this->ion_auth->is_admin();
    }

    public function is_not_login()
    {
        return parent::is_not_login() || !$this->ion_auth->is_admin();
    }
}