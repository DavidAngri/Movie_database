-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 02:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_movies_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actor_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('male','female','others','') NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `name`, `gender`, `nationality`, `picture`) VALUES
(1, 'Rajinikanth', 'male', 'Indian', 'Rajinikanth.jpg'),
(2, 'Vijay Sethupathi', 'male', 'Indian', 'vijay_sethupathi.jpg'),
(3, 'Jet Li', 'male', 'Chinese', 'Jet_Li.jpg'),
(4, 'Maggie Cheung', 'female', 'Chinese', 'Maggie_Cheung.jpg'),
(5, 'Arnold Schwarzenegger', 'male', 'USA', 'Arnold_schwarzenegger.jpg'),
(6, 'Jamie Lee Curtis', 'female', 'USA', 'Jamie_Lee_Curtis.jpg'),
(7, 'Sigourney Weaver', 'female', 'USA', 'Sigourney_Weaver.jpg'),
(8, 'Tom Skerritt', 'male', 'USA', 'Tom_Skerritt.jpg'),
(9, 'Marion Cotillard', 'female', 'French', 'Marion_Cotillard.jpg'),
(10, 'Francois Cluzet', 'male', 'French', 'Francois_Cluzet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Comedy'),
(2, 'Action'),
(3, 'Drama'),
(4, 'Adventure'),
(5, 'History'),
(6, 'Horror'),
(7, 'Sci-Fi'),
(8, 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `director_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nationality` enum('USA','UK','French','Indian','Chinese') NOT NULL,
  `picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`director_id`, `name`, `nationality`, `picture`) VALUES
(1, 'Karthik Subbaraj', 'Indian', 'karthik_subbaraj.jpg'),
(2, 'Yimou Zhang', 'Chinese', 'Yimou_Zhang.jpg'),
(3, 'James Cameron', 'USA', 'James_Cameron.jpg'),
(4, 'Ridley Scott', 'UK', 'Ridley_Scott.jpg'),
(5, 'Guillaume Canet', 'French', 'Guillaume_Canet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_year` year(4) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `poster` varchar(100) NOT NULL,
  `director_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `release_year`, `synopsis`, `poster`, `director_id`) VALUES
(4, 'Petta', 2019, 'Though he works as a hostel warden, there is more to Kaali than meets the eye. Things take an interesting turn when Kaali\'s path crosses with a group of dreaded gangsters.', 'Petta.jpg', 1),
(5, 'Hero', 2002, 'A defense officer, Nameless, was summoned by the King of Qin regarding his success of terminating three warriors.', 'Hero.jpg', 2),
(6, 'True Lies', 1994, 'A fearless, globe-trotting, terrorist-battling secret agent has his life turned upside down when he discovers his wife might be having an affair with a used-car salesman while terrorists smuggle nuclear war heads into the United States.', 'True_Lies.jpg', 3),
(7, 'Alien', 1979, 'After a space merchant vessel receives an unknown transmission as a distress call, one of the crew is attacked by a mysterious life form and they soon realize that its life cycle has merely begun.', 'Alien.jpg', 4),
(8, 'Nous finirons ensemble', 2019, 'The result of the small handkerchiefs \"Petits mouchoirs\", 7 years later. The band, which erupted, is found on the occasion of the anniversary surprise organized for Max.', 'Nous_finirons_ensemble.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `movie_actor`
--

CREATE TABLE `movie_actor` (
  `movie_id` int(10) NOT NULL,
  `actor_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_actor`
--

INSERT INTO `movie_actor` (`movie_id`, `actor_id`) VALUES
(4, 1),
(4, 2),
(5, 3),
(5, 4),
(6, 5),
(6, 6),
(7, 7),
(7, 8),
(8, 9),
(8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `movie_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_category`
--

INSERT INTO `movie_category` (`movie_id`, `category_id`) VALUES
(4, 2),
(4, 3),
(5, 2),
(5, 4),
(5, 5),
(6, 1),
(6, 2),
(6, 4),
(7, 6),
(7, 7),
(8, 1),
(8, 3),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `movie_playlist`
--

CREATE TABLE `movie_playlist` (
  `movie_id` int(10) NOT NULL,
  `playlist_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `Fk_director_id` (`director_id`);

--
-- Indexes for table `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD PRIMARY KEY (`movie_id`,`actor_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`movie_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `movie_playlist`
--
ALTER TABLE `movie_playlist`
  ADD PRIMARY KEY (`movie_id`,`playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `FK_playlist_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `director_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `Fk_director_id` FOREIGN KEY (`director_id`) REFERENCES `directors` (`director_id`);

--
-- Constraints for table `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD CONSTRAINT `movie_actor_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `movie_actor_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`actor_id`);

--
-- Constraints for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD CONSTRAINT `movie_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `movie_category_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `movie_playlist`
--
ALTER TABLE `movie_playlist`
  ADD CONSTRAINT `FK_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `movie_playlist_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_playlist_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
