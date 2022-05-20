<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\UserModel;
use app\exception\NotFoundException;
use app\exception\ForbiddenException;

/**
 *  清城舞萌助手 后端接口应用 - 管理端用户个人资料数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class ProfileData {

    /**
     *  获取个人资料
     * 
     *  @param int $userId 用户ID
     *  @return array 个人资料数组封装
     */

    public static function getInfo(int $userId): array {
        $user = UserModel::alias('user')
            ->leftJoin('user_role', 'user.role_id = user_role.role_id')
            ->field('user_role.role_name, user.*')
            ->where(array(
                'user.user_id' => $userId,
            ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        $response = array(
            'userId' => $user->user_id,
            'userName' => $user->user_name,
            'loginEmail' => $user->user_login_email,
            'avatar' => $user->user_avatar,
            'qqUim' => $user->user_qq_uim,
            'roleId' => $user->role_id,
            'roleName' => $user->role_name,
            'createTime' => $user->user_create_time,
        );
        return array(
            'user' => $response,
        );
    }

    /**
     *  更新个人资料
     * 
     *  @param int $userId 用户ID
     *  @param array $entry 个人资料更新表单数组
     *  @return void
     */

    public static function update(int $userId, array $entry): void {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        $user->user_name = $entry['user_name'];
        $user->user_qq_uim = $entry['qq_uim'];
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
    }

    /**
     *  更新登录邮箱
     * 
     *  @param int $userId 用户ID
     *  @param array $entry 登录邮箱更新表单数组
     *  @return array 邮箱验证码数组封装
     */

    public static function updateEmail(int $userId, array $entry): array {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        if ($user->user_login_email != $entry['email_old']) {
            throw new ForbiddenException('旧登录邮箱验证失败，请重新输入');
        }
        $user->user_login_email = $entry['email_new'];
        $user->user_email_hash = generateEmailHash();
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
        return array(
            'emailHash' => $user->user_email_hash,
        );
    }

    /**
     *  更新登录密码
     * 
     *  @param int $userId 用户ID
     *  @param array $entry 登录密码更新表单数组
     *  @return void
     */

    public static function updatePassword(int $userId, array $entry): void {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        if (!password_verify($entry['pwd_old'], $user->user_login_pwd)) {
            throw new ForbiddenException('旧密码验证失败，请重新输入');
        }
        $user->user_login_pwd = password_hash($entry['pwd_new'], PASSWORD_DEFAULT);
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
    }

}
