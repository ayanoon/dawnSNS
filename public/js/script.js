$(function () {
  $('.menu-trigger').click(function () { //ハンバーガーボタン(.menu-trigger)をクリック
    $(this).toggleClass('active'); //ハンバーガーボタンに(.active)を追加・削除
    if ($(this).hasClass('active')) { //もしハンバーガーボタンに(.active)があれば
      $('.g-navi').slideDown(); //(.g-navi)のスライドをおろす
    } else { //それ以外の場合は、
      $('.g-navi').slideUp(); //(.g-navi)のスライドをあげる
    }
  });
});
