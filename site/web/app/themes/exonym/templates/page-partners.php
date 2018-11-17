<?php
	/* =======================
		 TEMPLATE NAME: Partners
		 ======================= */
	get_header();
	get_template_part('templates/wrap', 'start');
	if(have_posts()): while(have_posts()): the_post();
?>
	<section class="module-subhead wrap">
		<h1 class="page-heading wrap"><?php the_title(); ?></h1>
    <?php $logos = get_field('logos'); if($logos): ?>
      <ul class="image-grid">
        <?php foreach($logos as $logo): ?>
          <li class="image-grid-single"><img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo $logo['alt']; ?>" /></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
	</section>
<?
	endwhile; endif;
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
