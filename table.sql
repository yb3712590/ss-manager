-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-27 01:51:06
-- 服务器版本： 5.5.47-MariaDB
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shadowsocks`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `port` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upasswd` varchar(32) NOT NULL,
  `ss_passwd` int(8) unsigned DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `utype` int(11) DEFAULT NULL,
  `upload` bigint(20) DEFAULT NULL,
  `download` bigint(20) DEFAULT NULL,
  `transfer_limit` int(11) DEFAULT NULL,
  `exp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`port`, `uname`, `upasswd`, `ss_passwd`, `email`, `active`, `utype`, `upload`, `download`, `transfer_limit`, `exp`) VALUES
(443, 'admin', '7815696ecbf1c96e6894b779456d330e', 22167863, '494888545@qq.com', 1, 0, 177376057, 2297084233, 1073741824, '2017-05-23'),
(1443, 'wy200855650', 'f87d0d0fcb3b01dfbe1d18616df5f80f', 40261878, '200855650@qq.com', 1, 0, 839869, 3221547, 1073741824, '2017-05-23'),
(2443, '270382011', '5ede89cfff9a097b07ece8202dcfe958', 83200770, '270382011@qq.com', 1, 0, 930, 380, 1073741824, '2017-05-23'),
(3443, 'dragonszy', '30dc0e845f7299eed32942873ed4a22d', 47596662, 'dragonszy@163.com', 1, 0, 108448138, 1945019408, 1073741824, '2017-05-23'),
(4443, 'zhutou530', 'c177078980e7347b71ce2d96ca7d57f5', 97690340, '584832043@qq.com', 1, 0, 451012, 4241143, 1073741824, '2017-05-23'),
(5443, 'sauronkk', '766a8e61890921118d940c422563620b', 24808793, '1444564649@qq.com', 1, 0, 413, 164, 1073741824, '2017-05-23'),
(6443, '397501170@qq.com', 'c41d0a758d97e811e2a6674d152118ee', 81957455, '397501170@qq.com', 1, 0, 3467404, 169294766, 1073741824, '2017-05-24'),
(7443, 'yb3712590', '7815696ecbf1c96e6894b779456d330e', 69455690, 'yb3712590@163.com', 1, 0, 2343885016, 3265677276, 1073741824, '2017-05-26'),
(8443, 'likethisj', '64948e0006ba0c9838deaebda426120e', 77200126, '278989285@qq.com', 1, 0, 234837744, 2566554280, 1073741824, '2017-05-28'),
(9443, 'kiranightshade', '820cb9cfa6105e7257c15bf28418d34d', 56295888, 'qianlitao@163.com', 1, 0, 5351761, 269901769, 1073741824, '2017-05-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`port`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `email` (`email`);

