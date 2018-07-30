<?php

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @see wp_add_inline_style()
 */
function krea_custom_css() {
	/*
	Colors
	*/
	$heroColor = esc_attr( get_theme_mod( 'krea_hero_color', '#0000ff' ) );
	$headings_color = esc_attr( get_theme_mod( 'krea_headings_color', '#222222' ) );
	$text_color = esc_attr( get_theme_mod( 'krea_text_color', '#777777' ) );
	$link_color = esc_attr( get_theme_mod( 'krea_link_color', '#0000ff' ) );
	$content_background_color = esc_attr( get_theme_mod( 'krea_content_background_color', '#FFFFFF' ) );
	$footer_background = esc_attr( get_theme_mod( 'krea_footer_background', '#FFFFFF' ) );
	$site_background_color = esc_attr( get_theme_mod( 'krea_site_background_color', '#e08461' ) );
	$logo_color = esc_attr( get_theme_mod( 'krea_logo_color', '#222222' ) );

	$colors = array(
		'heroColor'      => $heroColor,
		'headings_color' => $headings_color,
		'text_color'     => $text_color,
		'link_color'     => $link_color,
		'content_background_color'     => $content_background_color,
		'footer_background'     => $footer_background,
		'site_background_color'     => $site_background_color,
		'logo_color'     => $logo_color,

	);

	$custom_css = krea_get_custom_css( $colors );

	wp_add_inline_style( 'krea_style', $custom_css );



	/*
	Typography
	*/
	$krea_typography_font_family = get_theme_mod( 'krea_typography_font_family', 'Source Sans Pro' );
	$krea_typography_font_family_headings = get_theme_mod( 'krea_typography_font_family_headings', 'Inconsolata' );
	$krea_typography_subsets = get_theme_mod( 'krea_typography_subsets', '' );
	$krea_typography_font_size = esc_attr( get_theme_mod( 'krea_typography_font_size', '16' ) );

	$typography = array(
		'font-family' 		   => $krea_typography_font_family,
		'font-family-headings' => $krea_typography_font_family_headings,
		'font-size'     	   => $krea_typography_font_size,
	);

	//Add Google Fonts
	$krea_font_subset = '';
	if ( is_array( $krea_typography_subsets ) ) {
		$krea_font_subset = '&subset=';
		foreach ( $krea_typography_subsets as $subset ) {
			$krea_font_subset .= $subset . ',';
		}
		$krea_font_subset = rtrim( $krea_font_subset, ',' );
	}

	$krea_google_font = '//fonts.googleapis.com/css?family=' . esc_attr( $krea_typography_font_family ) . ':400,700' . esc_attr( $krea_font_subset );
	wp_enqueue_style( 'krea_google-font', $krea_google_font, array(), '1.0', 'all');

	$krea_google_font_headings = '//fonts.googleapis.com/css?family=' . esc_attr( $krea_typography_font_family_headings ) . ':400,700' . esc_attr( $krea_font_subset );
	wp_enqueue_style( 'krea_google-font-headings', $krea_google_font_headings, array(), '1.0', 'all');

	$custom_css = krea_get_custom_typography_css( $typography );

	wp_add_inline_style( 'krea_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'krea_custom_css' );



/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function krea_get_custom_css( $colors ) {

	//Default colors
	$colors = wp_parse_args( $colors, array(
		'heroColor'            => '#0000ff',
		'headings_color'       => '#222222',
		'text_color'           => '#777777',
		'link_color'           => '#0000ff',
		'content_background_color'           => '#FFFFFF',
		'footer_background'     => '#FFFFFF',
		'site_gradient'     => '1',
		'site_background_color'     => '#e08461',
		'logo_color'     => '#222222',
		'quick_view_bck'      => '#efefef',
		
	) );
	$heroColor_darker = krea_darken_color( $colors['heroColor'], 1.1 );
	$link_color_darker = krea_darken_color( $colors['link_color'], 1.2 );
	$heroColor_rgb = krea_hex2rgb( $colors['heroColor'] );

	$css = <<<CSS

	/* Text Color */
	body{
		color: {$colors['text_color']};
	}
	h1:not(.site-title), h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
	.blog-hype #content .post .entry-header .post-title a:hover{
		color: {$colors['headings_color']};
	}
	/* Link Color */
	a{
		color: {$colors['link_color']};
	}
	a:hover{
		color: {$link_color_darker};
	}



	/*============================================
	// Featured Color
	============================================*/

	/* Background Color */
	.pagination li.active a,
	.section-title::before,
	.ql_primary_btn,
	#jqueryslidemenu ul.nav > li > ul > li a:hover,
	#jqueryslidemenu .navbar-toggle .icon-bar,
	.krea-home-slider-fullscreen .slider-fullscreen-controls .prevnext-button,
	.pace .pace-progress,
	.woocommerce nav.woocommerce-pagination ul li a:focus, 
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.ql_woo_cart_button:hover,
	.ql_woo_cart_close,
	.woocommerce .woocommerce-MyAccount-navigation ul .woocommerce-MyAccount-navigation-link.is-active a,
	.woocommerce_checkout_btn,
	.post-navigation .nav-next a:hover::before, .post-navigation .nav-previous a:hover::before,
	.woocommerce #main .single_add_to_cart_button,
	.krea-contact-form input[type='submit'],
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
	.contact-form input[type="submit"],
	.portfolio-load-wrapper .portfolio-load-more,
	.krea-preloader .krea-folding-cube .krea-cube::before,
	#ql_load_more,
	.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
	.no-touch .ql_secundary_btn:hover,
	.no-touch .krea-mini-cart .woocommerce-mini-cart__buttons .button:hover,
	.krea-mini-cart .woocommerce-mini-cart__buttons .button.checkout,
	.ql_woocommerce_categories ul li.current a,
	.woocommerce #main .products li.product .product_text .button, 
	.woocommerce-page .products li.product .product_text .button, 
	.woocommerce ul.products li.product .product_text .button, 
	ul.products li.product .product_text .button, 
	.woocommerce #main .products li.product .product_text .add_to_cart_button, 
	.woocommerce-page .products li.product .product_text .add_to_cart_button, 
	.woocommerce ul.products li.product .product_text .add_to_cart_button, 
	ul.products li.product .product_text .add_to_cart_button, 
	.woocommerce #main .products li.product .product_text .product_type_external, 
	.woocommerce-page .products li.product .product_text .product_type_external, 
	.woocommerce ul.products li.product .product_text .product_type_external, 
	ul.products li.product .product_text .product_type_external,
	.krea-product-view .krea-product-desc .summary .entry a.button, 
	.woocommerce .krea-product-view .krea-product-desc .summary .entry a.button,
	.no-touch .main-navigation ul ul a:hover,
	.woocommerce #main .single_add_to_cart_button, .woocommerce .krea-product-view button.single_add_to_cart_button, 
	.woocommerce .krea-product-view a.single_add_to_cart_button,
	.no-touch .woocommerce #review_form #respond .form-submit input:hover, 
	.no-touch .woocommerce-page #review_form #respond .form-submit input:hover,
	.no-touch .woocommerce-cart .actions input[type='submit']:hover,
	.no-touch .woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.no-touch .woocommerce-account .edit:hover,
	.woocommerce #respond input#submit, 
	.woocommerce a.button, .woocommerce button.button, 
	.woocommerce input.button,
	.no-touch .post-password-form input[type='submit']:hover,
	.krea-double-bounce1, 
	.krea-double-bounce2,
	.krea-welcome .krea-welcome-text-wrap .krea-welcome-text span,
	.krea-preloader .krea-double-bounce1, 
	.krea-preloader .krea-double-bounce2
	{
		background-color: {$colors['heroColor']};
	}

	/* Border Color */
	.pagination li.active a,
	.pagination li.active a:hover,
	.section-title::after,
	.pace .pace-activity,
	.ql_woocommerce_categories ul li.current, .ql_woocommerce_categories ul li:hover,
	.woocommerce_checkout_btn,
	.ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field,
	.touch .ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field
	.krea-contact-form input[type='text']:focus,
	.krea-contact-form input[type='email']:focus,
	.krea-contact-form textarea:focus,
	.ql_secundary_btn,
	.krea-mini-cart .woocommerce-mini-cart__buttons .button,
	.woocommerce #review_form #respond .form-submit input, 
	.woocommerce-page #review_form #respond .form-submit input,
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce-account .edit,
	.ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field, 
	.touch .ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field, 
	.ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field-0, 
	.touch .ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field-0,
	.post-password-form input[type='submit']
	{
		border-color: {$colors['heroColor']};
	}

	/* Color */
	.pagination li.active a:hover,
	.single .post .entry-footer .metadata ul li a,
	#comments .comment-list .comment.bypostauthor .comment-body,
	#respond input,
	#respond textarea,
	.widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a,
	.style-title span,
	.ql_filter ul li.active a,
	.ql_filter ul li a:hover,
	.ql_filter .ql_filter_count .current,
	.portfolio-slider .portfolio-item .portfolio-item-title,
	.portfolio-slider .portfolio-slider-controls .prevnext-button,
	.portfolio-multiple-slider .portfolio-item .portfolio-item-title,
	.portfolio-multiple-slider .portfolio-slider-controls .prevnext-button,
	.single-portfolio-container .portfolio-item .portfolio-item-title,
	.ql_cart-btn:hover,
	.ql_cart-btn:focus,
	.ql_woocommerce_categories ul li a:hover,
	.woocommerce #main .products .product .price, .woocommerce-page .products .product .price,
	.woocommerce a.added_to_cart,
	.woocommerce div.product .woocommerce-product-rating,
	.woocommerce #main .price,
	.woocommerce #main .single_variation_wrap .price,
	.woocommerce-cart .cart .cart_item .product_text .amount,
	.ql_woo_cart_close:hover,
	#ql_woo_cart ul.cart_list li .product_text .amount,
	#ql_woo_cart .widget_shopping_cart_content .total,
	.woocommerce_checkout_btn:hover,
	.woocommerce .star-rating,
	.widget .amount,
	.post-navigation .nav-next a,
	.post-navigation .nav-previous a,
	.welcome-section .welcome-title,
	.question,
	.krea-contact-form .krea-contact-form-text,
	.krea-contact-form input[type='text'],
	.krea-contact-form input[type='email'],
	.krea-contact-form textarea,
	#jqueryslidemenu ul.nav > li > ul > li.current_page_item > a, 
	#jqueryslidemenu ul.nav > li > ul > li.current_page_parent > a,
	.woocommerce p.stars a,
	.ql_cart-btn .count,
	#jqueryslidemenu ul.nav > li > a:hover,
	.ql_secundary_btn,
	.vc_toggle_title > h4,
	.krea-mini-cart .woocommerce-mini-cart__buttons .button,
	.krea-product-view .krea-product-desc .summary .entry .price, 
	.woocommerce .krea-product-view .krea-product-desc .summary .entry .price,
	.krea-login-btn:hover, 
	.krea-login-btn:focus,
	.woocommerce #review_form #respond .form-submit input, 
	.woocommerce-page #review_form #respond .form-submit input,
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce-account .edit,
	.woocommerce a.added_to_cart,
	.post-password-form input[type='submit'],
	.post-navigation .nav-next a::before, 
	.post-navigation .nav-previous a::before
	{
		color: {$colors['heroColor']};
	}

	/* Fill */
	.entry-header .svg-title li .krea-vertical-simple .st0,
	.page-header .svg-title li .krea-vertical-simple .st0,
	.flickity-prev-next-button .arrow,
	.krea-home-slider .flickity-page-dots .dot .is-selected .krea-vertical-simple .st0,
	.portfolio-slider .flickity-page-dots .dot.is-selected .krea-vertical-simple .st0,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .krea-vertical-simple .st0,
	.krea-home-slider .flickity-prev-next-button .arrow,
	.krea-home-slider .flickity-prev-next-button .arrow,
	.krea-home-slider .flickity-page-dots .dot.is-selected .krea-vertical-simple .st0
	{
		fill: {$colors['heroColor']};
	}

	/* Stroke */
	.entry-header .svg-title li .krea-vertical-simple .st1,
	.page-header .svg-title li .krea-vertical-simple .st1,
	.krea-vertical path,
	.ql-svg-inline .g-svg,
	#jqueryslidemenu .current_page_item a, #jqueryslidemenu .current_page_parent a,
	.krea-home-slider .flickity-page-dots .dot .is-selected .krea-vertical-simple .st1,
	.ql_filter .ql_filter_count .krea-count-svg path,
	.portfolio-slider .flickity-page-dots .dot.is-selected .krea-vertical-simple .st1,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .krea-vertical-simple .st1
	{
		stroke: {$colors['heroColor']};
	}

	/* Darker Background Color */
	.no-touch .ql_primary_btn:hover,
	.no-touch .woocommerce #main .single_add_to_cart_button:hover,
	.no-touch .krea-contact-form input[type='submit']:hover,
	.no-touch .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.no-touch .woocommerce #payment #place_order:hover, 
	.no-touch .woocommerce-page #payment #place_order:hover,
	.contact-form input[type="submit"]:hover,
	.no-touch .portfolio-load-wrapper .portfolio-load-more:hover,
	.no-touch #ql_load_more:hover,
	.no-touch .krea-mini-cart .woocommerce-mini-cart__buttons .button.checkout:hover,
	.no-touch .woocommerce #main .products li.product .product_text .button:hover, 
	.no-touch .woocommerce-page .products li.product .product_text .button:hover, 
	.no-touch .woocommerce ul.products li.product .product_text .button:hover, 
	.no-touch ul.products li.product .product_text .button:hover, 
	.no-touch .woocommerce #main .products li.product .product_text .add_to_cart_button:hover, 
	.no-touch .woocommerce-page .products li.product .product_text .add_to_cart_button:hover, 
	.no-touch .woocommerce ul.products li.product .product_text .add_to_cart_button:hover, 
	.no-touch ul.products li.product .product_text .add_to_cart_button:hover, 
	.no-touch .woocommerce #main .products li.product .product_text .product_type_external:hover, 
	.no-touch .woocommerce-page .products li.product .product_text .product_type_external:hover, 
	.no-touch .woocommerce ul.products li.product .product_text .product_type_external:hover, 
	.no-touch ul.products li.product .product_text .product_type_external:hover,
	.no-touch .woocommerce #main .single_add_to_cart_button:hover, 
	.no-touch .woocommerce .krea-product-view button.single_add_to_cart_button:hover, 
	.no-touch .woocommerce .krea-product-view a.single_add_to_cart_button:hover,
	.no-touch .woocommerce #respond input#submit:hover, 
	.no-touch .woocommerce a.button:hover, 
	.no-touch .woocommerce button.button:hover, 
	.no-touch .woocommerce input.button:hover
	{
		background-color: {$heroColor_darker};
	}

	/* Faded Background Color */
	.portfolio-container .portfolio-item .portfolio-item-hover,
	.krea_team_member .krea_team_hover,
	{
		background-color: rgba( {$heroColor_rgb['red']}, {$heroColor_rgb['green']}, {$heroColor_rgb['blue']}, 0.88 );
	}

	/* Footer Background Color */
	.footer-wrap
	{
		background-color: {$colors['footer_background']};
	}

	/* Logo Color */
	.logo_container .ql_logo
	{
		color: {$colors['logo_color']};
	}

	/* Quick View Background Color */
	.krea-product-view, 
	.woocommerce .krea-product-view
	{
		background-color: {$colors['quick_view_bck']};
	}


CSS;

	return $css;
}


/**
 * Returns CSS for the typography styles.
 *
 * @param array $typography typography.
 * @return string CSS.
 */
function krea_get_custom_typography_css( $typography  ) {

	//Default colors
	$typography = wp_parse_args( $typography, array(
		'font-family'           => '"Open Sans"',
		'font-family-headings'  => '"Playfair Display"',
		'font-size'             => '16',
	) );

	$css = <<<CSS

	/* Typography */
	body{
		font-family: {$typography['font-family']};
		font-size: {$typography['font-size']}px;
	}
	.logo_container .ql_logo,
	.post-navigation .nav-next a span, .post-navigation .nav-previous a span
	{
		font-family: {$typography['font-family']};
	}
	h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	.metadata,
	.pagination a, .pagination span,
	.ql_primary_btn,
	.ql_secundary_btn,
	.ql_woocommerce_categories ul li,
	.sidebar_btn,
	.woocommerce #main .products .product .product_text, .woocommerce-page .products .product .product_text,
	.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
	.woocommerce #main .price,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce-cart .cart .cart_item .product_text .price,
	#jqueryslidemenu ul.nav > li,
	.sub-footer,
	.ql_filter ul li,
	.post-navigation .nav-next a, .post-navigation .nav-previous a,
	.read-more,
	.portfolio-load-wrapper .portfolio-load-more,
	.woocommerce .woocommerce-breadcrumb,
	#main .woocommerce-result-count,
	#ql_load_more,
	.woocommerce #main .single_add_to_cart_button,
	.contact-form input[type="submit"],
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
	.krea-offer-banner .krea-offer-banner-countdown .krea-offer-banner-time,
	.krea-product-metadata,
	.krea-product-view .krea-product-desc .summary .entry .price, .woocommerce .krea-product-view .krea-product-desc .summary .entry .price,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.main-navigation ul,
	.krea-mini-cart .woocommerce-mini-cart li.woocommerce-mini-cart-item,
	.krea-mini-cart .woocommerce-mini-cart__buttons .button,
	.krea-mini-cart .woocommerce-mini-cart__buttons .button.checkout,
	.woocommerce #main .single_add_to_cart_button, 
	.woocommerce .krea-product-view button.single_add_to_cart_button, 
	.woocommerce .krea-product-view a.single_add_to_cart_button
	{
		font-family: {$typography['font-family-headings']};
	}

CSS;

	return $css;
}
