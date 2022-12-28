-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2022 at 12:24 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18437197_shopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `user_id`, `quantity`, `size`) VALUES
(12, 16, 1, 3, 'Medium'),
(13, 17, 1, 4, 'Small'),
(16, 16, 41, 1, 'Medium'),
(18, 17, 41, 4, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` text NOT NULL,
  `product_size` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `p_cat_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_size`, `product_img1`, `product_img2`, `product_img3`, `p_cat_id`, `date`) VALUES
(16, 'STAN SMITH WHITE ', '100', 'Small', 'Stan_Smith_Shoes_Leyko_1.jpg', 'Stan_Smith_Shoes_Leyko_2.jpg', 'Stan_Smith_Shoes_Leyko_3.jpg', 4, '2022-05-05 13:53:05'),
(17, 'MANCHESTER UNITED RED', '60', 'Large', 'Manchester_United_21-22_Home_Authentic_Jersey_Kokkino_H31090_21_model1.jpg', 'Manchester_United_21-22_Home_Authentic_Jersey_Kokkino_H31090_22_model2.jpg', 'Manchester_United_21-22_Home_Authentic_Jersey_Kokkino_H31090_23_hover_model3.jpg', 2, '2022-05-05 13:53:05'),
(18, 'TREFOIL TRACK PANTSS', '70', 'Small', 'Adicolor_Classics_Lock-Up_Trefoil_Track_Pants_Mayro_H41387_21_model1.jpg', 'Adicolor_Classics_Lock-Up_Trefoil_Track_Pants_Mayro_H41387_23_hover_model2.jpg', 'Adicolor_Classics_Lock-Up_Trefoil_Track_Pants_Mayro_H41387_25_model3.jpg', 6, '2022-05-05 13:53:05'),
(19, 'TREFOIL TEEE', '30', 'Small', 'Trefoil_Tee_Leyko_HC2137_21_model1.jpg', 'Trefoil_Tee_Leyko_HC2137_23_hover_model2.jpg', 'Trefoil_Tee_Leyko_HC2137_25_model3.jpg', 2, '2022-05-05 13:53:05'),
(23, 'BLACK RUGBY COTTON', '35', 'Large', 'All_Blacks_Rugby_Cotton_Tee_Mayro_GU3158_21_model1.jpg', 'All_Blacks_Rugby_Cotton_Tee_Mayro_GU3158_23_hover_model2.jpg', 'All_Blacks_Rugby_Cotton_Tee_Mayro_GU3158_25_model3.jpg', 2, '2022-05-05 14:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `p_cat_id` int(11) NOT NULL,
  `p_cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`p_cat_id`, `p_cat_name`) VALUES
(1, 'Jacket'),
(2, 'T-Shirt'),
(3, 'Accessories'),
(4, 'Shoes'),
(5, 'Coats'),
(6, 'Pants'),
(10, 'Shorts'),
(11, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `access`, `date`) VALUES
(1, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin', '2022-09-15 18:39:07'),
(38, 'admin2', 'admin2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin', '2022-09-15 18:39:27'),
(40, 'test', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'Member', '2022-09-15 18:39:45'),
(41, 'test2', 'test2@gmail.com', '202cb962ac59075b964b07152d234b70', 'Member', '2022-09-15 18:39:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`p_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `p_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
