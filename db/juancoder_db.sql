-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 01:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juancoder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_distributions`
--

CREATE TABLE `tbl_cash_distributions` (
  `cash_distribution_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_member_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `cash_distribution_remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distribution_date` date NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cash_distributions`
--

INSERT INTO `tbl_cash_distributions` (`cash_distribution_id`, `project_id`, `project_member_id`, `amount`, `cash_distribution_remarks`, `distribution_date`, `date_modified`) VALUES
(1, 1, 3, '1000.00', '', '2023-03-20', '2023-03-20 15:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_contact_num` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_remarks` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`client_id`, `client_name`, `client_address`, `client_contact_num`, `client_remarks`, `date_added`, `date_modified`) VALUES
(3, 'Sample Client', 'Bacolod City', '090482374', '', '2023-03-08 15:48:52', '2023-03-08 15:48:52'),
(10, 'Pepe Corp.', 'j', 'j', '', '2023-03-12 18:06:34', '2023-03-12 18:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `payment_remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_amount` decimal(9,2) NOT NULL,
  `payment_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `project_id`, `payment_remarks`, `payment_amount`, `payment_date`, `date_added`) VALUES
(1, 9, '', '900.00', '2023-03-15', '2023-03-15 16:25:43'),
(2, 1, 'dsdd sdsd s', '23.00', '2023-03-15', '2023-03-15 16:33:14'),
(3, 1, '', '1000.00', '2023-03-13', '2023-03-20 13:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_desc` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_fee` decimal(9,2) NOT NULL,
  `project_remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `date_started` date NOT NULL,
  `date_finished` date NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`project_id`, `project_name`, `client_id`, `project_desc`, `project_fee`, `project_remarks`, `status`, `delivery_date`, `date_started`, `date_finished`, `date_modified`) VALUES
(1, 'CIMD', 3, '', '17000.00', '', '', '2023-08-31', '2023-03-12', '0000-00-00', '2023-03-12 18:07:11'),
(9, 'sample', 3, 'sa', '1000.00', '', '', '2023-03-12', '2023-03-12', '0000-00-00', '2023-03-20 14:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_members`
--

CREATE TABLE `tbl_project_members` (
  `project_member_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_project_members`
--

INSERT INTO `tbl_project_members` (`project_member_id`, `project_id`, `user_id`, `roles_id`, `date_added`) VALUES
(5, 4, 3, 4, '2023-03-12 21:52:20'),
(6, 8, 3, 4, '2023-03-12 22:10:23'),
(7, 9, 3, 4, '2023-03-12 22:27:58'),
(8, 0, 3, 0, '2023-03-13 15:55:55'),
(9, 1, 3, 4, '2023-03-14 22:11:51'),
(10, 9, 4, 4, '2023-03-20 15:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roles_id` int(11) NOT NULL,
  `role_name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roles_id`, `role_name`, `remarks`, `date_added`, `date_modified`) VALUES
(4, 'Project Manager', '', '2023-03-08 21:32:45', '2023-03-08 21:32:45'),
(5, 'Mobile Developer', '', '2023-03-08 21:33:02', '2023-03-08 21:33:02'),
(7, 'Web Developer', '', '2023-03-08 21:33:21', '2023-03-08 21:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE `tbl_tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_member_id` int(11) NOT NULL,
  `task_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_started` date NOT NULL,
  `date_finished` date NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_tasks`
--

INSERT INTO `tbl_tasks` (`task_id`, `project_id`, `project_member_id`, `task_desc`, `date_started`, `date_finished`, `status`) VALUES
(1, 0, 0, '', '0000-00-00', '0000-00-00', ''),
(2, 0, 3, 'h', '0000-00-00', '0000-00-00', ''),
(3, 0, 3, 's', '0000-00-00', '0000-00-00', ''),
(4, 0, 3, 'j', '0000-00-00', '0000-00-00', ''),
(5, 0, 3, 'k', '0000-00-00', '0000-00-00', ''),
(7, 9, 3, '2', '0000-00-00', '2023-03-20', 'F'),
(10, 1, 3, '', '2023-03-14', '2023-03-14', 'F'),
(11, 1, 3, 'hh', '2023-03-14', '2023-03-14', 'F'),
(12, 9, 3, 'j', '2023-03-20', '0000-00-00', ''),
(13, 9, 3, 'k', '2023-03-07', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_contact_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_category` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A - admin; S - staff',
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fullname`, `designation`, `user_contact_number`, `user_address`, `user_category`, `username`, `password`, `date_added`, `date_modified`) VALUES
(3, 'Jeffred Lim', 'ambot', '09107980997', 'Bacolod City', 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-03-09 15:40:45', '2023-03-09 15:40:45'),
(4, 'Kaye Jacildo', 'ambot', '09260923454', 'Bacolod City', 'A', 'kaye', '0cc175b9c0f1b6a831c399e269772661', '2023-03-20 15:56:13', '2023-03-20 15:56:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cash_distributions`
--
ALTER TABLE `tbl_cash_distributions`
  ADD PRIMARY KEY (`cash_distribution_id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tbl_project_members`
--
ALTER TABLE `tbl_project_members`
  ADD PRIMARY KEY (`project_member_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cash_distributions`
--
ALTER TABLE `tbl_cash_distributions`
  MODIFY `cash_distribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_project_members`
--
ALTER TABLE `tbl_project_members`
  MODIFY `project_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
