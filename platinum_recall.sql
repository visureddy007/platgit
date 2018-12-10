-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 02:55 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platinum_recall`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_pass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `user_pass`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `ans_scheduling_spec`
--

CREATE TABLE `ans_scheduling_spec` (
  `spec_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `Procedures_Services` text NOT NULL,
  `Treatment` text NOT NULL,
  `Emergency` text NOT NULL,
  `Pricing_Promotions` text NOT NULL,
  `Cancellation_Procedure` text NOT NULL,
  `Reschedule_Procedure` text NOT NULL,
  `Scripting` text NOT NULL,
  `New_Patient` text NOT NULL,
  `Pharmacy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ans_scheduling_spec`
--

INSERT INTO `ans_scheduling_spec` (`spec_id`, `doc_id`, `Procedures_Services`, `Treatment`, `Emergency`, `Pricing_Promotions`, `Cancellation_Procedure`, `Reschedule_Procedure`, `Scripting`, `New_Patient`, `Pharmacy`) VALUES
(1, 1, 'test', 'test', 'test', 'test', 'test', '', '<p>test</p>', '<p>test</p>', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `booking_date` varchar(225) NOT NULL,
  `slot_time` varchar(225) NOT NULL,
  `slot_dutation` varchar(225) NOT NULL,
  `booking_status` enum('PENDING','DONE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `break_punches`
--

CREATE TABLE `break_punches` (
  `bp_id` int(10) NOT NULL,
  `tc_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `break_type` enum('Work Related','Non-Work Related') NOT NULL,
  `break_in_date` date NOT NULL,
  `time_in` time NOT NULL,
  `break_out_date` date NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_log`
--

CREATE TABLE `call_log` (
  `cl_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `call_result` varchar(225) NOT NULL,
  `requires_attention` enum('Yes','No') NOT NULL DEFAULT 'No',
  `patient_response` varchar(225) NOT NULL,
  `notes` text NOT NULL,
  `reason_for_leave` varchar(225) NOT NULL,
  `appt_date` varchar(50) NOT NULL,
  `appt_time` varchar(50) NOT NULL,
  `adults` varchar(225) NOT NULL,
  `children` varchar(225) NOT NULL,
  `cl_created_on` datetime NOT NULL,
  `resolved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `resolved_by` int(10) NOT NULL,
  `resolved_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_log`
--

INSERT INTO `call_log` (`cl_id`, `emp_id`, `doc_id`, `first_name`, `last_name`, `call_result`, `requires_attention`, `patient_response`, `notes`, `reason_for_leave`, `appt_date`, `appt_time`, `adults`, `children`, `cl_created_on`, `resolved`, `resolved_by`, `resolved_datetime`) VALUES
(1, 0, 1, 'Jack', 'S', 'Contact', '', 'Schedule Appointment', 'this is test run ', '', '2018-08-15', '1:00 PM', '1', '0', '2018-08-15 05:39:43', 'Yes', 0, '0000-00-00 00:00:00'),
(2, 0, 1, 'Mickel', 'J', 'Contact', '', 'Discontinued Services', 'this is demo run ', 'Emergency only', '0000-00-00', '', '1', '0', '2018-08-15 05:40:18', 'Yes', 0, '0000-00-00 00:00:00'),
(3, 0, 1, 'Sam', 'K', 'Contact', '', 'Schedule Appointment', 'this is demo run ', '', '2018-08-15', '11:15 AM', '1', '0', '2018-08-15 05:41:30', 'Yes', 0, '0000-00-00 00:00:00'),
(4, 0, 1, 'Testing', 'Tester ', 'Contact', '', 'PR Call back', 'test test ', '', '0000-00-00', '', '', '', '2018-08-22 16:48:43', 'Yes', 0, '0000-00-00 00:00:00'),
(5, 0, 1, 'test', 'testt', 'Contact', '', 'Schedule Appointment', 'NA ', '', '2018-08-22', '11:45 AM', '1', '0', '2018-08-22 17:46:14', 'Yes', 0, '0000-00-00 00:00:00'),
(6, 0, 1, 'Testing', 'testt', 'Contact', '', 'Schedule Appointment', 'na ', '', '2018-08-25', '12:00 PM', '2', '3', '2018-08-22 17:51:51', 'Yes', 0, '0000-00-00 00:00:00'),
(7, 0, 1, 'Jim', 'mike', 'Contact', '', 'Schedule Appointment', 'na', '', '2018-09-04', '10:00 AM', '1', '0', '2018-09-04 03:25:22', 'Yes', 0, '0000-00-00 00:00:00'),
(8, 0, 1, 'mike', 'L', 'No Answer', '', '', '', '', '0000-00-00', '', '', '', '2018-09-04 03:27:32', 'Yes', 0, '0000-00-00 00:00:00'),
(9, 0, 1, 'vishnu', 'J', 'Contact', '', 'Schedule Appointment', 'demo run ', '', '2018-09-17', '12:30 PM', '1', '0', '2018-09-17 06:41:12', 'Yes', 0, '0000-00-00 00:00:00'),
(10, 0, 1, 'vishnu', 'L', 'Contact', '', 'Schedule Appointment', 'demo ', '', '2018-09-17', '1:00 PM', '1', '0', '2018-09-17 06:41:55', 'Yes', 0, '0000-00-00 00:00:00'),
(11, 2, 1, 'vishnu', 'Reddy', 'Contact', '', 'Schedule Appointment', 'demo run ', '', '2018-10-01', '3:30 PM', '1', '0', '2018-10-01 09:37:40', 'Yes', 2, '2018-10-01 10:56:26'),
(13, 2, 1, 'Sam', 'Jack', 'Contact', '', 'Schedule Appointment', 'demo', '', '2018-10-01', '5:15 PM', '1', '0', '2018-10-01 11:18:43', 'Yes', 0, '0000-00-00 00:00:00'),
(14, 2, 1, 'Sam', 'K', 'Contact', 'Yes', 'Schedule Appointment', 'Demo notes', '', '2018-10-01', '5:30 PM', '1', '0', '2018-10-01 11:22:18', 'Yes', 2, '2018-10-01 11:32:18'),
(15, 0, 1, 'Ttest', 'Ttest', 'Contact', 'No', 'Schedule Appointment', '*PR', '', '2018-11-03', '4:45 PM', '3', ' 1', '2018-10-24 22:45:31', 'No', 0, '0000-00-00 00:00:00'),
(16, 2, 1, 'John', 'Smith', 'No Answer', 'No', 'Schedule Appointment', '', '', '0000-00-00', '8:00 PM', '', '', '2018-10-25 01:51:48', 'No', 0, '0000-00-00 00:00:00'),
(17, 0, 1, 'vishnu', 'L', 'Contact', 'Yes', 'Schedule Appointment', '', '', '0000-00-00', '2:00 PM', '2', '', '2018-10-26 10:27:43', 'No', 0, '0000-00-00 00:00:00'),
(18, 0, 1, 'vishnu', 'Reddy', 'Contact', 'No', 'Schedule Appointment', '', '', '10-26-2018 ', '3:00 PM', '1', '', '2018-10-26 10:28:37', 'No', 0, '0000-00-00 00:00:00'),
(19, 0, 1, 'vishnu', 'Reddy', 'Contact', 'No', 'Schedule Appointment', '', '', '70707070-0101-0101', '2:30 PM', '1', '', '2018-10-26 10:37:51', 'No', 0, '0000-00-00 00:00:00'),
(20, 0, 1, 'vishnu', 'Reddy', 'Contact', 'Yes', 'Schedule Appointment', '', 'Not Leaving', '1970-01-01', '2:15 PM', '1', '', '2018-10-26 10:39:03', 'No', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doc_id` int(10) NOT NULL,
  `doc_username` varchar(225) NOT NULL,
  `doc_email` varchar(225) NOT NULL,
  `doc_password` varchar(225) NOT NULL,
  `doc_firstname` varchar(225) NOT NULL,
  `doc_lastname` varchar(225) NOT NULL,
  `doc_add1` varchar(225) NOT NULL,
  `doc_add2` varchar(225) NOT NULL,
  `state_id` int(10) NOT NULL,
  `zip` varchar(225) NOT NULL,
  `city` varchar(225) NOT NULL,
  `doc_phone` varchar(225) NOT NULL,
  `doc_timezone` varchar(225) NOT NULL,
  `doc_office_name` varchar(225) NOT NULL,
  `doc_goal_no` varchar(225) NOT NULL,
  `doc_can_excgoal` enum('yes','no') NOT NULL DEFAULT 'no',
  `doc_monthly_fee` varchar(225) NOT NULL,
  `doc_status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doc_id`, `doc_username`, `doc_email`, `doc_password`, `doc_firstname`, `doc_lastname`, `doc_add1`, `doc_add2`, `state_id`, `zip`, `city`, `doc_phone`, `doc_timezone`, `doc_office_name`, `doc_goal_no`, `doc_can_excgoal`, `doc_monthly_fee`, `doc_status`, `created_on`) VALUES
(1, 'test1', 'testoffice@test.com', '123456', '', '', '100-2/A', 'salt lake city', 52, '84101', 'US', '9876543210', '10', 'Test Office', '100', 'yes', '100', 1, '2018-08-09 16:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `doc_assign_emp`
--

CREATE TABLE `doc_assign_emp` (
  `id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `assn_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_assign_emp`
--

INSERT INTO `doc_assign_emp` (`id`, `emp_id`, `doc_id`, `assn_date`) VALUES
(2, 2, 1, '2018-08-09'),
(4, 3, 1, '2018-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `doc_schedule`
--

CREATE TABLE `doc_schedule` (
  `id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `day` varchar(225) NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doc_sech_spec`
--

CREATE TABLE `doc_sech_spec` (
  `spec_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `ofc_name` text NOT NULL,
  `doc_names` text NOT NULL,
  `pro_spe_hrs` text NOT NULL,
  `hyg_hrs` text NOT NULL,
  `ofc_hrs` text NOT NULL,
  `ins_acc` text NOT NULL,
  `ins_not_acc` text NOT NULL,
  `adult_sche` text NOT NULL,
  `child_sche` text NOT NULL,
  `per_sche` text NOT NULL,
  `pat_sche` text NOT NULL,
  `oper` text NOT NULL,
  `sche_det` text NOT NULL,
  `pat_inactv` text NOT NULL,
  `notes_comm` text NOT NULL,
  `scrip` text NOT NULL,
  `canc_poli` text NOT NULL,
  `pric_det` text NOT NULL,
  `ofc_remi` text NOT NULL,
  `balances` text NOT NULL,
  `schd_doc` text NOT NULL,
  `comp_acc_times` text NOT NULL,
  `comp_acc_logins` text NOT NULL,
  `loc_dire` text NOT NULL,
  `address` text NOT NULL,
  `phn_num` text NOT NULL,
  `fax` text NOT NULL,
  `ofc_mand_name` text NOT NULL,
  `ofc_mang_num` text NOT NULL,
  `email` text NOT NULL,
  `emergency` text NOT NULL,
  `Procedures_Services` text NOT NULL,
  `Treatment` text NOT NULL,
  `Pricing_Promotions` text NOT NULL,
  `Cancellation_Procedure` text NOT NULL,
  `Reschedule_Procedure` text NOT NULL,
  `Scripting` text NOT NULL,
  `New_Patient` text NOT NULL,
  `Pharmacy` text NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_sech_spec`
--

INSERT INTO `doc_sech_spec` (`spec_id`, `doc_id`, `ofc_name`, `doc_names`, `pro_spe_hrs`, `hyg_hrs`, `ofc_hrs`, `ins_acc`, `ins_not_acc`, `adult_sche`, `child_sche`, `per_sche`, `pat_sche`, `oper`, `sche_det`, `pat_inactv`, `notes_comm`, `scrip`, `canc_poli`, `pric_det`, `ofc_remi`, `balances`, `schd_doc`, `comp_acc_times`, `comp_acc_logins`, `loc_dire`, `address`, `phn_num`, `fax`, `ofc_mand_name`, `ofc_mang_num`, `email`, `emergency`, `Procedures_Services`, `Treatment`, `Pricing_Promotions`, `Cancellation_Procedure`, `Reschedule_Procedure`, `Scripting`, `New_Patient`, `Pharmacy`, `created_on`) VALUES
(1, 1, 'Test office', 'Test doctor', 'Mon-Fri 9AM to 6PM', 'Mon-Fri 9AM to 2PM', 'Mon-Fri 9AM to 6PM', 'Blue Shield', 'N/A', '30 min', '20 min', '10 min', '1 hour', 'N/A', 'Book slots', 'N/A', 'Take notes', 'script goes here', 'cancellation policy goes here', '100 USD', 'office reminders goes here', 'N/A', 'appointment booking', 'Mon-Fri 9AM to 9PM', 'test@test.com\r\n123456', 'Salt lake city', '100-2-3', '9876543210', '9898989898', 'John', '9876987698', 'john@test.com', '7897897890', 'demo', 'demo', 'demo', 'demo', '', '<p>demo</p>', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `user_type` enum('ADMIN','EMPLOYEE') DEFAULT 'EMPLOYEE',
  `emp_username` varchar(225) NOT NULL,
  `emp_email` varchar(225) NOT NULL,
  `emp_password` varchar(225) NOT NULL,
  `emp_firstname` varchar(225) NOT NULL,
  `emp_lastname` varchar(225) NOT NULL,
  `emp_add1` varchar(225) NOT NULL,
  `emp_add2` varchar(225) NOT NULL,
  `state_id` int(10) NOT NULL,
  `zip` varchar(225) NOT NULL,
  `city` varchar(225) NOT NULL,
  `emp_phone` varchar(225) NOT NULL,
  `emp_timezone` int(10) NOT NULL,
  `emp_role` enum('Employee','Manager','Administrator','') NOT NULL,
  `emp_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `user_type`, `emp_username`, `emp_email`, `emp_password`, `emp_firstname`, `emp_lastname`, `emp_add1`, `emp_add2`, `state_id`, `zip`, `city`, `emp_phone`, `emp_timezone`, `emp_role`, `emp_status`, `created_on`) VALUES
(0, 'ADMIN', 'Admin', 'Admin', '123', 'admin', '', '', '', 0, '', '', '', 0, '', 1, '0000-00-00 00:00:00'),
(2, 'EMPLOYEE', 'testemp1', 'testemp1@test.com', '123456', 'Test', 'Emp1', '100-2-3-0', 'salt lake city', 52, '84101', 'salt lake city', '1234567890', 10, 'Employee', 1, '2018-08-09 16:19:19'),
(3, 'EMPLOYEE', 'testemp2', 'visureddy16@gmail.com', '123456', 'Test 2', 'User 2 ', '5814 Marietta Station Dr.', 'Demo run', 25, '20769', 'Glenn Dale,', '9886996969', 13, 'Employee', 1, '2018-11-26 05:33:06'),
(4, 'EMPLOYEE', 'testemp3', 'info@dollarstaffing.com', '123456', 'testemp3', 'Demo 3 ', '5814 Marietta Station Dr.', 'test run 3 ', 25, '20769', 'Glenn Dale,', '972284448', 14, 'Employee', 1, '2018-11-26 11:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(10) NOT NULL,
  `msg_default` text NOT NULL,
  `msg_doctor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `msg_default`, `msg_doctor`) VALUES
(1, '<p>-------------------------------------------------------------------------------------------------------------------------------------</p><div><p><strong>Employee Referral:</strong> Platinum Recall is growing and we are looking to hire more talented team members just like you!  If you refer someone to work at our company and they stay with us for at least 2 months you will receive a $50 bonus! Don\'t be afraid to send them our way, just have them email a resume to me and follow up if you don\'t hear anything.</p></div><p> </p>', '<p>Thank you for coming to our website to view your month-end reports. We have created these reports to give important feedback on our recall progress and to provide a summary of your inactive patients.</p><p><br></p><p>We really enjoy working with your patients and interacting with you and your staff. We hope these reports prove valuable to you as you evaluate your practice and your hygiene department. Please let us know if you have any questions or concerns.</p><p><br></p><p>We appreciate your business,</p><p>Platinum Recall<br>1-800-900-2012</p><p><br></p><p>We would love to connect with you on facebook: <a href=\"http://www.facebook.com/platinumrecall\" data-cke-saved-href=\"http://www.facebook.com/platinumrecall\" data-mce-href=\"http://www.facebook.com/platinumrecall\">http://www.facebook.com/platinumrecall</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `scheduling_spec`
--

CREATE TABLE `scheduling_spec` (
  `spec_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `pro_names` text NOT NULL,
  `doc_sche` text NOT NULL,
  `hyg_sche` text NOT NULL,
  `insurance_prov` text NOT NULL,
  `adu_chi_age` text NOT NULL,
  `adu_chi_time` text NOT NULL,
  `pat_time` text NOT NULL,
  `sch_det` text NOT NULL,
  `buzz_word` text NOT NULL,
  `perio_sch` text NOT NULL,
  `do_you_word` text NOT NULL,
  `do_we_call` text NOT NULL,
  `how_do_you_ans` text NOT NULL,
  `bmx` text NOT NULL,
  `pat_notes` text NOT NULL,
  `initials_appts` text NOT NULL,
  `resetting_recall` text NOT NULL,
  `passwords` text NOT NULL,
  `treat_appt` text NOT NULL,
  `other_sche_det` text NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `abbrev`) VALUES
(1, 'Alaska', 'AK'),
(2, 'Alabama', 'AL'),
(3, 'American Samoa', 'AS'),
(4, 'Arizona', 'AZ'),
(5, 'Arkansas', 'AR'),
(6, 'California', 'CA'),
(7, 'Colorado', 'CO'),
(8, 'Connecticut', 'CT'),
(9, 'Delaware', 'DE'),
(10, 'District of Columbia', 'DC'),
(11, 'Federated States of Micronesia', 'FM'),
(12, 'Florida', 'FL'),
(13, 'Georgia', 'GA'),
(14, 'Guam', 'GU'),
(15, 'Hawaii', 'HI'),
(16, 'Idaho', 'ID'),
(17, 'Illinois', 'IL'),
(18, 'Indiana', 'IN'),
(19, 'Iowa', 'IA'),
(20, 'Kansas', 'KS'),
(21, 'Kentucky', 'KY'),
(22, 'Louisiana', 'LA'),
(23, 'Maine', 'ME'),
(24, 'Marshall Islands', 'MH'),
(25, 'Maryland', 'MD'),
(26, 'Massachusetts', 'MA'),
(27, 'Michigan', 'MI'),
(28, 'Minnesota', 'MN'),
(29, 'Mississippi', 'MS'),
(30, 'Missouri', 'MO'),
(31, 'Montana', 'MT'),
(32, 'Nebraska', 'NE'),
(33, 'Nevada', 'NV'),
(34, 'New Hampshire', 'NH'),
(35, 'New Jersey', 'NJ'),
(36, 'New Mexico', 'NM'),
(37, 'New York', 'NY'),
(38, 'North Carolina', 'NC'),
(39, 'North Dakota', 'ND'),
(40, 'Northern Mariana Islands', 'MP'),
(41, 'Ohio', 'OH'),
(42, 'Oklahoma', 'OK'),
(43, 'Oregon', 'OR'),
(44, 'Palau', 'PW'),
(45, 'Pennsylvania', 'PA'),
(46, 'Puerto Rico', 'PR'),
(47, 'Rhode Island', 'RI'),
(48, 'South Carolina', 'SC'),
(49, 'South Dakota', 'SD'),
(50, 'Tennessee', 'TN'),
(51, 'Texas', 'TX'),
(52, 'Utah', 'UT'),
(53, 'Vermont', 'VT'),
(54, 'Virgin Islands', 'VI'),
(55, 'Virginia', 'VA'),
(56, 'Washington', 'WA'),
(57, 'West Virginia', 'WV'),
(58, 'Wisconsin', 'WI'),
(59, 'Wyoming', 'WY'),
(60, 'Armed Forces Africa', 'AE'),
(61, 'Armed Forces Americas (except Canada)', 'AA'),
(62, 'Armed Forces Canada', 'AE'),
(63, 'Armed Forces Europe', 'AE'),
(64, 'Armed Forces Middle East', 'AE'),
(65, 'Armed Forces Pacific', 'AP');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(10) NOT NULL,
  `team_name` varchar(225) NOT NULL,
  `team_lead` varchar(225) NOT NULL,
  `team_members` varchar(225) NOT NULL,
  `team_status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_lead`, `team_members`, `team_status`, `created_on`) VALUES
(1, 'Platinum Recall', '4', '4', 1, '2018-08-10 21:28:45'),
(2, 'Demo Team', '2', '2,3', 1, '2018-11-26 05:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(10) NOT NULL,
  `timezone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `timezone`) VALUES
(1, '(UTC-12:00) International Date Line West'),
(2, '(UTC-11:00) Coordinated Universal Time-11'),
(3, '(UTC-10:00) Aleutian Islands'),
(4, '(UTC-10:00) Hawaii'),
(5, '(UTC-09:30) Marquesas Islands'),
(6, '(UTC-09:00) Alaska'),
(7, '(UTC-09:00) Coordinated Universal Time-09'),
(8, '(UTC-08:00) Baja California'),
(9, '(UTC-08:00) Coordinated Universal Time-08'),
(10, '(UTC-08:00) Pacific Time (US &amp; Canada)'),
(11, '(UTC-07:00) Arizona'),
(12, '(UTC-07:00) Chihuahua, La Paz, Mazatlan'),
(13, '(UTC-07:00) Mountain Time (US &amp; Canada)'),
(14, '(UTC-06:00) Central America'),
(15, '(UTC-06:00) Central Time (US &amp; Canada)'),
(16, '(UTC-06:00) Easter Island'),
(17, '(UTC-06:00) Guadalajara, Mexico City, Monterrey'),
(18, '(UTC-06:00) Saskatchewan'),
(19, '(UTC-05:00) Bogota, Lima, Quito, Rio Branco'),
(20, '(UTC-05:00) Chetumal'),
(21, '(UTC-05:00) Eastern Time (US &amp; Canada)'),
(22, '(UTC-05:00) Haiti'),
(23, '(UTC-05:00) Havana'),
(24, '(UTC-05:00) Indiana (East)'),
(25, '(UTC-04:00) Asuncion'),
(26, '(UTC-04:00) Atlantic Time (Canada)'),
(27, '(UTC-04:00) Caracas'),
(28, '(UTC-04:00) Cuiaba'),
(29, '(UTC-04:00) Georgetown, La Paz, Manaus, San Juan'),
(30, '(UTC-04:00) Santiago'),
(31, '(UTC-04:00) Turks and Caicos'),
(32, '(UTC-03:30) Newfoundland'),
(33, '(UTC-03:00) Araguaina'),
(34, '(UTC-03:00) Brasilia'),
(35, '(UTC-03:00) Cayenne, Fortaleza'),
(36, '(UTC-03:00) City of Buenos Aires'),
(37, '(UTC-03:00) Greenland'),
(38, '(UTC-03:00) Montevideo'),
(39, '(UTC-03:00) Punta Arenas'),
(40, '(UTC-03:00) Saint Pierre and Miquelon'),
(41, '(UTC-03:00) Salvador'),
(42, '(UTC-02:00) Coordinated Universal Time-02'),
(43, '(UTC-02:00) Mid-Atlantic - Old'),
(44, '(UTC-01:00) Azores'),
(45, '(UTC-01:00) Cabo Verde Is.'),
(46, '(UTC) Coordinated Universal Time'),
(47, '(UTC+00:00) Casablanca'),
(48, '(UTC+00:00) Dublin, Edinburgh, Lisbon, London'),
(49, '(UTC+00:00) Monrovia, Reykjavik'),
(50, '(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna'),
(51, '(UTC+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague'),
(52, '(UTC+01:00) Brussels, Copenhagen, Madrid, Paris'),
(53, '(UTC+01:00) Sarajevo, Skopje, Warsaw, Zagreb'),
(54, '(UTC+01:00) West Central Africa'),
(55, '(UTC+01:00) Windhoek'),
(56, '(UTC+02:00) Amman'),
(57, '(UTC+02:00) Athens, Bucharest'),
(58, '(UTC+02:00) Beirut'),
(59, '(UTC+02:00) Cairo'),
(60, '(UTC+02:00) Chisinau'),
(61, '(UTC+02:00) Damascus'),
(62, '(UTC+02:00) Gaza, Hebron'),
(63, '(UTC+02:00) Harare, Pretoria'),
(64, '(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius'),
(65, '(UTC+02:00) Jerusalem'),
(66, '(UTC+02:00) Kaliningrad'),
(67, '(UTC+02:00) Tripoli'),
(68, '(UTC+03:00) Baghdad'),
(69, '(UTC+03:00) Istanbul'),
(70, '(UTC+03:00) Kuwait, Riyadh'),
(71, '(UTC+03:00) Minsk'),
(72, '(UTC+03:00) Moscow, St. Petersburg, Volgograd'),
(73, '(UTC+03:00) Nairobi'),
(74, '(UTC+03:30) Tehran'),
(75, '(UTC+04:00) Abu Dhabi, Muscat'),
(76, '(UTC+04:00) Astrakhan, Ulyanovsk'),
(77, '(UTC+04:00) Baku'),
(78, '(UTC+04:00) Izhevsk, Samara'),
(79, '(UTC+04:00) Port Louis'),
(80, '(UTC+04:00) Saratov'),
(81, '(UTC+04:00) Tbilisi'),
(82, '(UTC+04:00) Yerevan'),
(83, '(UTC+04:30) Kabul'),
(84, '(UTC+05:00) Ashgabat, Tashkent'),
(85, '(UTC+05:00) Ekaterinburg'),
(86, '(UTC+05:00) Islamabad, Karachi'),
(87, '(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi'),
(88, '(UTC+05:30) Sri Jayawardenepura'),
(89, '(UTC+05:45) Kathmandu'),
(90, '(UTC+06:00) Astana'),
(91, '(UTC+06:00) Dhaka'),
(92, '(UTC+06:00) Omsk'),
(93, '(UTC+06:30) Yangon (Rangoon)'),
(94, '(UTC+07:00) Bangkok, Hanoi, Jakarta'),
(95, '(UTC+07:00) Barnaul, Gorno-Altaysk'),
(96, '(UTC+07:00) Hovd'),
(97, '(UTC+07:00) Krasnoyarsk'),
(98, '(UTC+07:00) Novosibirsk'),
(99, '(UTC+07:00) Tomsk'),
(100, '(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi'),
(101, '(UTC+08:00) Irkutsk'),
(102, '(UTC+08:00) Kuala Lumpur, Singapore'),
(103, '(UTC+08:00) Perth'),
(104, '(UTC+08:00) Taipei'),
(105, '(UTC+08:00) Ulaanbaatar'),
(106, '(UTC+08:30) Pyongyang'),
(107, '(UTC+08:45) Eucla'),
(108, '(UTC+09:00) Chita'),
(109, '(UTC+09:00) Osaka, Sapporo, Tokyo'),
(110, '(UTC+09:00) Seoul'),
(111, '(UTC+09:00) Yakutsk'),
(112, '(UTC+09:30) Adelaide'),
(113, '(UTC+09:30) Darwin'),
(114, '(UTC+10:00) Brisbane'),
(115, '(UTC+10:00) Canberra, Melbourne, Sydney'),
(116, '(UTC+10:00) Guam, Port Moresby'),
(117, '(UTC+10:00) Hobart'),
(118, '(UTC+10:00) Vladivostok'),
(119, '(UTC+10:30) Lord Howe Island'),
(120, '(UTC+11:00) Bougainville Island'),
(121, '(UTC+11:00) Chokurdakh'),
(122, '(UTC+11:00) Magadan'),
(123, '(UTC+11:00) Norfolk Island'),
(124, '(UTC+11:00) Sakhalin'),
(125, '(UTC+11:00) Solomon Is., New Caledonia'),
(126, '(UTC+12:00) Anadyr, Petropavlovsk-Kamchatsky'),
(127, '(UTC+12:00) Auckland, Wellington'),
(128, '(UTC+12:00) Coordinated Universal Time+12'),
(129, '(UTC+12:00) Fiji'),
(130, '(UTC+12:00) Petropavlovsk-Kamchatsky - Old'),
(131, '(UTC+12:45) Chatham Islands'),
(132, '(UTC+13:00) Coordinated Universal Time+13'),
(133, '(UTC+13:00) Nuku&#39;alofa'),
(134, '(UTC+13:00) Samoa'),
(135, '(UTC+14:00) Kiritimati Island');

-- --------------------------------------------------------

--
-- Table structure for table `time_clock`
--

CREATE TABLE `time_clock` (
  `tc_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `time_in` time NOT NULL,
  `time_in_date` date NOT NULL,
  `time_out` time NOT NULL,
  `time_out_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_clock`
--

INSERT INTO `time_clock` (`tc_id`, `emp_id`, `time_in`, `time_in_date`, `time_out`, `time_out_date`) VALUES
(2, 0, '15:29:00', '2018-08-10', '15:30:00', '2018-08-10'),
(3, 2, '17:00:00', '2018-08-02', '19:45:00', '2018-08-02'),
(4, 2, '09:00:00', '2018-09-03', '14:00:00', '2018-09-03'),
(5, 0, '14:25:00', '2018-10-26', '14:26:00', '2018-10-26'),
(6, 0, '14:39:00', '2018-10-26', '14:39:00', '2018-10-26'),
(7, 0, '14:39:00', '2018-10-26', '14:39:00', '2018-10-26'),
(8, 0, '14:39:00', '2018-10-26', '14:39:00', '2018-10-26'),
(9, 0, '10:38:00', '2018-11-12', '10:44:00', '2018-11-12'),
(10, 0, '10:44:00', '2018-11-12', '11:58:00', '2018-11-12'),
(11, 0, '11:58:00', '2018-11-12', '11:58:00', '2018-11-12'),
(12, 0, '12:01:00', '2018-11-12', '12:01:00', '2018-11-12'),
(13, 0, '12:01:00', '2018-11-12', '12:01:00', '2018-11-12'),
(14, 0, '12:01:00', '2018-11-12', '00:00:00', '0000-00-00'),
(15, 0, '15:43:00', '2018-11-15', '00:00:00', '0000-00-00'),
(16, 2, '11:13:00', '2018-11-26', '11:13:00', '2018-11-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ans_scheduling_spec`
--
ALTER TABLE `ans_scheduling_spec`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `break_punches`
--
ALTER TABLE `break_punches`
  ADD PRIMARY KEY (`bp_id`);

--
-- Indexes for table `call_log`
--
ALTER TABLE `call_log`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `doc_assign_emp`
--
ALTER TABLE `doc_assign_emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_schedule`
--
ALTER TABLE `doc_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_sech_spec`
--
ALTER TABLE `doc_sech_spec`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `scheduling_spec`
--
ALTER TABLE `scheduling_spec`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_clock`
--
ALTER TABLE `time_clock`
  ADD PRIMARY KEY (`tc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ans_scheduling_spec`
--
ALTER TABLE `ans_scheduling_spec`
  MODIFY `spec_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `break_punches`
--
ALTER TABLE `break_punches`
  MODIFY `bp_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_log`
--
ALTER TABLE `call_log`
  MODIFY `cl_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doc_assign_emp`
--
ALTER TABLE `doc_assign_emp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doc_schedule`
--
ALTER TABLE `doc_schedule`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_sech_spec`
--
ALTER TABLE `doc_sech_spec`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scheduling_spec`
--
ALTER TABLE `scheduling_spec`
  MODIFY `spec_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `time_clock`
--
ALTER TABLE `time_clock`
  MODIFY `tc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
