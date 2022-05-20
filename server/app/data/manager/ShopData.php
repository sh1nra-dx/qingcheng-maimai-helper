<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\ShopModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 店铺数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class ShopData {

    /**
     *  获取店铺列表
     * 
     *  @return array 店铺列表数组封装
     */

    public static function getList(): array {
        $rawList = ShopModel::order('shop_create_time', 'desc')->select();
        $shops = array();
        foreach ($rawList as $shop) {
            $shops[] = array(
                'shopId' => $shop->shop_id,
                'shopName' => $shop->shop_name,
                'address' => $shop->shop_address,
                'businessTime' => $shop->shop_business_time,
                'createTime' => $shop->shop_create_time,
            );
        }
        return array(
            'count' => count($shops),
            'shops' => $shops,
        );
    }

    /**
     *  获取店铺信息
     * 
     *  @param int $shopId 店铺ID
     *  @return array 店铺信息数组封装
     */

    public static function getInfo(int $shopId): array {
        $shop = ShopModel::where(array('shop_id' => $shopId,))->findOrEmpty();
        if ($shop->isEmpty()) {
            throw new NotFoundException('未找到相应的店铺条目');
        }
        $response = array(
            'shopId' => $shop->shop_id,
            'shopName' => $shop->shop_name,
            'address' => $shop->shop_address,
            'locationFix' => $shop->shop_location_fix,
            'description' => $shop->shop_description,
            'creditPrice' => $shop->shop_credit_price,
            'businessTime' => $shop->shop_business_time,
            'remark' => $shop->shop_remark,
            'createTime' => $shop->shop_create_time,
        );
        return array(
            'shop' => $response,
        );
    }

    /**
     *  添加店铺
     * 
     *  @param array $entry 店铺添加表单数组
     *  @return array 店铺自增ID数组封装
     */

    public static function add(array $entry): array {
        $shop = new ShopModel();
        $shop->shop_name = $entry['shop_name'];
        $shop->shop_address = $entry['address'];
        $shop->shop_location_fix = $entry['location_fix'];
        $shop->shop_description = $entry['description'];
        $shop->shop_credit_price = $entry['credit_price'];
        $shop->shop_business_time = $entry['business_time'];
        $shop->shop_remark = $entry['remark'];
        $shop->shop_create_time = date('Y-m-d H:i:s');
        $shop->shop_update_time = date('Y-m-d H:i:s');
        $shop->save();
        return array(
            'shopId' => $shop->shop_id,
        );
    }

    /**
     *  更新店铺
     * 
     *  @param int $shopId 店铺ID
     *  @param array $entry 店铺更新表单数组
     *  @return void
     */

    public static function update(int $shopId, array $entry): void {
        $shop = ShopModel::where(array('shop_id' => $shopId,))->findOrEmpty();
        if ($shop->isEmpty()) {
            throw new NotFoundException('未找到相应的店铺条目');
        }
        $shop->shop_name = $entry['shop_name'];
        $shop->shop_address = $entry['address'];
        $shop->shop_location_fix = $entry['location_fix'];
        $shop->shop_description = $entry['description'];
        $shop->shop_credit_price = $entry['credit_price'];
        $shop->shop_business_time = $entry['business_time'];
        $shop->shop_remark = $entry['remark'];
        $shop->shop_update_time = date('Y-m-d H:i:s');
        $shop->save();
    }

    /**
     *  删除店铺
     * 
     *  @param int $shopId 店铺ID
     *  @return void
     */

    public static function delete(int $shopId): void {
        $shop = ShopModel::where(array('shop_id' => $shopId,))->findOrEmpty();
        if ($shop->isEmpty()) {
            throw new NotFoundException('未找到相应的店铺条目');
        }
        $shop->delete();
    }

}
