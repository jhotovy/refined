<!-- testing server chris johnson -->
<?php get_template_part('templates/page', 'header'); ?>
<!-- testing server chris johnson -->
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<!-- masonry -->
<?php if (refined_is_masonry_page()) : ?><div id='container' class='masonry-container'><?php endif; ?>
<!-- grid -->
<?php $counter = 0; ?>
<?php if (refined_is_two_column_grid_page()) : ?>
  <?php if (have_posts()) : echo '<div class="row">'; endif; ?>
<?php endif; ?>
<!-- end -->

<?php while (have_posts()) : the_post(); $counter++; ?>
  <!-- grid -->
  <?php if (refined_is_two_column_grid_page()) : ?>
    <div class="col-sm-6">
  <?php endif; ?>
  <!-- end -->
  <?php get_template_part('templates/content', get_post_type()); ?>
  <!-- grid -->
  <?php if (refined_is_two_column_grid_page()) : ?>
    </div>
    <?php if ($counter % 2 == 0) : echo '</div><div class="vertical-gutter"></div><div class="row">'; endif; ?>
  <?php endif; ?>
  <!-- end -->
<?php endwhile; ?>

<!-- masonry -->
<?php if (refined_is_masonry_page()) : ?></div><?php endif; ?>
<!-- grid -->
<?php if (refined_is_two_column_grid_page()) : ?>
  <?php if ($counter > 0) : echo '</div>'; endif; ?>
<?php endif; ?>
<!-- end -->

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
