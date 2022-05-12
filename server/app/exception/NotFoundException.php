<?php
declare (strict_types = 1);

namespace app\common\exception;

use think\exception\HttpException;

/**
 *  清城舞萌助手 后端接口应用 - 资源不存在异常定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\exception
 */

class NotFoundException extends HttpException {

    public function __construct($message = '您所访问的资源不存在') {
        parent::__construct(404, $message);
    }

}
