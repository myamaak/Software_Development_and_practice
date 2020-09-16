-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 18-06-11 14:30
-- 서버 버전: 5.7.19
-- PHP 버전: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `proj`
--
CREATE DATABASE IF NOT EXISTS `proj` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proj`;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` varchar(48) NOT NULL,
  `username` varchar(48) DEFAULT NULL,
  `password` varchar(48) DEFAULT NULL,
  `email` varchar(48) DEFAULT NULL,
  `phonenum` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `email`, `phonenum`) VALUES
('DY', 'ë‚¨ë‹¤ì˜', '0000', 'ramda4415@naver.com', '01044151986'),
('Odette_with_C', 'Odette Lachapell', 'olovec', 'Odette1003@gmail.com', '01019981003'),
('ColinP', 'Colin J. Meath', 'cforo', 'ColinJMeath@gmail.com', '01019890914'),
('taesik7805', 'Taesik Kim', '7805', 'bow_wow@gmail.com', '01078051986'),
('dear_gh', 'Suseon Seo', 'sforh', 'Daffodil@naver.com', '01023170201'),
('gh0201', 'Hun Gang', 'foreverfirstlove', 'Temperature36_5@naver.com', '01005080201'),
('imgrute', 'im', 'grute', 'imgrute?', 'iamgrut3'),
('ì•„ì— ê·¸ë¤', 'ì•„ì— ê·¸ë¤ã…Œ!', 'rmfnx', 'ì•„ìž„ ê·¸ë¤?', 'ì•„ì´ì—  ê·¸ë£¨ã…Œ'),
('1111', '1111', '1111', '1111', '1111');

-- --------------------------------------------------------

--
-- 테이블 구조 `userdocument`
--

DROP TABLE IF EXISTS `userdocument`;
CREATE TABLE IF NOT EXISTS `userdocument` (
  `userID` varchar(48) DEFAULT NULL,
  `doctitle` varchar(48) NOT NULL,
  `contents` text,
  `Fdate` date NOT NULL,
  `email` varchar(48) NOT NULL,
  `dn` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`dn`),
  KEY `userID` (`userID`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `userdocument`
--

INSERT INTO `userdocument` (`userID`, `doctitle`, `contents`, `Fdate`, `email`, `dn`) VALUES
('taesik7805', 'new1', NULL, '2018-06-07', 'bow_wow@gmail.com', 2),
('Odette_with_C', 'new2', NULL, '2018-06-07', 'Odette1003@gmail.com', 3),
('dear_gh', 'new3', NULL, '2018-06-07', 'Daffodil@naver.com', 4),
('ColinP', 'new4', NULL, '2018-06-07', 'ColinJMeath@gmail.com', 5),
('gh0201', 'new5', NULL, '2018-06-07', 'Temperature36_5@naver.com', 6),
('DY', 'ê¹Œì•„', ' hhh', '2018-06-11', 'jfijof', 16),
('imgrute', '', NULL, '2018-06-11', 'imgrute?', 17),
('imgrute', '', NULL, '2018-06-11', 'imgrute?', 18),
('ì•„ì— ê·¸ë¤', '', ' iam grute im grute?\r\nì•„ìž„ ê·¸ë£» ì•” ê·¸ë¤ã…Œ\r\n\r\n\r\n\r\n\r\n\r\nwe\'re grute.....!!!! \r\nìœ„ì•„ ê·¸ë¤íŠ¸', '2018-06-11', 'ì•„ìž„ ê·¸ë¤?', 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
