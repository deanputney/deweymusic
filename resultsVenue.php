<?php 
	include('includes/header.php');
	include_once('functions/Albums.php');
	include_once('functions/Venue.php');
	include_once('functions/Artists.php');
	$id = $_GET["venue"];
?>
	<div id="yui-main">
	 <div class="yui-b">
	 	<div class="yui-g">
	 	
	 	<?php 
		 	echo '<h1>Venue: ';
	 		$venue = getVenue($id);
		  	while($venuerow = mysql_fetch_array($venue)){
		  		echo $venuerow["1"];
		  	}
		  	echo '</h1><em>';
		  	$albums = getAlbumsByVenue($id);
		  	echo(mysql_num_rows($albums));
		  	echo ' albums found</em>';	 
		 ?>
	 	</div>
		<div class="yui-gb">
	 	<?php
	 		$count=0;
	 		while($albumrow = mysql_fetch_array($albums)){
	 				if($count%3==0){
	 					echo '<div class="yui-u first entry">';
	 				}
	 				else{
	 					echo '<div class="yui-u entry">';
	 				}
	 				echo '<div class="add_play"><a href="javascript:playAlbum(\'';
	 				echo $albumrow[0];
	 				echo '\')"><img class="small" src="images/play.gif" /></a>';
	 				echo '<a href="javascript:appendAlbum(\'';
	 				echo $albumrow[0];
	 				echo '\')"><img class="small" src="images/add.gif" /></a></div>';
					echo '<h5><a href="javascript:loadContent(\'info.php?album=';
					echo $albumrow[0];
					echo '\')">';
					echo $albumrow[1];
					echo '</a></h5>';
					echo '<img class="star small" src="images/star.gif" /><p class="rating">';
					$rating = getRatingsForAlbum($albumrow[0]);
		  			while($ratingrow = mysql_fetch_array($rating)){
		  				echo $ratingrow[0];
		  			}
		  		echo '</p>';
					echo '</div>';
	 			if($count%3==2){
	 				echo '</div><div class="yui-gb">';}
	 			$count++;
	 		}
	 	?>
	 	</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>