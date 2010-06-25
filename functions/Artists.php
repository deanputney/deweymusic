<?php
/*LAST EDITED 10-29-09 BY kdyeh*/
function addGenreToArtist($genre_id, $artist_id)
{
$query = "INSERT INTO artists_genres (genre_id, artist_id) VALUES ($genre_id, $artist_id)";
$result = mysql_query($query);
return $result;
}
function addArtistToArtist($parent_id, $child_id)
{
$query = "INSERT INTO artists_artists (parent_id, child_id) VALUES ($parent_id, $child_id)";
$result = mysql_query($query);
return $result;
}

function getArtistsByName($name)
{
$name2=htmlspecialchars($name, ENT_QUOTES);
$query = "SELECT artists.id FROM artists WHERE artists.name = '$name2'";
$result = mysql_query($query);
return $result;
}
function getArtistsByGenre($genre_id)
{

$query = "SELECT artists.id, artists.name FROM artists JOIN artists_genres ON artists_genres.artist_id = artists.id WHERE artists_genres.genre_id = $genre_id";
$result = mysql_query($query);

return $result;
}

function getArtist($artist_id)
{

$query = "SELECT name FROM artists WHERE id = $artist_id";
$result = mysql_query($query);

return $result;

}
function insertArtist($id, $name)
{
$name2=htmlspecialchars($name, ENT_QUOTES);
$query = "INSERT INTO artists (id,name) VALUES('$id','$name2')";
$result = mysql_query($query);
return $result;
}
function getGenresForArtist($artist_id)
{
$query = "SELECT genres.id, genres.name FROM genres JOIN artists_genres ON artists_genres.genre_id = genres.id WHERE artists_genres.artist_id = $artist_id";

$result = mysql_query($query);

return $result;

}
function getAllArtists()
{
	$query = "SELECT id, name FROM artists ORDER BY name";
	$result = mysql_query($query);
	return $result;
}
function getNumberOfArtists()
{
$query = "SELECT count(*) FROM artists";

$result=mysql_query($query);
$array = mysql_fetch_array($result);
$numberOfArtists = $array['count(*)'];

return $numberOfArtists;
}

function getRelatedArtists($artist_id, $num)
{
$query = "SELECT child_id FROM artists_artists WHERE parent_id = $artist_id LIMIT $num";

$result = mysql_query($query);

return $result;


}


?>