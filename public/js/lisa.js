$(document).ready(function() {

// $('#navAnim').hide();
var $nav = $(".navbar-fixed-top");
var $navLink = $(".nav-link");
$(document).scroll(function () {
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    $navLink.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
});
    // Clique sur où le récupérer

    $("#clickOnAdress").hide();

    $("#where").click(function () {
        $("#price").hide();
        $("#quantity").hide();
        $("#button").hide();
        $("#clickOnAdress").toggle();
    });

    $("#returnButton").click(function () {
        $("#price").toggle();
        $("#quantity").toggle();
        $("#button").toggle();
        $("#clickOnAdress").hide();
    });







});