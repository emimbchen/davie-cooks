<?php
/**
 * The page template file
 */

get_header(); ?>

<div class="main" id="main">
	<div class="container">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	        <h1><?php the_title();?></h1>
	        <?php the_content();?>

		<?php endwhile; endif; ?>

		<?php //get_template_part('template-parts/sidebar', 'one'); ?>
		<?php //get_template_part('template-parts/sidebar', 'two'); ?>

	</div>
</div> <!-- end div.main -->	

<?php get_footer(); ?>
