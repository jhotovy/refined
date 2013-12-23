<?php query_posts(array('posts_per_page' => 4)); ?>

<div class="card padding-top">
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('No recent posts.', 'refined'); ?>
    </div>
  <?php endif; ?>

  <?php $counter = 0; ?>
  <?php if (have_posts()) : echo '<div class="row">'; endif; ?>
    <?php while (have_posts()) : the_post(); $counter++; ?>
      <div class="col-sm-6">
        <?php get_template_part('templates/content', 'front-post'); ?>
      </div>
      <?php if ($counter % 2 == 0) : echo '</div><div class="vertical-gutter"></div><div class="row">'; endif; ?>
    <?php endwhile; ?>
  <?php if ($counter > 0) : echo '</div>'; endif; ?>
</div>
<div class="vertical-gutter"></div>
<div class="card padding-top">
  <?php echo do_shortcode('[bbp-topic-index]'); ?>
</div>

<?php wp_reset_query(); ?>