<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Default_m');
        security();
    }

    public function index()
    {
        $data['title'] = 'Data User';
        $data['akses'] = $this->Default_m->cekDetailAkses();

        $on = 'tabel_profil.id_profil = tabel_user.id_profil';
        $data['user'] = $this->Default_m->getAllTwoTable('tabel_user', 'tabel_profil', $on, 'id_user')->result();
        $data['num'] = $this->Default_m->getAll('tabel_user', 'id_user')->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('master-data/user/index', $data);
        $this->load->view('templates/foot', $data);
    }

    public function tambah()
    {
        cekAksesDetail('tambah');

        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[tabel_user.username]');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|matches[passconfirm]');
        $this->form_validation->set_rules('passconfirm', 'konfirmasi password', 'required|trim|min_length[8]|matches[password]');
        $this->form_validation->set_rules('nama_user', 'nama lengkap', 'required|trim');
        $this->form_validation->set_rules('id_profil', 'profil', 'required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Tambah User';
            $data['profil'] = $this->Default_m->getAll('tabel_profil', 'id_profil')->result();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/user/tambah', $data);
            $this->load->view('templates/foot', $data);
        } else {
            $path = './assets/img/';
            $type = 'jpg|jpeg|png';
            $size = 500;
            $name = 'foto';

            cekCSRF();
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_user' => $this->input->post('nama_user'),
                'telpon' => $this->input->post('telpon'),
                'id_profil' => $this->input->post('id_profil'),
                'aktif' => $this->input->post('aktif'),
                'foto' => !empty($_FILES[$name]["name"]) ?  $this->Default_m->upload($path, $type, $size, $name) : ''
            ];

            $this->Default_m->insert('tabel_user', $data);
            $this->session->set_flashdata('flash', 'Data Berhasil Ditambahkan');
            redirect('user');
        }
    }

    public function ubah($id_user)
    {
        cekAksesDetail('ubah');
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('nama_user', 'nama lengkap', 'required|trim');
        $this->form_validation->set_rules('id_profil', 'profil', 'required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Ubah User';
            $data['profil'] = $this->Default_m->getAll('tabel_profil', 'id_profil')->result();

            $where = ['id_user' => $id_user];
            $data['ubah'] = $this->Default_m->getWhere('tabel_user', $where)->row();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/user/ubah', $data);
            $this->load->view('templates/foot', $data);
        } else {
            $path = './assets/img/';
            $type = 'jpg|jpeg|png';
            $size = 500;
            $name = 'foto';
            $fotoLama = $this->input->post('foto_lama');
            $token = $this->input->post('token');
            $id_user = $this->input->post('id_user');

            cekCSRF();
            cekToken($token, $id_user);

            $where = ['id_user' => $id_user];
            $data = [
                'username' => $this->input->post('username'),
                'nama_user' => $this->input->post('nama_user'),
                'telpon' => $this->input->post('telpon'),
                'id_profil' => $this->input->post('id_profil'),
                'aktif' => $this->input->post('aktif'),
                'foto' => !empty($_FILES[$name]["name"]) ?  $this->Default_m->upload($path, $type, $size, $name) : $fotoLama
            ];

            $this->Default_m->update('tabel_user', $where, $data);
            if (!empty($_FILES[$name]["name"])) {
                unlink($path . $fotoLama);
            }

            // notifikasi error sql
            $error = $this->db->error();
            if ($error['code'] != 0) {
                $this->session->set_flashdata('error', 'Username Sudah Digunakan');
                redirect('user/ubah/' . $id_user);
            } else {
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('user');
            }
        }
    }

    public function password($id_user)
    {
        cekAksesDetail('ubah');

        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|matches[passconfirm]');
        $this->form_validation->set_rules('passconfirm', 'konfirmasi password', 'required|trim|min_length[8]|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Ubah Password';
            $where = ['id_user' => $id_user];
            $data['ubah'] = $this->Default_m->getWhere('tabel_user', $where)->row();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/user/password', $data);
            $this->load->view('templates/foot', $data);
        } else {
            $token = $this->input->post('token');
            $id_user = $this->input->post('id_user');
            cekCSRF();
            cekToken($token, $id_user);
            $where = ['id_user' => $id_user];
            $data = ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)];
            $this->Default_m->update('tabel_user', $where, $data);
            $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
            redirect('user');
        }
    }

    public function hapus($id_user, $token)
    {
        cekAksesDetail('hapus');
        cekToken($token, $id_user);

        $where = ['id_user' => $id_user];
        $user = $this->Default_m->getWhere('tabel_user', $where)->row();
        unlink('./assets/img/' . $user->foto);
        $this->Default_m->delete('tabel_user', $where);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
            redirect('user');
        }
    }

    function getWhere()
    {
        $where = ['id_user' => $this->uri->segment(3)];
        $on = 'tabel_profil.id_profil = tabel_user.id_profil';
        $data['user'] = $this->Default_m->getWhereTwoTable('tabel_user', 'tabel_profil', $on, $where)->row();
        $this->load->view('master-data/user/detail', $data);
    }
}
