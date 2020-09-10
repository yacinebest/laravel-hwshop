$("#product-tabs a").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
});

$(document).ready(function() {
    $(".zoom-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: "mfp-with-zoom mfp-img-mobile",
        image: {
            verticalFit: true,
            titleSrc: function(item) {
                return (
                    item.el.attr("title") +
                    ' &middot; <a class="image-source-link" href="' +
                    item.el.attr("data-source") +
                    '" target="_blank">image source</a>'
                );
            }
        },
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
                return element.find("img");
            }
        }
    });
});

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})