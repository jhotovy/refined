<p class="byline author vcard small">
  <?php if (refined_is_user_content_post()) : ?>
    <?php echo __('Submitted by', 'roots'); ?>
  <?php else : ?>
    <?php echo __('by', 'roots'); ?>
  <?php endif; ?>
  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
  <?php echo __(' | ', 'roots'); ?>
  <a href="#disqus_thread"><?php comments_number(); ?></a>
</p>
