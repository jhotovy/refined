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
 * Images
 */
add_image_size('front-page', 500, 330, true);

/**
 * Refined Actions
 */
add_action('init', 'create_post_types');

/**
 * Refined Filters
 */
add_filter('nav_menu_css_class', 'filter_nav_menu_css_class', 10, 2);
add_filter('excerpt_length', 'filter_excerpt_length', 10, 1);

/**
 * BuddyPress Filters
 */
remove_filter('bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2);

/**
 * Refined Action Implementation
 */
function create_post_types()
{
	refined_create_post_type('refined-image', 'Image', 'Images', 'images');
	refined_create_post_type('refined-video', 'Video', 'Videos', 'videos');
	refined_create_post_type('refined-quote', 'Quote', 'Quotes', 'quotes');
}

function refined_create_post_type($post_type, $singular_name, $plural_name, $slug)
{
	register_post_type($post_type, array
	(
		'labels' => array
		(
			'name' => $plural_name,
			'singular_name' => $singular_name
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array
		(
			'slug' => $slug,
			'with_front' => false
		),
		'supports' => array
		(
			'title', 'editor', 'author', 'thumbnail', 'comments', 'trackbacks'
		),
	));
}

/**
 * Refined Filter Implementation
 */
function filter_nav_menu_css_class($classes, $item)
{
	$active_class = 'active';
	$classes[] = 'wp-menu-item';

	if (is_front_page())
	{
		if (strcasecmp($item->title, 'home') == 0)
		{
			$classes[] = $active_class;
		}
		return $classes;
	}
	switch(strtolower($item->title))
	{
		case 'blog':
		{
			if (strcasecmp(get_the_title(), 'blog') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_post_type(), 'post') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'discussions':
		{
			if (is_bbpress)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'discussion-categories') == 0)
			{
				$classes[] = $active_class;
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

function refined_image_dimensions($size)
{
	switch ($size)
	{
		case "thumbnail": return array(150, 150);
		case "medium": return array(300, 300);
		case "large": return array(640, 640);
		case "front-page": return array(500, 330);
	}
}

function refined_featured_image($size, $class)
{
	$dim = refined_image_dimensions($size);

	printf('<a href="%s" title="%s">', get_permalink(), get_the_title());
	printf('<img src="%s" class="%s" width="%s" height="%s" />',
		refined_featured_image_path($size),
		$class,
		$dim[0],
		$dim[1]);
	printf('</a>');
}

function refined_featured_image_path($size)
{
	if (has_post_thumbnail())
	{
		return wp_get_attachment_image_src(get_post_thumbnail_id(), $size)[0];
	}
	else
	{
		switch ($size)
		{
			case "thumbnail":
			{
				return refined_image_path("featured_image_default_thumbnail.png");
			}
			case "front-page":
			{
				return refined_image_path("featured_image_default_front_page.png");
			}
		}
	}
}

function refined_uploaded_image_path()
{
	return wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];
}

function refined_is_user_content_post()
{
	return (get_post_type() == 'refined-image' or get_post_type() == 'refined-video' or get_post_type() == 'refined-quote');
}

function refined_is_masonry_page()
{
	return (get_post_type() == 'refined-image');
}

function refined_should_display_title_and_meta()
{
	return (!(get_post_type() == 'refined-quote'));
}