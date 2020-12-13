<?php

function check_access($id_profil, $id_navigasi)
{
    $ci = get_instance();

    $ci->db->where('id_profil', $id_profil);
    $ci->db->where('id_navigasi', $id_navigasi);
    $result = $ci->db->get('tabel_akses');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_access_cread($id_profil, $id_navigasi)
{
    $ci = get_instance();

    $ci->db->where('id_profil', $id_profil);
    $ci->db->where('id_navigasi', $id_navigasi);
    $result = $ci->db->get('tabel_akses')->row();

    if ($result->tambah > 0) {
        return "checked='checked'";
    }
}

function check_access_update($id_profil, $id_navigasi)
{
    $ci = get_instance();

    $ci->db->where('id_profil', $id_profil);
    $ci->db->where('id_navigasi', $id_navigasi);
    $result = $ci->db->get('tabel_akses')->row();

    if ($result->ubah > 0) {
        return "checked='checked'";
    }
}

function check_access_delete($id_profil, $id_navigasi)
{
    $ci = get_instance();

    $ci->db->where('id_profil', $id_profil);
    $ci->db->where('id_navigasi', $id_navigasi);
    $result = $ci->db->get('tabel_akses')->row();

    if ($result->hapus > 0) {
        return "checked='checked'";
    }
}

function security()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('connect');
    } else {
        $id_user = $ci->session->userdata('id_user');
        $data = $ci->Default_m->getWhere('tabel_user', ['id_user' => $id_user])->row();
        $id_profil = $data->id_profil;

        $data = $ci->db->get_where('tabel_navigasi', ['url' => $ci->uri->segment(1)])->row();

        $akses = $ci->db->get_where('tabel_akses', [
            'id_profil' => $id_profil,
            'id_navigasi' => $data->id_navigasi
        ]);

        if ($akses->num_rows() < 1) {
            redirect('dashboard/error');
        }
    }
}

function cekAksesDetail($param)
{
    $ci = get_instance();
    $where = ['url' => $ci->uri->segment(1)];
    $page = $ci->Default_m->getWhere('tabel_navigasi', $where)->row();

    $where = ['id_navigasi' => $page->id_navigasi, 'id_profil' => $ci->session->userdata('id_profil')];
    $akses = $ci->Default_m->getWhere('tabel_akses', $where)->row();

    if ($akses->$param == 0) {
        $ci->session->set_flashdata('error', 'Anda Tidak Meiliki Akses');
        redirect('dashboard/error');
    }
}

function generate($param)
{
    $st = '';
    for ($i = 0; $i < strlen($param); $i++) {
        $st .= hash('sha256', substr($param, $i, 1));
    }
    return hash('md5', $st);
}

function cekToken($token, $param)
{
    $ci = get_instance();
    if ($token != generate($param)) {
        $ci->session->set_flashdata('error', 'Token Error');
        redirect('dashboard/error');
    }
}

function csrfName()
{
    return 'csrf_token';
}

function cekSessionCSRF()
{
    $ci = get_instance();
    if (!$ci->session->csrf_token) {
        $ci->session->csrf_token = hash('sha1', time());
    }
}

function cekCSRF()
{
    $ci = get_instance();
    if ($ci->input->post('csrf_token') != $ci->session->csrf_token) {
        $ci->session->unset_userdata('csrf_token');
        redirect('notfound');
    }
    $ci->session->unset_userdata('csrf_token');
}
