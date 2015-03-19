<!-- shared between quotes page and front page -->
<div class="masonry-item refined-user-quote">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><div class="quote"><i>
    &ldquo;<?php echo get_the_content(); ?>&rdquo;
  </i></div></a>
  <p id="author">&#8212&nbsp<?php the_title(); ?></p>
  <hr/>
</div>