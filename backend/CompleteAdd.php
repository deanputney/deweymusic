<?php
	/*LAST EDITED 10-29-09 BY kdyeh
		NOTE: implement this! check AddArtistsArtists.php as well.
	*/
	set_time_limit(0);
	ini_set("memory_limit", "2G");
	//echo "START: ".strftime('%c')."<br/>";
  	include_once("AddVenues.php");
  	include_once("AddArtistsGenres.php");
	include_once("AddAlbums.php");
	include_once("AddSongs.php");
	include_once("AddFormats.php");
	include_once("AddFiles.php");
	include_once("AddArtistsArtists.php");
	include_once("AddPlays.php");
	include_once("AddRatings.php");
	include_once("../functions/testdbconnect.php");
/*
	for($i=0; $i<=90; $i++){
		runAddVenues(1000, 1000*$i);
	}
	runAddArtistsGenres(11000);
	for($i=0; $i<=10; $i++){
		runAddAlbums(10000, 10000*$i);
	}
*/
	for($i=0; $i<=120; $i++){
		runAddSongs(10000, 10000*$i);
	}
/* 	runAddFormats(200); */
/*
	$error = 0;
	for($i=0; $i<=510; $i++){
		$error = runAddFiles(10000, 10000*$i);
		if($error !=0){
			break;
		}
	}
	echo "\n\n$error\n\n";
*/
/*
	runAddArtistsArtists();
	runAddPlays();
	runAddRatings();
*/
  	//echo "END: ".strftime('%c')."<br/>";
?>
