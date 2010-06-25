<?php include('includes/header.php'); ?>
<?php include_once('functions/Artists.php');?>
<?php include_once('functions/Albums.php');?>
<?php include_once('functions/Songs.php');?>
<?php

$terms = $_GET["terms"];

$artistQuery = " 
        SELECT id, 
			MATCH(name) AGAINST('$terms') AS score 
			FROM $db.artists 
		WHERE MATCH(name) AGAINST('$terms') 
		GROUP BY name
		ORDER BY score DESC 
		LIMIT 25
    	";
      
$artistResult = mysql_query($artistQuery);



    
$albumQuery = " 
        SELECT id, 
			MATCH(title) AGAINST('$terms') AS score 
			FROM $db.albums 
		WHERE MATCH(title) AGAINST('$terms') 
		GROUP BY title
		ORDER BY score DESC 
		LIMIT 25
    	"; 

$albumResult = mysql_query($albumQuery);

$songQuery = " 
        SELECT id, 
			MATCH(title) AGAINST('$terms') AS score 
			FROM $db.songs 
		WHERE MATCH(title) AGAINST('$terms') 
		GROUP BY title
		ORDER BY score DESC 
		LIMIT 25";
    
$songResult = mysql_query($songQuery);

$venueQuery = " 
        SELECT name, location, id,
			MATCH(name) AGAINST('$terms') AS score 
			FROM $db.venues 
		WHERE MATCH(name) AGAINST('$terms') 
		GROUP BY name
		ORDER BY score DESC 
		LIMIT 25";
    
$venueResult = mysql_query($venueQuery);

?>
	<div id="yui-main">
	 <div class="yui-b">
	 	<div class="yui-g">
	 		<h1>Results for '<?php echo $terms; ?>'</h1>
	 		<br />
	 	</div>
	 	<h3>Artists</h3>
	 		<table id="tracklist" class="search">
		<?php
          if($artistResult && mysql_num_rows($artistResult) >0){
        	$count=0;
            while($artistRow = mysql_fetch_assoc($artistResult)){
              $artist = mysql_fetch_assoc(getArtist($artistRow['id']));
            if($count%2==0){
            	echo '<tr>';
            }
            else{
            	echo '<tr class="odd">';
            }
            echo '<td class="title"><a href="javascript:loadContent(\'results.php?artist=';
            echo $artistRow["id"];
            echo '\')">';
            echo $artist["name"];
            echo '</a></td>';
            echo '</tr>';
            $count++;
            }
          }
          else{
          	echo '<em>\'';
          	echo $terms;
          	echo '\' returned no artists.</em>';
          }
          
          ?>	
				</table>
        
			
	<div class="yui-g">
	<h3>Albums</h3>
      <table id="tracklist" class="search album">
        <?php
          if($albumResult && mysql_num_rows($albumResult) >0){
          	echo 	'<tr class="headings">
          <td></td>
          <td class="title">Album Title</td>
          <td class="artist_title">Artist</td>
          <td><img src="images/star.gif" class="star small" /></td>
        </tr>';
        $count=0;
            while($albumRow = mysql_fetch_assoc($albumResult)){
              $album = mysql_fetch_assoc(getAlbum($albumRow['id']));   
            if($count%2==0){
            	echo '<tr>';
            }
            else{
            	echo '<tr class="odd">';
            }
            echo '<td class="play_add"><a href="javascript:playAlbum(\'';
            echo $albumRow["id"];
            echo '\')"><img class="small" src="images/play.gif" /></a><a href="javascript:appendAlbum(\'';
            echo $albumRow["id"];
            echo '\')"><img class="small" src="images/add.gif" /></a></td>';
            echo '<td class="title"><a href="javascript:loadContent(\'info.php?album=';
            echo $albumRow["id"];
            echo '\')">';
            echo $album["title"];
            echo '</a></td>';
            echo '<td class="artist_title"><a href="javascript:loadContent(\'results.php?artist=';
            echo $album["artist_id"];
            echo '\')">';
            $artist = getArtist($album["artist_id"]);
		  	while($artistrow = mysql_fetch_array($artist)){
		  		echo $artistrow[0];
			}
            echo '</a></td><td><p class="rating">';
            $rating = getRatingsForAlbum($albumRow["id"]);
		  	while($ratingrow = mysql_fetch_array($rating)){
		 		echo$ratingrow[0];
		  	}
		  	echo '</p>'; 
            echo '</tr>';
            $count++;
            }
          }
          else{
          	echo '<em>\'';
          	echo $terms;
          	echo '\' returned no albums.</em>';
          }
          
          ?>
      </table>
    </div>
    
	<div class="yui-g">
	<h3>Songs</h3>
      <table id="tracklist" class="search">
      <?php if($songResult && mysql_num_rows($songResult) >0){ 
      	echo '<tr class="headings">
          <td></td>
          <td class="title">Song Title</td>
          <td class="title">Album</td>
        </tr>';
        
        	$count=0;
            while($songRow = mysql_fetch_assoc($songResult)){
              $song = mysql_fetch_assoc(getSong($songRow['id']));
              
              $albumQuery = getAlbum($song['album_id']);
              if($albumQuery && mysql_num_rows($albumQuery) >0){
                $album = mysql_fetch_assoc($albumQuery);
              }
            
            if($count%2==0){
            	echo '<tr>';
            }
            else{
            	echo '<tr class="odd">';
            }
            echo '<td class="play_add"><a href="javascript:playSong(\'';
            echo $songRow["id"];
            echo '\')"><img class="small" src="images/play.gif" /></a><a href="javascript:appendSong(\'';
            echo $songRow["id"];
            echo '\')"><img class="small" src="images/add.gif" /></a></td>';
            echo '<td class="title"><a href="javascript:playSong(\'';
            echo $song["id"];
            echo '\')">';
            echo $song["title"];
            echo '</a></td>';
            echo '<td class="title"><a href="javascript:loadContent(\'info.php?album=';
            echo $song["album_id"];
            echo '\')">';
            echo $album["title"];
            echo '</a></td>';
            echo '</tr>';
            $count++;
            }
          }
          else{
          	echo '<em>\'';
          	echo $terms;
          	echo '\' returned no songs.</em>';
          }
          
          ?>
        
      </table>
      
     <h3>Venues</h3>
      <table id="tracklist" class="search">
      <?php
          if($venueResult && mysql_num_rows($venueResult) >0){
        echo '<tr class="headings">
          <td class="title">Name</td>
          <td class="title">Location</td>
        </tr>';
        
            $count=0;
            while($venueRow = mysql_fetch_assoc($venueResult)){
            if($count%2==0){
            	echo '<tr>';
            }
            else{
            	echo '<tr class="odd">';
            }
            echo '<td class="title"><a href="javascript:loadContent(\'resultsVenue.php?venue=\'';
            echo $venueRow["id"];
            echo '\')">';
            echo $venueRow["name"];
            echo '</a></td>';
            echo '<td class="title">';
            echo $venueRow['location'];
            echo '</td>';
            echo '</tr>';
            $count++;
            }
          }
          else{
          	echo '<em>\'';
          	echo $terms;
          	echo '\' returned no venues.</em>';
          }
          
          ?>

      </table>
     
	 	</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>
