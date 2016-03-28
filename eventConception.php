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



	// $countSQL = "SELECT * FROM `artists`";
	// $countResult = mysqli_query($artistCon, $countSQL);
	// $countSize = mysqli_num_rows($countResult);
	// echo "COUNT SIZE:".$countSize;
	// for ($i=0 ; $i <= $countSize ; $i++ ) 
	// { 
	// }

	// count debris above---------------------------------------------------------
	
     // Random string generator to pass to the Google Map generator to give each map a unique ID
    function generateRandomString($length = 15) 
    {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
	    
	    for ($i = 0; $i < $length; $i++) 
	    {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}

	function markEventAsAdded($id)
	{
		$con = mysqli_connect("localhost", "root", "toor", "artists");

		$sql = "UPDATE Events
		SET Added = 1
		WHERE EventID = $id";
		mysqli_query($con, $sql);
	}
	
	// add more stuff as table expands
	function constructEventPageHTML($eventID, $venue, $location, $date)
	{

		$youtubeQuery = str_replace(" ","+", $name);

		// $trimmedBio = str_replace('"', '', $bio);
		$trimmedBio = preg_replace('/^"/', '', $bio);
		$trimmedBio = preg_replace('/\"$/', '', $trimmedBio);
		$trimmedBio = preg_replace('/\n$/', '', $trimmedBio);



		// database sql bullshit
		$con = mysqli_connect("localhost", "root", "toor", "artists") or die('Cannot connect');
		$sqlEventArtists = "SELECT *
	                    		FROM `Artists`, `ArtistEvents`
	                     			WHERE `ArtistEvents`.EventID = '$eventID'
	                     				AND `Artists`.ArtistID = `ArtistEvents`.ArtistID
	                    		ORDER BY `Artists`.Name ASC";


		$leftCol = '<div class="list-group">
						<span class="list-group-item active listInfoHeader" style="background-color: #31708f;"><strong>Where: </strong>'.$location.'</span>
						<span class="list-group-item">[google-map-v3 shortcodeid="'.generateRandomString().'" width="100%" height="300"	animation="DROP" addresscontent="'.$location.'" zoom="16" maptype="roadmap" mapalign="center" directionhint="false" language="default" poweredby="false" maptypecontrol="true" pancontrol="true" zoomcontrol="true" scalecontrol="true" streetviewcontrol="true" scrollwheelcontrol="true" draggable="true" tiltfourtyfive="false" enablegeolocationmarker="false" enablemarkerclustering="false" addmarkermashup="false" addmarkermashupbubble="false" bubbleautopan="true" distanceunits="km"	showbike="false" showtraffic="false" showpanoramio="false"]</span>
					</div>

					<div class="list-group">
						<span class="list-group-item active listInfoHeader" style="background-color: #31708f;"><strong>When: </strong>'.$date.'</span>
					</div>

					<div class="list-group">
						<span class="list-group-item active listInfoHeader" style="background-color: #31708f;"><strong>Artists </strong></span>';

						$resultArtists = mysqli_query($con, $sqlEventArtists);

						while ($row = mysqli_fetch_array($resultArtists)) 
							$leftCol .= '<a href="?artist='.$row["Name"].'" class="list-group-item link">'.$row["Name"].'</a>';

						mysqli_close($con);
					
					$leftCol .='</div>';


		// Print genre markup
		// $leftCol .= '<h2>Artists</h2>';	
		// $resultArtists = mysqli_query($con, $sqlEventArtists);
		// while ($row = mysqli_fetch_array($resultArtists)) 
		// 	$leftCol .= '<a href="?artist='.$row["Name"].'">'.$row["Name"].'</a><br />';

		// mysqli_close($con);


		$rightCol = "";


		$page = $leftCol.$rightCol;

		return $page;
	}


	//select all artist info	
	$sqlStatement = "SELECT * 
                     FROM `Events` WHERE Added = 0 ORDER BY Date ASC
                     ";

	$result = mysqli_query($artistCon, $sqlStatement);


	//reading through table rows to create opton values for the selector
	while ($row = mysqli_fetch_array($result)) 
	{
		// echo constructEventPageHTML($row["EventID"], $row["Venue"], $row["Location"], $row["Date"]);
		// newly added address update
		$locationAddress = $row["Venue"].", ".$row["VenueLocation"].", ".$row["Location"];

		$html = constructEventPageHTML($row["EventID"], $row["Venue"], $locationAddress, $row["Date"]);

		$eventName = $row["EventID"];
		$eventTitle = $row["Venue"].", ".$row["Date"];

		echo $eventName;

	  	// Create post object
		$my_post = array(
		  'post_content'   => $html,
		  'post_name'      => $eventName,
		  'post_title'     => $eventTitle,
		  'post_status'    => 'publish',
		  'post_type'      => 'event',
		  'post_author'    => 1,
		  'ping_status'    => 'open',
		  'post_parent'    => 0,
		  'menu_order'     => 0,
		  'comment_status' => 'open',
		);

		echo "WP INSERT";
		// Insert the post into the wp database
		wp_insert_post( $my_post );
		
		markEventAsAdded($row["EventID"]);

	}
	mysqli_close($artistCon);

	

?>