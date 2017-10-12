<?php
/*
Template Name: Portfolio Half
*/
?>
<?php
/**
 * The template for Portfolio Half
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Krea
 */

get_header(); ?>

	<div id="content" class="col-md-12">

		<?php
		$krea_show_title = rwmb_meta( 'krea_show_title' );
		if ( 'no' != $krea_show_title ) {
		?>
			<header class="page-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .page-header -->
		<?php } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$krea_page_content = get_the_content();
				if ( ! empty( $krea_page_content ) ) {
				?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php } ?>

			</article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>
		

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

		    echo '<div class="krea-portfolio-container krea-portfolio-half">';

				    while ( $the_query->have_posts() ) { $the_query->the_post();
					
						echo '<div class="krea-portfolio-item krea-track">';
							echo '<div class="krea-portfolio-item-image">';
	                        echo "\t\t\t\t<a href='" . esc_url( get_permalink() ) . "'>\n";
	                            
	                            the_post_thumbnail( 'krea_post' );
	                        echo "\t\t\t\t</a>\n";

	                        echo '</div>';
	                        the_title( sprintf( '<h4 class="krea-portfolio-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
	                    echo '</div>';
				        
				    }//while

		    echo '</div><!-- /krea-portfolio-container -->';

		}// if have posts
		wp_reset_postdata();
		?>


		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
