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
    $ci->db->where('id_peran', $role_id);
    $ci->db->where('id_menu', $menu_id);
    $result = $ci->db->get('menu_akses_pengguna');

    // Periksa apakah ada baris yang ditemukan
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function generate_no_rm()
{
    $CI = &get_instance();
    $CI->load->database();

    // Maksimum percobaan pembuatan nomor rekam medis
    $max_retries = 3;
    $retry_count = 0;

    do {
        // Mulai transaksi
        $CI->db->trans_start();

        // Dapatkan tanggal hari ini dalam format yang diinginkan
        $tanggal = date('dmY');

        // Query untuk mendapatkan nomor urut terakhir (dengan kunci FOR UPDATE)
        $CI->db->select_max('no_rm');
        $CI->db->like('no_rm', "RM-{$tanggal}-", 'after');
        $query = $CI->db->get('pasien', 1, 0, FALSE, TRUE); // Menggunakan get() dengan kunci FOR UPDATE
        $result = $query->row_array();

        // Ekstrak nomor urut dari hasil query
        $last_number = 0;
        if ($result && $result['no_rm']) {
            $last_number = (int) substr($result['no_rm'], -4);
        }

        // Increment nomor urut
        $new_number = $last_number + 1;

        // Format nomor rekam medis baru
        $no_rm = "RM-{$tanggal}-" . str_pad($new_number, 4, '0', STR_PAD_LEFT);

        // Selesaikan transaksi
        $CI->db->trans_complete();

        $retry_count++;
    } while ($CI->db->trans_status() === FALSE && $retry_count < $max_retries);

    if ($CI->db->trans_status() === FALSE) {
        // Jika semua percobaan gagal, tampilkan pesan error atau lakukan tindakan lain
        log_message('error', 'Gagal membuat nomor rekam medis unik setelah beberapa percobaan.');
        return FALSE;
    }
    return $no_rm;
}

function generate_no_rg()
{
    $CI = &get_instance();
    $CI->load->database();

    // Maksimum percobaan pembuatan nomor registrasi
    $max_retries = 3;
    $retry_count = 0;

    do {
        // Mulai transaksi
        $CI->db->trans_start();

        // Dapatkan tanggal hari ini dalam format yang diinginkan
        $tanggal = date('dmY');

        // Query untuk mendapatkan nomor urut terakhir (dengan kunci FOR UPDATE)
        $CI->db->select_max('no_rg');
        $CI->db->like('no_rg', "RG-{$tanggal}-", 'after');
        $query = $CI->db->get('pendaftaran', 1, 0, FALSE, TRUE); // Menggunakan get() dengan kunci FOR UPDATE
        $result = $query->row_array();

        // Ekstrak nomor urut dari hasil query
        $last_number = 0;
        if ($result && $result['no_rg']) {
            $last_number = (int) substr($result['no_rg'], -4);
        }

        // Increment nomor urut
        $new_number = $last_number + 1;

        // Format nomor registrasi baru
        $no_rg = "RG-{$tanggal}-" . str_pad($new_number, 4, '0', STR_PAD_LEFT);

        // Selesaikan transaksi
        $CI->db->trans_complete();

        $retry_count++;
    } while ($CI->db->trans_status() === FALSE && $retry_count < $max_retries);

    if ($CI->db->trans_status() === FALSE) {
        // Jika semua percobaan gagal, tampilkan pesan error atau lakukan tindakan lain
        log_message('error', 'Gagal membuat nomor registrasi unik setelah beberapa percobaan.');
        return FALSE;
    }
    return $no_rg;
}
