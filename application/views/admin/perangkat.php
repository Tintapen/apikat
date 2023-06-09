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
    <section class="content">
        <div class="box">
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                        <div class="fa fa-plus"></div> Tambah Data
                    </button>
                </div>
            <?php } ?>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Kategori</th>
                                <th>Nama Perangkat</th>
                                <th>Deskripsi</th>
                                <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                    <th>Stok</th>
                                    <!-- <th>Terdaftar</th> -->
                                    <th>Aksi</th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($perangkat->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
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
                                        <!-- <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td> -->
                                    <?php } ?>
                                    <td>
                                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                            <!-- <a href="<?= base_url('admin/perangkat/history/') . $row['id'] ?>" class="btn btn-info btn-xs" style="margin-bottom: 2px">
                                                <div class="fa fa-history"></div> History
                                            </a> -->
                                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>" style="margin-bottom: 2px">
                                                <div class="fa fa-edit"></div> Edit
                                            </button>
                                            <a href="<?= base_url('admin/perangkat/delete/') . $row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini">
                                                <div class="fa fa-trash"></div> Delete
                                            </a>
                                        <?php } ?>
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
            <form action="<?= base_url('admin/perangkat/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="idKategori" class="form-control select2" style="width: 100%" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <?php foreach ($kategori->result() as $ktg) { ?>
                                <option value="<?= $ktg->id ?>"><?= $ktg->kategori ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Perangkat</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Perangkat" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
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
<?php foreach ($perangkat->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('admin/perangkat/update/') . $edit->id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="idKategori" class="form-control select2" style="width: 100%;" required>
                                <?php
                                $where = array('id' => $edit->idKategori);
                                $nama_kategori = $this->m_model->get_where($where, 'tb_kategori');
                                foreach ($nama_kategori->result() as $nKtg) {
                                ?>
                                    <option value="<?= $nKtg->id ?>"><?= $nKtg->kategori ?></option>
                                <?php } ?>
                                <option value="" disabled> -- Pilih Kategori Lain -- </option>
                                <?php foreach ($kategori->result() as $ktg) { ?>
                                    <option value="<?= $ktg->id ?>"><?= $ktg->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Perangkat</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Perangkat" value="<?= $edit->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" value="<?= $edit->deskripsi ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" placeholder="Stok" value="<?= $edit->stok ?>" required>
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