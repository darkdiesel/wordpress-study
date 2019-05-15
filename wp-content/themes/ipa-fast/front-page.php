<?php
/**
 * Template Name: Front Page Template
 * The home template file
 */
?>

<?php (function_exists('acf_form_head')) ? acf_form_head() : null; ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php
	// Load posts loop.
	while ( have_posts() ) :  the_post(); ?>
		<?php if (function_exists('acf_form')): ?>
			<?php acf_form(array(
				'fields' => array('slides')
			)); ?>
		<?php endif; ?>
		<?php get_template_part( 'template-parts/content/content', 'front' ); ?>
	<?php endwhile ?>

<?php else: ?>

	<?php
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );
	?>

<?php endif; ?>

<?php get_footer();