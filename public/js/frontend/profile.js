$(function() {
    'use strict';

    // ------------------------------------------------------

    // $('.profile .btn-menu').click(function() {

    //     $(this).addClass('selected').siblings().removeClass('selected');

    //     $('.profile-card').hide();
    //     $('.profile-title').hide();

    //     $('.' + $(this).data('class')).show();

    // });

    $('.profile .btn-order-dettails').click(function() {

        //$(this).addClass('selected').siblings().removeClass('selected');

        //$('.profile-card').hide();
        //  $('.profile-title').hide();

        //$('.' + $(this).data('class')).show();
        $(this).toggleClass('selected').parent('div').next('div').fadeToggle(100);

    });

    // $('.profile .btn-print').click(function() {

    //     $(this).parent('div').prev('div').printThis();

    // });

    // $('.profile-edit-btn').click(function() {
    //     $('.infos input, .infos select, .infos button').attr("disabled", false);
    //     $('.infos .password-edit').show();
    // });

    // // $('.logout-btn').click(function() {
    // //     return confirm("Voulez-vous vraiment se déconnecter?");
    // // });

    // $('.btn-livraison').click(function() {
    //     $('.livraison-body').hide();
    //     $('.form-livraison').show();
    // });

    // $('.old-pass').oninput(function() {
    //     $('.nv-pass').attr("required", true);
    //     $('.confirm-nv-pass').attr("required", true);
    // });
});



// function imprimer(divName) {
//     let printContents = document.getElementById(divName).innerHTML;
//     let originalContents = document.body.innerHTML;
//     document.body.innerHTML = printContents;
//     window.print();
//     document.body.innerHTML = originalContents;
// }