<?php
	/*LAST EDITED 10-29-09 BY kdyeh
		NOTE: implement this!
	*/
	$root_path = "/Library/WebServer/Documents/250_A/";
	
	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/testdbconnect.php");
  	include_once($root_path."functions/Albums.php");
  	include_once($root_path."functions/Songs.php");
  	include_once($root_path."functions/Plays.php");
	function runAddPlays(){
		$count=0;
		$allAlbumsResult=getAllAlbums();
		while($albumrow = mysql_fetch_assoc($allAlbumsResult))
		{	
			$albumId = $albumrow["id"];	
			$playCount = $albumrow["initial_plays"];
			$songsForAlbumResult=getSongsForAlbum($albumId);
			while($songrow = mysql_fetch_assoc($songsForAlbumResult))
			{
				$songId = $songrow["id"];
				initializePlays(1,$songId,$playCount);
				$count++;
			}							
		}
		echo $count;
	}	
?>
