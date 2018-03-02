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
               'order' => Restful\Order::desc ('id'),
               'offset' => $page['offset'],
               'limit' => $page['limit'],
               'where' => $where));

    $search->setObjs ($objs)
           ->setTotal ($total)
           ->setAddUrl (RestfulUrl::add ());

    return $this->view->setPath ('admin/stores/index.php')
                      ->with ('search', $search)
                      ->with ('pagination', implode ('', $page['links']));
  }

  public function add () {
    return $this->view->setPath ('admin/stores/add.php');
  }

  public function create () {
    $validation = function (&$posts, &$files) {
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
      $obj->icon->getValue ()
        ? Validation::maybe ($files, 'icon', '圖示')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024)
        : Validation::need ($files, 'icon', '圖示')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      $obj->bg->getValue ()
        ? Validation::maybe ($files, 'bg', '封面')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024)
        : Validation::need ($files, 'bg', '封面')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      Validation::need ($posts, 'name', '名稱')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'open_time', '營業時間')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'phone', '電話')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'address', '地址')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'type', '飲食類型')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'money', '荷包情況')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'menu', '推薦菜單')->isStringOrNumber ()->doTrim ();
      Validation::need ($posts, 'content', '商家描述')->isStringOrNumber ()->doTrim ();
    };

    $transaction = function ($posts, $files, &$obj) {
      return $obj->columnsUpdate ($posts)
          && $obj->save ()
          && $obj->putFiles ($files);
    };

    $posts = Input::post ();
    $files = Input::file ();

    if ($error = Validation::form ($validation, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = Store::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

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

}
