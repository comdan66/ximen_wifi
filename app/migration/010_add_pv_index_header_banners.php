<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "CREATE TABLE `pv_index_header_banners` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `index_header_banners_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Index Header Banner ID',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;",
    
    'down' => "DROP TABLE `pv_index_header_banners`;",
    
    'at' => "2018-03-05 09:03:04",
  );