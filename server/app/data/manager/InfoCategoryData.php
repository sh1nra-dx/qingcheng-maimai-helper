<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\InfoCategoryModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 资讯分类数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class InfoCategoryData {

    /**
     *  获取分类列表
     * 
     *  @return array 分类列表数组封装
     */

    public static function getList(): array {
        $rawList = InfoCategoryModel::order('category_create_time', 'desc')->select();
        $categories = array();
        foreach ($rawList as $category) {
            $categories[] = array(
                'categoryId' => $category->category_id,
                'categoryName' => $category->category_name,
                'createTime' => $category->category_create_time,
            );
        }
        return array(
            'count' => count($categories),
            'categories' => $categories,
        );
    }

    /**
     *  添加分类
     * 
     *  @param array $entry 分类添加表单数组
     *  @return array 分类自增ID数组封装
     */

    public static function add(array $entry): array {
        $category = new InfoCategoryModel();
        $category->category_name = $entry['name'];
        $category->category_create_time = date('Y-m-d H:i:s');
        $category->category_update_time = date('Y-m-d H:i:s');
        $category->save();
        return array(
            'categoryId' => $category->category_id,
        );
    }

    /**
     *  更新分类
     * 
     *  @param int $categoryId 分类ID
     *  @param array $entry 分类更新表单数组
     *  @return void
     */

    public static function update(int $categoryId, array $entry): void {
        $category = InfoCategoryModel::where(array('category_id' => $categoryId,))->findOrEmpty();
        if ($category->isEmpty()) {
            throw new NotFoundException('未找到相应的资讯分类条目');
        }
        $category->category_name = $entry['name'];
        $category->category_update_time = date('Y-m-d H:i:s');
        $category->save();
    }

    /**
     *  删除分类
     * 
     *  @param int $categoryId 分类ID
     *  @return void
     */

    public static function delete(int $categoryId): void {
        $category = InfoCategoryModel::where(array('category_id' => $categoryId,))->findOrEmpty();
        if ($category->isEmpty()) {
            throw new NotFoundException('未找到相应的资讯分类条目');
        }
        $category->delete();
    }

}
