<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('id_peran');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('menu_pengguna', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('menu_akses_pengguna', [
            'id_peran' => $role_id,
            'id_menu' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('id_peran', $role_id);
    $ci->db->where('id_menu', $menu_id);
    $result = $ci->db->get('menu_akses_pengguna');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
