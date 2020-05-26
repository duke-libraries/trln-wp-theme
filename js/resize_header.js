jQuery(document).ready(function($) {

  // apply spacing for banner

  if ( $("#banner").length ) {
    if ( $("#news_header").length ) {
      $("#news_header").addClass('news-banner');
    }
  }


  // resize header

  window.onscroll = function() { 
    scrollFunction() 
  };

  function scrollFunction() {
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
      $("#header-logo-wrapper a").addClass("scrolled");
      $("#site-header").addClass("scrolled");
      $("#banner").addClass("scrolled");
    } else {
      $("#header-logo-wrapper a").removeClass("scrolled");
      $("#site-header").removeClass("scrolled");
      $("#banner").removeClass("scrolled");
    }
  }

});