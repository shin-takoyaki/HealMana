-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-06-13 08:31:44
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `healmana`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `user_id` int(4) DEFAULT NULL COMMENT 'ユーザーID(外部キー(users.id))',
  `favorite_user_id` int(4) DEFAULT NULL COMMENT 'お気に入りユーザーID(外部キー(users.id))',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `favorite_user_id`, `created_at`, `updated_at`) VALUES
(28, 29, 30, '2023-06-07 09:35:50', '2023-06-07 09:35:50'),
(29, 29, 5, '2023-06-07 09:36:12', '2023-06-07 09:36:12'),
(39, 5, 26, '2023-06-07 10:39:02', '2023-06-07 10:39:02'),
(41, 5, 29, '2023-06-07 10:39:12', '2023-06-07 10:39:12'),
(43, 30, 29, '2023-06-07 11:33:54', '2023-06-07 11:33:54'),
(44, 30, 26, '2023-06-07 11:34:45', '2023-06-07 11:34:45'),
(45, 40, 30, '2023-06-07 11:35:30', '2023-06-07 11:35:30'),
(46, 30, 40, '2023-06-07 11:36:43', '2023-06-07 11:36:43'),
(47, 41, 40, '2023-06-07 11:38:29', '2023-06-07 11:38:29'),
(49, 5, 41, '2023-06-07 15:49:15', '2023-06-07 15:49:15'),
(50, 30, 41, '2023-06-08 05:44:32', '2023-06-08 05:44:32'),
(54, 5, 30, '2023-06-08 07:09:40', '2023-06-08 07:09:40'),
(55, 30, 5, '2023-06-08 08:04:46', '2023-06-08 08:04:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `user_id` int(4) DEFAULT NULL COMMENT 'ユーザーID(外部キー(users.id))',
  `post_id` int(4) DEFAULT NULL COMMENT '投稿ID(外部キー(posts.id))',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '投稿日時',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(99, 5, 15, '2023-05-23 08:13:09', '2023-05-23 08:13:09'),
(101, 5, 16, '2023-05-23 13:48:09', '2023-05-23 13:48:09'),
(103, 5, 27, '2023-05-26 06:27:28', '2023-05-26 06:27:28'),
(115, 26, 35, '2023-06-04 05:48:37', '2023-06-04 05:48:37'),
(116, 26, 36, '2023-06-04 08:57:47', '2023-06-04 08:57:47'),
(117, 5, 33, '2023-06-05 09:34:08', '2023-06-05 09:34:08'),
(119, 5, 35, '2023-06-07 05:25:57', '2023-06-07 05:25:57'),
(138, 5, 38, '2023-06-07 11:05:03', '2023-06-07 11:05:03'),
(139, 26, 38, '2023-06-07 11:06:32', '2023-06-07 11:06:32'),
(146, 40, 41, '2023-06-07 11:36:19', '2023-06-07 11:36:19'),
(148, 41, 41, '2023-06-07 11:38:26', '2023-06-07 11:38:26'),
(151, 30, 43, '2023-06-08 05:00:14', '2023-06-08 05:00:14'),
(153, 30, 42, '2023-06-08 07:00:09', '2023-06-08 07:00:09'),
(154, 30, 41, '2023-06-08 07:00:11', '2023-06-08 07:00:11'),
(155, 30, 39, '2023-06-08 07:00:14', '2023-06-08 07:00:14'),
(156, 30, 38, '2023-06-08 07:00:17', '2023-06-08 07:00:17'),
(157, 30, 36, '2023-06-08 07:00:19', '2023-06-08 07:00:19'),
(158, 30, 35, '2023-06-08 07:00:22', '2023-06-08 07:00:22'),
(159, 30, 34, '2023-06-08 07:00:24', '2023-06-08 07:00:24'),
(160, 30, 18, '2023-06-08 07:00:27', '2023-06-08 07:00:27'),
(161, 5, 44, '2023-06-08 07:03:10', '2023-06-08 07:03:10'),
(162, 5, 45, '2023-06-08 07:09:33', '2023-06-08 07:09:33'),
(163, 30, 46, '2023-06-08 08:04:39', '2023-06-08 08:04:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `user_id` int(4) DEFAULT NULL COMMENT 'ユーザーID(外部キー(users.id))',
  `meal_content` mediumtext DEFAULT NULL COMMENT '投稿内容',
  `exercise_content` mediumtext DEFAULT NULL COMMENT '運動内容',
  `other_content` mediumtext DEFAULT NULL COMMENT 'その他内容',
  `rising_time` time(5) DEFAULT current_timestamp() COMMENT '起床時間',
  `retiring_time` time(5) DEFAULT current_timestamp() COMMENT '就寝時間',
  `created_at` timestamp NULL DEFAULT current_timestamp() COMMENT '投稿日時',
  `num_likes` int(4) DEFAULT 0 COMMENT 'いいね数',
  `updated_at` datetime(5) NOT NULL DEFAULT current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `meal_content`, `exercise_content`, `other_content`, `rising_time`, `retiring_time`, `created_at`, `num_likes`, `updated_at`) VALUES
(17, 5, '{\"meal_time\":{\"1\":\"17:49\"},\"meal_comment\":{\"1\":\"\\u9d8f\\u8089\"}}', '{\"exercise_time\":{\"1\":\"17:55\"},\"exercise_comment\":{\"1\":\"\\u30b8\\u30e7\\u30ae\\u30f3\\u30b0\"}}', '{\"other_time\":{\"1\":\"17:55\"},\"other_comment\":{\"1\":\"\\u30b5\\u30a6\\u30ca\"}}', '17:55:00.00000', '17:55:00.00000', '2023-05-23 08:49:41', NULL, '2023-05-23 17:49:41.00000'),
(18, 5, '{\"meal_time\":{\"1\":\"18:17\"},\"meal_comment\":{\"1\":\"\\u5473\\u564c\\u6c41\"}}', '{\"exercise_time\":{\"1\":\"18:23\"},\"exercise_comment\":{\"1\":\"\\u30a2\\u30d6\\u30ed\\u30fc\\u30e9\\u30fc\"}}', '{\"other_time\":{\"1\":\"18:23\"},\"other_comment\":{\"1\":\"\\u30b5\\u30a6\\u30ca\"}}', '18:23:00.00000', '00:17:00.00000', '2023-05-23 09:17:49', 1, '2023-06-01 14:24:57.00000'),
(27, 5, '{\"meal_time\":{\"1\":\"14:07\",\"2\":\"15:29\"},\"meal_comment\":{\"1\":\"\\u30c1\\u30ad\\u30f3\",\"2\":\"\\u30b5\\u30e9\\u30c0\"}}', '{\"exercise_time\":{\"1\":\"14:11\"},\"exercise_comment\":{\"1\":\"\\u8155\\u7acb\\u3066\"}}', '{\"other_time\":{\"1\":\"14:12\"},\"other_comment\":{\"1\":\"\\u30b5\\u30d7\\u30ea\"}}', '14:13:00.00000', '14:13:00.00000', '2023-05-26 05:07:04', 2, '2023-06-01 14:24:48.00000'),
(34, 5, '{\"meal_time\":{\"1\":\"19:15\"},\"meal_comment\":{\"1\":\"\\u7d0d\\u8c46\"}}', '{\"exercise_time\":{\"1\":\"00:15\"},\"exercise_comment\":{\"1\":\"\\u30b8\\u30e7\\u30ae\\u30f3\\u30b0\"}}', '{\"other_time\":{\"1\":\"01:15\"},\"other_comment\":{\"1\":\"\\u7791\\u60f3\"}}', '01:15:00.00000', '19:20:00.00000', '2023-06-01 10:15:45', 1, '2023-06-07 18:20:20.00000'),
(35, 5, '{\"meal_time\":{\"1\":\"19:16\"},\"meal_comment\":{\"1\":\"\\u30b9\\u30c6\\u30fc\\u30ad\"}}', '{\"exercise_time\":{\"1\":\"19:22\"},\"exercise_comment\":{\"1\":\"\\u8179\\u7b4b\"}}', '{\"other_time\":{\"1\":\"00:16\"},\"other_comment\":{\"1\":\"\\u30b5\\u30a6\\u30ca\"}}', '19:22:00.00000', '19:22:00.00000', '2023-06-01 10:16:26', 3, '2023-06-07 18:20:18.00000'),
(36, 26, '{\"meal_time\":{\"1\":\"15:42\"},\"meal_comment\":{\"1\":\"apple\"}}', '{\"exercise_time\":{\"1\":\"21:42\"},\"exercise_comment\":{\"1\":\"\\u30c0\\u30f3\\u30d9\\u30eb\\uff11\\uff10\\uff10\\u56de\"}}', '{\"other_time\":{\"1\":\"15:48\"},\"other_comment\":{\"1\":\"\\u5168\\u529b\\u75be\\u8d70\\u00d7\\uff11\\uff10\"}}', '21:43:00.00000', '15:49:00.00000', '2023-06-04 06:43:07', 2, '2023-06-07 18:20:15.00000'),
(38, 29, '{\"meal_time\":{\"1\":\"16:08\"},\"meal_comment\":{\"1\":\"\\u611b\"}}', '{\"exercise_time\":{\"1\":\"16:14\"},\"exercise_comment\":{\"1\":\"\\u611b\"}}', '{\"other_time\":{\"1\":\"22:08\"},\"other_comment\":{\"1\":\"\\u611b\"}}', '16:13:00.00000', '16:12:00.00000', '2023-06-07 07:08:39', 3, '2023-06-08 16:00:17.00000'),
(39, 30, '{\"meal_time\":{\"1\":\"20:08\"},\"meal_comment\":{\"1\":\"\\u4f55\\u3082\\u98df\\u3079\\u305a\\u3002\"}}', '{\"exercise_time\":{\"1\":\"20:14\"},\"exercise_comment\":{\"1\":\"SIT\"}}', '{\"other_time\":{\"1\":\"01:08\"},\"other_comment\":{\"1\":\"\\u30d7\\u30ed\\u30c6\\u30a4\\u30f3\\u3068\\u30b5\\u30d7\\u30ea\"}}', '01:08:00.00000', '02:08:00.00000', '2023-06-07 11:08:37', 1, '2023-06-08 16:00:14.00000'),
(41, 40, '{\"meal_time\":{\"1\":\"20:35\"},\"meal_comment\":{\"1\":\"\\u30ad\\u30ce\\u30b3\"}}', '{\"exercise_time\":{\"1\":\"22:35\"},\"exercise_comment\":{\"1\":\"\\u8155\\u7acb\\u306610000000\\u56de\"}}', '{\"other_time\":{\"1\":\"20:41\"},\"other_comment\":{\"1\":\"\\u30b5\\u30a6\\u30ca10\\u6642\\u9593\"}}', '00:36:00.00000', '02:36:00.00000', '2023-06-07 11:36:09', 3, '2023-06-08 16:00:11.00000'),
(42, 41, '{\"meal_time\":{\"1\":\"20:38\"},\"meal_comment\":{\"1\":\"\\u5473\\u564c\\u6c41\"}}', '{\"exercise_time\":{\"1\":\"20:44\"},\"exercise_comment\":{\"1\":\"\\u6563\\u6b69\"}}', '{\"other_time\":{\"1\":\"20:44\"},\"other_comment\":{\"1\":\"\\u7791\\u60f3\"}}', '20:44:00.00000', '20:44:00.00000', '2023-06-07 11:38:51', 1, '2023-06-08 16:00:09.00000'),
(43, 30, '{\"meal_time\":{\"1\":\"13:58\",\"2\":\"13:58\"},\"meal_comment\":{\"1\":\"\\u30b5\\u30fc\\u30e2\\u30f3\",\"2\":\"\\u30d4\\u30fc\\u30ca\\u30c3\\u30c4\"}}', '{\"exercise_time\":{\"1\":\"13:59\"},\"exercise_comment\":{\"1\":\"HIIT\"}}', '{\"other_time\":{\"1\":\"13:59\"},\"other_comment\":{\"1\":\"\\u7791\\u60f3\\u3001\\u30a2\\u30b7\\u30e5\\u30ef\\u30ac\\u30f3\\u30c0\\u3001\\u30d3\\u30fc\\u30c4\\u3001\\u30d3\\u30bf\\u30df\\u30f3DK\\u3001\\u30af\\u30ec\\u30a2\\u30c1\\u30f3\\u3001\\u30cf\\u30a4\\u30c1\\u30aa\\u30fc\\u30ebC\"}}', '04:00:00.00000', '08:30:00.00000', '2023-06-08 05:00:07', 2, '2023-06-08 15:56:49.00000'),
(44, 5, '{\"meal_time\":{\"1\":\"16:02\",\"2\":\"16:02\"},\"meal_comment\":{\"1\":\"\\u7d0d\\u8c46\",\"2\":\"\\u7d0d\\u8c46\"}}', '{\"exercise_time\":{\"1\":\"16:07\"},\"exercise_comment\":{\"1\":\"\\u8155\\u7acb\\u3066\"}}', '{\"other_time\":{\"1\":\"16:02\"},\"other_comment\":{\"1\":\"\\u7791\\u60f3\"}}', '22:03:00.00000', '19:03:00.00000', '2023-06-08 07:03:05', 1, '2023-06-08 16:03:10.00000'),
(45, 5, '{\"meal_time\":{\"1\":\"16:09\"},\"meal_comment\":{\"1\":\"a\"}}', '{\"exercise_time\":{\"1\":\"22:09\"},\"exercise_comment\":{\"1\":\"a\"}}', '{\"other_time\":{\"1\":\"22:09\"},\"other_comment\":{\"1\":\"a\"}}', '22:09:00.00000', '16:15:00.00000', '2023-06-08 07:09:21', 1, '2023-06-08 16:09:33.00000'),
(46, 5, '{\"meal_time\":{\"1\":\"16:54\"},\"meal_comment\":{\"1\":\"\\u30c1\\u30ad\\u30f3\\u30b9\\u30c6\\u30fc\\u30ad\"}}', '{\"exercise_time\":{\"1\":\"22:54\"},\"exercise_comment\":{\"1\":\"\\u8179\\u7b4b\"}}', '{\"other_time\":{\"1\":\"16:54\"},\"other_comment\":{\"1\":\"\\u30b5\\u30a6\\u30ca\"}}', '22:54:00.00000', '16:00:00.00000', '2023-06-08 07:54:28', 1, '2023-06-08 17:04:39.00000');

-- --------------------------------------------------------

--
-- テーブルの構造 `titles`
--

CREATE TABLE `titles` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `title` varchar(255) DEFAULT NULL COMMENT '称号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `titles`
--

INSERT INTO `titles` (`id`, `title`) VALUES
(1, '凡人'),
(2, '健康の発芽者'),
(3, '健康の進化者'),
(4, 'ライフスタイル・アンバサダー'),
(5, 'ウェルネス・プロフェッショナル'),
(6, 'マスター・オブ・ヘルス'),
(7, '習慣の航海者'),
(8, 'ルーティン・エキスパート'),
(9, 'マスター・オブ・ハビッツ'),
(10, 'コンテンツ・イニシエーター'),
(11, 'マスター・コンテンツ・クリエイター'),
(12, 'インフルエンシャル・エキスパート'),
(13, '初心者の闘志'),
(14, '不屈の戦士'),
(15, '不滅の英雄');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `email` varchar(255) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `username` varchar(255) DEFAULT NULL COMMENT 'ユーザー名',
  `last_login` timestamp NULL DEFAULT current_timestamp() COMMENT '最終ログイン日',
  `num_logins` int(4) DEFAULT 0 COMMENT 'ログイン日数',
  `consecutive_login_days` int(4) DEFAULT 0 COMMENT '連続ログイン日数',
  `highest_consecutive_login_days` int(4) DEFAULT 0 COMMENT '最高連続ログイン日数',
  `recovery_days` int(4) DEFAULT 0 COMMENT 'リカバリー日数',
  `avatar_image` varchar(255) DEFAULT NULL COMMENT 'アカウント画像',
  `profile_details` varchar(255) DEFAULT NULL COMMENT 'プロフィール詳細',
  `selected_title_id` int(4) DEFAULT 1 COMMENT '選択中の称号ID',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '登録日時',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `last_login`, `num_logins`, `consecutive_login_days`, `highest_consecutive_login_days`, `recovery_days`, `avatar_image`, `profile_details`, `selected_title_id`, `created_at`, `updated_at`) VALUES
