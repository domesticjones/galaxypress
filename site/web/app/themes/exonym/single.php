<?php
	/* ===================
		 DEFAULT SINGLE POST
		 =================== */
	get_header();
	get_template_part('templates/wrap', 'start');
	get_template_part('templates/loop', 'articles-single');
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
