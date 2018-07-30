<?php
/**
 * Krea Theme Customizer.
 *
 * @package Krea
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function krea_customize_register( $wp_customize ) {


	/**
	 * Control for the PRO buttons
	 */
	class krea_Pro_Version extends WP_Customize_Control{
		public function render_content()
		{
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';



	/*
    Colors
    ===================================================== */
    	/*
		Featured
		------------------------------ */
		$wp_customize->add_setting( 'krea_hero_color', array( 'default' => '#0000ff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'krea_hero_color', array(
			'label'        => esc_html__( 'Featured Color', 'krea' ),
			'section'    => 'colors',
		) ) );

		/*
		Headings
		------------------------------ */
		$wp_customize->add_setting( 'krea_headings_color', array( 'default' => '#222222', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'krea_headings_color', array(
			'label'        => esc_html__( 'Headings Color', 'krea' ),
			'section'    => 'colors',
		) ) );

		/*
		Text
		------------------------------ */
		$wp_customize->add_setting( 'krea_text_color', array( 'default' => '#808080', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'krea_text_color', array(
			'label'        => esc_html__( 'Text Color', 'krea' ),
			'section'    => 'colors',
		) ) );

		/*
		Link
		------------------------------ */
		$wp_customize->add_setting( 'krea_link_color', array( 'default' => '#0000ff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'krea_link_color', array(
			'label'        => esc_html__( 'Link Color', 'krea' ),
			'section'    => 'colors',
		) ) );

		/*
		Footer Background
		------------------------------ */
		$wp_customize->add_setting( 'krea_footer_background', array( 'default' => '#ffffff', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'krea_footer_background', array(
			'label'        => esc_html__( 'Footer Background Color', 'krea' ),
			'section'    => 'colors',
		) ) );



	if ( class_exists( 'Kirki' ) ){

		Kirki::add_config( 'krea', array(
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
		) );

	}


    /*
    Site Options
    ===================================================== */

    $wp_customize->add_section( 'krea_site_options_section', array(
			'title' => esc_html__( 'Site Options', 'krea' ),
			'priority' => 140,
	) );

	$animations_options = array(
			'true' => esc_html__( 'Enable', 'krea' ),
			'false' => esc_html__( 'Disable', 'krea' ),
		);
	$wp_customize->add_setting( 'krea_site_animations', array( 'default' => 'true', 'sanitize_callback' => 'krea_sanitize_text', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'krea_site_animations', array(
        'label'   => esc_html__( 'Enable/Disable Site Animations', 'krea' ),
        'section' => 'krea_site_options_section',
        'settings'   => 'krea_site_animations',
        'type'       => 'select',
        'choices'    => $animations_options,
    ));






	/*
	Typography
	------------------------------ */
	$wp_customize->add_section( 'krea_typography_section', array(
		'title' => esc_html__( 'Typography', 'krea' ),
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'krea', array(
		    'type'     => 'select',
		    'settings' => 'krea_typography_font_family',
		    'label'    => esc_html__( 'Font Family', 'krea' ),
		    'section'  => 'krea_typography_section',
		    'default'  => 'Open Sans',
		    'priority' => 20,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'krea', array(
		    'type'     => 'select',
		    'settings' => 'krea_typography_font_family_headings',
		    'label'    => esc_html__( 'Headings Font Family', 'krea' ),
		    'section'  => 'krea_typography_section',
		    'default'  => 'Playfair Display',
		    'priority' => 22,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'krea', array(
		    'type'        => 'multicheck',
		    'settings'    => 'krea_typography_subsets',
		    'label'       => esc_html__( 'Google-Font subsets', 'krea' ),
		    'description' => esc_html__( 'The subsets used from Google\'s API.', 'krea' ),
		    'section'     => 'krea_typography_section',
		    'default'     => '',
		    'priority'    => 23,
		    'choices'     => Kirki_Fonts::get_google_font_subsets(),
		    'output'      => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-subset',
		        ),
		    ),
		) );

		Kirki::add_field( 'krea', array(
		    'type'      => 'slider',
		    'settings'  => 'krea_typography_font_size',
		    'label'     => esc_html__( 'Font Size', 'krea' ),
		    'section'   => 'krea_typography_section',
		    'default'   => 16,
		    'priority'  => 25,
		    'choices'   => array(
		        'min'   => 7,
		        'max'   => 48,
		        'step'  => 1,
		    ),
		    'output' => array(
		        array(
		            'element'  => 'html',
		            'property' => 'font-size',
		            'units'    => 'px',
		        ),
		    ),
		    'transport' => 'postMessage',
		    'js_vars'   => array(
		        array(
		            'element'  => 'html',
		            'function' => 'css',
		            'property' => 'font-size',
		            'units'    => 'px'
		        ),
		    ),
		) );
	}else{
		$wp_customize->add_setting( 'krea_typography_not_kirki', array( 'default' => '', 'sanitize_callback' => 'krea_sanitize_text', ) );
		$wp_customize->add_control( new krea_Display_Text_Control( $wp_customize, 'krea_typography_not_kirki', array(
			'section' => 'krea_typography_section', // Required, core or custom.
			'label' => sprintf( /* translators: 1: anchor link, 2: close anchor */ esc_html__( 'To change typography make sure you have installed the %1$s Kirki Toolkit %2$s plugin.', 'krea' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) . '">', '</a>' ),
		) ) );
	}//if Kirki exists


}
add_action( 'customize_register', 'krea_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function krea_customize_preview_js() {

	wp_register_script( 'krea_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'krea_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'krea_customizer_preview' );

}
add_action( 'customize_preview_init', 'krea_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function krea_customize_js() {

	wp_enqueue_script( 'krea_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls' ), '20151024', true );

}
add_action( 'customize_controls_enqueue_scripts', 'krea_customize_js' );










