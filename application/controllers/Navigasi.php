<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Default_m');
        security();
    }

    public function index()
    {
        $this->form_validation->set_rules('navigasi', 'navigasi', 'required');
        $this->form_validation->set_rules('urutan', 'urutan', 'required');
        $this->form_validation->set_rules('dropdown', 'dropdown', 'required');
        $this->form_validation->set_rules('aktif', 'aktif', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('cud', 'cud', 'required');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback text-capitalize">', '</div>');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Navigasi';
            $data['navigasi'] = $this->Default_m->getAll('tabel_navigasi', 'id_navigasi')->result();
            $data['num'] = $this->Default_m->getAll('tabel_navigasi', 'id_navigasi')->num_rows();
            $data['icon'] = $this->Default_m->getAll('tabel_icon', 'id_icon')->result();

            $data['akses'] = $this->Default_m->cekDetailAkses();

            $this->load->view('templates/header', $data);
            $this->load->view('master-data/navigasi/index', $data);
            $this->load->view('master-data/navigasi/script', $data);
            $this->load->view('templates/foot');
        } else {
            $id_navigasi = $this->input->post('id_navigasi');
            $token = $this->input->post('token');
            $data = [
                'navigasi' => $this->input->post('navigasi'),
                'heading' => $this->input->post('heading'),
                'url' => $this->input->post('url'),
                'icon' => empty($this->input->post('icon')) ? 'far fa-circle' : $this->input->post('icon'),
                'dropdown' => $this->input->post('dropdown'),
                'urutan' => $this->input->post('urutan'),
                'aktif' => $this->input->post('aktif'),
                'cud' => $this->input->post('cud')
            ];

            cekCSRF();
            if ($id_navigasi) {
                cekAksesDetail('ubah');
                cekToken($token, $id_navigasi);
                $where = ['id_navigasi' => $id_navigasi];
                $this->Default_m->update('tabel_navigasi', $where, $data);
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
            } else {
                cekAksesDetail('tambah');
                $this->Default_m->insert('tabel_navigasi', $data);
                $this->session->set_flashdata('flash', 'Data Berhasil Ditambahkan');
            }
            redirect('navigasi');
        }
    }

    public function getWhere()
    {
        $where = ['id_navigasi' => $_POST['id']];
        echo json_encode($this->Default_m->getWhere('tabel_navigasi', $where)->row());
    }

    public function getSearch()
    {
        $like = $_POST['keyword'];
        echo json_encode($this->Default_m->getSearch('tabel_icon', 'icon', $like, 'id_icon')->result());
    }

    public function getIcon()
    {
        echo json_encode($this->Default_m->getAll('tabel_icon', 'id_icon')->result());
    }

    public function hapus($id_navigasi, $token)
    {
        cekAksesDetail('hapus');
        cekToken($token, $id_navigasi);

        $where = ['id_navigasi' => $id_navigasi];
        $this->Default_m->delete('tabel_navigasi', $where);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
            redirect('navigasi');
        }
    }
}
