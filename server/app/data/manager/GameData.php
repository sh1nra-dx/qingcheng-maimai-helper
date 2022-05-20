<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\GameModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 游戏数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class GameData {

    /**
     *  获取游戏列表
     * 
     *  @return array 游戏列表数组封装
     */

    public static function getList(): array {
        $rawList = GameModel::order('game_create_time', 'desc')->select();
        $games = array();
        foreach ($rawList as $game) {
            $games[] = array(
                'gameId' => $game->game_id,
                'gameName' => $game->game_ch_name,
                'createTime' => $game->game_create_time,
            );
        }
        return array(
            'count' => count($games),
            'games' => $games,
        );
    }

    /**
     *  获取游戏信息
     * 
     *  @param int $gameId 游戏ID
     *  @return array 游戏信息数组封装
     */

    public static function getInfo(int $gameId): array {
        $game = GameModel::where(array('game_id' => $gameId,))->findOrEmpty();
        if ($game->isEmpty()) {
            throw new NotFoundException('未找到相应的游戏条目');
        }
        $response = array(
            'gameId' => $game->game_id,
            'chName' => $game->game_ch_name,
            'enName' => $game->game_en_name,
            'logo' => $game->game_logo,
            'createTime' => $game->game_create_time,
        );
        return array(
            'game' => $response,
        );
    }

    /**
     *  添加游戏
     * 
     *  @param array $entry 游戏添加表单数组
     *  @return array 游戏自增ID数组封装
     */

    public static function add(array $entry): array {
        $game = new GameModel();
        $game->game_ch_name = $entry['ch_name'];
        $game->game_en_name = $entry['en_name'];
        $game->game_logo = $entry['logo'];
        $game->game_create_time = date('Y-m-d H:i:s');
        $game->game_update_time = date('Y-m-d H:i:s');
        $game->save();
        return array(
            'gameId' => $game->game_id,
        );
    }

    /**
     *  更新游戏
     * 
     *  @param int $gameId 游戏ID
     *  @param array $entry 游戏更新表单数组
     *  @return void
     */

    public static function update(int $gameId, array $entry): void {
        $game = GameModel::where(array('game_id' => $gameId,))->findOrEmpty();
        if ($game->isEmpty()) {
            throw new NotFoundException('未找到相应的游戏条目');
        }
        $game->game_ch_name = $entry['ch_name'];
        $game->game_en_name = $entry['en_name'];
        $game->game_logo = $entry['logo'];
        $game->game_update_time = date('Y-m-d H:i:s');
        $game->save();
    }

    /**
     *  删除游戏
     * 
     *  @param int $gameId 游戏ID
     *  @return void
     */

    public static function delete(int $gameId): void {
        $game = GameModel::where(array('game_id' => $gameId,))->findOrEmpty();
        if ($game->isEmpty()) {
            throw new NotFoundException('未找到相应的游戏条目');
        }
        $game->delete();
    }

}
