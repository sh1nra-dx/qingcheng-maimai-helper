<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *  清城舞萌助手 后端接口应用 - 机台模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class CabinetModel extends Model {

    use SoftDelete;

    protected $name = 'cabinet';

    protected $pk = 'cab_id';

    protected $deleteTime = 'cab_delete_time';

}