/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function krea_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, krea_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function krea_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize return pro version text
 */
function krea_pro_version( $input ) {
    return $input;
}

/**
 * Sanitize Any
 */
function krea_sanitize_any( $input ) {
    return $input;
}

/**
 * Sanitize Text
 */
function krea_sanitize_text( $str ) {
	return sanitize_text_field( $str );
}

/**
 * Sanitize URL
 */
function krea_sanitize_url( $url ) {
	return esc_url( $url );
}

/**
 * Sanitize Boolean
 */
function krea_sanitize_bool( $string ) {
	return (bool)$string;
}

/**
 * Sanitize Text with html
 */
function krea_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize array for multicheck
 * http://stackoverflow.com/a/22007205
 */
function krea_sanitize_multicheck( $values ) {

    $multi_values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $multi_values ) ) ? array_map( 'sanitize_title', $multi_values ) : array();
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function krea_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
}



/**
 * Create the "PRO version" buttons
 */
if ( ! function_exists( 'krea_pro_btns' ) ){
	function krea_pro_btns( $args ){

		$wp_customize = $args['wp_customize'];
		$title = $args['title'];
		$label = $args['label'];
		if ( isset( $args['priority'] ) || array_key_exists( 'priority', $args ) ) {
			$priority = $args['priority'];
		}else{
			$priority = 120;
		}
		if ( isset( $args['panel'] ) || array_key_exists( 'panel', $args ) ) {
			$panel = $args['panel'];
		}else{
			$panel = '';
		}

		$section_id = sanitize_title( $title );

		$wp_customize->add_section( $section_id , array(
			'title'       => $title,
			'priority'    => $priority,
			'panel' => $panel,
		) );
		$wp_customize->add_setting( $section_id, array(
			'sanitize_callback' => 'krea_pro_version'
		) );
		$wp_customize->add_control( new krea_Pro_Version( $wp_customize, $section_id, array(
	        'section' => $section_id,
	        'label' => $label
		   )
		) );
	}
}//end if function_exists

/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class krea_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	        ?>
			<p><?php echo wp_kses( $this->label, $wp_kses_args ); ?></p>
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_krea_get_image_src', 'krea_get_image_src' );
add_action( 'wp_ajax_krea_get_image_src', 'krea_get_image_src' );

function krea_get_image_src() {
	if ( isset( $_POST[ 'image_id' ] ) ) {
        $image_id = sanitize_text_field( wp_unslash( $_GET[ 'image_id' ] ) );
    }
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo wp_kses_post( $image );
	die();
}
