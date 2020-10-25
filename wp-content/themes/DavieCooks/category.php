<?php
/**
 * Category archive page
 */

get_header(); 
$category = get_queried_object(); 
$args = array(
    'post_type' => 'recipes',
    'cat'=> $category->term_id
);
$title = single_cat_title('', false);
$background = get_field('image', $category->taxonomy . '_' . $category->term_id)['url'];
$categories = null;
$vars['author'] = null;
$vars['description'] = null;
$query = new WP_Query( $args );
?>

<div class="main recipes">
    <?php include('template-parts/blocks/hero-background.php')?>
	<div class="container">
        <div id="recipe-results">        
        <?php
        // The Loop
        while($query->have_posts()) : $query->the_post();
            $post_id = get_the_ID();
            include('template-parts/ajax/_recipeCard.php');
        endwhile; ?>
        </div>
	</div>
</div> <!-- end div.main -->	

<?php get_footer(); ?>