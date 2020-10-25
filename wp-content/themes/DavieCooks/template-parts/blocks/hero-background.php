<?php 
    $backgroundColors = ['#293462', '#00818a', '#ec9b3b', '#f7be16'];
    $style = 'style="';
    if($background){
        $style .= 'background-image: url('. $background .');"';
    }else{
        $color = $backgroundColors[mt_rand(0, count($backgroundColors) - 1)];
        $style .= 'background: '. $color.'; background-image:url('.get_template_directory_uri().'/assets/dist/imgs/bedge-grunge.png);"'; 
    }

?>
<div class="hero" <?php echo $style?>>
        <div class="container">
            <div class="hero__content">
                <div class="hero__categories"><?php 
                //category loop
                if($categories):
                    foreach($categories as $cat){?>
                    <a href="<?php echo get_term_link( $cat ) ?>"><?php echo $cat->cat_name ?></a>
                    <?php
                    }
                endif;
                ?>
                </div>
                <h1><?php echo $title ?></h1>
                <?php if($vars['author']): ?>
                <p class="hero__author">By: <?php echo $vars['author'] ?></p>
                <?php endif; ?>
                <p><?php echo $vars['description'] ?></p>
            </div>
        </div>
    </div>