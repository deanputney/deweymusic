<?php

function addGenre($genre)
{
$genre2= htmlspecialchars($genre,ENT_QUOTES);
$query = "INSERT INTO genres (name) VALUES ('$genre')";

$result = mysql_query($query);

return $result;

}
function getGenre($name)
{
$query = "SELECT id FROM genres WHERE name='$name'";
$result= mysql_query($query);
return $result;
}
function getGenres()
{

$query = "SELECT id, name FROM genres ORDER BY name";

$result = mysql_query($query);

return $result;

}

?>