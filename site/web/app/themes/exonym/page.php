<?php
	/* ============
		 DEFAULT PAGE
		 ============= */
	get_header();
	get_template_part('templates/wrap', 'start');
	if(have_posts()): while(have_posts()): the_post();
?>
	<section class="module-subhead wrap">
		<h1 class="page-heading wrap"><?php the_title(); ?></h1>
		<div class="subhead-content">
			<?php the_field('subhead'); ?>
		</div>
	</section>
	<?php if(have_rows('content_rows')): while(have_rows('content_rows')): the_row(); ?>
		<section class="module-twocol wrap">
		  <div class="twocol-left">
		    <?php the_sub_field('left_column'); ?>
		  </div>
		  <div class="twocol-right">
		    <?php the_sub_field('right_column'); ?>
		  </div>
		</section>
	<?php endwhile; endif; ?>
<?
	endwhile; endif;
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
