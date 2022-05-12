<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *  清城舞萌助手 后端接口应用 - 资讯分类模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class InfoCategoryModel extends Model {

    use SoftDelete;

    protected $name = 'info_category';

    protected $pk = 'category_id';

    protected $deleteTime = 'category_delete_time';

}
