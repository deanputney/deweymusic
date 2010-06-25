<?php include('includes/header.php'); ?>
<?php include_once('dbconnect.php'); ?>
<?php include_once('functions/Genres.php'); ?>
<?php include_once('functions/Artists.php'); ?>
	<div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
			<h4>BROWSE ALL MUSIC</h4>
		</div>
		<div class="yui-gb">
			<div class="yui-u first">
				<ul class="browse_list" id="first">
					<li class="current"><a onclick="javascript: loadArtists('0')">ALL GENRES</a></li>
					<?php
						$genres = getGenres();
						$count = 0;
						if(mysql_num_rows($genres) <= 0) 							{
           					 echo '';
       					 }
						else{
							while($genrerow = mysql_fetch_assoc($genres)){
						$artistnum = getArtistsByGenre($genrerow["id"]);
						
						if(mysql_num_rows($artistnum)>5){
						
            				if($count%2==0){
								echo '<li class="to_select odd">';
							}
							else{
								echo '<li class="to_select">';
							}
						echo '<a onclick="javascript: loadArtists(';
						echo $genrerow["id"];
						echo ')">';
						echo $genrerow["name"];
						echo '</a>';
						echo '</li>';
						$count = $count + 1;
						}
		}
        }

					?>
				</ul>
			</div>
			<div class="yui-u">
				<ul class="browse_list" id="second">
					<?php
						$artists = getAllArtists();
						$count = 0;
						if(mysql_num_rows($artists) <= 0) 							
						{
           					 echo '';
       					}
						else
						{
							while($artistrow = mysql_fetch_assoc($artists)){
            					if($count%2==0){
								echo '<li class="to_select">';
							}
							else{
								echo '<li class="to_select odd">';
							}
								echo '<a onclick="javascript: loadAlbums(';
								echo $artistrow["id"];
								echo ')">';
								echo $artistrow["name"];
								echo '</a>';
								echo '</li>';
								$count = $count + 1;
							}
						}
        

					?>
				</ul>
			</div>
			<div class="yui-u">
				<ul class="browse_list" id="last">
				</ul>
			</div>
		</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>

