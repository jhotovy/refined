<!-- shared between quotes page and front page -->
<div class="masonry-item refined-user-quote">
  <div class="quote"><i><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    &ldquo;<?php echo get_the_content(); ?>&rdquo;
  </a></i></div>
  <p id="author">&#8212&nbsp<?php the_title(); ?></p>
  <hr/>
</div>