/*
Navicat MySQL Data Transfer

Source Server         : toandaik
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : thietky_web

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-04 19:55:00
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin_action_log`
-- ----------------------------
DROP TABLE IF EXISTS `admin_action_log`;
CREATE TABLE `admin_action_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_action_log
-- ----------------------------

-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'toandaik', '7c4a8d09ca3762af61e59520943dc26494f8941b', null);

-- ----------------------------
-- Table structure for `card_transaction`
-- ----------------------------
DROP TABLE IF EXISTS `card_transaction`;
CREATE TABLE `card_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_pin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of card_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for `cms`
-- ----------------------------
DROP TABLE IF EXISTS `cms`;
CREATE TABLE `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `published_time` datetime NOT NULL,
  `mota` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms
-- ----------------------------
INSERT INTO `cms` VALUES ('1', 'Giới thiệu hệ thống nhân vật', 'gioi-thieu-he-thong-nhan-vat', '03/07/2016', 'tintuc', '', '<h1>Giới thiệu hệ thống nh&acirc;n vật</h1>\r\n<p>.</p>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('2', 'Giới thiệu hệ thống Kỹ Năng và XP Kỹ Năng', 'gioi-thieu-he-thong-ky-nang-va-xp-ky-nang', '04/07/2016', 'tintuc', '', '<h1>Giới thiệu hệ thống Kỹ Năng v&agrave; XP Kỹ Năng</h1>\r\n<h1>&nbsp;</h1>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('3', 'Giới thiệu hệ thống Tước Vị', 'gioi-thieu-he-thong-tuoc-vi', '04/07/2016', 'tintuc', '', '<h1>Giới thiệu hệ thống Tước Vị</h1>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('4', 'SỰ KIỆN QUÀ NẠP LẦN ĐẦU', 'su-kien-qua-nap-lan-dau', '04/07/2016', 'sukien', '', '<p><strong>Qu&yacute; chư vị bằng hữu th&acirc;n mến,</strong></p>\r\n<p>BQT xin&nbsp;giới thiệu với qu&yacute; vị sự kiện ưu đ&atilde;i cực lớn mang t&ecirc;n&nbsp;<strong>\"Qu&agrave; Nạp Lần Đầu\"&nbsp;</strong>qu&yacute; bằng hữu c&oacute; thể nhận c&aacute;c phần qu&agrave; cực kỳ gi&aacute; trị khi tiến h&agrave;nh nạp&nbsp;thẻ với gi&aacute; trị bất kỳ đầu ti&ecirc;n&nbsp;v&agrave;o game.</p>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('5', 'CHUỖI SỰ KIỆN KHAI MỞ MÁY CHỦ MỚI', 'chuoi-su-kien-khai-mo-may-chu-moi', '04/07/2016', 'sukien', '', '<p><strong>Th&acirc;n ch&agrave;o chư vị bằng hữu,</strong><br />Trong niềm h&acirc;n hoan <strong>BQT</strong>&nbsp;ch&iacute;nh thức mở cửa&nbsp;cho c&aacute;c bằng hữu tranh t&agrave;i xưng đế, &nbsp;<strong>BQT</strong>&nbsp;xin gửi đến c&aacute;c bạn 1 loạt c&aacute;c sự kiện hot nhằm đ&aacute;p lại t&igrave;nh cảm của c&aacute;c bạn đ&atilde; ủng hộ.</p>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('6', 'CƯỜNG HÓA', 'cuong-hoa', '04/07/2016', 'tintuc', '', '<p><strong>Hệ Thống&nbsp;Trang Bị&nbsp;</strong>trong&nbsp;<strong>BQT&nbsp;</strong>cực kỳ phức tạp với c&aacute;c t&iacute;nh năng đặc biệt như Cường&nbsp;H&oacute;a, Khảm Nạm. Trang bị sẽ gi&uacute;p người chơi tăng rất nhiều lực chiến, l&agrave; thứ kh&ocirc;ng thể thiếu trong con đường chinh phục thế giới&nbsp;<strong>BQT.</strong></p>\r\n<p><strong>&nbsp;Trang Bị: Gồm 5 loại phẩm chất:&nbsp;Trắng/Lam/T&iacute;m/V&agrave;ng/Đỏ&nbsp;</strong>(trang bị Ma Long)</p>\r\n<p>- Với số thuộc t&iacute;nh, lỗ cường h&oacute;a kh&aacute;c nhau t&ugrave;y từng phẩm chất Trắng nhỏ nhất, Đỏ lớn nhất.</p>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('7', 'HƯỚNG DẪN NẠP THẺ VÀ QUY ĐỔI TIỀN TỆ', 'huong-dan-nap-the-va-quy-doi-tien-te', '04/07/2016', 'tintuc', '', '<p>Ch&agrave;o c&aacute;c bạn</p>\r\n<p>C&oacute; rất nhiều c&aacute;ch để v&agrave;o trang nạp thẻ ngay trong tr&ograve; chơi&nbsp;.&nbsp;BQT xin hướng dẫn c&aacute;c bạn 1 trong những c&aacute;ch để nạp thẻ cũng như tỉ lệ quy đổi tiền tệ tại game BQT</p>', '0000-00-00 00:00:00', '');
INSERT INTO `cms` VALUES ('8', 'Xóa cache trình duyệt thường xuyên - khuyên dùng', 'xoa-cache-trinh-duyet-thuong-xuyen-khuyen-dung', '04/07/2016', 'camnang', '', '<p>Ch&agrave;o c&aacute;c bạn</p>\r\n<p>C&ugrave;ng n&oacute;i 1 ch&uacute;t về Cache nh&eacute;&nbsp;( Tệp v&agrave; h&igrave;nh ảnh được lưu trước đ&oacute; trong tr&igrave;nh duyệt )</p>\r\n<p>&nbsp;</p>', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'home_banner_1', '/frontend/images/quan-doan-ba-chu.png');
INSERT INTO `config` VALUES ('2', 'home_banner_1_link', '/tin-tuc');
INSERT INTO `config` VALUES ('3', 'home_banner_2', '/frontend/images/quyet-chien-ky-son.png');
INSERT INTO `config` VALUES ('4', 'home_banner_2_link', '/su-kien');
INSERT INTO `config` VALUES ('5', 'home_banner_3', '/frontend/images/banner-3.png');
INSERT INTO `config` VALUES ('6', 'home_banner_3_link', '/tin-tuc');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `refer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `last_server` int(11) DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `balance` bigint(20) NOT NULL,
  `dj` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
