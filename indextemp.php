<?php
include('includes/header.php');
include('functions/Albums.php');
include('functions/Artists.php');
include('functions/Featured.php');
include('functions/Venue.php');
?>
<?php 
	include('dbwpconnect.php');
	$sql = "SELECT *
	FROM wp_posts
	WHERE post_status='publish'
	AND post_type='post'
	ORDER BY post_date DESC
	LIMIT 1";
	$post_result = mysql_query($sql, $wpcon);
	if(mysql_num_rows($post_result) == 1){
		if(mysql_num_rows($post_result) == 1){
			$row = mysql_fetch_array($post_result);
			$postContent = $row['post_content'];
			$postID = $row['ID'];
			//$postDate = $row['post_date'];
			
			$sql = "SELECT *
			FROM wp_postmeta
			WHERE post_id='$postID'
			AND meta_key='album_id'";
			$post_result = mysql_query($sql, $wpcon);
			if(mysql_num_rows($post_result) == 1){
				if(mysql_num_rows($post_result) == 1){
					$row = mysql_fetch_array($post_result);
					$album_id = $row['meta_value'];
				}
			}
			$sql = "SELECT *
			FROM wp_postmeta
			WHERE post_id='$postID'
			AND meta_key='image'";
			$post_result = mysql_query($sql, $wpcon);
			if(mysql_num_rows($post_result) == 1){
				if(mysql_num_rows($post_result) == 1){
					$row = mysql_fetch_array($post_result);
					$image_url = $row['meta_value'];
				}
			}
		}
		else {
			echo "Your query sucks.";
		}
	}
	else {
		echo "Your query sucks.";
	}
	include("dbconnect.php");
	$album_result=getAlbum($album_id);
	if(mysql_num_rows($album_result)==1){
		$row = mysql_fetch_array($album_result);
		$albumTitle = $row['title'];
		$artist_id=$row['artist_id'];
		$album_date=$row['date'];
		$venue_id=$row['venue_id'];
	}
	$venue_result=getVenue($venue_id);
	if(mysql_num_rows($venue_result)==1){
		$row = mysql_fetch_array($venue_result);
		$venueName = $row['name'];
	}
	$artist_result=getArtist($artist_id);
	if(mysql_num_rows($artist_result)==1){
		$row = mysql_fetch_array($artist_result);
		$artist_name = $row['name'];
	}
	
?>

	<div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
			<h4>Dewey's Pick</h4>
		</div>
		<div class="yui-gc">
		  <div class="featured">
			<div class="yui-u first">
				<h1 class="ftitle"><a href="javascript:loadContent('info.php?album=<?php echo $album_id;?>')"><?php echo $albumTitle;?></a></h1>
				<h1><a href="javascript:loadContent('results.php?artist=<?php echo $artist_id;?>')"><?php echo $artist_name;?></a></h1>
				<h3><?php echo $album_date;?></h3>
				<?php $rating = getRatingsForAlbum($album_id);?>
				<img class="star" src="images/star.gif" />
				<p class="rating">
		  			<?php while($ratingrow = mysql_fetch_array($rating)){
		  				echo $ratingrow[0];
		  			}?>
				</p>
				<a href="javascript:playAlbum('<?php echo $album_id;?>')"><img class="ftitle" src="images/play.gif" /></a>
				<a href="javascript:appendAlbum('<?php echo $album_id;?>')"><img class="ftitle" src="images/add.gif" /></a>
				<a><img class="ftitle download" rel="dl_songid" src="images/download.gif" /></a>
				<div class="download_types hidden" id="dl_songid"><a>MP3</a><br /><a>OGG</a><br /><a>Other</a></div>
				<div class="clear"></div>
				<a name="fb_share" type="button" share_url="www.250a.deweymusic.org" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>				
				<p class="curator">
					<?php 
						echo "<br/>";
						echo $postContent;
					?>
				</p>
			</div>
			<div class="yui-u">
				<img class="art" src="<?php echo $image_url?>" />
			</div>
		   </div>
		</div>
			<div class="yui-g">
				<div class="tabs">
					<ul>
						<li class="current"><a onclick="javascript: loadTab('1')">TOP RATED</a></li>
						<li class="tab_toselect"><a onclick="javascript: loadTab('2')">MOST PLAYED</a></li>
						<li class="tab_toselect"><a onclick="javascript: loadTab('3')">NEWEST</a></li>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		<div id="tabs_div">
			<div class="yui-gb">
	 	<?php
	 		$albums = getHighestRatedAlbums(9);
	 		$count=0;
	 		while($albumrow = mysql_fetch_array($albums)){
	 				if($count%3==0){
	 					echo '<div class="yui-u first entry">';
	 				}
	 				else{
	 					echo '<div class="yui-u entry">';
	 				}
	 				echo '<div class="add_play"><a href="javascript:playAlbum(\'';
	 				echo $albumrow[0];
	 				echo '\')"><img class="small" src="images/play.gif" /></a>';
	 				echo '<a href="javascript:appendAlbum(\'';
	 				echo $albumrow[0];
	 				echo '\')"><img class="small" src="images/add.gif" /></a></div>';
					echo '<h5><a href="javascript:loadContent(\'info.php?album=';
					echo $albumrow[0];
					echo '\')">';
					echo $albumrow[1];
					echo '</a></h5>';
					echo '<img class="star small" src="images/star.gif" /><p class="rating">';
					$rating = getRatingsForAlbum($albumrow[0]);
		  			while($ratingrow = mysql_fetch_array($rating)){
		  				echo $ratingrow[0];
		  			}
		  		echo '</p>';
					echo '</div>';
	 			if($count%3==2){
	 				echo '</div><div class="yui-gb">';}
	 			$count++;
	 		}
	 	?>
			</div>
		</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer2.php');
?>
