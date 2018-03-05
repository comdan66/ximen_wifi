<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('ID')->setWidth (50)->setSort ('id')->setTd (function ($obj) { return $obj->id; }),
  Restful\Column::create ('圖片')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->pic->toImageTag (); }),
  Restful\Column::create ('標題')->setWidth (100)->setTd (function ($obj) { return $obj->title; }),
  Restful\Column::create ('鏈結')->setWidth (150)->setTd (function ($obj) { return $obj->link; }),
  Restful\Column::create ('情報內容')->setTd (function ($obj) { return $obj->min_column ('content'); }),
  Restful\Column::create ('點擊次數')->setWidth (100)->setSort ('click_cnt')->setTd (function ($obj) { return number_format ($obj->click_cnt); }),
  Restful\EditColumn::create ('編輯')->setTd (function ($obj, $column) {
    return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                  ->addEditLink (RestfulUrl::edit ($obj))
                  ->addLink (RestfulUrl::url ('admin/pv_ori_ads@index', $obj), array ('class' =>'icon-29')); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>