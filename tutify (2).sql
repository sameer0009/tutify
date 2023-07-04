-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 11:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutify`
--

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

CREATE TABLE `assesment` (
  `assesment_title` varchar(255) NOT NULL,
  `assesment_type` varchar(255) NOT NULL,
  `assesment_description` longtext NOT NULL,
  `due_date` date NOT NULL,
  `attachment_files` longblob NOT NULL,
  `course_id` int(255) NOT NULL,
  `assesment_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `tutor_id`, `full_name`, `email`, `date`, `time`) VALUES
(1, 2, 'Muhammad Sameer Sohail', '15000@students.riphah.edu.pk', '2023-07-05', '09:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `id` int(11) NOT NULL,
  `class_time` time NOT NULL,
  `class_date` date NOT NULL,
  `class_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_name` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `course_intsructor` varchar(255) NOT NULL,
  `course_duration` varchar(255) NOT NULL,
  `course_price` int(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `instructor_id` int(255) NOT NULL,
  `course_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_name`, `course_id`, `course_intsructor`, `course_duration`, `course_price`, `course_description`, `instructor_id`, `course_image`) VALUES
('English', 1, 'Muhammad Sameer', '2 months', 3500, 'English course for SSC', 2, 'englisg.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `content_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `content_title` varchar(255) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `content_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrolmentt`
--

CREATE TABLE `enrolmentt` (
  `enrolment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `enrolment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_instructor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolmentt`
--

INSERT INTO `enrolmentt` (`enrolment_id`, `user_id`, `course_id`, `type`, `enrolment_date`, `user_name`, `course_name`, `course_instructor`) VALUES
(1, 3, 1, '', '2023-07-04 16:25:12', 'Abdullah', 'English', 'Muhammad Sameer');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `assesment_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `grade` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_read` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` text NOT NULL,
  `expmonth` varchar(2) NOT NULL,
  `expyear` varchar(4) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `course_price` float NOT NULL,
  `course_instructor` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `instructor_id` int(255) NOT NULL,
  `tutor_fee` int(255) NOT NULL,
  `platform_fee` int(255) NOT NULL,
  `salary_check` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `fullname`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expmonth`, `expyear`, `cvv`, `course_name`, `course_id`, `course_price`, `course_instructor`, `user_id`, `instructor_id`, `tutor_fee`, `platform_fee`, `salary_check`) VALUES
(1, 'Abdullah', 'addullaharshadchoudhary@gmail.com', 'kot peer fazal shah', 'Lahore', 'Punjab', '55260', 'Abdullah', 'AE77EsGeHvekXDInuqKsXbyS/SLDjB685sYX0MAs8vk=', '2', '2023', '556', 'English', 1, 3500, 'Muhammad Sameer', 3, 2, 3150, 350, 0),
(2, 'Abdullah', 'addullaharshadchoudhary@gmail.com', 'kot peer fazal shah', 'Lahore', 'Punjab', '55260', 'Abdullah', '+0DH8fQ+9HuIEuzAtyooodroLDottNxfc95nOHBRLCE=', '5', '2023', '333', 'English', 1, 3500, 'Muhammad Sameer', 3, 2, 3150, 350, 0);

-- --------------------------------------------------------

--
-- Table structure for table `platform_fee`
--

CREATE TABLE `platform_fee` (
  `platform_percentage` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platform_fee`
--

INSERT INTO `platform_fee` (`platform_percentage`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `question` varchar(1500) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `correct_answer` varchar(110) NOT NULL,
  `marks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `marks`, `created_at`, `updated_at`, `course_id`) VALUES
(1, 'What is the main function of an operating system?', 'Running applications', 'Managing hardware resources', 'Providing internet connectivity', 'Creating graphical user interfaces', 'Managing hardware resources', 2, '2023-05-24 17:32:31', '2023-06-09 19:25:44', 1),
(2, 'What does HTML stand for?', 'HyperText Markup Language', 'High Technical Markup Language', 'Home Tool Markup Language', ' Hyperlink Text Markup Language', ' HyperText Markup Language', 1, '2023-05-24 17:33:08', '2023-06-09 19:28:27', 1),
(3, 'Which programming language is known for its use in artificial intelligence and machine learning?', 'Python', 'Java', 'C++', ' Ruby', 'Python', 2, '2023-05-24 17:33:51', '2023-06-09 19:28:32', 1),
(4, 'What is the purpose of a firewall in computer networks?', 'To prevent unauthorized access', 'To increase network speed', 'To provide wireless connectivity', 'To store and manage data', 'To prevent unauthorized access', 2, '2023-05-24 17:34:28', '2023-06-09 19:28:35', 1),
(5, 'What is the binary representation of the decimal number 10?', '1010', '1100', '1001', '1110', '1010', 1, '2023-05-24 17:34:53', '2023-06-09 19:28:40', 1),
(6, 'What is the plural form of \"child\"?', 'Childs', 'Childes', 'Children', 'none of above', 'Children', 1, '2023-06-09 19:21:43', '2023-06-09 19:28:43', 1),
(8, 'hum apky hen kon?', 'Dost', 'Muhabbat', 'dsjkh', 'none of above', 'none of above', 1, '2023-06-09 19:22:52', '2023-06-09 19:28:50', 1),
(9, 'kiya hall hen', 'bs theek', 'theek', 'nhi theek', 'none of above', 'theek', 1, '2023-06-09 19:34:06', '2023-06-09 19:34:06', 1),
(10, '', '', '', '', '', '', 0, '2023-06-25 09:32:57', '2023-06-25 09:32:57', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `course_id` int(30) NOT NULL,
  `score` int(30) NOT NULL,
  `user_id` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(255) NOT NULL,
  `tutor_name` varchar(255) NOT NULL,
  `tutor_id` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `withdraw_check` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assesment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `submission_date` datetime NOT NULL DEFAULT current_timestamp(),
  `file` varchar(500) NOT NULL,
  `course_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `is_graded` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s_notifications`
--

CREATE TABLE `s_notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_read` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `passing_criteria` float NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `subject`, `passing_criteria`, `time`) VALUES
(1, 'English', 80, '00:02:54'),
(2, 'Physics ', 80, '00:07:50'),
(3, 'Chemistry', 80, '00:05:40'),
(4, 'Math', 50, '00:04:55'),
(5, 'Computer', 80, '00:07:20'),
(12, 'Urdu', 80, '00:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `tsa_questions`
--

CREATE TABLE `tsa_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `question` varchar(1500) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `correct_answer` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `marks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `question_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tsa_questions`
--

INSERT INTO `tsa_questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `subject`, `marks`, `created_at`, `updated_at`, `question_type`) VALUES
(1, 'What is the comparative form of the adjective \"good\"?', 'Gooder', 'Better', 'Best', 'More good', 'Better', 'urdu', 1, '2023-05-24 15:27:39', '2023-07-03 14:43:11', ''),
(2, 'Choose the correct spelling:', 'Acquaintence', 'Acquaintance', 'Acquantance', 'Acquaintanse', 'Acquaintance', 'English', 1, '2023-05-24 15:28:27', '2023-05-24 15:28:27', ''),
(3, 'Which of the following is a coordinating conjunction?', 'And', 'However', ' Because', 'Therefore', 'And', 'English', 1, '2023-05-24 15:29:12', '2023-05-24 15:29:12', ''),
(4, 'Which of the following words is a synonym for \"enormous\"?', ' Tiny', ' Huge ', ' Average', 'Small', 'Huge', 'English', 1, '2023-05-24 15:30:25', '2023-05-24 15:30:25', ''),
(5, 'Identify the correct spelling of the word:', 'Accomodate', 'Acommodate', 'Accommodate', 'Acomodate', 'Accommodate', 'English', 1, '2023-05-24 15:31:00', '2023-05-24 15:31:00', ''),
(6, 'What is the SI unit of force?', 'Newton (N)', 'Joule (J)', 'Watt (W)', 'Pascal (Pa)', 'Newton (N)', 'Physics', 1, '2023-05-24 15:32:24', '2023-05-24 15:32:24', ''),
(7, 'Which of the following is an example of a vector quantity?', 'Temperature', ' Mass', 'Speed', ' Displacement', 'Displacement', 'Physics', 3, '2023-05-24 15:33:01', '2023-05-24 15:33:01', ''),
(8, 'Which of the following electromagnetic waves has the highest frequency?', 'Radio waves', 'Microwaves', 'Visible light', 'X-rays', 'X-rays', 'Physics', 1, '2023-05-24 15:33:46', '2023-05-24 15:33:46', ''),
(9, 'Which of the following best defines momentum?', 'The force applied to an object', ' The mass of an object', 'The speed of an object', 'The product of mass and velocity of an object', 'The product of mass and velocity of an object', 'Physics', 1, '2023-05-24 15:34:46', '2023-05-24 15:34:46', ''),
(10, 'What is the SI unit of electric current?', 'Ampere', 'Volt', 'Ohm', 'Joule', ' Ampere', 'Physics', 1, '2023-05-24 15:35:23', '2023-05-24 15:35:23', ''),
(11, 'Which of the following elements has the chemical symbol \"Na\"?', 'Nitrogen', 'Sodium ', 'Nickel', 'Neodymium', 'Sodium', 'Chemistry', 1, '2023-05-24 15:36:43', '2023-05-24 15:36:43', ''),
(12, 'What is the chemical formula for water?', 'HO', 'H2O', 'O2', 'CO2', 'H2O', 'Chemistry', 1, '2023-05-24 15:37:20', '2023-05-24 15:37:20', ''),
(13, 'Which of the following is a noble gas?', 'Hydrogen', 'Helium', 'Oxygen', ' Carbon', 'Helium', 'Chemistry', 1, '2023-05-24 15:37:51', '2023-05-24 15:37:51', ''),
(14, 'What is the atomic number of carbon?', '12', ' 6 ', ' 8', '14', '6', 'Chemistry', 1, '2023-05-24 15:38:22', '2023-05-24 15:38:22', ''),
(15, 'Which of the following is an example of a base?', 'Vinegar', ' Lemon juice', 'Baking soda ', 'Hydrochloric acid', 'Baking soda ', 'Chemistry', 1, '2023-05-24 15:39:02', '2023-05-24 15:39:02', ''),
(16, 'What is the square root of 49?', '6', '7', '8', '9', '7', 'Math', 3, '2023-05-24 15:39:55', '2023-05-24 15:39:55', ''),
(17, 'What is the value of π (pi) rounded to two decimal places?', '3.14', '3.16', '3.18', '3.20', '3.14', 'Math', 3, '2023-05-24 15:40:30', '2023-05-24 15:40:30', ''),
(18, 'What is the result of 5² - 3²?', '4', '8', '16', '22', '16', 'Math', 2, '2023-05-24 15:41:07', '2023-05-24 15:41:07', ''),
(19, 'Which of the following is the smallest prime number?', '1', '2', '3', '4', '2', 'Math', 3, '2023-05-24 15:41:34', '2023-05-24 15:41:34', ''),
(20, 'Solve the equation: 2x + 5 = 17.', 'x = 6', 'x = 7', 'x = 8', 'x = 9', 'x = 6', 'Math', 5, '2023-05-24 15:42:12', '2023-05-24 15:42:12', ''),
(24, 'how', 'Childs', 'diificult', 'dam', 'new', 'none of above', 'urdu', 1, '2023-07-03 14:43:47', '2023-07-03 14:43:47', ''),
(25, 'xsck lk', 'hgjkl', 'hgjkl', 'fhgjklk', 'none of above', 'none of above', 'urdu', 2, '2023-07-03 15:00:30', '2023-07-03 15:00:30', ''),
(26, 'fghjkl', 'fghjkl;', 'cghjkl', 'ghjkl', 'none of above', 'none of above', 'urdu', 2, '2023-07-03 15:02:47', '2023-07-03 15:02:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `tsa_quiz_results`
--

CREATE TABLE `tsa_quiz_results` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `score` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `passed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_reviews`
--

CREATE TABLE `tutor_reviews` (
  `id` int(255) NOT NULL,
  `feedback_tutor_id` int(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `student_name` varchar(255) NOT NULL,
  `tutor_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `ehistory` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `degree` longblob NOT NULL,
  `picture` longblob NOT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `unique_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `user_type`, `password`, `verification_code`, `create_date`, `address`, `postal_code`, `area`, `country`, `state`, `ehistory`, `experience`, `degree`, `picture`, `hourly_rate`, `reset_token`, `unique_id`) VALUES
(1, 'admin', 'admin', 0, 'admin@gmail.com', 'Admin', '$2y$10$UvjwTyi/mRRAO/D6hRUsa..na2fvXI4jEEKd.594xoKjieSvpVUyS', '3454d24c04f25f921cc09a89cd4fb47d', '2023-05-24 20:19:22', '', '', '', '', '', '', '', '', '', 0.00, NULL, ''),
(2, 'Muhammad Sameer', 'sohail', 2147483647, 'sameersohail0009@gmail.com', 'Teacher', '$2y$10$tznB35g/GIF9bfpzloBnhu8656wCXl6sEaxC41xBVRMDu6//risei', '8b74831af4a533fc17a342833110b239', '2023-05-24 20:43:37', 'malik colony near high school no 1 phool nagar', '55260', 'Lahore', 'Pakistan', 'Punjab', 'nill', '2 year', 0x73616d656572284356292e706466, 0x73616d6d6d6d6d6d6d2e6a7067, 50.00, '405818', ''),
(3, 'Abdullah', 'Arshad', 2147483647, 'addullaharshadchoudhary@gmail.com', 'Student', '$2y$10$2jzwtLZNDlvcY2hg3Tjo3uHpoF1ThPGnSdxx.zsyVe0WLTwtCByEi', 'cec5f1f8351c1a628c566cd5020e20d3', '2023-05-24 21:20:01', 'kot peer fazal shah', '55260', 'Lahore', 'Pakistan', 'Punjab', '', '', '', 0x63682e6a7067, 0.00, NULL, ''),
(4, 'Jawad', 'Ahmed', 3177631, 'jawad.ahmed.dillhow56@gmail.com', 'Teacher', '$2y$10$On.IBrZJsy7WRaNt9EIksOrZx.DU106FOSPPUi4yR77tK85PynjBO', 'b60f74fa0e7207423bbef31450d86484', '2023-05-25 11:17:03', '', '', '', '', '', '', '', '', '', 0.00, NULL, ''),
(7, 'ali', 'ahmed', 2147483647, 'aliahmed@gmail.com', 'Student', '$2y$10$juiQSoB.Kv7aZXjD0tsiTenKRHOS57zof73OiqceVgjdhFZvHQWHe', 'dc4e1f1f5f7ac6d895fdb55de25ade02', '2023-07-03 04:53:24', '', '', '', '', '', '', '', '', '', 0.00, NULL, '64a2b6b4d997e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assesment`
--
ALTER TABLE `assesment`
  ADD PRIMARY KEY (`assesment_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `enrolmentt`
--
ALTER TABLE `enrolmentt`
  ADD PRIMARY KEY (`enrolment_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `s_notifications`
--
ALTER TABLE `s_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tsa_questions`
--
ALTER TABLE `tsa_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tsa_quiz_results`
--
ALTER TABLE `tsa_quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor_reviews`
--
ALTER TABLE `tutor_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assesment`
--
ALTER TABLE `assesment`
  MODIFY `assesment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrolmentt`
--
ALTER TABLE `enrolmentt`
  MODIFY `enrolment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_notifications`
--
ALTER TABLE `s_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tsa_questions`
--
ALTER TABLE `tsa_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tsa_quiz_results`
--
ALTER TABLE `tsa_quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutor_reviews`
--
ALTER TABLE `tutor_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
