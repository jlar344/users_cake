/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100504
 Source Host           : localhost:3307
 Source Schema         : eclass_db

 Target Server Type    : MariaDB
 Target Server Version : 100504
 File Encoding         : 65001

 Date: 23/05/2022 22:32:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'administrador');
INSERT INTO `roles` VALUES (2, 'usuario');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NULL DEFAULT 1,
  `created` datetime NULL DEFAULT NULL,
  `modified` datetime NULL DEFAULT NULL,
  `deleted` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 't_admin', '779df125b92740903c345e72a05c43bfddfc6822211f29a5f42bf97f14a9f42819a359dfb3ff7ea0def4ea045604f9e346dbad5ef106c9d4be4b7d6c73ad3d82', 'Admin Test', 1, '2022-05-22 03:26:55', '2022-05-24 01:21:46', NULL);
INSERT INTO `users` VALUES (2, 2, 't_usuario1', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Camilo Perez', 1, '2022-05-24 01:25:58', '2022-05-24 01:25:58', NULL);
INSERT INTO `users` VALUES (3, 2, 't_usuario2', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Juan Perez', 1, '2022-05-24 01:25:58', '2022-05-24 01:25:58', NULL);
INSERT INTO `users` VALUES (4, 2, 't_usuario3', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Pedro Juarez', 1, '2022-05-23 21:30:39', '2022-05-23 21:30:39', NULL);
INSERT INTO `users` VALUES (5, 2, 't_usuario4', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Juan Juarez', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (6, 2, 't_usuario5', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Juana Santana', 0, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (7, 2, 't_usuario6', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Fernando James', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (8, 2, 't_usuario7', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Bernado Campos', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (9, 2, 't_usuario8', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Roy Ben', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (10, 2, 't_usuario9', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Robert Saenz', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (11, 2, 't_usuario10', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Alberto Juarez', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (12, 2, 't_usuario11', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Ronaldo Alarcón', 1, '2022-05-23 21:35:33', '2022-05-23 21:35:33', NULL);
INSERT INTO `users` VALUES (13, 2, 't_usuario12', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Jaime Fernandez', 1, '2022-05-23 21:35:34', '2022-05-23 21:35:34', NULL);
INSERT INTO `users` VALUES (14, 2, 't_usuario13', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'José Aran', 1, '2022-05-23 21:35:34', '2022-05-23 21:35:34', NULL);
INSERT INTO `users` VALUES (15, 2, 't_usuario14', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Patricia Perez', 1, '2022-05-23 21:35:34', '2022-05-23 21:35:34', NULL);
INSERT INTO `users` VALUES (16, 2, 't_usuario15', 'b055c31a136547e9dbbe0b4ae7ab7349a1d2500e714ca746a19136322d96d54ae5fa3352c2ade40809035056454fdfaeb82f0f0dedb4fe5b0d8232c12a15f88e', 'Veronica Juarez', 1, '2022-05-23 21:35:34', '2022-05-23 21:35:34', NULL);

SET FOREIGN_KEY_CHECKS = 1;
