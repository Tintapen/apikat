-- #1 Tambah kolom isstatus di Table tb_peminjaman
ALTER TABLE tb_peminjaman ADD isstatus char(1) NOT NULL DEFAULT 'N';

-- #2 Set foreign key di Table tb_peminjaman
ALTER TABLE tb_peminjaman ADD CONSTRAINT FK_UserId FOREIGN KEY (idUser) REFERENCES tb_user(id);

-- #3 Set foreign key di Table tb_dipinjam
ALTER TABLE tb_dipinjam ADD CONSTRAINT FK_PeminjamanId FOREIGN KEY (idPeminjaman) REFERENCES tb_peminjaman(id);
ALTER TABLE tb_dipinjam ADD CONSTRAINT FK_PerangkatId FOREIGN KEY (idPerangkat) REFERENCES tb_perangkat(id);
ALTER TABLE tb_dipinjam ADD CONSTRAINT FK_KategoriId FOREIGN KEY (idKategori) REFERENCES tb_kategori(id);
ALTER TABLE tb_dipinjam MODIFY column idUserpengembalian INT DEFAULT NULL;
ALTER TABLE tb_dipinjam ADD CONSTRAINT FK_UserPengembalianId FOREIGN KEY (idUserpengembalian) REFERENCES tb_user(id);

-- #4 Set foreign key di Table tb_backupdb
ALTER TABLE tb_backupdb ADD CONSTRAINT FK_IdUser FOREIGN KEY (idUser) REFERENCES tb_user(id);

-- #5 Set foreign key di Table tb_log
ALTER TABLE tb_log ADD CONSTRAINT FK_UserLog FOREIGN KEY (idUser) REFERENCES tb_user(id);

-- #6 Set foreign key di Table tb_notifikasi
ALTER TABLE tb_notifikasi ADD CONSTRAINT FK_UserNotif FOREIGN KEY (idUser) REFERENCES tb_user(id);

-- #7 Set foreign key di Table tb_perangkat
ALTER TABLE tb_perangkat ADD CONSTRAINT FK_KategoriIdPer FOREIGN KEY (idKategori) REFERENCES tb_kategori(id);

-- #8 Set foreign key di Table tb_tokens
ALTER TABLE tb_tokens ADD CONSTRAINT FK_UserToken FOREIGN KEY (tb_user_id) REFERENCES tb_user(id);

-- #9 Set foreign key di Table tb_user
ALTER TABLE tb_user ADD CONSTRAINT FK_FungsiId FOREIGN KEY (idFungsi) REFERENCES tb_fungsi(id);

-- #10 Tambah kolom tglkembali di Table tb_notifikasi
ALTER TABLE tb_notifikasi ADD tglkembali date DEFAULT NULL;