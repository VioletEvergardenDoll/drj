/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3307
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3307
 Source Schema         : drj

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 10/05/2021 12:34:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for experts
-- ----------------------------
DROP TABLE IF EXISTS `experts`;
CREATE TABLE `experts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hospital` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `education` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of experts
-- ----------------------------
INSERT INTO `experts` VALUES (5, '李天皓', '/upload/expert_thumb/png/20210510/202105100029128891_s.png', '内科', '主任', '医师', '衡水', '<p>公司归属感</p>', '<p>硕博连读</p>', '2021-05-10 00:29:52', '2021-05-10 12:24:25');
INSERT INTO `experts` VALUES (6, 'wangliu', '/upload/expert_thumb/png/20210510/202105100937549188_s.png', '外科', '护士', '护士长', '衡水', '<p>高达</p>', '<p>gas</p>', '2021-05-10 00:34:38', '2021-05-10 09:37:58');
INSERT INTO `experts` VALUES (7, '李景昀', '/upload/expert_thumb/png/20210510/202105101226378226_s.png', '个', '噶', '给广大', '发发', '<p>发发<br/></p>', '<p>公司的公司</p>', '2021-05-10 12:27:01', '2021-05-10 12:27:01');
INSERT INTO `experts` VALUES (8, '许迪', '/upload/expert_thumb/jfif/20210510/202105101228513044_s.jfif', '外科', '教授', '主任医师', '发发', '<p>干法发顺丰感受到各省市哈代发货</p>', '<p>嘎嘎搭嘎</p>', '2021-05-10 12:28:59', '2021-05-10 12:28:59');
INSERT INTO `experts` VALUES (9, '冯兴中', '/upload/expert_thumb/jpg/20210510/202105101230191392_s.jpg', '外科', '主任', '首都医科大学附属北京世纪坛医院中医科名誉主任、糖尿病中心副主任，北京市中西医结合肿瘤研究所常务副所长', '发', '<p>个搭嘎</p>', '<p>个打法的</p>', '2021-05-10 12:30:22', '2021-05-10 12:30:22');
INSERT INTO `experts` VALUES (10, '给我刚发', '/upload/expert_thumb/jpg/20210510/202105101230457663_s.jpg', '高达', '根深蒂固', '公司', '很舒服个', '<p>还是高达</p>', '<p>红色的</p>', '2021-05-10 12:30:47', '2021-05-10 12:30:47');
INSERT INTO `experts` VALUES (11, '公司', '/upload/expert_thumb/jpg/20210510/202105101230543922_s.jpg', '红色的', '还都是', '到衡水好', '还都是', '<p>还都是</p>', '<p>还都是</p>', '2021-05-10 12:31:02', '2021-05-10 12:31:02');
INSERT INTO `experts` VALUES (12, '还都是还都是', '/upload/expert_thumb/jpg/20210510/202105101231087383_s.jpg', '啥都会', '但是就尖幡', '交付给', '规范', '<p>咖啡馆</p>', '<p>开个会</p>', '2021-05-10 12:31:22', '2021-05-10 12:31:22');
INSERT INTO `experts` VALUES (13, '刚试的', '/upload/expert_thumb/jpg/20210510/202105101231282424_s.jpg', '华发商都', '加工费', '阶段', '冀凯股份', '<p>开鞍山市台</p>', '<p>噶尔</p>', '2021-05-10 12:31:40', '2021-05-10 12:31:40');

-- ----------------------------
-- Table structure for lives
-- ----------------------------
DROP TABLE IF EXISTS `lives`;
CREATE TABLE `lives`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_time` datetime(0) NOT NULL,
  `end_time` datetime(0) NOT NULL,
  `photo` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `relation` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL,
  `exid` int(11) NULL DEFAULT NULL,
  `exdepartment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `exphoto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lives
-- ----------------------------
INSERT INTO `lives` VALUES (6, '沙发上撒萨法', '/live/Staring at You.mp4', 1, '<p>刮大风大</p>', '2021-05-10 00:32:00', '2021-05-10 00:33:00', '/upload/live_thumb/png/20210510/202105100032571677_s.png', 'wangliu', '2021-05-10 00:33:03', '2021-05-10 10:31:21', 6, '外科', '/upload/expert_thumb/png/20210510/202105100937549188_s.png');
INSERT INTO `lives` VALUES (7, '放大', '/live/Staring at You.mp4', 1, '<p>发多少</p>', '2021-05-10 10:34:00', '2021-05-10 00:35:00', '/upload/live_thumb/png/20210510/202105100035098507_s.png', 'wangliu', '2021-05-10 00:35:15', '2021-05-10 00:35:15', 6, '外科', '/upload/expert_thumb/jpg/20210510/202105100034233232_s.jpg');
INSERT INTO `lives` VALUES (8, '刮大风是', '/live/Staring at You.mp4', 1, '<p>发发呆</p>', '2021-05-10 10:31:00', '2021-05-10 10:32:00', '/upload/live_thumb/png/20210510/202105101030197679_s.png', '李天皓', '2021-05-10 10:30:24', '2021-05-10 10:37:18', 5, '605', '/upload/expert_thumb/png/20210510/202105100029128891_s.png');
INSERT INTO `lives` VALUES (9, '噶', '/live/Staring at You.mp4', 0, '<p>发生</p>', '2021-05-10 11:35:00', '2021-05-10 13:50:00', '/upload/live_thumb/jpg/20210510/202105101033133000_s.jpg', '李天皓', '2021-05-10 10:33:19', '2021-05-10 10:40:10', 5, '605', '/upload/expert_thumb/png/20210510/202105100029128891_s.png');
INSERT INTO `lives` VALUES (10, '打非官方的', '/live/Staring at You.mp4', 1, '<p>刚打过</p>', '2021-05-10 11:00:00', '2021-05-10 11:00:00', '/upload/live_thumb/jpg/20210510/202105101101226593_s.jpg', '李天皓', '2021-05-10 11:01:25', '2021-05-10 11:01:25', 5, '605', '/upload/expert_thumb/png/20210510/202105100029128891_s.png');
INSERT INTO `lives` VALUES (11, '刚打', '/live/Staring at You.mp4', 1, '<p>还是</p>', '2021-05-10 12:32:00', '2021-05-10 12:32:00', '/upload/live_thumb/jpg/20210510/202105101232445117_s.jpg', '公司', '2021-05-10 12:32:49', '2021-05-10 12:32:49', 11, '红色的', '/upload/expert_thumb/jpg/20210510/202105101230543922_s.jpg');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2021_04_27_171444_create_users_table', 1);
INSERT INTO `migrations` VALUES ('2021_04_27_171647_create_lives_table', 1);
INSERT INTO `migrations` VALUES ('2021_04_27_171749_create_experts_table', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$LDM/8PaSDKwmF335YBzcEu7ydNYk.blV.WsPjOU9ROaVkkjuCNQKi', 'ygLPfCwzPcpkQaFtmlZ5fmJBOt8a3Drq1gZhDdpZa47Gli03RJHMqCqpV2Dd', '2021-05-04 13:04:58', '2021-05-09 23:52:01');

SET FOREIGN_KEY_CHECKS = 1;
