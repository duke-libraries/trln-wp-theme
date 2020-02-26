jQuery(document).ready(function($) {

  window.onscroll = function() { 
    scrollFunction() 
  };

  function scrollFunction() {
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
      $("#header-logo-wrapper a").addClass("scrolled");
      $("#site-header").addClass("scrolled");
    } else {
      $("#header-logo-wrapper a").removeClass("scrolled");
      $("#site-header").removeClass("scrolled");
    }
  }

});