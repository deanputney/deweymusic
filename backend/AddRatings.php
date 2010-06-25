<?php 
	$root_path = "/Library/WebServer/Documents/250_A/";

	include_once($root_path."functions/Albums.php");
	function runAddRatings(){
		$allAlbumsResult=getAllAlbums();
		while($albumRow = mysql_fetch_assoc($allAlbumsResult))
		{
			$rowId = $albumRow["id"];
			$rowPlays = $albumRow["initial_plays"];
			echo $rowId.":".$rowPlays."<br/>";
			$query = "UPDATE albums SET likes='$rowPlays' WHERE id = '$rowId'";
			mysql_query($query);
		}
		return 1;
	}




?>