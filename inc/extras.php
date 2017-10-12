<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Krea
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function krea_body_classes( $classes ) {

    $krea_theme_data = wp_get_theme();

    $classes[] = sanitize_title( $krea_theme_data['Name'] );
    $classes[] = 'v' . $krea_theme_data['Version'];

    $krea_slider_fullscreen = get_theme_mod( 'krea_slider_fullscreen', false );
    if ( class_exists( 'WooCommerce' ) ){
        if ( is_shop() && $krea_slider_fullscreen || isset( $_GET[ 'fullscreen_slider' ] ) ) {
            $classes[] = 'slider-fullscreen';
        }
    }

    // Add Animations Class
    $krea_site_animations = get_theme_mod( 'krea_site_animations', 'true' );
    if ( 'true' == $krea_site_animations ) {
        $classes[] = 'ql_animations ql_portfolio_animations';
    }


    //Add Single Portfolio classes
    if ( is_single() && krea_is_portfolio_type( get_post_type() ) ) :

        $classes[] = 'krea-portfolio-type';

	endif;

    //Add class for Blog Layout
    $krea_blog_layout = get_theme_mod( 'krea_blog_layout', 'layout-1' );
    if ( isset( $_GET[ 'blog_layout' ] ) ) {
        $krea_blog_layout = sanitize_text_field( wp_unslash( $_GET[ 'blog_layout' ] ) );
    }
    $classes[] = 'krea-blog-' . esc_attr( $krea_blog_layout );

    //Add class for Site Layout
    $krea_site_layout = get_theme_mod( 'krea_site_layout', 'default' );
    if ( isset( $_GET[ 'site_layout' ] ) ) {
        $krea_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
    }
    $classes[] = 'krea-' . esc_attr( $krea_site_layout );

    //Add class for Top Bar
    $krea_topbar_enable = get_theme_mod( 'krea_topbar_enable', 'default' );
    if ( isset( $_GET[ 'top_bar' ] ) || $krea_topbar_enable ) {
        $classes[] = 'krea-with-top-bar';
    }
    
    //Add class if there is Sidebar
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'krea-with-sidebar';
    }else{
        $classes[] = 'krea-with-out-sidebar';
    }

    //Add class for Header
    $krea_header_layout = get_theme_mod( 'krea_header_layout', 'header-1' );
    if ( isset( $_GET[ 'header_layout' ] ) ) {
        $krea_header_layout = sanitize_text_field( wp_unslash( $_GET[ 'header_layout' ] ) );
    }
    $classes[] = 'krea-' . esc_attr( $krea_header_layout );

    //Add class for Product View Enable/Disable
    $krea_shop_quick_view = get_theme_mod( 'krea_shop_quick_view', '1' );
    if ( '1' == $krea_shop_quick_view || isset( $_GET[ 'quick_view' ] ) ) {
        $classes[] = 'krea-product-view-enable';
    }else{
        $classes[] = 'krea-product-view-disable';
    }

    //Add class for Products delay animations
    $classes[] = 'krea-products-delay';

	return $classes;
}
add_filter( 'body_class', 'krea_body_classes' );


if ( ! function_exists( 'krea_new_content_more' ) ){
    function krea_new_content_more($more) {
           global $post;
           return ' <br><a href="' . esc_url( get_permalink() ) . '" class="more-link read-more">' . esc_html__( 'Read more', 'krea' ) . '</a>';
    }
}// end function_exists
    add_filter( 'the_content_more_link', 'krea_new_content_more' );


/**
 * Meta Slider configurations
 */
function krea_metaslider_default_slideshow_properties( $params ) {
        $params['width'] = 1450;
        $params['height'] = 700;
	return $params;
}
add_filter( 'metaslider_default_parameters', 'krea_metaslider_default_slideshow_properties', 10, 1 );

/**
 * Meta Slider referall ID
 */
function krea_metaslider_hoplink( $link ) {
    return "https://getdpd.com/cart/hoplink/15318?referrer=24l934xmnt6sc8gs";

}
add_filter( 'metaslider_hoplink', 'krea_metaslider_hoplink', 10, 1 );

/**
 * Retrieve sliders from Meta Slider plugin
 */
function krea_all_meta_sliders( $sort_key = 'date' ) {

    $sliders = array();

    // list the tabs
    $args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'orderby' => $sort_key,
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    $args = apply_filters( 'metaslider_all_meta_sliders_args', $args );

    // WP_Query causes issues with other plugins using admin_footer to insert scripts
    // use get_posts instead
    $all_sliders = get_posts( $args );

    foreach( $all_sliders as $slideshow ) {

        $sliders[] = array(
            'title' => $slideshow->post_title,
            'id' => $slideshow->ID
        );

    }

    return $sliders;

}


