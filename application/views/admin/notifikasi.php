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
        <div class="box">
            <div class="box-header">
                <a href="<?= base_url('admin/notifikasi/dibaca') ?>" class="btn btn-success">
                    <div class="fa fa-check"></div> Tandai Dibaca
                </a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Peminjam</th>
                                <th>Pesan Notifikasi</th>
                                <th>Keterangan</th>
                                <th>Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($notifikasi->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['idUser']);
                                        foreach ($this->db->get('tb_user')->result() as $dUsr) {
                                            echo $dUsr->nama;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['dibaca'] == 'Belum Dibaca') {
                                            echo '<div class="label label-danger">' . $row['dibaca'] . '</div>';
                                        } else {
                                            echo '<div class="label label-success">' . $row['dibaca'] . '</div>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>