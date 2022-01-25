-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 25, 2022 at 10:23 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registrationunisys`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(50) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(50) NOT NULL,
  `stud_id` int(50) NOT NULL,
  `present` tinyint(1) NOT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `stud_id` (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `lesson_id`, `stud_id`, `present`) VALUES
(15, 37, 3, 0),
(16, 37, 5, 0),
(17, 37, 3, 0),
(18, 37, 5, 1),
(19, 40, 3, 1),
(20, 40, 5, 0),
(21, 41, 3, 0),
(22, 41, 5, 1),
(23, 41, 3, 0),
(24, 41, 5, 0),
(25, 43, 3, 1),
(26, 43, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(50) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(50) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `seats_num` int(10) NOT NULL,
  `available_seats` int(10) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `dept_id`, `seats_num`, `available_seats`) VALUES
(1, 'Big Data', 3, 50, 48),
(2, 'Data Mining', 3, 50, 48),
(3, 'Network', 3, 50, 47),
(4, 'Security', 3, 50, 48),
(5, 'OOP', 3, 50, 49);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(50) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'CS'),
(2, 'SC'),
(3, 'IS');

-- --------------------------------------------------------

--
-- Table structure for table `ituser`
--

DROP TABLE IF EXISTS `ituser`;
CREATE TABLE IF NOT EXISTS `ituser` (
  `user_id` int(50) NOT NULL,
  `user_type` int(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ituser`
--

INSERT INTO `ituser` (`user_id`, `user_type`, `user_name`) VALUES
(1, 0, 'Mahmoud Mostafa');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
  `lesson_id` int(50) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `prof_id` int(50) NOT NULL,
  `course_id` int(50) NOT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `course_id` (`course_id`),
  KEY `prof_id` (`prof_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `date`, `prof_id`, `course_id`) VALUES
(37, '2022-01-12', 6, 2),
(38, '2022-01-12', 6, 2),
(39, '2022-01-12', 6, 2),
(40, '2022-01-14', 6, 2),
(41, '2022-01-12', 2, 1),
(42, '2022-01-12', 2, 1),
(43, '2022-01-12', 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `prof_id` int(50) NOT NULL,
  `user_type` int(50) NOT NULL,
  `prof_name` varchar(50) NOT NULL,
  `course_id` int(50) NOT NULL,
  PRIMARY KEY (`prof_id`),
  KEY `prof_id` (`prof_id`,`user_type`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`prof_id`, `user_type`, `prof_name`, `course_id`) VALUES
(2, 1, 'Ahmed Mohamed', 1),
(6, 1, 'Wedad Hussein', 2),
(7, 1, 'Hashem Mohamed', 3),
(8, 1, 'Amir Mounier', 4),
(9, 1, 'Sally Saad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `stud_id` int(50) NOT NULL,
  `user_type` int(50) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `dept_id` int(50) NOT NULL,
  `paid_tuition` varchar(1) NOT NULL,
  PRIMARY KEY (`stud_id`),
  KEY `dept_id` (`dept_id`),
  KEY `stud_id` (`stud_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `user_type`, `stud_name`, `dept_id`, `paid_tuition`) VALUES
(3, 2, 'Wardshan Essam', 3, 'N'),
(5, 2, 'Waleed Ehab', 3, 'Y'),
(10, 2, 'Yussef Ayman', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `student_has_course`
--

DROP TABLE IF EXISTS `student_has_course`;
CREATE TABLE IF NOT EXISTS `student_has_course` (
  `student_id` int(50) NOT NULL,
  `course_id` int(50) NOT NULL,
  `grade` int(10) DEFAULT NULL,
  `absense_times` int(10) NOT NULL,
  PRIMARY KEY (`student_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_has_course`
--

INSERT INTO `student_has_course` (`student_id`, `course_id`, `grade`, `absense_times`) VALUES
(3, 1, 95, 2),
(3, 2, 90, 2),
(3, 3, NULL, 0),
(3, 4, NULL, 0),
(3, 5, NULL, 0),
(5, 1, 59, 1),
(5, 2, NULL, 2),
(5, 3, NULL, 0),
(5, 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` int(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `user_id` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'admin@gmail.com', 'admin', 0),
(2, 'drahmed@gmail.com', '12345', 1),
(3, 'ward@gmail.com', '12345', 2),
(5, 'waleed@gmail.com', '12345', 2),
(6, 'drwedad@gmail.com', '123', 1),
(7, 'drhashem@gmail.com', '1234', 1),
(8, 'dramir@gmail.com', '123', 1),
(9, 'drsally@gmail.com', '123', 1),
(10, 'yussef@gmail.com', '123', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`lesson_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`);

--
-- Constraints for table `ituser`
--
ALTER TABLE `ituser`
  ADD CONSTRAINT `ituser_ibfk_1` FOREIGN KEY (`user_id`,`user_type`) REFERENCES `users` (`user_id`, `user_type`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`prof_id`) REFERENCES `professor` (`prof_id`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`prof_id`,`user_type`) REFERENCES `users` (`user_id`, `user_type`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`stud_id`,`user_type`) REFERENCES `users` (`user_id`, `user_type`);

--
-- Constraints for table `student_has_course`
--
ALTER TABLE `student_has_course`
  ADD CONSTRAINT `student_has_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `student_has_course_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`stud_id`),
  ADD CONSTRAINT `student_has_course_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `student` (`stud_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
