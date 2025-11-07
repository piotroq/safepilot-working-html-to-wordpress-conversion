<?php
/**
 * Template Name: FAQ Page
 * 
 * Template for displaying FAQ page
 * 
 * @package SafePilot
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
		<section class="faq-section-2 fix section-padding">
			<div class="container">
				<div class="row g-4">
					<div class="col-lg-12">
						<header class="page-header">
							<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
						</header>
						
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail( 'safepilot-featured' ); ?>
						</div>
						<?php endif; ?>
						
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						
						<!-- FAQ Accordion -->
						<div class="faq-accordion mt-5">
							<div class="accordion" id="faqAccordion">
								<?php
								// Get FAQ items from custom fields or page content
								// This is a placeholder for FAQ accordion structure
								$faq_items = apply_filters( 'safepilot_faq_items', array(
									array(
										'question' => __( 'What services does SafePilot offer?', 'safepilot' ),
										'answer'   => __( 'SafePilot offers comprehensive occupational health and safety (BHP) services, fire protection (PPOŻ), and first aid training.', 'safepilot' ),
									),
									array(
										'question' => __( 'How can I schedule a consultation?', 'safepilot' ),
										'answer'   => __( 'You can schedule a consultation by contacting us through the contact form or calling our office directly.', 'safepilot' ),
									),
									array(
										'question' => __( 'Do you provide on-site training?', 'safepilot' ),
										'answer'   => __( 'Yes, we provide on-site training for occupational health and safety, fire protection, and first aid.', 'safepilot' ),
									),
								) );
								
								foreach ( $faq_items as $index => $item ) :
									$accordion_id = 'faq-' . $index;
									$is_first = ( $index === 0 );
								?>
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading-<?php echo esc_attr( $accordion_id ); ?>">
										<button class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $accordion_id ); ?>" aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $accordion_id ); ?>">
											<?php echo esc_html( $item['question'] ); ?>
										</button>
									</h2>
									<div id="<?php echo esc_attr( $accordion_id ); ?>" class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>" aria-labelledby="heading-<?php echo esc_attr( $accordion_id ); ?>" data-bs-parent="#faqAccordion">
										<div class="accordion-body">
											<?php echo wp_kses_post( $item['answer'] ); ?>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						
						<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Post title */
									esc_html__( 'Edit %s', 'safepilot' ),
									'<span class="screen-reader-text">' . get_the_title() . '</span>'
								),
								'<span class="edit-link">',
								'</span>'
							);
							?>
						</footer>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
		
	<?php endwhile; ?>
</main><!-- #main -->

<?php
get_footer();
