<?php
  /* ==============
     POSTS ARCHIVES
     ============== */

	get_header();
	get_template_part('templates/wrap', 'start');
	get_template_part('modules/module', 'hero');
	get_template_part('templates/loop', 'articles');
	get_template_part('templates/wrap', 'end');
	get_footer();
?>
