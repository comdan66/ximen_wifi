<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "CREATE TABLE `starts` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片',
        `click_cnt` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '點擊次數',
        `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",

    'down' => "DROP TABLE `starts`;",

    'at' => "2018-03-02 00:43:07",
  );