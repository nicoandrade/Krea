<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Krea
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<!-- WP_Head -->
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>
<div class="krea-preloader"><div class="krea-spinner"><div class="krea-double-bounce1"></div><div class="krea-double-bounce2"></div></div></div>
<span class="krea-decoration-lines krea-decoration-lines1"></span><span class="krea-decoration-lines krea-decoration-lines2"></span><span class="krea-decoration-lines krea-decoration-lines3"></span><span class="krea-decoration-lines krea-decoration-lines4"></span>

    <div class="krea-site-wrap">
 
        <?php
        $header_image = "";
        if ( get_header_image() ){
            $header_image = get_header_image();
        }
         
        ?>
        <header id="header" class="site-header" <?php echo ( $header_image ) ? 'style="background-image: url(' . esc_url( $header_image ) . ');"' : ''; ?>>
                            
            <div class="container">

                <div class="row">            

                    <div class="logo_container col-md-12 col-sm-12 col-xs-12">
                        <?php
                        $logo = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="ql_logo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                        if ( has_custom_logo() ){
                            $logo = get_custom_logo();
                        }
                        ?>
                        <?php if ( is_front_page() ) : ?>
                            <h1 class="site-title"><?php echo wp_kses_post( $logo ); ?>&nbsp;</h1>
                        <?php else : ?>
                            <p class="site-title"><?php echo wp_kses_post( $logo ); ?></p>
                        <?php endif; ?>

                        <button id="krea-nav-btn" type="button" class="menu-toggle" data-toggle="collapse" aria-controls="primary-menu" aria-expanded="false">
                            <i class="fa fa-navicon"></i>
                        </button>

                    </div><!-- /logo_container -->

                    <div class="clearfix"></div>

                </div><!-- row-->

            </div><!-- /container -->

        </header>


    <main id="main" class="site-main ">

        <div id="container" class="container">

            <div class="row">
