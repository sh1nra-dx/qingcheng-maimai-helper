/**
 *  清城舞萌助手 数据库建模文件 - 资讯系统
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

DROP TABLE IF EXISTS mai_info;
CREATE TABLE mai_info (
    post_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    post_title VARCHAR(200) NOT NULL,
    post_content TEXT DEFAULT NULL,
    post_draft_flag TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
    post_create_time DATETIME NOT NULL,
    post_delete_time INT DEFAULT NULL,
    PRIMARY KEY (post_id),
    INDEX (category_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_info_category;
CREATE TABLE mai_info_category (
    category_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    category_create_time DATETIME NOT NULL,
    category_update_time DATETIME NOT NULL,
    category_delete_time INT DEFAULT NULL,
    PRIMARY KEY (category_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_relation_info_category;
CREATE TABLE mai_relation_info_category (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    post_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    INDEX (post_id),
    INDEX (category_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';
