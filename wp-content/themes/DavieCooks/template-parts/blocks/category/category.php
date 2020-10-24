<section class="category-block">
    <?php 
    $categories = get_categories();
        foreach($categories as $category):
            $id = $category->term_id;
            if($id != 1):
            include('category-block.php');
            endif;
        endforeach;
    ?>
</section>