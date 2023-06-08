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
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="row">
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                <?php
                                echo $this->db->query('SELECT id FROM tb_kategori')->num_rows();
                                ?>
                            </h3>

                            <p>Total Kategori Perangkat</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-database"></div>
                        </div>
                        <a href="<?= base_url('admin/kategori') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_perangkat')->num_rows();
                            ?>
                        </h3>

                        <p>Total Perangkat</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-android"></div>
                    </div>
                    <a href="<?= base_url('admin/perangkat') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_peminjaman')->num_rows();
                            ?>
                        </h3>

                        <p>Total Peminjaman</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-bookmark"></div>
                    </div>
                    <a href="<?= base_url('admin/peminjaman') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                <?php
                                echo $this->db->query('SELECT id FROM tb_fungsi')->num_rows();
                                ?>
                            </h3>

                            <p>Total Fungsi</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-wrench"></div>
                        </div>
                        <a href="<?= base_url('admin/fungsi') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>
                                <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE level="Administrator"')->num_rows();
                                ?>
                            </h3>

                            <p>Total Administrator</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-users"></div>
                        </div>
                        <a href="<?= base_url('admin/user') ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Peminjaman Bulan Ini (<?= date('F Y') ?>)</h4>
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
                                    <th>Terdaftar</th>
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
                                        <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/peminjaman/respon/') . $row['id'] ?>" class="btn btn-primary btn-xs">
                                                <div class="fa fa-pencil"></div> Respon
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Belum Dikembalikan (<?= $dikembalikan->num_rows() ?>)</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th>Peminjam</th>
                                    <th>Kategori</th>
                                    <th>Nama Perangkat</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Catatan</th> -->
                                    <!-- <th>Terdaftar</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($dikembalikan->result_array() as $dKembali) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php
                                            $where = array('id' => $dKembali['idPeminjaman']);
                                            $peminjaman = $this->m_model->get_where($where, 'tb_peminjaman');
                                            foreach ($peminjaman->result() as $pnjm) {
                                                $this->db->where('id', $pnjm->idUser);
                                                foreach ($this->db->get('tb_user')->result() as $dUsr) {
                                                    echo $pnjm->nomor . ' - ' . $dUsr->nama;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $where = array('id' => $dKembali['idKategori']);
                                            $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                            foreach ($nama_kategori->result() as $nKtg) {
                                                echo $nKtg->kategori;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $dKembali['nama'] ?></td>
                                        <td><?= $dKembali['deskripsi'] ?></td>
                                        <td><?= $dKembali['jumlah'] ?></td>
                                        <!-- <td>
                                            <?php
                                            if ($dKembali['status'] == 'Diproses') {
                                                echo '<div class="label label-warning"><div class="fa fa-history"> ' . $dKembali['status'] . '</div>';
                                            } else if ($dKembali['status'] == 'Disetujui') {
                                                echo '<div class="label label-success"><div class="fa fa-check"> ' . $dKembali['status'] . '</div>';
                                            }
                                            if ($dKembali['status'] == 'Ditolak') {
                                                echo '<div class="label label-danger"><div class="fa fa-close"> ' . $dKembali['status'] . '</div>';
                                            }
                                            ?>
                                        </td> -->
                                        <!-- <td><?= $dKembali['catatan'] ?></td> -->
                                        <!-- <td><?= date('d F Y H:i:s', strtotime($dKembali['terdaftar'])) ?></td> -->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</div>