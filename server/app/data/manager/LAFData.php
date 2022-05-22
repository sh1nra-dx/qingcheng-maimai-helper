<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\LAFModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 失物招领数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class LAFData {

    /**
     *  获取失物招领列表
     * 
     *  @return array 失物招领列表数组封装
     */

    public static function getList(): array {
        $rawList = LAFModel::alias('laf')
            ->leftJoin('user', 'laf.user_id = user.user_id')
            ->field('user.user_name, laf.laf_id, laf.laf_type, laf.laf_status, laf.laf_title, laf.laf_create_time')
            ->order('laf.laf_create_time', 'desc')
            ->select();
        $lafs = array();
        foreach ($rawList as $laf) {
            $lafs[] = array(
                'lafId' => $laf->laf_id,
                'userName' => $laf->user_name,
                'type' => $laf->laf_type,
                'status' => $laf->laf_status,
                'title' => $laf->laf_title,
                'createTime' => $laf->laf_create_time,
            );
        }
        return array(
            'count' => count($lafs),
            'lafs' => $lafs,
        );
    }

    /**
     *  获取失物招领信息
     * 
     *  @param int $lafId 失物招领ID
     *  @return array 失物招领信息数组封装
     */

    public static function getInfo(int $lafId): array {
        $laf = LAFModel::alias('laf')
            ->leftJoin('user', 'laf.user_id = user.user_id')
            ->field('user.user_name, user.user_avatar, laf.*')
            ->where(array(
                'laf.laf_id' => $lafId,
            ))->findOrEmpty();
        if ($laf->isEmpty()) {
            throw new NotFoundException('未找到相应的失物招领条目');
        }
        $response = array(
            'lafId' => $laf->laf_id,
            'userId' => $laf->user_id,
            'userName' => $laf->user_name,
            'avatar' => $laf->user_avatar,
            'type' => $laf->laf_type,
            'status' => $laf->laf_status,
            'time' => $laf->laf_time,
            'place' => $laf->laf_place,
            'title' => $laf->laf_title,
            'description' => $laf->laf_description,
            'photos' => $laf->laf_photo_array,
            'contactMethod' => $laf->laf_contact_method,
            'createTime' => $laf->laf_create_time,
        );
        return array(
            'laf' => $response,
        );
    }

    /**
     *  切换完成状态
     * 
     *  @param int $lafId 失物招领ID
     *  @return void
     */

    public static function toggleStatus(int $lafId): void {
        $laf = LAFModel::where(array('laf_id' => $lafId,))->findOrEmpty();
        if ($laf->isEmpty()) {
            throw new NotFoundException('未找到相应的失物招领条目');
        }
        $laf->laf_status = ($laf->laf_status) ? 0 : 1;
        $laf->save();
    }

    /**
     *  删除失物招领信息
     * 
     *  @param int $lafId 失物招领ID
     *  @return void
     */

    public static function delete(int $lafId): void {
        $laf = LAFModel::where(array('laf_id' => $lafId,))->findOrEmpty();
        if ($laf->isEmpty()) {
            throw new NotFoundException('未找到相应的失物招领条目');
        }
        $laf->delete();
    }

}
