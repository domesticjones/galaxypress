<?php
	/* =================================
		 TEMPLATE NAME: Under Construction
		 ================================= */
	get_header();
	get_template_part('templates/wrap', 'start');
  if(have_posts()): while(have_posts()): the_post();
	$slides = get_field('slides');
	$slideSize = 'jumbo';
?>
<?php if($slides): ?>
	<section id="header-slides">
		<?php foreach($slides as $slide): ?>
			<div>
				<?php echo wp_get_attachment_image($slide['ID'], $slideSize); ?>
			</div>
		<?php endforeach; ?>
	</section>
<?php endif; ?>
<article class="undercon-body">
	<header class="undercon-logo animate-on-enter">
		<img src="<?php ex_logo(); ?>" alt="Logo for <?php ex_brand(); ?>" />
	</header>
	<section class="undercon-content">
		<h1 class="header-blue animate-on-enter"><?php the_field('heading'); ?></h1>
		<div class="wrap">
			<h2 class="undercon-content-subhead animate-on-enter"><?php the_field('sub_heading'); ?></h2>
			<div class="undercon-content-text animate-on-enter"><?php the_field('content'); ?></div>
		</div>
	</section>
	<footer class="undercon-login animate-on-enter animate-parallax animate-z-normal">
		<div class="stars-bg"></div>
		<a href="<?php echo wp_login_url(get_post_type_archive_link('company')); ?>" class="undercon-login-button"><?php the_field('portal_button'); ?></a>
	</footer>
</article>
<?
	endwhile; endif;
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
