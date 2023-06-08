<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('level')) {
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		} elseif ($this->session->userdata('level') != 'Administrator') {
			redirect('home');
		}
	}

	public function index()
	{
		$data['title']		= 'Manajemen User';
		$data['subtitle']	= 'Semua user akan muncul disini';

		$this->db->where('level !=', 'Sales');
		$data['user']       = $this->m_model->get_desc('tb_user');

		$data['fungsi']       = $this->m_model->get_desc('tb_fungsi');

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/user');
		$this->load->view('admin/templates/footer');
	}

	public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_user');
		$this->session->set_flashdata('pesan', 'Account berhasil dihapus');
		redirect('admin/user');
	}

	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');
		$nama		= $_POST['nama'];
		$telp		= $_POST['telp'];
		$email		= $_POST['email'];
		$username	= $_POST['username'];
		$password	= $_POST['password'];
		$foto		= 'no-image.png';
		$skin		= 'blue';
		$idFungsi	= $_POST['idFungsi'];
		$level		= $_POST['level'];
		$terdaftar	= date('Y-m-d H:i:s');

		$where = array('username' => $username);
		$cekUsername	= $this->m_model->get_where($where, 'tb_user');
		if (empty($cekUsername->num_rows())) {
			$options = [
				'cost' => 10,
			];

			$enkripPassword = password_hash($password, PASSWORD_BCRYPT, $options);

			$data = array(
				'nama' 		=> $nama,
				'telp' 		=> $telp,
				'email' 	=> $email,
				'username'	=> $username,
				'password'	=> $enkripPassword,
				'foto'		=> $foto,
				'skin'		=> $skin,
				'idFungsi'	=> $idFungsi,
				'level'		=> $level,
				'terdaftar'	=> $terdaftar,
			);

			$this->m_model->insert($data, 'tb_user');
			$this->session->set_flashdata('pesan', 'Account berhasil dibuat!');
			redirect('admin/user');
		} else {
			$this->session->set_flashdata('pesanError', 'Username sudah ada!');
			redirect('admin/user');
		}
	}

	public function update($id)
	{
		$nama		= $_POST['nama'];
		$telp		= $_POST['telp'];
		$email		= $_POST['email'];
		$username	= $_POST['username'];
		$idFungsi	= $_POST['idFungsi'];
		$level		= $_POST['level'];

		$data = array(
			'nama' 		=> $nama,
			'telp' 		=> $telp,
			'email' 	=> $email,
			'username'	=> $username,
			'idFungsi'	=> $idFungsi,
			'level'		=> $level,
		);

		$where = array('id' => $id);

		$this->m_model->update($where, $data, 'tb_user');
		$this->session->set_flashdata('pesan', 'Account berhasil diubah!');
		redirect('admin/user');
	}

	public function resetpassword($id)
	{
		$password	= $_POST['password'];

		$options = [
			'cost' => 10,
		];

		$enkripPassword = password_hash($password, PASSWORD_BCRYPT, $options);

		$data = array(
			'password'	=> $enkripPassword,
		);

		$where = array('id' => $id);

		$this->m_model->update($where, $data, 'tb_user');
		$this->session->set_flashdata('pesan', 'Reset password berhasil!');
		redirect('admin/user');
	}
}
