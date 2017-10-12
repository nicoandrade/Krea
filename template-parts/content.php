<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Krea
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            	<?php 
            	$krea_thumbnail_size = 'krea_post';
            	$krea_blog_layout = get_theme_mod( 'krea_blog_layout', 'layout-1' );
            	if ( isset( $_GET[ 'blog_layout' ] ) && 'layout-4' == $_GET[ 'blog_layout' ] || 'layout-4' == $krea_blog_layout ) {
			        $krea_thumbnail_size = 'krea_post_wide';
			    }
            	?>
                <?php the_post_thumbnail( $krea_thumbnail_size ); ?>
            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content">

			<header class="entry-header">
        		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        	</header><!-- .entry-header -->

			

        	<div class="entry-content">
				<?php
					the_content();
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'krea' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<div class="clearfix"></div>

			<?php if ( 'post' === get_post_type() ) : ?>
			<footer class="entry-footer">
				<div class="metadata">
	                <?php krea_metadata(); ?>
	                <div class="clearfix"></div>
	            </div><!-- /metadata -->
            </footer><!-- .entry-footer -->
            <?php endif; ?>

			<div class="clearfix"></div>




		</div><!-- /post_content -->
</article><!-- #post-## -->
