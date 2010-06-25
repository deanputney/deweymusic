<?php include_once('functions/Artists.php'); ?>
<?php include_once('functions/Albums.php'); ?>
<?php include_once('functions/Login.php'); ?>
<?php include('functions/Featured.php'); ?>
<?php include('dbconnect.php')?>
<?php

session_start();
/*$db = mysql_connect("localhost", "haydent", "taitan5") or die ("Error connecting to database."); 
mysql_select_db("67250_A");
*/

$do = $_GET['do'];
switch($do) {
    case 'check_username_exists':
        if(get_magic_quotes_gpc()) {
            $username = $_GET['username'];
        }else{
            $username = addslashes($_GET['username']);
        }
        $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `username`='".$username."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        if($count > 0) {
            echo 'That username already exists.';
        }else{
            echo 'That username is available.';
        }
        echo '</result>';
    break;
    case 'load_artist_select':
	$genre = $_GET['genre_id'];
	if($genre>0){
	$artists = getArtistsByGenre($genre);
	}
	else
	{
	$artists = getAllArtists();
	}
	$first = true;
	$count=0;
	header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        if(mysql_num_rows($artists) < 1) {
            echo 'Feliz Cumpleanos!';
        }else{
		while($artistrow = mysql_fetch_assoc($artists)){
			if($count%2==0){
				echo '&lt;li class="to_select"&gt;';
			}
			else{
				echo '&lt;li class="to_select odd"&gt;';
			}
			
			
			echo '&lt;a onclick="javascript: loadAlbums(';
			echo $artistrow["id"];
			echo ')"&gt;';
			echo htmlspecialchars($artistrow["name"], ENT_QUOTES);
			echo '&lt;/a&gt;';
			echo '&lt;li&gt;';
			$count++;
		}
     }
        echo '</result>';

    break;
    
    case 'load_album_select':
    $artist = $_GET['artist_id'];
    $albums = getAlbumsByArtist($artist);
    $first = true;
    $count = 0;
	header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        if(mysql_num_rows($albums) < 1) {
            echo 'Feliz Cumpleanos!';
        }else{
		while($albumrow = mysql_fetch_assoc($albums)){
			if($count%2==0){
				echo '&lt;li&gt;';
			}
			else{
				echo '&lt;li class="odd"&gt;';
			}
			
			echo '&lt;a href="javascript:loadContent(\'info.php?album=';
			echo $albumrow["id"];
			echo '\')"&gt;';
			echo htmlspecialchars($albumrow["title"], ENT_QUOTES);
			echo '&lt;/a&gt;';
			echo '&lt;li&gt;';
			$count++;
		}
     }
        echo '</result>';
    
    break;
    
    case 'rate_album_up':
		$userid = $_SESSION['userid'];
		if($userid==null){
		break;
		}
		
		$albumid = $_GET['album_id'];
		
		rateUpAlbum($userid, $albumid);
		
    break;
    
    case 'rate_album_down':
		$userid = $_SESSION['userid'];
		if($userid==null){
		break;
		}
		
		$albumid = $_GET['album_id'];
		
		rateDownAlbum($userid, $albumid);
    break;
	
	case 'facebook_user':
        $fb_id = ($_GET['fb_id']);
        $count = mysql_num_rows(mysql_query("SELECT * FROM users WHERE fb_id='$fb_id'"));
        //header('Content-Type: text/xml');
        //header('Pragma: no-cache');
        if($count == 0) {		
			//$fb=new Facebook($api_key,$secret);
			//$fql = "SELECT proxied_email FROM user WHERE uid ='$fb_id'";
            //$query ="INSERT INTO users (email, username, fb_id) VALUES ('$fb_id', '$fb_id', '$fb_id')";
			//mysql_query($query);
			$newID = addFBUser($fb_id, $fb_id);
			siteLogin($fb_id, $fb_id,"","");
        }
    break;
    
    case 'load_tab':
    $tab_name = $_GET['tab_name'];
    if($tab_name==2){
    	$albums = getMostPlayedAlbums(9);
    }
    else if($tab_name==3){
    	$albums = getNewestAlbum(9);
    }
    else if($tab_name==1){
    	$albums = getHighestRatedAlbums(9);
    }
    else{
    	$albums = NULL;
    }
    $count = 0;
	header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        echo '&lt;div class="yui-gb"&gt;';
        if(mysql_num_rows($albums) < 1) {
            echo 'Feliz Cumpleanos!';
        }
        else{
		while($albumrow = mysql_fetch_assoc($albums)){
			if($count%3==0){
	 			echo '&lt;div class="yui-u first entry"&gt;';
	 		}
			else{
	 			echo '&lt;div class="yui-u entry"&gt;';
	 		}
	 		echo '&lt;div class="add_play"&gt;&lt;a href="javascript:playAlbum(\'';
	 		echo $albumrow["id"];
	 		echo '\')"&gt;&lt;img class="small" src="images/play.gif" /&gt;&lt;/a&gt;';
	 		echo '&lt;a href="javascript:appendAlbum(\'';
	 		echo $albumrow["id"];
	 		echo '\')"&gt;&lt;img class="small" src="images/add.gif" /&gt;&lt;/a&gt;&lt;/div&gt;';
			echo '&lt;h5&gt;&lt;a href="javascript:loadContent(\'info.php?album=';
			echo $albumrow["id"];
			echo '\')"&gt;';
			echo htmlspecialchars($albumrow["title"], ENT_QUOTES);
			echo '&lt;/a&gt;&lt;/h5&gt;';
			echo '&lt;img class="star small" src="images/star.gif" /&gt;&lt;p class="rating"&gt;';
			$rating = getRatingsForAlbum($albumrow["id"]);
		  	while($ratingrow = mysql_fetch_array($rating)){
		  		echo $ratingrow[0];
		  		}
		  	echo '&lt;/p&gt;';
			echo '&lt;/div&gt;';
	 		if($count%3==2){
	 			echo '&lt;/div&gt;&lt;div class="yui-gb"&gt;';}
	 		$count++;
		}
     }
     	echo '&lt;/div&gt;';
        echo '</result>';
    
    break;
    
    case 'random_album':
		$rowNum = $_GET['album_row'];
		
		$ranQuery = getRandomAlbum($rowNum);
		header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
		if($ranQuery && mysql_num_rows($ranQuery) >0){
		$randomAlbum = mysql_fetch_array($ranQuery);
		
		/*echo '&lt;a class="browse_button" href="javascript:loadContent(\'info.php?album=';
   			echo urlencode(htmlspecialchars($randomAlbum[12], ENT_QUOTES));
   			echo '\')"&gt;Random&lt;/a&gt;';		*/
   			
   		echo urlencode(htmlspecialchars($randomAlbum[12], ENT_QUOTES));
		
		}
        echo '</result>';
    break;
	
    default:
        echo 'Error, invalid action';
    break;
}
?> 