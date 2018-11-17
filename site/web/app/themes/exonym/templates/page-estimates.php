<?php
	/* ========================
		 TEMPLATE NAME: Estimates
		 ======================== */
	get_header();
	get_template_part('templates/wrap', 'start');
	if(have_posts()): while(have_posts()): the_post();
?>
	<section class="module-subhead wrap">
		<h1 class="page-heading wrap"><?php the_title(); ?></h1>
	</section>
	<?php if(have_rows('forms')): while(have_rows('forms')): the_row(); $form = get_sub_field('form') ?>
		<section class="module-twocol wrap">
		  <div class="twocol-left">
		    <h2 style="text-align: right;"><?php echo $form['title']; ?></h2>
		  </div>
		  <div class="twocol-right">
        <a href="<?php echo $form['url']; ?>" target="_blank" class="form-single">
  		    <p><?php echo $form['caption']; ?></p>
          <small>Click here to Download. <?php echo $form['description']; ?></small>
        </a>
		  </div>
		</section>
	<?php endwhile; endif; ?>
<?
	endwhile; endif;
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
