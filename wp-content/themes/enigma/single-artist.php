<?php
/**
 * Single Artist Page
 *
 * Brings up band data, tour map, etc.
 * http://www.makeuseof.com/tag/events-listing-custom-post-types-wordpress/
 * @package WordPress
 */

?>

<?php 
	get_header(); 
	get_template_part('breadcrums'); 
?>

<div class="container">	
	<div class="row enigma_blog_wrapper">
		<div class="col-md-8 col-sm-12">	
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			?>		
			
			<?php 
				get_template_part('post','content'); 

				// get_template_part('author','intro');
				
				endwhile; 
				
				else : 
					get_template_part('nocontent');
				endif;


				// weblizar_navigation_posts();
				
				comments_template( '', true ); 
			?>



		</div>

		<br/>

		<div class="col-md-4 col-sm-12">
			<iframe width="100%" 
					height="300"
					src="//www.youtube.com/embed/0ZE1bmcWMUY?list=UUbg_n0hovTYuCWuOcLvvvlg" 
					frameborder="0" 
					allowfullscreen>
			</iframe>
			
			<?php 


				$tweet = get_the_title();
				$tweet = str_replace(" ","",$tweet);
				// $tweet = strval($tweet);
				$tweet = strtolower($tweet);

				echo $tweet;


				// ------------------------------------------------------------


			








				// ------------------------------------------------------------

			
			echo '<a class="twitter-timeline" href="https://twitter.com/'.$tweet.'" data-widget-id="535973247414571009">#'.$tweet.' Tweets</a>';
			?>
			
			<!--<script>
				document.ready.location.reload(true);
			</script>-->
			<!-- <!--  -->
			<script>
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			</script>
			


			</div>
		
		<!--<?php get_sidebar(); ?>	-->
	</div> <!-- row div end here -->	
</div><!-- container div end here -->
<?php get_footer(); ?>

