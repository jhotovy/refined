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
add_action('bp_setup_nav', 'refined_bp_setup_nav');
add_action('login_enqueue_scripts', 'refined_enqueue_login_stylesheet');

/**
 * Refined Filters
 */
add_filter('excerpt_length', 'filter_excerpt_length', 10, 1);
add_filter('login_headerurl', 'refined_login_logo_url');
add_filter('login_headertitle', 'refined_login_logo_title');
add_filter('gform_validation', 'refined_gform_validation');
add_filter('show_admin_bar', 'refined_show_admin_bar');

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
		'yarpp_support' => true,
	));
}

function refined_bp_setup_nav()
{
	global $bp;
	$bp->bp_nav['discussions']['name'] = 'Discussions';
	$bp->bp_options_nav['discussions']['replies']['name'] = 'Comments';
}

function refined_enqueue_login_stylesheet()
{
	?>
		<link rel="stylesheet" id="refined_login_css"
			href="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/css/login.css" 
			type="text/css" media="all" />
	<?php
}

/**
 * Refined Filter Implementation
 */
function filter_excerpt_length($length)
{
	return 75;
}

function refined_login_logo_url()
{
	return get_bloginfo('url');
}

function refined_login_logo_title()
{
	return get_bloginfo('name');
}

function refined_gform_validation($validation_result)
{
	$form = $validation_result['form'];
	foreach ($form['fields'] as &$field)
	{
		if (strpos($field['cssClass'], 'refined-video-url-input') === false)
		{
			continue;
		}
		// ensure wp_oembed_get will not fail for video url's
		$field_id = $field['id'];
		$url = rgpost('input_' . $field_id);
		if (!wp_oembed_get($url))
		{
			$field['failed_validation'] = true;
			$field['validation_message'] = 'This is not a link to a video.';
			$validation_result['is_valid'] = false;
		}
	}
	$validation_result['form'] = $form;
	return $validation_result;
	return false;
}

function refined_show_admin_bar()
{
	return current_user_can('edit_posts');
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

function refined_current_page_link()
{
	return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function refined_bp_displayname_or_uname()
{
	$user = wp_get_current_user();
	if ($user->display_name)
	{
		return $user->display_name;
	}
	return $user->user_login;
}

function refined_the_related()
{
	return the_related(get_the_ID(), array(
		'usept' => array
		(
			get_post_type() => true
		),
		'storage_id' => 'better-related-' . get_post_type(),
		'minscore' => 0,
	));
}

function refined_menu_class($title)
{
	$active_class = 'active';
	$classes[] = 'wp-menu-item';

	if (is_front_page())
	{
		if (strcasecmp($title, 'home') == 0)
		{
			$classes[] = $active_class;
		}
		return implode(' ', $classes);
	}
	switch(strtolower($title))
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
			if (is_bbpress())
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'categories') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'videos':
		{
			if (strcasecmp(get_post_type(), 'refined-video') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'submit video') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'images':
		{
			if (strcasecmp(get_post_type(), 'refined-image') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'submit image') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'quotes':
		{
			if (strcasecmp(get_post_type(), 'refined-quote') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'submit quote') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'join':
		{
			global $post;
			if (strcasecmp($post->post_name, 'register') == 0)
			{
				$classes[] = $active_class;
			}
			break;
		}
		case 'about':
		{
			if (strcasecmp(get_the_title(), 'about') == 0 ||
				strcasecmp(get_the_title(), 'connect') == 0 ||
				strcasecmp(get_the_title(), 'updates') == 0) 
			{
				$classes[] = $active_class;
			}
			break;
		}
	}
	return implode(' ', $classes);
}