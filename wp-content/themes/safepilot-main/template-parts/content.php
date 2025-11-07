<?php
/**
 * Template part for displaying posts
 * 
 * @package SafePilot
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'safepilot-medium', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
		</a>
	</div>
	<?php endif; ?>
	
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
		</div>
	</header>
	
	<div class="entry-content">
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			the_excerpt();
		}
		
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'safepilot' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	
	<?php if ( ! is_singular() ) : ?>
	<div class="entry-footer">
		<a href="<?php the_permalink(); ?>" class="read-more-link">
			<?php esc_html_e( 'Read More', 'safepilot' ); ?>
			<i class="fas fa-arrow-right"></i>
		</a>
	</div>
	<?php endif; ?>
</article>
