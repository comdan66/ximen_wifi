<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('ID')
                ->setWidth (50)
                ->setSort ('id')
                ->setTd (function ($obj) { return $obj->id; }),
  
  Restful\Column::create ('圖示')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->icon->toImageTag (); }),
  Restful\Column::create ('封面')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->bg->toImageTag (); }),
  Restful\Column::create ('其他')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return implode ('', array_map (function ($img) { return $img->pic->toImageTag (); }, $obj->images)); }),

  Restful\Column::create ('名稱')
                ->setWidth (100)
                ->setSort ('name')
                ->setTd (function ($obj) { return $obj->name; }),

  Restful\Column::create ('營業時間')
                ->setWidth (150)
                ->setSort ('name')
                ->setTd (function ($obj) { return $obj->open_time; }),

  Restful\Column::create ('電話')
                ->setWidth (150)
                ->setSort ('name')
                ->setTd (function ($obj) { return $obj->phone; }),

  Restful\Column::create ('地址')
                ->setSort ('name')
                ->setTd (function ($obj) { return $obj->address; }),

  Restful\EditColumn::create ('編輯')
                    ->setTd (function ($obj, $column) {
                      return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                                    ->addEditLink (RestfulUrl::edit ($obj)); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>