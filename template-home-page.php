<?php
/*
Template Name: Home Page
*/
?>
<?php
/**
 * The template for Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Krea
 */

get_header(); ?>

	<div id="content" class="col-md-12">


		<div class="krea-welcome krea-track">
            <div class="krea-welcome-slider-wrap col-md-7">
                
				<?php
				$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '10' );
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				$args = array(
				    'post_type'      => 'jetpack-portfolio',
				    'paged'          => $paged,
					'posts_per_page' => $posts_per_page,
				);
				$the_query = new WP_Query( $args );
				if ( $the_query->have_posts() ) {

				    echo '<div class="krea-welcome-slider">';

						    while ( $the_query->have_posts() ) { $the_query->the_post();
							
								echo '<div class="krea-welcome-slider-item" data-title="' . esc_attr( get_the_title() ) . '" data-href="' . esc_url( get_permalink() ) . '">';
			                        echo "\t\t\t\t<a href='" . esc_url( get_permalink() ) . "'>\n";
			                            
			                            the_post_thumbnail( 'krea_post' );
			                        echo "\t\t\t\t</a>\n";
			                    echo '</div>';
						        
						    }//while

				    echo '</div><!-- .krea-welcome-slider -->';

				}// if have posts
				wp_reset_postdata();
				?>

                <h3 class="krea-welcome-slider-title"><a href="#"></a></h3>

                
            </div>
			
			<?php while ( have_posts() ) : the_post(); ?>
            	<div class="krea-welcome-text-wrap col-md-5">
            		<?php the_content(); ?>
            	</div>
            <?php endwhile; // End of the loop. ?>
            <div class="clearfix"></div>
        </div>

		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
