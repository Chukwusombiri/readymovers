$(function(){
     /* services slider */
     $('.services-slider.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeOut: 5000,
        autoplayHoverPause: false,
        smartSpeed: 700,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1500: {
                items: 5
            }
        }
    })
});