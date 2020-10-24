<?php
/**
 * The recipe template
 */

get_header(); 

$backgroundColors = ['#293462', '#00818a', '#ec9b3b', '#f7be16'];

//var logic
$categories = get_the_category( $post->ID );
$style = 'style="';
if(get_the_post_thumbnail_url()){
    $style .= 'background-image: url('. get_the_post_thumbnail_url() .');"';
}else{
    $color = $backgroundColors[mt_rand(0, count($backgroundColors) - 1)];
    $style .= 'background: '. $color.'; background-image:url('.get_template_directory_uri().'/assets/dist/imgs/bedge-grunge.png);"'; 
}
// variables
$vars = [
    'description' => get_field('description'),
    'comments' => get_field('comments'),
    'author' => get_field('original_author'),
    'serves' => get_field('serves'),
    'prep_time' => get_field('prep_time'),
    'cook_time' => get_field('cook_time'),
    'ready_in' => get_field('ready_in')
]

?>

<div class="main recipe">
    <div class="hero" <?php echo $style?>>
        <div class="container">
            <div class="hero__content">
                <div class="hero__categories"><?php 
                //category loop
                foreach($categories as $cat){?>
                <a href="<?php echo get_term_link( $cat ) ?>"><?php echo $cat->cat_name ?></a>
                <?php
                }
                ?>
                </div>
                <h1><?php the_title() ?></h1>
                <?php if($vars['author']): ?>
                <p class="hero__author">By: <?php echo $vars['author'] ?></p>
                <?php endif; ?>
                <p><?php echo $vars['description'] ?></p>
            </div>
        </div>
    </div>
	<div class="container">
        <div class="stats">
                <?php if($vars['serves']): ?>
                <p><span>Serves:</span> <?php echo $vars['serves'] ?> </p>
                <?php endif;?>
                <?php if($vars['prep_time']): ?>
                <p><span>Prep time:</span> <?php echo $vars['prep_time'] ?> </p>
                <?php endif;?>
                <?php if($vars['cook_time']): ?>
                <p><span>Cook time:</span>  <?php echo $vars['cook_time'] ?> </p>
                <?php endif;?>
                <?php if($vars['ready_in']): ?>
                <p><span>Ready in:</span>  <?php echo $vars['ready_in'] ?> </p>
                <?php endif;?>
        </div>
        <div class="recipe__main">
            <div class="ingredients">
            <h2>Ingredients</h2>
            <?php 
            if( have_rows('ingredients') ):?>
            <ul>
            <?php while( have_rows('ingredients') ) : the_row();
                    $ingredient = get_sub_field('ingredient');
                    ?>
                    <li><?php echo $ingredient ?></li>
                    <?php
                endwhile;
            ?> 
            </ul>
            <?php
            endif;
            ?>
            </div>
            <div class="directions">
            <h2>Directions</h2>
            <?php 
            if( have_rows('directions') ):?>
                <ol>
                <?php while( have_rows('directions') ) : the_row();
                    $direction = get_sub_field('direction');
                    ?>
                    <li><?php echo $direction ?></li>
                    <?php
                endwhile;?> 
                </ol>
            <?php endif;
            ?>
            </div>
        </div>
        <?php if($vars['comments']): ?>
        <div class="notes">
            <h2>Notes</h2>
            <?php echo $vars['comments']?>
        </div>
        <?php endif; ?>
    </div>
    <div class="btn_wrap">
        <a class="btn" href="<?php echo get_post_type_archive_link('recipes') ?>">Back to Recipes</a>
    </div>
</div> <!-- end div.main -->	

<?php get_footer(); ?>
