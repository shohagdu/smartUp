-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 07:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_up_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountlogs`
--

CREATE TABLE `accountlogs` (
  `id` int(11) NOT NULL,
  `acno` varchar(40) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acinfo`
--

CREATE TABLE `acinfo` (
  `id` int(11) NOT NULL,
  `acname` varchar(255) NOT NULL,
  `acno` varchar(40) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acinfo`
--

INSERT INTO `acinfo` (`id`, `acname`, `acno`, `balance`, `last_update`) VALUES
(1, 'CASH ACCOUNT', '0000-0000-0000-0000', '15429.80', '2019-07-17 12:03:08'),
(2, 'চেয়ারম্যান ইউনিয়ন পরিষদ', '2216/0', '100.00', '2018-08-18 16:07:30'),
(3, 'জন্ম নিবন্ধন', '2191/1', '0.00', '2016-09-22 08:07:31'),
(4, 'এলজিএসপি', '1603033008083', '0.00', '2016-09-22 08:07:31'),
(5, 'ভূমি হস্তান্তর কর ১%', '22751', '0.00', '2016-09-22 08:07:31'),
(6, 'নিজস্ব তহবিলঃ ক্যাশ', '0001-0001-0001-0001', '0.00', '2018-06-07 20:43:28'),
(7, 'নিজস্ব তহবিলঃ জন্ম নিবন্ধন', '0002-0002-0002-0002', '0.00', '2016-09-22 08:07:31'),
(8, 'উন্নয়ন তহবিলঃ এলজিএসপি', '0003-0003-0003-0003', '0.00', '2016-09-22 08:07:31'),
(9, 'উন্নয়ন তহবিলঃ ভূমি হস্তান্তর কর ১%', '0004-0004-0004-0004', '1000.00', '2019-07-04 11:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE `acl` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `widget` text NOT NULL,
  `ins_date` date NOT NULL,
  `insert_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `role_id`, `role_name`, `widget`, `ins_date`, `insert_by`) VALUES
