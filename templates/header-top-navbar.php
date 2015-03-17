<header class="logo-header chris-test">
  <div class="container">
    <a><href="<?php echo get_home_url(); ?>"><img class="logo center-block" src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" /></a>
  </div>
</header>
<!-- chris johnson says hi -->
<header class="banner navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <ul id="menu-refined" class="nav navbar-nav wp-menu">
        <li class="<?php echo refined_menu_class('Home'); ?>"><a href="<?php echo get_home_url(); ?>/">Home</a></li>
        <li class="<?php echo refined_menu_class('Blog'); ?>"><a href="<?php echo get_home_url(); ?>/blog">Blog</a></li>
        </li>
        <li class="dropdown <?php echo refined_menu_class('Videos'); ?>">
          <a href="<?php echo get_home_url(); ?>/videos" class="dropdown-toggle" data-toggle="dropdown">Videos&nbsp<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo get_home_url(); ?>/submit-video">Submit Video</a></li>
          </ul>
        </li>
        <li class="dropdown <?php echo refined_menu_class('Quotes'); ?>">
          <a href="<?php echo get_home_url(); ?>/quotes" class="dropdown-toggle" data-toggle="dropdown">Quotes&nbsp<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo get_home_url(); ?>/submit-quote">Submit Quote</a></li>
          </ul>
        </li>
        <li class="dropdown <?php echo refined_menu_class('Discuss'); ?>">
          <a href="<?php echo get_home_url(); ?>/discussions" class="dropdown-toggle" data-toggle="dropdown">Discuss&nbsp<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo get_home_url(); ?>/new-discussion">New Discussion</a></li>
            <li><a href="<?php echo get_home_url(); ?>/discussion-categories">View By Category</a></li>
          </ul>
        <li class="<?php echo refined_menu_class('Library'); ?>"><a href="http://refinethemind.tumblr.com/">Library</a></li>
	<li class="<?php echo refined_menu_class('Store'); ?>"><a href="http://refinethemind.bigcartel.com/">Store</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown <?php echo refined_menu_class('About'); ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span id="menu-about" class="glyphicon glyphicon-question-sign"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo get_home_url(); ?>/mission">Mission</a></li>
            <li><a href="<?php echo get_home_url(); ?>/updates">Updates</a></li>
            <li><a href="<?php echo get_home_url(); ?>/contact">Contact</a></li>
          </ul>
        </li>
        <?php if (is_user_logged_in()) : ?>
          <li class="dropdown <?php echo refined_menu_class('Username'); ?>">
            <a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()); ?>" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo get_avatar(get_current_user_id(), 18); ?>&nbsp&nbsp<?php echo refined_bp_displayname_or_uname(); ?>&nbsp
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()); ?>/profile">Profile</a></li>
              <li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()); ?>/profile/change-avatar">Change Picture</a></li>
              <li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()); ?>/messages">Messages</a></li>
              <li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()); ?>/settings">Settings</a></li>
              <li><a href="<?php echo wp_logout_url(refined_current_page_link()); ?>">Logout</a></li>
            </ul>
          </li>
        <?php else : ?>
          <li class="<?php echo refined_menu_class('Join'); ?>"><a href="<?php echo get_home_url(); ?>/register">Join</a></li>
          <li class="<?php echo refined_menu_class('Sign In'); ?>"><a href="<?php echo wp_login_url(refined_current_page_link()); ?>">Sign In</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
