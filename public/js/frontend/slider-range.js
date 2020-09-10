$(function() {

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 100000,
        values: [0, 100000],
        slide: function(event, ui) {
            $("#amount").val("DZD" + ui.values[0] + " - DZD" + ui.values[1]);
        }
    });

    $("#amount").val("DZD" + $("#slider-range").slider("values", 0) +
        " - DZD" + $("#slider-range").slider("values", 1));


});