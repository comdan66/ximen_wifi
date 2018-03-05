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
      <div id='top'<?php echo $q ? ' class="s"' : '';?>>
        <h1><a href="">Ximen Free Wifi 西門智慧商圈</a></h1>
        <a class='icon-2' id='sf'></a>
        <a class='icon-1'></a>
        
        <form id='fm' action='<?php echo Url::base ('stores');?>'>
          <input type='text' name='q' value='<?php echo $q;?>' />
          <button class='icon-2'> 搜尋</button>
        </form>
      </div>

      <div id='list'>
        <div class='store' data-link='https://www.google.com.tw/'>
          <div class='logo'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/1-61-150x150.jpg' />
          </div>
          <div class='content'>
            <h2>Comebuy</h2>
            <span>asdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asdasdasd asdsadasdasdas asd</span>
            <a>瀏覽商點</a>
          </div>
        </div>

        <div class='store' data-box='<?php echo Url::base ('api/stores/3');?>'>
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
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/200.jpg'>
          </a>
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/300.jpg'>
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
          <a class='ad'>
            <img src='http://occupy.sungchin.com/ximen/wp-content/uploads/2018/02/200.jpg'>
          </a>
        </div>
      </div>
    </main>

    <div id='box'></div>
    <div class='_c'></div>
    
    <div id='img'></div>
    <div class='_c'></div>

  </body>
</html>
