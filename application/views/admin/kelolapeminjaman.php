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
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title"><?= $form_title ?></h4>
                    </div>
                    <form class="form-horizontal" action="<?= base_url($uri1 . '/peminjaman/insert') ?>" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="keperluan" class="col-sm-2 control-label">Tujuan Peminjaman </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Tujuan Peminjaman" value="<?= isset($peminjaman) ? $peminjaman->keperluan : null ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">Keterangan </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= isset($peminjaman) ? $peminjaman->keterangan : null ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggalPinjam" class="col-sm-2 control-label">Tanggal Pinjam </label>
                                <div class="col-md-2">
                                    <input type="date" name="tanggalPinjam" class="form-control" value="<?= isset($peminjaman) ? $peminjaman->tanggalPinjam : date('Y-m-d') ?>" placeholder="Tanggal Mulai" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="tanggalKembali" class="form-control" value="<?= isset($peminjaman) ? $peminjaman->tanggalKembali : date('Y-m-d') ?>" placeholder="Tanggal Selesai" required>
                                </div>
                            </div>
                            <?php if (isset($peminjaman) && $peminjaman->isstatus === "N" || !isset($peminjaman)) : ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-md-2">
                                        <button type="button" name="button" class="btn btn-primary btn-sm tambah_item" title="Tambah Item"><i class="fa fa-plus"></i> Tambah Item</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTablePeminjaman" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Perangkat</th>
                                                <th>Jumlah</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php if (isset($dipinjam)) : ?>
                                            <tbody>
                                                <?php foreach ($dipinjam as $val) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <select class="form-control select2" name="perangkat[]" style="width: 300px;" required>
                                                                    <option value=""></option>
                                                                    <?php foreach ($perangkat as $row) : ?>
                                                                        <?php if ($val['idPerangkat'] == $row['id']) : ?>
                                                                            <option value="<?= $row['id'] ?>" selected><?= $row['nama'] ?>></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?>></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="jumlah[]" value="<?= $val['jumlah'] ?>" style="width: 125px;" required>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($perangkat as $row) :
                                                                if ($val['idPerangkat'] == $row['id']) :
                                                                    foreach ($kategori as $row2) :
                                                                        if ($row2['id'] == $row['idKategori']) :
                                                                            echo $row2['kategori'];
                                                                        endif;
                                                                    endforeach;
                                                                endif;
                                                            endforeach; ?>
                                                        </td>
                                                        <td>
                                                            <?php foreach ($perangkat as $row) :
                                                                if ($val['idPerangkat'] == $row['id']) :
                                                                    echo $row['deskripsi'];
                                                                endif;
                                                            endforeach; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($val['status'] !== "Disetujui") : ?>
                                                                <div class="form-group">
                                                                    <button type="button" title="Delete" class="btn btn-social-icon btn-sm btn-danger btn_delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <input type="hidden" class="form-control" name="dipinjam_id[]" value="<?= $val['id'] ?>" readonly>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($idPeminjaman) ? $idPeminjaman : "" ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-primary" href="<?= site_url($uri1 . '/peminjaman') ?>">
                                <div class="fa fa-arrow-left"></div> Kembali
                            </a>
                            <?php if (isset($peminjaman) && $peminjaman->isstatus === "N" || !isset($peminjaman)) : ?>
                                <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>