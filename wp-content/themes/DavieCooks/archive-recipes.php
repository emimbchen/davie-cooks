<?php
/**
 * The main template file
 */

get_header(); ?>

<div class="main recipes">
	<div class="container">
        <div class="title">
        <h1>Recipe Book</h1>
        </div>
        <div class="recipes__filter">
            <div class="search">
                <form method="get" id="searchform" class="searchform wrapper" action="<?php bloginfo('url'); ?>/">
                    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="searchInput" placeholder="Search">
                    <input type="hidden" name="search-type" value="normal" />
                    <button class="submit-button search-submit btn" type="button" name="submit" type="submit" value="Submit"><span class="far fa-search"></i></button>
                </form>
            </div>  
            <div class="filters">
                <div class="custom-select category">
                    <select title="Recipe Categories">
                        <option value="0">Recipe Categories:</option>
                        <?php 
                        $categories = get_categories();
                        foreach($categories as $category) {
                            if($category->name != 'Uncategorized' ){
                                echo '<option data-type="'.$category->slug.'" name="'.$category->slug.'">'.$category->name.'</option>';
                            }
                        }
                        ?>
                        <option value="0" data-type="">All</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="recipe-results"></div>
        <div class="search-pagination">
            <ul class="page-btns">
                   <li class="page-btn page-prev"><span class="far fa-chevron-left"></span></li>
                   <li class="pageNumbers"></li>
                   <li class="page-btn page-next"><span class="far fa-chevron-right"></span></li>
            </ul>
        </div>
	</div>
</div> <!-- end div.main -->	

<?php get_footer(); ?>

<script>
    jQuery(document).ready(function($){
        var page = 1;
        var category = "";
        var search = "";

        //on page search submit
        function onFormSubmit(){
            $('.submit-button').on('click', function(){
                search = $('#searchInput').val();
                page = 1;
                loadPosts();
            })
        }
        onFormSubmit();

        //on page search
        function pageSearch(){
            search = $('#searchInput').val();
            page = 1;
            loadPosts();
        }

        pageSearch();

        //search on enter
        $('#searchInput').keypress(function(e){
            var keyCode = e.keyCode || e.which;
            if(keyCode === 13){
                e.preventDefault();
                search = $('#searchInput').val();
                page = 1;
                loadPosts();
                return false;
            }
        })

        //category filter
        $('html').on('click', '.category .select-items div', function(){
            category = $(this).attr('data-type');
            page = 1;
            loadPosts();
        })

        //ajax
        function loadPosts(){
            if($('#recipe-results').length){
                $.ajax({
                    type: 'post',
                    url: '<?php echo get_template_directory_uri(); ?>/template-parts/ajax/ajax-recipes.php',
                    dataType: 'json',
                    complete: function(data){
                        if(data.responseText){
                            $('#recipe-results').html(data.responseText);
                            $('#recipe-results').fadeIn();
                        }
                        postTotal();
                        page++;
                    },
                    data:{ 'page': page, 'category' : category, 'search' : search }
                });
            }
        }

        function postTotal(){
            var perPage = 12;
            var totalPosts = $('.totalPosts').text();
            var pagesTotal = totalPosts / perPage;
            //page volume calcs
            if(totalPosts == ''){
                totalPosts = 0;
            }else{
                if(totalPosts !=0){
                    pagesTotal = pagesTotal + 1;
                }
            }
            maxPages = Math.ceil(parseInt(pagesTotal));

            //page numbers

            $('.pageNumbers').html('<span>Page '+ page + ' of ' + maxPages + '</span>')

            //calculating results
            $('.results').text(totalPosts);

            //paginations next
            if(page == maxPages){
                $('.page-next').hide();
            }else{
                $('.page-next').show();
            }

            //pagination prev
            if(page == 1){
                $('.page-prev').hide();
            }else{
                $('.page-prev').show();
            }
        }

        //pagination next
        function pageNext(){
            $('.page-next').on('click', function(){
                page = page++;
                loadPosts();
            })
        }
        pageNext();

         //pagination prev
         function pagePrev(){
            $('.page-prev').on('click', function(){
                page = page - 2;
                loadPosts();
            })
        }
        pagePrev();

        //disable on search input
        $('#searchForm').submit(function(e){
            e.preventDefault();
        })

    })
</script>
