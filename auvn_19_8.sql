-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2016 at 11:53 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) unsigned NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_color` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `category_description`, `category_image`, `image_position`, `category_color`, `category_status`, `created_at`, `updated_at`) VALUES
(3, 'Computers', 0, '<p>I''m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.</p>\r\n', '19', '', '', 1, '2016-04-24 09:23:21', '2016-08-09 10:57:28'),
(4, 'Fashion', 0, '<h2>4 DAYS 4 WAYS.</h2>\r\n\r\nI''m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. I’m a great place for you to tell a story and let your users know a little more about you.', '', 'right', '#85e2bf', 1, '2016-04-24 09:26:02', '2016-05-26 15:21:46'),
(5, 'Accessories', 0, '', '', '', '', 1, '2016-04-24 09:37:46', '2016-04-24 09:37:46'),
(6, 'Untitle', 0, '', '', '', '', 0, '2016-08-12 12:30:32', '2016-08-12 12:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`cityId` int(5) NOT NULL,
  `cityName` varchar(255) NOT NULL,
  `countryId` varchar(20) NOT NULL,
  `externalCode` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `cityName`, `countryId`, `externalCode`) VALUES
(1, 'New South wales', 'AU', 'NSW'),
(2, 'Victoria', 'AU', 'VIC');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`name`, `value`, `type`, `label`, `created_at`, `updated_at`) VALUES
('ajax_cart', 'True', 'text', 'Ajax Cart', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('bank', 'By EFT : ANZ BANK BSB : 012-445\r\nAccount Number: 457670637\r\nCompany Name : Life Force Global Pty Ltd', 'textarea', 'Bank', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('contact', '<h5>COME TO VISIT</h5><p><b></b>&nbsp;500 Terry Francois Street \r\nSan Francisco, CA 94158<br>info@mysite.com<br>Tel: 123-456-7890<br>Fax: 123-456-7890&nbsp;<b></b></p><h5>&nbsp;OPENING HOURS&nbsp;</h5><p>Mon - Fri: 7am - 10pm<br>Saturday: 8am - 10pm​<br>Sunday: 8am - 11pm</p>', 'textarea', 'Contact Us', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('facebook_url', 'http://facebook.com', 'text', 'Facebook Url', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('google_url', 'http://google.com', 'text', 'Google Url', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('gst_tax', '10', 'text', 'GST Tax (%)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('pinterest_url', 'https://www.pinterest.com/', 'text', 'Pinterest Url', '0000-00-00 00:00:00', '2016-08-12 10:13:27'),
('register_fee', '50', 'text', 'Register fee', '0000-00-00 00:00:00', '2016-08-12 10:13:28'),
('seo_name', 'Australia Hihi', 'text', 'SEO Name', '0000-00-00 00:00:00', '2016-08-12 10:13:28'),
('shipping_fee', '10', 'text', 'Shipping Fee', '0000-00-00 00:00:00', '2016-08-12 10:13:28'),
('site_desciption', 'Life fore descition', 'textarea', 'Site Description', '0000-00-00 00:00:00', '2016-08-12 10:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `countryId` varchar(20) NOT NULL,
  `countryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryName`) VALUES
('AU', 'Ustralia');

-- --------------------------------------------------------

--
-- Table structure for table `customers_address`
--

CREATE TABLE IF NOT EXISTS `customers_address` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cityname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suburb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customers_address`
--

