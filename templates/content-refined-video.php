<?php the_title(); ?>
<?php echo wp_oembed_get(get_the_content(), array('width' => 600)); ?>
<p id="meta">
  submitted by
  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
    <?php echo get_the_author(); ?>
  </a>
</p>
<hr/>