<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi extends CI_Controller {

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
        $data['title']      = 'Data Fungsi';
        $data['subtitle']   = 'Semua data fungsi akan ditampilkan disini';

        $data['fungsi']   = $this->m_model->get_desc('tb_fungsi');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/fungsi');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id );

        $this->m_model->delete($where, 'tb_fungsi');
        $this->session->set_flashdata('pesan','Data berhasil dihapus!');
        redirect('admin/fungsi');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');

        $fungsi         = $_POST['fungsi'];
        $keterangan     = $_POST['keterangan'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = array(
            'fungsi'        => $fungsi,
            'keterangan'    => $keterangan,
            'terdaftar'     => $terdaftar,
        );

        $this->m_model->insert($data, 'tb_fungsi');
        $this->session->set_flashdata('pesan','Data berhasil ditambahkan!');
        redirect('admin/fungsi');
    }

    public function update($id)
    {
        $fungsi         = $_POST['fungsi'];
        $keterangan     = $_POST['keterangan'];

        $data = array(
            'fungsi'        => $fungsi,
            'keterangan'    => $keterangan,
        );

        $where = array('id' => $id );

        $this->m_model->update($where, $data, 'tb_fungsi');
        $this->session->set_flashdata('pesan','Data berhasil diubah!');
        redirect('admin/fungsi');
    }
}