INSERT INTO `customers_address` (`id`, `user_id`, `address`, `created_at`, `updated_at`, `country`, `cityname`, `suburb`, `postalcode`) VALUES
(2, 8, '16A Nơ Trang Long, Q Bình Thạnh', '2016-07-06 14:15:14', '2016-07-06 14:14:15', 'AU', 'Victoria', 'Xuyên Mộc', '0003'),
(3, 31, '16A Nơ Trang Long, Q Bình Thạnh', '2016-07-14 08:26:26', '2016-07-14 08:26:26', 'AU', 'Victoria', 'Xuyên Mộc', '0003'),
(4, 30, '16A Nơ Trang Long, Q Bình Thạnh', '2016-07-14 09:59:16', '2016-07-14 09:16:59', 'AU', 'Victoria', 'Xuyên Mộc', '0003'),
(6, 10, '16A Nơ Trang Long, Q Bình Thạnh', '2016-08-10 15:34:29', '2016-08-10 15:29:34', 'AU', 'Victoria', 'Xuyên Mộc', '0003'),
(7, 7, '16A Nơ Trang Long, Q Bình Thạnh', '2016-08-16 03:03:44', '0000-00-00 00:00:00', '', 'Victoria', 'Xuyên Mộc', '0003'),
(8, 1, '17/1 ấp 2, Xã Hòa Bình', '2016-08-16 05:04:06', '2016-08-16 05:06:04', 'AU', 'New South wales', 'Xuyên Mộc', '0003'),
(9, 50, 'Testing for Cdiscount', '2016-08-16 10:56:28', '2016-08-16 10:28:56', 'AU', 'New South wales', 'TP HCM', '0003'),
(10, 51, 'Testing for Cdiscount', '2016-08-16 11:20:14', '2016-08-16 11:14:20', 'AU', 'New South wales', 'TP HCM', '0003');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
`id` int(11) unsigned NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `fullname`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Phan Văn Nhiên', 'phanvannhien@gmail.com', 'Hỏi MAC', 'contactus', '2016-08-12 12:25:47', '2016-08-12 12:25:47'),
(2, 'Phan Văn Nhiên', 'phanvannhien@gmail.com', 'Hỏi MAC', 'contactus', '2016-08-12 12:26:00', '2016-08-12 12:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
`id` int(11) unsigned NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `cityname` varchar(255) NOT NULL,
  `postalcode` varchar(100) NOT NULL,
  `suburb` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
`id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(10) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `file_name`, `file_type`, `file_url`, `file_size`, `created_at`, `updated_at`) VALUES
(11, '1470238896Chrysanthemum.jpg', 'thumbnail', 'http://auvn.local/uploads/1470238896Chrysanthemum.jpg', '879394', '2016-08-03 15:41:36', '2016-08-03 15:41:36'),
(12, '1470238923Cdiscount- Adobe-160328.pdf', 'pdf', 'http://auvn.local/uploads/1470238923Cdiscount- Adobe-160328.pdf', '266553', '2016-08-03 15:42:03', '2016-08-03 15:42:03'),
(13, '1470239347Cdiscount- Adobe-160328.pdf', 'pdf', 'http://auvn.local/uploads/1470239347Cdiscount- Adobe-160328.pdf', '266553', '2016-08-03 15:49:07', '2016-08-03 15:49:07'),
(14, '1470239388Cdiscount- Adobe-160328.pdf', 'pdf', 'http://auvn.local/uploads/1470239388Cdiscount- Adobe-160328.pdf', '266553', '2016-08-03 15:49:48', '2016-08-03 15:49:48'),
(15, '1470239493Cdiscount- Adobe-160328.pdf', 'pdf', 'http://auvn.local/uploads/1470239493Cdiscount- Adobe-160328.pdf', '266553', '2016-08-03 15:51:33', '2016-08-03 15:51:33'),
(16, '1470239621Cdiscount- Adobe-160328.pdf', 'pdf', 'http://auvn.local/uploads/1470239621Cdiscount- Adobe-160328.pdf', '266553', '2016-08-03 15:53:41', '2016-08-03 15:53:41'),
(17, '147023965403-Equipment Handover Minutes - Bien ban giao nhan thiet bi.pdf', 'pdf', 'http://auvn.local/uploads/147023965403-Equipment Handover Minutes - Bien ban giao nhan thiet bi.pdf', '109804', '2016-08-03 15:54:14', '2016-08-03 15:54:14'),
(18, '1470725736service2.jpg', 'category', 'http://auvn.local/uploads/1470725736service2.jpg', '22772', '2016-08-09 06:55:36', '2016-08-09 06:55:36'),
(19, '1470726067service2.jpg', 'category', 'http://auvn.local/uploads/1470726067service2.jpg', '22772', '2016-08-09 07:01:07', '2016-08-09 07:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_04_033910_create_categories_table', 1),
('2016_04_04_034344_create_product_table', 1),
('2016_04_17_095428_create_orders_table', 1),
('2016_04_17_095442_create_orders_detail_table', 1),
('2016_04_17_095747_create_customers_address_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `checkout_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `orderable_id` int(11) NOT NULL,
  `orderable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `gst_tax` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL,
  `total_include_tax` float NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `checkout_type`, `orderable_id`, `orderable_type`, `shipping_fee`, `gst_tax`, `total`, `total_include_tax`, `status`, `updated_by`, `address`, `created_at`, `updated_at`) VALUES
('MEM1471319938', 1, 'member', 1, 'App\\User', 10, 10, 16, 16.1, 'done', 1, '16A Nơ Trang Long, Q Bình Thạnh, Xuyên Mộc, 0003 Victoria, ', '2016-08-10 03:58:58', '2016-08-16 03:58:58'),
('MEM1471343336', 50, 'member', 50, 'App\\User', 10, 10, 56, 56.1, 'done', 50, 'Testing for Cdiscount, TP HCM, 0003 New South wales, AU', '2016-04-06 10:28:56', '2016-08-16 10:28:56'),
('MEM1471346060', 51, 'member', 51, 'App\\User', 10, 10, 56, 56.1, 'done', 51, 'Testing for Cdiscount, TP HCM, 0003 New South wales, AU', '2016-08-16 11:14:20', '2016-08-16 11:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE IF NOT EXISTS `orders_detail` (
`id` int(10) unsigned NOT NULL,
  `order_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `qty`, `price`, `subtotal`, `created_at`) VALUES
