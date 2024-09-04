-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 04:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_qualifications`
--

CREATE TABLE `additional_qualifications` (
  `APP_NO` int(10) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `university` varchar(200) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `yoj` year(4) NOT NULL,
  `yoc` year(4) NOT NULL,
  `duration` int(5) NOT NULL,
  `percentage` varchar(50) NOT NULL,
  `division` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_qualifications`
--

INSERT INTO `additional_qualifications` (`APP_NO`, `degree`, `university`, `branch`, `yoj`, `yoc`, `duration`, `percentage`, `division`) VALUES
(1, '2713 Dickinson Neck', '72272 Turner Hill', '48350 Jimmie Shoals', '0000', '0000', 252, '9747 Melissa Villages', 'Ut provident error molestias quis laboriosam labore nam.'),
(6, 'aaa', '9s', 'aaa', '2012', '2024', 5, '15', 'Mi');

-- --------------------------------------------------------

--
-- Table structure for table `applicationdetails`
--

CREATE TABLE `applicationdetails` (
  `AdvertisementNumber` varchar(255) NOT NULL,
  `DateOfApplication` varchar(100) DEFAULT NULL,
  `APP_NO` int(11) NOT NULL,
  `PostAppliedFor` varchar(255) DEFAULT NULL,
  `DepartmentSchool` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicationdetails`
--

INSERT INTO `applicationdetails` (`AdvertisementNumber`, `DateOfApplication`, `APP_NO`, `PostAppliedFor`, `DepartmentSchool`) VALUES
('IITP/FACREC-CHE/2023/JULY/02', '0000-00-00', 1, 'Professor', 'Chemical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `awards_recognitions`
--

CREATE TABLE `awards_recognitions` (
  `APP_NO` int(11) NOT NULL,
  `SNo` int(11) NOT NULL,
  `AwardName` varchar(255) NOT NULL DEFAULT '',
  `AwardingBody` varchar(255) NOT NULL,
  `YearOfAward` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awards_recognitions`
--

INSERT INTO `awards_recognitions` (`APP_NO`, `SNo`, `AwardName`, `AwardingBody`, `YearOfAward`) VALUES
(1, 1, 'Repudiandae dolor incidunt odit cumque eveniet illum.', 'Architecto recusandae eligendi laboriosam impedit voluptatibus earum consequuntur.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `consultancyprojects`
--

CREATE TABLE `consultancyprojects` (
  `APP_NO` int(11) NOT NULL,
  `SNo` int(11) NOT NULL,
  `Organization` varchar(255) DEFAULT NULL,
  `TitleOfProject` varchar(255) DEFAULT NULL,
  `AmountGranted` int(11) DEFAULT NULL,
  `Period` int(11) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultancyprojects`
--

INSERT INTO `consultancyprojects` (`APP_NO`, `SNo`, `Organization`, `TitleOfProject`, `AmountGranted`, `Period`, `Role`, `Status`) VALUES
(1, 1, 'Numquam consequatur nisi dolores iure error laboriosam placeat.', 'Investor Directives Manager', 0, 0, 'Co-investigator', 'New York'),
(1, 2, 'Quaerat aliquam iusto nulla repellat laudantium ex alias sint temporibus.', 'Central Marketing Consultant', 0, 0, 'Co-investigator', 'Wisconsin'),
(1, 3, 'Nostrum amet asperiores quaerat.', 'Principal Marketing Engineer', 0, 0, 'Co-investigator', 'South Dakota'),
(2, 1, 'Accusamus error consequuntur.', 'International Identity Associate', 0, 0, 'Principal Investigator', 'Massachusetts'),
(2, 2, 'Modi nisi molestias qui.', 'Corporate Web Assistant', 0, 0, 'Co-investigator', 'Kansas'),
(6, 1, 'Alias temporibus excepturi quasi.', 'Dynamic Configuration Analyst', 0, 0, 'Co-investigator', 'Nevada');

-- --------------------------------------------------------

--
-- Table structure for table `details_of_phd`
--

CREATE TABLE `details_of_phd` (
  `APP_NO` int(10) NOT NULL,
  `university` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `Name_of_PhD_Supervisor` varchar(50) NOT NULL,
  `Year_of_Joining` year(4) NOT NULL,
  `Date_of_Successful_Thesis_Defence` varchar(100) NOT NULL,
  `Date_of_Award` varchar(100) NOT NULL,
  `Title_of_PhD_Thesis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details_of_phd`
--

INSERT INTO `details_of_phd` (`APP_NO`, `university`, `department`, `Name_of_PhD_Supervisor`, `Year_of_Joining`, `Date_of_Successful_Thesis_Defence`, `Date_of_Award`, `Title_of_PhD_Thesis`) VALUES
(1, '403-365-5241', '72575 Robb Island', 'Praesentium nesciunt atque excepturi libero dolore', '1994', '0000-00-00', '0000-00-00', 'District Interactions Executive'),
(2, '749-439-3921', '220 Orlando Station', 'Unde nulla culpa assumenda.', '2013', '1900-12-20', '1900-12-25', 'Chief Accountability Agent'),
(3, '123456789', '314 Koby Junctions', 'Suscipit explicabo consequatur quis alias iure off', '2012', '2024-03-14', '2024-03-26', 'Investor Implementation Fa'),
(4, '297-358-6086', '9988 Cristopher Ramp', 'Porro explicabo perferendis eius facilis repellend', '0000', '2024-04-19', '2024-04-23', 'Lead Directives Developer'),
(6, '171-992-2759', '691 Beth Walks', 'Iste', '2012', '0000-00-00', '0000-00-00', 'Principal Mobility Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `APP_NO` int(11) NOT NULL,
  `five_best_papers` varchar(100) NOT NULL,
  `phd` varchar(100) NOT NULL,
  `pg` varchar(100) NOT NULL,
  `ug` varchar(100) NOT NULL,
  `12th_hsc` varchar(100) NOT NULL,
  `10th_ssc` varchar(100) NOT NULL,
  `pay_slip` varchar(100) NOT NULL,
  `noc` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `other_doc` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`APP_NO`, `five_best_papers`, `phd`, `pg`, `ug`, `12th_hsc`, `10th_ssc`, `pay_slip`, `noc`, `experience`, `other_doc`, `signature`) VALUES
(1, 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/bence-boros-2WpkG7DzBRI-unsplash.jpg'),
(6, 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/Ch1_AES2022.pdf', 'uploads/bence-boros-2WpkG7DzBRI-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doc_test`
--

CREATE TABLE `doc_test` (
  `APP_NO` int(11) NOT NULL,
  `five_best_papers` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_test`
--

INSERT INTO `doc_test` (`APP_NO`, `five_best_papers`) VALUES
(6, 'uploads/Ch1_AES2022.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `employmenthistory`
--

CREATE TABLE `employmenthistory` (
  `Position` varchar(255) DEFAULT NULL,
  `Organization` varchar(255) DEFAULT NULL,
  `Date_of_Joining` varchar(255) DEFAULT NULL,
  `Date_of_Leaving` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `APP_NO` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employmenthistory`
--

INSERT INTO `employmenthistory` (`Position`, `Organization`, `Date_of_Joining`, `Date_of_Leaving`, `duration`, `APP_NO`, `id`) VALUES
('Nam quibusdam aspernatur.', 'Minima dolorum ipsum consectetur expedita provident quibusdam.', 'Veritatis saepe laborum temporibus.', 'Quam quasi ipsum eligendi veritatis nisi vitae.', '<', 1, 1),
('Modi eius error veritatis atque natus iusto.', 'Libero aut perferendis.', 'Minus veritatis reprehenderit vitae dolor reprehenderit amet.', 'Illum atque ab optio dignissimos consequuntur nostrum fugit qui debitis.', 'b', 1, 2),
('Magnam fugit vero fuga.', 'Laudantium adipisci consectetur animi officiis.', 'Ut voluptatem odit voluptates exercitationem exercitationem fugiat sequi.', 'Quaerat eius qui.', 'r', 1, 3),
('Aut quos id voluptas sed exercitationem eum laborum voluptas.', 'Quisquam expedita ipsam.', 'Molestiae mollitia quos occaecati.', 'Beatae velit provident voluptas et enim perferendis facilis quasi excepturi.', ' ', 1, 4),
('asfdsfd', 'asfdasfd', '1245', 'fafs', '5', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `idproof`
--

CREATE TABLE `idproof` (
  `APP_NO` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industrial_experience`
--

CREATE TABLE `industrial_experience` (
  `id` int(11) NOT NULL,
  `APP_NO` int(11) NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `WorkProfile` varchar(255) DEFAULT NULL,
  `DateOfJoining` varchar(255) DEFAULT NULL,
  `DateOfLeaving` varchar(255) DEFAULT NULL,
  `Duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industrial_experience`
--

INSERT INTO `industrial_experience` (`id`, `APP_NO`, `organization`, `WorkProfile`, `DateOfJoining`, `DateOfLeaving`, `Duration`) VALUES
(1, 1, 'Voluptates natus in cum.', 'dolore velit necessitatibus', 'Modi eaque laboriosam dolore quos quisquam reiciendis.', 'Illo facilis magni illum.', 'Amet aliquid aspernatur dicta recusandae aspernatur corrupti eaque tenetur iste.'),
(1, 6, 'afsdf', 'fsdf', 'sfdfd', 'asfa', '12'),
(2, 1, 'Alias facere facilis itaque non quasi soluta accusamus facilis.', 'veniam quo fugit', 'Pariatur nulla quas inventore maxime.', 'Voluptas corrupti quisquam.', 'Totam pariatur vel.'),
(2, 6, 'asdfsfdafd', 'fsdsfd', 'sfads', 'asdf', 'afafsd'),
(3, 1, 'Dicta officia repudiandae maxime tempora porro necessitatibus.', 'nemo aliquam ducimus', 'Cupiditate dolorem cupiditate aspernatur et.', 'Sed harum suscipit assumenda qui libero.', 'Odio quidem voluptate natus architecto quo.'),
(4, 1, 'Expedita consequuntur exercitationem nobis.', 'adipisci voluptatum cumque', 'At quibusdam asperiores saepe fugit ab.', 'Quo amet itaque quis nam autem aliquid delectus.', 'Harum totam reprehenderit cumque delectus nam nulla fugit.'),
(5, 1, 'Eveniet fugiat magnam occaecati.', 'voluptates minima eveniet', 'Suscipit ratione expedita.', 'Atque nulla eum porro consequatur molestiae iure assumenda.', 'Consequatur dolorem expedita autem blanditiis sapiente.');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `APP_NO` int(11) NOT NULL,
  `SNo` int(11) NOT NULL,
  `nameOfSociety` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`APP_NO`, `SNo`, `nameOfSociety`, `status`) VALUES
(1, 1, 'Kayli Wiza', 'Colorado'),
(1, 2, 'Abigale Wiza', 'Maryland'),
(1, 3, 'Simeon Cummerata', 'Utah'),
(1, 4, 'Concepcion McCullough', 'Idaho'),
(2, 1, 'Sheldon McKenzie', 'Oregon'),
(2, 2, 'Leonie Bins', 'Vermont'),
(2, 3, 'Halle Huel', 'Utah'),
(6, 1, 'Elmer Runte', 'New Mexico'),
(6, 2, 'asdffda', 'afasd');

-- --------------------------------------------------------

--
-- Table structure for table `personaldetails`
--

CREATE TABLE `personaldetails` (
  `APP_NO` int(10) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `MaritalStatus` varchar(50) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `IDProof` varchar(255) DEFAULT NULL,
  `FathersName` varchar(255) DEFAULT NULL,
  `idproofImage` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `CorrAddress` varchar(255) NOT NULL,
  `PermanentAddress` varchar(255) NOT NULL,
  `Mobile` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `AltMobile` varchar(255) NOT NULL,
  `AltEmail` varchar(255) NOT NULL,
  `Landline` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personaldetails`
--

INSERT INTO `personaldetails` (`APP_NO`, `FirstName`, `MiddleName`, `LastName`, `Nationality`, `DOB`, `Gender`, `MaritalStatus`, `Category`, `IDProof`, `FathersName`, `idproofImage`, `image`, `CorrAddress`, `PermanentAddress`, `Mobile`, `Email`, `AltMobile`, `AltEmail`, `Landline`) VALUES
(1, 'Supreet', '', 'Maurya', ' Indian', '0000-00-00', 'Male', 'Other', 'UR', 'VOTER ID', 'Ariane73', '', '', '2326 Torphy Harbor', '2326 Rau Village', 'Internal Solutions M', 'gulidy@clout.wiki', 'your.email+fakedata21860@gmail.com', 'Senior Data Technici', '517');

-- --------------------------------------------------------

--
-- Table structure for table `pg_details`
--

CREATE TABLE `pg_details` (
  `APP_NO` int(15) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `stream` varchar(100) NOT NULL,
  `Year_of_Joining` year(4) NOT NULL,
  `Year_of_Completion` year(4) NOT NULL,
  `duration` int(5) NOT NULL,
  `cgpa` float NOT NULL,
  `division` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pg_details`
--

INSERT INTO `pg_details` (`APP_NO`, `degree`, `university`, `stream`, `Year_of_Joining`, `Year_of_Completion`, `duration`, `cgpa`, `division`) VALUES
(1, '2023-09-04 16:04:58', 'Nam sint quasi nobis recusandae autem assumenda quisquam.', 'Minus dolores unde magnam assumenda blanditiis repellat dolore.', '0000', '0000', 526, 36002, '36002'),
(2, '2023-07-10 16:58:56', 'A vitae quibusdam.', 'At laborum eveniet dolorum quisquam.', '2012', '2012', 136, 72684, '72684'),
(3, '2024-06-02 05:14:35', 'Consequuntur laudantium voluptatem quibusdam blanditiis minima ut.', 'Veritatis molestiae nisi veniam labore.', '2012', '2012', 2, 1802, 'Vitae tenetur dicta aperiam provident sunt molestiae deleniti. Voluptates suscipit illo eum animi re'),
(4, '2024-08-28 01:40:28', 'Ducimus aut voluptatem libero eos.', 'Doloribus eos numquam eius rem id incidunt omnis odio a.', '0000', '2026', 3, 7232, 'Maxime ipsam fugit quidem numquam blanditiis facere alias quos rem. Corrupti sit suscipit. Ipsum asp'),
(6, '2024-08-19 19:49:07', 'Eius illo distinctio.', 'Odio id enim natus possimus minus tenetur adipisci.', '1997', '0000', 116, 100, '100');

-- --------------------------------------------------------

--
-- Table structure for table `present_employment`
--

CREATE TABLE `present_employment` (
  `APP_NO` int(11) NOT NULL,
  `position` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT NULL,
  `DateOfLeaving` varchar(100) DEFAULT NULL,
  `OrganizationInstitution` varchar(255) DEFAULT NULL,
  `DateOfJoining` varchar(100) DEFAULT NULL,
  `DurationYears` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `present_employment`
--

INSERT INTO `present_employment` (`APP_NO`, `position`, `status`, `DateOfLeaving`, `OrganizationInstitution`, `DateOfJoining`, `DurationYears`) VALUES
(1, '140 Reichert Pike', 'State Government', '0000-00-00', '389 Tyrese Cove', '0000-00-00', 247),
(6, 'aa', 'Private', '0000-00-00', 'aa', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `professional_training`
--

CREATE TABLE `professional_training` (
  `APP_NO` int(11) NOT NULL,
  `SNo` int(11) NOT NULL,
  `TypeOfTrainingReceived` varchar(255) DEFAULT NULL,
  `Organisation` varchar(255) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_training`
--

INSERT INTO `professional_training` (`APP_NO`, `SNo`, `TypeOfTrainingReceived`, `Organisation`, `Year`, `Duration`) VALUES
(1, 1, 'Est tenetur omnis porro placeat deserunt.', 'Est tenetur omnis porro placeat deserunt.', 0, 'Est tenetur omnis porro placeat deserunt.'),
(1, 2, 'Harum laborum dolore itaque in itaque.', 'Harum laborum dolore itaque in itaque.', 0, 'Harum laborum dolore itaque in itaque.'),
(1, 3, 'Ratione eos voluptatibus.', 'Ratione eos voluptatibus.', 0, 'Ratione eos voluptatibus.'),
(1, 4, 'Rem earum maxime deleniti sint suscipit porro.', 'Rem earum maxime deleniti sint suscipit porro.', 0, 'Rem earum maxime deleniti sint suscipit porro.'),
(2, 1, 'Corrupti harum quia quia aliquid similique accusamus nemo veritatis maxime.', 'Praesentium itaque dolore.', 0, 'French Polynesia'),
(2, 2, 'Ipsa voluptatibus laudantium illo aut.', 'Non praesentium aliquam dignissimos non quas aliquid.', 0, 'Maldives'),
(2, 3, 'Tempore vero odio animi vero mollitia deserunt ad deleniti perferendis.', 'Eos ab voluptas officiis atque.', 0, '2024-07-30 21:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `projectdetails`
--

CREATE TABLE `projectdetails` (
  `APP_NO` int(11) NOT NULL,
  `SNo` int(11) NOT NULL,
  `SponsoringAgency` varchar(255) DEFAULT NULL,
  `TitleOfProject` varchar(255) DEFAULT NULL,
  `SanctionedAmount` decimal(10,2) DEFAULT NULL,
  `Period` int(255) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectdetails`
--

INSERT INTO `projectdetails` (`APP_NO`, `SNo`, `SponsoringAgency`, `TitleOfProject`, `SanctionedAmount`, `Period`, `Role`, `Status`) VALUES
(1, 1, 'Dignissimos debitis earum.', 'Dynamic Paradigm Assistant', 0.00, 0, 'Co-investigator', 'Pennsylvania'),
(2, 1, 'Distinctio nulla voluptatem porro eaque recusandae velit amet.', 'Investor Applications Orchestrator', 0.00, 0, 'Co-investigator', 'New York'),
(1, 2, 'Nisi veniam porro repellendus ab aut nisi recusandae recusandae.', 'National Program Executive', 0.00, 0, 'Co-investigator', 'Massachusetts'),
(2, 2, 'Sunt natus cupiditate odit adipisci at debitis voluptate itaque.', 'Chief Configuration Facilitator', 0.00, 0, 'Co-investigator', 'Oklahoma'),
(1, 3, 'Cupiditate necessitatibus eum dolores nesciunt tenetur adipisci quod eius.', 'Lead Accounts Coordinator', 0.00, 0, 'Co-investigator', 'Delaware');

-- --------------------------------------------------------

--
-- Table structure for table `refrees`
--

CREATE TABLE `refrees` (
  `APP_NO` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `associate_with_reference` varchar(100) NOT NULL,
  `institute` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refrees`
--

INSERT INTO `refrees` (`APP_NO`, `name`, `position`, `associate_with_reference`, `institute`, `email`, `contact`) VALUES
(1, 'uYolanda Cummerata', 'Ullam illum alias neque.', 'Research Collaborator', 'Vitae voluptate temporibus minima architecto nisi assumenda.', 'your.email+fakedata18670@gmail.com', '656-293-5557'),
(6, 'uYolanda Cummerata', 'Ullam illum alias neque.', 'Research Collaborator', 'Vitae voluptate temporibus minima architecto nisi assumenda.', 'your.email+fakedata18670@gmail.com', '656-293-5557');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `APP_NO` int(10) NOT NULL,
  `FIRSTNAME` varchar(200) NOT NULL,
  `LASTNAME` varchar(200) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CATEGORY` varchar(10) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL,
  `APP_DATE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`APP_NO`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `CATEGORY`, `PASSWORD`, `APP_DATE`) VALUES
(1, 'Supreet', 'Maurya', 'test@gmail.com', 'OBC', '1234', '2024-03-30'),
(2, 'Tanisha', 'Garg', 'test1@gmail.com', 'OBC', '1234', '2024-03-30'),
(6, 'Krishna', 'Kant', '3747krishna@gmail.com', 'OBC', '1234', '2024-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `research_experience`
--

CREATE TABLE `research_experience` (
  `id` int(11) NOT NULL,
  `app_no` int(11) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `Institute` varchar(255) DEFAULT NULL,
  `Supervisor` varchar(255) DEFAULT NULL,
  `DateOfJoining` varchar(255) DEFAULT NULL,
  `DateOfLeaving` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research_experience`
--

INSERT INTO `research_experience` (`id`, `app_no`, `position`, `Institute`, `Supervisor`, `DateOfJoining`, `DateOfLeaving`, `duration`) VALUES
(1, 1, 'Consequuntur rerum provident laborum quisquam laborum sapiente ut necessitatibus fuga.', 'Maine', 'Minus dolorem alias repudiandae beatae.', 'Distinctio repudiandae voluptas doloribus accusamus alias occaecati impedit.', 'Unde porro quis labore.', '2024-11-23 11:52:47'),
(2, 1, 'Consectetur doloribus laborum amet maxime explicabo numquam commodi neque.', 'Michigan', 'Recusandae soluta eos autem alias libero eligendi.', 'Amet inventore commodi fuga autem vel.', 'Debitis perspiciatis sed nemo amet.', '2025-04-14 01:51:04'),
(3, 1, 'Iusto natus ab quam quasi.', 'Arkansas', 'Quidem totam necessitatibus voluptate facilis ratione amet.', 'Necessitatibus dolores qui corrupti repudiandae distinctio.', 'Harum blanditiis repellendus eligendi provident.', '2025-03-10 18:28:34'),
(4, 6, 'fsfsadafsfd', 'ffasd', 'fdasd', 'fass', 'afsdf', 'asfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `standard` varchar(20) NOT NULL,
  `school` varchar(200) NOT NULL,
  `year_of_passing` year(4) NOT NULL,
  `percentage/grade` varchar(20) NOT NULL,
  `division` varchar(20) NOT NULL,
  `APP_NO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`standard`, `school`, `year_of_passing`, `percentage/grade`, `division`, `APP_NO`) VALUES
('10th', 'Ipsam quam quaerat quas quibusdam fugiat omnis iste fugit.', '0000', '214 K', 'Est a', 1),
('10th', 'Nam dolorem alias repudiandae corporis omnis quis reprehenderit praesentium ulla', '0000', '7536 ', 'Nostr', 2),
('10th', 'jfdkkd', '2009', '966 M', 'Repel', 6),
('12th', 'Ipsum nobis soluta dolor dolor consequuntur impedit quos distinctio.', '0000', '816 D', 'Porro', 1),
('12th', 'Distinctio doloremque dicta.', '2001', '750 B', 'Dolor', 2),
('12th', 'Error', '0000', '766 S', 'Conse', 6);

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `APP_NO` int(20) NOT NULL,
  `area_of_specialization` varchar(255) NOT NULL,
  `current_area_of_research` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`APP_NO`, `area_of_specialization`, `current_area_of_research`) VALUES
(1, 'safdfsds', 'asfsad'),
(6, 'aaa', 'aaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `teachingexperience`
--

CREATE TABLE `teachingexperience` (
  `id` int(11) NOT NULL,
  `app_no` int(11) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `CourseTaught` varchar(255) DEFAULT NULL,
  `UG_PG` varchar(50) DEFAULT NULL,
  `NoOfStudents` int(11) DEFAULT NULL,
  `DateOfJoining` varchar(100) DEFAULT NULL,
  `DateOfLeaving` varchar(100) DEFAULT NULL,
  `Duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachingexperience`
--

INSERT INTO `teachingexperience` (`id`, `app_no`, `position`, `employer`, `CourseTaught`, `UG_PG`, `NoOfStudents`, `DateOfJoining`, `DateOfLeaving`, `Duration`) VALUES
(1, 1, 'Officiis eos a labore laudantium mollitia sapiente deleniti. Saepe earum culpa unde laudantium repellendus. Iusto recusandae nesciunt consectetur quis sapiente magni consectetur explicabo.Voluptate totam et aperiam expedita. Eligendi deserunt atque ipsum ', 'Fuga distinctio dicta ea magnam cupiditate animi voluptas. Totam veniam voluptates dicta fugit maxime necessitatibus possimus dolor eum. Vero optio laudantium magnam laboriosam.Fugit quas voluptates amet repellat. Eum animi perspiciatis illo deserunt. Mol', 'Uzbekistan', 'Quos est voluptatibus earum. Deleniti id sunt quib', 644, '0000-00-00', '0000-00-00', 'Ut veritatis nulla magni placeat. Nemo pariatur id aut soluta minus harum. A voluptates aliquid quisquam.Tempora accusamus possimus quas quam necessitatibus optio unde beatae. Quos atque consequatur eaque consequatur autem eum. Magni esse perferendis quam'),
(1, 6, 'sdfsfsdf', 'fasf', 'fasfd', 'aa', 5, '2024-05-08', '2024-05-16', '5'),
(2, 1, 'Laborum beatae dolorem sapiente aperiam at laboriosam aspernatur. Delectus eum temporibus voluptas velit exercitationem dolore tempore. A iusto nemo tempora aut fugit.Accusamus recusandae odio magnam eius. Commodi tempora id dolorem cupiditate pariatur es', 'Rerum quidem tenetur adipisci aperiam aperiam tempora corporis voluptate reprehenderit. Pariatur dolor unde distinctio quos. Porro soluta quos repudiandae expedita.Voluptatibus modi officia. Et minus iusto beatae aspernatur assumenda. Sunt ullam accusanti', 'Sao Tome and Principe', 'Quidem eveniet ducimus. Adipisci doloremque odio i', 587, '0000-00-00', '0000-00-00', 'Praesentium vitae nisi dolorem corrupti aliquam maxime natus accusamus. Ullam reprehenderit labore animi iste sint possimus beatae nam. Harum quis voluptatum aut quas et odit.Iure repellat maiores. Aperiam pariatur quisquam delectus. Quod omnis libero dol'),
(3, 1, 'Quae nihil autem mollitia sit temporibus officia. Beatae cum ea vitae. Illum quisquam cum numquam illo nesciunt.Dignissimos ratione voluptatibus nesciunt. Exercitationem facere quis ullam consectetur. Rem doloremque quam.Cum quos odio neque asperiores eaq', 'Sequi eius quidem eum magnam consequuntur repellat exercitationem expedita. Quaerat adipisci illo at voluptates reiciendis occaecati. Totam similique repellendus officia.Fuga veritatis sapiente. Fugit et aut ducimus harum nam explicabo nemo. Quae ratione ', 'Palau', 'Culpa officiis inventore nulla maiores optio natus', 22, '0000-00-00', '0000-00-00', 'Cum delectus alias reprehenderit modi. Natus autem ipsa sunt. Laborum fugiat laboriosam perferendis at reprehenderit nemo nulla fuga.Earum ipsum eum quasi vitae sed eos aperiam eaque numquam. Provident similique minima architecto qui quis dolore. Quos har'),
(4, 1, 'Ad ducimus ad asperiores quibusdam quos voluptas dolore laboriosam. Fugit eum numquam itaque veritatis voluptatem quae. Aliquid occaecati quae.Fugiat itaque dignissimos itaque illo quaerat provident dolor corporis. Porro maxime non perspiciatis itaque lab', 'Tempora similique hic culpa temporibus. Tempore minima fugit distinctio mollitia reiciendis facilis aspernatur omnis sed. Quo dolorem est aspernatur cupiditate.Deserunt quaerat ut impedit sunt. Dolorem voluptatum labore nemo dolorum voluptatem dolorem. Bl', 'Trinidad and Tobago', 'Totam architecto dolore nobis mollitia sed illum h', 445, '0000-00-00', '0000-00-00', 'Facilis dolorum consectetur necessitatibus reprehenderit temporibus esse sequi. Delectus expedita deserunt. Adipisci aut distinctio praesentium rem.Perspiciatis neque unde. Necessitatibus repellendus optio laboriosam. Quisquam consectetur libero saepe min');

-- --------------------------------------------------------

--
-- Table structure for table `ug_details`
--

CREATE TABLE `ug_details` (
  `APP_NO` int(11) NOT NULL,
  `degree` varchar(200) NOT NULL,
  `university` varchar(200) NOT NULL,
  `stream` varchar(200) NOT NULL,
  `yoj` year(4) NOT NULL,
  `yoc` year(4) NOT NULL,
  `duration` int(10) NOT NULL,
  `percentage` int(10) NOT NULL,
  `division` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ug_details`
--

INSERT INTO `ug_details` (`APP_NO`, `degree`, `university`, `stream`, `yoj`, `yoc`, `duration`, `percentage`, `division`) VALUES
(1, '2023-09-12 20:58:22', 'Nam sint quasi nobis recusandae autem assumenda quisquam.', 'Temporibus totam harum cupiditate voluptatem nulla cupiditate amet.', '0000', '0000', 45, 4109, 'Ad dignissimos optio vel qui voluptas eaque eaque.'),
(2, '2024-07-06 06:55:12', 'A vitae quibusdam.', 'Amet accusamus aliquam consectetur.', '2012', '2012', 366, 802, 'Sequi alias molestiae occaecati nesciunt nobis.'),
(3, '2024-01-04 02:40:00', 'Consequuntur laudantium voluptatem quibusdam blanditiis minima ut.', 'Facilis optio facere maiores laboriosam.', '2012', '2012', 2023, 224, 'Harum et ea tempore sit.'),
(4, '2024-02-23 10:56:34', 'Totam necessitatibus excepturi enim dolores ab at tenetur neque.', 'Distinctio et recusandae eveniet modi molestias repellendus.', '2013', '2056', 1, 814, 'Nobis totam voluptas.'),
(6, '2024-02-05 18:38:22', 'Eius illo distinctio.', 'Hic nihil autem aspernatur libero impedit.', '0000', '0000', 301, 87491, 'Corporis numquam adipisci cumque sit.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_qualifications`
--
ALTER TABLE `additional_qualifications`
  ADD PRIMARY KEY (`APP_NO`,`degree`);

--
-- Indexes for table `applicationdetails`
--
ALTER TABLE `applicationdetails`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `awards_recognitions`
--
ALTER TABLE `awards_recognitions`
  ADD PRIMARY KEY (`SNo`,`APP_NO`);

--
-- Indexes for table `consultancyprojects`
--
ALTER TABLE `consultancyprojects`
  ADD PRIMARY KEY (`APP_NO`,`SNo`);

--
-- Indexes for table `details_of_phd`
--
ALTER TABLE `details_of_phd`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `doc_test`
--
ALTER TABLE `doc_test`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `employmenthistory`
--
ALTER TABLE `employmenthistory`
  ADD PRIMARY KEY (`APP_NO`,`id`);

--
-- Indexes for table `idproof`
--
ALTER TABLE `idproof`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `industrial_experience`
--
ALTER TABLE `industrial_experience`
  ADD PRIMARY KEY (`id`,`APP_NO`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`APP_NO`,`SNo`);

--
-- Indexes for table `personaldetails`
--
ALTER TABLE `personaldetails`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `pg_details`
--
ALTER TABLE `pg_details`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `present_employment`
--
ALTER TABLE `present_employment`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `professional_training`
--
ALTER TABLE `professional_training`
  ADD PRIMARY KEY (`APP_NO`,`SNo`);

--
-- Indexes for table `projectdetails`
--
ALTER TABLE `projectdetails`
  ADD PRIMARY KEY (`SNo`,`APP_NO`);

--
-- Indexes for table `refrees`
--
ALTER TABLE `refrees`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `research_experience`
--
ALTER TABLE `research_experience`
  ADD PRIMARY KEY (`id`,`app_no`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`standard`,`APP_NO`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`APP_NO`);

--
-- Indexes for table `teachingexperience`
--
ALTER TABLE `teachingexperience`
  ADD PRIMARY KEY (`id`,`app_no`);

--
-- Indexes for table `ug_details`
--
ALTER TABLE `ug_details`
  ADD PRIMARY KEY (`APP_NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `APP_NO` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
