<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Krea
 */

get_header(); ?>

	<?php

	if ( 'jetpack-portfolio' == get_post_type() ) :
	?>
		<div id="content" class="col-md-10 col-md-push-1">

			<?php get_template_part( 'template-parts/single-portfolio', 'single' ); ?>

		</div><!-- #content -->
	<?php
	else:
	?>

		<div id="content" class="site-content col-md-8" role="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php krea_post_navigation(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</div><!-- #content -->

	<?php endif; ?>
	
<?php 
if ( 'jetpack-portfolio' != get_post_type() ) {
	get_sidebar(); 
}

?>

<?php get_footer(); ?>
