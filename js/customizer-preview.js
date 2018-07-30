/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Logo
	wp.customize( 'krea_logo', function( value ) {
		value.bind( function( to ) {
			if ( to != "" ) {
				var logo = '<img src="' + to + '" />';
				$( '.logo_container .ql_logo' ).html( logo );
			}else{
				$( '.logo_container .ql_logo' ).text( wp_customizer.site_name );
			}
		} );
	} );





	/*
    Colors
    =====================================================
    */
		//Featured Color
		wp.customize( 'krea_hero_color', function( value ) {
			value.bind( function( to ) {
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .wpb_wrapper .products .product-category h3, .btn-ql:active, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_bck, .krea-nav-btn:hover, .krea-nav-btn:active, .cd-popular .cd-select, .no-touch .cd-popular .cd-select:hover, .pace .pace-progress, .woocommerce .products .product .add_to_cart_button:hover, #ql_woo_cart .widget_shopping_cart_content a.button.checkout' ).css( {
						'background-color': to
				} );
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .btn-ql:active, .btn-ql.alternative, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_border, .pace .pace-activity, #ql_woo_cart .widget_shopping_cart_content a.button.checkout' ).css( {
						'border-color': to
				} );
				$( '.pagination .current, .pagination a:hover, .widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a, .read-more, .read-more i, .btn-ql.alternative, .hero_color, .cd-popular .cd-pricing-header, .cd-popular .cd-currency, .cd-popular .cd-duration, #sidebar .widget ul li > a:hover, #sidebar .widget_recent_comments ul li a:hover' ).css( {
						'color': to
				} );
			} );
		} );

		//Headings Color
		wp.customize( 'krea_headings_color', function( value ) {
			value.bind( function( to ) {
				$( 'h1:not(.site-title), h2, h3, h4, h5, h6, h1 a, h2, a, h3 a, h4 a, h5 a, h6 a' ).css( {
						'color': to
				} );
			} );
		} );
		//Logo Color  
		wp.customize( 'krea_logo_color', function( value ) {
			value.bind( function( to ) {
				$( '.logo_container .ql_logo' ).css( {
						'color': to
				} );
			} );
		} );
		//Text Color
		wp.customize( 'krea_text_color', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).css( {
						'color': to
				} );
			} );
		} );
		//Link Color
		wp.customize( 'krea_link_color', function( value ) {
			value.bind( function( to ) {
				$( 'a' ).css( {
						'color': to
				} );
			} );
		} );
		//Content Background Color
		wp.customize( 'krea_content_background_color', function( value ) {
			value.bind( function( to ) {
				$( '.ql_background_padding, .product_text, .blog article, search article, archive article, .woocommerce .product .summary .summary-top, .woocommerce .product .summary .entry, .woocommerce .product .summary .summary-bottom, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, #ql_load_more' ).css( {
						'background-color': to
				} );
			} );
		} );

		//Footer Background Color
		wp.customize( 'krea_footer_background', function( value ) {
			value.bind( function( to ) {
				$( '#footer, .footer-wrap' ).css( {
						'background-color': to
				} );
				$( '.footer-top ul li' ).css( {
						'border-bottom-color': to
				} );
			} );
		} );

		//Header Background Color
		wp.customize( 'krea_header_bck_color', function( value ) {
			value.bind( function( to ) {
				$( '#header, .single-product #header, .krea-sidenav #header, .top-bar, .single-product .top-bar' ).css( {
						'background-color': to
				} );
			} );
		} );

		//Header Lines Color
		wp.customize( 'krea_header_lines_color', function( value ) {
			value.bind( function( to ) {
				$( '.krea-sidenav #header .ql_cart-btn, #jqueryslidemenu ul.nav > li, .krea-sidenav #header .logo_container, .ql_cart-btn, #header, .single-product #header, .top-bar, .krea-sidenav #header, .logo_container::before, .krea-header-2 #header .logo_container::before, .krea-header-2 #header #ql_nav_collapse #jqueryslidemenu ul.nav > li, .krea-header-2 #header #ql_nav_collapse #jqueryslidemenu ul.nav > li:last-child, .krea-header-2 #header .ql_cart-btn' ).css( {
						'border-color': to
				} );
			} );
		} );


	/*
    Shop Options
    =====================================================
    */
	//Shop Layout
	wp.customize( 'krea_shop_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'masonry' == to ) {
				$container_isotope.isotope( args_isotope );
			}else{
				$container_isotope.isotope('destroy');
			}
		} );
	} );

	//Shop Columns
	wp.customize( 'krea_shop_columns', function( value ) {
		value.bind( function( to ) {
			$( '.products' ).removeClass( 'layout-4-columns layout-2-columns layout-3-columns' );
			$( '.products' ).addClass( 'layout-' + to + '-columns' );
			setTimeout(function(){ $container_isotope.isotope('layout'); }, 301);


		} );
	} );


	
	/*
    Site
    =====================================================
    */
    //Background Color
	wp.customize( 'krea_site_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
					'background-color': to
			} );
		} );
	} );







} )( jQuery );

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}






