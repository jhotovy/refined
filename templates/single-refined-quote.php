<hr/>
<div class="refined-user-quote">
  <div class="quote"><i>&ldquo;<?php echo get_the_content(); ?>&rdquo;</i></div>
  <div>
    <p id="author" class="pull-left">&#8212&nbsp<?php the_title(); ?></p>
    <p id="submitted-by" class="pull-right">
      submitted by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
        <?php echo get_the_author(); ?>
      </a>
    </p>
  </div>
</div>

<div class="vertical-gutter"></div>