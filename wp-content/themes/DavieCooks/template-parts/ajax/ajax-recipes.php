<?php 
require_once('../../../../../wp-load.php');
$search = isset($_POST["search"]) ? htmlspecialchars($_POST["search"]) : '';
$category = isset($_POST["category"]) ? htmlspecialchars($_POST["category"]) : '';
$page = isset($_POST["page"]) ? htmlspecialchars($_POST["page"]) : 1;

$perPage = 12;
$postArgs = array(
    'post_type'=> 'recipes',
    'posts_per_page'=> $perPage,
    'paged'=>$page,
    's'=>$search,
    'tax_query'=> array(
        array(
            'taxonomy'=> 'category',
            'field'=> 'slug',
            'terms' => $category,
            'operator'=>'IN'
        )
    )
);

$post_query = new WP_Query($postArgs);
relevanssi_do_query($post_query);
$totalpost = $post_query->found_posts;

if($post_query->have_posts()) :
    $count = 1;
    if($page > 1){
        $count = ($page - 1) * $perPage + 1;
    }
    while($post_query->have_posts()) : $post_query->the_post();
        $post_id = get_the_ID();
        include('_recipeCard.php');
        $count ++; 
        endwhile;
    else: ?>
    <div class="container">
        <article>
            <h2>Sorry, no results found!</h2>
        </article>
    </div>
    <?php endif; wp_reset_postdata(); ?>
    <div class="totalPosts hidden"><?php echo $totalpost?></div>