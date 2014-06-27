<?php if (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <?php if (get_post_type() == 'post') echo '<div class="narrow-page">'; ?>

    <?php if (refined_should_display_title_and_meta()) : ?>
      <header>
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
    <?php else : ?>
      <div class="vertical-gutter"></div>
    <?php endif; ?>
    <div class="entry-content" <?php if (get_post_type() == 'post') echo 'data-sharebar-offset="30"'; ?>>
      <?php if (get_post_type() == 'refined-image') : ?>
        <?php get_template_part('templates/single', 'refined-image'); ?>
      <?php elseif (get_post_type() == 'refined-quote') : ?>
        <?php get_template_part('templates/single', 'refined-quote'); ?>
      <?php elseif (get_post_type() == 'refined-video') : ?>
        <?php get_template_part('templates/single', 'refined-video'); ?>
      <?php else : ?>
        <?php the_content(); ?>
      <?php endif; ?>
    </div>
    <?php if (get_post_type() == 'post') : ?>
      <div class="signup-box">
        <h3>Free Email Updates</h3>
        <p>Join 5,000 wonderful readers. Receive one thought-provoking parcel of goodness each week:</p>
        <!-- Begin MailChimp Signup Form -->
        <div id="mc_embed_signup" style="text-align: left;"><form id="mc-embedded-subscribe-form" class="validate" action="http://collegepartyblog.us2.list-manage.com/subscribe/post?u=229fad4d0dcc15b541174dae0&amp;id=24be761037" method="post" name="mc-embedded-subscribe-form" target="_blank"><label for="mce-EMAIL"></label>
        <input id="mce-EMAIL" class="email" type="text" name="EMAIL" value="your email address" /><input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Join!" /></form></div>
        <!--End mc_embed_signup-->
      </div>
      <br/>
    <?php endif; ?>
    <?php comments_template('/templates/comments.php'); ?>

    <?php if (get_post_type() == 'post') echo '</div>'; ?>
  </article>
<?php endif; ?>
