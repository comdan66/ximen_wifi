<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('ID')->setWidth (50)->setSort ('id')->setTd (function ($obj) { return $obj->id; }),
  Restful\Column::create ('名稱')->setSort ('name')->setTd (function ($obj) { return $obj->name; }),
  Restful\EditColumn::create ('編輯')->setTd (function ($obj, $column) {
    return $column->addDeleteLink (RestfulUrl::destroy ($obj))
                  ->addEditLink (RestfulUrl::edit ($obj)); }));
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>