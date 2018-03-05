<div class='back'>
  <a href="<?php echo RestfulUrl::index ();?>" class='icon-36'>回上一頁</a>
</div>

<?php echo $form->appendFormRows (
  Restful\Switcher::need ('是否啟用', 'status')->setCheckedValue (IndexFooterBanner::STATUS_ON),
  Restful\Text::need ('標題', 'title')->setAutofocus (true)->setMaxLength (255),
  Restful\Image::need ('圖片', 'pic')->setTip ('請上傳 400x240 圖片')->setAccept ('image/*'),
  Restful\Text::need ('鏈結', 'link')
);?>