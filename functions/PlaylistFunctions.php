<?php
function insertPlaylist($name,$user_id)
{
$query = "INSERT INTO playlists (name, user_id) VALUES ('$name','$user_id')";
echo $query;
$result = mysql_query($query);

return $result;
}

function getUserPlaylists($user_id)
{
$query = "SELECT id, name, pkey FROM playlists WHERE user_id = '$user_id'";
$result = mysql_query($query);

return $result;
}

function getPlaylist($id)
{
$query = "SELECT name, user_id FROM playlists WHERE id = '$id'";
$result = mysql_query($query);

return $result;
}

function deletePlaylist($id)
{
$query = "DELETE FROM playlists WHERE id = '$id'";
mysql_query($query) or die('Error, query failed');
$query = "DELETE FROM playlists_songs WHERE playlist_id = '$id'";
$result = mysql_query($query);

return $result;
}

function updatePlaylist($name,$id)
{
$query = "UPDATE playlists SET name = '$name' WHERE id = '$id'";
$result = mysql_query($query);

return $result;
}

function getUserPlaylistWithName($user_id, $name)
{
	$query = "SELECT id FROM playlists WHERE user_id = $user_id AND name = '$name'";
$result = mysql_query($query);

return $result;
}

?>
