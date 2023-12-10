-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2023 at 08:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plantnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `userID` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(600) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` date NOT NULL,
  `role` tinyint(4) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userID`, `fullname`, `password`, `phone`, `address`, `gender`, `birthday`, `role`, `email`) VALUES
('admin', 'Nguyen Van Lam', '$2y$10$3K.MfyxYfle9esoR0h.Qkudrn2LK.K3PFHWcrKIMNwN9rOoosojA.', '0777898323', 'Ho Chi Minh city', 'male', '1999-01-01', 1, 'nvl@gmail.com'),
('mingvuong', 'Le Minh Vuongg', '$2y$10$Qf.1FPDrYJ83g6KwD98G2.1ekJodiHDiCivjq2L5ejeeRS8q6OQrO', '0909090909', 'Can Tho', 'female', '2000-01-02', 0, 'lmv@gmail.com'),
('minhbao', 'Nguyen Minh Bao', '$2y$10$mVjSgQpA9eXoTMPh6DoRce6mdXowmQpO.5IRdljMTp2FYRArpiyxG', '0945345652', 'Long Hung, On Mon, Can Tho', 'male', '2001-03-03', 0, 'nmb@gmail.com'),
('ngocy', 'Nguyen Ngoc Y', '$2y$10$snSVDXKVfpFub7QLThsHWufzfzdDAClpw2SGHFpN.0BnEFmj2olvu', '0773669034', 'Can Tho', 'female', '2004-11-02', 0, 'nvl@gmail.com'),
('thiuyen', 'Nguyen Thi Uyen', '$2y$10$T5GoM8AJNEO/g.9HNdXbrOisAoYDkLaTvLT4rMj3yUcppQlENQt/e', '9999999999', 'Can Tho', 'female', '2020-02-02', 0, 'nml@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Flowering'),
(2, 'Non-flowering'),
(3, 'Indoor'),
(4, 'Outdoor'),
(5, 'Succulents'),
(6, 'Medicinal'),
(7, 'Pots'),
(8, 'Garden tools'),
(9, 'Pesticides');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetailID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetailID`, `orderID`, `productID`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 59),
(2, 2, 33, 1, 78),
(3, 3, 74, 2, 40),
(4, 4, 62, 1, 78),
(14, 10, 75, 1, 99),
(15, 11, 75, 3, 99),
(16, 12, 76, 2, 100),
(17, 13, 20, 1, 259),
(18, 13, 14, 2, 98),
(19, 14, 13, 5, 228),
(20, 14, 22, 1, 50),
(21, 14, 30, 10, 200),
(22, 14, 32, 6, 55);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Waiting for confirmation',
  `note` varchar(600) DEFAULT NULL,
  `userID` varchar(50) NOT NULL,
  `totalAmount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `status`, `note`, `userID`, `totalAmount`) VALUES
(1, '2023-08-11', 'Delivered', 'Be careful, please!', 'ngocy', '59'),
(2, '2023-08-12', 'Confirmed', 'i need urgently', 'thiuyen', '78'),
(3, '2023-08-12', 'Denied', 'Be careful, please!', 'thiuyen', '78'),
(4, '2023-08-06', 'Delivered', 'Cover product name, please!', 'thiuyen', '78'),
(5, '2023-06-16', 'Waiting for confirmation', 'Delivered to me the day after tomorrow, please!', 'thiuyen', '78'),
(6, '2023-08-12', 'Delivered', 'Delivered to me on sunday, please!', 'ngocy', '78'),
(10, '2023-08-13', 'Waiting for confirmation', NULL, 'thiuyen', '99'),
(11, '2023-08-13', 'Waiting for confirmation', NULL, 'thiuyen', '297'),
(12, '2023-08-13', 'Waiting for confirmation', NULL, 'ngocy', '200'),
(13, '2023-08-13', 'Delivered', NULL, 'ngocy', '455'),
(14, '2023-08-13', 'Delivered', NULL, 'ngocy', '3520');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `unitPrice` decimal(10,0) NOT NULL,
  `height` varchar(255) NOT NULL,
  `uses` varchar(600) DEFAULT NULL,
  `growthHabits` varchar(600) DEFAULT NULL,
  `light` varchar(255) DEFAULT NULL,
  `water` varchar(255) DEFAULT NULL,
  `categoryID` int(11) NOT NULL,
  `imageURL` varchar(500) NOT NULL,
  `unitsInStock` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `unitPrice`, `height`, `uses`, `growthHabits`, `light`, `water`, `categoryID`, `imageURL`, `unitsInStock`) VALUES
