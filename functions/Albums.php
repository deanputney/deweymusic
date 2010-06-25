<?php
/*LAST EDITED 10-29-09 BY kdyeh*/
function getAlbum($album_id)
{
$query = "SELECT albums.title, albums.subject, albums.date, albums.artist_id, albums.description, albums.source, albums.uploader_email, albums.taper_name, albums.transferer_name, venues.id, venues.name, venues.location, albums.id  FROM albums JOIN venues on albums.venue_id = venues.id WHERE albums.id = '$album_id'";
$result = mysql_query($query);

return $result;

}
function getAllAlbums()
{
	$query = "SELECT * FROM albums";
	$result = mysql_query($query);
	return $result;
}
/*function getRandomAlbum()
{
	$albumCount = countAlbums();
	$randomNumber = rand(0, $albumCount);

	return getAlbum($randomNumber);
}*/

function getRandomAlbum($rowNum)
{
$row = $rowNum;
$query = "SELECT * FROM albums LIMIT 1 OFFSET $row";
//echo $query;

$result = mysql_query($query);

if($result && mysql_num_rows($result) >0){
  $id = mysql_fetch_array($result);

  return getAlbum($id[0]);
}

return getAlbum('1');
}

//returns an int with the number of albums
function countAlbums()
{
$query = "SELECT count(*) FROM albums";
$result = mysql_query($query);

if($result){
$array = mysql_fetch_array($result);
return $array["count(*)"];
}

return 0;

}
function insertAlbum($dean_album_id,$title,$artist_id,$subject,$date, $plays, $avg_rating, $num_reviews, $description,$venue_id,$source,$uploader_email,$taper_name,$transferer_name,$likes)
{
$title2=htmlspecialchars($title, ENT_QUOTES);
$subject2=htmlspecialchars($subject, ENT_QUOTES);
$description2=htmlspecialchars($description, ENT_QUOTES);
$source2=htmlspecialchars($source, ENT_QUOTES);
$uploader_email2=htmlspecialchars($uploader_email, ENT_QUOTES);
$taper_name2=htmlspecialchars($taper_name, ENT_QUOTES);
$transferer_name2=htmlspecialchars($transferer_name, ENT_QUOTES);
$dean_album_id2=htmlspecialchars($dean_album_id, ENT_QUOTES);
$query = "INSERT INTO albums (id, title, artist_id, subject, date, plays, avg_ratings, reviews, description, venue_id, source, uploader_email, taper_name, transferer_name, likes) VALUES ('$dean_album_id2','$title2', '$artist_id', '$subject2', '$date', '$plays', '$avg_rating', '$num_reviews', '$description2', '$venue_id', '$source2', '$uploader_email2', '$taper_name2', '$transferer_name2','$likes')";
//echo $query."\n\n";
$result = mysql_query($query);
return $result;
}
function getAlbumByDeanId($deanId){
$deanId2=htmlspecialchars($deanId, ENT_QUOTES);
$query = "SELECT id FROM albums WHERE dean_album_id = '$deanId2'";
$result = mysql_query($query);
return $result;
}

function getAlbumsByArtist($artist_id)
{
$query = "SELECT id, title, date FROM albums WHERE artist_id = $artist_id";
$result = mysql_query($query);

return $result;
}


function getUserRating($user_id, $album_id)
{
$query = "SELECT likability FROM ratings WHERE album_id = '$album_id' AND user_id = $user_id";
$result = mysql_query($query);

return $result;
}

function getCanonincalRatingForAlbum($album_id)
{
$query = "SELECT COUNT(id)/(SELECT COUNT(id) FROM ratings WHERE album_id = '$album_id') FROM ratings WHERE album_id = '$album_id' AND likability = 1";
$result = mysql_query($query);

return $result;
}

function rateUpAlbum($user_id, $album_id)
{
$query = "INSERT INTO ratings (user_id, album_id, likability) VALUES ('$user_id', '$album_id', 1)";
$result = mysql_query($query);

return $result;
}

function rateDownAlbum($user_id, $album_id)
{
$query = "INSERT INTO ratings (user_id, album_id, likability) VALUES ('$user_id', '$album_id', -1)";
$result = mysql_query($query);

return $result;
}
function getFilesFromAlbumWithoutSongs($album_id)
{
$query = "SELECT files.name, files.http_location, file_types.name FROM files JOIN file_types JOIN songs ON files.file_type_id = file_types.id WHERE files.album_id = '$album_id' AND songs.id = files.song_id AND songs.track = '0'";
$result = mysql_query($query);

return $result;
}
	function getRatingsForAlbum($albumId){
		$query="SELECT likes FROM albums WHERE id='$albumId'";
		$results=mysql_query($query);
		return $results;
	}
function addRatings($userId,$albumId){
		$query="INSERT INTO ratings (user_id, album_id) VALUES ($userId, '$albumId')";
		$results=mysql_query($query);
		if(!$results){
			$query="UPDATE album SET likes=likes+1 WHERE id='$albumId'";
			$results=mysql_query($query);
			return $results;
		}
		return $results;
	}
?>