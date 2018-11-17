<?php
	/* ===================
		 TEMPLATE NAME: Home
		 =================== */
	get_header();
	get_template_part('templates/wrap', 'start');
  if(have_posts()): while(have_posts()): the_post();
?>
<section class="module-twocol wrap">
  <div class="twocol-left">
    <?php the_field('left_column'); ?>
  </div>
  <div class="twocol-right">
    <?php the_field('right_column'); ?>
  </div>
</section>
<footer class="undercon-login animate-on-enter animate-parallax animate-z-normal">
  <div class="stars-bg"></div>
  <a href="<?php echo wp_login_url(get_post_type_archive_link('company')); ?>" class="undercon-login-button">Client Log In</a>
</footer>
<?php
  endwhile; endif;
  get_template_part('templates/wrap', 'end');
  get_footer();
?>
