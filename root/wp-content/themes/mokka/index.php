<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mokka
 * @since Mokka 1.0
 */
?>
<?php get_header(); ?>

<?php
get_template_part("home-layout-1");
?> 

<?php get_footer(); ?>