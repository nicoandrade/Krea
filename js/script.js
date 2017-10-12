jQuery(document).ready(function($) {


    //Remove transition delay on products
    setTimeout(function(){ $("body").removeClass('krea-animations-delay'); }, 2000);


    setTimeout(function(){ $("body").removeClass('pace-running'); $("body").addClass('pace-done'); }, 4000);


    $(document).on('click', '#krea-nav-btn', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('body').toggleClass('krea-menu-open');
    });
    $(document).on('click', '.krea-close-menu', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('body').toggleClass('krea-menu-open');
    });



    var $welcome_slider = $('.krea-welcome-slider');
    $welcome_slider.flickity({
        contain: true,
        cellSelector: '.krea-welcome-slider-item',
        cellAlign: 'center',
        prevNextButtons: false,
        pageDots: true,
        imagesLoaded: true,
        autoPlay: true
    });
    var welcome_slider_data = $welcome_slider.data('flickity');
    
    if ( $welcome_slider.length ) {
        //Change title on start
        updateSliderTitle(welcome_slider_data.selectedIndex);

        //Change title on drag
        $welcome_slider.on('select.flickity', function() {
            updateSliderTitle(welcome_slider_data.selectedIndex);
        });
    }
    


    $(".krea-welcome-text span").clone().addClass('clone').attr( "aria-hidden", "true" ).appendTo( ".krea-welcome-text span" );



    /*
    Appear
    */
    appear({
        init: function init(){
        },
        elements: function elements(){
            // work with all elements with the class "track"
            return document.getElementsByClassName('krea-track');
        },
            appear: function appear(el){
            $(el).addClass('krea-is-visible');
        },
            disappear: function disappear(el){
                $(el).removeClass('krea-is-visible')
        },
        bounds: 50,
        reappear: true
    });



    





    $(".ql_scroll_top").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });

    $('.dropdown-toggle').dropdown();
    $('*[data-toggle="tooltip"]').tooltip();



    /*
    // Force Fullwidth
    //===========================================================
    */
    window.onresize = function(event) {
        position_fullwidth_container()
    };
    function position_fullwidth_container(){
        $.each($('.krea_force_fullwidth'), function(index, val) {
            var fullwidth_pos = $(val).offset();
            var body_width = $("body").prop("clientWidth");
            if ( $('body').hasClass('krea-sidenav') && $(window).outerWidth() > 1264 ) {
                fullwidth_pos.left = fullwidth_pos.left - $('#header').width();
                body_width = body_width - $('#header').width();
            }
            var $krea_force_fullwidth_container = $(val).children('.krea_force_fullwidth_container');
            $krea_force_fullwidth_container.css('left', ( ( fullwidth_pos.left - ( fullwidth_pos.left * 2  ) ) ) );
            $krea_force_fullwidth_container.width( body_width );
            if ( $ql_products_slider.length ) { $ql_products_slider.flickity('resize'); }
            if ( $ql_products_carousel.length ) { $ql_products_carousel.flickity('resize'); }
            setTimeout(function(){ $(val).children('.krea_force_fullwidth_height').height( $krea_force_fullwidth_container.height() ); }, 400);
        });
    }
    position_fullwidth_container();
    setTimeout(function(){ position_fullwidth_container(); }, 600);




    //Function to change Home Slider title
    function updateSliderTitle(selectedIndex) {
        var slide_title = $('.krea-welcome-slider .krea-welcome-slider-item').eq(selectedIndex).attr('data-title');
        var slide_href = $('.krea-welcome-slider .krea-welcome-slider-item').eq(selectedIndex).attr('data-href');
        if ( '' != slide_title) {
            $('.krea-welcome .krea-welcome-slider-title').html('<a href="' + slide_href + '">' + slide_title + '</a>');
        } else {
            $('.krea-welcome .krea-welcome-slider-title').html('');
        }
    }


});

