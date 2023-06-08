<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Fungsi</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Telp</th>
                                <th>Email</th>
                                <th>Sebagai</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($user->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php  
                                        $where = array('id' => $row['idFungsi'] );
                                        $nama_fungsi = $this->m_model->get_where($where, 'tb_fungsi');
                                        foreach ($nama_fungsi->result() as $nFng) {
                                            echo $nFng->fungsi;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['level'] ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                    <td>
                                        <?php if($this->session->userdata('id') == $row['id']) { ?>
                                            <a href="<?= base_url('index.php/admin/profil') ?>" class="btn btn-info btn-xs">
                                                <div class="fa fa-user"></div> My Profil
                                            </a>
                                        <?php } else { ?>
                                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                                <div class="fa fa-edit"></div> Edit
                                            </button>
                                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#resetPassword<?= $row['id'] ?>">
                                                <div class="fa fa-lock"></div> Reset Password
                                            </button>
                                            <a href="<?= base_url('index.php/admin/user/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Account tidak bisa dipulihkan setelah dihapus">
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
                <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
            </div>
            <form action="<?= base_url('index.php/admin/user/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="number" name="telp" class="form-control" placeholder="Telp" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Fungsi</label>
                        <select name="idFungsi" class="form-control select2" style="width: 100%" required>
                            <option value="" disabled selected> -- Pilih Fungsi -- </option>
                            <?php foreach ($fungsi->result() as $fng) { ?>
                                <option value="<?= $fng->id ?>"><?= $fng->fungsi ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sebagai</label>
                        <select name="level" class="form-control" required>
                            <option value="" disabled selected> -- Pilih Sebagai -- </option>
                            <option value="Administrator">Administrator</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($user->result() as $usr) { ?>
<div class="modal fade" id="editData<?= $usr->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            </div>
            <form action="<?= base_url('index.php/admin/user/update/').$usr->id ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $usr->nama ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="number" name="telp" class="form-control" placeholder="Telp" value="<?= $usr->telp ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $usr->email ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $usr->username ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Fungsi</label>
                        <select name="idFungsi" class="form-control select2" style="width: 100%" required>
                            <?php  
                            $where = array('id' => $usr->idFungsi );
                            $nama_fungsi = $this->m_model->get_where($where, 'tb_fungsi');
                            foreach ($nama_fungsi->result() as $nFng) { ?>
                                <option value="<?= $nFng->id ?>"><?= $nFng->fungsi ?></option>
                            <?php } ?>
                            <option value="" disabled> -- Pilih Fungsi -- </option>
                            <?php foreach ($fungsi->result() as $fng) { ?>
                                <option value="<?= $fng->id ?>"><?= $fng->fungsi ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sebagai</label>
                        <select name="level" class="form-control" required>
                            <option value="Administrator" <?= ($usr->level == 'Administrator') ? 'selected' : '' ?>>Administrator</option>
                            <option value="User" <?= ($usr->level == 'User') ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal Reset Password -->
<?php foreach ($user->result() as $reset) { ?>
    <div class="modal fade" id="resetPassword<?= $reset->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reset Password : <?= $reset->nama ?></h4>
                </div>
                <form action="<?= base_url('index.php/admin/user/resetpassword/').$reset->id ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="password" name="password" class="form-control" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                        <button type="submit" class="btn btn-primary"><div class="fa fa-lock"></div> Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>