<?php
function addPlay($userId,$songId){
	$query = "SELECT id FROM plays WHERE user_id='$userId' AND song_id='$songId'";
	$result= mysql_query($query);
	$playArray=mysql_fetch_array($result);
	if($playArray)
	{
		$playId=$playArray[0];
		$query = "UPDATE plays SET play_count=play_count+1 WHERE id = '$playId'";
		$result= mysql_query($query);
	//	return $result;
	}
	else
	{
		$query = "INSERT INTO plays (user_id, song_id) VALUES ('$userId','$songId')";
		$result = mysql_query($query);
		//return $result;
	}
  $query = "SELECT album_id FROM songs WHERE id = $songId";
  $result = mysql_query($query);
  $albumArray = mysql_fetch_array($result);
  $albumId = $albumArray[0];  
  $query = "UPDATE albums SET plays = plays + 1 WHERE id = '$albumId'";
  $result = mysql_query($query);
  
  return $result;
}
function initializePlays($userId,$songId,$count){
	$query = "INSERT INTO plays (user_id, song_id, play_count) VALUES ('$userId','$songId','$count')";
	$result = mysql_query($query);
	return $result;
}




?>