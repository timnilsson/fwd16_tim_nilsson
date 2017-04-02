-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2017 at 07:44 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `patientsWithDiagnos`(IN `diagnosName` VARCHAR(255))
BEGIN
SELECT COUNT(*) AS "Number of patient"
FROM patientdiagnos
RIGHT JOIN patient ON patientdiagnos.patientID = patient.patientID
RIGHT JOIN diagnos ON patientdiagnos.diagnosID = diagnos.diagnosID
WHERE diagnos.name = diagnosName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchDiagnosis`(IN diagnosName varchar(255))
BEGIN
SELECT medicine.name AS "Medicine name", medicine.dose AS "Dose"
FROM medicine LEFT JOIN diagnos ON medicine.diagnosID = diagnos.diagnosID
WHERE diagnos.name = diagnosName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchNursesByPatient`(IN patientNumber int)
BEGIN
SELECT CONCAT_WS(" ", nurse.firstName, nurse.lastName) AS "Nurses responsible for patient"
FROM patientnurse
LEFT JOIN nurse ON patientnurse.nurseID = nurse.nurseID
LEFT JOIN patient ON patientnurse.patientID = patient.patientID
WHERE patientnurse.patientID = patientNumber;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diagnos`
--

CREATE TABLE IF NOT EXISTS `diagnos` (
  `diagnosID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnos`
--

INSERT INTO `diagnos` (`diagnosID`, `name`) VALUES
(1, 'Cold'),
(2, 'Flu'),
(3, 'Migraine'),
(4, 'Imbecility'),
(5, 'Rabies');

-- --------------------------------------------------------

--
-- Stand-in structure for view `diagnosgroups`
--
CREATE TABLE IF NOT EXISTS `diagnosgroups` (
`Diagnos` varchar(255)
,`Number of patients` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorID`, `firstName`, `lastName`) VALUES
(1, 'Courtney', 'Michaels'),
(2, 'Kaleigh', 'Niklasson'),
(3, 'Stu', 'Hayward'),
(4, 'Dahlia', 'Belanger'),
(5, 'Madalyn', 'Lindsay');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `medicineID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dose` varchar(45) NOT NULL,
  `diagnosID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `name`, `dose`, `diagnosID`) VALUES
(1, 'Penicillin', '5 mg', 2),
(2, 'Atenolol', '50 mg', 3),
(3, 'Carvedilol', '25 mg', 5),
(4, 'Hydralazine', '25 mg', 3),
(5, 'Insulin', '100 units/mL', 1),
(6, 'Lisinopril', '10 mg', 4),
(7, 'Mesalazine', '400 mg', 5),
(8, 'Desiflurane', '240 ml', 2),
(9, 'Electric Shock', '5 v', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `medicininfo`
--
CREATE TABLE IF NOT EXISTS `medicininfo` (
`Medicine name` varchar(255)
,`Dose` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE IF NOT EXISTS `nurse` (
  `nurseID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`nurseID`, `firstName`, `lastName`) VALUES
(1, 'Royce', 'Leach'),
(2, 'Kaelee', 'Martinson'),
(3, 'Harrison', 'Scriven'),
(4, 'Davida', 'Hyland'),
(5, 'Dyan', 'Freeman'),
(6, 'Patricia', 'Lee'),
(7, 'Alesia', 'Cheshire'),
(8, 'Mansel', 'Cobb'),
(9, 'Fiona', 'Milton'),
(10, 'Viola', 'Nowell');

-- --------------------------------------------------------

