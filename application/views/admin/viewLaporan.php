<div class="content-wrapper" id="content_laporan">
    <section class="content-header">
        <h1>
            <?= $title ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="perangkat" class="col-sm-2 control-label">Perangkat</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="perangkat" name="perangkat">
                                <option value="">-- Pilih Perangkat --</option>
                                <?php foreach ($perangkat as $row) : ?>
                                    <option value="<?= $row->id; ?>"><?= $row->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali" class="col-sm-2 control-label">Tanggal Kembali</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control daterangetime" id="tgl_kembali" name="tgl_kembali">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="status" name="status">
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Sudah Kembali</option>
                                <option value="2">Belum Kembali</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="box-footer">
                <button type="reset" class="btn btn-danger btn_reset_laporan">
                    <i class="fa fa-undo fa-fw"></i> Reset
                </button>
                <button type="button" class="btn btn-success btn_ok_laporan">
                    <i class="fa fa-check"></i> OK
                </button>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="table_laporan">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>No. Peminjaman</th>
                                <th>Peminjam</th>
                                <th>Perangkat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Keperluan</th>
                                <th>Keterangan</th>
                                <!-- <th>Catatan Petugas</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>