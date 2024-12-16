/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : escul

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-12-10 08:50:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('61', '0001_01_01_000000_create_tc_ciclo_escolar_table', '1');
INSERT INTO `migrations` VALUES ('62', '0001_01_01_000000_create_tc_materia_table', '1');
INSERT INTO `migrations` VALUES ('63', '0001_01_01_000000_create_tc_matricula_table', '1');
INSERT INTO `migrations` VALUES ('64', '0001_01_01_000000_create_tc_mes_table', '1');
INSERT INTO `migrations` VALUES ('65', '0001_01_01_000000_create_tc_nivel_educativo_table', '1');
INSERT INTO `migrations` VALUES ('66', '0001_01_01_000000_create_tc_roll_table', '1');
INSERT INTO `migrations` VALUES ('67', '0001_01_01_000000_create_tc_tipo_calificacion_table', '1');
INSERT INTO `migrations` VALUES ('68', '0001_01_01_000000_create_tr_grupo_alumno_table', '1');
INSERT INTO `migrations` VALUES ('69', '0001_01_01_000000_create_tw_boleta_table', '1');
INSERT INTO `migrations` VALUES ('70', '0001_01_01_000000_create_tw_calificacion_table', '1');
INSERT INTO `migrations` VALUES ('71', '0001_01_01_000000_create_tw_usuario_table', '1');
INSERT INTO `migrations` VALUES ('72', '0001_01_01_000001_create_cache_table', '1');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for tc_ciclo_escolar
-- ----------------------------
DROP TABLE IF EXISTS `tc_ciclo_escolar`;
CREATE TABLE `tc_ciclo_escolar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ano_ini` year(4) NOT NULL,
  `ano_fin` year(4) NOT NULL,
  `periodo` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `denominacion` varchar(191) NOT NULL,
  `abreviatura` varchar(191) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `date_ini` varchar(20) NOT NULL,
  `date_fin` varchar(20) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_ciclo_escolar
-- ----------------------------

