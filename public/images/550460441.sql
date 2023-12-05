-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2023 at 10:15 PM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_hunddler`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backlog`
--

CREATE TABLE `backlog` (
  `id` int(11) NOT NULL,
  `epic_title` varchar(255) DEFAULT NULL,
  `epic_start_date` varchar(255) DEFAULT NULL,
  `epic_end_date` varchar(255) DEFAULT NULL,
  `epic_status` varchar(255) DEFAULT NULL,
  `epic_detail` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stream_id` varchar(255) DEFAULT NULL,
  `assign_status` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `jira_project` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `quarter` varchar(255) DEFAULT NULL,
  `team_id` int(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL DEFAULT '0',
  `account_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backlog_unit`
--

CREATE TABLE `backlog_unit` (
  `id` int(11) NOT NULL,
  `epic_title` varchar(255) DEFAULT NULL,
  `epic_start_date` varchar(255) DEFAULT NULL,
  `epic_end_date` varchar(255) DEFAULT NULL,
  `epic_status` varchar(255) DEFAULT NULL,
  `epic_detail` text,
  `unit_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assign_status` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `quarter` varchar(255) DEFAULT NULL,
  `jira_project` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT '0',
  `account_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backlog_unit`
--

INSERT INTO `backlog_unit` (`id`, `epic_title`, `epic_start_date`, `epic_end_date`, `epic_status`, `epic_detail`, `unit_id`, `created_at`, `assign_status`, `progress`, `jira_id`, `quarter`, `jira_project`, `user_id`, `team_id`, `position`, `account_id`) VALUES
(1, 'Hadilton', NULL, NULL, 'To Do', 'adfdasfds', '48', '2023-12-04 05:34:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(2, 'adfsdf', '2023-12-04', '2024-06-04', 'In progress', 'dafsdf', '48', '2023-12-04 05:51:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(3, 'asdfsdfsd', '2023-12-14', '2023-12-25', 'To Do', 'asfsdf', '48', '2023-12-04 05:51:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(4, 'adfdsf', '2023-12-21', '2024-01-03', 'To Do', NULL, '48', '2023-12-04 05:51:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(5, 'test Epic', '[\"2023-12-05\"]', '[\"2023-12-26\"]', 'To Do', 'asdfdfasdf', '51', '2023-12-04 20:00:09', '1', NULL, NULL, 'Q3 2023', NULL, NULL, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_units`
--

CREATE TABLE `business_units` (
  `id` int(11) NOT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `detail` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'unit',
  `user_id` varchar(255) DEFAULT NULL,
  `trash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_units`
--

INSERT INTO `business_units` (`id`, `org_id`, `business_name`, `lead_id`, `detail`, `created_at`, `slug`, `type`, `user_id`, `trash`) VALUES
(46, NULL, 'Retail customers in asia', '59', 'lorem ipsum dummy text for printing agencies', '2023-11-30 09:41:51', 'retail-customers-in-asia-80', 'unit', '126', NULL),
(47, NULL, 'Retail', '63', NULL, '2023-11-30 13:44:52', 'retail-48', 'unit', '129', NULL),
(48, NULL, 'Digital Transformation Solutions', '72', NULL, '2023-12-01 06:09:05', 'digital-transformation-solutions-13', 'unit', '140', NULL),
(49, NULL, 'Cybersecurity Solutions', '73', NULL, '2023-12-01 06:12:00', 'cybersecurity-solutions-96', 'unit', '140', NULL),
(51, NULL, 'Product Development V1', '77', 'Lorem ipsum dummy text', '2023-12-04 18:47:22', 'product-development-v1-25', 'unit', '153', NULL),
(52, NULL, 'Sales and Marketing', '78', 'lorem ipsum dummy text', '2023-12-04 18:48:30', 'sales-and-marketing-13', 'unit', '153', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_data`
--

CREATE TABLE `chart_data` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `target_value` varchar(255) DEFAULT NULL,
  `target_month` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `kpi_setting_id` varchar(255) DEFAULT NULL,
  `back_log` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `epics`
--

CREATE TABLE `epics` (
  `id` int(11) NOT NULL,
  `month_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `epic_status` varchar(255) DEFAULT NULL,
  `epic_name` varchar(255) DEFAULT NULL,
  `epic_detail` text,
  `epic_start_date` varchar(255) DEFAULT NULL,
  `epic_end_date` varchar(255) DEFAULT NULL,
  `epic_progress` varchar(255) DEFAULT '0',
  `user_id` varchar(255) DEFAULT NULL,
  `initiative_id` varchar(255) DEFAULT NULL,
  `quarter_id` varchar(255) DEFAULT NULL,
  `backlog_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `flag_type` varchar(255) DEFAULT 'null',
  `flag_assign` varchar(255) DEFAULT NULL,
  `flag_title` varchar(255) DEFAULT NULL,
  `flag_description` text,
  `flag_status` varchar(255) DEFAULT NULL,
  `flag_order` int(11) DEFAULT NULL,
  `trash` varchar(255) DEFAULT NULL,
  `obj_id` varchar(255) DEFAULT NULL,
  `buisness_unit_id` varchar(255) DEFAULT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `key_id` varchar(255) DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `jira_project` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `epic_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `epics`
--

INSERT INTO `epics` (`id`, `month_id`, `created_at`, `updated_at`, `epic_status`, `epic_name`, `epic_detail`, `epic_start_date`, `epic_end_date`, `epic_progress`, `user_id`, `initiative_id`, `quarter_id`, `backlog_id`, `type`, `flag_type`, `flag_assign`, `flag_title`, `flag_description`, `flag_status`, `flag_order`, `trash`, `obj_id`, `buisness_unit_id`, `team_id`, `key_id`, `jira_id`, `jira_project`, `account_id`, `epic_type`) VALUES
(454, '2559', '2023-11-30 07:20:34', NULL, 'In progress', 'sadsadsadsad', 'asdsad', '2023-10-25', '2023-10-31', '0', '126', '302', '957', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '155', '44', '8', '173', NULL, NULL, NULL, 'unit'),
(455, '2596', '2023-11-30 07:20:44', NULL, 'In progress', 'asdasdsad', 'asdsad', '2023-11-01', '2023-11-30', '0', '126', '304', '970', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '157', '32', '26', '177', NULL, NULL, NULL, 'stream'),
(456, '2560', '2023-11-30 07:51:35', NULL, 'In progress', 'Test Epic', 'asdsadsadsad', '2023-11-01', '2023-11-30', '0', '126', '302', '957', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '155', '44', '9', '173', NULL, NULL, NULL, 'unit'),
(457, '2608', '2023-11-30 09:47:23', '2023-11-30 10:25:55', 'To Do', 'Remote Work Policy Revision', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book It has survived not only five centuries but also the leap into electronic typesetting remaining essentially unchanged It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2023-12-01', '2023-12-31', '0', '126', '306', '974', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '159', NULL, '10', '181', NULL, NULL, NULL, 'unit'),
(458, '2607', '2023-11-30 10:28:48', '2023-11-30 10:29:17', 'To Do', 'Epic title', NULL, '2023-11-01', '2023-11-30', '100', '126', '306', '974', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, '2023-11-30 11:44:17', '159', NULL, '10', '181', NULL, NULL, NULL, 'unit'),
(459, '2607', '2023-11-30 11:44:53', NULL, 'To Do', 'This is the Test Epic', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', '2023-11-01', '2023-11-30', '0', '126', '306', '974', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '159', '46', '10', '181', NULL, NULL, NULL, 'unit'),
(460, '2631', '2023-12-01 05:44:34', NULL, 'In progress', 'adsfdasfds', 'adf', '2023-12-01', '2023-12-31', '0', '126', '308', '982', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '160', '10', NULL, '182', NULL, NULL, NULL, 'BU'),
(461, '2643', '2023-12-01 06:33:01', NULL, 'In progress', 'Implement a new customer relationship management (CRM) system', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-12-01', '2023-12-31', '0', '140', '309', '986', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '163', '48', NULL, '183', NULL, NULL, NULL, 'unit'),
(462, '2641', '2023-12-01 06:35:17', NULL, 'In progress', 'Launch a customer feedback program.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-01', '2023-11-30', '0', '140', '309', '986', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '163', '48', NULL, '183', NULL, NULL, NULL, 'unit'),
(463, '2643', '2023-12-01 06:37:22', NULL, 'To Do', 'Implement advanced threat intelligence tools.', 'lorem ipsum dummy text for printing and agencies', '2023-12-01', '2023-12-31', '0', '140', '309', '986', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '163', '48', NULL, '183', NULL, NULL, NULL, 'unit'),
(464, '2656', '2023-12-01 07:02:10', NULL, 'In progress', 'Launch the platform with a user adoption rate of 80%', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-10-01', '2023-10-31', '0', '140', '310', '991', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '163', NULL, NULL, '184', NULL, NULL, NULL, 'unit'),
(465, '2658', '2023-12-01 07:02:52', '2023-12-04 04:49:16', 'In progress', 'Improve decision-making efficiency by 25%.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-12-01', '2023-12-31', '0', '140', '310', '991', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '163', '48', NULL, '184', NULL, NULL, NULL, 'unit'),
(466, '2680', '2023-12-01 07:04:21', '2023-12-01 07:04:38', 'Done', 'Achieve 100% compliance with data protection regulations.', 'Achieve 100 compliance with data protection regulations', '2023-11-01', '2023-11-30', '100', '140', '311', '999', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '164', NULL, NULL, '185', NULL, NULL, NULL, 'unit'),
(467, '2607', '2023-12-01 07:08:44', NULL, 'In progress', 'epic New', '132132', '2023-11-01', '2023-11-30', '0', '126', '306', '974', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '159', '46', '10', '181', NULL, NULL, NULL, 'unit'),
(468, '2692', '2023-12-04 19:09:48', '2023-12-04 19:11:45', 'Done', 'Market Research', 'Conduct indepth market research to identify key trends and customer needs', '2023-12-01', '2023-12-31', '100', '153', '317', '1003', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', NULL, NULL, '190', NULL, NULL, NULL, 'unit'),
(469, '2692', '2023-12-04 19:13:35', '2023-12-04 19:13:57', 'Done', 'Content Creation', 'Develop compelling content including blog posts whitepapers and videos to engage the target audience', '2023-11-01', '2023-11-30', '100', '153', '317', '1003', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', NULL, NULL, '190', NULL, NULL, NULL, 'unit'),
(470, '2708', '2023-12-04 19:15:51', '2023-12-04 19:16:06', 'To Do', 'Chatbot Integration', 'Integrate a chatbot for quick issue resolution and common query handling', '2023-12-01', '2023-12-31', '100', '153', '318', '1009', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', NULL, NULL, '190', NULL, NULL, NULL, 'unit'),
(471, '2717', '2023-12-04 19:19:45', '2023-12-04 19:19:56', 'Done', 'Training Program', 'Provide ongoing training to support agents for effective issue resolution and customer communication', '2023-12-01', '2023-12-31', '100', '153', '319', '1012', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', NULL, NULL, '189', NULL, NULL, NULL, 'unit'),
(472, '2717', '2023-12-04 20:00:29', NULL, 'To Do', 'test Epic', 'asdfdfasdf', '2023-12-05', '2023-12-26', '0', '153', '319', '1012', '5', 'unit', 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '189', NULL, NULL, NULL, NULL),
(473, '2716', '2023-12-04 20:07:25', NULL, 'To Do', 'Decrease average response time for customer inquiries by 15%.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-11-01', '2023-11-30', '0', '153', '319', '1012', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '189', NULL, NULL, NULL, 'unit'),
(474, '2715', '2023-12-04 20:07:45', NULL, 'To Do', 'Achieve a customer satisfaction rating of 4.8 out of 5.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-10-01', '2023-10-31', '0', '153', '319', '1012', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '189', NULL, NULL, NULL, 'unit'),
(475, '2691', '2023-12-04 20:08:13', NULL, 'To Do', 'Achieve a customer satisfaction rating of 4.8 out of 5.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-11-01', '2023-11-30', '0', '153', '317', '1003', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '190', NULL, NULL, NULL, 'unit'),
(476, '2690', '2023-12-04 20:08:36', NULL, 'To Do', 'Achieve a customer satisfaction rating of 4.8 out of 5.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-10-01', '2023-10-31', '0', '153', '317', '1003', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '190', NULL, NULL, NULL, 'unit'),
(477, '2707', '2023-12-04 20:09:06', NULL, 'To Do', 'Achieve a 15% increase in new customer acquisitions.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-11-01', '2023-11-30', '0', '153', '318', '1009', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '190', NULL, NULL, NULL, 'unit'),
(478, '2706', '2023-12-04 20:09:30', NULL, 'To Do', 'Improve customer retention rate by 10% through targeted marketing campaigns.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-10-01', '2023-10-31', '0', '153', '318', '1009', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '168', '51', NULL, '190', NULL, NULL, NULL, 'unit'),
(479, '2733', '2023-12-04 20:12:56', '2023-12-04 20:12:56', 'Done', 'Implement Agile Transformation', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-12-01', '2023-12-31', '100', '153', '320', '1018', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '169', '51', NULL, '191', NULL, NULL, NULL, 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `epics_stroy`
--

CREATE TABLE `epics_stroy` (
  `id` int(11) NOT NULL,
  `epic_id` varchar(255) DEFAULT NULL,
  `epic_story_name` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `story_assign` varchar(255) DEFAULT NULL,
  `story_type` varchar(255) DEFAULT NULL,
  `story_status` varchar(255) DEFAULT NULL,
  `StoryID` varchar(255) DEFAULT NULL,
  `VS_BU_ID` varchar(255) DEFAULT NULL,
  `R_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `epics_stroy`
--

INSERT INTO `epics_stroy` (`id`, `epic_id`, `epic_story_name`, `progress`, `created_at`, `updated_at`, `user_id`, `story_assign`, `story_type`, `story_status`, `StoryID`, `VS_BU_ID`, `R_id`) VALUES
(205, NULL, 'asdsad', '0', '2023-11-25 07:14:50', NULL, '118', '55', NULL, 'In progress', 'ssp-687', '41', '803'),
(206, '447', 'asdasdasd', '0', '2023-11-30 05:28:17', NULL, '126', '59', NULL, 'In progress', 'ssp-543', '44', '713'),
(207, '456', NULL, '0', '2023-11-30 07:51:30', NULL, '126', '59', NULL, 'To Do', 'ssp-842', '44', '825'),
(208, NULL, 'Story 1', '0', '2023-11-30 09:45:00', NULL, '126', '59', NULL, 'To Do', 'ssp-989', '46', '245'),
(209, NULL, 'Story 2', '0', '2023-11-30 09:45:12', NULL, '126', '61', NULL, 'To Do', 'ssp-575', '46', '245'),
(210, '457', 'Story 1', '100', '2023-11-30 10:25:36', NULL, '126', '59', NULL, 'To Do', 'ssp-120', NULL, NULL),
(211, '457', 'Story 2', '100', '2023-11-30 10:25:44', NULL, '126', '60', NULL, 'To Do', 'ssp-964', NULL, NULL),
(213, '461', 'Story 1', '0', '2023-12-01 06:32:41', NULL, '140', '72', NULL, 'To Do', 'ssp-227', '48', '203'),
(214, '461', 'Story 2', '100', '2023-12-01 06:32:51', NULL, '140', '73', NULL, 'Done', 'ssp-527', '48', '203'),
(215, '462', 'Story 1', '0', '2023-12-01 06:34:59', NULL, '140', '72', NULL, 'To Do', 'ssp-973', '48', '770'),
(216, '462', 'Story 2', '0', '2023-12-01 06:35:15', NULL, '140', '72', NULL, 'In progress', 'ssp-534', '48', '770'),
(217, '466', 'Story 1', '100', '2023-12-01 07:02:09', NULL, '140', '72', NULL, 'To Do', 'ssp-804', '48', '845'),
(218, '465', 'sdfsdf', '0', '2023-12-04 04:49:16', NULL, '140', '74', NULL, 'In progress', 'ssp-139', NULL, NULL),
(219, '468', 'Story 1', '100', '2023-12-04 19:06:36', NULL, '153', '77', NULL, 'To Do', 'ssp-229', '51', '486');

-- --------------------------------------------------------

--
-- Table structure for table `epic_comment`
--

CREATE TABLE `epic_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epic_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `r_id` text COLLATE utf8mb4_unicode_ci,
  `is_publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epic_comment`
--

INSERT INTO `epic_comment` (`id`, `epic_id`, `user_id`, `comment`, `r_id`, `is_publish`, `created_at`, `updated_at`) VALUES
(5, '447', '126', 'asdasdasdasdsad', '713', 0, NULL, NULL),
(6, NULL, '126', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '245', 0, NULL, NULL),
(8, '457', '126', 'adfasdfd', NULL, 0, NULL, NULL),
(9, '46', '126', 'fadffdfad', NULL, 0, NULL, NULL),
(10, '457', '126', 'asfsdf', NULL, 0, NULL, NULL),
(11, '458', '126', 'asdfasdf', '836', 0, NULL, NULL),
(12, '461', '140', 'Comments goes here', '203', 0, NULL, NULL),
(13, '462', '140', 'asfdsfd', '770', 0, NULL, NULL),
(14, '465', '140', 'sdfsdfsd', NULL, 0, NULL, NULL),
(15, '468', '153', 'comment goes here', '486', 0, NULL, NULL),
(16, '468', '153', 'adfdf', '486', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `epic_comment_reply`
--

CREATE TABLE `epic_comment_reply` (
  `id` int(11) NOT NULL,
  `comment_id` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `epic_comment_reply`
--

INSERT INTO `epic_comment_reply` (`id`, `comment_id`, `reply`, `user_id`, `created_at`) VALUES
(14, '15', 'asdfsdfsd', '153', '2023-12-04 19:07:07'),
(15, '15', 'adfadfsd', '153', '2023-12-04 19:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `escalate_cards`
--

CREATE TABLE `escalate_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `escalate_cards`
--

INSERT INTO `escalate_cards` (`id`, `flag_id`, `from`, `to`, `from_id`, `to_id`, `created_at`, `updated_at`) VALUES
(20, 63, 'value_stream', 'business_units', '32', '44', '2023-11-30 02:21:47', '2023-11-30 02:21:47'),
(21, 74, 'unit_team', 'business_units', '10', '46', '2023-12-01 12:45:03', '2023-12-01 12:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epic_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_units` int(11) DEFAULT NULL,
  `flag_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_assign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_title` longtext COLLATE utf8mb4_unicode_ci,
  `flag_description` longtext COLLATE utf8mb4_unicode_ci,
  `flag_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archived` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escalate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `epic_id`, `business_units`, `flag_type`, `flag_assign`, `flag_title`, `flag_description`, `flag_status`, `flag_order`, `archived`, `board_type`, `escalate`, `created_at`, `updated_at`) VALUES
(63, '455', 32, 'Risk', '60', 'asdsadasdsa', 'dsadasdasdsadasd', 'todoflag', NULL, '2', 'stream', NULL, '2023-11-30 02:20:57', '2023-11-30 14:57:44'),
(64, '455', 44, 'Risk', '60', 'asdsadasdsa', 'dsadasdasdsadasd', 'doneflag', NULL, '2', 'unit', '20', '2023-11-30 02:21:47', '2023-11-30 14:57:44'),
(65, '456', 44, 'Impediment', '59', 'Please Change the tittle of Homepage', 'sadsadasdsad', 'inprogress', NULL, '2', 'unit', NULL, '2023-11-30 14:51:45', '2023-11-30 14:51:45'),
(66, '457', NULL, 'Risk', '60', 'adfds', 'adsf', 'todoflag', NULL, '2', 'unit', NULL, '2023-11-30 17:43:11', '2023-11-30 17:43:11'),
(67, '458', NULL, 'Impediment', '60', 'Please Change the tittle of Homepage', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'todoflag', NULL, '2', 'unit', NULL, '2023-11-30 18:43:23', '2023-11-30 18:43:23'),
(68, '459', 46, 'Impediment', '59', 'Please', '<ol><li><b>asdsadsadasda</b></li><li><b>sad</b></li><li><b>sad</b></li><li><b>sad</b></li><li><b>sad</b></li><li><b>sad<u>sadasdasdasd</u></b></li><li><b>as</b></li><li><b>dsa</b></li><li><b>das</b></li><li><b>d</b></li><li><b>as</b></li><li><b>dsa</b></li><li><b>d</b></li><li><b>sa</b></li><li><b>das</b></li><li><b>d</b></li><li><b>sa</b></li><li><b>d</b></li><li><b>asd</b></li><li><b>as</b></li><li><b>d</b></li><li><b>sa</b></li><li><b>d</b></li><li><b>sad</b></li><li><b>as</b></li><li><b>d</b></li><li><b>sa</b></li><li><b>d</b></li><li><b>sa</b></li><li><b>dsa</b></li><li><b>d</b></li><li><b>sa</b></li></ol>', 'todoflag', NULL, '2', 'unit', NULL, '2023-11-30 18:45:10', '2023-11-30 19:24:47'),
(69, '459', 46, 'Impediment', '61', 'Please Change the tittle of Homepage', '<p>4546546</p>', 'doneflag', NULL, '2', 'unit', NULL, '2023-11-30 19:22:50', '2023-11-30 19:24:59'),
(70, '459', 46, 'Risk', '59', 'Please Change the tittle of Homepage', NULL, 'doneflag', NULL, '2', 'unit', NULL, '2023-11-30 19:23:03', '2023-12-01 12:50:11'),
(71, '459', 46, 'Impediment', '59', 'Impediment 001', 'Impediment 001 Description', 'todoflag', NULL, '2', 'unit', NULL, '2023-11-30 23:40:27', '2023-11-30 23:40:27'),
(72, '459', 46, 'Impediment', '59', 'Facing server bandwidth issue', 'Facing server bandwidth issue', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-01 12:41:35', '2023-12-01 12:41:35'),
(73, '459', 46, 'Risk', '59', 'asdfdsf', 'asdfdsf', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-01 12:42:10', '2023-12-01 12:42:10'),
(74, '460', 10, 'Impediment', '61', 'Flag title goes here', 'sdfdfd', 'doneflag', NULL, '2', 'BU', NULL, '2023-12-01 12:44:49', '2023-12-01 12:44:49'),
(75, '460', 46, 'Impediment', '61', 'Flag title goes here', 'sdfdfd', 'doneflag', NULL, '2', 'unit', '21', '2023-12-01 12:45:03', '2023-12-01 12:45:03'),
(76, '459', 46, 'Impediment', '60', 'Please Change the tittle of About Us Page', 'sdfsdfsdf', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-01 12:58:32', '2023-12-01 12:58:32'),
(77, '461', 48, 'Risk', '72', 'United Progress Alliance Flag', 'The flag features a dynamic, interlocking network of gears, symbolizing unity and progress. The gears are in various colors, representing the diversity of talents and ideas contributing to the alliance\'s advancement.', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-01 13:42:09', '2023-12-01 13:42:09'),
(78, '467', 46, 'Impediment', '60', 'Please Change the tittle of Homepage', 'zcxzczxc', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-01 14:08:55', '2023-12-01 14:08:55'),
(79, '470', NULL, 'Impediment', '78', 'Knowledge Base Enhancement', 'Expand and improve the self-service knowledge base with comprehensive articles and tutorials.', 'todoflag', NULL, '2', 'unit', NULL, '2023-12-05 02:24:00', '2023-12-05 02:24:00'),
(80, NULL, 51, NULL, '77', 'Flag Title Goes here', '<div style=\"margin: 0px 14.4px 0px 28.8px; padding: 0px; width: 436.8px; float: left; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.8px 0px 14.4px; padding: 0px; width: 436.8px; float: right; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"></div>', 'doneflag', NULL, '2', 'unit', NULL, '2023-12-05 02:29:18', '2023-12-05 02:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `flag_comments`
--

CREATE TABLE `flag_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flag_comments`
--

INSERT INTO `flag_comments` (`id`, `flag_id`, `user_id`, `comment`, `type`, `comment_id`, `created_at`, `updated_at`) VALUES
(1, 65, '126', 'asdasdasdasd', 'comment', NULL, '2023-11-30 14:52:02', '2023-11-30 14:52:02'),
(2, 65, '126', 'asdasdasdasd', 'comment', NULL, '2023-11-30 14:52:12', '2023-11-30 14:52:12'),
(3, 64, '126', 'sadasdasd', 'comment', NULL, '2023-11-30 14:52:29', '2023-11-30 14:52:29'),
(4, 64, '126', 'sadasdasdsadasdsadsa', 'comment', NULL, '2023-11-30 14:57:21', '2023-11-30 14:57:32'),
(5, 64, '126', 'asdasdsad', 'comment', NULL, '2023-11-30 14:57:36', '2023-11-30 14:57:36'),
(6, 64, '126', 'asdasdasd', 'comment', NULL, '2023-11-30 14:57:39', '2023-11-30 14:57:39'),
(7, 68, '126', 'sadsadasdasd', 'comment', NULL, '2023-11-30 19:23:19', '2023-11-30 19:23:19'),
(8, 68, '126', 'Delve into the challenges posed by recurring technical glitches and explore strategies to overcome these hurdles in a rapidly evolving digital landscape.', 'comment', NULL, '2023-11-30 19:23:23', '2023-11-30 19:23:23'),
(9, 70, '126', 'Comment here', 'comment', NULL, '2023-12-01 12:50:02', '2023-12-01 12:50:02'),
(10, 70, '126', 'sfdfadfds', 'comment', NULL, '2023-12-01 12:50:22', '2023-12-01 12:50:22'),
(11, 70, '126', 'asfdfds', 'reply', '10', '2023-12-01 12:50:37', '2023-12-01 12:50:37'),
(12, 78, '126', 'sadsadasdasd', 'comment', NULL, '2023-12-01 14:10:02', '2023-12-01 14:10:02'),
(13, 78, '126', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'comment', NULL, '2023-12-01 14:10:07', '2023-12-01 14:10:07'),
(14, 78, '126', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'reply', '13', '2023-12-02 20:32:19', '2023-12-02 20:32:19'),
(16, 80, '153', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'comment', NULL, '2023-12-05 02:48:33', '2023-12-05 02:48:33');

-- --------------------------------------------------------

--
-- Table structure for table `initiative`
--

CREATE TABLE `initiative` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `key_id` varchar(255) DEFAULT NULL,
  `obj_id` varchar(255) DEFAULT NULL,
  `initiative_name` varchar(255) DEFAULT NULL,
  `initiative_start_date` varchar(255) DEFAULT NULL,
  `initiative_end_date` varchar(255) DEFAULT NULL,
  `initiative_detail` text,
  `initiative_status` varchar(255) NOT NULL DEFAULT 'To Do',
  `updated_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trash` varchar(255) DEFAULT NULL,
  `initiative_prog` varchar(255) NOT NULL DEFAULT '0',
  `initiative_weight` varchar(255) DEFAULT NULL,
  `q_initiative_prog` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `initiative`
--

INSERT INTO `initiative` (`id`, `user_id`, `key_id`, `obj_id`, `initiative_name`, `initiative_start_date`, `initiative_end_date`, `initiative_detail`, `initiative_status`, `updated_at`, `created_at`, `trash`, `initiative_prog`, `initiative_weight`, `q_initiative_prog`) VALUES
(302, '126', '173', '155', 'Frontend Initiative', '2023-11-27', '2025-01-01', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'In progress', NULL, '2023-11-27 12:38:04', NULL, '0', NULL, '0'),
(303, '126', '175', '155', 'asdsadsad', '2023-11-30', '2023-11-30', 'asdsadsad', 'In progress', NULL, '2023-11-30 05:27:53', NULL, '0', NULL, '0'),
(304, '126', '177', '157', 'redsadsad', '2023-11-30', '2023-11-30', 'asdasdsad', 'In progress', NULL, '2023-11-30 05:52:37', NULL, '0', NULL, '0'),
(306, '126', '181', '159', 'Virtual Team-Building Activities', '2023-11-30', '2024-11-30', NULL, 'To Do', NULL, '2023-11-30 09:43:45', NULL, '0', NULL, '0'),
(308, '126', '182', '160', 'INi', '2023-12-01', '2023-12-01', NULL, 'To Do', NULL, '2023-12-01 05:44:23', NULL, '0', NULL, '0'),
(309, '140', '183', '163', 'Initiative', '2023-12-01', '2024-03-01', 'lorem ipsum dummy text', 'To Do', NULL, '2023-12-01 06:31:44', NULL, '0', NULL, '0'),
(310, '140', '184', '163', 'Integrated Analytics Platform', '2023-12-01', '2024-11-01', 'Integrated Analytics Platform', 'To Do', NULL, '2023-12-01 07:01:38', NULL, '0', NULL, '0'),
(311, '140', '185', '164', 'Conduct regular red teaming exercises.', '2023-12-01', '2024-02-06', 'Conduct regular red teaming exercises.', 'To Do', NULL, '2023-12-01 07:04:08', NULL, '100', NULL, '100'),
(315, '129', '188', '167', 'init', '2023-12-03', '2023-12-08', NULL, 'To Do', NULL, '2023-12-04 10:39:48', NULL, '0', NULL, NULL),
(316, '129', '188', '167', 'init', '2023-12-03', '2023-12-08', NULL, 'To Do', NULL, '2023-12-04 10:39:55', NULL, '0', NULL, NULL),
(317, '153', '190', '168', 'Increase Market Share in Target Segments', '2023-12-04', '2024-07-05', NULL, 'Done', NULL, '2023-12-04 19:03:53', NULL, '50', '0', '50'),
(318, '153', '190', '168', 'Customer Satisfaction and Issue Resolution', '2023-12-05', '2023-12-20', NULL, 'Done', NULL, '2023-12-04 19:14:47', NULL, '33.333333333333', '0', '33.33'),
(319, '153', '189', '168', 'Knowledge Base Enhancement:', '2023-12-04', '2024-07-05', NULL, 'To Do', NULL, '2023-12-04 19:18:37', NULL, '25', NULL, '25'),
(320, '153', '191', '169', 'Increase the number of releases per year from 4 to 6.', '2023-12-04', '2024-07-05', NULL, 'To Do', NULL, '2023-12-04 20:12:25', NULL, '100', NULL, '100');

-- --------------------------------------------------------

--
-- Table structure for table `jira_data`
--

CREATE TABLE `jira_data` (
  `id` int(11) NOT NULL,
  `Summary` varchar(255) DEFAULT NULL,
  `Startdate` varchar(255) DEFAULT NULL,
  `Duedate` varchar(255) DEFAULT NULL,
  `InitiativeID` varchar(255) DEFAULT NULL,
  `E_Status` varchar(255) DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `detail` text,
  `progress` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `jira_project` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jira_project`
--

CREATE TABLE `jira_project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jira_setting`
--

CREATE TABLE `jira_setting` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `sync` varchar(255) DEFAULT NULL,
  `jira_url` varchar(255) DEFAULT NULL,
  `jira_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `key_chart`
--

CREATE TABLE `key_chart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quarter_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buisness_unit_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IndexCount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `key_chart`
--

INSERT INTO `key_chart` (`id`, `quarter_value`, `key_id`, `buisness_unit_id`, `IndexCount`, `created_at`, `updated_at`) VALUES
(4, NULL, '173', NULL, '1', NULL, NULL),
(5, NULL, '174', NULL, '1', NULL, NULL),
(6, '234234', '176', '44', '1', NULL, NULL),
(7, '123213', '177', '32', '1', NULL, NULL),
(8, '0000', '178', '44', '1', NULL, NULL),
(9, '0000', '179', '44', '1', NULL, NULL),
(10, '0000', '179', '44', '2', NULL, NULL),
(11, '110', '180', '45', '1', NULL, NULL),
(12, '120', '180', '45', '2', NULL, NULL),
(13, '130', '180', '45', '3', NULL, NULL),
(14, '140', '180', '45', '4', NULL, NULL),
(15, '110', '181', '46', '1', NULL, NULL),
(16, '120', '181', '46', '2', NULL, NULL),
(17, '130', '181', '46', '3', NULL, NULL),
(18, '140', '181', '46', '4', NULL, NULL),
(19, '200', '182', '10', '1', NULL, NULL),
(20, '110', '183', '48', '1', NULL, NULL),
(21, '120', '183', '48', '2', NULL, NULL),
(22, '130', '183', '48', '3', NULL, NULL),
(23, '140', '183', '48', '4', NULL, NULL),
(24, '20', '184', '48', '1', NULL, NULL),
(25, '30', '184', '48', '2', NULL, NULL),
(26, '40', '184', '48', '3', NULL, NULL),
(27, '50', '184', '48', '4', NULL, NULL),
(28, NULL, '185', '48', '1', NULL, NULL),
(29, NULL, '186', '11', '1', NULL, NULL),
(30, NULL, '187', '48', '1', NULL, NULL),
(31, '22', '188', '47', '1', NULL, NULL),
(32, '34', '188', '47', '2', NULL, NULL),
(33, '46', '188', '47', '3', NULL, NULL),
(34, '56', '188', '47', '4', NULL, NULL),
(35, '20', '189', '51', '1', NULL, NULL),
(36, NULL, '190', '51', '1', NULL, NULL),
(37, '25', '191', '51', '1', NULL, NULL),
(38, '50', '191', '51', '2', NULL, NULL),
(39, '75', '191', '51', '3', NULL, NULL),
(40, '100', '191', '51', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `key_quarter_value`
--

CREATE TABLE `key_quarter_value` (
  `id` int(11) NOT NULL,
  `key_chart_id` varchar(255) DEFAULT NULL,
  `key_id` varchar(255) DEFAULT NULL,
  `sprint_id` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `key_quarter_value`
--

INSERT INTO `key_quarter_value` (`id`, `key_chart_id`, `key_id`, `sprint_id`, `value`, `created_at`) VALUES
(50, '10', '179', '70', '00001', '2023-11-30 06:31:29'),
(51, '20', '183', '71', '105', '2023-12-01 06:44:58'),
(53, '20', '183', '71', '110', '2023-12-01 06:47:22'),
(54, '24', '184', '71', '12', '2023-12-01 06:50:26'),
(55, '24', '184', '71', '15', '2023-12-01 06:50:32'),
(56, '37', '191', '74', '10', '2023-12-04 20:13:17'),
(57, '37', '191', '74', '25', '2023-12-04 20:13:21');

-- --------------------------------------------------------

--
-- Table structure for table `key_result`
--

CREATE TABLE `key_result` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `obj_id` varchar(255) DEFAULT NULL,
  `key_name` varchar(255) DEFAULT NULL,
  `key_start_date` varchar(255) DEFAULT NULL,
  `key_end_date` varchar(255) DEFAULT NULL,
  `key_detail` text,
  `key_status` varchar(255) NOT NULL DEFAULT 'To Do',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `trash` varchar(255) DEFAULT NULL,
  `key_prog` varchar(255) NOT NULL DEFAULT '0',
  `weight` varchar(255) DEFAULT '0',
  `q_key_prog` varchar(255) DEFAULT NULL,
  `unit_id` varchar(255) DEFAULT NULL,
  `target_value` varchar(255) DEFAULT NULL,
  `key_result_type` varchar(255) DEFAULT NULL,
  `key_unit` varchar(255) DEFAULT NULL,
  `init_value` varchar(255) DEFAULT NULL,
  `target_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `key_result`
--

INSERT INTO `key_result` (`id`, `user_id`, `obj_id`, `key_name`, `key_start_date`, `key_end_date`, `key_detail`, `key_status`, `created_at`, `updated_at`, `trash`, `key_prog`, `weight`, `q_key_prog`, `unit_id`, `target_value`, `key_result_type`, `key_unit`, `init_value`, `target_number`) VALUES
(173, '126', '155', 'Frontend', '2023-11-27', '2025-01-27', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'In progress', '2023-11-27 12:37:19', NULL, NULL, '0', NULL, '0', NULL, '', NULL, NULL, NULL, NULL),
(174, '126', '155', 'Backend', '2023-11-27', '2026-01-27', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'In progress', '2023-11-27 12:37:39', NULL, NULL, '0', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(175, '126', '155', 'ertertretdsfdfret', '2023-11-30', '2023-12-01', 'sdfsdfdf', 'In progress', '2023-11-30 05:26:40', NULL, NULL, '0', NULL, '0', NULL, '234234', 'Should decrease to', 'number', '234234', '234234'),
(176, '126', '155', 'ertertretdsfdfret', '2023-11-30', '2023-12-01', 'sdfsdfdf', 'In progress', '2023-11-30 05:27:31', NULL, NULL, '0', NULL, '0', NULL, '234234', 'Should decrease to', 'number', '234234', '234234'),
(177, '126', '157', 'Key Result', '2023-11-30', '2023-12-08', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia', 'In progress', '2023-11-30 05:52:26', NULL, NULL, '0', NULL, '0', NULL, '123213', 'Should decrease to', 'number', '213', '213123'),
(179, '126', '155', 'key', '2023-11-30', '2023-11-30', NULL, 'To Do', '2023-11-30 06:31:00', NULL, NULL, '0', '0', NULL, NULL, '0000,0000', 'Should Increase to', 'pound £', '0000', '00000'),
(181, '126', '159', 'Increase Employee Engagement in Virtual Collaboration Tools by 15%:', '2023-11-30', '2024-11-30', NULL, 'In progress', '2023-11-30 09:43:24', NULL, NULL, '0', NULL, '0', NULL, '110,120,130,140', 'Should Increase to', 'pound £', '100', '140'),
(182, '126', '160', 'Key result', '2023-12-01', '2023-12-27', 'asfdf', 'To Do', '2023-12-01 05:44:10', NULL, NULL, '0', NULL, '0', NULL, '200', 'Should Increase to', 'number', '100', '1000'),
(183, '140', '163', 'Increase Net Promoter Score (NPS) by 15%', '2023-12-01', '2024-11-01', 'lorem ipsum dummy text', 'To Do', '2023-12-01 06:31:17', NULL, NULL, '0', '0', '0', NULL, '110,120,130,140', 'Should Increase to', 'Euro €', '100', '140'),
(184, '140', '163', 'New Key result', '2023-12-01', '2024-11-01', 'asdf', 'To Do', '2023-12-01 06:49:39', NULL, NULL, '0', '0', '0', NULL, '20,30,40,50', 'Should Increase to', 'Euro €', '10', '50'),
(185, '140', '164', 'Threat Detection and Response:', '2023-12-01', NULL, NULL, 'To Do', '2023-12-01 07:03:34', NULL, NULL, '100', '0', '100', NULL, '', 'Should decrease to', 'pound £', '100', '100'),
(186, '140', '165', 'asdf', '2023-12-01', '2024-06-01', 'fsdadsf', 'To Do', '2023-12-01 11:38:13', NULL, NULL, '0', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(187, '140', '163', 'new key result', '2023-12-04', '2024-11-01', 'adfdasfds', 'In progress', '2023-12-04 04:45:24', NULL, NULL, '0', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(188, '129', '167', 'key 1', '2023-11-04', '2023-12-08', NULL, 'To Do', '2023-12-04 10:34:58', NULL, NULL, '0', NULL, NULL, NULL, '22,34,46,56', 'Should Increase to', 'number', '12', '222'),
(189, '153', '168', 'Improve Time-to-Market for Products', '2023-12-04', '2024-11-04', 'Small des', 'To Do', '2023-12-04 18:56:25', NULL, NULL, '0', '0', '0', NULL, '', 'Should Increase to', 'number', '10', '50'),
(190, '153', '168', 'Implement Agile Transformation', '2023-12-05', '2024-07-05', 'small description', 'To Do', '2023-12-04 19:01:13', NULL, NULL, '0', '0', '0', NULL, '', NULL, NULL, NULL, NULL),
(191, '153', '169', 'Reduce average feature development time by 20%.', '2023-12-04', '2024-07-05', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'To Do', '2023-12-04 20:12:00', NULL, NULL, '100', '0', '100', NULL, '25,50,75,100', 'Should Increase to', 'pound £', '10', '100');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_setting`
--

CREATE TABLE `kpi_setting` (
  `id` int(11) NOT NULL,
  `t_value` varchar(255) DEFAULT NULL,
  `t_date` varchar(255) DEFAULT NULL,
  `chart_type` varchar(255) DEFAULT NULL,
  `trend_line` varchar(255) DEFAULT NULL,
  `green` varchar(255) DEFAULT NULL,
  `red` varchar(255) DEFAULT NULL,
  `amber` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `target_option` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `csv` varchar(255) DEFAULT NULL,
  `target_opt` varchar(255) DEFAULT NULL,
  `g_display` varchar(255) DEFAULT NULL,
  `t_display` varchar(255) DEFAULT NULL,
  `chart_title` varchar(255) DEFAULT NULL,
  `chart_subtitle` varchar(255) DEFAULT NULL,
  `stream_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `c_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `org_user` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `phone`, `image`, `user_id`, `org_id`, `updated_at`, `created_at`, `email`, `org_user`, `role`, `status`, `last_name`) VALUES
(59, 'Ashtyn', '240-766-7172', '79233597.jpg', '127', NULL, '2023-12-01 14:09:29', '2023-11-27 07:32:35', 'fakedata54934@gmail.com', '126', NULL, '1', 'Cormier'),
(60, 'Clemens', '694-967-6653', '1355712889.jpg', '128', NULL, '2023-12-01 14:09:36', '2023-11-27 07:33:01', 'fakedata67612@gmail.com', '126', NULL, '1', 'Goodwin'),
(61, 'Dan', '644-847-4883', '1216127319.jpg', '129', NULL, '2023-12-01 14:09:42', '2023-11-27 07:33:36', 'fakedata77771@gmail.com', '126', NULL, '1', 'Crona'),
(62, 'Hallie', '555-301-0205', '337038.jpg', '130', NULL, '2023-11-27 07:33:57', '2023-11-27 07:33:57', 'fakedata85203@gmail.com', '126', NULL, '1', 'Kreiger'),
(63, 'shahzad', '03003030', NULL, '131', NULL, '2023-11-30 16:20:43', '2023-11-30 16:20:43', 'cakeson332@frandin.com', '129', NULL, '1', 'iqbal'),
(64, 'karamat', 'adsf', NULL, '132', NULL, '2023-11-30 16:27:07', '2023-11-30 16:27:07', 'cakeson332@frandin.coadf', '129', NULL, '1', 'ali'),
(65, 'New Member', '+012 (345) 6789', NULL, '133', NULL, '2023-11-30 17:02:42', '2023-11-30 17:02:42', 'foffappomeulau-3340@yopmail.com', '129', NULL, '1', 'Member'),
(66, 'New Member', '+012 (345) 6789', NULL, '134', NULL, '2023-11-30 17:05:13', '2023-11-30 17:05:13', 'foffappomeulau-3340@yopmail.com', '129', NULL, '1', 'Member'),
(67, 'New Member', '+012 (345) 6789', NULL, '135', NULL, '2023-11-30 17:08:33', '2023-11-30 17:08:33', 'foffappomeulau-3340@yopmail.com', '129', NULL, '1', 'Member'),
(73, 'Amir', '0340111475', '544134143.jpg', '143', NULL, '2023-12-01 13:05:23', '2023-12-01 13:05:23', 'amirmuneer@gmail.com', '140', NULL, '1', 'muneer'),
(74, 'Awais', '0340014144', '2009319303.jpg', '145', NULL, '2023-12-01 13:06:14', '2023-12-01 13:06:14', 'awaisali@gmail.com', '140', NULL, '1', 'Ali'),
(75, 'shahzad', '030140114741', '1418567127.jpg', '151', NULL, '2023-12-04 11:47:29', '2023-12-04 11:47:29', 'katel17348@bustayes.com', '140', NULL, '1', 'iqbal'),
(77, 'Amir', '03407712693', '917372632.jpg', '154', NULL, '2023-12-05 01:27:44', '2023-12-05 01:13:46', 'amirmuneer11@gmail.com', '153', NULL, '1', 'muneer'),
(78, 'karamat', '0340771258', '1115933456.jpg', '155', NULL, '2023-12-05 01:27:24', '2023-12-05 01:27:24', 'karamatali1@gmail.com', '153', NULL, '1', 'Ali'),
(79, 'Awais', '12312312312', '2132948864.jpg', '156', NULL, '2023-12-05 01:28:23', '2023-12-05 01:28:23', 'awaisali2@gmail.com', '153', NULL, '1', 'Ali');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_17_060748_create_organization_table', 2),
(6, '2023_11_22_052349_create_flag_comments_table', 3),
(7, '2023_11_22_102526_create_flags_table', 4),
(12, '2023_11_23_125017_add_story_asign_story_type_story_status_to_epics_store', 5),
(15, '2023_11_24_062243_add_key_result_type_in_key_result', 6),
(16, '2023_11_24_092347_add_value_stream_id_in_epic', 7),
(17, '2023_11_24_054713_create_epic_comment_table', 8),
(18, '2023_11_25_084934_key_chart', 8),
(19, '2023_11_25_110730_create_escalate_cards_table', 9),
(20, '2023_11_28_114322_create_activities_table', 10),
(21, '2023_12_04_133025_create_attachments_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE `objectives` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `objective_name` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `detail` text,
  `status` varchar(255) NOT NULL DEFAULT 'To Do',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `trash` varchar(255) DEFAULT NULL,
  `obj_prog` varchar(255) DEFAULT '0',
  `q_obj_prog` varchar(255) DEFAULT NULL,
  `unit_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objectives`
--

INSERT INTO `objectives` (`id`, `user_id`, `org_id`, `objective_name`, `start_date`, `end_date`, `detail`, `status`, `created_at`, `updated_at`, `trash`, `obj_prog`, `q_obj_prog`, `unit_id`, `type`) VALUES
(156, '126', '44', '213132', '2023-12-01', '2023-12-19', NULL, 'In progress', '2023-11-30 05:24:15', NULL, NULL, '0', NULL, '8', 'BU'),
(157, '126', NULL, 'Objective', '2023-11-30', '2024-01-01', 'sdasd', 'To Do', '2023-11-30 05:51:09', NULL, NULL, '0', '0', '32', 'stream'),
(159, '126', NULL, 'Improve Productivity and Collaboration in Remote Work Environments', '2023-11-30', '2024-12-30', NULL, 'In progress', '2023-11-30 09:42:39', NULL, NULL, '0', '0', '46', 'unit'),
(160, '126', '46', 'Objective', '2023-11-30', NULL, 'asdfasd', 'To Do', '2023-11-30 10:01:56', NULL, NULL, '0', '0', '10', 'BU'),
(162, '126', NULL, 'Objective 1', '2023-11-30', '2024-05-30', NULL, 'To Do', '2023-11-30 17:01:44', NULL, NULL, '0', NULL, '33', 'stream'),
(163, '140', NULL, 'Enhance customer experience and satisfaction', '2023-12-01', '2024-11-01', 'lorem ipsum dummy text', 'In progress', '2023-12-01 06:30:16', NULL, NULL, '0', '0', '48', 'unit'),
(164, '140', NULL, 'Objective', '2023-12-01', '2024-03-01', NULL, 'To Do', '2023-12-01 07:03:12', NULL, NULL, '100', '100', '48', 'unit'),
(165, '140', '48', 'Objective', '2023-12-01', '2024-11-01', 'asdfsdf', 'To Do', '2023-12-01 11:37:49', NULL, NULL, '0', NULL, '11', 'BU'),
(166, '140', NULL, 'asfsdf', '2023-12-04', '2023-12-13', 'asdfdsf', 'In progress', '2023-12-04 04:50:16', NULL, NULL, '0', NULL, '48', 'unit'),
(167, '129', NULL, 'Obj', '2023-11-04', '2023-12-09', NULL, 'To Do', '2023-12-04 10:34:19', NULL, NULL, '0', NULL, '47', 'unit'),
(168, '153', NULL, 'Agile Software Development', '2023-12-04', '2024-11-04', 'Something goes here', 'To Do', '2023-12-04 18:55:02', NULL, NULL, '0', '0', '51', 'unit'),
(169, '153', NULL, 'Improve Time-to-Market for Products', '2023-12-04', '2024-10-05', NULL, 'To Do', '2023-12-04 20:10:28', NULL, NULL, '100', '100', '51', 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `organization_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `organization_name`, `email`, `phone_no`, `logo`, `detail`, `created_at`, `updated_at`, `user_id`, `slug`, `trash`, `code`, `month`) VALUES
(74, 'Usama', 'usamakashif890@gmail.com', NULL, NULL, NULL, '2023-11-27 07:29:52', '2023-11-27 07:29:52', '126', 'usama-37', NULL, '#OR2241', NULL),
(75, 'shahzad', 'tetabay992@frandin.com', NULL, NULL, NULL, '2023-12-01 13:00:30', '2023-12-01 13:00:30', '140', 'shahzad-80', NULL, '#OR9149', NULL),
(76, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:02:20', '2023-12-01 13:02:20', '141', 'ahsin-49', NULL, '#OR6531', NULL),
(77, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:06:09', '2023-12-01 13:06:09', '144', 'ahsin-43', NULL, '#OR5792', NULL),
(78, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:06:38', '2023-12-01 13:06:38', '146', 'ahsin-31', NULL, '#OR1335', NULL),
(79, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:07:02', '2023-12-01 13:07:02', '147', 'ahsin-19', NULL, '#OR9243', NULL),
(80, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:10:08', '2023-12-01 13:10:08', '148', 'ahsin-25', NULL, '#OR8435', NULL),
(81, 'Ahsin', 'ahsinjavaid890@gmail.com', NULL, NULL, NULL, '2023-12-01 13:24:40', '2023-12-01 13:24:40', '149', 'ahsin-72', NULL, '#OR1195', NULL),
(82, 'Hadilton', 'hadilton@gmail.com', NULL, NULL, NULL, '2023-12-01 16:32:14', '2023-12-01 16:32:14', '150', 'hadilton-78', NULL, '#OR2545', NULL),
(83, 'shahzad', 'goravi8934@getmola.com', NULL, NULL, NULL, '2023-12-05 01:02:09', '2023-12-05 01:02:09', '153', 'shahzad-89', NULL, '#OR2093', '3');

-- --------------------------------------------------------

--
-- Table structure for table `organization_contacts`
--

CREATE TABLE `organization_contacts` (
  `id` int(11) NOT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_contacts`
--

INSERT INTO `organization_contacts` (`id`, `org_id`, `name`, `email`, `phone`, `image`, `role`, `updated_at`, `created_at`, `user_id`, `last_name`) VALUES
(1, NULL, 'Karmat', 'cakeson332@frandin.com', '03407712569', NULL, 'ASDF', '2023-11-30 16:23:51', '2023-11-30 16:23:51', '129', 'ali'),
(3, NULL, 'Hussain', 'husnain@gmail.com', '123123123231', '2141871671.jpg', 'SKFP', '2023-12-05 01:30:31', '2023-12-05 01:30:02', '153', 'Hassan'),
(4, NULL, 'Yousuf', 'yousufhussain@gmail.com', '039888888', '82348455.jpg', 'ASD', '2023-12-05 01:31:00', '2023-12-05 01:31:00', '153', 'Hussain');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quarter`
--

CREATE TABLE `quarter` (
  `id` int(11) NOT NULL,
  `quarter_name` varchar(255) DEFAULT NULL,
  `initiative_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `quarter_progress` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `loop_index` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter`
--

INSERT INTO `quarter` (`id`, `quarter_name`, `initiative_id`, `created_at`, `updated_at`, `user_id`, `quarter_progress`, `year`, `loop_index`) VALUES
(954, 'Q1', '302', '2023-11-27 12:38:04', NULL, '126', NULL, '2023', '0'),
(955, 'Q2', '302', '2023-11-27 12:38:04', NULL, '126', NULL, '2023', '1'),
(956, 'Q3', '302', '2023-11-27 12:38:04', NULL, '126', NULL, '2023', '2'),
(957, 'Q4', '302', '2023-11-27 12:38:05', NULL, '126', '0', '2023', '3'),
(958, 'Q1', '302', '2023-11-27 12:38:05', NULL, '126', NULL, '2024', '4'),
(959, 'Q2', '302', '2023-11-27 12:38:05', NULL, '126', NULL, '2024', '5'),
(960, 'Q3', '302', '2023-11-27 12:38:05', NULL, '126', NULL, '2024', '6'),
(961, 'Q4', '302', '2023-11-27 12:38:05', NULL, '126', NULL, '2024', '7'),
(962, 'Q5', '302', '2023-11-27 12:38:05', NULL, '126', NULL, '2025', '8'),
(963, 'Q1', '303', '2023-11-30 05:27:53', NULL, '126', NULL, '2023', '0'),
(964, 'Q2', '303', '2023-11-30 05:27:53', NULL, '126', NULL, '2023', '1'),
(965, 'Q3', '303', '2023-11-30 05:27:54', NULL, '126', NULL, '2023', '2'),
(966, 'Q4', '303', '2023-11-30 05:27:54', NULL, '126', '0', '2023', '3'),
(967, 'Q1', '304', '2023-11-30 05:52:37', NULL, '126', NULL, '2023', '0'),
(968, 'Q2', '304', '2023-11-30 05:52:38', NULL, '126', NULL, '2023', '1'),
(969, 'Q3', '304', '2023-11-30 05:52:38', NULL, '126', NULL, '2023', '2'),
(970, 'Q4', '304', '2023-11-30 05:52:38', NULL, '126', '0', '2023', '3'),
(971, 'Q1', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2023', '0'),
(972, 'Q2', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2023', '1'),
(973, 'Q3', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2023', '2'),
(974, 'Q4', '306', '2023-11-30 09:43:45', NULL, '126', '0', '2023', '3'),
(975, 'Q1', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2024', '4'),
(976, 'Q2', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2024', '5'),
(977, 'Q3', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2024', '6'),
(978, 'Q4', '306', '2023-11-30 09:43:45', NULL, '126', NULL, '2024', '7'),
(979, 'Q1', '308', '2023-12-01 05:44:23', NULL, '126', NULL, '2023', '0'),
(980, 'Q2', '308', '2023-12-01 05:44:23', NULL, '126', NULL, '2023', '1'),
(981, 'Q3', '308', '2023-12-01 05:44:23', NULL, '126', NULL, '2023', '2'),
(982, 'Q4', '308', '2023-12-01 05:44:23', NULL, '126', '0', '2023', '3'),
(983, 'Q1', '309', '2023-12-01 06:31:44', NULL, '140', NULL, '2023', '0'),
(984, 'Q2', '309', '2023-12-01 06:31:44', NULL, '140', NULL, '2023', '1'),
(985, 'Q3', '309', '2023-12-01 06:31:44', NULL, '140', NULL, '2023', '2'),
(986, 'Q4', '309', '2023-12-01 06:31:44', NULL, '140', '0', '2023', '3'),
(987, 'Q1', '309', '2023-12-01 06:31:44', NULL, '140', NULL, '2024', '4'),
(988, 'Q1', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2023', '0'),
(989, 'Q2', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2023', '1'),
(990, 'Q3', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2023', '2'),
(991, 'Q4', '310', '2023-12-01 07:01:38', NULL, '140', '0', '2023', '3'),
(992, 'Q1', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2024', '4'),
(993, 'Q2', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2024', '5'),
(994, 'Q3', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2024', '6'),
(995, 'Q4', '310', '2023-12-01 07:01:38', NULL, '140', NULL, '2024', '7'),
(996, 'Q1', '311', '2023-12-01 07:04:08', NULL, '140', NULL, '2023', '0'),
(997, 'Q2', '311', '2023-12-01 07:04:08', NULL, '140', NULL, '2023', '1'),
(998, 'Q3', '311', '2023-12-01 07:04:08', NULL, '140', NULL, '2023', '2'),
(999, 'Q4', '311', '2023-12-01 07:04:08', NULL, '140', '100', '2023', '3'),
(1000, 'Q1', '311', '2023-12-01 07:04:08', NULL, '140', NULL, '2024', '4'),
(1001, 'Q1', '317', '2023-12-04 19:03:53', NULL, '153', NULL, '2023', '0'),
(1002, 'Q2', '317', '2023-12-04 19:03:53', NULL, '153', NULL, '2023', '1'),
(1003, 'Q3', '317', '2023-12-04 19:03:53', NULL, '153', '50', '2023', '2'),
(1004, 'Q4', '317', '2023-12-04 19:03:53', NULL, '153', NULL, '2024', '3'),
(1005, 'Q1', '317', '2023-12-04 19:03:53', NULL, '153', NULL, '2024', '4'),
(1006, 'Q2', '317', '2023-12-04 19:03:53', NULL, '153', NULL, '2024', '5'),
(1007, 'Q1', '318', '2023-12-04 19:14:47', NULL, '153', NULL, '2023', '0'),
(1008, 'Q2', '318', '2023-12-04 19:14:47', NULL, '153', NULL, '2023', '1'),
(1009, 'Q3', '318', '2023-12-04 19:14:47', NULL, '153', '33.33', '2023', '2'),
(1010, 'Q1', '319', '2023-12-04 19:18:37', NULL, '153', NULL, '2023', '0'),
(1011, 'Q2', '319', '2023-12-04 19:18:37', NULL, '153', NULL, '2023', '1'),
(1012, 'Q3', '319', '2023-12-04 19:18:37', NULL, '153', '25', '2023', '2'),
(1013, 'Q4', '319', '2023-12-04 19:18:37', NULL, '153', NULL, '2024', '3'),
(1014, 'Q1', '319', '2023-12-04 19:18:37', NULL, '153', NULL, '2024', '4'),
(1015, 'Q2', '319', '2023-12-04 19:18:37', NULL, '153', NULL, '2024', '5'),
(1016, 'Q1', '320', '2023-12-04 20:12:25', NULL, '153', NULL, '2023', '0'),
(1017, 'Q2', '320', '2023-12-04 20:12:25', NULL, '153', NULL, '2023', '1'),
(1018, 'Q3', '320', '2023-12-04 20:12:25', NULL, '153', '100', '2023', '2'),
(1019, 'Q4', '320', '2023-12-04 20:12:25', NULL, '153', NULL, '2024', '3'),
(1020, 'Q1', '320', '2023-12-04 20:12:25', NULL, '153', NULL, '2024', '4'),
(1021, 'Q2', '320', '2023-12-04 20:12:25', NULL, '153', NULL, '2024', '5');

-- --------------------------------------------------------

--
-- Table structure for table `quarter_month`
--

CREATE TABLE `quarter_month` (
  `id` int(11) NOT NULL,
  `quarter_id` varchar(255) DEFAULT NULL,
  `month` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL,
  `initiative_id` varchar(255) DEFAULT NULL,
  `quarter_name` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter_month`
--

INSERT INTO `quarter_month` (`id`, `quarter_id`, `month`, `user_id`, `created_at`, `updated_at`, `initiative_id`, `quarter_name`, `year`) VALUES
(2550, '954', 'January', '126', '2023-11-27 12:38:04', NULL, '302', 'Q1', '2023'),
(2551, '954', 'February', '126', '2023-11-27 12:38:04', NULL, '302', 'Q1', '2023'),
(2552, '954', 'March', '126', '2023-11-27 12:38:04', NULL, '302', 'Q1', '2023'),
(2553, '955', 'April', '126', '2023-11-27 12:38:04', NULL, '302', 'Q2', '2023'),
(2554, '955', 'May', '126', '2023-11-27 12:38:04', NULL, '302', 'Q2', '2023'),
(2555, '955', 'June', '126', '2023-11-27 12:38:04', NULL, '302', 'Q2', '2023'),
(2556, '956', 'July', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2023'),
(2557, '956', 'August', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2023'),
(2558, '956', 'September', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2023'),
(2559, '957', 'October', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2023'),
(2560, '957', 'November', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2023'),
(2561, '957', 'December', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2023'),
(2562, '958', 'January', '126', '2023-11-27 12:38:05', NULL, '302', 'Q1', '2024'),
(2563, '958', 'February', '126', '2023-11-27 12:38:05', NULL, '302', 'Q1', '2024'),
(2564, '958', 'March', '126', '2023-11-27 12:38:05', NULL, '302', 'Q1', '2024'),
(2565, '959', 'April', '126', '2023-11-27 12:38:05', NULL, '302', 'Q2', '2024'),
(2566, '959', 'May', '126', '2023-11-27 12:38:05', NULL, '302', 'Q2', '2024'),
(2567, '959', 'June', '126', '2023-11-27 12:38:05', NULL, '302', 'Q2', '2024'),
(2568, '960', 'July', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2024'),
(2569, '960', 'August', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2024'),
(2570, '960', 'September', '126', '2023-11-27 12:38:05', NULL, '302', 'Q3', '2024'),
(2571, '961', 'October', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2024'),
(2572, '961', 'November', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2024'),
(2573, '961', 'December', '126', '2023-11-27 12:38:05', NULL, '302', 'Q4', '2024'),
(2574, '962', 'January', '126', '2023-11-27 12:38:05', NULL, '302', 'Q5', '2025'),
(2575, '963', 'January', '126', '2023-11-30 05:27:53', NULL, '303', 'Q1', '2023'),
(2576, '963', 'February', '126', '2023-11-30 05:27:53', NULL, '303', 'Q1', '2023'),
(2577, '963', 'March', '126', '2023-11-30 05:27:53', NULL, '303', 'Q1', '2023'),
(2578, '964', 'April', '126', '2023-11-30 05:27:53', NULL, '303', 'Q2', '2023'),
(2579, '964', 'May', '126', '2023-11-30 05:27:53', NULL, '303', 'Q2', '2023'),
(2580, '964', 'June', '126', '2023-11-30 05:27:53', NULL, '303', 'Q2', '2023'),
(2581, '965', 'July', '126', '2023-11-30 05:27:54', NULL, '303', 'Q3', '2023'),
(2582, '965', 'August', '126', '2023-11-30 05:27:54', NULL, '303', 'Q3', '2023'),
(2583, '965', 'September', '126', '2023-11-30 05:27:54', NULL, '303', 'Q3', '2023'),
(2584, '966', 'October', '126', '2023-11-30 05:27:54', NULL, '303', 'Q4', '2023'),
(2585, '966', 'November', '126', '2023-11-30 05:27:54', NULL, '303', 'Q4', '2023'),
(2586, '967', 'January', '126', '2023-11-30 05:52:37', NULL, '304', 'Q1', '2023'),
(2587, '967', 'February', '126', '2023-11-30 05:52:37', NULL, '304', 'Q1', '2023'),
(2588, '967', 'March', '126', '2023-11-30 05:52:37', NULL, '304', 'Q1', '2023'),
(2589, '968', 'April', '126', '2023-11-30 05:52:38', NULL, '304', 'Q2', '2023'),
(2590, '968', 'May', '126', '2023-11-30 05:52:38', NULL, '304', 'Q2', '2023'),
(2591, '968', 'June', '126', '2023-11-30 05:52:38', NULL, '304', 'Q2', '2023'),
(2592, '969', 'July', '126', '2023-11-30 05:52:38', NULL, '304', 'Q3', '2023'),
(2593, '969', 'August', '126', '2023-11-30 05:52:38', NULL, '304', 'Q3', '2023'),
(2594, '969', 'September', '126', '2023-11-30 05:52:38', NULL, '304', 'Q3', '2023'),
(2595, '970', 'October', '126', '2023-11-30 05:52:38', NULL, '304', 'Q4', '2023'),
(2596, '970', 'November', '126', '2023-11-30 05:52:38', NULL, '304', 'Q4', '2023'),
(2597, '971', 'January', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2023'),
(2598, '971', 'February', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2023'),
(2599, '971', 'March', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2023'),
(2600, '972', 'April', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2023'),
(2601, '972', 'May', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2023'),
(2602, '972', 'June', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2023'),
(2603, '973', 'July', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2023'),
(2604, '973', 'August', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2023'),
(2605, '973', 'September', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2023'),
(2606, '974', 'October', '126', '2023-11-30 09:43:45', NULL, '306', 'Q4', '2023'),
(2607, '974', 'November', '126', '2023-11-30 09:43:45', NULL, '306', 'Q4', '2023'),
(2608, '974', 'December', '126', '2023-11-30 09:43:45', NULL, '306', 'Q4', '2023'),
(2609, '975', 'January', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2024'),
(2610, '975', 'February', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2024'),
(2611, '975', 'March', '126', '2023-11-30 09:43:45', NULL, '306', 'Q1', '2024'),
(2612, '976', 'April', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2024'),
(2613, '976', 'May', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2024'),
(2614, '976', 'June', '126', '2023-11-30 09:43:45', NULL, '306', 'Q2', '2024'),
(2615, '977', 'July', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2024'),
(2616, '977', 'August', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2024'),
(2617, '977', 'September', '126', '2023-11-30 09:43:45', NULL, '306', 'Q3', '2024'),
(2618, '978', 'October', '126', '2023-11-30 09:43:45', NULL, '306', 'Q4', '2024'),
(2619, '978', 'November', '126', '2023-11-30 09:43:45', NULL, '306', 'Q4', '2024'),
(2620, '979', 'January', '126', '2023-12-01 05:44:23', NULL, '308', 'Q1', '2023'),
(2621, '979', 'February', '126', '2023-12-01 05:44:23', NULL, '308', 'Q1', '2023'),
(2622, '979', 'March', '126', '2023-12-01 05:44:23', NULL, '308', 'Q1', '2023'),
(2623, '980', 'April', '126', '2023-12-01 05:44:23', NULL, '308', 'Q2', '2023'),
(2624, '980', 'May', '126', '2023-12-01 05:44:23', NULL, '308', 'Q2', '2023'),
(2625, '980', 'June', '126', '2023-12-01 05:44:23', NULL, '308', 'Q2', '2023'),
(2626, '981', 'July', '126', '2023-12-01 05:44:23', NULL, '308', 'Q3', '2023'),
(2627, '981', 'August', '126', '2023-12-01 05:44:23', NULL, '308', 'Q3', '2023'),
(2628, '981', 'September', '126', '2023-12-01 05:44:23', NULL, '308', 'Q3', '2023'),
(2629, '982', 'October', '126', '2023-12-01 05:44:23', NULL, '308', 'Q4', '2023'),
(2630, '982', 'November', '126', '2023-12-01 05:44:23', NULL, '308', 'Q4', '2023'),
(2631, '982', 'December', '126', '2023-12-01 05:44:23', NULL, '308', 'Q4', '2023'),
(2632, '983', 'January', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2023'),
(2633, '983', 'February', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2023'),
(2634, '983', 'March', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2023'),
(2635, '984', 'April', '140', '2023-12-01 06:31:44', NULL, '309', 'Q2', '2023'),
(2636, '984', 'May', '140', '2023-12-01 06:31:44', NULL, '309', 'Q2', '2023'),
(2637, '984', 'June', '140', '2023-12-01 06:31:44', NULL, '309', 'Q2', '2023'),
(2638, '985', 'July', '140', '2023-12-01 06:31:44', NULL, '309', 'Q3', '2023'),
(2639, '985', 'August', '140', '2023-12-01 06:31:44', NULL, '309', 'Q3', '2023'),
(2640, '985', 'September', '140', '2023-12-01 06:31:44', NULL, '309', 'Q3', '2023'),
(2641, '986', 'October', '140', '2023-12-01 06:31:44', NULL, '309', 'Q4', '2023'),
(2642, '986', 'November', '140', '2023-12-01 06:31:44', NULL, '309', 'Q4', '2023'),
(2643, '986', 'December', '140', '2023-12-01 06:31:44', NULL, '309', 'Q4', '2023'),
(2644, '987', 'January', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2024'),
(2645, '987', 'February', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2024'),
(2646, '987', 'March', '140', '2023-12-01 06:31:44', NULL, '309', 'Q1', '2024'),
(2647, '988', 'January', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2023'),
(2648, '988', 'February', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2023'),
(2649, '988', 'March', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2023'),
(2650, '989', 'April', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2023'),
(2651, '989', 'May', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2023'),
(2652, '989', 'June', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2023'),
(2653, '990', 'July', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2023'),
(2654, '990', 'August', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2023'),
(2655, '990', 'September', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2023'),
(2656, '991', 'October', '140', '2023-12-01 07:01:38', NULL, '310', 'Q4', '2023'),
(2657, '991', 'November', '140', '2023-12-01 07:01:38', NULL, '310', 'Q4', '2023'),
(2658, '991', 'December', '140', '2023-12-01 07:01:38', NULL, '310', 'Q4', '2023'),
(2659, '992', 'January', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2024'),
(2660, '992', 'February', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2024'),
(2661, '992', 'March', '140', '2023-12-01 07:01:38', NULL, '310', 'Q1', '2024'),
(2662, '993', 'April', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2024'),
(2663, '993', 'May', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2024'),
(2664, '993', 'June', '140', '2023-12-01 07:01:38', NULL, '310', 'Q2', '2024'),
(2665, '994', 'July', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2024'),
(2666, '994', 'August', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2024'),
(2667, '994', 'September', '140', '2023-12-01 07:01:38', NULL, '310', 'Q3', '2024'),
(2668, '995', 'October', '140', '2023-12-01 07:01:38', NULL, '310', 'Q4', '2024'),
(2669, '995', 'November', '140', '2023-12-01 07:01:38', NULL, '310', 'Q4', '2024'),
(2670, '996', 'January', '140', '2023-12-01 07:04:08', NULL, '311', 'Q1', '2023'),
(2671, '996', 'February', '140', '2023-12-01 07:04:08', NULL, '311', 'Q1', '2023'),
(2672, '996', 'March', '140', '2023-12-01 07:04:08', NULL, '311', 'Q1', '2023'),
(2673, '997', 'April', '140', '2023-12-01 07:04:08', NULL, '311', 'Q2', '2023'),
(2674, '997', 'May', '140', '2023-12-01 07:04:08', NULL, '311', 'Q2', '2023'),
(2675, '997', 'June', '140', '2023-12-01 07:04:08', NULL, '311', 'Q2', '2023'),
(2676, '998', 'July', '140', '2023-12-01 07:04:08', NULL, '311', 'Q3', '2023'),
(2677, '998', 'August', '140', '2023-12-01 07:04:08', NULL, '311', 'Q3', '2023'),
(2678, '998', 'September', '140', '2023-12-01 07:04:08', NULL, '311', 'Q3', '2023'),
(2679, '999', 'October', '140', '2023-12-01 07:04:08', NULL, '311', 'Q4', '2023'),
(2680, '999', 'November', '140', '2023-12-01 07:04:08', NULL, '311', 'Q4', '2023'),
(2681, '999', 'December', '140', '2023-12-01 07:04:08', NULL, '311', 'Q4', '2023'),
(2682, '1000', 'January', '140', '2023-12-01 07:04:08', NULL, '311', 'Q1', '2024'),
(2683, '1000', 'February', '140', '2023-12-01 07:04:08', NULL, '311', 'Q1', '2024'),
(2684, '1001', 'April', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2023'),
(2685, '1001', 'May', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2023'),
(2686, '1001', 'June', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2023'),
(2687, '1002', 'July', '153', '2023-12-04 19:03:53', NULL, '317', 'Q2', '2023'),
(2688, '1002', 'August', '153', '2023-12-04 19:03:53', NULL, '317', 'Q2', '2023'),
(2689, '1002', 'September', '153', '2023-12-04 19:03:53', NULL, '317', 'Q2', '2023'),
(2690, '1003', 'October', '153', '2023-12-04 19:03:53', NULL, '317', 'Q3', '2023'),
(2691, '1003', 'November', '153', '2023-12-04 19:03:53', NULL, '317', 'Q3', '2023'),
(2692, '1003', 'December', '153', '2023-12-04 19:03:53', NULL, '317', 'Q3', '2023'),
(2693, '1004', 'January', '153', '2023-12-04 19:03:53', NULL, '317', 'Q4', '2024'),
(2694, '1004', 'February', '153', '2023-12-04 19:03:53', NULL, '317', 'Q4', '2024'),
(2695, '1004', 'March', '153', '2023-12-04 19:03:53', NULL, '317', 'Q4', '2024'),
(2696, '1005', 'April', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2024'),
(2697, '1005', 'May', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2024'),
(2698, '1005', 'June', '153', '2023-12-04 19:03:53', NULL, '317', 'Q1', '2024'),
(2699, '1006', 'July', '153', '2023-12-04 19:03:53', NULL, '317', 'Q2', '2024'),
(2700, '1007', 'April', '153', '2023-12-04 19:14:47', NULL, '318', 'Q1', '2023'),
(2701, '1007', 'May', '153', '2023-12-04 19:14:47', NULL, '318', 'Q1', '2023'),
(2702, '1007', 'June', '153', '2023-12-04 19:14:47', NULL, '318', 'Q1', '2023'),
(2703, '1008', 'July', '153', '2023-12-04 19:14:47', NULL, '318', 'Q2', '2023'),
(2704, '1008', 'August', '153', '2023-12-04 19:14:47', NULL, '318', 'Q2', '2023'),
(2705, '1008', 'September', '153', '2023-12-04 19:14:47', NULL, '318', 'Q2', '2023'),
(2706, '1009', 'October', '153', '2023-12-04 19:14:47', NULL, '318', 'Q3', '2023'),
(2707, '1009', 'November', '153', '2023-12-04 19:14:47', NULL, '318', 'Q3', '2023'),
(2708, '1009', 'December', '153', '2023-12-04 19:14:47', NULL, '318', 'Q3', '2023'),
(2709, '1010', 'April', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2023'),
(2710, '1010', 'May', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2023'),
(2711, '1010', 'June', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2023'),
(2712, '1011', 'July', '153', '2023-12-04 19:18:37', NULL, '319', 'Q2', '2023'),
(2713, '1011', 'August', '153', '2023-12-04 19:18:37', NULL, '319', 'Q2', '2023'),
(2714, '1011', 'September', '153', '2023-12-04 19:18:37', NULL, '319', 'Q2', '2023'),
(2715, '1012', 'October', '153', '2023-12-04 19:18:37', NULL, '319', 'Q3', '2023'),
(2716, '1012', 'November', '153', '2023-12-04 19:18:37', NULL, '319', 'Q3', '2023'),
(2717, '1012', 'December', '153', '2023-12-04 19:18:37', NULL, '319', 'Q3', '2023'),
(2718, '1013', 'January', '153', '2023-12-04 19:18:37', NULL, '319', 'Q4', '2024'),
(2719, '1013', 'February', '153', '2023-12-04 19:18:37', NULL, '319', 'Q4', '2024'),
(2720, '1013', 'March', '153', '2023-12-04 19:18:37', NULL, '319', 'Q4', '2024'),
(2721, '1014', 'April', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2024'),
(2722, '1014', 'May', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2024'),
(2723, '1014', 'June', '153', '2023-12-04 19:18:37', NULL, '319', 'Q1', '2024'),
(2724, '1015', 'July', '153', '2023-12-04 19:18:37', NULL, '319', 'Q2', '2024'),
(2725, '1016', 'April', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2023'),
(2726, '1016', 'May', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2023'),
(2727, '1016', 'June', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2023'),
(2728, '1017', 'July', '153', '2023-12-04 20:12:25', NULL, '320', 'Q2', '2023'),
(2729, '1017', 'August', '153', '2023-12-04 20:12:25', NULL, '320', 'Q2', '2023'),
(2730, '1017', 'September', '153', '2023-12-04 20:12:25', NULL, '320', 'Q2', '2023'),
(2731, '1018', 'October', '153', '2023-12-04 20:12:25', NULL, '320', 'Q3', '2023'),
(2732, '1018', 'November', '153', '2023-12-04 20:12:25', NULL, '320', 'Q3', '2023'),
(2733, '1018', 'December', '153', '2023-12-04 20:12:25', NULL, '320', 'Q3', '2023'),
(2734, '1019', 'January', '153', '2023-12-04 20:12:25', NULL, '320', 'Q4', '2024'),
(2735, '1019', 'February', '153', '2023-12-04 20:12:25', NULL, '320', 'Q4', '2024'),
(2736, '1019', 'March', '153', '2023-12-04 20:12:25', NULL, '320', 'Q4', '2024'),
(2737, '1020', 'April', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2024'),
(2738, '1020', 'May', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2024'),
(2739, '1020', 'June', '153', '2023-12-04 20:12:25', NULL, '320', 'Q1', '2024'),
(2740, '1021', 'July', '153', '2023-12-04 20:12:25', NULL, '320', 'Q2', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

CREATE TABLE `sprint` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_data` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `detail` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `IndexCount` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `value_unit_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`id`, `title`, `start_data`, `end_date`, `detail`, `created_at`, `status`, `type`, `IndexCount`, `user_id`, `value_unit_id`) VALUES
(69, NULL, '2023-11-30', '2023-11-30', NULL, '2023-11-30 06:12:19', '1', 'unit', '1', '126', '44'),
(70, 'First Quarter', '2023-11-01', '2023-12-30', NULL, '2023-11-30 06:31:20', '1', 'unit', '2', '126', '44'),
(71, 'Quarter 1', '2023-12-01', '2024-02-29', NULL, '2023-12-01 06:44:40', '1', 'unit', '1', '140', '48'),
(72, 'Quarter 1', '2023-12-01', '2024-03-01', 'sdf', '2023-12-01 11:22:04', NULL, 'unit', '1', '140', '46'),
(73, 'Quarter 2', '2023-12-04', '2024-06-04', 'adf', '2023-12-04 04:53:58', NULL, 'unit', '2', '140', '48'),
(74, 'Quarter 1', '2023-12-04', '2023-12-20', 'adf', '2023-12-04 20:06:03', '1', 'unit', '1', '153', '51');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_report`
--

CREATE TABLE `sprint_report` (
  `id` int(11) NOT NULL,
  `q_id` varchar(255) DEFAULT NULL,
  `initiative_id` varchar(255) DEFAULT NULL,
  `initiative_key_id` varchar(255) DEFAULT NULL,
  `initiative_name` varchar(255) DEFAULT NULL,
  `epic_id` varchar(255) DEFAULT NULL,
  `epic_init_id` varchar(255) DEFAULT NULL,
  `epic_name` varchar(255) DEFAULT NULL,
  `epic_prog` varchar(255) DEFAULT NULL,
  `epic_date` varchar(255) DEFAULT NULL,
  `epic_trash` varchar(255) DEFAULT NULL,
  `epic_done` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `objective` text,
  `key_result` text,
  `initiative` varchar(255) DEFAULT NULL,
  `epic` varchar(255) DEFAULT NULL,
  `epic_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sprint_report`
--

INSERT INTO `sprint_report` (`id`, `q_id`, `initiative_id`, `initiative_key_id`, `initiative_name`, `epic_id`, `epic_init_id`, `epic_name`, `epic_prog`, `epic_date`, `epic_trash`, `epic_done`, `user_id`, `created_at`, `objective`, `key_result`, `initiative`, `epic`, `epic_status`) VALUES
(131, '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '126', '2023-11-30 06:30:08', '[]', '[]', NULL, NULL, NULL),
(132, '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '126', '2023-11-30 06:31:36', '[{\"id\":155,\"objective_name\":\"Websites\",\"objective_date\":\"Nov 27,2023 - Jan 27,2030\",\"objective_status\":\"In progress\",\"objective_prog\":\"0\"}]', '[{\"id\":173,\"obj_id\":\"155\",\"key_name\":\"Frontend\",\"key_date\":\"Nov 27,2023 - Jan 27,2025\",\"key_status\":\"In progress\",\"key_prog\":\"0\",\"key_epic_count\":1,\"key_epic_comp\":0,\"key_epic_incopm\":1},{\"id\":174,\"obj_id\":\"155\",\"key_name\":\"Backend\",\"key_date\":\"Nov 27,2023 - Jan 27,2026\",\"key_status\":\"In progress\",\"key_prog\":\"0\",\"key_epic_count\":0,\"key_epic_comp\":0,\"key_epic_incopm\":0},{\"id\":175,\"obj_id\":\"155\",\"key_name\":\"ertertretdsfdfret\",\"key_date\":\"Nov 30,2023 - Dec 01,2023\",\"key_status\":\"In progress\",\"key_prog\":\"0\",\"key_epic_count\":0,\"key_epic_comp\":0,\"key_epic_incopm\":0},{\"id\":176,\"obj_id\":\"155\",\"key_name\":\"ertertretdsfdfret\",\"key_date\":\"Nov 30,2023 - Dec 01,2023\",\"key_status\":\"In progress\",\"key_prog\":\"0\",\"key_epic_count\":1,\"key_epic_comp\":0,\"key_epic_incopm\":1},{\"id\":179,\"obj_id\":\"155\",\"key_name\":\"key\",\"key_date\":\"Nov 30,2023 - Nov 30,2023\",\"key_status\":\"To Do\",\"key_prog\":\"0\",\"key_epic_count\":0,\"key_epic_comp\":0,\"key_epic_incopm\":0}]', NULL, NULL, NULL),
(133, '70', '302', '173', 'Frontend Initiative', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-30 06:31:36', NULL, NULL, NULL, NULL, NULL),
(134, '70', '303', '175', 'asdsadsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-30 06:31:36', NULL, NULL, NULL, NULL, NULL),
(135, '70', '304', '177', 'redsadsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-30 06:31:36', NULL, NULL, NULL, NULL, NULL),
(136, '70', NULL, NULL, NULL, '445', '302', 'Epic One', '0', 'Nov 11,2023', NULL, NULL, NULL, '2023-11-30 06:31:36', NULL, NULL, NULL, NULL, 'In progress'),
(137, '70', NULL, NULL, NULL, '449', '305', 'Epic', '0', 'Nov 30,2023', NULL, '2023-11-30 06:29:15', NULL, '2023-11-30 06:31:36', NULL, NULL, NULL, NULL, 'To Do'),
(138, '71', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '140', '2023-12-01 07:04:47', '[{\"id\":164,\"objective_name\":\"Objective\",\"objective_date\":\"Dec 01,2023 - Mar 01,2024\",\"objective_status\":\"To Do\",\"objective_prog\":\"100\"}]', '[{\"id\":185,\"obj_id\":\"164\",\"key_name\":\"Threat Detection and Response:\",\"key_date\":\"Dec 01,2023 - Dec 01,2023\",\"key_status\":\"In progress\",\"key_prog\":\"100\",\"key_epic_count\":1,\"key_epic_comp\":1,\"key_epic_incopm\":0}]', NULL, NULL, NULL),
(139, '71', '310', '184', 'Integrated Analytics Platform', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01 07:04:47', NULL, NULL, NULL, NULL, NULL),
(140, '71', '311', '185', 'Conduct regular red teaming exercises.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01 07:04:47', NULL, NULL, NULL, NULL, NULL),
(141, '71', NULL, NULL, NULL, '464', '310', 'Launch the platform with a user adoption rate of 80%', '0', 'Oct 31,2023', NULL, NULL, NULL, '2023-12-01 07:04:47', NULL, NULL, NULL, NULL, 'In progress'),
(142, '71', NULL, NULL, NULL, '465', '310', 'Improve decision-making efficiency by 25%.', '0', 'Dec 31,2023', NULL, NULL, NULL, '2023-12-01 07:04:47', NULL, NULL, NULL, NULL, 'In progress'),
(143, '71', NULL, NULL, NULL, '466', '311', 'Achieve 100% compliance with data protection regulations.', '100', 'Nov 30,2023', NULL, '2023-12-01 07:04:38', NULL, '2023-12-01 07:04:47', NULL, NULL, NULL, NULL, 'Done'),
(144, '74', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '153', '2023-12-04 20:16:45', '[{\"id\":168,\"objective_name\":\"Agile Software Development\",\"objective_date\":\"Dec 04,2023 - Nov 04,2024\",\"objective_status\":\"To Do\",\"objective_prog\":\"0\"},{\"id\":169,\"objective_name\":\"Improve Time-to-Market for Products\",\"objective_date\":\"Dec 04,2023 - Oct 05,2024\",\"objective_status\":\"To Do\",\"objective_prog\":\"100\"}]', '[{\"id\":189,\"obj_id\":\"168\",\"key_name\":\"Improve Time-to-Market for Products\",\"key_date\":\"Dec 04,2023 - Nov 04,2024\",\"key_status\":\"To Do\",\"key_prog\":\"0\",\"key_epic_count\":4,\"key_epic_comp\":1,\"key_epic_incopm\":3},{\"id\":190,\"obj_id\":\"168\",\"key_name\":\"Implement Agile Transformation\",\"key_date\":\"Dec 05,2023 - Jul 05,2024\",\"key_status\":\"To Do\",\"key_prog\":\"0\",\"key_epic_count\":7,\"key_epic_comp\":3,\"key_epic_incopm\":4},{\"id\":191,\"obj_id\":\"169\",\"key_name\":\"Reduce average feature development time by 20%.\",\"key_date\":\"Dec 04,2023 - Jul 05,2024\",\"key_status\":\"To Do\",\"key_prog\":\"100\",\"key_epic_count\":1,\"key_epic_comp\":1,\"key_epic_incopm\":0}]', NULL, NULL, NULL),
(145, '74', '317', '190', 'Increase Market Share in Target Segments', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, NULL),
(146, '74', '318', '190', 'Customer Satisfaction and Issue Resolution', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, NULL),
(147, '74', '319', '189', 'Knowledge Base Enhancement:', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, NULL),
(148, '74', '320', '191', 'Increase the number of releases per year from 4 to 6.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, NULL),
(149, '74', NULL, NULL, NULL, '468', '317', 'Market Research', '100', 'Dec 31,2023', NULL, '2023-12-04 19:11:45', NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'Done'),
(150, '74', NULL, NULL, NULL, '469', '317', 'Content Creation', '100', 'Nov 30,2023', NULL, '2023-12-04 19:13:57', NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'Done'),
(151, '74', NULL, NULL, NULL, '470', '318', 'Chatbot Integration', '100', 'Dec 31,2023', NULL, '2023-12-04 19:16:06', NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(152, '74', NULL, NULL, NULL, '471', '319', 'Training Program', '100', 'Dec 31,2023', NULL, '2023-12-04 19:19:56', NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'Done'),
(153, '74', NULL, NULL, NULL, '472', '319', 'test Epic', '0', 'Dec 26,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(154, '74', NULL, NULL, NULL, '473', '319', 'Decrease average response time for customer inquiries by 15%.', '0', 'Nov 30,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(155, '74', NULL, NULL, NULL, '474', '319', 'Achieve a customer satisfaction rating of 4.8 out of 5.', '0', 'Oct 31,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(156, '74', NULL, NULL, NULL, '475', '317', 'Achieve a customer satisfaction rating of 4.8 out of 5.', '0', 'Nov 30,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(157, '74', NULL, NULL, NULL, '476', '317', 'Achieve a customer satisfaction rating of 4.8 out of 5.', '0', 'Oct 31,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(158, '74', NULL, NULL, NULL, '477', '318', 'Achieve a 15% increase in new customer acquisitions.', '0', 'Nov 30,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(159, '74', NULL, NULL, NULL, '478', '318', 'Improve customer retention rate by 10% through targeted marketing campaigns.', '0', 'Oct 31,2023', NULL, NULL, NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'To Do'),
(160, '74', NULL, NULL, NULL, '479', '320', 'Implement Agile Transformation', '100', 'Dec 31,2023', NULL, '2023-12-04 20:12:56', NULL, '2023-12-04 20:16:45', NULL, NULL, NULL, NULL, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `member` varchar(255) DEFAULT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `team_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team_backlog`
--

CREATE TABLE `team_backlog` (
  `id` int(11) NOT NULL,
  `epic_title` varchar(255) DEFAULT NULL,
  `epic_start_date` varchar(255) DEFAULT NULL,
  `epic_end_date` varchar(255) DEFAULT NULL,
  `epic_status` varchar(255) DEFAULT NULL,
  `epic_detail` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assign_status` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `jira_id` varchar(255) DEFAULT NULL,
  `quarter` varchar(255) DEFAULT NULL,
  `jira_project` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `unit_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit_team`
--

CREATE TABLE `unit_team` (
  `id` int(11) NOT NULL,
  `member` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `team_title` varchar(255) DEFAULT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'BU'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_team`
--

INSERT INTO `unit_team` (`id`, `member`, `org_id`, `team_title`, `lead_id`, `created_at`, `slug`, `type`) VALUES
(10, '59,60', '46', 'Tem Alpha', '60', '2023-11-30 09:58:45', 'tem-alpha-44', 'BU'),
(11, '72,73,74', '48', 'Team name', '72', '2023-12-01 11:37:11', 'team-name-70', 'BU'),
(12, '72,73', '48', 'asdf', '72', '2023-12-04 05:06:48', 'asdf-31', 'BU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_name`, `google_id`, `facebook_id`, `status`, `role`) VALUES
(126, 'Usama', 'usamakashif890@gmail.com', '2023-11-27 07:30:44', '$2y$10$0jRrdCljTPnLNJW6gfIDZudjEcS1fJ7i2HRJbjewheVcrfXOOfuMK', NULL, '2023-11-27 07:29:52', '2023-11-27 07:30:44', 'Kashif', NULL, NULL, '1', NULL),
(127, 'Ashtyn', 'fakedata54934@gmail.com', '2023-11-27 07:32:35', '$2y$10$qjAFxFwzJAXg5zLcXqYckuus1ehQosaKTy3p/y4ohtJJiIvAK71/u', NULL, '2023-11-27 07:32:35', '2023-11-27 07:32:35', NULL, NULL, NULL, '1', 'Manager'),
(128, 'Clemens', 'fakedata67612@gmail.com', '2023-11-27 07:33:01', '$2y$10$ThmZosAqM2WZYdnK2RDLU.g3WO6jTCsSgAyKvtVly.vXPB/6lOgWm', NULL, '2023-11-27 07:33:01', '2023-11-27 07:33:01', NULL, NULL, NULL, '1', 'Manager'),
(129, 'Dan', 'hunddlerlaravel@gmail.com', '2023-11-27 07:33:36', '$2y$10$ytxhnOagBQsSUkCFrgd2ZejY5MVWld0qKBOSsPFogKDEjyTumktaG', NULL, '2023-11-27 07:33:36', '2023-11-27 07:33:36', NULL, NULL, NULL, '1', 'Manager'),
(130, 'Hallie', 'fakedata85203@gmail.com', '2023-11-27 07:33:57', '$2y$10$rZ6k5aG8jhjftdSOUWJjNeE5duAlZvIZ54GAjkJaJFlNHEqfqW0BW', NULL, '2023-11-27 07:33:57', '2023-11-27 07:33:57', NULL, NULL, NULL, '1', 'Manager'),
(131, 'shahzad', 'cakeson332@frandin.com', '2023-11-30 16:20:43', '$2y$10$nOS6pb/LrkwrcjwLFtZHHe.qm47cE.S99DSOc.BgojU0aYbYts5LS', NULL, '2023-11-30 16:20:43', '2023-11-30 16:20:43', NULL, NULL, NULL, '1', 'CFO'),
(132, 'karamat', 'cakeson332@frandin.coadf', '2023-11-30 16:27:07', '$2y$10$s9J.OptrmrG3KGcxXfnrJ.nFK5o.tec1Y8F.2S3Z5r4gRxxb3.zeK', NULL, '2023-11-30 16:27:07', '2023-11-30 16:27:07', NULL, NULL, NULL, '1', 'adf'),
(140, 'shahzad', 'tetabay992@frandin.com', '2023-12-01 18:03:03', '$2y$10$PQ43Zngsz4KFjjX2IB/GIelha5YNhIiUzIgVxt1vwX57eSkgtIgHa', NULL, '2023-12-01 13:00:30', '2023-12-01 13:00:30', 'iqbal', NULL, NULL, '1', NULL),
(143, 'Amir', 'amirmuneer@gmail.com', '2023-12-01 13:05:22', '$2y$10$wtTekDi8iK9fKL1w4bLHAebHaWCNltR6jg.H9qW3SPzynIXFRFEuK', NULL, '2023-12-01 13:05:22', '2023-12-01 13:05:22', NULL, NULL, NULL, '1', 'Developer'),
(145, 'Awais', 'awaisali@gmail.com', '2023-12-01 13:06:14', '$2y$10$1IXeUJiKJWArR4hgnZoNUOj5erMPltsx05mpX3kLuyN6aParOAEX.', NULL, '2023-12-01 13:06:14', '2023-12-01 13:06:14', NULL, NULL, NULL, '1', 'UI Designer'),
(150, 'Hadilton', 'hadilton@gmail.com', NULL, '$2y$10$po50nUyp52Dt.KLu9xTx7uF0lrVlldfoIV1yY8A1HeYTyQgw6G7LG', NULL, '2023-12-01 16:32:14', '2023-12-01 16:32:14', 'Barbosa', NULL, NULL, '1', NULL),
(151, 'shahzad', 'katel17348@bustayes.com', '2023-12-04 11:47:29', '$2y$10$Mksv7hDKiFl00nythrAwtu0UI5ACneIqvGdhBt7zw4uAQbbg2OKGi', NULL, '2023-12-04 11:47:29', '2023-12-04 11:47:29', NULL, NULL, NULL, '1', 'CFO'),
(153, 'shahzad', 'goravi8934@getmola.com', '2023-12-05 01:05:18', '$2y$10$lSfKRoZC8MaGBkIY5Je22.ih8F.7VoxXZkE9Q1VIzr5/MJj9.vWKW', NULL, '2023-12-05 01:02:09', '2023-12-05 01:05:18', 'iqbal', NULL, NULL, '1', NULL),
(154, 'Amir', 'amirmuneer11@gmail.com', '2023-12-05 01:13:46', '$2y$10$w3GYNrEYhlrvwdJ1miB05enWwIedD5De/FLHRvC0KgYtp2.iUv3RC', NULL, '2023-12-05 01:13:46', '2023-12-05 01:27:44', NULL, NULL, NULL, '1', 'Wordpress Developer'),
(155, 'karamat', 'karamatali1@gmail.com', '2023-12-05 01:27:24', '$2y$10$NWmgNQnJofgX415oSXVXz.Mry0.vWgegeQ3DLw3luqH6ZfOI.vBvq', NULL, '2023-12-05 01:27:24', '2023-12-05 01:27:24', NULL, NULL, NULL, '1', 'CF'),
(156, 'Awais', 'awaisali2@gmail.com', '2023-12-05 01:28:23', '$2y$10$nqiA7zTpjtRfobA/xG08gecHj7KdVau9YxUHSjn8G7Cmt/qonjlsS', NULL, '2023-12-05 01:28:23', '2023-12-05 01:28:23', NULL, NULL, NULL, '1', 'UI designer');

-- --------------------------------------------------------

--
-- Table structure for table `value_stream`
--

CREATE TABLE `value_stream` (
  `id` int(11) NOT NULL,
  `value_name` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `unit_id` varchar(255) DEFAULT NULL,
  `detail` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'stream',
  `user_id` varchar(255) DEFAULT NULL,
  `trash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `value_stream`
--

INSERT INTO `value_stream` (`id`, `value_name`, `org_id`, `lead_id`, `unit_id`, `detail`, `created_at`, `slug`, `type`, `user_id`, `trash`) VALUES
(33, 'VS1', NULL, '59', '46', NULL, '2023-11-30 17:01:12', 'vs1-71', 'stream', '126', NULL),
(34, 'Customer Engagement', NULL, '72', '48', NULL, '2023-12-01 06:13:23', 'customer-engagement-51', 'stream', '140', NULL),
(35, 'Operational Efficiency', NULL, '72', '48', NULL, '2023-12-01 06:13:51', 'operational-efficiency-34', 'stream', '140', NULL),
(36, 'Threat Detection and Response', NULL, '73', '49', NULL, '2023-12-01 06:14:22', 'threat-detection-and-response-42', 'stream', '140', NULL),
(37, 'Compliance and Governance', NULL, '74', '49', NULL, '2023-12-01 06:14:39', 'compliance-and-governance-51', 'stream', '140', NULL),
(40, 'Value stream', NULL, '77', '51', NULL, '2023-12-04 20:01:59', 'value-stream-53', 'stream', '153', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `value_team`
--

CREATE TABLE `value_team` (
  `id` int(11) NOT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `member` varchar(255) DEFAULT NULL,
  `team_title` varchar(255) DEFAULT NULL,
  `lead_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'VS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `value_team`
--

INSERT INTO `value_team` (`id`, `org_id`, `member`, `team_title`, `lead_id`, `created_at`, `slug`, `type`) VALUES
(26, '32', '59,60,61', 'Value Stream Team', '60', '2023-11-30 05:51:38', 'value-stream-team-57', 'VS'),
(27, '33', '59,60,61', 'Team 1', '59', '2023-11-30 17:14:58', 'team-1-86', 'VS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backlog`
--
ALTER TABLE `backlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backlog_unit`
--
ALTER TABLE `backlog_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_units`
--
ALTER TABLE `business_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_data`
--
ALTER TABLE `chart_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epics`
--
ALTER TABLE `epics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epics_stroy`
--
ALTER TABLE `epics_stroy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epic_comment`
--
ALTER TABLE `epic_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epic_comment_reply`
--
ALTER TABLE `epic_comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escalate_cards`
--
ALTER TABLE `escalate_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flag_id` (`flag_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_units` (`business_units`);

--
-- Indexes for table `flag_comments`
--
ALTER TABLE `flag_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flag_id` (`flag_id`);

--
-- Indexes for table `initiative`
--
ALTER TABLE `initiative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jira_data`
--
ALTER TABLE `jira_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jira_project`
--
ALTER TABLE `jira_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jira_setting`
--
ALTER TABLE `jira_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_chart`
--
ALTER TABLE `key_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_quarter_value`
--
ALTER TABLE `key_quarter_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `key_result`
--
ALTER TABLE `key_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_setting`
--
ALTER TABLE `kpi_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objectives`
--
ALTER TABLE `objectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_contacts`
--
ALTER TABLE `organization_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarter`
--
ALTER TABLE `quarter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarter_month`
--
ALTER TABLE `quarter_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sprint_report`
--
ALTER TABLE `sprint_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_backlog`
--
ALTER TABLE `team_backlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_team`
--
ALTER TABLE `unit_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_stream`
--
ALTER TABLE `value_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_team`
--
ALTER TABLE `value_team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backlog`
--
ALTER TABLE `backlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backlog_unit`
--
ALTER TABLE `backlog_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `business_units`
--
ALTER TABLE `business_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `chart_data`
--
ALTER TABLE `chart_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epics`
--
ALTER TABLE `epics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `epics_stroy`
--
ALTER TABLE `epics_stroy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `epic_comment`
--
ALTER TABLE `epic_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `epic_comment_reply`
--
ALTER TABLE `epic_comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `escalate_cards`
--
ALTER TABLE `escalate_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `flag_comments`
--
ALTER TABLE `flag_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `initiative`
--
ALTER TABLE `initiative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `jira_data`
--
ALTER TABLE `jira_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jira_project`
--
ALTER TABLE `jira_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jira_setting`
--
ALTER TABLE `jira_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `key_chart`
--
ALTER TABLE `key_chart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `key_quarter_value`
--
ALTER TABLE `key_quarter_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `key_result`
--
ALTER TABLE `key_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `kpi_setting`
--
ALTER TABLE `kpi_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `objectives`
--
ALTER TABLE `objectives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `organization_contacts`
--
ALTER TABLE `organization_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quarter`
--
ALTER TABLE `quarter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT for table `quarter_month`
--
ALTER TABLE `quarter_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2741;

--
-- AUTO_INCREMENT for table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `sprint_report`
--
ALTER TABLE `sprint_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_backlog`
--
ALTER TABLE `team_backlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_team`
--
ALTER TABLE `unit_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `value_stream`
--
ALTER TABLE `value_stream`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `value_team`
--
ALTER TABLE `value_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `escalate_cards`
--
ALTER TABLE `escalate_cards`
  ADD CONSTRAINT `escalate_cards_ibfk_1` FOREIGN KEY (`flag_id`) REFERENCES `flags` (`id`);

--
-- Constraints for table `flag_comments`
--
ALTER TABLE `flag_comments`
  ADD CONSTRAINT `flag_comments_ibfk_1` FOREIGN KEY (`flag_id`) REFERENCES `flags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
