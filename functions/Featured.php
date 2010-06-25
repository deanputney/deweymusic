<?php

function getMostDownloaded($num)
{

$query = "SELECT  songs.id, songs.title, albums.title, files.http_location, venues.name, venues.location FROM files JOIN songs ON files.song_id = songs.id  JOIN albums on songs.album_id = albums.id JOIN venues ON albums.venue_id = venues.id ORDER BY files.downloads DESC LIMIT $num";
$result = mysql_query($query);
return $result;
}
///by album
//most played

function getMostPlayedAlbums($num)
{
//$query = "SELECT DISTINCT(albums.id), albums.title FROM albums JOIN songs ON songs.album_id = albums.id WHERE songs.id IN  (SELECT song_id FROM plays GROUP BY song_id ORDER BY COUNT(*) DESC) LIMIT $num";
$query = "SELECT id, title, plays FROM albums ORDER BY plays DESC LIMIT $num";


$result = mysql_query($query);

return $result;
}


//top rated by star
function getHighestRatedAlbums($num)
{

$query = "SELECT id, title FROM albums ORDER BY likes DESC LIMIT $num";

$result = mysql_query($query);

return $result; 

}

function getNewestAlbum($num)
{
$query = "SELECT albums.id, albums.title FROM albums ORDER BY created_at DESC LIMIT $num";

$result = mysql_query($query);

return $result;

}

?>