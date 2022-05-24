(function($, Drupal)
{
  Drupal.behaviors.backToTop = {
    attach: function(context, settings) {
      once('backToTop', 'body', context).forEach( function () {
        let btn = $('<button id="button-back-to-top"></button>').click(function() {
          $('html, body').animate({scrollTop:0}, '300');
        })
        btn.appendTo($('body'));

        $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            btn.show();
          } else {
            btn.hide();
          }
        })
      });
    }
  };
}(jQuery, Drupal));