(1, 'Philodendron Xanadu', '59', 'Medium plants measure between 10-16 inches.', 'Easy-care tropical houseplant that adds airy texture to any room. The plant ages, the shape of the lobed leaves gets more and more defined and unique.', 'This species can grow up to four feet tall under optimal conditions. Arrives in a nursery grow pot nestled in your planter choice.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 3, 'assets/images/indoor/indoor1.jpg', 100),
(2, 'Triostar Stromanthe', '39', 'Up to 6 feet tall and wide.', 'Stunning foliage fans out in streaks of cream, green and pink, with deep burgundy undersides. Perfect for a lower light area of the home.', 'Pot in a well draining soil mix and allow the top inch to dry out before watering. Keep away from vents and drafts, and supplement humidity in the winter for best results.', 'Bright indirect', 'Keep lightly moist', 3, 'assets/images/indoor/indoor2.jpg', 100),
(3, 'Snake Plant Laurentii', '64', 'Small plant measures between 6-12 inches; Medium plant measures between 16-24 inches; Large plant measures between 24-36 inches;', 'It is popular for its incredibly easy-going nature (it can tolerate low light and drought) and its air-purifying capabilities. ', 'The easiest way to kill this plant is to overcare for it. ', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 2-3 weeks, allowing soil to dry out between waterings.', 3, 'assets/images/indoor/indoor3.jpg', 100),
(4, 'Zamioculcas Zamiifolia', '78', 'Medium plants measure between 8-15 inches.', 'The ZZ Plant is characterized by its waxy green leaves above the surface of its potting mix, and its large potato-like rhizomes underneath. These rhizomes store water, making the ZZ a hardy, drought-tolerant houseplant that only needs water every few weeks.', 'You might spot large potato-like rhizomes under the surface of the ZZ Plant\'s soil. These store water to help the plant survive drought in its native habitat.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light. Not suited for intense, direct sun.', 'Water every 2-3 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 3, 'assets/images/indoor/indoor4.jpg', 100),
(5, 'Philodendron Silver', '68', 'Small and medium plants measure between 3–6 inches.', 'A species of Aroid that is prized for its heart-shaped leaves adorned with silvery splotches. This low-maintenance houseplant is perfect as a hanging plant but can be trained vertically since it\'s an evergreen climber!', 'The Silver Satin, a variety of Scindapsus pictus, is also commonly called the Satin Pothos or Silver Philodendron because of its similarities to those plants.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 3, 'assets/images/indoor/indoor5.jpg', 100),
(6, 'Philodendron Green', '78', 'Small and medium plants measure between 3–6 inches.', 'Why is the Philodendron our most popular plant year after year? It could be its heart-shaped green leaves, easy-going nature, or quick-growing trailing vines. Snag this low-maintenance houseplant now to bring the outdoors in.', 'Open environment, good soil.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 3, 'assets/images/indoor/indoor6.jpg', 100),
(7, 'Olive Tree', '68', 'Medium plant measures between 8-16 inches.', 'Olive trees (this specific variety is the Common Olive Tree) make beautiful houseplants. Pet friendly. ', 'These Mediterranean plants need a lot of bright, direct sunlight. South and west facing windows are ideal. ', 'Thrives in bright light to full sun conditions. Not suited for low light areas. South & West facing windows ideal, and consider grow lights in Fall/ Winter.', 'Water every 1 week, allowing soil to dry out halfway down between waterings. Tolerates normal room humidity levels.', 3, 'assets/images/indoor/indoor7.jpg', 100),
(8, 'Monstera ‘Thai Constellation’', '190', 'Small plant measures between 9 and 14 inches.', 'The highly coveted Monstera ‘Thai Constellation’ is a Monstera cultivar with eye-catching variegated cream and green heart-shaped leaves. This is a rare find! The unique, speckled coloring that puts the \"constellation\" in this variety\'s name (the variegation is likened to the  starry night sky) is due to a gene mutation, which means it can only be reproduced through propagation.', 'It will thrive best in bright, indirect light, which will help it retain its variegation. While the \'Thai Constellation grows a bit more slowly than straight-species varieties, it will still climb tall and can produce gorgeous, fenestrated leaves up to 15 inches wide, when given the right conditions.', 'Thrives in bright indirect to medium light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings.', 3, 'assets/images/indoor/indoor8.jpg', 100),
(9, 'Large Monstera Deliciosa', '228', 'Large plant measures between 20–28 inches.', 'Large plants benefit from brighter light to help retain their mature foliage. Large plants require less frequent waterings due to their higher volume of soil.', 'The Monstera is famous for its natural leaf holes, or fenestrations. The holes are theorized to maximize sun capture by increasing the spread of the leaf while decreasing the mass of leaf cells to support. Sized to ship best, our large Monstera arrives with room to grow as it adapts to your home’s conditions.', 'Thrives in bright indirect to medium light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings.', 3, 'assets/images/indoor/indoor9.jpg', 100),
(10, 'Monstera Deliciosa', '78', 'Medium plant measures between 12–24 inches; Large plant measures between 20–28 inches;', 'Nicknamed the swiss cheese plant, the Monstera deliciosa is famous for its quirky natural leaf holes. These holes are theorized to maximize sun fleck capture on the forest floor.', 'The Monstera is famous for its natural leaf holes, or fenestrations. The holes are theorized to maximize sun capture by increasing the spread of the leaf while decreasing the mass of leaf cells to support. Depending on the season and maturity of the plant, your Monstera could arrive with no holes just yet, and be sized to grow alongside you.', 'Thrives in bright indirect to medium light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light. Monsteras can benefit from filtered water or leaving water out overnight before using.', 3, 'assets/images/indoor/indoor10.jpg', 100),
(11, 'Staghorn Fern', '64', 'Small plant measures between 4-9.', 'This is a pet friendly plant.', 'Look very closely, and you may notice two distinct parts of the Staghorn: sporophytes (the stags) and gametophytes (the shields). Both play crucial roles in the epiphytic plant’s lifecycle.', 'Thrives in medium to bright indirect light.', 'Water every 1-2 weeks, allowing soil to dry out half way down between waterings.', 4, 'assets/images/outdoor/outdoor1.jpg', 100),
(12, 'Peace Lily ‘Domino’', '78', 'Medium plants measure between 12-16 inch.', 'These plants are known for their over-the-top ways of letting you know they need attention, specifically by flopping down in the most dramatic of ways when in need of water. This plant is known for its air purifying capabilities and took part in NASA\'s 1989 Clean Air Study.', 'Under bright light conditions, peace lilies will bloom tall white flowers year-round. They\'re also low-light tolerant, but keep the Domino in brighter light in order to retain its variegation.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 4, 'assets/images/outdoor/outdoor2.jpg', 100),
(13, 'Large Bird of Paradise', '228', 'Large plant measures between 24-30 inches.', 'With its broad vibrant green leaves, the Bird of Paradise brings a touch of the tropics to any room. It\'s named after its unique flowers, which resemble brightly colored birds in flight.', 'The Bird of Paradise thrives in warmer conditions with plenty of sunlight. The Bird of Paradise has leaf splitting which is a normal adaptive precaution to help the plant bear strong winds in its native habitat.', 'Thrives in bright indirect to direct light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings.', 4, 'assets/images/outdoor/outdoor3.jpg', 100),
(14, 'Large Fiddle Leaf Fig Tree', '98', 'Large plant measures between 42–50 inches.', 'Fiddle Leaf Fig, or Ficus lyrata, is famous for its broad green leaves with prominent veins that look great and accentuate your room.', 'Large plants benefit from brighter light to help retain their mature foliage. Large plants require less frequent waterings due to their higher volume of soil. It is sometimes described as “fickle” but will thrive in an environment with stable temps and bright light.', 'Thrives in bright indirect light to full sun. Can benefit from a few hours of direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 4, 'assets/images/outdoor/outdoor4.jpg', 100),
(15, 'Bird of Paradise', '78', 'Medium plant measures between 8 inches to 14 inches.', 'With its broad vibrant green leaves, the Bird of Paradise brings a bit of the tropics to any room. It\'s named after its unique flowers, which resemble brightly colored birds in flight (though the flowers don\'t often bloom in a houseplant setting in milder climates).', 'The Bird of Paradise thrives in warmer conditions with plenty of sunlight. The Bird of Paradise has leaf splitting which is a normal adaptive precaution to help the plant bear strong winds in its native habitat.', 'Thrives in bright indirect to direct light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings.', 4, 'assets/images/outdoor/outdoor5.jpg', 100),
(16, 'Dwarf Banana Tree', '74', 'Medium plant measures between 8 and 15 inches.', 'Pet friendly. This plant\'s broad, flat leaves are adorned with maroon blotches that fade as the plant ages.', 'Under optimal conditions, this plant can potentially produce actual bananas once it reaches at least three feet tall. ', 'Thrives in bright indirect to direct light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light. This plant can benefit from extra humidity.', 4, 'assets/images/outdoor/outdoor6.jpg', 100),
(17, 'Fiddle Leaf Fig ‘Bambino’', '62', 'Medium plant measures between 7–12 inches.', 'The Fiddle Leaf Fig ‘Bambino’ is a smaller version of the popular outdoor that boasts the same broad, vibrant green leaves.', 'It prefers a stable environment and can be fickle when temps fluctuate. Keep it in bright light, and water about once every 1 to 2 weeks.', 'Thrives in bright indirect light to full sun. Can benefit from a few hours of direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 4, 'assets/images/outdoor/outdoor7.jpg', 100),
(18, 'Barringtonia acutangula', '79', 'average height from 275-984 inches.', 'Brings fortune, luck and prosperity. Beautiful tree shape should be planted as an ornamental.', 'Sesame seeds are easy to grow, grow well when planted outdoors because the plant likes light, the amount of water the plant needs is moderate, and it doesn\'t like water retention.', 'Plant with direct sunlight.', 'The amount of water the plant needs is moderate.', 4, 'assets/images/outdoor/outdoor8.jpg', 100),
(19, 'Ornamental pomegranate', '289', 'Pomegranate tree has a height of 39 - 79 inches.', 'Pomegranate trees have beautiful roots, lush green leaves, and plump red pomegranates that create an extremely beautiful natural work for the garden.\r\n\r\n', 'Can be planted directly in the ground or in pots for ornamental purposes.', 'Plant the plant where it receives direct sunlight.', 'Water with moderate amount.', 4, 'assets/images/outdoor/outdoor9.jpg', 100),
(20, 'Ambassador', '259', 'The tree is of medium height.', 'Planting ambassadors in the garden grounds brings peace, lightness and purifies the air.', 'Porcelain plants are easy to grow, grow well, love the sun, are drought tolerant, so they do not need frequent watering.', 'Ambassador is a sun-loving plant.', 'Water with moderate amount, do not need frequent watering.', 4, 'assets/images/outdoor/outdoor10.jpg', 100),
(21, 'Phalaenopsis aphrodite', '32', 'Orchid measures between 8\"–14” tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'Aphrodite\'s phalaenopsis is a Northeast and Southeast Asia native plant. It has glossy, evergreen foliage and yellow-white blooms as attributes. In addition, this plant is easy to grow as long as it receives proper care.', 'Thrives in bright indirect light, but can tolerate medium indirect light. Direct sun tolerance is species dependant.', 'Water every 1-2 weeks, allowing potting medium to dry out between waterings. If kept in decorative, cache planter, pour out excess water after watering. Expect to water more often in brighter light and less often in lower light. This plant can benefit fro', 1, 'assets\\images\\flowering\\flowering1.jpg', 100),
(22, 'Anthurium andraeanum', '50', 'Small plant measures between 12–16\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'Has a bushy habit, and features a flowering yellow spike or spadix, which projects vertically from the base of the bract.', 'Thrives in bright indirect light, but can tolerate medium indirect light. Avoid direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light. This plant can benefit from extra humidity.', 1, 'assets\\images\\flowering\\flowering2.jpg', 100),
(23, 'Bromelia Vriesea orange', '60', 'Small plant measures between 14–18\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'The Vriesea Intenso Orange, or flaming sword houseplant, is one of the showiest bromeliads known for its bright orange spike, lasting as long as 3–6 months. It is a colorful, easy indoor plant that will brighten up any space. Added bonus, it’s non-toxic, making it safe to keep around curious pets.', 'Thrives in bright indirect light, but can tolerate a few hours of direct sun.', 'Each week, add water to the leaf cups (water tank), the center area created by overlapping leaves. As water cups tend to collect debris and insects, empty out each week and add new water. Bromeliads can be sensitive to hard tap water. Try using filtered w', 1, 'assets\\images\\flowering\\flowering3.jpg', 100),
(24, 'Pink Bromeliad', '45', 'Small plant measures between 12–16\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'The “pink” in Bromeliad Antonio Pink describes the fuchsia bracts found in this cultivar, which sometimes produce short-blooming purple flowers. Its vibrant bract also gives it its nickname, the Pink Quill Plant. This plant is pet-friendly!', 'Thrives in bright indirect light, but can tolerate a few hours of direct sun', 'Mist the plant regularly (2-3 times a week) and water the soil every 1–2 weeks, allowing it to dry out halfway between waterings. Expect to water more often in brighter light and less often in lower light. Bromeliads can be sensitive to hard tap water. Tr', 1, 'assets\\images\\flowering\\flowering4.jpg', 100),
(25, 'Guzmania lingulata', '77', 'Small plant measures between 14–18\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'Our Bromeliad Guzmania Hope sports a striking, bright red bract with white tips. A beautiful houseplant all year long, its bold and cheery color make it our go-to for a unique Mother’s Day, or any day, gift.', 'Thrives in bright indirect light, but can tolerate a few hours of direct sun from an East or West facing window. Not suited for low light or full direct afternoon sun.', 'Water every 1–2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light. Make sure the central cup of the plant has water within it at all times. This plant can benefit from extra humid', 1, 'assets\\images\\flowering\\flowering5.jpg', 100),
(26, 'Dracaena fragrans', '25', 'Small plant measures between 8\"-12\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'A member of the popular, low-maintenance Dracaena plant family, the Dracaena Fragrans ‘Sol’ has long, slender leaves adorned with green and yellow striations. This versatile plant will thrive best in bright light which helps it retain its color but it can tolerate lower light conditions.', 'Thrives in bright indirect light, but can tolerate medium to low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 1, 'assets\\images\\flowering\\flowering6.jpg', 100),
(27, 'Phalaenopsis aphrodite', '100', 'Orchid measures between 20–28\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'With its elegant stems and vibrant white flowers, this Phalaenopsis orchid makes any space feel chicer. You may notice a small number of blooms on your orchid upon delivery. These blooms will open quicker in a warm indoor setting. The Phalaenopsis will typically bloom about once a year for up to three months. After a blooming cycle, the flowers will wilt and fall off. This is the orchid’s way to store up energy to re-bloom again next season.', 'Thrives in bright indirect light, but can tolerate medium indirect light. Direct sun tolerance is species dependant.', 'Water every 1-2 weeks, allowing potting medium to dry out between waterings. If kept in decorative, cache planter, pour out excess water after watering. Expect to water more often in brighter light and less often in lower light. This plant can benefit fro', 1, 'assets\\images\\flowering\\flowering7.jpg', 100),
(28, 'Yellow Orchid', '90', 'Orchid measures between 16–22\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'These blooms will open more quickly in a warm, indoor setting. This plant will typically bloom about once a year, for up to three months at a time. After a blooming cycle, the flowers will wilt and fall off. This is the orchid’s way to store up energy to re-bloom again next season.\r\n', 'Thrives in bright indirect light, but can tolerate medium indirect light. Direct sun tolerance is species dependant.', 'Water every 1-2 weeks, allowing potting medium to dry out between waterings. If kept in decorative, cache planter, pour out excess water after watering. Expect to water more often in brighter light and less often in lower light. This plant can benefit fro', 1, 'assets\\images\\flowering\\flowering8.jpg', 100),
(29, 'Chlorophytum comosum', '69', 'Small plant measures between 3\"-6\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'The Spider Plant’s easy-going nature and green and white striped foliage make it one of the most popular houseplants around. It gets its name from the baby plants, or spiderettes, that dangle down from a mature mother plant like spiders on a web. Despite its creepy-crawly name, the Spider Plant is a lush, easy-care pick perfect for bringing life to your space.', 'Thrives in bright indirect light, but can tolerate medium indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 1, 'assets\\images\\flowering\\flowering9.jpg', 100),
(30, 'Hoya', '200', 'Medium plant measures between 4-6\" tall from the soil line to the top of the foliage', 'In addition, this plant is easy to grow as long as it receives proper care.', 'The Hoya hindu rope, scientifically known as Hoya carnosa \'compacta\' is an easy-going trailing plant originating from India as an epiphyte. Vines of twisted, thick and waxy leaves will brighten up any room, and the plant may put out dainty, sweet-smelling flowers. Great for hanging baskets or anywhere with space for the vines to trail. ', 'Thrives in bright indirect light. Can benefit from a few hours of direct sun depending on the species.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 1, 'assets\\images\\flowering\\flowering10.jpg', 100),
(31, 'Calathea Rattlesnake', '50', 'Small plants measure between 10\"-16\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'The Calathea Rattlesnake is known for its long, wavy green leaves with a brushstroke pattern resembling reptile skin. It raises and lowers these leaves from day to night, a phenomenon called nyctinasty and the source behind its nickname prayer plant. This plant is pet-friendly!', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out half way down between waterings. Expect to water more often in brighter light and less often in lower light. This plant can benefit from extra humidity. Calatheas can be sensitive to hard tap water. Try usin', 2, 'assets\\images\\non-flowering\\non-flowering1.jpg', 100),
(32, 'Dracaena fragrans', '55', 'Small plant measures between 8\"-12\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'A member of the popular, low-maintenance Dracaena plant family, the Dracaena Fragrans ‘Sol’ has long, slender leaves adorned with green and yellow striations. This versatile plant will thrive best in bright light which helps it retain its color but it can tolerate lower light conditions.', 'Thrives in bright indirect light, but can tolerate medium to low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering2.jpg', 100),
(33, 'Chinese evergreen', '78', 'Medium plant measures between 9-14\" tall from the soil line to the top of the foliage ', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'Embrace color with this unique Aglaonema cultivar, Wishes. A fitting name since the Aglaonema is said to bring luck, fortune, and general positivity to those who grow it. Whether you believe in its hidden powers or not, there’s no denying this colorful plant will bring joy to your space.', 'Thrives in medium to bright indirect light. Can tolerate low light conditions. Not suited for direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering3.jpg', 100),
(34, 'Fern', '35', 'Large plant measures between 12\"-18\" tall from the soil line to the top of the foliage ', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'The iconic Boston Fern is perfect for an outdoor porch during the warmer months or grown year-round indoors. This Fern is tolerant of low light and appreciative of high humidity. It is also considered pet-friendly or non-toxic, making it safe to keep around curious four-legged friends.', 'Thrives in medium to bright indirect light, but can tolerate low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out half way down between waterings. Expect to water more often in brighter light and less often in lower light. This plant can benefit from extra humidity.', 2, 'assets\\images\\non-flowering\\non-flowering4.jpg', 100),
(35, 'Corkscrew rush', '299', 'Small plant measures between 5- to 8-inches tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'uncus effusus \'Spiralis,\' commonly referred to as Corkscrew Rush, is an unusual eye-catching evergreen cultivar with coiled, leafless stems. This versatile, low-maintenance plant is perfect for beginners. It loves moist soil and can grow up to three feet tall.', 'Corkscrew rush requires abundant, bright and direct light.', 'Use our water calculator to personalize watering recommendations to your environment or download Greg for more advanced recommendations for all of your plants.', 2, 'assets\\images\\non-flowering\\non-flowering5.jpg', 100),
(36, 'Dracaena angustifolia', '190', 'Large plant measures between 32–40\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'The Dracaena marginata, or Dragon Tree, is a popular low-maintenance plant native to Madagascar. Its unique silhouette and height make it our go-to pick for upgrading any corner! Sized to ship best, our large Dracaena arrives with room to grow as it adapts to your home’s conditions.', 'Thrives in bright indirect light, but can tolerate medium to low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering6.jpg', 100),
(37, 'Dracaena fragrans', '99', 'Large plant measures between 32\"-42\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'A member of the popular, low-maintenance Dracaena plant family, the Dracaena Warneckii (sometimes called a corn plant) has a tall and slender silhouette that is great in corners, behind couches, or anywhere you want to add height without bulk. Sized to ship best, our large Dracaena arrives with room to grow as it adapts to your home’s conditions. ', 'Thrives in bright indirect light, but can tolerate medium to low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering7.jpg', 100),
(38, 'Rubber fig', '70', 'Plant measures between 7–12\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'The Ficus elastica ’Tineke’ – or variegated rubber tree – is a popular variety of ficus known for its beautiful pink, green, and yellow leaves. The Tineke’s striking variegation and easy-going nature make it the perfect new plant to add to your sill this year.', 'Thrives in bright indirect light. Can benefit from a few hours of direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering8.jpg', 100),
(39, 'Dracaena fragrans', '150', 'Large plant measures between 30\"-40\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'A member of the popular, low-maintenance Dracaena plant family, the Dracaena Lemon Lime takes its name from the bright yellow and green variegation of its sword-like leaves. This striking floor plant is a great way to add vertical interest and texture to corners, alongside windows, or anywhere you want some height and texture. Sized to ship best, our large Dracaena arrives with room to grow as it adapts to your home’s conditions. ', 'Thrives in bright indirect light, but can tolerate medium to low indirect light.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering9.jpg', 100),
(40, 'Ficus Altissima', '90', 'Large plant measures between 36-42\" tall from the soil line to the top of the foliage', 'In addition, this plant is very easy to grow with proper care. Make your space greener', 'The Ficus Altissima is known for its beautiful, lemon-lime variegated leaves. It is a popular variety of ficus known for its ability to grow to great heights, but will only grow to about 6 feet indoors. The Altissima does well with bright filtered light making it a great new plant to add to your sill this Spring.', 'Thrives in bright indirect light. Can benefit from a few hours of direct sun.', 'Water every 1-2 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 2, 'assets\\images\\non-flowering\\non-flowering10.jpg', 100),
(41, 'Cuddly Cactus', '88', 'Small plants measure 5-8\" tall from the soil line to the top of the foliage', 'Decorate', 'The Cuddly Cactus gets its name due to the absence of spine clusters, making it a safe option to keep around pets and children. Like most cacti, the evergreen Cereus cactus is drought-tolerant and loves sun.', 'Thrives in bright light to full sun. Not suited for areas with low light. South & west facing windows ideal, and consider grow lights in fall/winter.', 'Water every 2 to 3 weeks, allowing soil to thoroughly dry out between waterings. Expect to water more often in brighter light conditions and less often in lower light. Tolerates normal room humidity or dry conditions.', 5, 'assets/images/succulents/succulents01.jpg', 100),
(42, 'Echeveria Garotto', '68', 'Small plant measures between 1–2\" tall from the soil line to the top of the foliage', 'Decorate', 'Echeveria Garotto is a succulent in the Crassulaceae family native to Mexico. This vibrant plant is prized for its large rosette growth habit, adorned with blueish green pigmentation. The colors are more prominent when exposed to direct sunlight making it perfect for a small windowsill or sunny space.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents02.jpg', 100),
(43, 'Cacti Assortment', '68', '2\"', 'Decorate', 'Perfect for a small windowsill, our assortment includes a variety of three or six miniature cacti in their 2\" nursery grow pots. They require bright, direct light—but little else.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents03.jpg', 100),
(44, 'Cacti Assortment with Planters', '82', '2\"', 'Decorate', 'This exclusive set is perfect for a small windowsill or sunny space, and hard to kill. You’ll get a variety of miniature Cacti with matching planters to display them in.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents04.jpg', 100),
(45, 'Ball Cactus', '68', 'Small plants measure 2-4\" tall from the soil line to the top of the foliage', 'Decorate', 'The Gymnocalycium horstii, commonly referred to as Ball Cactus, has a globose shaped stem with minimal spines, only growing a little under a foot tall. The plant can be easily propagated by removing pups at the base of the stem or you can let them clump freely to produce a more interesting specimen. Like other cacti, this drought-tolerant species will pair well in any room with a sunny window!', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents05.jpg', 100),
(46, 'Summer Succulent', '64', '1–3\"', 'Decorate', 'The Summer Succulent is a colorful succulent that is pet friendly and perfect for a small windowsill or sunny space. It contains three varieties of Sempervivum species in one pot. This cute mix is a fun way to bring a pop of color and texture into any room.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents06.jpg', 100),
(47, 'Fairy Castle Cactus', '68', 'Small plants measure 4-6\" tall from the soil line to the top of the foliage', 'Decorate', 'The Fairy Castle Cactus gets its charming name due to its stalks resembling the architecture of a castle. Like most cacti, this evergreen Cereus cactus is drought-tolerant and loves a sunny window sill. Under optimal conditions over the years this plant can eventually reach between 5-6 feet tall! ', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents07.jpg', 100),
(48, 'Kalanchoe Flapjack', '48', 'Small plant measures between 4–9\" tall from the soil line to the top of the foliage', 'Decorate', 'The Kalanchoe thyrsiflora is commonly referred to as Flapjack succulent due to its large flat leaves that appear to be stacked together like pancakes. This drought-tolerant succulent can grow over 12 inches tall and direct sun exposure helps to create pinkish-red pigments on the edges of the leaves. ', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents08.jpg', 100),
(49, 'Blue Candle Cactus', '78', 'Medium plants measure 5-9\" tall from the soil line to the top of the foliage', 'Decorate', 'The Myrtillocactus geometrizans, commonly referred to as Blue Candle Cactus, is a species of Cacti native to Mexico. It is a popular variety that gets its name due to its unusual blue-green colored stems that branch freely like a candelabra. Like most cacti, this evergreen cactus is drought-tolerant and will thrive well in a sunny window.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents09.jpg', 100),
(50, 'Column Cactus', '74', 'Medium plants measure 5-8\" tall from the soil line to the top of the foliage', 'Decorate', 'The Column Cactus is a treelike columnar cactus that typically reaches between 3-6 feet in height when grown indoors. Species in the Browningia genus have drought-tolerant stems that range in color from blue to dark green with pronounced ribs. This slow growing plant will make a perfect addition to any sunny window. ', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents10.jpg', 100),
(51, 'Yellow Tower Cactus', '78', 'Medium plants measure 3-6\" tall from the soil line to the top of the foliage', 'Decorate', 'The Notocactus leninghausii, commonly referred to as Yellow Tower Cactus, is native to Southern Brazil and is prized for its bright golden spines. After it has reached maturity, it\'ll bloom a large white-yellow flower on its crown during Spring. This drought-tolerant plant is sure to bring joy in any home or office with a sunny window.', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents11.jpg', 100),
(52, 'Sunny Sill Trio', '168', 'Small Cacti arrive in 4\" grow pots nestled in your planter choice', 'Decorate', 'Cacti are a wide range of drought-tolerant plants. This exclusive set is perfect for a small windowsill or sunny space, and includes our Ball, Ladyfinger and Fairy Castle cacti. This variety of Cacti will arrive in grow pots or choose matching planters to display them in!', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents12.jpg', 100),
(53, 'Ladyfinger Cactus', '68', 'Small plants measure 3-6\" tall from the soil line to the top of the foliage', 'Decorate', 'The Mammillaria elongata, commonly referred to as Ladyfinger Cactus, is a species of Cacti native to central Mexico with dark green stems and bronze-orange spines. This drought-tolerant species creates clusters of offsets that can easily be propagated to form new plants. Under optimal conditions, it may surprise you with delicate pink or yellow flowers in Spring. ', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents13.jpg', 100),
(54, 'Small Spines Duo', '118', 'Medium cactus arrives in 6\" grow pot and small cactus arrives in 4\" grow pot, nestled in your planter choice', 'Decorate', 'Cacti are a wide range of drought-tolerant plants. This exclusive duo is perfect for a small windowsill or sunny space, and includes our medium Blue Candle and small Ball Cactus. This variety of Cacti will arrive in grow pots or choose matching planters to display them in!', 'Thrives in bright direct light, but can tolerate bright indirect light.', 'Water every 2-3 weeks in direct light, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.', 5, 'assets/images/succulents/succulents14.jpg', 100),
(55, 'Topsin M/Thiophanate Methyl', '1', '', 'Thiophanate Methyl provides curative preventive and systemic chemical against abroad spectrum of plant diseases on fruits vegetables and turf. In general thiophanate-methyl is considered a single-site fungicide and runs the risk of developing disease resistance for certain fungi strains. Therefore it is very important to exercise resistance rotation to maintain continued effectiveness for this product. Topsin M is compatible with many fungicides insecticides and acaricides except for highly alkaline materials such as Bordeaux mixture or lime sulfur.\n\r\nActive Ingredient: Thiophanate-Methyl\nCate', '', '', '', 9, 'assets/images/pesticides/MD01.jpg', 100),
(56, 'SUPERTHIRVE 60 ml', '1', '', '• SUPERTHIRVE 60 ml bottle SUPERTHIRVE has been certified non-toxic liquid by a US laboratory (WARF) – primarily a growth enhancer for plants, – produced since 1940.\r\n\n• It contains 0.09% vitamin B1, 0.048% 1-Napthyl acetic acid”. SuperThrive Contains vitamins and plant hormones that stimulate plant growth\r\n\n• No chemical fertilizer ingredients\r\n\n• No insecticides\r\n\n• Do not pollute the environment\r\n\n• Use with fertilizer for better plant growth\r\n\n• Is a highly appreciated product in the ornamental flower industry.\r\n\n• Quality assurance in accordance with product standards\r\n\n*Uses:\r\n\n• Restore', '', '', '', 9, 'assets/images/pesticides/MD02.jpg', 100),
(57, 'CoRoN 18-3-6 Plus 0.5%', '90', '', 'Controlled Release liquid turf and horticultural fertilizer with chelated iron. CoRoN is a liquid fertilizer with the unique properties that fit turf, ornamental and horticultural feeding needs. CoRoN contains nitrogen from controlled release methylene ureas along with additional nutrients to provide a quick turf green-up and prolonged release. CoRoN does not promote unnecessary surge growth and reduces clipping volumes, while minimizing nitrate leaching. CoRoN is compatible with most fungicides, herbicides and insecticides to allow time-saving tank mix applications. CoRoN is a true liquid sol', '', '', '', 9, 'assets/images/pesticides/MD03.jpg', 100),
(58, 'Peters Professional ', '74', '', 'The Peters Professional 20-20-20 General Purpose Fertilizer is safe to use for a wide range of crops. A formula that offers acidifying action to help prevent excessive pH particularly in growing media that contains mineral soil. This base formulation can be used alone or in rotation with a customizing component. This 20-20-20 General Purpose Fertilizer is appropriate to use for water types 2, 3 and 4 as a drip, foliar feed or drench. A no dye formulation is available for purchase if required.  Can be used in irrigation systems', '', '', '', 9, 'assets/images/pesticides/MD04.jpg', 100),
(59, 'Bio Advanced All-In-One Rose and Flower Care', '34', '', 'Bio Advanced previously known as Bayer Advanced All-In-One Rose and Flower Care is an exclusive formula that feeds, 9-14-9, and protects against insects and diseases in one easy step. Bayer Advanced All-In-One Rose and Flower Care - Concentrate provides 6 weeks protection against the major problems of Roses, Hibiscus, Iris and other Flowers and Shrubs. With Bayer Advanced All-In-One Rose and Flower Care - Concentrate there is no spraying, just mix and pour this formula around the base of the plant. Growing beautiful Roses, Flowers, and Shrubs has never been easier with Bayer Advanced All-In-On', '', '', '', 9, 'assets/images/pesticides/MD05.jpg', 100),
(60, 'Southern Ag Palm Nutritional Spray', '16', '', 'Southern Ag Palm Nutritional Spray contains 4 essential nutrients for correcting and preventing deficiencies in palms and other ornamentals. Corrects and prevents deficiencies that cause permanent injury, yellowing, curling, and browning.', '', '', '', 9, 'assets/images/pesticides/MD06.jpg', 100),
(61, 'Large Mexia Planter', '148', '11,8', 'The Mexia\'s classic shape compliments any houseplant, and its lightweight fiberglass material means you won’t break your back moving it around your space.', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots1.jpg', 100),
(62, 'Column Planter', '78', 'Choice of medium (8\" diameter) or large (12\" diameter)', 'Our Column Planter is a lightweight fiberglass vessel with a timeless fluted design. Suitable for indoor or outdoor use, the bottom of the planter includes a drainage hole with a removable rubber stopper. ', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots2.jpg', 100),
(63, 'Large Balboa Planter', '148', 'Pot measures 12.4', 'Our Balboa is a fiberglass planter that has a drainage hole with a removable rubber stopper. Place your plant in grow pot directly into the Balboa planter, à la cachepot, making watering a breeze. ', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots3.jpg', 100),
(64, 'Large Pallas Planter', '148', 'Pot measures 12.4', 'Our Balboa is a fiberglass planter that has a drainage hole with a removable rubber stopper. Place your plant in grow pot directly into the Balboa planter, à la cachepot, making watering a breeze. ', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots4.jpg', 100),
(65, 'Roma Planter', '89', 'Measures 7.87\" H', 'They are suitable for small to medium-sized plants and equipped with a built-in tray for adequate drainage.', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots5.jpg', 100),
(66, 'Terrazzo Archie Planter', '69', 'Measures 5.12\" W by 7.08\" H', 'The stunning Archie Planter’s base doubles as its water tray so that you can pot directly into the planter and be confident that your plant will drain properly.', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots6.jpg', 100),
(67, 'Terrazzo Banjo Planter', '129', 'Measures 7.87\" by 7.87\"', 'Each of these terrazzo pots was handmade in a non toxic resin, with a signature plinth that doubles as a water tray—you can pot directly into the planter and still be confident that your plant will experience proper drainage', 'unmentioned', 'unmentioned', 'unmentioned', 7, 'assets/images/pots/pots7.jpg', 100),
(68, 'Xact™ Trowel', '15', '3.25\" W x 14.5\" L x 1.75\" H', 'The Xact™ Trowel is the ideal tool for digging, ploughing and tilling hard soil and grass. It features a stainless steel, rust-proof tip with sharp edges and a handle', 'unmentioned', 'unmentioned', 'unmentioned', 8, 'assets/images/gradentools/gradentools1.jpg', 100),
(69, 'Micro-Tip® Pruning Snips', '14', 'unmentioned', 'Used regularly in our greenhouses to encourage healthy plant growth. The precision blades are ideal for shaping, repetitive trimming and complex cuts. These trimmers also have springs that gently open the blades after each cut to reduce hand fatigue. Includes buckle and easy-open blade cover for safe storage when not in use.', 'unmentioned', 'unmentioned', 'unmentioned', 8, 'assets/images/gradentools/gradentools2.jpg', 100),
(70, 'Plant Pruners', '20', '6\" L x 3.25\" W', 'Practice plant care comfortably with these lightweight pruners, which feature a bypass blade that cuts up to 1/2” in diameter. The sage green ergonomic handle makes them both practical and beautiful—a great gift for a budding plant parent or a seasoned pro.', 'unmentioned', 'unmentioned', 'unmentioned', 8, 'assets/images/gradentools/gradentools3.jpg', 100),
(71, 'Ergonomic Soil Scoop', '14', 'Measures 6.5” H x 3.15”', 'This ergonomic tool is made of matte black powder-coated stainless steel and features a cotton hanging cord for easy organization. ', 'unmentioned', 'unmentioned', 'unmentioned', 8, 'assets/images/gradentools/gradentools4.jpg', 100),
(72, 'Brass Mister', '34', '5.75” H x 3.5” W', 'This classic plant mister is ideal for gently watering and misting seedlings, sprouts, and humidity-loving houseplants. Too beautiful to tuck away, it can be kept on your table or counter, making weekly waterings more convenient.', 'unmentioned', 'unmentioned', 'unmentioned', 8, 'assets/images/gradentools/gradentools5.jpg', 100),
(73, 'Purple coneflower', '35', 'It typically grows to 2-4\' tall. Showy daisy-like purple coneflowers (to 5\" diameter) bloom throughout summer atop stiff stems clad with coarse, ovate to broad-lanceolate, dark green leaves.', 'Today, people use echinacea to shorten the duration of the common cold and flu, and reduce symptoms, such as sore throat (pharyngitis), cough, and fever. Many herbalists also recommend echinacea to help boost the immune system and help the body fight infections.', 'Echinacea are clump-forming perennials that grow to a mature size of between 12-36 inches wide and up to four feet tall. The size depends on the variety. Plants have an upright habit with large flowers with cone-shaped centers borne on tall, straight stalks.', 'Flowering is at its best in full sun, although plants will tolerate light shade.', 'Deep taproots make these plants quite drought-tolerant once established.', 6, 'assets\\images\\medicinal\\medicinal1.jpg', 100);
INSERT INTO `products` (`productID`, `productName`, `unitPrice`, `height`, `uses`, `growthHabits`, `light`, `water`, `categoryID`, `imageURL`, `unitsInStock`) VALUES
(74, 'Chamomile', '40', 'While similar in appearance, German chamomile is a tall-growing annual, reaching heights of around 60cm, while Roman chamomile is a low-growing, spreading perennial, reaching heights of just 30cm.', 'Chamomile preparations are commonly used for many human ailments such as hay fever, inflammation, muscle spasms, menstrual disorders, insomnia, ulcers, wounds, gastrointestinal disorders, rheumatic pain, and hemorrhoids. Essential oils of chamomile are used extensively in cosmetics and aromatherapy.', 'Chamomile likes a sunny spot with free-draining soil, and is full hardy. The name chamomile derives from the Greek for \'earth apple\', referring to its low-growing habit and apple-like scent. There are several types of chamomile with the characteristic, relaxing fragrance.', 'Space chamomile plants 8 inches apart in full sun for best flowering. In hot climates, an area with partial afternoon shade is ideal.', 'Water immediately after planting, then give plants 1 inch of water per week until well-established.', 6, 'assets\\images\\medicinal\\medicinal2.jpg', 100),
(75, 'Lavender', '99', 'Lavender varieties come in many sizes and growth habits. Compact dwarf varieties are available, and they do not exceed 12 inches in height (30 cm). There are also larger, more sprawling lavender varieties that can easily reach 3 ft. (90 cm) in height.', 'Lavender (Lavandula angustifolia) is an evergreen plant native to the Mediterranean. Its flower and oil have a popular scent and are also used as medicine. Lavender contains an oil that seems to have calming effects and might relax certain muscles. It also seems to have antibacterial and antifungal effects.', 'Lavender grows into a round, bushy shrub in warmer climates. It\'s a lower-growing perennial in colder climates. In humid climates, allow space for adequate airflow to prevent fungus or powdery mildew. Look at the varieties you\'re growing to determine their mature size.', 'Always grow lavender in full sun, where it can receive at least 8-10 hours of direct sunlight per day.', 'Water once the top inch of soil dries out, fertilize twice per year and provide low humidity and moderate temperatures.', 6, 'assets\\images\\medicinal\\medicinal3.jpg', 100),
(76, 'Grapes Seed and Vine', '100', 'The vines can grow up to six feet tall and spread up to 10 feet wide', 'Grape seed extract, which is made from the seeds of wine grapes, is promoted as a dietary supplement for various conditions, including venous insufficiency (when veins have problems sending blood from the legs back to the heart), promoting wound healing, and reducing inflammation.', 'Grapes bear their fruit on one-year-old wood. Different grape cultivars have different growth habits. American grape canes tend to grow in a willowy, downward direction, while European and many French-American hybrid grapes tend to grow directly up. Choose your training system with this in mind.', 'The common grape needs full sun to bear the best possible crop. Vines planted on a gentle Southeast facing slope often tend to produce well.', 'Give your crop adequate but not excessive water. Irrigate well during periods of drought. The ground should be kept evenly moist. Providing good drainage is an important first step in preventing overwatering.', 6, 'assets\\images\\medicinal\\medicinal4.jpg', 100),
(77, 'Flax Seed', '250', 'Flax is a herbaceous annual. When densely planted for fibre, plants average 0.9 to 1.2 metres (3 to 4 feet) in height, with slender stalks 2.5 to 4 mm (about 0.10 to 0.15 inch) in diameter and with branches concentrated at the top.', 'Flaxseed is commonly used to improve digestive health or relieve constipation. Flaxseed may also help lower total blood cholesterol and low-density lipoprotein (LDL, or \"bad\") cholesterol levels, which may help reduce the risk of heart disease.', 'Soil: Average to sandy well-drained soils are preferred. Flax does not do well in heavy clay or in wet conditions. If direct seeding, rake soil and broadcast seeds, raking in and tamping down to make good soil to seed contact.', 'A full sun site is preferred', 'It\'s worth noting that flax seeds have relatively low water requirements compared to other crops.', 6, 'assets\\images\\medicinal\\medicinal5.jpg', 100),
(78, 'Narrow-leaved paperbark', '50', 'Melaleuca linariifolia is a small tree growing to a height of 6–10 m (20–30 ft) with distinctive and attractive white or creamy white, papery bark and a dense canopy.', 'the bark is flexible and has a unique, soft texture and was a valuable material for a variety of uses. With these qualities, the bark was often used to wrap injuries, make sleeping mats, and wrap food to store for later. The leaves were a valuable medicinal source.', 'Evergreen, Spreading ; Soil Moisture: Dry, Well-drained, Moist moderate drainage, Boggy poorly drained ', 'A plant\'s growing potential is determined from its location, the time of year, and current local weather.', 'Paperbark Teatree needs 0.8 cups of water every 9 days when it doesn\'t get direct sunlight and is potted in a 5.0\" pot.', 6, 'assets\\images\\medicinal\\medicinal6.jpg', 100),
(79, 'Evening Primrose Oil', '60', 'Evening primrose can grow to an average height of around 1m, so plant it towards the middle or back of your border, in full sun to partial shade, and in moist but well-drained soil.', 'Evening primrose oil has been studied to treat cyclical breast pain linked to the menstrual cycle that occurs about a week before your period.', 'Evening-primrose is cultivated as an oilseed crop using strains with a high oil content.', 'Contrary to what you may believe about a plant that only blooms at night (making it perfect for moon gardens), evening primrose actually loves sunlight. It should be grown in a spot that gets full sunlight (or partial shade) and somewhere that the plant c', 'Evening primrose does best with adequate regular watering and will need a bit more water if grown in an especially hot climate during the summer. However, if you notice any discoloration or browning on the plant\'s many leaves, that\'s a sure sign that your', 6, 'assets\\images\\medicinal\\medicinal7.jpg', 100),
(80, 'Ginkgo', '300', 'It can grow 50 to 80 feet tall and 30 to 40 feet wide. Fruits from female trees are messy and have foul smelling fleshy seeds, so planting male trees is often preferable.', 'The extract from ginkgo leaves is promoted as a dietary supplement for many conditions, including anxiety, allergies, dementia, eye problems, peripheral artery disease (when buildup of plaque narrows the blood vessels that carry blood to the head, organs, and limbs), tinnitus, and other health problems.', 'While it tolerates a variety of soil textures and pH, ginkgo needs a site in full sun and good drainage to thrive. Avoid wet soils.', 'Most of the recommended cultivars grow best in full sun in the North (partial sun in the South)', 'Have average water needs, and stand up well to pollution and road salt. In fact, as salt-tolerant plants, they are good choices for those who landscape near the ocean.', 6, 'assets\\images\\medicinal\\medicinal8.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `userqueries`
--

CREATE TABLE `userqueries` (
  `userNo` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(600) NOT NULL,
  `dateFeedback` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userqueries`
--

INSERT INTO `userqueries` (`userNo`, `username`, `email`, `message`, `dateFeedback`) VALUES
(2, 'Jack', 'jack@gmail.com', 'The website has a wide variety of products to choose from.', '2023-08-13 11:24:01'),
(3, 'Dang', 'dang@gmail.com', 'Diverse products, easy-to-find category options.', '2023-08-13 11:25:51'),
(6, 'Nguyen Thi Uyen', 'y@gmail.com', 'User-friendly web interface and easy product purchase!', '2023-08-12 10:07:07'),
(7, 'Lisa', 'li@gmail.com', 'Friendly website interface, easy to use.', '2023-08-13 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `userreview`
--

CREATE TABLE `userreview` (
  `reviewNo` int(11) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `review` varchar(600) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `dateReview` datetime NOT NULL DEFAULT current_timestamp(),
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userreview`
--

INSERT INTO `userreview` (`reviewNo`, `userID`, `rating`, `review`, `seen`, `dateReview`, `productID`) VALUES
(1, 'mingvuong', 4, 'Normal', 1, '2023-08-12 08:45:46', 74),
(2, 'ngocy', 5, 'Ok', 0, '2023-08-11 22:34:25', 2),
(3, 'minhbao', 3, 'Very good', 0, '2023-08-12 08:46:33', 15),
(4, 'thiuyen', 5, 'Nice', 0, '2023-08-13 04:00:56', 62),
(5, 'thiuyen', 5, 'Nice', 0, '2023-08-13 09:16:40', 62),
(6, 'ngocy', 5, 'Good', 0, '2023-08-13 10:57:01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetailID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_accountOrders` (`userID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `fk_category` (`categoryID`);

--
-- Indexes for table `userqueries`
--
ALTER TABLE `userqueries`
  ADD PRIMARY KEY (`userNo`);

--
-- Indexes for table `userreview`
--
ALTER TABLE `userreview`
  ADD PRIMARY KEY (`reviewNo`),
  ADD KEY `fk_accountReview` (`userID`),
  ADD KEY `fk_productReview` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `userqueries`
--
ALTER TABLE `userqueries`
  MODIFY `userNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userreview`
--
ALTER TABLE `userreview`
  MODIFY `reviewNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_accountOrders` FOREIGN KEY (`userID`) REFERENCES `account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userreview`
--
ALTER TABLE `userreview`
  ADD CONSTRAINT `fk_accountReview` FOREIGN KEY (`userID`) REFERENCES `account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productReview` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
