<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;
use Html2Text\Html2Text;

class Peminjaman extends CI_Controller
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
        $data['title']      = 'Data Peminjaman';
        $data['subtitle']   = 'Menampilkan semua data peminjaman';

        if ($this->session->userdata('level') == 'User') {
            $this->db->where('idUser', $this->session->userdata('id'));
        }
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/peminjaman');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_peminjaman');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('admin/peminjaman');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');

        $idUser             = $this->session->userdata('id');
        $tanggalPinjam      = $_POST['tanggalPinjam'];
        $tanggalKembali     = $_POST['tanggalKembali'];
        $keperluan          = $_POST['keperluan'];
        $keterangan         = $_POST['keterangan'];
        $terdaftar          = date('Y-m-d H:i:s');

        $this->db->order_by('id', 'DESC');
        $this->db->limit('1');
        $hitung = $this->db->get('tb_peminjaman');
        if (empty($hitung->num_rows())) {
            $nomor = date('Y') . '1';
        } else {
            foreach ($hitung->result() as $dNmr) {
                $nmr    = $dNmr->id + 1;
                $nomor  = date('Y') . $nmr;
            }
        }

        $data = array(
            'nomor'             => $nomor,
            'idUser'            => $idUser,
            'tanggalPinjam'     => $tanggalPinjam,
            'tanggalKembali'    => $tanggalKembali,
            'keperluan'         => $keperluan,
            'keterangan'        => $keterangan,
            'terdaftar'         => $terdaftar,
        );

        $dataNotifikasi = array(
            'idUser'        => $this->session->userdata('id'),
            'keterangan'    => 'Mengajukan peminjaman perangkat',
            'tujuan'        => 'Administrator',
            'dibaca'        => 'Belum Dibaca',
            'terdaftar'     => $terdaftar
        );

        $this->m_model->insert($data, 'tb_peminjaman');
        $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');

        foreach ($this->m_model->get_where($data, 'tb_peminjaman')->result() as $dPnjmn) {

            $this->session->set_flashdata('pesan', 'Silahkan menambahkan perangkat yang dipinjam!');
            redirect("admin/peminjaman/kelola/$dPnjmn->id");
        }
    }

    public function update($id)
    {
        $tanggalPinjam      = $_POST['tanggalPinjam'];
        $tanggalKembali     = $_POST['tanggalKembali'];
        $keperluan          = $_POST['keperluan'];
        $keterangan         = $_POST['keterangan'];

        $data = array(
            'tanggalPinjam'     => $tanggalPinjam,
            'tanggalKembali'    => $tanggalKembali,
            'keperluan'         => $keperluan,
            'keterangan'        => $keterangan,
        );

        $where = array('id' => $id);

        $this->m_model->update($where, $data, 'tb_peminjaman');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('admin/peminjaman');
    }

    public function kelola($id)
    {
        $data['title']      = 'Kelola Peminjaman';
        $data['subtitle']   = 'Kelola peminjaman pada halaman ini';

        $data['idPeminjaman']   = $id;

        $this->db->where('id', $id);
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');
        $this->db->where('idPeminjaman', $id);
        $data['dipinjam']   = $this->m_model->get_desc('tb_dipinjam');
        $data['perangkat']  = $this->m_model->get_desc('tb_perangkat');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/kelolapeminjaman');
        $this->load->view('admin/templates/footer');
    }

    public function addtocart($idPeminjaman)
    {
        date_default_timezone_set('Asia/Jakarta');

        if (empty($_POST['idPerangkat'])) {
            $this->session->set_flashdata('pesanError', 'Centang minimal 1 perangkat untuk dipinjam');
            redirect("admin/peminjaman/kelola/$idPeminjaman");
        } else {
            foreach ($_POST['idPerangkat'] as $key => $id) {

                if ($_POST['jumlah'][$key] > 0) {
                    $this->db->where('id', $id);
                    foreach ($this->db->get('tb_perangkat')->result() as $dPrkt) {
                    }

                    $data = array(
                        'idPeminjaman'  => $idPeminjaman,
                        'idPerangkat'   => $id,
                        'idKategori'    => $dPrkt->idKategori,
                        'nama'          => $dPrkt->nama,
                        'deskripsi'     => $dPrkt->deskripsi,
                        'jumlah'        => $_POST['jumlah'][$key],
                        'status'        => 'Diproses',
                        'terdaftar'     => date('Y-m-d H:i:s')
                    );

                    $whereUpdate = array('id' => $id);
                    $dataUpdate = array('stok' => $dPrkt->stok - $_POST['jumlah'][$key]);

                    $this->m_model->insert($data, 'tb_dipinjam');
                    $this->m_model->update($whereUpdate, $dataUpdate, 'tb_perangkat');
                }
            }

            $this->session->set_flashdata('pesan', 'Perangkat berhasil dipinjam!');
            //redirect("admin/peminjaman/kelola/$idPeminjaman");
            redirect("admin/peminjaman");
        }
    }

    public function deletecart($idPeminjaman)
    {
        if (empty($_POST['idPinjam'])) {
            $this->session->set_flashdata('pesanError', 'Centang minimal 1 perangkat untuk dihapus');
            redirect("admin/peminjaman/kelola/$idPeminjaman");
        } else {

            foreach ($_POST['idPinjam'] as $key => $id) {
                //Get Data Pinjam
                $this->db->where('id', $id);
                foreach ($this->db->get('tb_dipinjam')->result() as $dPinjam) {
                }

                //Get Data Perangkat
                $this->db->where('id', $dPinjam->idPerangkat);
                foreach ($this->db->get('tb_perangkat')->result() as $dPrkt) {
                }

                $whereUpdate = array('id' => $dPinjam->idPerangkat);
                $dataUpdate = array('stok' => $dPrkt->stok + $dPinjam->jumlah);

                $whereDelete = array('id' => $id);

                $this->m_model->delete($whereDelete, 'tb_dipinjam');
                $this->m_model->update($whereUpdate, $dataUpdate, 'tb_perangkat');
            }

            $this->session->set_flashdata('pesan', 'Perangkat berhasil dihapus. Stok akan dikembalikan!');
            redirect("admin/peminjaman/kelola/$idPeminjaman");
        }
    }

    public function respon($id)
    {
        $data['title']      = 'Respon Peminjaman';
        $data['subtitle']   = 'Respon peminjaman pada halaman ini';

        $data['idPeminjaman']   = $id;

        $this->db->where('id', $id);
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', 'Diproses');
        $data['dipinjam']   = $this->m_model->get_desc('tb_dipinjam');
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', 'Disetujui');
        $data['disetujui']  = $this->m_model->get_desc('tb_dipinjam');
        $this->db->where('idPeminjaman', $id);
        $this->db->where('status', 'Ditolak');
        $data['ditolak']    = $this->m_model->get_desc('tb_dipinjam');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/responpeminjaman');
        $this->load->view('admin/templates/footer');
    }

    public function respondata($idPeminjaman, $idUser)
    {
        date_default_timezone_set('Asia/Jakarta');
        $terdaftar  = date('Y-m-d H:i:s');

        if (empty($_POST['idPinjam'])) {
            $this->session->set_flashdata('pesanError', 'Centang minimal 1 perangkat untuk merespon');
            redirect("admin/peminjaman/respon/$idPeminjaman");
        } else {
            $status     = $_POST['status'];
            $catatan    = $_POST['catatan'];

            if ($status == 'Disetujui') {
                foreach ($_POST['idPinjam'] as $key => $id) {

                    $dataUpdate = array(
                        'status'    => $status,
                        'catatan'   => $catatan,
                    );

                    $whereUpdate = array('id' => $id);

                    $this->m_model->update($whereUpdate, $dataUpdate, 'tb_dipinjam');
                }

                $this->session->set_flashdata('pesan', 'Perangkat berhasil disetujui');
            } else {
                foreach ($_POST['idPinjam'] as $key => $id) {
                    $this->db->where('id', $id);
                    foreach ($this->db->get('tb_dipinjam')->result() as $dPnjm) {
                    }

                    $this->db->where('id', $dPnjm->idPerangkat);
                    foreach ($this->db->get('tb_perangkat')->result() as $dPrkt) {
                    }

                    $whereUpdateperangkat = array('id' => $dPnjm->idPerangkat);
                    $dataUpdateperangkat = array('stok' => $dPrkt->stok + $dPnjm->jumlah);

                    $dataUpdate = array(
                        'status'    => $status,
                        'catatan'   => $catatan,
                    );

                    $whereUpdate = array('id' => $id);

                    $this->m_model->update($whereUpdate, $dataUpdate, 'tb_dipinjam');
                    $this->m_model->update($whereUpdateperangkat, $dataUpdateperangkat, 'tb_perangkat');
                }

                $this->session->set_flashdata('pesan', 'Perangkat berhasil ditolak');
            }

            $dataNotifikasi = array(
                'idUser'        => $idUser,
                'keterangan'    => 'Pengajuan peminjaman telah direspon',
                'tujuan'        => 'User',
                'dibaca'        => 'Belum Dibaca',
                'terdaftar'     => $terdaftar
            );

            $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');

            $this->db->where([
                'idPeminjaman'  => $idPeminjaman,
                'status'        => 'Diproses'
            ]);
            $respon = $this->m_model->get_desc('tb_dipinjam')->num_rows();

            if ($respon == 0)
                $this->responSelesai($idPeminjaman);

            redirect("admin/peminjaman/respon/$idPeminjaman");
        }
    }

    public function cetakdisetujui($id, $status = null)
    {
        $data['title']  = 'Cetak Peminjaman';

        //* Tempat menyimpan file
        $folder = FCPATH . 'tmp';

        //? Cek apakah folder tidak tersedia maka akan dibuatkan foldernya
        if (!is_dir($folder))
            mkdir($folder);

        $fileName = "CetakPeminjaman_" . date('YmdHis') . ".pdf";
        $dir = $folder . "/" . "$fileName";

        $this->db->where('id', $id);
        $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman');
        $this->db->where('idPeminjaman', $id);
        $data['disetujui']  = $this->m_model->get_desc('tb_dipinjam');
        $data['status']  = $status;

        $html = $this->load->view('admin/cetakdisetujui', $data, true);

        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML($html);

        if (!empty($status)) {
            $html2pdf->output($dir, 'F');
            return $dir;
        } else {
            $html2pdf->output($fileName);
        }
    }

    public function responSelesai($idPeminjaman)
    {
        $file = $this->cetakdisetujui($idPeminjaman, 'Y');
        $subject = "Informasi Peminjaman Perangkat ICT";

        $this->db->where('id', $idPeminjaman);
        $peminjaman = $this->m_model->get_desc('tb_peminjaman')->row();
        $this->db->where('id', $peminjaman->idUser);
        $user = $this->m_model->get_desc('tb_user')->row();

        $data['user'] = $user;
        $data['message'] = "<p>Sehubungan dengan peminjaman perangkat yang telah diajukan, berikut kami lampirkan surat balasan dalam bentuk PDF.</p>";

        $message = $this->load->view('admin/templates/emailtemplate', $data, true);
        $message = new Html2Text($message);

        return $this->m_model->sendEmail($user->email, $subject, $file, $message->getText());
    }
}
