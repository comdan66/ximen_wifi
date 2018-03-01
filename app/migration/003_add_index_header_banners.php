<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "CREATE TABLE `index_header_banners` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片',
        `click_cnt` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '點擊次數',
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
        `link` text COLLATE utf8_unicode_ci NOT NULL COMMENT '鏈結',
        `status` enum('on','off') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'off' COMMENT '狀態，啟用、停用',
        `sort` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '排列順序，上至下 DESC',
        `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    
    'down' => "DROP TABLE `index_header_banners`;",
    
    'at' => "2018-03-02 01:14:03",
  );