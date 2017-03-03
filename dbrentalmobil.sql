/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.16-MariaDB : Database - dbrentalmobil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbrentalmobil` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbrentalmobil`;

/*Table structure for table `merk` */

DROP TABLE IF EXISTS `merk`;

CREATE TABLE `merk` (
  `idmerk` int(2) NOT NULL AUTO_INCREMENT,
  `namamerk` varchar(100) DEFAULT NULL,
  `namamerk_seo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idmerk`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `merk` */

insert  into `merk`(`idmerk`,`namamerk`,`namamerk_seo`) values (1,'Toyota','toyota'),(2,'Honda','honda'),(3,'Daihatsu','daihatsu'),(4,'Nissan','nissan'),(5,'Suzuki','suzuki'),(7,'Mitsubishi','mitsubishi'),(10,'BMW','bmw'),(11,'Isuzu','isuzu'),(12,'Datsun','datsun'),(13,'Ferrari','ferrari');

/*Table structure for table `mobil` */

DROP TABLE IF EXISTS `mobil`;

CREATE TABLE `mobil` (
  `idmobil` int(3) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `idmerk` int(2) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `tahunproduksi` int(4) DEFAULT NULL,
  `platnomer` varchar(15) DEFAULT NULL,
  `kursi` int(2) DEFAULT NULL,
  `tarif` int(6) DEFAULT NULL,
  `lembur` int(6) DEFAULT NULL,
  `norangka` varchar(20) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `stmobil` enum('bebas','jalan') DEFAULT 'bebas',
  PRIMARY KEY (`idmobil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mobil` */

insert  into `mobil`(`idmobil`,`date`,`idmerk`,`type`,`tahunproduksi`,`platnomer`,`kursi`,`tarif`,`lembur`,`norangka`,`foto`,`update`,`stmobil`) values (1,'2016-11-17 08:19:32',3,'Ayla',2016,'A 1234 BCD',5,270000,50000,'A123KGJR','ayla.jpg','2016-11-22 16:05:00','bebas'),(2,'2016-11-17 14:21:55',1,'Agya',2016,'B 1122 CD',5,280000,50000,'A4455GGHT','agya.jpg','2016-11-20 09:04:54','bebas'),(3,'2016-11-20 09:05:34',3,'Xenia',2016,'B 4444 DUT',8,350000,50000,'AHASDR567JH','xenia1.png','2016-11-20 09:07:26','jalan'),(4,'2016-11-20 09:07:18',3,'Luxio',2016,'B 2233 CD',8,350000,50000,'AGD556K7','luxio.png',NULL,'jalan'),(5,'2016-11-22 16:02:14',1,'Avanza',2016,'B 1111 AAA',8,350000,50000,'HIJKLMN123','avanza.jpg',NULL,'bebas');

/*Table structure for table `supir` */

DROP TABLE IF EXISTS `supir`;

CREATE TABLE `supir` (
  `idsupir` int(2) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `namasupir` varchar(30) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `noktp` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `tarif` int(6) DEFAULT NULL,
  `lembur` int(6) DEFAULT NULL,
  PRIMARY KEY (`idsupir`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `supir` */

insert  into `supir`(`idsupir`,`date`,`namasupir`,`tgllahir`,`alamat`,`noktp`,`foto`,`tarif`,`lembur`) values (1,NULL,'Bambang','1980-07-24','Pasar Minggu, Jakarta Selatan','1234455678','121116140543100465.jpg',100000,20000),(3,NULL,'Ade Margono','1981-03-05','Jakarta Barat','456712378','foto_pp1.png',100000,20000);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `idtransaksi` int(100) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `namapelanggan` varchar(20) DEFAULT NULL,
  `noktp` varchar(20) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tglsewa` date DEFAULT NULL,
  `tglkembali` date DEFAULT NULL,
  `selisih` int(2) DEFAULT '0',
  `idmobil` int(2) DEFAULT NULL,
  `idsupir` int(2) DEFAULT NULL,
  `total` int(10) DEFAULT '0',
  `sttransaksi` enum('mulai','selesai') DEFAULT 'mulai',
  PRIMARY KEY (`idtransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`idtransaksi`,`date`,`namapelanggan`,`noktp`,`nohp`,`alamat`,`tglsewa`,`tglkembali`,`selisih`,`idmobil`,`idsupir`,`total`,`sttransaksi`) values (1,'2016-11-22 13:50:33','Budi Pangestu','65437890123','0812345678','Depok','2016-11-21','2016-11-22',2,3,3,900000,'selesai'),(2,'2016-11-22 12:17:10','Dedi Irawan','1234455678','0812345678','Jakarta','2016-11-20',NULL,0,4,0,0,'mulai'),(3,'2016-11-22 13:53:46','Jamal','584986794039','08982000969','Jakarta','2016-11-20',NULL,0,3,1,0,'mulai');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `iduser` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `stuser` int(1) DEFAULT '1',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`iduser`,`username`,`password`,`lastlogin`,`stuser`) values (1,'administrator','e10adc3949ba59abbe56e057f20f883e',NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
