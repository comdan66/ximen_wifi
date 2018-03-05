<div class='back'>
  <a href="<?php echo RestfulUrl::index ();?>" class='icon-36'>回上一頁</a>
</div>

<?php echo $form->appendFormRows (
  Restful\Image::need ('圖片', 'pic')->setTip ('請上傳 100x100 圖片')->setAccept ('image/*'),
  Restful\Text::need ('名稱', 'title')->setAutofocus (true)->setMaxLength (255),
  Restful\Text::need ('鏈結', 'link')->setMaxLength (255)
);?>