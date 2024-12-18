$(document).ready(function(){
    $(function () {
        $(".preloader").fadeOut();
    });

  

    $('.landing-categories').owlCarousel({
        loop: true,
        items: 4,
        margin: 0,
        autoplay: true,
        dots:false,
        autoplayTimeout: 8000,
        rewindSpeed : 8000,
        nav: true,
        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            990: {
                items: 4
            },
            1170: {
                items: 4
            }
        }

    });

    $('.shop-categories').owlCarousel({
        loop: true,
        items: 4,
        margin: 5,
        autoplay: false,
        dots:false,
        autoplayTimeout: 8000,
        rewindSpeed : 8000,
        nav: true,
        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            990: {
                items: 4
            },
            1170: {
                items: 4
            }
        }

    });

    $('.product-carousel').owlCarousel({
        loop: true,
        items: 4,
        margin: 15,
        autoplay: false,
        dots:false,
        autoplayTimeout: 8000,
        rewindSpeed : 8000,
        nav: true,
        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            990: {
                items: 3
            },
            1170: {
                items: 4
            }
        }

    });

    $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'fa fa-plus',
        verticaldownclass: 'fa fa-minus',
        max: 50
    });

});
let currentSlide = 0;

    function showSlide(index) {
        const slider = document.getElementById('slider');
        const slideWidth = document.querySelector('.slide').offsetWidth;
        currentSlide = index;

        slider.style.transform = `translateX(${-currentSlide * slideWidth}px)`;
    }

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide--;
        } else {
            currentSlide = document.querySelectorAll('.slide').length - 1;
        }
        showSlide(currentSlide);
    }

    function nextSlide() {
        const totalSlides = document.querySelectorAll('.slide').length - 1;
        if (currentSlide < totalSlides) {
            currentSlide++;
        } else {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }