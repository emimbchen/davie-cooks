# Name of Project

First Written: 
`2  February 2020`

Last Updated:
`2  February 2020`

=== General Information ===
Production Url: ortho-institute.org
Platform/CMS: WordPress
Initial Devleopment by:

- **Emi Chen**
- **Justin Bigham**
- **Ariel Zannou**

=== Technologies ===

* [Gulp](http://gulpjs.com/) - Streaming build system
* [npm](https://www.npmjs.com/) - Node package manager
* [Sass](http://sass-lang.com/) - Syntactically Awesome Style Sheets
* [NeatGrid](https://neat.bourbon.io/) - Neat Grid

---

## Local Environment Setup

For MAMP (Free)

1. Clone site from repo on AWS into Applications>MAMP>htdocs folder
2. Navigate to the site’s active theme
3. Run ```npm install```
4. Access dashboard at /wp-admin using environment config credentials from basecamp
5. Create Database - Database Name : `grande_cheese`
6. Import an updated Database (or use migratedb plugin to import database)
7. Site can be viewed at the localhost port set in the ports tab (default is localhost:8888)

For MAMP (pro)

1. Create a new site by clicking the "+" icon towards the bottom of the "Hosts" view
2. Creating a new host:
    - Name your new site `grandecheese.local`
    - Document Root: Point to the root directory of the WordPress site files you cloned earlier in the setup
    - Check the boxes for "create a database" and "generate certificate for https access"
3. Create Database - Database Name : `grande_cheese`
4. Import an updated Database (or use migratedb plugin to import database)
5. Run ```npm install```
6. Go back to MAMP Pro hosts window. Right-click on your `grandecheese.local` host and select "open in browser"
7. Access dashboard at /wp-admin using environment config credentials from basecamp



note: to compile files run the default `gulp` task in terminal

---

## Version Control

Release/Develop is the primary branch for staging
Release/Production is the primary branch for production

To create a new branch use the following naming convention ```Feature/JIRA100--epic-name```

### Pull Requests

When a feature is complete/ a branch is ready to be merged into Develop: 

1. Merge develop into your branch
2. Submit a pull request in code commit [instructions here](https://docs.aws.amazon.com/codecommit/latest/userguide/pull-requests.html)
3. Notify the lead dev 

____________________________________________________________

## Overview of Directories and Files:

###### Directories
- **dist/** - compiled assets (these get rewritten by Gulp)
- **fonts/** - a place to put locally hosted fonts. These fonts are included in SASS by "src/sass/global/fonts.scss"
- **node_modules/** - these are the node.js dependencies for this theme including gulp and gulp-sass, this directory is not part of the repo but is created when you setup or clone this project for the first time (by running npm install from the theme directory)
- **src/** - the source files that create the compiled assets, includes sass, bourbon and neat, js
- **template-parts/** - put partials that get called by wordpress templates here

###### Files
- **.gitignore** - this is set up to work with this theme, can be edited to meet your needs
- **functions-library.php** - these are snippets for common WordPress functions that you can move into functions.php if you need them 
- **gulpfile.js** - this is what tells Gulp what to do, it can be edited if need be
- **package.json** - this is what tells node package manager what to do when you run "npm install"
- **README.md** - this is where you should put documentation for the theme you create
- **style.css** - this is required by WordPress in order to register as a valid theme, don't use for any CSS. All CSS should be added within the "src/sass" files and be compiled by Gulp.

____________________________________________________________

### Enqueueing Scripts and Stylesheets

If you need to add another stylesheet or script, add it to the `my_add_theme_scripts()` function in functions.php and don't put it in the header. This is the recommended way of adding scripts and stylesheets to WordPress to avoid conflicts between themes and plugins and it also prevents dependencies from being loaded multiple times. The `my_add_theme_scripts()` function is set up to preload jQuery as a dependency of main.js so you don't need to add it anywhere else.


____________________________________________________________

## CSS

This theme does not use any standard CSS, please do not write styles within the default styles.css. All CSS should be added via SASS within the "src/sass/" directory. This directory is compiled by Gulp and distributed to the "dist/css/" directory for use in production.


#### SASS Compiling

All styles should be written using a minimal amount of nesting. With that in mind, each module should define a single outer class to isolate all internal module-specific styling to just that module. 

The stylesheets are set up to be compiled with SASS. Style.scss includes a reset (normalize.css) which you can swap for another one if you have a different reset you prefer. There are a few basic sass variables and mixins found in "src/sass/global/variables.scss" and "src/sass/global/mixins.scss" which you can use/modify/delete but they are there as a start.

Fonts- Located in `sass/components/_fonts.scss`

There's a Gulp file setup to compile sass files. In terminal, if you open the theme directory and run "gulp" it will compile all styles to dist/css/style.css. You may need to run "npm install" the first time you use the theme to install Gulp and other node dependencies locally in your project.


#### SASS Variables

The SASS variables are defined within "src/sass/global/variables.scss." You are welcome to add more variables to help make your theme more globally controlled. If you find yourself writing the same value multiple times over, you should define a SASS variable or mixin for it. Consider the [DRY method.](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) Variables and Mixins are very helpful when it comes to making consistent updates throughout the site's lifecycle. 


#### SASS Mixins

You will find the majority of mixins within the theme in "src/sass/global/mixins.scss" and "src/sass/global/fonts.scss." The font mixin set is designed to help make your fonts more centralized throughout the theme. The mixins are especially helpful when it comes to a design change later in the theme's lifecycle.



____________________________________________________________

## JavaScript

All JS should be written within the "src/js/" directory. This directory is compiled by Gulp and distributed to the "dist/js/" directory for use in production.
 

#### A note about jQuery "No-Conflict Mode"
Because WordPress loads jquery in no-conflict mode, the `$` alias will work only inside a document ready function with this syntax:
```
jQuery( document ).ready( function( $ ) {
  
});
```

In order to use the `$` alias outside of the document ready function, wrap it in this function instead:
```
( function( $ ){
  
} )( jQuery );
```
(from a post by Chris Coyier https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/)


**ALTERNATIVELY...**

You can deregister the pre-registered version of jQuery and add your own:
```
// To deregister the existing jquery:
wp_deregister_script( 'jquery' );
  
// To enqueue your own:
$scripts_jquery = '/dist/js/<name of your jquery script goes here>';
wp_register_script( 'jquery', get_stylesheet_directory_uri().$scripts_jquery, null, filemtime(get_stylesheet_directory().$scripts_jquery), true );
wp_enqueue_script( 'jquery' );
```

Then you can use the regular document ready function and $ alias as you normally would.


#### Skip Links
Skip links are key to making a website accessible. They allow a user using a screen reader to skip over hearing the entire header and nav read and skip to the main content. Its href is an anchor link that goes directly to the #main div. The link is in the header, the #main div it links to is in page.php, and the style that hides the link (position:absolute;top-50px;) is in global.scss. 

## PHP

## Alt Tag Fallback

For all wordpress media, use the ada_img_alt() function to provide automatic alt tag fallbacks. 

```php
    <img alt="<?php echo ada_img_alt($image); ?>">
```

---

### template-flex.php

template-flex.php dynamically pulls in the module template parts.

To add new page builder modules
1. Add layout to the ACF "Page Builder" flex content
2. Create php template in /template-parts/page-builder
note :The module file name must match the ACF flex-content row-layout name.
3. Add the basic structure for a module.

### Basic Field Requirements
- section_label for the arial labels
note: sectionNumber is automatically generated on page.php and acts as a fallback for the section label.


```php
 $sectionNumber = ($sectionCounter) ? 'section-'.$sectionCounter : '' ;
    $sectionLabel = get_sub_field('section_label') ? get_sub_field('section_label') : $sectionNumber;    
```
```html
<section class="nameofmodal-section" aria-label="<?php echo $sectionLabel?>">
    <div class="container">
    </div>
</section>
```