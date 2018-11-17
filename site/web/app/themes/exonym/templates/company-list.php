<?php
  $currentUser = get_current_user_id();
  $companyCount = 0;
  $args = array(
  	'post_type'        => 'company',
    'orderby'          => 'title',
    'order'            => 'ASC',
    'posts_per_page'   => -1,
  );
  $availableCompanies = new WP_Query($args);
  if($availableCompanies->have_posts()) {
    echo '<h2>Choose a business below</h2>';
  	while($availableCompanies->have_posts()) {
  		$availableCompanies->the_post();
      $permissions = get_field('users');
      if(in_array($currentUser, $permissions) || current_user_can('edit_pages')) {
        echo '<a href="' . get_permalink() . '">';
        the_post_thumbnail('small');
        echo '<span>' . get_the_title() . '</span>';
        echo '</a>';
        $companyCount++;
      }
  	}
    if($companyCount == 0) {
      get_template_part('templates/company', 'none');
    }
  }
  wp_reset_postdata();
?>
