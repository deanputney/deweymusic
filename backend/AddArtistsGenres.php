<?php
	/*LAST EDITED 10-29-09 BY kdyeh*/
	$root_path = "/Library/WebServer/Documents/250_A/";
	
	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/testdbconnect.php");
  	include_once($root_path."functions/Artists.php");
  	include_once($root_path."functions/Genres.php");
  	function runAddArtistsGenres($n){
  		global $root_path;
		$pathname = $root_path."xml_scripts/";
		$filename = 'albums.xml';
	  	getXML($filename, "http://api.deweymusic.org/artists/?n=".$n);
		if ($xml = simplexml_load_file($pathname.$filename)) {
			foreach( $xml->children() as $item){
				$artistFileName='artists.xml';
				if($item->name==""){
					insertArtist($item->id,$item->name);
				}
				else {
					getXML($artistFileName,"http://ws.audioscrobbler.com/2.0/artist/".$item->name."/info.xml");
					if(insertArtist($item->id,$item->name)){
						$artistId=$item->id;
						if($lfmXml=simplexml_load_file($pathname.$artistFileName))
						{
							foreach($lfmXml->tags->children() as $tag){
								$currentTag=$tag->name;
								if($currentTag!=""){
									addGenre($currentTag);
									$genreSQLresult=getGenre($currentTag);
									$genreId = mysql_fetch_array($genreSQLresult);
									addGenreToArtist($genreId[0], $artistId);
								}
							}
						}
					}			
				}	
			}
		}
	}
?>
