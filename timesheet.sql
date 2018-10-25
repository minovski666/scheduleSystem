-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2018 at 10:35 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `celebrated`
--

CREATE TABLE `celebrated` (
  `celebrated_id` int(10) NOT NULL,
  `celebrated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `celebrated`
--

INSERT INTO `celebrated` (`celebrated_id`, `celebrated_by`) VALUES
(1, 'Macedonian'),
(2, 'Albanian'),
(3, 'Serbian'),
(6, 'Jewish'),
(7, 'Bosnian'),
(8, 'Turks'),
(11, 'All'),
(12, 'Christian'),
(13, 'Muslims');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `region_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `nationality_id` int(10) NOT NULL,
  `religion_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `location_code` varchar(255) NOT NULL,
  `month_year` varchar(10) NOT NULL,
  `hours` int(10) NOT NULL,
  `night_hours` int(10) NOT NULL,
  `holiday` int(10) NOT NULL,
  `holiday_night` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `holiday_id` int(10) NOT NULL,
  `holiday` varchar(255) NOT NULL,
  `holiday_date` varchar(255) NOT NULL,
  `celebrated_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `region_id` int(10) NOT NULL,
  `location_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location`, `region_id`, `location_code`) VALUES
(1, 'All', 1, '00000');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `position_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `name`, `last_name`, `username`, `password`, `location_id`, `region_id`, `position_id`) VALUES
(4, 'admin', 'admin', 'admin', 'admin', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(10) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position`) VALUES
(1, 'Boss'),
(2, 'HR'),
(3, 'Admin'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(10) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region`) VALUES
(1, 'all');

-- --------------------------------------------------------

--
-- Table structure for table `schedule2`
--

CREATE TABLE `schedule2` (
  `schedule_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `shift_lenght` varchar(10) NOT NULL,
  `shift_night` varchar(255) NOT NULL,
  `holiday_day` varchar(255) NOT NULL,
  `holiday_night` varchar(255) NOT NULL,
  `day_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `monday` varchar(255) NOT NULL,
  `monday_shift` varchar(255) NOT NULL,
  `monday_date` varchar(255) NOT NULL,
  `tuesday` varchar(255) NOT NULL,
  `tuesday_shift` varchar(255) NOT NULL,
  `tuesday_date` varchar(255) NOT NULL,
  `wednesday` varchar(255) NOT NULL,
  `wednesday_shift` varchar(255) NOT NULL,
  `wednesday_date` varchar(255) NOT NULL,
  `thursday` varchar(255) NOT NULL,
  `thursday_shift` varchar(255) NOT NULL,
  `thursday_date` varchar(255) NOT NULL,
  `friday` varchar(255) NOT NULL,
  `friday_shift` varchar(255) NOT NULL,
  `friday_date` varchar(255) NOT NULL,
  `saturday` varchar(255) NOT NULL,
  `saturday_shift` varchar(255) NOT NULL,
  `saturday_date` varchar(255) NOT NULL,
  `sunday` varchar(255) NOT NULL,
  `sunday_shift` varchar(255) NOT NULL,
  `sunday_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `shift_id` int(10) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `hours` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `shift`, `hours`) VALUES
(1, 'First', 7),
(2, 'Second', 7),
(3, 'Between', 5),
(4, 'Free', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `celebrated`
--
ALTER TABLE `celebrated`
  ADD PRIMARY KEY (`celebrated_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_code` (`employee_code`),
  ADD KEY `FK_employees_cities_2` (`location_id`),
  ADD KEY `FK_employees_cities` (`region_id`),
  ADD KEY `FK_employees_celebrated` (`nationality_id`),
  ADD KEY `FK_employees_celebrated_2` (`religion_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `FK_files_employees` (`employee_code`),
  ADD KEY `FK_files_employees_2` (`location_code`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holiday_id`),
  ADD KEY `FK_holidays_celebrated` (`celebrated_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_code` (`location_code`),
  ADD KEY `FK_regions_cities` (`region_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `FK_managers_positions` (`position_id`),
  ADD KEY `FK_managers_cities` (`location_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `schedule2`
--
ALTER TABLE `schedule2`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `FK_schedule2_cities` (`location_id`),
  ADD KEY `FK_schedule2_employees` (`employee_id`),
  ADD KEY `FK_schedule2_regions` (`region_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `FK_schedules_employees` (`employee_id`),
  ADD KEY `FK_schedules_cities` (`location_id`),
  ADD KEY `FK_schedules_regions` (`region_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `celebrated`
--
ALTER TABLE `celebrated`
  MODIFY `celebrated_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `holiday_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `schedule2`
--
ALTER TABLE `schedule2`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_employees_celebrated` FOREIGN KEY (`nationality_id`) REFERENCES `celebrated` (`celebrated_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employees_celebrated_2` FOREIGN KEY (`religion_id`) REFERENCES `celebrated` (`celebrated_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employees_cities` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_employees_cities_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `holidays`
--
ALTER TABLE `holidays`
  ADD CONSTRAINT `FK_holidays_celebrated` FOREIGN KEY (`celebrated_id`) REFERENCES `celebrated` (`celebrated_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `FK_regions_cities` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `FK_managers_cities` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_managers_positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_managers_regions` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule2`
--
ALTER TABLE `schedule2`
  ADD CONSTRAINT `FK_schedule2_cities` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_schedule2_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_schedule2_regions` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `FK_schedules_cities` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_schedules_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_schedules_regions` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
