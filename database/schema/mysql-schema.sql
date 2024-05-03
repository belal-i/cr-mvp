/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_number` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nearby_public_transit` json DEFAULT NULL,
  `neighborhood` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nearby_points_of_interest` json DEFAULT NULL,
  `parking_rating` double(2,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `house_id` bigint unsigned DEFAULT NULL,
  `nearby_shops` json DEFAULT NULL,
  `distance_from_city_center_m` mediumint DEFAULT NULL,
  `compass_direction_from_city_center` enum('N','NE','E','SE','S','SW','W','NW') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `apartments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apartments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint unsigned DEFAULT NULL,
  `source_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_type` enum('APARTMENT','HOUSE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` json DEFAULT NULL,
  `number_of_rooms` double(5,2) DEFAULT NULL,
  `size_sq_m` smallint DEFAULT NULL,
  `is_furnished` tinyint(1) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `account_manager` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specials` json DEFAULT NULL,
  `rating` double(2,1) DEFAULT NULL,
  `story` tinyint DEFAULT NULL,
  `view` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flooring` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flooring_description` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flooring_material` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `living_room_description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `living_room_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `living_room_furniture` json DEFAULT NULL,
  `furnishing_description` json DEFAULT NULL,
  `furnishing_style` json DEFAULT NULL,
  `house_id` bigint unsigned NOT NULL,
  `number_of_bedrooms` tinyint DEFAULT NULL,
  `has_balcony` tinyint(1) DEFAULT NULL,
  `has_dish_washer` tinyint(1) DEFAULT NULL,
  `has_dryer` tinyint(1) DEFAULT NULL,
  `has_internet` tinyint(1) DEFAULT NULL,
  `has_parking_space` tinyint(1) DEFAULT NULL,
  `has_washing_machine` tinyint(1) DEFAULT NULL,
  `pets_ok` tinyint(1) DEFAULT NULL,
  `bathroom_description` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathroom_equipment` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathroom_furniture` json DEFAULT NULL,
  `bathroom_type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_television` tinyint(1) DEFAULT NULL,
  `kitchen_description` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_equipment` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_furniture` json DEFAULT NULL,
  `kitchen_situation` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen_type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luxury_items` json DEFAULT NULL,
  `television_size_inches` tinyint DEFAULT NULL,
  `windows` json DEFAULT NULL,
  `smoking_ok` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apartments_contact_id_foreign` (`contact_id`),
  KEY `apartments_house_id_foreign` (`house_id`),
  CONSTRAINT `apartments_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartments_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` json DEFAULT NULL,
  `phone` json DEFAULT NULL,
  `last_contact_date` date DEFAULT NULL,
  `last_contact_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_address_id_foreign` (`address_id`),
  CONSTRAINT `contacts_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `houses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `houses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_character` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_stories` tinyint DEFAULT NULL,
  `year_of_construction` smallint DEFAULT NULL,
  `year_of_last_renovation` year DEFAULT NULL,
  `energy_rating_type` enum('ENERGY_CONSUMPTION','ENERGY_REQUIRED','NO_INFORMATION') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `energy_source` enum('ACID_GAS','BIO_ENERGY','COMBINED_HEAT_AND_POWER_FOSSIL_FUELS','COMBINED_HEAT_AND_POWER_PLANT','COMBINED_HEAT_AND_POWER_RENEWABLE_ENERGY','DISTRICT_HEATING','ELECTRICITY','ENVIRONMENTAL_THERMAL_ENERGY','GAS','GAS_HEATING','HEAT_PUMP','HEAT_SUPPLY','LOCAL_HEATING','NATURAL_GAS_LIGHT','NO_INFORMATION','OIL','OIL_HEATING','SOLAR_HEATING','SOUR_GAS','STEAM_DISTRICT_HEATING','WOOD','WOOD_PELLET_HEATING') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `energy_usage_value` double(4,1) DEFAULT NULL,
  `energy_consumption_contains_warm_water` tinyint(1) DEFAULT NULL,
  `energy_certificate_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_id` bigint unsigned NOT NULL,
  `has_dryer` tinyint(1) DEFAULT NULL,
  `has_elevator` tinyint(1) DEFAULT NULL,
  `has_washing_machine` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `houses_address_id_foreign` (`address_id`),
  CONSTRAINT `houses_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint unsigned DEFAULT NULL,
  `apartment_id` bigint unsigned NOT NULL,
  `source_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `min_months` smallint DEFAULT NULL,
  `max_months` smallint DEFAULT NULL,
  `number_of_persons` tinyint DEFAULT NULL,
  `rent` int DEFAULT NULL,
  `security_deposit_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_deposit` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` json DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `last_changed_by` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_last_changed` date DEFAULT NULL,
  `time_last_changed` time DEFAULT NULL,
  `status` enum('FREE','NOT_FREE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NOT_FREE',
  `publish_on_immoscout` tinyint(1) DEFAULT NULL,
  `va_was_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_premium` tinyint(1) DEFAULT NULL,
  `utility_cost_included` tinyint(1) DEFAULT NULL,
  `electricity_cost_included` tinyint(1) DEFAULT NULL,
  `heating_cost_included` tinyint(1) DEFAULT NULL,
  `gas_cost_included` tinyint(1) DEFAULT NULL,
  `water_cost_included` tinyint(1) DEFAULT NULL,
  `internet_cost_included` tinyint(1) DEFAULT NULL,
  `cleaning_cost_included` tinyint(1) DEFAULT NULL,
  `utility_cost_amount` double(5,2) DEFAULT NULL,
  `electricity_cost_amount` double(5,2) DEFAULT NULL,
  `heating_cost_amount` double(5,2) DEFAULT NULL,
  `gas_cost_amount` double(5,2) DEFAULT NULL,
  `water_cost_amount` double(5,2) DEFAULT NULL,
  `internet_cost_amount` double(5,2) DEFAULT NULL,
  `cleaning_cost_amount` double(5,1) DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_contact_id_foreign` (`contact_id`),
  KEY `offers_apartment_id_foreign` (`apartment_id`),
  CONSTRAINT `offers_apartment_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `offers_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2023_10_06_094732_create_contacts_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2023_10_06_094804_create_apartments_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2023_10_06_094818_create_offers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2023_10_06_150514_fix_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2023_10_06_150949_fix_offers',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_10_06_151351_fix_contacts',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2023_12_02_124327_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2023_12_02_181253_update_offers',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2024_02_08_171157_create_addresses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2024_02_08_172816_update_contacts',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2024_02_08_172822_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2024_02_21_175959_create_houses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2024_02_22_102533_drop_house_columns_in_table_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2024_02_22_141443_foreign_ids_for_new_table_houses',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2024_03_22_143201_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2024_04_02_152536_update_houses',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2024_04_02_152548_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2024_04_04_165331_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2024_04_06_090011_update_addresses',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2024_04_06_101607_update_addresses',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2024_04_06_144535_update_apartments',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2024_04_08_165648_update_apartments_and_offers',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2024_04_13_141215_update_offers_feature_963',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2024_04_25_172025_update_offers_feature_1195',1);
