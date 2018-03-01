<div class='back'>
  <a href="<?php echo RestfulUrl::index ();?>" class='icon-36'>回上一頁</a>
</div>

<?php echo $form->appendFormRows (
  Restful\Image::need ('圖片', 'pic')->setTip ('預覽僅示意，未按比例')->setAccept ('image/*')
);?>