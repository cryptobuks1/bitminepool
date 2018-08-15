-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 04:55 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountbalance`
--

CREATE TABLE `accountbalance` (
  `id` int(100) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Register` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountbalance`
--

INSERT INTO `accountbalance` (`id`, `Balance`, `Username`, `Register`) VALUES
(88, '0', 'mshai', ''),
(89, '0', 'meettomangesh@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `binaryincome`
--

CREATE TABLE `binaryincome` (
  `id` int(11) NOT NULL,
  `userid` varchar(250) NOT NULL,
  `day_bal` varchar(250) NOT NULL,
  `current_bal` varchar(250) NOT NULL,
  `total_bal` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binaryincome`
--

INSERT INTO `binaryincome` (`id`, `userid`, `day_bal`, `current_bal`, `total_bal`) VALUES
(44, 'mshai', '0', '0', '0'),
(45, 'meettomangesh@gmail.com', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `Balance`, `Username`) VALUES
(56, '15', 'mshai'),
(57, '0', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dailymine`
--

CREATE TABLE `dailymine` (
  `id` int(11) NOT NULL,
  `Date` varchar(250) NOT NULL,
  `Pack` varchar(250) NOT NULL,
  `Btc` varchar(250) NOT NULL,
  `Usd` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grandpack`
--

CREATE TABLE `grandpack` (
  `id` int(11) NOT NULL,
  `PurchaseDate` varchar(250) NOT NULL,
  `MiningDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `CompletionDate` varchar(250) NOT NULL,
  `TotalMinable` varchar(250) NOT NULL,
  `Withdrawal` varchar(250) NOT NULL,
  `Comment` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grandpack`
--

INSERT INTO `grandpack` (`id`, `PurchaseDate`, `MiningDate`, `Username`, `Status`, `CompletionDate`, `TotalMinable`, `Withdrawal`, `Comment`) VALUES
(55, '0', '0', 'mshai', 'Inactive', '0', '4380', '0', 'Not-Purchased'),
(56, '0', '0', 'meettomangesh@gmail.com', 'Inactive', '0', '4380', '0', 'Not-Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `hangbtc`
--

CREATE TABLE `hangbtc` (
  `id` int(11) NOT NULL,
  `SendDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Btcamount` varchar(250) NOT NULL,
  `Btcaddress` varchar(250) NOT NULL,
  `Purpose` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hubcoin`
--

CREATE TABLE `hubcoin` (
  `id` int(100) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hubcoin`
--

INSERT INTO `hubcoin` (`id`, `Balance`, `Username`) VALUES
(88, '0', 'mshai'),
(89, '0', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(100) NOT NULL,
  `Paydate` varchar(250) NOT NULL,
  `Invoiceid` varchar(250) NOT NULL,
  `Purpose` varchar(250) NOT NULL,
  `Btcaddress` varchar(250) NOT NULL,
  `Amount` varchar(250) NOT NULL,
  `Btcamount` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `api_response` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `Paydate`, `Invoiceid`, `Purpose`, `Btcaddress`, `Amount`, `Btcamount`, `Status`, `Username`, `api_response`, `created_at`, `updated_at`) VALUES
(63, '22-07-2018', '2591182', 'Registration', '1FM3mZdwvfYGBYBhwD3jEj8c6YvH6KFm28', '100', '0.01407895', 'Paid', 'mshai', NULL, '2018-08-12 14:15:32', '2018-08-12 14:15:32'),
(64, '22-07-2018', '1890119', 'Registration', '1Pz53MmNYWxEeQ4WHzBZPAftoxjUguLmvi', '100', '0.01407895', 'Unpaid', 'meettomangesh@gmail.com', NULL, '2018-08-12 14:15:32', '2018-08-12 14:15:32'),
(65, '22-07-2018', '3801286', 'Starter', '1CPvdSmjvQt48ZiCYUnEMywPf1og1K3nwE', '300', '0.04116418', 'Paid', 'mshai', NULL, '2018-08-12 14:15:32', '2018-08-12 14:15:32'),
(66, '22-07-2018', '4237888', 'Starter', '1GxnZhQdwVwgg87JrrsKMtW3dVKmY7uezB', '300', '0.04116418', 'Unpaid', 'mshai', NULL, '2018-08-12 14:15:32', '2018-08-12 14:15:32'),
(67, '22-07-2018', '3063192', 'Starter', '1NkezVWetzGzg7BbacfcMDCcnerdtqtHT9', '300', '0.04116418', 'Unpaid', 'meettomangesh@gmail.com', NULL, '2018-08-12 14:15:32', '2018-08-12 14:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `mediumpack`
--

CREATE TABLE `mediumpack` (
  `id` int(11) NOT NULL,
  `PurchaseDate` varchar(250) NOT NULL,
  `MiningDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `CompletionDate` varchar(250) NOT NULL,
  `TotalMinable` varchar(250) NOT NULL,
  `Withdrawal` varchar(250) NOT NULL,
  `Comment` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mediumpack`
--

INSERT INTO `mediumpack` (`id`, `PurchaseDate`, `MiningDate`, `Username`, `Status`, `CompletionDate`, `TotalMinable`, `Withdrawal`, `Comment`) VALUES
(55, '0', '0', 'mshai', 'Inactive', '0', '2190', '0', 'Not-Purchased'),
(56, '0', '0', 'meettomangesh@gmail.com', 'Inactive', '0', '2190', '0', 'Not-Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `mining`
--

CREATE TABLE `mining` (
  `id` int(100) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mining`
--

INSERT INTO `mining` (`id`, `Balance`, `Username`) VALUES
(56, '0', 'mshai'),
(57, '0', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `minipack`
--

CREATE TABLE `minipack` (
  `id` int(11) NOT NULL,
  `PurchaseDate` varchar(250) NOT NULL,
  `MiningDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `CompletionDate` varchar(250) NOT NULL,
  `TotalMinable` varchar(250) NOT NULL,
  `Withdrawal` varchar(250) NOT NULL,
  `Comment` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `minipack`
--

INSERT INTO `minipack` (`id`, `PurchaseDate`, `MiningDate`, `Username`, `Status`, `CompletionDate`, `TotalMinable`, `Withdrawal`, `Comment`) VALUES
(55, '0', '0', 'mshai', 'Inactive', '0', '1095', '0', 'Not-Purchased'),
(56, '0', '0', 'meettomangesh@gmail.com', 'Inactive', '0', '1095', '0', 'Not-Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('3241da18cae0d9ee2cab4ca0633bfa507a56c673', 'web8989dsad8ff365fdg843839b', NULL, '2018-09-10 16:08:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('web8989dsad8ff365fdg843839b', '4c7f6f8fa93ghwd4302c0ae8c4aweb', 'https://bitminepool.com/', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(80) NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `Paydate` varchar(250) NOT NULL,
  `Payuser` varchar(250) NOT NULL,
  `Amountbtc` varchar(250) NOT NULL,
  `Amountusd` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `Paydate`, `Payuser`, `Amountbtc`, `Amountusd`) VALUES
(29, '2018-07-22', 'mshai', '0.01356391', '101.15882695'),
(30, '2018-07-22', 'meettomangesh@gmail.com', '0.01356391', '101.15882695'),
(31, '2018-07-22', 'mshai', '0.01356391', '101.15882695'),
(32, '2018-07-22', 'meettomangesh@gmail.com', '0.01356391', '101.15882695');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(100) NOT NULL,
  `Rank` varchar(250) NOT NULL,
  `Rankid` varchar(50) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Sponsor` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `Rank`, `Rankid`, `Username`, `Sponsor`) VALUES
(59, 'Miner', '1', 'mshai', 'mshai'),
(60, 'Miner', '1', 'meettomangesh@gmail.com', 'mshai ');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `EntryDate` varchar(250) NOT NULL,
  `Amount` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `EntryDate`, `Amount`, `Username`) VALUES
(53, '2018-07-22', '100', 'mshai'),
(54, '2018-07-22', '100', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `starterpack`
--

CREATE TABLE `starterpack` (
  `id` int(11) NOT NULL,
  `PurchaseDate` varchar(250) NOT NULL,
  `MiningDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `CompletionDate` varchar(250) NOT NULL,
  `TotalMinable` varchar(250) NOT NULL,
  `Withdrawal` varchar(250) NOT NULL,
  `Comment` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `starterpack`
--

INSERT INTO `starterpack` (`id`, `PurchaseDate`, `MiningDate`, `Username`, `Status`, `CompletionDate`, `TotalMinable`, `Withdrawal`, `Comment`) VALUES
(56, '2018-07-22', '2018-08-21', 'mshai', 'Active', '2019-07-22', '547.50', '0', 'Purchased'),
(57, '2018-07-22', '2018-08-21', 'meettomangesh@gmail.com', 'Active', '2019-07-22', '547.50', '0', 'Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(100) NOT NULL,
  `Ticketid` varchar(250) NOT NULL,
  `Date` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Issue` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `Category` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(100) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `Balance`, `Username`) VALUES
(94, '0', 'mshai'),
(95, '0', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teamvolume`
--

CREATE TABLE `teamvolume` (
  `id` int(100) NOT NULL,
  `Balance` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamvolume`
--

INSERT INTO `teamvolume` (`id`, `Balance`, `Username`) VALUES
(88, '300', 'mshai'),
(89, '300', 'meettomangesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(11) NOT NULL,
  `userid` varchar(250) DEFAULT NULL,
  `left` varchar(250) DEFAULT NULL,
  `right` varchar(250) DEFAULT NULL,
  `leftcount` int(50) DEFAULT '0',
  `rightcount` int(50) DEFAULT '0',
  `leftcredits` int(50) DEFAULT '0',
  `rightcredits` int(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `userid`, `left`, `right`, `leftcount`, `rightcount`, `leftcredits`, `rightcredits`) VALUES
(74, 'mshai', 'meettomangesh@gmail.com', '', 0, 0, 0, 0),
(75, 'meettomangesh@gmail.com', NULL, NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ultimatepack`
--

CREATE TABLE `ultimatepack` (
  `id` int(11) NOT NULL,
  `PurchaseDate` varchar(250) NOT NULL,
  `MiningDate` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `CompletionDate` varchar(250) NOT NULL,
  `TotalMinable` varchar(250) NOT NULL,
  `Withdrawal` varchar(250) NOT NULL,
  `Comment` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ultimatepack`
--

INSERT INTO `ultimatepack` (`id`, `PurchaseDate`, `MiningDate`, `Username`, `Status`, `CompletionDate`, `TotalMinable`, `Withdrawal`, `Comment`) VALUES
(55, '0', '0', 'mshai', 'Inactive', '0', '8760', '0', 'Not-Purchased'),
(56, '0', '0', 'meettomangesh@gmail.com', 'Inactive', '0', '8760', '0', 'Not-Purchased');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `under_userid` varchar(50) NOT NULL,
  `side` enum('left','right') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Username`, `under_userid`, `side`) VALUES
(54, 'meettomangesh@gmail.com', 'mshai', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `Fullname` varchar(250) NOT NULL,
  `Country` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Telephone` varchar(250) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `Sponsor` varchar(250) NOT NULL,
  `Token` varchar(250) NOT NULL,
  `Account` varchar(250) NOT NULL,
  `Activation` varchar(250) NOT NULL,
  `treestatus` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Fullname`, `Country`, `Email`, `Telephone`, `Gender`, `Username`, `Password`, `Status`, `Sponsor`, `Token`, `Account`, `Activation`, `treestatus`) VALUES
(89, 'Mshai', 'Kenya', 'family88@bitcoinminehub.com', '33446611', '2', 'mshai', '123', 'Close', '', '14685', '24rgxpwex1b4ko88owko ', '1', 'notree'),
(90, 'Mangesh Navale', 'India', 'meettomangesh@gmail.com', '09730872969', '1', 'meettomangesh@gmail.com', '7u8i9o0p', 'Open', 'mshai ', '730756', '42pswl2ze2gwg8c8gcg8 ', '1', 'tree');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountbalance`
--
ALTER TABLE `accountbalance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binaryincome`
--
ALTER TABLE `binaryincome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailymine`
--
ALTER TABLE `dailymine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grandpack`
--
ALTER TABLE `grandpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hangbtc`
--
ALTER TABLE `hangbtc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubcoin`
--
ALTER TABLE `hubcoin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediumpack`
--
ALTER TABLE `mediumpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mining`
--
ALTER TABLE `mining`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minipack`
--
ALTER TABLE `minipack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indexes for table `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indexes for table `oauth_scopes`
--
ALTER TABLE `oauth_scopes`
  ADD PRIMARY KEY (`scope`);

--
-- Indexes for table `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `starterpack`
--
ALTER TABLE `starterpack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamvolume`
--
ALTER TABLE `teamvolume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ultimatepack`
--
ALTER TABLE `ultimatepack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `accountbalance`
--
ALTER TABLE `accountbalance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `binaryincome`
--
ALTER TABLE `binaryincome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `dailymine`
--
ALTER TABLE `dailymine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;
--
-- AUTO_INCREMENT for table `grandpack`
--
ALTER TABLE `grandpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `hangbtc`
--
ALTER TABLE `hangbtc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hubcoin`
--
ALTER TABLE `hubcoin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `mediumpack`
--
ALTER TABLE `mediumpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `mining`
--
ALTER TABLE `mining`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `minipack`
--
ALTER TABLE `minipack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `starterpack`
--
ALTER TABLE `starterpack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `teamvolume`
--
ALTER TABLE `teamvolume`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `ultimatepack`
--
ALTER TABLE `ultimatepack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
