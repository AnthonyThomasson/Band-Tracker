<?php
/**
 * Single Genre Page
 *
 * Brings up info related to a particular genre of music.
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


				function sortVertically( $data = array() )
				{
				    /* PREPARE data for printing */
				    ksort( $data );     // Sort array by key.
				    $numCols    = 3;    // Desired number of columns
				    $numCells   = is_array($data) ? count($data) : 1 ;
				    $numRows    = ceil($numCells / $numCols);
				    $extraCells = $numCells % $numCols;  // Store num of tbody's with extra cell
				    $i          = 0;    // iterator
				    $cCell      = 0;    // num of Cells printed
				    $output     = NULL; // initialize 


				    /* START table printing */
				    $output     .= '<div>';
				    $output     .= '<table>';

				    foreach( $data as $key => $value )
				    {
				        if( $i % $numRows === 0 )   // Start a new tbody
				        {
				            if( $i !== 0 )          // Close prev tbody
				            {
				                $extraCells--;
				                if ($extraCells === 0 )
				                {
				                    $numRows--;     // No more tbody's with an extra cell
				                    $extraCells--;  // Avoid re-reducing numRows
				                }
				                $output .= '</tbody>';
				            }

				            $output .= '<tbody style="float: left;">';
				            $i = 0;                 // Reset iterator to 0
				        }
				        $output .= '<tr>';
				            $output .= '<th>'.$key.'</th>';
				            $output .= '<td>'.$value.'</td>';
				        $output .= '</tr>';

				        $cCell++;                   // increase cells printed count
				        if($cCell == $numCells){    // last cell, close tbody
				            $output .= '</tbody>';
				        }

				        $i++;
				    }

				    $output .= '</table>';
				    $output .= '</div>';
				    return $output;
				}

			?>

			<!-- <table border="1"> -->
			<?php
				$con = mysqli_connect("localhost", "root", "", "artists") or die('Cannot connect');
				$sqlGenreArtists = "SELECT *
	                    		FROM `Artists`, `ArtistGenres`
	                     			WHERE `ArtistGenres`.GenreID = 4--'$genreID'
	                     				AND `Artists`.ArtistID = `ArtistGenres`.ArtistID
	                    		ORDER BY `Artists`.Name ASC";

	            $resultArtists = mysqli_query($con, $sqlGenreArtists);
					


					
				
					// foreach(range('A','Z') as $letter) 
					// {	
					// 	echo "<b>".$letter."</b><br/>";

					// 	while ($row = mysqli_fetch_array($resultArtists)) 
					// 	{
					// 		$name = $row["Name"];
					// 		$name = $name.strtoupper($name);
					// 		// echo "Name: ".$name."<br/>";
					// 		// see if the first letter matches the range interation we are on
					// 		// echo "Name 0: ".$name[0];
					// 		// echo "Letter:".$letter;
					// 		if ($name[0] == $letter) 
					// 		{
					// 			echo '<a href="?artist='.$row["Name"].'"">'.$row["Name"].'</a><br />';
					// 		}

					// 	}
					// }

	            	$A = array();
	            	$B = array();
	            	$C = array();
	            	$D = array();
	            	$E = array();
	            	$F = array();
	            	$G = array();
	            	$H = array();
	            	$I = array();
	            	$J = array();
	            	$K = array();
	            	$L = array();
	            	$M = array();
	            	$N = array();
	            	$O = array();
	            	$P = array();
	            	$Q = array();
	            	$R = array();
	            	$S = array();
	            	$T = array();
	            	$U = array();
	            	$V = array();
	            	$W = array();
	            	$X = array();
	            	$Y = array();
	            	$Z = array();
	            	$num = array();

	            	function artistLink($name)
	            	{
	            		$link = '<a href="?artist='.$name.'" class="list-group-item">'.$name.'</a>';
	            		return $link;
	            	}

					while ($row = mysqli_fetch_array($resultArtists)) 
						{
							$name = $row["Name"];
							$firstLetter = $name.strtoupper($name);
							$firstLetter = $name[0];
							
							switch ($firstLetter) 
							{
							    case "A":
							        array_push( $A, artistLink($name) );
							        break;

							    case "B":
							        array_push( $B, artistLink($name) );
							        break;

							    case "C":
							        array_push( $C, artistLink($name) );
							        break;

							    case "D":
							        array_push( $D, artistLink($name) );
							        break;

							    case "E":
							        array_push( $E, artistLink($name) );
							        break;

							    case "F":
							        array_push( $F, artistLink($name) );
							        break;

							    case "G":
							        array_push( $G, artistLink($name) );
							        break;

							    case "H":
							        array_push( $H, artistLink($name) );
							        break;

							    case "I":
							        array_push( $I, artistLink($name) );
							        break;

							    case "J":
							        array_push( $J, artistLink($name) );
							        break;

							    case "K":
							        array_push( $K, artistLink($name) );
							        break;

							    case "L":
							        array_push( $L, artistLink($name) );
							        break;

							    case "M":
							        array_push( $M, artistLink($name) );
							        break;

							    case "N":
							        array_push( $N, artistLink($name) );
							        break;

							    case "O":
							        array_push( $O, artistLink($name) );
							        break;

							    case "P":
							        array_push( $P, artistLink($name) );
							        break;

							    case "Q":
							        array_push( $Q, artistLink($name) );
							        break;

							    case "R":
							        array_push( $R, artistLink($name) );
							        break;

							    case "S":
							        array_push( $S, artistLink($name) );
							        break;

							    case "T":
							        array_push( $T, artistLink($name) );
							        break;

							    case "U":
							        array_push( $U, artistLink($name) );
							        break;

							    case "V":
							        array_push( $V, artistLink($name) );
							        break;

							    case "W":
							        array_push( $W, artistLink($name) );
							        break;

							    case "X":
							        array_push( $X, artistLink($name) );
							        break;

							    case "Y":
							        array_push( $Y, artistLink($name) );
							        break;

							    case "Z":
							        array_push( $Z, artistLink($name) );
							        break;

							    default:
							        array_push( $num, artistLink($name) );
							        break;


							}
						}

						// foreach (range('A', 'Z') as $i) 
						// {
						// 	print_r()
						// }

						echo '<div class="list-group col-lg-4">
  							  	<span class="list-group-item active listInfoHeader" style="background-color: #31708f;">
  							  		<strong>A</strong> 
  							  	</span>';

							for ($i = 0; $i < sizeof($A); $i++)
							{
								echo $A[$i];
							}
							echo '</div>';

							echo "<br/>";

						// echo "<br/><b>B</b><br/>";
						// print_r($B);

						// echo "<br/><b>C</b><br/>";
						// print_r($C);

						// echo "<br/><b>D</b><br/>";
						// print_r($D);

						// echo '<div class="list-group col-lg-3 ">
						// 		<span class="list-group-item active listInfoHeader" style="background-color: #31708f;">
						// 		<strong>When: </strong>2014-11-28</span>
						// 	 </div>';

