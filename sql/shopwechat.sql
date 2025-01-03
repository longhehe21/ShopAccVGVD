-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 07:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopwechat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `cartegory_id`, `brand_name`) VALUES
(4, 3, '3 thang'),
(5, 4, 'ac thuong'),
(6, 3, '6th'),
(7, 3, '3th'),
(9, 4, 'acc vjp pro'),
(10, 6, 'gift cực chất22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartegory`
--

CREATE TABLE `tbl_cartegory` (
  `cartegory_id` int(11) NOT NULL,
  `cartegory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cartegory`
--

INSERT INTO `tbl_cartegory` (`cartegory_id`, `cartegory_name`) VALUES
(3, 'Acc Wechat'),
(4, 'Acc VGVD'),
(6, 'Gift Skin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home`
--

CREATE TABLE `tbl_home` (
  `home_id` int(11) NOT NULL,
  `home_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_home`
--

INSERT INTO `tbl_home` (`home_id`, `home_name`) VALUES
(2, 'MỪNG TẾT XẢ KHO - TÀI KHOẢN VƯƠNG GIẢ GIÁ SIÊU RẺ'),
(3, 'MỪNG TẾT - XẢ KHO TÀI KHOẢN WECHAT SIÊU RẺ NHƯ CHO'),
(4, 'MỪNG TẾT - XẢ GIFT SKIN SIÊU RẺ BÚ ĐẬM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_img`
--

CREATE TABLE `tbl_home_img` (
  `home_img_id` int(11) NOT NULL,
  `home_img_big` varchar(50) NOT NULL,
  `home_img_small` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `home_id` int(11) NOT NULL,
  `product_sale` int(11) NOT NULL,
  `product_images` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_price_new` varchar(255) NOT NULL,
  `product_desc` varchar(10000) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`home_id`, `product_sale`, `product_images`, `product_id`, `product_name`, `cartegory_id`, `brand_id`, `product_price`, `product_price_new`, `product_desc`, `product_img`) VALUES
(0, 0, 'uploads/Logo-DaDaShop-1.png', 62, 'Acc wechat 6 tháng', 3, 6, '2354423', '34342', '<p>hihi hehe</p>', 'long.jpg'),
(0, 0, 'uploads/Screenshot 2024-01-31 231032 - Copy - Copy.png#uploads/Screenshot 2024-01-31 231032 - Copy (2) - Copy.png#uploads/Screenshot 2024-01-31 231032 - Copy (2).png', 63, 'acc vương giả vjp', 4, 9, '3333', '143453', '<p>agagafggfdgag</p>', 'Screenshot 2024-02-12 125320.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `password`, `email`, `role`) VALUES
(10, '$2y$10$SO7VDu0l0vvQdoj8x08H2uSVF6UpFMfsoA5mJj83Gt1DEy/0O4lxO', 'admin@gmail.com', 1),
(11, '$2y$10$16BPHcr0ijTmGZ.2V2xXGOqR9UJ35SjRVB6OW6/8MvzMe5Bxq1Zm2', 'htl20122003@gmail.com', 0),
(12, '$2y$10$wXNv51dRjnODAZjAwFsXiehbnAIkbK1UYUZfQEcalEd5HeAJUeCi2', '20122003@gmail.com', 0),
(13, '$2y$10$v2TNvktl7KZtuAXb2eqcGufmeEA1Kljy8.LKwN0BDKCyqVqqx/.rG', 'congthe2003@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  ADD PRIMARY KEY (`cartegory_id`);

--
-- Indexes for table `tbl_home`
--
ALTER TABLE `tbl_home`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `tbl_home_img`
--
ALTER TABLE `tbl_home_img`
  ADD PRIMARY KEY (`home_img_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_home`
--
ALTER TABLE `tbl_home`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_home_img`
--
ALTER TABLE `tbl_home_img`
  MODIFY `home_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
