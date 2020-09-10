$(function() {
    'use strict';

    $('.product-details .nav-tabs .nav-link').click(function() {

        $(this).addClass('selected').siblings().removeClass('selected');

        $('.tab-details').hide();

        $('.' + $(this).data('class')).fadeIn(100);

    });

    $('.go-to-description').click(function() {

        $(this).addClass('selected').siblings().removeClass('selected');

        $('.description').fadeIn(100);
        $('.fiche').hide();
        $('.comment').hide();
    });

    $('.go-to-comment').click(function() {

        $(this).addClass('selected').siblings().removeClass('selected');

        $('.comment').fadeIn(100);
        $('.fiche').hide();
        $('.description').hide();
    });

    $('.confirm').click(function() {
        return confirm("Voulez-vous supprimer ce commentaire?");
    });
});