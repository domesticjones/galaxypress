<?php
  $currentUser = get_current_user_id();
  $currentId = get_the_id();
  $args = array(
  	'post_type'        => 'company',
    'p' => $currentId,
  );
  $availableCompanies = new WP_Query($args);
  if($availableCompanies->have_posts()) {
  	while($availableCompanies->have_posts()) {
  		$availableCompanies->the_post();
      $permissions = get_field('users');
      if(in_array($currentUser, $permissions) || current_user_can('edit_pages')) {
        get_template_part('templates/company', 'single-display');
      } else {
        get_template_part('templates/company', 'logincheck');
      }
  	}
  }
  wp_reset_postdata();
?>
