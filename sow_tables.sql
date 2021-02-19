-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2019 at 11:55 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sow`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `type`) VALUES
(1, 'Onshore'),
(2, 'Offshore');

-- --------------------------------------------------------

--
-- Table structure for table `manager_type`
--

CREATE TABLE `manager_type` (
  `id` int(11) NOT NULL,
  `type` enum('customer','supplier') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `manager_type`
--

INSERT INTO `manager_type` (`id`, `type`, `name`, `status`) VALUES
(1, 'customer', 'Graham Fisher', 'Active'),
(2, 'customer', 'Sim Suri Maun', 'Active'),
(3, 'customer', 'Alison Donelan', 'Active'),
(4, 'customer', 'Tony Simmonds', 'Active'),
(5, 'customer', 'Gary Batten', 'Active'),
(6, 'customer', 'Debbie Goulding', 'Active'),
(7, 'supplier', 'R. Ashok Kumar', 'Active'),
(8, 'supplier', 'Karan Vig', 'Active'),
(9, 'supplier', 'Harish Kohli', 'Active'),
(10, 'supplier', 'Anjali Satam', 'Active'),
(11, 'supplier', 'Manoranjan Das', 'Active'),
(12, 'supplier', 'Santosh Dalvi', 'Active'),
(13, 'supplier', 'Viki Lingeria', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `personal_data_type`
--

CREATE TABLE `personal_data_type` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_data_type`
--

INSERT INTO `personal_data_type` (`id`, `content`) VALUES
(1, '<p><strong>Contact Details </strong>(e.g. contact details, name, email address, job titles, work history)</p>'),
(2, '<p><strong>Financial</strong> (e.g. payment card data, bank account details)</p>'),
(3, '<p><strong>Demographic</strong> (e.g. age, date of birth, gender, income brackets)</p>');

-- --------------------------------------------------------

--
-- Table structure for table `procuring_party`
--

CREATE TABLE `procuring_party` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `procuring_party`
--

