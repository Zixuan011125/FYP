-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 02:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forever18`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Zixuan@1125');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `services` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `services`, `phone`, `date`, `time`) VALUES
(44, 'Leena', 'leena@gmail.com', 'Hair Colorings, Hair & Scalp Treatment With Organic Essential Oils', '011-20715887', '2024-02-23', '04:00 PM'),
(45, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair & Scalp Treatment With Organic Essential Oils', '011-20715887', '2024-05-07', '01:30 PM'),
(49, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair Colorings', '011-20715887', '2024-03-13', '12:30 PM'),
(50, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair Cutting', '011-20715887', '2024-03-13', '12:00 PM'),
(51, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair & Scalp Treatment With Organic Essential Oils', '011-20715887', '2024-03-13', '11:00 AM'),
(52, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair Colorings', '011-20715887', '2024-03-11', '04:00 PM'),
(53, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair Cutting', '011-20715887', '2024-04-02', '12:30 PM'),
(54, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', 'Hair Colorings', '011-20715887', '2024-04-02', '01:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `services` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `services`, `date`) VALUES
(12, 'Leena', 'leena@gmail.com', '011-20715887', 'By Senior Stylist, Regrowth, For Oily Scalp', '2024-03-10 09:44:42'),
(13, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', '011-20715887', 'By Senior Stylist, Highlight (Whole Head), For Dry Scalp', '2024-03-10 09:45:36'),
(14, 'Khoo Zi Xuan', 'zxkhoo141132@gmail.com', '011-20715887', 'By Senior Stylist, For Dry Scalp', '2024-03-18 05:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(10) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `salary` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `age`, `phone`, `salary`) VALUES
(2, 'Khoo Zi Xuan', 23, '011-20715887', 9000),
(3, 'Leena Sazleena', 22, '010-12345678', 8888),
(7, 'Jia Hui', 21, '011-2345654', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `invoices_number` int(10) NOT NULL,
  `services` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `invoices_number`, `services`, `date`, `total_cost`) VALUES
(7, 12, 716165, 'By Senior Stylist, Regrowth, For Oily Scalp', '2024-03-10 09:44:45', 260),
(8, 13, 608726, 'By Senior Stylist, Highlight (Whole Head), For Dry Scalp', '2024-03-10 09:45:47', 355),
(9, 14, 306995, 'By Senior Stylist, For Dry Scalp', '2024-03-18 05:10:38', 180),
(10, 12, 754291, 'By Senior Stylist, Regrowth, For Oily Scalp', '2024-03-19 03:16:34', 260);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rating` int(10) NOT NULL,
  `review` text NOT NULL,
  `reply_review` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `review`, `reply_review`, `time`) VALUES
(3, 'Xuan', 4, 'Nice', 'Please come again', '2024-02-25 06:43:35'),
(4, 'Leena', 2, 'Improve the services', 'Thanks for your comment!', '2024-02-25 06:42:58'),
(5, 'Khoo Zi Xuan', 5, 'Will come again', '', '2024-03-09 13:04:15'),
(6, 'Xuan', 0, 'Good Services', '', '2024-03-18 05:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `date`) VALUES
(1, 'Hair Cutting', '2024-02-20 11:13:33'),
(34, 'Hair Colorings', '2024-02-21 03:28:31'),
(37, 'Hair & Scalp Treatment With Organic Essential Oils', '2024-03-05 08:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `sub_services`
--

CREATE TABLE `sub_services` (
  `id` int(10) NOT NULL,
  `main_service_id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_services`
--

INSERT INTO `sub_services` (`id`, `main_service_id`, `name`, `cost`) VALUES
(18, 1, 'By Senior Stylist', 30),
(20, 1, 'By Stylist', 24),
(22, 34, 'Regrowth', 80),
(28, 34, 'Whole Head', 95),
(29, 34, 'Highlight (Half Head)', 120),
(30, 34, 'Highlight (Whole Head)', 175),
(31, 37, 'For Dry Scalp', 150),
(32, 37, 'For Sensitive Scalp', 150),
(33, 37, 'For Oily Scalp', 150),
(39, 37, 'For Dandruff', 150);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(20, 'Leena', 'leena@gmail.com', '$2y$10$9oTtj5VBjkmOICh.e/EqWO4MFy1Ad3N11L7n8sUtBjQbBg5thcUgi'),
(25, 'Zi Xuan', 'zxkhoo141132@gmail.com', '$2y$10$8Yo13E76BXyKwZ.6nEPDxOMRj90KNFHnJdJRxIE93YqxQRVJJmfy.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_service_id` (`main_service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `sub_services`
--
ALTER TABLE `sub_services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD CONSTRAINT `sub_services_ibfk_1` FOREIGN KEY (`main_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
