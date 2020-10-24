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
$query = new WP_Query( $args );
?>

<div class="main recipes">
	<div class="container">
         <div class="title">
            <h1><?php single_cat_title(); ?></h1>
         </div>
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