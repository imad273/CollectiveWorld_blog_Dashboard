-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 02:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clcworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Posts_id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `Date` datetime NOT NULL,
  `Views` int(11) NOT NULL,
  `Comments` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Posts_id`, `Title`, `Content`, `Date`, `Views`, `Comments`, `image`) VALUES
(47, 'My Audio Course on Knowable!', 'Many people think social media today is leaving us more disconnected from each other. Some feel they’re missing the benefits of a strong community in their daily lives — but who’s to say you can’t build your own? \nIn this course I will teach you how to build a genuine community, sharing real examples of those who’ve not only found their people but their voice as well. This course will help you nurture stronger human bonds while leaving out the toxicity and trolling.', '2021-09-20 10:59:36', 0, 0, '6655729_blog-10.jpeg'),
(48, 'A Child-Free Woman™', 'Last Summer when my debut novel OLIVE first came out in hardback, I accidentally-on-purpose became a voice on choosing to be childfree. I had just written a book with a childfree-by-choice protagonist. Without really meaning to, I\'d become a top Google search, a SEO hit for \"childfree by choice woman\". I wrote about it for ELLE, Grazia, Marie Claire, BBC Woman’s Hour and more. I’ve felt emotionally exposed and vulnerable at times, peeling back a layer into my life, but mostly I’ve been loving the open-hearted like-minded emails off the back of people’s late night Internet searches. I love the twists and turns and nuance of the conversation, how it always goes back to having compassion for each other’s personal choices, desires and heartbreaks. ', '2021-09-23 13:34:24', 0, 0, '15705597_blog-8.jpg'),
(49, 'A 3-part Ctrl Alt Delete Mini Series with Lenovo', 'I am joined by the excellent @natlue across three episodes on the theme of pushing boundaries at work - she is SO wise! We discuss everything from the myths of being your own boss, how to do deeper more focused work in a world of distraction and how to build your own career ladder. She is has a no BS attitude about this stuff while also being extremely compassionate in her advice. You don\'t have to be a CEO in a glass box or have a million followers to make very good money. You don\'t have to work all hours to be productive. She explains all the ways we\'ve been socialised and influenced big time in feeling this endless pressure in our work and lives and how to strip it back and find ourselves again. It was such a joy to record this in person with Natalie, and this 3-part series was made possible by Lenovo. I loved recording it, can\'t wait to hear what you think! ', '2021-09-23 13:35:19', 0, 0, '60739461_blog-3.jpg'),
(50, 'Musings on “Manifesting”', 'This week, I scrolled past three (!) virtual workshops on ‘how to manifest’ which should give you a pretty clear insight into what/who I seem to follow online these days. I am simultaneously very intrigued and very cynical about it. I think about the phrase “maybe you manifested it, maybe it’s white privilege” a lot too. Did you really manifest it? Or did the system swing in your favour? Because there’s a distinction, or should I say, relationship, between the two.\nIt’s clearly not as simple as: think it! believe it! get it! But — I do think there is some element of having to believe it might happen, in order to be more likely to get it. If something occupies your brain space a lot, you are of course more likely to navigate towards that thing. I thought I’d share some of my own musings and experiments.', '2021-09-23 13:36:19', 0, 0, '9822705_blog-1.jpg'),
(51, '“You’ve Changed…”', 'Being stuck inside for a year does strange things to your identity. Who are you, if you are a gym lover and your gym is closed, or a digital nomad without the travel, or a foodie without a restaurant, or a film nerd without the cinema? Those things might sound quite ‘surface level’ but it’s been tough on our psyches, because so much of our external life choices feels like the very bones of who we are. I wouldn’t say I’ve had an identity crisis, but more of an identity cleanse.', '2021-09-23 13:37:20', 0, 0, '416803_blog-4.jpeg'),
(52, 'Bridgerton, Gossip & Friendship', 'I interviewed the author Julia Quinn, creator of the Bridgerton books, this month for the podcast (going live on 4th March). It was a very enjoyable lively conversation, she was brilliant and funny, and we discussed so much about her writing career that spans over twenty years. She wrote her first full-length novel at 13 years old(!) and later ditched a career in medicine, thinking: “actually, I think I’ll write romance novels for a living instead.” And that’s exactly what she went and did.', '2021-09-23 13:38:07', 0, 0, '62614863_blog-5.jpeg'),
(53, 'OLIVE & Being Child-Free By Choice', 'A generation of women are opting out of parenthood. That doesn\'t make them selfish, shallow or in denial, but it does make society feel uncomfortable.\nBY EMMA GANNON, for ELLE, July issue / 14/07/2020\nMy inbox was going insane. Every second, a new ping! Every refresh, another 10 emails. It was December 2018, and I was doing some research for a project about women who had decided to not have children.\nI wrote a tweet asking people to get in touch: \'For a thing! I am looking to speak to a range of women who have zero desire to have kids (by choice!) who might talk to me, please reply or slide into one’s DMs – thank you.\'', '2021-09-23 13:56:11', 0, 0, '68232985_blog-13.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Member_type` smallint(7) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`, `Member_type`, `FirstName`, `LastName`, `Date`) VALUES
(4, 'admin', 'admin@gmail.com', '$2y$10$2UeuNANtk6oRYwIkwZbapuy./8wVv6X4pYmbJ99K1G3nwD2r/GzQa', 1, 'super', 'admin', '2021-09-09'),
(5, 'imad', 'imad@gmail.com', '$2y$10$2tH6XCu0BalqDugMKO/i/.RuRNQuwsdGNa1UiW3f5gEOa5FVjo.9W', 1, 'supeer', 'admin', '2021-09-09'),
(7, 'ealimide', 'DonaldMMathes@armyspy.com', '$2y$10$LMIfZi/1RxdX4Iafm39Nqu4F1TytNYPqhhwths4pqOv8sv0GHRYfG', 0, 'Donald', 'Mathes', '2021-09-11'),
(8, 'mpersol', 'CharityPRussell@dayrep.com', '$2y$10$Z8e7loumsU2Y4dmsWfWcmeEOH65WLHQ791sRUhNoLpBOAcGLFYP/u', 0, 'Charity', 'Russell', '2021-09-12'),
(9, 'eavio', 'MuzaffarJawharHakimi@rhyta.com', '$2y$10$8n9BS4NG49dbodHOEXi3reHbFJiIznNnj/x6tRSKTOFSgXIaYwtxu', 0, 'Jawhar', 'Hakimi', '2021-09-15'),
(11, 'eupren8', 'CallumParry@rhyta.com', '$2y$10$Q//L.VY2cReRQ.x0e88CVOvp8NokfGBmbBjvkNadjUzqDh9EoU0zy', 0, 'Callum', 'Parry', '2021-09-18'),
(12, 'titer12', 'JoshuaSummers@teleworm.us', '$2y$10$cUCjt8JE2pstwvTFPfjzZ.7G9AHkTMLDJGXUwAXLVzWWulxIDhIp6', 0, 'Joshua ', 'Summers', '2021-09-22'),
(13, 'Jenni8', 'JenniferJAmin@rhyta.com', '$2y$10$kxP8BSx5H/54E4wQ7f1yXefpSWmpP1XPZ0PhC.1nXJuljCRGPXzQ6', 0, 'Amin', 'Jennifer', '2021-09-26'),
(14, 'Alde6', 'AldenSFox@armyspy.com', '$2y$10$2eGtpnZWQd8Qf.uWALrBs.QZDOG9W.JmiuAutqizfVG0Zz0I92dAe', 0, 'Alden', 'Fox', '2021-09-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Posts_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
