<?php get_header(); ?>
<div class="enigma_header_breadcrum_title">	
	<div class="container">
		<div class="row">
		<?php if(have_posts()) :?>
			<div class="col-md-12">
			<h1><?php printf( __( 'Search Results for: %s', 'weblizar' ), '<span>' . get_search_query() . '</span>'  ); ?>
			</h1>
			</div>
		<?php endif; ?>
		<?php rewind_posts(); ?>
		</div>
	</div>	
</div>
<div class="container">	
	<div class="row enigma_blog_wrapper">
	<div class="col-md-8">
	<?php 
	if ( have_posts()): 
	while ( have_posts() ): the_post();
	get_template_part('post','content'); ?>	
	<?php endwhile;
	weblizar_navigation();
	else :
	get_template_part('nocontent');
	endif; ?>	 
	</div>
		
	<?php //get_sidebar(); ?>
	<div class="col-md-4 col-sm-12">
		<!-- twitter widget -->

		<a class="twitter-timeline" href="https://twitter.com/Band_Tracker" data-widget-id="535973247414571009">#twitter Tweets</a>	
			<script>
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			</script>
	</div>
	</div>


</div>

<?php get_footer(); ?>