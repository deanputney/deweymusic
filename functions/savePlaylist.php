<?php
session_start();
include_once("dbconnect.php");
include_once("PlaylistSongs.php");
include_once("PlaylistFunctions.php");
echo $db;
if(!isset($_SESSION["userid"]) || !isset($_POST["name"])){
	return;
}

function Truncate ($str, $length=21, $trailing='...') 
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
$answer = getUserPlaylistWithName($_SESSION['userid'],$_POST['name']);
if($answer&&mysql_num_rows($answer)>0){
	$row = mysql_fetch_assoc($answer);
	deletePlaylist($row[id]);
	$result = insertPlaylist($_POST['name'],$_SESSION["userid"]);
	if($result){
		$playlist_id= mysql_insert_id();
	}
	$songs = explode(",",$_POST['array']);
	foreach($songs as $song){
		insertPlaylistSong($song,$playlist_id);
	}

	echo "Updated!";
	
}else{
	$result = insertPlaylist($_POST['name'],$_SESSION['userid']);
	if($result){
		$playlist_id= mysql_insert_id();
	}
	echo "PlayList ID = $playlist_id";
	$songs = explode(",",$_POST['array']);
	foreach($songs as $song){
		echo "Inserting playlist song";
		insertPlaylistSong($song,$playlist_id);
	}
	echo "Saved!";

}
/*if(isset($_GET['album_id'])){
	$result = getSongsForAlbum($_GET['album_id']);
}else if(isset($_GET['song_id'])){
	$result = getSong($_GET['song_id']);
}
/*if(mysql_num_rows($result) > 0){
	while($albumrow = mysql_fetch_assoc($result)){
		echo $albumrow[http_location];
		echo "<br>";
	}
}
echo "<?xml version=\"1.0\"?>\n";  
echo "<response>\n";  
echo "\t<status>$status_code</status>\n";  
echo "\t<time>".time()."</time>\n";  
while($albumrow = mysql_fetch_assoc($result))  
{  
	 echo "\t<song>\n"; 
	$shorten=Truncate($albumrow[title]);
	 echo "\t\t<name>$shorten</name>\n"; 
	 echo "\t\t<album_id>$albumrow[album_id]</album_id>\n";
	 echo "\t\t<id>$albumrow[id]</id>\n";
	 echo "\t\t<location>$albumrow[http_location]</location>\n";  
	 echo "\t</song>\n";  
}  
echo "</response>";*/
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
