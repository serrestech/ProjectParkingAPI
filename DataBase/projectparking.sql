-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 07 Μάη 2017 στις 15:35:08
-- Έκδοση διακομιστή: 10.1.21-MariaDB
-- Έκδοση PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `projectparking`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cars`
--

CREATE TABLE `cars` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `sign` varchar(10) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `fromuser` int(10) NOT NULL,
  `touser` int(10) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `comments`
--

INSERT INTO `comments` (`id`, `fromuser`, `touser`, `content`) VALUES
(1, 39, 40, 'Hello');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `slots`
--

CREATE TABLE `slots` (
  `id` int(10) NOT NULL,
  `userid` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'free',
  `carid` int(10) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `slots`
--

INSERT INTO `slots` (`id`, `userid`, `status`, `carid`, `latitude`, `longitude`, `city`, `address`) VALUES
(2, NULL, 'free', NULL, 41.0750433, 23.5555892, 'Serres', 'TEI'),
(3, NULL, 'free', NULL, 41.0736147, 23.5529284, 'Serres', 'TEI II'),
(4, NULL, 'reserve', NULL, 25.35465343243, 56.6546423527353, 'Serres', 'TEICM');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `mobile`) VALUES
(39, 'iordkost', '43f2ca05ad146b3d6ab8a8ce6e394797', 'iordkost@teicm.gr', NULL),
(40, 'nikos', '80a7c011d8de90aa41299792b8334662', 'nikos5534@gmail.com', NULL),
(41, 'Ï†Ï€Ï†Ï€Ï†ÎºÏ†Îº', 'cdbdce87105f72368dae97523422870f', 'sjsjsjs@gmail.com', NULL),
(42, 'ÏƒÎºÎ´ÎºÎ´Î´Îº', 'bac62f18fe7c1773410497c86b49e2d9', 'nikos5@gmail.com', NULL),
(43, 'makis', '698d51a19d8a121ce581499d7b701668', 'makis@gmail.com', NULL),
(44, 'toyyuuo', '1bb52c26dfc9284534f58194b9b05b0a', 'arisabi@gmail.com', NULL),
(45, 'rororir', 'be4f714f784f464f9aa58d326116338d', 'nisksk@gmail.com', NULL),
(46, 'ff', '827ccb0eea8a706c4c34a16891f84e7b', 'aa@gmail.com', NULL),
(47, 'lalakisgr', 'd0970714757783e6cf17b26fb8e2298f', 'test@test.gr', NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromuser` (`fromuser`),
  ADD KEY `touser` (`touser`);

--
-- Ευρετήρια για πίνακα `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT για πίνακα `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT για πίνακα `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`fromuser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`touser`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
