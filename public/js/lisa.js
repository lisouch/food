$(document).ready(function() {

// $('#navAnim').hide();
var $nav = $(".navbar-fixed-top");
var $navLink = $(".nav-link");
$(document).scroll(function () {
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    $navLink.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
});
});