<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('level')){
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function admin()
    {
        $data['title']      = 'Data Notifikasi';
        $data['subtitle']   = 'Semua data Notifikasi akan ditampilkan disini';

        $this->db->where('tujuan', 'Administrator');
        $data['notifikasi'] = $this->m_model->get_desc('tb_notifikasi');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/notifikasi');
        $this->load->view('admin/templates/footer');
    }

    public function user()
    {
        $data['title']      = 'Data Notifikasi';
        $data['subtitle']   = 'Semua data Notifikasi akan ditampilkan disini';

        $this->db->where('idUser', $this->session->userdata('id'));
        $this->db->where('tujuan', 'User');
        $data['notifikasi'] = $this->m_model->get_desc('tb_notifikasi');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/notifikasi');
        $this->load->view('admin/templates/footer');
    }

    public function dibaca()
    {
        if($this->session->userdata('level') == 'Administrator') {
            $where = array(
                'dibaca' => 'Belum Dibaca',
                'tujuan' => 'Administrator',
            );
            $data = array('dibaca' => 'Sudah Dibaca');

            $this->m_model->update($where, $data, 'tb_notifikasi');
            $this->session->set_flashdata('pesan', 'Notifikasi berhasil ditandai terbaca!');
            redirect('admin/notifikasi/admin');
        } else {
            $where = array(
                'dibaca' => 'Belum Dibaca',
                'tujuan' => 'User',
                'idUser' => $this->session->userdata('id'),
            );
            $data = array('dibaca' => 'Sudah Dibaca');

            $this->m_model->update($where, $data, 'tb_notifikasi');
            $this->session->set_flashdata('pesan', 'Notifikasi berhasil ditandai terbaca!');
            redirect('admin/notifikasi/user');
        }
    }
}