<?php
add_action( 'admin_menu', 'quemalabs_getting_started_menu' );
function quemalabs_getting_started_menu() {
	add_theme_page( esc_attr__( 'Theme Info', 'krea' ), esc_attr__( 'Theme Info', 'krea' ), 'manage_options', 'krea_theme-info', 'quemalabs_getting_started_page' );
}

/**
 * Theme Info Page
 */
function quemalabs_getting_started_page() {
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'krea' ) );
	}
	echo '<div class="getting-started">';
	?>
	<div class="getting-started-header">
		<div class="header-wrap">
			<div class="theme-image">
				<span class="top-browser"><i></i><i></i><i></i></span>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="">
			</div>
			<div class="theme-content">
				<div class="theme-content-wrap">
				<h4><?php esc_html_e( 'Getting Started', 'krea' ); ?></h4>
				<h2 class="theme-name"><?php echo esc_html( KREA_THEME_NAME ); ?> <span class="ver"><?php echo 'v' . esc_html( KREA_THEME_VERSION ); ?></span></h2>
				<p><?php echo sprintf( /* translators: %s: theme name */ esc_html__( 'Thanks for using %s, we appriciate that you create with our products.', 'krea' ), esc_html( KREA_THEME_NAME ) ); ?></p>
				<p><?php esc_html_e( 'Check the content below to get started with our theme.', 'krea' ); ?></p>
				</div>

				<ul class="getting-started-menu">
					<?php
					if ( isset( $_GET['tab'] ) ){
						$tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
					}else{
						$tab = 'docs';
					}
					?>
					<li><a href="?page=krea_theme-info&amp;tab=docs" class="<?php echo ( $tab == 'docs' ) ? ' active' : ''; ?>"><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Documentation', 'krea' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://quemalabs.ticksy.com/' ); ?>" target="_blank"><i class="fa fa-support"></i> <?php esc_html_e( 'Support', 'krea' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://www.quemalabs.com/' ); ?>" target="_blank" class="<?php echo ( $tab == 'more-themes' ) ? ' active' : ''; ?>"><i class="fa fa-wordpress"></i> <?php esc_html_e( 'More Themes', 'krea' ); ?></a></li>
				</ul>

			</div><!-- .theme-content -->
		</div>
		<a href="<?php echo esc_url( 'https://www.quemalabs.com/' ); ?>" class="ql_logo" target="_blank"><img  src="<?php echo esc_url( get_template_directory_uri() ) . '/images/quemalabs.png'; ?>" alt="Quema Labs" /></a>
	</div><!-- .getting-started-header -->

	<div class="getting-started-content">

	<?php
	global $pagenow;
	global $updater;
	
	if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && 'krea_theme-info' == $_GET['page'] ){
		if ( isset( $_GET['tab'] ) ){
			$tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
		}else{
			$tab = 'docs';
		}

		switch ( $tab ){
			case 'docs' :
	?>

			<div class="theme-docuementation">
				<div class="help-msg-wrap">
					<div class="help-msg"><?php echo sprintf( /* translators: 1: anchor link, 2: anchor close */ esc_html__( 'You can find this documentation and more at our %1$sHelp Center%2$s.', 'krea' ), '<a href="' . esc_url( 'https://quemalabs.ticksy.com/articles/100012843' ) . '" target="_blank">', '</a>' ); ?></div>
				</div>
			</div><!-- .theme-docuementation -->
			<?php
	      	break;
	      	case 'license' :

	      	
			$updater->license_page();
	      	
	        ?>

        <?php
        	break;
     	}//switch
         ?>


	<?php }//if theme.php ?>

	</div><!-- .getting-started-content -->


	<?php
	echo '</div><!-- .getting-started -->';
}
?>