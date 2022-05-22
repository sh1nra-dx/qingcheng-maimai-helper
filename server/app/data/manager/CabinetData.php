<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\CabinetModel;
use app\exception\NotFoundException;
use app\exception\ForbiddenException;

/**
 *  清城舞萌助手 后端接口应用 - 机台数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class CabinetData {

    /**
     *  获取机台列表
     * 
     *  @param int $shopId 店铺ID
     *  @return array 机台列表数组封装
     */

    public static function getList(int $shopId): array {
        $rawList = CabinetModel::alias('cab')
            ->leftJoin('game', 'cab.game_id = game.game_id')
            ->order('cab.cab_create_time', 'desc')
            ->field('game.game_ch_name, cab.cab_id, cab.game_version, cab.cab_number, cab.round_credit, cab.cab_enable_player_count, cab.cab_create_time')
            ->where(array(
                'cab.shop_id' => $shopId,
            ))->select();
        $cabs = array();
        foreach ($rawList as $cab) {
            $cabs[] = array(
                'cabId' => $cab->cab_id,
                'gameName' => $cab->game_ch_name,
                'gameVersion' => $cab->game_version,
                'number' => $cab->cab_number,
                'credit' => $cab->round_credit,
                'enablePlayerCount' => $cab->cab_enable_player_count,
                'createTime' => $cab->cab_create_time,
            );
        }
        return array(
            'count' => count($cabs),
            'cabs' => $cabs,
        );
    }

    /**
     *  获取机台信息
     * 
     *  @param int $cabId 机台ID
     *  @return array 机台信息数组封装
     */

    public static function getInfo(int $cabId): array {
        $cab = CabinetModel::alias('cab')
            ->leftJoin('game', 'cab.game_id = game.game_id')
            ->field('cab.*, game.game_ch_name, game.game_en_name, game.game_logo')
            ->where(array(
                'cab.cab_id' => $cabId,
            ))->findOrEmpty();
        if ($cab->isEmpty()) {
            throw new NotFoundException('未找到相应的机台条目');
        }
        $response = array(
            'cabId' => $cab->cab_id,
            'chName' => $cab->game_ch_name,
            'enName' => $cab->game_en_name,
            'logo' => $cab->game_logo,
            'version' => $cab->game_version,
            'credit' => $cab->round_credit,
            'number' => $cab->cab_number,
            'remark' => $cab->cab_remark,
            'enablePlayerCount' => $cab->cab_enable_player_count,
            'maxCapacity' => $cab->cab_max_capacity,
            'createTime' => $cab->cab_create_time,
        );
        return array(
            'cab' => $response,
        );
    }

    /**
     *  添加机台
     * 
     *  @param array $entry 机台添加表单数组
     *  @return array 机台自增ID数组封装
     */

    public static function add(array $entry): array {
        $cab = new CabinetModel();
        $cab->game_id = $entry['game_id'];
        $cab->shop_id = $entry['shop_id'];
        $cab->game_version = $entry['version'];
        $cab->round_credit = $entry['credit'];
        $cab->cab_number = $entry['number'];
        $cab->cab_remark = $entry['remark'];
        $cab->cab_create_time = date('Y-m-d H:i:s');
        $cab->cab_update_time = date('Y-m-d H:i:s');
        $cab->save();
        return array(
            'cabId' => $cab->cab_id,
        );
    }

    /**
     *  更新机台
     * 
     *  @param int $cabId 机台ID
     *  @param array $entry 机台更新表单数组
     *  @return void
     */

    public static function update(int $cabId, array $entry): void {
        $cab = CabinetModel::where(array('cab_id' => $cabId,))->findOrEmpty();
        if ($cab->isEmpty()) {
            throw new NotFoundException('未找到相应的机台条目');
        }
        $cab->game_version = $entry['version'];
        $cab->round_credit = $entry['credit'];
        $cab->cab_number = $entry['number'];
        $cab->cab_remark = $entry['remark'];
        $cab->cab_enable_player_count = $entry['enable_player_count'];
        $cab->cab_max_capacity = $entry['max_capacity'];
        $cab->cab_update_time = date('Y-m-d H:i:s');
        $cab->save();
    }

    /**
     *  删除机台
     * 
     *  @param int $cabId 机台ID
     *  @return void
     */

    public static function delete(int $cabId): void {
        $cab = CabinetModel::where(array('cab_id' => $cabId,))->findOrEmpty();
        if ($cab->isEmpty()) {
            throw new NotFoundException('未找到相应的机台条目');
        }
        $cab->delete();
    }

}
