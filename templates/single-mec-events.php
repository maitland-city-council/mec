<?php
/** no direct access **/
defined('_MECEXEC_') or die();
/**
 * The Template for displaying all single events
 * 
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
get_header('mec'); ?>

	<?php if ( ! ( isset($post->post_content) && has_shortcode( $post->post_content, 'jobs' ) ) ): ?>
		<?php if ( has_post_thumbnail() ):
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'listable-featured-image' ); ?>
			<header class="page-header has-featured-image">
				<div class="page-header-background" style="background-image: url('<?php echo listable_get_inline_background_image( $image[0] ); ?>')"></div>
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header>
		<?php else:
			if ( !is_page_template( 'page-templates/full_width_no_title.php' ) ) { ?>
			<header class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>

				<?php if ( has_excerpt() ) : //only show custom excerpts not autoexcerpts ?>
					<span class="entry-subtitle"><?php echo get_the_excerpt(); ?></span>
				<?php endif; ?>

			</header>
		<?php }
		endif; ?>
	<?php endif; ?>

    <?php do_action('mec_before_main_content'); ?>

        <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_single_page_html_class', 'mec-container'); ?>">
		<?php while(have_posts()): the_post(); ?>

            <?php $MEC = MEC::instance(); echo $MEC->single(); ?>

		<?php endwhile; // end of the loop. ?>
	    <?php comments_template(); ?>
        </section>

    <?php do_action('mec_after_main_content'); ?>

<?php get_footer('mec');