(17, 'MEM1471319938', 1, '2', 8, 16, '2016-08-16 03:58:58'),
(19, 'MEM1471343336', 1, '7', 8, 56, '2016-08-16 10:56:28'),
(20, 'MEM1471343370', 1, '4', 8, 32, '2016-08-16 10:30:29'),
(21, 'MEM1471346060', 1, '7', 8, 56, '2016-08-16 11:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_sort_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_RPP` int(11) NOT NULL,
  `price_discount` int(11) NOT NULL,
  `product_thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `download_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_images` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `product_name`, `product_sort_description`, `product_description`, `price_RPP`, `price_discount`, `product_thumbnail`, `download_file`, `product_images`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'ACV (Apple Cider Vinegar)', 'ACV (Apple Cider Vinegar)', '<p>ACV (Apple Cider Vinegar)</p>\r\n', 10, 8, '', '', '/media/product/images/product-demo.jpg', 1, '2016-08-12 12:03:36', '0000-00-00 00:00:00'),
(2, 3, 'AGED MGO 11', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\r\n', 12, 10, '11', '17', '/media/product/images/product-demo.jpg', 0, '2016-08-03 15:29:54', '2016-08-03 15:54:14'),
(3, 0, 'Untitle', '', '', 0, 0, '', '', '', 0, '2016-08-12 12:32:21', '2016-08-12 12:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_suffix` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `membership_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_refferal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` int(10) unsigned NOT NULL DEFAULT '0',
  `uplinepath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_verify_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `register_fee` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `name_suffix`, `email`, `password`, `user_code`, `membership_number`, `user_refferal`, `user_level`, `uplinepath`, `user_role`, `registration_date`, `user_status`, `user_verify_code`, `admin`, `register_fee`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Phan Văn Nhiên', '_a_w', 'neihn88@gmail.com', '$2y$10$VCObCE0YIz7xPnzAz35yyuWM3NNWQb0fVuAmHYlsHV55X.V3GjMty', '00001', 'CM-00001-00000-VIC', '', 0, '', 'WM', '2016-03-14 16:00:09', 1, 'Z5JL42XzpwMN1lTTu0FCpk5xWgu0st132GcMl8ZBxkF2g7fccqo7INAKQ2iuAl0A', 1, 50, 'yt9iaqw3rWIh17Y5FGpD20j4uIjpSZF1B2zu47Ll6JHdSyCBSj54mMAwuVsd', NULL, '2016-08-16 03:27:13'),
(50, '', '_a_w', 'neihn881@gmail.com', '$2y$10$SZntOcXwMHnkKnV64uHUfeWfB9bxbsf9ygbi/5dtw9i.ui0kH7g3W', '00050', 'OM-00050-00001-NSW', '00001', 1, ',1', 'BM', '2016-03-02 10:28:27', 1, 'FHfeJztILqqYR8FKolGLKkpUJ2FwIMiNwdTR6CMfLoQ3K10xS8oWrGx4ZUBrQxtf', 0, 50, 'YGMnCe2t8ec5uPMMyGZiTlbyUgh9In3xwY7pyb8PLD1LFlPkPX0N7TdAF4fw', '2016-08-16 03:27:28', '2016-08-16 04:12:50'),
(51, '', '_a_w', 'neihn882@gmail.com', '$2y$10$pqCj2WXETmc8Voqw8YkOqexJFVNPX0eyGWiKLqlw5MsD6TqXSO.oC', '00051', 'OM-00051-00050-NSW', '00050', 2, ',1,50', 'OM', '2016-08-16 11:24:13', 1, 'SXkppOFU98inh9rjwS8zOOOYgTE7U0jxcztwA9pXPa8PROfsZiRudHAFKSQE7142', 0, 50, NULL, '2016-08-16 04:13:24', '2016-08-16 04:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE IF NOT EXISTS `users_role` (
  `roleid` varchar(20) NOT NULL,
  `roleTitle` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`roleid`, `roleTitle`, `created_at`, `updated_at`) VALUES
('BM', 'Membership building member', '2016-06-23 00:00:00', '2016-06-23 00:00:00'),
('CM', 'Committee Member', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('FD', 'Founder', '2016-05-20 00:00:00', '2016-05-20 00:00:00'),
('FM', 'Founding Member', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('OM', 'Ordinary member', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('VM', 'Wholesale member', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `customers_address`
--
ALTER TABLE `customers_address`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD KEY `orders_user_id_index` (`user_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
 ADD PRIMARY KEY (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `cityId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers_address`
--
ALTER TABLE `customers_address`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
