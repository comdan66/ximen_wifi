<div class='back'>
  <a href="<?php echo RestfulUrl::index ();?>" class='icon-36'>回上一頁</a>
</div>

<?php echo $form->appendFormRows (
  Restful\Image::need ('圖片', 'pic')->setTip ('請上傳 710x400 圖片')->setAccept ('image/*')
);?>