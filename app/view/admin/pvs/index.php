<?php echo $search; ?>

<div class='panel'>
<?php echo $search->setTableClomuns (
  Restful\Column::create ('ID')->setWidth (50)->setSort ('id')->setTd (function ($obj) { return $obj->id; }),
  Restful\Column::create ('時間點')->setSort ('created_at')->setTd (function ($obj) { return $obj->created_at->format ('Y-m-d H:i:s'); })
  );
?>
</div>

<div class='pagination'><div><?php echo $pagination;?></div></div>