<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 *  清城舞萌助手 后端接口应用 - 店铺审核模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class ShopReviewModel extends Model {

    protected $name = 'shop_review';

    protected $pk = 'review_id';

}
