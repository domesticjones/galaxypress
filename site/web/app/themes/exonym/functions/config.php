<?php
	/* ===================
		 THEME CONFIGURATION
		 =================== */

    // URL Shortcuts
    define('THEMEURL', get_template_directory()); 				            // shortcut to point to the root theme dir
    define('THEMECORE', get_template_directory() . '/core'); 	      	// shortcut to point to the /core/ dir
    define('THEMECSS', get_template_directory() . '/dist/styles');   	// shortcut to point to the /styles/ dir
    define('THEMEIMAGES', get_template_directory() . '/dist/images');	// shortcut to point to the /images/ dir
    define('THEMEFONTS', get_template_directory() . '/dist/fonts');	  // shortcut to point to the /fonts/ dir
    define('THEMEJS', get_template_directory() . '/dist/scripts');  	// shortcut to point to the /scripts/ dir

    // URI Shortcuts
    define('THEME', get_parent_theme_file_uri(), true);  	// shortcut to the theme root URI
    define('CORE', THEME . '/core', true);                // shortcut to point to the /core/ URI
    define('FAVICONS', THEME . '/favicons', true);        // shortcut to point to the /core/ URI
    define('CSS', THEME . '/dist/styles', true);          // shortcut to point to the /styles/ URI
    define('IMAGES', THEME . '/dist/images', true);       // shortcut to point to the /images/ URI
    define('FONTS', THEME . '/dist/fonts', true); 	      // shortcut to point to the /images/ URI
    define('JS', THEME . '/dist/scripts', true); 		      // shortcut to point to the /scripts/ URI

    // Add HTML5 and Media Query support for IE (NOTE: init)
    function add_ie_html5_shim () {
      echo '<!--[if lt IE 9]>';
      echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
      echo '<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>';
      echo '<![endif]-->';
    }

    // Add jQuery from Google's CDN and remove the default jQuery (NOTE: init)
    function register_jquery() {
      if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js', false, '2.2.0');
        wp_enqueue_script('jquery');
      }
    }

    // Remove jQuery Migrate because we have eslint telling us everything we did wrong (NOTE: init)
    function remove_jquery_migrate($scripts) {
       if(is_admin()) return;
       $scripts->remove('jquery');
       $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
    }

    // Adding WP 3+ Functions & Theme Support (NOTE: init)
    function ex_theme_support() {
    	add_theme_support('automatic-feed-links'); // RSS for all post types
    	add_theme_support('html5', array(
    		'comment-list',
    		'search-form',
    		'comment-form',
    		'caption'
    	));
    }

    // Inject the real scripts and styles (NOTE: init)
    function ex_scripts_and_styles() {
      global $wp_styles;
      if (!is_admin()) {

        // The custom files from the dist folder
        wp_enqueue_style('ex_styles', asset_path('styles/main.css'), false, null);
        wp_enqueue_script('ex_scripts', asset_path('scripts/main.js'), ['jquery'], null, true);
        wp_localize_script( 'ex_scripts', 'galaxy_press_comment_params', array(
          'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
        ) );

        // Only embed threadded comments when necessary
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) { wp_enqueue_script( 'comment-reply' ); }
      }
    }
