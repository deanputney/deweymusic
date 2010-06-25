<?php include('includes/header.php');
	include_once('dbconnect.php');
	include_once('functions/Songs.php');
	include_once('functions/Albums.php');
	include_once('functions/Artists.php');
	include_once('functions/Venue.php');
  include_once('functions/Files.php');
	$id=$_GET["album"];
  $artistId = 1;
  $user_id = $_SESSION['userid'];?>
  <div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
		  <div class="featured">
        <div class="download_types hidden" id="dl_songid">
         <?php
        $fileQuery = getFilesFromAlbumWithoutSongs($id);
        
        if($fileQuery && mysql_num_rows($fileQuery) > 0){
          while($file = mysql_fetch_array($fileQuery)){
           echo '<a href="';
           echo $file[1];
           echo '">';
           echo $file[2];
           echo "</a>";
           echo "<br/>";
          }
       }
        
        ?>
        </div>		  
        <?php
		  	$album = getAlbum($id);
		  	while($albumrow = mysql_fetch_array($album)){
		  		echo '<h1>';
		  		echo $albumrow[0];
		  		echo '</h1>';
		  		echo '<h1><a href="javascript:loadContent(\'results.php?artist=';
		  		echo $albumrow[3];
		  		echo '\')">';
		  		$artist = getArtist($albumrow[3]);
          $artistId = $albumrow[3];
		  		while($artistrow = mysql_fetch_array($artist)){
		  			echo $artistrow[0];
		  		}
		  		echo '</a></h1>';
		  		echo '<h3>';
		  		echo substr($albumrow[2], 0, 10);
		  		echo ' at <a href="javascript:loadContent(\'resultsVenue.php?venue=';
		  		$result = getVenueByName($albumrow[10]);
				$venuerow = mysql_fetch_array($result);
		  		echo $venuerow[0];
		  		echo '\')">';
		  		echo $albumrow[10];
		  		echo '</a>';
		  		echo '</h3> <img class="star" src="images/star.gif" /><p class="rating">';
		  		$rating = getRatingsForAlbum($id);
		  		while($ratingrow = mysql_fetch_array($rating)){
		  			echo $ratingrow[0];
		  		}
		  		echo '</p>';
		  		echo '<a href="javascript:playAlbum(\'';
		  		echo($id);
		  		echo '\')"><img class="ftitle" src="images/play.gif" /></a><a href="javascript:appendAlbum(\'';
		  		echo($id);
		  		echo '\')"><img class="ftitle" src="images/add.gif" /></a><img class="ftitle download" src="images/download.gif" rel="dl_songid" />';
		  		echo '<div class="clear"></div>';
		  		
            //$userRating = getUserRating($user_id, $id);
            
            //if(mysql_num_rows($userRating) == 0){
              echo '<a class="rate_it" href="javascript:rateUpAlbum(';
              echo $id;
              echo ');">I Like It!</a>';
	
            //}
            }
		  	
		  	
					$tracks = getSongsForAlbum($id);
					$count = 1;
					if(mysql_num_rows($tracks) <= 0)
					{
           				 echo '';
       				}
       				else
       				{
       					echo '<table id="tracklist">
								<tr class="headings">
									<td></td>
									<td></td>
									<td class="title">Track</td>
									<td></td>
									<td>Plays</td>
								</tr>';
							
						while($trackrow = mysql_fetch_assoc($tracks)){
							if($count%2==0){
								echo '<tr>';
							}
							else{
								echo '<tr class="odd">';
							}
							echo '<td class="position">';
							echo($count);
							echo '</td><td class="play_add"><a href="javascript:playSong(\'';
							echo $trackrow["id"];
							echo '\')"><img class="small" src="images/play.gif" /></a><a href="javascript:appendSong(\'';
							echo $trackrow["id"];
							echo '\')"><img class="small" src="images/add.gif" /></a><img class="small download" src="images/download.gif" rel="dl_'.$count.'" /></td>';
							echo '<td class="title">';
							echo $trackrow["title"];
							echo '</td><td class="duration">';
							echo '</td><td class="plays">';
							$plays=getPlaysForSong($trackrow["id"]);
							while($playsrow = mysql_fetch_array($plays)){
								echo $playsrow[0];
							}
							echo '</td></tr>';
							
							$fileQuery = getFilesForSong($trackrow["id"]);
        					
        					echo "<div class=\"download_types hidden\" id=\"dl_$count\">";
							if($fileQuery && mysql_num_rows($fileQuery) > 0){
							  while($file = mysql_fetch_array($fileQuery)){
								echo '<a href="';
								echo $file[1];
								echo '">';
								echo $file[2];
								echo "</a>";
								echo "<br/>";
							  }
							}
							echo "</div>";
							
							$count++;
						}
						echo '</table>';
					}
       				
				?>
		   </div>
		</div>
		<div class="module recommends">
		<div class="yui-g">
			<h4>Dewey Recommends</h4>
		</div>
      <div class="yui-gb">
        <?php
      $relatedArtists = getRelatedArtists($artistId, 9);
      if($relatedArtists && $relatedArtists!=null){
        while($relArtistRow = mysql_fetch_array($relatedArtists)){
          echo '<div class="yui-u entry">';
          $relId = $relArtistRow[0];

          $relArtist = getArtist($relId);
          $relName = "";
          if($relArtist && $relArtist!=null){
            $relNameRow = mysql_fetch_array($relArtist);
            $relName = $relNameRow[0];}
          echo '<a href="javascript:loadContent(\'results.php?artist=';
            echo $relId;
            echo '\')">';
            echo $relName;
            echo '</a>';
          echo '</div>';
        }
      }
    ?>
    
      </div>
		<!--<div class="yui-gb">
			<div class="yui-u first entry">
				<div class="add_play">
					<a href="#"><img class="small" src="images/play.gif" /></a>
					<a href="#"><img class="small" src="images/add.gif" /></a>
				</div>
				<h5><a href="#">Bearhug</a></h5>
				<h5><a href="#">Animal Collective</a></h5>
				<p><a href="#">Live at Grrrnd Zero</a></p>
				<img class="star small" src="images/star.gif" /><p class="rating">76</p>
			</div>
			<div class="yui-u entry">
				<div class="add_play">
					<a href="#"><img class="small" src="images/play.gif" /></a>
					<a href="#"><img class="small" src="images/add.gif" /></a>
				</div>
				<h5><a href="#">Bearhug</a></h5>
				<h5><a href="#">Animal Collective</a></h5>
				<p><a href="#">Live at Grrrnd Zero</a></p>
				<img class="star small" src="images/star.gif" /><p class="rating">76</p>
			</div>
			<div class="yui-u entry">
				<div class="add_play">
					<a href="#"><img class="small" src="images/play.gif" /></a>
					<a href="#"><img class="small" src="images/add.gif" /></a>
				</div>
				<h5><a href="#">Bearhug</a></h5>
				<h5><a href="#">Animal Collective</a></h5>
				<p><a href="#">Live at Grrrnd Zero</a></p>
				<img class="star small" src="images/star.gif" /><p class="rating">76</p>
			</div>
		</div>!-->
		</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>

