/*
 Navicat Premium Data Transfer

 Source Server         : epart
 Source Server Type    : MySQL
 Source Server Version : 80033
 Source Host           : localhost:3306
 Source Schema         : vcd

 Target Server Type    : MySQL
 Target Server Version : 80033
 File Encoding         : 65001

 Date: 01/12/2023 15:17:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for audio_info
-- ----------------------------
DROP TABLE IF EXISTS `audio_info`;
CREATE TABLE `audio_info`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '音频ID',
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '标题',
  `artist` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '艺术家',
  `genre` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '流派',
  `release_date` date NOT NULL COMMENT '发行日期',
  `price` decimal(8, 2) NOT NULL COMMENT '价格',
  `audio_format` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '音频格式',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL COMMENT '描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of audio_info
-- ----------------------------
INSERT INTO `audio_info` VALUES (1, '歌曲1', '艺术家', '流行', '2022-01-01', 9.99, 'MP3', '描述1');
INSERT INTO `audio_info` VALUES (2, '歌曲2', '艺术家2', '摇滚', '2022-02-15', 12.99, 'WAV', '描述2');
INSERT INTO `audio_info` VALUES (3, '歌曲3', '艺术家3', '爵士', '2022-03-10', 15.99, 'FLAC', '描述3');
INSERT INTO `audio_info` VALUES (4, '破酥', '艺术家4', '电子', '2022-04-22', 11.99, 'MP3', '描述4');
INSERT INTO `audio_info` VALUES (5, '歌曲5', '艺术家5', '古典', '2022-05-18', 14.99, 'WAV', '描述5');
INSERT INTO `audio_info` VALUES (6, '消愁', '毛不易', '流行', '2022-06-30', 10.99, 'FLAC', '描述6');
INSERT INTO `audio_info` VALUES (7, '歌曲7', '艺术家7', '摇滚', '2022-07-12', 13.99, 'MP3', '描述7');
INSERT INTO `audio_info` VALUES (8, '歌曲8', '艺术家8', '爵士', '2022-08-25', 16.99, 'WAV', '描述8');
INSERT INTO `audio_info` VALUES (9, '歌曲9', '艺术家9', '电子', '2022-09-05', 12.99, 'FLAC', '描述9');
INSERT INTO `audio_info` VALUES (10, '歌曲10', '艺术家10', '古典', '2022-10-18', 11.99, 'MP3', '描述10');
INSERT INTO `audio_info` VALUES (11, '歌曲11', '艺术家11', '流行', '2022-11-02', 14.99, 'WAV', '描述11');
INSERT INTO `audio_info` VALUES (12, '歌曲12', '艺术家12', '摇滚', '2022-12-15', 17.99, 'FLAC', '描述12');
INSERT INTO `audio_info` VALUES (13, '歌曲13', '艺术家13', '爵士', '2023-01-20', 13.99, 'MP3', '描述13');
INSERT INTO `audio_info` VALUES (14, '歌曲14', '艺术家14', '电子', '2023-02-28', 15.99, 'WAV', '描述14');
INSERT INTO `audio_info` VALUES (15, '歌曲15', '艺术家15', '古典', '2023-03-08', 18.99, 'FLAC', '描述15');
INSERT INTO `audio_info` VALUES (16, '歌曲16', '艺术家16', '流行', '2023-04-12', 16.99, 'MP3', '描述16');
INSERT INTO `audio_info` VALUES (17, '歌曲17', '艺术家17', '摇滚', '2023-05-25', 19.99, 'WAV', '描述17');
INSERT INTO `audio_info` VALUES (18, '歌曲18', '艺术家18', '爵士', '2023-06-30', 14.99, 'FLAC', '描述18');

-- ----------------------------
-- Table structure for rental_list
-- ----------------------------
DROP TABLE IF EXISTS `rental_list`;
CREATE TABLE `rental_list`  (
  `audio_id` int NOT NULL COMMENT '音频ID',
  `user_id` int NOT NULL COMMENT '用户ID',
  `rental_date` date NOT NULL COMMENT '租赁日期',
  `return_date` date NOT NULL COMMENT '归还日期',
  PRIMARY KEY (`audio_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rental_list
-- ----------------------------
INSERT INTO `rental_list` VALUES (2, 2, '2022-02-10', '2022-03-01');
INSERT INTO `rental_list` VALUES (4, 3, '2023-11-29', '2024-02-29');
INSERT INTO `rental_list` VALUES (5, 3, '2023-11-23', '2024-02-23');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL COMMENT '用户ID',
  `password` char(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT '密码',
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `status` tinyint UNSIGNED NOT NULL DEFAULT 1 COMMENT '0为挂失,1为正常',
  `admin` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT '0为普通用户,1为管理员',
  `last_login_time` datetime NULL DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (2, 'securepass', 'User 2', 1, 0, '2022-02-05 12:45:00');
INSERT INTO `user` VALUES (3, 'admin', 'admin', 1, 1, '2023-11-29 12:19:24');

SET FOREIGN_KEY_CHECKS = 1;
