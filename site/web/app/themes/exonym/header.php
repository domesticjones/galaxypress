<?php
  /* ==============
     DEFAULT HEADER
     ============== */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php wp_title(); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<div id="container">
			<?php if(is_page_template('templates/page-home.php') && get_field('header_video')): ?>
				<header id="header-video">
					<video class="ignore-ratio" autoplay muted loop>
						<source src="<?php echo get_field('header_video')['url']; ?>" type="<?php echo get_field('header_video')['mime_type']; ?>">
					</video>
				</header>
			<?php endif; ?>
      <header id="header" class="header-top" role="banner" itemscope itemtype="http://schema.org/WPHeader">
        <div class="wrap">
          <a href="<?php echo get_home_url(); ?>">
						<img src="<?php ex_logo(); ?>" alt="Logo for <?php ex_brand(); ?>" class="logo-header" />
					</a>
					<nav class="header-login">
						<?php
							$loginLink = wp_login_url(get_post_type_archive_link('company'));
							$loginText = 'Client Portal';
							if(is_user_logged_in()) {
								$loginLink = wp_logout_url();
								$loginText = 'Log Out';
							}
						?>
						<a href="<?php echo $loginLink; ?>" class="header-button"><?php echo $loginText; ?></a>
					</nav>
        </div>
				<nav class="nav-header menu-dropdown" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<a href="#" id="responsive-nav-toggle">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</a>
					<?php wp_nav_menu(array(
						'container' => false,								// remove nav container
						'container_class' => '',						// class of container (should you choose to use it)
						'menu' => __('Header', 'exonym'),	  // nav name
						'menu_class' => '',									// adding custom nav class
						'theme_location' => 'header-menu',	// where it's located in the theme
						'before' => '',											// before the menu
						'after' => '',											// after the menu
						'link_before' => '',								// before each link
						'link_after' => '',									// after each link
						'depth' => 0,												// limit the depth of the nav
						'fallback_cb' => ''									// fallback function (if there is one)
					)); ?>
				</nav>
      </header>