INSERT INTO `procuring_party` (`id`, `name`, `status`) VALUES
(1, 'Bupa UK - UKMU', 'Active'),
(2, 'Bupa UK - BGMU', 'Active'),
(3, 'Bupa Australia', 'Active'),
(4, 'Bupa PLC', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `id` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`id`, `type`, `status`) VALUES
(1, 'T&M', 'Active'),
(2, 'FR', 'Active'),
(3, 'FP', 'Active'),
(4, 'Others', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `skill_role`
--

CREATE TABLE `skill_role` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skill_role`
--

INSERT INTO `skill_role` (`id`, `name`, `status`) VALUES
(1, 'Developer', 'Active'),
(2, 'Sr. Developer', 'Active'),
(3, 'Tester', 'Active'),
(4, 'Sr. Tester', 'Active'),
(5, 'Test Lead', 'Active'),
(6, 'Sr. Test Lead', 'Active'),
(7, 'Technical Lead', 'Active'),
(8, 'Technical Manager', 'Active'),
(9, 'Solution Designer', 'Active'),
(10, 'Business Analyst', 'Active'),
(11, 'Sr. Business Analyst', 'Active'),
(12, 'Scrum Master', 'Active'),
(13, 'Scrum of Scrum Master', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sow`
--

CREATE TABLE `sow` (
  `id` int(11) NOT NULL,
  `supp_ref` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'SUPPLIER Reference  (SOW ID)',
  `cust_ref` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'CUSTOMER Reference',
  `procuring_party_id` int(11) NOT NULL COMMENT 'Procuring Party',
  `project_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Project Name',
  `project_type_id` int(11) NOT NULL COMMENT 'Project Type ',
  `project_desc` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Project Description',
  `act_scope_work` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Activities/Scope of work',
  `skills_tech_abilities` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Team Composition',
  `infra_cust` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Infrastructure from Customer',
  `infra_supp` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Infrastructure from Supplier',
  `location_id` int(11) NOT NULL COMMENT 'Location',
  `work_days` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Work Days/Work Hours/Work Holidays',
  `start_date` date NOT NULL COMMENT 'Dates',
  `end_date` date NOT NULL COMMENT 'Dates',
  `work_allocation` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Work Allocation',
  `progress_reporting` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Progress Reporting',
  `acceptance_criteria` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Acceptance Criteria or Fulfilment of SoW',
  `slas_agreed` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'SLAs Agreed',
  `cust_manager_id` int(11) NOT NULL COMMENT 'Line Managers',
  `supp_manager_id` int(11) NOT NULL COMMENT 'Line Managers',
  `change_control` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Change Control',
  `risk_mitigation_plans` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Risks & Mitigation Plans',
  `extension` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extension',
  `cancellation` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Cancellation / Delay / Early Termination',
  `applicability_deliverables` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Applicability of Escrow for the deliverables',
  `price` float(10,2) NOT NULL COMMENT 'Price (in GBP)',
  `overtime_working` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Overtime Working',
  `payments` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Payments',
  `out_pocket_travel_exp` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Out of Pocket and Travel Expenses',
  `trans_back_arr` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Transition Back Arrangements',
  `data_protection` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Data Protection',
  `creator_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `reviewer_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `approver_id` int(11) NOT NULL,
  `approver_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('draft','sent_to_reviewer','sent_to_approver','rejected_by_reviewer','rejected_by_approver','approved_by_approver','deleted') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sow_master`
--

CREATE TABLE `sow_master` (
  `id` int(11) NOT NULL,
  `project_type` int(5) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sow_master`
--

INSERT INTO `sow_master` (`id`, `project_type`, `name`, `content`) VALUES
(1, 0, 'header_desc', '<p>This Statement of Work (the &ldquo;<strong>SOW</strong>&rdquo;) is entered into as of 4<sup>th</sup> December 2018 (the &ldquo;<strong>Effective Date</strong>&rdquo;), between Datamatics Global Services Limited (&ldquo;<strong>Supplier</strong>&rdquo;), whose registered office is at Knowledge Centre, Plot 58, Street No. 17, MIDC, Andheri (East), Mumbai 400093, and BUPA Insurance Services Limited&nbsp; a company registered in&nbsp; England and Wales under company number 03829851 and whose registered office (effective from 11 December 2017) is 1 Angel Court London EC2R 7HJ (&ldquo;<strong>Customer</strong>&rdquo;) (together the &ldquo;<strong>Parties</strong>&rdquo;).</p>\r\n<p>The SOW is entered into pursuant to and shall be governed by the IT Services Framework Agreement signed on, 24<sup>th</sup> November 2017, effective from 21<sup>st</sup> July 2016, between the Parties (the &ldquo;<strong>Agreement</strong>&rdquo;).</p>\r\n<p>Supplier agrees to the following in respect of the Services to be provided under this SOW:</p>\r\n<ol>\r\n<li>Supplier shall ensure that all Supplier Personnel shall sign and adhere to Customer&rsquo;s confidentiality agreement; and</li>\r\n<li>Supplier shall adhere, and shall procure that all of its resources shall adhere, to applicable Customer IT and security policies and standards including Customer&rsquo;s Corporate Information Security Policy and the Customer Group IS Security Policy &amp; Rules.</li>\r\n</ol>\r\n<p>&nbsp;</p>'),
(2, 1, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Test/Development activities.</li>\r\n<li>Customer shall arrange to provide access only to support Development / Test servers</li>\r\n<li>Skype for business</li>\r\n<li>Customer&nbsp; shall arrange to provide the necessary data for Development/Test purposes and these are deemed as Development/Test Data only and not as Live Data.</li>\r\n</ul>'),
(3, 3, 'infra_cust', '<ul>\r\n<li>Customer shall provide the necessary VM infrastructure, adequate bandwidth connectivity and access to all systems that are needed as a part of the Testing activities.</li>\r\n<li>Customer shall arrange to provide access only to Development / Test servers</li>\r\n<li>Customer&nbsp; shall arrange to provide the necessary data for test purposes and these are deemed as Test Data only and not as Live Data.</li>\r\n</ul>'),
(4, 1, 'infra_supp', '<p>Following infrastructure requirements for the teams located at offshore -</p>\r\n<ol type=\"a\">\r\n<li>GDSC standard machine with Windows Professional</li>\r\n<li>MS Office 2016 Standard</li>\r\n</ol>'),
(5, 3, 'infra_supp', '<ul>\r\n<li>Following infrastructure will be provided by SUPPLIER for the Developer located at offshore in SUPPLIER offices-</li>\r\n</ul>\r\n<ol>\r\n<li>GDSC standard machine with Windows 7 Operating System</li>\r\n<li>MS Office 2016 Standard Edition</li>\r\n</ol>\r\n<p>To support the development, SUPPLIER shall provide the following licenses for use:</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"223\">\r\n<p><strong>Role of Team Member</strong></p>\r\n</td>\r\n<td width=\"296\">\r\n<p><strong>License proposed to be provided offshore</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"223\">\r\n<p>&nbsp;</p>\r\n</td>\r\n<td width=\"296\">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(6, 1, 'work_days\r\n', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>'),
(7, 3, 'work_days', '<ul>\r\n<li>All resources shall follow any 8-hours work duration between 8 am to 8 pm local time</li>\r\n<li>Work week will be 5-day week as followed at the deployment location</li>\r\n<li>Holidays will be adhered as per the deployment location</li>\r\n<li>Overtime, Holiday working, Weekend working and such other additional working beyond standard 8-hour work week shall be carried out with prior permission of the Client Manager(s).</li>\r\n</ul>'),
(8, 1, 'work_allocation\r\n', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager&nbsp;&nbsp; OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>'),
(9, 3, 'work_allocation', '<p>Work Allocation shall be done by the respective Scrum Master in consultation with the Client Manager&nbsp;&nbsp; OR</p>\r\n<p>Work Allocation shall be done by the respective Customer Manager or designate as applicable</p>'),
(10, 1, 'progress_reporting\r\n', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>'),
(11, 3, 'progress_reporting', '<ul>\r\n<li>Reporting shall be done by the Scrum Master and the Team through the Agile ceremonies.</li>\r\n<li>Monthly reporting shall be done by the Datamatics Manager. OR</li>\r\n<li>Reporting as directed by Customer Manager</li>\r\n</ul>'),
(12, 1, 'acceptance_criteria\r\n', '<p>Meeting &amp;ldquo;Done&amp;rdquo; Criteria for every sprint.</p>'),
(13, 1, 'slas_agreed\r\n', '<p>Not Applicable</p>'),
(14, 3, 'SLAs_agreed', '<p>None</p>'),
(15, 1, 'change_control \r\n', '<p>Not Applicable</p>'),
(16, 3, 'change_control', '<p>All change controls shall be only in writing.&nbsp; No change shall be made in any reduction of the team size. Team composition may be changed, if required, within the same level of resources.</p>'),
(17, 1, 'risk_mitigation_plans', '<p>Not Applicable</p>'),
(18, 3, 'risk_mitigation_plans', '<p>NIL</p>'),
(19, 1, 'extension\r\n', '<ul>\r\n<li>Customer may extend the SOW Term via the change management process for additional periods of Three (3) months&rsquo; with an advance notice of 30-days to the expiry of the SOW term.</li>\r\n<li>If Customer does not extend the SOW term in accordance with above, the SOW term will be extended by rolling periods of Thirty (30) days until such time as Customer requests an extension in accordance with the above or notifies Supplier in writing that the SOW will expire upon the expiry of the then current thirty (30) day rolling period</li>\r\n</ul>'),
(20, 3, 'extension', '<p>CUSTOMER may exercise in writing any Change Request, as required, based on mutually agreed price and other Terms and Conditions.</p>'),
(21, 1, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance.&nbsp;</p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as an &ldquo;expended day&rdquo; on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate.</p>'),
(22, 3, 'cancellation', '<p>No rescheduling of start date will be acceptable unless CUSTOMER notifies SUPPLIER of the same at least seven (7) days in advance.&nbsp;</p>\r\n<p>Any delay beyond one week solely attributable to CUSTOMER will be charged fully deeming it as a &ldquo;expended day&rdquo; on the project.</p>\r\n<p>Pre-closure of this Sow will invite notice period of thirty (30) days or payment in lieu of notice by CUSTOMER.</p>\r\n<p>Cancellation of this SoW prior to commencement will invite twenty (20) business days of daily rate.&nbsp;</p>'),
(23, 1, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>'),
(24, 3, 'applicability_deliverables', '<p>Deliverables made under this SoW are not subject to Escrow conditions as mentioned in the MSA</p>'),
(25, 1, 'overtime_working\r\n', '<p>Overtime shall be undertaken with prior approval from CUSTOMER Manager.&nbsp; It will be charged based on factored rate as per below table calculated on the Per Person Day Rate.</p>\r\n<p>Offshore &ndash; GBP 25; Onshore &ndash; GBP 50</p>\r\n<table style=\"width: 589px;\">\r\n<tbody>\r\n<tr style=\"height: 46px;\">\r\n<td style=\"width: 121px; height: 46px;\">\r\n<p>Detail</p>\r\n</td>\r\n<td style=\"width: 84px; height: 46px;\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td style=\"width: 366px; height: 46px;\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 46px;\">\r\n<td style=\"width: 121px; height: 46px;\">\r\n<p>Weekday</p>\r\n</td>\r\n<td style=\"width: 84px; height: 46px;\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 46px;\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 89px;\">\r\n<td style=\"width: 121px; height: 89px;\">\r\n<p>Saturday</p>\r\n</td>\r\n<td style=\"width: 84px; height: 89px;\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 89px;\">\r\n<p>In Blocks of 4 Hours &ndash;</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr style=\"height: 101px;\">\r\n<td style=\"width: 121px; height: 101px;\">\r\n<p>Sunday, Holiday &amp; any Overnight working</p>\r\n</td>\r\n<td style=\"width: 84px; height: 101px;\">\r\n<p>2 times</p>\r\n</td>\r\n<td style=\"width: 366px; height: 101px;\">\r\n<p>In Blocks of 4 Hours &ndash;</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(26, 3, 'overtime_working', '<p>All overtime shall be undertaken with prior approval from Bupa Manager.</p>\r\n<p>Standard Per hour rate to be considered for Overtime &ndash;</p>\r\n<p>Offshore &ndash; GBP 25; Onshore &ndash; GBP 50</p>\r\n<table width=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Detail</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>Factor Rate</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Applicability</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Weekday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>Rounded off to the nearest hour</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Saturday</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>1.5 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours &ndash;</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"120\">\r\n<p>Sunday, Holiday &amp; any Overnight working</p>\r\n</td>\r\n<td width=\"83\">\r\n<p>2 times</p>\r\n</td>\r\n<td width=\"202\">\r\n<p>In Blocks of 4 Hours &ndash;</p>\r\n<p>e.g. 0-4 hours = 4 hours</p>\r\n<p>4-8 Hours = 8 hours</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(27, 1, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears based on the Innate attendance in line with the MSA</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>'),
(28, 3, 'payments', '<ul>\r\n<li>SUPPLIER will invoice CUSTOMER monthly in arrears</li>\r\n<li>CUSTOMER Shall make the payment in line with clause no. 16.3 in the MSA</li>\r\n</ul>'),
(29, 1, 'out_pocket_travel_exp\r\n', '<ul>\r\n<li>Travel expenses for any Local travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any such travel &amp; stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel &amp; stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>\r\n'),
(30, 3, 'out_pocket_travel_exp', '<ul>\r\n<li>Travel expenses for any travel other than above mentioned locations shall be paid by CUSTOMER. Such expenses shall be as applicable for a CUSTOMER employee of same level.</li>\r\n<li>Any travel &amp; stay requirements, if required, as part of the execution shall be governed with additional charges at actual incurred by the team member; such travel &amp; stay shall be in line with the governing policies of CUSTOMER for an equivalent level CUSTOMER staff.</li>\r\n</ul>'),
(31, 1, 'trans_back_arr\r\n', '<p>Standard Terms and Conditions apply.</p>'),
(32, 3, 'trans_back_arr', '<p>Standard Terms and Conditions apply.</p>'),
(33, 1, 'data_protection', '<p>The terms &amp; conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>'),
(34, 3, 'data_protection', '<p>The terms &amp; conditions and the related annexures mentioned in GDPR Mandatory Contract Amendment dated 03 August 2018 shall be applicable only if the Supplier is processing any live and personal data.</p>'),
(35, 3, 'party_cntlr', '<p>Bupa Insurance Services Limited</p>'),
(36, 3, 'party_proc', '<p>Datamatics Global Services Limited</p>'),
(37, 3, 'proc_duration', '<p>Term of Statement of Work</p>'),
(38, 3, 'proc_nature', '<p>The supplier does not process any customer data under the SOW’s named in this Annexure</p>'),
(39, 3, 'type_pers_data', '<p>Please select all of the types of personal data which are subject to the processing: </p>\r\n\r\n<p>Personal: </p>'),
(40, 3, 'cat_subject', '<p>Please select all of the categories of data subjects (individuals) who are subject to the processing:</p>');

-- --------------------------------------------------------

--
-- Table structure for table `sow_personal_data`
--

CREATE TABLE `sow_personal_data` (
  `id` int(11) NOT NULL,
  `sow_id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sow_subject_categories`
--

CREATE TABLE `sow_subject_categories` (
  `id` int(11) NOT NULL,
  `sow_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sow_team_composition`
--

CREATE TABLE `sow_team_composition` (
  `id` int(11) NOT NULL,
  `sow_id` int(11) NOT NULL COMMENT 'SOW id',
  `role_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL COMMENT 'quantity',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_categories`
--

CREATE TABLE `subject_categories` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_categories`
--

INSERT INTO `subject_categories` (`id`, `content`) VALUES
(1, '<p><strong>Our People </strong>(Bupa prospective employees, current employees and/or those who have left the business)</p>'),
(2, '<p><strong>Insurance Customers</strong> (Bupa prospective and current individual and corporate insurance customers, family of customers (including children) and lapsed customers</p>'),
(3, '<p><strong>Health, Care and Dental Customers </strong>(Bupa prospective and current customers (including children) and/or lapsed)</p>'),
(4, '<p><strong>Other </strong>(including past, present and prospective advisors, brokers, consultants, correspondents)</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_type`
--
ALTER TABLE `manager_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_data_type`
--
ALTER TABLE `personal_data_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procuring_party`
--
ALTER TABLE `procuring_party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_role`
--
ALTER TABLE `skill_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sow`
--
ALTER TABLE `sow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sow_master`
--
ALTER TABLE `sow_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sow_personal_data`
--
ALTER TABLE `sow_personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sow_subject_categories`
--
ALTER TABLE `sow_subject_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sow_team_composition`
--
ALTER TABLE `sow_team_composition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_categories`
--
ALTER TABLE `subject_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager_type`
--
ALTER TABLE `manager_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_data_type`
--
ALTER TABLE `personal_data_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `procuring_party`
--
ALTER TABLE `procuring_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skill_role`
--
ALTER TABLE `skill_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sow`
--
ALTER TABLE `sow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sow_master`
--
ALTER TABLE `sow_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sow_personal_data`
--
ALTER TABLE `sow_personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sow_subject_categories`
--
ALTER TABLE `sow_subject_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sow_team_composition`
--
ALTER TABLE `sow_team_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_categories`
--
ALTER TABLE `subject_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
