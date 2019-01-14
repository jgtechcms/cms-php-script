-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2018 at 12:57 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jgtech_free`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `banner_image` blob NOT NULL,
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `page_id`, `menu_id`, `banner_image`, `description`) VALUES
(1, 0, 1, 0x31343936343337323730312e6a7067, '<h2><span style=\"color: #ffffff; font-size: 38px;\">Responsive Design</span></h2>\r\n<p><span style=\"color: #ffffff; font-size: 16px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod</span></p>\r\n<form class=\"form-inline\">\r\n<div class=\"form-group\"><span style=\"font-size: 18px;\"><button class=\"btn btn-primary btn-lg\" name=\"subscribe\" type=\"getnow\">Get Now</button></span></div>\r\n</form>'),
(2, 0, 1, 0x3135323036373233313762616e6e6572322e6a706567, '<h2><span style=\"color: #ff6600; font-size: 38px;\">Fully Customizable</span></h2>\r\n<p><span style=\"color: #ffffff; font-size: 16px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod</span></p>\r\n<form class=\"form-inline\">\r\n<div class=\"form-group\"><span style=\"font-size: 18px;\"><button class=\"btn btn-primary btn-lg\" name=\"subscribe\" type=\"getnow\">Get Now</button></span></div>\r\n</form>');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Note: This is the default CodeIgniter session table.';

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `action_taken` varchar(150) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `email`, `phone`, `subject`, `message`, `action_taken`, `created`) VALUES
(1, 'Andrew', 'mail@mail.com', '+81 9847102365', 'Cms Script', 'Welcome to JGTech CMS', NULL, '2018-03-13 17:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(180) NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `page_type_id` int(11) NOT NULL,
  `page_type` varchar(50) NOT NULL,
  `is_contact` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `is_product` tinyint(1) NOT NULL DEFAULT '0',
  `is_gallery` tinyint(1) NOT NULL DEFAULT '0',
  `is_blog` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `slug`, `order_by`, `parent_id`, `page_type_id`, `page_type`, `is_contact`, `is_home`, `is_product`, `is_gallery`, `is_blog`) VALUES
(1, 'Home', 'home', 1, 0, 0, 'is_home', 0, 0, 0, 0, 0),
(2, 'About us', 'about-us', 2, 0, 0, 'other', 0, 0, 0, 0, 0),
(5, 'Contact Us', 'contact-us', 5, 0, 0, 'is_contact', 0, 0, 0, 0, 0),
(6, 'Services', 'services', 6, 2, 0, 'other', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id`, `title`) VALUES
(1, 'Header Menu'),
(2, 'Footer Menu 1'),
(3, 'Footer Menu 2'),
(4, 'Footer Menu 3');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(240) NOT NULL,
  `content` text,
  `meta_title` varchar(250) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `h1_title` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `menu_id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `h1_title`, `status`) VALUES
(1, 1, '', NULL, 'Home page', 'Home page', 'Home page', '', ''),
(3, 2, 'About Us', NULL, 'About Us', 'About Us', 'About Us', '', ''),
(5, 5, 'Contact Us', NULL, 'Contact Us', '', '', '', ''),
(6, 6, 'Services', NULL, 'Services', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `page_products`
--

CREATE TABLE `page_products` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page_types`
--

CREATE TABLE `page_types` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_types`
--

INSERT INTO `page_types` (`id`, `name`, `slug`, `status`) VALUES
(1, 'Home page', 'is_home', 1),
(3, 'Contact us page', 'is_contact', 1),
(4, 'Other page', 'other', 1),
(5, 'Gallery page', 'is_gallery', 1),
(6, 'Blog page', 'is_blog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_widgets`
--