(1, 1, 'Super Admin', 'index,nagorickapplicant,assessmentForm,rateSheet,holdingRateSheet,memberAddForm,nagorickInfo,nagorickGenarate,nagorickapplicant,nagorickInfo,upMap,nagorickBangla,nagorickEnglish,nagorickMoneyReceipt,tradelicenseapplicant,tradelicenseInfo,tradelicenseGenarate,tradelicenseapplicant,tradelicenseInfo,tradelicenseBangla,tradelicenseEnglish,tradelicenseMoneyReceipt,tradelicenseapplicant,warishapplicant,warishInfo,warishGenarate,warishapplicant,warishInfo,warishBangla,warishEnglish,warishMoneyReceipt,dailySubmit,taxCollection,bankTransfers,fundTransfers,allroshid,tradelicenseMoneyReceipt,tradelicense_tab_roshid,tradelicenseMoneyReceipt,bosodbitakor_tab_roshid,bosodbitakorMoneyReceipt,peshajibikor_tab_roshid,peshaMoneyReceipt,dailycollection_tab_roshid,dailyCollectionMoneyReceipt,nagoriksonod_tab_roshid,,warishsonod_tab_roshid,,trade_bosodbitakor_tab_roshid,tradeBosodbitakorMoneyReceipt,dailyCollection,dailyVatCollection,dailyBankDetails,dailyMainLedger,dailySubLedger,employeeList,employeeManage,role,role_list,webSiteUpMemberList,webSiteUpMemberUpdate,webSiteUpMemberDelete,webSiteUpMembterAdd,charimanMessage,newsManage,dynamicSlide,unionPorishad,toolSetting,newAccEntry,mainCtgEntry,SubCtgEntry,ExpCtgEntry,ExpSubCtgEntry,changePassword,adminProfile', '2016-02-10', 'admin'),
(2, 2, 'Only user', 'index,nagorickapplicant,nagorickapplicant,tradelicenseapplicant,tradelicenseapplicant,warishapplicant,taxCollection,bosodbitakor_tab_roshid', '2018-04-25', 'admin'),
(3, 3, 'aaa', 'index,nagorickapplicant,nagorickInfo,nagorickGenarate,nagorickapplicant,nagorickInfo,nagorickBangla,nagorickEnglish,nagorickMoneyReceipt,tradelicenseapplicant,tradelicenseInfo,tradelicenseGenarate,tradelicenseapplicant,tradelicenseInfo,tradelicenseBangla,tradelicenseEnglish,tradelicenseMoneyReceipt,tradelicenseapplicant,warishapplicant,warishInfo,warishGenarate,warishapplicant,warishInfo,warishBangla,warishEnglish,warishMoneyReceipt,dailySubmit,taxCollection,bankTransfers,fundTransfers,allroshid,tradelicenseMoneyReceipt,tradelicense_tab_roshid,tradelicenseMoneyReceipt,bosodbitakor_tab_roshid,bosodbitakorMoneyReceipt,peshajibikor_tab_roshid,peshaMoneyReceipt,dailycollection_tab_roshid,dailyCollectionMoneyReceipt,nagoriksonod_tab_roshid,,warishsonod_tab_roshid,,trade_bosodbitakor_tab_roshid,tradeBosodbitakorMoneyReceipt,dailyCollection,dailyVatCollection,dailyBankDetails,dailyMainLedger,dailySubLedger,employeeList,employeeManage,webSiteUpMemberList,webSiteUpMemberUpdate,webSiteUpMemberDelete,webSiteUpMembterAdd,charimanMessage,newsManage,dynamicSlide,upMap,unionPorishad,newAccEntry,mainCtgEntry,SubCtgEntry,ExpCtgEntry,ExpSubCtgEntry', '2019-07-06', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `fullname` varchar(60) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `passDateTime` date NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `desig` varchar(60) DEFAULT NULL,
  `pic` varchar(160) DEFAULT NULL,
  `sid` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `trans_pin_code` varchar(8) DEFAULT NULL,
  `verify_mobile` tinyint(3) DEFAULT NULL,
  `verify_email` tinyint(3) DEFAULT NULL,
  `question_id` smallint(6) UNSIGNED DEFAULT NULL,
  `security_setting` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role_id`, `username`, `fullname`, `pass`, `passDateTime`, `email`, `mobile`, `desig`, `pic`, `sid`, `status`, `trans_pin_code`, `verify_mobile`, `verify_email`, `question_id`, `security_setting`) VALUES
(1, 1, 'admin', 'Rana', '4297f44b13955235245b2497399d7a93', '2018-06-08', 'rana.feni.fci@gmail.com', '01825292980', 'DCB Adminitration', '60792881_357750605099138_2460133902526709760_n.jpg', '54ac5d3f9dfc81b9cfe6e734c3a237d5', '1', '', 1, 0, 0, '1'),
(2, 2, 'juned', 'juned', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00', 'mddeg@gmail.com', '01711245688', 'udc', '', '', '0', NULL, 1, NULL, NULL, '1'),
(3, 2, 'asif', 'asif', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00', 'tom@gmail.com', '01643734728', 'sa', '', '', '0', NULL, 1, NULL, NULL, '1'),
(4, 3, 'mithu.kibria', 'mithu.kibria', '830ba4e8afd75ad07b13b7698fe9128f', '0000-00-00', 'mithu.kibria@gmail.com', '01710531931', 'pertner', '', '04f4cb329b43995a5dad9359e2aff96b', '1', NULL, 1, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `app_list`
--

CREATE TABLE `app_list` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `app_mac` varchar(30) NOT NULL,
  `app_name` varchar(150) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_list`
--

INSERT INTO `app_list` (`id`, `app_id`, `app_mac`, `app_name`, `user_name`, `address`, `registered_date`) VALUES
(1, 2150, 'Online Registration', 'Correction_up', 'abs_rana', 'datacenter', '2016-09-24 09:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `app_validation`
--

CREATE TABLE `app_validation` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `license_key` varchar(500) NOT NULL,
  `duration` int(11) NOT NULL,
  `pc_user` varchar(80) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `license_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_validation`
--

INSERT INTO `app_validation` (`id`, `app_id`, `license_key`, `duration`, `pc_user`, `ip`, `license_date`) VALUES
(1, 2150, '97wqiQ48UMndgMNu1HV4qUqZV3VlSjeT2G7CAhj5zvd5jULgXKeWHW7ALq8qpiASyMBMiP/ivdmLCtQ4oxjKmoWcH4kxj7xviNa+JVjwTV2GV+hU8CjVaw+iGdj4iSvq', 500, 'Rana', '::1', '2018-03-23 07:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `buisnestypes`
--

CREATE TABLE `buisnestypes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buisnestypes`
--

INSERT INTO `buisnestypes` (`id`, `title`) VALUES
(1, 'আইটি'),
(2, 'contractor'),
(3, '\" ফোন - ফ্যাক্স \"'),
(4, '\" প্রিন্টিং ও প্যাকেজিং \"'),
(5, ' \" সরবরাহকারী \"'),
(6, '\" ক্যামিক্যাল ও হাউজ ক্লিনিং প্রোডাক্টস বিক্রেতা \"'),
(7, '\" পেপার কাটিং \"'),
(8, '\" (প্রথম শ্রেণী)  ঠিকাদার ও সরবরাহকারী \"'),
(9, '\" (দ্বিতীয় শ্রেণী) ঠিকাদার ও সরবরাহকারী \"'),
(10, '\" ( তৃতীয় শ্রেণী) ঠিকাদার ও সরবরাহকারী \"'),
(11, '  \"(ত্বিতীয় শ্রেণী) ঠিকাদার \"'),
(12, '\" ঠিকাদর \"'),
(13, '\" আটা তৈরী ও সরবরাহকারী \"');

-- --------------------------------------------------------

--
-- Table structure for table `chairman_message`
--

CREATE TABLE `chairman_message` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `update_by` varchar(40) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chairman_message`
--

INSERT INTO `chairman_message` (`id`, `title`, `message`, `update_by`, `update_time`) VALUES
(1, '', 'বাংলাদেশ সরকারের ‘ভিশন ২০২১ রূপকল্পে ডিজিটাল বাংলাদেশ গড়ার লক্ষে জনগণের দোরগোড়ায় সেবা এই স্লোগানকে সামনে রেখে গত ১১/১১/২০১০ খ্রিঃ তারিখ প্রধানমন্ত্রীর কার্যালয়ের একসেস টু ইনফরমেশন(এটুআই) প্রকল্পের আওতায় মাননীয় প্রধানমন্ত্রী ইউনিয়ন পরিষদে স্থাপিত তথ্য-প্রযুক্তি ভিত্তিক কেন্দ্র ‘ইউনিয়ন তথ্য ও সেবা কেন্দ্র(ইউআইএসসি)’ উদ্বোধন করেন। সরকারী নির্দেশনা মোতাবেক সিধলা ইউনিয়ন পরিষদ অফিসেও একটি তথ্য ও সেবা কেন্দ্র গড়ে তোলা হয়। ফলে এই তথ্য ও সেবা কেন্দ্র থেকে ইউনিয়নের সাধারণ জনগণ তাদের প্রয়োজনীয় নাগরিক সনদ ছাড়াও বিভিন্ন তথ্য প্রযুক্তি বিষয়ক সেবা গ্রহণ করতে পারছে। এই কেন্দ্রের সেবার পরিধি দিন দিন আরো বৃদ্ধি পাচ্ছে।  পরম করুনাময়ের কাছে তাই অশেষ কৃতজ্ঞতা। গত ২৩/০৬/২০১৪ খ্রিঃ তারিখ প্রধানমন্ত্রীর কার্যালয়ের একসেস টু ইনফরমেশন(এটুআই) প্রকল্পের আওতায় ‘জাতীয় তথ্য বাতায়ন’(National Web Portal) এর শুভ উদ্বোধন করা হয়। যা ডিজিটাল বাংলাদেশ বিনির্মানে একটি যুগান্তকারী পদক্ষেপ। এই তথ্য বাতায়নের অংশ হিসেবে সিধলা  ইউনিয়ন তথ্য বাতায়ন’(Union Web Portal) খোলা হয়েছে। আমাদের নিবেদিত প্রান উদ্যেক্তাগন যাকে দিন দিন সমৃদ্ধ করেছে। এই তথ্য বাতায়নের মাধ্যমে পৃথিবীর যেকোন প্রান্ত থেকে মানুষ এখন  সিধলা ইউনিয়নের ইতিহাস ও ঐতিহ্য, ভৌগলিক অবস্থা, ভাষা ও সংস্কৃতি, শিক্ষা, স্বাস্থ্য, কৃষি, যাতায়াত ব্যবস্থা, উন্নয়নমূলক কর্মকান্ড, সামাজিক সেবামূলক কর্মকান্ড ইত্যাদি বিষয়ক তথ্য জানতে পারবে। বর্তমান তথ্য প্রযুক্তির যুগে বিশ্ব মানুষের কাছে সিধলা ইউনিয়নকে তুলে ধরতে পারছি। আর এটা সম্ভব হয়েছে একমাত্র এই তথ্য বাতায়ন সৃষ্টির মধ্য দিয়েই। এজন্য আমি আমার ইউনিয়নবাসীর পক্ষ থেকে মাননীয় প্রধানমন্ত্রী ও এটুআই প্রকল্পের সাথে সংশ্লিষ্ট সকলেক আন্তরিক ধন্যবাদ জানাচ্ছি। সাথে সাথে এটাও ব্যক্ত করছি যে, জাতীয় কল্যাণ ও আমার ইউনিয়নের জন্য কল্যাণকর সরকারের এই ধরণের মহান কার্যক্রমে আমি ও আমার ইউনিয়নবাসী সর্বাত্নক সহযোগীতা করব। ', 'admin', '2018-07-17 20:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `cmd`
--

CREATE TABLE `cmd` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cmd`
--

INSERT INTO `cmd` (`id`, `title`) VALUES
(1, 'ব্যক্তি মালিকানাধীন'),
(2, 'যৌথ মালিকানা'),
(3, 'কোম্পানী');

-- --------------------------------------------------------

--
-- Table structure for table `credit_voucher`
--

CREATE TABLE `credit_voucher` (
  `id` bigint(16) UNSIGNED NOT NULL,
  `vno` bigint(16) UNSIGNED NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credit_voucher`
--

INSERT INTO `credit_voucher` (`id`, `vno`, `utime`) VALUES
(1, 1, '2018-06-07 22:54:49'),
(2, 2, '2018-06-07 22:57:08'),
(3, 3, '2018-07-17 20:37:17'),
(4, 4, '2018-07-17 21:10:39'),
(5, 5, '2018-10-03 19:52:24'),
(6, 6, '2018-10-08 19:58:22'),
(7, 7, '2019-05-24 19:23:05'),
(8, 8, '2019-05-24 19:26:17'),
(9, 9, '2019-05-27 06:14:42'),
(10, 10, '2019-05-27 06:19:35'),
(11, 11, '2019-05-27 06:20:57'),
(12, 12, '2019-05-30 05:25:07'),
(13, 13, '2019-05-30 06:15:06'),
(14, 14, '2019-06-29 19:55:07'),
(15, 15, '2019-07-01 04:46:00'),
(16, 16, '2019-07-01 04:46:43'),
(17, 17, '2019-07-01 04:47:12'),
(18, 18, '2019-07-03 04:57:03'),
(19, 19, '2019-07-03 05:05:49'),
(20, 20, '2019-07-04 05:29:25'),
(21, 21, '2019-07-04 11:16:10'),
(22, 22, '2019-07-04 11:17:45'),
(23, 23, '2019-07-06 09:16:42'),
(24, 24, '2019-07-07 17:11:31'),
(25, 25, '2019-07-08 08:58:20'),
(28, 26, '2019-07-14 15:11:57'),
(29, 27, '2019-07-17 05:05:26'),
(30, 28, '2019-07-17 12:03:08'),
(31, 29, '2019-07-19 05:14:19'),
(32, 30, '2020-08-31 08:59:36'),
(33, 31, '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `dailycollection`
--

CREATE TABLE `dailycollection` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `transid` bigint(20) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `voucherno` bigint(20) NOT NULL,
  `accounts` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paytype` varchar(50) NOT NULL,
  `slipno` varchar(100) NOT NULL,
  `chno` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `issue` date NOT NULL,
  `pono` varchar(100) NOT NULL,
  `ddno` varchar(100) NOT NULL,
  `ttno` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `des` text NOT NULL,
  `payment_date` date NOT NULL,
  `update_by` varchar(40) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dailycollection`
--

INSERT INTO `dailycollection` (`id`, `fid`, `catid`, `transid`, `sub_cat`, `voucherno`, `accounts`, `amount`, `paytype`, `slipno`, `chno`, `bank`, `issue`, `pono`, `ddno`, `ttno`, `purpose`, `des`, `payment_date`, `update_by`, `update_date`) VALUES
(1, 1, 7, 22, 11, 21, 'উন্নয়ন তহবিলঃ ভূমি হস্তান্তর কর ১%', '1000.00', 'cash', '', '', '', '0000-00-00', '', '', '', 'সরকারী অনুদান-ভূমি হস্তান্তর কর (১%),১ম কিস্তি', 'jhj', '2019-07-04', 'admin', '2019-07-04 11:16:10'),
(2, 2, 3, 23, 2, 22, 'CASH ACCOUNT', '2222.00', 'cash', '', '', '', '0000-00-00', '', '', '', 'লাইসেন্স ফি,ট্রেড লাইসেন্স ফি', 'jhjh', '2019-07-04', 'admin', '2019-07-04 11:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `dailyexp`
--

CREATE TABLE `dailyexp` (
  `id` int(11) UNSIGNED NOT NULL,
  `fid` int(11) UNSIGNED NOT NULL,
  `catid` int(11) UNSIGNED NOT NULL,
  `sub_cat` int(11) UNSIGNED NOT NULL,
  `transid` bigint(16) UNSIGNED NOT NULL,
  `voucherno` bigint(16) UNSIGNED NOT NULL,
  `accounts` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paytype` varchar(50) DEFAULT NULL,
  `slipno` varchar(100) DEFAULT NULL,
  `chno` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `issue` datetime NOT NULL,
  `pono` varchar(100) DEFAULT NULL,
  `ddno` varchar(100) DEFAULT NULL,
  `ttno` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `des` text DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `update_by` varchar(40) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dcb_login_history`
--

CREATE TABLE `dcb_login_history` (
  `history_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `device_browser` text DEFAULT NULL,
  `pc_ip` varchar(30) DEFAULT NULL,
  `mac` varchar(30) DEFAULT NULL,
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_login_history`
--

INSERT INTO `dcb_login_history` (`history_id`, `user_id`, `device_browser`, `pc_ip`, `mac`, `login_time`, `logout_time`) VALUES
(1, 1, 'Chrome 66.0.3359.181', '::1', 'mac', '2018-06-08 04:34:42', '0000-00-00 00:00:00'),
(2, 1, 'Chrome 67.0.3396.79', '::1', 'mac', '2018-06-08 23:42:39', '0000-00-00 00:00:00'),
(3, 1, 'Chrome 67.0.3396.79', '::1', 'mac', '2018-06-09 22:09:32', '0000-00-00 00:00:00'),
(4, 1, 'Chrome 67.0.3396.99', '::1', 'mac', '2018-07-02 01:21:43', '0000-00-00 00:00:00'),
(5, 1, 'Chrome 67.0.3396.99', '::1', 'mac', '2018-07-03 22:47:12', '0000-00-00 00:00:00'),
(6, 1, 'Chrome 67.0.3396.99', '::1', 'mac', '2018-07-04 01:17:48', '0000-00-00 00:00:00'),
(7, 1, 'Chrome 67.0.3396.99', '::1', 'mac', '2018-07-18 02:16:10', '0000-00-00 00:00:00'),
(8, 1, 'Chrome 67.0.3396.99', '::1', 'mac', '2018-07-22 00:45:40', '0000-00-00 00:00:00'),
(9, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-08-16 12:46:25', '0000-00-00 00:00:00'),
(10, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-08-18 22:04:39', '0000-00-00 00:00:00'),
(11, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-09-03 23:54:55', '2018-09-03 23:57:39'),
(12, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-09-05 01:11:27', '0000-00-00 00:00:00'),
(13, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-09-07 01:57:08', '0000-00-00 00:00:00'),
(14, 1, 'Chrome 68.0.3440.106', '::1', 'mac', '2018-09-08 00:32:10', '0000-00-00 00:00:00'),
(15, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-03 00:44:08', '0000-00-00 00:00:00'),
(16, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-03 23:56:14', '0000-00-00 00:00:00'),
(17, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-05 01:21:48', '0000-00-00 00:00:00'),
(18, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-06 00:44:44', '0000-00-00 00:00:00'),
(19, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-06 23:15:38', '0000-00-00 00:00:00'),
(20, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-07 01:19:29', '0000-00-00 00:00:00'),
(21, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-10-09 01:55:28', '0000-00-00 00:00:00'),
(22, 1, 'Chrome 69.0.3497.100', '::1', 'mac', '2018-11-01 01:21:27', '0000-00-00 00:00:00'),
(23, 1, 'Chrome 71.0.3578.98', '::1', 'mac', '2018-12-23 23:50:09', '0000-00-00 00:00:00'),
(24, 1, 'Chrome 71.0.3578.98', '::1', 'mac', '2019-02-03 00:46:11', '0000-00-00 00:00:00'),
(25, 1, 'Chrome 71.0.3578.98', '::1', 'mac', '2019-02-03 23:13:48', '0000-00-00 00:00:00'),
(26, 1, 'Chrome 73.0.3683.103', '::1', 'mac', '2019-04-25 00:56:03', '0000-00-00 00:00:00'),
(27, 1, 'Chrome 73.0.3683.103', '::1', 'mac', '2019-04-28 23:49:11', '0000-00-00 00:00:00'),
(28, 1, 'Chrome 73.0.3683.103', '::1', 'mac', '2019-05-01 21:53:03', '0000-00-00 00:00:00'),
(29, 1, 'Chrome 73.0.3683.103', '::1', 'mac', '2019-05-07 00:50:37', '0000-00-00 00:00:00'),
(30, 1, 'Chrome 74.0.3729.157', '::1', 'mac', '2019-05-20 00:30:24', '0000-00-00 00:00:00'),
(31, 1, 'Chrome 74.0.3729.157', '::1', 'mac', '2019-05-24 15:17:36', '0000-00-00 00:00:00'),
(32, 1, 'Chrome 74.0.3729.157', '::1', 'mac', '2019-05-24 23:57:54', '0000-00-00 00:00:00'),
(33, 1, 'Chrome 74.0.3729.169', '118.179.175.107', 'mac', '2019-05-25 16:39:33', '0000-00-00 00:00:00'),
(34, 1, 'Firefox 67.0', '103.107.161.114', 'mac', '2019-05-26 11:30:28', '0000-00-00 00:00:00'),
(35, 1, 'Firefox 68.0', '103.107.161.114', 'mac', '2019-05-26 11:35:52', '0000-00-00 00:00:00'),
(36, 1, 'Chrome 74.0.3729.169', '103.107.161.114', 'mac', '2019-05-27 12:07:04', '0000-00-00 00:00:00'),
(37, 1, 'Chrome 74.0.3729.169', '103.107.161.114', 'mac', '2019-05-30 11:04:40', '0000-00-00 00:00:00'),
(38, 1, 'Chrome 74.0.3729.136', '116.58.203.112', 'mac', '2019-06-04 13:16:48', '0000-00-00 00:00:00'),
(39, 1, 'Chrome 73.0.3683.86', '119.82.76.18', 'mac', '2019-06-12 15:04:46', '2019-06-12 15:08:52'),
(40, 1, 'Chrome 75.0.3770.89', '103.67.159.86', 'mac', '2019-06-30 01:51:07', '0000-00-00 00:00:00'),
(41, 1, 'Chrome 75.0.3770.100', '103.67.159.201', 'mac', '2019-06-30 17:19:05', '0000-00-00 00:00:00'),
(42, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-06-30 21:15:42', '0000-00-00 00:00:00'),
(43, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 00:14:31', '0000-00-00 00:00:00'),
(44, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 00:20:19', '0000-00-00 00:00:00'),
(45, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 00:21:21', '0000-00-00 00:00:00'),
(46, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 00:23:27', '0000-00-00 00:00:00'),
(47, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 00:23:49', '0000-00-00 00:00:00'),
(48, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-01 10:23:39', '0000-00-00 00:00:00'),
(49, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-01 23:11:28', '0000-00-00 00:00:00'),
(50, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-02 11:04:52', '0000-00-00 00:00:00'),
(51, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-02 15:17:32', '0000-00-00 00:00:00'),
(52, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-03 10:42:48', '0000-00-00 00:00:00'),
(53, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-04 10:28:07', '0000-00-00 00:00:00'),
(54, 1, 'Opera 60.0.3255.170', '103.79.183.231', 'mac', '2019-07-04 11:40:54', '0000-00-00 00:00:00'),
(55, 1, 'Chrome 75.0.3770.80', '116.58.201.24', 'mac', '2019-07-04 16:49:45', '0000-00-00 00:00:00'),
(56, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-05 17:18:28', '0000-00-00 00:00:00'),
(57, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-05 23:00:08', '0000-00-00 00:00:00'),
(58, 1, 'Firefox 68.0', '119.30.32.161', 'mac', '2019-07-06 14:41:40', '2019-07-06 14:46:00'),
(59, 2, 'Firefox 68.0', '119.30.32.161', 'mac', '2019-07-06 14:46:06', '2019-07-06 14:46:21'),
(60, 1, 'Firefox 68.0', '119.30.32.161', 'mac', '2019-07-06 14:51:30', '2019-07-06 14:58:53'),
(61, 1, 'Firefox 68.0', '119.30.38.151', 'mac', '2019-07-06 15:13:53', '0000-00-00 00:00:00'),
(62, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-06 16:08:05', '0000-00-00 00:00:00'),
(63, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-07 11:06:07', '0000-00-00 00:00:00'),
(64, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-07 15:44:06', '0000-00-00 00:00:00'),
(65, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-07 23:05:38', '0000-00-00 00:00:00'),
(66, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-08 10:30:31', '0000-00-00 00:00:00'),
(67, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-09 11:19:46', '2019-07-09 15:15:58'),
(68, 1, 'Opera 60.0.3255.170', '103.79.183.231', 'mac', '2019-07-09 12:58:59', '0000-00-00 00:00:00'),
(69, 3, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-09 15:16:07', '2019-07-09 15:17:30'),
(70, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-09 15:17:34', '0000-00-00 00:00:00'),
(71, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-09 18:15:25', '0000-00-00 00:00:00'),
(72, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-10 00:14:55', '0000-00-00 00:00:00'),
(73, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-10 10:24:10', '0000-00-00 00:00:00'),
(74, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-10 12:52:18', '0000-00-00 00:00:00'),
(75, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-10 15:43:56', '0000-00-00 00:00:00'),
(76, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-11 00:21:34', '0000-00-00 00:00:00'),
(77, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-11 10:33:24', '0000-00-00 00:00:00'),
(78, 1, 'Opera 62.0.3331.43', '103.79.183.231', 'mac', '2019-07-11 17:39:13', '0000-00-00 00:00:00'),
(79, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-11 18:43:58', '0000-00-00 00:00:00'),
(80, 1, 'Firefox 67.0', '103.67.156.131', 'mac', '2019-07-12 16:53:48', '0000-00-00 00:00:00'),
(81, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-13 17:27:11', '0000-00-00 00:00:00'),
(82, 1, 'Chrome 75.0.3770.101', '116.58.200.52', 'mac', '2019-07-13 20:33:54', '0000-00-00 00:00:00'),
(83, 1, 'Chrome 75.0.3770.100', '103.197.155.216', 'mac', '2019-07-14 14:14:08', '0000-00-00 00:00:00'),
(84, 1, 'Firefox 68.0', '103.67.158.54', 'mac', '2019-07-14 21:04:45', '0000-00-00 00:00:00'),
(85, 4, 'Chrome 75.0.3770.101', '103.67.158.54', 'mac', '2019-07-14 21:40:36', '0000-00-00 00:00:00'),
(86, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-15 11:56:25', '0000-00-00 00:00:00'),
(87, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-15 13:10:01', '0000-00-00 00:00:00'),
(88, 1, 'Chrome 55.0.2883.87', '103.120.201.165', 'mac', '2019-07-15 13:13:49', '0000-00-00 00:00:00'),
(89, 1, 'Chrome 75.0.3770.100', '202.181.17.164', 'mac', '2019-07-15 16:10:46', '0000-00-00 00:00:00'),
(90, 1, 'Firefox 68.0', '43.245.122.10', 'mac', '2019-07-15 16:52:28', '0000-00-00 00:00:00'),
(91, 1, 'Opera 62.0.3331.72', '103.79.183.210', 'mac', '2019-07-15 16:53:46', '0000-00-00 00:00:00'),
(92, 4, 'Chrome 75.0.3770.101', '116.58.202.88', 'mac', '2019-07-15 21:11:10', '0000-00-00 00:00:00'),
(93, 4, 'Chrome 75.0.3770.101', '103.130.115.46', 'mac', '2019-07-15 23:33:09', '0000-00-00 00:00:00'),
(94, 4, 'Chrome 75.0.3770.101', '103.130.115.46', 'mac', '2019-07-16 00:14:50', '0000-00-00 00:00:00'),
(95, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-16 10:31:29', '0000-00-00 00:00:00'),
(96, 4, 'Chrome 75.0.3770.100', '103.78.163.225', 'mac', '2019-07-16 15:09:59', '0000-00-00 00:00:00'),
(97, 1, 'Opera 62.0.3331.72', '103.79.183.210', 'mac', '2019-07-16 16:55:22', '0000-00-00 00:00:00'),
(98, 1, 'Chrome 75.0.3770.100', '118.179.175.107', 'mac', '2019-07-16 23:29:46', '0000-00-00 00:00:00'),
(99, 1, 'Opera 62.0.3331.72', '103.79.183.210', 'mac', '2019-07-16 23:35:57', '0000-00-00 00:00:00'),
(100, 4, 'Chrome 75.0.3770.101', '116.58.201.105', 'mac', '2019-07-17 08:28:45', '0000-00-00 00:00:00'),
(101, 1, 'Firefox 68.0', '103.67.157.77', 'mac', '2019-07-17 11:02:01', '0000-00-00 00:00:00'),
(102, 4, 'Chrome 75.0.3770.101', '103.130.115.46', 'mac', '2019-07-17 12:39:16', '0000-00-00 00:00:00'),
(103, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-17 15:42:50', '0000-00-00 00:00:00'),
(104, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-17 18:02:41', '0000-00-00 00:00:00'),
(105, 1, 'Chrome 75.0.3770.142', '103.67.156.253', 'mac', '2019-07-17 22:09:09', '0000-00-00 00:00:00'),
(106, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-18 13:24:46', '0000-00-00 00:00:00'),
(107, 1, 'Opera 62.0.3331.72', '103.79.183.231', 'mac', '2019-07-18 16:02:58', '0000-00-00 00:00:00'),
(108, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-18 16:33:43', '0000-00-00 00:00:00'),
(109, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-18 16:35:07', '0000-00-00 00:00:00'),
(110, 1, 'Chrome 75.0.3770.142', '103.60.175.27', 'mac', '2019-07-19 00:07:39', '0000-00-00 00:00:00'),
(111, 4, 'Chrome 75.0.3770.101', '103.130.115.46', 'mac', '2019-07-19 05:49:31', '0000-00-00 00:00:00'),
(112, 1, 'Chrome 75.0.3770.142', '118.179.175.107', 'mac', '2019-07-19 11:12:18', '0000-00-00 00:00:00'),
(113, 4, 'Chrome 75.0.3770.101', '103.130.115.46', 'mac', '2019-07-20 17:09:11', '0000-00-00 00:00:00'),
(114, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-21 13:10:36', '0000-00-00 00:00:00'),
(115, 1, 'Firefox 68.0', '42.0.5.246', 'mac', '2019-07-21 16:19:34', '0000-00-00 00:00:00'),
(116, 1, 'Chrome 75.0.3770.142', '202.181.17.181', 'mac', '2019-07-21 17:02:46', '0000-00-00 00:00:00'),
(117, 1, 'Chrome 85.0.4183.83', '103.205.71.20', 'mac', '2020-08-31 14:51:58', '2020-08-31 15:25:54'),
(118, 1, 'Chrome 85.0.4183.83', '103.205.71.20', 'mac', '2020-08-31 15:26:22', '2020-08-31 15:26:28'),
(119, 1, 'Chrome 84.0.4147.135', '123.49.33.161', 'mac', '2020-08-31 17:52:37', '0000-00-00 00:00:00'),
(120, 1, 'Chrome 85.0.4183.102', '103.205.71.20', 'mac', '2020-09-10 21:34:25', '2020-09-10 21:34:48'),
(121, 1, 'Chrome 85.0.4183.102', '103.137.7.10', 'mac', '2020-09-14 10:13:11', '0000-00-00 00:00:00'),
(122, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 20:15:36', '0000-00-00 00:00:00'),
(123, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 21:56:35', '0000-00-00 00:00:00'),
(124, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 21:56:51', '0000-00-00 00:00:00'),
(125, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:09:02', '0000-00-00 00:00:00'),
(126, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:09:08', '0000-00-00 00:00:00'),
(127, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:32:49', '0000-00-00 00:00:00'),
(128, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:39:34', '0000-00-00 00:00:00'),
(129, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:40:40', '0000-00-00 00:00:00'),
(130, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:41:30', '0000-00-00 00:00:00'),
(131, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:42:37', '0000-00-00 00:00:00'),
(132, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:43:19', '0000-00-00 00:00:00'),
(133, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:44:19', '0000-00-00 00:00:00'),
(134, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:44:36', '0000-00-00 00:00:00'),
(135, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:48:35', '0000-00-00 00:00:00'),
(136, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:48:59', '0000-00-00 00:00:00'),
(137, 1, 'Chrome 85.0.4183.102', '::1', 'mac', '2020-09-21 22:50:40', '0000-00-00 00:00:00'),
(138, 1, 'Chrome 86.0.4240.193', '::1', 'mac', '2020-11-13 19:23:12', '0000-00-00 00:00:00'),
(139, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-14 00:56:49', '0000-00-00 00:00:00'),
(140, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-14 22:00:17', '0000-00-00 00:00:00'),
(141, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-26 20:41:22', '0000-00-00 00:00:00'),
(142, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-27 03:13:19', '2020-12-27 03:38:50'),
(143, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-29 21:19:53', '0000-00-00 00:00:00'),
(144, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-30 08:05:33', '0000-00-00 00:00:00'),
(145, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-30 18:55:22', '0000-00-00 00:00:00'),
(146, 1, 'Chrome 87.0.4280.88', '::1', 'mac', '2020-12-30 23:20:48', '0000-00-00 00:00:00'),
(147, 1, 'Chrome 87.0.4280.88', '103.205.71.20', 'mac', '2020-12-31 00:42:08', '2020-12-31 00:42:14'),
(148, 1, 'Chrome 87.0.4280.88', '103.205.71.20', 'mac', '2020-12-31 01:02:13', '0000-00-00 00:00:00'),
(149, 1, 'Chrome 87.0.4280.101', '45.251.228.119', 'mac', '2020-12-31 01:09:14', '0000-00-00 00:00:00'),
(150, 1, 'Chrome 88.0.4324.150', '103.205.71.20', 'mac', '2021-02-15 08:16:57', '2021-02-15 08:18:50'),
(151, 1, 'Chrome 88.0.4324.150', '103.205.71.20', 'mac', '2021-02-15 08:19:46', '2021-02-15 08:21:26'),
(152, 1, 'Chrome 88.0.4324.150', '::1', 'mac', '2021-02-16 00:29:17', '2021-02-16 00:29:25'),
(153, 1, 'Chrome 88.0.4324.150', '::1', 'mac', '2021-02-16 14:58:45', '0000-00-00 00:00:00'),
(154, 1, 'Chrome 88.0.4324.150', '::1', 'mac', '2021-02-16 15:10:19', '0000-00-00 00:00:00'),
(155, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-21 12:09:30', '0000-00-00 00:00:00'),
(156, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-21 18:02:03', '0000-00-00 00:00:00'),
(157, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-21 21:58:15', '0000-00-00 00:00:00'),
(158, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-22 08:06:52', '0000-00-00 00:00:00'),
(159, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-24 08:09:14', '0000-00-00 00:00:00'),
(160, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-25 23:29:19', '0000-00-00 00:00:00'),
(161, 1, 'Chrome 88.0.4324.182', '::1', 'mac', '2021-02-26 09:36:42', '0000-00-00 00:00:00'),
(162, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-02-26 17:21:55', '0000-00-00 00:00:00'),
(163, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-02-26 22:03:42', '0000-00-00 00:00:00'),
(164, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-02-27 10:59:12', '0000-00-00 00:00:00'),
(165, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-02-27 23:09:43', '0000-00-00 00:00:00'),
(166, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-02-28 23:31:32', '0000-00-00 00:00:00'),
(167, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-03-01 21:08:11', '0000-00-00 00:00:00'),
(168, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-03-02 08:06:50', '0000-00-00 00:00:00'),
(169, 1, 'Chrome 88.0.4324.190', '::1', 'mac', '2021-03-02 22:54:22', '2021-03-03 03:00:13'),
(170, 1, 'Chrome 89.0.4389.72', '::1', 'mac', '2021-03-03 18:21:43', '2021-03-03 19:33:59'),
(171, 1, 'Chrome 89.0.4389.72', '::1', 'mac', '2021-03-03 19:35:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dcb_mobile_verfication`
--

CREATE TABLE `dcb_mobile_verfication` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dcb_security_question`
--

CREATE TABLE `dcb_security_question` (
  `question_id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_security_question`
--

INSERT INTO `dcb_security_question` (`question_id`, `title`) VALUES
(1, 'What was your favorite color?'),
(2, 'What was your childhood nickname?'),
(3, 'What is the name of your favorite childhood friend?'),
(4, 'What is the middle name of your oldest child?'),
(5, 'What is your favorite team?'),
(6, 'What is your favorite movie?'),
(7, 'What was your favorite sport in high school?'),
(8, 'What was your favorite food as a child?'),
(9, 'What was the make and model of your first car?'),
(10, 'What was the name of the hospital where you were born?'),
(11, 'Who is your childhood sports hero?'),
(12, 'What school did you attend for sixth grade?'),
(13, 'What was the last name of your third grade teacher?'),
(14, 'What was the name of the company where you had your first job?');

-- --------------------------------------------------------

--
-- Table structure for table `dcb_security_setting`
--

CREATE TABLE `dcb_security_setting` (
  `security_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `two_step_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `security_question_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `trans_pin_code` enum('on','off') NOT NULL DEFAULT 'off',
  `mobile_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `email_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `send_sms_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `random_picture_verify` enum('on','off') NOT NULL DEFAULT 'off',
  `password_complexity` enum('on','off') NOT NULL DEFAULT 'off',
  `pass_change_45_days` enum('on','off') NOT NULL DEFAULT 'off',
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_security_setting`
--

INSERT INTO `dcb_security_setting` (`security_id`, `user_id`, `two_step_verify`, `security_question_verify`, `trans_pin_code`, `mobile_verify`, `email_verify`, `send_sms_verify`, `random_picture_verify`, `password_complexity`, `pass_change_45_days`, `entry_date`) VALUES
(1, 1, 'on', 'on', 'off', 'on', 'on', 'on', 'on', 'off', 'off', '2018-06-08 10:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `dcb_sms`
--

CREATE TABLE `dcb_sms` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `api_key` text DEFAULT NULL,
  `api_url` text DEFAULT NULL,
  `credit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dcb_sms_notification`
--

CREATE TABLE `dcb_sms_notification` (
  `id` int(11) NOT NULL,
  `wedgets` text NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_sms_notification`
--

INSERT INTO `dcb_sms_notification` (`id`, `wedgets`, `entry_date`) VALUES
(1, 'tradelicense_app_on,tradelicense_sonod_on,tradelicense_renew_On,oarish_app_on,oarish_sonod_on', '2016-07-19 06:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `dcb_sms_setting`
--

CREATE TABLE `dcb_sms_setting` (
  `id` int(11) NOT NULL,
  `sms_type` tinyint(2) NOT NULL,
  `msg` text NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_sms_setting`
--

INSERT INTO `dcb_sms_setting` (`id`, `sms_type`, `msg`, `entry_date`) VALUES
(1, 1, 'আপনার  ট্র্যাকিং নং  অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন দয়া করে', '2016-07-20 02:16:54'),
(2, 2, 'আপনার  ট্র্যাকিং নং অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2016-07-20 02:17:44'),
(3, 3, 'আপনার  ট্র্যাকিং নং অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2016-07-20 02:17:53'),
(4, 4, 'দয়া করে আপনার  সার্টিফিকেট নবায়ন করুণ  দয়া করে আপনার  সার্টিফিকেট নবায়ন করুণ  দয়া করে আপনার  সার্টিফিকেট নবায়ন করুণ ', '2016-07-21 04:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `dcb_sq_ans`
--

CREATE TABLE `dcb_sq_ans` (
  `ans_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ans` text NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dcb_sq_ans`
--

INSERT INTO `dcb_sq_ans` (`ans_id`, `user_id`, `question_id`, `ans`, `entry_date`) VALUES
(1, 1, 1, 'black', '2018-06-07 21:09:30'),
(2, 1, 2, 'alam', '2018-06-07 21:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `debit_voucher`
--

CREATE TABLE `debit_voucher` (
  `id` bigint(16) NOT NULL,
  `vno` bigint(20) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debit_voucher`
--

INSERT INTO `debit_voucher` (`id`, `vno`, `utime`) VALUES
(1, 1, '2018-08-18 16:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `exphead`
--

CREATE TABLE `exphead` (
  `id` int(11) UNSIGNED NOT NULL,
  `fund` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exphead`
--

INSERT INTO `exphead` (`id`, `fund`, `title`, `balance`) VALUES
(1, 2, 'সাধারন সংস্হাপন', '0.00'),
(2, 1, 'যোগাযোগ', '0.00'),
(3, 2, 'স্বাস্থ্য', '0.00'),
(4, 1, 'পানি সরবরাহ', '0.00'),
(5, 1, 'শিক্ষা', '0.00'),
(6, 1, 'প্রাকৃতিক সম্পদ ব্যবস্হাপনা', '0.00'),
(7, 1, 'কৃষি ও বাজার', '0.00'),
(8, 1, 'পয়নিষ্কাশন এবং বর্জ্য ব্যবস্থাপনা', '0.00'),
(9, 1, 'মানব সম্পদ উন্নয়ন', '0.00'),
(10, 1, 'অন্যান্য', '0.00'),
(11, 1, 'এলজিএসপি ফান্ড ফেরত হইতে ব্যয়', '0.00'),
(12, 1, 'অন্যা্ন্য ফান্ড ফেরত হইতে ব্যয়', '0.00'),
(13, 2, 'অডিট', '0.00'),
(14, 1, 'অগ্রিম', '0.00'),
(15, 2, 'Tax comition', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `expurpose`
--

CREATE TABLE `expurpose` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expurpose`
--

INSERT INTO `expurpose` (`id`, `pid`, `pname`, `balance`) VALUES
(1, 1, 'চেয়ারম্যান ও সদস্যদের ভাতা', '0.00'),
(2, 1, 'সেক্রেটারী ও অন্যান্য কর্মচারীদের বেতন', '0.00'),
(3, 5, 'কাবিখা', '0.00'),
(4, 5, 'টি আর', '0.00'),
(5, 3, 'এডিপি', '0.00'),
(6, 3, 'অতিদরিদ্র কর্মসূচি', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `food_dealer_info`
--

CREATE TABLE `food_dealer_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1= Dealert, 2= issue kito authority',
  `name` varchar(300) DEFAULT NULL,
  `shop_name` varchar(500) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `designation` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_time` date DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` date DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_dealer_info`
--

INSERT INTO `food_dealer_info` (`id`, `type`, `name`, `shop_name`, `address`, `mobile`, `designation`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 1, 'শরীফুল ইসলাম', 'শরীফ ট্রেডার্স', 'নাটোর সদর উপজেলা', '01839707645', NULL, 1, NULL, NULL, NULL, 1, '2021-03-03', '::1'),
(2, 1, 'মেহেদী হাসান রুদ্র', 'রুদ্র ট্রেডার্স', 'নাটোর সদর উপজেলা', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'করিমুল হক', '', 'নাটোর সদর উপজেলা', '3', '', 1, NULL, NULL, NULL, 1, '2021-03-03', '::1'),
(4, 2, 'আবদুর রহমান', '', 'নাটোর সদর উপজেলা', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 't', 'tt', '3', '4', NULL, 1, 1, '2021-03-03', '::1', NULL, NULL, NULL),
(6, 1, '3', '4', '5', '6', NULL, 1, 1, '2021-03-03', '::1', NULL, NULL, NULL),
(7, 1, 't', '3', '4', '4', NULL, 1, 1, '2021-03-03', '::1', NULL, NULL, NULL),
(8, 1, '34', '54', '34', '33', NULL, 0, 1, '2021-03-03', '::1', 1, '2021-03-03', '::1'),
(9, 1, '33', 't', 't', '3', NULL, 0, 1, '2021-03-03', '::1', 1, '2021-03-03', '::1'),
(10, 1, 't', '3', '3', '3', NULL, 0, 1, '2021-03-03', '::1', 1, '2021-03-03', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `food_program_info`
--

CREATE TABLE `food_program_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `person_amt` int(10) UNSIGNED DEFAULT NULL,
  `total_allotment` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL COMMENT '1=Kg, 2=Mattik ton',
  `food_type` tinyint(1) DEFAULT NULL COMMENT '1 = চাল, 2 = অন্যান্য'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_program_info`
--

INSERT INTO `food_program_info` (`id`, `title`, `person_amt`, `total_allotment`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`, `unit_id`, `food_type`) VALUES
(1, 'মার্চ - ২০২১', 30, 30000, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(2, 'test', 33, 3, 0, 1, '2021-03-03 01:11:23', '::1', 1, '2021-03-03 02:12:44', '::1', NULL, NULL),
(3, 't', 3, 3, 0, 1, '2021-03-03 01:12:22', '::1', 1, '2021-03-03 02:19:56', '::1', NULL, NULL),
(4, 'hello the world r', 3, 3, 0, 1, '2021-03-03 01:13:39', '::1', 1, '2021-03-03 02:14:28', '::1', NULL, NULL),
(5, 'মার্চ - ২০২১', 30, 30000, 0, 1, '2021-03-03 01:52:26', '::1', 1, '2021-03-03 02:20:00', '::1', NULL, NULL),
(6, 'মার্চ - ২০২১', 30, 30000, 2, 1, '2021-03-03 01:54:56', '::1', NULL, NULL, NULL, NULL, NULL),
(7, 'মার্চ - ২০২১ tes', 30, 30000, 0, 1, '2021-03-03 01:55:12', '::1', 1, '2021-03-03 02:12:35', '::1', NULL, NULL),
(8, 'মার্চ - ২০২১ tes 3', 30, 30000, 0, 1, '2021-03-03 01:55:12', '::1', 1, '2021-03-03 02:12:29', '::1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_receiver_applicant_info`
--

CREATE TABLE `food_receiver_applicant_info` (
  `id` int(11) NOT NULL,
  `applicant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `card_no` varchar(17) DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `name` varchar(350) DEFAULT NULL,
  `father_name` varchar(350) DEFAULT NULL,
  `mother_name` varchar(350) DEFAULT NULL,
  `guardin_type` tinyint(4) DEFAULT NULL,
  `occupation` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `card_issue_dt` date DEFAULT NULL,
  `finger_print_template` blob DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `wordNo` varchar(11) DEFAULT NULL,
  `post_office` varchar(200) DEFAULT NULL,
  `upazila` varchar(200) DEFAULT NULL,
  `district` varchar(200) DEFAULT NULL,
  `issueingAuthority` int(11) DEFAULT NULL,
  `pic` text DEFAULT NULL,
  `spouse_name` varchar(500) DEFAULT NULL,
  `is_verify` tinyint(1) UNSIGNED DEFAULT 1 COMMENT '1 = Not Verify,  2=verified By NID ',
  `api_data` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_receiver_applicant_info`
--

INSERT INTO `food_receiver_applicant_info` (`id`, `applicant_id`, `card_no`, `nid`, `name`, `father_name`, `mother_name`, `guardin_type`, `occupation`, `address`, `dealer_id`, `mobile`, `card_issue_dt`, `finger_print_template`, `date_of_birth`, `village`, `wordNo`, `post_office`, `upazila`, `district`, `issueingAuthority`, `pic`, `spouse_name`, `is_verify`, `api_data`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 2021030001, '01', '3287844728', 'মোঃ শরীফুল ইসলাম', 'আবদুল মালেক', NULL, 1, '1', NULL, 1, '01839707645', '2021-02-10', NULL, '1994-06-27', 'মসজিদ রোড', '', 'ফেনী সদর-৩৯০০', 'ফেনী সদর', 'ফেনী', 3, 'library/NID_image/NID_VERIFY_IMAGE_263704032603bf79718507.jpg', NULL, 2, '{\"name\":\"মোঃ শরীফুল ইসলাম\",\"nameEn\":\"MD. SHORIFUL ISLAM\",\"father\":\"আবদুল মালেক\",\"mother\":\"খোরশীদা বেগম\",\"gender\":\"male\",\"spouse\":null,\"dob\":\"06/27/1994\",\"permanentAddress\":\"বাসা/হোল্ডিং: ০৫৪৫০১, গ্রাম/রাস্তা: মসজিদ রোড, ওয়ার্ড নং-০৬, ডাকঘর: ফেনী সদর-৩৯০০, ফেনী সদর, ফেনী\",\"presentAddress\":null,\"photo\":\"\",\"fatherEn\":\"Abdul Malek\",\"motherEn\":\"Khorshida Begum\",\"spouseEn\":null,\"permanentAddressEn\":\"Home / Holding: 054501, Village / Road: Masjid Road, Ward No-06, Post Office: Feni Sadar-3900, Feni Sadar, Feni\",\"presentAddressEn\":null,\"dobNew\":\"27-06-1994\",\"holding_basha\":\" ০৫৪৫০১\",\"village\":\"মসজিদ রোড\",\"post_office\":\"ফেনী সদর-৩৯০০\",\"upazila\":\"ফেনী সদর\",\"district\":\"ফেনী\",\"image\":\"library/NID_image/NID_VERIFY_IMAGE_263704032603bf79718507.jpg\"}', 1, 1, '2021-03-01 02:05:58', '::1', NULL, NULL, NULL),
(2, 2021030002, '123654', '3287844728', 'মোঃ ওমর ফারুক', 'সিরাজুল ইসলাম', NULL, 1, '2', NULL, 1, '01839707645', '2021-02-10', NULL, '2021-03-26', 'লেমুয়া', '3', 'লেমুয়া বাজার-৩৯০০', 'ফেনী সদর', 'ফেনী', 3, 'library/NID_image/NID_UPLOADED_IMAGE_161461546424105.PNG', NULL, 1, '1', 1, 1, '2021-03-01 22:17:44', '::1', NULL, NULL, NULL),
(3, 2021030003, '003', '3287844728', 'আবু বক্কর ছিদ্দিক', 'আবদুল মমিন', NULL, 1, '1', NULL, 2, '01830320809', '2021-02-04', NULL, '1995-08-15', 'উত্তর জায়লস্কর', '16', 'জায়লস্কর-৩৯০০', 'দাগনভূঁঞা', 'ফেনী', 3, 'library/NID_image/NID_VERIFY_IMAGE_2061306080603d33512af87.jpg', NULL, 2, '{\"name\":\"আবু বক্কর ছিদ্দিক\",\"nameEn\":\"ABU BAKER SIDDIQUE\",\"father\":\"আবদুল মমিন\",\"mother\":\"রেজিয়া বেগম\",\"gender\":\"male\",\"spouse\":null,\"dob\":\"08/15/1995\",\"permanentAddress\":\"বাসা/হোল্ডিং: হাসেম মাষ্টার বাড়ি, গ্রাম/রাস্তা: উত্তর জায়লস্কর, জায়লস্কর, ডাকঘর: জায়লস্কর-৩৯০০, দাগনভূঁঞা, ফেনী\",\"presentAddress\":null,\"photo\":\"\",\"fatherEn\":\"Abdul Momin\",\"motherEn\":\"Rezia Begum\",\"spouseEn\":null,\"permanentAddressEn\":\"Home / Holding: Hashem Master House, Village / Road: North Jailskar, Jailskar, Post Office: Jailskar-3900, Daganbhuna, Feni\",\"presentAddressEn\":null,\"dobNew\":\"15-08-1995\",\"holding_basha\":\" হাসেম মাষ্টার বাড়ি\",\"village\":\"উত্তর জায়লস্কর\",\"post_office\":\"জায়লস্কর-৩৯০০\",\"upazila\":\"দাগনভূঁঞা\",\"district\":\"ফেনী\",\"image\":\"library/NID_image/NID_VERIFY_IMAGE_2061306080603d33512af87.jpg\"}', 1, 1, '2021-03-02 00:33:16', '::1', NULL, NULL, NULL),
(4, 2021030004, '003', '3287844728', 'আবু বক্কর ছিদ্দিক', 'আবদুল মমিন', NULL, 1, '1', NULL, 2, '01830320809', '2021-02-04', NULL, '1995-08-15', 'উত্তর জায়লস্কর', '16', 'জায়লস্কর-৩৯০০', 'দাগনভূঁঞা', 'ফেনী', 3, 'library/NID_image/NID_VERIFY_IMAGE_2061306080603d33512af87.jpg', NULL, 2, '{\"name\":\"আবু বক্কর ছিদ্দিক\",\"nameEn\":\"ABU BAKER SIDDIQUE\",\"father\":\"আবদুল মমিন\",\"mother\":\"রেজিয়া বেগম\",\"gender\":\"male\",\"spouse\":null,\"dob\":\"08/15/1995\",\"permanentAddress\":\"বাসা/হোল্ডিং: হাসেম মাষ্টার বাড়ি, গ্রাম/রাস্তা: উত্তর জায়লস্কর, জায়লস্কর, ডাকঘর: জায়লস্কর-৩৯০০, দাগনভূঁঞা, ফেনী\",\"presentAddress\":null,\"photo\":\"\",\"fatherEn\":\"Abdul Momin\",\"motherEn\":\"Rezia Begum\",\"spouseEn\":null,\"permanentAddressEn\":\"Home / Holding: Hashem Master House, Village / Road: North Jailskar, Jailskar, Post Office: Jailskar-3900, Daganbhuna, Feni\",\"presentAddressEn\":null,\"dobNew\":\"15-08-1995\",\"holding_basha\":\" হাসেম মাষ্টার বাড়ি\",\"village\":\"উত্তর জায়লস্কর\",\"post_office\":\"জায়লস্কর-৩৯০০\",\"upazila\":\"দাগনভূঁঞা\",\"district\":\"ফেনী\",\"image\":\"library/NID_image/NID_VERIFY_IMAGE_2061306080603d33512af87.jpg\"}', 1, 1, '2021-03-02 00:33:21', '::1', NULL, NULL, NULL),
(5, 202100005, '001', '3287844728', 'আবু বক্কর ছিদ্দিক', 'আবদুল মমিন', NULL, 1, '1', NULL, 1, '01839707645', '2021-02-12', NULL, '1995-08-15', 'উত্তর জায়লস্কর', '17', 'জায়লস্কর-৩৯০০', 'দাগনভূঁঞা', 'ফেনী', 3, 'library/NID_image/NID_VERIFY_IMAGE_2117096235603d372ee61b2.jpg', NULL, 2, '{\"name\":\"আবু বক্কর ছিদ্দিক\",\"nameEn\":\"ABU BAKER SIDDIQUE\",\"father\":\"আবদুল মমিন\",\"mother\":\"রেজিয়া বেগম\",\"gender\":\"male\",\"spouse\":null,\"dob\":\"08/15/1995\",\"permanentAddress\":\"বাসা/হোল্ডিং: হাসেম মাষ্টার বাড়ি, গ্রাম/রাস্তা: উত্তর জায়লস্কর, জায়লস্কর, ডাকঘর: জায়লস্কর-৩৯০০, দাগনভূঁঞা, ফেনী\",\"presentAddress\":null,\"photo\":\"\",\"fatherEn\":\"Abdul Momin\",\"motherEn\":\"Rezia Begum\",\"spouseEn\":null,\"permanentAddressEn\":\"Home / Holding: Hashem Master House, Village / Road: North Jailskar, Jailskar, Post Office: Jailskar-3900, Daganbhuna, Feni\",\"presentAddressEn\":null,\"dobNew\":\"15-08-1995\",\"holding_basha\":\" হাসেম মাষ্টার বাড়ি\",\"village\":\"উত্তর জায়লস্কর\",\"post_office\":\"জায়লস্কর-৩৯০০\",\"upazila\":\"দাগনভূঁঞা\",\"district\":\"ফেনী\",\"image\":\"library/NID_image/NID_VERIFY_IMAGE_2117096235603d372ee61b2.jpg\"}', 1, 1, '2021-03-02 00:49:38', '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_receiver_record`
--

CREATE TABLE `food_receiver_record` (
  `id` int(11) NOT NULL,
  `food_program_id` int(11) DEFAULT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `food_type` tinyint(1) DEFAULT NULL COMMENT '1 = চাল, 2= অন্যান্য',
  `food_amount` float DEFAULT NULL,
  `receive_dt` date DEFAULT NULL COMMENT '0 = Delete, 1= Active, 2= Inactive',
  `dealer_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_receiver_record`
--

INSERT INTO `food_receiver_record` (`id`, `food_program_id`, `applicant_id`, `food_type`, `food_amount`, `receive_dt`, `dealer_id`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 1, 3, 3, 33, '2021-03-18', 3, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fund_sub_ctg`
--

CREATE TABLE `fund_sub_ctg` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `mc_id` smallint(6) UNSIGNED NOT NULL,
  `subid` smallint(6) UNSIGNED NOT NULL,
  `fund_id` tinyint(3) UNSIGNED NOT NULL,
  `trno` bigint(16) UNSIGNED NOT NULL,
  `voucherno` bigint(16) UNSIGNED NOT NULL,
  `vtype` enum('C','D') NOT NULL DEFAULT 'C',
  `sub_title` varchar(255) DEFAULT NULL,
  `dr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fund_sub_ctg`
--

INSERT INTO `fund_sub_ctg` (`id`, `mc_id`, `subid`, `fund_id`, `trno`, `voucherno`, `vtype`, `sub_title`, `dr`, `cr`, `balance`, `payment_date`, `utime`) VALUES
(1, 1, 5, 2, 1, 1, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '2000.00', '0.00', '2018-06-08', '2018-06-07 22:54:49'),
(2, 1, 5, 2, 2, 2, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '200.00', '2000.00', '2018-06-08', '2018-06-07 22:57:08'),
(3, 3, 2, 2, 3, 3, 'C', 'ট্রেড লাইসেন্স ফি', '0.00', '115.00', '115.00', '2018-07-18', '2018-07-17 20:37:17'),
(4, 1, 5, 2, 4, 4, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '3000.00', '2200.00', '2018-07-18', '2018-07-17 21:10:39'),
(5, 6, 1, 2, 6, 5, 'C', 'অন্যান্য ফি', '0.00', '0.00', '0.00', '2018-10-04', '2018-10-03 19:52:24'),
(6, 6, 1, 2, 7, 6, 'C', 'অন্যান্য ফি', '0.00', '0.00', '0.00', '2018-10-09', '2018-10-08 19:58:22'),
(7, 1, 5, 2, 8, 7, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '400.00', '5200.00', '2019-05-25', '2019-05-24 19:23:05'),
(8, 6, 1, 2, 9, 8, 'C', 'অন্যান্য ফি', '0.00', '0.00', '0.00', '2019-05-25', '2019-05-24 19:26:17'),
(9, 1, 5, 2, 10, 9, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '100.00', '5600.00', '2019-05-27', '2019-05-27 06:14:42'),
(10, 1, 5, 2, 11, 10, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '100.00', '5700.00', '2019-05-27', '2019-05-27 06:19:35'),
(11, 6, 1, 2, 12, 11, 'C', 'অন্যান্য ফি', '0.00', '50.00', '50.00', '2019-05-27', '2019-05-27 06:20:57'),
(12, 1, 5, 2, 13, 12, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '225.00', '5800.00', '2019-05-30', '2019-05-30 05:25:07'),
(13, 6, 1, 2, 14, 13, 'C', 'অন্যান্য ফি', '0.00', '0.00', '50.00', '2019-05-30', '2019-05-30 06:15:06'),
(14, 1, 5, 2, 15, 14, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '390.00', '6025.00', '2019-06-30', '2019-06-29 19:55:07'),
(15, 1, 5, 2, 16, 15, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '990.00', '6415.00', '2019-07-01', '2019-07-01 04:46:00'),
(16, 1, 5, 2, 17, 16, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '205.00', '7405.00', '2019-07-01', '2019-07-01 04:46:43'),
(17, 6, 1, 2, 18, 17, 'C', 'অন্যান্য ফি', '0.00', '100.00', '150.00', '2019-07-01', '2019-07-01 04:47:12'),
(18, 6, 1, 2, 19, 18, 'C', 'অন্যান্য ফি', '0.00', '100.00', '250.00', '2019-07-03', '2019-07-03 04:57:03'),
(19, 1, 5, 2, 20, 19, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '215.00', '7610.00', '2019-07-03', '2019-07-03 05:05:49'),
(20, 3, 2, 2, 21, 20, 'C', 'ট্রেড লাইসেন্স ফি', '0.00', '129.80', '244.80', '2019-07-04', '2019-07-04 05:29:25'),
(21, 7, 11, 1, 22, 21, 'C', '১ম কিস্তি', '0.00', '1000.00', '1000.00', '2019-07-04', '2019-07-04 11:16:10'),
(22, 3, 2, 2, 23, 22, 'C', 'ট্রেড লাইসেন্স ফি', '0.00', '2222.00', '2466.80', '2019-07-04', '2019-07-04 11:17:45'),
(23, 1, 5, 2, 24, 23, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '800.00', '7825.00', '2019-07-06', '2019-07-06 09:16:42'),
(24, 1, 4, 2, 25, 24, 'C', 'ব্যবসা,পেশা ও জীবিকার উপর কর', '0.00', '100.00', '100.00', '2019-07-07', '2019-07-07 17:11:31'),
(25, 1, 5, 2, 26, 25, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '390.00', '8625.00', '2019-07-08', '2019-07-08 08:58:20'),
(28, 1, 5, 2, 27, 26, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '1625.00', '9015.00', '2019-07-14', '2019-07-14 15:11:57'),
(29, 1, 5, 2, 28, 27, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '1900.00', '10640.00', '2019-07-17', '2019-07-17 05:05:26'),
(30, 1, 5, 2, 29, 28, 'C', 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0.00', '173.00', '12540.00', '2019-07-17', '2019-07-17 12:03:08'),
(31, 3, 2, 2, 30, 29, 'C', 'ট্রেড লাইসেন্স ফি', '0.00', '0.00', '2466.80', '2019-07-19', '2019-07-19 05:14:19'),
(32, 6, 1, 2, 31, 30, 'C', 'অন্যান্য ফি', '0.00', '0.00', '250.00', '2020-08-31', '2020-08-31 08:59:36'),
(33, 14, 23, 10, 32, 31, 'C', 'UDC fee', '0.00', '0.00', '0.00', '2020-12-27', '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `fund_transfer`
--

CREATE TABLE `fund_transfer` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `transid` bigint(20) NOT NULL,
  `voucherno` bigint(20) NOT NULL,
  `accounts` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paytype` varchar(50) NOT NULL,
  `slipno` varchar(120) NOT NULL,
  `chno` varchar(120) NOT NULL,
  `bank` varchar(120) NOT NULL,
  `issue` date NOT NULL,
  `pono` varchar(120) NOT NULL,
  `ddno` varchar(120) NOT NULL,
  `ttno` varchar(120) NOT NULL,
  `fid2` int(11) NOT NULL,
  `catid2` int(11) NOT NULL,
  `sub_cat2` smallint(6) NOT NULL,
  `transid2` bigint(20) NOT NULL,
  `voucherno2` bigint(20) NOT NULL,
  `accounts2` varchar(255) NOT NULL,
  `paytype2` varchar(50) NOT NULL,
  `slipno2` varchar(120) NOT NULL,
  `chno2` varchar(120) NOT NULL,
  `bank2` varchar(120) NOT NULL,
  `issue2` date NOT NULL,
  `pono2` varchar(120) NOT NULL,
  `ddno2` varchar(120) NOT NULL,
  `ttno2` varchar(120) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `update_by` varchar(40) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `getlicense`
--

CREATE TABLE `getlicense` (
  `id` int(11) UNSIGNED NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `bno` int(11) UNSIGNED NOT NULL,
  `fiscal_year` varchar(40) DEFAULT NULL,
  `trno` bigint(16) NOT NULL,
  `vno` bigint(16) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `scharge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sbfee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `update_by` varchar(40) DEFAULT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `getlicense`
--

INSERT INTO `getlicense` (`id`, `trackid`, `bno`, `fiscal_year`, `trno`, `vno`, `fee`, `due`, `scharge`, `sbfee`, `discount`, `vat`, `total`, `payment_date`, `status`, `update_by`, `utime`) VALUES
(1, '11111111', 1, '2018-2019', 3, 3, '100.00', '0.00', '0.00', '0.00', '0.00', '15.00', '115.00', '2018-07-18', '1', 'admin', '2018-07-17 20:37:17'),
(2, '181566', 2, '2019-2020', 21, 20, '100.00', '12.00', '12.00', '0.00', '0.00', '16.80', '129.80', '2019-07-04', '1', 'admin', '2019-07-04 05:29:25'),
(3, '432432', 3, '2019-2020', 30, 29, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2019-07-19', '1', 'admin', '2019-07-19 05:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `holdingclientinfo`
--

CREATE TABLE `holdingclientinfo` (
  `id` int(11) UNSIGNED NOT NULL,
  `rate_sheet_id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `fathername` varchar(60) NOT NULL,
  `national_id` varchar(20) DEFAULT NULL COMMENT 'national id',
  `birth_certificate_id` varchar(20) DEFAULT NULL COMMENT 'birth certificate id',
  `village` varchar(40) NOT NULL,
  `wordno` smallint(6) UNSIGNED NOT NULL COMMENT 'word number',
  `holding_no` varchar(10) NOT NULL,
  `dag_no` varchar(10) NOT NULL,
  `mobile_number` varchar(11) DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0= delete, 1= active, 2 =inactive',
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holdingclientinfo`
--

INSERT INTO `holdingclientinfo` (`id`, `rate_sheet_id`, `name`, `fathername`, `national_id`, `birth_certificate_id`, `village`, `wordno`, `holding_no`, `dag_no`, `mobile_number`, `registration_date`, `created_by`, `created_ip`, `updated_by`, `updated_ip`, `is_active`, `utime`) VALUES
(1, 1, 'আবু বকর ছিদ্দিক', 'আবদুল মমিন', NULL, NULL, 'জায়লস্কর', 7, '101', '1001', '01825292980', '2018-06-08 04:50:03', 1, '::1', NULL, NULL, 1, '2018-06-07 22:50:03'),
(2, 8, 'ওসমান গনি', 'আবু তাহের', NULL, NULL, 'বাকরখানী', 9, '102', '1002', '01825292981', '2018-06-08 04:51:31', 1, '::1', NULL, NULL, 1, '2018-06-07 22:51:31'),
(3, 2, 'শাওন', 'হক', NULL, NULL, 'বালিচর', 6, '103', '1003', '01825292987', '2018-06-08 04:58:38', 1, '::1', NULL, NULL, 1, '2018-06-07 22:58:38'),
(4, 10, 'test', 'test', NULL, NULL, 'asadsfsadf', 1, '1111', '1110', NULL, '2019-05-24 16:49:54', 1, '::1', NULL, NULL, 1, '2019-05-24 10:49:54'),
(5, 11, 'sss', 'sss', NULL, NULL, 'ss', 6, '125', '1200', '01716344112', '2019-05-27 12:12:41', 1, '103.107.161.114', NULL, NULL, 1, '2019-05-27 06:12:41'),
(6, 7, 'মো: চেক আলী', 'মৃত: মরা আলী', NULL, NULL, 'সাজিয়াড়া', 3, '126', '1260', NULL, '2019-05-30 11:22:50', 1, '103.107.161.114', NULL, NULL, 1, '2019-05-30 05:22:50'),
(7, 10, 'Abu', 'Naser', NULL, NULL, 'P', 4, '01', '0000', '01719214125', '2019-06-30 01:52:29', 1, '103.67.159.86', NULL, NULL, 1, '2019-06-29 19:52:29'),
(8, 12, 'hridoy', 'lotif', NULL, NULL, 'mohon gong', 6, '116', '2235', NULL, '2019-07-01 10:26:35', 1, '202.181.17.164', NULL, NULL, 1, '2019-07-01 04:26:35'),
(9, 7, 'asif anam khan', 'lotif', NULL, NULL, 'mohon gong', 6, '100', '1120', NULL, '2019-07-03 11:03:57', 1, '202.181.17.164', NULL, NULL, 1, '2019-07-03 05:03:57'),
(10, 12, 'asif anam', 'lotif', NULL, NULL, 'mohon gong', 4, '116', '1134', NULL, '2019-07-03 15:09:42', 1, '202.181.17.164', NULL, NULL, 1, '2019-07-03 09:09:42'),
(11, 1, 'royal', 'lotif', NULL, NULL, 'mohon gong', 5, '116', '1023', NULL, '2019-07-09 13:26:32', 1, '202.181.17.164', NULL, NULL, 1, '2019-07-09 07:26:32'),
(12, 11, 'আবু নাছের', 'আব্দুল মুকিত', NULL, NULL, 'পানিউম্দা', 6, '1250', '1250', '01711245688', '2019-07-14 21:08:29', 1, '103.67.158.54', NULL, NULL, 1, '2019-07-14 15:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `holding_rate_sheet`
--

CREATE TABLE `holding_rate_sheet` (
  `id` int(11) UNSIGNED NOT NULL,
  `occupation_id` tinyint(3) UNSIGNED NOT NULL,
  `classification_id` tinyint(3) UNSIGNED NOT NULL,
  `label_id` smallint(6) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_current` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1= current, 0=old',
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=active, 0=in-active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `holding_rate_sheet`
--

INSERT INTO `holding_rate_sheet` (`id`, `occupation_id`, `classification_id`, `label_id`, `amount`, `created_by`, `created_ip`, `created_date`, `updated_by`, `updated_ip`, `updated_date`, `is_current`, `is_active`) VALUES
(1, 1, 6, 1, '1000.00', 1, '::1', '2018-06-08 04:45:02', NULL, NULL, NULL, 1, 1),
(2, 2, 6, 1, '500.00', 1, '::1', '2018-06-08 04:45:29', NULL, NULL, NULL, 1, 1),
(3, 4, 6, 3, '250.00', 1, '::1', '2018-06-08 04:45:49', NULL, NULL, NULL, 1, 1),
(4, 4, 7, 3, '200.00', 1, '::1', '2018-06-08 04:46:09', NULL, NULL, NULL, 1, 1),
(5, 3, 6, 4, '75.00', 1, '::1', '2018-06-08 04:46:30', NULL, NULL, NULL, 1, 1),
(6, 3, 8, 4, '40.00', 1, '::1', '2018-06-08 04:46:55', NULL, NULL, NULL, 1, 1),
(7, 5, 7, 3, '225.00', 1, '::1', '2018-06-08 04:47:12', NULL, NULL, NULL, 1, 1),
(8, 5, 6, 3, '250.00', 1, '::1', '2018-06-08 04:47:30', NULL, NULL, NULL, 1, 1),
(9, 2, 7, 2, '300.00', 1, '::1', '2018-06-08 04:47:48', NULL, NULL, NULL, 1, 1),
(10, 2, 6, 2, '400.00', 1, '::1', '2018-06-08 04:48:24', NULL, NULL, NULL, 1, 1),
(11, 5, 9, 4, '100.00', 1, '103.107.161.114', '2019-05-27 12:09:01', NULL, NULL, NULL, 1, 1),
(12, 4, 8, 4, '1000.00', 1, '103.107.161.114', '2019-05-27 12:09:55', 1, '202.181.17.164', '2019-07-09 13:29:17', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `holding_rate_sheet_label`
--

CREATE TABLE `holding_rate_sheet_label` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `rate_sheet_label` varchar(200) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=enable, 2= disable',
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `holding_rate_sheet_label`
--

INSERT INTO `holding_rate_sheet_label` (`id`, `rate_sheet_label`, `status`, `created_by`, `created_ip`, `created_date`, `updated_by`, `updated_ip`, `updated_date`) VALUES
(1, 'পাকা', 1, 1, '::1', '2018-06-08 04:43:19', NULL, NULL, NULL),
(2, 'আধাপাকা', 1, 1, '::1', '2018-06-08 04:43:34', NULL, NULL, NULL),
(3, 'টিনসেড', 1, 1, '::1', '2018-06-08 04:43:47', NULL, NULL, NULL),
(4, 'কাচা', 1, 1, '::1', '2018-06-08 04:43:57', 1, '202.181.17.164', '2019-07-09 16:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `trackid`, `mobile`, `msg`, `utime`) VALUES
(1, '11111111', NULL, 'আপনার  ট্র্যাকিং নং অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন  আপনার  সনদ নং : ২০১৮০৯১৫৩৪৫৪৪৫২৯৪', '2018-07-17 20:37:17'),
(2, '258853', '01825292963', 'আপনার  ট্র্যাকিং নং : 258853 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2018-10-08 19:56:47'),
(3, '054265', '01825292960', 'আপনার  ট্র্যাকিং নং : 054265 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2019-02-03 18:36:41'),
(4, '181566', '01643789562', 'আপনার  ট্র্যাকিং নং : 181566 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2019-07-04 05:29:00'),
(5, '181566', NULL, 'আপনার  ট্র্যাকিং নং অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন  আপনার  সনদ নং : ২০১৯০৯১৫৩৪৫৫৮৯৭১২', '2019-07-04 05:29:25'),
(6, '432432', '11', 'আপনার  ট্র্যাকিং নং : 432432 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2019-07-19 05:13:25'),
(7, '432432', NULL, 'আপনার  ট্র্যাকিং নং অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন  আপনার  সনদ নং : ২০১৯০৯১৫৩৪৫২৫২৪১৯', '2019-07-19 05:14:19'),
(8, '534718', '01839707645', 'আপনার  ট্র্যাকিং নং : 534718 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2020-09-21 17:19:56'),
(9, '851863', '01830320809', 'আপনার  ট্র্যাকিং নং : 851863 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2020-12-26 20:38:24'),
(10, '176080', '01834567891', 'আপনার  ট্র্যাকিং নং : 176080 অনলাইনে ট্র্যাকিং নং টি দিয়ে  আপনার  আবেদনের অবস্থান যাছাই করুন', '2020-12-30 13:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) UNSIGNED NOT NULL,
  `tid` bigint(16) UNSIGNED NOT NULL,
  `voucherno` bigint(16) UNSIGNED NOT NULL,
  `vtype` enum('C','D') NOT NULL DEFAULT 'C',
  `catid` int(11) UNSIGNED NOT NULL,
  `subid` int(11) UNSIGNED NOT NULL,
  `fundtype` smallint(6) UNSIGNED NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `ac` varchar(255) DEFAULT NULL,
  `dr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `inby` varchar(40) NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `tid`, `voucherno`, `vtype`, `catid`, `subid`, `fundtype`, `purpose`, `ac`, `dr`, `cr`, `balance`, `payment_date`, `inby`, `up_date`) VALUES
(1, 1, 1, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '2000.00', '2000.00', '2018-06-08', 'admin', '2018-06-07 22:54:49'),
(2, 2, 2, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '200.00', '2200.00', '2018-06-08', 'admin', '2018-06-07 22:57:08'),
(3, 3, 3, 'C', 3, 2, 2, 'ট্রেড লাইসেন্স ফি', '0000-0000-0000-0000', '0.00', '115.00', '2315.00', '2018-07-18', 'admin', '2018-07-17 20:37:17'),
(4, 4, 4, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '3000.00', '5315.00', '2018-07-18', 'admin', '2018-07-17 21:10:39'),
(5, 5, 1, 'D', 0, 0, 0, 'Balance Transfer From', '0000-0000-0000-0000', '100.00', '0.00', '5215.00', '2018-08-18', 'admin', '2018-08-18 16:07:30'),
(6, 6, 5, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '0.00', '5215.00', '2018-10-04', 'admin', '2018-10-03 19:52:24'),
(7, 7, 6, 'C', 6, 1, 2, 'ওয়ারিশ সনদ', '0000-0000-0000-0000', '0.00', '0.00', '5215.00', '2018-10-09', 'admin', '2018-10-08 19:58:22'),
(8, 8, 7, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '400.00', '5615.00', '2019-05-25', 'admin', '2019-05-24 19:23:05'),
(9, 9, 8, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '0.00', '5615.00', '2019-05-25', 'admin', '2019-05-24 19:26:17'),
(10, 10, 9, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '100.00', '5715.00', '2019-05-27', 'admin', '2019-05-27 06:14:42'),
(11, 11, 10, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '100.00', '5815.00', '2019-05-27', 'admin', '2019-05-27 06:19:35'),
(12, 12, 11, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '50.00', '5865.00', '2019-05-27', 'admin', '2019-05-27 06:20:57'),
(13, 13, 12, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '225.00', '6090.00', '2019-05-30', 'admin', '2019-05-30 05:25:07'),
(14, 14, 13, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '0.00', '6090.00', '2019-05-30', 'admin', '2019-05-30 06:15:06'),
(15, 15, 14, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '390.00', '6480.00', '2019-06-30', 'admin', '2019-06-29 19:55:07'),
(16, 16, 15, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '990.00', '7470.00', '2019-07-01', 'admin', '2019-07-01 04:46:00'),
(17, 17, 16, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '205.00', '7675.00', '2019-07-01', 'admin', '2019-07-01 04:46:43'),
(18, 18, 17, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '100.00', '7775.00', '2019-07-01', 'admin', '2019-07-01 04:47:12'),
(19, 19, 18, 'C', 6, 1, 2, 'নাগরিক সনদ', '0000-0000-0000-0000', '0.00', '100.00', '7875.00', '2019-07-03', 'admin', '2019-07-03 04:57:03'),
(20, 20, 19, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '215.00', '8090.00', '2019-07-03', 'admin', '2019-07-03 05:05:49'),
(21, 21, 20, 'C', 3, 2, 2, 'ট্রেড লাইসেন্স ফি', '0000-0000-0000-0000', '0.00', '129.80', '8219.80', '2019-07-04', 'admin', '2019-07-04 05:29:25'),
(22, 22, 21, 'C', 7, 11, 1, 'সরকারী অনুদান-ভূমি হস্তান্তর কর (১%),১ম কিস্তি', '0004-0004-0004-0004', '0.00', '1000.00', '1000.00', '2019-07-04', 'admin', '2019-07-04 11:16:10'),
(23, 23, 22, 'C', 3, 2, 2, 'লাইসেন্স ফি,ট্রেড লাইসেন্স ফি', '0000-0000-0000-0000', '0.00', '2222.00', '10441.80', '2019-07-04', 'admin', '2019-07-04 11:17:45'),
(24, 24, 23, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '800.00', '11241.80', '2019-07-06', 'admin', '2019-07-06 09:16:42'),
(25, 25, 24, 'C', 1, 4, 2, 'ব্যবসা,পেশা ও জীবিকার উপর কর', '0000-0000-0000-0000', '0.00', '100.00', '11341.80', '2019-07-07', 'admin', '2019-07-07 17:11:31'),
(26, 26, 25, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '390.00', '11731.80', '2019-07-08', 'admin', '2019-07-08 08:58:20'),
(29, 27, 26, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '1625.00', '13356.80', '2019-07-14', 'admin', '2019-07-14 15:11:57'),
(30, 28, 27, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '1900.00', '15256.80', '2019-07-17', 'admin', '2019-07-17 05:05:26'),
(31, 29, 28, 'C', 1, 5, 2, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '0000-0000-0000-0000', '0.00', '173.00', '15429.80', '2019-07-17', 'admin', '2019-07-17 12:03:08'),
(32, 30, 29, 'C', 3, 2, 2, 'ট্রেড লাইসেন্স ফি', '0000-0000-0000-0000', '0.00', '0.00', '15429.80', '2019-07-19', 'admin', '2019-07-19 05:14:19'),
(33, 31, 30, 'C', 6, 1, 2, 'ওয়ারিশ সনদ', '0000-0000-0000-0000', '0.00', '0.00', '15429.80', '2020-08-31', 'admin', '2020-08-31 08:59:36'),
(34, 32, 31, 'C', 14, 23, 10, NULL, '0000-0000-0000-0000', '0.00', '0.00', '15429.80', '2020-12-27', 'admin', '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `license_hostory`
--

CREATE TABLE `license_hostory` (
  `id` int(11) NOT NULL,
  `sno` varchar(17) NOT NULL,
  `issue_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('1','2') NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `license_hostory`
--

INSERT INTO `license_hostory` (`id`, `sno`, `issue_date`, `expire_date`, `status`, `up_date`) VALUES
(1, '20180915345445294', '2018-07-18', '2019-06-30', '1', '2018-07-17 20:37:17'),
(2, '20190915345589712', '2019-07-04', '2020-06-30', '1', '2019-07-04 05:29:25'),
(3, '20190915345252419', '2019-07-19', '2020-06-30', '1', '2019-07-19 05:14:19'),
(4, '20190915345589712', '2019-07-04', '2020-06-30', '1', '2020-08-31 09:11:18'),
(5, '20190915345589712', '2020-08-31', '2021-06-30', '2', '2020-08-31 09:11:18'),
(6, '20190915345589712', '2020-08-31', '2021-06-30', '1', '2020-08-31 09:11:36'),
(7, '20190915345589712', '2020-08-31', '2021-06-30', '2', '2020-08-31 09:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `license_notification`
--

CREATE TABLE `license_notification` (
  `id` int(11) NOT NULL,
  `notifydate` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mainctg`
--

CREATE TABLE `mainctg` (
  `id` int(11) NOT NULL,
  `fund_id` int(11) NOT NULL COMMENT '1=development, 2= personal',
  `category` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `insert_by` varchar(40) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mainctg`
--

INSERT INTO `mainctg` (`id`, `fund_id`, `category`, `balance`, `insert_by`, `utime`) VALUES
(1, 2, 'কর ও রেট', '12813.00', 'admin', '2019-07-17 12:03:08'),
(2, 1, 'ইজারা', '0.00', 'admin', '2018-06-07 21:46:30'),
(3, 2, 'লাইসেন্স ফি', '2466.80', 'admin', '2019-07-04 11:17:45'),
(4, 2, 'যানবাহন (মটরযান ব্যতীত)', '0.00', 'admin', '2018-06-07 21:46:30'),
(5, 1, 'বিনিযোগের আয়', '0.00', 'admin', '2018-06-07 21:46:30'),
(6, 2, 'জন্ম নিবন্ধন ফি', '250.00', 'admin', '2019-07-03 04:57:03'),
(7, 1, 'সরকারী অনুদান-ভূমি হস্তান্তর কর (১%)', '1000.00', 'admin', '2019-07-04 11:16:10'),
(8, 1, 'সরকরী অনুদান-সংস্থাপন', '0.00', 'admin', '2018-06-07 21:46:30'),
(9, 1, 'সরকরী অনুদান-উন্নয়ন', '0.00', 'admin', '2018-06-07 21:46:30'),
(10, 1, 'স্থানীয় সরকার-জেলা পরিষদ অনুদান', '0.00', 'admin', '2018-06-07 21:46:30'),
(11, 1, 'স্থানীয় সরকার-উপজেলা পরিষদ অনুদান', '0.00', 'admin', '2018-06-07 21:46:30'),
(12, 1, 'এলজিএসপি ফান্ড ফেরত', '0.00', 'admin', '2018-06-07 21:46:30'),
(13, 2, 'অন্যান্য প্রাপ্তি', '0.00', 'admin', '2018-06-07 21:46:30'),
(14, 10, 'UDC fund', '0.00', 'admin', '2018-06-07 21:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `mainctg_in_budget`
--

CREATE TABLE `mainctg_in_budget` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `actual_budget` decimal(10,2) NOT NULL,
  `budget_year` varchar(50) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mamla_badi`
--

CREATE TABLE `mamla_badi` (
  `id` int(11) UNSIGNED NOT NULL,
  `mamla_id` int(11) UNSIGNED NOT NULL,
  `badi_name` varchar(60) DEFAULT NULL,
  `badi_father_name` varchar(60) DEFAULT NULL,
  `gram` varchar(120) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mamla_badi`
--

INSERT INTO `mamla_badi` (`id`, `mamla_id`, `badi_name`, `badi_father_name`, `gram`, `status`) VALUES
(1, 1, 'asdad', 'asdasd', '', '1'),
(2, 2, 'asdad', 'asdasd', 'asd1', '1'),
(3, 2, 'asdad', 'asdasd', 'asd', '1'),
(4, 3, 'asdad', '', '', '1'),
(5, 3, 'asdad', 'asdasd', '', '1'),
(6, 4, 'asdad', 'asdasd', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mamla_bibadi`
--

CREATE TABLE `mamla_bibadi` (
  `id` int(11) UNSIGNED NOT NULL,
  `mamla_id` int(11) UNSIGNED NOT NULL,
  `bibadi_name` varchar(60) DEFAULT NULL,
  `bibadi_father_name` varchar(60) DEFAULT NULL,
  `gram` varchar(120) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mamla_bibadi`
--

INSERT INTO `mamla_bibadi` (`id`, `mamla_id`, `bibadi_name`, `bibadi_father_name`, `gram`, `status`) VALUES
(1, 1, 'asd', 'asd', '', '1'),
(2, 2, 'asd', 'asd', 'asd', '1'),
(3, 2, 'asd', 'asd', 'asd', '1'),
(4, 3, 'asd', 'asd', '', '1'),
(5, 4, 'asd', 'asd', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mamla_tbl`
--

CREATE TABLE `mamla_tbl` (
  `id` int(11) UNSIGNED NOT NULL,
  `mamla_no` int(11) UNSIGNED NOT NULL,
  `mamla_sonod` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `mamla_date` date NOT NULL,
  `sunani_date` date NOT NULL,
  `badi_gram` varchar(120) DEFAULT NULL,
  `bibadi_gram` varchar(120) DEFAULT NULL,
  `status` enum('1','2','3') NOT NULL,
  `comments` text DEFAULT NULL,
  `ins_user` varchar(40) DEFAULT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mamla_tbl`
--

INSERT INTO `mamla_tbl` (`id`, `mamla_no`, `mamla_sonod`, `subject`, `mamla_date`, `sunani_date`, `badi_gram`, `bibadi_gram`, `status`, `comments`, `ins_user`, `up_date`) VALUES
(1, 1, '20190915345703511', 'Null', '2019-07-01', '2019-07-09', 'adsasd', 'asd', '3', '', 'admin', '2019-07-02 09:18:41'),
(2, 2, '20190915345550952', 'Null', '2019-07-01', '2019-07-31', '', '', '2', '', 'admin', '2019-07-02 10:56:58'),
(3, 3, '20190915345290546', 'aa', '2019-07-02', '2019-07-22', '', '', '1', NULL, 'admin', '2019-07-02 06:21:02'),
(4, 4, '20190915345825137', 'Null', '2019-07-02', '2019-06-24', '', '', '1', NULL, 'admin', '2019-07-02 09:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `id` int(11) UNSIGNED NOT NULL,
  `trackid` varchar(17) NOT NULL COMMENT 'holding tax = dagno, tradelicense = trackid, other = sno',
  `bno` int(11) UNSIGNED DEFAULT NULL COMMENT 'Book number, use tradelicense, holding tax',
  `m_r_n` int(11) UNSIGNED DEFAULT NULL COMMENT 'Money receipt number',
  `inno` int(11) UNSIGNED NOT NULL COMMENT 'Invoice number',
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'sub total',
  `due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `scharge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vat` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'pay amount',
  `fiscal_year_id` text DEFAULT NULL,
  `rate_sheet_id` text DEFAULT NULL,
  `rate_sheet_amount` text DEFAULT NULL,
  `payment_date` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=tradelicense,2=tradeBosotbitaKor, 3= tradepesKor, 4=dagBosotKor, 5=nagorick, 6= warish, 7= dailycollection, 8=dailyexpensive',
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`id`, `trackid`, `bno`, `m_r_n`, `inno`, `fee`, `due`, `scharge`, `discount`, `vat`, `total`, `fiscal_year_id`, `rate_sheet_id`, `rate_sheet_amount`, `payment_date`, `status`, `utime`) VALUES
(1, '1001', 1, 1, 1, '2000.00', '0.00', '0.00', '0.00', '0.00', '2000.00', '[\"4\",\"3\"]', '[\"1\",\"1\"]', '[\"1000.00\",\"1000.00\"]', '2018-06-08', 4, '2018-06-07 22:54:49'),
(2, '1002', 1, 2, 2, '250.00', '0.00', '0.00', '50.00', '0.00', '200.00', '[\"4\"]', '[\"8\"]', '[\"250.00\"]', '2018-06-08', 4, '2018-06-07 22:57:08'),
(3, '11111111', 1, NULL, 3, '100.00', '0.00', '0.00', '0.00', '15.00', '115.00', NULL, NULL, NULL, '2018-07-18', 1, '2018-07-17 20:37:17'),
(4, '1001', 101, 12, 4, '3000.00', '0.00', '0.00', '0.00', '0.00', '3000.00', '[\"9\",\"8\",\"5\"]', '[\"1\",\"1\",\"1\"]', '[\"1000.00\",\"1000.00\",\"1000.00\"]', '2018-07-18', 4, '2018-07-17 21:10:39'),
(5, '379040', NULL, NULL, 5, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2018-10-04', 5, '2018-10-03 19:52:24'),
(6, '258853', NULL, NULL, 6, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2018-10-09', 6, '2018-10-08 19:58:22'),
(7, '1110', 123, 1111, 7, '400.00', '0.00', '0.00', '0.00', '0.00', '400.00', '[\"5\"]', '[\"10\"]', '[\"400.00\"]', '2019-05-25', 4, '2019-05-24 19:23:05'),
(8, '153119', NULL, NULL, 8, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2019-05-25', 5, '2019-05-24 19:26:17'),
(9, '1200', 1, 101, 9, '100.00', '0.00', '0.00', '0.00', '0.00', '100.00', '[\"4\"]', '[\"11\"]', '[\"100.00\"]', '2019-05-27', 4, '2019-05-27 06:14:42'),
(10, '1200', 1, 102, 10, '100.00', '0.00', '0.00', '0.00', '0.00', '100.00', '[\"5\"]', '[\"11\"]', '[\"100.00\"]', '2019-05-27', 4, '2019-05-27 06:19:35'),
(11, '784188', NULL, NULL, 11, '50.00', '0.00', '0.00', '0.00', '0.00', '50.00', NULL, NULL, NULL, '2019-05-27', 5, '2019-05-27 06:20:57'),
(12, '1260', 1, 100, 12, '225.00', '0.00', '0.00', '0.00', '0.00', '225.00', '[\"5\"]', '[\"7\"]', '[\"225.00\"]', '2019-05-30', 4, '2019-05-30 05:25:07'),
(13, '831291', NULL, NULL, 13, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2019-05-30', 5, '2019-05-30 06:15:06'),
(14, '0000', 1, 10, 14, '400.00', '0.00', '0.00', '10.00', '0.00', '390.00', '[\"1\"]', '[\"10\"]', '[\"400.00\"]', '2019-06-30', 4, '2019-06-29 19:55:07'),
(15, '2235', 1, 1011, 15, '1000.00', '0.00', '0.00', '10.00', '0.00', '990.00', '[\"5\"]', '[\"12\"]', '[\"1000.00\"]', '2019-07-01', 4, '2019-07-01 04:46:00'),
(16, '1260', 1, 1012, 16, '225.00', '0.00', '0.00', '20.00', '0.00', '205.00', '[\"6\"]', '[\"7\"]', '[\"225.00\"]', '2019-07-01', 4, '2019-07-01 04:46:43'),
(17, '444091', NULL, NULL, 17, '100.00', '0.00', '0.00', '0.00', '0.00', '100.00', NULL, NULL, NULL, '2019-07-01', 5, '2019-07-01 04:47:12'),
(18, '508830', NULL, NULL, 18, '100.00', '0.00', '0.00', '0.00', '0.00', '100.00', NULL, NULL, NULL, '2019-07-03', 5, '2019-07-03 04:57:03'),
(19, '1120', 12, 1, 19, '225.00', '0.00', '0.00', '10.00', '0.00', '215.00', '[\"6\"]', '[\"7\"]', '[\"225.00\"]', '2019-07-03', 4, '2019-07-03 05:05:49'),
(20, '181566', 2, NULL, 20, '100.00', '12.00', '12.00', '0.00', '16.80', '129.80', NULL, NULL, NULL, '2019-07-04', 1, '2019-07-04 05:29:25'),
(21, '000000', NULL, NULL, 21, '1000.00', '0.00', '0.00', '0.00', '0.00', '1000.00', NULL, NULL, NULL, '2019-07-04', 7, '2019-07-04 11:16:10'),
(22, '000000', NULL, NULL, 22, '2222.00', '0.00', '0.00', '0.00', '0.00', '2222.00', NULL, NULL, NULL, '2019-07-04', 7, '2019-07-04 11:17:45'),
(23, '2235', 2, 11, 23, '1000.00', '0.00', '0.00', '200.00', '0.00', '800.00', '[\"7\"]', '[\"1\"]', '[\"1000.00\"]', '2019-07-06', 4, '2019-07-06 09:16:42'),
(24, '181566', NULL, NULL, 24, '100.00', '0.00', '0.00', '0.00', '0.00', '100.00', NULL, NULL, NULL, '2019-07-07', 3, '2019-07-07 17:11:31'),
(25, '1120', 12, 1011, 25, '400.00', '0.00', '0.00', '10.00', '0.00', '390.00', '[\"5\"]', '[\"10\"]', '[\"400.00\"]', '2019-07-08', 4, '2019-07-08 08:58:20'),
(26, '1250', 1, 122, 26, '1725.00', '0.00', '0.00', '100.00', '0.00', '1625.00', '[\"1\",\"2\",\"3\"]', '[\"1\",\"2\",\"7\"]', '[\"1000.00\",\"500.00\",\"225.00\"]', '2019-07-14', 4, '2019-07-14 15:11:57'),
(27, '1250', 55, 222, 27, '2000.00', '0.00', '0.00', '100.00', '0.00', '1900.00', '[\"6\",\"7\"]', '[\"1\",\"1\"]', '[\"1000.00\",\"1000.00\"]', '2019-07-17', 4, '2019-07-17 05:05:26'),
(28, '1260', 5, 10, 28, '225.00', '0.00', '0.00', '52.00', '0.00', '173.00', '[\"1\"]', '[\"7\"]', '[\"225.00\"]', '2019-07-17', 4, '2019-07-17 12:03:08'),
(29, '432432', 3, NULL, 29, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2019-07-19', 1, '2019-07-19 05:14:19'),
(30, '054265', NULL, NULL, 30, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2020-08-31', 6, '2020-08-31 08:59:36'),
(31, '093144', NULL, NULL, 31, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, NULL, '2020-12-27', 5, '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `onnanoseba`
--

CREATE TABLE `onnanoseba` (
  `id` int(11) UNSIGNED NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `applicant_id` int(11) UNSIGNED NOT NULL,
  `trno` bigint(16) NOT NULL,
  `vno` bigint(16) NOT NULL,
  `acno` varchar(255) DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `onnanoseba`
--

INSERT INTO `onnanoseba` (`id`, `trackid`, `applicant_id`, `trno`, `vno`, `acno`, `fee`, `payment_date`, `utime`) VALUES
(1, '093144', 1, 32, 31, '0000-0000-0000-0000', '0.00', '2020-12-27', '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `otherserviceinfo`
--

CREATE TABLE `otherserviceinfo` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `sonodno` varchar(17) DEFAULT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `serviceId` tinyint(3) NOT NULL,
  `mukti_name` varchar(60) NOT NULL,
  `gejet_no` varchar(15) NOT NULL,
  `m_sonshod_sonod` varchar(20) NOT NULL,
  `relation` varchar(60) NOT NULL,
  `short_rel` varchar(30) NOT NULL,
  `sector_no` varchar(10) NOT NULL,
  `mukti_sonod` varchar(20) NOT NULL,
  `incomeAmount` varchar(20) DEFAULT NULL,
  `publishName` varchar(60) DEFAULT NULL,
  `workPlace` varchar(100) DEFAULT NULL,
  `ddfb` date NOT NULL,
  `nationid` varchar(20) DEFAULT NULL,
  `bcno` varchar(20) DEFAULT NULL,
  `pno` varchar(20) DEFAULT NULL,
  `dofb` date NOT NULL,
  `ename` varchar(60) NOT NULL,
  `name` varchar(80) NOT NULL,
  `gender` enum('male','female','others') NOT NULL,
  `mstatus` tinyint(2) NOT NULL,
  `ewname` varchar(60) DEFAULT NULL,
  `bwname` varchar(80) DEFAULT NULL,
  `ehname` varchar(60) DEFAULT NULL,
  `bhname` varchar(80) DEFAULT NULL,
  `efname` varchar(60) NOT NULL,
  `bfname` varchar(80) NOT NULL,
  `emname` varchar(60) NOT NULL,
  `mname` varchar(80) NOT NULL,
  `ocupt` varchar(120) DEFAULT NULL,
  `edustatus` varchar(120) DEFAULT NULL,
  `religion` varchar(30) NOT NULL,
  `bashinda` enum('1','2') NOT NULL,
  `p_gram` varchar(60) DEFAULT NULL,
  `pb_gram` varchar(100) DEFAULT NULL,
  `p_rbs` varchar(60) DEFAULT NULL,
  `pb_rbs` varchar(80) DEFAULT NULL,
  `p_wordno` int(4) DEFAULT NULL,
  `pb_wordno` varchar(10) DEFAULT NULL,
  `p_dis` varchar(60) DEFAULT NULL,
  `pb_dis` varchar(100) DEFAULT NULL,
  `p_thana` varchar(60) DEFAULT NULL,
  `pb_thana` varchar(100) DEFAULT NULL,
  `p_postof` varchar(60) DEFAULT NULL,
  `pb_postof` varchar(100) DEFAULT NULL,
  `per_gram` varchar(60) DEFAULT NULL,
  `perb_gram` varchar(100) DEFAULT NULL,
  `per_rbs` varchar(60) DEFAULT NULL,
  `perb_rbs` varchar(80) DEFAULT NULL,
  `per_wordno` int(4) DEFAULT NULL,
  `perb_wordno` varchar(10) DEFAULT NULL,
  `per_dis` varchar(60) DEFAULT NULL,
  `perb_dis` varchar(100) DEFAULT NULL,
  `per_thana` varchar(60) DEFAULT NULL,
  `perb_thana` varchar(100) DEFAULT NULL,
  `per_postof` varchar(60) DEFAULT NULL,
  `perb_postof` varchar(100) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `profile` varchar(160) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `insert_time` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otherserviceinfo`
--

INSERT INTO `otherserviceinfo` (`id`, `trackid`, `sonodno`, `delivery_type`, `serviceId`, `mukti_name`, `gejet_no`, `m_sonshod_sonod`, `relation`, `short_rel`, `sector_no`, `mukti_sonod`, `incomeAmount`, `publishName`, `workPlace`, `ddfb`, `nationid`, `bcno`, `pno`, `dofb`, `ename`, `name`, `gender`, `mstatus`, `ewname`, `bwname`, `ehname`, `bhname`, `efname`, `bfname`, `emname`, `mname`, `ocupt`, `edustatus`, `religion`, `bashinda`, `p_gram`, `pb_gram`, `p_rbs`, `pb_rbs`, `p_wordno`, `pb_wordno`, `p_dis`, `pb_dis`, `p_thana`, `pb_thana`, `p_postof`, `pb_postof`, `per_gram`, `perb_gram`, `per_rbs`, `perb_rbs`, `per_wordno`, `perb_wordno`, `per_dis`, `perb_dis`, `per_thana`, `perb_thana`, `per_postof`, `perb_postof`, `mobile`, `email`, `attachment`, `profile`, `status`, `insert_time`, `utime`) VALUES
(1, '448740', NULL, 3, 1, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2020-12-17', '2', '2', 'female', 2, '', '', '', '', '2', '2', '2', '2', '', '', 'হিন্দু', '2', '2', '2', '2', '2', 2, '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', 2, '2', '2', '2', '2', '2', '2', '2', '01830320809', '', 'ts', 'http://localhost/smartUp/img/default/profile.png', '0', '2020-12-27', '2020-12-26 21:00:49'),
(2, '093144', '20200915345752498', 3, 0, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2020-12-02', '33', '33', 'male', 2, '', '', '', '', '3', '33', '33', '33', '', '', 'ইসলাম', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01830320801', '', '', 'library/profile/1609016556.JPG', '1', '2020-12-27', '2020-12-26 21:14:42'),
(3, '733613', NULL, 3, 1, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2020-12-10', '22', '22', 'female', 2, '', '', '', '', '22', '22', '22', '22', '', '', 'হিন্দু', '1', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01830320804', '', '', 'library/profile/1609016683.JPG', '0', '2020-12-27', '2020-12-26 21:04:43'),
(4, '398519', NULL, 3, 2, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2020-12-09', '22', '22', 'female', 2, '', '', '', '', '22', '22', '22', '22', '', '', 'ইসলাম', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01830320803', '', 'tst', 'library/profile/160929778119032.jpg', '0', '2020-12-27', '2020-12-30 03:09:42'),
(5, '597436', NULL, 3, 3, '', '', '', '', '', '', '', '3', '3', '3', '2020-12-17', '', '', '', '2020-12-16', '3', '3', 'female', 3, '', '', '', '', '3', '3', 'asdfsa', 'asdf', '3', '3', 'হিন্দু', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01830320808', '', 'stt', 'library/profile/160933597834746.jpg', '0', '2020-12-30', '2020-12-30 13:46:18'),
(6, '553186', NULL, 3, 0, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2020-12-17', 'a', 'a', 'female', 2, '', '', '', '', 'a', 'a', 'a', 'a', '', '', 'হিন্দু', '2', 'a', '', 'a', '', 0, '', 'a', '', 'a', '', 'a', '', 'a', '', 'a', '', 0, '', 'a', '', 'a', '', 'a', '', '01830320802', '', '', 'library/profile/160934891915300.jpg', '0', '2020-12-30', '2020-12-30 17:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `otherservicelist`
--

CREATE TABLE `otherservicelist` (
  `id` int(11) NOT NULL,
  `listName` varchar(120) NOT NULL,
  `insdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ins_user` varchar(60) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otherservicelist`
--

INSERT INTO `otherservicelist` (`id`, `listName`, `insdate`, `ins_user`, `status`) VALUES
(1, 'মৃত্যু সনদ', '2018-06-07 21:56:55', 'admin', '1'),
(2, 'চারিত্রিক সনদ', '2018-06-07 21:56:55', 'admin', '1'),
(3, 'অবিবাহিত সনদ', '2018-06-07 21:56:55', 'admin', '1'),
(4, 'ভূমিহীন সনদ', '2018-06-07 21:56:55', 'admin', '1'),
(5, 'পুনঃ বিবাহ না হওয়া সনদ ', '2018-06-07 21:56:55', 'admin', '1'),
(6, 'বার্ষিক আয়ের প্রত্যয়ন', '2018-06-07 21:56:55', 'admin', '1'),
(7, 'একই নামের প্রত্যয়ন', '2018-06-07 21:56:55', 'admin', '1'),
(8, 'প্রকৃত বাকঁ ও শ্রবন প্রতিবন্ধী', '2018-06-07 21:56:55', 'admin', '1'),
(9, 'সনাতন ধর্ম  অবলম্বী', '2018-06-07 21:56:55', 'admin', '1'),
(10, 'অনুমতি পত্র', '2018-06-07 21:56:55', 'admin', '1'),
(11, 'প্রত্যয়ন পত্র', '2018-06-07 21:56:55', 'admin', '1'),
(12, 'মুক্তিযোদ্ধা সনদ', '2018-06-07 21:56:55', 'admin', '1'),
(13, 'মুক্তিযোদ্ধা পোষ্য সনদ', '2018-06-07 21:56:55', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment_log_bosotbita`
--

CREATE TABLE `payment_log_bosotbita` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` int(10) UNSIGNED NOT NULL,
  `holding_no` varchar(10) NOT NULL,
  `dag_no` varchar(10) NOT NULL,
  `book_number` int(10) UNSIGNED NOT NULL,
  `money_receipt` int(10) UNSIGNED NOT NULL,
  `fisyal_year_id` smallint(5) UNSIGNED NOT NULL,
  `rate_sheet_id` smallint(5) UNSIGNED NOT NULL,
  `sub_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_log_bosotbita`
--

INSERT INTO `payment_log_bosotbita` (`id`, `invoice`, `holding_no`, `dag_no`, `book_number`, `money_receipt`, `fisyal_year_id`, `rate_sheet_id`, `sub_amount`, `payment_date`, `created_by`) VALUES
(1, 1, '101', '1001', 1, 1, 4, 1, '1000.00', '2018-06-08', 1),
(2, 1, '101', '1001', 1, 1, 3, 1, '1000.00', '2018-06-08', 1),
(3, 2, '102', '1002', 1, 2, 4, 8, '250.00', '2018-06-08', 1),
(4, 4, '101', '1001', 101, 12, 9, 1, '1000.00', '2018-07-18', 1),
(5, 4, '101', '1001', 101, 12, 8, 1, '1000.00', '2018-07-18', 1),
(6, 4, '101', '1001', 101, 12, 5, 1, '1000.00', '2018-07-18', 1),
(7, 7, '1111', '1110', 123, 1111, 5, 10, '400.00', '2019-05-25', 1),
(8, 9, '125', '1200', 1, 101, 4, 11, '100.00', '2019-05-27', 1),
(9, 10, '125', '1200', 1, 102, 5, 11, '100.00', '2019-05-27', 1),
(10, 12, '126', '1260', 1, 100, 5, 7, '225.00', '2019-05-30', 1),
(11, 14, '01', '0000', 1, 10, 1, 10, '400.00', '2019-06-30', 1),
(12, 15, '116', '2235', 1, 1011, 5, 12, '1000.00', '2019-07-01', 1),
(13, 16, '126', '1260', 1, 1012, 6, 7, '225.00', '2019-07-01', 1),
(14, 19, '100', '1120', 12, 1, 6, 7, '225.00', '2019-07-03', 1),
(15, 23, '116', '2235', 2, 11, 7, 1, '1000.00', '2019-07-06', 1),
(16, 25, '100', '1120', 12, 1011, 5, 10, '400.00', '2019-07-08', 1),
(17, 26, '1250', '1250', 1, 122, 1, 1, '1000.00', '2019-07-14', 1),
(18, 26, '1250', '1250', 1, 122, 2, 2, '500.00', '2019-07-14', 1),
(19, 26, '1250', '1250', 1, 122, 3, 7, '225.00', '2019-07-14', 1),
(20, 27, '1250', '1250', 55, 222, 6, 1, '1000.00', '2019-07-17', 1),
(21, 27, '1250', '1250', 55, 222, 7, 1, '1000.00', '2019-07-17', 1),
(22, 28, '126', '1260', 5, 10, 1, 7, '225.00', '2019-07-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo`
--

CREATE TABLE `personalinfo` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `sonodno` varchar(17) DEFAULT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `nationid` varchar(20) DEFAULT NULL,
  `bcno` varchar(20) DEFAULT NULL,
  `pno` varchar(20) DEFAULT NULL,
  `dofb` date NOT NULL,
  `ename` varchar(60) NOT NULL,
  `name` varchar(80) NOT NULL,
  `gender` enum('male','female','others') NOT NULL,
  `mstatus` tinyint(2) NOT NULL,
  `holding_no` varchar(10) NOT NULL,
  `ewname` varchar(60) DEFAULT NULL,
  `bwname` varchar(80) DEFAULT NULL,
  `ehname` varchar(60) DEFAULT NULL,
  `bhname` varchar(80) DEFAULT NULL,
  `efname` varchar(60) NOT NULL,
  `bfname` varchar(80) NOT NULL,
  `emname` varchar(60) NOT NULL,
  `mname` varchar(80) NOT NULL,
  `ocupt` varchar(120) DEFAULT NULL,
  `edustatus` varchar(120) DEFAULT NULL,
  `religion` varchar(30) NOT NULL,
  `bashinda` enum('1','2') NOT NULL,
  `p_gram` varchar(60) DEFAULT NULL,
  `pb_gram` varchar(100) DEFAULT NULL,
  `p_rbs` varchar(60) DEFAULT NULL,
  `pb_rbs` varchar(80) DEFAULT NULL,
  `p_wordno` int(4) DEFAULT NULL,
  `pb_wordno` varchar(10) DEFAULT NULL,
  `p_dis` varchar(60) DEFAULT NULL,
  `pb_dis` varchar(100) DEFAULT NULL,
  `p_thana` varchar(60) DEFAULT NULL,
  `pb_thana` varchar(100) DEFAULT NULL,
  `p_postof` varchar(60) DEFAULT NULL,
  `pb_postof` varchar(100) DEFAULT NULL,
  `per_gram` varchar(60) DEFAULT NULL,
  `perb_gram` varchar(100) DEFAULT NULL,
  `per_rbs` varchar(60) DEFAULT NULL,
  `perb_rbs` varchar(80) DEFAULT NULL,
  `per_wordno` int(4) DEFAULT NULL,
  `perb_wordno` varchar(10) DEFAULT NULL,
  `per_dis` varchar(60) DEFAULT NULL,
  `perb_dis` varchar(100) DEFAULT NULL,
  `per_thana` varchar(60) DEFAULT NULL,
  `perb_thana` varchar(100) DEFAULT NULL,
  `per_postof` varchar(60) DEFAULT NULL,
  `perb_postof` varchar(100) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `profile` varchar(160) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `insert_time` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personalinfo`
--

INSERT INTO `personalinfo` (`id`, `trackid`, `sonodno`, `delivery_type`, `nationid`, `bcno`, `pno`, `dofb`, `ename`, `name`, `gender`, `mstatus`, `holding_no`, `ewname`, `bwname`, `ehname`, `bhname`, `efname`, `bfname`, `emname`, `mname`, `ocupt`, `edustatus`, `religion`, `bashinda`, `p_gram`, `pb_gram`, `p_rbs`, `pb_rbs`, `p_wordno`, `pb_wordno`, `p_dis`, `pb_dis`, `p_thana`, `pb_thana`, `p_postof`, `pb_postof`, `per_gram`, `perb_gram`, `per_rbs`, `perb_rbs`, `per_wordno`, `perb_wordno`, `per_dis`, `perb_dis`, `per_thana`, `perb_thana`, `per_postof`, `perb_postof`, `mobile`, `email`, `attachment`, `profile`, `status`, `insert_time`, `utime`) VALUES
(1, '379040', '20180915345607189', 3, '123456456789123', '1111111111114544', '1544545458787', '1990-06-12', 'Rana', 'রানা', 'male', 2, '101', '', '', '', '', 'Momin', 'মমিন', 'Razia', 'রেজিয়া', 'ছাত্র', 'এস এস সি', 'ইসলাম', '2', 'Dhaka', 'বব', '124', '৩', 12, '৩৩', 'Dhaka', 'বব', 'Dhaka', 'বব', 'Dhaka', 'ব', 'Dhaka', 'বব', '124', '৩', 12, '৩৩', 'Dhaka', 'বব', 'Dhaka', 'বব', 'Dhaka', 'ব', '01825292980', 'rana.feni.fci@gmail.com', 'dsfdfdfdfdfdf', 'http://localhost/db_correction/smartup/img/default/profile.png', '1', '2018-10-04', '2019-05-19 18:40:01'),
(2, '153119', '20190915345829640', 3, '', '', '', '1999-02-12', 'test', 'test', 'male', 2, '1111', '', '', '', '', 'aaasf', 'aasfas', 'asfdas', 'asdf', '', '', 'ইসলাম', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01825292987', '', '', 'http://localhost/db_correction/smartup/img/default/profile.png', '1', '2019-05-24', '2019-05-24 19:26:17'),
(3, '784188', '20190915345631995', 1, '', '', '', '1993-05-02', 'ss', 'াাা', 'male', 2, '125', '', '', '', '', 'sss', 'বিবববক', 'sss', 'াাাা', '', '', 'ইসলাম', '2', '', '', '', '', 0, '', 'sss', '', 'ffgfg', '', 'dd', '', '', '', '', '', 0, '', 'sss', '', 'ffgfg', '', 'dd', '', '01716344112', '', '', 'http://demo2.smartup.com.bd/img/default/profile.png', '1', '2019-05-27', '2019-05-27 06:20:57'),
(4, '831291', '20190915345079922', 3, '', '', '', '1996-07-02', 'dsfa', 'দেতকতদ', 'male', 2, '126', '', '', '', '', 'sfda', 'ুাি', 'df', 'ািু', '', '', 'ইসলাম', '1', '', '', '', '', 0, '', '', '', '', '', '', '', 'hdsf', 'ুিা', '', '', 2, '2', 'dsfa', 'ািুৃ', 'dsf', 'ৃুিা', 'dsf', 'ুা', '01716344112', '', '50', 'http://demo2.smartup.com.bd/img/default/profile.png', '1', '2019-05-30', '2019-05-30 06:15:06'),
(5, '444091', '20190915345133740', 3, '', '', '', '1970-01-01', 'aksar', 'asdadas', 'male', 1, '116', '5', 'asd', '', '', 'as', 'asdasd', 'asd', 'asda', 'asd', 'asda', 'ইসলাম', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01643789562', '', '', 'http://demo2.smartup.com.bd/img/default/profile.png', '1', '2019-07-01', '2019-07-01 04:47:12'),
(6, '508830', '20190915345961885', 2, '', '', '', '2019-10-07', 'asda', 'asdadas', 'male', 1, '116', 'aa', 'asd', '', '', 'Younus', 'aa', 'asd', 'asda', '', '', 'হিন্দু', '2', '', '', '', '', 0, '', 'aa', '', 'aa', 'aa', '', '', '', '', '', '', 0, '', 'aa', '', 'aa', 'aa', '', '', '01643789562', '', 'aaa', 'http://demo2.smartup.com.bd/img/default/profile.png', '1', '2019-07-03', '2019-07-03 04:57:03'),
(7, '479779', NULL, 3, '111111111111111', '11111111111111111', '11111111111111111', '2020-12-09', 'Md Omar Faruk', 'মো: ওমর ফারুক', 'male', 2, '101', '', '', '', '', 'মো: সিরাজুল হক', 'মো: সিরাজুল হক', 'নুরের নাহার', 'নুরের নাহার', 'বেকার', 'নাই', 'ইসলাম', '2', 's', 's', 's', 's', 0, 's', 'ts', 's', 's', 's', 's', 's', 's', 's', 's', 's', 0, 's', 'ts', 's', 's', 's', 's', 's', '01839707645', 'omarshohag93@gmail.com', 'test', 'img/default/profile.png', '0', '2020-12-26', '2020-12-26 04:29:47'),
(8, '022728', NULL, 3, '', '', '', '2020-12-23', '2', '2', 'female', 1, '102', '', '', '3', '3', '222', '22', '22', '22', '', '', 'হিন্দু', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01839707646', '', '', 'library/profile/1608988977.png', '0', '2020-12-26', '2020-12-26 13:22:58'),
(9, '358230', NULL, 3, '154862338955544', '', '', '1980-02-05', 'MD. Omar Faruk', 'মো: ওমর ফারুক', 'male', 5, '102', '', '', '', '', 'MD. Serajul Islam', 'মো: সিরাজুল ইসলাম', 'Nurer Naher', 'নুরেরর নাহার', 'চাকুরীজিবি', 'Bsc in CSE', 'ইসলাম', '2', 'Lemua', '', '', '', 5, '', 'Feni', '', 'Feni Sadar', '', 'Lemua Bazar', '', 'Lemua', '', '', '', 5, '', 'Feni', '', 'Feni Sadar', '', 'Lemua Bazar', '', '01840239203', '', 'N/A', 'library/profile/1608993516.jpg', '0', '2020-12-26', '2020-12-26 14:38:36'),
(10, '203019', NULL, 3, '', '', '', '2020-12-16', '3', '3', 'female', 1, '102', '', '', '2', '2', '3', '3', '3', '3', '', '', 'ইসলাম', '2', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '01420320809', '', '', 'library/profile/160929657748413.jpg', '0', '2020-12-27', '2020-12-30 02:49:37'),
(11, '899453', NULL, 3, '3233', '3', '3', '1970-01-01', '3', '3', 'male', 1, '102', '3', '3', '', '', '3', '3', '3', '3', '3', '3', 'ইসলাম', '2', '', '', '', '', 0, '', '3', '', '3', '', '3', '', '', '', '', '', 0, '', '3', '', '3', '', '3', '', '01839707644', '', 'ts', 'library/profile/160933354596484.jpg', '0', '2020-12-30', '2020-12-30 13:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `porichoprotro`
--

CREATE TABLE `porichoprotro` (
  `id` int(11) UNSIGNED NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `applicant_id` int(11) UNSIGNED NOT NULL,
  `trno` bigint(16) UNSIGNED NOT NULL,
  `vno` bigint(16) UNSIGNED NOT NULL,
  `acno` varchar(255) DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `porichoprotro`
--

INSERT INTO `porichoprotro` (`id`, `trackid`, `applicant_id`, `trno`, `vno`, `acno`, `fee`, `payment_date`, `utime`) VALUES
(1, '379040', 1, 6, 5, '0000-0000-0000-0000', '0.00', '2018-10-04', '2018-10-03 19:52:24'),
(2, '153119', 2, 9, 8, '0000-0000-0000-0000', '0.00', '2019-05-25', '2019-05-24 19:26:17'),
(3, '784188', 3, 12, 11, '0000-0000-0000-0000', '50.00', '2019-05-27', '2019-05-27 06:20:57'),
(4, '831291', 4, 14, 13, '0000-0000-0000-0000', '0.00', '2019-05-30', '2019-05-30 06:15:06'),
(5, '444091', 5, 18, 17, '0000-0000-0000-0000', '100.00', '2019-07-01', '2019-07-01 04:47:12'),
(6, '508830', 6, 19, 18, '0000-0000-0000-0000', '100.00', '2019-07-03', '2019-07-03 04:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `rate_sheet`
--

CREATE TABLE `rate_sheet` (
  `rid` int(11) NOT NULL,
  `licence_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ins_user` varchar(60) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1=active, 0= inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rate_sheet_history`
--

CREATE TABLE `rate_sheet_history` (
  `hid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `old_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `new_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ins_date` date NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `up_user` varchar(60) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `renew_req`
--

CREATE TABLE `renew_req` (
  `id` int(11) NOT NULL,
  `sno` varchar(17) NOT NULL,
  `dtype` tinyint(3) NOT NULL,
  `renew_utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setup_tbl`
--

CREATE TABLE `setup_tbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `full_name_english` varchar(255) NOT NULL,
  `gram` varchar(60) NOT NULL,
  `gram_english` varchar(60) NOT NULL,
  `thana` varchar(60) NOT NULL,
  `thana_english` varchar(60) NOT NULL,
  `district` varchar(60) NOT NULL,
  `district_english` varchar(60) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `union_code` varchar(10) NOT NULL,
  `upazila_code` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `web_link` varchar(40) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `porichoy_nid_api` varchar(500) DEFAULT NULL,
  `porichoy_api_key` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setup_tbl`
--

INSERT INTO `setup_tbl` (`id`, `full_name`, `full_name_english`, `gram`, `gram_english`, `thana`, `thana_english`, `district`, `district_english`, `postal_code`, `union_code`, `upazila_code`, `email`, `mobile`, `phone`, `web_link`, `created_by`, `created_ip`, `created_time`, `updated_by`, `updated_ip`, `updated_time`, `porichoy_nid_api`, `porichoy_api_key`) VALUES
(1, 'পোড়াবাড়ী ইউন‌িয়ন পর‌িষদ ', 'Porabari Union parishad', 'পোড়াবাড়ী বাজার', 'Porabari Bazar', 'টাঙ্গাইল সদর ', 'Tangail Sadar Upazila', 'টাঙ্গাইল ', 'Tangail ', '1900', '0915345', '1904', 'info@steptech.com', '0173356300', '0173356300', 'www.steptechbd.com', 0, '', '2021-02-26 19:47:50', 1, '103.205.71.20', '2020-12-30 19:05:06', 'https://porichoy.azurewebsites.net/api/Kyc/nid-person-values', '7c369818-47f9-42ec-b324-d84f65f20f13');

-- --------------------------------------------------------

--
-- Table structure for table `slide_setting`
--

CREATE TABLE `slide_setting` (
  `id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `sequence` smallint(5) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide_setting`
--

INSERT INTO `slide_setting` (`id`, `image_name`, `title`, `description`, `sequence`, `status`) VALUES
(1, 'Chrysanthemum.jpg', '', '', 0, '0'),
(2, 'Desert.jpg', '', '', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `snf_global_form`
--

CREATE TABLE `snf_global_form` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL COMMENT '1=occupation, 2=class',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=enable,2=disabled',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `snf_global_form`
--

INSERT INTO `snf_global_form` (`id`, `title`, `type`, `status`, `created_by`, `created_ip`, `created_date`, `updated_by`, `updated_ip`, `updated_date`) VALUES
(1, 'ব্যাবসায়ী', 1, 1, 1, '::1', '2018-06-05 01:24:30', NULL, NULL, NULL),
(2, 'প্রবাসী', 1, 1, 1, '::1', '2018-06-05 01:24:39', NULL, NULL, NULL),
(3, 'ভিক্ষুক', 1, 1, 1, '::1', '2018-06-05 01:24:50', NULL, NULL, NULL),
(4, 'কৃষক', 1, 1, 1, '::1', '2018-06-05 01:25:05', NULL, NULL, NULL),
(5, 'দিনমুজুর', 1, 1, 1, '::1', '2018-06-05 01:25:17', NULL, NULL, NULL),
(6, 'A', 2, 1, 1, '::1', '2018-06-05 01:25:36', NULL, NULL, NULL),
(7, 'B', 2, 1, 1, '::1', '2018-06-05 01:25:41', NULL, NULL, NULL),
(8, 'C', 2, 1, 1, '::1', '2018-06-05 01:25:45', NULL, NULL, NULL),
(9, 'D', 2, 1, 1, '::1', '2018-06-05 01:25:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subctg`
--

CREATE TABLE `subctg` (
  `id` int(11) NOT NULL,
  `mc_id` int(11) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subctg`
--

INSERT INTO `subctg` (`id`, `mc_id`, `sub_title`, `balance`) VALUES
(1, 6, 'অন্যান্য ফি', '250.00'),
(2, 3, 'ট্রেড লাইসেন্স ফি', '2466.80'),
(3, 1, 'ট্রেড লাইসেন্স ধারীর বসতভিটার উপর কর', '0.00'),
(4, 1, 'ব্যবসা,পেশা ও জীবিকার উপর কর', '100.00'),
(5, 1, 'হোল্ডিং ট্যাক্স ধারীর বসতভিটার উপর কর', '12713.00'),
(6, 1, 'বিনোদন কর সিনেমা, যাত্রা, নাটক ও অন্যান্য', '0.00'),
(7, 2, 'হাটবাজার', '0.00'),
(8, 2, 'ফেরী ঘাট', '0.00'),
(9, 2, 'জলমহল', '0.00'),
(10, 2, 'অন্যান্য', '0.00'),
(11, 7, '১ম কিস্তি', '1000.00'),
(12, 7, 'তৃতীয় কিস্তি', '0.00'),
(13, 8, 'চেয়ারম্যান ও সদস্যদের ভাতা', '0.00'),
(14, 8, 'সেক্রেটারী ও অন্যান্য কর্মচারীদের বেতন ও ভাতা', '0.00'),
(15, 9, 'কাবিখা', '0.00'),
(16, 9, 'টি আর', '0.00'),
(17, 9, 'এলজিএসপি', '0.00'),
(18, 9, 'অতিদরিদ্র কর্মসূচি', '0.00'),
(19, 9, 'থোক', '0.00'),
(20, 13, 'ভিজিডিও ভিজিএফ', '0.00'),
(21, 13, 'ব্যাংক জমা (এলজিএসপি)', '0.00'),
(22, 13, 'অন্যান্য', '0.00'),
(23, 14, 'UDC fee', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `subctg_in_budget`
--

CREATE TABLE `subctg_in_budget` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `actual_budget` decimal(10,2) NOT NULL DEFAULT 0.00,
  `budget_year` varchar(50) NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assesment`
--

CREATE TABLE `tbl_assesment` (
  `assid` int(11) NOT NULL,
  `hinfoid` int(11) NOT NULL,
  `htype_rate_id` int(11) NOT NULL,
  `ins_date` date NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ins_user` varchar(60) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_autistic`
--

CREATE TABLE `tbl_autistic` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_autisticstudent`
--

CREATE TABLE `tbl_autisticstudent` (
  `id` int(11) NOT NULL,
  `student_name` varchar(60) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `id` int(11) NOT NULL,
  `bno` int(11) NOT NULL DEFAULT 1,
  `fiscal_year` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `bno`, `fiscal_year`) VALUES
(1, 1, '2018-2019'),
(2, 2, '2019-2020'),
(3, 3, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fighters`
--

CREATE TABLE `tbl_fighters` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `sector_no` varchar(10) NOT NULL,
  `life_history` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fiscal_year`
--

CREATE TABLE `tbl_fiscal_year` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_year` varchar(10) NOT NULL,
  `short_year` varchar(6) NOT NULL,
  `start_year` date DEFAULT NULL,
  `end_year` date DEFAULT NULL,
  `is_current` tinyint(3) UNSIGNED NOT NULL COMMENT '2=old, 1= current, 0= upcomming',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(15) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_fiscal_year`
--

INSERT INTO `tbl_fiscal_year` (`id`, `full_year`, `short_year`, `start_year`, `end_year`, `is_current`, `created_by`, `created_ip`, `created_date`, `updated_by`, `updated_ip`, `updated_date`) VALUES
(1, '2014-2015', '14-15', '2014-06-30', '2015-06-30', 2, 1, NULL, '2018-05-09 16:45:41', NULL, NULL, NULL),
(2, '2015-2016', '15-16', '2015-06-30', '2016-06-30', 2, 1, NULL, '2018-05-09 19:53:39', NULL, NULL, NULL),
(3, '2016-2017', '16-17', '2016-06-30', '2017-06-30', 2, 1, NULL, '2018-05-09 16:37:35', NULL, NULL, NULL),
(4, '2017-2018', '17-18', '2017-06-30', '2018-06-30', 2, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL),
(5, '2018-2019', '18-19', '2018-06-30', '2019-06-30', 1, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL),
(6, '2019-2020', '19-20', '2019-06-30', '2020-06-30', 0, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL),
(7, '2020-2021', '20-21', '2020-06-30', '2021-06-30', 0, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL),
(8, '2021-2022', '21-22', '2021-06-30', '2022-06-30', 0, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL),
(9, '2022-2023', '22-23', '2022-06-30', '2023-06-30', 0, 1, NULL, '2018-05-09 18:44:40', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foreignman`
--

CREATE TABLE `tbl_foreignman` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mother_vata`
--

CREATE TABLE `tbl_mother_vata` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descrip` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `entry_user` varchar(40) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `title`, `descrip`, `status`, `entry_user`, `entry_date`) VALUES
(1, 'test double', '<p>hello world&nbsp; double test adf</p>', '1', 'admin', '2020-12-26 21:31:25'),
(2, 'news two ', '<p>news two details</p>', '1', 'admin', '2018-07-17 20:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oldmanstipend`
--

CREATE TABLE `tbl_oldmanstipend` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poormans`
--

CREATE TABLE `tbl_poormans` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tracking`
--

CREATE TABLE `tbl_tracking` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tracking`
--

INSERT INTO `tbl_tracking` (`id`, `trackid`, `utime`) VALUES
(1, '379040', '2018-10-03 19:51:40'),
(2, '258853', '2018-10-08 19:56:47'),
(3, '054265', '2019-02-03 18:36:40'),
(4, '153119', '2019-05-24 10:51:09'),
(5, '784188', '2019-05-27 06:18:03'),
(6, '831291', '2019-05-30 06:14:48'),
(7, '444091', '2019-07-01 04:44:28'),
(8, '508830', '2019-07-03 04:55:47'),
(9, '181566', '2019-07-04 05:29:00'),
(10, '432432', '2019-07-19 05:13:25'),
(11, '534718', '2020-09-21 17:19:56'),
(12, '479779', '2020-12-26 04:29:47'),
(13, '022728', '2020-12-26 13:22:58'),
(14, '358230', '2020-12-26 14:38:36'),
(15, '203019', '2020-12-26 20:05:04'),
(16, '851863', '2020-12-26 20:38:24'),
(17, '448740', '2020-12-26 21:00:49'),
(18, '093144', '2020-12-26 21:02:36'),
(19, '733613', '2020-12-26 21:04:43'),
(20, '398519', '2020-12-26 21:11:51'),
(21, '899453', '2020-12-30 13:05:19'),
(22, '176080', '2020-12-30 13:39:58'),
(23, '597436', '2020-12-30 13:46:18'),
(24, '553186', '2020-12-30 17:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upmember`
--

CREATE TABLE `tbl_upmember` (
  `id` int(11) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `n_id` varchar(20) NOT NULL,
  `designation` tinyint(4) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `dofb` date NOT NULL,
  `mstatus` tinyint(3) NOT NULL,
  `district` varchar(60) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `joindate` date NOT NULL,
  `barea` varchar(120) NOT NULL,
  `vno` varchar(10) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `update_by` varchar(40) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_upmember`
--

INSERT INTO `tbl_upmember` (`id`, `full_name`, `n_id`, `designation`, `status`, `mobile`, `email`, `dofb`, `mstatus`, `district`, `qualification`, `joindate`, `barea`, `vno`, `pic`, `update_by`, `utime`) VALUES
(1, 'মোঃ মোয়াজ্জম হোসেন লস্কর', '', 1, '1', '০১৭১২৫৩০৮৭২', 'muazzam1967@gmail.com', '2018-04-07', 1, 'Sylhet', '', '1970-01-01', '', '', 'nasim.jpg', '', '2020-12-26 21:24:25'),
(2, 'rana', '12121212121212121', 3, '1', '01825292988', 'rana.feni@gmail.com', '1999-05-10', 2, 'feni', 'ssc', '1970-01-01', 'feni', '8', 'DSC_00548 (1).jpg', '', '2021-02-15 02:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voter_list`
--

CREATE TABLE `tbl_voter_list` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `upazila_code` varchar(10) NOT NULL,
  `union_code` varchar(10) NOT NULL,
  `bangla_name` varchar(100) NOT NULL,
  `english_name` varchar(60) NOT NULL,
  `father_name` varchar(80) NOT NULL,
  `mother_name` varchar(80) NOT NULL,
  `date_of_birth` date NOT NULL,
  `basha` varchar(60) NOT NULL,
  `gram` varchar(60) NOT NULL,
  `word_no` varchar(10) NOT NULL,
  `post_office` varchar(60) NOT NULL,
  `upzilla` varchar(60) NOT NULL,
  `district` varchar(60) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warishesinfo`
--

CREATE TABLE `tbl_warishesinfo` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `sonodno` varchar(17) DEFAULT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `nationid` varchar(20) DEFAULT NULL,
  `bcno` varchar(20) DEFAULT NULL,
  `pno` varchar(20) DEFAULT NULL,
  `dofb` date NOT NULL,
  `ename` varchar(60) NOT NULL,
  `bname` varchar(80) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mstatus` tinyint(2) NOT NULL,
  `ewname` varchar(60) DEFAULT NULL,
  `bwname` varchar(80) DEFAULT NULL,
  `ehname` varchar(60) DEFAULT NULL,
  `bhname` varchar(80) DEFAULT NULL,
  `efname` varchar(60) NOT NULL,
  `bfname` varchar(80) NOT NULL,
  `emname` varchar(60) NOT NULL,
  `bmane` varchar(80) NOT NULL,
  `ocupt` varchar(120) DEFAULT NULL,
  `bashinda` enum('1','2') NOT NULL,
  `p_gram` varchar(60) DEFAULT NULL,
  `pb_gram` varchar(100) DEFAULT NULL,
  `p_rbs` varchar(60) DEFAULT NULL,
  `pb_rbs` varchar(100) DEFAULT NULL,
  `p_wordno` int(4) DEFAULT NULL,
  `pb_wordno` varchar(10) DEFAULT NULL,
  `p_dis` varchar(60) DEFAULT NULL,
  `pb_dis` varchar(100) DEFAULT NULL,
  `p_thana` varchar(60) DEFAULT NULL,
  `pb_thana` varchar(100) DEFAULT NULL,
  `p_postof` varchar(60) DEFAULT NULL,
  `pb_postof` varchar(100) DEFAULT NULL,
  `per_gram` varchar(60) DEFAULT NULL,
  `perb_gram` varchar(100) DEFAULT NULL,
  `per_rbs` varchar(60) DEFAULT NULL,
  `perb_rbs` varchar(100) DEFAULT NULL,
  `per_wordno` int(4) DEFAULT NULL,
  `perb_wordno` varchar(10) DEFAULT NULL,
  `per_dis` varchar(60) DEFAULT NULL,
  `perb_dis` varchar(100) DEFAULT NULL,
  `per_thana` varchar(60) DEFAULT NULL,
  `perb_thana` varchar(100) DEFAULT NULL,
  `per_postof` varchar(60) DEFAULT NULL,
  `perb_postof` varchar(100) DEFAULT NULL,
  `english_applicant_name` varchar(60) NOT NULL,
  `bangla_applicant_name` varchar(80) NOT NULL,
  `english_applicant_father_name` varchar(60) NOT NULL,
  `bangla_applicant_father_name` varchar(80) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `verifier_name` varchar(60) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `ins_time` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_warishesinfo`
--

INSERT INTO `tbl_warishesinfo` (`id`, `trackid`, `sonodno`, `delivery_type`, `nationid`, `bcno`, `pno`, `dofb`, `ename`, `bname`, `gender`, `mstatus`, `ewname`, `bwname`, `ehname`, `bhname`, `efname`, `bfname`, `emname`, `bmane`, `ocupt`, `bashinda`, `p_gram`, `pb_gram`, `p_rbs`, `pb_rbs`, `p_wordno`, `pb_wordno`, `p_dis`, `pb_dis`, `p_thana`, `pb_thana`, `p_postof`, `pb_postof`, `per_gram`, `perb_gram`, `per_rbs`, `perb_rbs`, `per_wordno`, `perb_wordno`, `per_dis`, `perb_dis`, `per_thana`, `perb_thana`, `per_postof`, `perb_postof`, `english_applicant_name`, `bangla_applicant_name`, `english_applicant_father_name`, `bangla_applicant_father_name`, `mobile`, `email`, `verifier_name`, `note`, `status`, `ins_time`, `utime`) VALUES
(1, '258853', '20180915345240279', 3, '34543534532453245', '23453245345', '234532453245', '2018-10-09', 'Md Abdul Karim', 'মো: আবদুল করিম', 'male', 2, NULL, NULL, NULL, NULL, 'Kamal Uddin', 'কামাল উদ্দিন', 'Halima Begum', 'হালিমা বেগম', 'sdfg', '2', 'Lemua Bazar', 'লেমুয়া বাজার', 'Lemua Bazar', 'লেমুয়া বাজার', 4, '4', 'Feni', 'ফেনী', 'Feni Sadar', 'ফেনী সদর', 'Lemua Bazar', 'লেমুয়া বাজার', 'Lemua Bazar', 'লেমুয়া বাজার', 'Lemua Bazar', 'লেমুয়া বাজার', 4, '4', 'Feni', 'ফেনী', 'Feni Sadar', 'ফেনী সদর', 'Lemua Bazar', 'লেমুয়া বাজার', 'Md Omar Faruk', 'মো: ওমর ফারুক', 'Md Serajul Islam', 'মো: সিরাজুল ইসলাম', '01825292963', 'omarshohag93@gmail.com', 'aaaa', 'আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের নাম বাংলাদেশ আমাদের দেশের', '1', '2018-10-09', '2020-08-31 08:59:16'),
(2, '054265', '20200915345222389', 3, '', '', '', '2019-02-20', 'sdfg', 'sdfg', 'male', 2, NULL, NULL, NULL, NULL, 'sdfg', 'sdfg', 'sdfg', 'sdf', 'sdfg', '2', 'sdfg', 'sdf', 'sdfg', 'sdfg', 4, '4', 'sdf', 'sdf', 'sdf', 'sdf', 'sdfg', 'sdf', 'sdfg', 'sdf', 'sdfg', 'sdfg', 4, '4', 'sdf', 'sdf', 'sdf', 'sdf', 'sdfg', 'sdf', 'sdfg', 'sdfg', 'sdfg', 'sdfg', '01825292960', 'rana.feni.fci@gmail.com', 'জয়নাল ', 'sdgsdgsdfg sdfg s sdg test', '1', '2019-02-04', '2020-08-31 08:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wcc`
--

CREATE TABLE `tbl_wcc` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `trno` bigint(20) NOT NULL,
  `vno` bigint(20) NOT NULL,
  `acno` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wcc`
--

INSERT INTO `tbl_wcc` (`id`, `trackid`, `applicant_id`, `trno`, `vno`, `acno`, `fee`, `payment_date`, `utime`) VALUES
(1, '258853', 1, 7, 6, '0000-0000-0000-0000', '0.00', '2018-10-09', '2018-10-08 19:58:22'),
(2, '054265', 2, 31, 30, '0000-0000-0000-0000', '0.00', '2020-08-31', '2020-08-31 08:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_webtools`
--

CREATE TABLE `tbl_webtools` (
  `id` int(11) NOT NULL,
  `item_no` tinyint(3) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `entry_user` varchar(40) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_webtools`
--

INSERT INTO `tbl_webtools` (`id`, `item_no`, `status`, `entry_user`, `entry_date`) VALUES
(2, 1, '1', 'admin', '2017-04-18 11:12:13'),
(3, 2, '0', 'admin', '2020-08-31 09:00:43'),
(4, 3, '1', 'admin', '2017-04-18 11:12:13'),
(5, 4, '1', 'admin', '2017-05-23 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_widow`
--

CREATE TABLE `tbl_widow` (
  `id` int(11) NOT NULL,
  `national_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `insert_by` varchar(40) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tradelicense`
--

CREATE TABLE `tradelicense` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `sno` varchar(17) DEFAULT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `app_type` tinyint(3) NOT NULL,
  `ownertype` tinyint(3) NOT NULL,
  `ecomname` varchar(200) NOT NULL,
  `bcomname` varchar(255) NOT NULL,
  `ewname` varchar(160) NOT NULL,
  `bwname` varchar(200) NOT NULL,
  `gender` varchar(80) NOT NULL,
  `mstatus` varchar(80) NOT NULL,
  `efname` varchar(160) NOT NULL,
  `bfname` varchar(200) NOT NULL,
  `ehname` varchar(100) DEFAULT NULL,
  `bhname` varchar(100) DEFAULT NULL,
  `emname` varchar(160) NOT NULL,
  `bmane` varchar(200) NOT NULL,
  `vatid` varchar(20) DEFAULT NULL,
  `taxid` varchar(20) DEFAULT NULL,
  `btype` varchar(200) NOT NULL,
  `btype_english` varchar(120) DEFAULT NULL,
  `pay_amount` decimal(4,2) NOT NULL,
  `be_gram` varchar(60) DEFAULT NULL,
  `bb_gram` varchar(100) DEFAULT NULL,
  `be_rbs` varchar(60) DEFAULT NULL,
  `bb_rbs` varchar(100) DEFAULT NULL,
  `be_wordno` int(4) DEFAULT NULL,
  `bb_wordno` varchar(10) DEFAULT NULL,
  `be_dis` varchar(60) DEFAULT NULL,
  `bb_dis` varchar(100) DEFAULT NULL,
  `be_thana` varchar(60) DEFAULT NULL,
  `bb_thana` varchar(100) DEFAULT NULL,
  `be_postof` varchar(60) DEFAULT NULL,
  `bb_postof` varchar(100) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `profile` varchar(160) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1',
  `insert_time` date NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `syn_status` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tradelicense`
--

INSERT INTO `tradelicense` (`id`, `trackid`, `sno`, `delivery_type`, `app_type`, `ownertype`, `ecomname`, `bcomname`, `ewname`, `bwname`, `gender`, `mstatus`, `efname`, `bfname`, `ehname`, `bhname`, `emname`, `bmane`, `vatid`, `taxid`, `btype`, `btype_english`, `pay_amount`, `be_gram`, `bb_gram`, `be_rbs`, `bb_rbs`, `be_wordno`, `bb_wordno`, `be_dis`, `bb_dis`, `be_thana`, `bb_thana`, `be_postof`, `bb_postof`, `mobile`, `phone`, `email`, `profile`, `issue_date`, `expire_date`, `status`, `insert_time`, `utime`, `syn_status`) VALUES
(1, '11111111', '20180915345445294', 1, 1, 1, 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', NULL, NULL, 'aa', 'aa', NULL, NULL, 'aa', 'Contractor', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rana.jpg', '2018-07-18', '2019-06-30', '', '0000-00-00', '2019-06-30 12:04:13', 1),
(2, '181566', '20190915345589712', 2, 1, 1, 'Jamal Traders', 'জামাল ট্রেডার্স', 'Jamal Uddin', 'জামাল উদ্দিন', 'male', 'বিবাহিত', 'Serajul Islam', 'সিরাজুল ইসলাম', '', '', 'Nurer Naher', 'নুরের নাহার', '', '', 'রট সিমেন্টের দোকান', 'Rot and Sement Shop', '0.00', 'Lemua Bazar', 'লেমুয়া বাজর', 'Lemua Bazar', 'লেমুয়া বাজার', 2, '২', 'Feni', 'ফেনী', 'Feni Sadar', 'ফেনী সদর', 'Lemua Bazar', 'লেমুয়া বাজার', '01643789562', '41525', 'omarshohag93@gmail.com', 'library/profile/160935515537793.jpg', '2020-08-31', '2021-06-30', '2', '2019-07-04', '2020-12-30 19:05:55', 1),
(3, '432432', '20190915345252419', 1, 1, 1, 'z', 'z', 'z', 'z', 'male', 'বিবাহিত', 'z', 'z', '', '', 'z', 'z', '11', '11', 'z', 'z', '0.00', 'z', 'z', 'z', 'z', 10, 'z', 'z', 'z', 'z', 'z', 'z', 'z', '11', '11', '', 'http://demo2.smartup.com.bd/img/default/profile.png', '2019-07-19', '2020-06-30', '2', '2019-07-19', '2019-07-19 05:14:19', 1),
(4, '534718', NULL, 3, 1, 1, 'Gm Brothers', 'জি এম ব্রাদার্স', 'Md. Omar Faruk', 'মো : ওমর ফারুক', 'male', 'বিবাহিত', 'Md. Serajul Islam', 'মো: সিরাজুল ইসলাম', '', '', 'Nurer Naher', 'নুরের নাহার', '', '', 'টেডিং করোপোরেশন', 'Trading Corporation', '0.00', 'Lemua Bazar', '', '', '', 9, '', 'Feni', '', 'Feni sadar', '', 'Lemua  Bazar', '', '01839707645', '', 'omarlemua@gmail.com', 'http://localhost/smartUp/img/default/profile.png', '0000-00-00', '0000-00-00', '1', '2020-09-21', '2020-09-21 17:19:56', 1),
(5, '851863', NULL, 3, 1, 1, 'ss', 'ss', 'ss', 'ss', 'male', 'অবিবাহিত', 'ss', 's', '', '', 's', 's', '', '', 's', 's', '0.00', '', '', '', '', 0, '', '', '', '', '', '', '', '01830320809', '', '', 'library/profile/160935519138824.JPG', '0000-00-00', '0000-00-00', '1', '2020-12-27', '2020-12-30 19:06:31', 1),
(6, '176080', NULL, 3, 1, 1, 'shohag traders', '3', '3', '3', 'male', 'বিবাহিত', '3', '3', '', '', '3', '3', '3', '3', '3', '3', '0.00', '33', '', '3', '', 33, '', '3', '', '3', '', '33', '', '01834567891', '', '', 'library/profile/160935520273539.JPG', '0000-00-00', '0000-00-00', '1', '2020-12-30', '2020-12-30 19:06:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(16) UNSIGNED NOT NULL,
  `tid` bigint(16) UNSIGNED NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `tid`, `up_date`) VALUES
(1, 1, '2018-06-07 22:54:49'),
(2, 2, '2018-06-07 22:57:08'),
(3, 3, '2018-07-17 20:37:17'),
(4, 4, '2018-07-17 21:10:39'),
(5, 5, '2018-08-18 16:07:30'),
(6, 6, '2018-10-03 19:52:24'),
(7, 7, '2018-10-08 19:58:22'),
(8, 8, '2019-05-24 19:23:05'),
(9, 9, '2019-05-24 19:26:17'),
(10, 10, '2019-05-27 06:14:42'),
(11, 11, '2019-05-27 06:19:35'),
(12, 12, '2019-05-27 06:20:57'),
(13, 13, '2019-05-30 05:25:07'),
(14, 14, '2019-05-30 06:15:06'),
(15, 15, '2019-06-29 19:55:07'),
(16, 16, '2019-07-01 04:46:00'),
(17, 17, '2019-07-01 04:46:43'),
(18, 18, '2019-07-01 04:47:12'),
(19, 19, '2019-07-03 04:57:03'),
(20, 20, '2019-07-03 05:05:49'),
(21, 21, '2019-07-04 05:29:25'),
(22, 22, '2019-07-04 11:16:10'),
(23, 23, '2019-07-04 11:17:45'),
(24, 24, '2019-07-06 09:16:42'),
(25, 25, '2019-07-07 17:11:31'),
(26, 26, '2019-07-08 08:58:20'),
(29, 27, '2019-07-14 15:11:57'),
(30, 28, '2019-07-17 05:05:26'),
(31, 29, '2019-07-17 12:03:08'),
(32, 30, '2019-07-19 05:14:19'),
(33, 31, '2020-08-31 08:59:36'),
(34, 32, '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `up_map`
--

CREATE TABLE `up_map` (
  `id` int(11) NOT NULL,
  `map_link` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `update_by` varchar(40) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `up_map`
--

INSERT INTO `up_map` (`id`, `map_link`, `status`, `update_by`, `utime`) VALUES
(1, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14608.267806000722!2d90.3613731697754!3d23.74499180000001!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1531860173707\" width=\"100%\" height=\"\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '1', '', '2018-07-17 20:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `up_sonods`
--

CREATE TABLE `up_sonods` (
  `id` int(11) NOT NULL,
  `sno` varchar(17) NOT NULL,
  `utime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `up_sonods`
--

INSERT INTO `up_sonods` (`id`, `sno`, `utime`) VALUES
(1, '20180915345445294', '2018-07-17 20:37:17'),
(2, '20180915345607189', '2018-10-03 19:52:24'),
(3, '20180915345240279', '2018-10-08 19:58:22'),
(4, '20190915345829640', '2019-05-24 19:26:17'),
(5, '20190915345631995', '2019-05-27 06:20:57'),
(6, '20190915345079922', '2019-05-30 06:15:06'),
(7, '20190915345133740', '2019-07-01 04:47:12'),
(8, '20190915345703511', '2019-07-01 09:34:38'),
(9, '20190915345550952', '2019-07-01 10:53:04'),
(10, '20190915345290546', '2019-07-02 06:21:02'),
(11, '20190915345825137', '2019-07-02 09:18:23'),
(12, '20190915345961885', '2019-07-03 04:57:03'),
(13, '20190915345589712', '2019-07-04 05:29:25'),
(14, '20190915345252419', '2019-07-19 05:14:19'),
(15, '20200915345222389', '2020-08-31 08:59:36'),
(16, '20200915345752498', '2020-12-26 21:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `warishinfo`
--

CREATE TABLE `warishinfo` (
  `id` int(11) NOT NULL,
  `trackid` varchar(8) NOT NULL,
  `w_name` varchar(60) NOT NULL,
  `w_relation` varchar(30) NOT NULL,
  `w_age` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warishinfo`
--

INSERT INTO `warishinfo` (`id`, `trackid`, `w_name`, `w_relation`, `w_age`) VALUES
(1, '258853', 'ff', 'ff', '4'),
(2, '258853', 'sdfg', 'sdfg', '3'),
(3, '258853', 'asdf', 'asf', '3'),
(4, '054265', 'sd', 'sdf', '4'),
(5, '054265', 'sdf', 'sdf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `word_member`
--

CREATE TABLE `word_member` (
  `id` int(11) NOT NULL,
  `word_no` smallint(6) UNSIGNED NOT NULL,
  `member_name` varchar(60) NOT NULL,
  `member_father` varchar(60) NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ip` varchar(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=enable, 2= disable',
  `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0= active, 1 = delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `word_member`
--

INSERT INTO `word_member` (`id`, `word_no`, `member_name`, `member_father`, `created_by`, `created_ip`, `created_date`, `updated_by`, `updated_ip`, `updated_date`, `is_active`, `is_delete`) VALUES
(1, 1, 'aa', 'aa', 1, '::1', '2018-10-06 00:47:09', NULL, NULL, NULL, 1, 0),
(2, 2, 'sads', 'sdsd', 1, '::1', '2018-10-06 23:15:52', NULL, NULL, NULL, 1, 0),
(3, 3, 'dfsdf', 'dfdf', 1, '::1', '2018-10-06 23:16:23', NULL, NULL, NULL, 1, 0),
(4, 4, 'aa', 'aa', 1, '::1', '2018-10-06 23:16:58', NULL, NULL, NULL, 1, 0),
(5, 5, 'fd', 'dfdf', 1, '::1', '2018-10-06 23:17:25', NULL, NULL, NULL, 1, 0),
(6, 6, 'dfdf', 'dfdf', 1, '::1', '2018-10-07 01:20:34', 1, '::1', '2018-10-07 01:20:39', 1, 1),
(7, 6, 'df', 'dfdf', 1, '::1', '2018-10-07 01:37:10', 1, '::1', '2018-10-07 01:37:16', 1, 1),
(8, 6, 'sdg', 'sdfg', 1, '::1', '2018-10-07 01:37:23', NULL, NULL, NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountlogs`
--
ALTER TABLE `accountlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acinfo`
--
ALTER TABLE `acinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `app_list`
--
ALTER TABLE `app_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_validation`
--
ALTER TABLE `app_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buisnestypes`
--
ALTER TABLE `buisnestypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chairman_message`
--
ALTER TABLE `chairman_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmd`
--
ALTER TABLE `cmd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_voucher`
--
ALTER TABLE `credit_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailycollection`
--
ALTER TABLE `dailycollection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyexp`
--
ALTER TABLE `dailyexp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_login_history`
--
ALTER TABLE `dcb_login_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `dcb_mobile_verfication`
--
ALTER TABLE `dcb_mobile_verfication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_security_question`
--
ALTER TABLE `dcb_security_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `dcb_security_setting`
--
ALTER TABLE `dcb_security_setting`
  ADD PRIMARY KEY (`security_id`);

--
-- Indexes for table `dcb_sms`
--
ALTER TABLE `dcb_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_sms_notification`
--
ALTER TABLE `dcb_sms_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_sms_setting`
--
ALTER TABLE `dcb_sms_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_sq_ans`
--
ALTER TABLE `dcb_sq_ans`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `debit_voucher`
--
ALTER TABLE `debit_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exphead`
--
ALTER TABLE `exphead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expurpose`
--
ALTER TABLE `expurpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_dealer_info`
--
ALTER TABLE `food_dealer_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_program_info`
--
ALTER TABLE `food_program_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_receiver_applicant_info`
--
ALTER TABLE `food_receiver_applicant_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_receiver_record`
--
ALTER TABLE `food_receiver_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_sub_ctg`
--
ALTER TABLE `fund_sub_ctg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_transfer`
--
ALTER TABLE `fund_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getlicense`
--
ALTER TABLE `getlicense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holdingclientinfo`
--
ALTER TABLE `holdingclientinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holding_rate_sheet`
--
ALTER TABLE `holding_rate_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holding_rate_sheet_label`
--
ALTER TABLE `holding_rate_sheet_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_hostory`
--
ALTER TABLE `license_hostory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_notification`
--
ALTER TABLE `license_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainctg`
--
ALTER TABLE `mainctg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainctg_in_budget`
--
ALTER TABLE `mainctg_in_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mamla_badi`
--
ALTER TABLE `mamla_badi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mamla_bibadi`
--
ALTER TABLE `mamla_bibadi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mamla_tbl`
--
ALTER TABLE `mamla_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onnanoseba`
--
ALTER TABLE `onnanoseba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherserviceinfo`
--
ALTER TABLE `otherserviceinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherservicelist`
--
ALTER TABLE `otherservicelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_log_bosotbita`
--
ALTER TABLE `payment_log_bosotbita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalinfo`
--
ALTER TABLE `personalinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trackid` (`trackid`),
  ADD UNIQUE KEY `sonodno` (`sonodno`);

--
-- Indexes for table `porichoprotro`
--
ALTER TABLE `porichoprotro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_sheet`
--
ALTER TABLE `rate_sheet`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `rate_sheet_history`
--
ALTER TABLE `rate_sheet_history`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `renew_req`
--
ALTER TABLE `renew_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_tbl`
--
ALTER TABLE `setup_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide_setting`
--
ALTER TABLE `slide_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snf_global_form`
--
ALTER TABLE `snf_global_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subctg`
--
ALTER TABLE `subctg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subctg_in_budget`
--
ALTER TABLE `subctg_in_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assesment`
--
ALTER TABLE `tbl_assesment`
  ADD PRIMARY KEY (`assid`);

--
-- Indexes for table `tbl_autistic`
--
ALTER TABLE `tbl_autistic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_autisticstudent`
--
ALTER TABLE `tbl_autisticstudent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fighters`
--
ALTER TABLE `tbl_fighters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_fiscal_year`
--
ALTER TABLE `tbl_fiscal_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_foreignman`
--
ALTER TABLE `tbl_foreignman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_mother_vata`
--
ALTER TABLE `tbl_mother_vata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_oldmanstipend`
--
ALTER TABLE `tbl_oldmanstipend`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_poormans`
--
ALTER TABLE `tbl_poormans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_tracking`
--
ALTER TABLE `tbl_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trackid` (`trackid`);

--
-- Indexes for table `tbl_upmember`
--
ALTER TABLE `tbl_upmember`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `n_id` (`n_id`);

--
-- Indexes for table `tbl_voter_list`
--
ALTER TABLE `tbl_voter_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tbl_warishesinfo`
--
ALTER TABLE `tbl_warishesinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trackid` (`trackid`),
  ADD UNIQUE KEY `sonodno` (`sonodno`);

--
-- Indexes for table `tbl_wcc`
--
ALTER TABLE `tbl_wcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_webtools`
--
ALTER TABLE `tbl_webtools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_widow`
--
ALTER TABLE `tbl_widow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `tradelicense`
--
ALTER TABLE `tradelicense`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trackid` (`trackid`),
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_map`
--
ALTER TABLE `up_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `up_sonods`
--
ALTER TABLE `up_sonods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warishinfo`
--
ALTER TABLE `warishinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `word_member`
--
ALTER TABLE `word_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountlogs`
--
ALTER TABLE `accountlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acinfo`
--
ALTER TABLE `acinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_list`
--
ALTER TABLE `app_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_validation`
--
ALTER TABLE `app_validation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buisnestypes`
--
ALTER TABLE `buisnestypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chairman_message`
--
ALTER TABLE `chairman_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cmd`
--
ALTER TABLE `cmd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credit_voucher`
--
ALTER TABLE `credit_voucher`
  MODIFY `id` bigint(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dailycollection`
--
ALTER TABLE `dailycollection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dailyexp`
--
ALTER TABLE `dailyexp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dcb_login_history`
--
ALTER TABLE `dcb_login_history`
  MODIFY `history_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `dcb_mobile_verfication`
--
ALTER TABLE `dcb_mobile_verfication`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dcb_security_question`
--
ALTER TABLE `dcb_security_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dcb_security_setting`
--
ALTER TABLE `dcb_security_setting`
  MODIFY `security_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dcb_sms`
--
ALTER TABLE `dcb_sms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dcb_sms_notification`
--
ALTER TABLE `dcb_sms_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dcb_sms_setting`
--
ALTER TABLE `dcb_sms_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dcb_sq_ans`
--
ALTER TABLE `dcb_sq_ans`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `debit_voucher`
--
ALTER TABLE `debit_voucher`
  MODIFY `id` bigint(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exphead`
--
ALTER TABLE `exphead`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expurpose`
--
ALTER TABLE `expurpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food_dealer_info`
--
ALTER TABLE `food_dealer_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `food_program_info`
--
ALTER TABLE `food_program_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_receiver_applicant_info`
--
ALTER TABLE `food_receiver_applicant_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_receiver_record`
--
ALTER TABLE `food_receiver_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fund_sub_ctg`
--
ALTER TABLE `fund_sub_ctg`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `fund_transfer`
--
ALTER TABLE `fund_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `getlicense`
--
ALTER TABLE `getlicense`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holdingclientinfo`
--
ALTER TABLE `holdingclientinfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `holding_rate_sheet`
--
ALTER TABLE `holding_rate_sheet`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `holding_rate_sheet_label`
--
ALTER TABLE `holding_rate_sheet_label`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `license_hostory`
--
ALTER TABLE `license_hostory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `license_notification`
--
ALTER TABLE `license_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mainctg`
--
ALTER TABLE `mainctg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mainctg_in_budget`
--
ALTER TABLE `mainctg_in_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mamla_badi`
--
ALTER TABLE `mamla_badi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mamla_bibadi`
--
ALTER TABLE `mamla_bibadi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mamla_tbl`
--
ALTER TABLE `mamla_tbl`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `onnanoseba`
--
ALTER TABLE `onnanoseba`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otherserviceinfo`
--
ALTER TABLE `otherserviceinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otherservicelist`
--
ALTER TABLE `otherservicelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_log_bosotbita`
--
ALTER TABLE `payment_log_bosotbita`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personalinfo`
--
ALTER TABLE `personalinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `porichoprotro`
--
ALTER TABLE `porichoprotro`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rate_sheet`
--
ALTER TABLE `rate_sheet`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rate_sheet_history`
--
ALTER TABLE `rate_sheet_history`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renew_req`
--
ALTER TABLE `renew_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setup_tbl`
--
ALTER TABLE `setup_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slide_setting`
--
ALTER TABLE `slide_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `snf_global_form`
--
ALTER TABLE `snf_global_form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subctg`
--
ALTER TABLE `subctg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subctg_in_budget`
--
ALTER TABLE `subctg_in_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assesment`
--
ALTER TABLE `tbl_assesment`
  MODIFY `assid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_autistic`
--
ALTER TABLE `tbl_autistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_autisticstudent`
--
ALTER TABLE `tbl_autisticstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_fighters`
--
ALTER TABLE `tbl_fighters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_fiscal_year`
--
ALTER TABLE `tbl_fiscal_year`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_foreignman`
--
ALTER TABLE `tbl_foreignman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mother_vata`
--
ALTER TABLE `tbl_mother_vata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_oldmanstipend`
--
ALTER TABLE `tbl_oldmanstipend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_poormans`
--
ALTER TABLE `tbl_poormans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tracking`
--
ALTER TABLE `tbl_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_upmember`
--
ALTER TABLE `tbl_upmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_voter_list`
--
ALTER TABLE `tbl_voter_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_warishesinfo`
--
ALTER TABLE `tbl_warishesinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_wcc`
--
ALTER TABLE `tbl_wcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_webtools`
--
ALTER TABLE `tbl_webtools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_widow`
--
ALTER TABLE `tbl_widow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tradelicense`
--
ALTER TABLE `tradelicense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `up_map`
--
ALTER TABLE `up_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `up_sonods`
--
ALTER TABLE `up_sonods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warishinfo`
--
ALTER TABLE `warishinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `word_member`
--
ALTER TABLE `word_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
