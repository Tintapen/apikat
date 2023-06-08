<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-primary" href="<?= site_url('admin/peminjaman') ?>">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </a>
                        <a href="<?= base_url('admin/peminjaman/cetakdisetujui/') . $idPeminjaman ?>" class="btn btn-success" target="_blank">
                            <div class="fa fa-print"></div> Cetak Status
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($peminjaman->result_array() as $dPeminjaman) { ?>
                                    <tr>
                                        <td width="140px">Nomor</td>
                                        <td width="10px">:</td>
                                        <td><?= $dPeminjaman['nomor'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Peminjaman</td>
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
                                    <tr>
                                        <td>Terdaftar</td>
                                        <td>:</td>
                                        <td><?= date('d F Y H:i:s', strtotime($dPeminjaman['terdaftar'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Perlu Direspon (<?= $dipinjam->num_rows() ?>)</h4>
                    </div>
                    <form action="<?= base_url('admin/peminjaman/respondata/') . $dPeminjaman['id'] . '/' . $dPeminjaman['idUser'] ?>" method="POST" id="form_respon">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th width="10px">#</th>
                                            <th>Kategori</th>
                                            <th>Nama Perangkat</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Terdaftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dipinjam->result_array() as $dPinjam) { ?>
                                            <tr>
                                                <td>
                                                    <?php if ($dPinjam['status'] == 'Diproses') { ?>
                                                        <input type="checkbox" name="idPinjam[]" value="<?= $dPinjam['id'] ?>">
                                                    <?php } ?>
                                                </td>
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
                                                <td><?= $dPinjam['deskripsi'] ?></td>
                                                <td><?= $dPinjam['jumlah'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($dPinjam['status'] == 'Diproses') {
                                                        echo '<div class="label label-warning"><div class="fa fa-history"> ' . $dPinjam['status'] . '</div>';
                                                    } else if ($dPinjam['status'] == 'Diterima') {
                                                        echo '<div class="label label-success"><div class="fa fa-check"> ' . $dPinjam['status'] . '</div>';
                                                    }
                                                    if ($dPinjam['status'] == 'Ditolak') {
                                                        echo '<div class="label label-danger"><div class="fa fa-close"> ' . $dPinjam['status'] . '</div>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= date('d F Y H:i:s', strtotime($dPinjam['terdaftar'])) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (!empty($dipinjam->num_rows())) { ?>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="" disabled selected> -- Pilih Respon -- </option>
                                                <option value="Disetujui">Disetujui</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <input type="text" name="catatan" class="form-control" placeholder="Catatan" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block">
                                    <div class="fa fa-save"></div> Respon
                                </button>
                                <font color="red">
                                    <small><i>NB : Jika status ditolak jumlah akan dikembalikan ke stok perangkat</i></small>
                                </font>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Disetujui (<?= $disetujui->num_rows() ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Kategori</th>
                                        <th>Nama Perangkat</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($disetujui->result_array() as $dPinjam) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
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
                                            <td><?= $dPinjam['deskripsi'] ?></td>
                                            <td><?= $dPinjam['jumlah'] ?></td>
                                            <td>
                                                <?php
                                                if ($dPinjam['status'] == 'Diproses') {
                                                    echo '<div class="label label-warning"><div class="fa fa-history"> ' . $dPinjam['status'] . '</div>';
                                                } else if ($dPinjam['status'] == 'Disetujui') {
                                                    echo '<div class="label label-success"><div class="fa fa-check"> ' . $dPinjam['status'] . '</div>';
                                                }
                                                if ($dPinjam['status'] == 'Ditolak') {
                                                    echo '<div class="label label-danger"><div class="fa fa-close"> ' . $dPinjam['status'] . '</div>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $dPinjam['catatan'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($dPinjam['terdaftar'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Ditolak (<?= $ditolak->num_rows() ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Kategori</th>
                                        <th>Nama Perangkat</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($ditolak->result_array() as $dTolak) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php
                                                $where = array('id' => $dTolak['idKategori']);
                                                $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                                foreach ($nama_kategori->result() as $nKtg) {
                                                    echo $nKtg->kategori;
                                                }
                                                ?>
                                            </td>
                                            <td><?= $dTolak['nama'] ?></td>
                                            <td><?= $dTolak['deskripsi'] ?></td>
                                            <td><?= $dTolak['jumlah'] ?></td>
                                            <td>
                                                <?php
                                                if ($dTolak['status'] == 'Diproses') {
                                                    echo '<div class="label label-warning"><div class="fa fa-history"> ' . $dTolak['status'] . '</div>';
                                                } else if ($dTolak['status'] == 'Disetujui') {
                                                    echo '<div class="label label-success"><div class="fa fa-check"> ' . $dTolak['status'] . '</div>';
                                                }
                                                if ($dTolak['status'] == 'Ditolak') {
                                                    echo '<div class="label label-danger"><div class="fa fa-close"> ' . $dTolak['status'] . '</div>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $dTolak['catatan'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($dTolak['terdaftar'])) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>