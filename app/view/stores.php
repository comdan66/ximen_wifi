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
    <main id='main'>
      <div id='header' class="<?php echo $f && $t ? 'f t' : ($f ? 'f' : ($t ? 't' : ''));?>">
        <h1><a href="<?php echo Url::base('intro');?>">Ximen Free Wifi 西門智慧商圈</a></h1>
        <a class='icon-2' id='sf'></a>
        <a class='icon-1' id='st'></a>
        
        <form id='fm' action='<?php echo Url::base ('stores');?>'>
          <input type='text' name='f' value='<?php echo $f;?>' minlength='0' required/>
          <button class='icon-2'> 搜尋</button>
        </form>

        <div id='tags'>
          <a href='<?php echo Url::base ('stores/?t=' . 'aa');?>' class='cho'>sada</a>
          <a href=''>sadafds</a>
          <a href=''>ss</a>
          <a href=''>sada</a>
          <a href=''>sadafds</a>
          <a href=''>ss</a>
          <a href=''>sada</a>
          <a href=''>sadafds</a>
          <a href=''>ss</a>
          <a href=''>sada</a>
          <a href=''>sadafds</a>
          <a href=''>ss</a>
          <a href=''>sada</a>
          <a href=''>sadafds</a>
          <a href=''>ss</a>
        </div>
      </div>

      <div id='list'>
        <div class='box' data-link='https://www.google.com.tw/'>
          <div class='logo'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/1-61-150x150.jpg' />
          </div>
          <div class='content'>
            <h2>Comebuy</h2>
            <span>asdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asd</span>
            <a>瀏覽商點</a>
          </div>
        </div>

        <div class='box' data-box='<?php echo Url::base ('api/stores/3');?>'>
          <div class='logo'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/1-61-150x150.jpg' />
          </div>
          <div class='content'>
            <h2>Comebuy</h2>
            <span>asdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asd</span>
            <a>瀏覽商點</a>
          </div>
        </div>

      </div>

      <div id='banner'>
        <a class='icon-3 l'></a>
        <a class='icon-4 r'></a>
        
        <div class='banner'>
          <a class='ad'>
            <img src='http://ximen-free-wifi.com/wfp_res/5129cad621d3434dbbd7457d08f91d7a.png'>
          </a>
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/300.jpg'>
          </a>
          <a class='ad'>
            <img src='http://ximen-free-wifi.com/wfp_api/api/cs/adv/ADV17102014530000/link'>
          </a>
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/200.jpg'>
          </a>
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/200.jpg'>
          </a>
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/200.jpg'>
          </a>
        </div>
      </div>
    </main>

  </body>
</html>
