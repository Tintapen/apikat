<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .table {
            width: 100%;
            /* max-width: 100%; */
            /* table-layout: fixed; */
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table thead tr th,
        .table tbody tr th,
        .table tfoot tr th,
        .table thead tr td,
        .table tbody tr td,
        .table tfoot tr td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        .table thead tr th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
            text-align: center;
            background-color: rgb(196, 194, 194);
        }

        .table tbody tr td {
            width: 115px;
            word-wrap: break-word;
        }

        .table-responsive {
            min-height: 0.01%;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 style="text-align: center;"><b>CETAK BUKTI PEMINJAMAN</b></h3>

        <table>
            <?php foreach ($peminjaman->result_array() as $dPeminjaman) { ?>
                <tr>
                    <td width="140px">No Peminjaman</td>
                    <td width="10px">:</td>
                    <td><?= $dPeminjaman['nomor'] ?></td>
                </tr>
                <tr>
                    <td>Peminjam</td>
                    <td>:</td>
                    <td>
                        <?php
                        $where = array('id' => $dPeminjaman['idUser']);
                        $nama_user = $this->m_model->get_where($where, 'tb_user');
                        foreach ($nama_user->result() as $nUsr) {
                            echo $nUsr->nama;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td>
                    <td>:</td>
                    <td><?= date('d F Y', strtotime($dPeminjaman['tanggalPinjam'])) ?></td>
                </tr>
                <tr>
                    <td>Tanggal Kembali</td>
                    <td>:</td>
                    <td><?= date('d F Y', strtotime($dPeminjaman['tanggalKembali'])) ?></td>
                </tr>
                <tr>
                    <td>Keperluan</td>
                    <td>:</td>
                    <td><?= $dPeminjaman['keperluan'] ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td><?= $dPeminjaman['keterangan'] ?></td>
                </tr>
                <!-- <tr>
                    <td>Terdaftar</td>
                    <td>:</td>
                    <td><?= date('d F Y H:i:s', strtotime($dPeminjaman['terdaftar'])) ?></td>
                </tr> -->
            <?php } ?>
        </table> <br>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th>Kategori</th>
                        <th>Nama Perangkat</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <?php if (!isset($pengembalian)) : ?>
                            <th>Catatan</th>
                            <!-- <th>Terdaftar</th> -->
                        <?php else : ?>
                            <th>Tgl Pengembalian</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($disetujui->result_array() as $dPinjam) {
                    ?>
                        <tr>
                            <td width="10px"><?= $no++ ?></td>
                            <td>
                                <?php
                                $where = array('id' => $dPinjam['idKategori']);
                                $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                foreach ($nama_kategori->result() as $nKtg) {
                                    echo $nKtg->kategori;
                                }
                                ?>
                            </td>
                            <td><?= $dPinjam['nama'] ?></td>
                            <?php if (isset($pengembalian)) : ?>
                                <td style="width: 24%; word-wrap: break-word"><?= $dPinjam['deskripsi'] ?></td>
                            <?php else : ?>
                                <td><?= $dPinjam['deskripsi'] ?></td>
                            <?php endif; ?>
                            <td style="text-align: right; width: 10px"><?= $dPinjam['jumlah'] ?></td>
                            <?php if (isset($pengembalian)) : ?>
                                <?php if ($dPinjam['idUserpengembalian'] == 0) : ?>
                                    <td width="10px">Belum Kembali</td>
                                    <td></td>
                                <?php else : ?>
                                    <td width="10px">Sudah Kembali</td>
                                    <td><?= date('d F Y H:i:s', strtotime($dPinjam['tglPengembalian'])) ?></td>
                                <?php endif; ?>
                            <?php else : ?>
                                <td width="10px"><?= $dPinjam['status'] ?></td>
                                <td><?= $dPinjam['catatan'] ?></td>
                                <!-- <td><?= date('d F Y H:i:s', strtotime($dPinjam['terdaftar'])) ?></td> -->
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($status)) : ?>
            <small><i>Diproses <?= date('d F Y H:i:s') ?> Oleh <?= $this->session->userdata('nama') ?></i></small>
        <?php else : ?>
            <small><i>Dicetak pada <?= date('d F Y H:i:s') ?> Oleh <?= $this->session->userdata('nama') ?> Sebagai <?= $this->session->userdata('level') ?></i></small>
        <?php endif; ?>
    </div>
</body>

</html>