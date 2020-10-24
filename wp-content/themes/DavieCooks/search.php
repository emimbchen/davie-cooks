<?php
/**
 * Template Name: Search Page
 */

get_header(); 
global $wp_query;
?>

<div class="main" id="main">
	<div class="container">
        <div class="title">
            <h1>Search Results For: "<?php the_search_query(); ?>" (<?php echo $wp_query->found_posts; ?>)</h1>
        </div>
        <form method="get" id="searchform" class="searchform wrapper" action="<?php bloginfo('url'); ?>/">
            <label class="input-container">
                    <input type="text" value="<?php the_search_query() ?>" name="s" id="s" placeholder="Search&hellip;">
                    <input type="hidden" name="search-type" value="normal" />
                    <button class="submit-button search-submit btn" type="button" name="submit" type="submit" value="Submit"><span class="far fa-search"></i></button>
            </label>
        </form>
        <div class="search-results">
        <?php if ( have_posts() ) { ?>
            <ul>
            <?php while ( have_posts() ) { the_post(); ?>
            <li>
                <h3><a href="<?php echo get_permalink(); ?>">
                <?php the_title();  ?>
                </a></h3>
                <p><?php  echo get_the_excerpt() ?></p>
                <div class="h-readmore"> <a href="<?php the_permalink(); ?>">Read More <span class="far fa-long-arrow-alt-right"></span></a></div>
            </li>

            <?php } ?>

            </ul>

            <?php echo paginate_links(); ?>

            <?php } ?>
        </div>
	</div>
</div> 
<!-- end div.main -->	

<?php get_footer(); ?>
