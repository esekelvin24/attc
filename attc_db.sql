/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : attc_db

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 03/06/2021 21:48:35
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
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `permissions` VALUES (27, 'Map Course to Lecturer', 'map-course-to-lecturer', NULL, NULL, NULL);
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
INSERT INTO `roles` VALUES (7, 'instructor', 'instructor', '2021-05-26 15:52:29', '2021-05-26 15:52:29', 'Staff of ATTC');

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
INSERT INTO `roles_permissions` VALUES (7, 23);
INSERT INTO `roles_permissions` VALUES (7, 24);
INSERT INTO `roles_permissions` VALUES (7, 25);
INSERT INTO `roles_permissions` VALUES (7, 26);

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
INSERT INTO `tbl_accommodation` VALUES (2, 'Amen Estate', '<p>Steeped in a tradition of excellence, Amen Estate is on a completely new plane of quality, taste and splendor in the Nigerian Real Estate sector. Located in Ibeju-Lekki axis of Lekki Peninsula, in Lagos, Amen Estate has set a high benchmark for comfort and convenience in Nigerian Master planned communities.</p>', NULL, NULL, NULL, NULL, NULL, 1, 1, '2-1.jpg;2-2.jpg;2-3.jpg;2-4.jpg');

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
  PRIMARY KEY (`application_id`, `course_id`) USING BTREE,
  INDEX `course_id`(`course_id`) USING BTREE,
  CONSTRAINT `application_id` FOREIGN KEY (`application_id`) REFERENCES `tbl_applications` (`application_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `tbl_courses` (`course_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_application_courses
-- ----------------------------
INSERT INTO `tbl_application_courses` VALUES (22, 1, 154000.00, 4, '2021-06-02 09:55:12');
INSERT INTO `tbl_application_courses` VALUES (22, 2, 346000.00, 4, '2021-06-02 09:55:12');
INSERT INTO `tbl_application_courses` VALUES (22, 5, 20000.00, 4, '2021-06-02 09:55:12');
INSERT INTO `tbl_application_courses` VALUES (23, 5, 20000.00, 4, '2021-06-03 09:29:20');

-- ----------------------------
-- Table structure for tbl_application_documents
-- ----------------------------
DROP TABLE IF EXISTS `tbl_application_documents`;
CREATE TABLE `tbl_application_documents`  (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_application_documents
-- ----------------------------
INSERT INTO `tbl_application_documents` VALUES (1, 'Academic Qualification');
INSERT INTO `tbl_application_documents` VALUES (2, 'Working Experience');
INSERT INTO `tbl_application_documents` VALUES (3, 'Offer Letter');
INSERT INTO `tbl_application_documents` VALUES (4, 'Acceptance Letter');
INSERT INTO `tbl_application_documents` VALUES (5, 'Completed Acceptance Letter');

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
INSERT INTO `tbl_application_documents_upload` VALUES (22, 1, 'eseboy24@gmail.com-3Ojx2GlYkS.pdf', '2021-06-02 09:55:12', '2021-06-02 09:55:12');
INSERT INTO `tbl_application_documents_upload` VALUES (23, 1, 'eseboy24@gmail.com-1yLFXN5VJC.pdf', '2021-06-03 09:29:20', '2021-06-03 09:29:20');
INSERT INTO `tbl_application_documents_upload` VALUES (23, 3, 'Offer_Letter_ATTC-0001-23.pdf', '2021-06-03 09:29:53', '2021-06-03 09:29:53');
INSERT INTO `tbl_application_documents_upload` VALUES (23, 4, 'Acceptance_Letter_ATTC-0001-23.pdf', '2021-06-03 09:29:53', '2021-06-03 09:29:53');
INSERT INTO `tbl_application_documents_upload` VALUES (23, 5, 'Completed_Offer_ATTC-0001-23.pdf', '2021-06-03 13:00:06', '2021-06-03 13:00:06');

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
  `payment_status` int(10) NULL DEFAULT 0 COMMENT '0 - Pending, 1- Successful, 2 - Failed',
  `accept_offer` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`application_id`) USING BTREE,
  INDEX `programme_id_new`(`programme_id`) USING BTREE,
  INDEX `academic_qualification`(`academic_qualification`) USING BTREE,
  CONSTRAINT `academic_qualification` FOREIGN KEY (`academic_qualification`) REFERENCES `tbl_qualifications` (`qualification_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `programme_id_new` FOREIGN KEY (`programme_id`) REFERENCES `tbl_programmes` (`programme_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_applications
-- ----------------------------
INSERT INTO `tbl_applications` VALUES (22, 1, 4, 1, 1, 1, '2021-06-02 10:36:37', 1, NULL, NULL, NULL, NULL, '2021-06-02 10:36:37', '2021-06-02 09:55:12', 1, 1);
INSERT INTO `tbl_applications` VALUES (23, 1, 4, 1, NULL, 2, '2021-06-03 14:46:09', 1, 'Nothing to say', NULL, NULL, NULL, '2021-06-03 14:46:09', '2021-06-03 09:29:20', 0, 0);

-- ----------------------------
-- Table structure for tbl_batch
-- ----------------------------
DROP TABLE IF EXISTS `tbl_batch`;
CREATE TABLE `tbl_batch`  (
  `batch_no` int(10) NOT NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`batch_no`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_batch
-- ----------------------------
INSERT INTO `tbl_batch` VALUES (1, 1, '2021-05-26 12:48:23', 1);

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
  `status` int(1) NULL DEFAULT 1 COMMENT '1- Active, 2 - Deactive',
  `disp_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `programme_id`(`programme_id`) USING BTREE,
  CONSTRAINT `created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `programme_id` FOREIGN KEY (`programme_id`) REFERENCES `tbl_programmes` (`programme_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_courses
-- ----------------------------
INSERT INTO `tbl_courses` VALUES (1, 'SMAW (Shielded Metal Arc Welding)', 'ATTC001', 4, 'Week(s)', 154000.00, '<p>Upon successful completion of this unit, the apprentice will be able to:</p>\r\n<ul>\r\n<li>Set‐up and maintain an arc.</li>\r\n<li>Deposit a weld bead.</li>\r\n<li>demonstrate knowledge of fillet weld mild steel in all positions using the SMAW process.</li>\r\n<li>perform visual inspection of welds.</li>\r\n</ul>', '<ol>\r\n<li>Define the terminology associated with arc welding.</li>\r\n</ol>\r\n<ul>\r\n<li>Mild steel and low alloy steel electrodes</li>\r\n<li>AC (Alternating Current)</li>\r\n<li>DC (Direct Current) (polarity)</li>\r\n<li>Arc Blow</li>\r\n<li>duty cycle</li>\r\n<li>rated amperage</li>\r\n</ul>\r\n<ol start=\"2\">\r\n<li>Describe the SMAW process.</li>\r\n</ol>\r\n<ul>\r\n<li>General precautions</li>\r\n<li>Equipment and accessories</li>\r\n<li>Personal protective equipment</li>\r\n<li>Ground clamps</li>\r\n<li>Terminal lugs</li>\r\n<li>Electrode holders</li>\r\n<li>Cable connectors</li>\r\n<li>Cables</li>\r\n<li>Electrodes</li>\r\n<li>Codes and standards</li>\r\n</ul>\r\n<ol start=\"3\">\r\n<li>Describe the characteristics and applications of different power sources.</li>\r\n</ol>\r\n<ul>\r\n<li>AC transformers</li>\r\n<li>AC/DC rectifiers</li>\r\n<li>DC generators</li>\r\n<li>Engine drive (gasoline, diesel)</li>\r\n<li>Inverters</li>\r\n</ul>\r\n<ol start=\"4\">\r\n<li>Describe the set‐up and maintenance of welding equipment used in the SMAW process.</li>\r\n<li>Describe the procedures used to strike and maintain an electric arc.</li>\r\n<li>Describe the procedures and techniques used to deposit a weld bead.</li>\r\n</ol>\r\n<ul>\r\n<li>stringer</li>\r\n<li>weave</li>\r\n<li>arc length</li>\r\n<li>travel speed</li>\r\n<li>work and travel angles</li>\r\n<li>visual inspection</li>\r\n</ul>\r\n<ol start=\"7\">\r\n<li>Identify types of joints and their characteristics.</li>\r\n</ol>\r\n<ul>\r\n<li>tee</li>\r\n<li>lap</li>\r\n<li>corner</li>\r\n</ul>\r\n<ol start=\"8\">\r\n<li>Identify types of fillet welds and describe their applications.</li>\r\n</ol>\r\n<ul>\r\n<li>tack</li>\r\n<li>composite</li>\r\n<li>single‐pass</li>\r\n<li>multi‐pass</li>\r\n<li>plug</li>\r\n<li>slot</li>\r\n</ul>\r\n<ol start=\"9\">\r\n<li>Describe the procedures used to fillet weld on mild steel in all positions.</li>\r\n</ol>\r\n<ul>\r\n<li>identify position</li>\r\n<li>limitations</li>\r\n<li>identify material</li>\r\n<li>determine thickness of material</li>\r\n<li>determine fillet size</li>\r\n<li>select electrode</li>\r\n<li>select current</li>\r\n<li>Describe the procedures used to test welds.</li>\r\n<li>Destructive</li>\r\n<li>non‐destructive (visual inspection)</li>\r\n<li>Describe weld faults and their causes.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>PRACTICAL:</strong></p>\r\n<p>Practical skills enhance the student&rsquo;s ability to meet the objectives of this course.</p>\r\n<ul>\r\n<li>Perform welds on tee lap and corner joint, In all positions.</li>\r\n</ul>', NULL, NULL, NULL, 1, 'CRASH COURSE FOR BEGINNERS IN SMAW', 1, '1.jpg');
INSERT INTO `tbl_courses` VALUES (2, 'SMAW (Shielded Metal Arc Welding) Groove Weld on plate', 'ATTC005', 8, 'Week(s)', 346000.00, '<p>Upon successful completion of this course, the apprentice will be able to:</p>\r\n<ul>\r\n<li>groove weld on mild steel using the SMAW process with electrodes.</li>\r\n<li>perform weld tests.</li>\r\n<li>Describe the process to weld on medium and high‐carbon steel in all positions using the SMAW process.</li>\r\n</ul>', '<ol>\r\n<li>Identify and describe the weld positions.\r\n<ul>\r\n<li>1‐G</li>\r\n<li>2‐G</li>\r\n<li>3-G</li>\r\n<li>4-G</li>\r\n</ul>\r\n</li>\r\n<li>Describe the procedures used to perform groove welds in the 1G, 2G, 3G, and 4G positions.\r\n<ul>\r\n<li>joint design</li>\r\n<li>inspection and testing</li>\r\n<li>electrode angles</li>\r\n<li>electrode manipulation</li>\r\n<li>amperage adjustment</li>\r\n<li>identify position and limitations</li>\r\n<li>identify material</li>\r\n<li>determine thickness of material</li>\r\n<li>select electrode</li>\r\n<li>select current</li>\r\n<li>penetration</li>\r\n</ul>\r\n</li>\r\n<li>Describe the procedures used to test welds.\r\n<ul>\r\n<li>codes and standards</li>\r\n</ul>\r\n</li>\r\n<li>Describe all types of weld faults.</li>\r\n<li>Describe the SMAW process as it applies to welding medium and high‐carbon steel.\r\n<ul>\r\n<li>general precautions</li>\r\n<li>characteristics of materials</li>\r\n<li>weldability of materials</li>\r\n<li>welding procedures</li>\r\n</ul>\r\n</li>\r\n<li>Describe weld faults with medium and high carbon steel.</li>\r\n</ol>\r\n<p><strong>Practical:</strong></p>\r\n<p>Practical skills enhance the apprentices&rsquo; ability to meet the objectives of this course. The learning objectives outlined below are mandatory.</p>\r\n<ul>\r\n<li>\r\n<ul>\r\n<li>Weld groove butt joints on 3/8&rdquo; mild steel plate in 1G, 2G, 3G, and 4G positions using F3 and F4 electrodes.</li>\r\n<li>Perform weld tests.</li>\r\n</ul>\r\n</li>\r\n</ul>', NULL, NULL, NULL, 1, 'BASIC WELDING COURSE SMAW', 1, '2.jpg');
INSERT INTO `tbl_courses` VALUES (3, 'MAW (Shielded Metal Arc Welding) groove weld on pipe', 'ATTC009', 4, 'Day(s)', 399000.00, NULL, NULL, NULL, NULL, NULL, 1, '6G/6GR CERTIFICATION COURSE IN SWAW', 1, '3.jpg');
INSERT INTO `tbl_courses` VALUES (4, 'SMAW (Shielded Metal Arc Welding) groove weld on pipe', 'ATTC011', 1, 'Week(s)', 192000.00, NULL, NULL, NULL, NULL, NULL, 1, 'REFRESH COURSE ON MMAW POSITIONAL PIPE WELDING FOR PRACTISING WELDING', 1, '4.jpg');
INSERT INTO `tbl_courses` VALUES (5, 'REFRESH COURSE IN SMAW FOR PRACTICE ON 3G/4G POSITION', 'ATTC015', 1, 'Day(s)', 20000.00, NULL, NULL, NULL, NULL, NULL, 1, 'REFRESH COURSE IN MMAW FOR PRACTISING WELDING (3G/4G POSITION)', 1, '5.jpg');
INSERT INTO `tbl_courses` VALUES (6, 'GMAW (Gas Metal Arc Welding)', 'ATTC002', 4, 'Week(s)', 158000.00, NULL, NULL, NULL, NULL, NULL, 2, 'CRASH COURSE FOR BEGINNERS IN SMAW', 1, '6.jpg');
INSERT INTO `tbl_courses` VALUES (7, 'GMAW (Gas Metal Arc Welding, FCAW) -groove welding on plate', 'ATTC006', 4, 'Week(s)', 198000.00, NULL, NULL, NULL, NULL, NULL, 2, 'BASIC WELDING COURSE IN GMAW PROCESS (SOLID & FLUX CURE)', 1, '7.jpg');
INSERT INTO `tbl_courses` VALUES (8, 'GMAW (Gas Metal Arc Welding) – Pipe And Tubing, All Positions', 'ATTC017', NULL, NULL, 128000.00, NULL, NULL, NULL, NULL, NULL, 2, 'TBD', 1, '8.jpg');

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
-- Records of tbl_courses_instructors
-- ----------------------------
INSERT INTO `tbl_courses_instructors` VALUES (1, 4, 1, '2021-05-16 15:22:01');
INSERT INTO `tbl_courses_instructors` VALUES (1, 5, 1, '2021-05-16 15:40:00');

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_event
-- ----------------------------
INSERT INTO `tbl_event` VALUES (4, 'Total Gas Training Exhibition', 'Total V.I Office', '2021-06-02', '10:00:00', '12:00:00', 'no_image.jpg', '2021-05-17 21:35:23', 1, 1, '<h4>Teaching Welding in the Virtual World</h4>\r\n<p>Welding instructors that are struggling to teach in today&rsquo;s virtual environment, there are few experts helping them figure out how to teach welding this new way and they need help.</p>\r\n<p>The Education/Workforce Development Conference has been held over a 5 year period at FABTECH. The conferences have always been geared towards welding instructors and providing essential information and products that can be transcended into the classroom. This Workshop is intended to provide welding instructors with tools and examples of how to teach welding in a virtual environment.</p>', 1, NULL);
INSERT INTO `tbl_event` VALUES (5, 'Welding School Junior Student Competition', 'Dangote Refinery JETTI', '2021-05-31', '09:00:00', '16:30:00', '5.png', '2021-05-17 21:39:52', 1, 1, '<h4>Teaching Welding in the Virtual World</h4>\r\n<p>Welding instructors that are struggling to teach in today&rsquo;s virtual environment, there are few experts helping them figure out how to teach welding this new way and they need help.</p>\r\n<p>The Education/Workforce Development Conference has been held over a 5 year period at FABTECH. The conferences have always been geared towards welding instructors and providing essential information and products that can be transcended into the classroom. This Workshop is intended to provide welding instructors with tools and examples of how to teach welding in a virtual environment.</p>', 1, NULL);

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
INSERT INTO `tbl_main_tab` VALUES (10, 'Master Manager', 'icon-drawer', 'view-master-manager');
INSERT INTO `tbl_main_tab` VALUES (30, 'System Settings', 'fa fa-gear', 'view-settings');

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
) ENGINE = MyISAM AUTO_INCREMENT = 63 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_payments
-- ----------------------------
INSERT INTO `tbl_payments` VALUES (60, 4, 520000, 22, 1, NULL, '2021-06-03 11:17:43', 'success', NULL, 2, NULL, NULL);
INSERT INTO `tbl_payments` VALUES (61, 4, 20000, 23, 1, NULL, '2021-06-03 13:00:22', '', NULL, 2, NULL, NULL);
INSERT INTO `tbl_payments` VALUES (62, 4, 20000, 23, 1, NULL, '2021-06-03 13:13:01', '', NULL, 2, 1, '2021-06-03 14:05:39');

-- ----------------------------
-- Table structure for tbl_programmes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_programmes`;
CREATE TABLE `tbl_programmes`  (
  `programme_id` int(11) NOT NULL,
  `programme_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1 COMMENT '1 - Active 2 - Deactivated',
  `disp_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`programme_id`) USING BTREE,
  INDEX `created_by_new`(`created_by`) USING BTREE,
  CONSTRAINT `created_by_new` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_programmes
-- ----------------------------
INSERT INTO `tbl_programmes` VALUES (1, 'SMAW – SHIELDED METAL ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '1.jpg');
INSERT INTO `tbl_programmes` VALUES (2, 'GMAW – GAS METAL ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '2.jpg');
INSERT INTO `tbl_programmes` VALUES (3, 'FCAW – FLUX CORED ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '3.jpg');
INSERT INTO `tbl_programmes` VALUES (4, 'GTAW – GAS TUNGSTEN ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '4.jpg');
INSERT INTO `tbl_programmes` VALUES (5, 'SMAW+GTAW – (SHIELDED METAL ARC WELDING+GAS TUNGSTEN ARC WELDING)', 1, '2021-05-12 20:48:02', NULL, 1, '5.jpg');
INSERT INTO `tbl_programmes` VALUES (6, 'SAW – SUBMERGED ARC WELDING', 1, '2021-05-12 20:48:02', NULL, 1, '6.jpg');
INSERT INTO `tbl_programmes` VALUES (7, 'OXY FUEL GAS WELDING AND CUTTING', 1, '2021-05-12 20:48:02', NULL, 1, '7.jpg');
INSERT INTO `tbl_programmes` VALUES (8, 'PLASMA ARC CUTTING AND GOUGING', 1, '2021-05-12 20:48:02', NULL, 1, '8.jpg');
INSERT INTO `tbl_programmes` VALUES (9, 'RIGGING AND SCAFFOLDING', 1, '2021-05-12 20:48:02', NULL, 1, '9.jpg');
INSERT INTO `tbl_programmes` VALUES (10, 'GRINDING SKILLS', 1, '2021-05-12 20:48:02', NULL, 1, '10.jpg');
INSERT INTO `tbl_programmes` VALUES (11, 'REFRESH COURSE FOR MAINTENANCE ENGINEERS', 1, '2021-05-12 20:48:02', NULL, 1, '11.jpg');
INSERT INTO `tbl_programmes` VALUES (12, 'METALLURGY, EXPANSION AND CONTRACTION CONTROL', 1, '2021-05-12 20:48:02', NULL, 1, '12.jpg');

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
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `tbl_sub_tab` VALUES (38, 2, 'Courses List', 'courses_list', 'view-all-course-list');
INSERT INTO `tbl_sub_tab` VALUES (39, 2, 'Map Course to Lecturer', 'map_course_to_lecturer', 'map-course-to-lecturer');
INSERT INTO `tbl_sub_tab` VALUES (40, 2, 'Assigned Courses', 'assigned_courses', 'view-assigned-courses');
INSERT INTO `tbl_sub_tab` VALUES (41, 3, 'Take C.A', 'take_ca', 'view-take-ca');
INSERT INTO `tbl_sub_tab` VALUES (42, 3, 'My Certificate', 'my_certificate', 'view-certificate');

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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `batch_no`(`batch_no`) USING BTREE,
  CONSTRAINT `batch_no` FOREIGN KEY (`batch_no`) REFERENCES `tbl_batch` (`batch_no`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Ese', 'Kelvin', 'Uvbiekpahor', 'esekelvin24@gmail.com', NULL, '$2y$10$EQfCJPWAztoqoylE63zjIuvyx9uSNPc.wnarqvMkc3F/wdR.hD37.', 'eseuvbiekpahor_7129554.jpg', '080', '0000-00-00', '0', '1', '1', '1', NULL, '2021-05-03 14:02:22', '2021-05-23 23:13:01', 1, 1, NULL, 2, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'System', 'K', 'Support', 'attc@gmail.com', NULL, '$2y$10$XsVRDKbzG9sWihM/4DJ2i.FYpL3t79qWKZSYTlvoXqlUEBZUeVRKa', 'no_pic.jpg', '08097191027', '0000-00-00', '0', '1', '1', '1', NULL, '2021-05-03 14:02:22', '2021-05-05 20:14:01', NULL, 0, NULL, 2, NULL, NULL, 1);
INSERT INTO `users` VALUES (4, 'Student', 'Ese', 'Kelvin', 'eseboy24@gmail.com', NULL, '$2y$10$EQfCJPWAztoqoylE63zjIuvyx9uSNPc.wnarqvMkc3F/wdR.hD37.', 'studentkelvin_1844511.jpg', '080', '0000-00-00', '0', '1', '1', '1', 'iBEV3UH2PybrpemxKlf5GRugzgED6N2ygZigHCAUPDZYOkqoEi0pz6hJFwFQ', '2021-05-10 00:00:00', '2021-05-26 14:38:06', 1, 5, NULL, 1, '1', 'I am expert in gas wedding ', 1);

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
INSERT INTO `users_roles` VALUES (2, 2);
INSERT INTO `users_roles` VALUES (4, 5);

SET FOREIGN_KEY_CHECKS = 1;