<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "CREATE TABLE `stores` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '圖示',
        `bg` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '封面',
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '名稱',
        `open_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '營業時間',
        `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '電話',
        `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
        `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '飲食類型',
        `money` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '荷包情況',
        `menu` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '推薦菜單',
        `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家描述',
        `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    
    'down' => "DROP TABLE `stores`;",
    
    'at' => "2018-03-02 09:00:53",
  );