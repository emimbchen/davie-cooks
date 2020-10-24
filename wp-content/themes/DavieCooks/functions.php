<?php

/*************************************************************/
/*  ENQUEUE SCRIPTS AND STYLES 								*/
/***********************************************************/
// for documentation and a list of scripts that are pre-registered by wordpress see https://developer.wordpress.org/reference/functions/wp_enqueue_script
// for a quick overview read this http://www.wpbeginner.com/wp-tutorials/how-to-properly-add-javascripts-and-styles-in-wordpress

function my_add_theme_scripts() {
    // Define enqueue vars
    $theme_prefix   = 'theme-';
    $theme_url      = get_stylesheet_directory_uri();   // Absolute path to theme directory (URL)
    $theme_rel      = get_stylesheet_directory();       // Relative path to theme directory
    $ajax_url       = admin_url( 'admin-ajax.php' );    // Localized AJAX URL


    /***** ENQUEUE DEPENDENCIES *****/
    $dep_styles_vendor = null;
    $dep_styles_custom = null;
    $dep_scripts_vendor = array('jquery');
    $dep_scripts_custom = array('jquery');


    /***** VENDOR STYLES *****/
    $handle_styles_vendor = $theme_prefix.'vendor-styles';
    $path_styles_vendor = '/assets/dist/css/'.$theme_prefix.'vendor.min.css';
    // if file exists, register & enqueue
    if( file_exists($theme_rel.$path_styles_vendor) ){
        // Update dependencies
        $dep_styles_custom = array($handle_styles_vendor);
        // Enqueue Asset
        wp_register_style( $handle_styles_vendor, $theme_url.$path_styles_vendor, $dep_styles_vendor, filemtime($theme_rel.$path_styles_vendor), false );
        wp_enqueue_style( $handle_styles_vendor );
    }

    /***** CUSTOM STYLES *****/
    $handle_styles_custom = $theme_prefix.'custom-styles';
    $path_styles_custom = '/assets/dist/css/theme-custom.min.css';
    // if file exists, register & enqueue
    if( file_exists($theme_rel.$path_styles_custom) ){
        // Enqueue Asset
        wp_register_style( $handle_styles_custom, $theme_url.$path_styles_custom, $dep_styles_custom, filemtime($theme_rel.$path_styles_custom), false );
        wp_enqueue_style( $handle_styles_custom );
    }

    /***** VENDOR SCRIPTS *****/
    $handle_scripts_vendor = $theme_prefix.'vendor-scripts';
    $path_scripts_vendor = '/assets/dist/js/'.$theme_prefix.'vendor.min.js';
    // if file exists, register & enqueue
    if( file_exists($theme_rel.$path_scripts_vendor) ){
        // Update dependencies
        $dep_scripts_custom = array('jquery', $handle_scripts_vendor);
        // Enqueue Asset
        wp_register_script( $handle_scripts_vendor, $theme_url.$path_scripts_vendor, $dep_scripts_vendor, filemtime($theme_rel.$path_scripts_vendor), true );
        wp_enqueue_script( $handle_scripts_vendor );
    }

    /***** CUSTOM SCRIPTS *****/
    $handle_scripts_custom = $theme_prefix.'custom-scripts';
    $path_scripts_custom = '/assets/dist/js/'.$theme_prefix.'custom.min.js';
    // if file exists, register & enqueue
    if( file_exists($theme_rel.$path_scripts_custom) ){
        // Enqueue Asset
        wp_register_script( $handle_scripts_custom, $theme_url.$path_scripts_custom, $dep_scripts_custom, filemtime($theme_rel.$path_scripts_custom), true );
        wp_enqueue_script( $handle_scripts_custom );
        // Pass variables from PHP into JS - accessible from the "php_vars" JS object: console.log('php_vars: ', php_vars)
        wp_localize_script( $handle_scripts_custom, 'php_vars', array(
            'ajax_url' => $ajax_url,
        ) );
    }

}
add_action( 'wp_enqueue_scripts', 'my_add_theme_scripts' );


/*************************************************************/
/*  REGISTER MENUS 			 								*/
/***********************************************************/

function register_my_menus() {

  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
	  'footer-menu' => __( 'Footer Menu' ),
    )
  );

}
add_action( 'init', 'register_my_menus' );


/*************************************************************/
/*  ADVANCED CUSTOM FIELDS 					 				 */
/*************************************************************/

// add options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
  ));	
  
}


/*************************************************************/
/*  ADA - WP IMG ALT  :: 
/*  Use in template: alt="<?php echo ada_img_alt($image); ?>"*/
/*************************************************************/

function ada_img_alt($img_object, $fallbackText = 'Image Alternative Text'){
  $alt = $img_object['alt'];
  if ($alt == null){
      $alt = $img_object['title'];
      if ($alt == null){
          $alt = $img_object['caption'];
          if ($alt == null){
              $alt = $img_object['description'];
              if ($alt == null){
                  $alt = $fallbackText;
              }
          }
      }
  }
  return $alt;
}

/*************************************************************/
/* CLEAN UP WORDPRESS ADMIN MENU */
/*************************************************************/

function custom_menu_page_removing()
{
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'custom_menu_page_removing');

/*************************************************************/
/*  Adding color palette                						         */
/*************************************************************/
// to acf
function kronos_acf_input_admin_footer()
{ ?>
    <script type="text/javascript">

        (function ($) {
            acf.add_filter('color_picker_args', function (args, $field) {
                args.palettes = ['#293462', '#00818a', '#ec9b3b', "#f7be16"];
                return args;
            });
        })(jQuery);

    </script>
<?php }

add_action('acf/input/admin_footer', 'kronos_acf_input_admin_footer');

// to wordpress
function my_mce4_options($init)
{
    $default_colours = '
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Brown",
        "C0C0C0", "Silver",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue",
        "CC99FF", "Plum",
        "FFFFFF", "White"
        ';
    $custom_colours = '
        "293462", "Navy",
        "00818a", "Turquoise",
        "ec9b3b", "Orange",
        "f7be16", "Yellow"
      ';
    $init['textcolor_map'] = '[' . $default_colours . ',' . $custom_colours . ']';
    $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
    return $init;
}

add_filter('tiny_mce_before_init', 'my_mce4_options');

//add thumbnail support
add_theme_support( 'post-thumbnails' );

//add excerpt support
function wpcodex_add_excerpt_support_for_pages() {
    add_post_type_support( 'recipes', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

// init blocks
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'categories',
            'title'             => __('Categories'),
            'description'       => __('Category Listing'),
            'render_template'   => 'template-parts/blocks/category/category.php',
            'category'          => 'widgets',
            'icon'              => 'columns',
            'keywords'          => array( 'categories', 'category', 'blocks', 'listing' ),
        ));
    }
}
