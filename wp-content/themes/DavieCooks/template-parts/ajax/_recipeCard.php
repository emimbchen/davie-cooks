<?php 
    $cats = wp_get_post_categories($post_id);
?>

    <article class="recipeCard">
        <a href="<?php the_permalink() ?>">
            <div class="img-wrap">
                <?php the_post_thumbnail($post_id, 'large') ?>
            </div>
        </a>
        <div class="recipeCard__content">
            <?php if($cats && !is_category()): ?>
            <div class="cats">
                <?php foreach($cats as $cat):
                    $cat = get_category($cat);
                    ?>
                    <a href="<?php echo get_category_link( $cat->term_id )?>"><span><?php echo $cat->name ?></span></a>
                <?php endforeach;?>
            </div>
            <?php endif; ?>
            <a href="<?php the_permalink() ?>">
                <h2><?php the_title() ?></h2>
            </a>
            <?php if(get_the_excerpt($post_id)):?>
                <p><?php echo get_the_excerpt($post_id) ?></p>
            <?php endif; ?>
        </div>
    </article>
