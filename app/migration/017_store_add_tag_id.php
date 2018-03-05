<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "ALTER TABLE `stores` ADD `store_tag_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Store Tag ID' AFTER `id`;",

    'down' => "ALTER TABLE `stores` DROP COLUMN `store_tags_id`;",

    'at' => "2018-03-05 19:33:49",
  );