<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Store extends Model {
  static $table_name = 'stores';

  static $has_one = array (
  );

  static $has_many = array (
    array ('images',  'class_name' => 'StoreImage'),
  );

  static $belongs_to = array (
  );

  const STATUS_ON  = 'on';
  const STATUS_OFF = 'off';

  static $statusTexts = array (
    self::STATUS_ON  => '啟用',
    self::STATUS_OFF => '停用',
  );

  public function __construct ($attrs = array (), $guardAttrs = true, $instantiatingViafind = false, $newRecord = true) {
    parent::__construct ($attrs, $guardAttrs, $instantiatingViafind, $newRecord);

    // 設定圖片上傳器
    Uploader::bind ('icon', 'StoreIconImageUploader');
    Uploader::bind ('bg', 'StoreBgImageUploader');
  }

  public function destroy () {
    if (!isset ($this->id))
      return false;
    
    return $this->delete ();
  }

  public function putFiles ($files) {
    foreach ($files as $key => $file)
      if (isset ($files[$key]) && $files[$key] && isset ($this->$key) && $this->$key instanceof Uploader && !$this->$key->put ($files[$key]))
        return false;
    return true;
  }
  public function min_column ($column, $length = 100) {
    if (!isset ($this->$column))
      return '';

    return $length ? mb_strimwidth (remove_ckedit_tag ($this->$column), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->$column);
  }
}

/* -- 圖片上傳器物件 ------------------------------------------------------------------ */
class StoreIconImageUploader extends ImageUploader {
  public function getVersions () {
    return array (
        '' => array (),
        'w100' => array ('resize', 100, 100, 'width'),
      );
  }
}
class StoreBgImageUploader extends ImageUploader {
  public function d4Url () {
    return '/assets/img/dtl-top-bg.jpg';
  }
  public function getVersions () {
    return array (
        '' => array (),
      );
  }
}
