<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Default_m');
        security();
    }

    public function index()
    {
        $this->form_validation->set_rules('profil', 'profil', 'required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Data Profil';
            $data['profil'] = $this->Default_m->getAll('tabel_profil', 'id_profil')->result();
            $data['num'] = $this->Default_m->getAll('tabel_profil', 'id_profil')->num_rows();
            $data['akses'] = $this->Default_m->cekDetailAkses();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/profil/index', $data);
            $this->load->view('master-data/profil/script', $data);
            $this->load->view('templates/foot');
        } else {
            $id_profil = $this->input->post('id_profil');
            $token = $this->input->post('token');
            $data = ['profil' => $this->input->post('profil')];

            cekCSRF();
            if ($id_profil) {
                cekAksesDetail('ubah');
                cekToken($token, $id_profil);
                $where = ['id_profil' => $id_profil];
                $this->Default_m->update('tabel_profil', $where, $data);
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
            } else {
                cekAksesDetail('tambah');
                $this->Default_m->insert('tabel_profil', $data);
                $this->session->set_flashdata('flash', 'Data Berhasil Ditambahkan');
            }
            redirect('profil');
        }
    }

    public function getWhere()
    {
        $where = ['id_profil' => $_POST['id']];
        echo json_encode($this->Default_m->getWhere('tabel_profil', $where)->row());
    }

    public function hapus($id_profil, $token)
    {
        cekAksesDetail('hapus');
        cekToken($token, $id_profil);

        $where = ['id_profil' => $id_profil];
        $this->Default_m->delete('tabel_profil', $where);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
        }

        // notifikasi sql
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('error', 'Data Gagal Dihapus, Data Sedang Digunakan');
        }
        redirect('profil');
    }

    public function akses($id_profil)
    {
        $data['navigasi'] = $this->Default_m->getAll('tabel_navigasi', 'id_navigasi')->result();

        $where = ['id_profil' => $id_profil];
        $data['profil'] = $this->Default_m->getWhere('tabel_profil', $where)->row();

        $data['title'] = 'Profil Akses';
        $this->load->view('templates/header', $data);
        $this->load->view('master-data/profil/akses', $data);
        $this->load->view('master-data/profil/script-akses', $data);
        $this->load->view('templates/foot');
    }

    public function changeaccess()
    {
        $id_profil = $this->input->post('id_profil');
        $id_navigasi = $this->input->post('id_navigasi');

        $data = [
            'id_profil' => $id_profil,
            'id_navigasi' => $id_navigasi
        ];

        $result = $this->db->get_where('tabel_akses', $data);

        if ($result->num_rows() < 1) {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'tambah' => 1,
                'ubah' => 1,
                'hapus' => 1
            ];
            $this->db->insert('tabel_akses', $data);
        } else {
            $this->db->delete('tabel_akses', $data);
        }
    }

    public function changeCreate()
    {
        $id_profil = $this->input->post('id_profil');
        $id_navigasi = $this->input->post('id_navigasi');

        $where = [
            'id_profil' => $id_profil,
            'id_navigasi' => $id_navigasi
        ];

        $result = $this->db->get_where('tabel_akses', $where)->row();

        if ($result->tambah < 1) {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'tambah' => 1
            ];
        } else {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'tambah' => 0
            ];
        }
        $this->db->where($where);
        $this->db->update('tabel_akses', $data);
    }

    public function changeUpdate()
    {
        $id_profil = $this->input->post('id_profil');
        $id_navigasi = $this->input->post('id_navigasi');

        $where = [
            'id_profil' => $id_profil,
            'id_navigasi' => $id_navigasi
        ];

        $result = $this->db->get_where('tabel_akses', $where)->row();

        if ($result->ubah < 1) {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'ubah' => 1
            ];
        } else {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'ubah' => 0
            ];
        }
        $this->db->where($where);
        $this->db->update('tabel_akses', $data);
    }

    public function changeDelete()
    {
        $id_profil = $this->input->post('id_profil');
        $id_navigasi = $this->input->post('id_navigasi');

        $where = [
            'id_profil' => $id_profil,
            'id_navigasi' => $id_navigasi
        ];

        $result = $this->db->get_where('tabel_akses', $where)->row();

        if ($result->hapus < 1) {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'hapus' => 1
            ];
        } else {
            $data = [
                'id_profil' => $id_profil,
                'id_navigasi' => $id_navigasi,
                'hapus' => 0
            ];
        }
        $this->db->where($where);
        $this->db->update('tabel_akses', $data);
    }
}
