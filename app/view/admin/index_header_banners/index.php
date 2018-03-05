<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('啟用')->setWidth (60)->setClass ('center')->setTd (function ($obj, $column) { return $column->setSwitch ($obj->status == IndexHeaderBanner::STATUS_ON, array ('class' => 'switch ajax', 'data-column' => 'status', 'data-url' => RestfulUrl::url ('admin/index_header_banners@status', $obj), 'data-true' => IndexHeaderBanner::STATUS_ON, 'data-false' => IndexHeaderBanner::STATUS_OFF)); }),
  Restful\Column::create ('ID')->setWidth (50)->setSort ('id')->setTd (function ($obj) { return $obj->id; }),
  Restful\Column::create ('圖片')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->pic->toImageTag ('wh10_9'); }),
  Restful\Column::create ('標題')->setTd (function ($obj) { return $obj->title; }),
  Restful\Column::create ('鏈結')->setWidth (250)->setTd (function ($obj) { return $obj->link; }),
  Restful\Column::create ('點擊次數')->setWidth (150)->setSort ('click_cnt')->setTd (function ($obj) { return number_format ($obj->click_cnt); }),
  Restful\EditColumn::create ('編輯')->setTd (function ($obj, $column) {
    return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                  ->addEditLink (RestfulUrl::edit ($obj))
                  ->addLink (RestfulUrl::url ('admin/pv_index_header_banners@index', $obj), array ('class' =>'icon-29')); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>