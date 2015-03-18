<?php if (refined_should_display_title()) : ?>
  <div class="page-header">
    <h2>
      <?php echo roots_title(); ?>
      <?php if (refined_is_videos_page()): ?>
        <a href="<?php echo get_home_url(); ?>/submit-video"><button class="btn btn-default pull-right">Submit Video</button></a>
      <?php elseif (refined_is_quotes_page()): ?>
        <a href="<?php echo get_home_url(); ?>/submit-quote"><button class="btn btn-default pull-right">Submit Quote</button></a>
      <?php endif; ?>
    </h2>
  </div>
<?php else : ?>
  <div class="vertical-gutter"></div>
<?php endif; ?>
