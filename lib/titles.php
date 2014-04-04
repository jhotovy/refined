<?php
/**
 * Page titles
 */
function roots_title() {
  $retval = '';
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      $retval = get_the_title(get_option('page_for_posts', true));
    } else {
      $retval = __('Latest Posts', 'roots');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      $retval = apply_filters('single_term_title', $term->name);
    } elseif (is_post_type_archive()) {
      $retval = apply_filters('the_title', get_queried_object()->labels->name);
    } elseif (is_day()) {
      $retval = sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      $retval = sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      $retval = sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      $retval = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
    } else {
      $retval = single_cat_title('', false);
    }
  } elseif (is_search()) {
    $retval = sprintf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    $retval = __('Not Found', 'roots');
  } else {
    $retval = get_the_title();
  }
  if ($retval == 'Forums') {
    return 'Discussions';
  }
  if ($retval == '') {
    return wp_title('');
  }
  return $retval;
}