-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 10:34 PM
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

--
-- Dumping data for table `assesment`
--

INSERT INTO `assesment` (`assesment_title`, `assesment_type`, `assesment_description`, `due_date`, `attachment_files`, `course_id`, `assesment_id`) VALUES
('Cloud', 'assignment', '<h2>Please submit on time</h2>', '2023-07-08', 0x2e2e2f75706c6f6164732f6173736573736d656e74732f36346136636664663363343333302e32323439353238372e706466, 4, 3),
('Kinematics Assignment 1 ', 'assignment', '<p>kindly submit on time </p>', '2023-09-08', 0x2e2e2f75706c6f6164732f6173736573736d656e74732f36346536363261333162343666332e38393237373534392e706466, 5, 5),
('Assignment 1 ITC', 'assignment', '<ol><li>Please Read it carefully </li><li>Please Submit on time </li></ol>', '2023-09-06', 0x2e2e2f75706c6f6164732f6173736573736d656e74732f36346538656131643965386339362e36383339303039302e646f6378, 6, 6);

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
(1, 4, 'Muhammad Sameer Sohail', 'meer.0009@icloud.com', '2023-07-08', '11:15:00'),
(2, 12, 'anass ali', 'm.sameersohail40@gmail.com', '2023-09-07', '17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `id` int(11) NOT NULL,
  `class_time` time NOT NULL,
  `class_date` date NOT NULL,
  `class_duration` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`id`, `class_time`, `class_date`, `class_duration`, `Course_id`) VALUES
