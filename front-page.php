<?php query_posts(array('posts_per_page' => 9)); ?>

<div class="card padding-top">
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('No recent posts.', 'refined'); ?>
    </div>
  <?php endif; ?>

  <?php $counter = 0; ?>
  <div class="row">
    <div class="col-sm-6">
      <div class="featured-post">
        <?php the_post(); ?>
        <?php get_template_part('templates/content', 'front-post-featured'); ?>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="row">
        <?php while ($counter < 4) : the_post(); $counter++; ?>
          <div class="col-sm-6">
            <?php get_template_part('templates/content', 'front-post'); ?>
          </div>
          <?php if ($counter == 2) : ?>
            </div><div class="vertical-gutter"></div><div class="row">
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="vertical-gutter"></div>
  <?php $counter = 0; ?>
  <p><a href="<?php echo get_home_url(); ?>/blog">See All Blog Posts</a></p>
</div>
<div class="vertical-gutter"></div>

<?php wp_reset_query(); ?>
<?php query_posts(array('posts_per_page' => 8, 'post_type' => 'refined-video')); ?>

<div class="card padding-top" id="front-page-videos">
  <h3 class="page-header">
    Videos<a href="<?php echo get_home_url(); ?>/submit-video"><button class="btn btn-default pull-right">Submit Video</button></a>
  </h3>
  <?php $counter = 0; ?>
  <?php if (have_posts()) : echo '<div class="row">'; endif; ?>
    <?php while (have_posts()) : the_post(); $counter++; ?>
      <div class="col-sm-3">
        <?php get_template_part('templates/content', 'front-video'); ?>
      </div>
      <?php if ($counter % 4 == 0) : echo '</div><div class="vertical-gutter"></div><div class="row">'; endif; ?>
    <?php endwhile; ?>
  <?php if ($counter > 0) : echo '</div>'; endif; ?>
  <p class="bottom-aligned-text"><a href="<?php echo get_home_url(); ?>/videos">See All Videos</a></p>
  <p class="foo">&nbsp</p>
</div>
<div class="vertical-gutter"></div>

<?php wp_reset_query(); ?>
<?php query_posts(array('posts_per_page' => 10, 'post_type' => 'refined-quote')); ?>

<div class="card padding-top" id="front-page-quotes">
  <h3 class="page-header">
    Quotes<a href="<?php echo get_home_url(); ?>/submit-quote"><button class="btn btn-default pull-right">Submit Quote</button></a>
  </h3>
  <div id='container' class='masonry-container'>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', 'refined-quote'); ?>
    <?php endwhile; ?>
  </div>
  <p><a href="<?php echo get_home_url(); ?>/quotes">See All Quotes</a></p>
</div>
