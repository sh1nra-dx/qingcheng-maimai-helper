<?php
declare (strict_types = 1);

namespace app\common\exception;

use think\exception\HttpException;

/**
 *  清城舞萌助手 后端接口应用 - 用户未鉴权异常定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\exception
 */

class UnauthorizedException extends HttpException {

    public function __construct($message = '会话已过期或您未登录，请登录后访问此内容') {
        parent::__construct(401, $message);
    }

}
