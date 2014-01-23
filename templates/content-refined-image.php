<div class="masonry-item refined-user-image">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <img id="thumbnail" src="<?php echo refined_uploaded_image_path(); ?>" />
    <div class="refined-image-overlay"></div>
    <h5 id="title" class="refined-image-title"><?php the_title(); ?></h5>
  </a>
</div>