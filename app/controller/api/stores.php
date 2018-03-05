<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class stores extends Controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index ($id = 0) {
    if (!(($id || $id = Input::get ('id')) && ($store = Store::find ('one', array ('where' => array ('id = ? AND status = ?', $id, Store::STATUS_ON))))))
      return Output::json ('找不到此資料！', 400);

    return Output::json (array (
        'id' => $store->id,
        'icon' => $store->icon->url (),
        'bg' => $store->bg->url (),
        'name' => $store->name,
        'open_time' => $store->open_time,
        'phone' => $store->phone,
        'address' => $store->address,
        'type' => $store->type,
        'money' => $store->money,
        'menu' => $store->menu,
        'content' => $store->content,
        'imgs' => array_map (function ($image) {
          return array (
              'ori' => $image->pic->url (),
              'min' => $image->pic->url ()
            );
        }, $store->images)
      ));
  }
}
