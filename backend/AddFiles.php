<?php
	/*LAST EDITED 10-29-09 BY kdyeh*/
	$root_path = "/Library/WebServer/Documents/250_A/";

  	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/Files.php");
	include_once($root_path."functions/testdbconnect.php");
  	function runAddFiles($n, $o){
  		global $root_path;
  		$pathname = $root_path."xml_scripts/";
		$filename = 'albums.xml';
	  	getXML($filename, "http://api.deweymusic.org/files/?n=".$n."&offset=".$o);
		if ($xml = simplexml_load_file($pathname.$filename)) {
			foreach( $xml->children() as $item){
				echo $item->name."\n";
				$http="http://www.archive.org/download/".$item->album_id."/".$item->name;
				insertFile($item->id,$item->name,$item->format_id,$item->song_id,$http,$item->album_id,$item->bitrate);
			}
			return 0;
		}
		else {
			return $o;
		}
		unset($xml);
	}
?>
