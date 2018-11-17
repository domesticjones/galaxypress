<?php
	/* ====================
		 THEME INITIALIZATION
		 ==================== */

  // Init Master
  function ex_subservience() {
  	add_action('init', 'ex_butler'); // enema machine
  	add_action('wp_enqueue_scripts', 'ex_scripts_and_styles', 999); // enqueue base scripts and styles
    add_action('wp_default_scripts', 'remove_jquery_migrate'); // remove jquery migrate
    add_action('wp_enqueue_scripts', 'register_jquery'); // google cdn jquery
    add_action('wp_head', 'add_ie_html5_shim'); // html5 support in all browsers
    add_action('login_enqueue_scripts', 'custom_login_assets'); // customized login
  	add_action('admin_head', 'ex_admin_scripts_and_styles'); // customized admin
    add_action('in_admin_footer', 'ex_admin_js'); // customized admin js
  	ex_theme_support(); // launching theme options
  }
  //Bow down to receive your daily blessing
  add_action('after_setup_theme', 'ex_subservience');
