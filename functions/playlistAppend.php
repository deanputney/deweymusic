<?php
header("Cache-Control: no-cache");
header("content-type: application/xml");
include_once("dbconnect.php");
include_once("Songs.php");
include_once("PlaylistSongs.php");


function Truncate ($str, $length=15, $trailing='...') 
{
      // take off chars for the trailing
      $length-=strlen($trailing);
      if (strlen($str) > $length) 
      {
         // string exceeded length, truncate and add trailing dots
         return substr($str,0,$length).$trailing;
      } 
      else 
      { 
         // string was already short enough, return the string
         $res = $str; 
      }
  
      return $res;
} 
if(isset($_GET['album_id'])){
	$result = getSongsForAlbum($_GET['album_id']);
}else if(isset($_GET['song_id'])){
	$result = getSong($_GET['song_id']);
}else if(isset($_GET['playlist_id'])){
	$result = getSongsInPlaylist($_GET['playlist_id']);
}
/*if(mysql_num_rows($result) > 0){
	while($albumrow = mysql_fetch_assoc($result)){
		echo $albumrow[http_location];
		echo "<br>";
	}
}*/
echo "<?xml version=\"1.0\"?>\n";  
echo "<response>\n";  
echo "\t<status>$status_code</status>\n";  
echo "\t<time>".time()."</time>\n";  

while($albumrow = mysql_fetch_assoc($result))  
{  
	 echo "\t<song>\n"; 
	 $shorten=Truncate($albumrow['title']);
	 $shorten=htmlentities($shorten);
	 echo "\t\t<name>$shorten</name>\n"; 
	 echo "\t\t<album_id>".$albumrow['album_id']."</album_id>\n";
	 echo "\t\t<id>".$albumrow['id']."</id>\n";
	 echo "\t\t<location>".$albumrow['http_location']."</location>\n";  
	 echo "\t</song>\n";  
}  
echo "</response>";
/*
echo "<li id=";
echo $_GET['song_id'];
echo "><label>";
echo $_GET['song_id'];
echo "</label><em>";
echo "<a href='javascript:loadContent(\"";
echo $_GET['song_id'];
echo ".php\")'>i</a></em></li>";*/
?>
