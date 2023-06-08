<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        $data['title']      = 'Laporan Pengembalian';
        $data['perangkat'] = $this->m_model->get_desc('tb_perangkat')->result();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/viewLaporan');
        $this->load->view('admin/templates/footer');
    }

    public function showAll()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [];
        $number = 0;

        if (isset($post['form']) && $post['clear'] === 'false') {
            foreach ($post['form'] as $field) :
                if (!empty($field['value'])) {
                    if ($field['name'] === "perangkat") {
                        $this->db->where('idPerangkat', $field['value']);
                    }

                    if ($field['name'] === "tgl_kembali") {
                        $datetime =  urldecode($field['value']);
                        $date = explode(" - ", $datetime);

                        $this->db->where('idUserpengembalian <>', 0);
                        $this->db->where('tglPengembalian >="' . $date[0] . '" AND tglPengembalian <="' . $date[1] . '"');
                    }

                    if ($field['name'] === "status") {
                        if ($field['value'] == 1) {
                            $this->db->where('idUserpengembalian <>', 0);
                        } else {
                            $this->db->where('idUserpengembalian', 0);
                        }
                    }
                }
            endforeach;

            $this->db->where('status', "Disetujui");
            $list = $this->m_model->get_desc('tb_dipinjam')->result();
            foreach ($list as $value) :
                $this->db->where('id', $value->idPeminjaman);
                $pinjam = $this->m_model->get_desc('tb_peminjaman')->row();

                $this->db->where('id', $pinjam->idUser);
                $user = $this->m_model->get_desc('tb_user')->row();

                $this->db->where('id', $value->idPerangkat);
                $perangkat = $this->m_model->get_desc('tb_perangkat')->row();

                $row = [];
                $number++;

                $row[] = $number;
                $row[] = $pinjam->nomor;
                $row[] = $user->nama;
                $row[] = $perangkat->nama;
                $row[] = date('d F Y', strtotime($pinjam->tanggalPinjam));

                if ($value->idUserpengembalian != 0) {
                    $row[] = date('d F Y H:i:s', strtotime($value->tglPengembalian));
                    $row[] = "Sudah kembali";
                } else {
                    $row[] = date('d F Y', strtotime($pinjam->tanggalKembali));
                    $row[] = "Belum kembali";
                }
                $row[] = $pinjam->keperluan;
                $row[] = $pinjam->keterangan;
                $row[] = $value->catatan;
                $data[] = $row;
            endforeach;
        }

        $response = [
            'data'                    => $data
        ];

        echo json_encode($response);
    }
}
