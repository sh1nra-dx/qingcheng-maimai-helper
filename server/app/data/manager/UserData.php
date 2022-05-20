<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\UserModel;
use app\model\UserRoleModel;
use app\exception\NotFoundException;
use app\exception\ForbiddenException;

/**
 *  清城舞萌助手 后端接口应用 - 管理端用户数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class UserData {

    public static function getList(int $roleId = 0): array {
        $query = UserModel::alias('user')
            ->leftJoin('user_role', 'user.role_id = user_role.role_id')
            ->field('user_role.role_name, user.user_id, user.user_name, user.user_login_email, user.user_create_time')
            ->order('user.user_create_time', 'desc');
        if ($roleId > 0) {
            $query->where(array('role_id' => $roleId));
        }
        $rawList = $query->select();
        $users = array();
        foreach ($rawList as $user) {
            $users[] = array(
                'userId' => $user->user_id,
                'userName' => $user->user_name,
                'roleName' => $user->role_name,
                'loginEmail' => $user->user_login_email,
                'createTime' => $user->user_create_time,
            );
        }
        return array(
            'count' => count($users),
            'users' => $users,
        );
    }

    public static function getInfo(int $userId): array {
        $user = UserModel::alias('user')
            ->leftJoin('user_role', 'user.role_id = user_role.role_id')
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
            'qqUim' => $user->user_qq_uim,
            'roleId' => $user->role_id,
            'roleName' => $user->role_name,
            'createTime' => $user->user_create_time,
        );
        return array(
            'user' => $response,
        );
    }

    public static function add(array $entry): array {
        $role = UserRoleModel::where(array(
            'role_id' => $entry['role_id'],
        ))->findOrEmpty();
        if ($role->isEmpty()) {
            throw new ForbiddenException('请输入正确的用户角色');
        }
        $user = new UserModel();
        $user->role_id = $entry['role_id'];
        $user->user_login_email = $entry['login_email'];
        $user->user_login_pwd = password_hash('12345678', PASSWORD_DEFAULT);
        $user->user_name = $entry['user_name'];
        $user->user_create_time = date('Y-m-d H:i:s');
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
        return array(
            'userId' => $user->user_id,
        );
    }

    public static function update(int $userId, array $entry): bool {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        $role = UserRoleModel::where(array(
            'role_id' => $user->role_id,
        ))->findOrEmpty();
        if ($role->isEmpty()) {
            throw new ForbiddenException('请输入正确的用户角色');
        }
        $user->role_id = $entry['role_id'];
        $user->user_name = $entry['user_name'];
        $user->user_login_email = $entry['login_email'];
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
        return true;
    }

    public static function updatePassword(int $userId, array $entry): bool {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        $user->user_login_pwd = password_hash($entry['pwd_new'], PASSWORD_DEFAULT);
        $user->user_update_time = date('Y-m-d H:i:s');
        $user->save();
        return true;
    }

    public static function delete(int $userId): bool {
        $user = UserModel::where(array(
            'user_id' => $userId,
        ))->findOrEmpty();
        if ($user->isEmpty()) {
            throw new NotFoundException('未找到相应的用户条目');
        }
        $user->delete();
        return true;
    }

}
