<?php

function insertPlaylistSong($song_id, $playlist_id)
{
$query = "INSERT INTO playlist_songs (song_id, playlist_id) VALUES ('$song_id', '$playlist_id')";
$result = mysql_query($query);
return $result;
}

function removePlaylistSong($song_id, $playlist_id)
{
$query = "DELETE FROM playlist_songs WHERE song_id = '$song_id' AND playlist_id='$playlist_id'";
$result = mysql_query($query);
return $result;
}

function getSongsInPlaylist($playlist_id)
{
	$query = "SELECT songs.id, songs.title, songs.track, files.http_location,files.bitrate, files.size, file_types.name, songs.album_id FROM songs JOIN playlist_songs ON playlist_songs.song_id = songs.id  JOIN files ON files.song_id=songs.id JOIN file_types ON files.file_type_id = file_types.id WHERE playlist_songs.playlist_id = $playlist_id AND file_types.name LIKE '% mp3'";
$result = mysql_query($query);
return $result;
}

?>
