<?php
/*
<file>
				<id>1</id>
				<song_id>1</song_id>
				<format_id>1</format_id>
				<album_id>cornmeal2009-07-30.at835b.flac16</album_id>
				<name>Cornmeal-2009-07-30-1644-t01.flac</name>
				<bitrate>0</bitrate>
			</file>
*/
function getFile($id)
{
$query = "SELECT FROM files WHERE id='$id'";
$result = mysql_query($query);

return $result;	
}

function insertFile($id,$name,$file_type_id,$song_id,$http_location,$album_id,$bitrate)
{
$name2=htmlspecialchars($name, ENT_QUOTES);
$query = "INSERT INTO files (id, name, file_type_id, song_id, http_location, album_id, bitrate) VALUES ('$id','$name2','$file_type_id', '$song_id', '$http_location', '$album_id', '$bitrate')";
$result = mysql_query($query);
return $result;
}


?>