-- ----------------------------
-- Table structure for tc_materia
-- ----------------------------
DROP TABLE IF EXISTS `tc_materia`;
CREATE TABLE `tc_materia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `materia` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_materia
-- ----------------------------

-- ----------------------------
-- Table structure for tc_matricula
-- ----------------------------
DROP TABLE IF EXISTS `tc_matricula`;
CREATE TABLE `tc_matricula` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `formato` varchar(191) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `ini_matricula` int(11) NOT NULL,
  `consecutivo_matricula` int(11) NOT NULL,
  `limite_matricula` int(11) NOT NULL,
  `permitir_modificar` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_matricula
-- ----------------------------
INSERT INTO `tc_matricula` VALUES ('1', 'a[aaaa]', '1', '1', '1', '111', '0', '2024-12-06 16:15:00', '2024-12-06 16:15:00');
INSERT INTO `tc_matricula` VALUES ('2', 'set[ggggg][plan]', '1', '1', '1', '500', '0', '2024-12-06 19:57:57', '2024-12-06 19:57:57');

-- ----------------------------
-- Table structure for tc_mes
-- ----------------------------
DROP TABLE IF EXISTS `tc_mes`;
CREATE TABLE `tc_mes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mes` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_mes
-- ----------------------------

-- ----------------------------
-- Table structure for tc_nivel_educativo
-- ----------------------------
DROP TABLE IF EXISTS `tc_nivel_educativo`;
CREATE TABLE `tc_nivel_educativo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave_identificador` varchar(191) NOT NULL,
  `descripcion` varchar(191) NOT NULL,
  `director_usuario_id` bigint(20) unsigned NOT NULL,
  `acuerdo_creacion_incorporacion` varchar(191) NOT NULL,
  `date` varchar(191) NOT NULL,
  `fecha_incorporacion` date NOT NULL,
  `zona_escolar` int(11) NOT NULL,
  `denominacion_grado` varchar(191) NOT NULL,
  `grado_ini` int(11) NOT NULL,
  `grado_fin` int(11) NOT NULL,
  `matricula_id` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_nivel_educativo
-- ----------------------------
INSERT INTO `tc_nivel_educativo` VALUES ('1', 'PRIM', 'PRIMARIA', '3', '123123adsasd', 'Diciembre / 06 / 2024', '2024-12-06', '1', 'AÑO', '1', '6', '1', '1', '2024-12-06 16:15:19', '2024-12-06 16:15:19');

-- ----------------------------
-- Table structure for tc_roll
-- ----------------------------
DROP TABLE IF EXISTS `tc_roll`;
CREATE TABLE `tc_roll` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roll` varchar(191) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `hash` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_roll
-- ----------------------------
INSERT INTO `tc_roll` VALUES ('1', 'administrador', '1', '$2y$12$/EFjsyMSXaTcYOaOZ1FNfekhzTEa5SVgcQv8yHXx7qjunRlQqN90.', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('2', 'admin', '1', '$2y$12$E0qk30zHJhzXqChRtruyB.cTvqr3BvAlqUNjpDA8LY6rOHHlH8aXe', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('3', 'director', '1', '$2y$12$8CCDBV/koC2CNDI0ygN3Au0V1cDgr7.0sGDrGak.heLXdXvIJWG8q', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('4', 'profesor', '1', '$2y$12$2mIt4JMb0k7d2ulMstOioOOH5weNRHNMKkF9Fr3aoTS32w20dU0Jq', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('5', 'tutor', '1', '$2y$12$zYHQJPEGoOEEBIsCl/EOMeflHP8JGBCh7Xx7Gbx/gUti6QC9z3.0O', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('6', 'padres', '1', '$2y$12$7MnO29TCUlnVnYn3vwpTX.hT0GXd3DXmSafQ.HD5mPynWAgZGSSV.', '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tc_roll` VALUES ('7', 'estudiante', '1', '$2y$12$EvFpwfSM02aal2jXTBwZyupb/CEL/uMhRNiNeE1D62pAg71IzC5Ku', '2024-12-06 16:14:47', '2024-12-06 16:14:47');

-- ----------------------------
-- Table structure for tc_tipo_calificacion
-- ----------------------------
DROP TABLE IF EXISTS `tc_tipo_calificacion`;
CREATE TABLE `tc_tipo_calificacion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resultado` char(3) NOT NULL,
  `calificacion` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tc_tipo_calificacion
-- ----------------------------

-- ----------------------------
-- Table structure for tr_grupo_alumno
-- ----------------------------
DROP TABLE IF EXISTS `tr_grupo_alumno`;
CREATE TABLE `tr_grupo_alumno` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `maestro_usuario_id` bigint(20) unsigned NOT NULL,
  `tutor_usuario_id` bigint(20) unsigned NOT NULL,
  `alumno_usuario_id` bigint(20) unsigned NOT NULL,
  `clico_escolar_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tr_grupo_alumno
-- ----------------------------

-- ----------------------------
-- Table structure for tw_boleta
-- ----------------------------
DROP TABLE IF EXISTS `tw_boleta`;
CREATE TABLE `tw_boleta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alimno_usuario_id` bigint(20) unsigned NOT NULL,
  `promedio_general` double NOT NULL,
  `materia_id` bigint(20) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tw_boleta
-- ----------------------------

-- ----------------------------
-- Table structure for tw_calificacion
-- ----------------------------
DROP TABLE IF EXISTS `tw_calificacion`;
CREATE TABLE `tw_calificacion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `materia_id` bigint(20) unsigned NOT NULL,
  `boleta_id` bigint(20) unsigned NOT NULL,
  `tipo_calificacion_id` bigint(20) unsigned NOT NULL,
  `maestro_usuario_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tw_calificacion
-- ----------------------------

-- ----------------------------
-- Table structure for tw_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tw_usuario`;
CREATE TABLE `tw_usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ap_pat` varchar(191) NOT NULL,
  `ap_mat` varchar(191) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `correo` varchar(191) NOT NULL,
  `contrasena` varchar(191) NOT NULL,
  `roll_id` bigint(20) unsigned NOT NULL,
  `telefono` varchar(191) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tw_usuario_correo_unique` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tw_usuario
-- ----------------------------
INSERT INTO `tw_usuario` VALUES ('1', 'Meza', 'Temoltzi', 'Gustavo', 'admin@gmail.com', '$2y$12$JnqqeXqC0ymVN2iwbTCQkOBGJK9GH0DXUeNYpNYzdtZdU606b0pDa', '1', '2221712060', '2024-12-06 10:14:47', '1', null, '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tw_usuario` VALUES ('2', 'Mendoza', 'Juarez', 'Alberto', 'albert@gmail.com', '$2y$12$gqZP05s35vba2oTWUj95.e5HHkI7sTzkxn4pAvczn47egMl4TiYVu', '2', '2223510472', '2024-12-06 10:14:47', '1', null, '2024-12-06 16:14:47', '2024-12-06 16:14:47');
INSERT INTO `tw_usuario` VALUES ('3', 'den', 'nim', 'test', 'test@gmail.com', '$2y$12$MmJJc6bWB1rX1ceUC2gr7.cBF9965JyQx9dWwC6inCzETnBgWhx1a', '3', '2221745414', '2024-12-06 10:18:56', '1', null, '2024-12-06 16:14:47', '2024-12-06 16:18:56');
