<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

			<?php

				if ( is_front_page() ) {

					$args = array(
						'post_type'   => 'homepage_content',
						'post_status' => 'publish',
					);
					
					$homepage_content = new WP_Query( $args );

					if( $homepage_content->have_posts() ) :

						while( $homepage_content->have_posts() ) :

							$homepage_content->the_post();

							$bg_color = get_post_meta( get_the_ID(), 'background_color_hexcode', true );
							$fg_color = get_post_meta( get_the_ID(), 'foreground_color_hexcode', true );

							echo '<div class="homepage-content-wrapper" style="background-color: ' . $bg_color . '; color: ' . $fg_color . '">';
													
							// render banner spacer

								$banner_args = array(
									'post_type'   => 'banner_content',
									'post_status' => 'publish',
								);
								
								$banner_content = new WP_Query( $banner_args );

								if ( $banner_content->have_posts() ) :
									echo '<div id="banner-spacer"></div>';
								endif;
											
											
								echo '<div class="entry-content">
												<div class="wp-block-group">
													<div class="wp-block-group__inner-container">';

							printf( get_the_content() );

							echo '			</div>
												</div>
											</div>
										</div>';
							
						endwhile;

						wp_reset_postdata();

					endif;

					

				}

			?>

			<div class="entry-content">

				<div class="entry-content-wrapper">
					
					<?php if ( is_front_page() || is_page() ) { ?>

						<?php if ( !is_page( 'staff' ) ) { ?>

							<div class="entry-content-column entry-content-column-twitter">

						<?php } else { ?>

							<div class="entry-content-column">

						<?php } ?>

					<?php } ?>

						<?php
						if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
							the_excerpt();
						} else {
							the_content( __( 'Continue reading', 'twentytwenty' ) );
						}
						?>

					</div>
					
					<!-- twitter feed -->

				</div>

			</div><!-- .entry-content -->

		

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
