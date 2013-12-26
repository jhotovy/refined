<article <?php post_class(); ?>>
  <?php refined_featured_image('thumbnail', 'img-thumbnail pull-left margin-bottom-right'); ?>
  <header>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
