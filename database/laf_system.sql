/**
 *  清城舞萌助手 数据库建模文件 - 失物招领系统
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

DROP TABLE IF EXISTS mai_laf;
CREATE TABLE mai_laf (
    laf_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    laf_type TINYINT(1) UNSIGNED NOT NULL DEFAULT 1, -- 1=寻物，2=领物
    laf_status TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    laf_time TEXT NOT NULL,
    laf_place TEXT NOT NULL,
    laf_description TEXT NOT NULL,
    laf_photo_array TEXT DEFAULT NULL,
    laf_contact_method TEXT NOT NULL,
    laf_create_time DATETIME NOT NULL,
    laf_update_time DATETIME NOT NULL,
    laf_delete_time INT DEFAULT NULL,
    PRIMARY KEY (laf_id),
    INDEX (user_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';
