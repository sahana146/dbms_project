-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 07:56 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sahana`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `festivalupdate` ()  NO SQL
UPDATE item 
     SET discount=0.9 * discount 
     AND itemqty BETWEEN 100 AND 500$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `userID` int(11) DEFAULT NULL,
  `houseno` int(11) NOT NULL,
  `street` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`userID`, `houseno`, `street`, `city`, `pincode`) VALUES
(104, 600, 'Koogubande road', 'Mysore', '576008'),
(106, 766, 'ladyhill', 'Mangalore', '576884'),
(107, 545, 'kodialbail', 'Mangalore', '576449'),
(108, 878, 'Hootagalli', 'Mysore', '576880'),
(109, 811, 'Brahmavar', 'Udupi', '576213'),
(111, 98, 'Nagarabavi', 'Bangalore', '579901'),
(112, 871, 'Vijaynagar', 'Mysore', '560022'),
(113, 123, 'Matthikere', 'Chikmagalur', '567629'),
(114, 902, 'Sastana', 'Udupi', '576005'),
(118, 255, 'kollegal', 'chamarajanagar', '570006'),
(119, 128, 'chamundipuram', 'mysuru', '570009'),
(120, 456, 'muddanahalli', 'kolar', '576580'),
(121, 345, 'jinahalli', 'dharwad', '556790'),
(122, 345, 'charmady', 'mangalore', '546789'),
(125, 122, 'belavadi', 'mysuru', '560001');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `name`, `phone`, `photo`) VALUES
(1111, 'sumangala', '9164522789', 'sumangala.JPG'),
(1112, 'sahana', '9164534541', 'sahana.JPG'),
(1113, 'medha kalkura', '9231546345', 'medha.JPG'),
(1114, 'sushma jayaram', '9231546345', 'sushma.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `adminid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminid`, `username`, `password`) VALUES
(1111, 'sumangala', 'rhyeo'),
(1112, 'sahana', 'gowda'),
(1113, 'medha', 'kalkura'),
(1114, 'sushma', 'jayaram');

-- --------------------------------------------------------

--
-- Stand-in structure for view `finalreport`
-- (See below for the actual view)
--
CREATE TABLE `finalreport` (
`Type` varchar(20)
,`Available` decimal(32,0)
,`Sold` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `itemname` varchar(20) NOT NULL,
  `itemqty` int(11) NOT NULL,
  `itemprice` int(11) NOT NULL,
  `itemtype_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `userID`, `itemname`, `itemqty`, `itemprice`, `itemtype_id`, `discount`) VALUES
(7, 104, 'magazine', 10, 30, 102, 30),
(8, 127, 'Jeans_127', 10, 100, 103, 100),
(9, 127, 'Rods_127', 30, 100, 104, 100),
(10, 127, 'Dining table_127', 1, 3000, 106, 3000),
(11, 127, 'Newspaper_127', 5, 11, 102, 11);

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `add_item_dup` AFTER INSERT ON `item` FOR EACH ROW Insert into item_dup (item_id) values (new.itemID)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `items_sold`
--

