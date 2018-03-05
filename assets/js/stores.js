/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, OAF2E
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
 
$(function () {
  var $top = $('#top');
  var $list = $('#list');
  $('#sf').click (function () { $top.toggleClass ('f'); });
  $('#st').click (function () { $top.toggleClass ('t'); });
  $('.logo, .ad').imgLiquid ({ verticalAlign: 'Fill' });
  

  $('#banner').each (function () {
    var $that = $(this).attr ('data-i', 1);
    var l = $that.find ('.banner > *').length - 4;

    $that.find ('>a').click (function () {
      var i = parseInt ($that.attr ('data-i'), 10);
      $that.attr ('data-i', $(this).hasClass ('l') ? --i < 1 ? l : i : (++i > l ? 1 : i));
    });
    
    setTimeout (function () { $that.addClass ('ani'); }, 300);
  });

  
});