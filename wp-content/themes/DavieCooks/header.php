<?php
/**
 * The template for displaying the header
 */
?> 

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 

		<title><?php wp_title(''); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
		<!-- add additional scripts and stylesheets to my_add_theme_scripts() in functions.php -->
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> >
		<div class="wrapper">

			<header role="banner" class="header">
				<a class="screen-reader-text skip-link" href="#main">Skip to content</a>

				<div class="container">
					<div class="logo">
						<!-- alter the following image src attribute to pull in your logo (or add an image field called 'logo' to the ACF options page) -->
						<a href="<?php bloginfo('url'); ?>"><img alt="logo" src="<?php echo get_field('logo', 'option')['url'] ?>" /></a>					
					</div>
					
					<div class="desktop nav">
						<nav role="navigation" class="mainNav">
							<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
						</nav>
					</div>

					<div class="search desktop">
						<form method="get" id="searchform" class="searchform wrapper" action="<?php bloginfo('url'); ?>/">
							<label class="input-container closed">
								<div class="shadow"></div>
								<div class="center">
									<input type="text" value="" name="s" id="s" placeholder="Search&hellip;">
									<input type="hidden" name="search-type" value="normal" />
									<input type="hidden" name="submit" type="submit" value="Go" />
								</div>
								<div class="sticks"></div>
							</label>
						</form>
					</div>
					<div class="mobile-nav mobile">
						<a class="search-icon" href="/?s="><span class="far fa-search"></span></a>

						<button class="hamburger hamburger--collapse" type="button">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>

					</div>

				</div>
			</header>