(5, 'test@gmail.com', '$2y$10$iaKMNAi3E9jfZoW.vraY1emSlKPk66Xg2gKxdi5mW4IevnmtTAfbm', 'ShinYamamoto', '2023-06-12 15:00:00', 8, 1, 3, 2, 'profile_pictures/1685863324_マッチョ.jpg', 'こんにちわ。しんです。', 15, '2023-05-08 01:58:14', '2023-06-13 15:10:33'),
(8, 'ryokezu@icloud.com', '$2y$10$H5ctqafUXDVVRjqMNKqZHe44YQra9oD9gATAgOLOEQLuChidlSS4e', 'kezu', '0000-00-00 00:00:00', 0, 0, 0, 0, NULL, NULL, 1, '2023-05-08 09:36:34', '2023-05-08 09:36:34'),
(26, 'apple@gmail.com', '$2y$10$V2GF0nsaO0zuhVzTZeUzZewY4E3kgUBEkUzDBPqR/33EWsrdw9u1C', 'apple', '2023-06-07 15:00:00', 5, 2, 2, 0, 'profile_pictures/1685860872_クリボー.png', NULL, 1, '2023-06-04 14:47:46', '2023-06-08 01:30:38'),
(29, 'ai@gmail.com', '$2y$10$s8n2zrBPSSWCoSF8Csejcu24lg1Vp.j/ZJKXIvLb2m4F53fM4ahE2', 'ホシノアイ', '2023-06-07 15:00:00', 3, 1, 1, 0, 'profile_pictures/1686121700_ai.avif', NULL, 1, '2023-06-07 14:30:16', '2023-06-08 02:11:06'),
(30, 'eren@gmail.com', '$2y$10$6IoJf3B8RrjccNkek06hkezxOZ3ikLSe5RS7P21DUw9glqlT8c5O6', 'Eren Yeager', '2023-06-07 15:00:00', 7, 4, 4, 2, 'profile_pictures/1686121639_eren.jpg', '駆逐してやる。', 2, '2023-06-07 15:08:10', '2023-06-08 17:00:54'),
(40, 'superman@gmail.com', '$2y$10$HQ90zec5HYFBbyXJUL4WsuC2l6APESYY0EnsIPALE5TBgoi2IXxS.', 'Superman', '2023-06-06 15:00:00', 1, 1, 1, 0, NULL, NULL, 1, '2023-06-07 20:35:16', '2023-06-07 20:35:26'),
(41, 'shin@gmail.com', '$2y$10$nFwcd2y.5XQgUteiccDZLeYKXyrsQNDkRi00WtM3XSn97wHrihYUu', 'shin', '2023-06-06 15:00:00', 1, 1, 1, 0, NULL, NULL, 1, '2023-06-07 20:38:07', '2023-06-07 20:38:21');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_titles`
--

CREATE TABLE `user_titles` (
  `id` int(4) NOT NULL COMMENT 'ID',
  `user_id` int(4) DEFAULT NULL COMMENT 'ユーザーID',
  `title_id` int(4) DEFAULT NULL COMMENT '称号ID',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user_titles`
