<?php
declare (strict_types = 1);

namespace app\data\manager;

use app\model\InfoModel;
use app\exception\NotFoundException;

/**
 *  清城舞萌助手 后端接口应用 - 资讯数据操作封装
 *
 *  @author 3.80GHz (X-buster) <shinra.dx@outlook.com>
 *  @copyright 2022 3.80GHz (X-buster)
 *  @license MIT
 *  @package app\data\manager
 */

class InfoData {

    /**
     *  获取文章列表
     * 
     *  @return array 文章列表数组封装
     */

    public static function getList(): array {
        $rawList = InfoModel::alias('info')
            ->leftJoin('info_category', 'info.category_id = info_category.category_id')
            ->order('info.post_create_time', 'desc')
            ->field('info_category.category_name, info.post_id, info.post_title, info.post_draft_flag, info.post_create_time')
            ->select();
        $posts = array();
        foreach ($rawList as $post) {
            $posts[] = array(
                'postId' => $post->post_id,
                'title' => $post->post_title,
                'category' => $post->category_name,
                'draftFlag' => $post->post_draft_flag,
                'createTime' => $post->post_create_time,
            );
        }
        return array(
            'count' => count($posts),
            'posts' => $posts,
        );
    }

    /**
     *  获取文章信息
     * 
     *  @param int $postId 文章ID
     *  @return array 文章信息数组封装
     */

    public static function getInfo(int $postId): array {
        $post = InfoModel::where(array('post_id' => $postId,))->findOrEmpty();
        if ($post->isEmpty()) {
            throw new NotFoundException('未找到对应的文章条目');
        }
        $response = array(
            'postId' => $post->post_id,
            'categoryId' => $post->category_id,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'draftFlag' => $post->post_draft_flag,
            'createTime' => $post->post_create_time,
        );
        return array(
            'post' => $response,
        );
    }

    /**
     *  添加文章
     * 
     *  @param array $entry 文章添加表单数组
     *  @return array 文章自增ID数组封装
     */

    public static function add(array $entry): array {
        $post = new InfoModel();
        $post->category_id = $entry['category_id'];
        $post->post_title = $entry['title'];
        $post->post_content = $entry['content'];
        $post->post_draft_flag = 1;
        $post->post_create_time = date('Y-m-d H:i:s');
        $post->post_update_time = date('Y-m-d H:i:s');
        $post->save();
        return array(
            'postId' => $post->post_id,
        );
    }

    /**
     *  更新文章
     * 
     *  @param int $postId 文章ID
     *  @param array $entry 文章更新表单数组
     *  @return void
     */

    public static function update(int $postId, array $entry): void {
        $post = InfoModel::where(array('post_id' => $postId,))->findOrEmpty();
        if ($post->isEmpty()) {
            throw new NotFoundException('未找到对应的文章条目');
        }
        $post->category_id = $entry['category_id'];
        $post->post_title = $entry['title'];
        $post->post_content = $entry['content'];
        $post->post_update_time = date('Y-m-d H:i:s');
        $post->save();
    }

    /**
     *  切换文章草稿标记
     * 
     *  @param int $postId 文章ID
     *  @return void
     */

    public static function toggleDraft(int $postId): void {
        $post = InfoModel::where(array('post_id' => $postId,))->findOrEmpty();
        if ($post->isEmpty()) {
            throw new NotFoundException('未找到对应的文章条目');
        }
        $post->post_draft_flag = ($post->post_draft_flag === 1) ? 0 : 1;
        $post->save();
    }

    /**
     *  删除文章
     * 
     *  @param int $postId 文章ID
     *  @return void
     */

    public static function delete(int $postId): void {
        $post = InfoModel::where(array('post_id' => $postId,))->findOrEmpty();
        if ($post->isEmpty()) {
            throw new NotFoundException('未找到对应的文章条目');
        }
        $post->delete();
    }

}
