/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : video

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 20/09/2019 18:46:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for h_res_video
-- ----------------------------
DROP TABLE IF EXISTS `h_res_video`;
CREATE TABLE `h_res_video`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名',
  `alise` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '别名',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '影片描述, hd, 高清等',
  `director` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '导演',
  `actor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '演员',
  `language` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '语言',
  `area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '地区',
  `intro` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '简介',
  `showtime` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上映时间',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '类型',
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '封面',
  `res` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '源资源json串',
  `md5` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '源资源js 的md5值, 判断源资源是否更新',
  `res_from` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '源来源',
  `res_id` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '源id',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '采集地址',
  `timeline` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '添加更新时间',
  `isup` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '是否已上传: 0:未, 1已',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `res_id`(`res_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5023 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '电视剧资源' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
