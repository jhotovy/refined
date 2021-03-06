<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

/**
 * Refined Changes:
 *
 * Remove voices
 * Remove author meta in freshness
 * Change freshness to regular text instead of a link
 * Add glyph icon before post count
 * Change topic titles to headers
 * Remove topic meta ("started by X in X")
 */
?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<li class="bbp-topic-title">

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_topic_favorite_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_topic_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<h4><a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></h4>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<?php bbp_topic_pagination(); ?>

		<?php bbp_topic_row_actions(); ?>

	</li>

	<li class="bbp-topic-reply-count"><span class="glyphicon glyphicon-comment"></span>&nbsp<?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></li>

	<li class="bbp-topic-freshness">

		<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

		<?php echo bbp_get_topic_last_active_time(); ?>

		<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>

	</li>

</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
