<?php $uri1 = $this->session->userdata('level') === "User" ? "user" : "admin"; ?>

<aside class="main-sidebar">
    <section class="sidebar">
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('nama') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if ($this->uri->segment(2) === 'dashboard') echo "active"; ?>">
                <a href="<?= base_url($uri1 . '/dashboard') ?>">
                    <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) === 'perangkat') echo "active"; ?>">
                <a href="<?= base_url($uri1 . '/perangkat') ?>">
                    <i class="fa fa-laptop"></i> <span>Data Perangkat</span>
                </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) === 'peminjaman') echo "active"; ?>">
                <a href="<?= base_url($uri1 . '/peminjaman') ?>">
                    <i class="fa fa-bookmark"></i> <span>Data Peminjaman</span>
                </a>
            </li>

            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <li class="<?php if ($this->uri->segment(2) === 'pengembalian') echo "active"; ?>">
                    <a href="<?= base_url('admin/pengembalian') ?>">
                        <i class="fa fa-inbox"></i> <span>Data Pengembalian</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(2) === 'laporan') echo "active"; ?>">
                    <a href="<?= base_url('admin/laporan') ?>">
                        <i class="fa fa-file"></i> <span>Laporan</span>
                    </a>
                </li>
                <li class="treeview <?php if ($this->uri->segment(2) === 'user' || $this->uri->segment(2) === 'aplikasi' || $this->uri->segment(2) === 'backupdatabase' || $this->uri->segment(2) === 'log') echo "active"; ?>">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Kelola</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($this->uri->segment(2) === 'user') echo "active"; ?>">
                            <a href="<?= base_url('admin/user') ?>"><i class="fa fa-circle-o"></i> User</a>
                        </li>
                        <li class="<?php if ($this->uri->segment(2) === 'fungsi') echo "active"; ?>">
                            <a href="<?= base_url('admin/fungsi') ?>">
                                <i class="fa fa-circle-o"></i> <span>Fungsi</span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                            <li class="<?php if ($this->uri->segment(2) === 'kategori') echo "active"; ?>">
                                <a href="<?= base_url('admin/kategori') ?>">
                                    <i class="fa fa-circle-o"></i> <span>Kategori Perangkat</span>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- <li class="<?php if ($this->uri->segment(2) === 'aplikasi') echo "active"; ?>">
                            <a href="<?= base_url('admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a>
                        </li> -->
                        <!-- <li class="<?php if ($this->uri->segment(2) === 'backupdatabase') echo "active"; ?>">
                            <a href="<?= base_url('admin/backupdatabase') ?>"><i class="fa fa-circle-o"></i> Backup Database</a>
                        </li>
                        <li class="<?php if ($this->uri->segment(2) === 'log') echo "active"; ?>">
                            <a href="<?= base_url('admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a>
                        </li> -->
                    </ul>
                </li>
            <?php } ?>
            <li class="<?php if ($this->uri->segment(2) === 'profil') echo "active"; ?>">
                <a href="<?= base_url($uri1 . '/profil') ?>">
                    <i class="fa fa-user"></i> <span>Profil</span>
                </a>
            </li>
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <li class="<?php if ($this->uri->segment(2) === 'notifikasi') echo "active"; ?>">
                    <a href="<?= base_url('admin/notifikasi/admin') ?>">
                        <i class="fa fa-bell"></i> <span>Notifikasi</span>
                        <span class="pull-right-container">
                            <span class="label label-primary pull-right">
                                <?php
                                $this->db->where('dibaca', 'Belum Dibaca');
                                $this->db->where('tujuan', 'Administrator');
                                echo $this->db->get('tb_notifikasi')->num_rows();
                                ?>
                            </span>
                        </span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="<?php if ($this->uri->segment(2) === 'notifikasi') echo "active"; ?>">
                    <a href="<?= base_url($uri1 . '/notifikasi/user') ?>">
                        <i class="fa fa-bell"></i> <span>Notifikasi</span>
                        <span class="pull-right-container">
                            <span class="label label-primary pull-right">
                                <?php
                                $this->db->where('dibaca', 'Belum Dibaca');
                                $this->db->where('idUser', $this->session->userdata('id'));
                                $this->db->where('tujuan', 'User');
                                echo $this->db->get('tb_notifikasi')->num_rows();
                                ?>
                            </span>
                        </span>
                    </a>
                </li>
            <?php } ?>
            <li class="<?php if ($this->uri->segment(2) === 'logout') echo "active"; ?>">
                <a href="<?= base_url('home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </section>
</aside>