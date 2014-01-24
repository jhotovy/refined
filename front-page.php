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

<?php wp_reset_query(); ?>

<div class="vertical-gutter"></div>

<div class="row">
  <div class="col-sm-6">
    <div class="card padding-top" id="front-page-videos">
      <h3 class="page-header">Videos</h3>
      <p>Coming soon...</p>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card padding-top" id="bbpress-front-page">
      <h3 class="page-header">Discussions</h3>
      <?php echo do_shortcode('[bbp-topic-index]'); ?>
    </div>
  </div>
</div>

<div class="vertical-gutter"></div>

<div class="card padding-top">
  <h3 class="page-header">Images</h3>
</div>