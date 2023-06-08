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
                        <a href="<?= base_url('admin/peminjaman/cetakdisetujui/') . $idPeminjaman ?>" class="btn btn-success">
                            <div class="fa fa-print"></div> Cetak Disetujui
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
                        <h4 class="box-title">Dipinjam (<?= $dipinjam->num_rows() ?>)</h4>
                    </div>
                    <form action="<?= base_url('admin/peminjaman/deletecart/') . $dPeminjaman['id'] ?>" method="POST">
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
                                            <!-- <th>Terdaftar</th> -->
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
                                                    } else if ($dPinjam['status'] == 'Disetujui') {
                                                        echo '<div class="label label-success"><div class="fa fa-check"> ' . $dPinjam['status'] . '</div>';
                                                    }
                                                    if ($dPinjam['status'] == 'Ditolak') {
                                                        echo '<div class="label label-danger"><div class="fa fa-close"> ' . $dPinjam['status'] . '</div>';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?= date('d F Y H:i:s', strtotime($dPinjam['terdaftar'])) ?></td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if (!empty($dipinjam->num_rows())) { ?>
                            <div class="box-footer">
                                <button class="btn btn-danger">
                                    <div class="fa fa-trash"></div> Delete
                                </button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Daftar Perangkat (<?= $perangkat->num_rows() ?>)</h4>
            </div>
            <form action="<?= base_url('admin/peminjaman/addtocart/') . $dPeminjaman['id'] ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th>Jumlah</th>
                                    <th>Kategori</th>
                                    <th>Nama Perangkat</th>
                                    <th>Deskripsi</th>
                                    <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                        <th>Stok</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($perangkat->result_array() as $row) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $no++ ?>
                                            <input type="checkbox" name="idPerangkat[]" value="<?= $row['id'] ?>" checked hidden>
                                        </td>
                                        <td><input type="number" name="jumlah[]" placeholder="Jumlah" value="0"></td>
                                        <td>
                                            <?php
                                            $where = array('id' => $row['idKategori']);
                                            $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                            foreach ($nama_kategori->result() as $nKtg) {
                                                echo $nKtg->kategori;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['deskripsi'] ?></td>
                                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                            <td><?= $row['stok'] ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success">
                        <div class="fa fa-cart-plus"></div> Pinjam
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>