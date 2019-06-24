/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 127.0.0.1:3306
 Source Schema         : take

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 15/06/2019 13:23:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '标题',
  `title_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '标题图片',
  `is_hot` int(4) DEFAULT 0 COMMENT '是否热门1是0否',
  `is_top` int(4) DEFAULT 0 COMMENT '是否置顶1是0否',
  `cate_id` int(8) DEFAULT NULL COMMENT '栏目主键',
  `user_id` int(8) DEFAULT NULL COMMENT '用户主键',
  `context` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '文档内容',
  `pv` int(10) DEFAULT 0 COMMENT '阅读量',
  `status` int(4) DEFAULT 1 COMMENT '状态1显示0隐藏',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文章表\r\n' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES (1, 'peter', '20190608\\d31573c4ac7e84265260276b2eb46d19.JPG', 0, 0, 2, 30, 'hgrasrh4aefr', 0, 1, 1559999896, 1559999896);
INSERT INTO `article` VALUES (2, 'php是世界上最好的语言', '20190608\\a0b0c74f44ad4aa6f477a7c211231b87.jpg', 0, 0, 2, 30, '<font color=\"#ff3300\" size=\"5\"><b style=\"\">哈哈哈哈哈哈哈哈哈哈 你是在搞笑吗 这个真的是吗</b></font>', 17, 1, 1560007499, 1560007499);
INSERT INTO `article` VALUES (3, 'whateyoutakeabout', '20190608\\d5b8e4c833a1cfbdaed3298e650eea34.JPG', 0, 0, 1, 30, 'l sping in feel aright keep hongkong', 0, 1, 1559998908, 1559998908);
INSERT INTO `article` VALUES (4, 'mmmmmmmm', '20190608\\bdea450696853c8a152185838714b382.JPG', 0, 0, 4, 28, 'mmmmmmm', 0, 1, 1559998288, 1559998288);
INSERT INTO `article` VALUES (5, 'xxsadasd', '20190608\\cc5dd27c765e835678b9ee2a4ebe8854.JPG', 0, 0, 4, 30, 'sadasdasdasdsd', 0, 1, 1559998809, 1559998809);
INSERT INTO `article` VALUES (6, 'llllllll', '20190608\\096bb514414f6a2de83b6cc250ab03f2.JPG', 0, 0, 3, 28, 'lllllll', 3, 1, 1559998257, 1559998257);
INSERT INTO `article` VALUES (7, 'eqeqeqeqeq', '20190608\\578d42a36802c0f5a80447df0e3440cd.JPG', 0, 0, 2, 28, 'dddddddsss', 0, 1, 1559998237, 1559998237);
INSERT INTO `article` VALUES (8, 'hhhhhhhhh', '20190608\\17c1cf26d325bf1a9743fb95249111b7.JPG', 0, 0, 1, 28, 'hhhhhhhhhhh', 0, 1, 1559998187, 1559998187);
INSERT INTO `article` VALUES (9, 'peter', '20190608\\368b1005e6f5fe594a74ae7745ed42a8.JPG', 0, 0, 3, 27, 'dddddddddd', 0, 1, 1559998144, 1559998144);
INSERT INTO `article` VALUES (12, 'php', '20190608\\08bff5fe6ee71426ea39d258eb2d2044.JPG', 0, 0, 1, 27, 'aaaaaaaaaaaaaaa', 0, 1, 1559998082, 1559998082);

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category`  (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL COMMENT '用户主键',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '栏目名称',
  `sort` int(4) DEFAULT NULL COMMENT '栏目用户',
  `status` int(4) DEFAULT 1 COMMENT '状态1显示0隐藏',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 60 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '栏目表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES (1, 27, 'PHP', 1, 1, 1559564982, 1560526206);
INSERT INTO `article_category` VALUES (2, 27, 'Java', 2, 1, 1560522475, 1560526206);
INSERT INTO `article_category` VALUES (3, 27, 'Vue', 3, 1, 1559564982, 1560526206);
INSERT INTO `article_category` VALUES (4, 27, 'TP5', 4, 1, 1560522794, 1560526206);
INSERT INTO `article_category` VALUES (27, 27, 'HTML', 5, 0, 1560523467, 1560523467);
INSERT INTO `article_category` VALUES (59, 27, 'PST', 12, 1, 1560568310, 1560568310);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `role` tinyint(2) DEFAULT NULL COMMENT '角色',
  `status` int(2) DEFAULT 1 COMMENT '状态1启用0禁用',
  `is_admin` int(2) DEFAULT 0 COMMENT '是否管理员',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `login_time` int(11) UNSIGNED DEFAULT NULL COMMENT '登录时间',
  `login_count` int(11) UNSIGNED DEFAULT 0 COMMENT '登录次数',
  `is_delete` int(2) UNSIGNED DEFAULT 0 COMMENT '是否删除1是0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (27, 'admin', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', 'admin@php.com', NULL, 1, 1, 1559564982, 1559564982, NULL, NULL, 0, 0);
INSERT INTO `user` VALUES (28, 'peter', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', 'peter@qq.com', NULL, 1, 0, 1559565065, 1559565065, NULL, NULL, 0, 0);
INSERT INTO `user` VALUES (29, 'xiaoli', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', 'xiaoli@qq.com', NULL, 1, 0, 1559574179, 1559574179, NULL, NULL, 0, 0);
INSERT INTO `user` VALUES (30, 'lisia', '4d9012b4a77a9524d675dad27c3276ab5705e5e8', 'lisi@qq.com', NULL, 1, 0, 1559915874, 1559915874, NULL, NULL, 0, 0);

-- ----------------------------
-- Table structure for user_comments
-- ----------------------------
DROP TABLE IF EXISTS `user_comments`;
CREATE TABLE `user_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL COMMENT '用户主键',
  `art_id` int(10) DEFAULT NULL COMMENT '文档主键',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '评论内容',
  `reply_id` int(10) DEFAULT NULL COMMENT '回复Id',
  `status` int(4) DEFAULT NULL COMMENT '1显示0隐藏',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_fav
-- ----------------------------
DROP TABLE IF EXISTS `user_fav`;
CREATE TABLE `user_fav`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `art_id` int(10) DEFAULT NULL COMMENT '文档主键',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '收藏表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of user_fav
-- ----------------------------
INSERT INTO `user_fav` VALUES (5, 30, 2);
INSERT INTO `user_fav` VALUES (12, 31, 19);

-- ----------------------------
-- Table structure for user_like
-- ----------------------------
DROP TABLE IF EXISTS `user_like`;
CREATE TABLE `user_like`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `art_id` int(10) DEFAULT NULL COMMENT '文档主键',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '点赞表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of user_like
-- ----------------------------
INSERT INTO `user_like` VALUES (12, 31, 19);

SET FOREIGN_KEY_CHECKS = 1;
