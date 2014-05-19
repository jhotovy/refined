<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a class="link-inverse" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <?php refined_featured_image('thumbnail', 'pull-left margin-bottom-right'); ?>
  <div class="entry-summary">
    <?php
      global $more;
      $more = 0;
      the_content();
    ?>
  </div>
</article>
