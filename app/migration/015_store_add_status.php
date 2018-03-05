<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

return array (
    'up' => "ALTER TABLE `stores` ADD `status` enum('on','off') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'off' COMMENT '狀態，啟用、停用' AFTER `click_cnt`;",

    'down' => "ALTER TABLE `stores` DROP COLUMN `status`;",

    'at' => "2018-03-05 16:34:39",
  );