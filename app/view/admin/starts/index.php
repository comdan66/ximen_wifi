<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('ID')
                ->setWidth (50)
                ->setSort ('id')
                ->setTd (function ($obj) { return $obj->id; }),

  Restful\Column::create ('圖片')->setWidth (50)->setClass ('oaips')->setTd (function ($obj) { return $obj->pic->toImageTag (); }),
  Restful\Column::create ('點擊次數')->setSort ('click_cnt')->setTd (function ($obj) { return number_format ($obj->click_cnt); }),

  Restful\EditColumn::create ('編輯')
                    ->setTd (function ($obj, $column) {
                      return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                                    ->addEditLink (RestfulUrl::edit ($obj)); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>