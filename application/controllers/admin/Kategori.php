<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('level')){
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data Kategori';
        $data['subtitle']   = 'Semua data kategori akan ditampilkan disini';

        $data['kategori']   = $this->m_model->get_desc('tb_kategori');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/kategori');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id );

        $this->m_model->delete($where, 'tb_kategori');
        $this->session->set_flashdata('pesan','Data berhasil dihapus!');
        redirect('admin/kategori');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');

        $kategori       = $_POST['kategori'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = array(
            'kategori'      => $kategori,
            'terdaftar'     => $terdaftar,
        );

        $this->m_model->insert($data, 'tb_kategori');
        $this->session->set_flashdata('pesan','Data berhasil ditambahkan!');
        redirect('admin/kategori');
    }

    public function update($id)
    {
        $kategori       = $_POST['kategori'];

        $data = array(
            'kategori'      => $kategori,
        );

        $where = array('id' => $id );

        $this->m_model->update($where, $data, 'tb_kategori');
        $this->session->set_flashdata('pesan','Data berhasil diubah!');
        redirect('admin/kategori');
    }

    public function history($id)
    {
        $data['title']      = 'History Kategori';
        $data['subtitle']   = 'Semua history perangkat yang dipilih akan ditampilkan disini';

        $this->db->where('id', $id);
        $data['kategori']     = $this->m_model->get_desc('tb_kategori');
        $this->db->where('idKategori', $id);
        $data['history']    = $this->m_model->get_desc('tb_perangkat');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/historykategori');
        $this->load->view('admin/templates/footer');
    }
}