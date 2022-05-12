<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *  清城舞萌助手 后端接口应用 - 资讯模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class InfoModel extends Model {

    use SoftDelete;

    protected $name = 'info';

    protected $pk = 'post_id';

    protected $deleteTime = 'post_delete_time';

}
