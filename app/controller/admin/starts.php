<?php defined ('OACI') || exit ('此檔案不允許讀取。');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, OACI
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class starts extends AdminRestfulController {

  public function __construct () {
    parent::__construct ();
    $this->layout->with ('title', '按鈕列表')
                 ->with ('current_url', RestfulUrl::url ('admin/starts@index'));
  }

  public function index () {

    $where = Where::create ();

    $search = Restful\Search::create ($where)
                            ->input ('點擊率大於等於', function ($val) { return Where::create ('click_cnt >= ?', $val); }, 'number');

    $total = Start::count ($where);
    $page  = Pagination::info ($total);
    $objs  = Start::find ('all', array (
               'order' => Restful\Order::desc ('id'),
               'offset' => $page['offset'],
               'limit' => $page['limit'],
               'where' => $where));

    $search->setObjs ($objs)
           ->setTotal ($total)
           ->setAddUrl (RestfulUrl::add ());

    return $this->view->setPath ('admin/starts/index.php')
                      
                      ->with ('search', $search)
                      ->with ('pagination', implode ('', $page['links']));
  }

  public function add () {
    return $this->view->setPath ('admin/starts/add.php');
  }

  public function create () {
    $validation = function (&$posts, &$files) {
      Validation::need ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);
    };

    $transaction = function ($posts, $files, &$obj) {
      return ($obj = Start::create ($posts))
           && $obj->putFiles ($files);
    };

    $posts = Input::post ();
    $files = Input::file ();
    
    if ($error = Validation::form ($validation, $posts, $files))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    if ($error = Start::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::add (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function edit ($obj) {
    return $this->view->setPath ('admin/starts/edit.php');
  }

  public function update ($obj) {
    $validation = function (&$posts, &$files, &$obj) {
      $obj->pic->getValue ()
        ? Validation::maybe ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024)
        : Validation::need ($files, 'pic', '圖片')->isUploadFile ()->formats ('jpg', 'gif', 'png')->size (1, 10 * 1024 * 1024);
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

    if ($error = Start::getTransactionError ($transaction, $posts, $files, $obj))
      return refresh (RestfulUrl::edit ($obj), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => $posts));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function destroy ($obj) {
    if ($error = Start::getTransactionError (function ($obj) { return $obj->destroy (); }, $obj))
      return refresh (RestfulUrl::index (), 'flash', array ('type' => 'failure', 'msg' => '失敗！' . $error, 'params' => array ()));

    return refresh (RestfulUrl::index (), 'flash', array ('type' => 'success', 'msg' => '成功！', 'params' => array ()));
  }

  public function show ($obj) {
    return $this->view->setPath ('starts/show.php');
  }
}
