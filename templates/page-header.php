<?php if (roots_title()) : ?>
  <div class="page-header">
    <h2>
      <?php echo roots_title(); ?>
      <?php if (refined_is_images_page()) : ?>
        <button class="btn btn-default" style="float: right;"><a href="<?php echo get_home_url(); ?>/submit-image">Submit Image</a></button>
      <?php elseif (refined_is_videos_page()): ?>
        <button class="btn btn-default" style="float: right;"><a href="<?php echo get_home_url(); ?>/submit-video">Submit Video</a></button>
      <?php elseif (refined_is_quotes_page()): ?>
        <button class="btn btn-default" style="float: right;"><a href="<?php echo get_home_url(); ?>/submit-quote">Submit Quote</a></button>
      <?php endif; ?>
    </h2>
  </div>
<?php else : ?>
  <div class="vertical-gutter"></div>
<?php endif; ?>
