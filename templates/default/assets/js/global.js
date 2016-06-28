$.fn.cycle.defaults.autoSelector = '.slideshow';

$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });

  $(".gallery-modal").magnificPopup({type:'image', gallery:{enabled:true}});
  
  $('textarea.form-control').wysihtml5({"font-styles": false});
});