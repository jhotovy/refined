<?php query_posts(array('posts_per_page' => 6)); ?>

<div class="card padding-top">
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('No recent posts.', 'refined'); ?>
    </div>
  <?php endif; ?>

  <?php $counter = 0; ?>
  <?php if (have_posts()) : echo '<div class="row">'; endif; ?>
    <?php while (have_posts()) : the_post(); $counter++; ?>
      <div class="col-sm-4">
        <?php get_template_part('templates/content', 'front-post'); ?>
      </div>
      <?php if ($counter % 3 == 0) : echo '</div><div class="vertical-gutter"></div><div class="row">'; endif; ?>
    <?php endwhile; ?>
  <?php if ($counter > 0) : echo '</div>'; endif; ?>
</div>
<div class="vertical-gutter"></div>

<?php wp_reset_query(); ?>
<?php query_posts(array('posts_per_page' => 8, 'post_type' => 'refined-video')); ?>

<div class="row">
  <div class="col-sm-6">
    <div class="card padding-top" id="front-page-videos">
      <h3 class="page-header">Videos</h3>

      <?php $counter = 0; ?>
      <?php if (have_posts()) : echo '<div class="row">'; endif; ?>
        <?php while (have_posts()) : the_post(); $counter++; ?>
          <div class="col-sm-6">
            <?php get_template_part('templates/content', 'front-video'); ?>
          </div>
          <?php if ($counter % 2 == 0) : echo '</div><div class="vertical-gutter"></div><div class="row">'; endif; ?>
        <?php endwhile; ?>
      <?php if ($counter > 0) : echo '</div>'; endif; ?>
      <p><a href="<?php echo get_home_url(); ?>/videos">See All Videos</a></p>
    </div>
  </div>

  <?php wp_reset_query(); ?>

  <div class="col-sm-6">
    <div class="card padding-top" id="bbpress-front-page">
      <h3 class="page-header">Discussions</h3>
      <?php echo do_shortcode('[bbp-topic-index]'); ?>
      <p><a href="<?php echo get_home_url(); ?>/discussions">See All Discussions</a></p>
    </div>
  </div>
</div>
<div class="vertical-gutter"></div>

<?php wp_reset_query(); ?>
<?php query_posts(array('posts_per_page' => 20, 'post_type' => 'refined-image')); ?>

<div class="card padding-top" id="front-page-images">
  <h3 class="page-header">Images</h3>
  <div id='container' class='masonry-container'>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', 'refined-image'); ?>
    <?php endwhile; ?>
  </div>
  <p><a href="<?php echo get_home_url(); ?>/images">See All Images</a></p>
</div>
<div class="vertical-gutter"></div>

<?php wp_reset_query(); ?>
<?php query_posts(array('posts_per_page' => 10, 'post_type' => 'refined-quote')); ?>

<div class="card padding-top" id="front-page-quotes">
  <h3 class="page-header">Quotes</h3>
  <div id='container' class='masonry-container'>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', 'refined-quote'); ?>
    <?php endwhile; ?>
  </div>
  <p><a href="<?php echo get_home_url(); ?>/quotes">See All Quotes</a></p>
</div>