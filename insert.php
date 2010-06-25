<?php
session_start();
include('dbconnect.php');

$time = date('Y-m-d H:i:s', strtotime("now"));
$username = mysql_escape_string($_POST['username']);
$password = md5(md5($_POST['password']).$time); 
$email = mysql_escape_string($_POST['email']);
$todo = mysql_escape_string($_POST['todo']);

if(isset($todo) and $todo=="post"){


if((strlen($username) == 0) OR (strlen($email) == 0) OR (strlen($password) == 0)){
	
	print "<script language=\"JavaScript\">";
	print "window.location = 'index.php' ";
	print "</script>";
	exit;
}

$status = "OK";
$msg="";
$added = "false";

if(mysql_query("INSERT INTO users (username, first_name, email, password, created_at)
	VALUES
	('$username','$username','$email','$password','$time')")){
//		echo "<font face='Verdana' size='2' color=black>Welcome, You have successfully signed up :) </font>";
		$_SESSION["username"]=$username;
		$_SESSION["name"]=$username;
		$added = "true";		
		$result=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
		$row = mysql_fetch_array($result);
		$_SESSION["userid"] = $row['id'];
		
// Welcome Email (: (:
		$to      = $email;
		$subject = 'Welcome to Dewey Music!';
		
		//message sending
		$message = "Dean Putney rocks your socks, Welcome to Dewey Music, where you can browse through individual songs, download albums or songs, and listen to live concerts - all from archive.org! \n\n\n  Enjoy! -Dean Putney
		
		
		$headers = 'From: Deweymusic.org' . "\r\n" .
    	'Reply-To: deweymusic@gmail.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		
	if($rowCheck > 0){
		$userrow = mysql_fetch_array($result);
  		$_SESSION["userid"]=$userrow['id'];
  	}
  }
else{ 
	echo "Database Problem, please contact Site admin";
			echo mysql_error();
	}


	$insert = "true";
	}
	include('includes/header.php');?>
<?php
include('functions/PlaylistFunctions.php');
include_once('functions/Featured.php');


$playlistQuery = getUserPlaylists($_SESSION["userid"]);

?>
	<div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
		  <div class="featured user">
				<h1 class="ftitle">
						
				<? if($added == "true"){?>
					
					Welcome to Dewey Music <? echo($_SESSION["name"]); ?></h1> 
					
				<? }else{
				?> Welcome Back, <? echo($_SESSION["name"]); ?></h1> <? } ?>  
				
				<p><a class="change" href="changepass.php"> change password </a></p>
				<div class="clear"></div>
				<h3>Your playlists are right where you left them...</h3>
        <?php
        
        if($playlistQuery && mysql_num_rows($playlistQuery)){
          echo "<table id='tracklist' class='user'>";
          $count=0;
          while($playlist = mysql_fetch_assoc($playlistQuery)){
          	if(count%2==0){
          		echo '<tr class="odd">'; 
          	}
          	else{
          		echo '<tr>';
          	}
            echo '<td class="load"><a class="button" href="javascript:loadContent(\'playlist.php?playlist=';
            echo $playlist["id"];
            echo '\')">LOAD</a>';
            echo '<td class="playlist">';
            echo $playlist["name"];
            
            echo '</td><td class="view"><a class="viewtrack" href="javascript:loadContent(\'playlist.php?playlist=';
            echo $playlist["id"];
            echo '\')"> VIEW TRACKS</a></td></tr>';
          }
          echo "</table>";
          echo '<td class = "featured">';
          echo "<!-- Recommended -->";
          echo "</td>";
        }
        
        
        else
        {
        echo "You don't have any playlists saved... start browsing!";
/*
       	echo "Dewey Recommends....."
       	
       	
       	
       	$myQuery = 
       	include('featured.php')
       	mysql_fetch_assoc($myQuery)
*/
       	
       	
        }

        ?>
		   </div>
		</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>



