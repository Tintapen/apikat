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
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-primary" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($perangkat->result_array() as $row) { ?>
                                    <tr>
                                        <td>Kategori</td>
                                        <td width="10px">:</td>
                                        <td>
                                            <?php  
                                                $where = array('id' => $row['idKategori'] );
                                                $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                                foreach ($nama_kategori->result() as $nKtg) {
                                                    echo $nKtg->kategori;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Perangkat</td>
                                        <td>:</td>
                                        <td><?= $row['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td><?= $row['deskripsi'] ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Riwayat Peminjaman (<?= $dipinjam->num_rows() ?>)</h4>
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
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($dipinjam->result_array() as $dPinjam) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php  
                                                    $where = array('id' => $dPinjam['idPeminjaman'] );
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
                                                    $where = array('id' => $dPinjam['idKategori'] );
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
                                                    if($dPinjam['status'] == 'Diproses') {
                                                        echo '<div class="label label-warning"><div class="fa fa-history"> '.$dPinjam['status'].'</div>';
                                                    } else if($dPinjam['status'] == 'Disetujui') {
                                                        echo '<div class="label label-success"><div class="fa fa-check"> '.$dPinjam['status'].'</div>';
                                                    } if($dPinjam['status'] == 'Ditolak') {
                                                        echo '<div class="label label-danger"><div class="fa fa-close"> '.$dPinjam['status'].'</div>';
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
        </div>
    </section>
</div>