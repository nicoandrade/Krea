<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Krea
 */

get_header(); ?>

	<div id="content" class="col-md-12">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			if ( 'jetpack-portfolio' == get_post_type() ) {

				echo "<div class='krea-portfolio-container krea-portfolio-half' data-post-type='" . esc_attr( get_post_type() ) . "'>\n\n";
				/* Start the Loop */
				while ( have_posts() ) : the_post();

				    echo '<div class="krea-portfolio-item krea-track">';
						echo '<div class="krea-portfolio-item-image">';
                        echo "\t\t\t\t<a href='" . esc_url( get_permalink() ) . "'>\n";
                            
                            the_post_thumbnail( 'krea_post' );
                        echo "\t\t\t\t</a>\n";

                        echo '</div>';
                        the_title( sprintf( '<h4 class="krea-portfolio-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                    echo '</div>';

				endwhile;
				echo "</div><!-- .krea-portfolio-container -->\n\n";

				get_template_part( 'template-parts/pagination', 'portfolio' );


			}else{
			?>
			
			<div class="krea-post-wrapper">
			
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
					?>

				<?php endwhile; ?>

			</div><!-- /krea-post-wrapper -->

				<?php get_template_part( 'template-parts/pagination', 'archive' ); ?>

			<?php }//is_tax() ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</div><!-- /content -->


<?php get_footer(); ?>
