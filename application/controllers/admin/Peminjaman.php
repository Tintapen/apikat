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
        $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_peminjaman');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect($uri1 . '/peminjaman');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";

        $post = $this->input->post(NULL, TRUE);

        if (!isset($post['perangkat'])) {
            $this->session->set_flashdata('pesanError', 'Silahkan menambahkan perangkat yang dipinjam!');
            empty($post['id']) ? redirect($uri1 . "/peminjaman/tambah") : redirect($uri1 . "/peminjaman/kelola/" . $post['id']);
        } else {
            $idUser             = $this->session->userdata('id');
            $tanggalPinjam      = $post['tanggalPinjam'];
            $tanggalKembali     = $post['tanggalKembali'];
            $keperluan          = $post['keperluan'];
            $keterangan         = $post['keterangan'];
            $terdaftar          = date('Y-m-d H:i:s');
            $perangkat          = $post['perangkat'];
            $qty                = $post['jumlah'];

            if (in_array(0, $qty)) {
                $this->session->set_flashdata('pesanError', 'Jumlah tidak boleh ada yang 0 !');
                empty($post['id']) ? redirect($uri1 . "/peminjaman/tambah") : redirect($uri1 . "/peminjaman/kelola/" . $post['id']);
            } else {
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

                // Memulai transaction mysql
                $this->db->trans_start();

                $dataLine = [];

                $data['tanggalPinjam']  = $tanggalPinjam;
                $data['tanggalKembali'] = $tanggalKembali;
                $data['keperluan']      = $keperluan;
                $data['keterangan']     = $keterangan;

                if (empty($post['id'])) {
                    $data['nomor']          = $nomor;
                    $data['idUser']         = $idUser;
                    $data['terdaftar']      = $terdaftar;

                    $this->m_model->insert($data, 'tb_peminjaman');
                    $last_id = $this->db->insert_id();

                    $dataNotifikasi = array(
                        'idUser'        => $idUser,
                        'keterangan'    => 'Mengajukan peminjaman perangkat',
                        'tujuan'        => 'Administrator',
                        'dibaca'        => 'Belum Dibaca',
                        'terdaftar'     => $terdaftar
                    );

                    $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');
                } else {
                    $where = array('id' => $post['id']);
                    $this->m_model->update($where, $data, 'tb_peminjaman');
                }

                foreach ($perangkat as $key => $value) :
                    $row = [];

                    $this->db->where('id', $value);
                    $rowPerangkat = $this->m_model->get_desc('tb_perangkat')->row();

                    $this->db->where('id', $rowPerangkat->idKategori);
                    $rowKategori = $this->m_model->get_desc('tb_kategori')->row();

                    if (!empty($post['dipinjam_id'][$key])) {
                        $row['idPerangkat']     = $value;
                        $row['idKategori']      = $rowKategori->id;
                        $row['nama']            = $rowPerangkat->nama;
                        $row['deskripsi']       = $rowPerangkat->deskripsi;
                        $row['jumlah']          = $qty[$key];
                        $row['id']              = $post['dipinjam_id'][$key];
                        $dataLine['update'][]   = $row;
                    } else if (empty($post['dipinjam_id'][$key])) {
                        if (empty($post['id'])) {
                            $row['idPeminjaman']    = $last_id;
                        } else {
                            $row['idPeminjaman']    = $post['id'];
                        }

                        $row['idPerangkat']     = $value;
                        $row['idKategori']      = $rowKategori->id;
                        $row['nama']            = $rowPerangkat->nama;
                        $row['deskripsi']       = $rowPerangkat->deskripsi;
                        $row['jumlah']          = $qty[$key];
                        $row['status']          = 'Diproses';
                        $row['terdaftar']       = $terdaftar;
                        $dataLine['insert'][]   = $row;
                    }
                endforeach;

                $this->db->where("idPeminjaman", $post['id']);
                $line = $this->m_model->get_desc('tb_dipinjam')->result_array();

                foreach ($line as $val) :
                    if ((!empty($post['dipinjam_id']) && !in_array($val['id'], $post['dipinjam_id'])) || empty($post['dipinjam_id'])) {
                        $dataLine['delete'][]   = $val['id'];
                    }
                endforeach;

                if (isset($dataLine['insert'])) {
                    $this->db->insert_batch('tb_dipinjam', $dataLine['insert']);
                }

                if (isset($dataLine['update'])) {
                    $this->db->update_batch('tb_dipinjam', $dataLine['update'], 'id');
                }

                if (isset($dataLine['delete'])) {
                    $this->db->where_in('id', $dataLine['delete']);
                    $this->db->delete('tb_dipinjam');
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('pesanError', 'Data tidak berhasil disimpan !');
                } else {
                    // Menutup transaction mysql
                    $this->db->trans_commit();
                    $this->session->set_flashdata('pesan', 'Data berhasil disimpan !');
                }
            }

            redirect($uri1 . "/peminjaman");
        }
    }

    public function kelola($id = null)
    {
        $data['title']      = 'Data Peminjaman';
        $data['form_title'] = 'Form Peminjaman';
        $data['subtitle']   = 'Data peminjaman pada halaman ini';

        if (!empty($id)) {
            $data['title']      = 'Kelola Peminjaman';
            $data['subtitle']   = 'Kelola peminjaman pada halaman ini';

            $data['idPeminjaman']   = $id;
            $this->db->where('id', $id);
            $data['peminjaman'] = $this->m_model->get_desc('tb_peminjaman')->row();
            $this->db->where('idPeminjaman', $id);
            $data['dipinjam'] = $this->m_model->get_desc('tb_dipinjam')->result_array();
            $this->db->order_by('nama', 'asc');
            $data['perangkat'] = $this->db->get('tb_perangkat')->result_array();
            $data['kategori'] = $this->m_model->get_desc('tb_kategori')->result_array();
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/kelolapeminjaman');
        $this->load->view('admin/templates/footer');
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
        $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin";

        if (empty($_POST['idPinjam'])) {
            $this->session->set_flashdata('pesanError', 'Centang minimal 1 perangkat untuk merespon');
            redirect("admin/peminjaman/respon/$idPeminjaman");
        } else {
            $status     = $_POST['status'];
            $catatan    = $_POST['catatan'];
            $idPinjam   = $_POST['idPinjam'];

            if ($status == 'Disetujui') {
                $this->db->where_in('id', $idPinjam);
                $line = $this->m_model->get_desc('tb_dipinjam')->result_array();

                foreach ($line as $val) {
                    $this->db->where('id', $val['idPerangkat']);
                    $dPrkt = $this->m_model->get_desc('tb_perangkat')->row();

                    if ($val['jumlah'] <= $dPrkt->stok) {
                        // Memulai transaction mysql
                        $this->db->trans_start();

                        $dataUpdate = array(
                            'status'    => $status,
                            'catatan'   => $catatan,
                        );

                        $whereUpdate = array('id' => $val['id']);
                        $this->m_model->update($whereUpdate, $dataUpdate, 'tb_dipinjam');

                        $dataUpdateperangkat = array('stok' => $dPrkt->stok - $val['jumlah']);
                        $whereUpdateperangkat = array('id' => $val['idPerangkat']);
                        $this->m_model->update($whereUpdateperangkat, $dataUpdateperangkat, 'tb_perangkat');

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('pesanError', 'Perangkat tidak berhasil disetujui !');
                        } else {
                            // Menutup transaction mysql
                            $this->db->trans_commit();
                            $this->session->set_flashdata('pesan', 'Perangkat berhasil disetujui !');

                            $dataNotifikasi = array(
                                'idUser'        => $idUser,
                                'keterangan'    => 'Pengajuan peminjaman telah direspon',
                                'tujuan'        => 'User',
                                'dibaca'        => 'Belum Dibaca',
                                'terdaftar'     => $terdaftar
                            );

                            $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');
                        }
                    } else {
                        $this->session->set_flashdata('pesanError', 'Perangkat ' . $dPrkt->nama . ' Stok kurang !');
                    }
                }
            } else {
                foreach ($idPinjam as $key => $id) {
                    $dataUpdate = array(
                        'status'    => $status,
                        'catatan'   => $catatan,
                    );

                    $whereUpdate = array('id' => $id);
                    $this->m_model->update($whereUpdate, $dataUpdate, 'tb_dipinjam');
                }

                $this->session->set_flashdata('pesan', 'Perangkat berhasil ditolak');

                $dataNotifikasi = array(
                    'idUser'        => $idUser,
                    'keterangan'    => 'Pengajuan peminjaman telah direspon',
                    'tujuan'        => 'User',
                    'dibaca'        => 'Belum Dibaca',
                    'terdaftar'     => $terdaftar
                );

                $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');
            }

            $this->db->where([
                'idPeminjaman'  => $idPeminjaman,
                'status'        => 'Diproses'
            ]);

            $respon = $this->m_model->get_desc('tb_dipinjam')->num_rows();

            if ($respon == 0) {
                $this->responSelesai($idPeminjaman);

                $dataUpdate = array(
                    'isstatus'  => "Y"
                );

                $whereUpdate = array('id' => $idPeminjaman);
                $this->m_model->update($whereUpdate, $dataUpdate, 'tb_peminjaman');


                $this->db->where([
                    'idPeminjaman'  => $idPeminjaman,
                    'status'        => 'Disetujui'
                ]);

                $pinjam = $this->m_model->get_desc('tb_dipinjam')->num_rows();

                if ($pinjam > 0) {
                    $this->db->where([
                        'id'    => $idPeminjaman
                    ]);

                    $pinjam = $this->m_model->get_desc('tb_peminjaman')->row();

                    $dataNotifikasi = array(
                        'idUser'        => $idUser,
                        'keterangan'    => 'Pengajuan peminjaman telah direspon',
                        'tujuan'        => 'User',
                        'dibaca'        => 'Belum Dibaca',
                        'tglkembali'    => $pinjam->tanggalKembali
                    );

                    $this->m_model->insert($dataNotifikasi, 'tb_notifikasi');
                }
            }

            redirect($uri1 . "/peminjaman/respon/$idPeminjaman");
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

    public function tambah_line()
    {
        $table = [];

        $this->db->order_by('nama', 'asc');
        $this->db->where('stok <>', 0);
        $perangkat = $this->db->get('tb_perangkat')->result_array();

        $table = [
            $this->fieldTable('select', null, 'perangkat', 'perangkat', 'required', null, null, $perangkat, null, 300, 'id', 'nama'),
            $this->fieldTable('input', 'text', 'jumlah', 'number', 'required', null, null, null, 0, 125),
            null,
            null,
            $this->fieldTable('button', 'button', 'btn_dipinjam_id')
        ];

        echo json_encode($table);
    }

    function fieldTable($tag, $type = null, $name, $class = null, $required = false, $readonly = null, $checked = null, $list = [], $defaultValue = null, $length = 50, $field = 'id', $field2 = 'name')
    {
        $div = '<div class="form-group">';

        $element = '';

        if ($tag === 'input') {
            if ($type === 'number' || $class === 'number') {
                $element .= '<input type="' . $type . '" class="form-control ' . $class . '" name="' . $name . '[]" value="' . $defaultValue . '" ' . $readonly . ' ' . $required . ' style="width: ' . $length . 'px;">';
            } else {
                $element .= '<input type="' . $type . '" class="form-control ' . $class . '" name="' . $name . '[]" value="' . $defaultValue . '" ' . $readonly . ' ' . $required . ' style="width: ' . $length . 'px;">';
            }
        }

        if ($tag === 'select') {
            $disabled = '';
            $select = 'select2';

            if ($readonly == 'readonly') {
                $disabled = 'disabled';
            }

            // Condition to merge select2 and another class
            if (!empty($class)) {
                $class = $select . ' ' . $class;
            } else {
                $class = $select;
            }

            $element .= '<select class="form-control ' . $class . '" name="' . $name . '[]" ' . $disabled . ' ' . $required . ' style="width: ' . $length . 'px;">';

            if (is_array($list) && count($list) > 0) {
                $element .= '<option value=""></option>';

                foreach ($list as $row) :
                    // Check default value is not null and default value equal $field
                    if (!empty($defaultValue) && ((is_string($defaultValue) && strtoupper($defaultValue) == strtoupper($row[$field2])) || ($defaultValue == $row[$field])))
                        $element .= '<option value="' . $row[$field] . '" selected>' . $row[$field2] . '</option>';
                    else
                        $element .= '<option value="' . $row[$field] . '">' . $row[$field2] . '</option>';
                endforeach;
            }

            $element .= '</select>';
        }

        if ($tag === 'button') {
            if ($field !== 'id') {
                // To set value on the variable field
                $field = $defaultValue;

                // defaultValue to empty value
                $defaultValue = "";
            }

            $class = $class . ' btn-danger btn_delete';
            $icon = '<i class="fa fa-trash"></i>';
            $title = 'Delete';

            $element .= '<button type="button" title="' . $title . '" class="btn btn-social-icon btn-sm ' . $class . '" id="' . $defaultValue . '" name="' . $name . '[]" value="' . $field . '">
                                ' . $icon . '
                                </button>';
        }

        $div .= $element;

        $div .= '</div>';

        return $div;
    }
}
