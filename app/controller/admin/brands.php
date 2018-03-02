<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class brands extends AdminRestfulController {

  public function __construct () {
    parent::__construct ();
    $this->layout->with ('title', '品牌輪播')
                 ->with ('current_url', RestfulUrl::url ('admin/brands@index'));
  }

  public function index () {

    $where = Where::create ();

    $search = Restful\Search::create ($where)
                            ->input ('標題', function ($val) { return Where::create ('title LIKE ?', '%' . $val . '%'); }, 'text');

    $total = Brand::count ($where);
    $page  = Pagination::info ($total);
    $objs  = Brand::find ('all', array (
               'order' => Restful\Order::desc ('id'),
               'offset' => $page['offset'],
               'limit' => $page['limit'],
               'where' => $where));

    $search->setObjs ($objs)
           ->setTotal ($total)
           ->setAddUrl (RestfulUrl::add ());

    return $this->view->setPath ('admin/brands/index.php')
                      ->with ('search', $search)
                      ->with ('pagination', implode ('', $page['links']));
  }

  public function add () {
    return $this->view->setPath ('admin/brands/add.php');
  }

  public function create () {
    $validation = function (&$posts, &$files) {
      Validation::need ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);
      Validation::need ($posts, 'title', '標題')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'link', '鏈結')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1);
    };

    $transaction = function ($posts, $files, &$obj) {
      return ($obj = Brand::create ($posts))
           && $obj->putFiles ($files);
    };

    $posts = Input::post ();
    $files = Input::file ();
    
    if ($error = Validation::form ($validation, $posts, $files))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = Brand::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function edit ($obj) {
    return $this->view->setPath ('admin/brands/edit.php');
  }

  public function update ($obj) {
    $validation = function (&$posts, &$files, &$obj) {
      $obj->pic->getValue ()
        ? Validation::maybe ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024)
        : Validation::need ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);

      Validation::need ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);
      Validation::need ($posts, 'title', '標題')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
      Validation::need ($posts, 'link', '鏈結')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1);
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

    if ($error = Brand::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function destroy ($obj) {
    if ($error = Brand::getTransactionError (function ($obj) { return $obj->destroy (); }, $obj))
      return refresh (RestfulUrl::index (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => array ()));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function show ($obj) {
    return $this->view->setPath ('articles/show.php');
  }

}
