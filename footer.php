<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Krea
 */

?>

            </div><!-- /#row -->

        </div><!-- /#container -->

    </main><!-- #main -->
        



    <div class="footer-wrap">

    	<div class="sub-footer">
            <div class="container">

                <div class="row">

                    <div class="col-md-6 col-sm-6">

                        <p><?php esc_html_e( '&copy; Copyright', 'krea' ); ?> <?php echo esc_html( date('Y') ); ?> <a rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( bloginfo( 'name' ) ); ?></a></p>

                    </div>
                    <div class="col-md-6 col-sm-6">

                        <?php get_template_part( '/template-parts/social-menu', 'footer' ); ?>

                    </div>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .sub-footer -->
    </div><!-- .footer-wrap -->

</div><!-- /krea-site-wrap -->



<div class="krea-main-menu">
    <a href="#" class="krea-close-menu"></a>
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'krea' ); ?>">
        <?php wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
        ) ); ?>
    </nav><!-- #site-navigation -->
        
</div><!-- /krea-main-menu -->



<?php wp_footer(); ?>

</body>
</html>