echo "<br/>";

				mysqli_close($con);

	

				// $con = mysqli_connect("localhost", "root", "", "artists") or die('Cannot connect');
				//  // check connection
			 //    if (mysqli_connect_errno()) 
			 //    {
			 //        printf("Connect failed: %s\n", mysqli_connect_error());
			 //        exit();
			 //    }

			 //   $sqlGenreArtists = "SELECT *
	   //                  		FROM `Artists`, `ArtistGenres`
	   //                   			WHERE `ArtistGenres`.GenreID = '$genreID'
	   //                   				AND `Artists`.ArtistID = `ArtistGenres`.ArtistID
	   //                  		ORDER BY `Artists`.Name ASC";

    //        		$leftCol .= '<h2>Artists</h2>';	
				// $resultArtists = mysqli_query($con, $sqlGenreArtists);
				// // while ($row = mysqli_fetch_array($resultArtists)) 
				// // $leftCol .= '<a href="?artist='.$row["Name"].'"">'.$row["Name"].'</a><br />';
				// echo sortVertically(mysqli_fetch_array($resultArtists));
				// mysqli_close($con);



				// sortVertically();


				// INSTAGRAM OUTPUT BELOW

				get_template_part('post','content'); 

				// get_template_part('author','intro');
				$genre = get_the_title();

				$client_id = "2fc415e19e5a44df9ed2fdd2a534d40b"; //your client-id here
				 
				// $band = the_title(); //your tag here
				// $band = "August Burns Red";
				$tag = str_replace(" ", "", $genre);
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

