//	Feature property
$featureProperty.owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 1500,
    margin: 30,
    nav: true,
    dots: false,
    navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
    responsive: {

        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1024: {
            items: 2
        },
        1200: {
            items: 3
        }
    }

});

//  Feature property sidebar
$sidebarFeatured.owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 30,
    nav: false,
    autoplayHoverPause: true,
    dots: false,
    navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
    responsive: {

        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1024: {
            items: 1
        },
        1200: {
            items: 1
        }
    }

});
//  Partner Slide
$partners.owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 1500,
    margin: 30,
    nav: false,
    dots: true,
    autoplayHoverPause: true,
    responsive: {

        0: {
            items: 3
        },
        600: {
            items: 3
        },
        1024: {
            items: 5
        },
        1200: {
            items: 5
        }
    }

});

//  Review Testimonial
$recentReviews.owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    margin: 30,
    nav: false,
    dots: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        }
    }

});