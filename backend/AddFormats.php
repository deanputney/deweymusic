<?php
	/*LAST EDITED 10-29-09 BY kdyeh*/
	$root_path = "/Library/WebServer/Documents/250_A/";
	
  	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/FileType.php");
	include_once($root_path."functions/testdbconnect.php");
	
	function runAddFormats($n){
		global $root_path;
		$pathname = $root_path."xml_scripts/";
		$filename = 'albums.xml';
  		getXML($filename, "http://api.deweymusic.org/formats/?n=".$n);	
		if ($xml = simplexml_load_file($pathname.$filename)) {
			foreach( $xml->children() as $item){
				insertFileType($item->id,$item->name);
			}
		}
	}
?>
