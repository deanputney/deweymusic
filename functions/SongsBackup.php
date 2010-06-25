<?php

function getSong($id)
{
$query = "SELECT songs.id, songs.title, songs.track, files.http_location, files.bitrate, files.size, file_types.name, songs.album_id FROM songs JOIN files ON files.song_id = songs.id JOIN file_types ON files.file_type_id = file_types.id WHERE songs.id=$id AND file_types.name LIKE '% mp3'  ORDER BY songs.track";
$result = mysql_query($query);
return $result;
}

function getSongsForAlbum($album_id)
{
$query = "SELECT songs.id, songs.title, songs.track, files.http_location, files.bitrate, files.size, file_types.name, songs.album_id FROM songs JOIN files ON files.song_id = songs.id JOIN file_types ON files.file_type_id = file_types.id WHERE songs.album_id = $album_id AND file_types.name LIKE '% mp3'  ORDER BY songs.track";
$result = mysql_query($query);

return $result;
}
function insertSong($album_id, $title,$track,$dean_song_id){
$title2=htmlspecialchars($title, ENT_QUOTES);
$query = "INSERT INTO songs (album_id, title, track, dean_song_id) VALUES ('$album_id', '$title2', '$track', '$dean_song_id')";
$result = mysql_query($query);
return $result;
}

function getSongByDeanId($dean_id){
$query = "SELECT id FROM songs WHERE dean_song_id='$dean_id'";
$result=mysql_query($query);
return $result;
}
function getPlaysForSong($song_id)
{
$query = "SELECT COUNT(id) FROM plays WHERE song_id = $song_id";
$result = mysql_query($query);

return $result;
}

function getAllSongs()
{
$query = "SELECT id FROM songs";

$result=mysql_query($query);
return $result;
}

function getFilesForSong($song_id)
{
$query = "SELECT files.name, files.http_location, file_types.name FROM files JOIN file_types JOIN songs ON files.file_type_id = file_types.id WHERE songs.id = files.song_id AND songs.id = '$song_id'";
$result = mysql_query($query);

return $result;
}

?>
