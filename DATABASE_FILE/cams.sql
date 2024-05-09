-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2023 at 05:37 AM
-- Server version: 8.0.34
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cams`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications_daman`
--

CREATE TABLE `applications_daman` (
  `ack_no` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept_no` int NOT NULL,
  `app_code` int NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `query_date` varchar(255) NOT NULL,
  `grant_date` varchar(255) NOT NULL,
  `rejected_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications_diu`
--

CREATE TABLE `applications_diu` (
  `ack_no` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept_no` int NOT NULL,
  `app_code` int NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `query_date` varchar(255) NOT NULL,
  `grant_date` varchar(255) NOT NULL,
  `rejected_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications_dnh`
--

CREATE TABLE `applications_dnh` (
  `ack_no` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept_no` int NOT NULL,
  `app_code` int NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `query_date` varchar(255) DEFAULT NULL,
  `grant_date` varchar(255) DEFAULT NULL,
  `rejected_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_type`
--

CREATE TABLE `app_type` (
  `app_code` int NOT NULL,
  `app_type` varchar(255) NOT NULL,
  `dept_no` int NOT NULL,
  `no_days` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `app_type`
--

INSERT INTO `app_type` (`app_code`, `app_type`, `dept_no`, `no_days`) VALUES
(101, 'Grant of Arms Licence', 1, 60),
(102, 'Renewal of Arms Licence', 1, 30),
(103, 'G/A of Lic. to Proc. & Sell Explosives', 1, 30),
(104, 'Ren. of Lic. to Proc. & Sell Explosives', 1, 30),
(105, 'Grant of Movie Theatre Licence', 1, 60),
(106, 'G/A/R/T of Lic. to Import & Store Petrolium', 1, 30),
(107, 'Grant of licence to Mfg. Insecticides', 1, 60),
(108, 'Renewal of licence to Mfg. Insecticides', 1, 30),
(109, 'Grant of Lic. to sell Stock or Exibit Insecticides', 1, 60),
(110, 'Renewal of Lic. to  sell Stock or Exibit Insectici', 1, 30),
(111, 'ISSUANCE OF NOC PUTTING UP A PETROL PUMP', 1, 30),
(112, 'RENEWAL FOR DEALERS LICEINCE', 1, 7),
(201, 'ISSUE OF RES. CERTIFICATE', 2, 10),
(202, 'ISSUE OF CASTE CERTIFICATE', 2, 10),
(203, 'ISSUE OF DOMICILE CERTIFICATE', 2, 10),
(204, 'ENTRY OF NAME IN RECORD OF RIGHTS', 2, 30),
(205, 'ISSUE OF 7/12 FORM', 2, 7),
(301, 'INCLU. OF NEW NAME IN RATION CARD', 3, 3),
(302, 'ISSUE OF NAME/CARD CANC. CERT.', 3, 2),
(303, 'ISSUE OF DUPLICATE RATION CARD', 3, 7),
(304, 'RENEWAL OF OLD RATION CARD', 3, 7),
(305, 'ISSUE OF NEW RATION CARD', 3, 7),
(306, 'GRANT  OF SLOLVENT LICEINCE', 3, 30),
(307, 'RENEWAL OF SOLVENT LICEINCE', 3, 10),
(308, 'RENEWAL OF DELER LICEINCE', 3, 7),
(309, 'GRANT OF DELER LICEINCE', 3, 7),
(401, 'GRANT OF DEALER LIC. FOR SALE W/M', 4, 30),
(402, 'GRANT OF MANUF. LIC. FOR W/M', 4, 30),
(403, 'GRANT OF REPAIR LIC. FOR W/M', 4, 30),
(501, 'ISSUE OF CERT. COPY OF MAP', 5, 8),
(502, 'MEASUREMENT OF LAND', 5, 40),
(503, 'SUBDIV. OF AGRI. LAND', 5, 14),
(504, 'AMALGAMATION OF AGRI. LAND', 5, 14),
(505, 'SUBDIV. OF N.A. LAND', 5, 28),
(506, 'AMALGAMATION OF NA LAND', 5, 28),
(507, 'ISSUE OF CERT. COPY OF MAP TO LANDLESS LABOUR', 5, 12),
(508, 'ISSUE OF DIST.NUMBER', 5, 5),
(509, 'MEASUREMENT & CERTI. COPY OF MAY', 5, 40),
(601, 'GRANT OF LIC UN.STD OF WT&MES IA-1985', 6, 15),
(602, 'GRANT OF REG.UN.STD.OF WT&MES R-1977', 6, 15),
(603, 'ST/VER OF WT/MES ALL TY OF WT', 6, 1),
(604, 'PLATFARM SCALE', 6, 3),
(605, 'DORMANT SCALE', 6, 7),
(606, 'DISPENSING PUMP (PETROL PUMPS)', 6, 2),
(607, 'ALL TYPE OF  MEASURES', 6, 1),
(608, 'BEAM SCALES', 6, 1),
(609, 'COUNTER CENTER', 6, 1),
(610, 'ALL TYPE OF WEIGHTS', 6, 1),
(611, 'GRANT OF REPAIR LICEINCE OF W & M', 6, 1),
(612, 'REN FOR MFG LICEINCE', 6, 15),
(613, 'REN FOR DEALERS LICENCE', 6, 7),
(614, 'REN FOR REPAIRER LICEINCE', 6, 7),
(615, 'REN OF LICEINCE OF WEIGHT & MEASUREMENT', 6, 7),
(701, 'REN.OF MFG SALE, STK, & EXHI. H.INSC LIC', 7, 30),
(702, 'REN OF LIC.MFG SALE, STK, & EXHI. H.INSC LIC', 7, 10),
(703, 'GRANT OF LIC. MFG SALE, STK 7OR EXCIBIT INSECTICID', 7, 60),
(801, 'APP.  FOR GRANT OF  N.A.', 8, 90),
(802, 'GRANT OF OCCUPANCY CET.', 8, 30),
(803, 'GRANT OF CONSTRUCTION  PERMISSION (EXTE>)', 8, 90),
(804, 'GRANT OF CONSTRUCTION PREMISSION (FRESH)', 8, 90),
(805, 'GRANT OF SALE PERMISSION', 8, 90);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_no` int NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `ho_desig` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_no`, `dept_name`, `ho_desig`) VALUES
(1, 'COLLECTORATE', 'COLLECTORATE'),
(2, 'MAMLATDAR I', 'MAMLATDAR I'),
(3, 'PURCHASE AND SUPPLY OFFICE', 'PURCHASE AND SUPPLY OFFICE'),
(4, 'METEROLOGY OFFICER', 'CONTROLLER OF LEGAL METEROLOGY'),
(5, 'SURVEY AND SETTLEMENT OFFICE', 'SURVEY AND SETTLEMENT OFFICE'),
(6, 'WEIGHTS & MEASURES DEPT.', 'WEIGHTS & MEASURES DEPT.'),
(7, 'AGRICULTURE DEPARTMENT', 'AGRICULTURE DEPARTMENT'),
(8, 'MAMLATDAR II', 'MMM'),
(9, 'ATP', 'ATP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `user_type`, `password`, `district`) VALUES
(1, 'admindnh@gmail.com', 'admin', 'bece04b14b290c92145e3872f524bd3127df6f555bf271087150a02d37a9ce98', 'dnh'),
(2, 'admindaman@gmail.com', 'admin', 'bece04b14b290c92145e3872f524bd3127df6f555bf271087150a02d37a9ce98', 'daman'),
(3, 'admindiv@gmail.com', 'admin', 'bece04b14b290c92145e3872f524bd3127df6f555bf271087150a02d37a9ce98', 'diu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications_daman`
--
ALTER TABLE `applications_daman`
  ADD PRIMARY KEY (`ack_no`);

--
-- Indexes for table `applications_diu`
--
ALTER TABLE `applications_diu`
  ADD PRIMARY KEY (`ack_no`);

--
-- Indexes for table `applications_dnh`
--
ALTER TABLE `applications_dnh`
  ADD PRIMARY KEY (`ack_no`);

--
-- Indexes for table `app_type`
--
ALTER TABLE `app_type`
  ADD PRIMARY KEY (`app_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