/**
 * Convert HEX colors to RGB
 */
function hex2rgb( $colour ) {
    $colour = str_replace("#", "", $colour);
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function get_portfolios_slug(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $krea_portfolio_types = Multiple_Portfolios::get_post_types();
        $krea_portfolio_types_slugs = array();
        foreach ( $krea_portfolio_types as $portfolio ) {
            $krea_portfolio_types_slugs[] = $portfolio['slug'];
        }
        return $krea_portfolio_types_slugs;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'krea' ) );
    }

 }


/**
* Return portfolios as option for Meta Box
*
* @return array
*/
function get_portfolios_options(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $krea_portfolio_types = Multiple_Portfolios::get_post_types();
        $krea_portfolio_types_option = array();
        foreach ( $krea_portfolio_types as $portfolio ) {
            $krea_portfolio_types_option[$portfolio['slug']] = $portfolio['name'];
        }
        return $krea_portfolio_types_option;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'krea' ) );
    }

}


/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function krea_is_portfolio_category( $category ){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $krea_portfolio_types = Multiple_Portfolios::get_post_types();
        $taxonomy_objects = get_object_taxonomies( 'portfolio' );

        foreach ( $krea_portfolio_types as $portfolio ) {
            $taxonomy_objects = get_object_taxonomies( $portfolio );
            $portfolio_tax_category = $taxonomy_objects[0]; //portfolio_category
            if ( $category == $portfolio_tax_category ) {
                return true;
            }
        }
        return false;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'krea' ) );
    }

 }


/**
* Avoid undefined functions if Meta Box is not activated
*
* @return bool
*/
if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}


/**
* Check if the post type is a Portfolio post type
*
* @return bool
*/
if ( ! function_exists( 'krea_is_portfolio_type' ) ) {
    function krea_is_portfolio_type( $post_type ) {

    	$krea_portfolios_post_types = get_portfolios_slug();
        if ( ! is_wp_error( $krea_portfolios_post_types ) ) {
        	if ( in_array( $post_type, $krea_portfolios_post_types ) ) :
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }

    }
}


