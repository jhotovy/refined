<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="refined-image-container resizable">
  <div id="wrapper">
    <img id="thumbnail" src="<?php echo refined_featured_image_path('front-page'); ?>" />
  </div>
  <div class="refined-image-overlay"></div>
  <h5 class="refined-image-title"><b><?php the_title(); ?></b></h5>
</a>