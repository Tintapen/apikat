<?php $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url($uri1 . '/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <a href="<?= base_url($uri1 . '/peminjaman/tambah') ?>" class="btn btn-primary">
                    <div class="fa fa-plus"></div> Tambah Data
                </a>
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button> -->
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>No Pinjam</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Keperluan</th>
                                <th>Keterangan</th>
                                <th>Perangkat (Jumlah)</th>
                                <th>Status</th>
                                <!-- <th>Terdaftar</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($peminjaman->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nomor'] ?></td>
                                    <td>
                                        <?php
                                        $where = array('id' => $row['idUser']);
                                        $nama_user = $this->m_model->get_where($where, 'tb_user');
                                        foreach ($nama_user->result() as $nUsr) {
                                            echo $nUsr->nama;
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('d F Y', strtotime($row['tanggalPinjam'])) ?></td>
                                    <td><?= date('d F Y', strtotime($row['tanggalKembali'])) ?></td>
                                    <td><?= $row['keperluan'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('idPeminjaman', $row['id']);
                                        $dipinjam = $this->db->get('tb_dipinjam')->num_rows();
                                        echo $dipinjam . ' Perangkat';

                                        foreach ($this->db->query('SELECT SUM(jumlah) AS total FROM tb_dipinjam WHERE idPeminjaman="' . $row['id'] . '" ')->result() as $tPinjam) {
                                            echo ' (' . number_format($tPinjam->total) . ')';
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        Diproses : <?= $this->db->query('SELECT id FROM tb_dipinjam WHERE status="Diproses" AND idPeminjaman="' . $row['id'] . '"')->num_rows(); ?> <br>
                                        Disetujui : <?= $this->db->query('SELECT id FROM tb_dipinjam WHERE status="Disetujui" AND idPeminjaman="' . $row['id'] . '"')->num_rows(); ?> <br>
                                        Ditolak : <?= $this->db->query('SELECT id FROM tb_dipinjam WHERE status="Ditolak" AND idPeminjaman="' . $row['id'] . '"')->num_rows(); ?>
                                    </td>
                                    <!-- <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td> -->
                                    <td>
                                        <?php if ($row['idUser'] == $this->session->userdata('id')) { ?>
                                            <a href="<?= base_url($uri1 . '/peminjaman/kelola/') . $row['id'] ?>" class="btn btn-info btn-xs" style="margin-bottom: 1px">
                                                <div class="fa fa-history"></div> Kelola
                                            </a>
                                            <!-- <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>" style="margin-bottom: 1px">
                                                <div class="fa fa-edit"></div> Edit
                                            </button> -->
                                            <?php if (empty($dipinjam) && $row['isstatus'] === "N") { ?>
                                                <a href="<?= base_url($uri1 . '/peminjaman/delete/') . $row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini">
                                                    <div class="fa fa-trash"></div> Delete
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('level') == 'Administrator' && $row['isstatus'] === "N") { ?>
                                            <a href="<?= base_url('admin/peminjaman/respon/') . $row['id'] ?>" class="btn btn-primary btn-xs" style="margin-bottom: 1px">
                                                <div class="fa fa-pencil"></div> Respon
                                            </a>
                                        <?php } ?>
                                        <a href="<?= base_url($uri1 . '/peminjaman/cetakdisetujui/') . $row['id'] ?>" class="btn btn-success btn-xs" target="_blank">
                                            <div class="fa fa-print"></div> Cetak Bukti
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title ?></h4>
            </div>
            <form action="<?= base_url('admin/peminjaman/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pinjam</label>
                                <input type="date" name="tanggalPinjam" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Kembali</label>
                                <input type="date" name="tanggalKembali" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" placeholder="Keperluan" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-trash"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($peminjaman->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('admin/peminjaman/update/') . $edit->id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" name="tanggalPinjam" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= $edit->tanggalPinjam ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <input type="date" name="tanggalKembali" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= $edit->tanggalKembali ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" placeholder="Keperluan" value="<?= $edit->keperluan ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="<?= $edit->keterangan ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <div class="fa fa-trash"></div> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="fa fa-save"></div> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>