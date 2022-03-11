-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2019 年 07 月 06 日 02:51
-- 伺服器版本： 10.1.39-MariaDB
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `orderplatform`
--

-- --------------------------------------------------------

--
-- 資料表結構 `audit_company`
--

CREATE TABLE `audit_company` (
  `id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL COMMENT '填寫人帳號',
  `user_display_name` varchar(50) DEFAULT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `company_profile` text NOT NULL,
  `billing_time` varchar(30) NOT NULL COMMENT '建檔時間',
  `admin_acc` varchar(50) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `last_modified_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `audit_company`
--

INSERT INTO `audit_company` (`id`, `company_id`, `type`, `status`, `title`, `user_id`, `user_display_name`, `phone`, `address`, `company_profile`, `billing_time`, `admin_acc`, `admin_name`, `last_modified_time`) VALUES
(1, '1', 'dist', 0, 'test_dist', '', NULL, '0123456789', 'dqwdw', 'wdqwdwq', '20190429171614', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '2019-06-04 15:59:16'),
(2, '2', 'dist', 1, '0509_test_c', '', NULL, '', '', '', '20190509165857', 'admin_acc', NULL, '2019-05-09 17:05:45'),
(3, '3', 'dist', 1, '0509_test_dist_c_2', '', NULL, '', '', '', '20190509173044', 'admin_acc', NULL, '2019-05-23 20:32:38'),
(4, '4', 'dist', 1, '0509_test_dist_c_2', '', NULL, '', '', '', '20190509173149', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '2019-05-30 11:32:33'),
(5, '5', 'dist', 1, '0509_test_dist_c_3', '', NULL, '', '', '', '20190509173704', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '2019-05-30 11:17:27'),
(6, '6', 'dist', 1, '0509_test_dist_c_4', '', NULL, '', '', '', '20190509173742', 'admin_acc', NULL, '2019-05-09 18:09:13'),
(7, '7', 'dist', 1, '0509_test_dist_c_5', '', NULL, '', '', '', '20190509173854', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', '2019-05-30 11:32:58'),
(8, '8', 'farm', 1, 'test_farm_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1234567890', '															高雄111															dqdwqwd																												', '																														dqqw																												', '20190524124706', 'admin_acc', NULL, '2019-06-04 12:20:41'),
(9, '9', 'farm', 1, '123農場', NULL, NULL, '', '', '', '20190530110216', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', '2019-05-30 11:38:21'),
(10, '10', 'farm', 0, 'test_farm_c', NULL, NULL, '1234567890', '高雄', '															dqqw														', '20190604115342', NULL, NULL, '2019-06-04 11:53:42'),
(11, '11', 'dist', 0, '', NULL, NULL, '', '', '', '20190605140809', NULL, NULL, '2019-06-05 14:08:09'),
(12, '12', 'dist', 0, '', NULL, NULL, '', '', '', '20190605141318', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '2019-06-05 14:13:21');

-- --------------------------------------------------------

--
-- 資料表結構 `audit_user`
--

CREATE TABLE `audit_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT 'unreviewed',
  `status` varchar(10) NOT NULL DEFAULT '0',
  `user_display_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_avator` text,
  `source_auth` varchar(20) NOT NULL,
  `billing_time` datetime NOT NULL COMMENT '建檔時間',
  `admin_acc` varchar(100) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `last_modified_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `audit_user`
--

INSERT INTO `audit_user` (`id`, `user_id`, `type`, `status`, `user_display_name`, `user_email`, `user_phone`, `user_avator`, `source_auth`, `billing_time`, `admin_acc`, `admin_name`, `last_modified_time`) VALUES
(2, 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'dist', '1', 'Aki Wu', 'aki547168@gmail.com', '', 'https://lh3.googleusercontent.com/-r6I84qlbeBs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcJsURG-pZeHUYB9tOe0v10cLi-iw/mo/photo.jpg', 'firebase', '2019-05-09 17:15:39', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', '', NULL),
(3, 'CYfowFCAuedwA6xMtcsyjDYRFt82', 'admin', '1', 'James 周駿憲', 'james@fofo.tw', '', 'https://lh3.googleusercontent.com/-ZImb45LkDag/AAAAAAAAAAI/AAAAAAAAAL8/pdxIUcVnfRY/photo.jpg', 'firebase', '2019-05-09 17:17:05', '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'ut wu', NULL),
(7, 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'admin', '1', 'Effy Chou', 'effy@foso.tw', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'firebase', '2019-05-09 17:25:06', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '2019-06-13 17:06:02'),
(10, 'MbpQcbI2CDUMxXwXecOvnD5cZKu2', 'admin', '1', 'CHUN HSIEN CHOU', 'james@foso.tw', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'firebase', '2019-05-09 17:40:50', '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'ut wu', NULL),
(74, '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'admin', '1', 'ut wu', 'utingwu@foso.tw', '', 'https://lh4.googleusercontent.com/-7B7ehaqguhA/AAAAAAAAAAI/AAAAAAAAACc/j88Kc7zcQZw/photo.jpg', 'firebase', '2019-05-21 14:47:23', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', NULL),
(77, 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'admin', '1', '王麗雯', 'lily872980@gmail.com', '', 'https://lh5.googleusercontent.com/-Ts_Lm-u3T1o/AAAAAAAAAAI/AAAAAAAAAAA/APUIFaNXoikZz1UdStKLUJAXhKqvl2dzlA/mo/photo.jpg', 'firebase', '2019-05-23 10:57:13', '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'ut wu', NULL),
(114, 'aki', 'farm', '1', 'Aki', '', '', '', 'member', '2019-05-24 16:40:02', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', NULL),
(173, 'yajenhina', 'admin', '1', 'effy', '', '', '', 'member', '2019-05-27 11:25:43', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '2019-05-29 17:04:38'),
(215, 'tms_test', 'dist', '1', 'tms_test', '', '', '', 'member', '2019-05-28 09:53:43', '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'ut wu', NULL),
(217, 'tms_test2', 'dist', '1', 'tms_test2', '', '', '', 'member', '2019-05-28 10:08:43', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', NULL),
(233, 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'dist', '1', 'uting wu', 'utingduffy@gmail.com', '', 'https://lh4.googleusercontent.com/-xl713JGW27w/AAAAAAAAAAI/AAAAAAAAIWs/ZuyvyxY-368/photo.jpg', 'firebase', '2019-05-29 16:04:44', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', NULL),
(277, 'oFeyhxnGAgUbcdTc4z7n4Vy4Zm13', 'dist', '1', 'FOFOSOLOMO LUKA', 'lukawa@fofo.tw', '', 'https://lh6.googleusercontent.com/-q9SFy3lmkeI/AAAAAAAAAAI/AAAAAAAAG3c/3jfTnmC7YIA/photo.jpg', 'firebase', '2019-06-19 10:04:46', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', NULL),
(287, 'IkWu7xCEExaEGAQ3KqBEtdpBo473', 'admin', '1', '郭湘芬', 'fanniekuo0444@gmail.com', '', 'https://lh5.googleusercontent.com/-QBGvxD2a81E/AAAAAAAAAAI/AAAAAAAAAAA/ACevoQOZYKZHtrlfiHOVXOu_KfTowpSzDQ/mo/photo.jpg', 'firebase', '2019-06-20 14:17:03', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `format_set`
--

CREATE TABLE `format_set` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `length` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `unit_l` varchar(10) NOT NULL,
  `unit_w` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `save_time` datetime NOT NULL,
  `last_modified_time` datetime NOT NULL,
  `admin_acc` varchar(50) NOT NULL,
  `admin_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `format_set`
--

INSERT INTO `format_set` (`id`, `title`, `status`, `length`, `weight`, `unit_l`, `unit_w`, `remark`, `save_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(1, '20cm,300g', 1, '20', '300', 'cm', 'g', '青江菜 20cm,300g', '2019-06-10 16:15:00', '2019-06-10 16:15:00', '', NULL),
(2, '10cm,150g', 1, '10', '150', 'cm', 'g', '青江菜 10cm,150g', '2019-06-10 16:15:00', '2019-06-10 16:15:00', '', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `order_num` varchar(20) NOT NULL COMMENT '訂單編號',
  `trans_num` varchar(20) NOT NULL,
  `goods_num` varchar(25) NOT NULL,
  `goods_status` varchar(10) NOT NULL COMMENT '貨物狀態',
  `spec_format` varchar(10) NOT NULL COMMENT '規格 ID',
  `order_billing` varchar(20) NOT NULL COMMENT '訂單開單時間',
  `order_dist` varchar(30) NOT NULL COMMENT '通路商',
  `order_dist_acc` varchar(50) NOT NULL,
  `order_dist_name` varchar(20) NOT NULL,
  `order_subscript` varchar(30) NOT NULL,
  `order_subscript_num` varchar(10) NOT NULL COMMENT '下標數量(每日需求數量)',
  `order_subscript_acc` varchar(50) NOT NULL,
  `order_subscript_name` varchar(20) NOT NULL,
  `sub_cycle` varchar(30) NOT NULL COMMENT '下標週期',
  `order_sub_remark` text,
  `order_status` varchar(10) NOT NULL COMMENT '訂單狀態(農場/通路商)',
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `product_price` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `save_time` datetime NOT NULL COMMENT '存入時間',
  `last_modified_time` datetime NOT NULL COMMENT '最後修改時間',
  `admin_acc` varchar(50) NOT NULL COMMENT '管理員帳號',
  `admin_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `goods`
--

INSERT INTO `goods` (`id`, `order_num`, `trans_num`, `goods_num`, `goods_status`, `spec_format`, `order_billing`, `order_dist`, `order_dist_acc`, `order_dist_name`, `order_subscript`, `order_subscript_num`, `order_subscript_acc`, `order_subscript_name`, `sub_cycle`, `order_sub_remark`, `order_status`, `product_name`, `product_unit`, `product_price`, `start_date`, `end_date`, `save_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(1, 'ORD20190530105155995', 'TNS20190530105897971', 'TNS20190530105897971', '0', '1', '20190530105103', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', 'ㄧ,三,五', 'wwwww', '7', '玉米', 'kg', '200', '2019-06-01', '2019-06-30', '2019-07-05 17:44:14', '2019-07-05 17:44:14', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou'),
(4, 'ORD20190530105155995', 'TNS20190530105897971', 'TNS20190530105897971_1', '0', '1', '20190530105103', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', 'ㄧ,三,五', 'wwwww', '7', '玉米', 'kg', '200', '2019-06-01', '2019-06-30', '2019-07-05 17:49:00', '2019-07-05 17:49:00', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou'),
(5, 'ORD20190530105155995', 'TNS20190530105897971', 'TNS20190530105897971_2', '0', '1', '20190530105103', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', 'ㄧ,三,五', 'wwwww', '7', '玉米', 'kg', '200', '2019-06-01', '2019-06-30', '2019-07-05 17:49:00', '2019-07-05 17:49:00', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou'),
(6, 'ORD20190530105155995', 'TNS20190530105897971', 'TNS20190530105897971_3', '0', '1', '20190530105103', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', 'ㄧ,三,五', 'wwwww', '7', '玉米', 'kg', '200', '2019-06-01', '2019-06-30', '2019-07-05 17:49:00', '2019-07-05 17:49:00', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_num` varchar(20) NOT NULL COMMENT '訂單編號',
  `order_billing` varchar(20) NOT NULL COMMENT '訂單開單時間',
  `order_dist` varchar(30) NOT NULL COMMENT '通路商',
  `order_dist_acc` varchar(50) NOT NULL,
  `order_dist_name` varchar(20) NOT NULL,
  `order_status` varchar(10) NOT NULL COMMENT '訂單狀態(管理員審核)',
  `return_ps` varchar(50) DEFAULT NULL COMMENT '審核(退回原因)',
  `scientific_id` varchar(10) NOT NULL COMMENT '學名',
  `variety` varchar(20) NOT NULL COMMENT '品種',
  `check_level` varchar(60) NOT NULL COMMENT '檢驗等級',
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(10) NOT NULL COMMENT '產品唯一單位',
  `product_price` varchar(10) NOT NULL COMMENT '產品單價',
  `spec_format` varchar(10) NOT NULL COMMENT '規格 ID',
  `shipping_total` varchar(10) NOT NULL COMMENT '需求出貨總數(每日需求數量)',
  `shipping_cycle` varchar(30) NOT NULL COMMENT '出貨週期',
  `start_date` date NOT NULL COMMENT '需求開始日期',
  `end_date` date NOT NULL COMMENT '需求結束日期',
  `remark` text NOT NULL,
  `save_time` datetime NOT NULL COMMENT '存入時間',
  `last_modified_time` datetime NOT NULL COMMENT '最後修改時間',
  `admin_acc` varchar(50) NOT NULL COMMENT '管理員帳號',
  `admin_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `order_num`, `order_billing`, `order_dist`, `order_dist_acc`, `order_dist_name`, `order_status`, `return_ps`, `scientific_id`, `variety`, `check_level`, `product_name`, `product_unit`, `product_price`, `spec_format`, `shipping_total`, `shipping_cycle`, `start_date`, `end_date`, `remark`, `save_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(1, 'ORD20190524154797565', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', NULL, '10103', '', 'organic,safe', '米', 'kg', '200', '2', '100', '一,五,六', '2019-05-07', '2019-05-17', '                                                                                                                                                                                                                                                                                                                                                            ', '2019-05-24 15:47:38', '0000-00-00 00:00:00', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu'),
(2, 'ORD20190524155055100', '20190524155047', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', '1', NULL, '10438', '柳橙', 'organic,safe', '柳橙100G', '', '20', '100', '30', '二,三', '2019-05-07', '2019-05-30', '', '2019-05-24 15:50:47', '2019-06-04 15:47:27', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou'),
(3, 'ORD20190529172057534', '20190529172009', '', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', '1', NULL, '10103', '柳橙', '3', '大麥', '', '', '500', '200', ',日,一,二,三,四,五,六', '2019-06-01', '2019-06-30', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ', '2019-05-29 17:20:09', '0000-00-00 00:00:00', '', ''),
(4, 'ORD20190530104048499', '20190530104048', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', '0', NULL, '', '', '', '小白菜', '', '20', '', '5', '一,三,五', '2019-06-01', '2019-06-30', '                                                                                                                                                                                                                                                                                                                                                            ', '2019-05-30 10:40:48', '2019-06-14 15:16:59', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou'),
(5, 'ORD20190530105155995', '20190530105103', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', '0', NULL, '', '', '', '玉米', '', '', '', '5', '二,六', '2019-06-01', '2019-06-30', '12345', '2019-05-30 10:51:03', '2019-06-03 16:38:03', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', '王麗雯'),
(6, 'ORD20190603152949545', '20190603152905', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '0', NULL, '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '2019-06-03 15:29:05', '2019-06-03 15:29:05', '', ''),
(7, 'ORD20190603152954971', '20190603152910', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '5', 'rrrrr', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '2019-06-03 15:29:10', '2019-06-10 13:26:37', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu'),
(8, 'ORD20190603153151979', '20190603153115', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '0', NULL, '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '2019-06-03 15:31:15', '2019-06-03 15:31:15', '', ''),
(10, 'ORD20190603162610110', '20190603162638', 'test_farm_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '0', NULL, '', '', '', '米', '', '', '', '10', '一,五', '2019-06-04', '2019-06-28', '', '2019-06-03 16:26:38', '2019-06-03 16:26:38', '', ''),
(11, 'ORD20190604133351565', '20190604133339', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '5', '3113212', '', '', '', '', 'g', '', '2', '', '', '0000-00-00', '0000-00-00', '', '2019-06-04 13:33:39', '2019-06-10 12:27:15', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu');

-- --------------------------------------------------------

--
-- 資料表結構 `subscript`
--

CREATE TABLE `subscript` (
  `id` int(11) NOT NULL,
  `order_num` varchar(20) NOT NULL COMMENT '訂單編號',
  `trans_num` varchar(20) NOT NULL,
  `order_billing` varchar(20) NOT NULL COMMENT '訂單開單時間',
  `order_dist` varchar(30) NOT NULL COMMENT '通路商',
  `order_dist_acc` varchar(50) NOT NULL,
  `order_dist_name` varchar(20) NOT NULL,
  `order_subscript` varchar(30) NOT NULL,
  `order_subscript_num` varchar(10) NOT NULL COMMENT '下標數量(每日需求數量)',
  `order_subscript_acc` varchar(50) NOT NULL,
  `order_subscript_name` varchar(20) NOT NULL,
  `sub_cycle` varchar(30) NOT NULL COMMENT '下標週期',
  `order_sub_remark` text COMMENT '下標備註',
  `order_status` varchar(10) NOT NULL COMMENT '訂單狀態(管理員/通路商審核)',
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `product_price` varchar(10) NOT NULL,
  `spec_format` varchar(10) NOT NULL COMMENT '規格 ID',
  `shipping_total` varchar(10) NOT NULL COMMENT '需求出貨總數(每日需求數量)',
  `shipping_cycle` varchar(30) NOT NULL COMMENT '出貨週期',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `scientific_id` varchar(10) NOT NULL COMMENT '學名',
  `variety` varchar(20) NOT NULL COMMENT '品種',
  `check_level` varchar(60) NOT NULL COMMENT '檢驗等級',
  `order_dist_remark` text COMMENT '通路商備註',
  `return_ps` varchar(50) DEFAULT NULL COMMENT '審核(退回原因)',
  `save_time` datetime NOT NULL COMMENT '存入時間',
  `last_modified_time` datetime NOT NULL COMMENT '最後修改時間',
  `admin_acc` varchar(50) NOT NULL COMMENT '管理員帳號',
  `admin_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `subscript`
--

INSERT INTO `subscript` (`id`, `order_num`, `trans_num`, `order_billing`, `order_dist`, `order_dist_acc`, `order_dist_name`, `order_subscript`, `order_subscript_num`, `order_subscript_acc`, `order_subscript_name`, `sub_cycle`, `order_sub_remark`, `order_status`, `product_name`, `product_unit`, `product_price`, `spec_format`, `shipping_total`, `shipping_cycle`, `start_date`, `end_date`, `scientific_id`, `variety`, `check_level`, `order_dist_remark`, `return_ps`, `save_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(1, 'ORD20190524155055100', 'TNS20190528161410257', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', 'test_farm_c', '10', 'aki', 'Aki', '', '', '7', '柳橙100G', '', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '10                                             ', NULL, '2019-05-28 16:14:07', '2019-05-28 16:20:14', 'aki', ''),
(2, 'ORD20190524155055100', 'TNS20190528162049495', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '24', 'aki', 'Aki', '', '', '3', '柳橙100G', '', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        24', NULL, '2019-05-28 16:20:49', '2019-05-28 17:50:13', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', ''),
(3, 'ORD20190524155055100', 'TNS20190528162598525', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', '8', '11', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', '', '', '7', '柳橙100G', '', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        11', NULL, '2019-05-28 16:25:15', '2019-05-28 16:54:26', 'aki', ''),
(4, 'ORD20190524155055100', 'TNS20190529152351554', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '10', 'aki', 'MXYGaGqid6cpP6DPk3fz', '', '', '3', '柳橙100G', '', '20', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '          10                                              ', NULL, '2019-05-29 15:23:47', '2019-05-29 15:28:41', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', ''),
(5, 'ORD20190529172057534', 'TNS20190529173253485', '20190529172009', '', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', '', '', '150', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', '', '', '0', '大麥', '', '', '', '200', '日,一,二,三,四,五,六', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, '2019-05-29 17:32:37', '2019-05-29 17:32:37', '', ''),
(6, 'ORD20190529172057534', 'TNS20190529173310055', '20190529172009', '', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', '', '', '105', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', '', '', '0', '大麥', '', '', '', '200', '日,一,二,三,四,五,六', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, '2019-05-29 17:33:01', '2019-05-29 17:33:01', '', ''),
(7, 'ORD20190524155055100', 'TNS20190529174752534', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', 'test_farm_c', '12', 'aki', 'Aki', '', '', '3', '柳橙100G', '', '20', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        ', NULL, '2019-05-29 17:47:48', '2019-06-03 16:29:45', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', ''),
(8, 'ORD20190530105155995', 'TNS20190530105897971', '20190530105103', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '1', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', 'ㄧ,三,五', 'wwwww', '7', '玉米', 'kg', '200', '1', '5', '二,六', '2019-06-01', '2019-06-30', '', '玉米', '3', '12345                                                      ', NULL, '2019-05-30 10:58:34', '2019-07-05 11:33:15', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou'),
(9, 'ORD20190530104048499', 'TNS20190603163851574', '20190530104048', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', 'test_dist', '20', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '', '', '3', '小白菜', '', '', '', '5', ',一,三,五', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, '2019-06-03 16:38:27', '2019-06-03 16:39:11', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', ''),
(11, 'ORD20190530104048499', 'TNS20190604165710248', '20190530104048', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '123', 'aki', 'Aki', '', '', '7', '', '', '', '', '5', '', '2019-06-01', '2019-06-30', '', '', '', '                                    111', NULL, '2019-06-04 16:57:19', '2019-06-17 15:31:29', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', ''),
(12, 'ORD20190530104048499', 'TNS20190604165754515', '20190530104048', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', 'test_farm_c', '123', 'aki', 'Aki', '', '', '2', '', '', '', '', '7', '', '2019-06-01', '2019-06-30', '', '', '', '                                    ', NULL, '2019-06-04 16:57:42', '2019-06-10 17:16:20', '', ''),
(13, 'ORD20190530104048499', 'TNS20190604170550565', '20190530104048', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', 'test_farm_c', '123', 'aki', 'Aki', '', '', '1', '', '', '', '', '5', '', '2019-06-01', '2019-06-30', '', '', '', '                                    3333112', NULL, '2019-06-04 17:05:54', '2019-06-04 17:05:54', '', ''),
(14, 'ORD20190524155055100', 'TNS20190704165150102', '20190524155047', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', '8', '110', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '', '30', '', '2019-05-07', '2019-05-30', '', '', '', '', NULL, '2019-07-04 16:51:14', '2019-07-04 16:51:14', '', ''),
(15, 'ORD20190524154797565', 'TNS20190704170110110', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '111', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '', '100', '', '2019-05-07', '2019-05-17', '', '', '', '', NULL, '2019-07-04 17:01:02', '2019-07-04 17:01:02', '', ''),
(16, 'ORD20190524154797565', 'TNS20190704170355995', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '122', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '', '100', '', '2019-05-07', '2019-05-17', '', '', '', '', NULL, '2019-07-04 17:03:35', '2019-07-04 17:03:35', '', ''),
(17, 'ORD20190524155055100', 'TNS20190704170510010', '20190524155047', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', '8', '345', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '', '30', '', '2019-05-07', '2019-05-30', '', '', '', '', NULL, '2019-07-04 17:05:33', '2019-07-04 17:05:33', '', ''),
(18, 'ORD20190524154797565', 'TNS20190704181799541', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '100', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '米', '200', '200', '2', '100', '一,五,六', '2019-05-07', '2019-05-17', '10103', '', 'organic,safe', '', '', '2019-07-04 18:17:32', '2019-07-04 18:17:32', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `trans_list`
--

CREATE TABLE `trans_list` (
  `id` int(11) NOT NULL,
  `order_num` varchar(20) NOT NULL COMMENT '訂單編號',
  `trans_num` varchar(20) DEFAULT NULL,
  `spec_format` varchar(10) NOT NULL COMMENT '規格 ID',
  `order_billing` varchar(20) NOT NULL COMMENT '訂單開單時間',
  `order_dist` varchar(30) NOT NULL COMMENT '通路商',
  `order_dist_acc` varchar(50) NOT NULL,
  `order_dist_name` varchar(20) NOT NULL,
  `order_subscript` varchar(30) DEFAULT NULL,
  `order_subscript_num` varchar(10) DEFAULT NULL COMMENT '下標數量(每日需求數量)',
  `order_subscript_acc` varchar(50) DEFAULT NULL,
  `order_subscript_name` varchar(20) DEFAULT NULL,
  `sub_cycle` varchar(30) DEFAULT NULL COMMENT '下標週期',
  `order_sub_remark` text COMMENT '下標備註',
  `order_status` varchar(10) DEFAULT NULL COMMENT '訂單狀態(所有紀錄)',
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `product_price` varchar(10) NOT NULL,
  `shipping_total` varchar(10) NOT NULL COMMENT '需求出貨總數(每日需求數量)',
  `shipping_cycle` varchar(30) NOT NULL COMMENT '出貨週期',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `scientific_id` varchar(10) NOT NULL COMMENT '學名',
  `variety` varchar(20) NOT NULL COMMENT '品種',
  `check_level` varchar(60) NOT NULL COMMENT '檢驗等級',
  `order_dist_remark` text COMMENT '通路商備註',
  `return_ps` varchar(50) DEFAULT NULL COMMENT '審核(退回原因)',
  `goods_num` varchar(20) DEFAULT NULL COMMENT '貨物單號',
  `goods_status` varchar(10) DEFAULT NULL COMMENT '貨物狀態',
  `save_time` datetime NOT NULL COMMENT '存入時間',
  `last_modified_time` datetime NOT NULL COMMENT '最後修改時間',
  `admin_acc` varchar(50) NOT NULL COMMENT '管理員帳號',
  `admin_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `trans_list`
--

INSERT INTO `trans_list` (`id`, `order_num`, `trans_num`, `spec_format`, `order_billing`, `order_dist`, `order_dist_acc`, `order_dist_name`, `order_subscript`, `order_subscript_num`, `order_subscript_acc`, `order_subscript_name`, `sub_cycle`, `order_sub_remark`, `order_status`, `product_name`, `product_unit`, `product_price`, `shipping_total`, `shipping_cycle`, `start_date`, `end_date`, `scientific_id`, `variety`, `check_level`, `order_dist_remark`, `return_ps`, `goods_num`, `goods_status`, `save_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(1, 'ORD20190524155055100', 'TNS20190528161410257', '', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', 'test_farm_c', '10', 'aki', 'Aki', '', '', '7', '柳橙100G', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '10                                             ', NULL, NULL, NULL, '2019-05-28 16:14:07', '2019-05-28 16:20:14', 'aki', ''),
(2, 'ORD20190524155055100', 'TNS20190528162049495', '', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '24', 'aki', 'Aki', '', '', '3', '柳橙100G', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        24', NULL, NULL, NULL, '2019-05-28 16:20:49', '2019-05-28 17:50:13', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', ''),
(3, 'ORD20190524155055100', 'TNS20190528162598525', '', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', '8', '11', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki', '', '', '7', '柳橙100G', '', '', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        11', NULL, NULL, NULL, '2019-05-28 16:25:15', '2019-05-28 16:54:26', 'aki', ''),
(4, 'ORD20190524155055100', 'TNS20190529152351554', '', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '10', 'aki', 'MXYGaGqid6cpP6DPk3fz', '', '', '3', '柳橙100G', '', '20', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '          10                                              ', NULL, NULL, NULL, '2019-05-29 15:23:47', '2019-05-29 15:28:41', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', ''),
(5, 'ORD20190529172057534', 'TNS20190529173253485', '', '20190529172009', '', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', '', '', '150', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', '', '', '0', '大麥', '', '', '200', '日,一,二,三,四,五,六', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, NULL, NULL, '2019-05-29 17:32:37', '2019-05-29 17:32:37', '', ''),
(6, 'ORD20190529172057534', 'TNS20190529173310055', '', '20190529172009', '', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', '', '', '105', 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'uting wu', '', '', '0', '大麥', '', '', '200', '日,一,二,三,四,五,六', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, NULL, NULL, '2019-05-29 17:33:01', '2019-05-29 17:33:01', '', ''),
(7, 'ORD20190524155055100', 'TNS20190529174752534', '', '20190524155047', '0509_test_c', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', 'test_farm_c', '12', 'aki', 'Aki', '', '', '3', '柳橙100G', '', '20', '30', '二,三', '2019-05-07', '2019-05-30', '', '', '', '                                                        ', NULL, NULL, NULL, '2019-05-29 17:47:48', '2019-06-03 16:29:45', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', ''),
(8, 'ORD20190530105155995', 'TNS20190530105897971', '', '20190530105103', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', '', '5', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', '王麗雯', '', 'wwwww', '7', '玉米', '', '', '5', '二,六', '2019-06-01', '2019-06-30', '', '', '', '12345                                              ', NULL, NULL, NULL, '2019-05-30 10:58:34', '2019-06-03 16:38:03', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', ''),
(9, 'ORD20190530104048499', 'TNS20190603163851574', '', '20190530104048', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', 'test_dist', '20', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', '', '', '3', '小白菜', '', '', '5', ',一,三,五', '2019-06-01', '2019-06-30', '', '', '', '                                                        ', NULL, NULL, NULL, '2019-06-03 16:38:27', '2019-06-03 16:39:11', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', ''),
(11, 'ORD20190530104048499', 'TNS20190604165710248', '', '20190530104048', 'test_dist', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', 'test_farm_c', '123', 'aki', 'Aki', '', '', '7', '', '', '', '5', '', '2019-06-01', '2019-06-30', '', '', '', '                                    111', NULL, NULL, NULL, '2019-06-04 16:57:19', '2019-06-17 15:31:29', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', ''),
(12, 'ORD20190530104048499', 'TNS20190604165754515', '', '20190530104048', 'test_dist', 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'Effy Chou', 'test_farm_c', '123', 'aki', 'Aki', '', '', '2', '', '', '', '7', '', '2019-06-01', '2019-06-30', '', '', '', '                                    ', NULL, NULL, NULL, '2019-06-04 16:57:42', '2019-06-10 17:16:20', '', ''),
(13, 'ORD20190530104048499', 'TNS20190604170550565', '', '20190530104048', 'test_dist', 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'Effy Chou', 'test_farm_c', '123', 'aki', 'Aki', '', '', '1', '', '', '', '5', '', '2019-06-01', '2019-06-30', '', '', '', '                                    3333112', NULL, NULL, NULL, '2019-06-04 17:05:54', '2019-06-04 17:05:54', '', ''),
(14, 'ORD20190524155055100', 'TNS20190704165150102', '', '20190524155047', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', '8', '110', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '30', '', '2019-05-07', '2019-05-30', '', '', '', '', NULL, NULL, NULL, '2019-07-04 16:51:14', '2019-07-04 16:51:14', '', ''),
(15, 'ORD20190524154797565', 'TNS20190704170110110', '', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '111', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '100', '', '2019-05-07', '2019-05-17', '', '', '', '', NULL, NULL, NULL, '2019-07-04 17:01:02', '2019-07-04 17:01:02', '', ''),
(16, 'ORD20190524154797565', 'TNS20190704170355995', '', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '122', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '100', '', '2019-05-07', '2019-05-17', '', '', '', '', NULL, NULL, NULL, '2019-07-04 17:03:35', '2019-07-04 17:03:35', '', ''),
(17, 'ORD20190524155055100', 'TNS20190704170510010', '', '20190524155047', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Effy Chou', '8', '345', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', '', '1', '', '', '', '30', '', '2019-05-07', '2019-05-30', '', '', '', '', NULL, NULL, NULL, '2019-07-04 17:05:33', '2019-07-04 17:05:33', '', ''),
(18, 'ORD20190524154797565', 'TNS20190704181799541', '2', '20190524154738', '2', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '8', '100', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu', '', NULL, '1', '米', '200', '200', '100', '一,五,六', '2019-05-07', '2019-05-17', '10103', '', 'organic,safe', '', '', NULL, NULL, '2019-07-04 18:17:32', '2019-07-04 18:17:32', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `company_id` varchar(30) NOT NULL,
  `user_display_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_avator` text NOT NULL,
  `source_auth` varchar(20) NOT NULL,
  `token` varchar(50) NOT NULL,
  `limit_time` datetime NOT NULL COMMENT '過期時間',
  `last_login_time` datetime NOT NULL,
  `billing_time` datetime NOT NULL COMMENT '建檔時間',
  `last_modified_time` datetime NOT NULL,
  `admin_acc` varchar(100) DEFAULT NULL,
  `admin_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `user_id`, `type`, `status`, `company_id`, `user_display_name`, `user_email`, `user_phone`, `user_avator`, `source_auth`, `token`, `limit_time`, `last_login_time`, `billing_time`, `last_modified_time`, `admin_acc`, `admin_name`) VALUES
(3, 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'admin', '1', '8', 'Aki Wu', 'aki547168@gmail.com', '', 'https://lh3.googleusercontent.com/-r6I84qlbeBs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcJsURG-pZeHUYB9tOe0v10cLi-iw/mo/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-09 17:15:39', '2019-05-29 16:51:39', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu'),
(4, 'aki', 'farm', '1', '8', 'Aki', '', '', '', 'member', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-24 16:40:02', '2019-05-24 17:00:51', NULL, ''),
(5, '1ofCbG9LEwcsE7ghs78XhxEHwhB3', 'admin', '1', '請選擇', 'ut wu', 'utingwu@foso.tw', '', 'https://lh4.googleusercontent.com/-7B7ehaqguhA/AAAAAAAAAAI/AAAAAAAAACc/j88Kc7zcQZw/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-21 14:47:23', '2019-05-28 15:22:16', NULL, ''),
(6, 'tms_test2', 'dist', '1', '1', 'tms_test2', '', '', '', 'member', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-28 10:08:43', '2019-05-29 15:40:13', NULL, ''),
(7, 'tms_test', 'dist', '1', '1', 'tms_test', '', '', '', 'member', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-28 09:53:43', '2019-05-29 15:41:14', NULL, ''),
(8, 'CYfowFCAuedwA6xMtcsyjDYRFt82', 'admin', '1', '1', 'James 周駿憲', 'james@fofo.tw', '', 'https://lh3.googleusercontent.com/-ZImb45LkDag/AAAAAAAAAAI/AAAAAAAAAL8/pdxIUcVnfRY/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-09 17:17:05', '2019-05-29 16:02:24', NULL, ''),
(9, 'DZfIMKWlPxVLAjoc1kMY5ZP01yH3', 'admin', '1', '5', 'Effy Chou', 'effy@foso.tw', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-09 17:25:06', '2019-06-13 17:06:02', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu'),
(10, 'MbpQcbI2CDUMxXwXecOvnD5cZKu2', 'admin', '1', '1', 'CHUN HSIEN CHOU', 'james@foso.tw', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-09 17:40:50', '2019-05-29 16:02:45', NULL, ''),
(11, 'Pi9IOMF7alZFvo7pjN5Fs3ABdkr2', 'admin', '1', '1', '王麗雯', 'lily872980@gmail.com', '', 'https://lh5.googleusercontent.com/-Ts_Lm-u3T1o/AAAAAAAAAAI/AAAAAAAAAAA/APUIFaNXoikZz1UdStKLUJAXhKqvl2dzlA/mo/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-23 10:57:13', '2019-05-29 16:02:54', NULL, ''),
(12, 'fYHJJTl0EVaQz3ls83kiww8c6aE2', 'dist', '1', '1', 'uting wu', 'utingduffy@gmail.com', '', 'https://lh4.googleusercontent.com/-xl713JGW27w/AAAAAAAAAAI/AAAAAAAAIWs/ZuyvyxY-368/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-29 16:04:44', '2019-05-29 16:05:07', NULL, ''),
(13, 'yajenhina', 'admin', '1', '請選擇', 'effy', '', '', '', 'member', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-27 11:25:43', '2019-05-29 17:04:38', 'MXYGaGqid6cpP6DPk3fzJzf1nfh1', 'Aki Wu'),
(14, 'oFeyhxnGAgUbcdTc4z7n4Vy4Zm13', 'admin', '1', '請選擇', 'FOFOSOLOMO LUKA', 'lukawa@fofo.tw', '', 'https://lh6.googleusercontent.com/-q9SFy3lmkeI/AAAAAAAAAAI/AAAAAAAAG3c/3jfTnmC7YIA/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-06-19 10:04:46', '2019-06-19 10:25:01', '', ''),
(15, 'IkWu7xCEExaEGAQ3KqBEtdpBo473', 'admin', '1', '請選擇', '郭湘芬', 'fanniekuo0444@gmail.com', '', 'https://lh5.googleusercontent.com/-QBGvxD2a81E/AAAAAAAAAAI/AAAAAAAAAAA/ACevoQOZYKZHtrlfiHOVXOu_KfTowpSzDQ/mo/photo.jpg', 'firebase', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-06-20 14:17:03', '2019-06-20 14:47:54', '', '');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `audit_company`
--
ALTER TABLE `audit_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- 資料表索引 `audit_user`
--
ALTER TABLE `audit_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 資料表索引 `format_set`
--
ALTER TABLE `format_set`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `goods_num` (`goods_num`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_num` (`order_num`);

--
-- 資料表索引 `subscript`
--
ALTER TABLE `subscript`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_num` (`trans_num`);

--
-- 資料表索引 `trans_list`
--
ALTER TABLE `trans_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_num` (`trans_num`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `audit_company`
--
ALTER TABLE `audit_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `audit_user`
--
ALTER TABLE `audit_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `format_set`
--
ALTER TABLE `format_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `subscript`
--
ALTER TABLE `subscript`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `trans_list`
--
ALTER TABLE `trans_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
