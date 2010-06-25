<?php include_once('includes/header.php');
include_once('functions/PlaylistFunctions.php');
include_once('functions/PlaylistSongs.php');
include_once('functions/Songs.php');

$pId = $_GET["playlist"];
$pName = "";

$playlistQuery = getPlaylist($pId);

if($playlistQuery && mysql_num_rows($playlistQuery) > 0){

$playlist = mysql_fetch_assoc($playlistQuery);
$pName = $playlist["name"];
$pUser = $playlist["user_id"];

$tracks = getSongsInPlaylist($pId);
}

?>
<div id="yui-main">
 <div class="yui-b">
		<div class="yui-g">
 <h1>Playlist</h1>
 <?php
 echo '<a href="javascript:playPlaylist(\'';
		  		echo($pId);
		  		echo '\')"><img class="ftitle" src="images/play.gif" /></a>';
 ?>
 <h2><?php
  echo $pName; 
  ?></h2>
  <h3>Tracks</h3>
	<a href="javascript:loadPlaylist('<?php echo $_GET['playlist'] ?>')">Load Playlist</a>
  <?php
  if($tracks && mysql_num_rows($tracks) > 0)
	{
       					echo '<table id="tracklist">
								<tr class="headings">
									<td></td>
									<td></td>
									<td class="title">Track</td>
									<td></td>
									<td>Plays</td>
								</tr>';
							
		while($trackrow = mysql_fetch_array($tracks)){
			if($count%2==0){
				echo '<tr>';
			}
			else{
				echo '<tr class="odd">';
			}
			echo '<td class="position">';
			echo($count);
			echo '</td><td class="play_add"><a href="javascript:playSong(\'';
			echo $trackrow[0];
			echo '\')"><img class="small" src="images/play.gif" /></a>';
			
			if($_SESSION["userid"] !=null && $pUser = $_SESSION["userid"]){
			echo '<a href="javascript:removeSong(\'';
			echo $trackrow[0];
			echo '\')"><img class="small" src="images/subtract.gif" /></a></td>';
			
			}
			
			echo '<td class="title">';
			echo $trackrow[1];
			echo '</td><td class="duration">';
			echo '</td><td class="plays">';
			$plays=getPlaysForSong($trackrow[0]);
			while($playsrow = mysql_fetch_array($plays)){
				echo $playsrow[0];
				}
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
