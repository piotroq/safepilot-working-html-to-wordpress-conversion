<?php
/**
 * The template for displaying all single posts
 * 
 * @package SafePilot
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-fullwidth' ); ?>>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
					
					<div class="entry-meta">
						<span class="posted-on">
							<i class="far fa-calendar"></i>
							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
								<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</a>
						</span>
						
						<span class="byline">
							<i class="far fa-user"></i>
							<span class="author vcard">
								<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
									<?php echo esc_html( get_the_author() ); ?>
								</a>
							</span>
						</span>
						
						<?php if ( has_category() ) : ?>
						<span class="cat-links">
							<i class="far fa-folder"></i>
							<?php the_category( ', ' ); ?>
						</span>
						<?php endif; ?>
						
						<?php if ( comments_open() || get_comments_number() ) : ?>
						<span class="comments-link">
							<i class="far fa-comments"></i>
							<a href="<?php comments_link(); ?>">
								<?php
								printf(
									/* translators: %s: Number of comments */
									_n( '%s Comment', '%s Comments', get_comments_number(), 'safepilot' ),
									number_format_i18n( get_comments_number() )
								);
								?>
							</a>
						</span>
						<?php endif; ?>
					</div>
				</header>
				
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'safepilot-featured', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
				</div>
				<?php endif; ?>
				
				<div class="entry-content">
					<?php
					the_content( sprintf(
						/* translators: %s: Post title */
						wp_kses(
							__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'safepilot' ),
							array( 'span' => array( 'class' => array() ) )
						),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
					
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'safepilot' ),
						'after'  => '</div>',
					) );
					?>
				</div>
				
				<footer class="entry-footer">
					<?php if ( has_tag() ) : ?>
					<div class="tags-links">
						<i class="far fa-tags"></i>
						<?php the_tags( '', ', ' ); ?>
					</div>
					<?php endif; ?>
					
					<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Post title */
							esc_html__( 'Edit %s', 'safepilot' ),
							'<span class="screen-reader-text">' . get_the_title() . '</span>'
						),
						'<span class="edit-link"><i class="far fa-edit"></i> ',
						'</span>'
					);
					?>
				</footer>
			</article>
			
			<?php
			// Post navigation
			the_post_navigation( array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'safepilot' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'safepilot' ) . '</span> <span class="nav-title">%title</span>',
			) );
			
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
		endwhile;
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
