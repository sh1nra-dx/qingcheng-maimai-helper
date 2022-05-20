<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\Softdelete;

/**
 *  清城舞萌助手 后端接口应用 - 失物招领信息模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class LAFModel extends Model {

    use SoftDelete;

    protected $name = 'laf';

    protected $pk = 'laf_id';

    protected $deleteTime = 'laf_delete_time';

}
