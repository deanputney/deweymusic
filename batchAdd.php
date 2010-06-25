<?php
/* DOWNLOADING XML FILE */
	/* 50 rows: http://bit.ly/QT51b */
	/* 500 rows: http://bit.ly/1U216k */
	/* 150,000 rows: http://bit.ly/2w1mcn */
	/*1.) Venue
	  2.) Genre
	  3.) Artist
	  4.) Album
	  5.) Song
	  6.) File Type
	  7.) File
	*/
	$pathname = '/raid2/250_A/xml_scripts/';
	$filename = 'albums.xml';
	set_time_limit(0);
  	include_once("xml_scripts/xmlfunctions.php");
  	include_once("functions/Venue.php");
  	include_once("functions/Artists.php");
  	include_once("functions/Genres.php");
  	include_once("functions/Albums.php");
  	include_once("functions/Songs.php");
	include_once("functions/dbconnect.php");
	include_once("functions/FileType.php");
	include_once("functions/Files.php");
  	getXML($filename, "http://api.deweymusic.org/files/?n=10");
  	
  	
  	//$questions = 4; /* QUESTIONS PREVENTS MAXING MYSQL RESOURCES ON SERVER */

	if ($xml = simplexml_load_file($pathname.$filename)) {
		foreach( $xml->children() as $item){
			/*ADD VENUES
			print $item->venue."@".$item->location;
			insertVenue($item->venue,$item->location);
			$id = getVenueByInfo($item->venue,$item->location);
			print $id."<br/>";
			*/
			
			/*ADD ARTISTS/GENRES
			$artistFileName='artists.xml';
			print $item->name;
			if($item->name==""){
				echo "SPECIAL CASE FOUND";
			}
			else {
				echo "NORMAL RUN";
				getXML($artistFileName,"http://ws.audioscrobbler.com/2.0/artist/".$item->name."/info.xml");
				print $item->name.":TAGS:";
				if(insertArtist($item->name,$item->id)){
					$artistId=mysql_insert_id();
					print $id;
					if($lfmXml=simplexml_load_file($pathname.$artistFileName))
					{
						foreach($lfmXml->tags->children() as $tag){
							$currentTag=$tag->name;
							if($currentTag!=""){
								addGenre($currentTag);
								$genreSQLresult=getGenre($currentTag);
								$genreId = mysql_fetch_array($genreSQLresult);
								addGenreToArtist($genreId[0], $artistId);
								print $genreId.": ".$tag->name." ";
							}
						}
					}
				}
				print "<br/>";				
			}*/
			/*ADD ALBUM
			//echo $item->venue.":".$item->location."<br/>";
			$venueId=null;$artist_id=null;
			if($venueSQLresult=getVenueByInfo($item->venue, $item->location))
			{
			$venueId=mysql_fetch_array($venueSQLresult);
			}
			if($artistSQLresult=getArtistByDeanId($item->artist_id))
			{$artist_id=mysql_fetch_array($artistSQLresult);}
			
			
			//echo "THIS IS THE DATE OMG KENNY: ".$item->date;
			//echo $item->transferer;
			if($venueId[0]!=null && $artist_id[0]!=null)
			{
				echo $venueId[0].":".$artist_id[0]."<br/>";
			if(insertAlbum($item->title, $artist_id[0], $item->subject, $item->date, $item->description, $venueId[0], $item->source, $item->uploader,$item->taper,$item->transferer,$item->id)){
			}
			else
				echo "boo<br/>";
			
			}*/
			/*ADD SONG
			if($deanIdSQL=getAlbumByDeanId($item->album_id))
			{$deanId=mysql_fetch_array($deanIdSQL);}
			$albumId=$deanId[0];
			echo "ID:".$item->id." album_id:".$albumId." track:".$item->track." title:".$item->title."<br/>";
			if($albumId!=null||$albumId!=""){
				insertSong($albumId, $item->title,$item->track,$item->id);
			}*/
			/*ADD FILETYPE
			echo $item->id.":".$item->name."<br/>";
			
			insertFileType($item->id,$item->name);*/
			/*ADD FILE
			<file>
				<id>1</id>
				<song_id>1</song_id>
				<format_id>1</format_id>
				<album_id>cornmeal2009-07-30.at835b.flac16</album_id>
				<name>Cornmeal-2009-07-30-1644-t01.flac</name>
				<bitrate>0</bitrate>
			</file>
			
			
			$http="http://www.archive.org/download/".$item->album_id."/".$item->name;
			if($deanSongIdSQL=getSongByDeanId($item->song_id))
			{$song_id=mysql_fetch_array($deanSongIdSQL);}
			if($deanAlbumIdSQL=getAlbumByDeanId($item->album_id))
			{$album_id=mysql_fetch_array($deanAlbumIdSQL);}
			
			echo "ID: ".$item->id."<br/>NAME: ".$item->name."<br/>FTID: ".$item->format_id."<br/>SONG_ID: ".$song_id[0]."<br/>http_location: ".$http."<br/>album_id: ".$album_id[0]."<br/>bitrate: ".$item->bitrate."<br/><br/>";
			insertFile($item->id,$item->name,$item->format_id,$song_id[0],$http,$album_id[0],$item->bitrate);
			*/
		}
	}
?>
