/*
 Navicat Premium Data Transfer

 Source Server         : ATTC Nigeria
 Source Server Type    : MySQL
 Source Server Version : 100328
 Source Host           : 127.0.0.1:3306
 Source Schema         : attclmqk_main

 Target Server Type    : MySQL
 Target Server Version : 100328
 File Encoding         : 65001

 Date: 26/07/2021 09:16:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2021_05_03_124141_create_roles_table', 1);
INSERT INTO `migrations` VALUES (5, '2021_05_03_124213_create_permissions_table', 1);
INSERT INTO `migrations` VALUES (6, '2021_05_03_125039_create_users_permissions_table', 1);
INSERT INTO `migrations` VALUES (7, '2021_05_03_125139_create_users_roles_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_05_03_125235_create_roles_permissions_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_05_03_125512_create_titles_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'View Settings', 'view-settings', '2021-05-05 12:40:07', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'View Manage User', 'view-manage-user', '2021-05-05 12:40:42', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'View Master Manager', 'view-master-manager', '2021-05-05 12:41:24', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'View Menu Permission', 'view-menu-permission', '2021-05-05 12:51:55', NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'View Update Role', 'view-update-role', '2021-05-05 12:59:26', NULL, NULL);
INSERT INTO `permissions` VALUES (6, 'View Update Permission', 'view-update-permission', '2021-05-05 13:00:02', NULL, NULL);
INSERT INTO `permissions` VALUES (7, 'View Special Permission', 'view-special-permission', '2021-05-05 13:01:36', NULL, NULL);
INSERT INTO `permissions` VALUES (8, 'View Manage Department', 'view-manage-department', '2021-05-05 13:02:37', NULL, NULL);
INSERT INTO `permissions` VALUES (9, 'Add New Role', 'add-new-role', '2021-05-05 13:05:03', NULL, NULL);
INSERT INTO `permissions` VALUES (10, 'Edit Role', 'edit-role', '2021-05-05 13:07:46', NULL, NULL);
INSERT INTO `permissions` VALUES (11, 'Add Permission', 'add-permission', '2021-05-05 13:10:24', NULL, NULL);
INSERT INTO `permissions` VALUES (12, 'Edit Permission', 'edit-permission', '2021-05-05 13:12:21', NULL, NULL);
INSERT INTO `permissions` VALUES (13, 'Assign Special Permission', 'assign-special-permission', '2021-05-05 15:45:59', NULL, NULL);
INSERT INTO `permissions` VALUES (14, 'Save Menu Permission', 'save-menu-permission', '2021-05-05 15:45:59', NULL, NULL);
INSERT INTO `permissions` VALUES (15, 'Edit Users', 'edit-users', '2021-05-05 15:45:59', NULL, NULL);
INSERT INTO `permissions` VALUES (16, 'Create User', 'create-user', '2021-05-09 18:10:46', NULL, NULL);
INSERT INTO `permissions` VALUES (17, 'Create Department', 'create-department', '2021-05-10 23:13:40', NULL, NULL);
INSERT INTO `permissions` VALUES (18, 'View Manage Department', 'view-manage-department', '2021-05-10 23:14:19', NULL, NULL);
INSERT INTO `permissions` VALUES (19, 'Edit Department', 'edit-department', '2021-05-10 23:14:49', NULL, NULL);
INSERT INTO `permissions` VALUES (20, 'Create Designation', 'create-designation', '2021-05-10 23:15:24', NULL, NULL);
INSERT INTO `permissions` VALUES (21, 'Edit Designation', 'edit-designation', '2021-05-10 23:15:42', NULL, NULL);
INSERT INTO `permissions` VALUES (22, 'View Manage Designation', 'view-manage-designation', '2021-05-10 23:16:06', NULL, NULL);
INSERT INTO `permissions` VALUES (23, 'View Course Manager', 'view-course-manager', '2021-05-16 23:57:17', NULL, NULL);
INSERT INTO `permissions` VALUES (24, 'View All Course List', 'view-all-course-list', '2021-05-16 23:58:03', NULL, NULL);
INSERT INTO `permissions` VALUES (25, 'Edit Courses', 'edit-courses', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (26, 'Create Course', 'create-course', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (27, 'Map Course to Lecturer', 'map-lecturer-to-courses', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (28, 'View Assigned Courses', 'view-assigned-courses', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (29, 'View Online Class Facility', 'view-online-class-facility', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (30, 'View Take C.A ', 'view-take-ca', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (31, 'View My Certificate', 'view-certificate', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (32, 'View Assessment Manager', 'view-assessment-manager', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (33, 'View Payments Portal', 'view-payment-portal', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (34, 'View Events Manager', 'view-events-manager', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (36, 'View Application on Dashboard', 'view-application-on-dashboard', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (37, 'View Application Manager', 'view-application-manager', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (38, 'View Student Application', 'view-student-application', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (39, 'View My Application', 'view-my-application', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (40, 'Approve Level One', 'approve-level-one', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (41, 'Can Pay Tuition Fee', 'can-pay-tuition-fees', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (42, 'Pay with Bank Transfer', 'pay-with-bank-transfer', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (43, 'Pay with Debit Card', 'pay-with-debit-card', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (44, 'View Bank Transfer', 'view-bank-transfer', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (45, 'Confirm Bank Transfer', 'confirm-bank-transfer', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (46, 'View Student ID', 'view-student-id', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (47, 'View Time Table', 'view-time-table', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (48, 'Manage Assessment Weight', 'manage-assessment-weight', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (49, 'View Upload C.A Question', 'view-upload-ca-question', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (50, 'View All Courses Selection List', 'view-all-courses-selection-list', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (51, 'View Manage Student', 'view-manage-student', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (52, 'View My Student', 'view-my-student', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (53, 'View All Student', 'view-all-students', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (54, 'Edit Student Record', 'edit-student-record', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (55, 'Manage My Assessment', 'manage-my-assessment', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (56, 'Edit Assessment', 'edit_assessement', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (57, 'Create Assessment', 'create-assessment', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (58, 'Event List', 'view-event-list', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (59, 'Edit Event', 'edit-event', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (60, 'Create Event', 'create-event', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (61, 'Dashboard Total Student', 'dashboard-total-student', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (62, 'Dashboard Total Student Application', 'dashboard-total-student-application', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (63, 'Dashboard Total Programmes', 'dashboard-total-programmes', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (64, 'Dashboard Total Courses', 'dashboard-total-courses', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (65, 'Dashboard Total Lecturer', 'dashboard-total-lecturer', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (66, 'Dashboard My student', 'dashboard-my-student', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (67, 'View Programme Manager', 'view-programme-manager', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (68, 'Edit Programme', 'edit-programme', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (69, 'Create Programme', 'create-programme', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (70, 'View Programmme List', 'view-programme-list', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (71, 'View Payment Report', 'view-payment-report', NULL, NULL, NULL);
INSERT INTO `permissions` VALUES (72, 'Manage Question', 'manage-question', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Developer', 'developer', '2021-05-03 14:02:22', '2021-05-23 22:32:51', 'User with this role have full right to the system');
INSERT INTO `roles` VALUES (2, 'System Support', 'support', '2021-05-03 14:02:22', '2021-05-23 22:32:39', 'User with this role have full admin rights to the system');
INSERT INTO `roles` VALUES (5, 'Prospective Student', 'prospective_student', '2021-05-23 22:31:10', '2021-05-23 22:31:10', 'Student who has not gotten admission into the institute');
INSERT INTO `roles` VALUES (6, 'Student', 'student', '2021-05-23 22:32:13', '2021-05-23 22:32:13', 'Current student of the institute');
INSERT INTO `roles` VALUES (7, 'Lecturer', 'lecturer', '2021-05-26 15:52:29', '2021-06-07 09:58:04', 'Lecturer of ATTC');

-- ----------------------------
-- Table structure for roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `roles_permissions`;
CREATE TABLE `roles_permissions`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`) USING BTREE,
  INDEX `roles_permissions_permission_id_foreign`(`permission_id`) USING BTREE,
  CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles_permissions
-- ----------------------------
INSERT INTO `roles_permissions` VALUES (1, 1);
INSERT INTO `roles_permissions` VALUES (1, 2);
INSERT INTO `roles_permissions` VALUES (1, 3);
INSERT INTO `roles_permissions` VALUES (1, 4);
INSERT INTO `roles_permissions` VALUES (1, 5);
INSERT INTO `roles_permissions` VALUES (1, 6);
INSERT INTO `roles_permissions` VALUES (1, 7);
INSERT INTO `roles_permissions` VALUES (1, 8);
INSERT INTO `roles_permissions` VALUES (1, 9);
INSERT INTO `roles_permissions` VALUES (1, 10);
INSERT INTO `roles_permissions` VALUES (1, 11);
INSERT INTO `roles_permissions` VALUES (1, 12);
INSERT INTO `roles_permissions` VALUES (1, 13);
INSERT INTO `roles_permissions` VALUES (1, 14);
INSERT INTO `roles_permissions` VALUES (1, 15);
INSERT INTO `roles_permissions` VALUES (1, 16);
INSERT INTO `roles_permissions` VALUES (1, 17);
INSERT INTO `roles_permissions` VALUES (1, 18);
INSERT INTO `roles_permissions` VALUES (1, 19);
INSERT INTO `roles_permissions` VALUES (1, 20);
INSERT INTO `roles_permissions` VALUES (1, 21);
INSERT INTO `roles_permissions` VALUES (1, 22);
INSERT INTO `roles_permissions` VALUES (1, 23);
INSERT INTO `roles_permissions` VALUES (1, 24);
INSERT INTO `roles_permissions` VALUES (1, 25);
INSERT INTO `roles_permissions` VALUES (1, 26);
INSERT INTO `roles_permissions` VALUES (1, 27);
INSERT INTO `roles_permissions` VALUES (1, 28);
INSERT INTO `roles_permissions` VALUES (1, 29);
INSERT INTO `roles_permissions` VALUES (1, 30);
INSERT INTO `roles_permissions` VALUES (1, 31);
INSERT INTO `roles_permissions` VALUES (1, 32);
INSERT INTO `roles_permissions` VALUES (1, 33);
INSERT INTO `roles_permissions` VALUES (1, 34);
INSERT INTO `roles_permissions` VALUES (1, 36);
INSERT INTO `roles_permissions` VALUES (1, 37);
INSERT INTO `roles_permissions` VALUES (1, 38);
INSERT INTO `roles_permissions` VALUES (1, 39);
INSERT INTO `roles_permissions` VALUES (1, 40);
INSERT INTO `roles_permissions` VALUES (1, 41);
INSERT INTO `roles_permissions` VALUES (1, 42);
INSERT INTO `roles_permissions` VALUES (1, 43);
INSERT INTO `roles_permissions` VALUES (1, 44);
INSERT INTO `roles_permissions` VALUES (1, 45);
INSERT INTO `roles_permissions` VALUES (1, 47);
INSERT INTO `roles_permissions` VALUES (1, 49);
INSERT INTO `roles_permissions` VALUES (1, 50);
INSERT INTO `roles_permissions` VALUES (1, 51);
INSERT INTO `roles_permissions` VALUES (1, 52);
INSERT INTO `roles_permissions` VALUES (1, 53);
INSERT INTO `roles_permissions` VALUES (1, 54);
INSERT INTO `roles_permissions` VALUES (1, 55);
INSERT INTO `roles_permissions` VALUES (1, 56);
INSERT INTO `roles_permissions` VALUES (1, 57);
INSERT INTO `roles_permissions` VALUES (1, 58);
INSERT INTO `roles_permissions` VALUES (1, 59);
INSERT INTO `roles_permissions` VALUES (1, 60);
INSERT INTO `roles_permissions` VALUES (1, 61);
INSERT INTO `roles_permissions` VALUES (1, 62);
INSERT INTO `roles_permissions` VALUES (1, 63);
INSERT INTO `roles_permissions` VALUES (1, 64);
INSERT INTO `roles_permissions` VALUES (1, 65);
INSERT INTO `roles_permissions` VALUES (1, 67);
INSERT INTO `roles_permissions` VALUES (1, 68);
INSERT INTO `roles_permissions` VALUES (1, 69);
INSERT INTO `roles_permissions` VALUES (1, 70);
INSERT INTO `roles_permissions` VALUES (1, 71);
INSERT INTO `roles_permissions` VALUES (1, 72);
INSERT INTO `roles_permissions` VALUES (2, 2);
INSERT INTO `roles_permissions` VALUES (2, 3);
INSERT INTO `roles_permissions` VALUES (2, 15);
INSERT INTO `roles_permissions` VALUES (2, 16);
INSERT INTO `roles_permissions` VALUES (2, 17);
INSERT INTO `roles_permissions` VALUES (2, 18);
INSERT INTO `roles_permissions` VALUES (2, 19);
INSERT INTO `roles_permissions` VALUES (2, 20);
INSERT INTO `roles_permissions` VALUES (2, 21);
INSERT INTO `roles_permissions` VALUES (2, 22);
INSERT INTO `roles_permissions` VALUES (2, 44);
INSERT INTO `roles_permissions` VALUES (2, 45);
INSERT INTO `roles_permissions` VALUES (2, 53);
INSERT INTO `roles_permissions` VALUES (2, 54);
INSERT INTO `roles_permissions` VALUES (2, 58);
INSERT INTO `roles_permissions` VALUES (2, 59);
INSERT INTO `roles_permissions` VALUES (2, 60);
INSERT INTO `roles_permissions` VALUES (2, 61);
INSERT INTO `roles_permissions` VALUES (2, 62);
INSERT INTO `roles_permissions` VALUES (2, 63);
INSERT INTO `roles_permissions` VALUES (2, 64);
INSERT INTO `roles_permissions` VALUES (2, 65);
INSERT INTO `roles_permissions` VALUES (2, 66);
INSERT INTO `roles_permissions` VALUES (2, 67);
INSERT INTO `roles_permissions` VALUES (2, 68);
INSERT INTO `roles_permissions` VALUES (2, 69);
INSERT INTO `roles_permissions` VALUES (2, 71);
INSERT INTO `roles_permissions` VALUES (5, 33);
INSERT INTO `roles_permissions` VALUES (5, 36);
INSERT INTO `roles_permissions` VALUES (5, 41);
INSERT INTO `roles_permissions` VALUES (5, 42);
INSERT INTO `roles_permissions` VALUES (5, 43);
INSERT INTO `roles_permissions` VALUES (6, 29);
INSERT INTO `roles_permissions` VALUES (6, 30);
INSERT INTO `roles_permissions` VALUES (6, 31);
INSERT INTO `roles_permissions` VALUES (6, 33);
INSERT INTO `roles_permissions` VALUES (6, 37);
INSERT INTO `roles_permissions` VALUES (6, 39);
INSERT INTO `roles_permissions` VALUES (6, 41);
INSERT INTO `roles_permissions` VALUES (6, 42);
INSERT INTO `roles_permissions` VALUES (6, 43);
INSERT INTO `roles_permissions` VALUES (6, 46);
INSERT INTO `roles_permissions` VALUES (6, 47);
INSERT INTO `roles_permissions` VALUES (7, 23);
INSERT INTO `roles_permissions` VALUES (7, 28);
INSERT INTO `roles_permissions` VALUES (7, 32);
INSERT INTO `roles_permissions` VALUES (7, 49);
INSERT INTO `roles_permissions` VALUES (7, 51);
INSERT INTO `roles_permissions` VALUES (7, 52);
INSERT INTO `roles_permissions` VALUES (7, 55);
INSERT INTO `roles_permissions` VALUES (7, 56);
INSERT INTO `roles_permissions` VALUES (7, 57);
INSERT INTO `roles_permissions` VALUES (7, 66);

-- ----------------------------
-- Table structure for tbl_accommodation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_accommodation`;
CREATE TABLE `tbl_accommodation`  (
  `accommodation_id` int(11) NOT NULL AUTO_INCREMENT,
  `accommodation_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `accommodation_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `facility` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `in_your_room` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `shared_space` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `accommodation_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`accommodation_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_accommodation
-- ----------------------------
INSERT INTO `tbl_accommodation` VALUES (1, 'Institute Accommodation', '<p>Our Hostel is on the same premises where students receive lectures, it is one of the cheapest accommodations the school can offer to new students who gained an admission into a programme</p>', '<ul>\r\n<li>On campus</li>\r\n<li>All bills included (gas, water, electricity, internet and possessions insurance)</li>\r\n<li>Wi-Fi and wired internet</li>\r\n<li>En suite and non-en suite rooms available</li>\r\n<li>Cleaning provided in communal areas three times a week</li>\r\n<li>Self-service launderette</li>\r\n<li>Common room</li>\r\n<li>Bicycle storage</li>\r\n<li>Individual mail boxes</li>\r\n<li>Parcel collection point on campus</li>\r\n<li>Residential Assistants living on-site</li>\r\n<li>24-hour campus security and external CCTV</li>\r\n<li>Repairs and maintenance service included in the rent</li>\r\n<li>We\'re unable to offer car parking</li>\r\n</ul>', '<ul>\r\n<li>Small double bed (4ft) with mattress and mattress protector</li>\r\n<li>Wardrobe with shelf</li>\r\n<li>Desk and chair</li>\r\n<li>Noticeboard</li>\r\n<li>Mini fridge</li>\r\n<li>Rubbish bin</li>\r\n<li>Desk lamp</li>\r\n<li>Under-bed storage (some rooms include a storage box too)</li>\r\n</ul>\r\n<p>En suite rooms (61 available) contain:</p>\r\n<ul>\r\n<li>Toilet</li>\r\n<li>Sink</li>\r\n<li>Mirror</li>\r\n<li>Shower</li>\r\n</ul>', '<p>Kitchens (shared between five to eight students)</p>\r\n<ul>\r\n<li>Fridge freezer</li>\r\n<li>Oven with grill and hob</li>\r\n<li>Microwave</li>\r\n<li>Cupboard space</li>\r\n<li>Dining table and chairs</li>\r\n<li>Vacuum cleaner</li>\r\n<li>Ironing board</li>\r\n<li>Mop and bucket</li>\r\n<li>Dustpan and brush</li>\r\n<li>Broom</li>\r\n<li>Noticeboard</li>\r\n</ul>\r\n<p>Shared bathrooms (Flat 4 only, shared between seven students)</p>\r\n<ul>\r\n<li>Two toilets</li>\r\n<li>Two sinks</li>\r\n<li>One shower</li>\r\n<li>One bath</li>\r\n<li>Mirrors</li>\r\n</ul>\r\n<p>Common room</p>\r\n<ul>\r\n<li>TV</li>\r\n<li>Sofas</li>\r\n<li>Tables and benches</li>\r\n</ul>', NULL, '2021-05-19 10:07:25', 1, 1, '1-1.jpg;1-2.jpg;1-3.jpg;1-4.jpg');

-- ----------------------------
-- Table structure for tbl_application_courses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_application_courses`;
CREATE TABLE `tbl_application_courses`  (
  `application_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `application_course_price` decimal(10, 2) NULL DEFAULT NULL,
  `app_created_by` int(10) NULL DEFAULT NULL,
  `app_creation_date` datetime(0) NULL DEFAULT NULL,
  `ca1` int(10) NULL DEFAULT NULL COMMENT 'First C.A Written',
  `ca2` int(10) NULL DEFAULT NULL COMMENT 'Second C.A Written',
  `ca3` int(10) NULL DEFAULT NULL COMMENT 'Third C.A Written',
  `ca4` int(10) NULL DEFAULT NULL COMMENT 'Fourth C.A Written',
  `exam` int(10) NULL DEFAULT NULL COMMENT 'Exam Grade',
  PRIMARY KEY (`application_id`, `course_id`) USING BTREE,
  INDEX `course_id`(`course_id`) USING BTREE,
  CONSTRAINT `application_id` FOREIGN KEY (`application_id`) REFERENCES `tbl_applications` (`application_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `tbl_courses` (`course_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_application_courses
-- ----------------------------
INSERT INTO `tbl_application_courses` VALUES (34, 36, 35000.00, 19, '2021-07-26 00:29:33', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_application_courses` VALUES (35, 32, 198000.00, 19, '2021-07-26 00:35:30', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_application_courses` VALUES (36, 42, 128000.00, 20, '2021-07-26 06:50:51', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_application_documents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_application_documents`;
CREATE TABLE `tbl_application_documents`  (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_application_documents
-- ----------------------------
INSERT INTO `tbl_application_documents` VALUES (1, 'Academic Qualification');
INSERT INTO `tbl_application_documents` VALUES (2, 'Working Experience');
INSERT INTO `tbl_application_documents` VALUES (3, 'Offer Letter');
INSERT INTO `tbl_application_documents` VALUES (4, 'Acceptance Letter');
INSERT INTO `tbl_application_documents` VALUES (5, 'Completed Acceptance Letter');
INSERT INTO `tbl_application_documents` VALUES (6, 'To Whom It May Concern');

-- ----------------------------
-- Table structure for tbl_application_documents_upload
-- ----------------------------
DROP TABLE IF EXISTS `tbl_application_documents_upload`;
CREATE TABLE `tbl_application_documents_upload`  (
  `application_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`application_id`, `document_id`) USING BTREE,
  INDEX `document_id`(`document_id`) USING BTREE,
  CONSTRAINT `application_id_doc` FOREIGN KEY (`application_id`) REFERENCES `tbl_applications` (`application_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `document_id` FOREIGN KEY (`document_id`) REFERENCES `tbl_application_documents` (`document_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_application_documents_upload
-- ----------------------------
INSERT INTO `tbl_application_documents_upload` VALUES (34, 1, 'eseboy24@gmail.com-bfDke5AI3W.pdf', '2021-07-26 00:29:33', '2021-07-26 00:29:33');
INSERT INTO `tbl_application_documents_upload` VALUES (34, 3, 'Offer_Letter_ATTC-0001-34.pdf', '2021-07-26 00:30:36', '2021-07-26 00:30:36');
INSERT INTO `tbl_application_documents_upload` VALUES (34, 4, 'Acceptance_Letter_ATTC-0001-34.pdf', '2021-07-26 00:30:36', '2021-07-26 00:30:36');
INSERT INTO `tbl_application_documents_upload` VALUES (34, 5, 'Completed_Offer_ATTC-0001-34.pdf', '2021-07-26 00:31:02', '2021-07-26 00:31:02');
INSERT INTO `tbl_application_documents_upload` VALUES (35, 1, 'eseboy24@gmail.com-5RZXcP1CeA.pdf', '2021-07-26 00:35:30', '2021-07-26 00:35:30');
INSERT INTO `tbl_application_documents_upload` VALUES (35, 3, 'Offer_Letter_ATTC-0001-35.pdf', '2021-07-26 00:43:48', '2021-07-26 00:43:48');
INSERT INTO `tbl_application_documents_upload` VALUES (35, 4, 'Acceptance_Letter_ATTC-0001-35.pdf', '2021-07-26 00:43:48', '2021-07-26 00:43:48');
INSERT INTO `tbl_application_documents_upload` VALUES (35, 5, 'Completed_Offer_ATTC-0001-35.pdf', '2021-07-26 00:44:12', '2021-07-26 00:44:12');
INSERT INTO `tbl_application_documents_upload` VALUES (36, 1, 'officialmichelle12@gmail.com-AbyLeEPxO7.JPG', '2021-07-26 06:50:51', '2021-07-26 06:50:51');
INSERT INTO `tbl_application_documents_upload` VALUES (36, 3, 'Offer_Letter_ATTC-0001-36.pdf', '2021-07-26 06:52:21', '2021-07-26 06:52:21');
INSERT INTO `tbl_application_documents_upload` VALUES (36, 4, 'Acceptance_Letter_ATTC-0001-36.pdf', '2021-07-26 06:52:21', '2021-07-26 06:52:21');
INSERT INTO `tbl_application_documents_upload` VALUES (36, 5, 'Completed_Offer_ATTC-0001-36.pdf', '2021-07-26 06:56:05', '2021-07-26 06:56:05');

-- ----------------------------
-- Table structure for tbl_applications
-- ----------------------------
DROP TABLE IF EXISTS `tbl_applications`;
CREATE TABLE `tbl_applications`  (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `programme_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `batch_id` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1 COMMENT '1 - active, 2 - deleted',
  `action_1_status` int(1) NULL DEFAULT 0 COMMENT '0 - Pending, 1 - Approved, 2 - Cancelled',
  `action_1_date` datetime(0) NULL DEFAULT NULL,
  `action_1_user` int(10) UNSIGNED NULL DEFAULT NULL,
  `rejection_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `academic_qualification` int(10) NULL DEFAULT NULL,
  `work_experience` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `application_date` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `payment_status` int(10) NULL DEFAULT 0 COMMENT '0 - Pending, 1- Successful, 2 - Failed, 3 - Bank Trf Onhold',
  `accept_offer` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`application_id`) USING BTREE,
  INDEX `academic_qualification`(`academic_qualification`) USING BTREE,
  INDEX `programme_id_new`(`programme_id`) USING BTREE,
  CONSTRAINT `academic_qualification` FOREIGN KEY (`academic_qualification`) REFERENCES `tbl_qualifications` (`qualification_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `programme_id_new` FOREIGN KEY (`programme_id`) REFERENCES `tbl_programmes` (`programme_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_applications
-- ----------------------------
INSERT INTO `tbl_applications` VALUES (34, 5, 19, 1, 1, 1, '2021-07-26 00:30:34', 1, NULL, NULL, NULL, NULL, '2021-07-26 00:31:17', '2021-07-26 00:29:33', 1, 1);
INSERT INTO `tbl_applications` VALUES (35, 3, 19, 1, 1, 1, '2021-07-26 00:43:46', 1, NULL, NULL, NULL, NULL, '2021-07-26 00:44:21', '2021-07-26 00:35:30', 1, 1);
INSERT INTO `tbl_applications` VALUES (36, 10, 20, 1, 1, 1, '2021-07-26 06:52:19', 15, NULL, NULL, NULL, NULL, '2021-07-26 06:56:36', '2021-07-26 06:50:51', 1, 1);

-- ----------------------------
-- Table structure for tbl_assessment_creation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_creation`;
CREATE TABLE `tbl_assessment_creation`  (
  `assessment_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `batch_id` int(11) NULL DEFAULT NULL,
  `created_by` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `assessment_status` int(1) NULL DEFAULT 1 COMMENT '1 - Open  2- Close  3 - Cancel',
  `assessment_type` int(1) NULL DEFAULT NULL COMMENT '1 - First Assessment 2 - Second Assessment 3 - Second Assessment 4 - Second Assessment',
  `display_result` int(1) UNSIGNED ZEROFILL NULL DEFAULT 0 COMMENT '1 - Display Result 2 - Hide Result',
  `status` int(1) UNSIGNED ZEROFILL NULL DEFAULT 0 COMMENT '1 -> Delete',
  `expiration_date` datetime(0) NULL DEFAULT NULL,
  `expiration_time` time(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL COMMENT 'Date it will be display on student dashboard',
  `start_time` time(0) NULL DEFAULT NULL COMMENT 'Time it will be display on student dashboard',
  PRIMARY KEY (`assessment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assessment_creation
-- ----------------------------
INSERT INTO `tbl_assessment_creation` VALUES (8, '32', 1, '6', 1, 1, 0, 0, '2021-07-28 00:00:00', '18:00:00', '2021-07-26 00:47:48', '2021-07-26 00:00:00', '00:00:00');

-- ----------------------------
-- Table structure for tbl_assessment_session
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_session`;
CREATE TABLE `tbl_assessment_session`  (
  `assessment_id` int(1) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(3) NOT NULL,
  `marks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) UNSIGNED ZEROFILL NOT NULL DEFAULT 0 COMMENT '1 - Passed, 2 - Failed',
  `course_id` int(11) NULL DEFAULT NULL,
  `finished_ca` int(1) UNSIGNED ZEROFILL NULL DEFAULT 0 COMMENT '0 - Ongoing 1 - FInished 2 - cancel',
  `question_json` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `question_id_list` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `batch_id` int(11) NULL DEFAULT NULL,
  `assessement_type` int(1) NULL DEFAULT NULL COMMENT '1 - First Assessment 2 - Second Assessment 3 - Second Assessment 4 - Second Assessment',
  `completed_at` datetime(0) NULL DEFAULT NULL,
  `score` int(10) NULL DEFAULT NULL,
  `total_questions` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`assessment_id`, `user_id`) USING BTREE,
  INDEX `assessment_id`(`assessment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assessment_session
-- ----------------------------
INSERT INTO `tbl_assessment_session` VALUES (6, 14, NULL, '2021-06-23 17:03:13', '14', 1, 1, 1, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, NULL, '2021-06-23 17:04:00', 8, 10);

-- ----------------------------
-- Table structure for tbl_assessment_student_answers
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_student_answers`;
CREATE TABLE `tbl_assessment_student_answers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `user_id` int(1) NULL DEFAULT NULL,
  `total_questions` int(2) NULL DEFAULT NULL,
  `question_json` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `question_id_list` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL COMMENT '1 - Passed, 2 - Failed',
  `question_answer` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `question_user_response` int(1) NULL DEFAULT NULL,
  `question_arr_index` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 164 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assessment_student_answers
-- ----------------------------
INSERT INTO `tbl_assessment_student_answers` VALUES (154, 6, '2021-06-23 17:03:20', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '1', 2, 0);
INSERT INTO `tbl_assessment_student_answers` VALUES (155, 6, '2021-06-23 17:03:23', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '1', 2, 1);
INSERT INTO `tbl_assessment_student_answers` VALUES (156, 6, '2021-06-23 17:03:25', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '4', 1, 2);
INSERT INTO `tbl_assessment_student_answers` VALUES (157, 6, '2021-06-23 17:03:28', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '3', 3, 3);
INSERT INTO `tbl_assessment_student_answers` VALUES (158, 6, '2021-06-23 17:03:31', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '3', 4, 4);
INSERT INTO `tbl_assessment_student_answers` VALUES (159, 6, '2021-06-23 17:03:33', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '2', 1, 5);
INSERT INTO `tbl_assessment_student_answers` VALUES (160, 6, '2021-06-23 17:03:36', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '4', 3, 6);
INSERT INTO `tbl_assessment_student_answers` VALUES (161, 6, '2021-06-23 17:03:55', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 2, '1', 3, 7);
INSERT INTO `tbl_assessment_student_answers` VALUES (162, 6, '2021-06-23 17:03:57', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 2, '4', 3, 8);
INSERT INTO `tbl_assessment_student_answers` VALUES (163, 6, '2021-06-23 17:04:00', 14, 10, '[{\"question_id\":19,\"question\":\"A co-processor\",\"option_1\":\"Is relatively easy to support in software\",\"option_2\":\"Causes all processor to function equally\",\"option_3\":\"Works with any application\",\"option_4\":\"Is quite common in modern computer\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":15,\"question\":\"If there are multiple recycle bin for a hard disk\",\"option_1\":\"You can set different size for each recycle bin\",\"option_2\":\"You can choose which recycle bin to use to store your deleted files\",\"option_3\":\"You can make any one of them default recycle bin\",\"option_4\":\"None of above\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":17,\"question\":\"You should save your computer from?\",\"option_1\":\"Viruses\",\"option_2\":\"Time bombs\",\"option_3\":\"Worms\",\"option_4\":\"All of the above\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":14,\"question\":\"Ajit has a certain average for 9 innings. In the tenth innings, he scores 100 runs thereby increasing his average by 8 runs. His new average is:\",\"option_1\":\"20\",\"option_2\":\"21\",\"option_3\":\"29\",\"option_4\":\"32\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":16,\"question\":\"Identify false statement\",\"option_1\":\"You can find deleted files in recycle bin\",\"option_2\":\"You can restore any files in recycle bin if you ever need\",\"option_3\":\"You can increase free space of disk by sending files in recycle bin\",\"option_4\":\"You can right click and choose Empty Recycle Bin to clean it at once\",\"answer\":\"3\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":18,\"question\":\"World Wide Web is being standard by\",\"option_1\":\"Worldwide corporation\",\"option_2\":\"W3C\",\"option_3\":\"World Wide Consortium\",\"option_4\":\"World Wide Web Standard\",\"answer\":\"2\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":12,\"question\":\"If the displayed system time and date is wrong, you can reset it using\",\"option_1\":\"Write\",\"option_2\":\"Calendar\",\"option_3\":\"Write file\",\"option_4\":\"Control panel\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":20,\"question\":\"A Microsoft Windows is a(n)\",\"option_1\":\"Operating system\",\"option_2\":\"Graphic program\",\"option_3\":\"Word Processing\",\"option_4\":\"Database program\",\"answer\":\"1\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":11,\"question\":\"The speed of the train going from Nagpur to Allahabad is 100 km\\/h while when coming back from Allahabad to Nagpur, its speed is 150 km\\/h. find the average speed during whole journey.\",\"option_1\":\"125 Km\\/hr\",\"option_2\":\"75 km\\/hr\",\"option_3\":\"135 km\\/hr\",\"option_4\":\"120 km\\/hr\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null},{\"question_id\":13,\"question\":\"Find the average of first 97 natural numbers.\",\"option_1\":\"47\",\"option_2\":\"37\",\"option_3\":\"48\",\"option_4\":\"49\",\"answer\":\"4\",\"posted_by\":\"7\",\"created_at\":\"2020-05-17 07:16:50\",\"assessment_type\":1,\"dummy_questions\":0,\"course_id\":1,\"updated_at\":null}]', '\"19\",\"15\",\"17\",\"14\",\"16\",\"18\",\"12\",\"20\",\"11\",\"13\"', 1, '4', 4, 9);

-- ----------------------------
-- Table structure for tbl_assessment_weights
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessment_weights`;
CREATE TABLE `tbl_assessment_weights`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `batch_id` int(10) NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT NULL COMMENT '1 -> 2CA, 1 Exam.  2 -> 3CA. 1 Exam, 3 -> 4CA, 1 Exam',
  `ca_1` int(3) NULL DEFAULT NULL,
  `ca_2` int(3) NULL DEFAULT NULL,
  `ca_3` int(3) NULL DEFAULT NULL,
  `ca_4` int(3) NULL DEFAULT NULL,
  `exam` int(3) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `status` int(1) UNSIGNED ZEROFILL NULL DEFAULT 0 COMMENT '1 -> Delete',
  `exam_duration` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Online Exam Duration in minutes',
  `ca_duration` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Online C.A Duration in minutes',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assessment_weights
-- ----------------------------
INSERT INTO `tbl_assessment_weights` VALUES (1, 1, 1, 10, 10, NULL, NULL, 80, 1, '2020-05-17 14:26:07', 1, '50', '20');

-- ----------------------------
-- Table structure for tbl_assessments_students
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assessments_students`;
CREATE TABLE `tbl_assessments_students`  (
  `assessment_id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`assessment_id`, `user_id`) USING BTREE,
  INDEX `user_id_two`(`user_id`) USING BTREE,
  CONSTRAINT `assessment_id` FOREIGN KEY (`assessment_id`) REFERENCES `tbl_assessment_creation` (`assessment_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_id_two` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assessments_students
-- ----------------------------
INSERT INTO `tbl_assessments_students` VALUES (8, 19, 6, '2021-07-26 00:49:01');

-- ----------------------------
-- Table structure for tbl_batch
-- ----------------------------
DROP TABLE IF EXISTS `tbl_batch`;
CREATE TABLE `tbl_batch`  (
  `batch_no` int(10) NOT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `batch_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`batch_no`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_batch
-- ----------------------------
INSERT INTO `tbl_batch` VALUES (1, 1, '2021-05-26 12:48:23', 1, '2021/2022');

-- ----------------------------
-- Table structure for tbl_branch
-- ----------------------------
DROP TABLE IF EXISTS `tbl_branch`;
CREATE TABLE `tbl_branch`  (
  `branch_code` int(10) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`branch_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_branch
-- ----------------------------
INSERT INTO `tbl_branch` VALUES (1, 'Refinery Office', '2021-02-01 20:44:35', 1);

-- ----------------------------
-- Table structure for tbl_courses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_courses`;
CREATE TABLE `tbl_courses`  (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `short_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `course_duration` int(10) NULL DEFAULT NULL,
  `course_duration_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `course_price` decimal(10, 2) NULL DEFAULT NULL,
  `course_outcome` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `course_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `programme_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1 COMMENT '1- Active, 2 - Deactive ',
  `disp_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `open_registration` int(1) NULL DEFAULT 2 COMMENT '1 - open, 2 - close',
  PRIMARY KEY (`course_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `programme_id`(`programme_id`) USING BTREE,
  CONSTRAINT `created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `programme_id` FOREIGN KEY (`programme_id`) REFERENCES `tbl_programmes` (`programme_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_courses
-- ----------------------------
INSERT INTO `tbl_courses` VALUES (1, 'SMAW (Shielded Metal Arc Welding)', 'ATTC001', 6, 'Week(s)', 174000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<p>‐ set‐up and maintain an arc.</p>\r\n\r\n<p>‐ deposit a weld bead.</p>\r\n\r\n<p>‐ demonstrate knowledge of fillet weld mild steel in all positions using the SMAW process.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p>‐ perform visual inspection of welds.</p>', '<p>1. Define the terminology associated with arc welding.</p>\r\n\r\n<ul>\r\n	<li>mild steel and low alloy steel electrodes</li>\r\n	<li>&nbsp;AC (Alternating Current)</li>\r\n	<li>&nbsp;DC (Direct Current) (polarity)</li>\r\n	<li>&nbsp;Arc Blow</li>\r\n	<li>&nbsp;duty cycle</li>\r\n	<li>&nbsp;rated amperage</li>\r\n</ul>\r\n\r\n<p>2. Describe the SMAW process.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>equipment and accessories</li>\r\n	<li>personal protective equipment</li>\r\n	<li>ground clamps</li>\r\n	<li>terminal lugs</li>\r\n	<li>electrode holders</li>\r\n	<li>cable connectors</li>\r\n	<li>cables</li>\r\n	<li>electrodes</li>\r\n	<li>codes and standards</li>\r\n</ul>\r\n\r\n<p>3. Describe the characteristics and applications of different power sources.</p>\r\n\r\n<ul>\r\n	<li>AC transformers</li>\r\n	<li>AC/DC rectifiers</li>\r\n	<li>DC generators</li>\r\n	<li>engine drive (gasoline, diesel)</li>\r\n	<li>inverters</li>\r\n</ul>\r\n\r\n<p>4. Describe the set‐up and maintenance of welding equipment used in the SMAW</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; process.</p>\r\n\r\n<p>5. Describe the procedures used to strike and maintain an electric arc.</p>\r\n\r\n<p>6. Describe the procedures and techniques used to deposit a weld bead.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;stringer</li>\r\n	<li>&nbsp;weave</li>\r\n	<li>&nbsp;arc length</li>\r\n	<li>&nbsp;travel speed</li>\r\n	<li>&nbsp;work and travel angles</li>\r\n	<li>&nbsp;visual inspection</li>\r\n</ul>\r\n\r\n<p>7. Identify types of joints and their characteristics.</p>\r\n\r\n<ul>\r\n	<li>tee</li>\r\n	<li>lap</li>\r\n	<li>corner</li>\r\n</ul>\r\n\r\n<p>8. Identify types of fillet welds and describe their applications.</p>\r\n\r\n<ul>\r\n	<li>tack</li>\r\n	<li>composite</li>\r\n	<li>single‐pass</li>\r\n	<li>multi‐pass</li>\r\n	<li>plug</li>\r\n	<li>slot</li>\r\n</ul>\r\n\r\n<p>9. Describe the procedures used to fillet weld on mild steel in all positions.</p>\r\n\r\n<ul>\r\n	<li>identify position</li>\r\n	<li>limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>determine fillet size</li>\r\n	<li>select electrode</li>\r\n	<li>&nbsp;select current</li>\r\n</ul>\r\n\r\n<p>10. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>Destructive</li>\r\n	<li>non‐destructive (visual inspection)</li>\r\n</ul>\r\n\r\n<p>11. Describe weld faults and their causes.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the student&rsquo;s ability to meet the objectives of this course.</p>\r\n\r\n<p>Perform welds on tee lap and corner joint, In all positions.</p>', 1, '2021-06-09 11:52:43', '2021-07-23 14:02:09', 1, 'CRASH COURSE FOR BEGINNERS IN SMAW (1F/2F/3F/4F LEVEL)', 1, '1.jpg', 1);
INSERT INTO `tbl_courses` VALUES (13, 'BASIC WELDING COURSE IN SWAM (1G/2G/3G/4G)', 'ATTC005', 3, 'Month(s)', 385000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<p>‐ groove weld on mild steel using the SMAW process with electrodes.</p>\r\n\r\n<p>‐ perform weld tests.</p>\r\n\r\n<p>‐ Describe the process to weld on medium and high‐carbon steel in all positions</p>\r\n\r\n<p>&nbsp; using the SMAW process.</p>', '<p>1. Identify and describe the weld positions.</p>\r\n\r\n<ul>\r\n	<li>1‐G</li>\r\n	<li>2‐G</li>\r\n	<li>3-G</li>\r\n	<li>4-G</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures used to perform groove welds in the</p>\r\n\r\n<p>1G, 2G, 3G, and 4G positions.</p>\r\n\r\n<ul>\r\n	<li>joint design</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>codes and standards</li>\r\n</ul>\r\n\r\n<p>4. Describe all types of weld faults.</p>\r\n\r\n<p>5. Describe the SMAW process as it applies to welding medium and high‐carbon steel.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>characteristics of materials</li>\r\n	<li>weldability of materials</li>\r\n	<li>welding procedures</li>\r\n</ul>\r\n\r\n<p>6. Describe weld faults with medium and high carbon steel.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Weld groove butt joints on 3/8&rdquo; mild steel plate in 1G, 2G, 3G, and 4G positions using F3 and F4 electrodes.</p>\r\n\r\n<p>2. Perform weld tests.</p>', NULL, '2021-07-23 13:58:57', '2021-07-23 14:01:47', 1, 'BASIC WELDING COURSE IN SWAM (1G/2G/3G/4G)', 1, '86013342215869.jpg', 1);
INSERT INTO `tbl_courses` VALUES (14, '6G CERTIFICATE COURSE IN SWAM', 'ATTC008', 2, 'Month(s)', 366000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>describe the process to weld carbon steel and alloy steels using the SMAW process.</li>\r\n</ul>', '<p>1. Identify and describe the weld position.</p>\r\n\r\n<ul>\r\n	<li>5‐G</li>\r\n	<li>6‐G</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures used to weld pipe and tubing in all positions.</p>\r\n\r\n<ul>\r\n	<li>types of pipes and tubing</li>\r\n	<li>root gap</li>\r\n	<li>root face</li>\r\n	<li>tacking</li>\r\n	<li>electrode angle</li>\r\n	<li>angle of cut</li>\r\n	<li>operation of contour marker</li>\r\n	<li>wall thickness</li>\r\n</ul>\r\n\r\n<p>3. Describe tack welding of pipe sections.</p>\r\n\r\n<p>4. Describe the procedures used to prepare test coupons.</p>\r\n\r\n<ul>\r\n	<li>cutting and grinding</li>\r\n</ul>\r\n\r\n<p>5. Describe the procedures used to perform a groove weld in an open root butt joint in 5G,6G and&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; positions.</p>\r\n\r\n<ul>\r\n	<li>joint design</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n	<li>polarity selection</li>\r\n</ul>\r\n\r\n<p>6. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>codes and standards</li>\r\n</ul>\r\n\r\n<p>7. Describe the SMAW process for welding alloy steels.</p>\r\n\r\n<ul>\r\n	<li>identification of materials</li>\r\n	<li>alloying elements</li>\r\n	<li>weldability</li>\r\n	<li>techniques</li>\r\n	<li>problems</li>\r\n	<li>probable causes</li>\r\n	<li>welding procedure</li>\r\n</ul>\r\n\r\n<p>8. Describe the procedures used to test welds.</p>\r\n\r\n<p>9. Describe weld faults and remedies.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<ol>\r\n	<li>Prepare and weld 6&rdquo; SCH 80 pipe in all positions.</li>\r\n</ol>', NULL, '2021-07-23 14:07:15', '2021-07-23 15:41:06', 1, '6G CERTIFICATE COURSE IN SWAM', 1, '691667256115.jpg', 1);
INSERT INTO `tbl_courses` VALUES (15, 'REFRESH COURSE IN SWAM FOR WELDING PRACTICE (3G/4G)', 'ATTC015', 1, 'Day(s)', 20000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Perform weld tests on plates.</li>\r\n	<li>&nbsp;groove weld on mild steel using the SMAW process with electrodes</li>\r\n</ul>', '<p>1. Describe the procedures used to perform on groove weld</p>\r\n\r\n<ul>\r\n	<li>joint design</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n</ul>\r\n\r\n<p>2. Describe all types of weld faults.</p>\r\n\r\n<p>3. Describe the SMAW and GTAW process as it applies to welding medium and high‐carbon steel.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>characteristics of materials</li>\r\n	<li>weldability of materials</li>\r\n	<li>welding procedures</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Weld groove butt joints on 3/8&rdquo; mild steel plate.</p>\r\n\r\n<p>2. Perform weld tests.</p>', NULL, '2021-07-23 14:12:51', '2021-07-23 19:05:53', 1, 'REFRESH COURSE IN SWAM FOR WELDING PRACTICE (3G/4G)', 1, '96069527943349.jpg', 1);
INSERT INTO `tbl_courses` VALUES (16, 'QUALITY ASSURANCE/QUALITY CONTROL (QA/QC)', 'ATTC021', 2, 'Month(s)', 250000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate knowledge of quality control.</li>\r\n	<li>demonstrate knowledge of non‐destructive tests.</li>\r\n</ul>', '<p>1. Explain the purpose and scope of quality control.</p>\r\n\r\n<p>2. Describe the methods used to identify and verify materials.</p>\r\n\r\n<ul>\r\n	<li>standards and specifications</li>\r\n	<li>knowledge about QAP and ITP</li>\r\n</ul>\r\n\r\n<p>3. Describe standards and specifications applicable in the trade.</p>\r\n\r\n<ul>\r\n	<li>templates and/or gauges</li>\r\n	<li>drawing (compliance with)</li>\r\n</ul>\r\n\r\n<p>4. Describe the procedures used to ascertain compliance with design and code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; specifications.</p>\r\n\r\n<p>5. Describe the methods of inspection and testing of structural materials and welds</p>\r\n\r\n<p>and their associated procedures.</p>\r\n\r\n<ul>\r\n	<li>non‐destructive</li>\r\n	<li>visual</li>\r\n	<li>radiography</li>\r\n	<li>magnetic particle</li>\r\n	<li>ultrasonic</li>\r\n	<li>dye penetrant test</li>\r\n	<li>leak test</li>\r\n	<li>pneumatic test (air and soap, inert gas)</li>\r\n	<li>hydrostatic test (water pressure)</li>\r\n	<li>paint thickness</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Perform visual inspection of welds.</p>\r\n\r\n<p>2. Inspect and test structural material and weld.</p>\r\n\r\n<ul>\r\n	<li>inspect items and note irregularities (visual inspection)</li>\r\n	<li>bend specimen and determine ductility and soundness</li>\r\n	<li>perform etch test</li>\r\n	<li>visual inspection radiographic film for irregularities</li>\r\n	<li>use magnetic partial test</li>\r\n	<li>perform dye penetrant test</li>\r\n	<li>perform leak test on small vessels</li>\r\n	<li>air and soap (pneumatic)</li>\r\n	<li>water pressure (hydrostatic)</li>\r\n</ul>\r\n\r\n<p>1.Identify inspection and test methods for paint thickness.</p>\r\n\r\n<p><strong>Quality Assurance/Quality Control</strong></p>\r\n\r\n<p><strong>Description:</strong></p>\r\n\r\n<p>This course is designed to give students an understanding of the concepts and</p>\r\n\r\n<p>requirements of QA/QC such as, interpreting standards, controlling the acceptance of</p>\r\n\r\n<p>raw materials, controlling quality variables and documenting the process. It includes</p>\r\n\r\n<p>information on quality concepts, codes and standards, documentation,</p>\r\n\r\n<p>communications, human resources, company structure and policy, teamwork, quality management system and responsibilities.</p>\r\n\r\n<p><strong>Objectives &amp; Content:</strong></p>\r\n\r\n<p>1. Describe the reasons for quality assurance and quality plans.</p>\r\n\r\n<p>2. Explain the relationship between quality assurance and quality control.</p>\r\n\r\n<p>3. Describe quality control procedures as applied to the production and checking of</p>\r\n\r\n<p>specifications and processes in applicable occupations.</p>\r\n\r\n<p>4. Describe quality control procedures as applied to the acceptance and checking of</p>\r\n\r\n<p>raw materials.</p>\r\n\r\n<p>5. Explain the role of communications in a quality environment.</p>\r\n\r\n<p>6. Explain why it is important for all employees to understand the structure of the</p>\r\n\r\n<p>company and its production processes. Explain how human resource effectiveness is</p>\r\n\r\n<p>maximized in a quality managed organization.</p>\r\n\r\n<p>7. Explain the role of company policy in quality management.</p>\r\n\r\n<p>8. Explain the purpose of codes and standards in various occupations.</p>\r\n\r\n<p>9. Explain the concepts of quality.</p>\r\n\r\n<ul>\r\n	<li>cost of quality</li>\r\n	<li>measurement of quality</li>\r\n	<li>elements of quality</li>\r\n	<li>elements of the quality audit</li>\r\n	<li>quality standards</li>\r\n	<li>role expectations and responsibilities</li>\r\n</ul>\r\n\r\n<p>10. Explain the structure of quality assurance and quality control.</p>\r\n\r\n<ul>\r\n	<li>describe organizational charts</li>\r\n	<li>identify the elements of quality assurance system such as ISO.</li>\r\n	<li>WHMIS, Sanitation Safety Code (SSC)</li>\r\n	<li>explain the purpose of the quality assurance manual</li>\r\n	<li>describe quality assurance procedures</li>\r\n</ul>\r\n\r\n<p>11. Examine quality assurance/quality control documentation.</p>\r\n\r\n<ul>\r\n	<li>describe methods of recording reports in industry</li>\r\n	<li>describe procedures of traceability (manual and computer‐based</li>\r\n	<li>recording)</li>\r\n	<li>identify needs for quality control procedures</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>1. Apply quality control to a project.</p>\r\n\r\n<ul>\r\n	<li>follow QA/QC procedures for drawings, plans and specifications in</li>\r\n	<li>applicable occupations</li>\r\n	<li>calibrate measuring instruments and devices in applicable occupations</li>\r\n	<li>interpret required standards</li>\r\n	<li>follow QA/QC procedures for accepting raw materials</li>\r\n	<li>carry out the project</li>\r\n	<li>control the quality elements (variables)</li>\r\n	<li>complete QA/QC reports</li>\r\n</ul>', NULL, '2021-07-23 14:20:36', '2021-07-24 16:21:03', 34, 'QUALITY ASSURANCE/QUALITY CONTROL (QA/QC)', 1, '16.png', 1);
INSERT INTO `tbl_courses` VALUES (17, 'MATERIAL HANDLING AND RIGGING', 'ATTC022', 1, 'Month(s)', 75000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate knowledge of rigging,hoisting ,lifting equipment,scaffolding accessories and practices.</li>\r\n</ul>', '<p>1. Identify Provincial regulations applicable to material handling, rigging and scaffolding.</p>\r\n\r\n<p>2. Describe the procedures for manual lifting.</p>\r\n\r\n<p>3. Describe responsibilities and liabilities in the use of equipment for rigging, lifting and hoisting.</p>\r\n\r\n<p>4. Describe the variables to consider when hoisting.</p>\r\n\r\n<ul>\r\n	<li>weight of objects</li>\r\n	<li>object of configuration</li>\r\n	<li>materials</li>\r\n	<li>materials for blocking</li>\r\n</ul>\r\n\r\n<p>5. Describe the methods of hoisting, their applications and procedures for use.</p>\r\n\r\n<p>6. Describe the various types of wire ropes, chains, cables, cable clamps and their</p>\r\n\r\n<p>accessories.</p>\r\n\r\n<ul>\r\n	<li>characteristics</li>\r\n	<li>applications</li>\r\n	<li>precaution</li>\r\n	<li>procedures for use</li>\r\n	<li>inspection</li>\r\n</ul>\r\n\r\n<p>7. Identify and describe the various types of lifting clamps.</p>\r\n\r\n<ul>\r\n	<li>characteristics</li>\r\n	<li>applications</li>\r\n	<li>precautions</li>\r\n	<li>inspection</li>\r\n	<li>procedures for use</li>\r\n</ul>\r\n\r\n<p>8. Identify types of come along, rope and chain falls, and describe their applications</p>\r\n\r\n<p>and procedures for use.</p>\r\n\r\n<p>9. Identify types of jacks and describe their applications and procedures for use.</p>\r\n\r\n<ul>\r\n	<li>hydraulic</li>\r\n	<li>screw</li>\r\n	<li>ratchet</li>\r\n</ul>\r\n\r\n<p>10. Describe stacking and blocking.</p>\r\n\r\n<ul>\r\n	<li>structural shapes</li>\r\n	<li>plate and sheet</li>\r\n	<li>weldments and components</li>\r\n</ul>\r\n\r\n<p>11. Describe the methods of securing chains to provide for manipulation of structural shapes</p>\r\n\r\n<p>12. Identify types of slings and describe their applications and procedures for use.</p>\r\n\r\n<ul>\r\n	<li>wire rope slings</li>\r\n	<li>nylon slings</li>\r\n</ul>\r\n\r\n<p>13. Describe use of hooks and shackles.</p>\r\n\r\n<p>14. Describe rope and its use.</p>\r\n\r\n<ul>\r\n	<li>sizes</li>\r\n	<li>care and inspection</li>\r\n	<li>bowline</li>\r\n	<li>square or reef</li>\r\n	<li>round turn and two half hitches</li>\r\n	<li>scaffold hitch</li>\r\n	<li>whipped ends and eyes</li>\r\n</ul>\r\n\r\n<p>15. Describe use of chokers, slings and tag lines.</p>\r\n\r\n<p>16. Describe spooling of line on drums.</p>\r\n\r\n<ul>\r\n	<li>over wind</li>\r\n	<li>under wind</li>\r\n	<li>left and right hand lay lines</li>\r\n</ul>\r\n\r\n<p>17. Describe practices for use of tackle.</p>\r\n\r\n<ul>\r\n	<li>safety factors</li>\r\n	<li>reeving practices</li>\r\n</ul>\r\n\r\n<p>18. Identify mechanical types of hoisting methods and describe their applications.</p>\r\n\r\n<ul>\r\n	<li>overhead crane</li>\r\n	<li>jib crane</li>\r\n	<li>boom crane</li>\r\n	<li>mobile crane</li>\r\n	<li>fork lifts</li>\r\n</ul>\r\n\r\n<p>19. Describe standard hand signals.</p>\r\n\r\n<p>20. Identify the different types of scaffolds, and describe their applications and</p>\r\n\r\n<p>procedures for use.</p>\r\n\r\n<ul>\r\n	<li>tube and clamp</li>\r\n	<li>manufactured platforms and scaffolding</li>\r\n	<li>rolling scaffolding</li>\r\n	<li>suspended scaffolding</li>\r\n</ul>\r\n\r\n<p>21. Describe safety requirements for erecting and working on scaffolding.</p>\r\n\r\n<ul>\r\n	<li>kick plates</li>\r\n	<li>braces</li>\r\n	<li>ties</li>\r\n	<li>planking</li>\r\n	<li>permits</li>\r\n	<li>tagging</li>\r\n	<li>fall arrest</li>\r\n	<li>railings</li>\r\n</ul>\r\n\r\n<p>22. Describe special problems of rolling and suspended scaffolding and guidelines for</p>\r\n\r\n<p>their use.</p>\r\n\r\n<p>23. Identify types of ladders and describe their applications and use.</p>\r\n\r\n<p>24. Identify powerline hazards when using lifting equipment.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Make up spreader bar.</p>\r\n\r\n<p>2. Tie knots using fibre rope.</p>\r\n\r\n<ul>\r\n	<li>reef knot</li>\r\n	<li>bowline knot</li>\r\n	<li>round turn and hitch</li>\r\n	<li>scaffold hitch</li>\r\n	<li>demonstrate hand signals</li>\r\n</ul>', NULL, '2021-07-23 14:49:29', '2021-07-24 16:33:08', 33, 'MATERIAL HANDLING AND RIGGING', 1, '17.jpg', 1);
INSERT INTO `tbl_courses` VALUES (18, 'ULTRASONIC TEST LEVEL 2', 'ATTC023', 2, 'Week(s)', 80000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession</strong></li>\r\n</ul>', '<p>Ultrasonic testing (UT) is used in the testing of nearly all solid materials, such as fine-grained aluminium, steels and alloys, composites and plastics -practically any solid material where detection of internal discontinuities or thickness measurements are of most common concern.</p>\r\n\r\n<p>It is also used in the detection of interlaminar separations and regions that have been improperly processed or damaged in layered composite structures.</p>\r\n\r\n<p>It is used in the detection and sizing of internal reflectors of ultrasonic pulses and thus is found in the testing of welds, forgings and raw materials in the form of plate, rod, pipe and similar simple geometrical shapes.</p>\r\n\r\n<p>&nbsp;</p>', NULL, '2021-07-23 15:06:15', '2021-07-24 16:05:50', 32, 'ULTRASONIC TEST LEVEL 2', 1, '18.jpg', 1);
INSERT INTO `tbl_courses` VALUES (19, 'MAGNETIC PARTICLE TEST LEVEL 2', 'ATTC024', 1, 'Week(s)', 60000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession.</strong></li>\r\n</ul>', '<p>Magnetic particle testing (MT) is used to detect discontinuities in ferromagnetic parts - namely parts made of iron, steel, nickel, cobalt and the alloys of these materials. Ferromagnetic materials develop strong internal magnetic fields when an electric current is passed through the part. Magnetic particles are applied to the part and a discontinuity that causes a disruption in the induced magnetic field attracts the applied particles, producing an indication.</p>\r\n\r\n<p>MT is a highly effective inspection tool that is sensitive to the presence of cracks, laps, seams and similar types of surface and near-surface discontinuities</p>', NULL, '2021-07-23 15:08:31', '2021-07-24 16:05:22', 32, 'MAGNETIC PARTICLE TEST LEVEL 2', 1, '19.jpg', 1);
INSERT INTO `tbl_courses` VALUES (20, 'LIQUID PENETRENT TEST LEVEL 2', 'ATTC025', 1, 'Week(s)', 60000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession.</strong></li>\r\n</ul>', '<p>Liquid penetrant testing (PT) is only used for detecting discontinuities open to the surface. With the correct application, it will detect discontinuities ranging in size from the large to the microscopic. The specially prepared liquids, characterized by low a viscosity, easily enter voids open to the surface when the part is dipped into or sprayed by the penetrant. Relatively simple, inexpensive and reliable.</p>', NULL, '2021-07-23 15:10:20', '2021-07-24 16:04:53', 32, 'LIQUID PENETRENT TEST LEVEL 2', 1, '20.jpg', 1);
INSERT INTO `tbl_courses` VALUES (21, 'RADIOGRAPHIC TEST LEVEL 2', 'ATTC026', 2, 'Week(s)', 100000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession.</strong></li>\r\n</ul>', '<p>Inspection techniques using radiographic testing (RT) are some of the most common</p>\r\n\r\n<p>approaches to visualizing the internal structures of components, materials and assemblies. The approach requires a source of electromagnetic radiation that can penetrate the item being examined during exposure (the time the item is illuminated by the radiation).</p>\r\n\r\n<p>Applications, for RT are found throughout manufacturing and field-service environments. Raw materials are examined for the presence of internal discontinuities (castings, forgings); fabrications and assemblies are examined for induced discontinuities (welds) and misalignments or absence of internal parts; and in-service inspections use RT for detecting and assessing time-dependent degradation, such as corrosion, cracking and environmental damage.</p>', NULL, '2021-07-23 15:12:14', '2021-07-24 16:04:25', 32, 'RADIOGRAPHIC TEST LEVEL 2', 1, '21.jpg', 1);
INSERT INTO `tbl_courses` VALUES (22, 'VISUAL INSPECTION TEST', 'ATTC027', 1, 'Week(s)', 60000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession.</strong></li>\r\n</ul>', '<p>Visual testing is the most commonly used test method in industry. Because most test methods require that the operator look at the surface of the part being inspected, visual inspection is inherent in most of the other test methods. As the name implies, VT involves the visual observation of the surface of a test object to evaluate the presence of surface discontinuities. VT inspections may be by Direct Viewing, using line-of sight vision, or may be enhanced with the use of optical instalments such as magnifying glasses, mirrors, horoscopes, and computer-assisted viewing systems (Remote Viewing). Corrosion, misalignment of parts, physical damage and cracks are just some of the discontinuities that maybe detected by visual examinations.</p>', NULL, '2021-07-23 15:14:35', '2021-07-24 16:03:47', 32, 'VISUAL INSPECTIO TEST', 1, '22.jpg', 1);
INSERT INTO `tbl_courses` VALUES (23, 'RADIOGRAPHIC TEST FILM INTERPRETATION', 'ATTC028', 1, 'Week(s)', 60000.00, '<p><strong>To gain experience with and understanding of the types, advantages and applications of various NDT menthods&nbsp;</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Foundation: to provide students with a strong knowledge of terms, concepts,principles etc ....involves in NON-DESTRUCTIVE TESTING</strong></li>\r\n	<li><strong>Skills: to provide practical training in handling and testing the NON-DESTRUCTIVE TESTING equipment&#39;s</strong></li>\r\n	<li><strong>Data analysis: to develop knowledge and stills for interpretation and evaluation of the result.</strong></li>\r\n	<li><strong>Awareness and professions ethics:To offer environment to enhance team essential skills for affective careers in insection profession.</strong></li>\r\n</ul>', '<p><em>unavailable</em></p>', NULL, '2021-07-23 15:21:36', '2021-07-24 16:03:14', 32, 'RADIOGRAPHIC TEST FILM INTERPRETATION', 1, '23.jpg', 1);
INSERT INTO `tbl_courses` VALUES (24, 'PIPE ENGINEERING COURSE', 'ATTC029', 2, 'Month(s)', 250000.00, '<p><em>unavailable</em></p>', '<p><em>unavailale</em></p>', NULL, '2021-07-23 19:34:00', '2021-07-24 15:54:00', 31, 'PIPE ENGINEERING COURSE', 1, '24.jpg', 1);
INSERT INTO `tbl_courses` VALUES (25, 'PIPE FITTER COURSE', 'ATTC030', 6, 'Week(s)', 150000.00, '<p><em>unavailable</em></p>', '<p><em>unavailale</em></p>', NULL, '2021-07-23 19:36:33', '2021-07-24 15:53:32', 31, 'PIPE FITTER COURSE', 1, '25.jpg', 1);
INSERT INTO `tbl_courses` VALUES (26, 'SCAFFOLD LEVEL 1', 'ATTC031', 1, 'Week(s)', 25000.00, '<p><em>unavailable</em></p>', '<p><em>unavailable</em></p>', NULL, '2021-07-23 20:00:59', '2021-07-24 15:38:57', 12, 'SCAFFOLD LEVEL 1', 1, '26.jpg', 1);
INSERT INTO `tbl_courses` VALUES (27, 'SCAFFOLD LEVEL 2', 'ATTC032', 1, 'Week(s)', 35000.00, '<p><em>unavailable</em></p>', '<p><em>unavailable</em></p>', NULL, '2021-07-23 20:02:41', '2021-07-24 15:38:03', 12, 'SCAFFOLD LEVEL 2', 1, '27.jpg', 1);
INSERT INTO `tbl_courses` VALUES (28, 'SCAFFOLD LEVEL 3', 'ATTC033', 1, 'Week(s)', 50000.00, '<p><em>unavailable</em></p>', '<p><em>unavailable</em></p>', NULL, '2021-07-23 20:06:30', '2021-07-24 14:23:05', 12, 'SCAFFOLD LEVEL 3', 1, '28.jpg', 1);
INSERT INTO `tbl_courses` VALUES (29, 'SCAFFOLD SUPERVISOR TRAINING', 'ATTC034', 3, 'Day(s)', 80000.00, '<p>unavailable</p>', '<p>unavailable</p>', NULL, '2021-07-23 20:08:13', '2021-07-24 14:22:19', 12, 'SCAFFOLD SUPERVISOR TRAINING', 1, '29.jpg', 1);
INSERT INTO `tbl_courses` VALUES (30, 'BASIC SCAFFOLD INSPECTION TRAINING', 'ATTC035', 3, 'Day(s)', 100000.00, '<p><em>unavailable</em></p>', '<p><em>unavailable</em></p>', NULL, '2021-07-23 20:10:35', '2021-07-24 14:20:26', 12, 'BASIC SCAFFOLD INSPECTION TRAINING', 1, '30.jpg', 1);
INSERT INTO `tbl_courses` VALUES (31, 'CRASH COURSE FOR BEGINNERS IN GMAW(1F/2F/3F/4F LEVEL)', 'ATTC002', 6, 'Week(s)', 178000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate knowledge of the procedures to set‐up GMAW equipment, strike and maintain an arc.</li>\r\n	<li>disassemble and reassemble GMAW welding systems.</li>\r\n	<li>&nbsp;perform visual inspection of weld.</li>\r\n</ul>', '<p>1. Define terminology associated with the GMAW process.</p>\r\n\r\n<p>2. Describe the GMAW process.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>equipment and accessories</li>\r\n	<li>shielding gas and regulators</li>\r\n	<li>electrode wire</li>\r\n	<li>gun</li>\r\n	<li>feeder</li>\r\n	<li>power source</li>\r\n	<li>nozzle</li>\r\n	<li>cable connections</li>\r\n	<li>cables</li>\r\n	<li>pulsed arc machines</li>\r\n	<li>metal transfers</li>\r\n	<li>polarity</li>\r\n	<li>arc voltage</li>\r\n	<li>slope and adjustment</li>\r\n	<li>inductance</li>\r\n	<li>travel speed</li>\r\n	<li>wire feed speed</li>\r\n	<li>penetration</li>\r\n	<li>travel and work angles</li>\r\n	<li>manipulation</li>\r\n	<li>guide tubes</li>\r\n	<li>contact tips</li>\r\n	<li>liners</li>\r\n	<li>gas</li>\r\n</ul>\r\n\r\n<p>3. Describe the assembly and disassembly of welding equipment used in the GMAW process.</p>\r\n\r\n<p>4. Describe troubleshooting and maintenance procedures for GMAW equipment.</p>\r\n\r\n<p>5. Describe the procedures used to establish and maintain an arc.</p>\r\n\r\n<ul>\r\n	<li>starting and stopping the weld</li>\r\n	<li>finishing end of the joint</li>\r\n	<li>filler metal</li>\r\n	<li>adjustment</li>\r\n	<li>shielding gases (pre and post weld)</li>\r\n	<li>drive rolls</li>\r\n	<li>gun</li>\r\n	<li>stick‐out</li>\r\n	<li>speed</li>\r\n</ul>\r\n\r\n<p>6. Describe the procedures and techniques used to deposit a weld bead.</p>\r\n\r\n<ul>\r\n	<li>stringer</li>\r\n	<li>weave</li>\r\n	<li>stick‐out</li>\r\n	<li>travel speed</li>\r\n	<li>work and travel angles</li>\r\n	<li>visual inspection</li>\r\n</ul>\r\n\r\n<p>7. Describe the various gases and gas mixtures and describe their applications.</p>\r\n\r\n<p>8. Describe weld faults and their causes.</p>\r\n\r\n<p>9. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>destructive</li>\r\n	<li>non‐destructive (visual inspection)</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Setup GMAW equipment.</p>\r\n\r\n<p>2. Change electrode wire guide.</p>\r\n\r\n<p>3. Adjust and check flow meter.</p>\r\n\r\n<p>4. Deposit fillet welds on mild steel, various thickness.</p>', NULL, '2021-07-23 21:27:59', '2021-07-23 21:49:16', 2, 'CRASH COURSE FOR BEGINNERS IN GMAW(1F/2F/3F/4F LEVEL)', 1, '75570618796292.jpg', 1);
INSERT INTO `tbl_courses` VALUES (32, 'CRASH COURSE FOR BEGINNERS IN FCAW (1F/2F/3F/4F LEVEL)', 'ATTC003', 6, 'Week(s)', 198000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>set‐up and adjust FCAW equipment.</li>\r\n	<li>set‐Up and Deposit a fillet Weld.</li>\r\n</ul>', '<p>1. Define terminology associated with the FCAW process.</p>\r\n\r\n<p>2. Describe the FCAW process.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>equipment and accessories</li>\r\n	<li>shielding gas, regulator and heater.</li>\r\n	<li>type of wire</li>\r\n	<li>flux cored</li>\r\n	<li>metal cored</li>\r\n	<li>gun</li>\r\n	<li>feeder</li>\r\n	<li>power source</li>\r\n	<li>nozzle and contact tip</li>\r\n	<li>cable connections</li>\r\n	<li>cables</li>\r\n	<li>metal transfers mode</li>\r\n	<li>polarity</li>\r\n	<li>arc voltage</li>\r\n	<li>slope and adjustment</li>\r\n	<li>inductance</li>\r\n	<li>travel speed</li>\r\n	<li>wire feed speed</li>\r\n	<li>penetration</li>\r\n	<li>travel and work angles</li>\r\n	<li>manipulation</li>\r\n	<li>guide tubes</li>\r\n	<li>contact tip</li>\r\n	<li>liners</li>\r\n</ul>\r\n\r\n<p>3. Describe the assembly and disassembly of welding equipment used in the FCAW process.</p>\r\n\r\n<p>4. Describe troubleshooting and maintenance procedures for FCAW equipment.</p>\r\n\r\n<p>5. Describe the procedures used to deposit a satisfactory weld.</p>\r\n\r\n<ul>\r\n	<li>starting and stopping the weld</li>\r\n	<li>filler metal</li>\r\n	<li>adjustment</li>\r\n	<li>shielded gases (pre and post weld)</li>\r\n	<li>drive rolls</li>\r\n	<li>gun</li>\r\n	<li>stick‐out</li>\r\n	<li>speed</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Set‐up FCAW equipment and adjust flow meter, if necessary.</p>\r\n\r\n<p>2.Identify electrode wire and equipment components</p>\r\n\r\n<p>3.fillet weld in all positions.</p>', NULL, '2021-07-23 21:31:53', '2021-07-23 21:58:04', 3, 'CRASH COURSE FOR BEGINNERS IN FCAW (1F/2F/3F/4F LEVEL)', 1, '54342149252469.jpg', 1);
INSERT INTO `tbl_courses` VALUES (33, 'CRASH COURSE FOR BEGINNERS IN GTAW (1F/2F/3F/4F LEVEL)', 'ATTC004', 6, 'Week(s)', 255000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate, set‐up equipment, strike and maintain an arc.</li>\r\n	<li>&nbsp;perform visual inspection of welds.</li>\r\n</ul>', '<p>1. Define terminology associated with the GTAW process.</p>\r\n\r\n<p>2. Describe the GTAW process.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>equipment and accessories</li>\r\n	<li>power sources</li>\r\n	<li>torches</li>\r\n	<li>flowmeters</li>\r\n	<li>electrodes</li>\r\n	<li>current requirement</li>\r\n	<li>shielding gases</li>\r\n	<li>travel and work angles</li>\r\n	<li>filler rods</li>\r\n	<li>joint types and their preparation</li>\r\n	<li>edge preparations</li>\r\n	<li>weld types</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures to assemble and disassemble GTAW welding equipment.</p>\r\n\r\n<p>4. Describe the procedures used to establish and maintain an arc.</p>\r\n\r\n<ul>\r\n	<li>conventional and pulse arc welding</li>\r\n</ul>\r\n\r\n<p>5.Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>destructive</li>\r\n	<li>non‐destructive (visual inspection)</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Setup GTAW equipment, strike and maintain arc.</p>\r\n\r\n<p>2. Change electrode, collet and collet body.</p>\r\n\r\n<p>3. Adjust and check flow meter.</p>\r\n\r\n<p>4. Run beads on cold rolled steel plate.</p>\r\n\r\n<p>5. Shut down equipment.</p>', NULL, '2021-07-23 21:41:14', '2021-07-23 21:53:11', 4, 'CRASH COURSE FOR BEGINNERS IN GTAW (1F/2F/3F/4F LEVEL)', 1, '77745568191274.jpg', 1);
INSERT INTO `tbl_courses` VALUES (34, '6G CERTIFICATE COURSE IN GTAW', 'ATTC007', 3, 'Month(s)', 420000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>Groove weld on mild steel plate in all positions using the GTAW process.</li>\r\n</ul>', '<p>1.Describe the purpose, applications and advantages of GTAW.</p>\r\n\r\n<p>2.Describe the set‐up and preparation used to weld medium and high‐carbon steels.</p>\r\n\r\n<ul>\r\n	<li>characteristics of material</li>\r\n	<li>weldability</li>\r\n</ul>\r\n\r\n<p>3. Describe the process used to groove weld in all positions.</p>\r\n\r\n<ul>\r\n	<li>preparation</li>\r\n	<li>current requirements</li>\r\n	<li>electrode selection</li>\r\n	<li>type</li>\r\n	<li>size and preparation</li>\r\n	<li>cup sizes</li>\r\n	<li>gas lens (diffusers)</li>\r\n	<li>shielding gas</li>\r\n	<li>filler metal</li>\r\n	<li>manipulation</li>\r\n	<li>filler metal</li>\r\n	<li>torch</li>\r\n</ul>\r\n\r\n<p>4. Describe the procedures used to test welds.</p>\r\n\r\n<p>5. Describe weld faults.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<ol>\r\n	<li>Perform groove welds on mild steel in all positions using the GTAW process.</li>\r\n	<li>Theory only.</li>\r\n</ol>', NULL, '2021-07-23 21:43:43', '2021-07-23 21:56:20', 4, '6G CERTIFICATE COURSE IN GTAW', 1, '13325753511514.jpg', 1);
INSERT INTO `tbl_courses` VALUES (35, '6G CERTIFICATION COURSE IN GTAW+SMAW', 'ATTC009', 5, 'Month(s)', 585000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>weld pipe in all positions using the GTAW process.</li>\r\n	<li>demonstrate knowledge of orbital welding equipment.</li>\r\n</ul>', '<p>1.Identify and describe the weld position.</p>\r\n\r\n<ul>\r\n	<li>5‐G</li>\r\n	<li>6‐G</li>\r\n</ul>\r\n\r\n<p>2.Describe the process of welding pipe and tubing in all positions.</p>\r\n\r\n<ul>\r\n	<li>joint preparation</li>\r\n	<li>root face and gap</li>\r\n	<li>backing rings</li>\r\n	<li>consumable insert</li>\r\n	<li>purging</li>\r\n	<li>dams</li>\r\n	<li>gases</li>\r\n	<li>shielding</li>\r\n	<li>purging (special applications)</li>\r\n	<li>welding and fabricated fittings</li>\r\n	<li>tack weld</li>\r\n	<li>work and travel angles</li>\r\n	<li>torch manipulation</li>\r\n	<li>welding variables</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures used to weld pipes and tubing in all positions.</p>\r\n\r\n<p>4. Identify types of rotating positioners and describe their applications and</p>\r\n\r\n<p>procedures for use in welding.</p>\r\n\r\n<p>5. Identify orbital welding equipment and describe its components and applications.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Weld pipe and tubing in all positions using the GTAW process.</p>', NULL, '2021-07-23 22:08:17', '2021-07-23 22:08:17', 5, '6G CERTIFICATION COURSE IN GTAW+SMAW', 1, '39407239410133.jpg', 1);
INSERT INTO `tbl_courses` VALUES (36, 'REFRESH COURSE IN GTAW+SMAW 6G PRACTICE ON PIPE (6G)', 'ATTC016', 1, 'Day(s)', 35000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>Perform weld tests on pipe.</li>\r\n	<li>groove weld on mild steel using the SMAW+GTAW process with electrodes and filler wire</li>\r\n</ul>', '<p>. Describe the procedures used to perform on groove weld</p>\r\n\r\n<ul>\r\n	<li>joint design &amp; preparation</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n</ul>\r\n\r\n<p>2. Describe all types of weld faults.</p>\r\n\r\n<p>3. Describe the SMAW and GTAW process as it applies to welding medium and high‐carbon steel.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>characteristics of materials</li>\r\n	<li>weldability of materials</li>\r\n	<li>welding procedures</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Weld groove butt joints on 3/8&rdquo; mild steel pipes</p>\r\n\r\n<p>2. Perform weld tests.</p>', NULL, '2021-07-24 11:12:46', '2021-07-24 11:12:46', 5, 'REFRESH COURSE IN GTAW+SMAW 6G PRACTICE ON PIPE (6G)', 1, '38170675913578.jpg', 1);
INSERT INTO `tbl_courses` VALUES (37, 'REFRESH COURSE IN GTAW+SMAW PRACTICING ON PIPE', 'ATTC014', 1, 'Week(s)', 117000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>describe the process to weld carbon steel and alloy steels pipe using the SMAW process.</li>\r\n</ul>', '<p>. Identify and describe the weld position.</p>\r\n\r\n<ul>\r\n	<li>5‐G</li>\r\n	<li>6‐G</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures used to weld pipe and tubing in all positions.</p>\r\n\r\n<ul>\r\n	<li>types of pipes and tubing</li>\r\n	<li>root gap</li>\r\n	<li>root face</li>\r\n	<li>tacking</li>\r\n	<li>electrode angle</li>\r\n	<li>angle of cut</li>\r\n	<li>operation of contour marker</li>\r\n	<li>wall thickness</li>\r\n	<li>joint design</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n	<li>polarity selection</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>codes and standards</li>\r\n</ul>\r\n\r\n<p>4. Describe the SMAW process for welding alloy steels.</p>\r\n\r\n<ul>\r\n	<li>identification of materials</li>\r\n	<li>alloying elements</li>\r\n	<li>weldability</li>\r\n	<li>techniques</li>\r\n	<li>problems</li>\r\n	<li>probable causes</li>\r\n	<li>welding procedure</li>\r\n</ul>\r\n\r\n<p>5. Describe the procedures used to test welds.</p>\r\n\r\n<p>6. Describe weld faults and remedies.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Prepare and weld 6&rdquo; SCH 80 pipe in all positions.</p>', NULL, '2021-07-24 11:17:00', '2021-07-24 11:17:00', 5, 'REFRESH COURSE IN GTAW+SMAW PRACTICING ON PIPE', 1, '80023337511459.jpg', 1);
INSERT INTO `tbl_courses` VALUES (38, 'BASIC WELDING COURSE IN GMAW/FCAW(1G/2G/3G/4G)', 'ATTC006', 3, 'Month(s)', 298000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;describe the process to fillet and groove weld in all positions using the GMAW process.</li>\r\n	<li>deposit a weld in 1G, 2G,3G, and 4G positions using flux cored wire.</li>\r\n	<li>&nbsp;identify various gases and gas mixer gas.</li>\r\n</ul>', '<p>1. Describe the procedures and techniques used to deposit a weld bead.</p>\r\n\r\n<ul>\r\n	<li>stringer</li>\r\n	<li>weave</li>\r\n	<li>stick‐out</li>\r\n	<li>travel speed</li>\r\n	<li>work and travel angles</li>\r\n	<li>visual inspection</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures used to weld plate in 1G, 2G,3G and 4G positions using</p>\r\n\r\n<ul>\r\n	<li>flux cored wire.</li>\r\n	<li>quality of welds</li>\r\n	<li>faults</li>\r\n	<li>travel angles</li>\r\n	<li>manipulation</li>\r\n</ul>\r\n\r\n<p>3. Describe the various gases and gas mixtures and describe their applications.</p>\r\n\r\n<p>4.Describe the purpose, applications and advantages of GMAW.</p>\r\n\r\n<p>5. Describe the GMAW process used to groove weld in all positions.</p>\r\n\r\n<ul>\r\n	<li>conventional and pulse</li>\r\n	<li>identification of position</li>\r\n	<li>modes of transfer</li>\r\n	<li>short circuiting</li>\r\n	<li>globular</li>\r\n	<li>spray</li>\r\n	<li>pulse spray</li>\r\n	<li>shielding gas selection</li>\r\n	<li>filler metals</li>\r\n	<li>troubleshooting</li>\r\n	<li>work and travel angles</li>\r\n	<li>gun manipulation</li>\r\n</ul>\r\n\r\n<p>6. Describe medium and high‐carbon steels and their use in the GMAW process.</p>\r\n\r\n<ul>\r\n	<li>weldability</li>\r\n	<li>characteristics</li>\r\n</ul>\r\n\r\n<p>7. Describe the GMAW process used to weld medium and high‐carbon steels in all positions.</p>\r\n\r\n<p>8. Describe the procedures used to test welds.</p>\r\n\r\n<p>9. Describe weld faults.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The learning objectives outlined below are mandatory.</p>\r\n\r\n<ol>\r\n	<li>Perform groove welds on mild steel plate using the GMAW process.</li>\r\n	<li>Theory</li>\r\n</ol>', NULL, '2021-07-24 11:21:00', '2021-07-24 11:21:00', 6, 'BASIC WELDING COURSE IN GMAW/FCAW(1G/2G/3G/4G)', 1, '79033717287308.jpg', 1);
INSERT INTO `tbl_courses` VALUES (39, '6G CERTIFICATION COURSE IN GMAW/FCAW', 'ATTC011', 3, 'Month(s)', 385000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>weld pipe and tubing in all positions using the GMAW process.</li>\r\n</ul>', '<p>1. Describe the GMAW (MIG, MAG, FCAW) process for welding ferrous pipe and tubing in all positions.</p>\r\n\r\n<ul>\r\n	<li>joint preparation</li>\r\n	<li>root face and gap</li>\r\n	<li>backing rings</li>\r\n	<li>welding pre‐fabricated fittings</li>\r\n	<li>tack welds</li>\r\n	<li>common defects</li>\r\n	<li>work and travel angles</li>\r\n	<li>gun manipulation</li>\r\n	<li>welding variables</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures to weld pipes mounted on a rotating positioner.</p>\r\n\r\n<ul>\r\n	<li>rotating positioners</li>\r\n	<li>types</li>\r\n	<li>speed</li>\r\n	<li>uses</li>\r\n</ul>\r\n\r\n<p>3. Describe the GMAW process used to weld pipe in all positions.</p>\r\n\r\n<ul>\r\n	<li>determine material characteristics</li>\r\n	<li>identification numbers</li>\r\n	<li>alloys</li>\r\n	<li>weldability</li>\r\n	<li>select filler wire</li>\r\n	<li>identify parameters</li>\r\n	<li>identify variables</li>\r\n	<li>identify shielding gases</li>\r\n</ul>\r\n\r\n<p>4. Describe the procedures used to fillet and groove weld stainless steel.</p>\r\n\r\n<p>5. Describe the procedures used to test welds.</p>\r\n\r\n<p>6. Describe weld faults.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Deposit groove welds on pipe of various thicknesses.</p>\r\n\r\n<p>2.Theory.</p>', NULL, '2021-07-24 11:23:55', '2021-07-24 11:23:55', 6, '6G CERTIFICATION COURSE IN GMAW/FCAW', 1, '60038041163844.jpg', 1);
INSERT INTO `tbl_courses` VALUES (40, 'REFRESHER COURSE ON PROCESS,WELD ABILITY,WELDING METALLUGY FOR WELDING ENGINEERS', 'ATTC012', 4, 'Week(s)', 145000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate understanding of the practices and principles to control expansion, contraction and distortion.</li>\r\n</ul>', '<p>1. Define terminology associated with metallurgy.</p>\r\n\r\n<p>2. Describe the types and characteristics of metals.</p>\r\n\r\n<ul>\r\n	<li>ferrous</li>\r\n	<li>low carbon</li>\r\n	<li>medium carbon</li>\r\n	<li>high carbon</li>\r\n	<li>alloy steel</li>\r\n	<li>non‐ferrous</li>\r\n</ul>\r\n\r\n<p>3. Describe mechanical and physical properties of metals.</p>\r\n\r\n<ul>\r\n	<li>tensile strength</li>\r\n	<li>yield strength</li>\r\n	<li>elasticity</li>\r\n	<li>ductility</li>\r\n	<li>hardness</li>\r\n	<li>compressive strength</li>\r\n	<li>fatigue strength</li>\r\n	<li>impact strength</li>\r\n	<li>toughness</li>\r\n	<li>density</li>\r\n	<li>melting point</li>\r\n	<li>thermal conductivity</li>\r\n	<li>thermal expansion</li>\r\n	<li>electrical conductivity and resistance</li>\r\n	<li>corrosion resistance</li>\r\n	<li>brittleness</li>\r\n	<li>malleability</li>\r\n	<li>plasticity</li>\r\n	<li>reaction to heat</li>\r\n	<li>specific heat</li>\r\n	<li>heat of fusion</li>\r\n</ul>\r\n\r\n<p>4. Describe the effects on properties of metals when:</p>\r\n\r\n<ul>\r\n	<li>forming</li>\r\n	<li>shearing</li>\r\n	<li>punching</li>\r\n	<li>drilling</li>\r\n	<li>cutting</li>\r\n	<li>welding</li>\r\n</ul>\r\n\r\n<p>5. Describe the effects of stresses and shrinkage on materials.</p>\r\n\r\n<ul>\r\n	<li>hard</li>\r\n	<li>brittle</li>\r\n	<li>tough</li>\r\n	<li>ductile</li>\r\n</ul>\r\n\r\n<p>6. Describe common methods to determine the type of material and/or weldability.</p>\r\n\r\n<ul>\r\n	<li>spark</li>\r\n	<li>flame</li>\r\n	<li>visual</li>\r\n	<li>chip</li>\r\n	<li>weight</li>\r\n	<li>magnet</li>\r\n</ul>\r\n\r\n<p>7. Identify pre‐heat and post‐heat processes and describe their purpose and applications.</p>\r\n\r\n<ul>\r\n	<li>temperature</li>\r\n</ul>\r\n\r\n<p>8. Describe various classification systems used for ferrous metals.</p>\r\n\r\n<ul>\r\n	<li>numbering systems</li>\r\n	<li>SAE (Society Automotive Engineers)</li>\r\n	<li>AISI (American Iron and Steel Institute)</li>\r\n	<li>ASTM (American Society of Testing and Materials)</li>\r\n	<li>CSA (Canadian Standards Association)</li>\r\n	<li>colour coding of materials</li>\r\n</ul>\r\n\r\n<p>9. Describe common problems in welding medium and high carbon steel.</p>\r\n\r\n<p>10. Describe expansion and contraction of metals.</p>\r\n\r\n<ul>\r\n	<li>heating compared with cooling</li>\r\n</ul>\r\n\r\n<p>11. Describe stresses resulting from.</p>\r\n\r\n<ul>\r\n	<li>welding</li>\r\n	<li>flame cutting</li>\r\n	<li>shearing</li>\r\n	<li>unsatisfactory preparation for welding</li>\r\n	<li>forming</li>\r\n	<li>riveting</li>\r\n</ul>\r\n\r\n<p>12. Describe control of shrinkage in weldments.</p>\r\n\r\n<ul>\r\n	<li>welding sequence</li>\r\n	<li>back step</li>\r\n	<li>staggered intermittent</li>\r\n	<li>chain intermittent</li>\r\n	<li>weld size and number of passes</li>\r\n	<li>balancing of shrinkage and other forces</li>\r\n	<li>pre‐heat and post‐heat requirements</li>\r\n</ul>\r\n\r\n<p>13. Describe stress relief.</p>\r\n\r\n<ul>\r\n	<li>purpose</li>\r\n	<li>methods</li>\r\n	<li>heating</li>\r\n	<li>peening</li>\r\n	<li>aging</li>\r\n	<li>requirements</li>\r\n</ul>\r\n\r\n<p>14. Describe controlled shrinkage for:</p>\r\n\r\n<ul>\r\n	<li>straightening of bent or distorted members</li>\r\n	<li>alignment of sub‐assemblies</li>\r\n	<li>pre‐bending</li>\r\n	<li>removal of corroded or seized parts</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory</p>\r\n\r\n<p>1. Identify metals using the spark test.</p>\r\n\r\n<p>2. Shape, grind and heat treat chisels.</p>\r\n\r\n<p>3. Observe tensile, ductility, hardness, tests.</p>\r\n\r\n<p>4. Demonstrate expansion and contraction.</p>\r\n\r\n<p>5. Pre‐set heated metal.</p>\r\n\r\n<p>6. Use pre-setting to straighten bent members.</p>\r\n\r\n<p>7. Perform pre‐bending.</p>', NULL, '2021-07-24 11:27:54', '2021-07-24 11:27:54', 8, 'REFRESHER COURSE ON PROCESS,WELD ABILITY,WELDING METALLUGY FOR WELDING ENGINEERS', 1, '29069768008939.jpg', 1);
INSERT INTO `tbl_courses` VALUES (41, 'REFRESH COURSE IN WELDING FOR MAINTENANCE ENGINEERS', 'ATTC013', 4, 'Week(s)', 125000.00, '<p>Upon successful completion of this course, the engineers will be able to:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;demonstrate understanding of the practices and principles to control expansion, contraction and distortion.</li>\r\n</ul>', '<p>1. Describe the types and characteristics of metals.</p>\r\n\r\n<ul>\r\n	<li>ferrous</li>\r\n	<li>low carbon</li>\r\n	<li>medium carbon</li>\r\n	<li>high carbon</li>\r\n	<li>alloy steel</li>\r\n	<li>non‐ferrous</li>\r\n</ul>\r\n\r\n<p>2. Describe stresses resulting from.</p>\r\n\r\n<ul>\r\n	<li>welding</li>\r\n	<li>flame cutting</li>\r\n	<li>shearing</li>\r\n	<li>unsatisfactory preparation for welding</li>\r\n	<li>forming</li>\r\n	<li>riveting</li>\r\n</ul>\r\n\r\n<p>3. Identify pre‐heat and post‐heat processes and describe their purpose and</p>\r\n\r\n<p>applications.</p>\r\n\r\n<ul>\r\n	<li>temperature</li>\r\n</ul>\r\n\r\n<p>4. Describe the effects on properties of metals when:</p>\r\n\r\n<ul>\r\n	<li>cutting</li>\r\n	<li>welding</li>\r\n</ul>\r\n\r\n<p>5. Describe controlled shrinkage for:</p>\r\n\r\n<ul>\r\n	<li>straightening of bent or distorted members</li>\r\n	<li>alignment of sub‐assemblies</li>\r\n	<li>pre‐bending</li>\r\n	<li>removal of corroded or seized parts</li>\r\n</ul>\r\n\r\n<p>6. Describe control of shrinkage in weldments.</p>\r\n\r\n<ul>\r\n	<li>welding sequence</li>\r\n	<li>back step</li>\r\n	<li>staggered intermittent</li>\r\n	<li>chain intermittent</li>\r\n	<li>weld size and number of passes</li>\r\n	<li>balancing of shrinkage and other forces</li>\r\n	<li>pre‐heat and post‐heat requirements</li>\r\n</ul>\r\n\r\n<p>7. Describe stress relief.</p>\r\n\r\n<ul>\r\n	<li>purpose</li>\r\n	<li>methods</li>\r\n	<li>heating</li>\r\n	<li>peening</li>\r\n	<li>aging</li>\r\n	<li>requirements</li>\r\n</ul>\r\n\r\n<p>8. Describe various classification systems used for ferrous metals.</p>\r\n\r\n<ul>\r\n	<li>numbering systems</li>\r\n	<li>AISI (American Iron and Steel Institute)</li>\r\n	<li>ASTM (American Society of Testing and Materials)</li>\r\n	<li>colour coding of materials</li>\r\n</ul>\r\n\r\n<p>9. Describe common problems in welding medium and high carbon steel.</p>\r\n\r\n<p>10. Describe expansion and contraction of metals.</p>\r\n\r\n<ul>\r\n	<li>heating compared with cooling</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory,</p>\r\n\r\n<p>1. Identify metals using the spark test.</p>\r\n\r\n<p>2. Shape, grind and heat treat chisels.</p>\r\n\r\n<p>3. Demonstrate expansion and contraction.</p>\r\n\r\n<p>4. Pre‐set heated metal.</p>\r\n\r\n<p>5. Use pre-setting to straighten bent members.</p>\r\n\r\n<p>6. Perform pre‐bending.</p>', NULL, '2021-07-24 11:34:30', '2021-07-24 11:34:30', 11, 'REFRESH COURSE IN WELDING FOR MAINTENANCE ENGINEERS', 1, '9343923482816.jpg', 1);
INSERT INTO `tbl_courses` VALUES (42, 'BASIC COURSE OXY-FUEL CUTTING, WELDING AND BRAZING', 'ATTC017', 4, 'Week(s)', 128000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>demonstrate knowledge of oxy‐fuel equipment.</li>\r\n</ul>', '<p>1. Describe the procedures used to set‐up and shut down oxy‐fuel equipment.</p>\r\n\r\n<ul>\r\n	<li>protective equipment</li>\r\n	<li>cleaning</li>\r\n	<li>equipment and accessories</li>\r\n	<li>cylinders (storage and handling)</li>\r\n	<li>regulators</li>\r\n	<li>lighter</li>\r\n	<li>torches</li>\r\n	<li>flashback arrestors</li>\r\n	<li>check valve</li>\r\n	<li>hose</li>\r\n	<li>manifold</li>\r\n	<li>assembling</li>\r\n	<li>tip selection</li>\r\n	<li>cutting</li>\r\n	<li>heating</li>\r\n	<li>gouging</li>\r\n	<li>thread identification</li>\r\n	<li>pressure adjustment</li>\r\n	<li>quality of cut</li>\r\n	<li>gas selection</li>\r\n	<li>types of flames</li>\r\n	<li>testing</li>\r\n	<li>disassembling</li>\r\n</ul>\r\n\r\n<p>2. Identify oxy‐fuel cutting, heating and gouging applications and procedures.</p>\r\n\r\n<ul>\r\n	<li>sheet metal</li>\r\n	<li>plate</li>\r\n	<li>structural shapes</li>\r\n	<li>pipe</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course.</p>\r\n\r\n<p>1. Cutting</p>\r\n\r\n<ul>\r\n	<li>straight cutting</li>\r\n	<li>bevel cutting</li>\r\n</ul>\r\n\r\n<p>2. Gouging</p>\r\n\r\n<ul>\r\n	<li>gouge groove in flat plate</li>\r\n</ul>\r\n\r\n<p><strong>Fusion, Brazing and Braze Welding (Oxy‐ Fuel)</strong></p>\r\n\r\n<p><strong>Outcomes:</strong></p>\r\n\r\n<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>silver brazing (copper pipe in all positions.</li>\r\n	<li>fusion weld steel in the flat and horizontal positions.</li>\r\n	<li>braze weld.</li>\r\n</ul>\r\n\r\n<p><strong>Objectives and Content:</strong></p>\r\n\r\n<p>1. Describe the purpose, applications and advantages of fusion, brazing and braze</p>\r\n\r\n<p>welding.</p>\r\n\r\n<p>2. Describe the procedures necessary to fusion weld in flat and horizontal positions.</p>\r\n\r\n<p>3. Describe the procedures used to braze (silver solder).</p>\r\n\r\n<ul>\r\n	<li>&nbsp;copper pipe</li>\r\n	<li>&nbsp;cold roll (mild steel)</li>\r\n	<li>&nbsp;stainless steel</li>\r\n	<li>&nbsp;ferrous to non‐ferrous metal</li>\r\n</ul>\r\n\r\n<p>4. Describe the procedures necessary to braze with sil‐fos and easy flow.</p>\r\n\r\n<p>5. Describe the procedures used to braze weld.</p>\r\n\r\n<ul>\r\n	<li>steel</li>\r\n	<li>cast iron</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Fusion welding.</p>\r\n\r\n<ul>\r\n	<li>closed corner</li>\r\n	<li>&nbsp;open corner</li>\r\n	<li>&nbsp;horizontal lap joint</li>\r\n	<li>&nbsp;square butt joint</li>\r\n</ul>\r\n\r\n<p>2. Bronze welding.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;tinning</li>\r\n	<li>&nbsp;horizontal lap joint</li>\r\n	<li>&nbsp;square butt joint</li>\r\n</ul>\r\n\r\n<p>3. Silver brazing.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;copper/steel tee joint</li>\r\n	<li>&nbsp;copper tee and tubing</li>\r\n	<li>&nbsp;braze copper to copper (sil-fos).</li>\r\n	<li>&nbsp;braze stainless steel to stainless steel (easy flow).</li>\r\n</ul>\r\n\r\n<p>4. Braze weld cast iron and mild steel.</p>', NULL, '2021-07-24 11:38:15', '2021-07-24 13:50:31', 10, 'BASIC COURSE OXY-FUEL CUTTING, WELDING AND BRAZING', 1, '42.jpg', 1);
INSERT INTO `tbl_courses` VALUES (43, 'AIR CARBON ARC CUTTING AND GOUGING', 'ATTC019', 1, 'Week(s)', 65000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>remove a weld from a joint using the air carbon arc (CAC‐A) process.</li>\r\n	<li>prepare joints using the air carbon arc (CAC‐A) process.</li>\r\n</ul>', '<p>1. Describe the purposes and applications of air carbon arc cutting and gouging.</p>\r\n\r\n<p>2. Describe the procedures used to remove a weld from a joint using the CAC‐A (Air</p>\r\n\r\n<p>Carbon Arc) process.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;types of carbon electrodes</li>\r\n	<li>&nbsp;air pressure</li>\r\n	<li>&nbsp;electrode angles</li>\r\n	<li>&nbsp;polarity</li>\r\n	<li>&nbsp;constant current power source</li>\r\n</ul>\r\n\r\n<p>3. Describe groove preparation using the CAC‐A process.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;joint</li>\r\n	<li>&nbsp;J‐joint</li>\r\n	<li>&nbsp;single‐vee</li>\r\n	<li>&nbsp;single‐bevel joints</li>\r\n</ul>\r\n\r\n<p>4. Describe the procedures used to back gouge a welded joint.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Setup equipment for gouging, select the correct air pressure, carbon electrode and</p>\r\n\r\n<p>polarity.</p>\r\n\r\n<p>2. Back gouge to sound metal a single vee groove butt joint.</p>', NULL, '2021-07-24 11:42:26', '2021-07-24 13:49:53', 10, 'AIR CARBON ARC CUTTING AND GOUGING', 1, '43.jpg', 1);
INSERT INTO `tbl_courses` VALUES (44, 'GTAW+SMAW PIPE WELDING TRAINING FOR BEGINNERS', 'ATTC010', 10, 'Month(s)', 850000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n\r\n<p>‐fillet &amp; groove weld on mild steel using the SMAW+ GTAW process with electrodes and filler wire.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;perform weld tests on pipe and plate.</li>\r\n	<li>&nbsp;Describe the process to weld on medium and high‐carbon steel in all positions&nbsp;using the SMAW process.</li>\r\n</ul>', '<p>1. Identify and describe the weld positions.</p>\r\n\r\n<ul>\r\n	<li>1-F</li>\r\n	<li>2-F</li>\r\n	<li>3-F</li>\r\n	<li>4-F</li>\r\n	<li>1‐G</li>\r\n	<li>2‐G</li>\r\n	<li>3-G</li>\r\n	<li>4-G</li>\r\n	<li>5-G</li>\r\n	<li>6-G</li>\r\n</ul>\r\n\r\n<p>2. Describe the procedures used to perform on groove weld and fillet weld.</p>\r\n\r\n<ul>\r\n	<li>joint design</li>\r\n	<li>inspection and testing</li>\r\n	<li>electrode angles</li>\r\n	<li>electrode manipulation</li>\r\n	<li>amperage adjustment</li>\r\n	<li>identify position and limitations</li>\r\n	<li>identify material</li>\r\n	<li>determine thickness of material</li>\r\n	<li>select electrode</li>\r\n	<li>select current</li>\r\n	<li>penetration</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures used to test welds.</p>\r\n\r\n<ul>\r\n	<li>codes and standards</li>\r\n</ul>\r\n\r\n<p>4. Describe all types of weld faults.</p>\r\n\r\n<p>5. Describe the SMAW and GTAW process as it applies to welding medium and high‐carbon steel.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>characteristics of materials</li>\r\n	<li>weldability of materials</li>\r\n	<li>welding procedures</li>\r\n</ul>\r\n\r\n<p>6. Describe weld faults with medium and high carbon steel.</p>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1. Weld groove butt joints on 3/8&rdquo; mild steel plate and pipe.</p>\r\n\r\n<p>2. Perform weld tests.</p>', NULL, '2021-07-24 13:20:05', '2021-07-24 13:20:05', 5, 'GTAW+SMAW PIPE WELDING TRAINING FOR BEGINNERS', 1, '39577248239528.jpg', 1);
INSERT INTO `tbl_courses` VALUES (45, 'PLASMA ARC CUTTING AND GOUGING', 'ATTC018', 2, 'Week(s)', 60000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n\r\n<ul>\r\n	<li>set‐up and operate plasma arc equipment.</li>\r\n	<li>cut and gouge ferrous and non-ferrous metal.</li>\r\n</ul>', '<p>1. Define terminology associated with the plasma arc process.</p>\r\n\r\n<p>2. Describe the plasma arc process.</p>\r\n\r\n<ul>\r\n	<li>general precautions</li>\r\n	<li>equipment and accessories</li>\r\n	<li>types of torches</li>\r\n	<li>electrodes and tips</li>\r\n	<li>types of arcs</li>\r\n	<li>gases</li>\r\n	<li>power source</li>\r\n	<li>procedures to set‐up equipment and check its operation</li>\r\n</ul>\r\n\r\n<p>3. Describe the procedures used to assemble and disassemble plasma arc equipment.</p>\r\n\r\n<p>4. Describe the procedures used to maintain and troubleshoot plasma arc equipment.</p>\r\n\r\n<p>5. Describe the procedures used to cut various thicknesses of ferrous and non‐ferrous</p>\r\n\r\n<p>metals.</p>\r\n\r\n<ul>\r\n	<li>structural shapes</li>\r\n	<li>plate</li>\r\n</ul>\r\n\r\n<p><strong>Practical:</strong></p>\r\n\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The</p>\r\n\r\n<p>learning objectives outlined below are mandatory.</p>\r\n\r\n<p>1.cut and gouge ferrous and non-ferrous metal.</p>\r\n\r\n<p>2.Theory</p>', NULL, '2021-07-24 13:32:55', '2021-07-24 16:24:37', 35, 'PLASMA ARC CUTTING AND GOUGING', 1, '45.jpg', 1);

-- ----------------------------
-- Table structure for tbl_courses_instructors
-- ----------------------------
DROP TABLE IF EXISTS `tbl_courses_instructors`;
CREATE TABLE `tbl_courses_instructors`  (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_department
-- ----------------------------
DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE `tbl_department`  (
  `department_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_date` datetime(0) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_department
-- ----------------------------
INSERT INTO `tbl_department` VALUES ('Transportation', 1, '2021-02-04 16:06:11', 1);
INSERT INTO `tbl_department` VALUES ('Admin', 1, '0000-00-00 00:00:00', 2);
INSERT INTO `tbl_department` VALUES ('Information Technology', 1, '2020-03-20 03:35:58', 3);
INSERT INTO `tbl_department` VALUES ('Public', 1, '2021-05-09 19:37:55', 4);
INSERT INTO `tbl_department` VALUES ('Learning and Development', 0, '0000-00-00 00:00:00', 5);

-- ----------------------------
-- Table structure for tbl_designation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_designation`;
CREATE TABLE `tbl_designation`  (
  `designation` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `department_id` int(11) NULL DEFAULT NULL,
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`designation_id`) USING BTREE,
  INDEX `department_id`(`department_id`) USING BTREE,
  CONSTRAINT `tbl_designation_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_designation
-- ----------------------------
INSERT INTO `tbl_designation` VALUES ('System Admin', 3, 1);
INSERT INTO `tbl_designation` VALUES ('Network Engineer', 3, 2);
INSERT INTO `tbl_designation` VALUES ('Software Programmer', 3, 3);
INSERT INTO `tbl_designation` VALUES ('General User', 4, 4);
INSERT INTO `tbl_designation` VALUES ('Lecturer 1', 5, 5);
INSERT INTO `tbl_designation` VALUES ('Driver', 1, 6);
INSERT INTO `tbl_designation` VALUES ('Senior Lecturer', 5, 12);

-- ----------------------------
-- Table structure for tbl_event
-- ----------------------------
DROP TABLE IF EXISTS `tbl_event`;
CREATE TABLE `tbl_event`  (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `event_venue` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `event_date` date NULL DEFAULT NULL,
  `event_start_time` time(0) NULL DEFAULT NULL,
  `event_end_time` time(0) NULL DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `user_id` int(10) NULL DEFAULT NULL,
  `status` int(255) NULL DEFAULT 1,
  `event_content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `file` int(1) NULL DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`event_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_event
-- ----------------------------
INSERT INTO `tbl_event` VALUES (4, 'Total Gas Training Exhibition', 'Total V.I Office', '2021-06-02', '10:00:00', '12:00:00', 'no_image.jpg', '2021-05-17 21:35:23', 1, 1, '<h4>Teaching Welding in the Virtual World</h4>\r\n<p>Welding instructors that are struggling to teach in today&rsquo;s virtual environment, there are few experts helping them figure out how to teach welding this new way and they need help.</p>\r\n<p>The Education/Workforce Development Conference has been held over a 5 year period at FABTECH. The conferences have always been geared towards welding instructors and providing essential information and products that can be transcended into the classroom. This Workshop is intended to provide welding instructors with tools and examples of how to teach welding in a virtual environment.</p>', 0, NULL);
INSERT INTO `tbl_event` VALUES (5, 'Welding School Junior Student Competition', 'Dangote Refinery JETTI', '2021-05-31', '09:00:00', '16:30:00', '5.png', '2021-06-07 16:14:34', 1, 1, '<p>Teaching Welding in the Virtual World</p>\r\n\r\n<p>Welding instructors that are struggling to teach in today&rsquo;s virtual environment, there are few experts helping them figure out how to teach welding this new way and they need help.</p>\r\n\r\n<p>The Education/Workforce Development Conference has been held over a 5 year period at FABTECH. The conferences have always been geared towards welding instructors and providing essential information and products that can be transcended into the classroom. This Workshop is intended to provide welding instructors with tools and examples of how to teach welding in a virtual environment.</p>', 1, '18120431432815.pdf');

-- ----------------------------
-- Table structure for tbl_main_tab
-- ----------------------------
DROP TABLE IF EXISTS `tbl_main_tab`;
CREATE TABLE `tbl_main_tab`  (
  `main_tab_id` int(11) NOT NULL,
  `main_tab_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permission_slug` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`main_tab_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_main_tab
-- ----------------------------
INSERT INTO `tbl_main_tab` VALUES (1, 'User Manager', 'icon-people', 'view-manage-user');
INSERT INTO `tbl_main_tab` VALUES (2, 'Course Manager', 'fa fa-book', 'view-course-manager');
INSERT INTO `tbl_main_tab` VALUES (3, 'Online Class Facility', 'fa fa-desktop', 'view-online-class-facility');
INSERT INTO `tbl_main_tab` VALUES (4, 'Assessment Manager', 'icon-pencil', 'view-assessment-manager');
INSERT INTO `tbl_main_tab` VALUES (5, 'Application Manager', 'fa fa-file', 'view-application-manager');
INSERT INTO `tbl_main_tab` VALUES (6, 'Payments Portal', 'icon-credit-card', 'view-payment-portal');
INSERT INTO `tbl_main_tab` VALUES (7, 'Events Manager', 'icon-picture', 'view-events-manager');
INSERT INTO `tbl_main_tab` VALUES (8, 'Student Manager', 'fa fa-users', 'view-manage-student');
INSERT INTO `tbl_main_tab` VALUES (9, 'Programme Manager', 'fa fa-graduation-cap', 'view-programme-manager');
INSERT INTO `tbl_main_tab` VALUES (10, 'Master Manager', 'icon-drawer', 'view-master-manager');
INSERT INTO `tbl_main_tab` VALUES (30, 'System Settings', 'fa fa-gear', 'view-settings');

-- ----------------------------
-- Table structure for tbl_map_lecturer_to_courses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_map_lecturer_to_courses`;
CREATE TABLE `tbl_map_lecturer_to_courses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NULL DEFAULT NULL,
  `lecturer_user_id` int(3) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_map_lecturer_to_courses
-- ----------------------------
INSERT INTO `tbl_map_lecturer_to_courses` VALUES (42, 6, 6, '2021-06-22 19:50:22', '1');
INSERT INTO `tbl_map_lecturer_to_courses` VALUES (46, 32, 6, '2021-07-25 19:10:50', '15');
INSERT INTO `tbl_map_lecturer_to_courses` VALUES (51, 42, 6, '2021-07-25 21:52:08', '1');
INSERT INTO `tbl_map_lecturer_to_courses` VALUES (52, 36, 6, '2021-07-26 00:33:41', '1');
INSERT INTO `tbl_map_lecturer_to_courses` VALUES (53, 42, 21, '2021-07-26 06:53:00', '15');

-- ----------------------------
-- Table structure for tbl_payments
-- ----------------------------
DROP TABLE IF EXISTS `tbl_payments`;
CREATE TABLE `tbl_payments`  (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `amount` decimal(10, 0) NOT NULL,
  `application_id` int(11) NULL DEFAULT NULL,
  `payment_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-Regular Fee 2-Accomodation',
  `ref` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `creation_date` datetime(0) NOT NULL,
  `paystack_status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `paystack_amount_processed` int(255) NULL DEFAULT NULL COMMENT 'Amount is in kobo',
  `payment_method` int(1) NULL DEFAULT 1 COMMENT '1 - Debit Card, 2- Bank Transfer',
  `bank_trans_confirmed_by` int(10) NULL DEFAULT NULL,
  `bank_trans_confirmed_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 101 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_payments
-- ----------------------------
INSERT INTO `tbl_payments` VALUES (94, 14, 611000, 29, 1, NULL, '2021-06-23 17:23:55', 'success', NULL, 2, 1, '2021-06-23 17:24:07');
INSERT INTO `tbl_payments` VALUES (93, 14, 158000, 28, 1, '14_20210622_95385', '2021-06-22 19:41:32', 'success', 15800000, 1, NULL, NULL);
INSERT INTO `tbl_payments` VALUES (92, 14, 154000, 27, 1, '14_20210615_35007', '2021-06-15 17:09:59', 'success', 15400000, 1, NULL, NULL);
INSERT INTO `tbl_payments` VALUES (95, 16, 154000, 30, 1, '16_20210722_95567', '2021-07-22 16:21:38', 'success', 15400000, 1, NULL, NULL);
INSERT INTO `tbl_payments` VALUES (96, 20, 128000, 31, 1, NULL, '2021-07-24 18:13:08', 'success', NULL, 2, 15, '2021-07-24 18:16:09');
INSERT INTO `tbl_payments` VALUES (97, 19, 198000, 32, 1, NULL, '2021-07-25 19:10:57', 'success', NULL, 2, 15, '2021-07-25 19:11:23');
INSERT INTO `tbl_payments` VALUES (98, 19, 35000, 34, 1, NULL, '2021-07-26 00:31:17', 'success', NULL, 2, 1, '2021-07-26 00:31:44');
INSERT INTO `tbl_payments` VALUES (99, 19, 198000, 35, 1, NULL, '2021-07-26 00:44:21', 'success', NULL, 2, 1, '2021-07-26 00:44:42');
INSERT INTO `tbl_payments` VALUES (100, 20, 128000, 36, 1, NULL, '2021-07-26 06:56:36', 'success', NULL, 2, 15, '2021-07-26 06:57:26');

-- ----------------------------
-- Table structure for tbl_programmes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_programmes`;
CREATE TABLE `tbl_programmes`  (
  `programme_id` int(11) NOT NULL AUTO_INCREMENT,
  `programme_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1 COMMENT '1 - Active 2 - Deactivated',
  `disp_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`programme_id`) USING BTREE,
  INDEX `created_by_new`(`created_by`) USING BTREE,
  CONSTRAINT `created_by_new` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_programmes
-- ----------------------------
INSERT INTO `tbl_programmes` VALUES (1, 'SMAW – SHIELDED METAL ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '1.jpg');
INSERT INTO `tbl_programmes` VALUES (2, 'GMAW – GAS METAL ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '2.jpg');
INSERT INTO `tbl_programmes` VALUES (3, 'FCAW – FLUX CORED ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '3.jpg');
INSERT INTO `tbl_programmes` VALUES (4, 'GTAW – GAS TUNGSTEN ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '4.jpg');
INSERT INTO `tbl_programmes` VALUES (5, 'GTAW+ SMAW (GAS TUNGSTEN ARC WELDING +SHIELDED METAL ARC WELDING)', 1, '2021-05-12 20:48:02', NULL, 1, '5.jpg');
INSERT INTO `tbl_programmes` VALUES (6, 'GMAW+FCAW ( GAS METAL ARC WELDING+ FLUX-CORED ARE WELDING)', 1, '2021-05-12 20:48:02', NULL, 1, '6.jpg');
INSERT INTO `tbl_programmes` VALUES (8, 'METALLURGY ,EXPENSION AND CONTRACTION CONTROL', 1, '2021-05-12 20:48:02', NULL, 1, '8.jpg');
INSERT INTO `tbl_programmes` VALUES (9, 'RIGGING AND SCAFFOLDING', 1, '2021-05-12 20:48:02', NULL, 1, '9.jpg');
INSERT INTO `tbl_programmes` VALUES (10, 'GAS WELDING, CUTTING AND GOUGING COURSES', 1, '2021-05-12 20:48:02', NULL, 1, '10.jpg');
INSERT INTO `tbl_programmes` VALUES (11, 'REFRESHER COURSE IN WELDING FOR MAINTENANCE ENGINEERS', 1, '2021-05-12 20:48:02', NULL, 1, '11.jpg');
INSERT INTO `tbl_programmes` VALUES (12, 'SCAFFOLD TRAINING', 1, '2021-05-12 20:48:02', NULL, 1, '12.jpg');
INSERT INTO `tbl_programmes` VALUES (31, ' PIPING COURSE', 1, '2021-07-23 20:21:15', NULL, 1, '31.jpg');
INSERT INTO `tbl_programmes` VALUES (32, 'NDT TRAINING COURSE', 1, '2021-05-12 20:48:02', NULL, 1, '32.jpg');
INSERT INTO `tbl_programmes` VALUES (33, 'LIFTING OPERATIONS TRAINING', 1, '2021-05-12 20:48:02', NULL, 1, '33.jpg');
INSERT INTO `tbl_programmes` VALUES (34, 'QA/QC TRAINING COURSE', 1, '2021-05-12 20:48:02', NULL, 1, '34.png');
INSERT INTO `tbl_programmes` VALUES (35, 'PLASMA ARC CUTTING AND GOUGING', 15, '2021-07-24 13:26:17', NULL, 1, '35.jpg');

-- ----------------------------
-- Table structure for tbl_qualifications
-- ----------------------------
DROP TABLE IF EXISTS `tbl_qualifications`;
CREATE TABLE `tbl_qualifications`  (
  `qualification_id` int(11) NOT NULL,
  `qualification_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`qualification_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_qualifications
-- ----------------------------
INSERT INTO `tbl_qualifications` VALUES (1, 'Primary', '2021-05-26 13:08:16');
INSERT INTO `tbl_qualifications` VALUES (2, 'Secondary', '2021-05-26 13:08:26');
INSERT INTO `tbl_qualifications` VALUES (3, 'Bsc', '2021-05-26 13:08:26');
INSERT INTO `tbl_qualifications` VALUES (4, 'Msc', '2021-05-26 13:08:26');
INSERT INTO `tbl_qualifications` VALUES (5, 'PHD', '2021-05-26 13:08:26');

-- ----------------------------
-- Table structure for tbl_questions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_questions`;
CREATE TABLE `tbl_questions`  (
  `question_id` int(100) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `option_1` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `option_2` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `option_3` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `option_4` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `answer` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `posted_by` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `assessment_type` int(1) NULL DEFAULT NULL,
  `dummy_questions` int(1) NULL DEFAULT 0,
  `course_id` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`question_id`) USING BTREE,
  INDEX `course_id_new`(`course_id`) USING BTREE,
  CONSTRAINT `course_id_new` FOREIGN KEY (`course_id`) REFERENCES `tbl_courses` (`course_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_settings
-- ----------------------------
DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings`  (
  `settings_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `value` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`settings_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_settings
-- ----------------------------
INSERT INTO `tbl_settings` VALUES (1, 'company_name', 'African Technical Training Centre', NULL);
INSERT INTO `tbl_settings` VALUES (2, 'powered_by', 'Ese Kelvin', NULL);
INSERT INTO `tbl_settings` VALUES (3, 'maintenance_mode', 'false', 'When this is true, site will display maintenance mode');
INSERT INTO `tbl_settings` VALUES (4, 'google_api_key', 'AIzaSyAx79EFCwbousiM-kcnCsZXCdNYRMMDQhw', NULL);
INSERT INTO `tbl_settings` VALUES (5, 'company_email', 'dangote.gts@gmail.com', NULL);
INSERT INTO `tbl_settings` VALUES (6, 'default_password', '123456', 'default password created for new users');
INSERT INTO `tbl_settings` VALUES (7, 'Contact Us Email', 'dangote.gts@gmail.com', 'contact us admin email address');

-- ----------------------------
-- Table structure for tbl_states
-- ----------------------------
DROP TABLE IF EXISTS `tbl_states`;
CREATE TABLE `tbl_states`  (
  `state_id` int(11) NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`state_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_states
-- ----------------------------
INSERT INTO `tbl_states` VALUES (1, 'Abia', 128);
INSERT INTO `tbl_states` VALUES (2, 'Adamawa', 128);
INSERT INTO `tbl_states` VALUES (3, 'Akwa Ibom', 128);
INSERT INTO `tbl_states` VALUES (4, 'Anambra', 128);
INSERT INTO `tbl_states` VALUES (5, 'Bauchi', 128);
INSERT INTO `tbl_states` VALUES (6, 'Bayelsa', 128);
INSERT INTO `tbl_states` VALUES (7, 'Benue', 128);
INSERT INTO `tbl_states` VALUES (8, 'Borno', 128);
INSERT INTO `tbl_states` VALUES (9, 'Cross River', 128);
INSERT INTO `tbl_states` VALUES (10, 'Delta', 128);
INSERT INTO `tbl_states` VALUES (11, 'Ebonyi', 128);
INSERT INTO `tbl_states` VALUES (12, 'Edo', 128);
INSERT INTO `tbl_states` VALUES (13, 'Ekiti', 128);
INSERT INTO `tbl_states` VALUES (14, 'Enugu', 128);
INSERT INTO `tbl_states` VALUES (15, 'FCT', 128);
INSERT INTO `tbl_states` VALUES (16, 'Gombe', 128);
INSERT INTO `tbl_states` VALUES (17, 'Imo', 128);
INSERT INTO `tbl_states` VALUES (18, 'Jigawa', 128);
INSERT INTO `tbl_states` VALUES (19, 'Kaduna', 128);
INSERT INTO `tbl_states` VALUES (20, 'Kano', 128);
INSERT INTO `tbl_states` VALUES (21, 'Katsina', 128);
INSERT INTO `tbl_states` VALUES (22, 'Kebbi', 128);
INSERT INTO `tbl_states` VALUES (23, 'Kogi', 128);
INSERT INTO `tbl_states` VALUES (24, 'Kwara', 128);
INSERT INTO `tbl_states` VALUES (25, 'Lagos', 128);
INSERT INTO `tbl_states` VALUES (26, 'Nasarawa', 128);
INSERT INTO `tbl_states` VALUES (27, 'Niger', 128);
INSERT INTO `tbl_states` VALUES (28, 'Ogun', 128);
INSERT INTO `tbl_states` VALUES (29, 'Ondo', 128);
INSERT INTO `tbl_states` VALUES (30, 'Osun', 128);
INSERT INTO `tbl_states` VALUES (31, 'Oyo', 128);
INSERT INTO `tbl_states` VALUES (32, 'Plateau', 128);
INSERT INTO `tbl_states` VALUES (33, 'Rivers', 128);
INSERT INTO `tbl_states` VALUES (34, 'Sokoto', 128);
INSERT INTO `tbl_states` VALUES (35, 'Taraba', 128);
INSERT INTO `tbl_states` VALUES (36, 'Yobe', 128);
INSERT INTO `tbl_states` VALUES (37, 'Zamfara', 128);

-- ----------------------------
-- Table structure for tbl_sub_tab
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sub_tab`;
CREATE TABLE `tbl_sub_tab`  (
  `sub_tab_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_tab_id` int(11) NOT NULL,
  `sub_tab_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sub_tab_named_route` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `permission_slug` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  PRIMARY KEY (`sub_tab_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_sub_tab
-- ----------------------------
INSERT INTO `tbl_sub_tab` VALUES (1, 1, 'Manage User', 'manage_user', 'view-manage-user');
INSERT INTO `tbl_sub_tab` VALUES (2, 10, 'Manage Department', 'manage_department', 'view-manage-department');
INSERT INTO `tbl_sub_tab` VALUES (3, 30, 'Update Role', 'manage_role', 'view-update-role');
INSERT INTO `tbl_sub_tab` VALUES (4, 30, 'Update Permission', 'manage_permission', 'view-update-permission');
INSERT INTO `tbl_sub_tab` VALUES (5, 30, 'Special Permission', 'manage_special_permission', 'view-special-permission');
INSERT INTO `tbl_sub_tab` VALUES (6, 30, 'Menu Permission', 'manage_menu_permission', 'view-menu-permission');
INSERT INTO `tbl_sub_tab` VALUES (7, 10, 'Manage Designation', 'manage_designation', 'view-manage-designation');
INSERT INTO `tbl_sub_tab` VALUES (8, 5, 'My Application', 'my_application', 'view-my-application');
INSERT INTO `tbl_sub_tab` VALUES (9, 5, 'Student Application', 'student_application', 'view-student-application');
INSERT INTO `tbl_sub_tab` VALUES (10, 6, 'Pay Tuition Fees', 'pay_tution_fees', 'can-pay-tuition-fees');
INSERT INTO `tbl_sub_tab` VALUES (11, 6, 'Confirm Bank Transfer', 'confirm_bank_transfer', 'view-bank-transfer');
INSERT INTO `tbl_sub_tab` VALUES (12, 3, 'My Time Table', 'my_time_table', 'view-time-table');
INSERT INTO `tbl_sub_tab` VALUES (13, 4, 'Assessment Weight', 'assessment_weight', 'manage-assessment-weight');
INSERT INTO `tbl_sub_tab` VALUES (14, 8, 'My Students', 'my_students', 'view-my-student');
INSERT INTO `tbl_sub_tab` VALUES (15, 8, 'All Students', 'all_students', 'view-all-students');
INSERT INTO `tbl_sub_tab` VALUES (16, 4, 'Manage Questions', 'manage_question', 'manage-question');
INSERT INTO `tbl_sub_tab` VALUES (38, 2, 'Courses List', 'courses_list', 'view-all-course-list');
INSERT INTO `tbl_sub_tab` VALUES (39, 2, 'Map Lecturer to Courses', 'map_lecturer_to_courses', 'map-lecturer-to-courses');
INSERT INTO `tbl_sub_tab` VALUES (40, 2, 'Assigned Courses', 'assigned_courses', 'view-assigned-courses');
INSERT INTO `tbl_sub_tab` VALUES (41, 3, 'Take C.A', 'take_ca', 'view-take-ca');
INSERT INTO `tbl_sub_tab` VALUES (42, 3, 'My Certificate', 'my_certificate', 'view-certificate');
INSERT INTO `tbl_sub_tab` VALUES (43, 4, 'Upload C.A Question', 'upload_ca_question', 'view-upload-ca-question');
INSERT INTO `tbl_sub_tab` VALUES (44, 4, 'Manage Assessment', 'manage_assessment', 'manage-my-assessment');
INSERT INTO `tbl_sub_tab` VALUES (45, 7, 'Event List', 'event_list', 'view-event-list');
INSERT INTO `tbl_sub_tab` VALUES (46, 9, 'Programme List', 'programme_list', 'view-programme-list');
INSERT INTO `tbl_sub_tab` VALUES (47, 6, 'Payment Report', 'payment_report', 'view-payment-report');

-- ----------------------------
-- Table structure for tbl_suber_tab
-- ----------------------------
DROP TABLE IF EXISTS `tbl_suber_tab`;
CREATE TABLE `tbl_suber_tab`  (
  `suber_tab_id` int(11) NOT NULL,
  `sub_tab_id` int(11) NOT NULL,
  `suber_tab_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `suber_tab_named_route` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `permission_slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  PRIMARY KEY (`suber_tab_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_suber_tab
-- ----------------------------
INSERT INTO `tbl_suber_tab` VALUES (1, 1, 'Create Role', 'new_staff_role', NULL);
INSERT INTO `tbl_suber_tab` VALUES (2, 1, 'View Roles', 'view_staff_role', NULL);
INSERT INTO `tbl_suber_tab` VALUES (3, 1, 'Edit Role', 'edit_staff_role', NULL);

-- ----------------------------
-- Table structure for tbl_team
-- ----------------------------
DROP TABLE IF EXISTS `tbl_team`;
CREATE TABLE `tbl_team`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `company_designation` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `biography` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `facebook_url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `twitter_url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `profile_url_img` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_team
-- ----------------------------
INSERT INTO `tbl_team` VALUES (1, 'Nonso Esotu', 'Managing Director', '<p>The vibrant and charismatic Managing Director of VERITY ROCK LIMITED. His vast experience spans various sectors of the economy. With a degree in Business administration he is an achiever, a self motivated MD who places high premium on the collective corporate goals and aspirations.</p><p>Nonso Esotu exudes and radiates a un-parallel level of confidence. He is a stickler for time, principles and high moral standards. His contagious passion for success and mathematical approach to corporate governance and depth of knowledge in the maritime sector has strategically positioned him as the helmsman of African Technical Training Centre</p>', '2021-05-11 13:34:15', '1', NULL, NULL, '1.jpg');
INSERT INTO `tbl_team` VALUES (2, 'Priyan Balan', 'Director Operations and Logistics', '<p>The indefatigable Priyan Balan is the Director, Operations and Logistics. A bachelors\' degree in Mechanical Engineering having 18 years in welding and fabrication field, he is a visionary, a perfectionist who always strives for greater heights.</p><p>Priyan is focused and highly disciplined with QA/QC Certification and ASNT Level 2 Certification. An experienced welding teacher with practical sessions, his versatility and good sense of corporate governance of VERITY ROCK LIMITED is rapidly bearing fruits and attesting to his Midas touch here in Nigeria.</p>', '2021-05-11 14:08:54', NULL, NULL, NULL, '2.jpg');

-- ----------------------------
-- Table structure for tbl_timetable
-- ----------------------------
DROP TABLE IF EXISTS `tbl_timetable`;
CREATE TABLE `tbl_timetable`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `week_start` date NULL DEFAULT NULL,
  `week_end` date NULL DEFAULT NULL,
  `lecture_date` date NULL DEFAULT NULL,
  `start_time` time(0) NULL DEFAULT NULL,
  `end_time` time(0) NULL DEFAULT NULL,
  `day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `course_id` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `batch_id` int(11) NULL DEFAULT NULL,
  `zoom_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `zoom_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `zoom_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_timetable
-- ----------------------------
INSERT INTO `tbl_timetable` VALUES (1, '2021-06-21', '2021-06-27', '2021-06-21', '08:00:00', '09:00:00', '1', 1, '2021-06-22 22:23:56', 1, 1, 'http://www.google.com', NULL, NULL);
INSERT INTO `tbl_timetable` VALUES (2, '2021-06-21', '2021-06-27', '2021-06-21', '09:00:00', '10:00:00', '1', 2, '2021-06-22 22:25:47', 1, 1, 'http://www.google.com', NULL, NULL);
INSERT INTO `tbl_timetable` VALUES (3, '2021-06-21', '2021-06-27', '2021-06-22', '09:00:00', '10:00:00', '2', 2, '2021-06-22 22:25:47', 1, 1, 'http://www.google.com', NULL, NULL);
INSERT INTO `tbl_timetable` VALUES (4, '2021-06-21', '2021-06-27', '2021-06-22', '08:00:00', '12:00:00', '2', 1, '2021-06-22 22:23:56', 1, 1, 'http://www.google.com', NULL, NULL);

-- ----------------------------
-- Table structure for titles
-- ----------------------------
DROP TABLE IF EXISTS `titles`;
CREATE TABLE `titles`  (
  `title_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`title_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of titles
-- ----------------------------
INSERT INTO `titles` VALUES (1, 'Mr', NULL, NULL);
INSERT INTO `titles` VALUES (2, 'Miss', NULL, NULL);
INSERT INTO `titles` VALUES (3, 'Mrs', NULL, NULL);
INSERT INTO `titles` VALUES (4, 'Dr', NULL, NULL);
INSERT INTO `titles` VALUES (5, 'Assoc Prof', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pics` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no_pic.jpg',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `god_eye` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `title_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `chng_password_logon` tinyint(1) NULL DEFAULT NULL,
  `designation_id` int(5) NULL DEFAULT NULL,
  `branch_id` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_type` int(10) NULL DEFAULT NULL COMMENT '1- Student, 2- Staff',
  `created_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lecturer_biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `batch_no` int(10) NULL DEFAULT NULL,
  `nationality` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `state_of_origin` int(10) NULL DEFAULT NULL,
  `permanent_state_of_residence` int(10) NULL DEFAULT NULL,
  `current_state_of_residence` int(10) NULL DEFAULT NULL,
  `permanent_residence` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `current_residence` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `religion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_reset_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `email_reset_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `batch_no`(`batch_no`) USING BTREE,
  CONSTRAINT `batch_no` FOREIGN KEY (`batch_no`) REFERENCES `tbl_batch` (`batch_no`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Ese', 'Kelvin', 'Uvbiekpahor', 'esekelvin24@gmail.com', '2021-07-24 21:51:06', '$2y$10$EQfCJPWAztoqoylE63zjIuvyx9uSNPc.wnarqvMkc3F/wdR.hD37.', 'eseuvbiekpahor_7129554.jpg', '080', '0000-00-00', '1', '1', '1', '1', NULL, '2021-05-03 14:02:22', '2021-05-23 23:13:01', 1, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'Lecturer', '', 'One', 'ese.kelvin@dangoteprojects.com', '2021-07-24 21:51:02', '$2y$10$AnTYstsRXUc/S3mEeoR2legmCPy4u/5f87K8.7Guf4QjaI.1Y46D2', 'no_pic.jpg', '08097191027', '0000-00-00', '0', '1', '1', '1', '2NeS4nD0QgUF3ZZNzkCMnax04MXWxfb0dbDXCHA71YIlJT6xY9n1RgikIN8l', '2021-06-07 00:00:00', '2021-06-07 10:02:02', 1, 5, '1', 2, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (15, 'Michelle', '', 'Obiorah', 'officialmichelle12@yahoo.com', '2021-07-22 13:23:35', '$2y$10$FDCQc6dqYsQg8l2xHMbewO.MSXPfUyXwhLlwLn/jBvk4NO3P.pYYm', 'no_pic.jpg', '08135559646', '0000-00-00', '1', '1', '1', '1', 'khHhBPAQBr0fow7ciJOLM6VPO67WNokMTJPb7DHSTnn4lrYDJRoCfZqR2AMP', '2021-07-22 00:00:00', '2021-07-22 13:23:35', 1, 1, '1', 2, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (19, 'Bello', 'Usman', 'Kelvin', 'eseboy24@gmail.com', '2021-07-24 17:52:19', '$2y$10$7qcFIOWvfKVZ9LMxWzp8xuhQBsBof/Ea7XcBA6zU9PMWOMatHMAne', 'no_pic.jpg', '08097191027', '2021-07-22', '0', '1', '1', '1', 'gTRXBXuEstaqP1dSJbmeTOqwb3OrWY8Rb8CHl7ZqSwNO3W4r1u2zyG2sAlgb', '2021-07-24 00:00:00', '2021-07-25 22:00:40', 1, 4, '1', 1, NULL, NULL, 1, 'Nigeria', 1, 1, 2, 'Hi', 'Hi', 'Islam', '', '2021-07-25 22:00:00');
INSERT INTO `users` VALUES (20, 'michelle', 'ebuka', 'obiorah', 'officialmichelle12@gmail.com', '2021-07-24 18:01:15', '$2y$10$yYe/ynbFyxGT.w3Y.EUpluy4/IOjQqqDFLMJpx0yDoW2ku78DepnS', 'no_pic.jpg', '+2348135559646', '1991-12-22', '0', '1', '1', '1', 'GFk6P5wXxWsjVwe332iMan9USSXBWppaHj3W0ysjreZ0ZOzFu6mbCTIAbzPf', '2021-07-24 00:00:00', '2021-07-25 19:04:26', 1, 4, '1', 1, NULL, NULL, 1, 'nigerian', 19, 19, 19, 'No.96 Chiroma street', 'No.96 Chiroma street', 'Christianity', '', '2021-07-25 19:03:19');
INSERT INTO `users` VALUES (21, 'sarah', 'oyin', 'segun', 'sarahsegun288@gmail.com', '2021-07-24 18:38:42', '$2y$10$8S1ukpXPeGIDcTdxGAVAO.1Yk616cuVtiJoxYjWyXhi8IwiaO6RzS', 'no_pic.jpg', '08149221214', '0000-00-00', '0', '1', '2', '2', 'TmGXny41VC81NKYjH1Hz1ZKEKGFDCgjCnPDoVyotNeYwMXetfUrbhyxdSvuK', '2021-07-24 00:00:00', '2021-07-24 18:38:42', 1, 2, '1', 2, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users_permissions
-- ----------------------------
DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE `users_permissions`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `permission_id`) USING BTREE,
  INDEX `users_permissions_permission_id_foreign`(`permission_id`) USING BTREE,
  CONSTRAINT `users_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `users_permissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users_roles
-- ----------------------------
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `users_roles_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users_roles
-- ----------------------------
INSERT INTO `users_roles` VALUES (1, 1);
INSERT INTO `users_roles` VALUES (6, 7);
INSERT INTO `users_roles` VALUES (15, 1);
INSERT INTO `users_roles` VALUES (19, 6);
INSERT INTO `users_roles` VALUES (20, 6);
INSERT INTO `users_roles` VALUES (21, 7);

SET FOREIGN_KEY_CHECKS = 1;
