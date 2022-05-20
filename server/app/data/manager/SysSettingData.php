<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\SysSettingModel;

/**
 *  清城舞萌助手 后端接口应用 - 系统设置数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class SysSettingData {

    /**
     *  获取设置项
     * 
     *  @return array 设置项数组封装
     */

    public static function get(): array {
        $setting = SysSettingModel::where(array('id' => 1,))->find();
        return array(
            'setting' => array(
                'isMaintenance' => $setting->is_maintenance,
                'autoReview' => $setting->auto_review,
            ),
        );
    }

    /**
     *  更新设置项
     * 
     *  @param array $entry 设置项表单数组
     *  @return void
     */

    public static function update(array $entry): void {
        $setting = SysSettingModel::where(array('id' => 1,))->find();
        $setting->is_maintenance = $entry['is_maintenance'];
        $setting->auto_review = $entry['auto_review'];
        $setting->save();
    }

}
