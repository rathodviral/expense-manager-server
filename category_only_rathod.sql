-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 06:49 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exp_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_only_rathod`
--

CREATE TABLE `category_only_rathod` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_bin NOT NULL,
  `detail` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `is_expense` int(1) NOT NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category_only_rathod`
--

INSERT INTO `category_only_rathod` (`id`, `name`, `detail`, `is_expense`, `is_active`) VALUES
(1, 'Gas Bottle', 'Gas Bottle', 1, 1),
(2, 'Electricity Bill', 'Electricity Bill', 1, 1),
(3, 'House Rent', 'House Rent', 1, 1),
(4, 'Milk', 'Milk', 1, 1),
(5, 'Ghee', 'Ghee', 1, 1),
(6, 'Buttermilk', 'Buttermilk', 1, 1),
(7, 'Cheese', 'Cheese', 1, 1),
(8, 'Butter', 'Butter', 1, 1),
(9, 'Curd', 'Curd', 1, 1),
(10, 'Paneer', 'Paneer', 1, 1),
(11, 'Cream', 'Cream', 1, 1),
(12, 'Vegetables', 'Vegetables', 1, 1),
(13, 'Fruits', 'Fruits', 1, 1),
(14, 'Oil', 'Oil', 1, 1),
(15, 'Tea', 'Tea', 1, 1),
(16, 'Salt', 'Salt', 1, 1),
(17, 'Lot', 'Lot', 1, 1),
(18, 'Sugar', 'Sugar', 1, 1),
(19, 'Kathod', 'Kathod', 1, 1),
(20, 'Daal', 'Daal', 1, 1),
(21, 'Dry Fruits', 'Dry Fruits', 1, 1),
(22, 'Pohaa', 'Pohaa', 1, 1),
(23, 'Jaggery', 'Jaggery', 1, 1),
(24, 'Popcorn', 'Popcorn', 1, 1),
(25, 'Mamara', 'Mamara', 1, 1),
(26, 'Papad', 'Papad', 1, 1),
(27, 'Honey', 'Honey', 1, 1),
(28, 'Catchup', 'Catchup', 1, 1),
(29, 'Mukhvash', 'Mukhvash', 1, 1),
(30, 'Mix Hubs', 'Mix Hubs', 1, 1),
(31, 'Masala', 'Masala', 1, 1),
(32, 'Ice Cream', 'Ice Cream', 1, 1),
(33, 'Soft Drinks', 'Soft Drinks', 1, 1),
(34, 'Chocolates', 'Chocolates', 1, 1),
(35, 'Biscuits', 'Biscuits', 1, 1),
(36, 'Maggi', 'Maggi', 1, 1),
(37, 'Bread', 'Bread', 1, 1),
(38, 'Snacks', 'Snacks', 1, 1),
(39, 'Pasta', 'Pasta', 1, 1),
(40, 'Hair Oil', 'Hair Oil', 1, 1),
(41, 'Hair Sampoo', 'Hair Sampoo', 1, 1),
(42, 'Hair Color', 'Hair Color', 1, 1),
(43, 'Traveling Expenses', 'Travel', 1, 1),
(44, 'Vehical', 'Vehical', 1, 1),
(45, 'Petrol', 'Petrol', 1, 1),
(46, 'Medical', 'Medical', 1, 1),
(47, 'Dish Washer', 'Dish Washer', 1, 1),
(48, 'Bath Soap', 'Bath Soap', 1, 1),
(49, 'Mosquito Liquid', 'Bhindo', 1, 1),
(50, 'Toilet Cleaner', 'Limbu', 1, 1),
(51, 'Paper Napkin', 'Bataka', 1, 1),
(52, 'Monthly Deposit', 'Monthly Deposit', 0, 1),
(53, 'From Last Month', 'From Last Month', 0, 1),
(54, 'Sport & Excercise', 'Sport & Excercise', 1, 1),
(55, 'Recharge', 'Recharge', 1, 1),
(56, 'Hotel', 'Hotel', 1, 1),
(57, 'Gardening', 'Flowers, Plants & Pots', 1, 1),
(58, 'Maid - કામવાળા', 'કામવાળા', 1, 1),
(59, 'News Papar Bill', 'News Papar Bill', 1, 1),
(60, 'Khiru - ખીરું', 'ખીરું (ઈડલી, ઢોસા)', 1, 1),
(61, 'House Hold Items', '', 1, 1),
(62, 'Kitchen Items', 'Kitchen Items', 1, 1),
(63, 'Toothpaste', 'Toothpaste', 1, 1),
(64, 'Washing powder', 'Washing powder', 1, 1),
(65, 'Sanitary pad', 'Sanitary pad', 1, 1),
(66, 'Internet Bill', 'Internet Bill', 1, 1),
(67, 'Toiletry', 'Toiletry', 1, 1),
(68, 'Zerox', '', 1, 1),
(69, 'Floor Cleaner', '', 1, 1),
(70, 'Grooming Tools', '', 1, 1),
(71, 'Donation', 'Donation', 1, 1),
(72, 'Courier Charge', 'Courier Charge', 1, 1),
(73, 'Footwear', '', 1, 1),
(74, 'Readymade Garment', 'Readymade Garment', 1, 1),
(75, 'Garbage Bag', '', 1, 1),
(76, 'Beauty Parlour', '', 1, 1),
(77, 'Greetings', '', 1, 1),
(78, 'Talcum Powder', '', 1, 1),
(79, 'Mutual Fund Renew', 'Mutual Fund Renew', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_only_rathod`
--
ALTER TABLE `category_only_rathod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_only_rathod`
--
ALTER TABLE `category_only_rathod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
