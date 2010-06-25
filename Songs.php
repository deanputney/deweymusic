<?php

function getSong($id)
{
$query = "SELECT album_id, title, track FROM songs WHERE id='$id'";
$result = mysql_query($query);
return $result;
}

function getSongsForAlbum($album_id)
{
$query = "SELECT songs.id, songs.title, songs.track, files.http_location, files.bitrate, files.size FROM songs JOIN files ON files.song_id = songs.id WHERE songs.album_id = $album_id";
$result = mysql_query($query);

return $result;
}

function getPlaysForSong($song_id)
{
$query = "SELECT COUNT(id) FROM plays WHERE song_id = $song_id";
$result = mysql_query($query);

return $result;
}

?>