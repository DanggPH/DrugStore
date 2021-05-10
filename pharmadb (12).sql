-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 10, 2021 lúc 09:51 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pharmadb`
--
CREATE DATABASE IF NOT EXISTS `pharmadb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pharmadb`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountad`
--

DROP TABLE IF EXISTS `accountad`;
CREATE TABLE IF NOT EXISTS `accountad` (
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accountad`
--

INSERT INTO `accountad` (`username`, `password`, `email`, `fullname`, `birthday`, `sex`, `level`) VALUES
('admin', '123456', 'vqtoan1807@gmail.com', 'dsgveadsga', '2021-04-20', 1, 100),
('vqtoan1807', '18072000', 'vqtoan1807@gmail.com', 'Võ Quốc Toàn', '2000-07-18', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountcus`
--

DROP TABLE IF EXISTS `accountcus`;
CREATE TABLE IF NOT EXISTS `accountcus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `usernameCus` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `phonenumber` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `cart` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accountcus`
--

INSERT INTO `accountcus` (`ID`, `usernameCus`, `password`, `email`, `fullname`, `sex`, `phonenumber`, `cart`, `created_at`, `updated_at`) VALUES
(10, 'highquas', '9d6b5c65a22950c07c62b3e7a80be480', 'highquas@gmail.com', 'Lên Vủ Mạnh', 0, '0983243953', '', '2021-05-03 20:11:43', '2021-05-03 20:11:43'),
(11, 'wtf', 'a970a7e3b359f88a4732b56050822888', 'wtf@gmail.com', 'wtf', 0, '0123456789', '[{\"name\":\"máy tính cơ\",\"price\":\"900000 VNĐ\",\"quality\":\"1\",\"image\":\"admin/images/máy tính cơFB_IMG_1599402426667.jpg\"}]', '2021-05-04 13:54:30', '2021-05-04 13:54:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address1`
--

DROP TABLE IF EXISTS `address1`;
CREATE TABLE IF NOT EXISTS `address1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCus` int(11) NOT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `street1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCus1` (`idCus`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `address1`
--

INSERT INTO `address1` (`id`, `idCus`, `province`, `district`, `street1`, `street2`) VALUES
(5, 10, 'Đồng Tháp', 'Thành phố Cao Lãnh', 'nhà bán 12 pro max', ''),
(6, 11, 'An Giang', 'Thành phố Long Xuyên', 'abc', 'xyz');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logolink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `logolink`, `created_at`, `updated_at`) VALUES
(22, 'BRAUER', 'BRAUERenvato.png', '2021-05-03 20:01:03', '2021-05-03 20:01:03'),
(23, 'colgate', 'colgatephotodune.png', '2021-05-03 20:52:07', '2021-05-03 20:52:07'),
(24, 'blackmores', 'blackmoresthemeforest.png', '2021-05-03 20:20:08', '2021-05-03 20:20:08'),
(25, 'La Roche-posay', 'La Roche-posayactiveden.png', '2021-05-03 20:55:31', '2021-05-03 20:55:31'),
(26, 'Durex', 'Durex302eda25c2677cbd5d4b20eaf8eb1a8a.png', '2021-05-03 22:56:15', '2021-05-03 22:56:15'),
(27, 'Diana', 'Dianadownload.png', '2021-05-03 22:34:16', '2021-05-03 22:34:16'),
(28, 'PS', 'PSCapture.PNG', '2021-05-03 22:36:18', '2021-05-03 22:36:18'),
(29, 'Kotex', 'Kotexdownload (1).png', '2021-05-03 22:05:20', '2021-05-03 22:05:20'),
(30, 'Okamoto', 'Okamotodownload (2).png', '2021-05-03 22:28:22', '2021-05-03 22:28:22'),
(31, 'Que thử thai chip chip', 'Que thử thai chip chipchipchop logo final.jpg', '2021-05-04 11:57:18', '2021-05-04 11:57:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IDaccount` int(11) DEFAULT NULL,
  `idproduct` int(11) NOT NULL,
  `summary` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `voted` decimal(2,1) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_comment` (`idproduct`),
  KEY `fk_idcus` (`IDaccount`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE IF NOT EXISTS `orderdetail` (
  `Idodertable` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  PRIMARY KEY (`Idodertable`,`idproduct`),
  KEY `fk_IdProduct` (`idproduct`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`Idodertable`, `idproduct`, `quality`) VALUES
(22, 52, 1),
(25, 57, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ordertable`
--

DROP TABLE IF EXISTS `ordertable`;
CREATE TABLE IF NOT EXISTS `ordertable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDcus` int(11) NOT NULL,
  `idAddress` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_idCusOder` (`IDcus`),
  KEY `fk_address` (`idAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ordertable`
--

INSERT INTO `ordertable` (`ID`, `IDcus`, `idAddress`, `created_at`, `status`) VALUES
(22, 10, 5, '2021-05-04 15:14:28', 0),
(25, 10, 5, '2021-05-10 09:25:32', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandid` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `des_product` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `price_old` float NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brandid` (`brandid`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `brandid`, `name`, `des_product`, `price`, `price_old`, `image`, `amount`, `created_at`, `updated_at`) VALUES
(52, 28, 'Kem đánh răng PS Bé Ngoan hương dâu', 'Kem đánh răng P/S trẻ em hương dâu 35g với thành phần chứa Canxi và Flour giúp mẹ làm sạch nhẹ nhàng loại bỏ mảng bám mà không ảnh hưởng đến men răng hay nướu lợi của bé. - Hàm lượng Vitamin E có trong kem đánh răng sẽ nhẹ nhàng chăm sóc răng và nướu cho bé mối ngày. Sản phẩm bảo vệ và chăm sóc răng nướu cho bé hằng ngày - Kem đánh răng P/S dành cho trẻ em không chứa đường gây hại cho răng, đây là điểm đặc biệt của sản phẩm và kem đánh răng P/S được các mẹ tin tưởng và cho bé sử dụng. Hướng dẫn sử dụng và bảo quản: Chải răng ít nhất 2 lần mỗi ngày hoặc theo hướng dẫn của nha sĩ. Dùng đủ ít nhất 1g kem đánh răng (bằng hạt đậu) Trẻ em dưới 6 tuổi cần đánh răng dưới sự giám sát của người lớn. Tham khảo ý kiến bác sĩ khi nuốt phải. Đậy nắp sau khi sử dụng. Bảo quản nơi khô ráo, thoáng mát. Tránh ánh nắng trực tiếp. Lưu ý Dùng lượng kem bằng hạt đậu nhỏ, trẻ dưới 6 tuổi cần sự hướng dẫn của người lớn Hạn sử dụng: 3 năm kể từ ngày sản xuất', 50000, 50000, 'Kem đánh răng PS Bé Ngoan hương dâuUntitled.png', 1, '2021-05-04 14:16:56', '2021-05-04 17:09:02'),
(54, 26, 'Ultra Performing', '', 170, 170, 'Ultra PerformingUltra PerformingP19386_2_l-300x300.jpg', 120, '2021-05-04 16:38:42', '2021-05-04 17:13:52'),
(57, 23, 'Nước súc miệng hương bạc hà Colgate Plax', 'Nước súc miệng hương bạc hà Colgate Plax sử dụng sau khi đánh răng đem đến hơi thở thơm mát, ngăn ngừa vi khuẩn gây sâu răng đến 99% đồng thời mang đến cảm giác sảng khoái và tự tin suốt cả ngày.', 25000, 25000, 'Nước súc miệng hương bạc hà Colgate PlaxP12632_1_l.jpg', 9, '2021-05-04 16:42:48', '2021-05-04 16:42:48'),
(58, 23, 'Bàn chải đánh răng Colgate Cushion Clean', '<p>Creating an editor using a CKEditor 5 build is very simple and can be described in two steps:</p><ol><li>Load the desired editor via the &lt;script&gt; tag.</li><li>Call the static create() method to create the editor.</li></ol><p>There are other installation and integration methods available. For more information check <a href=\"https://ckeditor.com/docs/ckeditor5/latest/builds/guides/integration/installation.html\">Installation</a> and <a href=\"https://ckeditor.com/docs/ckeditor5/latest/builds/guides/integration/basic-api.html\">Basic API</a> guides.</p><h2>Classic editor</h2>', 150000, 150000, 'Bàn chải đánh răng Colgate Cushion CleanP20093_1_l.jpg', 1000, '2021-05-04 16:16:49', '2021-05-10 08:35:09'),
(62, 23, 'Kem đánh răng colgate SENSITIVE', '', 50000, 50000, 'Kem đánh răng colgate SENSITIVEUntitled2.png', 50, '2021-05-04 17:04:17', '2021-05-04 17:04:17');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `address1`
--
ALTER TABLE `address1`
  ADD CONSTRAINT `idCus1` FOREIGN KEY (`idCus`) REFERENCES `accountcus` (`ID`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`idproduct`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_idcus` FOREIGN KEY (`IDaccount`) REFERENCES `accountcus` (`ID`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `fk_IdOrder` FOREIGN KEY (`Idodertable`) REFERENCES `ordertable` (`ID`);

--
-- Các ràng buộc cho bảng `ordertable`
--
ALTER TABLE `ordertable`
  ADD CONSTRAINT `fk_idCusOder` FOREIGN KEY (`IDcus`) REFERENCES `accountcus` (`ID`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_brandid` FOREIGN KEY (`brandid`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
