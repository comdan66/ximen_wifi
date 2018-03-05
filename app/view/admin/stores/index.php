<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('啟用')->setWidth (60)->setClass ('center')->setTd (function ($obj, $column) { return $column->setSwitch ($obj->status == Store::STATUS_ON, array ('class' => 'switch ajax', 'data-column' => 'status', 'data-url' => RestfulUrl::url ('admin/stores@status', $obj), 'data-true' => Store::STATUS_ON, 'data-false' => Store::STATUS_OFF)); }),

  Restful\Column::create ('ID')->setWidth (50)->setSort ('id')->setTd (function ($obj) { return $obj->id; }),
  Restful\Column::create ('圖示')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->icon->toImageTag (); }),
  Restful\Column::create ('封面')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->bg->toImageTag (); }),
  Restful\Column::create ('其他')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return implode ('', array_map (function ($img) { return $img->pic->toImageTag (); }, $obj->images)); }),
  Restful\Column::create ('名稱')->setWidth (100)->setTd (function ($obj) { return $obj->name; }),
  Restful\Column::create ('營業時間')->setWidth (150)->setTd (function ($obj) { return $obj->open_time; }),
  Restful\Column::create ('電話')->setWidth (150)->setTd (function ($obj) { return $obj->phone; }),
  Restful\Column::create ('地址')->setTd (function ($obj) { return $obj->address; }),
  Restful\Column::create ('點擊次數')->setWidth (100)->setSort ('click_cnt')->setTd (function ($obj) { return number_format ($obj->click_cnt); }),

  Restful\EditColumn::create ('編輯')->setTd (function ($obj, $column) {
    return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                  ->addEditLink (RestfulUrl::edit ($obj))->addLink (RestfulUrl::url ('admin/pv_stores@index', $obj), array ('class' =>'icon-29')); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>