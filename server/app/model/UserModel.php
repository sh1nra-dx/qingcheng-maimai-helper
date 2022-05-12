<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *  清城舞萌助手 后端接口应用 - 用户模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class UserModel extends Model {

    use SoftDelete;

    protected $name = 'user';

    protected $pk = 'user_id';

    protected $deleteTime = 'user_delete_time';

}
