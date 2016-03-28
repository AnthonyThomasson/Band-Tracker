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
				function echoimage($value) 
				{
				 
				  $thumb = $value["images"]["thumbnail"]["url"];
				  $link = $value["link"];
				  $time = date("d/m/y", $value["created_time"]);
				  $nick = $value["user"]["username"];
				  $avatar = $value["user"]["profile_picture"];
				 
				  return "<div class='insta'>
				  		  	<a href=\"$link\" target=\"_blank\"><img src=\"$thumb\"/></a>
				  		  </div>";
				 
				}

			?>
			
			<?php 

				wpfp_link();

				// INSTA SHIT
				get_template_part('post','content'); 

				// get_template_part('author','intro');
				$band = get_the_title();

				$client_id = "2fc415e19e5a44df9ed2fdd2a534d40b"; //your client-id here
				 
				// $band = the_title(); //your tag here
				// $band = "August Burns Red";
				$tag = str_replace(" ", "", $band);
				// replace all character that are not numeric or alphabetic
				$tag = preg_replace("/[^A-Za-z0-9 ]/", '', $tag);
				$tag = strtolower($tag);

				// $cachefile = "instagram_cache/$tag.cache";

			    $contents = file_get_contents("https://api.instagram.com/v1/tags/$tag/media/recent?client_id=$client_id");

				 
				$json = json_decode($contents, true);
				echo "<h4>Instagram #".$tag."</h4>";
				echo "<br clear='all'/>";
				$i = 0;
				foreach ($json["data"] as $value) 
				{    	
				   	echo echoimage($value);
				   	// $instagram.echoimage($value);
				    
				    if (++$i == 8) break;
				}
				echo "<br clear='all'/>";
				

				 
				
				
				endwhile; 
				
				else : 
					get_template_part('nocontent');
				endif;


				
				
				comments_template( '', true ); 

								weblizar_navigation_posts();
			?>



		</div>

		<!-- sidebar -->
		<!--<?php get_sidebar(); ?>-->

		<br/>

		<div class="col-md-4 col-sm-12">
			
			<?php 


				$tweet = get_the_title();
				$tweet = str_replace(" ","",$tweet);
				// $tweet = strval($tweet);
				$tweet = strtolower($tweet);

				// ------------------------------------------------------------
			
				// [hashtag_tweets hashtag="face" number="25"]
				// [hashtag_tweets hashtag=$tweet number="25"]

				// ------------------------------------------------------------

			
			echo '<a class="twitter-timeline" href="https://twitter.com/'.$tweet.'" data-widget-id="535973247414571009">#'.$tweet.' Tweets</a>';
			?>
			
			<!-- dont use twitter widget -->
			<!-- <!--  -->
			<script>
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			</script>
			


			</div>
		
		<!--<?php get_sidebar(); ?>	-->
	</div> <!-- row div end here -->	
</div><!-- container div end here -->
<?php get_footer(); ?>

