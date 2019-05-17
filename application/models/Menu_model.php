<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 3/19/19
 * Time: 11:06 AM
 */

class Menu_model extends CI_Model
{
    public function get_all_menu($parent=0) {

        return $this->db->where('menus.parent', $parent)
            ->select('menus.*, GROUP_CONCAT(menus_groups.group_id SEPARATOR ",") as groups')
            ->order_by('menus.lokasi, menus.urutan')
            ->from('menus')
            ->join('menus_groups', 'menus_groups.menu_id=menus.id')
            ->group_by('menus.id')
            ->get()
            ->result_array();
    }
    public function get_group_by_menu_ids_string($string) {
        return $this->db->where_in("id", explode(",", $string))
            ->get('groups')
            ->result_array();
    }

    public function get_sub_menu($lokasi, $parent=0) {
        $user_groups = $this->ion_auth->get_users_groups()->result_array();
        $group_id = array_column($user_groups, 'id');
        if (empty($group_id)) $group_id=array('false');

        return $this->db->where('menus.parent', $parent)
            ->select('menus.*')
            ->where('menus.lokasi', $lokasi)
            ->where_in('menus_groups.group_id', $group_id)
            ->order_by('menus.urutan')
            ->from('menus')
            ->join('menus_groups', 'menus_groups.menu_id=menus.id')
            ->get()
            ->result_array();
    }
    public function get_sub_menu_without_level($lokasi, $parent=0) {
        return $this->db->where('menus.parent', $parent)
            ->select('menus.*')
            ->where('menus.lokasi', $lokasi)
            ->order_by('menus.urutan')
            ->from('menus')
            ->get()
            ->result_array();
    }

    public function get_lokasi_menu() {
        return $this->db->select('lokasi')
            ->group_by('lokasi')
            ->get('menus')
            ->result_array();
    }

    public function create_new_menu_with_new_location() {
        $groups = (array) $this->input->post('groups');
        $this->db->insert('menus', array(
            'lokasi' => $this->input->post('lokasi'),
            'nama_menu' => $this->input->post('nama_menu'),
            'icon' => $this->input->post('icon'),
            'url' => $this->input->post('url'),
            'parent' => 0,
            'urutan' => 1,
        ));
        $menu_id = $this->db->insert_id();
        $groups = (array) $this->input->post('groups');
        $new_group = array();
        foreach ($groups as $group_id) {
            $new_group[] = compact('group_id', 'menu_id');
        }
        $this->db->insert_batch('menus_groups', $new_group);
    }
    public function create_new_menu() {
        $urutan = $this->input->post('urutan');
        if (!$urutan) {
            $urutan = $this->db->where('lokasi', $this->input->post('lokasi'))
                ->limit(1)
                ->order_by('urutan', 'desc')
                ->get('menus')
                ->row_array();
            $urutan = @$urutan['urutan'];
            if ($urutan === false || $urutan === null) $urutan = 0;
            $urutan = $urutan+1;
        }
        $this->db->insert('menus', array(
            'lokasi' => $this->input->post('lokasi'),
            'nama_menu' => $this->input->post('nama_menu'),
            'icon' => $this->input->post('icon'),
            'url' => $this->input->post('url'),
            'parent' => $this->input->post('parent'),
            'urutan' => $urutan,
        ));
        $menu_id = $this->db->insert_id();
        $groups = (array) $this->input->post('groups');
        $new_group = array();
        foreach ($groups as $group_id) {
            $new_group[] = compact('group_id', 'menu_id');
        }
        $this->db->insert_batch('menus_groups', $new_group);
    }

    public function delete_menu($id) {
        $this->db->where('menu_id', $id)
            ->delete('menus_groups');
        return $this->db->where('id', $id)
            ->delete('menus');
    }


}