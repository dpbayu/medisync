-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.byetcluster.com
-- Generation Time: Jun 09, 2024 at 01:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_35441725_medisync`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `name_admin` varchar(50) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `profile_admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `id_user`, `name_admin`, `email_admin`, `password_admin`, `profile_admin`) VALUES
(1, 'd558e35a-318d-4605-8d98-6df32b8962cf', 'Dwi Putra Bayu', 'bayu@gmail.com', '$2y$10$CgAN8xj/z5ap05l3mcx2i.DyHaJqlIU8nTB/gKELDW3fjuowyVyeC', 'Bayu 2.jpeg'),
(2, '0c5548d7-00f9-4d5d-948a-f20fd7cee341', 'Syifa Khairunnisa', 'syifa@gmail.com', '$2y$10$oPhKWpdokFlyzBgXoTD8EeardutZePK0kgYoAMthkp.hMnXoLkW5K', 'Web capture_9-10-2023_233250_www.instagram.com.jpeg'),
(4, 'ae9297b6-6ede-429e-ba45-3f6410563d03', 'Silaindi', 'sila@gmail.com', '$2y$10$ksSdsqzrIRy7XLNBQmfVfuxwFOWeInLxFk0JcK24PxZ30.LpdtcuO', 'Web capture_28-10-2023_61724_www.instagram.com.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE `tbl_doctor` (
  `id` int(11) NOT NULL,
  `id_doctor` varchar(100) NOT NULL,
  `name_doctor` varchar(225) NOT NULL,
  `email_doctor` varchar(255) NOT NULL,
  `password_doctor` varchar(255) NOT NULL,
  `id_specialist` varchar(50) NOT NULL,
  `address_doctor` text NOT NULL,
  `phone_doctor` varchar(15) NOT NULL,
  `profile_doctor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_doctor`
--

INSERT INTO `tbl_doctor` (`id`, `id_doctor`, `name_doctor`, `email_doctor`, `password_doctor`, `id_specialist`, `address_doctor`, `phone_doctor`, `profile_doctor`) VALUES
(1, '34e61663-73f6-4b03-b55b-9dd48b3954a0', 'Eren Yeager', 'eren@gmail.com', '$2y$10$IgYy.Ee7W5bDBf7Cp.xEoea1B/d8RxcHVvzB4E8ci2UikpxAzFd7y', '1c1fbfe2-cd3a-11ed-bbfa-b4a9fcffb61c', 'Konohagakure', '0896043335789', 'Eren.jpeg'),
(2, 'db881baa-cc83-43c2-85e3-98805850141b', 'Mikasa Ackerman', 'mikasa@gmail.com', '$2y$10$t.sEtq4DP5sg7SOlEbNwReJDaz.BztT1RTq8emQwlSwcwCsiuOEuO', '1c1fb5da-cd3a-11ed-bbfa-b4a9fcffb61c', 'Cocoyashi Village', '089604333575', 'Mikasa 1.jpg'),
(3, '7083507b-e00e-48f3-8c40-be7ea2633512', 'Tony Tony Chopper', 'tony@gmail.com', '$2y$10$VIsZ8t93B7q41vYCjOStzOwwjiCKi7f/nGQmPLDYCrpsVT4QXfq1i', '3038e55f-5539-4360-bb44-7da1f43e101f', 'Sakura Kingdom', '08960433587', 'chopper.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital_medicine`
--

CREATE TABLE `tbl_hospital_medicine` (
  `id` int(11) NOT NULL,
  `id_hospital` int(11) NOT NULL,
  `id_medicine` varchar(50) NOT NULL,
  `qty_medicine` varchar(255) NOT NULL,
  `price_medicine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hospital_medicine`
--

INSERT INTO `tbl_hospital_medicine` (`id`, `id_hospital`, `id_medicine`, `qty_medicine`, `price_medicine`) VALUES
(1, 1, '09a7b207-40fe-4077-8fff-8787b6688bd0', '5', 5500),
(2, 1, 'f68d912e-ec37-4e8d-94f8-d80622f3d65f', '10', 20000),
(3, 2, 'f68d912e-ec37-4e8d-94f8-d80622f3d65f', '5', 20000),
(4, 2, '09a7b207-40fe-4077-8fff-8787b6688bd0', '5', 5500),
(5, 3, '94ca103b-470d-401e-bf1f-2a3bd94500ef', '12', 30000),
(6, 3, 'dca87eaa-79b9-4318-bb01-2824a36200c5', '6', 65000),
(7, 3, 'f68d912e-ec37-4e8d-94f8-d80622f3d65f', '6', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medical_record`
--

CREATE TABLE `tbl_medical_record` (
  `id_hospital` int(11) NOT NULL,
  `id_patient` varchar(50) NOT NULL,
  `illness` text NOT NULL,
  `id_doctor` varchar(50) NOT NULL,
  `diagnosis` text NOT NULL,
  `id_poly` varchar(50) NOT NULL,
  `check_up` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medical_record`
--

INSERT INTO `tbl_medical_record` (`id_hospital`, `id_patient`, `illness`, `id_doctor`, `diagnosis`, `id_poly`, `check_up`) VALUES
(1, '5a1994bb-0250-4aa3-beba-29447311f064', '<p>Fever</p>', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '<ol>\r\n<li>Out of breath</li>\r\n<li>Headaches</li>\r\n<li>Nauseous</li>\r\n</ol>', '900ff3ff-52dc-436e-9c5a-83425f37f722', '2023-11-17'),
(2, '77083b9b-2ff7-4ae3-b32d-7303cccb6e68', '<p>Sore throat</p>', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '<ol>\r\n<li>Cough</li>\r\n<li>Ulcer</li>\r\n</ol>', '900ff3ff-52dc-436e-9c5a-83425f37f722', '2023-11-18'),
(3, '5a1994bb-0250-4aa3-beba-29447311f064', '<p>Bleeding gums</p>', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '<p>Canker sores on the tongue</p>', 'd4d133a4-d585-4c29-8cdf-e6046bd968d5', '2023-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine`
--

CREATE TABLE `tbl_medicine` (
  `id_medicine` varchar(50) NOT NULL,
  `name_medicine` varchar(255) NOT NULL,
  `description_medicine` text NOT NULL,
  `stock_medicine` varchar(255) NOT NULL,
  `price_medicine` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medicine`
--

INSERT INTO `tbl_medicine` (`id_medicine`, `name_medicine`, `description_medicine`, `stock_medicine`, `price_medicine`) VALUES
('09a7b207-40fe-4077-8fff-8787b6688bd0', 'Paracetamol', 'Fever', '15', 5500),
('148ff283-3687-45bb-b12b-7687fc52caaa', 'Acetazolamide', 'Glaucoma, Epilepsy or Altitude Sickness', '10', 100000),
('19c74196-b2d4-4de9-a9ae-220d9376d58e', 'Ranitidin', 'Reduces excess stomach acid production', '25', 20000),
('25d84410-b8a9-4b1b-8fd1-458e6d58b754', 'Klomifen', 'Medicines to treat infertility or infertility in women who experience ovulation disorders', '35', 23000),
('4846759e-04ff-49ca-88ee-2977a1a21e5d', 'Abacavir', 'HIV Infection', '5', 695000),
('4fcdb2f7-bb21-4d8e-874f-7c73102c7bd1', 'Antihistamin', 'Alergi', '48', 60000),
('5947aa9d-f5da-4c40-95ab-80f9eb8ba109', 'Paliperidone', 'Skizofrenia', '80', 57000),
('5b4b06d3-f861-46c0-b6d9-3e5f39cccb51', 'Stavudin', 'Reduces the number of HIV viruses in the body', '75', 69000),
('5bf32014-c1ca-4e57-9f15-47a90217a24d', 'Ambroxol', 'Thinning phlegm', '100', 5000),
('94ca103b-470d-401e-bf1f-2a3bd94500ef', 'Vitamin B', 'Helps maintain the health and function of body organs, such as maintaining the digestive system and helping cell development', '38', 30000),
('d811aafa-eaa6-431b-bb40-9110c3493aac', 'Antasida', 'Maag', '13', 2000),
('dca87eaa-79b9-4318-bb01-2824a36200c5', 'Zinc', 'Strengthens the body\'s resistance, relieves inflammation, and accelerates wound healing', '74', 65000),
('f68d912e-ec37-4e8d-94f8-d80622f3d65f', 'Vitamin C', 'Vitamin C deficiency', '29', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_owner`
--

CREATE TABLE `tbl_owner` (
  `id` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `name_owner` varchar(255) NOT NULL,
  `email_owner` varchar(255) NOT NULL,
  `password_owner` varchar(255) NOT NULL,
  `profile_owner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_owner`
--

INSERT INTO `tbl_owner` (`id`, `id_user`, `name_owner`, `email_owner`, `password_owner`, `profile_owner`) VALUES
(1, '5f41259b-d1ad-11ed-b3e4-b4a9fcffb61c', 'Anya Taylor-Joy', 'anya@gmail.com', '$2y$10$V3TJ2I.KcYm0D//9Sp9qS.eABQdk7zlmS4CPwojfXjF5Lwj1VQ.ES', 'Anya Taylor-Joy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `id_patient` varchar(50) NOT NULL,
  `nik_patient` varchar(30) NOT NULL,
  `name_patient` varchar(255) NOT NULL,
  `email_patient` varchar(255) NOT NULL,
  `password_patient` varchar(255) NOT NULL,
  `gender_patient` varchar(10) NOT NULL,
  `address_patient` text NOT NULL,
  `phone_patient` varchar(15) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `blood_patient` varchar(2) NOT NULL,
  `religion_patient` varchar(255) NOT NULL,
  `marriage_patient` varchar(255) NOT NULL,
  `profile_patient` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id_patient`, `nik_patient`, `name_patient`, `email_patient`, `password_patient`, `gender_patient`, `address_patient`, `phone_patient`, `birth_date`, `birth_place`, `blood_patient`, `religion_patient`, `marriage_patient`, `profile_patient`) VALUES
('5a1994bb-0250-4aa3-beba-29447311f064', '41815010140', 'Chou Tzuyu', 'tzuyu@gmail.com', '$2y$10$0F7Tonk6L5ip3E0yWljBveY29YXuPIwzlPltSx8XLT/JuDmM2oUzu', 'Woman', 'Taipei, Taiwan', '089604333578', '1994-10-29', 'New Taipei', 'B', 'Islam', 'Not Married', ''),
('762860c9-18ff-4bed-ac59-f1a713593c56', '41815010145', 'Giselle', 'giselle@gmail.com', '$2y$10$htQFUB76QwqW7h7i9RJd7uPvgV9f3ZgXNW0QlbmTaNzJBE593J.Ze', 'Woman', 'Surabaya, Indonesia', '0896043367', '1994-10-09', 'Canada', 'B', 'Chatolic', 'Widower', ''),
('77083b9b-2ff7-4ae3-b32d-7303cccb6e68', '41815010120', 'Winter', 'winter@gmail.com', '$2y$10$jmJiB2TcA8m5u9ywoQ61FOIk3qToOBvA5QaT4lcKmMq6j7jy15Pv2', 'Woman', 'Paris, France', '089604333523', '2000-05-15', 'Kuala Lumpur', 'O', 'Islam', 'Not Married', 'Winter 1.jpg'),
('daf90ef9-5c75-4353-95a9-e9af018788f2', '41815010130', 'Irene', 'irene@gmail.com', '$2y$10$iirGZJYn6S/0HFkMA6gpgOHVjnLHQ/HzIxHGakQLr24Pjafs16SQu', 'Woman', 'Milan, Italy', '089604333526', '1991-02-20', 'Venice', 'AB', 'Hindu', 'Not Married', 'Irene 1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacist`
--

CREATE TABLE `tbl_pharmacist` (
  `id` int(11) NOT NULL,
  `id_hospital` int(11) NOT NULL,
  `id_patient` varchar(50) NOT NULL,
  `id_doctor` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `check_up` date NOT NULL,
  `total_medicine` text NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pharmacist`
--

INSERT INTO `tbl_pharmacist` (`id`, `id_hospital`, `id_patient`, `id_doctor`, `birth_date`, `check_up`, `total_medicine`, `total_price`) VALUES
(1, 1, '5a1994bb-0250-4aa3-beba-29447311f064', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '1994-10-29', '2023-11-17', 'Paracetamol (5 x Rp 5.500 ) <br> Vitamin C (10 x Rp 20.000 ) <br> ', 455000),
(2, 2, '77083b9b-2ff7-4ae3-b32d-7303cccb6e68', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '2000-05-15', '2023-11-18', 'Vitamin C (5 x Rp 20.000 ) <br> Paracetamol (5 x Rp 5.500 ) <br> ', 255000),
(3, 3, '5a1994bb-0250-4aa3-beba-29447311f064', '34e61663-73f6-4b03-b55b-9dd48b3954a0', '1994-10-29', '2023-11-18', 'Vitamin B (12 x Rp 30.000 ) <br> Zinc (6 x Rp 65.000 ) <br> Vitamin C (6 x Rp 20.000 ) <br> ', 1740000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poly`
--

CREATE TABLE `tbl_poly` (
  `id_poly` varchar(50) NOT NULL,
  `name_poly` varchar(50) NOT NULL,
  `desc_poly` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_poly`
--

INSERT INTO `tbl_poly` (`id_poly`, `name_poly`, `desc_poly`) VALUES
('48519f64-c564-46e9-9cca-25e0b23cccdf', 'Pediatric Poly', '1'),
('6fc1516b-9381-4b20-a0c2-d517af138620', 'OBGYN Poly', '5'),
('900ff3ff-52dc-436e-9c5a-83425f37f722', 'General Poly', '2'),
('959e3ca9-402b-43ea-83d2-fc87f477fb5d', 'E.N.T', '1'),
('d4d133a4-d585-4c29-8cdf-e6046bd968d5', 'Dentistry Poly', '4'),
('fc7924e9-01ff-46fb-bde3-a25e487a14b2', 'Infection Poly', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specialist`
--

CREATE TABLE `tbl_specialist` (
  `id_specialist` varchar(50) NOT NULL,
  `name_specialist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_specialist`
--

INSERT INTO `tbl_specialist` (`id_specialist`, `name_specialist`) VALUES
('0e2814a5-444b-4e6a-bcf0-5e6c7e337985', 'Anesthetic'),
('1c1fb5da-cd3a-11ed-bbfa-b4a9fcffb61c', 'Neurologist'),
('1c1fbfe2-cd3a-11ed-bbfa-b4a9fcffb61c', 'Pediatrician'),
('1eff1a2a-50f7-4a33-a6ea-c4a524340997', 'Neurosurgery'),
('3038e55f-5539-4360-bb44-7da1f43e101f', 'Dentist'),
('3a84e784-bd37-49af-a450-7f4d891876d3', 'Nutritionist'),
('9445be39-570c-4ada-985d-51f9a307ac04', 'Radiologist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `email`, `role`) VALUES
('0c5548d7-00f9-4d5d-948a-f20fd7cee341', 'syifa@gmail.com', 'Admin'),
('34e61663-73f6-4b03-b55b-9dd48b3954a0', 'eren@gmail.com', 'Doctor'),
('5a1994bb-0250-4aa3-beba-29447311f064', 'tzuyu@gmail.com', 'Patient'),
('5f41259b-d1ad-11ed-b3e4-b4a9fcffb61c', 'anya@gmail.com', 'Owner'),
('7083507b-e00e-48f3-8c40-be7ea2633512', 'tony@gmail.com', 'Doctor'),
('762860c9-18ff-4bed-ac59-f1a713593c56', 'giselle@gmail.com', 'Patient'),
('77083b9b-2ff7-4ae3-b32d-7303cccb6e68', 'winter@gmail.com', 'Patient'),
('ae9297b6-6ede-429e-ba45-3f6410563d03', 'velika@gmail.com', 'Admin'),
('d558e35a-318d-4605-8d98-6df32b8962cf', 'bayu@gmail.com', 'Admin'),
('daf90ef9-5c75-4353-95a9-e9af018788f2', 'irene@gmail.com', 'Patient'),
('db881baa-cc83-43c2-85e3-98805850141b', 'mikasa@gmail.com', 'Doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_specialist` (`id_specialist`),
  ADD KEY `id_user` (`id_doctor`);

--
-- Indexes for table `tbl_hospital_medicine`
--
ALTER TABLE `tbl_hospital_medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medicine` (`id_medicine`),
  ADD KEY `id_hospital` (`id_hospital`);

--
-- Indexes for table `tbl_medical_record`
--
ALTER TABLE `tbl_medical_record`
  ADD PRIMARY KEY (`id_hospital`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_poly` (`id_poly`);

--
-- Indexes for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  ADD PRIMARY KEY (`id_medicine`);

--
-- Indexes for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Indexes for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hospital` (`id_hospital`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_patient` (`id_patient`);

--
-- Indexes for table `tbl_poly`
--
ALTER TABLE `tbl_poly`
  ADD PRIMARY KEY (`id_poly`);

--
-- Indexes for table `tbl_specialist`
--
ALTER TABLE `tbl_specialist`
  ADD PRIMARY KEY (`id_specialist`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_hospital_medicine`
--
ALTER TABLE `tbl_hospital_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_medical_record`
--
ALTER TABLE `tbl_medical_record`
  MODIFY `id_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  ADD CONSTRAINT `tbl_doctor_ibfk_1` FOREIGN KEY (`id_specialist`) REFERENCES `tbl_specialist` (`id_specialist`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_doctor_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_hospital_medicine`
--
ALTER TABLE `tbl_hospital_medicine`
  ADD CONSTRAINT `tbl_hospital_medicine_ibfk_1` FOREIGN KEY (`id_hospital`) REFERENCES `tbl_medical_record` (`id_hospital`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_medical_record`
--
ALTER TABLE `tbl_medical_record`
  ADD CONSTRAINT `tbl_medical_record_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `tbl_doctor` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_medical_record_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `tbl_patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_medical_record_ibfk_3` FOREIGN KEY (`id_poly`) REFERENCES `tbl_poly` (`id_poly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD CONSTRAINT `tbl_owner_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD CONSTRAINT `tbl_patient_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  ADD CONSTRAINT `tbl_pharmacist_ibfk_1` FOREIGN KEY (`id_hospital`) REFERENCES `tbl_medical_record` (`id_hospital`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pharmacist_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `tbl_doctor` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pharmacist_ibfk_3` FOREIGN KEY (`id_patient`) REFERENCES `tbl_patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
