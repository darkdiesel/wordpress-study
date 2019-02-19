<?php
/**
 * The main template file
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<?php
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content/content' );
	}
	?>

<?php else: ?>

	<?php
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );
	?>

<?php endif; ?>

<?php
get_footer();
