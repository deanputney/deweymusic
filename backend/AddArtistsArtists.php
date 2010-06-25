<?php
	/*LAST EDITED 10-29-09 BY kdyeh
		NOTE: implement this!
	*/
	$root_path = "/Library/WebServer/Documents/250_A/";
	
	include_once($root_path."xml_scripts/xmlfunctions.php");
  	include_once($root_path."functions/testdbconnect.php");
  	include_once($root_path."functions/Artists.php");
	function runAddArtistsArtists(){
		global $root_path;
		$pathname = $root_path."xml_scripts/";
		$filename = 'albums.xml';
		$allArtistsResult=getAllArtists();
		while($artistrow = mysql_fetch_assoc($allArtistsResult))
		{	
			$parentName = $artistrow["name"];
			$parentId = $artistrow["id"];	
			$artistFileName='artists.xml';		
			getXML($artistFileName,"http://ws.audioscrobbler.com/2.0/artist/".$parentName."/info.xml");
			if($lfmXml=simplexml_load_file($pathname.$artistFileName))
			{
				foreach($lfmXml->similar->children() as $childArtist){
					$childName = $childArtist->name;					
					$childSQLresult=getArtistsByName($childName);
					$childId = mysql_fetch_array($childSQLresult);
					if($childId[0]!="" & $childId[0]!=$parentId){
						addArtistToArtist($childId[0], $parentId);
						addArtistToArtist($parentId, $childId[0]);
					}					
				}
			}							
		}
	}	
?>
