/**
 *  清城舞萌助手 数据库建模文件 - 游戏系统
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

DROP TABLE IF EXISTS mai_game;
CREATE TABLE mai_game (
    game_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    game_ch_name VARCHAR(100) NOT NULL,
    game_en_name VARCHAR(100) DEFAULT NULL,
    game_logo TEXT DEFAULT NULL,
    game_create_time DATETIME NOT NULL,
    game_update_time DATETIME NOT NULL,
    game_delete_time INT DEFAULT NULL,
    PRIMARY KEY (game_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_shop;
CREATE TABLE mai_shop (
    shop_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    shop_name VARCHAR(200) NOT NULL,
    shop_address TEXT NOT NULL,
    shop_location_fix TEXT DEFAULT NULL,
    shop_description TEXT DEFAULT NULL,
    shop_credit_price VARCHAR(20) DEFAULT NULL,
    shop_business_time VARCHAR(200) DEFAULT NULL,
    shop_remark TEXT DEFAULT NULL,
    shop_create_time DATETIME NOT NULL,
    shop_update_time DATETIME NOT NULL,
    shop_delete_time INT DEFAULT NULL,
    PRIMARY KEY (shop_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_shop_review;
CREATE TABLE mai_shop_review (
    review_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    shop_id INT UNSIGNED NOT NULL DEFAULT 0,
    user_id INT UNSIGNED NOT NULL,
    shop_name VARCHAR(200) DEFAULT NULL,
    shop_address TEXT DEFAULT NULL,
    shop_location_fix TEXT DEFAULT NULL,
    shop_description TEXT DEFAULT NULL,
    shop_credit_price VARCHAR(20) DEFAULT NULL,
    shop_business_time VARCHAR(200) DEFAULT NULL,
    shop_remark TEXT DEFAULT NULL,
    shop_delete_time INT DEFAULT NULL,
    shop_review_create_time DATETIME NOT NULL,
    shop_review_flag TINYINT(1) NOT NULL DEFAULT 0, -- 0=待审，1=通过，-1=不通过
    shop_review_remark TEXT DEFAULT NULL,
    shop_review_time DATETIME DEFAULT NULL,
    PRIMARY KEY (review_id),
    INDEX (shop_id),
    INDEX (user_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_shop_image;
CREATE TABLE mai_shop_image (
    image_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    shop_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    image_source TEXT NOT NULL,
    image_create_time DATETIME NOT NULL,
    image_review_flag TINYINT(1) NOT NULL DEFAULT 0, -- 0=待审，1=通过，-1=不通过
    image_review_remark TEXT DEFAULT NULL,
    image_review_time DATETIME DEFAULT NULL,
    image_delete_time INT DEFAULT NULL,
    PRIMARY KEY (image_id),
    INDEX (shop_id),
    INDEX (user_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_cabinet;
CREATE TABLE mai_cabinet (
    cab_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    game_id INT UNSIGNED NOT NULL,
    shop_id INT UNSIGNED NOT NULL,
    game_version VARCHAR(100) DEFAULT NULL,
    round_credit INT UNSIGNED DEFAULT NULL,
    cab_number INT UNSIGNED DEFAULT NULL,
    cab_remark TEXT DEFAULT NULL,
    cab_enable_player_count TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    cab_max_capacity INT UNSIGNED NOT NULL DEFAULT 0,
    cab_player_count INT UNSIGNED NOT NULL DEFAULT 0,
    cab_player_count_update_time DATETIME NOT NULL,
    cab_create_time DATETIME NOT NULL,
    cab_update_time DATETIME NOT NULL,
    cab_delete_time INT DEFAULT NULL,
    PRIMARY KEY (cab_id),
    INDEX (game_id),
    INDEX (shop_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_cabinet_review;
CREATE TABLE mai_cabinet_review (
    review_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    cab_id INT UNSIGNED NOT NULL DEFAULT 0,
    game_id INT UNSIGNED NOT NULL,
    shop_id INT UNSIGNED NOT NULL,
    game_version VARCHAR(100) DEFAULT NULL,
    round_credit INT UNSIGNED DEFAULT NULL,
    cab_number INT UNSIGNED DEFAULT NULL,
    cab_remark TEXT DEFAULT NULL,
    cab_delete_time INT DEFAULT NULL,
    cab_review_create_time DATETIME NOT NULL,
    cab_review_flag TINYINT(1) NOT NULL DEFAULT 0, -- 0=待审，1=通过，-1=不通过
    cab_review_remark TEXT DEFAULT NULL,
    cab_review_time DATETIME DEFAULT NULL,
    PRIMARY KEY (review_id),
    INDEX (cab_id),
    INDEX (game_id),
    INDEX (shop_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';
