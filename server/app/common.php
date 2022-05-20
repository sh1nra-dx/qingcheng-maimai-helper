<?php
declare (strict_types = 1);

/**
 *  清城舞萌助手 后端接口应用 - 公共函数库
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 */

/**
 *  创建邮箱验证码
 * 
 *  @return string 长度6位的验证码
 */

function generateEmailHash(): string {
    return strtoupper(substr(md5(uniqid((string) rand(), true)), 0, 6));
}
