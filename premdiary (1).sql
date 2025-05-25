-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 05:22 PM
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
-- Database: `premdiary`
--

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE `diary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `entry` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `note_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diary`
--

INSERT INTO `diary` (`id`, `user_id`, `title`, `entry`, `created_at`, `note_text`) VALUES
(2, 5, 'yeee', 'Chhath Puja is a significant Hindu festival celebrated to honor the Sun God, Surya, for bringing light, energy, and life to Earth. It is observed mainly in the Indian states of Bihar, Jharkhand, Uttar Pradesh, and in some parts of Nepal. The festival is unique as it involves praying to both the setting and rising sun, symbolizing the cycle of life and the importance of gratitude for each day.\r\n\r\nIn 2024, Chhath Puja was celebrated on Thursday, November 7. The sunrise on that day was at 06 AM, and the sunset was at 05 PM.\r\n The festival lasts for four days and includes fasting, holy baths, and arghya (water offerings) to the Sun God.\r\n\r\nChhath Puja is more than a religious celebration; it is a display of gratitude to Surya, the deity of light, warmth, and the life force. Devotees believe that the Sun God nourishes life on Earth and that his blessings can bring health, happiness, and success.\r\n\r\nThe festival is also celebrated by the diaspora in countries such as the United States, Australia, Singapore, the United Arab Emirates, Canada, Mauritius, Japan, and the United Kingdom, preserving their cultural heritage.\r\n\r\nChhath Puja has its origins in the Indian states of Bihar, Jharkhand, and', '2025-05-24 14:37:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `futmsgs`
--

CREATE TABLE `futmsgs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `open_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `futmsgs`
--

INSERT INTO `futmsgs` (`id`, `user_id`, `message`, `open_date`, `created_at`) VALUES
(1, 1, 'ghftyfgh', '2025-08-30', '2025-05-24 06:36:41'),
(2, 1, 'ghfvtdghvhjg', '2025-05-30', '2025-05-24 06:37:03'),
(3, 1, 'vtydf', '2025-05-29', '2025-05-24 06:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `memorybox`
--

CREATE TABLE `memorybox` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memorybox`
--

INSERT INTO `memorybox` (`id`, `user_id`, `image`, `description`, `created_at`) VALUES
(1, 1, 'Screenshot (3).png', 'hgftyfghj', '2025-05-24 06:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `reminder` text DEFAULT NULL,
  `remind_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `user`, `reminder`, `remind_at`, `created_at`) VALUES
(1, 'testuser', 'no', '2025-05-24 12:52:00', '2025-05-24 07:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `shared_goals`
--

CREATE TABLE `shared_goals` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `partner` varchar(100) DEFAULT NULL,
  `goal` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `url` text NOT NULL,
  `youtube_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `language`, `url`, `youtube_id`, `created_at`) VALUES
(1, 'Tum Hi Ho', 'Arijit Singh', 'Hindi', '', 'Umqb9KENgmk', '2025-05-24 06:49:56'),
(2, 'Perfect', 'Ed Sheeran', 'English', '', '2Vv-BfVoq4g', '2025-05-24 06:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `your_name` varchar(100) NOT NULL,
  `partner_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `your_name`, `partner_name`, `email`, `password`, `created_at`) VALUES
(5, 'anjali gupta', 'gaurav', 'anjaliprakash78177@gmail.com', '$2y$10$KoEn0J1yimaZdQivH2/p4eosF7.XRiEB2FqnkpSa34nkhdLxgNGIW', '2025-05-24 14:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user`, `item`, `created_at`) VALUES
(1, 'testuser', 'love', '2025-05-24 07:19:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `futmsgs`
--
ALTER TABLE `futmsgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memorybox`
--
ALTER TABLE `memorybox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared_goals`
--
ALTER TABLE `shared_goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diary`
--
ALTER TABLE `diary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `futmsgs`
--
ALTER TABLE `futmsgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memorybox`
--
ALTER TABLE `memorybox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shared_goals`
--
ALTER TABLE `shared_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diary`
--
ALTER TABLE `diary`
  ADD CONSTRAINT `diary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
