<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="front-post">
  <div id="wrapper">
    <img id="thumbnail" src="<?php echo refined_video_thumbnail_url(); ?>" />
  </div>
  <div class="refined-image-overlay"></div>
  <h5 id="title"><?php the_title(); ?></h5>
</a>