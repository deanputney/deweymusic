<?php
	/*LAST EDITED 10-29-09 BY kdyeh*/
	$root_path = "/Library/WebServer/Documents/250_A/";
	
	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/testdbconnect.php");
  	include_once($root_path."functions/Venue.php");
  	function runAddVenues($n, $o){
  		global $root_path;
		$pathname = $root_path."xml_scripts/";
		$filename = 'albums.xml';
  		getXML($filename, "http://api.deweymusic.org/albums/?n=".$n."&offset=".$o); 		
		if ($xml = simplexml_load_file($pathname.$filename)) {
			foreach( $xml->children() as $item){
				insertVenue($item->venue,$item->location);			
			}
		}
	}
?>