--
-- Stand-in structure for view `nursesbypatient`
--
CREATE TABLE IF NOT EXISTS `nursesbypatient` (
`Nurses responsible for patient` varchar(511)
);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patientID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `doctorID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `lastName`, `doctorID`) VALUES
(1, 'Clinton', 'Banks', NULL),
(2, 'Madelina', 'Wootton', 3),
(3, 'Solveig', 'Groves', NULL),
(4, 'Rosy', 'Stidolph', 4),
(5, 'Johnathon', 'Christophers', 2),
(6, 'Gabriella', 'Abbot', 3),
(7, 'Philip', 'Macey', 3),
(8, 'Chrissy', 'Richard', 1),
(9, 'Ormond', 'Thornton', 2),
(10, 'Judi', 'Longstaff', 5),
(11, 'Howard', 'Small', NULL),
(12, 'Alesia', 'Thacker', 5),
(13, 'Bud', 'Smith', 1),
(14, 'Jacob', 'Sherman', 5),
(15, 'Harriet', 'Snyder', NULL),
(16, 'Ricki', 'Huddleston', 5),
(17, 'Tom', 'Boatwright', 4),
(18, 'Ronny', 'Short', 2),
(19, 'Leanora', 'Forrest', 4),
(20, 'Marleen', 'Saunders', 4);

-- --------------------------------------------------------

--
-- Table structure for table `patientdiagnos`
--

CREATE TABLE IF NOT EXISTS `patientdiagnos` (
  `patientID` int(11) NOT NULL,
  `diagnosID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientdiagnos`
--

INSERT INTO `patientdiagnos` (`patientID`, `diagnosID`) VALUES
(1, 1),
(3, 1),
(5, 1),
(7, 1),
(8, 1),
(9, 1),
(3, 2),
(4, 2),
(7, 2),
(11, 2),
(12, 2),
(15, 2),
(16, 2),
(20, 2),
(5, 3),
(6, 3),
(10, 3),
(13, 3),
(14, 3),
(17, 3),
(18, 3),
(19, 3),
(1, 4),
(2, 4),
(4, 4),
(5, 4),
(13, 4),
(2, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `patientnumbers`
--
CREATE TABLE IF NOT EXISTS `patientnumbers` (
`Patients` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `patientnurse`
--

CREATE TABLE IF NOT EXISTS `patientnurse` (
  `patientID` int(11) NOT NULL,
  `nurseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientnurse`
--

INSERT INTO `patientnurse` (`patientID`, `nurseID`) VALUES
(1, 1),
(6, 1),
(13, 1),
(1, 2),
(4, 2),
(7, 3),
(10, 4),
(14, 4),
(20, 4),
(4, 5),
(6, 5),
(11, 5),
(2, 6),
(5, 6),
(10, 6),
(15, 6),
(19, 6),
(3, 7),
(9, 8),
(10, 8),
(12, 8),
(1, 9),
(3, 9),
(12, 9),
(16, 9),
(18, 9),
(8, 10),
(13, 10),
(17, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `patientswithdoctor`
--
CREATE TABLE IF NOT EXISTS `patientswithdoctor` (
`First name` varchar(255)
,`Last name` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `diagnosgroups`
--
DROP TABLE IF EXISTS `diagnosgroups`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `diagnosgroups` AS select `diagnos`.`name` AS `Diagnos`,count(0) AS `Number of patients` from (`diagnos` left join `patientdiagnos` on((`patientdiagnos`.`diagnosID` = `diagnos`.`diagnosID`))) group by `diagnos`.`diagnosID`;

-- --------------------------------------------------------

--
-- Structure for view `medicininfo`
--
DROP TABLE IF EXISTS `medicininfo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `medicininfo` AS select `medicine`.`name` AS `Medicine name`,`medicine`.`dose` AS `Dose` from (`medicine` left join `diagnos` on((`medicine`.`diagnosID` = `diagnos`.`diagnosID`))) where (`diagnos`.`name` = 'Migraine');

-- --------------------------------------------------------

--
-- Structure for view `nursesbypatient`
--
DROP TABLE IF EXISTS `nursesbypatient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nursesbypatient` AS select concat_ws(' ',`nurse`.`firstName`,`nurse`.`lastName`) AS `Nurses responsible for patient` from (`nurse` left join (`patient` left join `patientnurse` on((`patientnurse`.`patientID` = `patient`.`patientID`))) on((`patientnurse`.`nurseID` = `nurse`.`nurseID`))) where (`patient`.`patientID` = 1);

-- --------------------------------------------------------

--
-- Structure for view `patientnumbers`
--
DROP TABLE IF EXISTS `patientnumbers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patientnumbers` AS select count(0) AS `Patients` from `patient`;

-- --------------------------------------------------------

--
-- Structure for view `patientswithdoctor`
--
DROP TABLE IF EXISTS `patientswithdoctor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `patientswithdoctor` AS select `patient`.`firstName` AS `First name`,`patient`.`lastName` AS `Last name` from (`patient` left join `doctor` on((`patient`.`doctorID` = `doctor`.`doctorID`))) where (`patient`.`doctorID` is not null);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnos`
--
ALTER TABLE `diagnos`
  ADD PRIMARY KEY (`diagnosID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`),
  ADD KEY `diagnosID` (`diagnosID`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`nurseID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `patientdiagnos`
--
ALTER TABLE `patientdiagnos`
  ADD PRIMARY KEY (`patientID`,`diagnosID`),
  ADD KEY `diagnosID` (`diagnosID`);

--
-- Indexes for table `patientnurse`
--
ALTER TABLE `patientnurse`
  ADD PRIMARY KEY (`patientID`,`nurseID`),
  ADD KEY `nurseID` (`nurseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnos`
--
ALTER TABLE `diagnos`
  MODIFY `diagnosID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `nurseID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`diagnosID`) REFERENCES `diagnos` (`diagnosID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`doctorID`) REFERENCES `doctor` (`doctorID`);

--
-- Constraints for table `patientdiagnos`
--
ALTER TABLE `patientdiagnos`
  ADD CONSTRAINT `patientdiagnos_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`),
  ADD CONSTRAINT `patientdiagnos_ibfk_2` FOREIGN KEY (`diagnosID`) REFERENCES `diagnos` (`diagnosID`);

--
-- Constraints for table `patientnurse`
--
ALTER TABLE `patientnurse`
  ADD CONSTRAINT `patientnurse_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`),
  ADD CONSTRAINT `patientnurse_ibfk_2` FOREIGN KEY (`nurseID`) REFERENCES `nurse` (`nurseID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
