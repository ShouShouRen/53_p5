-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-22 03:33:58
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `53_p5`
--

-- --------------------------------------------------------

--
-- 資料表結構 `login_log`
--

CREATE TABLE `login_log` (
  `user` varchar(100) NOT NULL,
  `login_time` datetime NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `login_log`
--

INSERT INTO `login_log` (`user`, `login_time`, `status`) VALUES
('admin', '2023-03-22 08:59:37', '登入失敗'),
('admin', '2023-03-22 09:03:46', '登入成功'),
('admin', '2023-03-22 09:27:12', '登出成功'),
('asdf', '2023-03-22 09:27:20', '登入失敗'),
('sdaf', '2023-03-22 09:27:23', '登入失敗'),
('dfsa', '2023-03-22 09:27:25', '登入失敗'),
('admin', '2023-03-22 09:30:13', '登入失敗'),
('admin', '2023-03-22 09:30:21', '登入成功'),
('admin', '2023-03-22 10:32:05', '登出成功'),
('user01', '2023-03-22 10:32:15', '登入失敗'),
('user01', '2023-03-22 10:32:27', '登入失敗'),
('user01', '2023-03-22 10:32:38', '登入成功'),
('user01', '2023-03-22 10:32:53', '登出成功'),
('user02', '2023-03-22 10:33:01', '登入失敗'),
('user01', '2023-03-22 10:33:09', '登入成功'),
('user01', '2023-03-22 10:33:31', '登出成功'),
('user02', '2023-03-22 10:33:41', '登入成功'),
('user02', '2023-03-22 10:33:46', '登出成功');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `user_id`, `user`, `pw`, `user_name`, `role`) VALUES
(1, '0000', 'admin', '1234', '超級管理員', 0),
(2, '0001', 'user01', '1234', '使用者01', 0),
(3, '0002', 'user02', '1234', '使用者02', 1),
(4, '0003', 'user03', '1234', '使用者03', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
