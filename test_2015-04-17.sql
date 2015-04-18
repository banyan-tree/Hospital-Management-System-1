# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.23)
# Database: test
# Generation Time: 2015-04-18 02:27:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bill_patient
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bill_patient`;

CREATE TABLE `bill_patient` (
  `consult_ID` varchar(45) NOT NULL,
  `insurence_ID` varchar(45) DEFAULT NULL,
  `bill_Amount` int(11) DEFAULT NULL,
  `Bill_Date` date DEFAULT NULL,
  PRIMARY KEY (`consult_ID`),
  KEY `insurence_ID_idx` (`insurence_ID`),
  CONSTRAINT `consult_ID` FOREIGN KEY (`consult_ID`) REFERENCES `prescription` (`consult_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `insurence_ID` FOREIGN KEY (`insurence_ID`) REFERENCES `prescription` (`consult_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bill_patient` WRITE;
/*!40000 ALTER TABLE `bill_patient` DISABLE KEYS */;

INSERT INTO `bill_patient` (`consult_ID`, `insurence_ID`, `bill_Amount`, `Bill_Date`)
VALUES
	('c1','i123',500,'2014-04-10'),
	('c2','i234',1000,'2014-04-10'),
	('c3','i345',100,'2014-04-10');

/*!40000 ALTER TABLE `bill_patient` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table discharge_info
# ------------------------------------------------------------

DROP VIEW IF EXISTS `discharge_info`;

CREATE TABLE `discharge_info` (
   `admission_ID` VARCHAR(45) NOT NULL,
   `patient_ID` VARCHAR(45) NULL DEFAULT NULL,
   `admission_Date` DATE NULL DEFAULT NULL,
   `discharge_Date` DATE NULL DEFAULT NULL,
   `bed_Number` INT(11) NULL DEFAULT NULL,
   `doctor` VARCHAR(45) NULL DEFAULT NULL,
   `staff_Name` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table discharge_sheet
# ------------------------------------------------------------

DROP TABLE IF EXISTS `discharge_sheet`;

CREATE TABLE `discharge_sheet` (
  `admission_ID` varchar(45) NOT NULL,
  `patient_ID` varchar(45) DEFAULT NULL,
  `admission_Date` date DEFAULT NULL,
  `discharge_Date` date DEFAULT NULL,
  `bed_Number` int(11) DEFAULT NULL,
  `doctor_ID` varchar(45) DEFAULT NULL,
  `incharge` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`admission_ID`),
  KEY `patient_ID_idx` (`patient_ID`),
  CONSTRAINT `patient_ID` FOREIGN KEY (`patient_ID`) REFERENCES `patient_record` (`patient_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `discharge_sheet` WRITE;
/*!40000 ALTER TABLE `discharge_sheet` DISABLE KEYS */;

INSERT INTO `discharge_sheet` (`admission_ID`, `patient_ID`, `admission_Date`, `discharge_Date`, `bed_Number`, `doctor_ID`, `incharge`)
VALUES
	('a1','p1','2014-06-10','2014-06-15',10,'s1','s2'),
	('a2','p2','2014-06-15','2014-10-29',5,'s3','s4'),
	('a3','p3','2014-06-20','2015-04-15',7,'s3','s4'),
	('a4','p4','2015-04-17','2015-04-22',1,'s1','s4'),
	('a5','p5','2015-04-17','2015-04-22',3,'s1','s2'),
	('a6','p6','2015-04-17','2015-04-22',4,'s3','s2'),
	('a7','p7','2015-04-17','2015-04-22',8,'s3','s4'),
	('a8','p8','2015-04-17','2015-04-22',9,'s6','s5');

/*!40000 ALTER TABLE `discharge_sheet` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table doctor_patient_discharge
# ------------------------------------------------------------

DROP VIEW IF EXISTS `doctor_patient_discharge`;

CREATE TABLE `doctor_patient_discharge` (
   `admission_ID` VARCHAR(45) NOT NULL,
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `admission_Date` DATE NULL DEFAULT NULL,
   `discharge_Date` DATE NULL DEFAULT NULL,
   `bed_Number` INT(11) NULL DEFAULT NULL,
   `staff_Name` VARCHAR(45) NULL DEFAULT NULL,
   `doctor_ID` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table doctor_patient_info
# ------------------------------------------------------------

DROP VIEW IF EXISTS `doctor_patient_info`;

CREATE TABLE `doctor_patient_info` (
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `patient_Age` INT(11) NULL DEFAULT NULL,
   `patient_Email_ID` VARCHAR(45) NULL DEFAULT NULL,
   `prescribed_Date` DATE NULL DEFAULT NULL,
   `diagnosis` VARCHAR(45) NULL DEFAULT NULL,
   `drugs` VARCHAR(45) NULL DEFAULT NULL,
   `staff_ID` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(40) NOT NULL,
  `unique_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;

INSERT INTO `login` (`username`, `password`, `role`, `unique_ID`)
VALUES
	('01070bd0d44d49ecd2315de88253ed9e','0588499a7fadc0d74996e5c65a6624c3','PATIENT','p7'),
	('07a23fa2fa5ade0562bb30d921b92ca7','1006f0ae5a7ece19828a67ac62288e05','PATIENT','p5'),
	('149e200961ea52955bd55cb49a127935','9410fd2b928a71f977b5ab76cbb7b767','DOCTOR','s3'),
	('21232f297a57a5a743894a0e4a801fc3','6e9d0b286cba08487b712946a751740f','ADMIN','a1'),
	('2dfadf1c87039ffa7beca3f732d544c4','4b2158e106e063b2415458c19d36434b','PATIENT','p1'),
	('310a87565a48526e9d096f917007dbfe','de35a48b6691601328146e312dab9c29','NURSE','s2'),
	('8a7455d449453c2242f1de70009d38a6','80e2235fd9a018996178a07a6a3f4fff','PATIENT','p8'),
	('9ca574b17a244ba0d8036e1387af1f2b','254775650fb02988be2d1f8d05f51790','PATIENT','p2'),
	('ae59c4f9fb45e71f3f25e2e55b006d37','b653c0f71f1c8160e2411865b1a78fde','PATIENT','p3'),
	('b4cd4783d19f9e3416f7023ca8d9dce7','350d89c1cd6592bbbd1ed2e8a4f3ddba','PATIENT','p6'),
	('d3df153ba5e1e4a08293ebf7c3d0a8c7','bba7e8f625749733c15ef75dea80948f','DOCTOR','s6'),
	('d821e72d0b9f832d6cde431111057d96','82e7299654b06c9e24341863fd35e748','DOCTOR','s1'),
	('db068ce9f744fbb35eedc9a883f91085','f115cceb0c518dffe69e6aa1b44a2b1e','NURSE','s4'),
	('dc4ae195b31e3e6a26f5833de7b9595c','aae43a9434815aa9d1c50881402fec7a','NURSE','s5'),
	('f6ec95e0444daaaf49cbbd1f6c476525','f72e9a1ac26eb390ef16669c43bac7f3','PATIENT','p4');

/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nurse_patient_discharge
# ------------------------------------------------------------

DROP VIEW IF EXISTS `nurse_patient_discharge`;

CREATE TABLE `nurse_patient_discharge` (
   `admission_ID` VARCHAR(45) NOT NULL,
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `admission_Date` DATE NULL DEFAULT NULL,
   `discharge_Date` DATE NULL DEFAULT NULL,
   `bed_Number` INT(11) NULL DEFAULT NULL,
   `incharge` VARCHAR(45) NULL DEFAULT NULL,
   `doctor` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table nurse_patient_info
# ------------------------------------------------------------

DROP VIEW IF EXISTS `nurse_patient_info`;

CREATE TABLE `nurse_patient_info` (
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `patient_Age` INT(11) NULL DEFAULT NULL,
   `patient_Email_ID` VARCHAR(45) NULL DEFAULT NULL,
   `diagnosis` VARCHAR(45) NULL DEFAULT NULL,
   `drugs` VARCHAR(45) NULL DEFAULT NULL,
   `doctor` VARCHAR(45) NULL DEFAULT NULL,
   `incharge` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table patient_discharge
# ------------------------------------------------------------

DROP VIEW IF EXISTS `patient_discharge`;

CREATE TABLE `patient_discharge` (
   `admission_ID` VARCHAR(45) NOT NULL,
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `admission_Date` DATE NULL DEFAULT NULL,
   `discharge_Date` DATE NULL DEFAULT NULL,
   `bed_Number` INT(11) NULL DEFAULT NULL,
   `staff_Name` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table patient_info
# ------------------------------------------------------------

DROP VIEW IF EXISTS `patient_info`;

CREATE TABLE `patient_info` (
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `patient_Age` INT(11) NULL DEFAULT NULL,
   `patient_Email_ID` VARCHAR(45) NULL DEFAULT NULL,
   `prescribed_Date` DATE NULL DEFAULT NULL,
   `diagnosis` VARCHAR(45) NULL DEFAULT NULL,
   `drugs` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table patient_record
# ------------------------------------------------------------

DROP TABLE IF EXISTS `patient_record`;

CREATE TABLE `patient_record` (
  `patient_ID` varchar(10) NOT NULL,
  `patient_name` varchar(45) DEFAULT NULL,
  `patient_address` varchar(150) DEFAULT NULL,
  `patient_Email_ID` varchar(45) DEFAULT NULL,
  `patient_Contact` varchar(45) DEFAULT NULL,
  `patient_Age` int(11) DEFAULT NULL,
  PRIMARY KEY (`patient_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `patient_record` WRITE;
/*!40000 ALTER TABLE `patient_record` DISABLE KEYS */;

INSERT INTO `patient_record` (`patient_ID`, `patient_name`, `patient_address`, `patient_Email_ID`, `patient_Contact`, `patient_Age`)
VALUES
	('p1','Sonam Padwal','1625','sonam@gmail.com','5851112222',20),
	('p2','siddesh pillai','pqr apartment 1','siddesh@gmail.com','5852223333',25),
	('p3','Sushil Mohite','lmn apartment 2','sushil@gmail.com','5851231234',25),
	('p4','Siddharth Thakur','14 Crittenden Way','siddharth@yahoo.com','5851193324',25),
	('p5','Sahil Bapat','1615 Crittenden Way','sahil@hotmail.com','5853254298',39),
	('p6','Nikhil Hegde','221B Baker Street','nikhil@me.com','5554432345',19),
	('p7','Rihanna Khan','Mannat Lands End','rihanna@indiatimes.com','5857372234',33),
	('p8','Hitesh Vyas','34 Crittenden','hitesh@hv.com','9876543210',56);

/*!40000 ALTER TABLE `patient_record` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table personal_info
# ------------------------------------------------------------

DROP VIEW IF EXISTS `personal_info`;

CREATE TABLE `personal_info` (
   `patient_ID` VARCHAR(10) NULL DEFAULT NULL,
   `patient_address` VARCHAR(150) NULL DEFAULT NULL,
   `patient_Age` INT(11) NULL DEFAULT NULL,
   `patient_name` VARCHAR(45) NULL DEFAULT NULL,
   `patient_Contact` VARCHAR(45) NULL DEFAULT NULL,
   `patient_Email_ID` VARCHAR(45) NULL DEFAULT NULL,
   `consult_ID` VARCHAR(45) NOT NULL,
   `prescribed_Date` DATE NULL DEFAULT NULL,
   `diagnosis` VARCHAR(45) NULL DEFAULT NULL,
   `drugs` VARCHAR(45) NULL DEFAULT NULL,
   `insurance_Company` VARCHAR(45) NULL DEFAULT NULL,
   `insurance_ID` VARCHAR(45) NULL DEFAULT NULL,
   `staff_Name` VARCHAR(45) NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table prescription
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prescription`;

CREATE TABLE `prescription` (
  `consult_ID` varchar(45) NOT NULL,
  `prescribed_Date` date DEFAULT NULL,
  `diagnosis` varchar(45) DEFAULT NULL,
  `drugs` varchar(45) DEFAULT NULL,
  `insurance_Company` varchar(45) DEFAULT NULL,
  `insurance_ID` varchar(45) DEFAULT NULL,
  `staff_ID` varchar(45) DEFAULT NULL,
  `patient_ID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`consult_ID`),
  KEY `patient_ID_idx` (`patient_ID`),
  KEY `patient_ID` (`patient_ID`),
  KEY `staff_ID_idx` (`staff_ID`),
  CONSTRAINT `staff_ID` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `prescription` WRITE;
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;

INSERT INTO `prescription` (`consult_ID`, `prescribed_Date`, `diagnosis`, `drugs`, `insurance_Company`, `insurance_ID`, `staff_ID`, `patient_ID`)
VALUES
	('c1','2014-06-10','fever','Ibuprofane','LIC','i123','s1','p1'),
	('c2','2014-06-15','sore throat','T Azee','ATENA','i234','s3','p2'),
	('c3','2014-06-24','wegners','Endoxan','MAX NEW YORK','i345','s3','p3'),
	('c4','2015-04-17','Common Cold','Nyquil','NATIONWIDE','i666','s1','p4'),
	('c5','2015-04-17','Diarrhea','Norfloxicin','BAJAJ','i667','s1','p5'),
	('c6','2015-04-17','Maleria','Cleocin','MAX NEW YORK','i668','s3','p6'),
	('c7','2015-04-17','Dengue','aspirin','NATIONWIDE','i700','s3','p7'),
	('c8','2015-04-17','Throat Infection','Lifeboy','Allianz','i707','s6','p8');

/*!40000 ALTER TABLE `prescription` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `staff_ID` varchar(45) NOT NULL,
  `staff_Name` varchar(45) DEFAULT NULL,
  `staff_Email_ID` varchar(45) DEFAULT NULL,
  `designatoin` varchar(45) DEFAULT NULL,
  `date_Of_Employeement` date DEFAULT NULL,
  PRIMARY KEY (`staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;

INSERT INTO `staff` (`staff_ID`, `staff_Name`, `staff_Email_ID`, `designatoin`, `date_Of_Employeement`)
VALUES
	('s1','Pritesh Shah','pritesh@yahoo.com','DOCTOR','2014-04-01'),
	('s2','Vaibhav Gandhi','vaibhav@hotmail.com','NURSE','2014-04-01'),
	('s3','Varun Hegde','varun@gmail.com','DOCTOR','2014-04-01'),
	('s4','Karan Chimedia','karan@gmail.com','NURSE','2014-04-01'),
	('s5','Siya Parabh','siya@parab.com','NURSE','2015-04-17'),
	('s6','Tobin Pereira','tobin@me.com','DOCTOR','2015-04-17');

/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;




# Replace placeholder table for patient_info with correct view syntax
# ------------------------------------------------------------

DROP TABLE `patient_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patient_info`
AS SELECT
   `pr`.`patient_name` AS `patient_name`,
   `pr`.`patient_Age` AS `patient_Age`,
   `pr`.`patient_Email_ID` AS `patient_Email_ID`,
   `p`.`prescribed_Date` AS `prescribed_Date`,
   `p`.`diagnosis` AS `diagnosis`,
   `p`.`drugs` AS `drugs`
FROM (`prescription` `p` join `patient_record` `pr`) where (`p`.`patient_ID` = `pr`.`patient_ID`);


# Replace placeholder table for personal_info with correct view syntax
# ------------------------------------------------------------

DROP TABLE `personal_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `personal_info`
AS SELECT
   `p`.`patient_ID` AS `patient_ID`,
   `pr`.`patient_address` AS `patient_address`,
   `pr`.`patient_Age` AS `patient_Age`,
   `pr`.`patient_name` AS `patient_name`,
   `pr`.`patient_Contact` AS `patient_Contact`,
   `pr`.`patient_Email_ID` AS `patient_Email_ID`,
   `p`.`consult_ID` AS `consult_ID`,
   `p`.`prescribed_Date` AS `prescribed_Date`,
   `p`.`diagnosis` AS `diagnosis`,
   `p`.`drugs` AS `drugs`,
   `p`.`insurance_Company` AS `insurance_Company`,
   `p`.`insurance_ID` AS `insurance_ID`,
   `s`.`staff_Name` AS `staff_Name`
FROM ((`patient_record` `pr` join `prescription` `p`) join `staff` `s`) where ((`p`.`staff_ID` = `s`.`staff_ID`) and (`p`.`patient_ID` = `pr`.`patient_ID`));


# Replace placeholder table for nurse_patient_discharge with correct view syntax
# ------------------------------------------------------------

DROP TABLE `nurse_patient_discharge`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nurse_patient_discharge`
AS SELECT
   `ds`.`admission_ID` AS `admission_ID`,
   `pr`.`patient_name` AS `patient_name`,
   `ds`.`admission_Date` AS `admission_Date`,
   `ds`.`discharge_Date` AS `discharge_Date`,
   `ds`.`bed_Number` AS `bed_Number`,
   `ds`.`incharge` AS `incharge`,
   `d`.`staff_Name` AS `doctor`
FROM ((`discharge_sheet` `ds` join `staff` `d`) join `patient_record` `pr`) where ((`ds`.`patient_ID` = `pr`.`patient_ID`) and (`ds`.`doctor_ID` = `d`.`staff_ID`));


# Replace placeholder table for doctor_patient_info with correct view syntax
# ------------------------------------------------------------

DROP TABLE `doctor_patient_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `doctor_patient_info`
AS SELECT
   `pr`.`patient_name` AS `patient_name`,
   `pr`.`patient_Age` AS `patient_Age`,
   `pr`.`patient_Email_ID` AS `patient_Email_ID`,
   `p`.`prescribed_Date` AS `prescribed_Date`,
   `p`.`diagnosis` AS `diagnosis`,
   `p`.`drugs` AS `drugs`,
   `p`.`staff_ID` AS `staff_ID`
FROM ((`prescription` `p` join `patient_record` `pr`) join `staff` `s`) where ((`pr`.`patient_ID` = `p`.`patient_ID`) and (`p`.`staff_ID` = `s`.`staff_ID`));


# Replace placeholder table for doctor_patient_discharge with correct view syntax
# ------------------------------------------------------------

DROP TABLE `doctor_patient_discharge`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `doctor_patient_discharge`
AS SELECT
   `ds`.`admission_ID` AS `admission_ID`,
   `pr`.`patient_name` AS `patient_name`,
   `ds`.`admission_Date` AS `admission_Date`,
   `ds`.`discharge_Date` AS `discharge_Date`,
   `ds`.`bed_Number` AS `bed_Number`,
   `s`.`staff_Name` AS `staff_Name`,
   `ds`.`doctor_ID` AS `doctor_ID`
FROM ((`discharge_sheet` `ds` join `staff` `s`) join `patient_record` `pr`) where ((`ds`.`incharge` = `s`.`staff_ID`) and (`ds`.`patient_ID` = `pr`.`patient_ID`));


# Replace placeholder table for nurse_patient_info with correct view syntax
# ------------------------------------------------------------

DROP TABLE `nurse_patient_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nurse_patient_info`
AS SELECT
   `pr`.`patient_name` AS `patient_name`,
   `pr`.`patient_Age` AS `patient_Age`,
   `pr`.`patient_Email_ID` AS `patient_Email_ID`,
   `p`.`diagnosis` AS `diagnosis`,
   `p`.`drugs` AS `drugs`,
   `d`.`staff_Name` AS `doctor`,
   `ds`.`incharge` AS `incharge`
FROM (((`discharge_sheet` `ds` join `patient_record` `pr`) join `staff` `d`) join `prescription` `p`) where ((`pr`.`patient_ID` = `ds`.`patient_ID`) and (`ds`.`patient_ID` = `p`.`patient_ID`) and (`ds`.`doctor_ID` = `d`.`staff_ID`));


# Replace placeholder table for patient_discharge with correct view syntax
# ------------------------------------------------------------

DROP TABLE `patient_discharge`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patient_discharge`
AS SELECT
   `ds`.`admission_ID` AS `admission_ID`,
   `pr`.`patient_name` AS `patient_name`,
   `ds`.`admission_Date` AS `admission_Date`,
   `ds`.`discharge_Date` AS `discharge_Date`,
   `ds`.`bed_Number` AS `bed_Number`,
   `s`.`staff_Name` AS `staff_Name`
FROM ((`discharge_sheet` `ds` join `staff` `s`) join `patient_record` `pr`) where ((`ds`.`incharge` = `s`.`staff_ID`) and (`ds`.`patient_ID` = `pr`.`patient_ID`));


# Replace placeholder table for discharge_info with correct view syntax
# ------------------------------------------------------------

DROP TABLE `discharge_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `discharge_info`
AS SELECT
   `ds`.`admission_ID` AS `admission_ID`,
   `ds`.`patient_ID` AS `patient_ID`,
   `ds`.`admission_Date` AS `admission_Date`,
   `ds`.`discharge_Date` AS `discharge_Date`,
   `ds`.`bed_Number` AS `bed_Number`,
   `d`.`staff_Name` AS `doctor`,
   `s`.`staff_Name` AS `staff_Name`
FROM ((`discharge_sheet` `ds` join `staff` `s`) join `staff` `d`) where ((`ds`.`incharge` = `s`.`staff_ID`) and (`ds`.`doctor_ID` = `d`.`staff_ID`));

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
