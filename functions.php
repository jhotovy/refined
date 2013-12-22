<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions

/**
 * Filters
 */
add_filter('nav_menu_css_class', 'filter_nav_menu_css_class', 10, 2);
add_filter('excerpt_length', 'filter_excerpt_length', 10, 1);

function filter_nav_menu_css_class($classes, $item)
{
	switch(strtolower($item->title))
	{
		case 'blog':
		{
			if (strcasecmp(get_the_title(), 'blog') == 0)
			{
				$classes[] = 'active';
			}
			if (strcasecmp(get_post_type(), 'post') == 0)
			{
				$classes[] = 'active';
			}
			break;
		}
		case 'discussions':
		{
			if (is_bbpress())
			{
				$classes[] = 'active';
			}
			break;
		}
	}
	return $classes;
}

function filter_excerpt_length($length)
{
	return 75;
}

/**
 * Helpers
 */
function refined_image_path($image_name)
{
	return get_bloginfo('template_directory') . '/assets/img/' . $image_name;
}

function refined_post_thumbnail()
{
	$thumbnail_class = 'img-thumbnail pull-left margin-bottom-right';

	printf('<a href="%s" title="%s">', get_permalink(), get_the_title());
	if (has_post_thumbnail())
	{
		the_post_thumbnail('thumbnail', array('class' => $thumbnail_class));
	}
	else
	{
		printf('<img src="%s" class="%s" width="150" height="150" />', refined_image_path('blog_post_thumbnail_default.png'), $thumbnail_class);
	}
	printf('</a>');
}