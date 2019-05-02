<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 3/19/19
 * Time: 10:15 PM
 */

class Menus extends \DedeGunawan\MyFramework\CoreController\SuperAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
    }

    public function index() {
        $this->addData('page_title', 'Daftar Menu');
        $this->addData('lokasi_menus', $this->menu_model->get_lokasi_menu());

        $this->addData('menus', $this->menu_model->get_all_menu(0));

        $this->render('menus/index');
    }

    public function ganti_lokasi_menu() {
        $lokasi_menu = $this->input->post('lokasi_menu');
        $this->session->set_userdata('lokasi_menu', $lokasi_menu);
        $this->_json(array(
            'status' => 1,
            'message' => 'berhasil mengubah lokasi menu',
        ));
    }

    public function create_new_location() {
        $this->addData('page_title', 'Tambah Menu Baru');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lokasi', 'Lokasi Menu', 'required');
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('groups', 'Group', 'required|callback_check_groups');

        if ($this->form_validation->run() === FALSE) {
            // display the form
            // set the flash data error message if there is one

            $this->addData('groups', $this->ion_auth->groups()->result_array());
            $this->addData('default_lokasi', set_value('lokasi'));
            $this->addData('default_nama_menu', set_value('nama_menu'));
            $this->addData('default_icon', set_value('icon'));
            $this->addData('default_url', set_value('url'));
            $this->addData('default_groups', set_value('groups'));

            $this->render('menus/create_new_location');
        }
        else {
            $this->menu_model->create_new_menu_with_new_location();
            $this->session->set_flashdata('message', "Berhasil menambah menu dengan lokasi baru");
            $this->session->set_flashdata('alert_type', "success");
            return redirect(base_url('/super_admin/menus'));

        }
    }
    public function create() {
        $this->addData('page_title', 'Tambah Menu Baru');
        $this->addData('lokasi_menus', $this->menu_model->get_lokasi_menu());
        $this->addData('parents', $this->menu_model->get_sub_menu_without_level($this->session->userdata('lokasi_menu')));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('lokasi', 'Lokasi Menu', 'required');
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('groups', 'Group', 'callback_check_groups');

        if ($this->form_validation->run() === FALSE) {
            // display the form
            // set the flash data error message if there is one

            $this->addData('groups', $this->ion_auth->groups()->result_array());
            $this->addData('default_lokasi', set_value('lokasi')?set_value('lokasi'):$this->session->userdata('lokasi_menu'));
            $this->addData('default_nama_menu', set_value('nama_menu'));
            $this->addData('default_icon', set_value('icon'));
            $this->addData('default_url', set_value('url'));
            $this->addData('default_parent', set_value('parent'));
            $this->addData('default_urutan', set_value('urutan'));
            $this->addData('default_groups', set_value('groups'));

            $this->render('menus/create');
        }
        else {
            $this->menu_model->create_new_menu();
            $this->session->set_flashdata('message', "Berhasil menambah menu dengan lokasi baru");
            $this->session->set_flashdata('alert_type', "success");
            return redirect(base_url('/super_admin/menus'));

        }
    }

    public function check_groups($datas) {
        $datas = $this->input->post('groups');
        if (empty($datas)) {
            $this->form_validation->set_message('check_groups', 'Kolom {field} harus diisi');
            return FALSE;
        }
        $group_ids = array_column($this->ion_auth->groups()->result_array(), "id");
        $exists = array_intersect($datas, $group_ids);
        if (count($exists) < count($datas)) {
            $this->form_validation->set_message('check_groups', 'Kolom {field} ada yang tidak terdapat pada group');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete($id) {
        $child = $this->menu_model->get_all_menu($id);
        if (!empty($child)) {
            $this->session->set_flashdata('message', "Gagal, menu mempunyai child. Silahkan hapus child terlebih dahulu");
            $this->session->set_flashdata('alert_type', "danger");
            return redirect(base_url('/super_admin/menus'));
        } else {
            $this->menu_model->delete_menu($id);
            $this->session->set_flashdata('message', "Berhasil menghapus menu");
            $this->session->set_flashdata('alert_type', "success");
            return redirect(base_url('/super_admin/menus'));
        }
    }
}