<?php
declare (strict_types = 1);

namespace app\common\exception;

use think\exception\HttpException;

/**
 *  清城舞萌助手 后端接口应用 - 无效请求异常定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\exception
 */

class BadRequestException extends HttpException {

    public function __construct($message = '无效的请求') {
        parent::__construct(400, $message);
    }

}
