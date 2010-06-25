	
<div class="yui-b">
	<div id="playlist">
		<ul id="play_buttons">
			<li class="rw"></li>
			<li id="playPauseButton" class="pp"></li>
			<li class="ff"></li>
		</ul>
		<div class="clear"></div>
		<div id="songInfo"></div>
		<h6>Playlist</h6>
		<a class="clearPlaylist">Clear Playlist</a><br>
		<?php 
		if(isset($_SESSION['userid'])){
			echo '<a class="save">Save Playlist</a>';
		}else {
			echo '<a class="notsave">Login to save playlists</a>';
		}
		?>
	
		<ol id="playlistList">
			<!--- <li><label>Freak Out - 311</label><em>i</em><a href='javascript:deleteSong('1')'><img src="images/delete.gif"></a></li> -->
		</ol>
		<hr />
	</div>
	
	<div class="sidebar_box">
		<h6>About Dewey</h6>
		DeweyMusic is a new interface for <a href="http://www.archive.org" target="_blank">Archive.org</a>'s wonderful public domain music library. <br/><br/>You can listen to, download, remix, and share anything you see on this site legally and for free.
	</div>
</div>
	
</div>
