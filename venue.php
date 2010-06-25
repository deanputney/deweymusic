<?php include('includes/header.php');
include('functions/Venue.php');
include('functions/Albums.php');

$vId = $_GET["venue"];
$vName = "";
$venueQuery = getVenue($vId);

if($venueQuery && mysql_num_rows($venueQuery)){

	$venue = mysql_fetch_assoc($venueQuery);
		$vName = $venue["name"];
		$vLoc = $venue["location"];

		$albumQuery = getAlbumsByVenue($vId);
	
}

?>
<div id="yui-main">
 <div class="yui-b">
 <div class="yui-g">
 <h2>Venue</h2>
 <h3><?php echo $vName; ?></h3>
 <?php
 if($albumQuery && mysql_num_rows($albumQuery) > 0)
       				{
       					echo '<table id="tracklist">
								<tr class="headings">
									<td></td>
									<td></td>
									<td class="title">Track</td>
									<td></td>
									<td>Plays</td>
								</tr>';
							
						while($albumRow = mysql_fetch_assoc($albumQuery)){
							if($count%2==0){
								echo '<tr>';
							}
							else{
								echo '<tr class="odd">';
							}
							echo '<td class="position">';
							echo($count);
							echo '</td><td class="play_add"><a href="javascript:playAlbum(\'';
							echo $albumRow["id"];
							echo '\')"><img class="small" src="images/play.gif" /></a><a href="javascript:appendAlbum(\'';
							echo $albumRow["id"];
							echo '\')"><img class="small" src="images/add.gif" /></a></td>';
							echo '<td class="title">';
							echo '<a href="javascript:loadContent(\'info.php?album=';
							echo $albumRow["id"];
							echo '\')">';
							echo $albumRow["title"];
							echo '</a>';
							echo '</td><td class="duration">';
							echo '</td><td class="plays">';
							
							echo '</td></tr>';
							$count++;
						}
						echo '</table>';
					}
 ?>
 </div>
 </div>
</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>

