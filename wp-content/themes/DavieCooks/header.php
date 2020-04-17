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
						<a href="<?php bloginfo('url'); ?>"><img alt="logo" src="logo.png" />logo</a>					
					</div>

					<div class="search">
						<form method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>/">
							<input type="text" value="" name="s" id="s" placeholder="Search&hellip;"/>
							<input type="hidden" name="search-type" value="normal" />
							<input name="submit" type="submit" value="Go" />
						</form>
					</div>

					<div class=" nav">
						<nav role="navigation" class="mainNav">
							<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
						</nav>
					</div>
				</div>
			</header>






