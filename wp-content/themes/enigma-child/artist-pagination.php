<?php
/*
 * Template name: Artist Pagination

 http://www.deluxeblogtips.com/2010/05/pagination-within-page-in-wordpress.html
 */
?>
 
<?php 
    get_header(); 
    get_template_part('breadcrums'); 
?>

 
    <div id="container">
        <div id="content">
        <?php

        global $wp_query;
 
        $paged = (empty($wp_query->query_vars['paged'])) ? 1 : $wp_query->query_vars['paged'];
 
        query_posts(array(
            'post_type' => 'artist', // can be custom post type
            'paged' => $paged, // set the current page
            'order' => 'ASC'
        ));
 
        if (have_posts()):
        ?>

        <div class="container navbar-container">
            <div class="col-lg-12">
                <ul class="list-group" style="list-style-type:none;">
                <?php while (have_posts()): the_post(); ?>
                    <li class="list-group-item">
                        <?php $link = get_permalink(); ?>
                        <b><a style="font-size:large;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b>
                        <br/>

                        <?php 
                            if (catch_that_image() != "NO") 
                            {
                                // prep excerpt
                                $excerpt = get_the_excerpt();
                                $excerpt = str_replace ( '<p>', '', $excerpt);
                                $excerpt = str_replace ( '</p>', '', $excerpt);

                                // echo '<a href="'.$link.'"><img src="'.catch_that_image().'" class="listArtistsIMG" /></a>';
                                echo '<a href="'.$link.'"><span style="background-image: url('.catch_that_image().');" class="listArtistsIMG"></span></a>';
                                echo '<p>'.$excerpt.'...</p>';
                                echo '<div class="listArtistsSpacer"></div>';
                            }
                        ?>

                    </li>
                <?php endwhile; ?>
                </ul>

                    <div class="btn-group" role="group" aria-label="...">
                       
                            <?php 
                                if ($_GET['paged'] != 1 && $_GET['paged'] != 0) 
                                {
                                    echo '<button type="button" class="btn btn-default">';
                                        previous_posts_link('<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> <b>Prev.</b>');
                                    echo "</button>";
                                }                              
                            ?>
                        
                        
                        <button type="button" class="btn btn-default">  <?php next_posts_link('<b>Next</b> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>'); ?></button>
                    </div>

                    <!-- <div class="nav-previous">
                        <?php next_posts_link('← Prev.'); ?>
                    </div>
                    
                    <div class="nav-next">
                        <?php previous_posts_link('Next →'); ?>
                    </div>
     -->
                <?php endif; ?>
            </div>
        </div>
        <br clear="all">

        </div><!-- #content-->
    </div><!-- #container -->
 
<?php get_footer(); ?>