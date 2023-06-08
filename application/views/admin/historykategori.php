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
                                <?php foreach ($kategori->result_array() as $row) { ?>
                                    <tr>
                                        <td width="100px">Kategori</td>
                                        <td width="10px">:</td>
                                        <td><?= $row['kategori'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            echo $this->db->query('SELECT id FROM tb_perangkat WHERE idKategori = "'.$row['id'].'"')->num_rows();
                                            ?> Perangkat
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tardaftar</td>
                                        <td>:</td>
                                        <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
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
                        <h4 class="box-title">Daftar Perangkat (<?= $history->num_rows() ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Nama Perangkat</th>
                                        <th>Deskripsi</th>
                                        <?php if($this->session->userdata('level') == 'Administrator') { ?>
                                            <th>Stok</th>
                                            <th>Terdaftar</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($history->result() as $dHty) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dHty->nama ?></td>
                                            <td><?= $dHty->deskripsi ?></td>
                                            <?php if($this->session->userdata('level') == 'Administrator') { ?>
                                                <td><?= $dHty->stok ?></td>
                                                <td><?= date('d F Y H:i:s', strtotime($dHty->terdaftar)) ?></td>
                                            <?php } ?>
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