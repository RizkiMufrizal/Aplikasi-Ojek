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

CREATE TABLE tb_pelanggan (
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    no_telpon VARCHAR(15) NOT NULL,
    role VARCHAR(30) NOT NULL
)  ENGINE=INNODB;

CREATE TABLE tb_ojek(
    id_ojek VARCHAR(150) NOT NULL PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    no_telpon VARCHAR(15) NOT NULL,
    role VARCHAR(15) NOT NULL
) ENGINE = INNODB;

CREATE TABLE tb_pesan_ojek (
    id_pesan_ojek VARCHAR(150) NOT NULL PRIMARY KEY,
    tanggal DATETIME,
    lokasi_awal TEXT NOT NULL,
    lokasi_akhir TEXT NOT NULL,
    status TINYINT(1) NOT NULL,
    jumlah_jam INT NOT NULL,
    harga INT NOT NULL,
    email VARCHAR(50) NOT NULL,
    id_ojek VARCHAR(150),
    FOREIGN KEY (email)
        REFERENCES tb_pelanggan (email),
    FOREIGN KEY (id_ojek)
        REFERENCES tb_ojek (id_ojek)
)  ENGINE=INNODB;

CREATE VIEW `tb_pelanggan_pesan_ojek` AS
SELECT
  `tb_pelanggan`.`email`,
  `tb_pelanggan`.`nama`,
  `tb_pelanggan`.`no_telpon`,
  `tb_pesan_ojek`.`id_pesan_ojek`,
  `tb_pesan_ojek`.`tanggal`,
  `tb_pesan_ojek`.`lokasi_awal`,
  `tb_pesan_ojek`.`lokasi_akhir`,
  `tb_pesan_ojek`.`status`,
  `tb_pesan_ojek`.`jumlah_jam`,
  `tb_pesan_ojek`.`harga`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_ojek`
ON
  `tb_pelanggan`.`email` = `tb_pesan_ojek`.`email`;

CREATE VIEW `tb_pelanggan_ojek` AS
SELECT
  `tb_pelanggan`.`email`,
  `tb_pelanggan`.`nama`,
  `tb_pelanggan`.`no_telpon`,
  `tb_pesan_ojek`.`id_pesan_ojek`,
  `tb_pesan_ojek`.`tanggal`,
  `tb_pesan_ojek`.`lokasi_awal`,
  `tb_pesan_ojek`.`lokasi_akhir`,
  `tb_pesan_ojek`.`status`,
  `tb_pesan_ojek`.`jumlah_jam`,
  `tb_pesan_ojek`.`harga`,
  `tb_ojek`.`id_ojek`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_ojek`
ON
  `tb_pelanggan`.`email` = `tb_pesan_ojek`.`email`
INNER JOIN
  `tb_ojek`
ON
  `tb_pesan_ojek`.`id_ojek` = `tb_ojek`.`id_ojek`;

CREATE VIEW `tb_ojek_pesan_ojek` AS
SELECT
  `tb_ojek`.`nama`,
  `tb_ojek`.`id_ojek`,
  `tb_pesan_ojek`.`status`,
  `tb_ojek`.`no_telpon`,
  `tb_pesan_ojek`.`tanggal`,
  `tb_pesan_ojek`.`lokasi_awal`,
  `tb_pesan_ojek`.`lokasi_akhir`,
  `tb_pesan_ojek`.`jumlah_jam`,
  `tb_pesan_ojek`.`harga`,
  `tb_pesan_ojek`.`email`
FROM
  `tb_pelanggan`
INNER JOIN
  `tb_pesan_ojek`
ON
  `tb_pelanggan`.`email` = `tb_pesan_ojek`.`email`
INNER JOIN
  `tb_ojek`
ON
  `tb_pesan_ojek`.`id_ojek` = `tb_ojek`.`id_ojek`
