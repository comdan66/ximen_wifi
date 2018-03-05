<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class stores extends AdminRestfulController {

  public function __construct () {
    parent::__construct ();
    $this->layout->with ('title', '商家列表')
                 ->with ('current_url', RestfulUrl::url ('admin/stores@index'));
  }

  public function index () {

    $where = Where::create ();

    $search = Restful\Search::create ($where)
                            ->input ('名稱', function ($val) { return Where::create ('name LIKE ?', '%' . $val . '%'); }, 'text')
                            ->input ('地址', function ($val) { return Where::create ('address LIKE ?', '%' . $val . '%'); }, 'text');

    $total = Store::count ($where);
    $page  = Pagination::info ($total);
    $objs  = Store::find ('all', array (
               'order' => Restful\Order::desc ('sort'),
               'offset' => $page['offset'],
               'limit' => $page['limit'],
               'where' => $where));

    $search->setObjs ($objs)
           ->setTotal ($total)
           ->setAddUrl (RestfulUrl::add ())
           ->setSortUrl (RestfulUrl::sorts ());

    return $this->view->setPath ('admin/stores/index.php')
                      ->with ('search', $search)
                      ->with ('pagination', implode ('', $page['links']));
  }

  public function add () {
    return $this->view->setPath ('admin/stores/add.php');
  }

  public function create () {
    $validation = function (&$posts, &$files) {
      Validation::maybe ($posts, 'status', '狀態', Store::STATUS_OFF)->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->inArray (array_keys (Store::$statusTexts));
      
      Validation::need ($files, 'icon', '圖示')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);
      Validation::maybe ($files, 'bg', '封面')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      Validation::need ($posts, 'name', '名稱')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'open_time', '營業時間')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'phone', '電話')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'address', '地址')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'type', '飲食類型')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'money', '荷包情況')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'menu', '推薦菜單')->isStringOrNumber ()->doTrim ();
      Validation::need ($posts, 'content', '商家描述')->isStringOrNumber ()->doTrim ();

      Validation::maybe ($files, 'images', '商家圖片們')->isArray ()->fileterIsUploadFiles ()->filterFormats ('jpg', 'gif', 'png')->filterSize (1, 10 * 1024 * 1024);
    };

    $transaction = function ($posts, $files, &$obj) {
      return ($obj = Store::create ($posts))
           && $obj->putFiles ($files);
    };

    $transaction2 = function ($files, $obj) {
      foreach ($files['images'] as $image)
        if (!(($img = StoreImage::create (array ('store_id' => $obj->id, 'pic' => ''))) && $img->pic->put ($image)))
          return false;
      return true;
    };

    $posts = Input::post ();
    $files = Input::file ();
    $files['images'] = Input::file ('images[]');
    $posts['sort'] = Store::count ();
    
    if ($error = Validation::form ($validation, $posts, $files))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = Store::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = StoreImage::getTransactionError ($transaction2, $files, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function edit ($obj) {
    return $this->view->setPath ('admin/stores/edit.php');
  }

  public function update ($obj) {
    $validation = function (&$posts, &$files, &$obj) {
      Validation::maybe ($posts, 'status', '狀態', Store::STATUS_OFF)->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->inArray (array_keys (Store::$statusTexts));
      
      $obj->icon->getValue ()
        ? Validation::maybe ($files, 'icon', '圖示')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024)
        : Validation::need ($files, 'icon', '圖示')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      Validation::maybe ($files, 'bg', '封面')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      Validation::need ($posts, 'name', '名稱')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'open_time', '營業時間')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'phone', '電話')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'address', '地址')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'type', '飲食類型')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'money', '荷包情況')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'menu', '推薦菜單')->isStringOrNumber ()->doTrim ();
      Validation::need ($posts, 'content', '商家描述')->isStringOrNumber ()->doTrim ();
      
      Validation::maybe ($files, 'images', '商家圖片們')->isArray ()->fileterIsUploadFiles ()->filterFormats ('jpg', 'gif', 'png')->filterSize (1, 10 * 1024 * 1024);
      Validation::maybe ($posts, '_ori_images', '舊的商家圖片們 ID', array ())->isArray ();
      
    };

    $transaction = function ($posts, $files, &$obj) {
      return $obj->columnsUpdate ($posts)
          && $obj->save ()
          && $obj->putFiles ($files);
    };

    $transaction2 = function ($posts, $files, $obj) {
      if ($del_ids = array_diff (array_orm_column ($obj->images, 'id'), $posts['_ori_images']))
        if ($dels = StoreImage::find ('all', array ('where' => array ('id IN (?)', $del_ids))))
          foreach ($dels as $del)
            if (!$del->destroy ())
              return false;

      foreach ($files['images'] as $image)
        if (!(($img = StoreImage::create (array ('store_id' => $obj->id, 'pic' => ''))) && $img->pic->put ($image)))
          return false;
      return true;
    };

    $posts = Input::post ();
    $files = Input::file ();
    $files['images'] = Input::file ('images[]');

    if ($error = Validation::form ($validation, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = Store::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));
    
    if ($error = StoreImage::getTransactionError ($transaction2, $posts, $files, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function destroy ($obj) {
    if ($error = Store::getTransactionError (function ($obj) { return $obj->destroy (); }, $obj))
      return refresh (RestfulUrl::index (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => array ()));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function show ($obj) {
    return $this->view->setPath ('articles/show.php');
  }
  public function status ($obj) {
    $validation = function (&$posts) {
      Validation::maybe ($posts, 'status', '狀態', Store::STATUS_OFF)->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->inArray (array_keys (Store::$statusTexts));
    };

    $transaction = function ($posts, $obj) {
      return $obj->columnsUpdate ($posts)
          && $obj->save ();
    };

    $posts = Input::post ();

    if ($error = Validation::form ($validation, $posts))
      return Output::json ($error, 400);

    if ($error = Store::getTransactionError ($transaction, $posts, $obj))
      return Output::json ($error, 400);

    return Output::json (array (
        'status' => $obj->status
      ));
  }
  public function sorts () {
    $validation = function (&$posts) {
      Validation::maybe ($posts, 'changes', '狀態', array ())->isArray ()->doArrayValues ()->doArrayMap (function ($t) {
        if (!isset ($t['id'], $t['ori'], $t['now']))
          return Validation::error ('格式不正確(1)');

        if (!$obj = Store::find ('one', array ('select' => 'id,sort', 'where' => Where::create ('id = ? AND sort = ?', $t['id'], $t['ori']))))
          return Validation::error ('格式不正確(2)');

        return array ('obj' => $obj, 'sort' => $t['now']);
      })->doArrayFilter ();
    };

    $posts = Input::post ();

    if ($error = Validation::form ($validation, $posts))
      return Output::json ($error, 400);

    $transaction = function ($posts) {
      foreach ($posts['changes'] as $value)
        $value['obj']->sort = $value['sort'];
      
      foreach ($posts['changes'] as $value)
        if (!$value['obj']->save ())
          return false;

      return true;
    };

    if ($error = Store::getTransactionError ($transaction, $posts))
      return Output::json ($error, 400);

    return Output::json (array_map (function ($t) { return array ('id' => $t->id, 'sort' => $t->sort);}, array_column ($posts['changes'], 'obj')));
  }
}