CREATE TABLE `page_widgets` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_widgets`
--

INSERT INTO `page_widgets` (`id`, `page_id`, `widget_id`, `order_by`) VALUES
(43, 3, 7, 1),
(44, 3, 8, 2),
(49, 6, 9, 1),
(50, 6, 10, 2),
(51, 6, 11, 3),
(52, 1, 1, 1),
(53, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `ga_code` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `template_type` enum('free','custom') NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `template_modified` date DEFAULT NULL,
  `template_request_id` int(11) DEFAULT NULL,
  `custom_template_name` varchar(50) NOT NULL,
  `copy_right` varchar(250) DEFAULT NULL,
  `background_image` varchar(100) NOT NULL DEFAULT '1',
  `is_ecommerce_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `admin_email` varchar(200) NOT NULL,
  `admin_notify_email` varchar(250) DEFAULT NULL,
  `mail_protocol` varchar(10) NOT NULL DEFAULT 'sendmail',
  `mail_path` varchar(100) NOT NULL DEFAULT '/usr/sbin/sendmail',
  `smtp_host_name` varchar(100) NOT NULL,
  `smtp_username` varchar(150) NOT NULL,
  `smtp_password` varchar(50) NOT NULL,
  `smtp_port` smallint(6) NOT NULL DEFAULT '25',
  `smtp_timeout` tinyint(4) NOT NULL DEFAULT '5',
  `lkey` varchar(20) DEFAULT NULL,
  `gen_key` varchar(250) DEFAULT NULL,
  `is_payment_settings_updated` tinyint(1) NOT NULL DEFAULT '1',
  `is_subscription_exists` tinyint(1) NOT NULL DEFAULT '1',
  `custom_css` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `address`, `phone`, `ga_code`, `logo`, `favicon`, `template_type`, `template_id`, `template_modified`, `template_request_id`, `custom_template_name`, `copy_right`, `background_image`, `is_ecommerce_enabled`, `admin_email`, `admin_notify_email`, `mail_protocol`, `mail_path`, `smtp_host_name`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_timeout`, `lkey`, `gen_key`, `is_payment_settings_updated`, `is_subscription_exists`, `custom_css`) VALUES
(1, 'JG Technologies Demo', 'Parrys, Chennai', '9630125487', '', 'logo2.png', 'favicon.ico', 'free', 1, NULL, NULL, '', NULL, '', 0, 'info@jgtech.in', 'info@jgtech.in', 'sendmail', '/usr/sbin/sendmail', '', '', '', 25, 5, '12345467891234546789', '736ba9a04ee9295ffbc67425c628db559c658e2e21b4cfaf9f9d64e71deea0b095a4f9691121339e50cdc4776bc92b20717ce98b1620c963c9336a266c3e2b50', 1, 0, 'body {\r\n    font-family: Arial,sans-serif;\r\n    font-size: 14px;\r\n    line-height: 24px;\r\n    color: #333;\r\n    background-color: #fff;\r\n}\r\n\r\n/** home slider **/\r\n.head_caption{top:35%;top: calc(45% - 100px);}\r\n.carousel-inner .form-inline .form-group button {\r\n    padding: 20px 60px;\r\n    font-size: 25px;\r\n    background: #0BA9F9;\r\n    color: #fff;\r\n	border: none;\r\n    margin-top: 20px;\r\n}\r\n.carousel-inner h2{margin-bottom:20px;}\r\n\r\n.carousel-inner .form-inline .form-group button:hover {\r\n	color:#0BA9F9;\r\n	background:#fff;\r\n	-webkit-transition: color 300ms, background-color 300ms;\r\n  -moz-transition: color 300ms, background-color 300ms;\r\n  -o-transition:  color 300ms, background-color 300ms;\r\n  transition:  color 300ms, background-color 300ms;\r\n}\r\n\r\n/** service page **/\r\n.media ul li {\r\n    list-style: none;\r\n}\r\n.media i {\r\n    color: #1BBD36;\r\n    font-size: 20px;\r\n}\r\n.media h4 {\r\n    font-weight: 600;\r\n    color: #1BBD36;\r\n}\r\n.media-body p {\r\n    margin-bottom: 30px;\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `url` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `icon`, `url`, `status`) VALUES
(2, 'Facebook', 'fa-facebook', 'https://www.facebook.com/', 1),
(3, 'twitter', 'fa-twitter', 'https://twitter.com/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `layout` text,
  `has_banner` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `slug`, `layout`, `has_banner`) VALUES
(1, 'Default', 'green', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `company` varchar(150) NOT NULL,
  `user_type` int(1) NOT NULL,
  `forgot_password_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `username`, `password`, `name`, `email`, `company`, `user_type`, `forgot_password_code`) VALUES
