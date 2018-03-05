<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title>Ximen Free Wifi 西門智慧商圈</title>

    <?php echo $asset->renderCSS ();?>
    <?php echo $asset->renderJS ();?>

  </head>
  <body lang="zh-tw">
    <div id='top' data-i='1'>
<?php foreach ($hBanners as $banner) { ?>
        <a class='box' data-box='<?php echo Url::base ('api/stores/3');?>'>
          <img src="<?php echo $banner->pic->url ('min');?>">
        </a>
<?php }?>
    </div>
    <div id='mid'>
      <a class='img' href='<?php echo Url::base ('stores');?>'>
        <img src="/assets/img/store.jpg" >
      </a>
    </div>
    <div id='bot' data-i='1'>
<?php foreach ($fBanners as $banner) { ?>
        <a class='box' data-link='<?php echo Url::base ('api/stores/3');?>'>
          <img src="<?php echo $banner->pic->url ('min');?>">
        </a>
<?php }?>
    </div>
  </body>
</html>
