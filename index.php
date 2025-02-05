<<<<<<< HEAD
<?php get_header(); ?>

<?php echo "Hello World"; ?>

<div>
    This is some other content
</div>

<?php get_footer(); ?>
=======
<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
>>>>>>> 15069cf8e8c0402423ab63a9877c0092d02d3cc7
