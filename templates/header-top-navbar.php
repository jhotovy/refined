<header class="logo-header">
  <div class="container">
    <a href="<?php echo get_home_url(); ?>"><img class="logo" src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" /></a>
  </div>
</header>
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
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav wp-menu'));
        endif;
      ?>
      <ul class="nav navbar-nav navbar-right">
        <?php if (is_user_logged_in()) : ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <b class="caret"></b>&nbsp&nbsp<?php echo wp_get_current_user()->display_name; ?>
              <?php echo get_avatar(get_current_user_id(), 18); ?>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo wp_logout_url(get_permalink()); ?>">Logout</a></li>
            </ul>
          </li>
        <?php else : ?>
          <li><a href="<?php echo wp_login_url(get_permalink()); ?>">Login</a></li>
          <li><a href="<?php echo get_home_url(); ?>/register">Join</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
