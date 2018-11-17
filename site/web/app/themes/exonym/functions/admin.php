<?php
	/* =================
		 WP ADMINISTRATION
		 ================= */

	// Admin footer attribution
  function remove_footer_admin() {
    echo '<span id="footer-thankyou">Exstructae : <a href="http://domesticjones.com" target="_blank">Exonym</a></span>';
  }
  add_filter('admin_footer_text', 'remove_footer_admin');

  // Kill the admin bar on the front-end
  add_filter('show_admin_bar', '__return_false');

  // Editor and Custom Admin stylesheets (NOTE: init)
  function ex_admin_scripts_and_styles() {
    if (is_admin()) {
      wp_enqueue_style('ex_styles', asset_path('styles/admin.css'));
      add_editor_style(asset_path('styles/editor.css'));
    }
  }

  // Custom admin JS (NOTE: init)
  function ex_admin_js() {
    wp_enqueue_script('custom_admin_js', asset_path('scripts/admin.js'), array('jquery'));
  }

  // Custom Login Styles & Scripts (NOTE: init)
  function custom_login_assets() {
    wp_enqueue_style('custom-login', asset_path('styles/login.css'));
    wp_enqueue_script('custom-login', asset_path('scripts/login.js'));
  }

  // Custom Login Logo
  function custom_login_logo() { ?>
    <style type="text/css">
      #login h1 a,
      .login h1 a {
        background-image: url(<?php echo ex_logo('alternate', 'light'); ?>);
      }
    </style>
  <?php }
  add_action('login_enqueue_scripts', 'custom_login_logo');




  function my_login_logo_url() {
      return home_url();
  }
  add_filter( 'login_headerurl', 'my_login_logo_url' );

  function my_login_logo_url_title() {
      return 'Your Site Name and Info';
  }
  add_filter( 'login_headertitle', 'my_login_logo_url_title' );



  // Enable SVG upload in admin
  function wpcontent_svg_mime_type($mimes = array()) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'wpcontent_svg_mime_type');

  // Allow Editors to edit Menus
  $roleObject = get_role( 'editor' );
  if (!$roleObject->has_cap('edit_theme_options')) {
    $roleObject->add_cap('edit_theme_options');
  }
