<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['title']		= 'Dashboard';
		$data['subtitle']	= 'Control Panel';

		$this->db->where('MONTH(terdaftar)', date('m'));
		$this->db->where('YEAR(terdaftar)', date('Y'));
		$data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');

        $data['dikembalikan']  = $this->db->query('SELECT * FROM tb_dipinjam WHERE idPeminjaman IN (SELECT id FROM tb_peminjaman WHERE idUser="'.$this->session->userdata('id').'") AND status="Disetujui" AND idUserpengembalian="0" ');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/footer');
    }
}