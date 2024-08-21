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

    // Simpan hasil query ke dalam variabel result
    $result = $ci->db->get_where('menu_akses_pengguna', [
        'id_peran' => $role_id,
        'id_menu' => $menu_id
    ]);

    // Periksa apakah ada baris yang ditemukan
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
