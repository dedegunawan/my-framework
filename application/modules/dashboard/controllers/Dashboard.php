<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/2/19
 * Time: 4:35 PM
 */

class Dashboard extends \DedeGunawan\MyFramework\CoreController\NeedLoginController
{
    public function index() {
        $is_admin = $this->ion_auth->is_admin();
        if ($is_admin) return redirect(base_url('/super_admin'));

//        $pendaftar = $this->ion_auth->in_group('pendaftar');
//        if ($pendaftar) return redirect(base_url('/pendaftar'));

        return redirect(base_url('/admin'));
    }
}