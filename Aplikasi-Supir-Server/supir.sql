/**
 *
 * @Author Rizki Mufrizal <mufrizalrizki@gmail.com>
 * @Since Apr 17, 2016
 * @Time 8:13:38 AM
 * @Encoding UTF-8
 * @Project Aplikasi-Ojek-Server
 * @Package Expression package is undefined on line 8, column 15 in Templates/Other/SQLTemplate.sql.
 *
 */

CREATE DATABASE aplikasisupir;
USE aplikasisupir;

CREATE TABLE tb_pelanggan (
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    no_telpon VARCHAR(15) NOT NULL,
    role VARCHAR(30) NOT NULL
)  ENGINE=INNODB;

CREATE TABLE tb_supir(
    id_supir VARCHAR(150) NOT NULL PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    no_telpon VARCHAR(15) NOT NULL,
    role VARCHAR(15) NOT NULL
) ENGINE = INNODB;

CREATE TABLE tb_pesan_supir (
    id_pesan_supir VARCHAR(150) NOT NULL PRIMARY KEY,
    tanggal DATETIME,
    lokasi_awal TEXT NOT NULL,
    lokasi_akhir TEXT NOT NULL,
    status TINYINT(1) NOT NULL,
    jumlah_jam INT NOT NULL,
    harga INT NOT NULL,
    email VARCHAR(50) NOT NULL,
    id_supir VARCHAR(150),
    FOREIGN KEY (email)
        REFERENCES tb_pelanggan (email),
    FOREIGN KEY (id_supir)
        REFERENCES tb_supir (id_supir)
)  ENGINE=INNODB;

CREATE VIEW `tb_pelanggan_pesan_supir` AS
SELECT
  `tb_pelanggan`.`email`,
  `tb_pelanggan`.`nama`,
  `tb_pelanggan`.`no_telpon`,
  `tb_pesan_supir`.`id_pesan_supir`,
  `tb_pesan_supir`.`tanggal`,
  `tb_pesan_supir`.`lokasi_awal`,
  `tb_pesan_supir`.`lokasi_akhir`,
  `tb_pesan_supir`.`status`,
  `tb_pesan_supir`.`jumlah_jam`,
  `tb_pesan_supir`.`harga`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_supir`
ON
  `tb_pelanggan`.`email` = `tb_pesan_supir`.`email`;

CREATE VIEW `tb_pelanggan_supir` AS
SELECT
  `tb_pelanggan`.`email`,
  `tb_pelanggan`.`nama`,
  `tb_pelanggan`.`no_telpon`,
  `tb_pesan_supir`.`id_pesan_supir`,
  `tb_pesan_supir`.`tanggal`,
  `tb_pesan_supir`.`lokasi_awal`,
  `tb_pesan_supir`.`lokasi_akhir`,
  `tb_pesan_supir`.`status`,
  `tb_pesan_supir`.`jumlah_jam`,
  `tb_pesan_supir`.`harga`,
  `tb_supir`.`id_supir`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_supir`
ON
  `tb_pelanggan`.`email` = `tb_pesan_supir`.`email`
INNER JOIN
  `tb_supir`
ON
  `tb_pesan_supir`.`id_supir` = `tb_supir`.`id_supir`;

CREATE VIEW `tb_supir_pesan_supir` AS
SELECT
  `tb_supir`.`nama`,
  `tb_supir`.`id_supir`,
  `tb_pesan_supir`.`status`,
  `tb_supir`.`no_telpon`,
  `tb_pesan_supir`.`tanggal`,
  `tb_pesan_supir`.`lokasi_awal`,
  `tb_pesan_supir`.`lokasi_akhir`,
  `tb_pesan_supir`.`jumlah_jam`,
  `tb_pesan_supir`.`harga`,
  `tb_pesan_supir`.`email`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_supir`
ON
  `tb_pelanggan`.`email` = `tb_pesan_supir`.`email`
INNER JOIN
  `tb_supir`
ON
  `tb_pesan_supir`.`id_supir` = `tb_supir`.`id_supir`;
