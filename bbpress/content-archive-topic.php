<?php

/**
 * Archive Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

/**
 * Refined Changes:
 *
 * Remove search form
 * Remove pagination
 */
?>

<div id="bbpress-forums">

	<?php bbp_breadcrumb(); ?>

	<?php if ( bbp_is_topic_tag() ) bbp_topic_tag_description(); ?>

	<?php do_action( 'bbp_template_before_topics_index' ); ?>

	<?php if ( bbp_has_topics() ) : ?>

		<?php bbp_get_template_part( 'loop',       'topics'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback',   'no-topics' ); ?>

	<?php endif; ?>

	<button type="button" class="btn btn-default"><a href="<?php echo get_home_url(); ?>/discussion-categories">View By Category</a></button>

	<?php do_action( 'bbp_template_after_topics_index' ); ?>

</div>
