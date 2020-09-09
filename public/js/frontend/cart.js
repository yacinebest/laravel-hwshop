$(function() {

    /* afficher min Panier */
    $(".button-cart").on("click", function(e) {
        e.preventDefault();
        $(".shopping-cart").fadeToggle("fast");
    });

});