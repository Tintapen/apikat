<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;
use Html2Text\Html2Text;

class Pengembalian extends CI_Controller
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
        $data['title']      = 'Data Pengembalian';
        $data['subtitle']   = 'Semua data pengembalian akan ditampilkan disini';

        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/pengembalian');
        $this->load->view('admin/templates/footer');
    }

    public function proses($id)
    {
        $data['title']      = 'Kelola Pengembalian';
        $data['subtitle']   = 'Kelola pengembalian pada halaman ini';

        $data['idPeminjaman']   = $id;

        $this->db->where('id', $id);
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', 'Disetujui');
        $this->db->where('idUserpengembalian', 0);
        $data['disetujui']  = $this->m_model->get_desc('tb_dipinjam');
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', 'Disetujui');
        $this->db->where('idUserpengembalian !=', 0);
        $data['dikembalikan']  = $this->m_model->get_desc('tb_dipinjam');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/responpengembalian');
        $this->load->view('admin/templates/footer');
    }

    public function prosespengembalian($idPeminjaman)
    {
        date_default_timezone_set('Asia/Jakarta');

        if (empty($_POST['idPinjam'])) {
            $this->session->set_flashdata('pesanError', 'Centang minimal 1 perangkat yang dikembalikan');
            redirect("admin/pengembalian/proses/$idPeminjaman");
        } else {

            $idUserpengembalian = $this->session->userdata('id');
            $tglPengembalian    = date('Y-m-d H:i:s');

            foreach ($_POST['idPinjam'] as $key => $id) {

                $this->db->where('id', $id);
                foreach ($this->db->get('tb_dipinjam')->result() as $dPnjm) {
                }

                $this->db->where('id', $dPnjm->idPerangkat);
                foreach ($this->db->get('tb_perangkat')->result() as $dPrkt) {
                }

                $whereUpdateperangkat = array('id' => $dPnjm->idPerangkat);
                $dataUpdateperangkat = array('stok' => $dPrkt->stok + $dPnjm->jumlah);

                $where = array('id' => $id);
                $data = array(
                    'idUserpengembalian'    => $idUserpengembalian,
                    'tglPengembalian'       => $tglPengembalian
                );

                $this->m_model->update($where, $data, 'tb_dipinjam');
                $this->m_model->update($whereUpdateperangkat, $dataUpdateperangkat, 'tb_perangkat');
            }

            $this->session->set_flashdata('pesan', 'Perangkat berhasil dikembalikan!');
            redirect("admin/pengembalian/proses/$idPeminjaman");
        }
    }

    public function kirimNotifikasi($id)
    {
        $data['title']  = 'Data Peminjaman';

        //* Tempat menyimpan file
        $folder = FCPATH . 'tmp';

        //? Cek apakah folder tidak tersedia maka akan dibuatkan foldernya
        if (!is_dir($folder))
            mkdir($folder);

        $fileName = "DataPeminjaman_" . date('YmdHis') . ".pdf";
        $file = $folder . "/" . "$fileName";

        $this->db->where('id', $id);
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');
        $data['pengembalian'] = "Y";
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', "Disetujui");
        $data['disetujui']  = $this->m_model->get_desc('tb_dipinjam');
        $data['status'] = "Y";

        $html = $this->load->view('admin/cetakdisetujui', $data, true);
        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);
        $html2pdf->output($file, 'F');

        $subject = "Informasi Peminjaman Perangkat ICT";
        $this->db->where('id', $id);
        $peminjaman = $this->m_model->get_desc('tb_peminjaman')->row();
        $this->db->where('id', $peminjaman->idUser);
        $user = $this->m_model->get_desc('tb_user')->row();

        $template['user'] = $user;
        $template['message'] = "<p>Sehubungan dengan peminjaman perangkat yang telah diajukan, berikut kami lampirkan data perangkat yang belum dikembalikan.</p>";

        $message = $this->load->view('admin/templates/emailtemplate', $template, true);
        $message = new Html2Text($message);

        $send = $this->m_model->sendEmail($user->email, $subject, $file, $message->getText());
        echo json_encode($send);
    }
}
