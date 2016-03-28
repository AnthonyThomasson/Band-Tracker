<?php
/**
 * Template Name: Artists Page
 *
 * Brings up all artists in a list
 *
 * @package WordPress
 */

?>

<?php get_header(); 
get_template_part('breadcrums'); ?>
<div class="container">
	<div class="row enigma_blog_wrapper">
	<div class="col-md-8">
		<?php query_posts( 'post_type=artist'); ?>
		<?php if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
} ?>

	<?php get_template_part('post','page'); ?>	


	</div>
	<?php get_sidebar(); ?>	
	</div>
</div>	
<?php get_footer(); ?>

