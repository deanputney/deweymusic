<?php

function getFileType($id)
{
$query = "SELECT FROM file_types WHERE id='$id'";
$result = mysql_query($query);

return $result;	
}

function insertFileType($id,$name)
{
$name2=htmlspecialchars($name, ENT_QUOTES);
$query = "INSERT INTO file_types (id, name) VALUES ('$id','$name')";
$result = mysql_query($query);


return $result;
}


?>