<?php
	/* ========================
		 TEMPLATE NAME: Equipment
		 ======================== */
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
  <div class="gallery-wrap wrap">
    <?php $gallery = get_field('gallery'); if($gallery): ?>
      <ul id="gallery">
        <?php foreach($gallery as $image): ?>
          <li class="gallery-image">
            <img src="<?php echo $image['sizes']['large']; ?>" />
            <h3><?php echo $image['title']; ?></h3>
          </li>
        <?php endforeach; ?>
      </ul>
      <ul id="gallery-control">
        <?php foreach($gallery as $image): ?>
          <li class="gallery-thumb">
            <img src="<?php echo $image['sizes']['small']; ?>" />
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
<?
	endwhile; endif;
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
