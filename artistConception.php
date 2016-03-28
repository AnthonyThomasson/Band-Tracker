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
	    
	// add more stuff as table expands

	function getLatLongFromAddress($addr)
	{
		$Address = urlencode($addr);
		$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
		$xml = simplexml_load_file($request_url) or die("url not loading");
		$status = $xml->status;
		if ($status=="OK") 
		{
			$Lat = $xml->result->geometry->location->lat;
			$Lon = $xml->result->geometry->location->lng;
			$LatLng = "$Lat,$Lon";
		}

		return $LatLng;
	}

	 // Random string generator to pass to the Google Map generator to give each map a unique ID
    function generateRandomString($length = 12) 
    {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
	    
	    for ($i = 0; $i < $length; $i++) 
	    {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}


	function markArtistAsAdded($id)
	{
	 $con = mysqli_connect("localhost", "root", "toor", "artists");

	 $sql = "UPDATE Artists
	   SET Added = 1
	   WHERE ArtistID = $id";
		mysqli_query($con, $sql);
	}


	function constructArtistPageHTML($artistID, $name, $bio, $startYear, $endYear, $imageURL)
	{

		$youtubeQuery = str_replace(" ","+", $name);

		// $trimmedBio = str_replace('"', '', $bio);
		$trimmedBio = preg_replace('/^"/', '', $bio);
		$trimmedBio = preg_replace('/\"$/', '', $trimmedBio);
		$trimmedBio = preg_replace('/\n$/', '', $trimmedBio);



		// database sql bullshit
		$con = mysqli_connect("localhost", "root", "toor", "artists") or die('Cannot connect');

		$sqlArtistGenres = "SELECT `Genres`.GenreID, `Genres`.Name, `Genres`.Description
	                    		FROM `Genres`, `ArtistGenres`
	                     			WHERE `ArtistGenres`.ArtistID = '$artistID'
	                     				AND `Genres`.GenreID = `ArtistGenres`.GenreID
	                    		ORDER BY `Genres`.Name ASC";

		$sqlArtistEvents = "SELECT `Events`.EventID, `Events`.Venue, `Events`.Location, `Events`.Date
								FROM `Artists`,`Events`, `ArtistEvents`
						         	WHERE `ArtistEvents`.ArtistID = '$artistID'
						         		AND `Artists`.ArtistId = '$artistID'
						         		AND `Events`.EventID = `ArtistEvents`.EventID
					        	ORDER BY `Events`.Date ASC";





		$leftCol =  '<img src="'.$imageURL.'" class="alignnone size-large wp-image-27" alt="'.$name.'" width="auto" max-height="270px" height="auto" />

					';
					if($startYear != 0000)
					{
						$leftCol .= '<h3>Formed: '. $startYear.'</h3>';
					}
        			 
					$leftCol .= '
					 <div>
					 	<p>'.$trimmedBio.'</p>
					 <br/>
					 http://www.youtube.com/embed?listType=search&list='.$youtubeQuery.'&hd=1&hd720
					 </div>
					 <br>
					';


		
		// Print genre markup
		$leftCol .= '<h3>Genres</h3>';	
		$resultGenres = mysqli_query($con, $sqlArtistGenres);
		while ($row = mysqli_fetch_array($resultGenres)) 
			$leftCol .= '<div class="alert alert-info col-lg-3 genreMargins" role="alert">
      						<strong><a class="genreListText link" href="?genre='.$row["Name"].'">'.$row["Name"].'</a></strong>
    					</div>';
			
			$leftCol .='<br clear="all"/>';


		// Print event markup
		$resultEvents = mysqli_query($con, $sqlArtistEvents);
		if($resultEvents->num_rows > 0)
		{
			$leftCol .= '<h3>Events</h3>';

			$markertList = "";

			

			while ($row = mysqli_fetch_array($resultEvents)) 
			{	
				$addToMarkerList= $row["Venue"].', '.$row["VenueLocation"].', '.$row["Location"].' | ';	
				$markerList .= $addToMarkerList;
			}

			

			$leftCol .= '
						<div class="list-group">
							<span class="list-group-item active listInfoHeader" style="background-color: #31708f;"><strong>Tour Tracking</strong></span><span class="list-group-item">[google-map-v3 shortcodeid="'.generateRandomString().'" width="100%" height="300"animation="DROP" addmarkerlist="'.$markerList.'" zoom="16" maptype="roadmap" mapalign="center" directionhint="false" language="default" poweredby="false" maptypecontrol="true" pancontrol="true" zoomcontrol="true" scalecontrol="true" streetviewcontrol="true" scrollwheelcontrol="true" draggable="true" tiltfourtyfive="false" enablegeolocationmarker="false" enablemarkerclustering="false" addmarkermashup="false" addmarkermashupbubble="false" bubbleautopan="true" distanceunits="miles" showbike="false" showtraffic="false" showpanoramio="false"]</span>
						</div>';
						
			$leftCol .='<br clear="all"/>';

			$resultEvents2 = mysqli_query($con, $sqlArtistEvents);

			while ($row = mysqli_fetch_array($resultEvents2)) 
			{
				$leftCol .= '<div class="alert alert-success col-lg-3 eventMargins" role="alert">
      						<strong><a class="eventListText link" href="?event='.$row["EventID"].'">'.$row["Venue"].", on ".$row["Date"].'</a></strong>
    					</div>';
    		}
    		$leftCol .='<br clear="all"/>';
    	}

    	// DISPLAY EVENT MAP HERE?

		mysqli_close($con);


		$rightCol = "";


		$page = $leftCol.$rightCol;

		return $page;
	}


	//select all artist info	
	$sqlStatement = "SELECT * 
                     FROM `Artists` WHERE Added = 0 ORDER BY Name ASC
                     ";

	$result = mysqli_query($artistCon, $sqlStatement);
	// echo "<br />Is false? " . (($result === false) ? "true" : "false");
	// echo "<br />" . mysql_error($artistCon);
	mysqli_close($artistCon);


	$counter = 1;
	//reading through table rows to create opton values for the selector
	while ($row = mysqli_fetch_array($result)) 
	{
		// echo constructArtistPageHTML($row["ArtistID"], $row["Name"], $row["Bio"], $row["StartYear"], $row["EndYear"], $row["ImageURL"]);

		$html = constructArtistPageHTML($row["ArtistID"], $row["Name"], $row["Bio"], $row["StartYear"], $row["EndYear"], $row["ImageURL"]);

		$bandName = $row["Name"];
		$bandName = str_replace(" ","-",$bandName);

		echo $bandName;

	  	// Create post object
		$my_post = array(
		  'post_content'   => $html,
		  'post_name'      => $bandName,
		  'post_title'     => $row["Name"],
		  'post_status'    => 'publish',
		  'post_type'      => 'artist',
		  'post_author'    => 1,
		  'ping_status'    => 'open',
		  'post_parent'    => 0,
		  'menu_order'     => 0,
		  'comment_status' => 'open',
		);

		echo "WP INSERT";
		// Insert the post into the wp database
		wp_insert_post( $my_post );

		markArtistAsAdded($row["ArtistID"]);

	}



?>