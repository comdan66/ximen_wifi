<div class='back'>
  <a href="<?php echo RestfulUrl::index ();?>" class='icon-36'>回上一頁</a>
</div>

<?php echo $form->appendFormRows (
  Restful\Image::need ('圖示', 'icon')->setTip ('預覽僅示意，未按比例')->setAccept ('image/*'),
  Restful\Image::maybe ('封面', 'bg')->setTip ('預覽僅示意，未按比例')->setAccept ('image/*'),
  Restful\Text::need ('名稱', 'name')->setAutofocus (true)->setMaxLength (255),
  Restful\Text::need ('營業時間', 'open_time')->setMaxLength (255),
  Restful\Text::need ('電話', 'phone')->setMaxLength (255),
  Restful\Text::need ('地址', 'address')->setMaxLength (255),
  Restful\Text::need ('飲食類型', 'type')->setMaxLength (255),
  Restful\Text::need ('荷包情況', 'money')->setMaxLength (255),
  Restful\PureText::need ('推薦菜單', 'menu'),
  Restful\PureText::need ('商家描述', 'content'),
  Restful\Images::maybe ('商家圖片們', 'images')->setTip ('可上傳多張，預覽僅示意，未按比例')->setAccept ('image/*')
);?>