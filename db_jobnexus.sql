-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 11:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jobnexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `benefit`
--

CREATE TABLE `benefit` (
  `benefitID` varchar(11) NOT NULL,
  `employerID` varchar(11) NOT NULL,
  `benefitTitle` varchar(255) DEFAULT NULL,
  `benefitDescription` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `benefit`
--

INSERT INTO `benefit` (`benefitID`, `employerID`, `benefitTitle`, `benefitDescription`, `icon`, `isDeleted`) VALUES
('B0000000000', 'E2300000', 'Health Insurance', 'Comprehensive health coverage for employees', 'bi-heart-pulse', 0),
('B0000000001', 'E2300000', 'Flexible Hours', 'Allowing employees to set flexible working hours', 'bi-suitcase2', 0),
('B0000000002', 'E2300001', 'Professional Development', 'Support for continuous learning and career growth', 'bi-people', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `employerID` varchar(11) NOT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `contactPersonName` varchar(255) DEFAULT NULL,
  `emailAddress` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `addressLineOne` varchar(50) DEFAULT NULL,
  `addressLineTwo` varchar(50) DEFAULT NULL,
  `addressLineThree` varchar(50) DEFAULT NULL,
  `postcode` int(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `numberOfEmployees` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `aboutUs` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `backgroundPicture` varchar(255) DEFAULT NULL,
  `officePictures` varchar(255) DEFAULT NULL,
  `websiteUrl` varchar(255) DEFAULT NULL,
  `facebookUrl` varchar(255) DEFAULT NULL,
  `linkedinUrl` varchar(255) DEFAULT NULL,
  `whatsappUrl` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `dateJoined` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`employerID`, `companyName`, `contactPersonName`, `emailAddress`, `password`, `phoneNumber`, `addressLineOne`, `addressLineTwo`, `addressLineThree`, `postcode`, `city`, `state`, `numberOfEmployees`, `industry`, `aboutUs`, `logo`, `backgroundPicture`, `officePictures`, `websiteUrl`, `facebookUrl`, `linkedinUrl`, `whatsappUrl`, `status`, `dateJoined`) VALUES
('E2300000', 'Tech Solutions Ltd', 'David Yap', 'davidspam404@gmail.com', '3540cd7582d65cf71121857e6662fc01', '162462609', '123 Main St', 'Taman Sri Gombak', '', 68100, 'BATU CAVES', 'Selangor', '10-50', 'Technology', 'Leading tech company', 'logo.jpg', 'background.jpg', 'office1.jpg, office2.jpg', 'http://techsolutions.com', 'http://facebook.com/techsolutions', 'http://linkedin.com/company/techsolutions', 'http://wa.me/162462609', 'Approved', '2023-01-01'),
('E2300001', 'Innovate Innovations', 'Jane Smith', 'jane.smith@example.com', '3540cd7582d65cf71121857e6662fc01', '1112223333', '456 Innovation Ave', 'Taman Sri Mantu', '', 56789, 'BATU LEMBUT', 'Kuala Lumpur', '50-100', 'Healthcare', 'Revolutionizing the industry', 'innovate_logo.jpg', 'innovate_background.jpg', 'innovate_office1.jpg, innovate_office2.jpg', 'http://innovate.com', 'http://facebook.com/innovate', 'http://linkedin.com/company/innovate', 'http://wa.me/1112223333', 'Approved', '2023-02-01'),
('E2300002', 'Global Enterprises', 'Alex Johnson', 'alex.johnson@example.com', '3540cd7582d65cf71121857e6662fc01', '1112223334', '789 International Blvd', 'Taman Sri Mamak', '', 56789, 'BATU KERAS', 'Kuala Lumpur', '100-500', 'Global', 'Connecting the world', 'global_logo.jpg', 'global_background.jpg', 'global_office1.jpg, global_office2.jpg', 'http://global.com', 'http://facebook.com/global', 'http://linkedin.com/company/global', 'http://wa.me/1112223333', 'Approved', '2023-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `applicationID` varchar(11) NOT NULL,
  `jobSeekerID` varchar(11) NOT NULL,
  `jobPostingID` varchar(12) NOT NULL,
  `applicationDate` date DEFAULT NULL,
  `coverLetterSummary` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `salaryExpectation` int(11) DEFAULT NULL,
  `availableDate` date DEFAULT NULL,
  `replies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`applicationID`, `jobSeekerID`, `jobPostingID`, `applicationDate`, `coverLetterSummary`, `status`, `salaryExpectation`, `availableDate`, `replies`) VALUES
('JA230125000', 'JS2300000', 'JP2301150000', '2023-01-25', 'Excited to contribute to innovative projects', 'Pending', 3000, '2023-03-01', 'Looking forward to the opportunity'),
('JA230301000', 'JS2300001', 'JP2302200000', '2023-03-01', 'Passionate about digital marketing trends', 'Success', 3000, '2023-04-01', 'Eager to start work'),
('JA230302000', 'JS2300002', 'JP2303100000', '2023-03-20', 'Expertise in financial analysis and reporting', 'Under Review', 3000, '2023-05-01', 'Thank you for the consideration');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `jobCategoryID` varchar(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`jobCategoryID`, `categoryName`, `description`, `keywords`) VALUES
('00000000001', 'Software Development', 'Creating software applications', 'software, development, programming'),
('00000000002', 'Marketing', 'Promoting products and services', 'marketing, advertising, promotion'),
('00000000003', 'Finance', 'Dealing with financial matters', 'finance, accounting, budgeting'),
('00000000004', 'Customer Support', 'Customer support', 'customer service,support'),
('00000000005', 'Human Resources', 'Employment and human management', 'human resources,personnel,management');

-- --------------------------------------------------------

--
-- Table structure for table `job_posting`
--

CREATE TABLE `job_posting` (
  `jobPostingID` varchar(12) NOT NULL,
  `employerID` varchar(11) NOT NULL,
  `jobCategoryID` varchar(11) NOT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `jobDescription` text DEFAULT NULL,
  `jobRequirement` text DEFAULT NULL,
  `jobHighlight` varchar(255) DEFAULT NULL,
  `experienceLevel` varchar(30) DEFAULT NULL,
  `locationState` varchar(255) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `employmentType` varchar(255) DEFAULT NULL,
  `applicationDeadline` date DEFAULT NULL,
  `isPublish` varchar(20) DEFAULT NULL,
  `publishDate` date DEFAULT NULL,
  `isFeatured` tinyint(1) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_posting`
--

INSERT INTO `job_posting` (`jobPostingID`, `employerID`, `jobCategoryID`, `jobTitle`, `jobDescription`, `jobRequirement`, `jobHighlight`, `experienceLevel`, `locationState`, `salary`, `employmentType`, `applicationDeadline`, `isPublish`, `publishDate`, `isFeatured`, `isDeleted`, `created_at`) VALUES
('JP2301150000', 'E2300000', '00000000001', 'Software Engineer', 'Developing cutting-edge software solutions', 'Bachelor’s degree in Computer Science, Java proficiency', 'Exciting opportunities for career growth', 'Full-time', 'Selangor', 4000, 'Full-time', '2023-02-15', 'Published', '2023-01-15', 1, 0, '2023-01-15'),
('JP2302200000', 'E2300000', '00000000002', 'Digital Marketing Specialist', 'Creating and executing digital marketing campaigns', 'Bachelor’s degree in Marketing, SEO expertise', 'Innovative marketing strategies', 'Full-time', 'Selangor', 3000, 'Full-time', '2023-03-22', 'Published', '2023-02-25', 0, 0, '2023-02-20'),
('JP2303100000', 'E2300000', '00000000003', 'Financial Analyst', 'Analyzing financial data and preparing reports', 'Bachelor’s degree in Finance, CPA certification', 'Strategic financial planning', 'Senior-Level', 'Selangor', 120000, 'Full-time', '2023-04-15', 'Unpublished', '2023-03-15', 1, 0, '2023-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `jobSeekerID` varchar(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `emailAddress` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `isOpenForJobs` tinyint(1) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `working_experience` tinyint(2) DEFAULT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `graduate_year` int(4) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`jobSeekerID`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNumber`, `address`, `profilePic`, `resume`, `isOpenForJobs`, `created_at`, `working_experience`, `education_level`, `field_of_study`, `institution`, `graduate_year`, `skills`) VALUES
('JS2300000', 'Alice', 'Shau', 'shauyx-wm20@student.tarc.edu.my', '66f740643b5c73a459a0e9ea3c675974', '012-1234567', '12, Jalan ABC, KL', 'userProfile/JS2300002_profile.png', 'userResume/resume_655e1a0248381_Resume.pdf', 1, '2023-01-01', 1, 'Undergraduate', 'Computer Science', 'TARUMT', 2022, 'Java, Python, SQL'),
('JS2300001', 'Bob', 'Smith', 'bob.smith@example.com', '66f740643b5c73a459a0e9ea3c675974', '012-1234567', '456 Career Ave', 'userProfile/JS2300002_profile.png', 'userResume/resume_655e1a0248381_Resume.pdf', 1, '2023-02-01', 2, 'Master’s', 'Marketing', 'Innovate College', 2021, 'SEO, Social Media Marketing'),
('JS2300002', 'Charlie', 'Brown', 'charlie.brown@example.com', '66f740643b5c73a459a0e9ea3c675974', '012-1234567', '789 Opportunity Blvd', 'userProfile/JS2300002_profile.png', 'userResume/resume_655e1a0248381_Resume.pdf', 1, '2023-03-01', 5, 'Ph.D.', 'Finance', 'Global Institute', 2019, 'Financial Analysis, Risk Management');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` varchar(11) NOT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paymentStatus` varchar(30) DEFAULT NULL,
  `paymentDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentMethod`, `amount`, `paymentStatus`, `paymentDateTime`) VALUES
('P230115000', 'Credit / Debit Card', 3300, 'Completed', '2023-01-15 10:30:00'),
('P230220000', 'Paypal', 11000, 'Completed', '2023-02-20 12:45:00'),
('P230310000', 'Online Banking', 26400, 'Completed', '2023-03-10 15:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleID` varchar(11) NOT NULL,
  `paymentID` varchar(11) NOT NULL,
  `saleDateTime` datetime DEFAULT NULL,
  `subtotalAmount` double DEFAULT NULL,
  `taxAmount` double DEFAULT NULL,
  `totalAmount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleID`, `paymentID`, `saleDateTime`, `subtotalAmount`, `taxAmount`, `totalAmount`) VALUES
('S230115000', 'P230115000', '2023-01-15 10:35:00', 3000, 300, 3300),
('S230220000', 'P230220000', '2023-02-20 12:50:00', 10000, 1000, 11000),
('S230310000', 'P230310000', '2023-03-10 15:25:00', 24000, 2400, 26400);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscriptionID` varchar(11) NOT NULL,
  `saleID` varchar(11) NOT NULL,
  `subscriptionPlanID` varchar(11) NOT NULL,
  `employerID` varchar(11) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscriptionID`, `saleID`, `subscriptionPlanID`, `employerID`, `startDate`, `endDate`, `isActive`) VALUES
('SB232400000', 'S230310000', 'SP001', 'E2300000', '2023-01-15', '2024-01-15', 1),
('SB232400001', 'S230220000', 'SP002', 'E2300001', '2023-02-20', '2024-02-20', 1),
('SB232400002', 'S230310000', 'SP003', 'E2300002', '2023-03-10', '2024-03-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `subscriptionPlanID` varchar(11) NOT NULL,
  `planName` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` double DEFAULT NULL,
  `validityPeriod` varchar(255) DEFAULT NULL,
  `maxJobPosting` varchar(255) DEFAULT NULL,
  `maxJobApplication` varchar(255) DEFAULT NULL,
  `applicationRankingAvailability` tinyint(1) DEFAULT NULL,
  `maxFeatureJobListing` varchar(15) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`subscriptionPlanID`, `planName`, `description`, `price`, `validityPeriod`, `maxJobPosting`, `maxJobApplication`, `applicationRankingAvailability`, `maxFeatureJobListing`, `isActive`) VALUES
('SP001', 'Basic Plan', 'Standard features for small businesses', 3000, '1 Year', '5', '50', 1, '0', 1),
('SP002', 'Pro Plan', 'Advanced features for growing businesses', 10000, '1 Year', '15', '100', 1, '5', 1),
('SP003', 'Enterprise Plan', 'Customized solutions for large enterprises', 24000, '1 Year', '30', 'UNLIMITED', 1, '10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benefit`
--
ALTER TABLE `benefit`
  ADD PRIMARY KEY (`benefitID`),
  ADD KEY `employerID` (`employerID`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`employerID`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`applicationID`),
  ADD KEY `jobSeekerID` (`jobSeekerID`),
  ADD KEY `jobPostingID` (`jobPostingID`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`jobCategoryID`);

--
-- Indexes for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD PRIMARY KEY (`jobPostingID`,`employerID`),
  ADD KEY `jobCategoryID` (`jobCategoryID`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`jobSeekerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleID`),
  ADD KEY `paymentID` (`paymentID`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscriptionID`),
  ADD KEY `saleID` (`saleID`),
  ADD KEY `subscriptionPlanID` (`subscriptionPlanID`),
  ADD KEY `employerID` (`employerID`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`subscriptionPlanID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benefit`
--
ALTER TABLE `benefit`
  ADD CONSTRAINT `benefit_ibfk_1` FOREIGN KEY (`employerID`) REFERENCES `employer` (`employerID`);

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_ibfk_1` FOREIGN KEY (`jobSeekerID`) REFERENCES `job_seeker` (`jobSeekerID`),
  ADD CONSTRAINT `job_application_ibfk_2` FOREIGN KEY (`jobPostingID`) REFERENCES `job_posting` (`jobPostingID`);

--
-- Constraints for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD CONSTRAINT `job_posting_ibfk_1` FOREIGN KEY (`jobCategoryID`) REFERENCES `job_category` (`jobCategoryID`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`saleID`) REFERENCES `sales` (`saleID`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`subscriptionPlanID`) REFERENCES `subscription_plan` (`subscriptionPlanID`),
  ADD CONSTRAINT `subscription_ibfk_3` FOREIGN KEY (`employerID`) REFERENCES `employer` (`employerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
