-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 07:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comm_admin`
--

CREATE TABLE `comm_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sha256',
  `admin_fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_lname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_mobile` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_upm_id` int(11) DEFAULT '0',
  `admin_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_last_login` datetime NOT NULL,
  `admin_add_date` datetime NOT NULL,
  `admin_added_by` int(11) DEFAULT NULL,
  `admin_edit_date` datetime NOT NULL,
  `admin_edit_by` int(11) DEFAULT NULL,
  `admin_failed_login_attempts` int(11) DEFAULT '0',
  `admin_last_failed_login` datetime NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active',
  `admin_pass_verify_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `exp_verify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comm_admin`
--

INSERT INTO `comm_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_fname`, `admin_lname`, `admin_designation`, `admin_email`, `admin_mobile`, `admin_upm_id`, `admin_image`, `admin_last_login`, `admin_add_date`, `admin_added_by`, `admin_edit_date`, `admin_edit_by`, `admin_failed_login_attempts`, `admin_last_failed_login`, `admin_status`, `admin_pass_verify_code`, `exp_verify_date`) VALUES
(1, 'admined', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'anoop', 'daipuriya', 'super admin', 'anoop.daipuriya@mapit.gov.in', '9893892291', 1, NULL, '2021-10-10 07:13:06', '2017-05-30 00:00:00', 1, '2018-04-12 02:47:43', 1, 0, '0000-00-00 00:00:00', 1, '5518656834', '2018-10-03 11:39:28'),
(2, 'admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'keshav', 'raghuvanshi', 'editor', 'k.raghuvanshi@mapit.gov.in', '9993609950', 2, NULL, '2020-03-04 03:30:52', '2018-05-09 12:17:58', 1, '2018-07-28 03:02:28', 1, 1, '2020-09-11 11:10:08', 1, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comm_auth_acl`
--

CREATE TABLE `comm_auth_acl` (
  `auth_id` int(11) NOT NULL,
  `priviledge_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `auth_function` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_auth_acl`
--

INSERT INTO `comm_auth_acl` (`auth_id`, `priviledge_id`, `menu_id`, `auth_function`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`) VALUES
(3, 2, 22, 'index,add,edit', '2017-08-22 05:19:23', 1, '0000-00-00 00:00:00', 0, 1),
(13, 2, 68, 'index', '2017-08-26 12:38:08', 1, '2017-10-09 04:40:47', 1, 1),
(15, 2, 15, 'index,updateRecord', '2017-08-26 12:40:19', 1, '0000-00-00 00:00:00', 0, 1),
(16, 2, 24, 'index,add,edit,delete', '2017-08-26 12:42:33', 1, '0000-00-00 00:00:00', 0, 1),
(19, 2, 94, 'index,add,edit,delete', '2017-08-29 12:07:55', 1, '0000-00-00 00:00:00', 0, 1),
(20, 2, 93, 'index,add,edit,delete', '2017-08-29 12:08:03', 1, '0000-00-00 00:00:00', 0, 1),
(36, 2, 112, 'index,add,edit,delete', '2017-08-29 12:11:50', 1, '0000-00-00 00:00:00', 0, 1),
(38, 2, 98, 'index,add,edit,delete', '2017-08-29 12:12:12', 1, '0000-00-00 00:00:00', 0, 1),
(39, 2, 97, 'index,add,edit,delete', '2017-08-29 12:12:33', 1, '0000-00-00 00:00:00', 0, 1),
(40, 2, 95, 'index,add,edit,delete', '2017-08-29 12:12:47', 1, '0000-00-00 00:00:00', 0, 1),
(41, 2, 104, 'index,add,edit,delete', '2017-08-29 12:12:55', 1, '0000-00-00 00:00:00', 0, 1),
(42, 2, 101, 'index,add,edit,delete', '2017-08-29 12:13:15', 1, '0000-00-00 00:00:00', 0, 1),
(43, 2, 102, 'index,add,edit,delete', '2017-08-29 12:13:28', 1, '0000-00-00 00:00:00', 0, 1),
(44, 2, 100, 'index,add,edit,delete', '2017-08-29 12:13:34', 1, '0000-00-00 00:00:00', 0, 1),
(46, 2, 114, 'index', '2017-08-29 12:13:49', 1, '0000-00-00 00:00:00', 0, 1),
(47, 2, 19, 'index,add,delete', '2017-08-29 12:14:02', 1, '0000-00-00 00:00:00', 0, 1),
(48, 2, 108, 'index,add,edit,delete', '2017-08-29 12:14:23', 1, '0000-00-00 00:00:00', 0, 1),
(49, 2, 106, 'index,add,edit,delete', '2017-08-29 12:14:36', 1, '0000-00-00 00:00:00', 0, 1),
(50, 2, 105, 'index,bottomMenu,add,edit,delete,updateAll', '2017-08-29 12:14:45', 1, '0000-00-00 00:00:00', 0, 1),
(51, 2, 4, 'index,add,edit', '2017-08-29 12:14:53', 1, '0000-00-00 00:00:00', 0, 1),
(52, 3, 24, 'index,add,edit', '2017-08-29 12:30:58', 1, '0000-00-00 00:00:00', 0, 1),
(55, 3, 94, 'index,add,edit,delete', '2017-08-29 12:31:46', 1, '0000-00-00 00:00:00', 0, 1),
(56, 3, 93, 'index,add,edit,delete', '2017-08-29 12:32:05', 1, '0000-00-00 00:00:00', 0, 1),
(72, 3, 112, 'index,add,edit,delete', '2017-08-29 12:36:40', 1, '0000-00-00 00:00:00', 0, 1),
(74, 3, 98, 'index,add,edit,delete', '2017-08-29 12:37:46', 1, '0000-00-00 00:00:00', 0, 1),
(75, 3, 97, 'index,add,edit,delete', '2017-08-29 12:38:02', 1, '0000-00-00 00:00:00', 0, 1),
(76, 3, 95, 'index,add,edit,delete', '2017-08-29 12:38:25', 1, '0000-00-00 00:00:00', 0, 1),
(77, 3, 104, 'index,add,edit,delete', '2017-08-29 12:38:32', 1, '0000-00-00 00:00:00', 0, 1),
(78, 3, 101, 'index,add,edit,delete', '2017-08-29 12:38:47', 1, '0000-00-00 00:00:00', 0, 1),
(79, 3, 102, 'index,add,edit,delete', '2017-08-29 12:38:56', 1, '0000-00-00 00:00:00', 0, 1),
(80, 3, 100, 'index,add,edit,delete', '2017-08-29 12:39:07', 1, '0000-00-00 00:00:00', 0, 1),
(82, 3, 19, 'index,add', '2017-08-29 12:39:59', 1, '0000-00-00 00:00:00', 0, 1),
(83, 3, 108, 'index,add,edit', '2017-08-29 12:40:08', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comm_auth_controller_function`
--

CREATE TABLE `comm_auth_controller_function` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `auth_function_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `controller_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_auth_controller_function`
--

INSERT INTO `comm_auth_controller_function` (`id`, `menu_id`, `auth_function_name`, `controller_title`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`) VALUES
(5, 88, 'index,add_update,updateAll,delete', 'Admin Menu', '2017-08-18 10:49:58', 1, '2017-08-26 11:54:55', 1, 1),
(6, 129, 'index,add,edit,delete', 'Create Access List', '2017-08-22 03:56:11', 1, '2017-08-26 11:55:32', 1, 1),
(7, 130, 'index,add,edit,delete', 'Assign User Access', '2017-08-22 03:56:30', 1, '2017-08-26 11:56:13', 1, 1),
(8, 68, 'index,add,edit', 'User Menu Previlege', '2017-08-22 03:57:49', 1, '2017-08-26 11:56:37', 1, 1),
(9, 22, 'index,add,edit', 'Manage User', '2017-08-22 03:59:29', 1, '2017-08-26 11:56:47', 1, 1),
(10, 15, 'index,updateRecord', 'Social Link', '2017-08-22 04:02:14', 1, '2017-08-26 12:44:22', 1, 1),
(11, 24, 'index,add,edit,delete,page_default', 'Page', '2017-08-22 04:04:13', 1, '2017-08-26 11:57:28', 1, 1),
(14, 94, 'index,add,edit,delete', 'Photo Gallery Category', '2017-08-22 04:08:44', 1, '2017-08-26 12:43:48', 1, 1),
(15, 93, 'index,add,edit,delete', 'Photo Gallery', '2017-08-22 04:09:29', 1, '2017-08-26 12:43:58', 1, 1),
(29, 112, 'index,add,edit,delete', 'Events', '2017-08-22 04:24:25', 1, '2017-08-26 12:03:12', 1, 1),
(31, 98, 'index,add,edit,delete', 'Notice Board', '2017-08-22 04:25:56', 1, '2017-08-26 12:03:38', 1, 1),
(32, 97, 'index,add,edit,delete', 'Whats New', '2017-08-22 04:26:21', 1, '2017-08-26 12:03:54', 1, 1),
(33, 95, 'index,add,edit,delete,recycle', 'Important Link', '2017-08-22 04:27:21', 1, '2018-07-30 12:52:34', 1, 1),
(34, 104, 'index,add,edit,delete,recycle', 'Important Website', '2017-08-22 04:27:26', 1, '2018-07-30 12:52:48', 1, 1),
(35, 101, 'index,add,edit,delete', 'News', '2017-08-22 04:28:44', 1, '2018-07-30 12:57:05', 1, 1),
(36, 100, 'index,add,edit,delete', 'RTI', '2017-08-22 04:30:03', 1, '2017-08-26 12:05:15', 1, 1),
(38, 102, 'index,add,edit,delete', 'Services', '2017-08-22 04:30:30', 1, '2017-08-26 12:06:00', 1, 1),
(39, 114, 'index', 'Feedback', '2017-08-22 04:31:13', 1, '2017-08-26 12:05:40', 1, 1),
(40, 19, 'index,add,delete', 'Media', '2017-08-22 04:32:47', 1, '2017-08-26 12:06:21', 1, 1),
(41, 108, 'index,add,edit,delete', 'Slider', '2017-08-22 04:34:24', 1, '2017-08-26 12:06:10', 1, 1),
(43, 4, 'index,add,edit', 'Website Settings', '2017-08-22 04:58:15', 1, '2017-08-26 12:16:41', 1, 1),
(45, 105, 'index,bottomMenu,add,edit,delete,updateAll', 'Front Menu', '2017-08-26 12:15:02', 1, '0000-00-00 00:00:00', 0, 1),
(48, 106, 'index,add,edit,delete', 'Menu Module', '2017-08-29 12:00:16', 1, '0000-00-00 00:00:00', 0, 1),
(50, 147, 'index,add,edit,delete,recycle', 'Video Gallery Category', '2018-07-30 12:42:05', 1, '2018-07-30 12:43:28', 1, 1),
(51, 146, 'index,add,edit,delete,recycle', 'Video Gallery', '2018-07-30 12:43:50', 1, '0000-00-00 00:00:00', 0, 1),
(52, 152, 'index,add,edit,delete,recycle', 'Download', '2018-07-30 12:51:07', 1, '0000-00-00 00:00:00', 0, 1),
(53, 149, 'index,add,edit,delete,recycle', 'Contact Category', '2018-07-30 12:57:57', 1, '2018-07-30 12:58:21', 1, 1),
(54, 150, 'index,add,edit,delete,recycle', 'Contact Designation', '2018-07-30 12:59:29', 1, '0000-00-00 00:00:00', 0, 1),
(55, 151, 'index,add,edit,delete,recycle', 'Contactboard', '2018-07-30 12:59:52', 1, '0000-00-00 00:00:00', 0, 1),
(56, 143, 'index,add,edit,delete,recycle', 'Messageboard', '2018-07-30 01:00:20', 1, '0000-00-00 00:00:00', 0, 1),
(57, 153, 'index,add,edit,delete,recycle', 'Hospital Category', '2018-07-30 01:05:24', 1, '0000-00-00 00:00:00', 0, 1),
(58, 154, 'index,add,edit,delete,recycle', 'Hospital', '2018-07-30 01:05:43', 1, '0000-00-00 00:00:00', 0, 1),
(59, 156, 'index,add,edit,delete,recycle', 'Entitlement', '2018-07-30 01:05:59', 1, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comm_contact`
--

CREATE TABLE `comm_contact` (
  `id` int(11) NOT NULL,
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `work_allocation_hi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `work_allocation_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `d_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `res_phone_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_preference` int(11) NOT NULL DEFAULT '1',
  `order_modified_date` datetime NOT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_contact`
--

INSERT INTO `comm_contact` (`id`, `title_hi`, `title_en`, `email_address`, `contact_number`, `attachment`, `work_allocation_hi`, `work_allocation_en`, `type`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`, `is_delete`, `d_id`, `cat_id`, `phone_number`, `res_phone_number`, `order_preference`, `order_modified_date`, `location`) VALUES
(1, 'Anoop', 'Anoop', 'anoop@gmail.com', '', '', '', '', 1, '2018-11-15 04:04:49', 1, '2021-03-04 12:39:59', 0, 1, 0, 2, 1, '1236547890', '', 11, '0000-00-00 00:00:00', 0),
(2, 'Shubham', 'Shubhan', 'test@dsfds.com', '09098303738', 'water2-min7.jpg', 'test', 'tewt', 1, '2019-11-16 12:50:45', 1, '2021-03-04 12:40:01', 0, 1, 0, 2, 1, '12341234567', '09098303738', 12, '0000-00-00 00:00:00', 0),
(3, 'Shubham', 'Shubham', 'test@test.com', '09098303738', '', '', '', 1, '2019-11-16 12:53:14', 1, '2019-11-16 02:14:00', 1, 1, 1, 2, 1, '08103053046', '09098303738', 13, '0000-00-00 00:00:00', 0),
(4, 'Manish Singh', 'Manish SIngh', 'manish.singh@test.com', '', '31.png', '', '', 1, '2019-12-07 11:25:04', 1, '2021-03-04 12:40:04', 0, 1, 0, 1, 1, '', '', 14, '0000-00-00 00:00:00', 0),
(5, 'Dr. Ajit Sharma', 'Dr. Ajit Sharma', '', '', '', '', '', 1, '2019-12-07 04:41:12', 2, '2020-09-26 04:04:41', 1, 1, 0, 6, 1, '0755-2708598', '', 1, '2019-12-07 17:02:28', 1),
(6, 'श्री बाल मुकुंद सोनी', 'Sri Bal Mukund Soni', 'pd.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:47:01', 2, '2021-03-04 12:39:52', 0, 1, 0, 3, 1, '0755-2579874', '', 2, '2019-12-07 17:02:36', 0),
(7, 'श्री प्रकाश चन्द्र जैन', 'Sri Prakash Chandra Jain', 'cgm.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:52:47', 2, '2021-03-04 12:39:54', 0, 1, 0, 2, 1, '0755 -2579874', '', 3, '2019-12-07 17:02:46', 0),
(8, 'श्री आशीष श्रीवास्तव', 'Sri Ashish Srivastava', 'cgm2.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:54:42', 2, '2021-03-04 12:39:56', 0, 1, 0, 2, 1, '0755 -2579874', '', 4, '2019-12-07 17:02:55', 0),
(9, 'श्री पी के रघुवंशी', 'Sri P K Raghuwanshi', 'gmproc.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:56:46', 2, '2021-03-04 12:39:57', 0, 1, 0, 4, 1, '0755 -2579874', '', 5, '2019-12-07 17:03:08', 0),
(10, 'श्री आलोक कुमार जैन', 'Sri Alok Kumar Jain', 'gmdnm.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:58:07', 2, '2021-03-04 12:40:07', 0, 1, 0, 4, 1, '0755 -2579874', '', 7, '2019-12-07 17:03:36', 0),
(11, 'श्री दिलीप कुमार जैन', 'Sri Dilip Kumar Jain', 'gmgen.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 04:59:18', 2, '2021-03-04 12:40:05', 0, 1, 0, 4, 1, '0755 -2579874', '', 6, '2019-12-07 17:03:26', 0),
(12, 'श्री प्रवीण कुमार गुरु', 'Sri Praveen Kumar Guru', 'gmplan.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 05:00:28', 2, '2021-03-04 12:40:08', 0, 1, 0, 4, 1, '0755 -2579874', '', 8, '2019-12-07 17:03:54', 0),
(13, 'श्री विजय जादोन', 'Sri Vijay Jadon', 'gmcp.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 05:02:07', 2, '2020-09-26 04:03:08', 1, 1, 1, 4, 1, '0755 -2579874', '', 9, '2019-12-07 17:04:01', 0),
(14, 'श्री सुबोध शर्मा', 'Sri Subodh Sharma', 'cfo.mpjalnigam@mp.gov.in', '', '', '', '', 1, '2019-12-07 05:16:41', 2, '2020-09-26 04:03:05', 1, 1, 1, 5, 1, '0755 -2579874', '', 10, '2019-12-07 17:17:24', 0),
(15, 'Mr. Alok Nayak', 'Mr. Alok Nayak', 'nayakalok@mp.gov.in', '', '', '', '', 1, '2020-09-26 04:06:17', 1, '2021-03-04 12:33:43', 1, 1, 0, 6, 1, '1234567890', '', 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comm_contact_category`
--

CREATE TABLE `comm_contact_category` (
  `cat_id` int(11) NOT NULL,
  `category_hi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `edit_by` varchar(45) COLLATE utf8_unicode_ci DEFAULT '0',
  `cat_status` tinyint(2) DEFAULT '1',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_contact_category`
--

INSERT INTO `comm_contact_category` (`cat_id`, `category_hi`, `category_en`, `added_date`, `added_by`, `edit_date`, `edit_by`, `cat_status`, `is_delete`) VALUES
(1, 'प्रधान कार्यालय', 'Head Office', '2018-01-06 03:30:39', 1, '2018-07-25 03:30:41', '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_contact_designation`
--

CREATE TABLE `comm_contact_designation` (
  `d_id` int(11) NOT NULL,
  `designation_hi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `cat_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  `is_delete` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_contact_designation`
--

INSERT INTO `comm_contact_designation` (`d_id`, `designation_hi`, `designation_en`, `status`, `cat_id`, `added_date`, `added_by`, `edit_date`, `edit_by`, `is_delete`) VALUES
(1, 'प्रबंध संचालक', 'Managing Director', '1', 1, '2018-07-25 00:00:00', 1, '2018-08-14 03:49:41', 3, 1),
(2, 'मुख्य महा प्रबंधक', 'Chief General Manager', '1', 1, '2018-08-08 00:00:00', 3, '2019-12-07 00:00:00', 2, 0),
(3, 'परियोजना निर्देशक', 'Project Director', '1', 1, '2018-08-08 00:00:00', 3, '2019-12-07 00:00:00', 2, 0),
(4, 'महा प्रबंधक', 'General Manager', '1', 1, '2018-08-08 00:00:00', 3, '2019-12-07 00:00:00', 2, 0),
(5, 'मुख्य वित्त्त अधिकारी', 'Chief Finance Officer', '1', 1, '2018-08-23 00:00:00', 3, '2019-12-11 00:00:00', 2, 0),
(6, 'Project Fellow', 'Project Fellow', '1', 1, '2020-09-26 00:00:00', 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_events`
--

CREATE TABLE `comm_events` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_hi` text COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `event_start_date` datetime NOT NULL,
  `event_end_date` datetime NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `is_archive` tinyint(2) NOT NULL DEFAULT '0',
  `order_preference` int(11) NOT NULL DEFAULT '1',
  `order_modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_events`
--

INSERT INTO `comm_events` (`id`, `cat_id`, `title_hi`, `title_en`, `description_hi`, `description_en`, `attachment`, `event_start_date`, `event_end_date`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`, `is_delete`, `is_archive`, `order_preference`, `order_modified_date`) VALUES
(1, 0, 'पुंजापुरा समूह जल प्रदाय योजना', 'Punjapura MVRWSS*', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:293px;\" width=\"294\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"30\">\r\n			<td colspan=\"2\" height=\"30\" style=\"height: 30px; width: 293px; text-align: center;\">\r\n				<span style=\"font-size:16px;\"><strong>परियोजना एक नज़र मे&nbsp;</strong></span></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:155px;\">\r\n				<strong>परियोजना का नाम&nbsp;</strong></td>\r\n			<td style=\"width:139px;\">\r\n				<strong>पुंजापुरा समूह जल प्रदाय योजना&nbsp;</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				जिला</td>\r\n			<td style=\"width:139px;\">\r\n				देवास&nbsp;</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				गाँवों की संख्या&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				25</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				कनेक्शनों&nbsp; की संख्या&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				3770</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				लाभान्वित जनसँख्या&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				23825</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				प्रारंभ दिनांक&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				07.08.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				पूर्ण दिनांक&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				01.09.2017</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:155px;\">\r\n				परियोजना की लागत (रु. करोड़ में )</td>\r\n			<td style=\"width:139px;\">\r\n				25.04</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				संचालन संधारण अवधि&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 वर्ष&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:293px;\" width=\"294\">\r\n	<colgroup>\r\n		<col />\r\n		<col />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"42\">\r\n			<td colspan=\"2\" height=\"42\" style=\"height: 42px; width: 293px; text-align: center;\">\r\n				<strong><span style=\"font-size:16px;\">Project At A Glance</span></strong></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:155px;\">\r\n				<strong>Project Name</strong></td>\r\n			<td style=\"width:139px;\">\r\n				<strong>Punjapura MVRWSS</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				District</td>\r\n			<td style=\"width:139px;\">\r\n				Dewas</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				No. of Villages Covered</td>\r\n			<td style=\"width:139px;\">\r\n				25</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				No. of Connections&nbsp;</td>\r\n			<td style=\"width:139px;\">\r\n				3770</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td height=\"20\" style=\"height:20px;width:155px;\">\r\n				Population&nbsp;Benefited</td>\r\n			<td style=\"width:139px;\">\r\n				23825</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				Start Date</td>\r\n			<td style=\"width:139px;\">\r\n				07.08.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				Completion Date</td>\r\n			<td style=\"width:139px;\">\r\n				01.09.2017</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:155px;\">\r\n				Project Cost (Rs. In Cr.)</td>\r\n			<td style=\"width:139px;\">\r\n				25.04</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:155px;\">\r\n				Operation &amp; Maintanance Duration&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 years&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', '', '2019-11-20 02:10:00', '2019-11-27 06:30:00', '2019-11-16 10:44:01', 1, '2019-12-10 10:45:33', 1, 1, 1, 0, 4, '2019-12-09 11:02:41'),
(2, 0, 'मरदानपुर  समूह जल प्रदाय योजना', 'Mardanpur MVRWSS*', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 365px;\" width=\"365\">\r\n	<tbody>\r\n	</tbody>\r\n</table>\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:303px;\" width=\"303\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"30\">\r\n			<td colspan=\"2\" height=\"30\" style=\"height: 30px; width: 303px; text-align: center;\">\r\n				<strong><span style=\"font-size:16px;\">परियोजना एक नज़र मे&nbsp;</span></strong></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:179px;\">\r\n				परियोजना का नाम&nbsp;</td>\r\n			<td align=\"left\" style=\"width:124px;\">\r\n				<strong>मरदानपुर&nbsp; समूह जल प्रदाय योजना&nbsp;</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				जिला</td>\r\n			<td align=\"left\" style=\"width:124px;\">\r\n				सीहोर&nbsp;</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				गाँवों की संख्या&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				187</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				कनेक्शनों&nbsp; की संख्या&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				24787</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				लाभान्वित जनसँख्या&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				224542</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				प्रारंभ दिनांक&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				23.01.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				पूर्ण दिनांक&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				01.01.2018</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:179px;\">\r\n				परियोजना की लागत (रु. करोड़ में )</td>\r\n			<td style=\"width:124px;\">\r\n				274.65</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				संचालन संधारण अवधि&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 वर्ष&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:303px;\" width=\"303\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"42\">\r\n			<td colspan=\"2\" height=\"42\" style=\"height: 42px; width: 303px; text-align: center;\">\r\n				<span style=\"font-size:16px;\"><strong>Project At A Glance</strong></span></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:179px;\">\r\n				Project Name</td>\r\n			<td align=\"left\" style=\"width:124px;\">\r\n				Mardanpur MVRWSS</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				District</td>\r\n			<td align=\"left\" style=\"width:124px;\">\r\n				Sehore</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				No. of Villages Covered</td>\r\n			<td style=\"width:124px;\">\r\n				187</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				No. of Connections&nbsp;</td>\r\n			<td style=\"width:124px;\">\r\n				25787</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				Population&nbsp;Benefited</td>\r\n			<td style=\"width:124px;\">\r\n				224542</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				Start Date</td>\r\n			<td style=\"width:124px;\">\r\n				23.01.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				Completion Date</td>\r\n			<td style=\"width:124px;\">\r\n				01.01.2018</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:179px;\">\r\n				Project Cost (Rs. In Cr.)</td>\r\n			<td style=\"width:124px;\">\r\n				274.65</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:179px;\">\r\n				Operation &amp; Maintanance Duration&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 years&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'Mardanpur.jpg', '2019-11-19 01:05:00', '2019-11-27 05:25:00', '2019-11-16 10:45:09', 1, '2019-12-10 10:45:11', 1, 1, 1, 0, 3, '0000-00-00 00:00:00'),
(3, 0, 'झुरकी समूह जल प्रदाय योजना', 'Jhurki MVRWSS', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:279px;\" width=\"279\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"30\">\r\n			<td colspan=\"2\" height=\"30\" style=\"height: 30px; width: 279px; text-align: center;\">\r\n				<span style=\"font-size:16px;\"><strong>परियोजना एक नज़र मे&nbsp;</strong></span></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:172px;\">\r\n				<strong>परियोजना का नाम&nbsp;</strong></td>\r\n			<td align=\"left\" style=\"width:107px;\">\r\n				<strong>झुरकी समूह ज</strong>ल प्रदाय योजना&nbsp;</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				जिला</td>\r\n			<td align=\"left\" style=\"width:107px;\">\r\n				सिवनी&nbsp;</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				गाँवों की संख्या&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				15</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				कनेक्शनों&nbsp; की संख्या&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				1116</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				लाभान्वित जनसँख्या&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				9518</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				प्रारंभ दिनांक&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				07.08.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				पूर्ण दिनांक&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				01.11.2017</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:172px;\">\r\n				परियोजना की लागत (रु. करोड़ में )</td>\r\n			<td style=\"width:107px;\">\r\n				13.17</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				संचालन संधारण अवधि&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 वर्ष&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:279px;\" width=\"279\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"42\">\r\n			<td colspan=\"2\" height=\"42\" style=\"height: 42px; width: 279px; text-align: center;\">\r\n				<span style=\"font-size:16px;\"><strong>Project At A Glance</strong></span></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:172px;\">\r\n				<strong>Project Name</strong></td>\r\n			<td align=\"left\" style=\"width:107px;\">\r\n				<strong>Jhurki MVRWSS</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				District</td>\r\n			<td align=\"left\" style=\"width:107px;\">\r\n				Seoni</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td height=\"20\" style=\"height:20px;width:172px;\">\r\n				No. of Villages Covered</td>\r\n			<td style=\"width:107px;\">\r\n				15</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				No. of Connections&nbsp;</td>\r\n			<td style=\"width:107px;\">\r\n				1116</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td height=\"20\" style=\"height:20px;width:172px;\">\r\n				Population&nbsp;Benefited</td>\r\n			<td style=\"width:107px;\">\r\n				9518</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				Start Date</td>\r\n			<td style=\"width:107px;\">\r\n				07.08.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				Completion Date</td>\r\n			<td style=\"width:107px;\">\r\n				01.11.2017</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:172px;\">\r\n				Project Cost (Rs. In Cr.)</td>\r\n			<td style=\"width:107px;\">\r\n				13.17</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:172px;\">\r\n				Operation &amp; Maintanance Duration&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 years&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'Jhurki.jpg', '2019-11-26 05:25:00', '2019-12-04 10:50:00', '2019-11-16 10:46:37', 1, '2019-12-10 10:44:52', 1, 1, 1, 0, 2, '2019-12-09 18:10:21'),
(4, 0, 'उदयपूरा समूह जल प्रदाय योजना', 'Udaipura MVRWSS', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:288px;\" width=\"287\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"30\">\r\n			<td colspan=\"2\" height=\"30\" style=\"height: 30px; width: 288px; text-align: center;\">\r\n				<strong><span style=\"font-size:16px;\">परियोजना एक नज़र मे&nbsp;</span></strong></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:177px;\">\r\n				<strong>परियोजना का नाम&nbsp;</strong></td>\r\n			<td align=\"left\" style=\"width:111px;\">\r\n				<strong>उदयपूरा समूह जल प्रदाय योजना&nbsp;</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				जिला</td>\r\n			<td align=\"left\" style=\"width:111px;\">\r\n				रायसेन&nbsp;</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				गाँवों की संख्या&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				107</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				कनेक्शनों&nbsp; की संख्या&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				14897</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				लाभान्वित जनसँख्या&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				149980</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				प्रारंभ दिनांक&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				24.01.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				पूर्ण दिनांक&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				01.11.2018</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:177px;\">\r\n				परियोजना की लागत (रु. करोड़ में )</td>\r\n			<td style=\"width:111px;\">\r\n				155.73</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				संचालन संधारण अवधि&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 वर्ष&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:288px;\" width=\"287\">\r\n	<colgroup>\r\n		<col style=\"text-align: center;\" />\r\n		<col style=\"text-align: center;\" />\r\n	</colgroup>\r\n	<tbody>\r\n		<tr height=\"42\">\r\n			<td colspan=\"2\" height=\"42\" style=\"height: 42px; width: 288px; text-align: center;\">\r\n				<span style=\"font-size:16px;\"><strong>Project At A Glance</strong></span></td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:177px;\">\r\n				<strong>Project Name</strong></td>\r\n			<td align=\"left\" style=\"width:111px;\">\r\n				<strong>Udaipura MVRWSS</strong></td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				District</td>\r\n			<td align=\"left\" style=\"width:111px;\">\r\n				Raisen</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td height=\"20\" style=\"height:20px;width:177px;\">\r\n				No. of Villages Covered</td>\r\n			<td style=\"width:111px;\">\r\n				107</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				No. of Connections&nbsp;</td>\r\n			<td style=\"width:111px;\">\r\n				14897</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td height=\"20\" style=\"height:20px;width:177px;\">\r\n				Population&nbsp;Benefited</td>\r\n			<td style=\"width:111px;\">\r\n				149980</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				Start Date</td>\r\n			<td style=\"width:111px;\">\r\n				24.01.2014</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				Completion Date</td>\r\n			<td style=\"width:111px;\">\r\n				01.11.2018</td>\r\n		</tr>\r\n		<tr height=\"20\">\r\n			<td align=\"left\" height=\"20\" style=\"height:20px;width:177px;\">\r\n				Project Cost (Rs. In Cr.)</td>\r\n			<td style=\"width:111px;\">\r\n				155.73</td>\r\n		</tr>\r\n		<tr height=\"32\">\r\n			<td align=\"left\" height=\"32\" style=\"height:32px;width:177px;\">\r\n				Operation &amp; Maintanance Duration&nbsp;</td>\r\n			<td align=\"left\">\r\n				10 years&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'Udaipura.JPG', '2019-11-13 10:25:00', '2019-12-04 09:45:00', '2019-11-16 10:46:58', 1, '2019-12-10 10:44:24', 1, 1, 1, 0, 1, '2019-12-09 18:10:13'),
(5, 1, 'Biosphere Reserve Projects', 'Biosphere Reserve Projects', '<p>\r\n	<span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span></p>', '<p>\r\n	<span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span><span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Biosphere Reserve Projects </span></p>', 'vcr.jpg', '2020-09-14 03:15:00', '2020-10-03 07:35:00', '2020-09-14 03:57:46', 1, '0000-00-00 00:00:00', 1, 1, 1, 0, 1, '0000-00-00 00:00:00'),
(6, 1, 'Climate Change Action Projects', 'Climate Change Action Projects', '<p>\r\n	<span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been </span></p>', '<p>\r\n	<span style=\"font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been </span></p>', 'vcr-2.jpg', '2020-09-08 04:35:00', '2020-10-10 11:55:00', '2020-09-14 04:40:56', 1, '0000-00-00 00:00:00', 1, 1, 1, 0, 1, '0000-00-00 00:00:00'),
(7, 1, 'Event name', 'Event name', '<p>\r\n	Event name&nbsp;</p>', '<p>\r\n	Event name&nbsp;</p>', 'event4.jpg', '2020-09-28 05:25:00', '2020-10-10 11:55:00', '2020-09-17 03:11:33', 1, '0000-00-00 00:00:00', 0, 1, 0, 0, 1, '0000-00-00 00:00:00'),
(8, 1, 'Event name', 'Event name', '<p>\r\n	Event name&nbsp;</p>', '<p>\r\n	Event name&nbsp;</p>', 'event3.jpg', '2020-09-07 07:35:00', '2020-10-10 11:55:00', '2020-09-17 03:11:52', 1, '0000-00-00 00:00:00', 0, 1, 0, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comm_events_media`
--

CREATE TABLE `comm_events_media` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comm_events_media`
--

INSERT INTO `comm_events_media` (`id`, `event_id`, `attachment`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`) VALUES
(13, 7, 'DSC100339491.jpg', '2021-01-23 16:35:21', 1, '0000-00-00 00:00:00', 0, 0),
(14, 7, 'img_(3).jpg', '2021-01-23 16:35:27', 1, '0000-00-00 00:00:00', 0, 0),
(15, 7, 'nature-3082832__340.jpg', '2021-01-23 16:35:27', 1, '0000-00-00 00:00:00', 0, 0),
(16, 8, 'img_(4).jpg', '2021-01-23 16:35:38', 1, '0000-00-00 00:00:00', 0, 0),
(17, 7, 'Screenshot_(2).png', '2021-08-17 13:05:00', 1, '0000-00-00 00:00:00', 0, 0),
(18, 7, 'Screenshot_(13).png', '2021-08-17 13:56:44', 1, '0000-00-00 00:00:00', 0, 0),
(19, 7, 'Screenshot_(8).png', '2021-08-17 13:57:09', 1, '0000-00-00 00:00:00', 0, 0),
(20, 7, 'Screenshot_(7).png', '2021-08-17 14:54:29', 1, '0000-00-00 00:00:00', 0, 0),
(21, 7, 'Screenshot_(7)1.png', '2021-08-17 14:57:44', 1, '0000-00-00 00:00:00', 0, 0),
(22, 7, 'Screenshot_(13)1.png', '2021-08-17 15:01:09', 1, '0000-00-00 00:00:00', 0, 0),
(23, 7, 'Screenshot_(7)2.png', '2021-08-17 15:05:57', 1, '0000-00-00 00:00:00', 0, 0),
(24, 7, 'Screenshot_(13)2.png', '2021-08-17 15:06:01', 1, '0000-00-00 00:00:00', 0, 0),
(25, 7, 'screencapture-localhost-8080-MP-Aadhyatm-manage-MandirPujari-add-a3BHUnpXUHY1YmlFbW9xOHAvSm9WQT09-20', '2021-08-26 11:03:22', 1, '0000-00-00 00:00:00', 0, 0),
(26, 7, 'screencapture-localhost-8080-MP-Aadhyatm-manage-MandirPujari-add-a3BHUnpXUHY1YmlFbW9xOHAvSm9WQT09-20', '2021-08-26 11:03:22', 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_feedback`
--

CREATE TABLE `comm_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `feedback_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `feedback_mobile` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `feedback_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feedback_message` text COLLATE utf8_unicode_ci NOT NULL,
  `feedback_type` tinyint(2) NOT NULL DEFAULT '1',
  `feedback_date` datetime NOT NULL,
  `feedback_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comm_feedback`
--

INSERT INTO `comm_feedback` (`feedback_id`, `feedback_name`, `feedback_email`, `feedback_mobile`, `feedback_subject`, `feedback_message`, `feedback_type`, `feedback_date`, `feedback_status`) VALUES
(1, 'Anoop', 'anoop.daipuriya@mapit.gov.in', '9893892291', 'query', 'test message', 2, '2018-11-15 02:38:57', 1),
(2, 'Anoop', 'anoop.daipuriya@mapit.gov.in', '9893892291', 'test', 'test message', 1, '2018-11-15 02:46:00', 1),
(3, 'Tets', 'shubham.magre@mapit.gov.in', '8878177177', 'Test feedback', 'test message', 1, '2018-11-22 04:21:00', 1),
(4, 'Tes', 'anoop.daipuriya@mapit.gov.in', '1234567890', 'test', 'test message', 1, '2018-11-26 03:11:47', 1),
(5, 'Test', 'shubham.magre@mapit.gov.in', '8878177177', 'Test', 'Test', 1, '2018-11-27 04:33:05', 1),
(6, 'Shubham', 'shubham.sss05@gmail.com', '8103053046', 'test', 'test', 1, '2019-11-16 01:59:10', 1),
(7, 'Dfgdfg', 'dg@wy.ftg', '4565644467', 'dh', 'dhdfhdh', 2, '2020-09-25 01:04:02', 1),
(8, 'Shubha', 'shubha.pachori@mapit.gov.in', '9807654378', 'test', 'test', 1, '2020-09-26 04:54:18', 1),
(9, 'Cvb', 'fgh@fhj.fcg', '1234567890', 'fgh', 'cfgbfgdfg', 1, '2020-10-01 02:26:51', 1),
(10, 'FGHFGH', 'RR@GMAIL.COM', '1234567890', 'CVB', 'RR@GMAIL.COMRR@GMAIL.COMRR@GMAIL.COM', 1, '2020-10-01 02:29:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comm_financereport`
--

CREATE TABLE `comm_financereport` (
  `id` int(11) NOT NULL,
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_archive` tinyint(2) NOT NULL DEFAULT '0',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `archive_exp_date` datetime NOT NULL,
  `order_preference` int(11) NOT NULL DEFAULT '1',
  `order_modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comm_media`
--

CREATE TABLE `comm_media` (
  `id` int(11) NOT NULL,
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_media`
--

INSERT INTO `comm_media` (`id`, `title_hi`, `title_en`, `attachment`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`) VALUES
(1, '', '', 'Proforma.docx', '2019-02-08 16:03:50', 1, '0000-00-00 00:00:00', 0, 0),
(2, '', '', 'OC.jpg', '2019-12-10 12:42:50', 1, '0000-00-00 00:00:00', 0, 0),
(3, '', '', 'BOD1.jpg', '2019-12-10 12:42:50', 1, '0000-00-00 00:00:00', 0, 0),
(4, '', '', 'PIU.jpg', '2019-12-10 12:42:51', 1, '0000-00-00 00:00:00', 0, 0),
(5, '', '', '2_MPJNM_MOM.pdf', '2019-12-10 12:59:39', 1, '0000-00-00 00:00:00', 0, 0),
(6, '', '', '1_MPJNM_Co_Reg_Certs.pdf', '2019-12-10 12:59:39', 1, '0000-00-00 00:00:00', 0, 0),
(7, '', '', '3_MPJNM_AOA.pdf', '2019-12-10 12:59:40', 1, '0000-00-00 00:00:00', 0, 0),
(8, '', '', 'epco_2.png', '2021-01-06 16:31:39', 1, '0000-00-00 00:00:00', 0, 0),
(9, '', '', 'vision.jpg', '2021-01-06 16:31:39', 1, '0000-00-00 00:00:00', 0, 0),
(10, '', '', 'epco_4_(1).jpg', '2021-01-06 16:31:39', 1, '0000-00-00 00:00:00', 0, 0),
(11, '', '', 'img1.jpg', '2021-01-06 16:31:39', 1, '0000-00-00 00:00:00', 0, 0),
(12, '', '', 'epco_4_(1)1.jpg', '2021-01-07 11:19:31', 1, '0000-00-00 00:00:00', 0, 0),
(13, '', '', 'img11.jpg', '2021-01-07 11:19:32', 1, '0000-00-00 00:00:00', 0, 0),
(14, '', '', 'vcr-3.jpg', '2021-01-07 12:15:10', 1, '0000-00-00 00:00:00', 0, 0),
(15, '', '', 'vcr-4.jpg', '2021-01-07 12:15:10', 1, '0000-00-00 00:00:00', 0, 0),
(16, '', '', 'vcr-2.jpg', '2021-01-07 12:15:10', 1, '0000-00-00 00:00:00', 0, 0),
(17, '', '', 'epco_21.png', '2021-01-07 12:15:32', 1, '0000-00-00 00:00:00', 0, 0),
(18, '', '', 'epco_8.jpg', '2021-04-22 14:10:00', 1, '0000-00-00 00:00:00', 0, 0),
(19, '', '', 'epco_81.jpg', '2021-04-22 17:10:11', 1, '0000-00-00 00:00:00', 0, 0),
(20, '', '', 'Bug_10457.mp4', '2021-08-03 12:49:44', 1, '0000-00-00 00:00:00', 0, 0),
(21, '', '', 'Screenshot_(7).png', '2021-08-17 13:04:29', 1, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_menu`
--

CREATE TABLE `comm_menu` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `page_module_link` int(11) NOT NULL,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL DEFAULT '0',
  `custom_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `html_block` text COLLATE utf8_unicode_ci NOT NULL,
  `icon_class` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `title_hi` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mega_menu` tinyint(2) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `tab_same_new` int(11) NOT NULL DEFAULT '0' COMMENT '1=Same, 2=Newew',
  `menu_order` int(11) NOT NULL DEFAULT '1',
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_menu`
--

INSERT INTO `comm_menu` (`id`, `type_id`, `page_module_link`, `page_id`, `module_id`, `custom_url`, `html_block`, `icon_class`, `title_hi`, `title_en`, `mega_menu`, `parent_id`, `tab_same_new`, `menu_order`, `added_date`, `added_by`, `edit_date`, `edit_by`) VALUES
(1, 1, 3, 0, 0, 'http://localhost/3spnew/', '', 'fa fa-home', 'मुख्य पृष्ठ', 'Home', 0, 0, 1, 1, '2017-06-20 11:44:25', 1, '2021-10-10 10:18:39', 1),
(166, 1, 2, 0, 26, '', '', '', 'संपर्क करें', 'Contact Us', 0, 0, 1, 17, '2018-11-14 05:16:57', 1, '2021-10-10 07:17:07', 1),
(280, 1, 3, 0, 0, '#', '', '', 'हमारे बारे में', 'About us', 0, 0, 1, 2, '2021-10-09 01:02:16', 1, '2021-10-10 07:15:19', 1),
(284, 1, 1, 3, 0, '', '', '', 'Our Commitment', 'Our Commitment', 0, 280, 1, 3, '2021-10-10 09:21:00', 1, '2021-10-10 07:15:37', 1),
(285, 1, 1, 4, 0, '', '', '', 'Mission/Vission/Values', 'Mission/Vission/Values', 0, 280, 1, 5, '2021-10-10 09:24:24', 1, '2021-10-10 07:15:44', 1),
(286, 1, 1, 5, 0, '', '', '', 'Our Leadership Team', 'Our Leadership  Team', 0, 280, 1, 6, '2021-10-10 09:29:33', 1, '2021-10-10 07:15:51', 1),
(287, 1, 1, 7, 0, '', '', '', 'Client review/Testimonials', 'Client review/Testimonials', 0, 280, 1, 7, '2021-10-10 09:51:32', 1, '2021-10-10 07:15:58', 1),
(288, 1, 1, 1, 0, '', '', '', 'Company Profile', 'Company Profile', 0, 280, 1, 4, '2021-10-10 09:53:45', 1, '2021-10-10 10:23:41', 1),
(289, 1, 3, 0, 0, '#', '', '', 'Job Seeker', 'Job Seeker', 0, 0, 1, 14, '2021-10-10 09:56:56', 1, '2021-10-10 07:16:17', 1),
(290, 1, 1, 8, 0, '', '', '', 'Career Artical', 'Career Artical', 0, 289, 1, 15, '2021-10-10 09:59:23', 1, '2021-10-10 07:16:22', 1),
(291, 1, 1, 9, 0, '', '', '', 'Industries We Serve', 'Industries We Serve', 0, 0, 1, 16, '2021-10-10 10:02:27', 1, '2021-10-10 07:16:27', 1),
(292, 1, 3, 0, 0, '#', '', '', 'Our Services', 'Our Services', 0, 0, 1, 8, '2021-10-10 07:13:53', 1, '0000-00-00 00:00:00', 0),
(293, 1, 3, 0, 0, '#', '', '', 'Current Openings', 'Current Openings', 0, 0, 1, 18, '2021-10-10 07:14:49', 1, '0000-00-00 00:00:00', 0),
(296, 2, 1, 1, 0, '', '', '', 'About 3SP Resources', 'About 3SP Resources', 0, 0, 1, 1, '2021-10-10 07:37:32', 1, '0000-00-00 00:00:00', 0),
(298, 2, 1, 7, 0, '', '', '', 'Client Reviews', 'Client Reviews', 0, 0, 1, 2, '2021-10-10 07:38:47', 1, '0000-00-00 00:00:00', 0),
(299, 2, 3, 0, 0, '#', '', '', 'Post Resume', 'Post Resume', 0, 0, 1, 3, '2021-10-10 07:39:03', 1, '0000-00-00 00:00:00', 0),
(300, 2, 3, 0, 0, 'contact-us', '', '', 'Free Consultation', 'Free Consultation', 0, 0, 1, 4, '2021-10-10 07:39:57', 1, '0000-00-00 00:00:00', 0),
(301, 2, 3, 0, 0, '#', '', '', '3SP Photo Gallery', '3SP Photo Gallery', 0, 0, 1, 5, '2021-10-10 07:40:47', 1, '0000-00-00 00:00:00', 0),
(302, 2, 3, 0, 0, '#', '', '', 'Post Your Requirements', 'Post Your Requirements', 0, 0, 1, 6, '2021-10-10 07:41:48', 1, '0000-00-00 00:00:00', 0),
(303, 2, 1, 5, 0, '', '', '', 'Our Team', 'Our Team', 0, 0, 1, 7, '2021-10-10 07:42:08', 1, '0000-00-00 00:00:00', 0),
(304, 2, 1, 4, 0, '', '', '', 'Our Focus', 'Our Focus', 0, 0, 1, 8, '2021-10-10 07:42:35', 1, '0000-00-00 00:00:00', 0),
(305, 2, 1, 3, 0, '', '', '', 'Our Commitment', 'Our Commitment', 0, 0, 1, 9, '2021-10-10 07:43:06', 1, '0000-00-00 00:00:00', 0),
(306, 2, 3, 0, 0, '#', '', '', 'Industries we serve', 'Industries we serve', 0, 0, 1, 10, '2021-10-10 07:43:31', 1, '0000-00-00 00:00:00', 0),
(307, 3, 3, 0, 0, '#', '', '', 'Manpower Recruitment  Services', 'Manpower Recruitment  Services', 0, 0, 1, 1, '2021-10-10 08:26:39', 1, '0000-00-00 00:00:00', 0),
(309, 3, 3, 0, 0, '#', '', '', 'Placement Services', 'Placement Services', 0, 0, 1, 2, '2021-10-10 08:28:26', 1, '0000-00-00 00:00:00', 0),
(310, 3, 3, 0, 0, '#', '', '', 'IT Services', 'IT Services', 0, 0, 1, 3, '2021-10-10 08:29:11', 1, '0000-00-00 00:00:00', 0),
(311, 3, 3, 0, 0, '#', '', '', 'Training', 'Training', 0, 0, 1, 4, '2021-10-10 08:29:30', 1, '0000-00-00 00:00:00', 0),
(312, 3, 3, 0, 0, '#', '', '', 'Temp staffing', 'Temp staffing', 0, 0, 1, 5, '2021-10-10 08:30:03', 1, '0000-00-00 00:00:00', 0),
(313, 1, 1, 10, 0, '', '', '', 'Manpower Recruitment Services', 'Manpower Recruitment Services', 0, 292, 1, 9, '2021-10-10 10:51:26', 1, '0000-00-00 00:00:00', 0),
(314, 1, 1, 11, 0, '', '', '', 'Placement Services', 'Placement Services', 0, 292, 1, 10, '2021-10-10 10:55:39', 1, '0000-00-00 00:00:00', 0),
(315, 1, 1, 12, 0, '', '', '', 'IT Services', 'IT Services', 0, 292, 1, 11, '2021-10-10 11:14:20', 1, '0000-00-00 00:00:00', 0),
(316, 1, 1, 13, 0, '', '', '', 'Training', 'Training', 0, 292, 1, 12, '2021-10-10 11:14:44', 1, '0000-00-00 00:00:00', 0),
(317, 1, 1, 14, 0, '', '', '', 'Temp staffing', 'Temp staffing', 0, 292, 1, 13, '2021-10-10 11:15:03', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_menu_modules`
--

CREATE TABLE `comm_menu_modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_menu_modules`
--

INSERT INTO `comm_menu_modules` (`module_id`, `module_name`, `module_url`, `added_date`, `added_by`, `edit_date`, `edit_by`) VALUES
(1, 'What\'s New', 'whatsnew', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(2, 'Circulars', 'circular', '2017-06-01 00:00:00', 1, '2017-07-14 02:23:37', 1),
(3, 'Notice Board', 'noticeboard', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(4, 'Events', 'events', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(5, 'Schemes', 'schemes', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(6, 'Services', 'services', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(7, 'Forms & Download', 'download', '2017-06-01 00:00:00', 1, '2017-07-05 05:52:31', 1),
(8, 'Rules & Acts', 'rulesacts', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(9, 'Right to Information', 'rti', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(10, 'Important Links', 'implinks', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(11, 'Important Websites', 'impwebsites', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(14, 'News', 'news-details', '2017-06-01 00:00:00', 1, '2018-05-08 05:15:19', 1),
(15, 'Photo Gallery', 'photo-gallery', '2017-06-01 00:00:00', 1, '2017-06-01 00:00:00', 1),
(16, 'Who\\\'s Who', 'whos-who', '2017-06-01 00:00:00', 1, '2017-07-04 04:45:29', 1),
(17, 'Publication', 'publication', '2017-06-01 00:00:00', 1, '2017-07-05 05:31:57', 1),
(18, 'head office', 'head-office', '2017-07-04 05:03:48', 1, '0000-00-00 00:00:00', 0),
(19, 'policies', 'policies', '2017-07-06 04:09:27', 1, '0000-00-00 00:00:00', 0),
(20, 'video gallery', 'video-gallery', '2017-07-07 04:02:43', 1, '0000-00-00 00:00:00', 0),
(21, 'sitemap', 'sitemap', '2017-07-18 01:30:48', 1, '0000-00-00 00:00:00', 0),
(22, 'Rules', 'rules', '2017-07-28 05:48:32', 1, '0000-00-00 00:00:00', 0),
(23, 'Acts', 'acts', '2017-07-28 05:50:13', 1, '0000-00-00 00:00:00', 0),
(24, 'Laws', 'laws', '2017-07-28 05:50:20', 1, '0000-00-00 00:00:00', 0),
(25, 'Feedback', 'feedback', '2017-08-24 04:44:37', 1, '0000-00-00 00:00:00', 0),
(26, 'Contact Us', 'contact-us', '2018-01-04 03:43:47', 1, '2018-01-04 03:44:03', 1),
(27, 'Career', 'career', '2019-11-15 05:29:16', 1, '0000-00-00 00:00:00', 0),
(28, 'Tender', 'tender', '2019-11-15 05:29:22', 1, '0000-00-00 00:00:00', 0),
(29, 'Archive', 'publication/archieve_publication', '2020-09-15 12:10:32', 1, '0000-00-00 00:00:00', 0),
(30, 'Announcement', 'announcement', '2020-09-15 03:49:57', 1, '0000-00-00 00:00:00', 0),
(32, 'policy', 'policy', '2020-09-18 03:23:31', 1, '0000-00-00 00:00:00', 0),
(33, 'project', 'project', '2020-09-18 03:28:17', 1, '2020-09-18 03:29:07', 1),
(34, 'Consultancy', 'Consultancy', '2020-09-18 04:04:48', 1, '0000-00-00 00:00:00', 0),
(35, 'research papers', 'publication/view/2', '2020-09-21 02:31:04', 1, '2020-10-01 02:23:42', 1),
(36, 'Press release', 'news-details/pressrelease', '2020-09-21 05:04:25', 1, '0000-00-00 00:00:00', 0),
(37, 'Policy Briefs', 'publication/view/4', '2020-09-22 12:00:03', 1, '2020-10-01 02:24:16', 1),
(38, 'Books & Periodicals', 'publication/view/1', '2020-09-22 12:00:19', 1, '2020-10-01 02:23:00', 1),
(39, 'Reports & articles', 'publication/view/resports', '2020-09-22 12:00:40', 1, '2021-08-12 12:59:47', 1),
(40, 'Research Gallery', 'photo-gallery-view/UFpqN1UvTGpzSFdSK0RxcHlLT24vdz09', '2020-09-24 12:50:41', 1, '2020-09-24 12:51:31', 1),
(41, 'International', 'project-view/a3BHUnpXUHY1YmlFbW9xOHAvSm9WQT09', '2020-09-25 04:51:05', 1, '0000-00-00 00:00:00', 0),
(42, 'Admission', 'register', '2021-03-24 03:37:54', 1, '2021-03-26 04:30:42', 1),
(43, 'registration status', 'login', '2021-07-16 04:59:33', 1, '0000-00-00 00:00:00', 0),
(44, 'pgbdm', 'empanelment-consultancy', '2021-07-16 05:02:27', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_menu_type`
--

CREATE TABLE `comm_menu_type` (
  `menu_type_id` int(11) NOT NULL,
  `menu_type_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comm_menu_type`
--

INSERT INTO `comm_menu_type` (`menu_type_id`, `menu_type_title`) VALUES
(1, 'Top Menu'),
(2, 'Footer Menu'),
(3, 'Middle Menu');

-- --------------------------------------------------------

--
-- Table structure for table `comm_pages`
--

CREATE TABLE `comm_pages` (
  `page_id` int(11) NOT NULL,
  `page_title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_description_hi` text COLLATE utf8_unicode_ci NOT NULL,
  `page_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_description_en` text COLLATE utf8_unicode_ci NOT NULL,
  `pre_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page/content/',
  `page_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page_added_date` datetime NOT NULL,
  `page_added_by` int(11) NOT NULL DEFAULT '0',
  `page_edit_date` datetime NOT NULL,
  `page_edit_by` int(11) NOT NULL DEFAULT '0',
  `page_status` tinyint(2) NOT NULL DEFAULT '1',
  `meta_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(2) NOT NULL DEFAULT '0',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `attachment` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comm_pages`
--

INSERT INTO `comm_pages` (`page_id`, `page_title_hi`, `page_description_hi`, `page_title_en`, `page_description_en`, `pre_url`, `page_url`, `page_added_date`, `page_added_by`, `page_edit_date`, `page_edit_by`, `page_status`, `meta_title`, `meta_keyword`, `meta_desc`, `is_default`, `is_delete`, `attachment`) VALUES
(1, 'Company Profile', '<section class=\"about-faq sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<figure class=\"img-box\">\r\n					<img alt=\"About Us\" src=\"/uploads/media/bench-accounting(2).jpg\" style=\"width: 100px; height: 100px;\" /></figure>\r\n			</div>\r\n			<div class=\"col-md-8 col-sm-12 col-xs-12\">\r\n				<div class=\"about-info\">\r\n					<h4 style=\" color: #FF4500;\r\n  font-weight: bold;\">\r\n						We Only Bring the Best.</h4>\r\n					<div class=\"text\">\r\n						<p>\r\n							At 3SP Resources we sincerely believe in rising above through innovative hiring and engaging with the most powerful asset on earth <b>&ldquo;PEOPLE&rdquo; </b></p>\r\n						<p>\r\n							<b>Our Philosophy is &ldquo;To blend talent and passion for our client&rsquo;s success&rdquo; </b></p>\r\n						<p>\r\n							We are an extension of our client&rsquo;s HR team and must perform as a responsible representative of their organization.</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<hr />\r\n		<div class=\"row\">\r\n			<div class=\"col-md-12 col-sm-12 col-xs-12\">\r\n				<div class=\"outer-box\">\r\n					<h4 class=\"training-skills\">\r\n						Global Workforce Experts</h4>\r\n					<div class=\"text\">\r\n						<p>\r\n							It is our continuous endeavour to create high-impact solutions to enhance the competitiveness of the organizations and the individuals we serve. At 3SP Resources we offer services which help companies succeed in a fast-changing, uncertain world of work and connect people to meaningful employment opportunities every year. We deliver the solutions to suit your precise business needs.</p>\r\n						<br />\r\n						<br />\r\n						<div class=\"section-title\">\r\n							<h3>\r\n								Services</h3>\r\n						</div>\r\n						<h4 class=\"training-skills\">\r\n							Contract Staffing</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We bring you the innovative staffing solutions which are agile enough to meet the rapidly changing talent needs of today&rsquo;s world of work.</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Permanent Recruitment</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								Organizations keep looking at hiring good leaders as part of their growth strategy. The challenge is to get appropriate alignment of leader&#39;s aspirations with the directions of the organization. We create high-impact solutions to enhance the competitiveness of the organizations.</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Innovative Workforce Solutions</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								3SP Resources delivers innovative staffing solutions, which are agile enough to meet the rapidly changing talent needs of today&rsquo;s world of work. No matter what form these solutions take - short term assignments, permanent placement or workforce management programs- we provide rapid access to highly qualified talent resulting in better business results</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Career Development and Training</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We help you respond to changing market conditions and emerging business opportunities by strategically mobilizing and sizing your workforce to meet the needs of your business, minimize turnover and maintain Productivity. We offer a full array of resouces to ensure that your talent has the skills and knowledge needed to drive your business forward</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							IT Services</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We are one of the leading provider of innovative IT solutions offering Custom Application Development, Custom &amp; Packaged ERP, Collaborative Computing Practices, Web &amp; Portal Development, Security &amp; Storage Solutions for various industries, including Banking &amp; Financial Services, Consumer &amp; Retail, IT, Telecom, ITES, Manufacturing &amp; Healthcare.</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Company Profile', '<section class=\"about-faq sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<figure class=\"img-box\">\r\n					<img alt=\"about section\" src=\"/uploads/media/bench-accounting.jpg\" /></figure>\r\n			</div>\r\n			<div class=\"col-md-8 col-sm-12 col-xs-12\">\r\n				<div class=\"about-info\">\r\n					<h4 style=\" color: #FF4500;\r\n  font-weight: bold;\">\r\n						We Only Bring the Best.</h4>\r\n					<div class=\"text\">\r\n						<p>\r\n							At 3SP Resources we sincerely believe in rising above through innovative hiring and engaging with the most powerful asset on earth <b>&ldquo;PEOPLE&rdquo; </b></p>\r\n						<p>\r\n							<b>Our Philosophy is &ldquo;To blend talent and passion for our client&rsquo;s success&rdquo; </b></p>\r\n						<p>\r\n							We are an extension of our client&rsquo;s HR team and must perform as a responsible representative of their organization.</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<hr />\r\n		<div class=\"row\">\r\n			<div class=\"col-md-12 col-sm-12 col-xs-12\">\r\n				<div class=\"outer-box\">\r\n					<h4 class=\"training-skills\">\r\n						Global Workforce Experts</h4>\r\n					<div class=\"text\">\r\n						<p>\r\n							It is our continuous endeavour to create high-impact solutions to enhance the competitiveness of the organizations and the individuals we serve. At 3SP Resources we offer services which help companies succeed in a fast-changing, uncertain world of work and connect people to meaningful employment opportunities every year. We deliver the solutions to suit your precise business needs.</p>\r\n						<br />\r\n						<br />\r\n						<div class=\"section-title\">\r\n							<h3>\r\n								Services</h3>\r\n						</div>\r\n						<h4 class=\"training-skills\">\r\n							Contract Staffing</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We bring you the innovative staffing solutions which are agile enough to meet the rapidly changing talent needs of today&rsquo;s world of work.</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Permanent Recruitment</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								Organizations keep looking at hiring good leaders as part of their growth strategy. The challenge is to get appropriate alignment of leader&#39;s aspirations with the directions of the organization. We create high-impact solutions to enhance the competitiveness of the organizations.</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Innovative Workforce Solutions</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								3SP Resources delivers innovative staffing solutions, which are agile enough to meet the rapidly changing talent needs of today&rsquo;s world of work. No matter what form these solutions take - short term assignments, permanent placement or workforce management programs- we provide rapid access to highly qualified talent resulting in better business results</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							Career Development and Training</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We help you respond to changing market conditions and emerging business opportunities by strategically mobilizing and sizing your workforce to meet the needs of your business, minimize turnover and maintain Productivity. We offer a full array of resouces to ensure that your talent has the skills and knowledge needed to drive your business forward</p>\r\n						</div>\r\n						<br />\r\n						<h4 class=\"training-skills\">\r\n							IT Services</h4>\r\n						<div class=\"text\">\r\n							<p>\r\n								We are one of the leading provider of innovative IT solutions offering Custom Application Development, Custom &amp; Packaged ERP, Collaborative Computing Practices, Web &amp; Portal Development, Security &amp; Storage Solutions for various industries, including Banking &amp; Financial Services, Consumer &amp; Retail, IT, Telecom, ITES, Manufacturing &amp; Healthcare.</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'company-profile', '2018-11-13 03:41:35', 1, '2021-10-10 10:23:26', 1, 1, '', '', '', 1, 0, ''),
(2, 'Contact Us', '<p>\r\n	Contact Us</p>', 'Contact Us', '<p>\r\n	Contact Us</p>', 'page/content/', 'contact', '2021-10-09 07:34:27', 1, '2021-10-09 07:39:07', 1, 1, '', '', '', 0, 0, ''),
(3, 'Our Commitment', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-12 col-sm-12 col-xs-12\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"text\">\r\n						<p>\r\n							Our commitment is the key to Success of 3SP resources Consultancy</p>\r\n					</div>\r\n					<br />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Commitment</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							We are committed as when we make a promise to our clients due to their needs. Our Recruitment Consultants are firmly committed to their jobs and it is the strength of this commitment will lead to both the company&rsquo;s and client&rsquo;s success. The quality of the company&rsquo;s commitment to the clients is always based on the quality of the committed Recruitment Consultants. If we can&rsquo;t achieve the deadline, we will let the client know as possible for whatever reasons in order to avoid their operation bottleneck. Commitment ignites actions and responsibility. We are committed to be an employment agency of choice and we strive to build a long-term relationship with our client based on integrity, passion, ethics, professionalism, and honesty that supports our commitments.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Integrity</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Success will come and go in life but integrity is with us forever. Integrity is doing the correct things all the time, regardless of the consequences. Thus, our Recruitment Consultant&rsquo;s integrity is not to overpromise or under deliver. We embrace differences and are honest, ethical and committed.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Passion</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants are driven and committed to engage and inspire in order to deliver results to our clients.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Ethics</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants work closely with the clients to understand and identify their recruitment challenges in the organization. We provide frank and honest recommendations so as to achieve result in the recruitment process instead of focusing on profit.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Professionalism</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							It is essential to be professional if they want success. Being professional means conducting oneself with responsibility, integrity, accountability and work excellence. Our recruitment process and quality characterize a professional image of 3SP Resources..</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Honesty</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants keep their word and they are Trustworthy.</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Our Commitment', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-12 col-sm-12 col-xs-12\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"text\">\r\n						<p>\r\n							Our commitment is the key to Success of 3SP resources Consultancy</p>\r\n					</div>\r\n					<br />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Commitment</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							We are committed as when we make a promise to our clients due to their needs. Our Recruitment Consultants are firmly committed to their jobs and it is the strength of this commitment will lead to both the company&rsquo;s and client&rsquo;s success. The quality of the company&rsquo;s commitment to the clients is always based on the quality of the committed Recruitment Consultants. If we can&rsquo;t achieve the deadline, we will let the client know as possible for whatever reasons in order to avoid their operation bottleneck. Commitment ignites actions and responsibility. We are committed to be an employment agency of choice and we strive to build a long-term relationship with our client based on integrity, passion, ethics, professionalism, and honesty that supports our commitments.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Integrity</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Success will come and go in life but integrity is with us forever. Integrity is doing the correct things all the time, regardless of the consequences. Thus, our Recruitment Consultant&rsquo;s integrity is not to overpromise or under deliver. We embrace differences and are honest, ethical and committed.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Passion</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants are driven and committed to engage and inspire in order to deliver results to our clients.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Ethics</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants work closely with the clients to understand and identify their recruitment challenges in the organization. We provide frank and honest recommendations so as to achieve result in the recruitment process instead of focusing on profit.</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Professionalism</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							It is essential to be professional if they want success. Being professional means conducting oneself with responsibility, integrity, accountability and work excellence. Our recruitment process and quality characterize a professional image of 3SP Resources..</p>\r\n					</div>\r\n					<br />\r\n					<hr />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Honesty</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Our Recruitment Consultants keep their word and they are Trustworthy.</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'our-commitment', '2021-10-10 09:20:16', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, ''),
(4, 'Mission/Vission/Values', '<section class=\"four-column sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12 col-xs-12\">\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Mission</h4>\r\n						<p class=\"justified\">\r\n							We are a professional, enthusiastic and innovative team, dedicated to providing professional HR Consulting Services and evolving Recruitment Solutions that help our customers become more productive and profitable.</p>\r\n					</div>\r\n				</div>\r\n				<br />\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Vision</h4>\r\n						<p class=\"justified\">\r\n							To be recognized as an impactful, innovative and efficient HR Consulting partner. Through our One-Stop HR Shop</p>\r\n						<p class=\"justified\">\r\n							We continuously strive to become the preferred source for employment and human resource services. We are devoted to remaining unsurpassed in customer satisfaction. We strive to maintain our reputation as a -</p>\r\n						<br />\r\n						<ul class=\"ul-list ul-margin\">\r\n							<li>\r\n								Professional small business with principles and integrity.</li>\r\n							<li>\r\n								Friendly organization that supports our communities.</li>\r\n							<li>\r\n								Willing and trusted partner.</li>\r\n							<li>\r\n								Generous organization, giving of time and resources.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12 col-xs-12\">\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Values</h4>\r\n						<p class=\"justified\">\r\n							Be the most reputed partners for our Clients with utmost respect towards their Company and adding value by providing right candidates at the right time and on right place as per the commitment, by giving our value added services with our innovative methods and processes, through :-</p>\r\n						<br />\r\n						<ul class=\"ul-list ul-margin\">\r\n							<li>\r\n								<b class=\"bold\">Trust : </b> We are a high performing, high quality organization dedicated to employment and human resource services &ndash; a trusted partner and resource for our customers and our community.</li>\r\n							<li>\r\n								<b class=\"bold\">Respect : </b> We treat every individual with respect, in every interaction.</li>\r\n							<li>\r\n								<b class=\"bold\">Integrity : </b> We promise only what we can deliver, and we deliver on every promise. Our business is built on a foundation of honesty and integrity.</li>\r\n							<li>\r\n								<b class=\"bold\">Commitment : </b> We are committed to providing solutions for our customers. We exist to meet and solve the challenges our customers face.</li>\r\n							<li>\r\n								<b class=\"bold\">Professionalism : </b> We are seasoned professionals, continuously educating ourselves and preparing for the challenges ahead.</li>\r\n							<li>\r\n								<b class=\"bold\">Joy : </b> Helping others through our daily business activities and community service brings us joy.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Mission/Vission/Values', '<section class=\"four-column sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12 col-xs-12\">\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Mission</h4>\r\n						<p class=\"justified\">\r\n							We are a professional, enthusiastic and innovative team, dedicated to providing professional HR Consulting Services and evolving Recruitment Solutions that help our customers become more productive and profitable.</p>\r\n					</div>\r\n				</div>\r\n				<br />\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Vision</h4>\r\n						<p class=\"justified\">\r\n							To be recognized as an impactful, innovative and efficient HR Consulting partner. Through our One-Stop HR Shop</p>\r\n						<p class=\"justified\">\r\n							We continuously strive to become the preferred source for employment and human resource services. We are devoted to remaining unsurpassed in customer satisfaction. We strive to maintain our reputation as a -</p>\r\n						<br />\r\n						<ul class=\"ul-list ul-margin\">\r\n							<li>\r\n								Professional small business with principles and integrity.</li>\r\n							<li>\r\n								Friendly organization that supports our communities.</li>\r\n							<li>\r\n								Willing and trusted partner.</li>\r\n							<li>\r\n								Generous organization, giving of time and resources.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12 col-xs-12\">\r\n				<div class=\"item center\">\r\n					<div class=\"content\">\r\n						<h4>\r\n							Our Values</h4>\r\n						<p class=\"justified\">\r\n							Be the most reputed partners for our Clients with utmost respect towards their Company and adding value by providing right candidates at the right time and on right place as per the commitment, by giving our value added services with our innovative methods and processes, through :-</p>\r\n						<br />\r\n						<ul class=\"ul-list ul-margin\">\r\n							<li>\r\n								<b class=\"bold\">Trust : </b> We are a high performing, high quality organization dedicated to employment and human resource services &ndash; a trusted partner and resource for our customers and our community.</li>\r\n							<li>\r\n								<b class=\"bold\">Respect : </b> We treat every individual with respect, in every interaction.</li>\r\n							<li>\r\n								<b class=\"bold\">Integrity : </b> We promise only what we can deliver, and we deliver on every promise. Our business is built on a foundation of honesty and integrity.</li>\r\n							<li>\r\n								<b class=\"bold\">Commitment : </b> We are committed to providing solutions for our customers. We exist to meet and solve the challenges our customers face.</li>\r\n							<li>\r\n								<b class=\"bold\">Professionalism : </b> We are seasoned professionals, continuously educating ourselves and preparing for the challenges ahead.</li>\r\n							<li>\r\n								<b class=\"bold\">Joy : </b> Helping others through our daily business activities and community service brings us joy.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'our-mission', '2021-10-10 09:23:34', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, ''),
(5, 'Our Team', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\" id=\"short-msg\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"sameer co-founder\" src=\"/uploads/media/sameer.png\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Sameer Agarwal</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"sameer-read\" onclick=\"getmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								He has been heading various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality. The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"veecas co-founder\" src=\"/uploads/media/veecas.jpg\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Veecas Jain</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"veecas-read\" onclick=\"getsecondmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<hr />\r\n			</div>\r\n		</div>\r\n		<div class=\"full-msg-wrapper\">\r\n			<div class=\"row\" id=\"header-line\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"sameer-anchor\" onclick=\"getanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Sameer Agarwal </a></h3>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"veecas-anchor\" onclick=\"getveeanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Veecas Jain </a></h3>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"sameer-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/sameer.png\" />\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.<br />\r\n								<br />\r\n								Mr Sameer Agrawal is an MBA in HR&amp; Marketing from One of the Top Business Schools in India, Running Job Consultancy successfully for the last 4 years, Previously Associatedwith top Engineering and MBA Colleges as Head Training and Placements, Worked with Reliance Communication, Bajaj Allianz, Everonn Education etc, started his career with Gallup Organisation.<br />\r\n								<br />\r\n								He through his excellent knowledge about the domain and the urge to learn new things has made him a prolific leader in the industry. Over the years, he has built profound expertise in talent search and his leadership quality has led him to establish 3SP Resource as a global entity. He is continuously working towards to achieve the best and to build pioneering solutions for clients in the human resource domain.<br />\r\n								<br />\r\n								He has opined his insights on industry trends, practices, innovation, culture, etc. at various public platforms such as national and global newspapers and news channels. His keen interest in technological innovation has led him to forth come with technologies in current recruitment life cycles and advisory services, which helps to multiply the efforts of the clients, candidates and consultants.</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"vicas-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/veecas.jpg\" style=\"width:182px;\" />\r\n							<p>\r\n								He has been handing various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality<br />\r\n								<br />\r\n								The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.<br />\r\n								<br />\r\n								Mr Veecas Jain is an MBA in IT &amp; Marketing from One of the Top Business Schools in India , He has recently been awarded as Entrepreneur of the Year 2016-17 by My FM.<br />\r\n								<br />\r\n								Mr Veecas Jain has 18 Yrs of Expertise in Human Resource, Sales Operations, Sales Support, B2B Sales, Channel Sales, Information Technology, Distribution &amp; Trade Marketing in Telecom &amp; FMCG Business.&nbsp;<br />\r\n								<br />\r\n								Worked with prestigious brands like Vodafone, Airtel , Reliance &amp; Marico.<br />\r\n								<br />\r\n								Result focused &amp; effectual leader with demonstrated skills in turnaround of challenging units. Talent for proactively identifying opportunities through out of box thinking and taking initiative.&nbsp;<br />\r\n								<br />\r\n								He has successfully headed Sales &amp; Distribution &amp; Marketing divisions of multinational companies for long tenures and started career in 1999 with Marico Industries Ltd, India&rsquo;s leading FMCG Company.<br />\r\n								&nbsp;</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Expert Team</h3>\r\n				</div>\r\n				<!-- <div class=\"item\">\r\n                    <div class=\"text\">\r\n                        <p>3SP Resources holds the team of experience and dedicated professioners they are equipped with the latest industries like IT, FMCG, Education, Manufacturing, Telecom, BPO, Media, Financial Services Etc. Our consultants are committed to conduct strong R&D, track key industry trends and continuously innovate their approach to evolve with the time. All our consultants hold prior experience in handling HR consulting services for high-level management roles. At 3SP Resources, we thoroughly prepare them to be problem solvers and to think ‘out of the box’. Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</p>\r\n                        <div class=\"quot\"><i class=\"fa fa-quote-left\"></i></div>\r\n                    </div>\r\n            </div> -->\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							3SP Resources holds the team of experience and dedicated HR Expert for each Industry , Specialized in IT, FMCG, Education, Manufacturing, Telecom, BPO, Media &amp; Financial Services .</li>\r\n						<li>\r\n							They are well equipped with the latest developments in the Industries, Our consultants are committed to conduct strong R&amp;D, track key industry trends and continuously innovate their approach to evolve with the time.</li>\r\n						<li>\r\n							All our consultants hold prior experience in handling HR consulting services for high-level management roles.</li>\r\n						<li>\r\n							At 3SP Resources, we thoroughly prepare them to be problem solvers and to think &lsquo;out of the box&rsquo;.</li>\r\n						<li>\r\n							Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</li>\r\n					</ul>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Our Team', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\" id=\"short-msg\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"sameer co-founder\" src=\"/uploads/media/sameer.png\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Sameer Agarwal</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"sameer-read\" onclick=\"getmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								He has been heading various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality. The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"veecas co-founder\" src=\"/uploads/media/veecas.jpg\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Veecas Jain</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"veecas-read\" onclick=\"getsecondmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<hr />\r\n			</div>\r\n		</div>\r\n		<div class=\"full-msg-wrapper\">\r\n			<div class=\"row\" id=\"header-line\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"sameer-anchor\" onclick=\"getanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Sameer Agarwal </a></h3>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"veecas-anchor\" onclick=\"getveeanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Veecas Jain </a></h3>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"sameer-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/sameer.png\" />\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.<br />\r\n								<br />\r\n								Mr Sameer Agrawal is an MBA in HR&amp; Marketing from One of the Top Business Schools in India, Running Job Consultancy successfully for the last 4 years, Previously Associatedwith top Engineering and MBA Colleges as Head Training and Placements, Worked with Reliance Communication, Bajaj Allianz, Everonn Education etc, started his career with Gallup Organisation.<br />\r\n								<br />\r\n								He through his excellent knowledge about the domain and the urge to learn new things has made him a prolific leader in the industry. Over the years, he has built profound expertise in talent search and his leadership quality has led him to establish 3SP Resource as a global entity. He is continuously working towards to achieve the best and to build pioneering solutions for clients in the human resource domain.<br />\r\n								<br />\r\n								He has opined his insights on industry trends, practices, innovation, culture, etc. at various public platforms such as national and global newspapers and news channels. His keen interest in technological innovation has led him to forth come with technologies in current recruitment life cycles and advisory services, which helps to multiply the efforts of the clients, candidates and consultants.</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"vicas-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/veecas.jpg\" style=\"width:182px;\" />\r\n							<p>\r\n								He has been handing various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality<br />\r\n								<br />\r\n								The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.<br />\r\n								<br />\r\n								Mr Veecas Jain is an MBA in IT &amp; Marketing from One of the Top Business Schools in India , He has recently been awarded as Entrepreneur of the Year 2016-17 by My FM.<br />\r\n								<br />\r\n								Mr Veecas Jain has 18 Yrs of Expertise in Human Resource, Sales Operations, Sales Support, B2B Sales, Channel Sales, Information Technology, Distribution &amp; Trade Marketing in Telecom &amp; FMCG Business.&nbsp;<br />\r\n								<br />\r\n								Worked with prestigious brands like Vodafone, Airtel , Reliance &amp; Marico.<br />\r\n								<br />\r\n								Result focused &amp; effectual leader with demonstrated skills in turnaround of challenging units. Talent for proactively identifying opportunities through out of box thinking and taking initiative.&nbsp;<br />\r\n								<br />\r\n								He has successfully headed Sales &amp; Distribution &amp; Marketing divisions of multinational companies for long tenures and started career in 1999 with Marico Industries Ltd, India&rsquo;s leading FMCG Company.<br />\r\n								&nbsp;</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Expert Team</h3>\r\n				</div>\r\n				<!-- <div class=\"item\">\r\n                    <div class=\"text\">\r\n                        <p>3SP Resources holds the team of experience and dedicated professioners they are equipped with the latest industries like IT, FMCG, Education, Manufacturing, Telecom, BPO, Media, Financial Services Etc. Our consultants are committed to conduct strong R&D, track key industry trends and continuously innovate their approach to evolve with the time. All our consultants hold prior experience in handling HR consulting services for high-level management roles. At 3SP Resources, we thoroughly prepare them to be problem solvers and to think ‘out of the box’. Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</p>\r\n                        <div class=\"quot\"><i class=\"fa fa-quote-left\"></i></div>\r\n                    </div>\r\n            </div> -->\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							3SP Resources holds the team of experience and dedicated HR Expert for each Industry , Specialized in IT, FMCG, Education, Manufacturing, Telecom, BPO, Media &amp; Financial Services .</li>\r\n						<li>\r\n							They are well equipped with the latest developments in the Industries, Our consultants are committed to conduct strong R&amp;D, track key industry trends and continuously innovate their approach to evolve with the time.</li>\r\n						<li>\r\n							All our consultants hold prior experience in handling HR consulting services for high-level management roles.</li>\r\n						<li>\r\n							At 3SP Resources, we thoroughly prepare them to be problem solvers and to think &lsquo;out of the box&rsquo;.</li>\r\n						<li>\r\n							Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</li>\r\n					</ul>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'our-team', '2021-10-10 09:29:06', 1, '2021-10-10 09:49:04', 1, 1, '', '', '', 0, 0, '');
INSERT INTO `comm_pages` (`page_id`, `page_title_hi`, `page_description_hi`, `page_title_en`, `page_description_en`, `pre_url`, `page_url`, `page_added_date`, `page_added_by`, `page_edit_date`, `page_edit_by`, `page_status`, `meta_title`, `meta_keyword`, `meta_desc`, `is_default`, `is_delete`, `attachment`) VALUES
(6, 'Leadership team', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\" id=\"short-msg\" style=\"display: none;\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"sameer co-founder\" src=\"images/team/sameer.png\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Sameer Agarwal</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"sameer-read\" onclick=\"getmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								He has been heading various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality. The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"veecas co-founder\" src=\"images/team/veecas.jpg\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Veecas Jain</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"veecas-read\" onclick=\"getsecondmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<hr />\r\n			</div>\r\n		</div>\r\n		<div class=\"full-msg-wrapper\">\r\n			<div class=\"row\" id=\"header-line\" style=\"display: block;\">\r\n				<div class=\"col-md-offset-1 col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"sameer-anchor\" onclick=\"getanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Sameer Agarwal</a></h3>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"sameer-div\" style=\"display: block;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img alt=\"Sameer Agarwal\" class=\"full-msg-image\" src=\"/uploads/media/sameer.png\" />\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.<br />\r\n								<br />\r\n								Mr Sameer Agrawal is an MBA in HR&amp; Marketing from One of the Top Business Schools in India, Running Job Consultancy successfully for the last 4 years, Previously Associatedwith top Engineering and MBA Colleges as Head Training and Placements, Worked with Reliance Communication, Bajaj Allianz, Everonn Education etc, started his career with Gallup Organisation.<br />\r\n								<br />\r\n								He through his excellent knowledge about the domain and the urge to learn new things has made him a prolific leader in the industry. Over the years, he has built profound expertise in talent search and his leadership quality has led him to establish 3SP Resource as a global entity. He is continuously working towards to achieve the best and to build pioneering solutions for clients in the human resource domain.<br />\r\n								<br />\r\n								He has opined his insights on industry trends, practices, innovation, culture, etc. at various public platforms such as national and global newspapers and news channels. His keen interest in technological innovation has led him to forth come with technologies in current recruitment life cycles and advisory services, which helps to multiply the efforts of the clients, candidates and consultants.</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"vicas-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/veecas.jpg\" style=\"width:182px;\" />\r\n							<p>\r\n								He has been handing various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality<br />\r\n								<br />\r\n								The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.<br />\r\n								<br />\r\n								Mr Veecas Jain is an MBA in IT &amp; Marketing from One of the Top Business Schools in India , He has recently been awarded as Entrepreneur of the Year 2016-17 by My FM.<br />\r\n								<br />\r\n								Mr Veecas Jain has 18 Yrs of Expertise in Human Resource, Sales Operations, Sales Support, B2B Sales, Channel Sales, Information Technology, Distribution &amp; Trade Marketing in Telecom &amp; FMCG Business.&nbsp;<br />\r\n								<br />\r\n								Worked with prestigious brands like Vodafone, Airtel , Reliance &amp; Marico.<br />\r\n								<br />\r\n								Result focused &amp; effectual leader with demonstrated skills in turnaround of challenging units. Talent for proactively identifying opportunities through out of box thinking and taking initiative.&nbsp;<br />\r\n								<br />\r\n								He has successfully headed Sales &amp; Distribution &amp; Marketing divisions of multinational companies for long tenures and started career in 1999 with Marico Industries Ltd, India&rsquo;s leading FMCG Company.<br />\r\n								&nbsp;</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Expert Team</h3>\r\n				</div>\r\n				<!-- <div class=\"item\">\r\n                    <div class=\"text\">\r\n                        <p>3SP Resources holds the team of experience and dedicated professioners they are equipped with the latest industries like IT, FMCG, Education, Manufacturing, Telecom, BPO, Media, Financial Services Etc. Our consultants are committed to conduct strong R&D, track key industry trends and continuously innovate their approach to evolve with the time. All our consultants hold prior experience in handling HR consulting services for high-level management roles. At 3SP Resources, we thoroughly prepare them to be problem solvers and to think ‘out of the box’. Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</p>\r\n                        <div class=\"quot\"><i class=\"fa fa-quote-left\"></i></div>\r\n                    </div>\r\n            </div> -->\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							3SP Resources holds the team of experience and dedicated HR Expert for each Industry , Specialized in IT, FMCG, Education, Manufacturing, Telecom, BPO, Media &amp; Financial Services .</li>\r\n						<li>\r\n							They are well equipped with the latest developments in the Industries, Our consultants are committed to conduct strong R&amp;D, track key industry trends and continuously innovate their approach to evolve with the time.</li>\r\n						<li>\r\n							All our consultants hold prior experience in handling HR consulting services for high-level management roles.</li>\r\n						<li>\r\n							At 3SP Resources, we thoroughly prepare them to be problem solvers and to think &lsquo;out of the box&rsquo;.</li>\r\n						<li>\r\n							Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</li>\r\n					</ul>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Sameer Agarwal', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\" id=\"short-msg\" style=\"display: none;\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"sameer co-founder\" src=\"images/team/sameer.png\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Sameer Agarwal</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"sameer-read\" onclick=\"getmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-6 col-sm-12 col-xs-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text\">\r\n							<p>\r\n								He has been heading various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality. The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.</p>\r\n							<div class=\"quot\">\r\n								&nbsp;</div>\r\n						</div>\r\n						<div class=\"author-info\">\r\n							<ul class=\"list-inline\">\r\n								<li>\r\n									<img alt=\"veecas co-founder\" src=\"images/team/veecas.jpg\" /></li>\r\n								<li>\r\n									<h2 class=\"author\">\r\n										Veecas Jain</h2>\r\n									<p class=\"author-title\">\r\n										Co-Founder, 3SP Resources</p>\r\n								</li>\r\n								<li class=\"list-right\">\r\n									<a class=\"thm-btn yellow-bg detail-btn\" id=\"veecas-read\" onclick=\"getsecondmsg();\" style=\"cursor: pointer;\">Read More</a></li>\r\n							</ul>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<hr />\r\n			</div>\r\n		</div>\r\n		<div class=\"full-msg-wrapper\">\r\n			<div class=\"row\" id=\"header-line\" style=\"display: block;\">\r\n				<div class=\"col-md-offset-1 col-md-5 col-sm-6\">\r\n					<div class=\"section-title\" id=\"sameer-anchor\" onclick=\"getanchor();\">\r\n						<h3>\r\n							<a style=\"cursor: pointer;\">Mr. Sameer Agarwal</a></h3>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"sameer-div\" style=\"display: block;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"/uploads/media/sameer.png\" />\r\n							<p>\r\n								An MBA, who is a Senior HR Professional and has 17+ years of HR &amp; General Management experience, heads the division. He is core competence includes formulating and evaluating HR strategies Campus Placement, payroll management, recruitment, employee motivation strategies.<br />\r\n								<br />\r\n								Mr Sameer Agrawal is an MBA in HR&amp; Marketing from One of the Top Business Schools in India, Running Job Consultancy successfully for the last 4 years, Previously Associatedwith top Engineering and MBA Colleges as Head Training and Placements, Worked with Reliance Communication, Bajaj Allianz, Everonn Education etc, started his career with Gallup Organisation.<br />\r\n								<br />\r\n								He through his excellent knowledge about the domain and the urge to learn new things has made him a prolific leader in the industry. Over the years, he has built profound expertise in talent search and his leadership quality has led him to establish 3SP Resource as a global entity. He is continuously working towards to achieve the best and to build pioneering solutions for clients in the human resource domain.<br />\r\n								<br />\r\n								He has opined his insights on industry trends, practices, innovation, culture, etc. at various public platforms such as national and global newspapers and news channels. His keen interest in technological innovation has led him to forth come with technologies in current recruitment life cycles and advisory services, which helps to multiply the efforts of the clients, candidates and consultants.</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"row\" id=\"vicas-div\" style=\"display: none;\">\r\n				<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n					<div class=\"item\">\r\n						<div class=\"text no-border\">\r\n							<img class=\"full-msg-image\" src=\"images/team/veecas.jpg\" style=\"width:182px;\" />\r\n							<p>\r\n								He has been handing various Blue Chip Companies as profit centre Head for various sectors like FMCG, Telecom, Consultancy, and Hospitality<br />\r\n								<br />\r\n								The group is headed by an extremely experienced professional and a successful entrepreneur in this field since past 18 years.<br />\r\n								<br />\r\n								Mr Veecas Jain is an MBA in IT &amp; Marketing from One of the Top Business Schools in India , He has recently been awarded as Entrepreneur of the Year 2016-17 by My FM.<br />\r\n								<br />\r\n								Mr Veecas Jain has 18 Yrs of Expertise in Human Resource, Sales Operations, Sales Support, B2B Sales, Channel Sales, Information Technology, Distribution &amp; Trade Marketing in Telecom &amp; FMCG Business.&nbsp;<br />\r\n								<br />\r\n								Worked with prestigious brands like Vodafone, Airtel , Reliance &amp; Marico.<br />\r\n								<br />\r\n								Result focused &amp; effectual leader with demonstrated skills in turnaround of challenging units. Talent for proactively identifying opportunities through out of box thinking and taking initiative.&nbsp;<br />\r\n								<br />\r\n								He has successfully headed Sales &amp; Distribution &amp; Marketing divisions of multinational companies for long tenures and started career in 1999 with Marico Industries Ltd, India&rsquo;s leading FMCG Company.<br />\r\n								&nbsp;</p>\r\n							<div class=\"clearfix\">\r\n								&nbsp;</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-offset-1 col-md-10 col-sm-12\">\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Expert Team</h3>\r\n				</div>\r\n				<!-- <div class=\"item\">\r\n                    <div class=\"text\">\r\n                        <p>3SP Resources holds the team of experience and dedicated professioners they are equipped with the latest industries like IT, FMCG, Education, Manufacturing, Telecom, BPO, Media, Financial Services Etc. Our consultants are committed to conduct strong R&D, track key industry trends and continuously innovate their approach to evolve with the time. All our consultants hold prior experience in handling HR consulting services for high-level management roles. At 3SP Resources, we thoroughly prepare them to be problem solvers and to think ‘out of the box’. Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</p>\r\n                        <div class=\"quot\"><i class=\"fa fa-quote-left\"></i></div>\r\n                    </div>\r\n            </div> -->\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							3SP Resources holds the team of experience and dedicated HR Expert for each Industry , Specialized in IT, FMCG, Education, Manufacturing, Telecom, BPO, Media &amp; Financial Services .</li>\r\n						<li>\r\n							They are well equipped with the latest developments in the Industries, Our consultants are committed to conduct strong R&amp;D, track key industry trends and continuously innovate their approach to evolve with the time.</li>\r\n						<li>\r\n							All our consultants hold prior experience in handling HR consulting services for high-level management roles.</li>\r\n						<li>\r\n							At 3SP Resources, we thoroughly prepare them to be problem solvers and to think &lsquo;out of the box&rsquo;.</li>\r\n						<li>\r\n							Our team works as a trusted partner to clients were they maintain the norms of information security and quality management. Our business experience and genuineness make us recognize the worth of building cordial and respectful relationships with both our clients and candidates.</li>\r\n					</ul>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'leadeship-team-sameer', '2021-10-10 09:47:13', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, ''),
(7, 'Client Review/ Testimonials', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources has been effective in delivering favourable search results leading to appointments across many of our specific business segments. Their in-depth expertise and understanding of our industry practices is commendable.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/nokia.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Prashant Sharma</h2>\r\n								<p class=\"author-title\">\r\n									Nokia Solution &amp; Networks</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources has demonstrated local insight and global expertise to satisfy our manpower requirements in India and neighbouring countries.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/utstarcom.jpg\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Ankush Mendiratta</h2>\r\n								<p class=\"author-title\">\r\n									UT Starcom</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							We are fully satisfied with the service levels of 3SP Resources and the way it works. We can count upon 3SP Resources as one of our premier trusted partners in helping us fulfil our talent acquisition needs</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/logo.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Pankaj Gulati</h2>\r\n								<p class=\"author-title\">\r\n									HR Business Partner ZTE</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							Despite the fact that 3SP Resources is a pretty large organization it still retains the attributes of being agile, being fast in responses and being nimble footed. Our relationship with 3SP Resources is not just a vendor-supplier relationship but a business partner relationship...</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/sharekhan.png\" /></li>\r\n							<li style=\"width:80%;\">\r\n								<h2 class=\"author\">\r\n									UllhasPagey</h2>\r\n								<p class=\"author-title\">\r\n									Head Human Capital and Organisational Development - Share Khan Ltd.</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources is a valued partner for us and we cherish the support. &quot;In all my interactions, I have always found the firm to display professionalism and conduct of the highest level&quot;. The team is very flexible and responsive; the overall experience is notably different. It is therefore no surprise that your firm is one of our top performing partners and I look forward to a long and mutually beneficial relationship.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/Sapient-Logo.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Prashant Bhatnagar</h2>\r\n								<p class=\"author-title\">\r\n									Director Hiring Sapient India</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Client review/Testimonials', '<section class=\"testimonials sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources has been effective in delivering favourable search results leading to appointments across many of our specific business segments. Their in-depth expertise and understanding of our industry practices is commendable.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/nokia.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Prashant Sharma</h2>\r\n								<p class=\"author-title\">\r\n									Nokia Solution &amp; Networks</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources has demonstrated local insight and global expertise to satisfy our manpower requirements in India and neighbouring countries.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/utstarcom.jpg\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Ankush Mendiratta</h2>\r\n								<p class=\"author-title\">\r\n									UT Starcom</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							We are fully satisfied with the service levels of 3SP Resources and the way it works. We can count upon 3SP Resources as one of our premier trusted partners in helping us fulfil our talent acquisition needs</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/logo.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Pankaj Gulati</h2>\r\n								<p class=\"author-title\">\r\n									HR Business Partner ZTE</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							Despite the fact that 3SP Resources is a pretty large organization it still retains the attributes of being agile, being fast in responses and being nimble footed. Our relationship with 3SP Resources is not just a vendor-supplier relationship but a business partner relationship...</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/sharekhan.png\" /></li>\r\n							<li style=\"width:80%;\">\r\n								<h2 class=\"author\">\r\n									UllhasPagey</h2>\r\n								<p class=\"author-title\">\r\n									Head Human Capital and Organisational Development - Share Khan Ltd.</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n				<div class=\"item\">\r\n					<div class=\"text\">\r\n						<p>\r\n							3SP Resources is a valued partner for us and we cherish the support. &quot;In all my interactions, I have always found the firm to display professionalism and conduct of the highest level&quot;. The team is very flexible and responsive; the overall experience is notably different. It is therefore no surprise that your firm is one of our top performing partners and I look forward to a long and mutually beneficial relationship.</p>\r\n						<div class=\"quot\">\r\n							&nbsp;</div>\r\n					</div>\r\n					<div class=\"author-info\">\r\n						<ul class=\"list-inline\">\r\n							<li>\r\n								<img alt=\"\" src=\"/uploads/media/Sapient-Logo.png\" /></li>\r\n							<li>\r\n								<h2 class=\"author\">\r\n									Prashant Bhatnagar</h2>\r\n								<p class=\"author-title\">\r\n									Director Hiring Sapient India</p>\r\n							</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'client-review', '2021-10-10 09:50:58', 1, '2021-10-10 10:38:51', 1, 1, '', '', '', 0, 0, ''),
(8, 'Career Artical', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-1\">\r\n				&nbsp;</div>\r\n			<div class=\"col-md-10\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Enter every activity without giving mental recognition to the possibility of defeat. Concentrate on your strengths, instead of your weaknesses&hellip; on your powers, instead of your problems.&rdquo;- Paul J. Meyer</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Life in the real world is different from being a student. Challenges are inevitable as well as failures. However, if you focus on your strengths and use your weaknesses to improve yourself, nothing is impossible to a determined person.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Success consists of going from failure to failure without loss of enthusiasm.&rdquo;- Winston Churchill</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							You are young. It&rsquo;s okay to make mistakes. If you get into a wrong career path, or you meet a bad boss, or you&rsquo;re dissatisfied with your job, it&rsquo;s okay that&rsquo;s normal. In the span of your career journey, you will surely make mistakes and fail many times. You&rsquo;re still inexperienced so enjoy exploring life. Fix your mistakes and learn from them, then move forward- That&rsquo;s the joy of learning.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Strive not to be a success, but rather to be of value.&rdquo;- Albert Einstein</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Everyone wants to be successful in life. But instead of running behind success, aim for excellence. Strive for it and eventually you&rsquo;ll become successful.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Think big and don&rsquo;t listen to people who tell you it can&rsquo;t be done. Life&rsquo;s too short to think small.&rdquo;- Timothy Ferriss</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Dream big and act on it to make it happen. Do what you&rsquo;re passionate about and embrace it. Whatever you enjoy doing make it your profession. Satisfy your inner interest before others. It&rsquo;s you who can make your dream come true and not them. Take a chance and trust yourself.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;In between goals is a thing called life, that has to be lived and enjoyed.&rdquo;- Sid Caesar</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							You can concentrate on your goals but do not forget to have life. Study effectively and work hard but don&rsquo;t forget to relax and enjoy a bit. Go out with friends and have quality time with your family. Pursue your goals while living a balanced life.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;The future belongs to those who believe in the beauty of their dreams.&rdquo;- Eleanor Roosevelt</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Envision yourself living to your dream and figure out how you can achieve it. If you dream to become a business person, teacher, doctor, nurse, engineer, etc. then plan how you&rsquo;re going to reach it. No matter what life throws at you, keep going and live to your purpose.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Choose a job you love, and you will never have to work a day in your life.&rdquo;- Confucius</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Do something that you have talent for and you love doing. Using your interest as your basis in finding your career path will help you determine the right direction towards your goals. If you love your profession, you will have a great time doing the job and less likely to experience stress.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Too many of us are not living our dreams because we are living our fears.&rdquo;- Les Brown</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							There will be moments when you doubt your own ability to succeed. You lose enthusiasm and drive to keep going. But instead of letting yourself defeat by your own fears, why not give yourself a fair chance to do everything that you can. You never know where your courage will take you.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Desire! That&rsquo;s the one secret of every man&rsquo;s career. Not education. Not being born with hidden talents. Desire.&rdquo;- Bobby Unser</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Having a strong desire or will is what keeps you from achieving your goals. If you desire to succeed in life, you can do everything to make your goal a reality. This gives you hope, inspiration, and driving force to move forward and accomplish something.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;To accomplish great things, we must not only act, but also dream, not only plan, but also believe.&rdquo;- Anatole France</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							A dream without action is dead. Having dreams without believing on it is useless. If you dream make sure it&rsquo;s big, plan on how to get it and be confident that you can reach it. If you desire to get a particular job, even if it seems impossible to achieve, never stop believing and do your best to get it. You can start from taking small steps until you reach goal.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;We become what we think about.&rdquo;- Earl Nightingale</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							While you&rsquo;re young, have a clear vision of your future. Even though you&rsquo;re still clueless with your destination just think of what you wanted to become. Fill your mind with positive thoughts, dreams, and beliefs so that it would manifest into your life. Stop worrying, stop complaining. Do not let the idea of &ldquo;what if&rsquo;s&rdquo; corrupt your dreams. You might not control everything that may happen to you but you have a choice to take it or leave it behind.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;It is good to have an end to journey toward; but it is the journey that matters, in the end.&rdquo;- Ernest Hemingway</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							It&rsquo;s good to have a goal so you know where you&rsquo;re heading at. However, aside from focusing on your destination, it&rsquo;s the long journey that will matter in the end. The goal of most college students probably is to have a good career. You study hard to complete your education and acquire the skills needed for your job application. Of course, you can set your eyes towards your goal but do not forget everything you&rsquo;ve learned and experienced while you&rsquo;re on your way there.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Opportunities don&rsquo;t happen, you create them.&rdquo;- Chris Grosser</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Successful people didn&rsquo;t wait for opportunities to knock on their doors. They created it that&rsquo;s why they&rsquo;re reaping what they have sown. Apply this truth to your life and you&rsquo;ll definitely accomplish everything on your own.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Motivation is what gets you started. Habit is what keeps you going.&rdquo;- Jim Ryun</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Staying consistently motivated in reaching your goals will eventually become your habit. If you continuously do things properly then you&rsquo;ll keep going until you get to your destination. When you&rsquo;re motivated, you have a reason to do what you love.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.&rdquo;- Thomas A. Edison</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Failures happen to anyone and yes, it happens all the time. Don&rsquo;t feel hopeless after failing many times. You just have to understand perfectly the purpose of failure in your life in order to realize that it is something you need to succeed. Giving up will stop you from achieving greatness and making a difference. So instead of thinking about quitting, why not take it as an opportunity to make things way better?</p>\r\n						<hr />\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Carrer Artical', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-1\">\r\n				&nbsp;</div>\r\n			<div class=\"col-md-10\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Enter every activity without giving mental recognition to the possibility of defeat. Concentrate on your strengths, instead of your weaknesses&hellip; on your powers, instead of your problems.&rdquo;- Paul J. Meyer</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Life in the real world is different from being a student. Challenges are inevitable as well as failures. However, if you focus on your strengths and use your weaknesses to improve yourself, nothing is impossible to a determined person.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Success consists of going from failure to failure without loss of enthusiasm.&rdquo;- Winston Churchill</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							You are young. It&rsquo;s okay to make mistakes. If you get into a wrong career path, or you meet a bad boss, or you&rsquo;re dissatisfied with your job, it&rsquo;s okay that&rsquo;s normal. In the span of your career journey, you will surely make mistakes and fail many times. You&rsquo;re still inexperienced so enjoy exploring life. Fix your mistakes and learn from them, then move forward- That&rsquo;s the joy of learning.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Strive not to be a success, but rather to be of value.&rdquo;- Albert Einstein</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Everyone wants to be successful in life. But instead of running behind success, aim for excellence. Strive for it and eventually you&rsquo;ll become successful.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Think big and don&rsquo;t listen to people who tell you it can&rsquo;t be done. Life&rsquo;s too short to think small.&rdquo;- Timothy Ferriss</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Dream big and act on it to make it happen. Do what you&rsquo;re passionate about and embrace it. Whatever you enjoy doing make it your profession. Satisfy your inner interest before others. It&rsquo;s you who can make your dream come true and not them. Take a chance and trust yourself.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;In between goals is a thing called life, that has to be lived and enjoyed.&rdquo;- Sid Caesar</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							You can concentrate on your goals but do not forget to have life. Study effectively and work hard but don&rsquo;t forget to relax and enjoy a bit. Go out with friends and have quality time with your family. Pursue your goals while living a balanced life.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;The future belongs to those who believe in the beauty of their dreams.&rdquo;- Eleanor Roosevelt</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Envision yourself living to your dream and figure out how you can achieve it. If you dream to become a business person, teacher, doctor, nurse, engineer, etc. then plan how you&rsquo;re going to reach it. No matter what life throws at you, keep going and live to your purpose.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Choose a job you love, and you will never have to work a day in your life.&rdquo;- Confucius</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Do something that you have talent for and you love doing. Using your interest as your basis in finding your career path will help you determine the right direction towards your goals. If you love your profession, you will have a great time doing the job and less likely to experience stress.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Too many of us are not living our dreams because we are living our fears.&rdquo;- Les Brown</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							There will be moments when you doubt your own ability to succeed. You lose enthusiasm and drive to keep going. But instead of letting yourself defeat by your own fears, why not give yourself a fair chance to do everything that you can. You never know where your courage will take you.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Desire! That&rsquo;s the one secret of every man&rsquo;s career. Not education. Not being born with hidden talents. Desire.&rdquo;- Bobby Unser</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Having a strong desire or will is what keeps you from achieving your goals. If you desire to succeed in life, you can do everything to make your goal a reality. This gives you hope, inspiration, and driving force to move forward and accomplish something.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;To accomplish great things, we must not only act, but also dream, not only plan, but also believe.&rdquo;- Anatole France</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							A dream without action is dead. Having dreams without believing on it is useless. If you dream make sure it&rsquo;s big, plan on how to get it and be confident that you can reach it. If you desire to get a particular job, even if it seems impossible to achieve, never stop believing and do your best to get it. You can start from taking small steps until you reach goal.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;We become what we think about.&rdquo;- Earl Nightingale</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							While you&rsquo;re young, have a clear vision of your future. Even though you&rsquo;re still clueless with your destination just think of what you wanted to become. Fill your mind with positive thoughts, dreams, and beliefs so that it would manifest into your life. Stop worrying, stop complaining. Do not let the idea of &ldquo;what if&rsquo;s&rdquo; corrupt your dreams. You might not control everything that may happen to you but you have a choice to take it or leave it behind.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;It is good to have an end to journey toward; but it is the journey that matters, in the end.&rdquo;- Ernest Hemingway</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							It&rsquo;s good to have a goal so you know where you&rsquo;re heading at. However, aside from focusing on your destination, it&rsquo;s the long journey that will matter in the end. The goal of most college students probably is to have a good career. You study hard to complete your education and acquire the skills needed for your job application. Of course, you can set your eyes towards your goal but do not forget everything you&rsquo;ve learned and experienced while you&rsquo;re on your way there.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Opportunities don&rsquo;t happen, you create them.&rdquo;- Chris Grosser</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Successful people didn&rsquo;t wait for opportunities to knock on their doors. They created it that&rsquo;s why they&rsquo;re reaping what they have sown. Apply this truth to your life and you&rsquo;ll definitely accomplish everything on your own.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Motivation is what gets you started. Habit is what keeps you going.&rdquo;- Jim Ryun</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Staying consistently motivated in reaching your goals will eventually become your habit. If you continuously do things properly then you&rsquo;ll keep going until you get to your destination. When you&rsquo;re motivated, you have a reason to do what you love.</p>\r\n						<hr />\r\n					</div>\r\n					<div class=\"career-title\">\r\n						<h3>\r\n							&ldquo;Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.&rdquo;- Thomas A. Edison</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Failures happen to anyone and yes, it happens all the time. Don&rsquo;t feel hopeless after failing many times. You just have to understand perfectly the purpose of failure in your life in order to realize that it is something you need to succeed. Giving up will stop you from achieving greatness and making a difference. So instead of thinking about quitting, why not take it as an opportunity to make things way better?</p>\r\n						<hr />\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'career-artical', '2021-10-10 09:58:45', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, '');
INSERT INTO `comm_pages` (`page_id`, `page_title_hi`, `page_description_hi`, `page_title_en`, `page_description_en`, `pre_url`, `page_url`, `page_added_date`, `page_added_by`, `page_edit_date`, `page_edit_by`, `page_status`, `meta_title`, `meta_keyword`, `meta_desc`, `is_default`, `is_delete`, `attachment`) VALUES
(9, 'Industries we serve', '<section class=\"service sec-padd-top\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/agriculture.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									FMCG Services</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										FMCG Services</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										The FMCG Sector is standing on the substratum of Fashion Industry.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/bpo.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Call Center &amp; BPO</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Call Center &amp; BPO</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										The emergence of ICE has necessitated the need for professionally qualified and talented people in the Information technology (IT) sector.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/finance.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Financial Services</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Financial Services</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										Financial Services is one such industry that requires candidates with high intellect.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/construction.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Manufacturing Services</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Manufacture Services</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										We blend diverse expertise with keen foresight to facilitate projects and mitigate construction risk.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/media.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Media</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Media</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										It has long been at the center of the converging communications, media and entertainment industries.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/telecom.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Telecom Service</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Telecom Service</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										Telecommunication industry is one of the biggest means to hold the communication among people these days.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"row\">\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/it-service.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									IT Services</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										IT Services</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										Information Technology (I.T) is a product of globalization that makes the working environment efficient thus enhancing the rate of productivity.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n				<div class=\"item\">\r\n					<figure class=\"img-box\">\r\n						<a href=\"#\"><img alt=\"\" src=\"images/industries/education.jpg\" /></a>\r\n						<div class=\"bottom-content\">\r\n							<div class=\"clearfix\">\r\n								<div class=\"icon_box\">\r\n									&nbsp;</div>\r\n								<h4>\r\n									Education</h4>\r\n							</div>\r\n						</div>\r\n						<div class=\"overlay-box\">\r\n							<div class=\"inner-box\">\r\n								<div class=\"clearfix\">\r\n									<div class=\"icon_box\">\r\n										&nbsp;</div>\r\n									<h4>\r\n										Education</h4>\r\n								</div>\r\n								<div class=\"text\">\r\n									<p>\r\n										The spread of education, the number of academic institutes has increased drastically all over the world.</p>\r\n								</div>\r\n								<div class=\"link\">\r\n									<a class=\"default_link\" href=\"post-requirements.php\">Share Your Requirements </a></div>\r\n							</div>\r\n						</div>\r\n					</figure>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Industries we serve', '<section class=\"service sec-padd-top\">\r\n    <div class=\"container\">\r\n\r\n        <div class=\"row\">\r\n            \r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/agriculture.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-travel\"></span>\r\n                                </div>\r\n                                <h4>FMCG Services</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-travel\"></span>\r\n                                    </div>\r\n                                    <h4>FMCG Services</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>The FMCG Sector is standing on the substratum of Fashion Industry. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/bpo.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-search\"></span>\r\n                                </div>\r\n                                <h4>Call Center &amp; BPO</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-search\"></span>\r\n                                    </div>\r\n                                    <h4>Call Center &amp; BPO</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>The emergence of ICE has necessitated the need for professionally qualified and talented people in the Information technology (IT) sector.  </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n            \r\n            \r\n\r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/finance.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-business-2\"></span>\r\n                                </div>\r\n                                <h4>Financial Services</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-business-2\"></span>\r\n                                    </div>\r\n                                    <h4>Financial Services</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>Financial Services is one such industry that requires candidates with high intellect. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/construction.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-business-2\"></span>\r\n                                </div>\r\n                                <h4>Manufacturing Services</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-business-2\"></span>\r\n                                    </div>\r\n                                    <h4>Manufacture Services</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>We blend diverse expertise with keen foresight to facilitate projects and mitigate construction risk. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/media.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-business-2\"></span>\r\n                                </div>\r\n                                <h4>Media</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-business-2\"></span>\r\n                                    </div>\r\n                                    <h4>Media</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p> It has long been at the center of the converging communications, media and entertainment industries. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/telecom.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-business-2\"></span>\r\n                                </div>\r\n                                <h4>Telecom Service</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-business-2\"></span>\r\n                                    </div>\r\n                                    <h4>Telecom Service</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>Telecommunication industry is one of the biggest means to hold the communication among people these days. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n\r\n           \r\n\r\n\r\n\r\n            \r\n            \r\n        </div>\r\n\r\n        <div class=\"row\">\r\n             <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/it-service.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-arrow\"></span>\r\n                                </div>\r\n                                <h4>IT Services </h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-arrow\"></span>\r\n                                    </div>\r\n                                    <h4>IT Services</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>Information Technology (I.T) is a product of globalization that makes the working environment efficient thus enhancing the rate of productivity.  </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        \r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n\r\n             <div class=\"col-md-4 col-sm-6 col-xs-12\">\r\n                <div class=\"item\">\r\n                    <figure class=\"img-box\">\r\n                        <a href=\"#\"><img src=\"images/industries/education.jpg\" alt=\"\"></a>\r\n                        <div class=\"bottom-content\">\r\n                            <div class=\"clearfix\">\r\n                                <div class=\"icon_box\">\r\n                                    <span class=\"icon-business\"></span>\r\n                                </div>\r\n                                <h4>Education</h4>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        <div class=\"overlay-box\">\r\n                            <div class=\"inner-box\">\r\n                                <div class=\"clearfix\">\r\n                                    <div class=\"icon_box\">\r\n                                        <span class=\"icon-business\"></span>\r\n                                    </div>\r\n                                    <h4>Education</h4>\r\n                                </div>\r\n                                    \r\n                                <div class=\"text\">\r\n                                    <p>The spread of education, the number of academic institutes has increased drastically all over the world. </p>\r\n                                </div>\r\n                                <div class=\"link\">\r\n                                    <a href=\"post-requirements.php\" class=\"default_link\">Share Your Requirements <i class=\"fa fa-angle-right\"></i></a>\r\n                                </div>\r\n                            </div>\r\n                                \r\n                        </div>\r\n                        \r\n                    </figure>  \r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>', 'page/content/', 'industries-we-serve', '2021-10-10 10:01:38', 1, '2021-10-10 11:17:40', 1, 1, '', '', '', 0, 0, ''),
(10, 'Manpower Recruitment Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower Recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/temp-staffing\">Temp staffing</a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"intro-img\">\r\n						<div class=\"row\">\r\n							<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n								<div class=\"img-box\">\r\n									<img alt=\"\" src=\"images/service/2.jpg\" /></div>\r\n							</div>\r\n							<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n								<div class=\"img-box\">\r\n									<img alt=\"\" src=\"images/service/3.jpg\" /></div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							We offer Manpower Recruitment Services. These services are highly admired in the market owing to their reliability and low prices. In this service, we provide right candidate who have rich industry knowledge. We complete this service under the administration of strict rule and guidelines.</p>\r\n						<br />\r\n						<p>\r\n							We are the leading organization in the industry to offer our precious clients an optimum quality Manpower Services. We provide professionals for factory and plant site works. The professionals we provide are recruited and selected only after a thorough interview and only when it is proved that they can attain the needs of our esteemed clients. We conduct training schedule for the candidates after selection in order to help them serve our clients better.</p>\r\n						<br />\r\n						<p>\r\n							We have with us extensive experience in utilizing our expertise as well as professional recruitment principles to find best possible placement solutions for our clients. Here, other than having deep understanding of international manpower recruitment services, we also hold expertise in providing comprehensive HR services as well as recruit-ment solution support for maximizing clients&#39; manpower potential. Being a global recruitment entity.</p>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<div class=\"border-bottom\">\r\n						&nbsp;</div>\r\n					<br />\r\n					&nbsp;</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Manpower Recruitment Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower Recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/temp-staffing\">Temp staffing</a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"intro-img\">\r\n						<div class=\"row\">\r\n							<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n								<div class=\"img-box\">\r\n									<img alt=\"\" src=\"images/service/2.jpg\" /></div>\r\n							</div>\r\n							<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n								<div class=\"img-box\">\r\n									<img alt=\"\" src=\"images/service/3.jpg\" /></div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							We offer Manpower Recruitment Services. These services are highly admired in the market owing to their reliability and low prices. In this service, we provide right candidate who have rich industry knowledge. We complete this service under the administration of strict rule and guidelines.</p>\r\n						<br />\r\n						<p>\r\n							We are the leading organization in the industry to offer our precious clients an optimum quality Manpower Services. We provide professionals for factory and plant site works. The professionals we provide are recruited and selected only after a thorough interview and only when it is proved that they can attain the needs of our esteemed clients. We conduct training schedule for the candidates after selection in order to help them serve our clients better.</p>\r\n						<br />\r\n						<p>\r\n							We have with us extensive experience in utilizing our expertise as well as professional recruitment principles to find best possible placement solutions for our clients. Here, other than having deep understanding of international manpower recruitment services, we also hold expertise in providing comprehensive HR services as well as recruit-ment solution support for maximizing clients&#39; manpower potential. Being a global recruitment entity.</p>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<div class=\"border-bottom\">\r\n						&nbsp;</div>\r\n					<br />\r\n					&nbsp;</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'manpower-recruitment', '2021-10-10 10:50:22', 1, '2021-10-10 11:13:24', 1, 1, '', '', '', 0, 0, ''),
(11, 'Placement Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/placement-services.php\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services.php\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training.php\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/temp-staffing\">Temp Staffing</a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get In Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"row\">\r\n						<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n							<div class=\"section-title\">\r\n								<h3>\r\n									CAMPUS PLACEMENT</h3>\r\n							</div>\r\n							<h4 style=\"line-height: 30px;\">\r\n								3SP Resources has successfully facilitated the student community in finding the most awesome career opportunities available and simultaneously empowered its clients seeking for the best talent, thereby matching,</h4>\r\n						</div>\r\n						<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n							<div class=\"img-box\">\r\n								<a href=\"#\"><img alt=\"\" src=\"images/service/hiring-1.jpg\" /></a></div>\r\n							<div class=\"content center over-view\">\r\n								<h4>\r\n									We deliver right solution for you</h4>\r\n								<a href=\"contact.php\">Free Consultation</a></div>\r\n						</div>\r\n					</div>\r\n					<h4 class=\"training-skills\">\r\n						To Make Every Graduate Employable!</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								3SP Resources is involved in recruiting the candidates according to the job profile of the requirement.</li>\r\n							<li>\r\n								3SP Resourcesis having Tie- Ups with more then 50 + institutions all over India for their placements services or campus drives.</li>\r\n							<li>\r\n								The placement cell of the respective Educational Institution usually provides certain facilities like accommodation / transportation to the respective Clients if required.</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<h4 class=\"training-skills\">\r\n						Benefits of Campus Recruitment</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Get access to authentic candidates with genuine degrees / qualifications.</li>\r\n							<li>\r\n								Opportunity for interacting with the best talent pool under one roof.</li>\r\n							<li>\r\n								Opportunity to choose from and select the best talent in a short span of time.</li>\r\n							<li>\r\n								Companies end up saving a lot of time and efforts that go in advertising vacancies, screening and eventually selecting applicants for employment.</li>\r\n							<li>\r\n								College students who are just passing out get the opportunity to present themselves to some of the best Companies within their industry of interest. Landing a job offer while still in college and joining just after graduating is definitely what all students dream of.</li>\r\n							<li>\r\n								Verify documents certified by the college.</li>\r\n							<li>\r\n								Centralized quick processing</li>\r\n							<li>\r\n								Cost effectiveness and Significant reduction in efforts pertaining to logistics / co-ordination.</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<h4 class=\"training-skills\">\r\n						Process of conducting Campus Drive</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Shortlist from Resumes.</li>\r\n							<li>\r\n								CPI (minimum).</li>\r\n							<li>\r\n								Pre Placement Talk: Yes (If yes, equipment required for PPT: Laptop)</li>\r\n							<li>\r\n								Aptitude Test</li>\r\n							<li>\r\n								Group Discussion</li>\r\n							<li>\r\n								Personal Interview</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Why Us</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Driven by the passion to excel and single objective of the clients, we are committed to deliver quality in every element of our search, our people , our process &amp; our database of proven &amp; emerging talent. In the process of helping our client organizations in achieving the goals in most efficient and cost effective manner, our services are competitively priced and are aligned to the Industry standards.</p>\r\n					</div>\r\n					<div class=\"tag-line\">\r\n						Right People with the Right Job</div>\r\n					<div class=\"analysis-result\">\r\n						<h4>\r\n							To Clients:</h4>\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Acquire the potentials of talented candidates for their esteemed organization.</li>\r\n							<li>\r\n								Co &ndash; employment relationship between the client, employee and 3SP Resources.</li>\r\n							<li>\r\n								Manage HR, Administration and regulatory compliances.</li>\r\n							<li>\r\n								Contract duration: Short term &amp; long term.</li>\r\n							<li>\r\n								Option of Absorption on completion of the assignment.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Placement Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/placement-services.php\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services.php\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training.php\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/temp-staffing\">Temp Staffing</a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get In Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9\">\r\n				<div class=\"outer-box\">\r\n					<div class=\"row\">\r\n						<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n							<div class=\"section-title\">\r\n								<h3>\r\n									CAMPUS PLACEMENT</h3>\r\n							</div>\r\n							<h4 style=\"line-height: 30px;\">\r\n								3SP Resources has successfully facilitated the student community in finding the most awesome career opportunities available and simultaneously empowered its clients seeking for the best talent, thereby matching,</h4>\r\n						</div>\r\n						<div class=\"col-md-6 col-sm-6 col-xs-12\">\r\n							<div class=\"img-box\">\r\n								<a href=\"#\"><img alt=\"\" src=\"images/service/hiring-1.jpg\" /></a></div>\r\n							<div class=\"content center over-view\">\r\n								<h4>\r\n									We deliver right solution for you</h4>\r\n								<a href=\"contact.php\">Free Consultation</a></div>\r\n						</div>\r\n					</div>\r\n					<h4 class=\"training-skills\">\r\n						To Make Every Graduate Employable!</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								3SP Resources is involved in recruiting the candidates according to the job profile of the requirement.</li>\r\n							<li>\r\n								3SP Resourcesis having Tie- Ups with more then 50 + institutions all over India for their placements services or campus drives.</li>\r\n							<li>\r\n								The placement cell of the respective Educational Institution usually provides certain facilities like accommodation / transportation to the respective Clients if required.</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<h4 class=\"training-skills\">\r\n						Benefits of Campus Recruitment</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Get access to authentic candidates with genuine degrees / qualifications.</li>\r\n							<li>\r\n								Opportunity for interacting with the best talent pool under one roof.</li>\r\n							<li>\r\n								Opportunity to choose from and select the best talent in a short span of time.</li>\r\n							<li>\r\n								Companies end up saving a lot of time and efforts that go in advertising vacancies, screening and eventually selecting applicants for employment.</li>\r\n							<li>\r\n								College students who are just passing out get the opportunity to present themselves to some of the best Companies within their industry of interest. Landing a job offer while still in college and joining just after graduating is definitely what all students dream of.</li>\r\n							<li>\r\n								Verify documents certified by the college.</li>\r\n							<li>\r\n								Centralized quick processing</li>\r\n							<li>\r\n								Cost effectiveness and Significant reduction in efforts pertaining to logistics / co-ordination.</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<h4 class=\"training-skills\">\r\n						Process of conducting Campus Drive</h4>\r\n					<div class=\"analysis-result\">\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Shortlist from Resumes.</li>\r\n							<li>\r\n								CPI (minimum).</li>\r\n							<li>\r\n								Pre Placement Talk: Yes (If yes, equipment required for PPT: Laptop)</li>\r\n							<li>\r\n								Aptitude Test</li>\r\n							<li>\r\n								Group Discussion</li>\r\n							<li>\r\n								Personal Interview</li>\r\n						</ul>\r\n					</div>\r\n					<br />\r\n					<br />\r\n					<div class=\"section-title\">\r\n						<h3>\r\n							Why Us</h3>\r\n					</div>\r\n					<div class=\"text\">\r\n						<p>\r\n							Driven by the passion to excel and single objective of the clients, we are committed to deliver quality in every element of our search, our people , our process &amp; our database of proven &amp; emerging talent. In the process of helping our client organizations in achieving the goals in most efficient and cost effective manner, our services are competitively priced and are aligned to the Industry standards.</p>\r\n					</div>\r\n					<div class=\"tag-line\">\r\n						Right People with the Right Job</div>\r\n					<div class=\"analysis-result\">\r\n						<h4>\r\n							To Clients:</h4>\r\n						<ul class=\"ul-list\">\r\n							<li>\r\n								Acquire the potentials of talented candidates for their esteemed organization.</li>\r\n							<li>\r\n								Co &ndash; employment relationship between the client, employee and 3SP Resources.</li>\r\n							<li>\r\n								Manage HR, Administration and regulatory compliances.</li>\r\n							<li>\r\n								Contract duration: Short term &amp; long term.</li>\r\n							<li>\r\n								Option of Absorption on completion of the assignment.</li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'placement-services', '2021-10-10 10:55:13', 1, '2021-10-10 11:13:01', 1, 1, '', '', '', 0, 0, '');
INSERT INTO `comm_pages` (`page_id`, `page_title_hi`, `page_description_hi`, `page_title_en`, `page_description_en`, `pre_url`, `page_url`, `page_added_date`, `page_added_by`, `page_edit_date`, `page_edit_by`, `page_status`, `meta_title`, `meta_keyword`, `meta_desc`, `is_default`, `is_delete`, `attachment`) VALUES
(12, 'IT Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/outsourcing-staffing\">Temp staffing </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"career-title\">\r\n					<h3 style=\"font-size: 17px;\">\r\n						&quot;IT Staffing is one of the outsourcing strategies where the service contributor provides skilled staff to the client and helps the client in achieving business objectives. IT Staffing is an efficient way to get highly qualified and specialized Personnel at a substantially low cost.&quot;</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						3SP Resources IT Services, offers IT Staffing services to clients, enabling them to extend their staff to our offshore development center in India taking advantage of our qualified and experienced personnel. Our services provide clients with a cost effective solution to increase and expand their staff and help organizations to accomplish their special or seasonal projects.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						IT Staffing Models</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						Committed to achieve maximum customer satisfaction, we offer customized IT Staffing models with the objective of meeting specific requirements of our clients in the most efficient manner.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Flat Price Project</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						In this this model, flat price quotes are provided to the client for flat scope of work and flat deadline. The model is based on our extensive experience and standard work metrics, which ensure on-time, in-budget delivery of any solution required. In this case a percentage differential will not exist and changes to the price would only happen if the customer changes the specification.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Flexible Time and Delivery</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						This model is well-suited for those companies that do not have well-defined requirements, need research work, or want ongoing software enhancements. The client and GlobalHunt agree on an estimation for the specified task, and the Project Manager assigns the task to the developer and assures that it is completed as close to the estimate as possible without degrading the quality of the final solution.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"border-bottom\">\r\n					&nbsp;</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"text\">\r\n					<p>\r\n						We are a renowned recruitment agency offering complete Staffing Solutions to clients in the countries such as India, UAE, Oman, Bahrain Qatar, Kuwait and Saudi Arabia. We have the expertise in offering competent staff for all the level including junior, middle as well as senior level positions. We are competent enough to manage manpower requirements on a very short notice as well. We offer Staffing Solutions to clients across diverse sectors. We take complete responsibility of recruiting the staff right from the screening process to the final selection under the guidance of expert HR consultants.</p>\r\n				</div>\r\n				<div class=\"row\">\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Mobile App Development</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								We build custom application according to need for any domain in any platform like Android, Iphone, Windows and Blackberry.</p>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Software Development</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								3SP provides end to end software development and maintenance services to its customers across the globe to effectively maintain and run their mission critical applications.</p>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Web Development/Designing</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								Beat market competition with an interactive online presence. We provide a comprehensive range of web services, including design, portals and ecommerce application.</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'IT Services', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/outsourcing-staffing\">Temp staffing </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"career-title\">\r\n					<h3 style=\"font-size: 17px;\">\r\n						&quot;IT Staffing is one of the outsourcing strategies where the service contributor provides skilled staff to the client and helps the client in achieving business objectives. IT Staffing is an efficient way to get highly qualified and specialized Personnel at a substantially low cost.&quot;</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						3SP Resources IT Services, offers IT Staffing services to clients, enabling them to extend their staff to our offshore development center in India taking advantage of our qualified and experienced personnel. Our services provide clients with a cost effective solution to increase and expand their staff and help organizations to accomplish their special or seasonal projects.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						IT Staffing Models</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						Committed to achieve maximum customer satisfaction, we offer customized IT Staffing models with the objective of meeting specific requirements of our clients in the most efficient manner.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Flat Price Project</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						In this this model, flat price quotes are provided to the client for flat scope of work and flat deadline. The model is based on our extensive experience and standard work metrics, which ensure on-time, in-budget delivery of any solution required. In this case a percentage differential will not exist and changes to the price would only happen if the customer changes the specification.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"section-title\">\r\n					<h3>\r\n						Flexible Time and Delivery</h3>\r\n				</div>\r\n				<div class=\"text\">\r\n					<p>\r\n						This model is well-suited for those companies that do not have well-defined requirements, need research work, or want ongoing software enhancements. The client and GlobalHunt agree on an estimation for the specified task, and the Project Manager assigns the task to the developer and assures that it is completed as close to the estimate as possible without degrading the quality of the final solution.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"border-bottom\">\r\n					&nbsp;</div>\r\n				<br />\r\n				<br />\r\n				<div class=\"text\">\r\n					<p>\r\n						We are a renowned recruitment agency offering complete Staffing Solutions to clients in the countries such as India, UAE, Oman, Bahrain Qatar, Kuwait and Saudi Arabia. We have the expertise in offering competent staff for all the level including junior, middle as well as senior level positions. We are competent enough to manage manpower requirements on a very short notice as well. We offer Staffing Solutions to clients across diverse sectors. We take complete responsibility of recruiting the staff right from the screening process to the final selection under the guidance of expert HR consultants.</p>\r\n				</div>\r\n				<div class=\"row\">\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Mobile App Development</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								We build custom application according to need for any domain in any platform like Android, Iphone, Windows and Blackberry.</p>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Software Development</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								3SP provides end to end software development and maintenance services to its customers across the globe to effectively maintain and run their mission critical applications.</p>\r\n						</div>\r\n					</div>\r\n					<div class=\"col-md-4 col-sm-12 col-xs-12\">\r\n						<h3 class=\"outsourcing-head\">\r\n							Web Development/Designing</h3>\r\n						<div class=\"analysis-result\">\r\n							<p>\r\n								Beat market competition with an interactive online presence. We provide a comprehensive range of web services, including design, portals and ecommerce application.</p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'it-services', '2021-10-10 10:59:50', 1, '2021-10-10 11:13:56', 1, 1, '', '', '', 0, 0, ''),
(13, 'Training', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/outsourcing-staffing\">Temp staffing </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"text\">\r\n					<p>\r\n						We are a Corporate Training house based at Bhopal, with services extended to all over India. Our Corporate Training Programs are aimed at enriching the work place and creating a positive environment of confidence, knowledge, teamwork, cooperation and initiation. We believe that good communication within the organization is extremely important, and so is teamwork and performance. Training programs are customized according to needs of every group and therefore the objectives of each program are clear and achievable.</p>\r\n					<br />\r\n					<br />\r\n					<p>\r\n						The training we facilitate in degree colleges (Engineering/ Management, General) traverses Life-Skills and Employability Skills catering to Teachers and Students to help them improve their performance in respective fields. Build their Self confidence and help them perform better in life. There are separate Teacher&#39;s Training Programs and Pre-Placement Training programs for students.</p>\r\n					<br />\r\n					<br />\r\n					<b>Different types of training we do</b><br />\r\n					<br />\r\n					<ul>\r\n						<li class=\"training-skills\">\r\n							Soft Skill Training</li>\r\n						<li class=\"training-skills\">\r\n							Behavioral Training</li>\r\n						<li class=\"training-skills\">\r\n							Campus Training</li>\r\n						<li class=\"training-skills\">\r\n							Corporate Training</li>\r\n						<li class=\"training-skills\">\r\n							Stress Training</li>\r\n						<li class=\"training-skills\">\r\n							Mock Interviews</li>\r\n					</ul>\r\n					<img class=\"training-img\" src=\"/uploads/media/training.png\" /></div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'Training', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n						<li>\r\n							<a href=\"3spnew/outsourcing-staffing\">Temp staffing </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"text\">\r\n					<p>\r\n						We are a Corporate Training house based at Bhopal, with services extended to all over India. Our Corporate Training Programs are aimed at enriching the work place and creating a positive environment of confidence, knowledge, teamwork, cooperation and initiation. We believe that good communication within the organization is extremely important, and so is teamwork and performance. Training programs are customized according to needs of every group and therefore the objectives of each program are clear and achievable.</p>\r\n					<br />\r\n					<br />\r\n					<p>\r\n						The training we facilitate in degree colleges (Engineering/ Management, General) traverses Life-Skills and Employability Skills catering to Teachers and Students to help them improve their performance in respective fields. Build their Self confidence and help them perform better in life. There are separate Teacher&#39;s Training Programs and Pre-Placement Training programs for students.</p>\r\n					<br />\r\n					<br />\r\n					<b>Different types of training we do</b><br />\r\n					<br />\r\n					<ul>\r\n						<li class=\"training-skills\">\r\n							Soft Skill Training</li>\r\n						<li class=\"training-skills\">\r\n							Behavioral Training</li>\r\n						<li class=\"training-skills\">\r\n							Campus Training</li>\r\n						<li class=\"training-skills\">\r\n							Corporate Training</li>\r\n						<li class=\"training-skills\">\r\n							Stress Training</li>\r\n						<li class=\"training-skills\">\r\n							Mock Interviews</li>\r\n					</ul>\r\n					<img class=\"training-img\" src=\"/uploads/media/training.png\" /></div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>\r\n<p>\r\n	&nbsp;</p>', 'page/content/', 'training', '2021-10-10 11:03:16', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, ''),
(14, 'Outsourcing And Staffing Solution', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/temp-staffing\">Temp staffing </a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"text\">\r\n					<p>\r\n						Across the country, organisations big and small are struggling to deal with increased government regulations and volatile market demand. When things are uncertain, you may not want to hire permanent employees on a full-time basis. You want the flexibility of an agile, on-demand workforce who is equipped to run your business operations just the way you want them to.</p>\r\n					<br />\r\n					<p>\r\n						3SP Resources provides reliable temporary staffing solutions that offer you the ability to build your staff strength without absorbing them full time, assist overloaded employees during critical times, and keep projects moving. We are one of the leading employee leasing services in India, offering a full service, cost-effective, and efficient Human Resource Management services to organisations that may not have the necessary infrastructure or inclination to perform these labour-intensive tasks. When you hire us as your temporary staffing agency, we would work just like your company&#39;s own HR Department, minus the hassles and tediousness that you&rsquo;d otherwise have to deal with.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					Highlights of our temporary staffing services</h4>\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							Temporary employees who will stay on our rolls.</li>\r\n						<li>\r\n							Standard contractual procedures that we will handle.</li>\r\n						<li>\r\n							Payroll and personnel administration.</li>\r\n						<li>\r\n							Statutory compliance, remittance of statutory payments, and other related administration.</li>\r\n						<li>\r\n							Employee registration under ESIC &amp; EPF schemes</li>\r\n					</ul>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					WE RECRUIT FOR YOUR NEEDS</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						We have a proven, time-tested recruitment process which allows us to recruit just the right candidates for your company. We have professional networks all over the country which give us access to a huge base of candidates. We vigorously screen, shortlist, and evaluate potential candidates to give you the choicest picks.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					DECREASE YOUR COSTS</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						Our temporary staffing services will allow your company to staff up or down depending on the needs of your current business cycle. Temporary staffing allows you to bring down your costs on hiring, training, and providing benefits to new employees, along with the administrative costs of the human resources department. It also lets you give a respite to your permanent staff who may be overloaded during busy periods.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					REDUCE ADMINISTRATIVE BURDEN</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						There are umpteen laws that organisations have to comply with in India - minimum wages, gratuity, ESIC, PF etc. just to name a few. 3SP Resources takes over the burden of all administrative tasks by acting as the central point for all temporary staffing requirements including labour law compliance and other legal issues. We have a team of legal eagles and compliance officers to ensure that your business will be in 100% compliance with all the statutory regulations in the market.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					EMPLOYEE LEASING AND CONTRACT STAFFING</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						Our employee leasing service works by simply transferring employees from a company on to the payroll of 3SP Resources employee leasing services, and then releasing them back to the company on a temporary basis. This facilitates 3SP Resources to become the legal employer, thus taking over all your HR administrative and management hassles.<br />\r\n						<br />\r\n						When you outsource your HR administration to us, it will give you more time to focus on your core business, while saving you money, time, and resources. We have a huge, multidisciplinary selection of temporary staff including attorneys, qualified accountants, insurance experts, and other professionals. No matter what kind of personnel you&#39;re looking for, or for what duration, we can find the right people for you.<br />\r\n						<br />\r\n						Contract labour has been in existence for a long time, but now it is becoming more prominent even in white-collar jobs. Contract staffing is advantageous for both businesses and employees. Organisations have the flexibility of finding people for short projects, while talented employees also get to chart out a clear career path by progressively handling more challenging and higher positions in different companies.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					Approach us when you need people for a short duration, a specific project, or to tide over your seasonal staffing requirements.</h4>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'Outsourcing And Staffing Solution', '<section class=\"service-single sec-padd\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-12 col-xs-12\">\r\n				<div class=\"service-sidebar\">\r\n					<ul class=\"service-catergory\">\r\n						<li>\r\n							<a href=\"3spnew/manpower-recruitment\">Manpower recruitment Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/placement-services\">Placement Services</a></li>\r\n						<li class=\"active\">\r\n							<a href=\"3spnew/temp-staffing\">Temp staffing </a></li>\r\n						<li>\r\n							<a href=\"3spnew/it-services\">IT Services</a></li>\r\n						<li>\r\n							<a href=\"3spnew/training\">Training </a></li>\r\n					</ul>\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<br />\r\n					<div class=\"getin-tuch\">\r\n						<h4>\r\n							Get Touch With Us</h4>\r\n						<p>\r\n							You can also send us an <a href=\"contact.php\">email</a> and we&rsquo;ll get in touch shortly.</p>\r\n						<div class=\"link\">\r\n							<a class=\"default_link\" href=\"contact.php\">LOCATE US</a></div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-9 col-sm-12 col-xs-12\">\r\n				<div class=\"text\">\r\n					<p>\r\n						Across the country, organisations big and small are struggling to deal with increased government regulations and volatile market demand. When things are uncertain, you may not want to hire permanent employees on a full-time basis. You want the flexibility of an agile, on-demand workforce who is equipped to run your business operations just the way you want them to.</p>\r\n					<br />\r\n					<p>\r\n						3SP Resources provides reliable temporary staffing solutions that offer you the ability to build your staff strength without absorbing them full time, assist overloaded employees during critical times, and keep projects moving. We are one of the leading employee leasing services in India, offering a full service, cost-effective, and efficient Human Resource Management services to organisations that may not have the necessary infrastructure or inclination to perform these labour-intensive tasks. When you hire us as your temporary staffing agency, we would work just like your company&#39;s own HR Department, minus the hassles and tediousness that you&rsquo;d otherwise have to deal with.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					Highlights of our temporary staffing services</h4>\r\n				<div class=\"analysis-result\">\r\n					<ul class=\"ul-list\">\r\n						<li>\r\n							Temporary employees who will stay on our rolls.</li>\r\n						<li>\r\n							Standard contractual procedures that we will handle.</li>\r\n						<li>\r\n							Payroll and personnel administration.</li>\r\n						<li>\r\n							Statutory compliance, remittance of statutory payments, and other related administration.</li>\r\n						<li>\r\n							Employee registration under ESIC &amp; EPF schemes</li>\r\n					</ul>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					WE RECRUIT FOR YOUR NEEDS</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						We have a proven, time-tested recruitment process which allows us to recruit just the right candidates for your company. We have professional networks all over the country which give us access to a huge base of candidates. We vigorously screen, shortlist, and evaluate potential candidates to give you the choicest picks.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					DECREASE YOUR COSTS</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						Our temporary staffing services will allow your company to staff up or down depending on the needs of your current business cycle. Temporary staffing allows you to bring down your costs on hiring, training, and providing benefits to new employees, along with the administrative costs of the human resources department. It also lets you give a respite to your permanent staff who may be overloaded during busy periods.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					REDUCE ADMINISTRATIVE BURDEN</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						There are umpteen laws that organisations have to comply with in India - minimum wages, gratuity, ESIC, PF etc. just to name a few. 3SP Resources takes over the burden of all administrative tasks by acting as the central point for all temporary staffing requirements including labour law compliance and other legal issues. We have a team of legal eagles and compliance officers to ensure that your business will be in 100% compliance with all the statutory regulations in the market.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					EMPLOYEE LEASING AND CONTRACT STAFFING</h4>\r\n				<div class=\"analysis-result\">\r\n					<p>\r\n						Our employee leasing service works by simply transferring employees from a company on to the payroll of 3SP Resources employee leasing services, and then releasing them back to the company on a temporary basis. This facilitates 3SP Resources to become the legal employer, thus taking over all your HR administrative and management hassles.<br />\r\n						<br />\r\n						When you outsource your HR administration to us, it will give you more time to focus on your core business, while saving you money, time, and resources. We have a huge, multidisciplinary selection of temporary staff including attorneys, qualified accountants, insurance experts, and other professionals. No matter what kind of personnel you&#39;re looking for, or for what duration, we can find the right people for you.<br />\r\n						<br />\r\n						Contract labour has been in existence for a long time, but now it is becoming more prominent even in white-collar jobs. Contract staffing is advantageous for both businesses and employees. Organisations have the flexibility of finding people for short projects, while talented employees also get to chart out a clear career path by progressively handling more challenging and higher positions in different companies.</p>\r\n				</div>\r\n				<br />\r\n				<br />\r\n				<h4 class=\"training-skills\">\r\n					Approach us when you need people for a short duration, a specific project, or to tide over your seasonal staffing requirements.</h4>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</section>', 'page/content/', 'temp-staffing', '2021-10-10 11:06:50', 1, '0000-00-00 00:00:00', 0, 1, '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `comm_photo_gallery`
--

CREATE TABLE `comm_photo_gallery` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `order_preference` int(11) NOT NULL DEFAULT '1',
  `order_modified_date` datetime NOT NULL,
  `is_delete` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_photo_gallery`
--

INSERT INTO `comm_photo_gallery` (`id`, `cat_id`, `title_hi`, `title_en`, `attachment`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`, `order_preference`, `order_modified_date`, `is_delete`) VALUES
(1, 1, 'Wall Painting 1', 'Wall Painting 1', '12-600x600.jpg', '2021-10-09 05:49:49', 1, '0000-00-00 00:00:00', 0, 1, 1, '0000-00-00 00:00:00', 0),
(2, 1, 'Wall Painting 2', 'Wall Painting 2', '1-600x6001.jpg', '2021-10-09 05:50:14', 1, '0000-00-00 00:00:00', 0, 1, 2, '0000-00-00 00:00:00', 0),
(3, 1, 'Wall Painting 3', 'Wall Painting 3', '6-600x6001.jpg', '2021-10-09 05:50:32', 1, '0000-00-00 00:00:00', 0, 1, 3, '0000-00-00 00:00:00', 0),
(4, 1, 'Wall Painting 4', 'Wall Painting 4', '11-600x600.jpg', '2021-10-09 05:50:55', 1, '0000-00-00 00:00:00', 0, 1, 4, '0000-00-00 00:00:00', 0),
(5, 2, 'Sketch 1', 'Sketch 1', '4-600x600.jpg', '2021-10-09 05:51:24', 1, '0000-00-00 00:00:00', 0, 1, 5, '0000-00-00 00:00:00', 0),
(6, 2, 'Sketch 2', 'Sketch 2', '14-600x6001.jpg', '2021-10-09 05:51:46', 1, '0000-00-00 00:00:00', 0, 1, 6, '0000-00-00 00:00:00', 0),
(7, 2, 'Sketch 3', 'Sketch 3', '18-600x600.jpg', '2021-10-09 05:55:12', 1, '0000-00-00 00:00:00', 0, 1, 7, '0000-00-00 00:00:00', 0),
(8, 2, 'Sketch 4', 'Sketch 4', '20-600x600.jpg', '2021-10-09 05:55:44', 1, '0000-00-00 00:00:00', 0, 1, 8, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_photo_gallery_category`
--

CREATE TABLE `comm_photo_gallery_category` (
  `cat_id` int(11) NOT NULL,
  `cat_title_hi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cat_title_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `cat_status` tinyint(2) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_photo_gallery_category`
--

INSERT INTO `comm_photo_gallery_category` (`cat_id`, `cat_title_hi`, `cat_title_en`, `added_date`, `added_by`, `edit_date`, `edit_by`, `cat_status`, `is_delete`) VALUES
(1, 'भित्ति चित्रण', 'Wall Painting', '2021-10-09 05:47:50', 1, NULL, 0, 1, 0),
(2, 'स्केच', 'Sketch', '2021-10-09 05:48:16', 1, NULL, 0, 1, 0),
(3, 'दृश्य कला', 'Visual Arts', '2021-10-09 05:49:04', 1, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_settings`
--

CREATE TABLE `comm_settings` (
  `id` int(11) NOT NULL,
  `last_updated_on` date NOT NULL,
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL,
  `website_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tag_line_hi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fav_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tag_line_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_details` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_settings`
--

INSERT INTO `comm_settings` (`id`, `last_updated_on`, `edit_date`, `edit_by`, `website_name`, `tag_line_hi`, `logo`, `fav_icon`, `tag_line_en`, `account_details`) VALUES
(1, '2017-06-16', '2021-09-15 12:54:10', 1, 'EPCO', 'पर्यावरण नियोजन एवं समन्वय संगठन', 'epco-logo.png', 'a3BHUnpXUHY1YmlFbW9xOHAvSm9WQT09', 'The Environmental Planning & Coordination Organisation', '<p>\r\n	One time Registration fees for&nbsp;Consultancy firms - 10,000/-&nbsp;&nbsp;Individual Consultants- 5000/-</p>\r\n<p>\r\n	You can make Payemnt by RTGS or NEFT on following Account Details:</p>\r\n<p>\r\n	Account Name : Executive Director EPCO BHOPAL</p>\r\n<p>\r\n	Acount Number : 3229010100005551</p>\r\n<div>\r\n	Bank Name : PUNJAB&nbsp; NATIONAL BANK&nbsp;</div>\r\n<div>\r\n	Branch : EPCO PARYAVARAN PARISAR ARERACOLONY , BHOPAL<span style=\"white-space: pre;\"> </span></div>\r\n<div>\r\n	Bank code : 024</div>\r\n<div>\r\n	IFSC CODE : punb0631000</div>');

-- --------------------------------------------------------

--
-- Table structure for table `comm_sliders`
--

CREATE TABLE `comm_sliders` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL COMMENT '1=Top, 2=Bottom',
  `title_hi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `order_preference` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_sliders`
--

INSERT INTO `comm_sliders` (`id`, `cat_id`, `title_hi`, `title_en`, `attachment`, `desc_url`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`, `is_delete`, `order_preference`) VALUES
(1, 1, 'Slider 1', 'Slider 1', 'slidershow4-3-1170x5661.jpg', '', '2021-10-09 04:51:51', 1, '0000-00-00 00:00:00', 0, 1, 0, 1),
(2, 1, 'Slider 2', 'Slider 2', 'slidershow4-1-1170x5661.jpg', '', '2021-10-09 04:52:37', 1, '0000-00-00 00:00:00', 0, 1, 0, 1),
(3, 1, 'Slider 3', 'Slider 3', 'slidershow4-2-1170x5661.jpg', '', '2021-10-09 04:53:01', 1, '0000-00-00 00:00:00', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comm_slider_category`
--

CREATE TABLE `comm_slider_category` (
  `cat_id` int(11) NOT NULL,
  `cat_title_en` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comm_social`
--

CREATE TABLE `comm_social` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `location` varchar(200) CHARACTER SET latin1 NOT NULL,
  `link` varchar(350) CHARACTER SET latin1 DEFAULT NULL,
  `li_class` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comm_social`
--

INSERT INTO `comm_social` (`id`, `name`, `location`, `link`, `li_class`) VALUES
(1, 'Facebook', 'fa fa-facebook', 'https://www.facebook.com/', 'btn-facebook'),
(2, 'Twitter', 'fa fa-twitter', 'https://twitter.com/', 'btn-twitter'),
(3, 'Google Plus', 'icon-google', '', NULL),
(4, 'Youtube', 'fa fa-youtube', 'https://www.youtube.com/', 'btn-youtube'),
(5, 'Linkedin', 'ld fa fa-linkedin', '', NULL),
(6, 'Dribbble', 'dr fa-dribbble', '', NULL),
(7, 'Vimeo Square', 'fa fa-vimeo', '', NULL),
(8, 'RSS', 'fa fa-rss', '', NULL),
(9, 'Pinterrest', 'fa fa-pinterest', '', NULL),
(10, 'Android', 'fa fa-android', '', NULL),
(11, 'Flickr', 'fa fa-flickr', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comm_video_gallery`
--

CREATE TABLE `comm_video_gallery` (
  `id` int(11) NOT NULL,
  `title_hi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime NOT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0',
  `is_default` tinyint(2) NOT NULL DEFAULT '0',
  `order_preference` int(11) NOT NULL DEFAULT '1',
  `order_modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comm_video_gallery`
--

INSERT INTO `comm_video_gallery` (`id`, `title_hi`, `title_en`, `url`, `cat_id`, `added_date`, `added_by`, `edit_date`, `edit_by`, `status`, `is_delete`, `is_default`, `order_preference`, `order_modified_date`) VALUES
(1, 'test 1', 'test 2', 'https://www.youtube.com/watch?v=OqxpKNeJzls', 1, '2018-05-05 06:05:01', 1, '0000-00-00 00:00:00', 0, 1, 0, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comm_video_gallery_category`
--

CREATE TABLE `comm_video_gallery_category` (
  `cat_id` int(11) NOT NULL,
  `cat_title_hi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_title_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0',
  `edit_date` datetime DEFAULT NULL,
  `edit_by` int(11) NOT NULL DEFAULT '0',
  `cat_status` tinyint(2) NOT NULL DEFAULT '0',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comm_video_gallery_category`
--

INSERT INTO `comm_video_gallery_category` (`cat_id`, `cat_title_hi`, `cat_title_en`, `added_date`, `added_by`, `edit_date`, `edit_by`, `cat_status`, `is_delete`) VALUES
(1, 'सामान्य', 'General', '2017-07-07 01:35:15', 1, NULL, 0, 1, 0),
(2, 'आधिकारिक', 'Official', '2017-07-07 01:35:55', 1, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comm_web_visitor`
--

CREATE TABLE `comm_web_visitor` (
  `v_id` int(11) NOT NULL,
  `v_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1=website visitor, 2=page visitor',
  `v_menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `v_ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `v_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comm_web_visitor`
--

INSERT INTO `comm_web_visitor` (`v_id`, `v_type`, `v_menu_name`, `v_ip_address`, `v_created_date`) VALUES
(0, 2, 'about-us', '::1', '2021-03-23 02:39:56'),
(1, 2, 'sitemap', '::1', '2018-11-14 04:58:07'),
(2, 2, 'circular', '::1', '2018-11-14 05:10:07'),
(3, 2, 'contact-us', '::1', '2018-11-14 05:13:06'),
(4, 2, 'contact', '::1', '2018-11-14 05:17:03'),
(5, 1, 'home', '::1', '2018-11-14 05:41:22'),
(6, 2, 'search', '::1', '2018-11-14 05:47:52'),
(7, 2, 'search-details', '::1', '2018-11-14 05:51:02'),
(8, 1, 'home', '::1', '2018-11-15 11:19:20'),
(9, 2, 'photo-gallery', '::1', '2018-11-15 11:19:28'),
(10, 2, 'photo-gallery-view', '::1', '2018-11-15 11:26:57'),
(11, 2, 'news-details', '::1', '2018-11-15 11:35:29'),
(12, 2, 'about-us', '::1', '2018-11-15 11:35:41'),
(13, 2, 'contact-us', '::1', '2018-11-15 11:43:34'),
(14, 2, 'sitemap', '::1', '2018-11-15 11:47:38'),
(15, 2, 'search', '::1', '2018-11-15 11:47:51'),
(16, 2, 'circular', '::1', '2018-11-15 12:53:46'),
(17, 2, 'ImportantLinks', '::1', '2018-11-15 01:03:49'),
(18, 2, 'rti', '::1', '2018-11-15 02:23:45'),
(19, 2, 'screen-reader', '::1', '2018-11-15 02:36:21'),
(20, 2, 'feedback', '::1', '2018-11-15 02:41:04'),
(21, 2, 'NoticeBoard', '::1', '2018-11-15 03:04:38'),
(22, 2, 'notice-board', '::1', '2018-11-15 03:14:37'),
(23, 2, 'Whoswho', '::1', '2018-11-15 04:03:17'),
(24, 2, 'copyright-policy', '::1', '2018-11-15 04:44:56'),
(25, 2, 'whos-who', '::1', '2018-11-15 04:56:09'),
(26, 2, 'disclaimer', '::1', '2018-11-15 04:58:17'),
(27, 2, 'terms-of-use', '::1', '2018-11-15 04:58:27'),
(28, 1, 'home', '::1', '2018-11-16 10:36:49'),
(29, 2, 'rti', '::1', '2018-11-16 10:38:25'),
(30, 2, 'about-us', '::1', '2018-11-16 10:47:05'),
(31, 2, 'search', '::1', '2018-11-16 10:55:37'),
(32, 2, 'copyright-policy', '::1', '2018-11-16 10:56:58'),
(33, 2, 'RulesActs', '::1', '2018-11-16 11:01:47'),
(34, 2, 'acts', '::1', '2018-11-16 12:02:44'),
(35, 2, 'whos-who', '::1', '2018-11-16 12:04:27'),
(36, 2, 'news-details', '::1', '2018-11-16 12:09:00'),
(37, 2, 'search-details', '::1', '2018-11-16 12:11:31'),
(38, 2, 'photo-gallery', '::1', '2018-11-16 12:17:12'),
(39, 2, 'photo-gallery-view', '::1', '2018-11-16 12:17:16'),
(40, 2, 'important-links', '::1', '2018-11-16 12:23:01'),
(41, 2, 'important-websites', '::1', '2018-11-16 12:23:33'),
(42, 2, 'contact-us', '::1', '2018-11-16 01:11:39'),
(43, 2, 'feedback', '::1', '2018-11-16 01:21:25'),
(44, 2, 'screen-reader', '::1', '2018-11-16 04:13:44'),
(45, 1, 'home', '::1', '2018-11-19 10:40:00'),
(46, 2, 'search', '::1', '2018-11-19 10:40:18'),
(47, 2, 'whos-who', '::1', '2018-11-19 10:40:30'),
(48, 2, 'acts', '::1', '2018-11-19 10:40:34'),
(49, 2, 'photo-gallery', '::1', '2018-11-19 10:40:36'),
(50, 2, 'contact-us', '::1', '2018-11-19 10:40:39'),
(51, 2, 'about-us', '::1', '2018-11-19 10:40:42'),
(52, 2, 'photo-gallery-view', '::1', '2018-11-19 11:32:06'),
(53, 2, 'download', '::1', '2018-11-19 12:05:07'),
(54, 2, 'rti', '::1', '2018-11-19 12:15:03'),
(55, 2, 'news-details', '::1', '2018-11-19 12:25:15'),
(56, 2, 'notice-board', '::1', '2018-11-19 12:53:15'),
(57, 2, 'important-links', '::1', '2018-11-19 01:00:18'),
(58, 2, 'screen-reader', '::1', '2018-11-19 03:31:57'),
(59, 2, 'sitemap', '::1', '2018-11-19 03:47:35'),
(60, 2, 'about-us', '::1', '2018-11-20 02:35:41'),
(61, 2, 'acts', '::1', '2018-11-20 02:35:47'),
(62, 2, 'rti', '::1', '2018-11-20 02:35:50'),
(63, 2, 'download', '::1', '2018-11-20 02:35:53'),
(64, 2, 'whos-who', '::1', '2018-11-20 02:35:57'),
(65, 2, 'photo-gallery', '::1', '2018-11-20 02:36:02'),
(66, 2, 'photo-gallery-view', '::1', '2018-11-20 02:36:07'),
(67, 1, 'home', '::1', '2018-11-20 02:49:31'),
(68, 2, 'news-details', '::1', '2018-11-20 03:19:51'),
(69, 2, 'contact-us', '::1', '2018-11-20 04:04:43'),
(70, 2, 'search', '::1', '2018-11-20 04:04:50'),
(71, 1, 'home', '::1', '2018-11-22 10:45:50'),
(72, 2, 'news-details', '::1', '2018-11-22 10:45:55'),
(73, 2, 'rti', '::1', '2018-11-22 10:46:09'),
(74, 2, 'download', '::1', '2018-11-22 10:46:16'),
(75, 2, 'acts', '::1', '2018-11-22 10:46:21'),
(76, 2, 'whos-who', '::1', '2018-11-22 10:46:28'),
(77, 1, 'home', '164.100.146.66', '2018-11-22 04:01:15'),
(78, 2, 'feedback', '164.100.146.66', '2018-11-22 04:20:17'),
(79, 2, 'copyright-policy', '164.100.146.66', '2018-11-22 05:26:05'),
(80, 2, 'hyperlink-policy', '164.100.146.66', '2018-11-22 05:26:08'),
(81, 2, 'rti', '164.100.146.66', '2018-11-22 05:26:12'),
(82, 2, 'feedback', '164.100.146.66', '2018-11-24 10:31:13'),
(83, 1, 'home', '164.100.146.66', '2018-11-24 12:09:01'),
(84, 1, 'home', '47.247.131.152', '2018-11-24 02:40:46'),
(85, 2, 'acts', '47.247.131.152', '2018-11-24 02:42:27'),
(86, 2, 'rti', '47.247.131.152', '2018-11-24 02:42:30'),
(87, 2, 'download', '47.247.131.152', '2018-11-24 02:42:37'),
(88, 2, 'whos-who', '47.247.131.152', '2018-11-24 02:42:42'),
(89, 2, 'photo-gallery', '47.247.131.152', '2018-11-24 02:42:46'),
(90, 2, 'contact-us', '47.247.131.152', '2018-11-24 02:42:51'),
(91, 2, 'photo-gallery-view', '47.247.131.152', '2018-11-24 04:36:37'),
(92, 2, 'photo-gallery', '164.100.146.66', '2018-11-24 05:24:32'),
(93, 2, 'photo-gallery-view', '164.100.146.66', '2018-11-24 05:24:35'),
(94, 1, 'home', '164.100.146.66', '2018-11-26 10:46:22'),
(95, 2, 'photo-gallery', '164.100.146.66', '2018-11-26 11:32:45'),
(96, 2, 'photo-gallery-view', '164.100.146.66', '2018-11-26 11:34:32'),
(97, 2, 'screen-reader', '164.100.146.66', '2018-11-26 12:10:26'),
(98, 2, 'contact-us', '164.100.146.66', '2018-11-26 12:16:24'),
(99, 2, 'search', '164.100.146.66', '2018-11-26 12:38:48'),
(100, 2, 'search-details', '164.100.146.66', '2018-11-26 12:38:53'),
(101, 2, 'whos-who', '164.100.146.66', '2018-11-26 12:42:46'),
(102, 2, 'download', '164.100.146.66', '2018-11-26 12:43:00'),
(103, 2, 'about-us', '164.100.146.66', '2018-11-26 12:46:03'),
(104, 2, 'feedback', '164.100.146.66', '2018-11-26 03:10:46'),
(105, 1, 'home', '164.100.146.66', '2018-11-27 11:28:40'),
(106, 2, 'photo-gallery', '164.100.146.66', '2018-11-27 11:28:55'),
(107, 2, 'photo-gallery-view', '164.100.146.66', '2018-11-27 11:29:05'),
(108, 2, 'feedback', '164.100.146.66', '2018-11-27 04:32:23'),
(109, 1, 'home', '164.100.146.66', '2018-11-29 10:55:09'),
(110, 2, 'disclaimer', '164.100.146.66', '2018-11-29 10:55:31'),
(111, 2, 'photo-gallery', '164.100.146.66', '2018-11-29 10:55:38'),
(112, 2, 'privacy-policy', '164.100.146.66', '2018-11-29 11:04:51'),
(113, 2, 'whos-who', '164.100.146.66', '2018-11-29 11:05:08'),
(114, 2, 'download', '164.100.146.66', '2018-11-29 11:05:23'),
(115, 2, 'rti', '164.100.146.66', '2018-11-29 11:05:26'),
(116, 2, 'contact-us', '164.100.146.66', '2018-11-29 11:09:22'),
(117, 2, 'circular', '164.100.146.66', '2018-11-29 11:09:25'),
(118, 2, 'EmergencyContact', '164.100.146.66', '2018-11-29 11:09:45'),
(119, 2, 'photo-gallery-view', '164.100.146.66', '2018-11-29 11:53:52'),
(120, 2, 'about-us', '164.100.146.66', '2018-11-29 04:28:56'),
(121, 2, 'rulesacts', '164.100.146.66', '2018-11-29 04:55:14'),
(122, 2, 'hyperlink-policy', '164.100.146.66', '2018-11-29 04:56:21'),
(123, 2, 'terms-of-use', '164.100.146.66', '2018-11-29 04:56:23'),
(124, 2, 'feedback', '164.100.146.66', '2018-11-29 04:56:26'),
(125, 2, 'sitemap', '164.100.146.66', '2018-11-29 04:56:32'),
(126, 2, 'search', '164.100.146.66', '2018-11-29 04:57:09'),
(127, 2, 'screen-reader', '164.100.146.66', '2018-11-29 04:58:26'),
(128, 1, 'home', '47.247.237.182', '2018-11-29 05:51:08'),
(129, 1, 'home', '164.100.146.66', '2018-11-30 11:09:36'),
(130, 1, 'home', '27.62.226.47', '2018-12-03 12:47:14'),
(131, 2, 'rti', '27.62.226.47', '2018-12-03 12:47:54'),
(132, 2, 'screen-reader', '27.62.226.47', '2018-12-03 12:48:08'),
(133, 2, 'whos-who', '27.62.226.47', '2018-12-03 12:48:54'),
(134, 2, 'rulesacts', '27.62.226.47', '2018-12-03 12:49:44'),
(135, 2, 'photo-gallery', '27.62.226.47', '2018-12-03 12:49:58'),
(136, 2, 'photo-gallery-view', '27.62.226.47', '2018-12-03 12:50:43'),
(137, 2, 'contact-us', '27.62.226.47', '2018-12-03 12:51:55'),
(138, 2, 'about-us', '27.62.226.47', '2018-12-03 12:52:08'),
(139, 2, 'download', '27.62.226.47', '2018-12-03 12:57:11'),
(140, 2, 'disclaimer', '27.62.226.47', '2018-12-03 12:58:01'),
(141, 2, 'sitemap', '27.62.226.47', '2018-12-03 12:58:07'),
(142, 2, 'hyperlink-policy', '27.62.226.47', '2018-12-03 12:58:30'),
(143, 2, 'terms-of-use', '27.62.226.47', '2018-12-03 12:58:33'),
(144, 2, 'copyright-policy', '27.62.226.47', '2018-12-03 12:58:36'),
(145, 2, 'privacy-policy', '27.62.226.47', '2018-12-03 12:58:40'),
(146, 2, 'feedback', '27.62.226.47', '2018-12-03 12:58:43'),
(147, 1, 'home', '27.62.247.166', '2018-12-04 07:49:20'),
(148, 1, 'home', '164.100.146.66', '2018-12-04 01:56:25'),
(149, 2, 'about-us', '164.100.146.66', '2018-12-04 01:56:40'),
(150, 2, 'rti', '164.100.146.66', '2018-12-04 01:56:45'),
(151, 2, 'rulesacts', '164.100.146.66', '2018-12-04 01:56:48'),
(152, 2, 'download', '164.100.146.66', '2018-12-04 01:56:51'),
(153, 2, 'whos-who', '164.100.146.66', '2018-12-04 01:56:56'),
(154, 2, 'photo-gallery', '164.100.146.66', '2018-12-04 01:57:06'),
(155, 2, 'photo-gallery-view', '164.100.146.66', '2018-12-04 01:57:20'),
(156, 2, 'screen-reader', '164.100.146.66', '2018-12-04 01:57:44'),
(157, 2, 'hyperlink-policy', '164.100.146.66', '2018-12-04 01:57:49'),
(158, 2, 'copyright-policy', '164.100.146.66', '2018-12-04 01:57:51'),
(159, 2, 'sitemap', '164.100.146.66', '2018-12-04 01:57:55'),
(160, 1, 'home', '27.57.234.182', '2018-12-04 06:22:30'),
(161, 1, 'home', '27.62.165.59', '2018-12-06 10:18:45'),
(162, 2, 'important-links', '27.62.165.59', '2018-12-06 10:19:34'),
(163, 2, 'rti', '27.62.165.59', '2018-12-06 10:19:57'),
(164, 2, 'whos-who', '27.62.165.59', '2018-12-06 10:20:12'),
(165, 2, 'photo-gallery', '27.62.165.59', '2018-12-06 10:20:35'),
(166, 2, 'photo-gallery-view', '27.62.165.59', '2018-12-06 10:20:53'),
(167, 2, 'rulesacts', '27.62.165.59', '2018-12-06 10:21:02'),
(168, 2, 'contact-us', '27.62.165.59', '2018-12-06 10:21:07'),
(169, 2, 'download', '27.62.165.59', '2018-12-06 10:21:26'),
(170, 2, 'screen-reader', '27.62.165.59', '2018-12-06 10:23:23'),
(171, 1, 'home', '164.100.146.66', '2018-12-11 01:37:45'),
(172, 2, 'contact-us', '164.100.146.66', '2018-12-11 01:37:52'),
(173, 2, 'download', '164.100.146.66', '2018-12-11 01:37:56'),
(174, 2, 'about-us', '164.100.146.66', '2018-12-11 01:38:00'),
(175, 2, 'rti', '164.100.146.66', '2018-12-11 01:38:09'),
(176, 2, 'photo-gallery', '164.100.146.66', '2018-12-11 01:38:14'),
(177, 2, 'photo-gallery-view', '164.100.146.66', '2018-12-11 01:38:26'),
(178, 2, 'rulesacts', '164.100.146.66', '2018-12-11 01:38:44'),
(179, 1, 'home', '164.100.146.66', '2018-12-12 06:25:02'),
(180, 2, 'rulesacts', '164.100.146.66', '2018-12-12 06:25:06'),
(181, 2, 'rti', '164.100.146.66', '2018-12-12 06:25:09'),
(182, 2, 'whos-who', '164.100.146.66', '2018-12-12 06:25:11'),
(183, 1, 'home', '164.100.146.66', '2018-12-13 11:42:03'),
(184, 1, 'home', '164.100.146.66', '2018-12-14 02:10:47'),
(185, 2, 'about-us', '164.100.146.66', '2018-12-14 02:11:11'),
(186, 2, 'rti', '164.100.146.66', '2018-12-14 02:11:17'),
(187, 2, 'rulesacts', '164.100.146.66', '2018-12-14 02:11:22'),
(188, 2, 'download', '164.100.146.66', '2018-12-14 02:11:24'),
(189, 2, 'whos-who', '164.100.146.66', '2018-12-14 02:11:27'),
(190, 2, 'photo-gallery', '164.100.146.66', '2018-12-14 02:11:40'),
(191, 2, 'photo-gallery-view', '164.100.146.66', '2018-12-14 02:11:45'),
(192, 2, 'contact-us', '164.100.146.66', '2018-12-14 02:11:49'),
(193, 2, 'sitemap', '164.100.146.66', '2018-12-14 02:11:58'),
(194, 2, 'disclaimer', '164.100.146.66', '2018-12-14 02:12:06'),
(195, 2, 'copyright-policy', '164.100.146.66', '2018-12-14 02:12:16'),
(196, 2, 'hyperlink-policy', '164.100.146.66', '2018-12-14 02:12:18'),
(197, 2, 'screen-reader', '164.100.146.66', '2018-12-14 02:12:27'),
(198, 2, 'news-details', '164.100.146.66', '2018-12-14 02:13:41'),
(199, 1, 'home', '164.100.146.66', '2018-12-19 02:55:59'),
(200, 2, 'rulesacts', '164.100.146.66', '2018-12-19 02:56:02'),
(201, 2, 'whos-who', '164.100.146.66', '2018-12-19 04:03:06'),
(202, 2, 'photo-gallery', '164.100.146.66', '2018-12-19 04:03:08'),
(203, 2, 'contact-us', '164.100.146.66', '2018-12-19 04:03:12'),
(204, 2, 'rti', '164.100.146.66', '2018-12-19 04:03:17'),
(205, 2, 'about-us', '164.100.146.66', '2018-12-19 04:03:19'),
(206, 2, 'download', '164.100.146.66', '2018-12-19 04:03:31'),
(207, 1, 'home', '164.100.146.66', '2018-12-27 11:07:09'),
(208, 2, 'photo-gallery', '164.100.146.66', '2018-12-27 11:07:47'),
(209, 2, 'photo-gallery-view', '164.100.146.66', '2018-12-27 11:08:48'),
(210, 1, 'home', '27.57.249.249', '2019-01-01 07:20:30'),
(211, 2, 'notice-board', '27.57.249.249', '2019-01-01 07:21:54'),
(212, 2, 'disclaimer', '27.57.249.249', '2019-01-01 07:22:20'),
(213, 2, 'about-us', '27.57.249.249', '2019-01-01 07:22:40'),
(214, 2, 'rulesacts', '27.57.249.249', '2019-01-01 07:22:47'),
(215, 2, 'photo-gallery', '27.57.249.249', '2019-01-01 07:22:55'),
(216, 2, 'photo-gallery-view', '27.57.249.249', '2019-01-01 07:23:04'),
(217, 2, 'sitemap', '27.57.249.249', '2019-01-01 07:23:31'),
(218, 2, 'whos-who', '27.57.249.249', '2019-01-01 07:23:47'),
(219, 2, 'screen-reader', '27.57.249.249', '2019-01-01 07:24:26'),
(220, 1, 'home', '164.100.146.66', '2019-01-03 12:19:38'),
(221, 1, 'home', '164.100.146.66', '2019-01-05 11:06:38'),
(222, 2, 'rti', '164.100.146.66', '2019-01-05 06:47:02'),
(223, 2, 'rulesacts', '164.100.146.66', '2019-01-05 06:47:07'),
(224, 2, 'download', '164.100.146.66', '2019-01-05 06:47:10'),
(225, 2, 'whos-who', '164.100.146.66', '2019-01-05 06:47:15'),
(226, 2, 'photo-gallery', '164.100.146.66', '2019-01-05 06:47:19'),
(227, 2, 'contact-us', '164.100.146.66', '2019-01-05 06:47:27'),
(228, 2, 'about-us', '164.100.146.66', '2019-01-05 06:47:36'),
(229, 1, 'home', '164.100.146.66', '2019-01-07 10:51:35'),
(230, 1, 'home', '164.100.146.66', '2019-01-09 03:52:43'),
(231, 1, 'home', '182.70.146.210', '2019-01-09 04:35:53'),
(232, 2, 'photo-gallery', '182.70.146.210', '2019-01-09 04:39:40'),
(233, 1, 'home', '171.60.141.246', '2019-01-10 10:36:25'),
(234, 1, 'home', '164.100.146.66', '2019-01-16 01:09:09'),
(235, 2, 'rti', '164.100.146.66', '2019-01-16 02:27:07'),
(236, 2, 'rulesacts', '164.100.146.66', '2019-01-16 02:27:21'),
(237, 2, 'download', '164.100.146.66', '2019-01-16 02:27:23'),
(238, 2, 'whos-who', '164.100.146.66', '2019-01-16 02:27:25'),
(239, 2, 'photo-gallery', '164.100.146.66', '2019-01-16 02:27:27'),
(240, 2, 'contact-us', '164.100.146.66', '2019-01-16 02:27:29'),
(241, 1, 'home', '164.100.146.66', '2019-01-24 04:58:14'),
(242, 1, 'home', '164.100.146.66', '2019-01-28 03:42:22'),
(243, 2, 'contact-us', '164.100.146.66', '2019-01-28 03:42:37'),
(244, 2, 'photo-gallery', '164.100.146.66', '2019-01-28 03:42:42'),
(245, 2, 'whos-who', '164.100.146.66', '2019-01-28 03:43:14'),
(246, 2, 'download', '164.100.146.66', '2019-01-28 03:43:24'),
(247, 2, 'rulesacts', '164.100.146.66', '2019-01-28 03:43:59'),
(248, 2, 'rti', '164.100.146.66', '2019-01-28 03:44:02'),
(249, 2, 'privacy-policy', '164.100.146.66', '2019-01-28 03:44:07'),
(250, 2, 'sitemap', '164.100.146.66', '2019-01-28 03:44:11'),
(251, 1, 'home', '164.100.146.66', '2019-02-01 11:19:31'),
(252, 2, 'photo-gallery', '164.100.146.66', '2019-02-01 11:19:34'),
(253, 1, 'home', '122.168.27.254', '2019-02-08 11:15:27'),
(254, 2, 'whos-who', '122.168.27.254', '2019-02-08 11:15:46'),
(255, 2, 'photo-gallery', '122.168.27.254', '2019-02-08 11:15:54'),
(256, 2, 'download', '122.168.27.254', '2019-02-08 11:15:57'),
(257, 2, 'about-us', '122.168.27.254', '2019-02-08 11:16:09'),
(258, 2, 'rulesacts', '122.168.27.254', '2019-02-08 11:16:16'),
(259, 2, 'privacy-policy', '122.168.27.254', '2019-02-08 11:16:22'),
(260, 2, 'disclaimer', '122.168.27.254', '2019-02-08 11:16:26'),
(261, 2, 'copyright-policy', '122.168.27.254', '2019-02-08 11:16:29'),
(262, 2, 'hyperlink-policy', '122.168.27.254', '2019-02-08 11:16:32'),
(263, 2, 'terms-of-use', '122.168.27.254', '2019-02-08 11:16:35'),
(264, 1, 'home', '164.100.146.66', '2019-02-08 03:35:40'),
(265, 2, 'about-us', '164.100.146.66', '2019-02-08 03:40:27'),
(266, 2, 'pds', '164.100.146.66', '2019-02-08 03:46:54'),
(267, 2, 'whos-who', '164.100.146.66', '2019-02-08 03:58:10'),
(268, 2, 'photo-gallery', '164.100.146.66', '2019-02-08 03:58:50'),
(269, 2, 'download', '164.100.146.66', '2019-02-08 03:58:54'),
(270, 2, 'rti', '164.100.146.66', '2019-02-08 03:59:27'),
(271, 2, 'contact-us', '164.100.146.66', '2019-02-08 03:59:39'),
(272, 2, 'photo-gallery-view', '164.100.146.66', '2019-02-08 04:00:24'),
(273, 2, 'important-links', '164.100.146.66', '2019-02-08 04:08:35'),
(274, 1, 'home', '182.70.192.201', '2019-02-11 05:48:00'),
(275, 1, 'home', '164.100.146.66', '2019-02-12 12:38:19'),
(276, 2, 'rulesacts', '164.100.146.66', '2019-02-12 12:38:21'),
(277, 2, 'download', '164.100.146.66', '2019-02-12 12:38:24'),
(278, 2, 'whos-who', '164.100.146.66', '2019-02-12 12:38:26'),
(279, 2, 'photo-gallery', '164.100.146.66', '2019-02-12 12:38:27'),
(280, 2, 'contact-us', '164.100.146.66', '2019-02-12 12:38:29'),
(281, 2, 'rti', '164.100.146.66', '2019-02-12 12:38:32'),
(282, 1, 'home', '47.247.242.44', '2019-02-12 09:22:38'),
(283, 2, 'search', '47.247.242.44', '2019-02-12 09:23:13'),
(284, 2, 'pds', '47.247.242.44', '2019-02-12 09:41:07'),
(285, 1, 'home', '182.70.144.189', '2019-02-13 12:55:52'),
(286, 2, 'pr', '182.70.144.189', '2019-02-13 01:07:30'),
(287, 2, 'pds', '182.70.144.189', '2019-02-13 01:15:41'),
(288, 2, 'about-us', '182.70.144.189', '2019-02-13 01:15:45'),
(289, 1, 'home', '47.247.249.161', '2019-02-13 09:42:48'),
(290, 2, 'pds', '47.247.249.161', '2019-02-13 09:49:54'),
(291, 2, 'pr', '47.247.249.161', '2019-02-13 09:50:42'),
(292, 1, 'home', '182.70.144.189', '2019-02-14 01:43:37'),
(293, 2, 'pds', '182.70.144.189', '2019-02-14 01:44:41'),
(294, 2, 'pr', '182.70.144.189', '2019-02-14 01:55:36'),
(295, 2, 'ml', '182.70.144.189', '2019-02-14 02:04:57'),
(296, 2, 'tp', '182.70.144.189', '2019-02-14 02:08:39'),
(297, 2, 'download', '182.70.144.189', '2019-02-14 02:12:26'),
(298, 2, 'fn', '182.70.144.189', '2019-02-14 02:12:55'),
(299, 2, 'contact-us', '182.70.144.189', '2019-02-14 03:08:28'),
(300, 2, 'whos-who', '182.70.144.189', '2019-02-14 03:08:40'),
(301, 2, 'photo-gallery', '182.70.144.189', '2019-02-14 03:08:44'),
(302, 2, 'rulesacts', '182.70.144.189', '2019-02-14 03:11:07'),
(303, 2, 'about-us', '182.70.144.189', '2019-02-14 03:12:46'),
(304, 2, 'rti', '182.70.144.189', '2019-02-14 03:29:17'),
(305, 1, 'home', '171.61.36.128', '2019-02-15 11:52:03'),
(306, 2, 'pds', '171.61.36.128', '2019-02-15 11:52:39'),
(307, 2, 'about-us', '171.61.36.128', '2019-02-15 11:52:47'),
(308, 2, 'pr', '171.61.36.128', '2019-02-15 11:53:25'),
(309, 2, 'ml', '171.61.36.128', '2019-02-15 11:53:29'),
(310, 2, 'fn', '171.61.36.128', '2019-02-15 11:53:33'),
(311, 2, 'screen-reader', '171.61.36.128', '2019-02-15 12:15:51'),
(312, 2, 'whos-who', '171.61.36.128', '2019-02-15 12:17:42'),
(313, 1, 'home', '122.168.212.180', '2019-02-15 04:58:49'),
(314, 1, 'home', '164.100.146.66', '2019-02-15 04:59:17'),
(315, 2, 'pr', '122.168.212.180', '2019-02-15 04:59:23'),
(316, 2, 'tp', '122.168.212.180', '2019-02-15 04:59:26'),
(317, 2, 'fn', '122.168.212.180', '2019-02-15 04:59:38'),
(318, 2, 'whos-who', '122.168.212.180', '2019-02-15 04:59:41'),
(319, 2, 'photo-gallery', '122.168.212.180', '2019-02-15 04:59:50'),
(320, 2, 'pds', '164.100.146.66', '2019-02-15 05:00:03'),
(321, 2, 'pr', '164.100.146.66', '2019-02-15 05:00:08'),
(322, 2, 'ml', '122.168.212.180', '2019-02-15 05:00:10'),
(323, 2, 'ml', '164.100.146.66', '2019-02-15 05:00:15'),
(324, 2, 'rti', '122.168.212.180', '2019-02-15 05:00:16'),
(325, 2, 'about-us', '164.100.146.66', '2019-02-15 05:00:20'),
(326, 2, 'contact-us', '122.168.212.180', '2019-02-15 05:00:20'),
(327, 2, 'about-us', '122.168.212.180', '2019-02-15 05:00:26'),
(328, 2, 'screen-reader', '122.168.212.180', '2019-02-15 05:01:12'),
(329, 2, 'download', '122.168.212.180', '2019-02-15 05:02:23'),
(330, 1, 'home', '122.168.48.209', '2019-02-21 11:22:19'),
(331, 1, 'home', '164.100.146.66', '2019-02-21 11:23:53'),
(332, 1, 'home', '171.61.53.216', '2019-02-21 12:06:22'),
(333, 2, 'contact-us', '171.61.53.216', '2019-02-21 12:12:33'),
(334, 2, 'photo-gallery', '171.61.53.216', '2019-02-21 12:12:47'),
(335, 2, 'fn', '171.61.53.216', '2019-02-21 12:12:50'),
(336, 2, 'ml', '171.61.53.216', '2019-02-21 12:12:53'),
(337, 2, 'tp', '171.61.53.216', '2019-02-21 12:12:56'),
(338, 2, 'pds', '171.61.53.216', '2019-02-21 12:12:59'),
(339, 2, 'about-us', '171.61.53.216', '2019-02-21 12:13:05'),
(340, 2, 'contact-us', '164.100.146.66', '2019-02-21 12:18:16'),
(341, 2, 'feedback', '164.100.146.66', '2019-02-21 12:18:20'),
(342, 1, 'home', '164.100.146.66', '2019-02-22 10:44:45'),
(343, 2, 'screen-reader', '164.100.146.66', '2019-02-22 10:47:08'),
(344, 2, 'ml', '164.100.146.66', '2019-02-22 10:47:13'),
(345, 2, 'tp', '164.100.146.66', '2019-02-22 10:47:14'),
(346, 2, 'about-us', '164.100.146.66', '2019-02-22 11:01:20'),
(347, 2, 'pds', '164.100.146.66', '2019-02-22 11:01:34'),
(348, 2, 'pr', '164.100.146.66', '2019-02-22 11:01:58'),
(349, 2, 'photo-gallery', '164.100.146.66', '2019-02-22 11:02:11'),
(350, 2, 'photo-gallery-view', '164.100.146.66', '2019-02-22 11:02:19'),
(351, 2, 'fn', '164.100.146.66', '2019-02-22 11:03:08'),
(352, 2, 'contact-us', '164.100.146.66', '2019-02-22 11:03:11'),
(353, 2, 'news-details', '164.100.146.66', '2019-02-22 11:27:25'),
(354, 2, 'notice-board', '164.100.146.66', '2019-02-22 11:46:21'),
(355, 2, 'search', '164.100.146.66', '2019-02-22 11:47:19'),
(356, 1, 'home', '59.88.157.36', '2019-02-22 04:32:34'),
(357, 1, 'home', '27.57.164.37', '2019-02-26 01:08:59'),
(358, 2, 'pr', '27.57.164.37', '2019-02-26 01:12:46'),
(359, 2, 'whos-who', '27.57.164.37', '2019-02-26 01:13:57'),
(360, 2, 'download', '27.57.164.37', '2019-02-26 01:15:42'),
(361, 1, 'home', '27.57.145.162', '2019-02-28 03:15:30'),
(362, 2, 'pds', '27.57.145.162', '2019-02-28 03:16:35'),
(363, 2, 'pr', '27.57.145.162', '2019-02-28 03:16:45'),
(364, 2, 'ml', '27.57.145.162', '2019-02-28 03:17:04'),
(365, 2, 'tp', '27.57.145.162', '2019-02-28 03:17:05'),
(366, 2, 'fn', '27.57.145.162', '2019-02-28 03:17:08'),
(367, 2, 'about-us', '27.57.145.162', '2019-02-28 03:17:36'),
(368, 2, 'whos-who', '27.57.145.162', '2019-02-28 03:31:23'),
(369, 2, 'photo-gallery', '27.57.145.162', '2019-02-28 03:31:36'),
(370, 2, 'contact-us', '27.57.145.162', '2019-02-28 03:31:57'),
(371, 1, 'home', '164.100.146.66', '2019-03-02 02:23:50'),
(372, 1, 'home', '164.100.146.66', '2019-03-06 02:57:14'),
(373, 2, 'pds', '164.100.146.66', '2019-03-06 02:57:40'),
(374, 2, 'pr', '164.100.146.66', '2019-03-06 02:57:41'),
(375, 1, 'home', '164.100.146.66', '2019-03-11 11:42:42'),
(376, 1, 'home', '164.100.146.66', '2019-03-28 01:08:53'),
(377, 2, 'about-us', '164.100.146.66', '2019-03-28 01:09:50'),
(378, 2, 'pds', '164.100.146.66', '2019-03-28 01:10:02'),
(379, 2, 'search', '164.100.146.66', '2019-03-28 01:10:04'),
(380, 2, 'search-details', '164.100.146.66', '2019-03-28 01:10:16'),
(381, 2, 'contact-us', '164.100.146.66', '2019-03-28 01:10:32'),
(382, 2, 'photo-gallery', '164.100.146.66', '2019-03-28 01:10:36'),
(383, 2, 'photo-gallery-view', '164.100.146.66', '2019-03-28 01:10:41'),
(384, 2, 'whos-who', '164.100.146.66', '2019-03-28 01:10:53'),
(385, 2, 'fn', '164.100.146.66', '2019-03-28 01:11:05'),
(386, 2, 'tp', '164.100.146.66', '2019-03-28 01:11:43'),
(387, 2, 'pr', '164.100.146.66', '2019-03-28 01:12:12'),
(388, 2, 'download', '164.100.146.66', '2019-03-28 01:12:22'),
(389, 2, 'rulesacts', '164.100.146.66', '2019-03-28 01:12:45'),
(390, 2, 'copyright-policy', '164.100.146.66', '2019-03-28 01:12:47'),
(391, 2, 'news-details', '164.100.146.66', '2019-03-28 01:13:19'),
(392, 2, 'notice-board', '164.100.146.66', '2019-03-28 01:14:26'),
(393, 1, 'home', '66.249.84.237', '2019-03-28 01:15:09'),
(394, 1, 'home', '66.249.84.234', '2019-03-28 01:15:09'),
(395, 1, 'home', '66.102.9.137', '2019-03-28 02:16:00'),
(396, 1, 'home', '66.102.6.234', '2019-03-28 02:16:07'),
(397, 1, 'home', '66.102.6.230', '2019-03-28 02:16:18'),
(398, 1, 'home', '66.102.6.232', '2019-03-28 02:16:25'),
(399, 1, 'home', '66.102.9.135', '2019-03-28 02:16:25'),
(400, 1, 'home', '164.100.146.66', '2019-03-30 11:16:01'),
(401, 1, 'home', '164.100.146.66', '2019-04-04 03:11:56'),
(402, 2, 'whos-who', '164.100.146.66', '2019-04-04 03:12:00'),
(403, 1, 'home', '164.100.146.66', '2019-04-08 01:08:39'),
(404, 1, 'home', '164.100.146.66', '2019-04-10 03:19:57'),
(405, 1, 'home', '64.233.172.7', '2019-04-10 03:32:14'),
(406, 2, 'fn', '164.100.146.66', '2019-04-10 03:39:08'),
(407, 2, 'photo-gallery', '164.100.146.66', '2019-04-10 03:39:17'),
(408, 2, 'contact-us', '164.100.146.66', '2019-04-10 03:39:18'),
(409, 2, 'about-us', '164.100.146.66', '2019-04-10 03:39:20'),
(410, 2, 'pds', '164.100.146.66', '2019-04-10 03:39:21'),
(411, 2, 'pr', '164.100.146.66', '2019-04-10 03:39:24'),
(412, 2, 'tp', '164.100.146.66', '2019-04-10 03:39:25'),
(413, 2, 'ml', '164.100.146.66', '2019-04-10 03:39:26'),
(414, 2, 'whos-who', '164.100.146.66', '2019-04-10 03:39:43'),
(415, 2, 'terms-of-use', '164.100.146.66', '2019-04-10 03:39:52'),
(416, 2, 'hyperlink-policy', '164.100.146.66', '2019-04-10 03:39:54'),
(417, 2, 'privacy-policy', '164.100.146.66', '2019-04-10 03:39:55'),
(418, 1, 'home', '164.100.146.66', '2019-04-26 01:44:53'),
(419, 2, 'ml', '164.100.146.66', '2019-04-26 01:45:09'),
(420, 2, 'contact-us', '164.100.146.66', '2019-04-26 01:45:12'),
(421, 2, 'whos-who', '164.100.146.66', '2019-04-26 01:45:15'),
(422, 2, 'pr', '164.100.146.66', '2019-04-26 01:45:21'),
(423, 2, 'pds', '164.100.146.66', '2019-04-26 01:45:22'),
(424, 2, 'about-us', '164.100.146.66', '2019-04-26 01:45:30'),
(425, 2, 'fn', '164.100.146.66', '2019-04-26 01:45:45'),
(426, 2, 'photo-gallery', '164.100.146.66', '2019-04-26 01:45:49'),
(427, 2, 'photo-gallery-view', '164.100.146.66', '2019-04-26 01:45:53'),
(428, 2, 'rulesacts', '164.100.146.66', '2019-04-26 01:45:58'),
(429, 2, 'rti', '164.100.146.66', '2019-04-26 01:45:59'),
(430, 2, 'copyright-policy', '164.100.146.66', '2019-04-26 01:46:02'),
(431, 2, 'hyperlink-policy', '164.100.146.66', '2019-04-26 01:46:03'),
(432, 2, 'terms-of-use', '164.100.146.66', '2019-04-26 01:46:04'),
(433, 2, 'privacy-policy', '164.100.146.66', '2019-04-26 01:46:05'),
(434, 2, 'disclaimer', '164.100.146.66', '2019-04-26 01:46:06'),
(435, 2, 'sitemap', '164.100.146.66', '2019-04-26 01:46:07'),
(436, 2, 'download', '164.100.146.66', '2019-04-26 01:46:10'),
(437, 2, 'notice-board', '164.100.146.66', '2019-04-26 02:20:10'),
(438, 1, 'home', '182.70.139.59', '2019-04-27 11:02:24'),
(439, 2, 'about-us', '182.70.139.59', '2019-04-27 11:02:56'),
(440, 2, 'pds', '182.70.139.59', '2019-04-27 11:03:08'),
(441, 2, 'pr', '182.70.139.59', '2019-04-27 11:03:10'),
(442, 2, 'tp', '182.70.139.59', '2019-04-27 11:03:14'),
(443, 2, 'ml', '182.70.139.59', '2019-04-27 11:03:17'),
(444, 2, 'fn', '182.70.139.59', '2019-04-27 11:03:19'),
(445, 2, 'whos-who', '182.70.139.59', '2019-04-27 11:03:40'),
(446, 1, 'home', '164.100.146.66', '2019-04-30 05:17:55'),
(447, 2, 'pds', '164.100.146.66', '2019-04-30 05:18:32'),
(448, 2, 'pr', '164.100.146.66', '2019-04-30 05:18:34'),
(449, 2, 'tp', '164.100.146.66', '2019-04-30 05:18:37'),
(450, 2, 'ml', '164.100.146.66', '2019-04-30 05:18:39'),
(451, 2, 'fn', '164.100.146.66', '2019-04-30 05:18:41'),
(452, 2, 'whos-who', '164.100.146.66', '2019-04-30 05:19:25'),
(453, 2, 'contact-us', '164.100.146.66', '2019-04-30 05:20:24'),
(454, 1, 'home', '164.100.146.66', '2019-05-09 01:37:13'),
(455, 2, 'about-us', '164.100.146.66', '2019-05-09 01:37:46'),
(456, 2, 'pds', '164.100.146.66', '2019-05-09 01:37:49'),
(457, 2, 'tp', '164.100.146.66', '2019-05-09 01:37:53'),
(458, 2, 'ml', '164.100.146.66', '2019-05-09 01:37:54'),
(459, 2, 'contact-us', '164.100.146.66', '2019-05-09 01:46:01'),
(460, 2, 'whos-who', '164.100.146.66', '2019-05-09 02:13:48'),
(461, 1, 'home', '164.100.146.66', '2019-05-10 11:02:27'),
(462, 2, 'pds', '164.100.146.66', '2019-05-10 11:02:29'),
(463, 2, 'pr', '164.100.146.66', '2019-05-10 11:02:36'),
(464, 2, 'tp', '164.100.146.66', '2019-05-10 11:02:38'),
(465, 2, 'fn', '164.100.146.66', '2019-05-10 11:02:52'),
(466, 2, 'about-us', '164.100.146.66', '2019-05-10 01:20:07'),
(467, 2, 'whos-who', '164.100.146.66', '2019-05-10 03:15:36'),
(468, 2, 'photo-gallery', '164.100.146.66', '2019-05-10 03:15:56'),
(469, 1, 'home', '164.100.146.66', '2019-05-13 10:51:24'),
(470, 1, 'home', '164.100.146.66', '2019-05-14 10:31:25'),
(471, 1, 'home', '164.100.146.66', '2019-05-21 02:53:17'),
(472, 1, 'home', '164.100.146.66', '2019-05-24 03:51:24'),
(473, 2, 'photo-gallery', '164.100.146.66', '2019-05-24 03:51:26'),
(474, 2, 'photo-gallery-view', '164.100.146.66', '2019-05-24 03:51:28'),
(475, 1, 'home', '164.100.146.66', '2019-05-30 11:43:16'),
(476, 2, 'ml', '164.100.146.66', '2019-05-30 11:43:19'),
(477, 2, 'contact-us', '164.100.146.66', '2019-05-30 12:29:58'),
(478, 2, 'whos-who', '164.100.146.66', '2019-05-30 01:29:09'),
(479, 2, 'photo-gallery', '164.100.146.66', '2019-05-30 01:29:11'),
(480, 2, 'photo-gallery-view', '164.100.146.66', '2019-05-30 01:29:14'),
(481, 1, 'home', '27.57.202.255', '2019-06-11 07:49:40'),
(482, 2, 'about-us', '27.57.202.255', '2019-06-11 07:50:36'),
(483, 2, 'about-us', '27.57.202.255', '2019-06-12 10:18:58'),
(484, 1, 'home', '164.100.146.66', '2019-06-13 01:53:27'),
(485, 2, 'pds', '164.100.146.66', '2019-06-13 01:53:33'),
(486, 2, 'about-us', '164.100.146.66', '2019-06-13 03:02:03'),
(487, 2, 'ml', '164.100.146.66', '2019-06-13 03:04:38'),
(488, 2, 'tp', '164.100.146.66', '2019-06-13 03:04:41'),
(489, 2, 'pr', '164.100.146.66', '2019-06-13 03:04:44'),
(490, 1, 'home', '164.100.146.66', '2019-06-29 01:41:39'),
(491, 2, 'about-us', '164.100.146.66', '2019-06-29 01:41:46'),
(492, 2, 'tp', '164.100.146.66', '2019-06-29 01:41:49'),
(493, 2, 'fn', '164.100.146.66', '2019-06-29 01:41:53'),
(494, 2, 'photo-gallery', '164.100.146.66', '2019-06-29 01:41:57'),
(495, 2, 'contact-us', '164.100.146.66', '2019-06-29 01:41:58'),
(496, 2, 'pds', '164.100.146.66', '2019-06-29 01:42:00'),
(497, 2, 'pr', '164.100.146.66', '2019-06-29 01:42:03'),
(498, 1, 'home', '164.100.146.66', '2019-07-01 03:40:29'),
(499, 1, 'home', '27.57.136.158', '2019-07-19 12:40:09'),
(500, 2, 'pds', '27.57.136.158', '2019-07-19 12:40:32'),
(501, 2, 'pr', '27.57.136.158', '2019-07-19 12:40:35'),
(502, 2, 'tp', '27.57.136.158', '2019-07-19 12:40:42'),
(503, 2, 'ml', '27.57.136.158', '2019-07-19 12:40:48'),
(504, 2, 'fn', '27.57.136.158', '2019-07-19 12:40:51'),
(505, 2, 'whos-who', '27.57.136.158', '2019-07-19 12:40:54'),
(506, 2, 'photo-gallery', '27.57.136.158', '2019-07-19 12:40:58'),
(507, 2, 'about-us', '27.57.136.158', '2019-07-19 12:41:13'),
(508, 2, 'contact-us', '27.57.136.158', '2019-07-19 12:49:01'),
(509, 2, 'download', '27.57.136.158', '2019-07-19 12:52:53'),
(510, 1, 'home', '164.100.146.66', '2019-07-19 12:53:59'),
(511, 2, 'pds', '164.100.146.66', '2019-07-19 12:54:24'),
(512, 1, 'home', '122.168.16.109', '2019-07-19 02:07:54'),
(513, 2, 'pds', '122.168.16.109', '2019-07-19 02:08:45'),
(514, 2, 'tp', '122.168.16.109', '2019-07-19 02:08:46'),
(515, 2, 'pr', '122.168.16.109', '2019-07-19 02:08:48'),
(516, 2, 'ml', '122.168.16.109', '2019-07-19 02:09:18'),
(517, 2, 'contact-us', '122.168.16.109', '2019-07-19 02:09:36'),
(518, 2, 'about-us', '122.168.16.109', '2019-07-19 02:09:45'),
(519, 2, 'pr', '164.100.146.66', '2019-07-19 02:40:24'),
(520, 2, 'tp', '164.100.146.66', '2019-07-19 02:40:27'),
(521, 2, 'ml', '164.100.146.66', '2019-07-19 02:40:29'),
(522, 2, 'fn', '164.100.146.66', '2019-07-19 02:40:30'),
(523, 2, 'whos-who', '164.100.146.66', '2019-07-19 02:40:31'),
(524, 2, 'photo-gallery', '164.100.146.66', '2019-07-19 02:40:35'),
(525, 2, 'contact-us', '164.100.146.66', '2019-07-19 02:40:38'),
(526, 2, 'about-us', '164.100.146.66', '2019-07-19 02:40:39'),
(527, 1, 'home', '164.100.146.66', '2019-07-22 11:02:57'),
(528, 1, 'home', '47.247.191.90', '2019-07-22 09:38:16'),
(529, 2, 'about-us', '47.247.191.90', '2019-07-22 09:40:11'),
(530, 2, 'about-us', '47.247.164.111', '2019-07-23 08:17:04'),
(531, 2, 'about-us', '47.247.167.18', '2019-07-24 08:07:28'),
(532, 1, 'home', '164.100.146.66', '2019-07-26 05:38:55'),
(533, 2, 'pr', '164.100.146.66', '2019-07-26 05:39:28'),
(534, 1, 'home', '164.100.146.66', '2019-07-30 02:26:53'),
(535, 2, 'download', '164.100.146.66', '2019-07-30 02:47:32'),
(536, 1, 'home', '182.70.194.203', '2019-07-30 02:47:44'),
(537, 2, 'about-us', '164.100.146.66', '2019-07-30 02:47:49'),
(538, 2, 'pds', '164.100.146.66', '2019-07-30 02:47:50'),
(539, 2, 'pr', '164.100.146.66', '2019-07-30 02:47:51'),
(540, 2, 'download', '182.70.194.203', '2019-07-30 02:48:17'),
(541, 2, 'ml', '164.100.146.66', '2019-07-30 02:49:08'),
(542, 2, 'pr', '182.70.194.203', '2019-07-30 05:38:27'),
(543, 2, 'fn', '182.70.194.203', '2019-07-30 05:38:54'),
(544, 2, 'contact-us', '182.70.194.203', '2019-07-30 05:39:00'),
(545, 1, 'home', '164.100.146.66', '2019-07-31 10:46:18'),
(546, 1, 'home', '164.100.146.66', '2019-08-01 09:07:56'),
(547, 2, 'pr', '164.100.146.66', '2019-08-01 09:08:07'),
(548, 2, 'pds', '164.100.146.66', '2019-08-01 09:08:09'),
(549, 2, 'ml', '164.100.146.66', '2019-08-01 09:08:11'),
(550, 2, 'whos-who', '164.100.146.66', '2019-08-01 09:08:14'),
(551, 2, 'photo-gallery', '164.100.146.66', '2019-08-01 09:08:17'),
(552, 2, 'contact-us', '164.100.146.66', '2019-08-01 09:08:18'),
(553, 2, 'about-us', '164.100.146.66', '2019-08-01 09:08:29'),
(554, 1, 'home', '164.100.146.66', '2019-08-02 12:02:01'),
(555, 1, 'home', '10.125.242.221', '2019-08-02 12:02:09'),
(556, 2, 'pds', '10.125.242.221', '2019-08-02 12:05:10'),
(557, 2, 'pr', '10.125.242.221', '2019-08-02 12:09:27'),
(558, 2, 'about-us', '10.125.242.221', '2019-08-02 12:14:47'),
(559, 1, 'home', '164.100.146.67', '2019-08-31 10:51:06'),
(560, 2, 'about-us', '164.100.146.67', '2019-08-31 10:51:28'),
(561, 2, 'pds', '164.100.146.67', '2019-08-31 10:51:31'),
(562, 2, 'pr', '164.100.146.67', '2019-08-31 10:51:37'),
(563, 2, 'tp', '164.100.146.67', '2019-08-31 10:51:39'),
(564, 2, 'whos-who', '164.100.146.67', '2019-08-31 10:51:43'),
(565, 2, 'photo-gallery', '164.100.146.67', '2019-08-31 10:51:46'),
(566, 2, 'contact-us', '164.100.146.67', '2019-08-31 10:51:49'),
(567, 2, 'screen-reader', '164.100.146.67', '2019-08-31 10:51:58'),
(568, 2, 'notice-board', '164.100.146.67', '2019-08-31 10:52:05'),
(569, 2, 'fn', '164.100.146.67', '2019-08-31 10:52:15'),
(570, 1, 'home', '66.102.6.230', '2019-09-05 05:47:43'),
(571, 1, 'home', '164.100.146.67', '2019-09-16 04:54:08'),
(572, 1, 'home', '164.100.146.67', '2019-09-30 05:26:53'),
(573, 2, 'fn', '164.100.146.67', '2019-09-30 05:27:26'),
(574, 2, 'whos-who', '164.100.146.67', '2019-09-30 05:27:28'),
(575, 2, 'tp', '164.100.146.67', '2019-09-30 05:27:34'),
(576, 2, 'pr', '164.100.146.67', '2019-09-30 05:27:36'),
(577, 2, 'about-us', '164.100.146.67', '2019-09-30 05:27:43'),
(578, 2, 'pds', '164.100.146.67', '2019-09-30 05:27:44'),
(579, 2, 'ml', '164.100.146.67', '2019-09-30 05:27:46'),
(580, 2, 'photo-gallery', '164.100.146.67', '2019-09-30 05:27:49'),
(581, 2, 'photo-gallery-view', '164.100.146.67', '2019-09-30 05:27:52'),
(582, 1, 'home', '164.100.146.66', '2019-11-02 06:16:31'),
(583, 1, 'home', '10.115.96.66', '2019-11-02 06:36:12'),
(584, 2, 'pr', '10.115.96.66', '2019-11-02 06:36:21'),
(585, 1, 'home', '10.115.96.66', '2019-11-04 02:41:54'),
(586, 2, 'about-us', '10.115.96.66', '2019-11-04 03:39:25'),
(587, 2, 'whos-who', '10.115.96.66', '2019-11-04 03:54:16'),
(588, 2, 'notice-board', '10.115.96.66', '2019-11-04 04:07:31'),
(589, 2, 'feedback', '10.115.96.66', '2019-11-04 04:07:44'),
(590, 2, 'sitemap', '10.115.96.66', '2019-11-04 04:07:57'),
(591, 2, 'hyperlink-policy', '10.115.96.66', '2019-11-04 04:08:00'),
(592, 2, 'terms-of-use', '10.115.96.66', '2019-11-04 04:08:02'),
(593, 2, 'career', '10.115.96.66', '2019-11-04 04:20:18'),
(594, 2, 'rti', '10.115.96.66', '2019-11-04 04:20:19'),
(595, 2, 'tender', '10.115.96.66', '2019-11-04 04:20:20'),
(596, 1, 'home', '10.115.96.66', '2019-11-13 11:30:21'),
(597, 1, 'home', '10.115.96.66', '2019-11-15 09:37:38'),
(598, 2, 'about-us', '10.115.96.66', '2019-11-15 09:37:46'),
(599, 2, 'career', '10.115.96.66', '2019-11-15 05:31:18'),
(600, 2, 'rti', '10.115.96.66', '2019-11-15 05:53:04'),
(601, 2, 'contact-us', '10.115.96.66', '2019-11-15 06:25:14'),
(602, 2, 'tender', '10.115.96.66', '2019-11-15 06:27:06'),
(603, 1, 'home', '10.115.96.66', '2019-11-16 09:43:11'),
(604, 2, 'tender', '10.115.96.66', '2019-11-16 09:46:28'),
(605, 2, 'career', '10.115.96.66', '2019-11-16 09:46:30'),
(606, 2, 'whos-who', '10.115.96.66', '2019-11-16 09:46:32'),
(607, 2, 'feedback', '10.115.96.66', '2019-11-16 10:30:32'),
(608, 2, 'events', '10.115.96.66', '2019-11-16 11:03:35'),
(609, 2, 'about-us', '10.115.96.66', '2019-11-16 11:14:05'),
(610, 2, 'notice-board', '10.115.96.66', '2019-11-16 11:16:54'),
(611, 2, 'news-details', '10.115.96.66', '2019-11-16 11:17:03'),
(612, 2, 'important-links', '10.115.96.66', '2019-11-16 11:17:07'),
(613, 2, 'circular', '10.115.96.66', '2019-11-16 11:40:49'),
(614, 2, 'search', '10.115.96.66', '2019-11-16 12:21:17'),
(615, 2, 'rti', '10.115.96.66', '2019-11-16 12:21:30'),
(616, 2, 'contact-us', '10.115.96.66', '2019-11-16 12:55:17'),
(617, 2, 'contact', '10.115.96.66', '2019-11-16 12:56:10'),
(618, 2, 'terms-of-use', '10.115.96.66', '2019-11-16 01:35:46'),
(619, 1, 'home', '164.100.146.66', '2019-11-16 02:37:55'),
(620, 1, 'home', '47.247.131.71', '2019-11-17 01:48:52'),
(621, 1, 'home', '47.247.25.232', '2019-11-17 02:23:18'),
(622, 2, 'tender', '47.247.25.232', '2019-11-17 02:23:32'),
(623, 2, 'rti', '47.247.25.232', '2019-11-17 02:23:45'),
(624, 2, 'career', '47.247.25.232', '2019-11-17 02:23:48'),
(625, 2, 'whos-who', '47.247.25.232', '2019-11-17 02:23:51'),
(626, 2, 'contact', '47.247.25.232', '2019-11-17 02:23:53'),
(627, 1, 'home', '117.232.234.91', '2019-11-17 05:30:09'),
(628, 2, 'tender', '117.232.234.91', '2019-11-17 05:32:56'),
(629, 2, 'rti', '117.232.234.91', '2019-11-17 05:33:17'),
(630, 2, 'career', '117.232.234.91', '2019-11-17 05:33:23'),
(631, 2, 'whos-who', '117.232.234.91', '2019-11-17 05:33:28'),
(632, 2, 'contact', '117.232.234.91', '2019-11-17 05:33:36'),
(633, 1, 'home', '164.100.146.66', '2019-11-18 10:05:08'),
(634, 2, 'contact', '164.100.146.66', '2019-11-18 10:05:26'),
(635, 2, 'whos-who', '164.100.146.66', '2019-11-18 10:05:32'),
(636, 2, 'career', '164.100.146.66', '2019-11-18 10:05:33'),
(637, 1, 'home', '66.102.6.223', '2019-11-18 05:30:18'),
(638, 1, 'home', '66.102.6.221', '2019-11-20 10:39:21'),
(639, 1, 'home', '117.232.254.182', '2019-11-20 11:15:15'),
(640, 1, 'home', '66.102.6.223', '2019-11-21 11:02:34'),
(641, 1, 'home', '117.232.229.137', '2019-11-21 11:47:26'),
(642, 1, 'home', '117.232.217.87', '2019-11-21 07:21:21'),
(643, 1, 'home', '66.102.6.221', '2019-11-25 10:47:43'),
(644, 1, 'home', '164.100.146.66', '2019-11-25 11:11:50'),
(645, 1, 'home', '164.100.151.232', '2019-11-25 12:24:40'),
(646, 1, 'home', '66.102.8.205', '2019-11-25 12:24:45'),
(647, 2, 'contact', '164.100.151.232', '2019-11-25 12:24:59'),
(648, 2, 'whos-who', '164.100.151.230', '2019-11-25 12:25:04'),
(649, 2, 'tender', '164.100.151.232', '2019-11-25 12:25:15'),
(650, 1, 'home', '164.100.151.234', '2019-11-25 12:27:55'),
(651, 1, 'home', '164.100.151.230', '2019-11-25 12:30:54'),
(652, 1, 'home', '66.102.8.199', '2019-11-25 12:31:43'),
(653, 2, 'about-us', '164.100.151.232', '2019-11-25 12:31:48'),
(654, 2, 'screen-reader', '164.100.151.230', '2019-11-25 12:32:23'),
(655, 2, 'tender', '164.100.146.66', '2019-11-25 12:44:15'),
(656, 2, 'career', '164.100.146.66', '2019-11-25 12:44:18'),
(657, 2, 'contact', '164.100.146.66', '2019-11-25 12:44:21'),
(658, 2, 'news-details', '164.100.146.66', '2019-11-25 05:08:36'),
(659, 1, 'home', '164.100.151.232', '2019-11-26 10:51:22'),
(660, 2, 'tender', '164.100.151.230', '2019-11-26 10:58:28'),
(661, 2, 'screen-reader', '164.100.151.232', '2019-11-26 10:58:51'),
(662, 2, 'career', '164.100.151.232', '2019-11-26 10:59:02'),
(663, 2, 'whos-who', '164.100.151.232', '2019-11-26 10:59:04'),
(664, 2, 'contact', '164.100.151.232', '2019-11-26 10:59:05'),
(665, 1, 'home', '164.100.151.234', '2019-11-26 11:00:35'),
(666, 2, 'tender', '164.100.151.234', '2019-11-26 12:21:41'),
(667, 2, 'contact', '164.100.151.234', '2019-11-26 12:22:37'),
(668, 2, 'whos-who', '164.100.151.230', '2019-11-26 12:25:04'),
(669, 2, 'contact', '164.100.151.230', '2019-11-26 12:25:17'),
(670, 2, 'events', '164.100.151.230', '2019-11-26 12:26:17'),
(671, 2, 'tender', '164.100.151.232', '2019-11-26 12:28:56'),
(672, 2, 'rti', '164.100.151.230', '2019-11-26 12:29:01'),
(673, 2, 'events', '164.100.151.234', '2019-11-26 12:31:02'),
(674, 1, 'home', '164.100.146.66', '2019-11-26 12:44:01'),
(675, 1, 'home', '10.115.250.244', '2019-11-26 12:52:10'),
(676, 1, 'home', '47.247.128.172', '2019-11-26 12:53:06'),
(677, 2, 'about-us', '164.100.151.232', '2019-11-26 01:16:49'),
(678, 2, 'contact', '164.100.146.66', '2019-11-26 03:22:45'),
(679, 2, 'whos-who', '164.100.146.66', '2019-11-26 03:22:48'),
(680, 2, 'career', '164.100.146.66', '2019-11-26 03:22:49'),
(681, 2, 'rti', '164.100.146.66', '2019-11-26 03:22:51'),
(682, 1, 'home', '164.100.146.66', '2019-11-27 10:41:02'),
(683, 2, 'about-us', '164.100.146.66', '2019-11-27 10:45:22'),
(684, 1, 'home', '66.102.6.193', '2019-11-27 11:18:16'),
(685, 2, 'contact', '157.34.174.84', '2019-11-28 12:12:25'),
(686, 1, 'home', '157.34.174.84', '2019-11-28 12:12:32'),
(687, 1, 'home', '164.100.146.66', '2019-11-28 10:40:39'),
(688, 1, 'home', '66.102.6.223', '2019-11-28 11:01:38'),
(689, 2, 'tender', '164.100.146.66', '2019-11-28 11:51:57'),
(690, 1, 'home', '128.30.52.96', '2019-11-28 12:11:14'),
(691, 1, 'home', '205.211.169.31', '2019-11-28 12:11:25'),
(692, 2, 'privacy-policy', '164.100.146.66', '2019-11-28 12:14:04'),
(693, 1, 'home', '164.100.151.234', '2019-11-28 12:30:47'),
(694, 1, 'home', '66.102.8.209', '2019-11-28 12:30:58'),
(695, 2, 'tender', '164.100.151.230', '2019-11-28 12:31:14'),
(696, 2, 'rti', '164.100.151.230', '2019-11-28 12:31:29'),
(697, 2, 'contact', '164.100.151.234', '2019-11-28 12:31:36'),
(698, 1, 'home', '164.100.151.232', '2019-11-28 12:34:41'),
(699, 2, 'tender', '164.100.151.232', '2019-11-28 12:35:42'),
(700, 2, 'about-us', '164.100.151.232', '2019-11-28 12:35:46'),
(701, 1, 'home', '117.228.173.92', '2019-11-28 12:39:14'),
(702, 1, 'home', '164.100.151.230', '2019-11-28 12:40:06'),
(703, 2, 'about-us', '164.100.151.230', '2019-11-28 12:44:20'),
(704, 2, 'rti', '164.100.151.232', '2019-11-28 12:44:56'),
(705, 2, 'career', '164.100.151.232', '2019-11-28 12:45:03'),
(706, 2, 'whos-who', '164.100.151.232', '2019-11-28 12:45:24'),
(707, 2, 'contact', '164.100.151.232', '2019-11-28 12:45:29'),
(708, 2, 'contact', '164.100.151.230', '2019-11-28 12:45:47'),
(709, 2, 'news-details', '164.100.146.66', '2019-11-28 12:55:00'),
(710, 2, 'contact', '164.100.146.66', '2019-11-28 01:05:22'),
(711, 2, 'about-us', '164.100.146.66', '2019-11-28 03:15:41'),
(712, 2, 'events', '164.100.151.234', '2019-11-28 04:48:59'),
(713, 2, 'tender', '164.100.151.234', '2019-11-28 04:49:30'),
(714, 2, 'events', '164.100.151.232', '2019-11-28 05:11:46'),
(715, 2, 'events', '164.100.151.230', '2019-11-28 05:13:21'),
(716, 2, 'events', '164.100.146.66', '2019-11-28 05:51:08'),
(717, 2, 'about-us', '164.100.151.234', '2019-11-28 05:57:11'),
(718, 2, 'whos-who', '164.100.151.234', '2019-11-28 05:57:34'),
(719, 2, 'whos-who', '164.100.151.230', '2019-11-28 06:16:02'),
(720, 1, 'home', '157.34.114.4', '2019-11-28 11:08:09'),
(721, 2, 'about-us', '157.34.114.4', '2019-11-28 11:09:59'),
(722, 2, 'whos-who', '157.34.114.4', '2019-11-28 11:10:06'),
(723, 2, 'events', '157.34.114.4', '2019-11-28 11:10:15'),
(724, 2, 'tender', '157.34.114.4', '2019-11-28 11:10:44'),
(725, 2, 'career', '157.34.114.4', '2019-11-28 11:10:48'),
(726, 2, 'contact', '157.34.114.4', '2019-11-28 11:10:54'),
(727, 1, 'home', '66.102.6.193', '2019-11-29 10:37:19'),
(728, 1, 'home', '164.100.146.66', '2019-11-29 11:11:54'),
(729, 1, 'home', '164.100.151.234', '2019-11-29 11:51:39'),
(730, 1, 'home', '164.100.151.232', '2019-11-29 12:12:20'),
(731, 2, 'about-us', '164.100.151.230', '2019-11-29 12:14:00'),
(732, 1, 'home', '164.100.151.230', '2019-11-29 12:14:34'),
(733, 2, 'whos-who', '164.100.151.234', '2019-11-29 12:15:26'),
(734, 2, 'events', '164.100.151.234', '2019-11-29 12:15:29'),
(735, 2, 'tender', '164.100.151.234', '2019-11-29 12:15:38'),
(736, 2, 'about-us', '164.100.151.234', '2019-11-29 12:15:42'),
(737, 2, 'events', '164.100.151.230', '2019-11-29 12:16:35'),
(738, 2, 'tender', '164.100.151.230', '2019-11-29 01:49:05'),
(739, 2, 'contact', '164.100.151.232', '2019-11-29 01:49:32'),
(740, 2, 'career', '164.100.151.232', '2019-11-29 01:49:36'),
(741, 2, 'events', '164.100.151.232', '2019-11-29 01:49:38'),
(742, 2, 'whos-who', '164.100.151.232', '2019-11-29 01:50:44'),
(743, 2, 'about-us', '164.100.151.232', '2019-11-29 01:51:40'),
(744, 2, 'about-us', '164.100.146.66', '2019-11-29 04:05:24'),
(745, 2, 'tender', '164.100.146.66', '2019-11-29 05:07:34'),
(746, 2, 'whos-who', '164.100.146.66', '2019-11-29 05:07:55'),
(747, 1, 'home', '66.102.6.193', '2019-11-30 12:07:58'),
(748, 1, 'home', '164.100.146.66', '2019-11-30 12:23:51'),
(749, 2, 'about-us', '164.100.146.66', '2019-11-30 01:17:19'),
(750, 1, 'home', '164.100.151.232', '2019-11-30 03:13:19'),
(751, 2, 'about-us', '164.100.151.233', '2019-11-30 03:13:31'),
(752, 1, 'home', '164.100.151.233', '2019-11-30 03:13:45'),
(753, 2, 'whos-who', '164.100.151.233', '2019-11-30 03:13:57'),
(754, 2, 'tender', '164.100.151.233', '2019-11-30 03:14:11'),
(755, 2, 'events', '164.100.151.233', '2019-11-30 03:14:17'),
(756, 1, 'home', '59.88.157.230', '2019-12-01 02:14:40'),
(757, 1, 'home', '164.100.146.66', '2019-12-02 11:09:00'),
(758, 2, 'events', '164.100.146.66', '2019-12-02 11:09:40'),
(759, 2, 'contact', '164.100.146.66', '2019-12-02 11:11:34'),
(760, 2, 'tender', '164.100.146.66', '2019-12-02 11:29:16'),
(761, 1, 'home', '47.247.202.207', '2019-12-02 12:57:43'),
(762, 2, 'contact', '47.247.202.207', '2019-12-02 01:07:04'),
(763, 2, 'events', '47.247.202.207', '2019-12-02 01:09:07'),
(764, 2, 'terms-of-use', '47.247.202.207', '2019-12-02 01:24:55'),
(765, 2, 'tender', '47.247.202.207', '2019-12-02 01:26:25'),
(766, 1, 'home', '66.102.6.223', '2019-12-02 02:12:40'),
(767, 1, 'home', '164.100.151.232', '2019-12-02 02:40:24'),
(768, 2, 'about-us', '164.100.151.230', '2019-12-02 02:41:59'),
(769, 1, 'home', '164.100.151.230', '2019-12-02 02:42:07'),
(770, 2, 'whos-who', '164.100.151.230', '2019-12-02 02:42:11'),
(771, 2, 'events', '164.100.151.232', '2019-12-02 02:42:14'),
(772, 2, 'tender', '164.100.151.230', '2019-12-02 02:42:18'),
(773, 2, 'career', '164.100.151.230', '2019-12-02 02:42:20'),
(774, 2, 'contact', '164.100.151.230', '2019-12-02 02:42:22'),
(775, 2, 'contact', '164.100.151.232', '2019-12-02 02:42:53'),
(776, 2, 'whos-who', '164.100.151.232', '2019-12-02 02:55:20'),
(777, 1, 'home', '164.100.151.231', '2019-12-02 02:55:48'),
(778, 1, 'home', '47.247.194.211', '2019-12-02 02:59:49'),
(779, 2, 'feedback', '47.247.194.211', '2019-12-02 03:28:28'),
(780, 2, 'hyperlink-policy', '47.247.194.211', '2019-12-02 03:28:32'),
(781, 2, 'privacy-policy', '47.247.194.211', '2019-12-02 03:29:21'),
(782, 2, 'terms-of-use', '47.247.194.211', '2019-12-02 03:29:36'),
(783, 2, 'disclaimer', '47.247.194.211', '2019-12-02 03:29:39'),
(784, 2, 'sitemap', '47.247.194.211', '2019-12-02 03:29:49'),
(785, 2, 'tender', '47.247.194.211', '2019-12-02 03:33:57'),
(786, 1, 'home', '47.247.240.32', '2019-12-02 05:20:52'),
(787, 1, 'home', '49.36.30.192', '2019-12-03 09:23:04'),
(788, 1, 'home', '66.102.6.221', '2019-12-04 10:46:20'),
(789, 1, 'home', '47.247.207.203', '2019-12-04 11:42:31'),
(790, 2, 'feedback', '47.247.207.203', '2019-12-04 11:43:49'),
(791, 2, 'hyperlink-policy', '47.247.207.203', '2019-12-04 11:47:01'),
(792, 2, 'terms-of-use', '47.247.207.203', '2019-12-04 11:47:20'),
(793, 2, 'privacy-policy', '47.247.207.203', '2019-12-04 11:56:05'),
(794, 2, 'disclaimer', '47.247.207.203', '2019-12-04 12:02:23'),
(795, 1, 'home', '47.247.203.51', '2019-12-04 01:11:13'),
(796, 2, 'contact', '47.247.203.51', '2019-12-04 01:11:31'),
(797, 2, 'whos-who', '47.247.203.51', '2019-12-04 01:12:03'),
(798, 2, 'about-us', '47.247.203.51', '2019-12-04 01:26:48'),
(799, 2, 'events', '47.247.203.51', '2019-12-04 01:43:44'),
(800, 1, 'home', '164.100.146.66', '2019-12-04 04:44:51'),
(801, 2, 'contact', '164.100.146.66', '2019-12-04 04:49:15'),
(802, 1, 'home', '64.233.172.171', '2019-12-05 10:42:27'),
(803, 1, 'home', '164.100.151.232', '2019-12-05 11:58:54'),
(804, 2, 'whos-who', '164.100.151.231', '2019-12-05 11:59:37'),
(805, 2, 'events', '164.100.151.232', '2019-12-05 11:59:40'),
(806, 1, 'home', '164.100.151.233', '2019-12-05 11:59:58'),
(807, 2, 'contact', '164.100.151.233', '2019-12-05 12:00:27'),
(808, 1, 'home', '164.100.151.231', '2019-12-05 12:01:07'),
(809, 1, 'home', '164.100.146.66', '2019-12-05 01:02:16'),
(810, 2, 'about-us', '164.100.146.66', '2019-12-05 02:25:49'),
(811, 2, 'privacy-policy', '164.100.146.66', '2019-12-05 02:43:09'),
(812, 2, 'photo-gallery', '164.100.146.66', '2019-12-05 02:59:59'),
(813, 2, 'photo-gallery-view', '164.100.146.66', '2019-12-05 03:00:06'),
(814, 2, 'video-gallery', '164.100.146.66', '2019-12-05 03:00:22'),
(815, 2, 'contact', '164.100.146.66', '2019-12-05 03:05:30'),
(816, 2, 'notice-board', '164.100.146.66', '2019-12-05 07:17:29'),
(817, 2, 'news-details', '164.100.146.66', '2019-12-05 07:17:40'),
(818, 1, 'home', '117.228.222.54', '2019-12-05 07:55:55'),
(819, 1, 'home', '171.60.139.108', '2019-12-05 08:30:04'),
(820, 2, 'aim-object', '171.60.139.108', '2019-12-05 08:31:05'),
(821, 2, 'company-register', '171.60.139.108', '2019-12-05 08:31:12'),
(822, 2, 'organisation-chart', '171.60.139.108', '2019-12-05 08:31:14'),
(823, 2, 'whos-who', '171.60.139.108', '2019-12-05 08:31:22'),
(824, 2, 'events', '171.60.139.108', '2019-12-05 08:31:32'),
(825, 2, 'tender', '171.60.139.108', '2019-12-05 08:31:36'),
(826, 2, 'photo-gallery', '171.60.139.108', '2019-12-05 08:31:51'),
(827, 2, 'video-gallery', '171.60.139.108', '2019-12-05 08:32:01'),
(828, 2, 'contact', '171.60.139.108', '2019-12-05 08:32:07'),
(829, 2, 'about-us', '171.60.139.108', '2019-12-05 08:34:05'),
(830, 1, 'home', '164.100.151.233', '2019-12-06 09:57:28'),
(831, 1, 'home', '164.100.151.232', '2019-12-06 09:58:32'),
(832, 2, 'whos-who', '164.100.151.232', '2019-12-06 09:58:51'),
(833, 2, 'company-register', '164.100.151.232', '2019-12-06 09:59:01'),
(834, 2, 'events', '164.100.151.232', '2019-12-06 09:59:07'),
(835, 2, 'tender', '164.100.151.232', '2019-12-06 09:59:19'),
(836, 2, 'photo-gallery', '164.100.151.231', '2019-12-06 09:59:25'),
(837, 2, 'photo-gallery-view', '164.100.151.232', '2019-12-06 09:59:37'),
(838, 1, 'home', '164.100.151.231', '2019-12-06 11:19:40'),
(839, 1, 'home', '164.100.146.66', '2019-12-06 12:31:37'),
(840, 1, 'home', '66.102.6.221', '2019-12-06 12:46:58'),
(841, 2, 'organisation-chart', '164.100.151.233', '2019-12-06 02:11:36'),
(842, 2, 'aim-object', '164.100.151.233', '2019-12-06 02:11:40'),
(843, 2, 'whos-who', '164.100.151.231', '2019-12-06 02:11:43'),
(844, 2, 'contact', '164.100.151.231', '2019-12-06 02:11:55');
INSERT INTO `comm_web_visitor` (`v_id`, `v_type`, `v_menu_name`, `v_ip_address`, `v_created_date`) VALUES
(845, 2, 'events', '164.100.151.233', '2019-12-06 02:13:21'),
(846, 2, 'tender', '164.100.151.233', '2019-12-06 02:13:27'),
(847, 2, 'video-gallery', '164.100.151.232', '2019-12-06 02:14:44'),
(848, 2, 'contact', '164.100.151.232', '2019-12-06 02:14:59'),
(849, 2, 'events', '164.100.146.66', '2019-12-06 05:29:20'),
(850, 2, 'whos-who', '164.100.146.66', '2019-12-06 06:14:03'),
(851, 2, 'events', '164.100.151.231', '2019-12-06 06:14:26'),
(852, 2, 'contact', '164.100.146.66', '2019-12-06 06:15:16'),
(853, 2, 'about-us', '164.100.151.232', '2019-12-06 06:25:05'),
(854, 2, 'aim-object', '164.100.151.232', '2019-12-06 06:30:02'),
(855, 2, 'tender', '164.100.151.231', '2019-12-06 06:33:10'),
(856, 2, 'aim-object', '164.100.151.231', '2019-12-06 06:35:38'),
(857, 2, 'about-us', '164.100.151.233', '2019-12-06 06:36:01'),
(858, 2, 'about-us', '164.100.151.231', '2019-12-06 06:36:22'),
(859, 1, 'home', '164.100.151.231', '2019-12-07 10:18:05'),
(860, 1, 'home', '164.100.151.233', '2019-12-07 10:50:22'),
(861, 1, 'home', '164.100.146.66', '2019-12-07 11:17:00'),
(862, 2, 'whos-who', '164.100.146.66', '2019-12-07 11:25:08'),
(863, 2, 'events', '164.100.146.66', '2019-12-07 11:32:59'),
(864, 2, 'tender', '164.100.146.66', '2019-12-07 11:33:00'),
(865, 2, 'contact', '164.100.146.66', '2019-12-07 12:29:01'),
(866, 2, 'video-gallery', '164.100.146.66', '2019-12-07 12:51:45'),
(867, 2, 'important-links', '164.100.151.231', '2019-12-07 01:29:37'),
(868, 2, 'important-links', '164.100.151.232', '2019-12-07 01:46:16'),
(869, 1, 'home', '164.100.151.232', '2019-12-07 01:46:34'),
(870, 2, 'about-us', '164.100.151.233', '2019-12-07 02:54:01'),
(871, 2, 'aim-object', '164.100.151.233', '2019-12-07 03:00:32'),
(872, 2, 'aim-object', '164.100.151.231', '2019-12-07 03:04:11'),
(873, 2, 'contact', '164.100.151.233', '2019-12-07 03:08:51'),
(874, 2, 'contact', '164.100.151.232', '2019-12-07 03:15:11'),
(875, 2, 'aims-objectives', '164.100.151.232', '2019-12-07 03:15:26'),
(876, 2, 'company-register', '164.100.151.232', '2019-12-07 03:15:33'),
(877, 2, 'organisation-chart', '164.100.151.231', '2019-12-07 03:15:39'),
(878, 2, 'aims-objectives', '164.100.146.66', '2019-12-07 03:20:12'),
(879, 2, 'company-register', '164.100.146.66', '2019-12-07 03:20:18'),
(880, 2, 'organisation-chart', '164.100.146.66', '2019-12-07 03:20:22'),
(881, 2, 'about-us', '164.100.151.231', '2019-12-07 03:24:42'),
(882, 2, 'aims-objectives', '164.100.151.231', '2019-12-07 03:25:20'),
(883, 2, 'about-us', '164.100.146.66', '2019-12-07 03:25:24'),
(884, 2, 'aims-objectives', '164.100.151.233', '2019-12-07 03:26:30'),
(885, 2, 'about-us', '164.100.151.232', '2019-12-07 03:31:23'),
(886, 2, 'company-register', '164.100.151.231', '2019-12-07 03:32:51'),
(887, 2, 'events', '164.100.151.231', '2019-12-07 03:33:00'),
(888, 2, 'tender', '164.100.151.232', '2019-12-07 03:33:02'),
(889, 2, 'contact', '164.100.151.231', '2019-12-07 03:33:05'),
(890, 2, 'organisation-chart', '164.100.151.232', '2019-12-07 04:08:45'),
(891, 2, 'whos-who', '164.100.151.232', '2019-12-07 04:08:48'),
(892, 2, 'events', '164.100.151.232', '2019-12-07 04:08:50'),
(893, 2, 'whos-who', '164.100.151.231', '2019-12-07 04:28:01'),
(894, 2, 'tender', '164.100.151.233', '2019-12-07 05:17:58'),
(895, 2, 'whos-who', '164.100.151.233', '2019-12-07 05:20:37'),
(896, 2, 'company-register', '164.100.151.233', '2019-12-07 05:33:44'),
(897, 2, 'organisation-chart', '164.100.151.233', '2019-12-07 05:33:47'),
(898, 2, 'photo-gallery', '164.100.151.233', '2019-12-07 05:35:30'),
(899, 2, 'video-gallery', '164.100.151.233', '2019-12-07 05:35:37'),
(900, 2, 'events', '164.100.151.233', '2019-12-07 05:37:28'),
(901, 1, 'home', '117.228.207.92', '2019-12-07 09:50:33'),
(902, 1, 'home', '122.168.171.78', '2019-12-08 08:25:39'),
(903, 2, 'events', '122.168.171.78', '2019-12-08 08:56:13'),
(904, 2, 'organisation-chart', '122.168.171.78', '2019-12-08 10:17:04'),
(905, 2, 'aims-objectives', '122.168.171.78', '2019-12-08 10:19:42'),
(906, 1, 'home', '66.102.6.223', '2019-12-09 10:52:30'),
(907, 1, 'home', '164.100.151.233', '2019-12-09 10:53:24'),
(908, 1, 'home', '164.100.151.231', '2019-12-09 10:53:33'),
(909, 2, 'aims-objectives', '164.100.151.231', '2019-12-09 10:53:45'),
(910, 2, 'company-register', '164.100.151.233', '2019-12-09 10:53:51'),
(911, 2, 'organisation-chart', '164.100.151.233', '2019-12-09 10:53:55'),
(912, 2, 'whos-who', '164.100.151.233', '2019-12-09 10:53:58'),
(913, 2, 'events', '164.100.151.231', '2019-12-09 10:54:10'),
(914, 2, 'events', '164.100.151.232', '2019-12-09 10:54:43'),
(915, 1, 'home', '164.100.151.232', '2019-12-09 11:09:35'),
(916, 2, 'contact', '164.100.151.231', '2019-12-09 11:25:01'),
(917, 2, 'events', '164.100.151.233', '2019-12-09 11:50:34'),
(918, 1, 'home', '164.100.146.66', '2019-12-09 01:09:02'),
(919, 2, 'aims-objectives', '164.100.146.66', '2019-12-09 01:15:52'),
(920, 2, 'about-us', '164.100.146.66', '2019-12-09 01:16:04'),
(921, 2, 'whos-who', '164.100.146.66', '2019-12-09 01:19:24'),
(922, 2, 'feedback', '164.100.146.66', '2019-12-09 01:26:21'),
(923, 2, 'contact', '164.100.146.66', '2019-12-09 01:29:01'),
(924, 2, 'company-register', '164.100.146.66', '2019-12-09 01:36:03'),
(925, 2, 'events', '164.100.146.66', '2019-12-09 01:38:14'),
(926, 2, 'video-gallery', '164.100.146.66', '2019-12-09 01:40:48'),
(927, 2, 'photo-gallery', '164.100.146.66', '2019-12-09 01:41:19'),
(928, 2, 'about-us', '164.100.151.232', '2019-12-09 03:30:56'),
(929, 2, 'about-us', '164.100.151.231', '2019-12-09 03:31:10'),
(930, 2, 'company-register', '164.100.151.232', '2019-12-09 03:31:17'),
(931, 2, 'organisation-chart', '164.100.151.232', '2019-12-09 03:31:20'),
(932, 2, 'whos-who', '164.100.151.232', '2019-12-09 03:31:24'),
(933, 2, 'tender', '164.100.151.231', '2019-12-09 03:31:47'),
(934, 2, 'contact', '164.100.151.232', '2019-12-09 03:31:55'),
(935, 2, 'photo-gallery', '164.100.151.231', '2019-12-09 05:06:51'),
(936, 2, 'photo-gallery', '164.100.151.233', '2019-12-09 06:26:19'),
(937, 1, 'home', '171.61.36.7', '2019-12-09 08:07:49'),
(938, 2, 'about-us', '171.61.36.7', '2019-12-09 08:09:48'),
(939, 2, 'company-register', '171.61.36.7', '2019-12-09 08:09:55'),
(940, 2, 'organisation-chart', '171.61.36.7', '2019-12-09 08:09:58'),
(941, 2, 'whos-who', '171.61.36.7', '2019-12-09 08:10:04'),
(942, 2, 'events', '171.61.36.7', '2019-12-09 08:10:58'),
(943, 2, 'photo-gallery', '171.61.36.7', '2019-12-09 08:18:50'),
(944, 2, 'video-gallery', '171.61.36.7', '2019-12-09 08:18:55'),
(945, 2, 'contact', '171.61.36.7', '2019-12-09 08:18:58'),
(946, 1, 'home', '164.100.151.232', '2019-12-10 10:37:38'),
(947, 2, 'whos-who', '164.100.151.232', '2019-12-10 10:38:32'),
(948, 2, 'events', '164.100.151.232', '2019-12-10 10:38:37'),
(949, 2, 'contact', '164.100.151.232', '2019-12-10 10:38:48'),
(950, 2, 'photo-gallery', '164.100.151.232', '2019-12-10 10:38:56'),
(951, 2, 'about-us', '164.100.151.232', '2019-12-10 10:39:05'),
(952, 2, 'events', '164.100.151.233', '2019-12-10 10:40:47'),
(953, 2, 'events', '164.100.151.231', '2019-12-10 10:45:57'),
(954, 1, 'home', '164.100.146.66', '2019-12-10 10:46:51'),
(955, 2, 'contact', '164.100.146.66', '2019-12-10 10:47:13'),
(956, 2, 'feedback', '164.100.146.66', '2019-12-10 10:49:43'),
(957, 2, 'whos-who', '164.100.146.66', '2019-12-10 10:49:52'),
(958, 2, 'about-us', '164.100.151.233', '2019-12-10 11:00:49'),
(959, 1, 'home', '27.62.232.178', '2019-12-10 11:02:04'),
(960, 1, 'home', '164.100.151.231', '2019-12-10 11:02:07'),
(961, 2, 'contact', '27.62.232.178', '2019-12-10 11:04:30'),
(962, 2, 'tender', '27.62.232.178', '2019-12-10 11:04:58'),
(963, 2, 'company-register', '164.100.151.232', '2019-12-10 11:05:30'),
(964, 2, 'organisation-chart', '164.100.151.232', '2019-12-10 11:05:35'),
(965, 2, 'whos-who', '164.100.151.233', '2019-12-10 11:05:40'),
(966, 2, 'tender', '164.100.151.233', '2019-12-10 11:05:54'),
(967, 2, 'whos-who', '27.62.232.178', '2019-12-10 11:06:06'),
(968, 2, 'photo-gallery', '164.100.151.233', '2019-12-10 11:06:13'),
(969, 2, 'video-gallery', '164.100.151.233', '2019-12-10 11:06:21'),
(970, 2, 'contact', '164.100.151.233', '2019-12-10 11:06:24'),
(971, 2, 'contact', '164.100.151.231', '2019-12-10 11:06:51'),
(972, 2, 'video-gallery', '27.62.232.178', '2019-12-10 11:07:38'),
(973, 2, 'about-us', '27.62.232.178', '2019-12-10 11:11:54'),
(974, 1, 'home', '52.91.167.153', '2019-12-10 11:28:12'),
(975, 2, 'whos-who', '164.100.151.231', '2019-12-10 11:33:00'),
(976, 1, 'home', '27.56.204.25', '2019-12-10 11:34:12'),
(977, 2, 'events', '27.56.204.25', '2019-12-10 11:34:38'),
(978, 2, 'tender', '27.56.204.25', '2019-12-10 11:47:02'),
(979, 1, 'home', '164.100.151.233', '2019-12-10 11:48:52'),
(980, 2, 'screen-reader', '27.56.204.25', '2019-12-10 11:56:10'),
(981, 2, 'piu', '164.100.146.66', '2019-12-10 12:55:52'),
(982, 2, 'organisation-chart', '164.100.146.66', '2019-12-10 12:55:59'),
(983, 2, 'board-of-directors', '164.100.151.233', '2019-12-10 01:14:25'),
(984, 2, 'organisation-chart', '164.100.151.233', '2019-12-10 01:14:41'),
(985, 2, 'piu', '164.100.151.232', '2019-12-10 01:15:36'),
(986, 2, 'tender', '164.100.151.231', '2019-12-10 01:16:31'),
(987, 2, 'photo-gallery', '164.100.151.231', '2019-12-10 01:16:34'),
(988, 2, 'about-us', '164.100.151.231', '2019-12-10 01:16:41'),
(989, 2, 'piu', '164.100.151.231', '2019-12-10 01:20:40'),
(990, 2, 'tender', '164.100.151.232', '2019-12-10 01:22:15'),
(991, 2, 'disclaimer', '27.56.204.25', '2019-12-10 01:23:00'),
(992, 2, 'contact', '27.56.204.25', '2019-12-10 01:23:47'),
(993, 2, 'organisation-chart', '164.100.151.231', '2019-12-10 01:28:20'),
(994, 2, 'piu', '164.100.151.233', '2019-12-10 01:28:33'),
(995, 2, 'video-gallery', '164.100.151.231', '2019-12-10 01:29:19'),
(996, 2, 'important-links', '164.100.151.231', '2019-12-10 01:30:01'),
(997, 2, 'board-of-directors', '164.100.151.231', '2019-12-10 01:43:26'),
(998, 2, 'board-of-directors', '164.100.151.232', '2019-12-10 03:16:19'),
(999, 2, 'video-gallery', '164.100.151.232', '2019-12-10 05:00:35'),
(1000, 1, 'home', '117.228.183.126', '2019-12-10 05:33:35'),
(1001, 1, 'home', '171.60.128.236', '2019-12-10 06:09:09'),
(1002, 2, 'news-details', '171.60.128.236', '2019-12-10 07:21:39'),
(1003, 2, 'events', '171.60.128.236', '2019-12-10 07:28:25'),
(1004, 2, 'whos-who', '171.60.128.236', '2019-12-10 07:37:06'),
(1005, 2, 'tender', '171.60.128.236', '2019-12-10 07:37:35'),
(1006, 2, 'contact', '171.60.128.236', '2019-12-10 07:37:42'),
(1007, 2, 'about-us', '171.60.128.236', '2019-12-10 08:00:29'),
(1008, 2, 'board-of-directors', '171.60.128.236', '2019-12-10 08:08:19'),
(1009, 2, 'organisation-chart', '171.60.128.236', '2019-12-10 08:08:25'),
(1010, 2, 'piu', '171.60.128.236', '2019-12-10 08:08:31'),
(1011, 1, 'home', '122.168.165.47', '2019-12-11 08:06:58'),
(1012, 2, 'news-details', '122.168.165.47', '2019-12-11 08:22:17'),
(1013, 2, 'whos-who', '122.168.165.47', '2019-12-11 08:23:53'),
(1014, 1, 'home', '164.100.151.233', '2019-12-11 10:33:03'),
(1015, 1, 'home', '164.100.151.232', '2019-12-11 10:34:38'),
(1016, 2, 'about-us', '164.100.151.232', '2019-12-11 10:35:46'),
(1017, 1, 'home', '66.102.6.223', '2019-12-11 10:40:15'),
(1018, 1, 'home', '66.102.8.209', '2019-12-11 11:31:19'),
(1019, 2, 'board-of-directors', '164.100.151.231', '2019-12-11 11:31:59'),
(1020, 2, 'whos-who', '164.100.151.231', '2019-12-11 11:32:06'),
(1021, 2, 'events', '164.100.151.231', '2019-12-11 11:32:56'),
(1022, 2, 'tender', '164.100.151.231', '2019-12-11 11:33:00'),
(1023, 2, 'photo-gallery', '164.100.151.231', '2019-12-11 11:33:16'),
(1024, 2, 'photo-gallery-view', '164.100.151.231', '2019-12-11 11:33:31'),
(1025, 2, 'video-gallery', '164.100.151.231', '2019-12-11 11:33:42'),
(1026, 2, 'contact', '164.100.151.233', '2019-12-11 11:35:03'),
(1027, 2, 'about-us', '164.100.151.233', '2019-12-11 11:50:49'),
(1028, 2, 'board-of-directors', '164.100.151.232', '2019-12-11 11:51:28'),
(1029, 2, 'organisation-chart', '164.100.151.233', '2019-12-11 11:51:37'),
(1030, 2, 'piu', '164.100.151.232', '2019-12-11 11:51:45'),
(1031, 2, 'whos-who', '164.100.151.232', '2019-12-11 11:51:55'),
(1032, 2, 'events', '164.100.151.233', '2019-12-11 11:52:15'),
(1033, 2, 'events', '164.100.151.232', '2019-12-11 11:52:21'),
(1034, 2, 'contact', '164.100.151.231', '2019-12-11 11:52:48'),
(1035, 1, 'home', '164.100.151.231', '2019-12-11 11:54:09'),
(1036, 2, 'about-us', '164.100.151.231', '2019-12-11 11:54:16'),
(1037, 2, 'board-of-directors', '164.100.151.233', '2019-12-11 12:43:14'),
(1038, 2, 'piu', '164.100.151.233', '2019-12-11 12:43:26'),
(1039, 2, 'contact', '164.100.151.232', '2019-12-11 12:46:10'),
(1040, 2, 'whos-who', '164.100.151.233', '2019-12-11 12:46:19'),
(1041, 2, 'important-links', '164.100.151.231', '2019-12-11 05:40:13'),
(1042, 2, 'organisation-chart', '164.100.151.232', '2019-12-11 05:42:33'),
(1043, 2, 'tender', '164.100.151.232', '2019-12-11 05:44:00'),
(1044, 2, 'photo-gallery', '164.100.151.232', '2019-12-11 05:44:25'),
(1045, 1, 'home', '164.100.146.66', '2019-12-11 07:28:16'),
(1046, 1, 'home', '117.228.182.213', '2019-12-11 08:36:52'),
(1047, 1, 'home', '117.228.208.31', '2019-12-12 08:09:29'),
(1048, 1, 'home', '164.100.151.232', '2019-12-12 11:05:03'),
(1049, 1, 'home', '164.100.151.233', '2019-12-12 11:05:21'),
(1050, 2, 'whos-who', '164.100.151.232', '2019-12-12 12:33:31'),
(1051, 2, 'whos-who', '52.90.235.182', '2019-12-12 12:38:30'),
(1052, 2, 'events', '164.100.151.232', '2019-12-12 12:39:31'),
(1053, 2, 'events', '164.100.151.231', '2019-12-12 12:39:42'),
(1054, 2, 'events', '164.100.151.233', '2019-12-12 12:41:01'),
(1055, 2, 'events', '164.100.146.66', '2019-12-12 01:09:35'),
(1056, 1, 'home', '164.100.146.66', '2019-12-12 01:09:38'),
(1057, 1, 'home', '49.36.24.250', '2019-12-12 02:00:24'),
(1058, 2, 'tender', '49.36.24.250', '2019-12-12 02:00:54'),
(1059, 2, 'board-of-directors', '49.36.24.250', '2019-12-12 02:01:32'),
(1060, 2, 'photo-gallery', '164.100.151.233', '2019-12-12 02:54:24'),
(1061, 2, 'contact', '49.36.24.250', '2019-12-12 03:10:44'),
(1062, 1, 'home', '3.81.69.184', '2019-12-12 04:16:05'),
(1063, 2, 'contact', '103.113.229.94', '2019-12-12 05:59:00'),
(1064, 2, 'photo-gallery', '103.113.229.94', '2019-12-12 05:59:11'),
(1065, 2, 'video-gallery', '103.113.229.94', '2019-12-12 05:59:40'),
(1066, 1, 'home', '164.100.146.66', '2019-12-13 09:22:04'),
(1067, 1, 'home', '164.100.151.232', '2019-12-13 10:50:12'),
(1068, 2, 'whos-who', '164.100.151.232', '2019-12-13 10:56:40'),
(1069, 2, 'tender', '164.100.151.233', '2019-12-13 10:56:47'),
(1070, 2, 'tender', '164.100.151.232', '2019-12-13 11:02:17'),
(1071, 2, 'tender', '164.100.151.231', '2019-12-13 11:03:13'),
(1072, 2, 'events', '164.100.151.231', '2019-12-13 11:03:16'),
(1073, 2, 'events', '164.100.151.233', '2019-12-13 01:34:07'),
(1074, 1, 'home', '164.100.151.233', '2019-12-13 01:34:16'),
(1075, 1, 'home', '164.100.151.231', '2019-12-13 01:38:25'),
(1076, 2, 'news-details', '164.100.146.66', '2019-12-13 04:34:32'),
(1077, 2, 'events', '164.100.151.232', '2019-12-13 04:49:54'),
(1078, 2, 'tender', '164.100.146.66', '2019-12-13 04:51:22'),
(1079, 2, 'whos-who', '164.100.151.233', '2019-12-13 05:35:01'),
(1080, 2, 'photo-gallery', '164.100.151.231', '2019-12-13 05:39:54'),
(1081, 2, 'photo-gallery-view', '164.100.151.232', '2019-12-13 05:40:07'),
(1082, 1, 'home', '10.125.239.6', '2019-12-16 12:12:07'),
(1083, 1, 'home', '164.100.151.232', '2019-12-16 11:41:36'),
(1084, 2, 'whos-who', '164.100.151.232', '2019-12-16 11:42:37'),
(1085, 2, 'events', '164.100.151.230', '2019-12-16 11:42:48'),
(1086, 2, 'tender', '164.100.151.232', '2019-12-16 11:42:54'),
(1087, 2, 'tender', '164.100.151.230', '2019-12-16 11:42:57'),
(1088, 2, 'photo-gallery', '164.100.151.230', '2019-12-16 11:43:04'),
(1089, 1, 'home', '164.100.151.230', '2019-12-16 11:43:38'),
(1090, 2, 'whos-who', '164.100.151.230', '2019-12-16 12:15:11'),
(1091, 1, 'home', '164.100.146.66', '2019-12-16 02:11:30'),
(1092, 1, 'home', '164.100.151.234', '2019-12-16 02:50:16'),
(1093, 1, 'home', '164.100.151.233', '2019-12-16 03:46:37'),
(1094, 2, 'events', '49.36.28.218', '2019-12-16 04:20:50'),
(1095, 2, 'about-us', '49.36.28.218', '2019-12-16 04:21:41'),
(1096, 1, 'home', '49.36.28.218', '2019-12-16 04:21:52'),
(1097, 2, 'whos-who', '49.36.28.218', '2019-12-16 04:23:06'),
(1098, 2, 'tender', '49.36.28.218', '2019-12-16 04:23:10'),
(1099, 2, 'photo-gallery', '49.36.28.218', '2019-12-16 04:23:14'),
(1100, 2, 'contact', '49.36.28.218', '2019-12-16 04:23:17'),
(1101, 1, 'home', '164.100.146.66', '2019-12-17 02:47:09'),
(1102, 2, 'tender', '164.100.146.66', '2019-12-17 02:47:15'),
(1103, 1, 'home', '164.100.146.66', '2019-12-18 11:08:50'),
(1104, 1, 'home', '164.100.151.235', '2019-12-18 11:18:54'),
(1105, 2, 'whos-who', '164.100.151.233', '2019-12-18 11:19:02'),
(1106, 1, 'home', '164.100.151.234', '2019-12-18 11:57:31'),
(1107, 2, 'photo-gallery', '164.100.146.66', '2019-12-18 12:25:00'),
(1108, 2, 'whos-who', '164.100.146.66', '2019-12-18 12:44:09'),
(1109, 2, 'whos-who', '164.100.151.235', '2019-12-18 01:04:54'),
(1110, 2, 'whos-who', '164.100.151.234', '2019-12-18 01:05:01'),
(1111, 1, 'home', '164.100.146.66', '2019-12-19 10:38:59'),
(1112, 1, 'home', '164.100.146.66', '2019-12-20 01:12:18'),
(1113, 1, 'home', '164.100.146.66', '2019-12-24 10:37:55'),
(1114, 2, 'events', '164.100.146.66', '2019-12-24 03:43:21'),
(1115, 2, 'project', '164.100.146.66', '2019-12-24 06:08:25'),
(1116, 2, 'project-view', '164.100.146.66', '2019-12-24 06:08:57'),
(1117, 1, 'home', '164.100.151.234', '2019-12-26 10:25:28'),
(1118, 1, 'home', '164.100.151.235', '2019-12-26 10:25:49'),
(1119, 2, 'tender', '164.100.151.234', '2019-12-26 10:25:55'),
(1120, 2, 'events', '164.100.151.234', '2019-12-26 10:25:58'),
(1121, 2, 'photo-gallery', '164.100.151.234', '2019-12-26 10:26:02'),
(1122, 2, 'photo-gallery-view', '164.100.151.234', '2019-12-26 10:26:12'),
(1123, 2, 'video-gallery', '164.100.151.234', '2019-12-26 10:26:49'),
(1124, 1, 'home', '164.100.151.234', '2019-12-27 02:14:09'),
(1125, 1, 'home', '64.233.172.47', '2019-12-27 04:03:30'),
(1126, 1, 'home', '164.100.146.66', '2019-12-27 04:25:56'),
(1127, 1, 'home', '164.100.146.66', '2019-12-30 11:55:15'),
(1128, 2, 'events', '164.100.146.66', '2019-12-30 11:55:18'),
(1129, 2, 'project', '164.100.146.66', '2019-12-30 11:55:31'),
(1130, 2, 'project-view', '164.100.146.66', '2019-12-30 11:55:35'),
(1131, 1, 'home', '164.100.146.66', '2019-12-31 05:51:37'),
(1132, 2, 'whos-who', '164.100.146.66', '2019-12-31 05:51:41'),
(1133, 1, 'home', '164.100.146.66', '2020-01-02 10:55:16'),
(1134, 1, 'home', '164.100.146.66', '2020-01-03 11:11:59'),
(1135, 1, 'home', '164.100.146.66', '2020-01-04 06:39:28'),
(1136, 1, 'home', '164.100.146.66', '2020-01-06 10:52:49'),
(1137, 2, 'financereport', '164.100.146.66', '2020-01-06 06:06:30'),
(1138, 1, 'home', '164.100.146.66', '2020-01-16 11:50:30'),
(1139, 1, 'home', '164.100.146.66', '2020-02-10 11:02:13'),
(1140, 1, 'home', '164.100.146.66', '2020-02-17 11:23:01'),
(1141, 1, 'home', '164.100.151.234', '2020-02-24 05:03:46'),
(1142, 2, 'events', '164.100.151.233', '2020-03-02 11:34:43'),
(1143, 1, 'home', '164.100.146.66', '2020-03-04 03:28:46'),
(1144, 1, 'home', '::1', '2020-09-08 12:49:42'),
(1145, 2, 'contact', '::1', '2020-09-08 04:34:19'),
(1146, 2, 'whos-who', '::1', '2020-09-08 04:35:09'),
(1147, 2, 'about-us', '::1', '2020-09-08 04:36:59'),
(1148, 1, 'home', '::1', '2020-09-09 11:15:07'),
(1149, 2, 'board-of-directors', '::1', '2020-09-09 11:24:47'),
(1150, 2, 'photo-gallery', '::1', '2020-09-09 11:58:46'),
(1151, 2, 'project', '::1', '2020-09-09 12:26:20'),
(1152, 1, 'home', '::1', '2020-09-11 12:08:56'),
(1153, 2, 'privacy-policy', '::1', '2020-09-11 12:12:08'),
(1154, 2, 'test', '::1', '2020-09-11 02:24:54'),
(1155, 1, 'home', '::1', '2020-09-14 12:11:12'),
(1156, 2, 'test', '::1', '2020-09-14 12:11:17'),
(1157, 2, 'video-gallery', '::1', '2020-09-14 12:28:33'),
(1158, 2, 'whos-who', '::1', '2020-09-14 02:03:16'),
(1159, 2, 'tender', '::1', '2020-09-14 02:31:35'),
(1160, 2, 'administration', '::1', '2020-09-14 02:31:36'),
(1161, 2, 'feedback', '::1', '2020-09-14 02:31:37'),
(1162, 2, 'introduction', '::1', '2020-09-14 02:50:55'),
(1163, 2, 'welcome-home', '::1', '2020-09-14 02:50:58'),
(1164, 2, 'about-us', '::1', '2020-09-14 02:52:18'),
(1165, 2, 'contact', '::1', '2020-09-14 03:02:11'),
(1166, 2, 'project', '::1', '2020-09-14 03:58:01'),
(1167, 2, 'project-view', '::1', '2020-09-14 03:58:05'),
(1168, 1, 'home', '::1', '2020-09-15 11:41:12'),
(1169, 2, 'publication', '::1', '2020-09-15 11:45:28'),
(1170, 2, 'news-details', '::1', '2020-09-15 12:24:39'),
(1171, 2, 'feedback', '::1', '2020-09-15 12:24:41'),
(1172, 2, 'contact', '::1', '2020-09-15 12:24:45'),
(1173, 2, 'welcome-home', '::1', '2020-09-15 12:59:40'),
(1174, 2, 'announcement', '::1', '2020-09-15 03:42:36'),
(1175, 2, 'circular', '::1', '2020-09-15 03:50:37'),
(1176, 2, 'introduction', '::1', '2020-09-15 04:33:17'),
(1177, 2, 'visionmission', '::1', '2020-09-15 04:37:22'),
(1178, 2, 'photo-gallery', '::1', '2020-09-15 04:42:58'),
(1179, 2, 'administration', '::1', '2020-09-15 04:43:03'),
(1180, 1, 'home', '::1', '2020-09-16 12:48:47'),
(1181, 2, 'introduction', '::1', '2020-09-16 12:51:23'),
(1182, 2, 'history', '::1', '2020-09-16 12:51:25'),
(1183, 2, 'visionmission', '::1', '2020-09-16 12:51:26'),
(1184, 2, 'project-view', '::1', '2020-09-16 04:57:11'),
(1185, 1, 'home', '::1', '2020-09-17 11:13:41'),
(1186, 2, 'screen-reader', '::1', '2020-09-17 11:25:46'),
(1187, 2, 'about-us', '::1', '2020-09-17 11:46:14'),
(1188, 2, 'news-details', '::1', '2020-09-17 11:49:29'),
(1189, 2, 'feedback', '::1', '2020-09-17 11:49:31'),
(1190, 2, 'administration', '::1', '2020-09-17 11:55:57'),
(1191, 2, 'contact', '::1', '2020-09-17 12:59:28'),
(1192, 2, 'events', '::1', '2020-09-17 03:18:12'),
(1193, 2, 'project-view', '::1', '2020-09-17 03:28:15'),
(1194, 2, 'project', '::1', '2020-09-17 03:28:27'),
(1195, 1, 'home', '::1', '2020-09-18 11:43:34'),
(1196, 2, 'events', '::1', '2020-09-18 11:48:13'),
(1197, 2, 'project', '::1', '2020-09-18 11:48:52'),
(1198, 2, 'circular', '::1', '2020-09-18 11:50:08'),
(1199, 2, 'publication', '::1', '2020-09-18 11:50:20'),
(1200, 2, 'introduction', '::1', '2020-09-18 12:07:23'),
(1201, 2, 'history', '::1', '2020-09-18 12:13:07'),
(1202, 2, 'visionmission', '::1', '2020-09-18 12:14:29'),
(1203, 2, 'library', '::1', '2020-09-18 12:27:30'),
(1204, 2, 'career', '::1', '2020-09-18 12:36:31'),
(1205, 2, 'contact', '::1', '2020-09-18 12:38:32'),
(1206, 2, 'contact-us', '::1', '2020-09-18 12:57:05'),
(1207, 2, 'feedback', '::1', '2020-09-18 01:18:52'),
(1208, 2, 'news-details', '::1', '2020-09-18 01:19:15'),
(1209, 2, 'administration', '::1', '2020-09-18 01:38:24'),
(1210, 2, 'video-gallery', '::1', '2020-09-18 02:56:06'),
(1211, 2, 'photo-gallery', '::1', '2020-09-18 03:07:54'),
(1212, 2, 'photo-gallery-view', '::1', '2020-09-18 03:08:00'),
(1213, 2, 'policy', '::1', '2020-09-18 03:26:40'),
(1214, 2, 'planning', '::1', '2020-09-18 03:29:31'),
(1215, 2, 'research', '::1', '2020-09-18 03:50:37'),
(1216, 2, 'project-view', '::1', '2020-09-18 03:53:23'),
(1217, 2, 'consultancy', '::1', '2020-09-18 04:09:46'),
(1218, 2, 'education', '::1', '2020-09-18 04:15:18'),
(1219, 2, 'climate-change', '::1', '2020-09-18 04:18:41'),
(1220, 2, 'terms-of-use', '::1', '2020-09-18 04:31:24'),
(1221, 2, 'privacy-policy', '::1', '2020-09-18 04:40:23'),
(1222, 1, 'home', '::1', '2020-09-21 11:10:39'),
(1223, 2, 'publication', '::1', '2020-09-21 12:01:51'),
(1224, 2, 'project', '::1', '2020-09-21 12:16:17'),
(1225, 2, 'planning', '::1', '2020-09-21 12:16:21'),
(1226, 2, 'research', '::1', '2020-09-21 12:36:00'),
(1227, 2, 'about-us', '::1', '2020-09-21 12:39:39'),
(1228, 2, 'introduction', '::1', '2020-09-21 12:39:41'),
(1229, 2, 'video-gallery', '::1', '2020-09-21 12:39:55'),
(1230, 2, 'photo-gallery', '::1', '2020-09-21 12:39:57'),
(1231, 2, 'photo-gallery-view', '::1', '2020-09-21 12:40:02'),
(1232, 2, 'education', '::1', '2020-09-21 04:01:18'),
(1233, 2, 'feedback', '::1', '2020-09-21 04:32:37'),
(1234, 2, 'contact-us', '::1', '2020-09-21 04:32:40'),
(1235, 2, 'career', '::1', '2020-09-21 04:32:40'),
(1236, 2, 'news-details', '::1', '2020-09-21 04:32:46'),
(1237, 2, 'circular', '::1', '2020-09-21 05:14:36'),
(1238, 1, 'home', '::1', '2020-09-22 11:16:22'),
(1239, 2, 'circular', '::1', '2020-09-22 11:22:13'),
(1240, 2, 'news-details', '::1', '2020-09-22 11:22:25'),
(1241, 2, 'introduction', '::1', '2020-09-22 11:24:04'),
(1242, 2, 'history', '::1', '2020-09-22 11:24:06'),
(1243, 2, 'visionmission', '::1', '2020-09-22 11:24:07'),
(1244, 2, 'library', '::1', '2020-09-22 11:26:46'),
(1245, 2, 'publication', '::1', '2020-09-22 11:26:48'),
(1246, 2, 'video-gallery', '::1', '2020-09-22 11:26:52'),
(1247, 2, 'photo-gallery', '::1', '2020-09-22 11:26:54'),
(1248, 2, 'contact-us', '::1', '2020-09-22 11:27:02'),
(1249, 2, 'career', '::1', '2020-09-22 11:27:04'),
(1250, 2, 'feedback', '::1', '2020-09-22 11:41:52'),
(1251, 2, 'screen-reader', '::1', '2020-09-22 11:47:48'),
(1252, 2, 'project', '::1', '2020-09-22 11:52:04'),
(1253, 2, 'project-view', '::1', '2020-09-22 11:52:06'),
(1254, 2, 'photo-gallery-view', '::1', '2020-09-22 12:15:56'),
(1255, 2, 'policy', '::1', '2020-09-22 01:42:47'),
(1256, 2, 'events', '::1', '2020-09-22 01:44:10'),
(1257, 2, 'education', '::1', '2020-09-22 01:49:01'),
(1258, 2, 'about-us', '::1', '2020-09-22 02:38:46'),
(1259, 1, 'home', '::1', '2020-09-23 11:08:19'),
(1260, 2, 'history', '::1', '2020-09-23 11:12:39'),
(1261, 2, 'visionmission', '::1', '2020-09-23 11:12:41'),
(1262, 2, 'introduction', '::1', '2020-09-23 11:12:44'),
(1263, 2, 'policy', '::1', '2020-09-23 01:05:19'),
(1264, 2, 'project', '::1', '2020-09-23 01:22:59'),
(1265, 2, 'news-details', '::1', '2020-09-23 02:44:06'),
(1266, 2, 'green-building', '::1', '2020-09-23 03:58:29'),
(1267, 2, 'announcement', '::1', '2020-09-23 03:58:31'),
(1268, 2, 'planning', '::1', '2020-09-23 04:02:00'),
(1269, 2, 'education', '::1', '2020-09-23 04:02:01'),
(1270, 2, 'climate-change', '::1', '2020-09-23 04:02:02'),
(1271, 2, 'research', '::1', '2020-09-23 04:02:03'),
(1272, 2, 'consultancy', '::1', '2020-09-23 04:02:03'),
(1273, 2, 'publication', '::1', '2020-09-23 04:02:20'),
(1274, 2, 'video-gallery', '::1', '2020-09-23 04:02:26'),
(1275, 2, 'photo-gallery', '::1', '2020-09-23 04:02:28'),
(1276, 2, 'feedback', '::1', '2020-09-23 04:03:08'),
(1277, 2, 'career', '::1', '2020-09-23 04:03:11'),
(1278, 2, 'administration', '::1', '2020-09-23 04:03:17'),
(1279, 2, 'about-us', '::1', '2020-09-23 04:17:43'),
(1280, 2, 'project-view', '::1', '2020-09-23 04:35:32'),
(1281, 2, 'contact-us', '::1', '2020-09-23 04:37:31'),
(1282, 2, 'environmental-policy', '::1', '2020-09-23 05:15:08'),
(1283, 2, 'about-neac', '::1', '2020-09-23 05:15:08'),
(1284, 2, 'circular', '::1', '2020-09-23 05:32:17'),
(1285, 1, 'home', '::1', '2020-09-24 11:08:17'),
(1286, 2, 'planning', '::1', '2020-09-24 11:16:23'),
(1287, 2, 'introduction', '::1', '2020-09-24 11:16:32'),
(1288, 2, 'about-us', '::1', '2020-09-24 11:16:33'),
(1289, 2, 'publication', '::1', '2020-09-24 11:16:36'),
(1290, 2, 'photo-gallery', '::1', '2020-09-24 11:16:37'),
(1291, 2, 'news-details', '::1', '2020-09-24 11:16:39'),
(1292, 2, 'project', '::1', '2020-09-24 11:16:43'),
(1293, 2, 'project-view', '::1', '2020-09-24 11:16:47'),
(1294, 2, 'circular', '::1', '2020-09-24 11:45:08'),
(1295, 2, 'contact-us', '::1', '2020-09-24 11:45:09'),
(1296, 2, 'career', '::1', '2020-09-24 11:45:09'),
(1297, 2, 'screen-reader', '::1', '2020-09-24 11:45:44'),
(1298, 2, 'history', '::1', '2020-09-24 11:46:09'),
(1299, 2, 'feedback', '::1', '2020-09-24 11:46:15'),
(1300, 2, 'visionmission', '::1', '2020-09-24 11:54:17'),
(1301, 2, 'photo-gallery-view', '::1', '2020-09-24 12:07:06'),
(1302, 2, 'policy', '::1', '2020-09-24 12:10:47'),
(1303, 2, 'environmental-policy', '::1', '2020-09-24 12:10:55'),
(1304, 2, 'about-neac', '::1', '2020-09-24 12:10:56'),
(1305, 2, 'general-awareness-campaign', '::1', '2020-09-24 12:10:57'),
(1306, 2, 'pachmarhi-biosphere-reservecamp', '::1', '2020-09-24 12:10:57'),
(1307, 2, 'important-environmental-days', '::1', '2020-09-24 12:11:52'),
(1308, 2, 'training-awareness-programmes', '::1', '2020-09-24 12:22:05'),
(1309, 2, 'library', '::1', '2020-09-24 12:23:42'),
(1310, 2, 'fellowship-awards', '::1', '2020-09-24 12:35:58'),
(1311, 2, 'video-gallery', '::1', '2020-09-24 12:49:30'),
(1312, 2, 'research', '::1', '2020-09-24 12:52:17'),
(1313, 2, 'achanakmar-amarkantak-bio-reserves', '::1', '2020-09-24 12:52:22'),
(1314, 2, 'conservation-management-of-water-bodies', '::1', '2020-09-24 12:52:23'),
(1315, 2, 'biosphere-reserves', '::1', '2020-09-24 12:52:23'),
(1316, 2, 'management-aspects', '::1', '2020-09-24 12:52:24'),
(1317, 2, 'pachmarhi-bio-reserves', '::1', '2020-09-24 12:52:24'),
(1318, 2, 'panna-bio-reserves', '::1', '2020-09-24 12:52:25'),
(1319, 1, 'home', '::1', '2020-09-25 10:52:36'),
(1320, 2, 'project', '::1', '2020-09-25 11:15:40'),
(1321, 2, 'policy', '::1', '2020-09-25 11:32:02'),
(1322, 2, 'circular', '::1', '2020-09-25 11:36:23'),
(1323, 2, 'history', '::1', '2020-09-25 11:38:12'),
(1324, 2, 'contact-us', '::1', '2020-09-25 11:39:17'),
(1325, 2, 'career', '::1', '2020-09-25 11:39:27'),
(1326, 2, 'news-details', '::1', '2020-09-25 11:39:33'),
(1327, 2, 'visionmission', '::1', '2020-09-25 11:39:39'),
(1328, 2, 'introduction', '::1', '2020-09-25 11:39:40'),
(1329, 2, 'environmental-research-laboratory', '::1', '2020-09-25 11:40:36'),
(1330, 2, 'photo-gallery', '::1', '2020-09-25 11:40:52'),
(1331, 2, 'green-building', '::1', '2020-09-25 11:41:36'),
(1332, 2, 'project-management-consultancy', '::1', '2020-09-25 11:43:54'),
(1333, 2, 'projects-outcomes', '::1', '2020-09-25 11:46:22'),
(1334, 2, 'privacy-policy', '::1', '2020-09-25 11:53:07'),
(1335, 2, 'planning', '::1', '2020-09-25 12:02:26'),
(1336, 2, 'education', '::1', '2020-09-25 12:02:40'),
(1337, 2, 'about-neac', '::1', '2020-09-25 12:02:55'),
(1338, 2, 'important-environmental-days', '::1', '2020-09-25 12:02:55'),
(1339, 2, 'environmental-policy', '::1', '2020-09-25 12:02:56'),
(1340, 2, 'library', '::1', '2020-09-25 12:10:03'),
(1341, 2, 'about-us', '::1', '2020-09-25 12:15:23'),
(1342, 2, 'administration', '::1', '2020-09-25 12:15:28'),
(1343, 2, 'publication', '::1', '2020-09-25 12:16:28'),
(1344, 2, 'video-gallery', '::1', '2020-09-25 12:17:22'),
(1345, 2, 'achanakmar-amarkantak-bio-reserves', '::1', '2020-09-25 12:21:29'),
(1346, 2, 'general-awareness-campaign', '::1', '2020-09-25 12:29:44'),
(1347, 2, 'feedback', '::1', '2020-09-25 01:16:59'),
(1348, 2, 'project-view', '::1', '2020-09-25 02:07:53'),
(1349, 2, 'hyperlink-policy', '::1', '2020-09-25 02:09:42'),
(1350, 2, 'training-awareness-programmes', '::1', '2020-09-25 02:16:13'),
(1351, 2, 'fellowship-awards', '::1', '2020-09-25 02:16:41'),
(1352, 2, 'national-green-corps', '::1', '2020-09-25 02:16:42'),
(1353, 2, 'climate-change', '::1', '2020-09-25 02:16:51'),
(1354, 2, 'consultancy', '::1', '2020-09-25 02:17:14'),
(1355, 2, 'consultants-architectural', '::1', '2020-09-25 02:43:54'),
(1356, 2, 'services', '::1', '2020-09-25 02:43:55'),
(1357, 2, 'photo-gallery-view', '::1', '2020-09-25 02:47:16'),
(1358, 2, 'terms-of-use', '::1', '2020-09-25 02:50:45'),
(1359, 2, 'sitemap', '::1', '2020-09-25 02:50:50'),
(1360, 2, 'conservation-management-of-water-bodies', '::1', '2020-09-25 04:03:19'),
(1361, 2, 'pachmarhi-biosphere-reservecamp', '::1', '2020-09-25 04:05:22'),
(1362, 2, 'biosphere-reserves', '::1', '2020-09-25 04:06:04'),
(1363, 2, 'management-aspects', '::1', '2020-09-25 04:06:05'),
(1364, 2, 'panna-bio-reserves', '::1', '2020-09-25 04:06:05'),
(1365, 2, 'research', '::1', '2020-09-25 04:06:49'),
(1366, 2, 'ongoing-projects', '::1', '2020-09-25 05:06:10'),
(1367, 2, 'architectural', '::1', '2020-09-25 05:06:11'),
(1368, 2, 'special-consultancy-assign-simhasta-2004', '::1', '2020-09-25 05:06:12'),
(1369, 2, 'eco-city', '::1', '2020-09-25 05:06:14'),
(1370, 2, 'national-lake-conservation-project-nlcp', '::1', '2020-09-25 05:09:14'),
(1371, 2, 'department-for-international-development-dfid', '::1', '2020-09-25 05:14:57'),
(1372, 2, 'district-poverty-initiatives-project-sponsored-by-', '::1', '2020-09-25 05:14:58'),
(1373, 1, 'home', '::1', '2020-09-26 11:05:55'),
(1374, 2, 'career', '::1', '2020-09-26 11:06:51'),
(1375, 2, 'contact-us', '::1', '2020-09-26 11:23:13'),
(1376, 2, 'administration', '::1', '2020-09-26 11:24:18'),
(1377, 2, 'about-us', '::1', '2020-09-26 11:24:54'),
(1378, 2, 'history', '::1', '2020-09-26 11:24:57'),
(1379, 2, 'services', '::1', '2020-09-26 11:29:56'),
(1380, 2, 'department-for-international-development-dfid', '::1', '2020-09-26 11:29:59'),
(1381, 2, 'district-poverty-initiatives-project-sponsored-by-', '::1', '2020-09-26 11:29:59'),
(1382, 2, 'ongoing-projects', '::1', '2020-09-26 11:30:02'),
(1383, 2, 'environmental-research-laboratory', '::1', '2020-09-26 11:30:18'),
(1384, 2, 'biosphere-reserves', '::1', '2020-09-26 11:30:20'),
(1385, 2, 'architectural', '::1', '2020-09-26 11:30:21'),
(1386, 2, 'national-lake-conservation-project-nlcp', '::1', '2020-09-26 11:30:21'),
(1387, 2, 'district-poverty-initiatives-project-sponsored-by-', '::1', '2020-09-26 11:30:23'),
(1388, 2, 'project', '::1', '2020-09-26 11:30:26'),
(1389, 2, 'circular', '::1', '2020-09-26 11:58:48'),
(1390, 2, 'consultancy', '::1', '2020-09-26 12:04:02'),
(1391, 2, 'library', '::1', '2020-09-26 12:07:16'),
(1392, 2, 'publication', '::1', '2020-09-26 12:07:20'),
(1393, 2, 'photo-gallery', '::1', '2020-09-26 12:07:23'),
(1394, 2, 'news-details', '::1', '2020-09-26 12:07:25'),
(1395, 2, 'introduction', '::1', '2020-09-26 12:11:26'),
(1396, 2, 'visionmission', '::1', '2020-09-26 12:23:20'),
(1397, 2, 'feedback', '::1', '2020-09-26 03:27:50'),
(1398, 2, 'whos-who', '::1', '2020-09-26 04:00:47'),
(1399, 1, 'home', '::1', '2020-09-28 11:14:19'),
(1400, 2, 'policy', '::1', '2020-09-28 01:02:43'),
(1401, 2, 'consultants-architectural', '::1', '2020-09-28 01:02:46'),
(1402, 2, 'services', '::1', '2020-09-28 01:02:52'),
(1403, 2, 'pachmarhi-biosphere-reservecamp', '::1', '2020-09-28 01:05:29'),
(1404, 2, 'feedback', '::1', '2020-09-28 01:07:26'),
(1405, 2, 'national-green-corps', '::1', '2020-09-28 01:10:12'),
(1406, 2, 'district-poverty-initiatives-project-sponsored-by-', '::1', '2020-09-28 01:10:15'),
(1407, 2, 'department-for-international-development-dfid', '::1', '2020-09-28 01:10:16'),
(1408, 1, 'home', '::1', '2020-09-30 11:30:34'),
(1409, 2, 'circular', '::1', '2020-09-30 04:03:52'),
(1410, 2, 'about-us', '::1', '2020-09-30 04:03:55'),
(1411, 2, 'whos-who', '::1', '2020-09-30 04:03:58'),
(1412, 2, 'introduction', '::1', '2020-09-30 04:04:10'),
(1413, 2, 'feedback', '::1', '2020-09-30 04:04:20'),
(1414, 2, 'library', '::1', '2020-09-30 04:13:41'),
(1415, 2, 'project', '::1', '2020-09-30 05:01:04'),
(1416, 2, 'consultancy', '::1', '2020-09-30 05:11:51'),
(1417, 2, 'history', '::1', '2020-09-30 05:20:07'),
(1418, 2, 'services', '::1', '2020-09-30 05:20:20'),
(1419, 2, 'consultants-architectural', '::1', '2020-09-30 05:20:21'),
(1420, 2, 'visionmission', '::1', '2020-09-30 05:20:35'),
(1421, 2, 'administration', '::1', '2020-09-30 05:20:40'),
(1422, 2, 'conservation-management-of-water-bodies', '::1', '2020-09-30 05:21:01'),
(1423, 1, 'home', '::1', '2020-10-01 10:57:22'),
(1424, 2, 'introduction', '::1', '2020-10-01 10:57:26'),
(1425, 2, 'project', '::1', '2020-10-01 10:57:32'),
(1426, 2, 'conservation-management-of-water-bodies', '::1', '2020-10-01 10:57:36'),
(1427, 2, 'about-us', '::1', '2020-10-01 11:16:54'),
(1428, 2, 'history', '::1', '2020-10-01 11:16:59'),
(1429, 2, 'visionmission', '::1', '2020-10-01 11:17:02'),
(1430, 2, 'whos-who', '::1', '2020-10-01 11:17:04'),
(1431, 2, 'library', '::1', '2020-10-01 11:22:04'),
(1432, 2, 'publication', '::1', '2020-10-01 11:22:12'),
(1433, 2, 'video-gallery', '::1', '2020-10-01 11:25:43'),
(1434, 2, 'photo-gallery', '::1', '2020-10-01 11:29:46'),
(1435, 2, 'photo-gallery-view', '::1', '2020-10-01 11:33:56'),
(1436, 2, 'project-management-consultancy', '::1', '2020-10-01 11:40:57'),
(1437, 2, 'news-details', '::1', '2020-10-01 11:41:04'),
(1438, 2, 'feedback', '::1', '2020-10-01 11:50:43'),
(1439, 2, 'circular', '::1', '2020-10-01 12:13:10'),
(1440, 2, 'contact-us', '::1', '2020-10-01 12:20:34'),
(1441, 2, 'career', '::1', '2020-10-01 12:31:19'),
(1442, 2, 'consultants-architectural', '::1', '2020-10-01 12:33:05'),
(1443, 2, 'services', '::1', '2020-10-01 12:33:06'),
(1444, 2, 'project-view', '::1', '2020-10-01 12:36:43'),
(1445, 2, 'training-awareness-programmes', '::1', '2020-10-01 12:51:07'),
(1446, 2, 'consultancy', '::1', '2020-10-01 12:51:11'),
(1447, 2, 'fellowship-awards', '::1', '2020-10-01 12:51:21'),
(1448, 2, 'terms-of-use', '::1', '2020-10-01 12:51:26'),
(1449, 2, 'planning', '::1', '2020-10-01 12:53:22'),
(1450, 2, 'sitemap', '::1', '2020-10-01 12:53:47'),
(1451, 2, 'administration', '::1', '2020-10-01 02:35:33'),
(1452, 2, 'policy', '::1', '2020-10-01 03:25:40'),
(1453, 2, 'national-green-corps', '::1', '2020-10-01 03:50:52'),
(1454, 2, 'about-neac', '::1', '2020-10-01 03:53:42'),
(1455, 2, 'management-aspects', '::1', '2020-10-01 04:04:42'),
(1456, 2, 'international', '::1', '2020-10-01 04:08:45'),
(1457, 2, 'ongoing-projects', '::1', '2020-10-01 04:09:07'),
(1458, 2, 'events', '::1', '2020-10-01 04:11:04'),
(1459, 2, 'testimonial', '::1', '2020-10-01 04:20:12'),
(1460, 1, 'home', '::1', '2020-10-03 11:46:01'),
(1461, 2, 'testimonial', '::1', '2020-10-03 11:52:07'),
(1462, 2, 'project', '::1', '2020-10-03 11:52:11'),
(1463, 2, 'project-view', '::1', '2020-10-03 11:52:13'),
(1464, 2, 'conservation-management-of-water-bodies', '::1', '2020-10-03 11:52:25'),
(1465, 2, 'biosphere-reserves', '::1', '2020-10-03 11:52:28'),
(1466, 2, 'photo-gallery-view', '::1', '2020-10-03 12:05:01'),
(1467, 2, 'important-environmental-days', '::1', '2020-10-03 12:05:25'),
(1468, 2, 'national-green-corps', '::1', '2020-10-03 12:05:35'),
(1469, 2, 'fellowship-awards', '::1', '2020-10-03 12:05:36'),
(1470, 2, 'environmental-research-laboratory', '::1', '2020-10-03 12:05:42'),
(1471, 2, 'services', '::1', '2020-10-03 12:05:56'),
(1472, 2, 'circular', '::1', '2020-10-03 12:09:14'),
(1473, 2, 'career', '::1', '2020-10-03 12:09:17'),
(1474, 2, 'history', '::1', '2020-10-03 12:09:18'),
(1475, 2, 'administration', '::1', '2020-10-03 12:09:19'),
(1476, 2, 'whos-who', '::1', '2020-10-03 12:09:21'),
(1477, 2, 'general-awareness-campaign', '::1', '2020-10-03 12:09:29'),
(1478, 2, 'publication', '::1', '2020-10-03 12:09:51'),
(1479, 2, 'international', '::1', '2020-10-03 12:09:59'),
(1480, 2, 'special-consultancy-assign-simhasta-2004', '::1', '2020-10-03 12:11:10'),
(1481, 2, 'contact-us', '::1', '2020-10-03 12:11:23'),
(1482, 2, 'feedback', '::1', '2020-10-03 12:11:26'),
(1483, 2, 'news-details', '::1', '2020-10-03 12:11:27'),
(1484, 2, 'research', '::1', '2020-10-03 12:19:48'),
(1485, 2, 'consultancy', '::1', '2020-10-03 12:19:53'),
(1486, 2, 'policy', '::1', '2020-10-03 12:20:01'),
(1487, 2, 'planning', '::1', '2020-10-03 12:20:03'),
(1488, 2, 'education', '::1', '2020-10-03 12:20:05'),
(1489, 2, 'library', '::1', '2020-10-03 12:28:33'),
(1490, 2, 'introduction', '::1', '2020-10-03 12:28:34'),
(1491, 2, 'visionmission', '::1', '2020-10-03 12:28:37'),
(1492, 2, 'photo-gallery', '::1', '2020-10-03 12:28:40'),
(1493, 2, 'video-gallery', '::1', '2020-10-03 12:28:43'),
(1494, 2, 'eco-city', '::1', '2020-10-03 12:30:04'),
(1495, 2, 'ongoing-projects', '::1', '2020-10-03 12:30:05'),
(1496, 2, 'training-awareness-programmes', '::1', '2020-10-03 12:47:13'),
(1497, 2, 'about-neac', '::1', '2020-10-03 12:52:56'),
(1498, 2, 'pachmarhi-bio-reserves', '::1', '2020-10-03 01:13:59'),
(1499, 2, 'about-us', '::1', '2020-10-03 01:26:21'),
(1500, 2, 'environmental-policy', '::1', '2020-10-03 01:42:41'),
(1501, 2, 'pachmarhi-biosphere-reservecamp', '::1', '2020-10-03 01:42:43'),
(1502, 2, 'hyperlink-policy', '::1', '2020-10-03 01:59:23'),
(1503, 2, 'sitemap', '::1', '2020-10-03 01:59:31'),
(1504, 2, 'events', '::1', '2020-10-03 02:08:37'),
(1505, 2, 'national-lake-conservation-project-nlcp', '::1', '2020-10-03 02:17:06'),
(1506, 1, 'home', '::1', '2020-10-09 05:16:48'),
(1507, 1, 'home', '::1', '2020-11-03 11:59:58'),
(1508, 2, 'contact-us', '::1', '2020-11-03 12:56:36'),
(1509, 1, 'home', '::1', '2021-01-06 01:02:59'),
(1510, 1, 'home', '::1', '2021-01-07 02:57:51'),
(1511, 2, 'project', '::1', '2021-01-07 04:41:28'),
(1512, 2, 'project-view', '::1', '2021-01-07 04:42:03'),
(1513, 2, 'events', '::1', '2021-01-07 04:47:25'),
(1514, 2, 'photo-gallery', '::1', '2021-01-07 05:21:47'),
(1515, 2, 'photo-gallery-view', '::1', '2021-01-07 05:21:48'),
(1516, 2, 'project', '::1', '2021-01-08 11:03:55'),
(1517, 1, 'home', '::1', '2021-01-08 11:56:18'),
(1518, 2, 'events', '::1', '2021-01-08 12:41:42'),
(1519, 2, 'news-details', '::1', '2021-01-08 12:53:14'),
(1520, 2, 'about-us', '::1', '2021-01-08 12:55:41'),
(1521, 2, 'photo-gallery', '::1', '2021-01-08 01:03:55'),
(1522, 2, 'photo-gallery-view', '::1', '2021-01-08 01:03:56'),
(1523, 2, 'project-view', '::1', '2021-01-08 01:08:06'),
(1524, 1, 'home', '::1', '2021-01-15 11:57:43'),
(1525, 1, 'home', '::1', '2021-01-23 04:26:58'),
(1526, 1, 'home', '::1', '2021-01-25 11:07:38'),
(1527, 2, 'events', '::1', '2021-01-25 11:26:22'),
(1528, 2, 'news-details', '::1', '2021-01-25 12:00:06'),
(1529, 2, 'project', '::1', '2021-01-25 12:10:17'),
(1530, 2, 'project-view', '::1', '2021-01-25 12:11:45'),
(1531, 2, 'policy', '::1', '2021-01-25 02:49:26'),
(1532, 2, 'introduction', '::1', '2021-01-25 03:07:02'),
(1533, 2, 'history', '::1', '2021-01-25 03:07:05'),
(1534, 2, 'visionmission', '::1', '2021-01-25 03:07:07'),
(1535, 2, 'circular', '::1', '2021-01-25 03:12:17'),
(1536, 2, 'policy', '::1', '2021-01-27 12:58:50'),
(1537, 2, 'project', '::1', '2021-01-27 12:58:52'),
(1538, 1, 'home', '::1', '2021-01-27 12:58:55'),
(1539, 2, 'project-view', '::1', '2021-01-27 12:59:01'),
(1540, 2, 'about-us', '::1', '2021-01-27 12:59:23'),
(1541, 2, 'biosphere-reserves', '::1', '2021-01-27 12:59:27'),
(1542, 2, 'publication', '::1', '2021-01-27 12:59:40'),
(1543, 1, 'home', '::1', '2021-01-29 01:12:42'),
(1544, 1, 'home', '::1', '2021-02-02 11:20:05'),
(1545, 2, 'publication', '::1', '2021-02-02 11:20:08'),
(1546, 2, 'policy', '::1', '2021-02-02 12:48:01'),
(1547, 2, 'project', '::1', '2021-02-02 12:48:03'),
(1548, 2, 'international', '::1', '2021-02-02 12:48:07'),
(1549, 2, 'department-for-international-development-dfid', '::1', '2021-02-02 12:48:15'),
(1550, 2, 'project-view', '::1', '2021-02-02 12:48:29'),
(1551, 1, 'home', '::1', '2021-02-18 05:12:45'),
(1552, 1, 'home', '::1', '2021-02-24 02:56:48'),
(1553, 1, 'home', '::1', '2021-02-26 03:48:04'),
(1554, 2, 'planning', '::1', '2021-02-26 03:51:16'),
(1555, 2, 'project', '::1', '2021-02-26 03:51:31'),
(1556, 2, 'policy', '::1', '2021-02-26 03:51:32'),
(1557, 2, 'about-us', '::1', '2021-02-26 03:51:33'),
(1558, 2, 'education', '::1', '2021-02-26 03:58:33'),
(1559, 1, 'home', '::1', '2021-03-01 03:42:02'),
(1560, 2, 'education', '::1', '2021-03-01 03:42:06'),
(1561, 2, 'planning', '::1', '2021-03-01 05:08:16'),
(1562, 1, 'home', '::1', '2021-03-02 04:21:55'),
(1563, 2, 'education', '::1', '2021-03-02 04:21:59'),
(1564, 2, 'training-awareness-programmes', '::1', '2021-03-02 04:22:01'),
(1565, 2, 'about-neac', '::1', '2021-03-02 04:22:11'),
(1566, 2, 'national-green-corps', '::1', '2021-03-02 04:22:22'),
(1567, 2, 'fellowship-awards', '::1', '2021-03-02 04:23:17'),
(1568, 2, 'project', '::1', '2021-03-02 04:24:34'),
(1569, 2, 'planning', '::1', '2021-03-02 04:24:35'),
(1570, 2, 'international', '::1', '2021-03-02 04:24:39'),
(1571, 2, 'project-management-consultancy', '::1', '2021-03-02 04:25:28'),
(1572, 2, 'important-environmental-days', '::1', '2021-03-02 04:26:13'),
(1573, 2, 'general-awareness-campaign', '::1', '2021-03-02 04:26:14'),
(1574, 2, 'environmental-policy', '::1', '2021-03-02 04:26:15'),
(1575, 2, 'about-neac', '::1', '2021-03-03 11:00:42'),
(1576, 2, 'environmental-policy', '::1', '2021-03-03 11:00:45'),
(1577, 1, 'home', '::1', '2021-03-03 11:33:10'),
(1578, 2, 'education', '::1', '2021-03-03 11:46:33'),
(1579, 2, 'research', '::1', '2021-03-03 11:49:38'),
(1580, 2, 'conservation-management-of-water-bodies', '::1', '2021-03-03 11:49:42'),
(1581, 2, 'biosphere-reserves', '::1', '2021-03-03 11:50:18'),
(1582, 2, 'panna-bio-reserves', '::1', '2021-03-03 11:50:50'),
(1583, 2, 'management-aspects', '::1', '2021-03-03 11:51:36'),
(1584, 2, 'photo-gallery-view', '::1', '2021-03-03 11:51:40'),
(1585, 2, 'fellowship-awards', '::1', '2021-03-03 11:51:47'),
(1586, 1, 'home', '::1', '2021-03-04 11:59:02'),
(1587, 2, 'whos-who', '::1', '2021-03-04 11:59:36'),
(1588, 2, 'project', '::1', '2021-03-04 12:42:18'),
(1589, 2, 'policy', '::1', '2021-03-04 12:42:18'),
(1590, 2, 'planning', '::1', '2021-03-04 12:42:20'),
(1591, 2, 'about-us', '::1', '2021-03-04 12:42:23'),
(1592, 2, 'publication', '::1', '2021-03-04 12:42:25'),
(1593, 2, 'video-gallery', '::1', '2021-03-04 12:42:31'),
(1594, 2, 'news-details', '::1', '2021-03-04 12:42:33'),
(1595, 2, 'circular', '::1', '2021-03-04 12:42:34'),
(1596, 2, 'feedback', '::1', '2021-03-04 12:42:35'),
(1597, 2, 'introduction', '::1', '2021-03-04 12:42:40'),
(1598, 2, 'library', '::1', '2021-03-04 12:42:43'),
(1599, 2, 'contact-us', '::1', '2021-03-04 12:43:02'),
(1600, 2, 'photo-gallery', '::1', '2021-03-04 12:45:24'),
(1601, 1, 'home', '::1', '2021-03-23 02:15:49'),
(1602, 2, 'contact-us', '::1', '2021-03-23 02:50:50'),
(1603, 2, 'feedback', '::1', '2021-03-23 02:51:19'),
(1604, 2, 'history', '::1', '2021-03-23 02:51:41'),
(1605, 2, 'terms-of-use', '::1', '2021-03-23 02:53:05'),
(1606, 2, 'sitemap', '::1', '2021-03-23 02:53:17'),
(1607, 2, 'hyperlink-policy', '::1', '2021-03-23 02:53:30'),
(1608, 2, 'department-for-international-development-dfid', '::1', '2021-03-23 02:53:43'),
(1609, 1, 'home', '::1', '2021-03-24 11:38:19'),
(1610, 2, 'feedback', '::1', '2021-03-24 12:34:22'),
(1611, 2, 'circular', '::1', '2021-03-24 01:17:59'),
(1612, 2, 'about-us', '::1', '2021-03-24 01:18:08'),
(1613, 2, 'video-gallery', '::1', '2021-03-24 03:19:21'),
(1614, 2, 'news-details', '::1', '2021-03-24 03:19:25'),
(1615, 2, 'publication', '::1', '2021-03-24 03:19:36'),
(1616, 2, 'project', '::1', '2021-03-24 03:19:53'),
(1617, 2, 'project-view', '::1', '2021-03-24 03:19:55'),
(1618, 2, 'library', '::1', '2021-03-24 03:20:39'),
(1619, 2, 'terms-of-use', '::1', '2021-03-24 03:22:04'),
(1620, 2, 'privacy-policy', '::1', '2021-03-24 03:22:07'),
(1621, 2, 'search', '::1', '2021-03-24 03:22:54'),
(1622, 2, 'contact-us', '::1', '2021-03-24 04:39:48'),
(1623, 2, 'events', '::1', '2021-03-25 01:43:56'),
(1624, 1, 'home', '::1', '2021-03-25 01:44:00'),
(1625, 2, 'feedback', '::1', '2021-03-26 04:29:29'),
(1626, 1, 'home', '::1', '2021-03-26 04:29:33'),
(1627, 2, 'register', '::1', '2021-03-26 04:32:42'),
(1628, 2, 'register', '::1', '2021-03-27 05:25:34'),
(1629, 1, 'home', '::1', '2021-03-30 12:18:29'),
(1630, 2, 'register', '::1', '2021-03-30 12:18:32'),
(1631, 2, 'login', '::1', '2021-03-30 12:24:55'),
(1632, 2, 'contact-us', '::1', '2021-03-30 12:46:33'),
(1633, 2, 'register', '::1', '2021-03-31 11:55:41'),
(1634, 2, 'register', '::1', '2021-04-01 11:34:18'),
(1635, 1, 'home', '::1', '2021-04-05 12:07:26'),
(1636, 2, 'register', '::1', '2021-04-05 12:07:34'),
(1637, 2, 'login', '::1', '2021-04-05 12:44:05'),
(1638, 2, 'register', '::1', '2021-04-06 11:11:59'),
(1639, 2, 'login', '::1', '2021-04-06 11:15:29'),
(1640, 1, 'home', '::1', '2021-04-06 03:44:03'),
(1641, 1, 'home', '::1', '2021-04-07 11:23:57'),
(1642, 2, 'register', '::1', '2021-04-07 11:24:00'),
(1643, 2, 'login', '::1', '2021-04-07 11:24:02'),
(1644, 2, 'user', '::1', '2021-04-07 01:45:18'),
(1645, 2, 'registerview', '::1', '2021-04-07 05:54:29'),
(1646, 2, 'register', '::1', '2021-04-08 11:05:19'),
(1647, 2, 'login', '::1', '2021-04-08 11:05:21'),
(1648, 2, 'registerview', '::1', '2021-04-08 11:22:41'),
(1649, 2, 'about-us', '::1', '2021-04-08 04:08:01'),
(1650, 1, 'home', '::1', '2021-04-08 04:16:12'),
(1651, 2, 'user', '::1', '2021-04-08 04:29:56'),
(1652, 2, 'contact-us', '::1', '2021-04-08 04:42:18'),
(1653, 2, 'career', '::1', '2021-04-08 05:02:59'),
(1654, 2, 'register', '::1', '2021-04-09 10:43:40'),
(1655, 2, 'login', '::1', '2021-04-09 10:46:46'),
(1656, 1, 'home', '::1', '2021-04-09 11:39:30'),
(1657, 2, 'registerview', '::1', '2021-04-09 11:47:06'),
(1658, 2, 'planning', '::1', '2021-04-09 01:34:47'),
(1659, 2, 'education', '::1', '2021-04-09 02:04:13'),
(1660, 1, 'home', '::1', '2021-04-12 03:39:09'),
(1661, 2, 'register', '::1', '2021-04-12 04:41:20'),
(1662, 2, 'login', '::1', '2021-04-12 04:41:52'),
(1663, 1, 'home', '::1', '2021-04-15 10:18:57'),
(1664, 2, 'register', '::1', '2021-04-15 10:21:41'),
(1665, 2, 'login', '::1', '2021-04-15 10:22:10'),
(1666, 2, 'register', '::1', '2021-04-16 11:12:08'),
(1667, 1, 'home', '::1', '2021-04-20 04:40:37'),
(1668, 2, 'login', '::1', '2021-04-20 04:40:42'),
(1669, 2, 'register', '::1', '2021-04-20 04:44:02'),
(1670, 2, 'registerview', '::1', '2021-04-20 05:50:50'),
(1671, 1, 'home', '::1', '2021-04-22 12:20:55'),
(1672, 2, 'registerview', '::1', '2021-04-22 12:26:58'),
(1673, 2, 'login', '::1', '2021-04-22 12:27:11'),
(1674, 2, 'register', '::1', '2021-04-27 12:41:17'),
(1675, 2, 'intern', '::1', '2021-04-27 03:15:04'),
(1676, 2, 'login', '::1', '2021-04-27 03:16:57'),
(1677, 2, 'registerview', '::1', '2021-04-27 03:16:58'),
(1678, 2, 'privacy-policy', '::1', '2021-04-27 05:34:54'),
(1679, 2, 'feedback', '::1', '2021-04-27 05:35:11'),
(1680, 2, 'intern', '::1', '2021-04-28 11:23:03'),
(1681, 1, 'home', '::1', '2021-04-29 03:06:43'),
(1682, 2, 'intern', '::1', '2021-04-29 03:37:25'),
(1683, 2, 'intern', '::1', '2021-04-30 01:56:49'),
(1684, 2, 'intern', '::1', '2021-05-03 11:42:07'),
(1685, 2, 'intern', '::1', '2021-05-04 01:48:16'),
(1686, 1, 'home', '::1', '2021-05-19 04:40:02'),
(1687, 1, 'home', '::1', '2021-05-20 03:30:24'),
(1688, 1, 'home', '::1', '2021-05-21 03:21:57'),
(1689, 2, 'intern', '::1', '2021-05-21 03:24:42'),
(1690, 2, 'ProjectMonitoring', '::1', '2021-05-21 04:46:24'),
(1691, 2, 'ProjectMonitoring', '::1', '2021-05-24 11:02:21'),
(1692, 2, 'intern', '::1', '2021-05-24 11:21:36'),
(1693, 1, 'home', '::1', '2021-05-24 06:16:05'),
(1694, 2, 'intern', '::1', '2021-05-25 11:02:00'),
(1695, 2, 'hyperlink-policy', '::1', '2021-05-25 05:43:40'),
(1696, 2, 'intern', '::1', '2021-05-27 10:12:50'),
(1697, 1, 'home', '::1', '2021-05-28 11:48:11'),
(1698, 2, 'intern', '::1', '2021-05-28 11:48:25'),
(1699, 2, 'empanelment-consultancy', '::1', '2021-05-28 03:13:56'),
(1700, 1, 'home', '::1', '2021-06-01 03:39:04'),
(1701, 2, 'empanelment-consultancy', '::1', '2021-06-01 03:39:16'),
(1702, 2, 'register', '::1', '2021-06-01 06:22:45'),
(1703, 2, 'login', '::1', '2021-06-01 06:23:31'),
(1704, 2, 'registerview', '::1', '2021-06-01 06:27:08'),
(1705, 1, 'home', '::1', '2021-06-02 11:45:33'),
(1706, 2, 'register', '::1', '2021-06-02 11:45:39'),
(1707, 2, 'login', '::1', '2021-06-02 11:46:17'),
(1708, 2, 'registerview', '::1', '2021-06-02 12:08:53'),
(1709, 1, 'home', '::1', '2021-06-03 03:22:49'),
(1710, 2, 'register', '::1', '2021-06-03 03:22:54'),
(1711, 2, 'login', '::1', '2021-06-03 03:23:23'),
(1712, 2, 'registerview', '::1', '2021-06-03 03:25:10'),
(1713, 2, 'registerview', '::1', '2021-06-04 10:09:58');
INSERT INTO `comm_web_visitor` (`v_id`, `v_type`, `v_menu_name`, `v_ip_address`, `v_created_date`) VALUES
(1714, 2, 'register', '::1', '2021-06-04 10:10:01'),
(1715, 2, 'login', '::1', '2021-06-04 04:46:34'),
(1716, 1, 'home', '::1', '2021-06-07 10:33:12'),
(1717, 2, 'register', '::1', '2021-06-07 12:13:26'),
(1718, 2, 'login', '::1', '2021-06-07 12:14:06'),
(1719, 1, 'home', '::1', '2021-06-14 11:33:24'),
(1720, 2, 'register', '::1', '2021-06-14 11:53:09'),
(1721, 2, 'news-details', '::1', '2021-06-14 11:56:55'),
(1722, 1, 'home', '::1', '2021-06-25 02:34:57'),
(1723, 1, 'home', '::1', '2021-06-30 05:29:22'),
(1724, 2, 'career', '::1', '2021-06-30 05:29:53'),
(1725, 1, 'home', '::1', '2021-07-16 03:55:16'),
(1726, 2, 'register', '::1', '2021-07-16 03:55:18'),
(1727, 2, 'login', '::1', '2021-07-16 04:52:43'),
(1728, 2, 'circular', '::1', '2021-07-16 04:53:49'),
(1729, 2, 'feedback', '::1', '2021-07-16 04:53:50'),
(1730, 2, 'empanelment-consultancy', '::1', '2021-07-16 05:03:26'),
(1731, 1, 'home', '::1', '2021-07-19 10:23:36'),
(1732, 2, 'register', '::1', '2021-07-19 10:50:17'),
(1733, 2, 'empanelment-consultancy', '::1', '2021-07-19 01:10:18'),
(1734, 2, 'login', '::1', '2021-07-19 03:57:25'),
(1735, 1, 'home', '::1', '2021-07-22 10:58:22'),
(1736, 2, 'register', '::1', '2021-07-22 11:02:39'),
(1737, 2, 'empanelment-consultancy', '::1', '2021-07-22 11:20:40'),
(1738, 2, 'login', '::1', '2021-07-22 11:20:40'),
(1739, 1, 'home', '::1', '2021-07-27 11:18:19'),
(1740, 2, 'feedback', '::1', '2021-07-27 11:18:30'),
(1741, 2, 'register', '::1', '2021-07-27 11:38:44'),
(1742, 2, 'login', '::1', '2021-07-27 11:38:47'),
(1743, 2, 'empanelment-consultancy', '::1', '2021-07-27 11:43:02'),
(1744, 2, 'contact-us', '::1', '2021-07-27 02:02:56'),
(1745, 2, 'career', '::1', '2021-07-27 04:01:21'),
(1746, 2, 'circular', '::1', '2021-07-27 04:54:20'),
(1747, 1, 'home', '::1', '2021-07-28 10:58:04'),
(1748, 2, 'register', '::1', '2021-07-28 10:58:26'),
(1749, 1, 'home', '::1', '2021-07-29 11:33:33'),
(1750, 2, 'search', '::1', '2021-07-29 11:33:39'),
(1751, 2, 'search-details', '::1', '2021-07-29 11:34:45'),
(1752, 2, 'news-details', '::1', '2021-07-29 12:14:37'),
(1753, 2, 'circular', '::1', '2021-07-29 12:14:40'),
(1754, 2, 'whos-who', '::1', '2021-07-29 12:14:42'),
(1755, 2, 'publication', '::1', '2021-07-29 12:14:46'),
(1756, 2, 'video-gallery', '::1', '2021-07-29 12:14:51'),
(1757, 2, 'career', '::1', '2021-07-29 12:14:52'),
(1758, 2, 'contact-us', '::1', '2021-07-29 12:14:53'),
(1759, 2, 'feedback', '::1', '2021-07-29 12:14:56'),
(1760, 2, 'policy', '::1', '2021-07-29 12:15:40'),
(1761, 2, 'project', '::1', '2021-07-29 12:15:42'),
(1762, 2, 'project-view', '::1', '2021-07-29 12:15:44'),
(1763, 2, 'register', '::1', '2021-07-29 12:16:53'),
(1764, 2, 'history', '::1', '2021-07-29 12:22:52'),
(1765, 2, 'introduction', '::1', '2021-07-29 12:23:47'),
(1766, 2, 'biosphere-reserves', '::1', '2021-07-29 12:25:34'),
(1767, 2, 'management-aspects', '::1', '2021-07-29 12:25:37'),
(1768, 1, 'home', '::1', '2021-08-02 10:56:06'),
(1769, 2, 'contact-us', '::1', '2021-08-02 10:56:10'),
(1770, 2, 'register', '::1', '2021-08-02 10:56:16'),
(1771, 2, 'download', '::1', '2021-08-02 02:13:17'),
(1772, 2, 'important-links', '::1', '2021-08-02 02:13:30'),
(1773, 1, 'home', '::1', '2021-08-03 11:15:28'),
(1774, 2, 'important-links', '::1', '2021-08-03 11:17:43'),
(1775, 2, 'register', '::1', '2021-08-03 11:37:43'),
(1776, 2, 'video-gallery', '::1', '2021-08-03 11:40:06'),
(1777, 2, 'photo-gallery', '::1', '2021-08-03 12:30:58'),
(1778, 2, 'whos-who', '::1', '2021-08-03 05:01:53'),
(1779, 2, 'whos-who', '::1', '2021-08-04 11:12:25'),
(1780, 1, 'home', '::1', '2021-08-04 12:03:18'),
(1781, 1, 'home', '::1', '2021-08-10 02:14:15'),
(1782, 2, 'news-details', '::1', '2021-08-10 04:08:39'),
(1783, 2, 'career', '::1', '2021-08-10 04:09:08'),
(1784, 2, 'circular', '::1', '2021-08-10 04:13:48'),
(1785, 2, 'publication', '::1', '2021-08-10 04:25:55'),
(1786, 2, 'video-gallery', '::1', '2021-08-10 05:02:56'),
(1787, 2, 'photo-gallery', '::1', '2021-08-10 05:02:58'),
(1788, 2, 'whos-who', '::1', '2021-08-10 05:03:04'),
(1789, 2, 'photo-gallery-view', '::1', '2021-08-10 05:38:49'),
(1790, 1, 'home', '::1', '2021-08-12 12:41:03'),
(1791, 2, 'publication', '::1', '2021-08-12 12:45:14'),
(1792, 2, 'project', '::1', '2021-08-12 01:59:30'),
(1793, 2, 'about-us', '::1', '2021-08-12 01:59:40'),
(1794, 2, 'conservation-management-of-water-bodies', '::1', '2021-08-12 01:59:45'),
(1795, 2, 'video-gallery', '::1', '2021-08-12 02:09:36'),
(1796, 2, 'whos-who', '::1', '2021-08-12 02:09:43'),
(1797, 2, 'introduction', '::1', '2021-08-12 02:10:28'),
(1798, 2, 'search', '::1', '2021-08-12 02:16:30'),
(1799, 2, 'library', '::1', '2021-08-12 02:30:23'),
(1800, 2, 'visionmission', '::1', '2021-08-12 02:30:28'),
(1801, 2, 'photo-gallery', '::1', '2021-08-12 02:30:35'),
(1802, 2, 'photo-gallery-view', '::1', '2021-08-12 02:30:36'),
(1803, 2, 'feedback', '::1', '2021-08-12 02:30:39'),
(1804, 2, 'news-details', '::1', '2021-08-12 02:30:44'),
(1805, 2, 'circular', '::1', '2021-08-12 02:30:51'),
(1806, 2, 'contact-us', '::1', '2021-08-12 02:30:53'),
(1807, 2, 'career', '::1', '2021-08-12 02:30:55'),
(1808, 2, 'register', '::1', '2021-08-12 02:31:08'),
(1809, 2, 'login', '::1', '2021-08-12 02:31:09'),
(1810, 2, 'empanelment-consultancy', '::1', '2021-08-12 05:10:22'),
(1811, 1, 'home', '::1', '2021-08-17 12:02:40'),
(1812, 2, 'news-details', '::1', '2021-08-17 12:38:14'),
(1813, 2, 'library', '::1', '2021-08-17 12:38:17'),
(1814, 2, 'feedback', '::1', '2021-08-17 12:38:20'),
(1815, 2, 'circular', '::1', '2021-08-17 12:38:21'),
(1816, 2, 'project', '::1', '2021-08-17 12:38:32'),
(1817, 2, 'project-view', '::1', '2021-08-17 12:38:34'),
(1818, 2, 'register', '::1', '2021-08-17 12:38:40'),
(1819, 2, 'publication', '::1', '2021-08-17 12:38:41'),
(1820, 2, 'login', '::1', '2021-08-17 12:41:25'),
(1821, 1, 'home', '::1', '2021-08-25 04:56:04'),
(1822, 2, 'visionmission', '::1', '2021-08-25 04:56:07'),
(1823, 2, 'introduction', '::1', '2021-08-25 04:57:21'),
(1824, 2, 'about-us', '::1', '2021-08-25 04:57:23'),
(1825, 2, 'career', '::1', '2021-08-25 05:06:02'),
(1826, 2, 'news-details', '::1', '2021-08-25 05:18:26'),
(1827, 1, 'home', '::1', '2021-08-26 10:35:07'),
(1828, 2, 'visionmission', '::1', '2021-08-26 11:34:37'),
(1829, 2, 'introduction', '::1', '2021-08-26 11:34:45'),
(1830, 1, 'home', '::1', '2021-09-02 05:39:05'),
(1831, 2, 'empanelment-consultancy', '::1', '2021-09-02 05:39:49'),
(1832, 1, 'home', '::1', '2021-09-03 03:29:33'),
(1833, 1, 'home', '::1', '2021-09-08 04:37:39'),
(1834, 2, 'circular', '::1', '2021-09-08 04:37:46'),
(1835, 2, 'empanelment-consultancy', '::1', '2021-09-08 04:38:01'),
(1836, 1, 'home', '::1', '2021-09-09 02:32:55'),
(1837, 2, 'empanelment-consultancy', '::1', '2021-09-09 02:33:04'),
(1838, 2, 'circular', '::1', '2021-09-09 02:45:46'),
(1839, 1, 'home', '::1', '2021-09-15 12:40:59'),
(1840, 2, 'circular', '::1', '2021-09-15 12:41:02'),
(1841, 2, 'empanelment-consultancy', '::1', '2021-09-15 12:41:12'),
(1842, 1, 'home', '::1', '2021-09-17 01:03:27'),
(1843, 1, 'home', '::1', '2021-09-22 03:27:01'),
(1844, 2, 'planning', '::1', '2021-09-22 03:29:26'),
(1845, 1, 'home', '::1', '2021-09-27 12:36:27'),
(1846, 1, 'home', '::1', '2021-09-30 07:50:41'),
(1847, 1, 'home', '::1', '2021-10-01 09:10:07'),
(1848, 1, 'home', '::1', '2021-10-03 07:40:30'),
(1849, 1, 'home', '::1', '2021-10-04 07:23:18'),
(1850, 1, 'home', '::1', '2021-10-09 12:46:57'),
(1851, 2, 'photo-gallery', '::1', '2021-10-09 12:47:16'),
(1852, 2, 'contact-us', '::1', '2021-10-09 12:48:09'),
(1853, 2, 'about', '::1', '2021-10-09 12:48:20'),
(1854, 2, 'feedback', '::1', '2021-10-09 01:07:27'),
(1855, 2, 'careers-us', '::1', '2021-10-09 01:19:10'),
(1856, 2, 'about-us', '::1', '2021-10-10 09:07:37'),
(1857, 2, 'our-commitment', '::1', '2021-10-10 09:21:23'),
(1858, 2, 'our-mission', '::1', '2021-10-10 09:24:49'),
(1859, 2, 'our-team', '::1', '2021-10-10 09:29:58'),
(1860, 2, 'client-review', '::1', '2021-10-10 09:52:00'),
(1861, 1, 'home', '::1', '2021-10-10 10:17:24'),
(1862, 2, 'contact-us', '::1', '2021-10-10 10:39:54'),
(1863, 2, 'manpower-recruitment', '::1', '2021-10-10 10:52:01'),
(1864, 2, 'placement-services', '::1', '2021-10-10 10:56:04'),
(1865, 2, 'it-services', '::1', '2021-10-10 11:16:15'),
(1866, 2, 'training', '::1', '2021-10-10 11:16:22'),
(1867, 2, 'temp-staffing', '::1', '2021-10-10 11:16:27'),
(1868, 2, 'industries-we-serve', '::1', '2021-10-10 11:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `menu_name` varchar(40) DEFAULT NULL,
  `controller_name` varchar(50) NOT NULL DEFAULT '#',
  `icon_class` varchar(50) DEFAULT NULL,
  `p_menu_id` int(11) DEFAULT NULL,
  `s_order` int(11) DEFAULT NULL,
  `class_id` varchar(15) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `tab_same_new` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 for same, 2 for new',
  `is_active` tinyint(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `controller_name`, `icon_class`, `p_menu_id`, `s_order`, `class_id`, `action`, `tab_same_new`, `is_active`) VALUES
(1, 'Dashboard', 'manage/Dashboard', 'glyphicon glyphicon-dashboard', 0, 1, 'title', 'index', 1, 1),
(2, 'Master', '#', 'fa fa-folder-o', 131, 3, 'title', NULL, 1, 1),
(3, 'Settings', '#', 'fa fa-cog', 131, 55, 'title', NULL, 1, 1),
(4, 'Website Setting', 'manage/Settings', 'glyphicon glyphicon-folder-close', 3, 56, NULL, NULL, 1, 1),
(11, ' Media', '#', 'fa fa-picture-o', 131, 44, 'title', NULL, 1, 1),
(15, 'Social Link', 'manage/Social', 'fa fa-hand-o-right', 2, 9, NULL, '', 1, 1),
(19, 'Upload File', 'manage/Media', 'fa fa-cloud-upload', 11, 45, NULL, 'add', 1, 1),
(20, 'View File', 'manage/Media', 'fa fa-hand-o-right', 11, 46, NULL, NULL, 1, 1),
(22, 'User Master', 'manage/User', 'fa fa-hand-o-right', 2, 4, NULL, '', 1, 1),
(23, 'Pages', '#', 'fa fa-file', 131, 10, 'title', NULL, 1, 1),
(24, 'Page Master', 'manage/Page', 'fa fa-hand-o-right', 23, 11, NULL, '', 1, 1),
(68, 'User Privileges', 'manage/Userprivilege', 'fa fa-hand-o-right', 2, 6, NULL, NULL, 1, 1),
(88, 'Admin Menu', 'manage/Adminmenu', 'fa fa-hand-o-right', 2, 5, NULL, '', 1, 1),
(90, 'Module', '#', 'fa fa-folder-o', 131, 12, 'title', NULL, 1, 1),
(93, 'Photo Gallery', 'manage/Gallerymaster', 'fa fa-hand-o-right', 90, 14, NULL, '', 1, 1),
(94, 'Photo Gallery Category', 'manage/Gallerycategorymaster', 'fa fa-hand-o-right', 90, 13, NULL, '', 1, 1),
(105, 'Top Menu', 'manage/Frontmenu', 'fa fa-hand-o-right', 110, 52, NULL, NULL, 1, 1),
(106, 'Menu Modules', 'manage/Menumodule', 'fa fa-hand-o-right', 110, 51, NULL, NULL, 1, 1),
(107, 'Manage Slider', '#', 'fa fa-picture-o', 131, 47, 'title', NULL, 1, 1),
(108, 'Top Slider', 'manage/Slider', 'fa fa-hand-o-right', 107, 48, NULL, NULL, 1, 1),
(110, 'Front Menu', '#', 'fa fa-folder-o', 131, 50, 'title', NULL, 1, 1),
(111, 'Bottom Menu', 'manage/Frontmenu', 'fa fa-hand-o-right', 110, 54, NULL, 'bottomMenu', 1, 1),
(129, 'Access List', 'manage/Accesslist', 'fa fa-hand-o-right', 2, 7, NULL, NULL, 1, 1),
(130, 'Assign User Access', 'manage/Acl', 'fa fa-hand-o-right', 2, 8, NULL, NULL, 1, 1),
(131, 'CMS', '#', 'fa fa-folder-o', 0, 2, 'title', NULL, 1, 1),
(145, 'End Menu', '#', 'fa fa-cog', 0, 57, 'title', NULL, 1, 1),
(146, 'Video Gallery', 'manage/Videogallery', 'fa fa-hand-o-right', 90, 16, NULL, NULL, 1, 1),
(147, 'Video Gallery Category', 'manage/Videocategory', 'fa fa-hand-o-right', 90, 15, NULL, NULL, 1, 1),
(160, 'Bottom Slider', '/manage/Slider', 'fa fa-hand-o-right', 107, 49, NULL, 'index/2', 1, 1),
(164, 'Middle Menu', 'manage/Frontmenu', 'fa fa-hand-o-right', 110, 53, NULL, 'middleMenu', 1, 1),
(166, 'Events', 'manage/events', 'fa fa-hand-o-right', 90, 36, NULL, NULL, 1, 1),
(177, 'Event Media', '/manage/EventMedia', 'fa fa-hand-o-right', 90, 37, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu_list`
-- (See below for the actual view)
--
CREATE TABLE `menu_list` (
`id` int(11) unsigned
,`menu_name` varchar(40)
,`controller_name` varchar(50)
,`icon_class` varchar(50)
,`p_menu_id` int(11)
,`s_order` int(11)
,`class_id` varchar(15)
,`action` varchar(50)
,`tab_same_new` tinyint(2)
,`is_active` tinyint(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_acl`
-- (See below for the actual view)
--
CREATE TABLE `user_acl` (
`auth_id` int(11)
,`priviledge_id` int(11)
,`menu_id` int(11)
,`auth_function` varchar(255)
,`added_date` datetime
,`added_by` int(11)
,`edit_date` datetime
,`edit_by` int(11)
,`status` tinyint(2)
,`admin_name` varchar(201)
,`controller_name` varchar(50)
,`upm_id` int(11)
,`upm_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_previlege_master`
--

CREATE TABLE `user_previlege_master` (
  `upm_id` int(11) NOT NULL COMMENT '1=Supper Admin,2=Administrator,3=Editor,4=Author',
  `upm_name` varchar(50) NOT NULL,
  `upm_description` varchar(350) NOT NULL,
  `upm_range` varchar(500) NOT NULL,
  `isdelete` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_previlege_master`
--

INSERT INTO `user_previlege_master` (`upm_id`, `upm_name`, `upm_description`, `upm_range`, `isdelete`) VALUES
(1, 'Supper Admin', 'Allow all menu', '1,131,2,22,88,68,129,130,15,23,24,90,94,93,147,146,95,149,150,175,143,157,158,101,112,176,172,102,166,177,171,165,167,159,114,168,11,19,20,107,108,160,110,106,105,164,111,3,4,145,178,179', 0),
(2, 'Administrator', 'Allow main menu', '1,131,2,22,23,24,90,94,93,147,146,95,149,150,151,157,161,162,101,112,176,166,177,114,168,107,108,160,3,4,145,179', 0);

-- --------------------------------------------------------

--
-- Structure for view `menu_list`
--
DROP TABLE IF EXISTS `menu_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_list`  AS  select `menus`.`id` AS `id`,`menus`.`menu_name` AS `menu_name`,replace(`menus`.`controller_name`,'manage/','') AS `controller_name`,`menus`.`icon_class` AS `icon_class`,`menus`.`p_menu_id` AS `p_menu_id`,`menus`.`s_order` AS `s_order`,`menus`.`class_id` AS `class_id`,`menus`.`action` AS `action`,`menus`.`tab_same_new` AS `tab_same_new`,`menus`.`is_active` AS `is_active` from `menus` where ((not(`menus`.`id` in (select distinct `n1`.`id` from (`menus` `n1` join `menus` `n2`) where ((`n1`.`id` > `n2`.`id`) and (`n1`.`controller_name` = `n2`.`controller_name`))))) and (trim(`menus`.`controller_name`) <> '#')) ;

-- --------------------------------------------------------

--
-- Structure for view `user_acl`
--
DROP TABLE IF EXISTS `user_acl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_acl`  AS  select `ac`.`auth_id` AS `auth_id`,`ac`.`priviledge_id` AS `priviledge_id`,`ac`.`menu_id` AS `menu_id`,`ac`.`auth_function` AS `auth_function`,`ac`.`added_date` AS `added_date`,`ac`.`added_by` AS `added_by`,`ac`.`edit_date` AS `edit_date`,`ac`.`edit_by` AS `edit_by`,`ac`.`status` AS `status`,concat(`cm`.`admin_fname`,' ',`cm`.`admin_lname`) AS `admin_name`,replace(trim(`m`.`controller_name`),'manage/','') AS `controller_name`,`upm`.`upm_id` AS `upm_id`,`upm`.`upm_name` AS `upm_name` from (((`comm_auth_acl` `ac` left join `comm_admin` `cm` on((`cm`.`admin_id` = `ac`.`added_by`))) left join `menus` `m` on((`m`.`id` = `ac`.`menu_id`))) left join `user_previlege_master` `upm` on((`upm`.`upm_id` = `ac`.`priviledge_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comm_admin`
--
ALTER TABLE `comm_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comm_auth_acl`
--
ALTER TABLE `comm_auth_acl`
  ADD PRIMARY KEY (`auth_id`),
  ADD UNIQUE KEY `priviledge_id` (`priviledge_id`,`menu_id`),
  ADD KEY `menu_id_idx` (`menu_id`);

--
-- Indexes for table `comm_auth_controller_function`
--
ALTER TABLE `comm_auth_controller_function`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_id` (`menu_id`);

--
-- Indexes for table `comm_contact`
--
ALTER TABLE `comm_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_contact_category`
--
ALTER TABLE `comm_contact_category`
  ADD PRIMARY KEY (`cat_id`,`added_by`);

--
-- Indexes for table `comm_contact_designation`
--
ALTER TABLE `comm_contact_designation`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `comm_events`
--
ALTER TABLE `comm_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_events_media`
--
ALTER TABLE `comm_events_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_feedback`
--
ALTER TABLE `comm_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `comm_financereport`
--
ALTER TABLE `comm_financereport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_media`
--
ALTER TABLE `comm_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_menu`
--
ALTER TABLE `comm_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_menu_modules`
--
ALTER TABLE `comm_menu_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `comm_menu_type`
--
ALTER TABLE `comm_menu_type`
  ADD PRIMARY KEY (`menu_type_id`);

--
-- Indexes for table `comm_pages`
--
ALTER TABLE `comm_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_url` (`page_url`);

--
-- Indexes for table `comm_photo_gallery`
--
ALTER TABLE `comm_photo_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_photo_gallery_category`
--
ALTER TABLE `comm_photo_gallery_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comm_settings`
--
ALTER TABLE `comm_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_sliders`
--
ALTER TABLE `comm_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_slider_category`
--
ALTER TABLE `comm_slider_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comm_social`
--
ALTER TABLE `comm_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_video_gallery`
--
ALTER TABLE `comm_video_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_video_gallery_category`
--
ALTER TABLE `comm_video_gallery_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comm_web_visitor`
--
ALTER TABLE `comm_web_visitor`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_previlege_master`
--
ALTER TABLE `user_previlege_master`
  ADD PRIMARY KEY (`upm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comm_admin`
--
ALTER TABLE `comm_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comm_auth_acl`
--
ALTER TABLE `comm_auth_acl`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `comm_auth_controller_function`
--
ALTER TABLE `comm_auth_controller_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `comm_contact`
--
ALTER TABLE `comm_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comm_contact_category`
--
ALTER TABLE `comm_contact_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comm_contact_designation`
--
ALTER TABLE `comm_contact_designation`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comm_events`
--
ALTER TABLE `comm_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comm_events_media`
--
ALTER TABLE `comm_events_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comm_feedback`
--
ALTER TABLE `comm_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comm_financereport`
--
ALTER TABLE `comm_financereport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comm_media`
--
ALTER TABLE `comm_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comm_menu`
--
ALTER TABLE `comm_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `comm_menu_modules`
--
ALTER TABLE `comm_menu_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `comm_menu_type`
--
ALTER TABLE `comm_menu_type`
  MODIFY `menu_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comm_pages`
--
ALTER TABLE `comm_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comm_photo_gallery`
--
ALTER TABLE `comm_photo_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comm_photo_gallery_category`
--
ALTER TABLE `comm_photo_gallery_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comm_settings`
--
ALTER TABLE `comm_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comm_sliders`
--
ALTER TABLE `comm_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comm_slider_category`
--
ALTER TABLE `comm_slider_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comm_social`
--
ALTER TABLE `comm_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comm_video_gallery`
--
ALTER TABLE `comm_video_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comm_video_gallery_category`
--
ALTER TABLE `comm_video_gallery_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comm_web_visitor`
--
ALTER TABLE `comm_web_visitor`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1869;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `user_previlege_master`
--
ALTER TABLE `user_previlege_master`
  MODIFY `upm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1=Supper Admin,2=Administrator,3=Editor,4=Author', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comm_auth_acl`
--
ALTER TABLE `comm_auth_acl`
  ADD CONSTRAINT `fk_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `comm_auth_controller_function` (`menu_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
