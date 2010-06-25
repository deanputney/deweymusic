<?php
	/*LAST EDITED 10-29-09 BY kdyeh*/
	$root_path = "/Library/WebServer/Documents/250_A/";

  	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/testdbconnect.php");
  	include_once($root_path."functions/Albums.php");
  	include_once($root_path."functions/Venue.php");
  	function runAddAlbums($n, $o){
  		global $root_path;
  		$pathname = $root_path."/xml_scripts/";
		$filename = 'albums.xml';
	  	getXML($filename, "http://api.deweymusic.org/albums/?n=".$n."&offset=".$o);	
		if ($xml = simplexml_load_file($pathname.$filename)) {
			foreach( $xml->children() as $item){
				//echo $item->venue.":".$item->location."<br/>";
				$venueId=null;$artist_id=null;
				if($venueSQLresult=getVenueByInfo($item->venue, $item->location))
				{
					$venueId=mysql_fetch_array($venueSQLresult);
				}
				insertAlbum($item->id,$item->title, $item->artist_id, $item->subject, $item->date, $item->downloads, $item->avg_rating, $item->num_reviews,$item->description, $venueId[0], $item->source, $item->uploader,$item->taper,$item->transferer,$item->downloads);
			}
		}
	}
?>
