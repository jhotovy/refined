<p class="byline author vcard small">
  <?php if (refined_is_user_content_post()) : ?>
    <?php echo __('Submitted by', 'roots'); ?>
  <?php else : ?>
    <?php echo __('by', 'roots'); ?>
  <?php endif; ?>
  <a href="<?php echo bp_core_get_user_domain(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
  <?php echo __(' | ', 'roots'); ?>
  <a href="<?php echo get_permalink(); ?>#disqus_thread"><?php comments_number(); ?></a>
</p>