(1, '09:30:00', '2023-08-28', 45, 5),
(2, '11:30:00', '2023-08-29', 25, 6);

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
('Computer', 4, 'Jawad', '2 months', 5000, 'For SSC Students', 4, 'computer.jpeg'),
('Physics ', 5, 'Muhammad Sameer', '2 months', 4500, 'For HSSC Students', 2, 'phy.jpeg'),
('Computer', 6, 'Muhammad Sameer', '3 weeks', 5000, 'Short computer course for exam preparation', 2, 'computer.jpeg'),
('Biology', 9, 'Umar', '6 weeks', 5000, 'Biology course for HSSC part 1 ', 12, 'bio.webp'),
('Chemistry O levels', 10, 'james', '6 weeks', 8000, 'Chemistry for O level students', 13, 'chemistry.jpg');

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

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`content_id`, `course_id`, `content_title`, `content_type`, `content_file`, `created_at`) VALUES
(4, 4, 'cloud Computing', 'documents', '../uploads/content/64a6cf98bd3163.35844390.pdf', '2023-07-06 14:28:40'),
(5, 4, 'cloud Computing', 'documents', '../uploads/content/64a6cfa2ed3db8.82071262.pdf', '2023-07-06 14:28:50'),
(6, 5, 'Thermo Dynamics', 'documents', '../uploads/content/64a6d0da7085b4.20869679.ppt', '2023-07-06 14:34:02'),
(7, 5, 'kinematics', 'documents', '../uploads/content/64e66150d2bec2.29233260.pdf', '2023-08-23 19:43:12'),
(8, 5, 'Dynamics', 'slides', '../uploads/content/64e66167157bc4.64143509.pptx', '2023-08-23 19:43:35'),
(9, 5, 'Gravitation', 'documents', '../uploads/content/64e66183646e84.82565982.pptx', '2023-08-23 19:44:03'),
(10, 6, 'Introduction to Computer', 'slides', '../uploads/content/64e8e921502e22.20359277.ppt', '2023-08-25 17:47:13'),
(11, 6, 'Computer and its components', 'slides', '../uploads/content/64e8e936679ba2.62322111.ppt', '2023-08-25 17:47:34');

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
(2, 3, 5, '', '2023-07-06 14:39:44', 'Abdullah', 'Physics ', 'Muhammad Sameer'),
(3, 9, 4, '', '2023-07-07 03:54:34', 'Ali ', 'Computer', 'Jawad'),
(4, 7, 9, '', '2023-08-23 20:36:50', 'ali', 'Biology', 'Umar');

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

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `course_id`, `assesment_id`, `user_id`, `grade`) VALUES
(1, 5, 2, 3, 55);

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created_at`, `user_name`, `type`, `is_read`) VALUES
(1, 'welcome to our platform ', '2023-07-06 15:09:05', 'Muhammad Sameer', 'info', 1);

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
(1, 'Abdullah', 'addullaharshadchoudhary@gmail.com', 'kot peer fazal shah', 'Lahore', 'Punjab', '55260', 'Abdullah', 'pdc45ZTWm+kZ+4uKL0CJ7SysOhfJnfWPhEAGqPz7mDI=', '02', '2025', '235', 'Physics ', 5, 4500, 'Muhammad Sameer', 3, 2, 4050, 450, 1),
(2, 'Ali ', '15000@students.riphah.edu.pk', 'malik colony near high school no 1 phool nagar', 'Lahore', 'Punjab', '55260', 'Abdullah', 'q/W45J4Z5yFXPfwjURQWufD5YQa43F00XfmG4dI9XgY=', '02', '2026', '335', 'Computer', 4, 5000, 'Jawad', 9, 4, 4500, 500, 1),
(3, 'ali', 'aliahmed@gmail.com', 'sabzazar Lahore', 'Lahore', 'Lahore', '55260', 'Ali Ahmed', 'd6kGmpi/obG2xDO1oC3G3Wv/drDUwT1WcDYmcYyLy7o=', '2', '2026', '323', 'Biology', 9, 5000, 'Umar', 7, 12, 4500, 500, 0);

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
(12, 'What  are lambda functions', 'micro services', 'functions which are to be run for a short and specific period of time', 'to carry out large computations', 'aws functions', 'micro services', 1, '2023-07-07 04:08:31', '2023-07-07 04:08:31', 4),
(13, 'what is cloud computing', 'computing over internet', 'Distributed Computing', 'Clusters of computers', 'linked computers', 'computing over internet', 1, '2023-07-07 04:12:49', '2023-07-07 04:12:49', 4),
(14, 'If a body does not rotates then its motion is', 'Vibratory ', 'rotatory', 'translational ', 'none of above', 'translational', 1, '2023-08-23 19:50:32', '2023-08-23 19:50:32', 5),
(15, 'What is the state of a passenger sitting in a moving bus?', 'uniform motion', 'rest', 'dynamic motion', 'relative motion', 'rest', 1, '2023-08-23 19:52:04', '2023-08-23 19:52:04', 5),
(16, 'What does CPU stand for?', 'Central Process Unit', 'Computer Personal Unit', 'Central Processor Unit', 'Central Personal Unit', 'Central Process Unit', 2, '2023-08-25 17:53:50', '2023-08-25 17:53:50', 6),
(17, 'Which of the following is considered the \"brain\" of the computer?', 'RAM', 'Monitor', 'Hard Drive', 'CPU', 'CPU', 2, '2023-08-25 17:55:30', '2023-08-25 17:55:30', 6),
(18, 'What does RAM stand for?', 'Random Access Memory', 'Read-Only Memory', 'Remote Access Memory', 'Rapid Application Memory', 'Random Access Memory', 2, '2023-08-25 17:56:12', '2023-08-25 17:56:12', 6);

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

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `course_id`, `score`, `user_id`) VALUES
(2, 4, 0, 9),
(3, 5, 100, 3),
(4, 4, 100, 9);

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

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `tutor_name`, `tutor_id`, `amount`, `withdraw_check`) VALUES
(1, 'Muhammad Sameer', 2, 4050, 1),
(2, 'Jawad', 4, 4500, 0);

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

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `user_id`, `assesment_id`, `comment`, `submission_date`, `file`, `course_id`, `path`, `username`, `is_graded`) VALUES
(2, 9, 3, 'nill', '2023-07-06 21:05:09', '64a78ef56345f1.33065509.pdf', 4, '../uploads/submissions/64a78ef56345f1.33065509.pdf', 'Ali ', 0),
(3, 3, 5, '', '2023-08-25 23:01:39', '64e8ec8369e810.24545560.docx', 5, '../uploads/submissions/64e8ec8369e810.24545560.docx', 'Abdullah', 0);

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

--
-- Dumping data for table `s_notifications`
--

INSERT INTO `s_notifications` (`id`, `message`, `created_at`, `user_name`, `type`, `is_read`) VALUES
(1, 'http://localhost/tutify/video/groupCall.html?roomID=room01', '2023-07-07 04:34:42', 'Abdullah', 'info', 1),
(2, 'Welcome to my course ', '2023-08-25 17:57:10', 'Abdullah', 'info', 0);

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
(13, 'Urdu', 50, '00:00:02');

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

--
-- Dumping data for table `tsa_quiz_results`
--

INSERT INTO `tsa_quiz_results` (`id`, `subject_id`, `subject_name`, `score`, `created_at`, `passed`) VALUES
(1, 1, 'English', 50, '2023-08-22 21:15:08', 0),
(2, 2, 'Physics ', 60, '2023-08-22 21:20:59', 0),
(3, 3, 'Chemistry', 40, '2023-08-26 16:44:41', 0);

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

--
-- Dumping data for table `tutor_reviews`
--

INSERT INTO `tutor_reviews` (`id`, `feedback_tutor_id`, `student_id`, `rating`, `comment`, `created_at`, `student_name`, `tutor_name`) VALUES
(1, 2, 3, 5, 'method of teaching is very good', '2023-07-06 15:06:51', 'Abdullah', 'Muhammad Sameer'),
(2, 12, 7, 5, 'good teacher', '2023-08-23 20:35:04', 'ali', 'Umar');

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
  `unique_id` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `user_type`, `password`, `verification_code`, `create_date`, `address`, `postal_code`, `area`, `country`, `state`, `ehistory`, `experience`, `degree`, `picture`, `hourly_rate`, `reset_token`, `unique_id`, `Subject`) VALUES
(1, 'admin', 'admin', 0, 'admin@gmail.com', 'Admin', '$2y$10$UvjwTyi/mRRAO/D6hRUsa..na2fvXI4jEEKd.594xoKjieSvpVUyS', '3454d24c04f25f921cc09a89cd4fb47d', '2023-05-24 20:19:22', '', '', '', '', '', '', '', '', '', 0.00, NULL, '', ''),
(2, 'Muhammad Sameer', 'sohail', 2147483647, 'sameersohail0009@gmail.com', 'Teacher', '$2y$10$3L1rVTkRawDcwtD6PHZ9w.4y3aM/UnZjM./foZnKSuVkfNcwXeCcq', '8b74831af4a533fc17a342833110b239', '2023-05-24 20:43:37', 'malik colony near high school no 1 phool nagar', '55260', 'Lahore', 'Pakistan', 'Punjab', 'nill', '2 year', 0x73616d656572284356292e706466, 0x73616d6d6d6d6d6d6d2e6a7067, 50.00, '', '', 'Computer Science'),
(3, 'Abdullah', 'Arshad', 2147483647, 'addullaharshadchoudhary@gmail.com', 'Student', '$2y$10$2jzwtLZNDlvcY2hg3Tjo3uHpoF1ThPGnSdxx.zsyVe0WLTwtCByEi', 'cec5f1f8351c1a628c566cd5020e20d3', '2023-05-24 21:20:01', 'kot peer fazal shah', '55260', 'Lahore', 'Pakistan', 'Punjab', '', '', '', 0x63682e6a7067, 0.00, NULL, '', ''),
(4, 'Jawad', 'Ahmed', 3177631, 'jawad.ahmed.dillhow56@gmail.com', 'Teacher', '$2y$10$On.IBrZJsy7WRaNt9EIksOrZx.DU106FOSPPUi4yR77tK85PynjBO', 'b60f74fa0e7207423bbef31450d86484', '2023-05-25 11:17:03', 'Thoker naiz baig', '5500', 'Lahore', 'Pakistan', 'Punjab', 'nill', '2 year', 0x6665652073756d2e706466, 0x6a61776164202e6a7067, 50.00, NULL, '', ''),
(7, 'ali', 'ahmed', 2147483647, 'aliahmed@gmail.com', 'Student', '$2y$10$juiQSoB.Kv7aZXjD0tsiTenKRHOS57zof73OiqceVgjdhFZvHQWHe', 'dc4e1f1f5f7ac6d895fdb55de25ade02', '2023-07-03 04:53:24', 'sabzazar Lahore', '55260', 'Lahore', 'Pakistan', 'Lahore', '', '', '', 0x7465636865722e6a706567, 0.00, NULL, '64a2b6b4d997e', ''),
(10, 'Ans', 'Ali', 2147483647, 'Anasali2190@gmail.com', 'Student', '$2y$10$0hmsPiMPza1GKAD/iuz4/.AfjGZIAMyoEKl6OHpifqdmmUK5AjSdC', 'f694dd188ad7fa445cc117d2de121e01', '2023-08-18 00:58:17', '', '', '', '', '', '', '', '', '', 0.00, NULL, '64de7bd9426c7', ''),
(12, 'Umar', 'Arif', 312548595, 'umararif555@gmail.com', 'Teacher', '$2y$10$VgZxwYn5u0WGKVGdSxZYa.KWfT5pr73YgO80vppD18QbnuOmvTmhS', '601729105235ffffab313f1b87b14bb0', '2023-08-23 02:20:59', 'house no 21, street Bhag wali HYD Sindh ', '55420', 'Sindh', 'Pakistan', 'Sindh', 'Nill', 'Medicine and Surgery ', 0x6665652073756d2e706466, 0x75737461642e6a706567, 500.00, NULL, '64e52662b8bff', 'Biology '),
(13, 'james', 'oliver', 1211255645, 'james55@gmail.com', 'Teacher', '$2y$10$XgZM3.o3MtC0DwMChzGiTOWpovAaX6XXGR0JKP7d8Ij2aDchLtt4S', '5cf89b1b75bb41316c86c0bf911a2353', '2023-08-26 21:44:41', '132, My Street, Kingston, ', '12401.', 'New York ', 'USA', 'New York', 'nill', 'Fresh', 0x50502041737369676e6d656e742e646f6378, 0x74322e6a706567, 550.00, NULL, '64ea2bca86639', 'Chemistry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assesment`
--
ALTER TABLE `assesment`
  ADD PRIMARY KEY (`assesment_id`),
  ADD KEY `FK_course_id_assesment_cascade_Delete` (`course_id`);

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
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `FK_course_id_cascade_Delete` (`course_id`);

