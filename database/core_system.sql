/**
 *  清城舞萌助手 数据库建模文件 - 核心系统
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

DROP TABLE IF EXISTS mai_bot_whitelist;
CREATE TABLE mai_bot_whitelist (
    wl_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    wl_group_uim VARCHAR(50) NOT NULL,
    enable_maidx TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    enable_queue TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    wl_create_time DATETIME NOT NULL,
    wl_update_time DATETIME NOT NULL,
    wl_delete_time INT DEFAULT NULL,
    PRIMARY KEY (wl_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_sys_setting;
CREATE TABLE mai_sys_setting (
    id INT UNSIGNED NOT NULL,
    is_maintenance TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    auto_review TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';
INSERT INTO mai_sys_setting (id, is_maintenance, auto_review) VALUES
(1, 0, 0);
