
<?php
/**
 * @hooked - g5plus_output_content_wrapper_end - 1
 **/
do_action('g5plus_main_wrapper_content_end');
?>
</div>
<!-- Close Wrapper Content -->
<?php get_template_part('templates/footer-template'); ?>
</div>
<!-- Close Wrapper -->

<?php
/**
 * @hooked - g5plus_back_to_top - 5
 **/
do_action('g5plus_after_page_wrapper');
?>
<?php wp_footer(); ?>
</body>
</html> <!-- end of site. what a ride! -->