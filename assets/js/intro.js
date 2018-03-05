/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, OAF2E
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
 
$(function () {
  $('#start-img, #mid > a').each (function () {
    $(this).imgLiquid ({ verticalAlign: 'center' });
  });

  // $('#top .box, #bot .box').each (function () {
  //   $(this).imgLiquid ({ fill: true });
  // });

  $('#top, #bot').each (function () {
    var $that = $(this);
    $that.data ('l', $that.find ('>.img').length);
    $that.attr ('data-i', 1);
    setInterval (function () { var l = parseInt ($that.data ('l'), 10), i = parseInt ($that.attr ('data-i'), 10); $that.attr ('data-i', ++i > l ? 1 : i); }, (Math.floor ((Math.random () * 5) + 4)) * 1000);
  });
});