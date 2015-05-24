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
add_image_size('front-page-large', 546, 361, true);
add_image_size('front-page-small', 265, 175, true);
add_image_size('width_200px', 200, 0, false);
add_image_size('width_350px', 350, 0, false);


/**
 * Refined Actions
 */
add_action('init', 'create_post_types');
add_action('bp_setup_nav', 'refined_bp_setup_nav');
add_action('login_enqueue_scripts', 'refined_enqueue_login_stylesheet');
add_action('gform_after_submission', "refined_gform_after_submission", 10, 2);
// add_action('add_attachment', 'refined_add_attachment', 10, 1);

/**
 * Refined Filters
 */
add_filter('excerpt_length', 'filter_excerpt_length', 10, 1);
add_filter('login_headerurl', 'refined_login_logo_url');
add_filter('login_headertitle', 'refined_login_logo_title');
add_filter('gform_validation', 'refined_gform_validation');
add_filter('gform_post_data', 'refined_gform_post_data', 10, 3);
add_filter('show_admin_bar', 'refined_show_admin_bar');
add_filter('the_title', 'refined_the_title');

/**
 * BuddyPress Filters
 */
remove_filter('bp_get_the_profile_field_value', 'xprofile_filter_link_profile_data', 9, 2);

/**
 * Refined Action Implementation
 */
function create_post_types()
{
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
	global $refined_noembed_video_data;

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
			break;
		}
		$refined_noembed_video_data = refined_noembed_get_video_data($url);
		if (!$refined_noembed_video_data)
		{
			$field['failed_validation'] = true;
			$field['validation message'] = 'Submission failed. Please try again later or let us know if the issue persists.';
			$validation_result['is_valid'] = false;
		}
	}
	$validation_result['form'] = $form;
	return $validation_result;
	return false;
}

function refined_gform_post_data($post_data, $form, $entry)
{
	global $refined_noembed_video_data;

	if (strcasecmp('submit video', $form['title']) == 0)
	{
		// post_title originally stores video URL. move it to content,
		// and grab the actual title from noembed
		$url = $post_data['post_title'];
		$post_data['post_title'] = $refined_noembed_video_data['title'];
		$post_data['post_content'] = $url;
	}
	return $post_data;
}

function refined_gform_after_submission($entry, $form)
{
	global $refined_noembed_video_data;

	if (strcasecmp('submit video', $form['title']) == 0)
	{
		add_post_meta($entry['post_id'], 'refined-video-thumbnail-url', $refined_noembed_video_data['thumbnail_url']);
	}
}

function refined_add_attachment($attachment_id)
{
	$params = array();
	$params['file'] = get_attached_file($attachment_id);
	$params['url'] = wp_get_attachment_url($attachment_id);
	$params['type'] = wp_check_filetype($params['file'])['type'];

	imsanity_handle_upload($params);
}

function refined_show_admin_bar()
{
	return current_user_can('edit_posts');
}

function refined_the_title($title)
{
	// if title is wrapped in <a>, remove the link. BuddyPress does
	// this sometimes
	if (strpos($title, '<a href') == 0)
	{
		$title = preg_replace('#<a href[^>]*>#', '', $title);
		$title = preg_replace('#</a>#', '', $title);
		return $title;
	}
	return $title;
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
		case "front-page-large": return array(546, 361);
		case "front-page-small": return array(265, 175);
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
			case "front-page-large":
			case "front-page-small":
			{
				return refined_image_path("featured_image_default_front_page.png");
			}
		}
	}
}

function refined_uploaded_image_path($size = 'thumbnail')
{
	return wp_get_attachment_image_src(get_post_thumbnail_id(), $size)[0];
}

// available data fields: width, author_name, author_url, version, provider_url,
// thumbnail_width, provider_name, thumbnail_url, height, thumbnail_height, url,
// title, type, html
function refined_noembed_get_video_data($url)
{
	$noembed_url = 'http://noembed.com/embed?url=' . urlencode($url);
	$response = file_get_contents($noembed_url);
	if ($response === FALSE)
	{
		return NULL;
	}
	$data = json_decode($response, true);
	if (!$data)
	{
		return NULL;
	}
	// these fields are required; return NULL if they are not available to
	// indicate an error with noembed
	if (!($data['title'] && $data['thumbnail_url']))
	{
		return NULL;
	}
	return $data;
}

function refined_video_url()
{
	return get_the_content();
}

function refined_video_thumbnail_url()
{
	return get_post_meta(get_the_id(), 'refined-video-thumbnail-url', true);
}

function refined_is_user_content_post()
{
	return (get_post_type() == 'refined-video' or get_post_type() == 'refined-quote');
}

function refined_is_videos_page()
{
	return (strcasecmp(roots_title(), 'videos') == 0);
}

function refined_is_quotes_page()
{
	return (strcasecmp(roots_title(), 'quotes') == 0);
}

// TODO: this can be removed
function refined_is_masonry_page()
{
	return false;
}

function refined_is_two_column_grid_page()
{
	return (get_post_type() == 'refined-video');
}

function refined_should_display_title_and_meta()
{
	return (!(get_post_type() == 'refined-quote'));
}

function refined_should_display_title()
{
	if (strcasecmp(get_the_title(), 'about') == 0)
	{
		return false;
	}
	if (strcasecmp(get_the_title(), 'updates') == 0)
	{
		return false;
	}
	if (strcasecmp(get_the_title(), 'connect') == 0)
	{
		return false;
	}
	return roots_title();
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
	else if (bp_is_user())
	{
		if (strcasecmp($title, 'username') == 0)
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
			if (strcasecmp(get_the_title(), 'discussion categories') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'discussions') == 0)
			{
				$classes[] = $active_class;
			}
			if (strcasecmp(get_the_title(), 'new discussion') == 0)
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