--

INSERT INTO `user_titles` (`id`, `user_id`, `title_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2023-06-03 07:59:49', '2023-06-03 07:59:49'),
(2, 5, 2, '2023-06-03 07:59:49', '2023-06-03 07:59:49'),
(3, 8, 1, '2023-06-03 07:59:49', '2023-06-03 07:59:49'),
(7, 26, 1, '2023-06-04 05:47:46', '2023-06-04 05:47:46'),
(8, 27, 1, '2023-06-04 09:02:40', '2023-06-04 09:02:40'),
(9, 28, 1, '2023-06-04 09:12:30', '2023-06-04 09:12:30'),
(10, 5, 3, '2023-06-05 07:40:39', '2023-06-05 07:40:39'),
(11, 5, 4, '2023-06-05 07:41:00', '2023-06-05 07:41:00'),
(12, 5, 6, '2023-06-05 07:41:08', '2023-06-05 07:41:08'),
(13, 5, 5, '2023-06-05 07:41:20', '2023-06-05 07:41:20'),
(14, 5, 7, '2023-06-05 07:41:28', '2023-06-05 07:41:28'),
(15, 5, 8, '2023-06-05 07:41:34', '2023-06-05 07:41:34'),
(16, 5, 9, '2023-06-05 07:41:40', '2023-06-05 07:41:40'),
(17, 5, 10, '2023-06-05 07:41:47', '2023-06-05 07:41:47'),
(18, 5, 11, '2023-06-05 07:41:55', '2023-06-05 07:41:55'),
(20, 5, 12, '2023-06-05 08:41:34', '2023-06-05 08:41:34'),
(23, 28, 6, '2023-06-05 09:23:30', '2023-06-05 09:23:30'),
(24, 28, 5, '2023-06-05 09:27:21', '2023-06-05 09:27:21'),
(27, 29, 1, '2023-06-07 05:30:16', '2023-06-07 05:30:16'),
(28, 26, 2, '2023-06-07 05:31:08', '2023-06-07 05:31:08'),
(29, 30, 1, '2023-06-07 06:08:10', '2023-06-07 06:08:10'),
(30, 30, 1, '2023-06-07 06:08:22', '2023-06-07 06:08:22'),
(31, 30, 2, '2023-06-07 06:16:29', '2023-06-07 06:16:29'),
(32, 5, 13, '2023-06-07 06:24:23', '2023-06-07 06:24:23'),
(33, 5, 14, '2023-06-07 06:24:28', '2023-06-07 06:24:28'),
(34, 5, 15, '2023-06-07 06:24:35', '2023-06-07 06:24:35'),
(41, 33, 1, '2023-06-07 09:58:46', '2023-06-07 09:58:46'),
(42, 34, 1, '2023-06-07 09:59:49', '2023-06-07 09:59:49'),
(43, 35, 1, '2023-06-07 10:00:45', '2023-06-07 10:00:45'),
(44, 36, 1, '2023-06-07 10:02:47', '2023-06-07 10:02:47'),
(48, 40, 1, '2023-06-07 11:35:16', '2023-06-07 11:35:16'),
(49, 41, 1, '2023-06-07 11:38:07', '2023-06-07 11:38:07'),
(50, 29, 2, '2023-06-07 17:11:06', '2023-06-07 17:11:06'),
(52, 5, 3, '2023-06-08 07:08:50', '2023-06-08 07:08:50'),
(53, 30, 3, '2023-06-08 08:03:03', '2023-06-08 08:03:03'),
(54, 30, 3, '2023-06-08 08:03:18', '2023-06-08 08:03:18');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- テーブルのインデックス `user_titles`
--
ALTER TABLE `user_titles`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=56;

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=164;

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=47;

--
-- テーブルの AUTO_INCREMENT `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=43;

--
-- テーブルの AUTO_INCREMENT `user_titles`
--
ALTER TABLE `user_titles`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
