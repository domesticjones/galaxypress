<?php
	/* ===================
		 WP IMAGE DEFINITIONS
		 =================== */

  // WP Theme Checker Compliance
  function ex_theme_terlet() {
  	flush_rewrite_rules();
  }
  add_action('after_switch_theme', 'ex_theme_terlet');

  // Register Custom Post Type
  function cpt_companies() {

  	$labels = array(
  		'name'                  => _x( 'Companies', 'Post Type General Name', 'companies' ),
  		'singular_name'         => _x( 'Company', 'Post Type Singular Name', 'companies' ),
  		'menu_name'             => __( 'Companies', 'companies' ),
  		'name_admin_bar'        => __( 'Company', 'companies' ),
  		'archives'              => __( 'Company Archives', 'companies' ),
  		'attributes'            => __( 'Company Attributes', 'companies' ),
  		'parent_item_colon'     => __( 'Parent Company:', 'companies' ),
  		'all_items'             => __( 'All Companies', 'companies' ),
  		'add_new_item'          => __( 'Add New Company', 'companies' ),
  		'add_new'               => __( 'Add New', 'companies' ),
  		'new_item'              => __( 'New Company', 'companies' ),
  		'edit_item'             => __( 'Edit Company', 'companies' ),
  		'update_item'           => __( 'Update Company', 'companies' ),
  		'view_item'             => __( 'View Company', 'companies' ),
  		'view_items'            => __( 'View Companies', 'companies' ),
  		'search_items'          => __( 'Search Company', 'companies' ),
  		'not_found'             => __( 'Not found', 'companies' ),
  		'not_found_in_trash'    => __( 'Not found in Trash', 'companies' ),
  		'featured_image'        => __( 'Featured Image', 'companies' ),
  		'set_featured_image'    => __( 'Set featured image', 'companies' ),
  		'remove_featured_image' => __( 'Remove featured image', 'companies' ),
  		'use_featured_image'    => __( 'Use as featured image', 'companies' ),
  		'insert_into_item'      => __( 'Insert into Company', 'companies' ),
  		'uploaded_to_this_item' => __( 'Uploaded to this Company', 'companies' ),
  		'items_list'            => __( 'Companies list', 'companies' ),
  		'items_list_navigation' => __( 'Companies list navigation', 'companies' ),
  		'filter_items_list'     => __( 'Filter Companies list', 'companies' ),
  	);
  	$args = array(
  		'label'                 => __( 'Company', 'companies' ),
  		'description'           => __( 'Clients and their products', 'companies' ),
  		'labels'                => $labels,
  		'supports'              => array( 'title', 'thumbnail', 'comments' ),
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => true,
  		'menu_position'         => 5,
  		'menu_icon'             => 'dashicons-money',
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => true,
  		'exclude_from_search'   => true,
  		'publicly_queryable'    => true,
  		'capability_type'       => 'page',
  		'show_in_rest'          => false,
  	);
  	register_post_type( 'company', $args );

  }
  add_action( 'init', 'cpt_companies', 0 );
