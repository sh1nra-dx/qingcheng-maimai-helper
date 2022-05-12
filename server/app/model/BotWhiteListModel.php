<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 *  清城舞萌助手 后端接口应用 - QQ机器人白名单模型定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\model
 */

class BotWhiteListModel extends Model {

    use SoftDelete;

    protected $name = 'bot_whitelist';

    protected $pk = 'wl_id';

    protected $deleteTime = 'wl_delete_time';

}
