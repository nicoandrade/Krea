<?php
	//Bootstrap =======================================================
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7', 'all');
	//=================================================================

	//Flickity ======================================================
	wp_register_style( 'flickity', get_template_directory_uri() . '/css/flickity.css', array(), '4.1.1', 'all' );
	wp_enqueue_style( 'flickity' );
	//=================================================================


	wp_enqueue_style( 'krea_style', get_stylesheet_uri() );
