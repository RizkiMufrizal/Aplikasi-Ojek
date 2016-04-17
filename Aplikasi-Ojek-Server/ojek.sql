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
    role VARCHAR(10) NOT NULL
)  ENGINE=INNODB;

CREATE TABLE tb_ojek(
  id_ojek VARCHAR(150) NOT NULL PRIMARY KEY,
  nama VARCHAR(50) NOT NULL,
  password VARCHAR(150) NOT NULL,
  role VARCHAR(10) NOT NULL
) ENGINE = INNODB;

CREATE TABLE tb_pesan_ojek (
    id_pesan_ojek VARCHAR(150) NOT NULL PRIMARY KEY,
    lokasi_awal TEXT NOT NULL,
    lokasi_akhir TEXT NOT NULL,
    status TINYINT(1) NOT NULL,
    email VARCHAR(50),
    id_ojek VARCHAR(150),
    FOREIGN KEY (email)
        REFERENCES tb_pelanggan (email),
    FOREIGN KEY (id_ojek)
        REFERENCES tb_ojek (id_ojek)
)  ENGINE=INNODB;