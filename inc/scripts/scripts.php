<?php

	//HTML5 Shiv ==============================================
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3', true );
	//=================================================================

	//hoverIntent Plugin ==============================================
	wp_enqueue_script( 'hoverIntent' );
	//=================================================================

	//Modernizr Plugin ================================================
	wp_enqueue_script( 'krea_modernizr', get_template_directory_uri() . '/js/modernizr.min.js', '2.8.3', true );
	//=================================================================

	//Pace  ===========================================================
	wp_enqueue_script( 'pace', get_template_directory_uri() . '/js/pace.min.js', array(), '1.0.2', true );
	//=================================================================

	//appear  ===========================================================
	wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/appear.min.js', array(), '1.0.3', true );
	//=================================================================

	//Flickity  ===========================================================
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), '2.0.5', true );
	//=================================================================

	//Bootstrap JS ========================================
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );
	//=================================================================

	//Comment Reply ===================================================
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//=================================================================

	//Navigation Menu ===================================================
	wp_enqueue_script( 'krea-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '1.0', true );
	$krea_l10n = array(
		'quote'          => krea_get_svg( array( 'icon' => 'quote-right' ) ),
	);
	$krea_l10n['expand']         = __( 'Expand child menu', 'krea' );
	$krea_l10n['collapse']       = __( 'Collapse child menu', 'krea' );
	$krea_l10n['icon']           = krea_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	wp_localize_script( 'krea-navigation', 'krea_ScreenReaderText', $krea_l10n );
	//=================================================================


	//Customs Scripts =================================================
	wp_enqueue_script( 'krea_theme-custom', get_template_directory_uri() . '/js/script.js', array( 'jquery', 'bootstrap' ), '1.0', true );
	$krea_custom_js = array(
		'admin_ajax' => admin_url( 'admin-ajax.php' ),
		'token' => wp_create_nonce( 'quemalabs-secret' )
	);
	wp_localize_script( 'krea_theme-custom', 'krea', $krea_custom_js );
	//=================================================================
