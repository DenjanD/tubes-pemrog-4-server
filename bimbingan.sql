-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE `bimbingan` (
  `bimbingan_id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int NOT NULL,
  `file_bimbingan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `judul_bimbingan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_bimbingan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Menunggu','Diterima','Revisi') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `evaluasi_bimbingan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`bimbingan_id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  CONSTRAINT `bimbingan_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bimbingan` (`bimbingan_id`, `mahasiswa_id`, `file_bimbingan`, `judul_bimbingan`, `deskripsi_bimbingan`, `status`, `evaluasi_bimbingan`) VALUES
(1,	1,	'',	'prediksi kehamilan',	'menentukkan judul',	'Menunggu',	'lebih baik kata dari judulnya panjang ');

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `dosen_id` int NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`dosen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `dosen` (`dosen_id`, `nip`, `nama`, `password`, `foto`) VALUES
(1,	12345626,	'Harry ',	'1234556745',	'');

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `mahasiswa_id` int NOT NULL AUTO_INCREMENT,
  `npm` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosen_id` int NOT NULL,
  PRIMARY KEY (`mahasiswa_id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mahasiswa` (`mahasiswa_id`, `npm`, `nama`, `password`, `foto`, `dosen_id`) VALUES
(1,	1204044,	'Fahira',	'iraa123',	'',	1);

DROP TABLE IF EXISTS `pengajuan_dospem`;
CREATE TABLE `pengajuan_dospem` (
  `mahasiswa_id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int NOT NULL,
  `is_diterima` binary(1) NOT NULL,
  PRIMARY KEY (`mahasiswa_id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `pengajuan_dospem_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`),
  CONSTRAINT `pengajuan_dospem_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pengajuan_dospem` (`mahasiswa_id`, `dosen_id`, `is_diterima`) VALUES
(1,	1,	UNHEX('01'));

-- 2023-01-10 06:26:12
