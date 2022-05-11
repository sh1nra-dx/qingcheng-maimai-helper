/**
 *  清城舞萌助手 数据库建模文件 - 用户系统
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

DROP TABLE IF EXISTS mai_user;
CREATE TABLE mai_user (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    role_id INT UNSIGNED NOT NULL DEFAULT 4,
    open_id VARCHAR(50) DEFAULT NULL,
    user_name VARCHAR(100) DEFAULT NULL,
    user_avatar TEXT DEFAULT NULL,
    user_login_email VARCHAR(100) DEFAULT NULL,
    user_login_pwd VARCHAR(255) DEFAULT NULL,
    user_qq_uim VARCHAR(50) DEFAULT NULL,
    user_create_time DATETIME NOT NULL,
    user_update_time DATETIME NOT NULL,
    user_delete_time INT DEFAULT NULL,
    PRIMARY KEY (user_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';

DROP TABLE IF EXISTS mai_user_role;
CREATE TABLE mai_user_role (
    role_id INT UNSIGNED NOT NULL,
    role_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (role_id)
) ENGINE = InnoDB DEFAULT CHARSET = 'utf8';
INSERT INTO mai_user_role (role_id, role_name) VALUES
(1, '系统管理员'),
(2, '资讯管理员'),
(3, '店铺审核员'),
(4, '普通用户');
