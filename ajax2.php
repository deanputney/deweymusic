<?php
session_start();
include('dbconnect.php');

$do = $_GET['do'];
switch($do) {
    case 'check_username_exists':
        if(get_magic_quotes_gpc()) {
            $username = $_GET['username'];
        }else{
            $username = addslashes($_GET['username']);
        }
        if($username)
         $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `username`='".$username."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        
        if((strlen($username) < 3) OR (strlen($username) > 15)){
			echo 'That username has invalid length.';				
		}
        else if($count > 0) {
            echo 'That username already exists.';
        }
        else{
            echo 'That username is available.';
        }

        echo '</result>';
    break;
    default:
        echo 'Error, invalid action';
    break;
    
    case 'check_email_exists':
        if(get_magic_quotes_gpc()) {
            $email = $_GET['email'];
        }else{
            $email = addslashes($_GET['email']);
        }
        
         $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `email`='".$email."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
      	
        if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email)){
		echo 'Invalid email';
		}
        else if($count > 0) {
            echo 'That email already exists.';
        }else{
            echo 'That email is available.';
        }
        echo '</result>';
    break;
    default:
        echo 'Error, invalid action';
    break;
    
    // for forgot password
    case 'check_lostusername_exists':
        if(get_magic_quotes_gpc()) {
            $username = $_GET['username'];
        }else{
            $username = addslashes($_GET['username']);
        }
        

        if($username)
         $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `username`='".$username."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        
        if($count > 0) {
            echo 'That username is valid :)';
        }else{
            echo 'That username does not exist :(';
        }

        echo '</result>';
    break;
    default:
        echo 'Error, invalid action';
    break;
    
    case 'check_lostemail_exists':
        if(get_magic_quotes_gpc()) {
            $email = $_GET['email'];
        }else{
            $email = addslashes($_GET['email']);
        }
        
         $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `email`='".$email."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
      	
        if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email)){
		echo 'Invalid email';
		}
        else if($count > 0) {
            echo 'That email is valid :)';
        }else{
            echo 'That email does not exist :(';
        }
        echo '</result>';
    break;
    default:
        echo 'Error, invalid action';
    break;
    
    // for changing password:
    
        case 'check_password1_exists':
        if(get_magic_quotes_gpc()) {
            $username = $_GET['username'];
        }else{
            $username = addslashes($_GET['username']);
        }
        

        if($username)
 //        $count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `username`='".$username."'"));
        header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
        
 		if(strlen($username) <3){
			echo 'That password is too short.';				
		}
		else{
			echo 'That password is valid';
			}

        echo '</result>';
    break;
    default:
        echo 'Error, invalid action';
    break;
    

    
    case 'check_oldpassword_exists':
        if(get_magic_quotes_gpc()) {
            $email = $_GET['email'];
        }else{
            $email = addslashes($_GET['email']);
        }
        
        $user = $_SESSION["username"];

		$getsignupdate = mysql_query("SELECT created_at FROM users WHERE username='$user'");
		$daterow = mysql_fetch_array($getsignupdate);
		$signupdate = $daterow['created_at'];

		$loginpost = $email;
		$pass = md5(md5($loginpost).$signupdate);

		$result=mysql_query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
		
		header('Content-Type: text/xml');
        header('Pragma: no-cache');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<result>';
		$rowCheck = mysql_num_rows($result);
		if($rowCheck == 1){
		echo('This is your current password :)');
 		}
		else{
			echo('This is not your password :(');
		}
        
        echo '</result>';

    break;
    default:
        echo 'Error, invalid action';
    break;

}



?> 