/**
* Display Portfolio or Post navigation
*
* @return html
*/
if ( ! function_exists( 'krea_post_navigation' ) ) {
    function krea_post_navigation() {

        $post_nav_bck = '';
        $post_nav_bck_next = '';
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'krea_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;
        $next_post = get_next_post();
        if ( ! empty( $next_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'krea_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck_next = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;

        if ( ! empty( $prev_post ) || ! empty( $next_post ) ):
        ?>
            <nav class="navigation post-navigation" >
                <div class="nav-links">
                    <?php if ( ! empty( $prev_post ) ): ?>
                    <div class="nav-previous" <?php echo $post_nav_bck; ?>>
                        <?php
                        $prev_text = esc_html__( 'Previous Post', 'krea' );
                        if ( krea_is_portfolio_type( get_post_type() ) ) {
                            $prev_text = esc_html__( 'Previous Project', 'krea' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev"><span><?php echo $prev_text; ?></span><?php echo esc_html( $prev_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $next_post ) ): ?>
                    <div class="nav-next" <?php echo $post_nav_bck_next; ?>>
                        <?php
                        $next_text = esc_html__( 'Next Post', 'krea' );
                        if ( krea_is_portfolio_type( get_post_type() ) ) {
                            $next_text = esc_html__( 'Next Project', 'krea' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next"><span><?php echo $next_text; ?></span><?php echo esc_html( $next_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif;

    }
}

/**
* Return a darker color in HEX
*
* @return string
*/
function krea_darken_color( $rgb, $darker = 2 ) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}


/**
 * Enqueues front-end CSS for retina images of portfolio.
 *
 * @see wp_add_inline_style()
 */
function krea_portfolio_retina_images() {

    $custom_css = krea_get_portfolio_retina_css();

    wp_add_inline_style( 'krea_style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'krea_portfolio_retina_images' );


/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function krea_get_portfolio_retina_css() {


    $krea_portfolio_display = rwmb_meta( 'krea_portfolio_display' );
    $krea_retina_css = '';

    $args = array(
        'post_type'      => $krea_portfolio_display,
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {


        while ( $the_query->have_posts() ) { $the_query->the_post();

            if ( has_post_thumbnail() ) {
                $portfolio_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id(), 'krea_portfolio_2x' );

                $krea_retina_css .= "@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {";
                $krea_retina_css .= "#portfolio-item-" . esc_attr( get_the_ID() ) . "{ background-image: url(" . esc_url( $portfolio_image_2x[0] ) . "); }";
                $krea_retina_css .=  "}\n";
            }
            
        }//while


    }// if have posts
    wp_reset_postdata();


    $css = <<<CSS

    /*============================================
    // Retina Images
    ============================================*/
    {$krea_retina_css}
    


CSS;

    return $css;
}




/**
* Return CSS class for #content
*
* @return bool
*/
if ( ! function_exists( 'krea_content_css_class' ) ) {
    function krea_content_css_class() {

        if ( is_page_template( 'template-full-width.php' ) ) {
            return 'col-md-12';
        }
        if ( is_page_template( 'template-fullscreen.php' ) ) {
            return '';
        }

        $krea_site_layout = get_theme_mod( 'krea_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $krea_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        switch ( $krea_site_layout ) {
            case 'default':
                if ( is_single() && is_active_sidebar( 'sidebar-1' ) && ! is_singular( array( 'product' ) ) ) {
                    return 'col-md-6 col-md-push-2';
                }else{
                    return 'col-md-8 col-md-push-2';
                }
                break;

            case 'sidenav':
                if ( is_single() && is_active_sidebar( 'sidebar-1' ) && ! is_singular( array( 'product' ) ) ) {
                    return 'col-md-6 col-md-push-2';
                }else{
                    return 'col-md-8 col-md-push-2';
                }
                break;            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}



/**
* Return CSS class for #footer
*
* @return bool
*/
if ( ! function_exists( 'krea_footer_css_class' ) ) {
    function krea_footer_css_class() {

        $krea_site_layout = get_theme_mod( 'krea_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $krea_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        switch ( $krea_site_layout ) {
            case 'default':
                    return 'col-md-8 col-md-push-2';
                break;

            case 'sidenav':
                    return 'col-md-12';
                break;            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}

/**
* Return CSS class for Shop Page
*
* @return bool
*/
if ( ! function_exists( 'krea_shop_css_class' ) ) {
    function krea_shop_css_class() {

        $krea_shop_page_layout = get_theme_mod( 'krea_shop_page_layout', 'shop-narrow' );
        if ( isset( $_GET[ 'shop_page_layout' ] ) ) {
            $krea_shop_page_layout = sanitize_text_field( wp_unslash( $_GET[ 'shop_page_layout' ] ) );
        }

        switch ( $krea_shop_page_layout ) {
            case 'shop-narrow':
                return 'col-md-8 col-md-push-2';
                break;

            case 'shop-fullwidth':
                return 'col-md-12';
                break;
            
            default:
                return 'col-md-8 col-md-push-2';
                break;
        }

    }
}


/**
* Return CSS class for Container
*
* @return bool
*/
if ( ! function_exists( 'krea_container_css_class' ) ) {
    function krea_container_css_class() {
        $krea_site_layout = get_theme_mod( 'krea_site_layout', 'default' );
        if ( isset( $_GET[ 'site_layout' ] ) ) {
            $krea_site_layout = sanitize_text_field( wp_unslash( $_GET[ 'site_layout' ] ) );
        }

        //Default
        $container_css_class = 'container';

         if ( ! is_singular( array( 'product' ) ) ) {
    
            if( 'default' == $krea_site_layout ){

                $krea_shop_page_layout = get_theme_mod( 'krea_shop_page_layout', 'shop-narrow' );
                if ( isset( $_GET[ 'shop_page_layout' ] ) ) {
                    $krea_shop_page_layout = sanitize_text_field( wp_unslash( $_GET[ 'shop_page_layout' ] ) );
                }

                //If it is Shop or Shop Archive page, show as full width.
                if ( function_exists( 'is_shop' ) ) {
                    if ( ( is_shop() || is_product_category() ) && 'shop-fullwidth' == $krea_shop_page_layout ) {
                        $container_css_class = 'container-fluid';                    
                    }
                }
                

            }elseif( 'sidenav' == $krea_site_layout ){
                $container_css_class = 'container-fluid';
            }
        }

        if ( is_page_template( 'template-full-width.php' ) ) {
            $container_css_class = 'container-fluid';
        }
        if ( is_page_template( 'template-fullscreen.php' ) ) {
            $container_css_class = '';
        }

        return $container_css_class;

    }
}

/**
* Return CSS class for Main
*
* @return bool
*/
if ( ! function_exists( 'krea_main_css_class' ) ) {
    function krea_main_css_class() {
        //Default
        $main_css_class = 'row';

        if ( is_page_template( 'template-fullscreen.php' ) ) {
            $main_css_class = '';
        }

        return $main_css_class;

    }
}



/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function krea_get_svg( $args = array() ) {
    // Make sure $args are an array.
    if ( empty( $args ) ) {
        return __( 'Please define default parameters in the form of an array.', 'krea' );
    }

    // Define an icon.
    if ( false === array_key_exists( 'icon', $args ) ) {
        return __( 'Please define an SVG icon filename.', 'krea' );
    }

    // Set defaults.
    $defaults = array(
        'icon'        => '',
        'title'       => '',
        'desc'        => '',
        'fallback'    => false,
    );

    // Parse args.
    $args = wp_parse_args( $args, $defaults );

    // Set aria hidden.
    $aria_hidden = ' aria-hidden="true"';

    // Set ARIA.
    $aria_labelledby = '';

    /*
     * Twenty Seventeen doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
     *
     * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
     *
     * Example 1 with title: <?php echo krea_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
     *
     * Example 2 with title and description: <?php echo krea_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
     *
     * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
     */
    if ( $args['title'] ) {
        $aria_hidden     = '';
        $unique_id       = uniqid();
        $aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

        if ( $args['desc'] ) {
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
        }
    }

    // Begin SVG markup.
    $svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

    // Display the title.
    if ( $args['title'] ) {
        $svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

        // Display the desc only if the title is already set.
        if ( $args['desc'] ) {
            $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
        }
    }

    /*
     * Display the icon.
     *
     * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
     *
     * See https://core.trac.wordpress.org/ticket/38387.
     */
    $svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

    // Add some markup to use as a fallback for browsers that do not support SVGs.
    if ( $args['fallback'] ) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
    }

    $svg .= '</svg>';

    return $svg;
}


/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function krea_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
    if ( 'primary' === $args->theme_location ) {
        foreach ( $item->classes as $value ) {
            if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
                $title = $title . '<i class="fa-angle-down fa icon"></i>';
            }
        }
    }

    return $title;
}
add_filter( 'nav_menu_item_title', 'krea_dropdown_icon_to_menu_link', 10, 4 );



/**
 * Scrapper for Instagram
 *
 * @param  string $username instagram user.
 * @param  string $max_id  .
 */
// based on https://gist.github.com/cosmocatalano/4544576
    function krea_scrape_instagram( $username, $max_id = '' ) {

        $username = strtolower( $username );
        $username = str_replace( '@', '', $username );

        if ( ! empty( $max_id ) ) {
            $instagram = get_transient( 'olivo-instagram-a10-' . sanitize_title_with_dashes( $username ) . '-' . sanitize_title_with_dashes( $max_id ) );
        }else{
            $instagram = get_transient( 'olivo-instagram-a10-' . sanitize_title_with_dashes( $username ) );
        }

        if ( false === $instagram ) {

            $add_par = '';
            if ( $max_id ) {
               $add_par = '/?max_id=' . sanitize_title_with_dashes( $max_id );
            }
            $remote = wp_remote_get( 'http://instagram.com/' . trim( $username ) . $add_par );

            if ( is_wp_error( $remote ) )
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'olivo' ) );

            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'olivo' ) );

            $shards = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], TRUE );

            if ( ! $insta_array )
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'olivo' ) );

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'olivo' ) );
            }
            

            if ( ! is_array( $images ) )
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'olivo' ) );

            $instagram = array();

            foreach ( $images as $image ) {

                $image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
                $image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

                // handle both types of CDN url
                if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
                    $image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
                    $image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
                } else {
                    $urlparts = wp_parse_url( $image['thumbnail_src'] );
                    $pathparts = explode( '/', $urlparts['path'] );
                    array_splice( $pathparts, 3, 0, array( 's160x160' ) );
                    $image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
                    $pathparts[3] = 's320x320';
                    $image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
                }

                $image['large'] = $image['thumbnail_src'];

                if ( $image['is_video'] == true ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = esc_html__( 'Instagram Image', 'olivo' );
                if ( ! empty( $image['caption'] ) ) {
                    $caption = $image['caption'];
                }

                $instagram[] = array(
                    'id'   => $image['id'],
                    'description'   => $caption,
                    'link'          => trailingslashit( '//instagram.com/p/' . $image['code'] ),
                    'time'          => $image['date'],
                    'comments'      => $image['comments']['count'],
                    'likes'         => $image['likes']['count'],
                    'thumbnail'     => $image['thumbnail'],
                    'small'         => $image['small'],
                    'large'         => $image['large'],
                    'original'      => $image['display_src'],
                    'dimensions'      => $image['dimensions'],
                    'type'          => $type
                );
            }

            // do not set an empty transient - should help catch private or empty accounts
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                if ( ! empty( $max_id ) ) {
                    set_transient( 'olivo-instagram-a10-' . sanitize_title_with_dashes( $username ) . '-' . sanitize_title_with_dashes( $max_id ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
                }else{
                    set_transient( 'olivo-instagram-a10-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
                }
            }
        }

        if ( ! empty( $instagram ) ) {

            return unserialize( base64_decode( $instagram ) );

        } else {

            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'olivo' ) );

        }
    }
