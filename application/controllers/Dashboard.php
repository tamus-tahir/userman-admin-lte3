<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Default_m');
        security();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['icon'] = $this->Default_m->getAll('tabel_icon', 'id_icon')->num_rows();
        $data['navigasi'] = $this->Default_m->getAll('tabel_navigasi', 'id_navigasi')->num_rows();
        $data['profil'] = $this->Default_m->getAll('tabel_profil', 'id_profil')->num_rows();
        $data['user'] = $this->Default_m->getAll('tabel_user', 'id_user')->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('master-data/dashboard/index', $data);
        $this->load->view('templates/foot', $data);
    }

    public function error()
    {
        $data['title'] = 'No Access';

        $this->load->view('templates/header', $data);
        $this->load->view('master-data/dashboard/no-access', $data);
        $this->load->view('templates/foot');
    }

    public function profil($id_user)
    {
        $data['title'] = 'Profil User';

        $where = ['id_user' => $id_user];
        $on = 'tabel_profil.id_profil = tabel_user.id_profil';
        $data['user'] = $this->Default_m->getWhereTwoTable('tabel_user', 'tabel_profil', $on, $where)->row();

        $this->load->view('templates/header', $data);
        $this->load->view('master-data/dashboard/profil', $data);
        $this->load->view('templates/foot');
    }

    public function changeprofil($id_user)
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('nama_user', 'nama lengkap', 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Ganti Profil';
            $where = ['id_user' => $id_user];
            $data['ubah'] = $this->Default_m->getWhere('tabel_user', $where)->row();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/dashboard/changeprofil', $data);
            $this->load->view('templates/foot');
        } else {
            $path = './assets/img/';
            $type = 'jpg|jpeg|png';
            $size = 5224;
            $name = 'foto';
            $fotoLama = $this->input->post('foto_lama');
            $id_user = $this->session->userdata('id_user');

            cekCSRF();
            $where = ['id_user' => $id_user];
            $data = [
                'username' => $this->input->post('username'),
                'telpon' => $this->input->post('telpon'),
                'nama_user' => $this->input->post('nama_user'),
                'foto' => !empty($_FILES[$name]['name']) ?  $this->Default_m->upload($path, $type, $size, $name) : $fotoLama
            ];

            $this->Default_m->update('tabel_user', $where, $data);
            if (!empty($_FILES[$name]['name'])) {
                unlink($path . $fotoLama);
            }

            // notifikasi error sql
            $error = $this->db->error();
            if ($error['code'] != 0) {
                $this->session->set_flashdata('error', 'Username Sudah Digunakan');
                redirect('dashboard/changeprofil/' . $id_user);
            } else {
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('dashboard');
            }
        }
    }

    public function changepass($id_user)
    {
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|matches[passconfirm]');
        $this->form_validation->set_rules('passconfirm', 'konfirmasi password', 'required|trim|min_length[8]|matches[password]');
        $this->form_validation->set_rules('oldpass', 'oldpass', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Ganti Password';

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/dashboard/changepass', $data);
            $this->load->view('templates/foot');
        } else {
            $oldpass = $this->input->post('oldpass');
            $password = $this->input->post('password');
            $id_user = $this->session->userdata('id_user');

            cekCSRF();
            $where = ['id_user' => $id_user];
            $user = $this->Default_m->getWhere('tabel_user', $where)->row();
            if (password_verify($oldpass, $user->password)) {
                $data = ['password' => password_hash($password, PASSWORD_DEFAULT),];
                $this->Default_m->update('tabel_user', $where, $data);
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password / Username Salah');
                redirect('dashboard/changepass/' . $id_user);
            }
        }
    }
}
