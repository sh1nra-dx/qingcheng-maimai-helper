<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\ShopImageModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 店铺照片数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class ShopImageData {

    /**
     *  获取照片列表
     * 
     *  @param int $shopId 店铺ID
     *  @return array 照片列表数组封装
     */

    public static function getList(int $shopId): array {
        $rawList = ShopImageModel::alias('image')
            ->leftJoin('user', 'image.user_id = user.user_id')
            ->field('image.*, user.user_name')
            ->where(array(
                'image.shop_id' => $shopId,
            ))->order('image.image_create_time', 'desc')
            ->select();
        $images = array();
        foreach ($rawList as $image) {
            $images[] = array(
                'imageId' => $image->image_id,
                'userName' => $image->user_name,
                'source' => $image->image_source,
                'createTime' => $image->image_create_time,
            );
        }
        return array(
            'images' => $images,
        );
    }

    /**
     *  添加照片
     * 
     *  @param array $entry 照片添加表单数组
     *  @return array 照片自增ID数组封装
     */

    public static function add(array $entry): array {
        $image = new ShopImageModel();
        $image->shop_id = $entry['shop_id'];
        $image->user_id = $entry['user_id'];
        $image->image_source = $entry['source'];
        $image->image_review_flag = 1;
        $image->image_create_time = date('Y-m-d H:i:s');
        $image->save();
        return array(
            'imageId' => $image->image_id,
        );
    }

    /**
     *  删除照片
     * 
     *  @param int $imageId 照片ID
     *  @return void
     */

    public static function delete(int $imageId): void {
        $image = ShopImageModel::where(array('image_id' => $imageId,))->findOrEmpty();
        if ($image->isEmpty()) {
            throw new NotFoundException('未找到相应的照片条目');
        }
        $image->delete();
    }

}
