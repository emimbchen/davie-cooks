<?php 
$background = get_field('image', $category->taxonomy . '_' . $id);
?>
<a href="<?php echo get_category_link($category->term_id) ?>">
    <div class="category-block" style="background-image:url(<?php echo $background ? $background['url']: '' ?>)">
        <div>
            <h2><?php echo $category->name ?></h2>
        </div>
    </div>
</a>