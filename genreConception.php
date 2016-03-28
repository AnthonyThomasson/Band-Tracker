<?php
	require_once("wp-config.php");

	// ini_set(E_ALL);
	//artist database connection
	$artistCon = mysqli_connect("localhost", "root", "toor", "artists") or die('Cannot connect');

	// may have to redefine DB_HOST for our server
	
    // check connection
    if (mysqli_connect_errno()) 
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }


   	function markGenreAsAdded($id)
	{
		$con = mysqli_connect("localhost", "root", "toor", "artists");

		$sql = "UPDATE Genres
		SET Added = 1
		WHERE GenreID = $id";
		mysqli_query($con, $sql);
	}

	function artistLink($name)
	{
		$link = '<a href="?artist='.$name.'" class="list-group-item link">'.$name.'</a>';
		return $link;
	}

	// returns the top part of the alphebetical output div area
	function artistLetterHead($letter)
	{
		$html = '<div class="list-group col-lg-4"><span class="list-group-item active listInfoHeader" style="background-color: #31708f;"><strong>'.$letter.'</strong></span>';
		return $html;
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
		$con = mysqli_connect("localhost", "root", "toor", "artists") or die('Cannot connect');
		$sqlGenreArtists = "SELECT *
	                    		FROM `Artists`, `ArtistGenres`
	                     			WHERE `ArtistGenres`.GenreID = '$genreID'
	                     				AND `Artists`.ArtistID = `ArtistGenres`.ArtistID
	                    		ORDER BY `Artists`.Name DESC"; 
	                    		// I CHANGED THIS TO DESC FROM ASC



					$leftCol = '
					 <div>
					 	<p>'.$description.'</p>
					 <br/>
					 http://www.youtube.com/embed?listType=search&list='.$youtubeQuery.'&hd=1&hd720
					 </div>
					';



		// Print genre markup EDIT GENRE OUTPUT
		$leftCol .= '<h3>Artists</h3>';	
		$resultArtists = mysqli_query($con, $sqlGenreArtists);
		// while ($row = mysqli_fetch_array($resultArtists)) 
		// 	$leftCol .= '<a href="?artist='.$row["Name"].'"">'.$row["Name"].'</a><br />';

			// arrrays for storing all artists in the genre based on the first letter of the artist name
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

        

        	// read through all of the returned artists
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

			
			// A array
			$leftCol .= artistLetterHead("A");
			$count = 0;
			while ($count < sizeof($A)) 
			{
				$leftCol .= $A[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// B array
			$leftCol .= artistLetterHead("B");
			$count = 0;
			while ($count < sizeof($B)) 
			{
				$leftCol .= $B[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// C array
			$leftCol .= artistLetterHead("C");
			$count = 0;
			while ($count < sizeof($C)) 
			{
				$leftCol .= $C[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// D array
			$leftCol .= artistLetterHead("D");
			$count = 0;
			while ($count < sizeof($D)) 
			{
				$leftCol .= $D[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// E array
			$leftCol .= artistLetterHead("E");
			$count = 0;
			while ($count < sizeof($E)) 
			{
				$leftCol .= $E[$count];

				$count++;
			}
			$leftCol .= '</div>';

			// F array
			$leftCol .= artistLetterHead("F");
			$count = 0;
			while ($count < sizeof($F)) 
			{
				$leftCol .= $F[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// G array
			$leftCol .= artistLetterHead("G");
			$count = 0;
			while ($count < sizeof($G)) 
			{
				$leftCol .= $G[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// H array
			$leftCol .= artistLetterHead("H");
			$count = 0;
			while ($count < sizeof($H)) 
			{
				$leftCol .= $H[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// I array
			$leftCol .= artistLetterHead("I");
			$count = 0;
			while ($count < sizeof($I)) 
			{
				$leftCol .= $I[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// J array
			$leftCol .= artistLetterHead("J");
			$count = 0;
			while ($count < sizeof($J)) 
			{
				$leftCol .= $J[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// K array
			$leftCol .= artistLetterHead("K");
			$count = 0;
			while ($count < sizeof($K)) 
			{
				$leftCol .= $K[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// L array
			$leftCol .= artistLetterHead("L");
			$count = 0;
			while ($count < sizeof($L)) 
			{
				$leftCol .= $L[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';

			// M array
			$leftCol .= artistLetterHead("M");
			$count = 0;
			while ($count < sizeof($M)) 
			{
				$leftCol .= $M[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// N array
			$leftCol .= artistLetterHead("N");
			$count = 0;
			while ($count < sizeof($N)) 
			{
				$leftCol .= $N[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// O array
			$leftCol .= artistLetterHead("O");
			$count = 0;
			while ($count < sizeof($O)) 
			{
				$leftCol .= $O[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all">';


			// P array
			$leftCol .= artistLetterHead("P");
			$count = 0;
			while ($count < sizeof($P)) 
			{
				$leftCol .= $P[$count];

				$count++;
			}
			$leftCol .= '</div>';

			// Q array
			$leftCol .= artistLetterHead("Q");
			$count = 0;
			while ($count < sizeof($Q)) 
			{
				$leftCol .= $Q[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// R array
			$leftCol .= artistLetterHead("R");
			$count = 0;
			while ($count < sizeof($R)) 
			{
				$leftCol .= $R[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// S array
			$leftCol .= artistLetterHead("S");
			$count = 0;
			while ($count < sizeof($S)) 
			{
				$leftCol .= $S[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// T array
			$leftCol .= artistLetterHead("T");
			$count = 0;
			while ($count < sizeof($T)) 
			{
				$leftCol .= $T[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// U array
			$leftCol .= artistLetterHead("U");
			$count = 0;
			while ($count < sizeof($U)) 
			{
				$leftCol .= $U[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// V array
			$leftCol .= artistLetterHead("V");
			$count = 0;
			while ($count < sizeof($P)) 
			{
				$leftCol .= $P[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// W array
			$leftCol .= artistLetterHead("W");
			$count = 0;
			while ($count < sizeof($W)) 
			{
				$leftCol .= $W[$count];

				$count++;
			}
			$leftCol .= '</div>';

			// X array
			$leftCol .= artistLetterHead("X");
			$count = 0;
			while ($count < sizeof($X)) 
			{
				$leftCol .= $X[$count];

				$count++;
			}
			$leftCol .= '</div>';


			$leftCol .= '<br clear="all"/>';


			// Y array
			$leftCol .= artistLetterHead("Y");
			$count = 0;
			while ($count < sizeof($Y)) 
			{
				$leftCol .= $Y[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// Z array
			$leftCol .= artistLetterHead("Z");
			$count = 0;
			while ($count < sizeof($Z)) 
			{
				$leftCol .= $Z[$count];

				$count++;
			}
			$leftCol .= '</div>';


			// Other array
			$leftCol .= artistLetterHead("Other");
			$count = 0;
			while ($count < sizeof($num)) 
			{
				$leftCol .= $num[$count];

				$count++;
			}
			$leftCol .= '</div>';

			$leftCol .= '<br clear="all"/>';		

		mysqli_close($con);


		$rightCol = "";


		$page = $leftCol.$rightCol;

		return $page;
	}


	//select all genre info	
	$sqlStatement = "SELECT * 
                     FROM `Genres` WHERE Added = 0  ORDER BY Name ASC
                     ";

	$result = mysqli_query($artistCon, $sqlStatement);


	//reading through table rows to create opton values for the selector
	while ($row = mysqli_fetch_array($result)) 
	{
		// echo constructGenrePageHTML($row["GenreID"], $row["Name"], $row["Description"]);

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

		markGenreAsAdded($row["GenreID"]);

	}
	mysqli_close($artistCon);



?>