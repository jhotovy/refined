<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php if (refined_should_display_title_and_meta()) : ?>
      <header>
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
    <?php else : ?>
      <div class="vertical-gutter"></div>
    <?php endif; ?>
    <div class="entry-content">
      <?php if (get_post_type() == 'refined-image') : ?>
        <?php get_template_part('templates/single', 'refined-image'); ?>
      <?php elseif (get_post_type() == 'refined-quote') : ?>
        <?php get_template_part('templates/single', 'refined-quote'); ?>
      <?php else : ?>
        <?php the_content(); ?>
      <?php endif; ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