(1, '2016-10-31 13:38:19', 'admin', '7e3ac0eeb75a7b3fd13bcd9dd0cd1f4346f632f3dae420f4373fd1e8998f6098b5cccef8920a2145f68452d4f899f50c22f9fec14c937624fcf87ccc515a039c', 'admin', 'info@jgtech.in', 'jg tech', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu_type_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu_type_id`, `menu_id`) VALUES
(105, 1, 2),
(106, 2, 2),
(120, 1, 4),
(121, 4, 4),
(122, 1, 5),
(123, 2, 5),
(124, 1, 3),
(125, 3, 3),
(127, 1, 6),
(128, 3, 6),
(129, 1, 1),
(130, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `widget_type_id` int(11) NOT NULL,
  `page_limit` int(11) NOT NULL,
  `disable_in_mobile` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `content_layout` varchar(50) DEFAULT NULL,
  `single_column_content` text,
  `two_column_content` text,
  `three_column_content` text,
  `four_column_content` text,
  `section_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `name`, `widget_type_id`, `page_limit`, `disable_in_mobile`, `status`, `content_layout`, `single_column_content`, `two_column_content`, `three_column_content`, `four_column_content`, `section_title`) VALUES
(1, 'Home Main', 5, 0, 0, 0, 'three_column', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<p><a class=\"btn btn-default\" href=\"#\">Learn More</a></p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<p><a class=\"btn btn-default\" href=\"#\">Learn More</a></p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>\r\n<p><a class=\"btn btn-default\" href=\"#\">Learn More</a></p>', '', 'Welcome to JG CMS'),
(2, 'Home Features', 5, 0, 0, 0, 'two_column', '<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod.</span></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod.</span></p>\r\n<ul style=\"padding: 0 10px 0 20px;\">\r\n<li style=\"list-style: none;\"><span class=\"fa fa-circle\" style=\"color: #008000; font-size: 12px;\"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n<li style=\"list-style: none; margin: 5px 0 0 0;\"><span class=\"fa fa-circle\" style=\"color: #008000; font-size: 12px;\"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n<li style=\"list-style: none; margin: 5px 0 0 0;\"><span class=\"fa fa-circle\" style=\"color: #008000; font-size: 12px;\"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n<li style=\"list-style: none; margin: 5px 0 0 0;\"><span class=\"fa fa-circle\" style=\"color: #008000; font-size: 12px;\"></span> Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>\r\n</ul>', '<p><img src=\"assets/file_manager/source/feature1.jpg?1520672487011\" alt=\"\" /></p>', '', '', 'Features'),
(7, 'About us top', 5, 0, 0, 0, 'two_column', '<p><img src=\"assets/file_manager/source/blog5_web.jpg?1520708125952\" alt=\"\" /></p>\r\n<h4><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit</span></h4>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>', '<div class=\"skill\">\r\n<h2>Our Skills</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n<div class=\"progress-wrap\">\r\n<h3>Graphic Design</h3>\r\n<div class=\"progress\">\r\n<div class=\"progress-bar  color1\" role=\"progressbar\" aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 85%;\"><span class=\"bar-width\">85%</span></div>\r\n</div>\r\n</div>\r\n<div class=\"progress-wrap\">\r\n<h4>HTML</h4>\r\n<div class=\"progress\">\r\n<div class=\"progress-bar color2\" role=\"progressbar\" aria-valuenow=\"20\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 95%;\"><span class=\"bar-width\">95%</span></div>\r\n</div>\r\n</div>\r\n<div class=\"progress-wrap\">\r\n<h4>CSS</h4>\r\n<div class=\"progress\">\r\n<div class=\"progress-bar color3\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 80%;\"><span class=\"bar-width\">80%</span></div>\r\n</div>\r\n</div>\r\n<div class=\"progress-wrap\">\r\n<h4>Wordpress</h4>\r\n<div class=\"progress\">\r\n<div class=\"progress-bar color4\" role=\"progressbar\" aria-valuenow=\"80\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 90%;\"><span class=\"bar-width\">90%</span></div>\r\n</div>\r\n</div>\r\n</div>', '', '', ''),
(8, 'About us bottom', 5, 0, 0, 0, 'three_column', '<p><img src=\"assets/file_manager/source/people1_web.jpg?1520708258151\" alt=\"\" /></p>\r\n<h4 style=\"text-align: center;\">Developer</h4>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>', '<p><img src=\"assets/file_manager/source/people2_web.jpg?1520708289311\" alt=\"\" /></p>\r\n<h4 style=\"text-align: center;\">Designer</h4>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>', '<p><img src=\"assets/file_manager/source/people3_web.jpg?1520708322682\" alt=\"\" /></p>\r\n<h4 style=\"text-align: center;\">SEO</h4>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>', '', 'Our Team'),
(9, 'Service top', 5, 0, 0, 0, 'two_column', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod.</p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>\r\n<p style=\"text-align: center;\"><a class=\"btn btn-default\" href=\"#\">Learn More</a></p>', '<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod.</p>\r\n<p style=\"text-align: center;\"><a class=\"btn btn-default\" href=\"#\">Learn More</a></p>', '', '', ''),
(10, 'Service middle', 5, 0, 0, 0, 'two_column', '<p><img src=\"assets/file_manager/source/blog4_web.jpg?1520708657079\" alt=\"\" /></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque</span></p>', '<div class=\"media\">\r\n<ul>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-pencil\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Web Development</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-book\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Responsive Design</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-rocket\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Bootstrap Themes</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>', '', '', 'Our Vision'),
(11, 'Service bottom', 5, 0, 0, 0, 'two_column', '<div class=\"media\">\r\n<ul>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-pencil\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Landing Page</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-book\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Training</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n<li>\r\n<div class=\"media-left\"><i class=\"fa fa-rocket\"></i></div>\r\n<div class=\"media-body\">\r\n<h4 class=\"media-heading\">Logo Design</h4>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget.</p>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>', '<p><img src=\"assets/file_manager/source/computer1_web.jpg?1520708863300\" alt=\"\" /></p>\r\n<p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque.</span></p>', '', '', 'Our Mission'),
(12, 'hr tag', 5, 0, 0, 0, 'single_column', '<hr />\r\n<p></p>', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `widget_types`
--

CREATE TABLE `widget_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `limit_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_types`
--

INSERT INTO `widget_types` (`id`, `name`, `slug`, `limit_description`) VALUES
(1, 'Blog', 'blog', 'Number of posts to be displayed'),
(2, 'Testimonial', 'testimonial', 'Number of testimonials to be displayed'),
(3, 'Gallery', 'gallery', 'Number of galleries to be displayed'),
(4, 'Sponsor', 'sponsor', 'Number of sponsors to be displayed'),
(5, 'Custom', 'custom', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_type_id` (`page_type_id`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `page_products`
--
ALTER TABLE `page_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_types`
--
ALTER TABLE `page_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_widgets`
--
ALTER TABLE `page_widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`template_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`username`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`menu_type_id`),
  ADD KEY `menu_type_id` (`menu_type_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widget_types`
--
ALTER TABLE `widget_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `page_products`
--
ALTER TABLE `page_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_types`
--
ALTER TABLE `page_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `page_widgets`
--
ALTER TABLE `page_widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `widget_types`
--
ALTER TABLE `widget_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
