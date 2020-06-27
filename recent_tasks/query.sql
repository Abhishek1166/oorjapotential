ALTER TABLE `leads` ADD `requirement` BIGINT(20) NOT NULL COMMENT 'Product_ID | Category_ID' AFTER `email`, ADD `comment` LONGTEXT NOT NULL AFTER `requirement`, ADD `followup_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `comment`, ADD `status` INT(2) NOT NULL DEFAULT '0' COMMENT '0 - New | 11 - Not Interested | 12 - Interested | 13 - Convened | 14 - Not Convened | 3 - Delete ' AFTER `followup_date`, ADD `created_by` BIGINT NOT NULL AFTER `status`, ADD `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by`, ADD `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_date`, ADD `modified_by` BIGINT NOT NULL AFTER `modified_date`, ADD INDEX (`requirement`), ADD INDEX (`status`), ADD INDEX (`followup_date`), ADD INDEX (`created_date`);
ALTER TABLE `users` ADD `is_pinned` INT(1) NULL AFTER `followup_date`;

-- Categories Table
CREATE TABLE `base_dev`.`categories` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NULL , `parent_id` BIGINT(20) NULL , `image` TEXT NULL , `created_by` BIGINT(20) NULL , `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `modified_by` BIGINT(20) NULL , `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `status` INT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `categories` ADD `slug` VARCHAR(255) NULL AFTER `title`;

-- Filter Relations Table
CREATE TABLE `base_dev`.`filter_product_category_relations` ( `id` BIGINT NOT NULL AUTO_INCREMENT , `key_id` BIGINT NULL , `value_Id` BIGINT NULL , `product_id` BIGINT NULL , `category_id` BIGINT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Filter Key Table
CREATE TABLE `base_dev`.`filters` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `filter_title` VARCHAR(255) NULL , `created_by` BIGINT(20) NULL , `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `modified_by` BIGINT(20) NULL , `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `status` INT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Filter Value Table
CREATE TABLE `base_dev`.`filter_values` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `filter_value_title` VARCHAR(255) NULL , `status` INT(1) NULL DEFAULT '0' , `created_by` BIGINT(20) NULL , `created_date` TIMESTAMP NULL , `modified_by` BIGINT(20) NULL , `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- User Group Role Table
CREATE TABLE `base_dev`.`user_group_roles` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `group_role_id` bigint(20) NULL , `module_id` bigint(20) NULL , `action_key` varchar(255) NULL ,`status` TINYINT(2) NULL DEFAULT '0' , `created_by` BIGINT(20) NULL , `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `modified_by` BIGINT(20) NULL , `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

-- User Groups Table
CREATE TABLE `base_dev`.`user_groups` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
 `user_group` VARCHAR(255) NULL,`status` TINYINT(2) NULL DEFAULT '0' ,`created_by` BIGINT(20) NULL ,`created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,`modified_by` BIGINT(20) NULL ,`modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

-- User Modules Table
CREATE TABLE `base_dev`.`user_modules` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
 `module` VARCHAR(255) NULL ,`display_title` VARCHAR(255) NULL ,`status` TINYINT(2) NULL DEFAULT '0' ,`created_by` BIGINT(20) NULL ,`created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,`modified_by` BIGINT(20) NULL ,`modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

-- Testimonial
ALTER TABLE `testimonial` ADD `name` VARCHAR(255) NULL AFTER `modified_date`, ADD `comment` VARCHAR(255) NULL AFTER `name`, ADD `rating` VARCHAR(255) NULL AFTER `comment`;

