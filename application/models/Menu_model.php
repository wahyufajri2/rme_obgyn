<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `submenu_pengguna`.*, `menu_pengguna`.`menu` 
                    FROM `submenu_pengguna` JOIN `menu_pengguna` 
                    ON `submenu_pengguna`.`id_menu` = `menu_pengguna`.`id`
        ";
        return $this->db->query($query)->result_array();
    }
}
