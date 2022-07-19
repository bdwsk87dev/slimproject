CREATE DATABASE `gmb` /*!40100 DEFAULT CHARACTER SET utf8 */;


USE `gmb`;


CREATE TABLE `gmb`.`location_categories` (
  `lc_code` varchar(100) NOT NULL,
  `lc_name_en` varchar(100) NOT NULL,
  `lc_name_uk` varchar(100) NOT NULL,
  `lc_name_ru` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gmb`.`accounts` (
  `a_id` varchar(21) NOT NULL,
  `a_name` varchar(30) NOT NULL,
  `a_title` varchar(100) NOT NULL,
  `a_number` varchar(10) NOT NULL,
  `a_type` varchar(100) NOT NULL,
  `a_verification_state` varchar(100) NOT NULL,
  `a_vetted_state` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`a_id`),
  KEY `i__a_name` (`a_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gmb`.`locations` (
  `l_id` varchar(20) NOT NULL,
  `f_account_id` varchar(21) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `l_name_full` varchar(61) NOT NULL,
  `l_title` varchar(100) NOT NULL DEFAULT '',
  `l_description` mediumtext,
  `f_status_id` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `l_lang_code` char(2) DEFAULT '',
  `l_store_code` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `l_website_url` varchar(255) DEFAULT '',
  `l_labels` varchar(255) DEFAULT '',
  `f_office_status_id` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `l_categories` mediumtext,
  `l_regular_hours` mediumtext,
  `l_phone` mediumtext,
  `l_lat_lng` varchar(100) DEFAULT '',
  `f_country_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `f_region_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `f_city_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `l_address` mediumtext,
  `l_metadata` mediumtext,
  `l_logo` varchar(150) DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`l_id`),
  KEY `i__f_account_id` (`f_account_id`),
  KEY `i__f_status_id` (`f_status_id`),
  KEY `i__f_office_status_id` (`f_office_status_id`),
  KEY `i__f_country_id` (`f_country_id`),
  KEY `i__f_region_id` (`f_region_id`),
  KEY `i__city_id` (`f_city_id`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`f_account_id`) REFERENCES `accounts` (`a_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_countries` (
  `lc_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `lc_code` char(2) NOT NULL,
  `lc_name_en` varchar(30) DEFAULT '',
  `lc_name_uk` varchar(30) DEFAULT '',
  `lc_name_ru` varchar(30) DEFAULT '',
  `lc_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lc_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lc_id`),
  KEY `i__lc_code` (`lc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_regions` (
  `lr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `f_country_id` tinyint(3) unsigned NOT NULL,
  `lr_name_en` varchar(30) DEFAULT '',
  `lr_name_uk` varchar(30) DEFAULT '',
  `lr_name_ru` varchar(30) DEFAULT '',
  `lr_name_translit` varchar(30) DEFAULT '',
  `lr_name_en_ru` varchar(30) DEFAULT '',
  `lr_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lr_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lr_id`),
  KEY `i__f_country_id` (`f_country_id`),
  CONSTRAINT `location_regions_ibfk_1` FOREIGN KEY (`f_country_id`) REFERENCES `location_countries` (`lc_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_cities` (
  `lc_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `f_country_id` tinyint(3) unsigned NOT NULL,
  `f_region_id` smallint(5) unsigned DEFAULT '0',
  `lc_name` varchar(100) NOT NULL,
  `lc_name_en` varchar(100) DEFAULT '',
  `lc_name_uk` varchar(100) DEFAULT '',
  `lc_name_ru` varchar(100) DEFAULT '',
  `lc_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lc_id`),
  UNIQUE KEY `i__city_unique` (`f_country_id`,`f_region_id`,`lc_name`),
  KEY `i__f_country_id` (`f_country_id`),
  KEY `i__f_region_id` (`f_region_id`),
  CONSTRAINT `location_cities_ibfk_1` FOREIGN KEY (`f_region_id`) REFERENCES `location_regions` (`lr_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_statuses` (
  `ls_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `ls_code` varchar(20) NOT NULL,
  `ls_name_en` varchar(30) DEFAULT '',
  `ls_name_uk` varchar(30) DEFAULT '',
  `ls_name_ru` varchar(30) DEFAULT '',
  `ls_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_office_statuses` (
  `los_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `los_code` varchar(20) NOT NULL,
  `los_name_en` varchar(30) DEFAULT '',
  `los_name_uk` varchar(30) DEFAULT '',
  `los_name_ru` varchar(30) DEFAULT '',
  `los_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`los_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`location_changes` (
  `lch_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `f_location_id` varchar(21) NOT NULL,
  `f_location_name` varchar(61) NOT NULL,
  `f_user_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `f_user_ip` varbinary(16) NOT NULL,
  `lch_type` enum('insert','update','delete') DEFAULT NULL,
  `lch_data` text,
  `lch_is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gmb`.`reviews` (
  `r_id` varchar(100) NOT NULL,
  `f_account_id` varchar(21) NOT NULL,
  `f_location_id` varchar(21) NOT NULL,
  `r_name` varchar(161) NOT NULL,
  `r_comment` text,
  `r_star_rating` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `r_time_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `r_time_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `r_reviewer_photo` mediumtext,
  `r_reviewer_name` varchar(100) DEFAULT '',
  `r_comment_reply` text,
  `r_time_reply` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`r_id`),
  KEY `i__f_location_id` (`f_location_id`),
  KEY `i__f_account_id` (`f_account_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`f_location_id`) REFERENCES `locations` (`l_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`review_changes` (
  `rch_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `f_review_id` varchar(100) NOT NULL,
  `f_review_name` varchar(161) NOT NULL,
  `f_user_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `f_user_ip` varbinary(16) NOT NULL,
  `rch_type` enum('update','delete') DEFAULT NULL,
  `rch_data` text,
  `rch_is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gmb`.`media_files` (
  `mf_id` varchar(100) NOT NULL,
  `f_account_id` varchar(21) NOT NULL,
  `f_location_id` varchar(21) NOT NULL,
  `mf_name` varchar(150) NOT NULL,
  `mf_description` mediumtext,
  `mf_type` varchar(10) DEFAULT '',
  `mf_format` varchar(25) DEFAULT '',
  `mf_category` varchar(30) DEFAULT '',
  `mf_google_url` varchar(150) DEFAULT '',
  `mf_thumbnail_url` varchar(150) DEFAULT '',
  `mf_time_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mf_dimensions` mediumtext,
  `mf_view_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mf_customer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mf_id`),
  KEY `i__f_location_id` (`f_location_id`),
  KEY `i__f_account_id` (`f_account_id`),
  CONSTRAINT `media_files_ibfk_1` FOREIGN KEY (`f_location_id`) REFERENCES `locations` (`l_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`media_file_changes` (
  `mfch_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `f_media_file_id` varchar(100) NOT NULL,
  `f_media_file_name` varchar(150) NOT NULL,
  `f_user_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `f_user_ip` varbinary(16) NOT NULL,
  `mfch_type` enum('insert','update','delete') DEFAULT NULL,
  `mfch_data` text,
  `mfch_is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mfch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gmb`.`users` (
  `u_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_first_name` varchar(100) NOT NULL,
  `u_last_name` varchar(100) NOT NULL,
  `u_middle_name` varchar(100) DEFAULT '',
  `u_phone` varchar(50) DEFAULT '',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `i__u_email` (`u_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`user_level` (
  `ul_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ul_type` varchar(20) NOT NULL,
  `ul_name_en` varchar(100) NOT NULL,
  `ul_name_uk` varchar(100) NOT NULL,
  `ul_name_ru` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gmb`.`user_log` (
  `ul_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ul_user_id` smallint(5) unsigned NOT NULL,
  `ul_type` varchar(20) NOT NULL,
  `ul_table` varchar(100) NOT NULL,
  `ul_field_id` varchar(100) NOT NULL,
  `ul_description` varchar(100) NOT NULL,
  `ul_prev_data` text,
  `ul_new_data` text,
  `ul_ip_address` varbinary(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
