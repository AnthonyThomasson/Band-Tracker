<?php
	require_once("wp-config.php");

	// ini_set(E_ALL);
	//artist database connection
	$artistCon = mysqli_connect("localhost", "root", "", "artists") or die('Cannot connect');

	// may have to redefine DB_HOST for our server
	
    // check connection
    if (mysqli_connect_errno()) 
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }



	// $countSQL = "SELECT * FROM `artists`";
	// $countResult = mysqli_query($artistCon, $countSQL);
	// $countSize = mysqli_num_rows($countResult);
	// echo "COUNT SIZE:".$countSize;
	// for ($i=0 ; $i <= $countSize ; $i++ ) 
	// { 
	// }

	// count debris above---------------------------------------------------------
	    
	// add more stuff as table expands
	function constructGenrePageHTML($genreID, $name, $description)
	{

		$youtubeQuery = str_replace(" ","+", $name);

		// $trimmedBio = str_replace('"', '', $bio);
		$trimmedBio = preg_replace('/^"/', '', $bio);
		$trimmedBio = preg_replace('/\"$/', '', $trimmedBio);
		$trimmedBio = preg_replace('/\n$/', '', $trimmedBio);



		// database sql bullshit
		$con = mysqli_connect("localhost", "root", "", "artists") or die('Cannot connect');
		$sqlGenreArtists = "SELECT *
	                    		FROM `Artists`, `ArtistGenres`
	                     			WHERE `ArtistGenres`.GenreID = '$genreID'
	                     				AND `Artists`.ArtistID = `ArtistGenres`.ArtistID
	                    		ORDER BY `Artists`.Name ASC";




					$leftCol = '
					 <div>
					 	<p>'.$description.'</p>
					 <br/>
					 http://www.youtube.com/embed?listType=search&list='.$youtubeQuery.'&hd=1&hd720
					 </div>
					';



		// Print genre markup
		$leftCol .= '<h2>Artists</h2>';	
		$resultArtists = mysqli_query($con, $sqlGenreArtists);
		while ($row = mysqli_fetch_array($resultArtists)) 
			$leftCol .= '<a href="?artist='.$row["Name"].'"">'.$row["Name"].'</a><br />';

		mysqli_close($con);


		$rightCol = "";


		$page = $leftCol.$rightCol;

		return $page;
	}


	//select all artist info	
	$sqlStatement = "SELECT * 
                     FROM `Genres` ORDER BY Name ASC
                     ";

	$result = mysqli_query($artistCon, $sqlStatement);


	//reading through table rows to create opton values for the selector
	while ($row = mysqli_fetch_array($result)) 
	{
		echo constructGenrePageHTML($row["GenreID"], $row["Name"], $row["Description"]);

		$html = constructGenrePageHTML($row["GenreID"], $row["Name"], $row["Description"]);

		$genreName = $row["Name"];
		$genreName = str_replace(" ","-",$genreName);

		echo $genreName;

	  	// Create post object
		$my_post = array(
		  'post_content'   => $html,
		  'post_name'      => $genreName,
		  'post_title'     => $row["Name"],
		  'post_status'    => 'publish',
		  'post_type'      => 'genre',
		  'post_author'    => 1,
		  'ping_status'    => 'open',
		  'post_parent'    => 0,
		  'menu_order'     => 0,
		  'comment_status' => 'open',
		);

		echo "WP INSERT";
		// Insert the post into the wp database
		wp_insert_post( $my_post );

	}
	mysqli_close($artistCon);



?>