<?php
define('BP_FORUMS_SLUG', 'discussions');

// http://buddydev.com/buddypress/prevent-spaces-in-wordpressbuddypress-usernames/
add_action('bp_loaded','bpdev_remove_bp_pre_user_login_action');
add_filter('validate_username', 'bpdev_restrict_space_in_username', 10, 2);

function bpdev_remove_bp_pre_user_login_action()
{
    remove_action('pre_user_login', 'bp_core_strip_username_spaces');
}

function bpdev_restrict_space_in_username($valid, $user_name)
{
    if (preg_match('/\s/',$user_name))
    {
        return false;
    }
    return $valid;
}
?>