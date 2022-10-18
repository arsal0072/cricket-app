DROP TABLE IF EXISTS app_contents;

CREATE TABLE `app_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) unsigned NOT NULL,
  `platform` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS apps;

CREATE TABLE `apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_unique_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default/app.png',
  `notification_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onesignal_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `onesignal_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_server_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_topics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS fixures;

CREATE TABLE `fixures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_type_id` int(11) NOT NULL,
  `series_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_one_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_two_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_one_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_two_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS highlight_apps;

CREATE TABLE `highlight_apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) unsigned NOT NULL,
  `highlight_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS highlight_streaming_sources;

CREATE TABLE `highlight_streaming_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `highlight_id` bigint(20) unsigned NOT NULL,
  `stream_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resulation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci,
  `block_country` longtext COLLATE utf8mb4_unicode_ci,
  `is_block_them` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS highlights;

CREATE TABLE `highlights` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_type_id` bigint(20) unsigned NOT NULL,
  `match_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS live_match_apps;

CREATE TABLE `live_match_apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) unsigned NOT NULL,
  `match_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS live_matches;

CREATE TABLE `live_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_type_id` bigint(20) unsigned NOT NULL,
  `match_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_one_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_one_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_two_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_two_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apps` longtext COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS popular_series;

CREATE TABLE `popular_series` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS promotions;

CREATE TABLE `promotions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_type_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS sports_types;

CREATE TABLE `sports_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sports_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sports_skq` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS streaming_sources;

CREATE TABLE `streaming_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) unsigned NOT NULL,
  `stream_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resulation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stream_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci,
  `block_country` longtext COLLATE utf8mb4_unicode_ci,
  `is_block_them` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.png',
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','Admin','Admin','arsal@admin.com','admin','','$2y$10$CAwBOiutfbAneE4B0/YfA.CG9RxuGUnvXpEf5CNLfxn5g5VffBDwu','profile.png','1','','2021-07-03 21:28:53','2022-04-16 20:54:56');



