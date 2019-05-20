<?php

//$paged = ( get_query_var('paged') ) ? absint(get_query_var('paged')) : 1;
//
//$ar = array(
//	'post_type' => 'photosession',
//	'post_status' => 'publish',
//	'order' => 'DESC',
//	'paged' => $paged,
//	'posts_per_page' => '3',
//);
//
//query_posts($ar);


$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array(
	'post_type'      => 'photosession',
	'post_status'    => 'publish',
	'paged'          => $paged,
	'posts_per_page' => '10',
);

/**
 * @var $photoSessions WP_Query
 * @var $photoSession WP_Post
 */
$photoSessions = new WP_Query( $args );

$photoSessions->get_posts(); ?>

<?php if ( $photoSessions->have_posts() ): ?>
    <div class="row">
		<?php foreach ( $photoSessions->get_posts() as $photoSession ): ?>
            <div class="col-md-6 col-12">
	            <?php
	            $post_thumbnail_id = get_post_thumbnail_id( $photoSession->ID );
	            $main_image        = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
	            $main_image        = $main_image[0];
	            ?>

                <div class="clearfix px-2">
                    <a href="<?php echo get_permalink($photoSession->ID); ?>">
                        <img src="<?php echo $main_image; ?>" class="img-fluid" alt="<?php echo $photoSession->post_title; ?>">
                    </a>

                    <?php if (function_exists('pvc_get_post_views')): ?>
                    <div class="pull-right">
                        <i class="fa fa-eye" aria-hidden="true"></i> <?php echo pvc_get_post_views( $photoSession->ID ); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <h3><a href="<?php echo get_permalink($photoSession->ID); ?>"><?php echo $photoSession->post_title; ?></a></h3>
            </div>
		<?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
// Reset Query
wp_reset_query();