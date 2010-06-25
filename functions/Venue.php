<?php

function getVenue($id)
{
$query = "SELECT id, name FROM venues WHERE id='$id'";
$result = mysql_query($query);

return $result;	
}

function insertVenue($name,$location)
{
$name2=htmlspecialchars($name, ENT_QUOTES);
$location2=htmlspecialchars($location, ENT_QUOTES);
$query = "INSERT INTO venues (name, location) VALUES ('$name2','$location2')";
echo $query."\n\n";
$result = mysql_query($query);
return $result;
}

function getVenueByInfo($name,$location)
{
$query= "SELECT id FROM venues WHERE name='$name' AND location='$location'";
$result = mysql_query($query);
return $result;
}

function getVenueByName($name)
{
$query= "SELECT id FROM venues WHERE name='$name'";
$result = mysql_query($query);
return $result;
}

function updateVenue($name,$location,$id)
{
$query = "UPDATE venues SET name='$name' ,location='$location' WHERE id='$id'";
$result = mysql_query($query);

return $result;
}

function getAlbumsByVenue($id)
{
$query= "SELECT * FROM albums WHERE venue_id='$id'";
$result = mysql_query($query);
return $result;
}


?>