<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "ALTER TABLE `stores` ADD `sort` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '排列順序，上至下 DESC' AFTER `status`;",

    'down' => "ALTER TABLE `stores` DROP COLUMN `sort`;",

    'at' => "2018-03-05 16:34:39",
  );