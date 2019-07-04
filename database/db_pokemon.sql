-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 02:58 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pokemon`
--

CREATE DATABASE `db_pokemon`;
use `db_pokemon`;
-- --------------------------------------------------------

--
-- Table structure for table `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `max_cp` int(5) NOT NULL,
  `attact` int(5) NOT NULL,
  `defense` int(5) NOT NULL,
  `stamina` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pokemon`
--

INSERT INTO `pokemon` (`id`, `name`, `image`, `max_cp`, `attact`, `defense`, `stamina`) VALUES
(1, 'Kricketune', 'https://db.pokemongohub.net/images/official/detail/402.png', 1653, 160, 100, 184),
(2, 'Suicune', 'https://db.pokemongohub.net/images/official/detail/245.png', 2983, 180, 235, 225),
(3, 'Charizard', 'https://db.pokemongohub.net/images/official/detail/006.png', 2889, 223, 173, 186),
(4, 'Tyranitar', 'https://db.pokemongohub.net/images/official/detail/248.png', 3834, 251, 207, 225),
(7, 'Raikou', 'https://db.pokemongohub.net/images/official/detail/243.png', 3452, 241, 195, 207),
(9, 'Zekrom', 'https://db.pokemongohub.net/images/official/detail/644.png', 4654, 302, 242, 200),
(11, 'Guzzlord', 'https://db.pokemongohub.net/images/official/detail/799.png', 2906, 188, 99, 446),
(12, 'Golurk', 'https://db.pokemongohub.net/images/official/detail/623.png', 2673, 222, 154, 178);

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_of_type`
--

CREATE TABLE `pokemon_of_type` (
  `id` int(5) NOT NULL,
  `type_id` int(5) NOT NULL,
  `pokemon_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pokemon_of_type`
--

INSERT INTO `pokemon_of_type` (`id`, `type_id`, `pokemon_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 18, 2),
(4, 7, 3),
(5, 8, 3),
(6, 16, 4),
(7, 2, 4),
(16, 4, 7),
(18, 3, 9),
(19, 4, 9),
(20, 3, 10),
(21, 4, 10),
(22, 2, 11),
(23, 3, 11),
(24, 9, 12),
(25, 11, 12);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Bug'),
(2, 'Dark'),
(3, 'Dragon'),
(4, 'Electric'),
(5, 'Fairy'),
(6, 'Fighting'),
(7, 'Fire'),
(8, 'Flying'),
(9, 'Ghost'),
(10, 'Grass'),
(11, 'Ground'),
(12, 'Ice'),
(13, 'Normal'),
(14, 'Poison'),
(15, 'Psychic'),
(16, 'Rock'),
(17, 'Steel'),
(18, 'Water');

-- --------------------------------------------------------

--
-- Table structure for table `weakness_of_type`
--

CREATE TABLE `weakness_of_type` (
  `id` int(5) NOT NULL,
  `type_id` int(5) NOT NULL,
  `weakness_of_type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weakness_of_type`
--

INSERT INTO `weakness_of_type` (`id`, `type_id`, `weakness_of_type`) VALUES
(1, 1, 6),
(2, 1, 8),
(3, 1, 16),
(4, 2, 1),
(5, 2, 5),
(6, 2, 6),
(7, 3, 3),
(8, 3, 5),
(9, 3, 12),
(10, 3, 16),
(11, 4, 11),
(12, 5, 14),
(13, 5, 17),
(14, 6, 5),
(15, 6, 8),
(16, 6, 15),
(17, 7, 11),
(18, 7, 16),
(19, 7, 18),
(20, 8, 4),
(21, 8, 12),
(22, 8, 16),
(26, 9, 2),
(27, 9, 9),
(28, 10, 1),
(29, 10, 7),
(30, 10, 8),
(31, 10, 12),
(32, 10, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokemon_of_type`
--
ALTER TABLE `pokemon_of_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weakness_of_type`
--
ALTER TABLE `weakness_of_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pokemon_of_type`
--
ALTER TABLE `pokemon_of_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `weakness_of_type`
--
ALTER TABLE `weakness_of_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
