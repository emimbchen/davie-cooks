<?php
/**
 * The page template file
 */

get_header(); ?>

<div class="main" id="main">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php if(get_field('include_title') == true):?>
					<div class="title">
						<h1><?php the_title();?></h1>
					</div>
				<?php endif; ?>
				<?php the_content();?>
			<?php endwhile; 
		endif; ?>
	</div>
</div> 
<!-- end div.main -->	

<?php get_footer(); ?>
