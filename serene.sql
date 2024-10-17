-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 08:26 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serene`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `product` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE IF NOT EXISTS `creditcard` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `cardholder` varchar(255) NOT NULL,
  `cardnumber` bigint(20) NOT NULL,
  `expirymonth` tinyint(4) NOT NULL,
  `expiryyear` smallint(6) NOT NULL,
  `cvv` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `offerid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `originalprice` float NOT NULL,
  `discountedprice` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offerid`, `pname`, `image`, `originalprice`, `discountedprice`) VALUES
(1, 'Lotus & Rabutan', 'https://lk.spaceylon.com/cdn/shop/files/L_R_Pop_up.jpg?v=1721585840&width=750', 1500, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `pname` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `pname`, `image`, `product_description`, `price`, `category`) VALUES
(31, 'Pigeon flower Perfume', 'images/Fragrance/Fragrance (1).png', 'Pigeon Flower Perfume" captures the unexpected beauty of urban wildflowers, blending fresh citrus, soft jasmine, and earthy musk. A scent of quiet elegance, perfect for those who find beauty in the overlooked', 1800, 'fragrance'),
(32, 'Peach Flower Perfume', 'images/Fragrance/Fragrance (2).png', 'Peach Flower Perfume" is a sweet, enchanting blend of ripe peach, delicate blossoms, and soft vanilla. This fragrance embodies the warmth of summer, evoking a sense of playful elegance and radiant charm.', 2100, 'fragrance'),
(33, 'Velvet whisper perfume', 'images/Fragrance/Fragrance (3).png', 'Velvet Whisper Perfume" is a luxurious blend of rich amber, soft rose, and warm vanilla. This scent wraps you in a sensual, elegant embrace, leaving a trail of irresistible allure.', 1600, 'fragrance'),
(34, 'Sapphire mist perfume', 'images/Fragrance/Fragrance (4).png', 'Sapphire Mist Perfume" is a refreshing blend of cool blue lotus, sparkling citrus, and soft musk. This fragrance evokes the mystery of twilight, enveloping you in an aura of serene elegance.', 1200, 'fragrance'),
(35, 'Aurora veil perfume', 'images/Fragrance/Fragrance (5).png', 'Aurora Veil Perfume" is a magical blend of ethereal lavender, blooming peony, and soft sandalwood. This fragrance captures the essence of dawn, enveloping you in a veil of delicate, radiant beauty.', 3100, 'fragrance'),
(36, 'Golden seraph perfume', 'images/Fragrance/Fragrance (6).png', 'A heavenly blend of luminous amber, honeyed jasmine, and warm vanilla. This fragrance exudes divine elegance, wrapping you in a radiant glow that feels both ethereal and captivating.', 2300, 'fragrance'),
(37, 'Ivory petal perfume', 'images/Fragrance/Fragrance (7).png', 'A delicate fusion of white gardenia, creamy sandalwood, and fresh lily. This scent captures the purity and grace of ivory petals, offering a soft, timeless elegance that lingers beautifully.', 2800, 'fragrance'),
(38, 'Enchanted Woods perfume', 'images/Fragrance/Fragrance (8).png', 'A mysterious blend of deep cedar, mossy oak, and wild berries. This fragrance evokes the magic of a twilight forest, enveloping you in a captivating and earthy allure.', 2500, 'fragrance'),
(39, 'Serene hair serum', 'images/Hair/hair (1).png', 'A lightweight elixir that smooths and nourishes, leaving hair silky and frizz-free. Infused with botanical extracts, it enhances shine and softness for a truly serene finish.', 1800, 'hair'),
(40, 'Serene hair oil', 'images/Hair/hair (2).png', 'A luxurious blend of natural oils that deeply moisturizes and revitalizes, transforming dry, brittle hair into soft, lustrous strands with a calming, aromatic touch.', 1300, 'hair'),
(41, 'Serene hair boosting oil', 'images/Hair/hair (3).png', 'This powerful oil boosts volume and strength, infused with biotin and essential nutrients. It revitalizes thin, lifeless hair, giving it a fuller, more vibrant appearance.', 2300, 'hair'),
(42, 'Serene hair gel oil', 'images/Hair/hair (4).png', 'A unique hybrid formula that provides the hold of a gel with the nourishment of an oil. It tames flyaways, defines curls, and adds shine without the crunch.', 2200, 'hair'),
(43, 'Serene hair shampoo', 'images/Hair/hair (5).png', 'A gentle, sulfate-free shampoo that cleanses and rejuvenates, leaving hair soft, hydrated, and refreshed. Its soothing formula enhances natural shine while promoting healthy hair growth.', 2400, 'hair'),
(44, 'Serene hair mask', 'images/Hair/hair (6).png', 'An intensive treatment that deeply conditions and repairs damaged hair. Enriched with keratin and natural oils, it restores strength, moisture, and softness for a serene, silky finish.', 1800, 'hair'),
(45, 'Serene hair petal mask', 'images/Hair/hair (7).png', 'Infused with rose petals and nourishing oils, this mask hydrates and revitalizes, leaving hair soft, fragrant, and full of life, with a touch of floral serenity.', 1300, 'hair'),
(46, 'Serene hair green mask', 'images/Hair/hair (8).png', 'A refreshing treatment infused with green tea and aloe vera, this mask detoxifies and nourishes, rejuvenating the hair with natural moisture and a serene, healthy glow.', 1100, 'hair'),
(47, 'Serene body lotion', 'images/Skin/skin (1).png', 'A lightweight, hydrating lotion infused with soothing aloe and shea butter. It absorbs quickly, leaving skin silky smooth, deeply nourished, and wrapped in a serene, calming scent', 2300, 'skin'),
(48, 'Serene body cream', 'images/Skin/skin (2).png', 'A rich, luxurious cream that envelops your skin in moisture. Enhanced with cocoa butter and vitamin E, it provides lasting hydration and a soft, serene glow.', 1800, 'skin'),
(49, 'Herbal serenity body seru', 'images/Skin/skin (3).png', 'A revitalizing serum infused with herbal extracts and antioxidants. It deeply nourishes and soothes, restoring your skin''s natural balance and leaving it feeling calm and rejuvenated.', 2300, 'skin'),
(50, 'Serene body radiance oil', 'images/Skin/skin (4).png', 'A luminous body oil that blends nourishing botanicals with shimmering highlights. It hydrates and enhances your skin’s natural glow, leaving it radiant, soft, and beautifully serene.', 1900, 'skin'),
(51, 'Serene body serum', 'images/Skin/skin (5).png', 'A lightweight, fast-absorbing serum that delivers intense hydration and skin-plumping effects. Enriched with hyaluronic acid and natural botanicals, it leaves your skin smooth, firm, and serene.', 1600, 'skin'),
(52, 'Citrus blossom hand cream', 'images/Skin/skin (6).png', 'A refreshing hand cream infused with bright citrus and delicate blossoms. It hydrates and softens hands, leaving them silky smooth and wrapped in a vibrant, uplifting scent.', 2400, 'skin'),
(53, 'Rose quartz body mist', 'images/Skin/skin (7).png', 'A delicate mist infused with rose quartz essence and floral notes. It refreshes and hydrates the skin, leaving a subtle, romantic fragrance and a serene, rosy glow.', 1700, 'skin'),
(54, 'Amber waves body cream', 'images/Skin/skin (8).png', 'A warm, indulgent body cream enriched with amber and vanilla. It deeply moisturizes, leaving your skin velvety soft and wrapped in a rich, comforting scent.', 1800, 'skin');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `product` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `user` (`user`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offerid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product` (`product`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offerid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
