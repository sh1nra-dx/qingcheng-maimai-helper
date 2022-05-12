<?php
declare (strict_types = 1);

namespace app\common\middleware;

use think\Request;
use think\Response;
use \Closure;

/**
 *  清城舞萌助手 后端接口应用 - 接口跨域访问中间件定义
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\exception
 */

class CORSMiddleware {

    public function handle(Request $request, Closure $next) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Max-Age: 1800');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        if (strtoupper($request->method()) == 'OPTIONS') {
            return response()->send();
        }
        return $next($request);
    }

}
