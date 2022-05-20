<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\BotWhiteListModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - QQ Bot白名单数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class BotWhiteListData {

    /**
     *  获取白名单列表
     * 
     *  @return array 白名单列表数组封装
     */

    public static function get(): array {
        $rawList = BotWhiteListModel::order('wl_create_time', 'desc')->select();
        $whiteLists = array();
        foreach ($rawList as $wl) {
            $whiteLists[] = array(
                'wlId' => $wl->wl_id,
                'groupUim' => $wl->wl_group_uim,
                'maimaidx' => $wl->enable_maimaidx,
                'queue' => $wl->enable_queue,
                'laf' => $wl->enable_laf,
                'createTime' => $wl->wl_create_time,
            );
        }
        return array(
            'count' => count($whiteLists),
            'whiteLists' => $whiteLists,
        );
    }

    /**
     *  添加白名单条目
     * 
     *  @param array $entry 白名单添加表单数组
     *  @return array 白名单自增ID数组封装
     */

    public static function add(array $entry): array {
        $wl = new BotWhiteListModel();
        $wl->wl_group_uim = $entry['group_uim'];
        $wl->enable_maimaidx = $entry['enable_maimaidx'];
        $wl->enable_queue = $entry['enable_queue'];
        $wl->enable_laf = $entry['enable_laf'];
        $wl->wl_create_time = date('Y-m-d H:i:s');
        $wl->wl_update_time = date('Y-m-d H:i:s');
        $wl->save();
        return array(
            'wlId' => $wl->wl_id,
        );
    }

    /**
     *  更新白名单条目
     * 
     *  @param int $wlId 白名单ID
     *  @param array $entry 白名单更新表单数组
     *  @return void
     */

    public static function update(int $wlId, array $entry): void {
        $wl = BotWhiteListModel::where(array('wl_id' => $wlId,))->findOrEmpty();
        if ($wl->isEmpty()) {
            throw new NotFoundException('未找到相应的白名单条目');
        }
        $wl->enable_maimaidx = $entry['enable_maimaidx'];
        $wl->enable_queue = $entry['enable_queue'];
        $wl->enable_laf = $entry['enable_laf'];
        $wl->wl_update_time = date('Y-m-d H:i:s');
        $wl->save();
    }

    /**
     *  删除白名单条目
     * 
     *  @param int $wlId 白名单ID
     *  @return void
     */

    public static function delete(int $wlId): void {
        $wl = BotWhiteListModel::where(array('wl_id' => $wlId,))->findOrEmpty();
        if ($wl->isEmpty()) {
            throw new NotFoundException('未找到相应的白名单条目');
        }
        $wl->delete();
    }

}
