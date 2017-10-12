    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="post-header">
                <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="post-content">

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'krea' ),
                            'after'  => '</div>',
                        ));
                    ?>
                </div><!-- .entry-content -->

                <div class="clearfix"></div>

                <?php if( has_term( '', get_post_type() . '_category', $post->ID ) ): ?>
                <footer class="entry-footer">
        			<div class="metadata">
                        <ul>
                            <li class="meta_categories">
                                <?php esc_html_e( 'Category:', 'krea' );?>
                                <?php echo get_the_term_list( $post->ID, get_post_type() . '_category', '', ' ' ); ?>
                            </li>
                        </ul>
        	            <div class="clearfix"></div>
        	        </div><!-- /metadata -->
        	    </footer><!-- .entry-footer -->
            <?php endif; ?>

            </div><!-- /post_content -->

        </article><!-- #post-## -->

        <?php krea_post_navigation(); ?>

    <?php endwhile; // End of the loop.?>