CREATE TABLE `items_sold` (
  `userID` int(11) NOT NULL,
  `itemname` varchar(30) NOT NULL,
  `itemqty` int(11) NOT NULL,
  `itemprice` int(11) NOT NULL,
  `itemtypeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items_sold`
--

INSERT INTO `items_sold` (`userID`, `itemname`, `itemqty`, `itemprice`, `itemtypeid`) VALUES
(106, 'Bags_106', 12, 15, 101),
(104, 'bucket', 12, 20, 101),
(107, 'Cans_107', 5, 23, 101),
(107, 'Cupboard_107', 2, 320, 106),
(109, 'Dooms_109', 7, 10000, 105),
(106, 'Dupatta_106', 7, 15, 103),
(106, 'Ironframes_106', 10, 170, 104),
(109, 'Laptops_109', 3, 12000, 105),
(106, 'Ledgers_106', 15, 5, 102),
(104, 'mixer', 3, 800, 105),
(104, 'mobile', 5, 1000, 105),
(104, 'Newspaper_104', 10, 12, 102),
(106, 'Nokia mobile_106', 4, 270, 105),
(109, 'Rods_109', 15, 170, 104),
(104, 'Shirts_104', 12, 100, 103),
(108, 'Shirts_108', 20, 10, 103),
(106, 'Table_106', 6, 20, 106),
(108, 'Table_108', 4, 75, 106);

-- --------------------------------------------------------

--
-- Table structure for table `item_dup`
--

CREATE TABLE `item_dup` (
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_dup`
--

INSERT INTO `item_dup` (`item_id`) VALUES
(7),
(8),
(9),
(10),
(11);

--
-- Triggers `item_dup`
--
DELIMITER $$
CREATE TRIGGER `update_item_sold` AFTER DELETE ON `item_dup` FOR EACH ROW BEGIN

Insert into items_sold(userID,itemname,itemqty,itemprice,itemtypeid) select userID,itemname,itemqty,itemprice,itemtype_id from item where itemID=old.item_id;

DELETE from item where itemID=old.item_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `itemtypeid` int(11) NOT NULL,
  `itemtype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`itemtypeid`, `itemtype`) VALUES
(103, 'Cloth'),
(105, 'E-waste'),
(104, 'Metal'),
(102, 'Paper'),
(101, 'Plastic'),
(106, 'Wood');

-- --------------------------------------------------------

--
-- Table structure for table `ragpicker`
--

CREATE TABLE `ragpicker` (
  `ragID` int(11) NOT NULL,
  `rname` varchar(20) NOT NULL,
  `locality` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ragpicker`
--

INSERT INTO `ragpicker` (`ragID`, `rname`, `locality`, `photo`, `age`) VALUES
(901, 'somanna', 'jayanagara,mysuru', 'rag1.jpg', 40),
(902, 'beemanna', 'ladyhill,mangalore', 'rag2.jpg', 47),
(903, 'manjanna', 'mathikere,chikmagalur', 'rag3.jpg', 37),
(904, 'chikkanna', 'uppana,udupi', 'rag4.jpg', 40),
(905, 'doddanna', 'kodialbail,mangalore', 'rag5.jpg', 42),
(906, 'dharma', 'nagarbavi,bangalore', 'rag6.jpg', 45),
(907, 'dasappa', 'jinhalli,kolar', 'rag7.jpg', 39),
(908, 'muruli', 'kormangla,banglore', 'rag8.jpg', 46),
(909, 'raja', 'uppinkuduru,udupi', 'rag9.jpg', 49),
(910, 'mara', 'kollegala,chamarajanagar', 'rag10.jpg', 45);

-- --------------------------------------------------------

--
-- Stand-in structure for view `report`
-- (See below for the actual view)
--
CREATE TABLE `report` (
`type` varchar(20)
,`avialable` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `report1`
-- (See below for the actual view)
--
CREATE TABLE `report1` (
`type` varchar(20)
,`sold` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `signlogin`
--

CREATE TABLE `signlogin` (
  `userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signlogin`
--

INSERT INTO `signlogin` (`userID`, `username`, `password`) VALUES
(104, 'medhak', 'medha'),
(106, 'shankam', 'kamath'),
(107, 'piyagar', 'pppp'),
(108, 'shriy', 'shriya'),
(109, 'Zkhan', 'zoya'),
(111, 'rkrish', 'rkrk'),
(112, 'psam', 'sam'),
(113, 'sanapa', 'udupa'),
(114, 'vmad', 'maddy'),
(118, 'shreyas', 'shreyas'),
(119, 'deepu', 'deepak'),
(120, 'beeresh', 'beeresh'),
(121, 'dharmesh', 'lololo'),
(122, 'ashish', 'ashish'),
(125, 'mani', 'mani'),
(127, 'sonu', 'sonu');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `userID` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`userID`, `firstname`, `lastname`, `username`, `phone`, `photo`, `email`) VALUES
(104, 'Medha', 'Kalkura', 'medhak', '9876576008', 'images/user10.jpg', 'medhakkkk@gmail.com'),
(106, 'Shantanu', 'Kamath', 'shankam', '9234576884', 'images/user2.jpg', 'shankam@gmail.com'),
(107, 'Piya', 'Agarwal', 'piyagar', '7689576449', 'images/user3.jpg', 'piyagar@gmail.com'),
(108, 'Shriya', 'Sharma', 'shriy', '8964576880', 'images/user4.jpg', 'ssma@gmail.com'),
(109, 'Zoya', 'Khan', 'Zkhan', '8796576213', 'images/user5.jpg', 'zk321@gmail.com'),
(111, 'Ramya', 'Krishna', 'rkrish', '8612579901', 'images/user7.jpg', 'krish@gmail.com'),
(112, 'Parth', 'samthaan', 'psam', '9786560022', 'images/user8.jpg', 'psps@gmail.com'),
(113, 'Sanath', 'Udupa', 'sanapa', '8796567629', 'images/user9.jpg', 'sanath@gmail.com'),
(114, 'Vivek', 'Madhyasta', 'vmad', '7689576005', 'images/user17.jpg', 'vmad@gmail.com'),
(118, 'shreyas', 'A N', 'shreyas', '7869570006', 'images/user11.jpg', 'shreyas@gmail.com'),
(119, 'deepak', 'D C', 'deepu', '8976570009', 'images/user12.jpg', 'deepak@gmail.com'),
(120, 'beeresh', 'Huigere', 'beeresh', '6789576580', 'images/user13.jpg', 'beeresh@gmail.com'),
(121, 'dharmesh', 'khanna', 'dharmesh', '8976556790', 'images/user14.jpg', 'dharmesh@gmail.com'),
(122, 'ashish', 'kapoor', 'ashish', '7894546789', 'images/user15.jpg', 'ashish@gmail.com'),
(123, 'rohith', 'saraf', 'rohith', '6789567489', 'images/user16.jpg', 'Rohith@gmail.com'),
(125, 'mani', 'kapoor', 'mani', '9873463212', 'images/user1.jpg', 'mani@gmail.com'),
(127, 'sahana', 'gowda', 'sonu', '8295560859', 'images/user6.jpg', 'sahanagowda961@gmail.com');

-- --------------------------------------------------------

--
-- Structure for view `finalreport`
--
DROP TABLE IF EXISTS `finalreport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `finalreport`  AS  select `report`.`type` AS `Type`,`report`.`avialable` AS `Available`,`report1`.`sold` AS `Sold` from (`report` join `report1` on((`report`.`type` = `report1`.`type`))) ;

-- --------------------------------------------------------

--
-- Structure for view `report`
--
DROP TABLE IF EXISTS `report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report`  AS  select `item_type`.`itemtype` AS `type`,sum(`item`.`itemqty`) AS `avialable` from (`item_type` left join `item` on((`item`.`itemtype_id` = `item_type`.`itemtypeid`))) group by `item_type`.`itemtypeid` ;

-- --------------------------------------------------------

--
-- Structure for view `report1`
--
DROP TABLE IF EXISTS `report1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report1`  AS  select `j`.`itemtype` AS `type`,sum(`i`.`itemqty`) AS `sold` from (`item_type` `j` left join `items_sold` `i` on((`i`.`itemtypeid` = `j`.`itemtypeid`))) group by `j`.`itemtypeid` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD UNIQUE KEY `adminid` (`adminid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD UNIQUE KEY `itemname` (`itemname`),
  ADD KEY `itemtype_id` (`itemtype_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `items_sold`
--
ALTER TABLE `items_sold`
  ADD UNIQUE KEY `itemname` (`itemname`),
  ADD KEY `itemtypeid` (`itemtypeid`);

--
-- Indexes for table `item_dup`
--
ALTER TABLE `item_dup`
  ADD UNIQUE KEY `item_id` (`item_id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`itemtypeid`),
  ADD UNIQUE KEY `itemtype` (`itemtype`);

--
-- Indexes for table `ragpicker`
--
ALTER TABLE `ragpicker`
  ADD PRIMARY KEY (`ragID`);

--
-- Indexes for table `signlogin`
--
ALTER TABLE `signlogin`
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `photo` (`photo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ragpicker`
--
ALTER TABLE `ragpicker`
  MODIFY `ragID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=911;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `signup` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD CONSTRAINT `adminlogin_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`adminid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`itemtype_id`) REFERENCES `item_type` (`itemtypeid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `signup` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_dup`
--
ALTER TABLE `item_dup`
  ADD CONSTRAINT `item_dup_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`itemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `signlogin`
--
ALTER TABLE `signlogin`
  ADD CONSTRAINT `signlogin_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `signup` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