--
-- Indexes for table `enrolmentt`
--
ALTER TABLE `enrolmentt`
  ADD PRIMARY KEY (`enrolment_id`),
  ADD KEY `FK_enrollment_cascade_Delete` (`course_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_grades_delete_Cascade` (`course_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_quiz_delete_Cascade` (`course_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_quiz_result_delete_Cascade` (`course_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `FK_submissions_delete_Cascade` (`assesment_id`);

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
  MODIFY `assesment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_content`
--
ALTER TABLE `course_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `enrolmentt`
--
ALTER TABLE `enrolmentt`
  MODIFY `enrolment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `s_notifications`
--
ALTER TABLE `s_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tsa_questions`
--
ALTER TABLE `tsa_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tsa_quiz_results`
--
ALTER TABLE `tsa_quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tutor_reviews`
--
ALTER TABLE `tutor_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assesment`
--
ALTER TABLE `assesment`
  ADD CONSTRAINT `FK_course_id_assesment_cascade_Delete` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `course_content`
--
ALTER TABLE `course_content`
  ADD CONSTRAINT `FK_course_id_cascade_Delete` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `enrolmentt`
--
ALTER TABLE `enrolmentt`
  ADD CONSTRAINT `FK_enrollment_cascade_Delete` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `FK_grades_delete_Cascade` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `FK_quiz_delete_Cascade` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `FK_quiz_result_delete_Cascade` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `FK_submissions_delete_Cascade` FOREIGN KEY (`assesment_id`) REFERENCES `assesment` (`assesment_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
