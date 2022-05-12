<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 *  清城舞萌助手 后端接口应用 - 用户角色模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class UserRoleModel extends Model {

    protected $name = 'user_role';

    protected $pk = 'role_id';

}
