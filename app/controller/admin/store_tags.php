<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class store_tags extends AdminRestfulController {

  public function __construct () {
    parent::__construct ();
    $this->layout->with ('title', '商家分類')
                 ->with ('current_url', RestfulUrl::url ('admin/store_tags@index'));
  }

  public function index () {

    $where = Where::create ();

    $search = Restful\Search::create ($where)
                            ->input ('名稱', function ($val) { return Where::create ('name LIKE ?', '%' . $val . '%'); }, 'text');

    $total = StoreTag::count ($where);
    $page  = Pagination::info ($total);
    $objs  = StoreTag::find ('all', array (
               'order' => Restful\Order::desc ('id'),
               'offset' => $page['offset'],
               'limit' => $page['limit'],
               'where' => $where));

    $search->setObjs ($objs)
           ->setTotal ($total)
           ->setAddUrl (RestfulUrl::add ());

    return $this->view->setPath ('admin/store_tags/index.php')
                      
                      ->with ('search', $search)
                      ->with ('pagination', implode ('', $page['links']));
  }

  public function add () {
    return $this->view->setPath ('admin/store_tags/add.php');
  }

  public function create () {
    $validation = function (&$posts) {
      Validation::need ($posts, 'name', '名稱')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
    };

    $transaction = function ($posts, &$obj) {
      return ($obj = StoreTag::create ($posts));
    };

    $posts = Input::post ();

    $posts['sort'] = StoreTag::count ();
    
    if ($error = Validation::form ($validation, $posts))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = StoreTag::getTransactionError ($transaction, $posts, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function edit ($obj) {
    return $this->view->setPath ('admin/store_tags/edit.php');
  }

  public function update ($obj) {
    $validation = function (&$posts, &$obj) {
      Validation::maybe ($posts, 'name', '名稱')->isStringOrNumber ()->doTrim ()->doRemoveHtmlTags ()->length (1, 255);
    };

    $transaction = function ($posts, &$obj) {
      return $obj->columnsUpdate ($posts)
          && $obj->save ();
    };

    $posts = Input::post ();

    if ($error = Validation::form ($validation, $posts, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = StoreTag::getTransactionError ($transaction, $posts, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function destroy ($obj) {
    if ($error = StoreTag::getTransactionError (function ($obj) { return $obj->destroy (); }, $obj))
      return refresh (RestfulUrl::index (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => array ()));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function show ($obj) {
    return $this->view->setPath ('articles/show.php');
  }

}