INSERT INTO `user_modules` (`slug`, `module_title`,`status`, `created_by`)
 VALUES ('admin','Admin', '1', '1'),
 ('blog','Blog', '1', '1'),
 ('category','category', '1', '1'),
 ('filter','filter', '1', '1'),
 ('gallery','gallery', '1', '1'),
 ('lead', 'lead', '1', '1'),
 ('module','module', '1', '1'),
 ('page','page', '1', '1'),
 ('product','product', '1', '1'),
 ('project','project', '1', '1'),
 ('property','property', '1', '1'),
 ('slider','slider', '1', '1'),
 ('testimonial','testimonial', '1', '1'),
 ('user','user', '1', '1'),
 ('userrole','userrole', '1', '1');

 INSERT INTO `user_modules` (`id`, `slug`, `module_title`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES (NULL, 'comment', 'Comments', '1', '1', CURRENT_TIMESTAMP, '1', CURRENT_TIMESTAMP), (NULL, 'setting', 'Settings', '1', '1', CURRENT_TIMESTAMP, '1', CURRENT_TIMESTAMP);

 ALTER TABLE `users` CHANGE `user_type` `user_type` ENUM('ADMIN','SUBSCRIBER') NOT NULL DEFAULT 'SUBSCRIBER';

 INSERT INTO `user_modules` (`id`, `slug`, `module_title`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES (NULL, 'test', 'Testing', '0', NULL, CURRENT_TIMESTAMP, NULL, CURRENT_TIMESTAMP);

ALTER TABLE `products` ADD `post_type` ENUM('product','property','event') NULL AFTER `title`;

ALTER TABLE `filters` ADD `post_type` ENUM('product','property','event') NULL AFTER `filter_title`;

ALTER TABLE `products` DROP `type`;

ALTER TABLE `filters` CHANGE `type` `type` INT(1) NOT NULL DEFAULT '0' COMMENT '0 : Single | 1: Multiple';

DELETE FROM `filter_values` WHERE `filter_values`.`id` = 17;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 18;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 19;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 20;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 21;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 22;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 23;
DELETE FROM `filter_values` WHERE `filter_values`.`id` = 24;

ALTER TABLE `categories` ADD `post_type` ENUM('product','property','event') NULL AFTER `title`;

ALTER TABLE `products` ADD `category_id` BIGINT(20) NULL DEFAULT NULL AFTER `post_type`;
INSERT INTO `user_modules` (`id`, `slug`, `module_title`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES (NULL, 'order', 'Orders', '1', '1', CURRENT_TIMESTAMP, '1', CURRENT_TIMESTAMP);

CREATE TABLE `base_dev`.`orders` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `order_group_id` BIGINT(20) NULL , `user_id` BIGINT(20) NULL , `coupon_id` BIGINT(20) NULL , `product_id` BIGINT(20) NULL , `product_quantity` VARCHAR(255) NULL , `total_discount` VARCHAR(255) NULL COMMENT 'Total Offer & Discountable Price' , `total_addition` VARCHAR(255) NULL COMMENT 'Total Tax & Other Addable Price' , `total_amount` VARCHAR(255) NULL COMMENT 'Total Product Price' , `total_paid` VARCHAR(255) NULL COMMENT 'Calculated Price, To Be Paid ' , `product_received_date` TIMESTAMP NULL , `remark` TEXT NULL , `payment_mode` ENUM('online','cod') NULL , `payment_status` INT(2) NULL COMMENT '0: Unpaid | 1: Paid | 2: Return' , `delivery_status` INT(2) NULL COMMENT '0: New | 1: Delivered | 2: Processing | 3: Cancel | 4: Return' , `transaction_id` VARCHAR(255) NULL , `transaction_msg` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `orders` ADD `user_ip` VARCHAR(255) NULL AFTER `transaction_msg`, ADD `web_token_id` VARCHAR(255) NULL AFTER `user_ip`, ADD `app_token_id` VARCHAR(255) NULL AFTER `web_token_id`, ADD `device_type` VARCHAR(255) NULL AFTER `app_token_id`, ADD `browser` VARCHAR(255) NULL AFTER `device_type`, ADD `browser_version` VARCHAR(255) NULL AFTER `browser`, ADD `os` VARCHAR(255) NULL AFTER `browser_version`, ADD `mobile_device` VARCHAR(255) NULL AFTER `os`, ADD `created_by` BIGINT(20) NULL AFTER `mobile_device`, ADD `created_date` TIMESTAMP NULL AFTER `created_by`, ADD `modified_by` BIGINT(20) NULL AFTER `created_date`, ADD `modified_date` TIMESTAMP NULL AFTER `modified_by`;

ALTER TABLE `orders` ADD `status` INT(2) NULL DEFAULT '1' COMMENT '3 : DELETE & Always Status be 1' AFTER `delivery_status`;

ALTER TABLE `orders` CHANGE `total_discount` `total_discount` FLOAT(10,2) NULL DEFAULT '0' COMMENT 'Total Offer & Discountable Price', CHANGE `total_addition` `total_addition` FLOAT(10,2) NULL DEFAULT '0' COMMENT 'Total Tax & Other Addable Price', CHANGE `total_amount` `total_amount` FLOAT(10,2) NULL DEFAULT '0' COMMENT 'Total Product Price', CHANGE `total_paid` `total_paid` FLOAT(10,2) NULL DEFAULT '0' COMMENT 'Calculated Price, To Be Paid ', CHANGE `payment_status` `payment_status` TINYINT(2) NULL DEFAULT '0' COMMENT '0: Unpaid | 1: Paid | 2: Return', CHANGE `delivery_status` `delivery_status` TINYINT(2) NULL DEFAULT '0' COMMENT '0: New | 1: Delivered | 2: Processing | 3: Cancel | 4: Return';


ALTER TABLE `products` CHANGE `min_price` `regular_price` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT 'Mn Price', CHANGE `max_price` `sell_price` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT 'Max Price';

ALTER TABLE `orders` CHANGE `created_date` `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `modified_date` `modified_date` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `orders` CHANGE `order_group_id` `order_group_id` VARCHAR(255) NULL DEFAULT NULL;

SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

ALTER TABLE `products` CHANGE `avg_rate` `avg_rate` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0', CHANGE `rating_count` `rating_count` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0', CHANGE `total_sale` `total_sale` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0';