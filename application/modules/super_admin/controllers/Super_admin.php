<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 3/19/19
 * Time: 10:33 AM
 */

class Super_admin extends \DedeGunawan\MyFramework\CoreController\SuperAdminController
{
    public function index() {
        $link_datas = array(
            array(
                'href' => base_url('/super_admin/users'),
                'title' => 'Jumlah Pendaftar',
                'subtitle' => $this->ion_auth->users()->num_rows().' Pengguna',
                'icon' => 'fa fa-users fa-4x'
            )
        );
        $this->addData('link_datas', $link_datas);
        $this->addData('page_title', 'Dashboard');
        $this->render('dashboard');
    }

}