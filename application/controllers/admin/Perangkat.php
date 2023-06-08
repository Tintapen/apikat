<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perangkat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data Perangkat';
        $data['subtitle']   = 'Semua data perangkat akan ditampikan disini';

        $data['kategori'] = $this->m_model->get_desc('tb_kategori');
        $data['perangkat'] = $this->m_model->get_desc('tb_perangkat');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/perangkat');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_perangkat');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('admin/perangkat');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');

        $idKategori     = $_POST['idKategori'];
        $nama           = $_POST['nama'];
        $deskripsi      = $_POST['deskripsi'];
        $stok           = $_POST['stok'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = array(
            'idKategori'    => $idKategori,
            'nama'          => $nama,
            'deskripsi'     => $deskripsi,
            'stok'          => $stok,
            'terdaftar'     => $terdaftar
        );

        $this->m_model->insert($data, 'tb_perangkat');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('admin/perangkat');
    }

    public function update($id)
    {
        $idKategori     = $_POST['idKategori'];
        $nama           = $_POST['nama'];
        $deskripsi      = $_POST['deskripsi'];
        $stok           = $_POST['stok'];

        $data = array(
            'idKategori'    => $idKategori,
            'nama'          => $nama,
            'deskripsi'     => $deskripsi,
            'stok'          => $stok
        );

        $where = array('id' => $id);

        $this->m_model->update($where, $data, 'tb_perangkat');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('admin/perangkat');
    }

    public function history($id)
    {
        $data['title']      = 'History Data Perangkat';
        $data['subtitle']   = 'Semua history perangkat yang dipilih akan ditampikan disini';

        $this->db->where('id', $id);
        $data['perangkat']  = $this->m_model->get_desc('tb_perangkat');
        $this->db->where('idPerangkat', $id);
        $data['dipinjam']   = $this->m_model->get_desc('tb_dipinjam');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/historyperangkat');
        $this->load->view('admin/templates/footer');
    }
}
