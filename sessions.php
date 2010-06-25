<html>
<body>



<?php



$db = mysql_connect("localhost", "haydent", "taitan5") or die ("Error connecting to database."); 

if($db)
echo "good ";

echo "Hello World";



mysql_select_db("67250_A");


mysql_query("INSERT INTO albums (id, title, subject, artist_id, art, description, venue_id, source, license_url, uploader_email, taper_name, transferer_name, created_at, modified_at)
VALUES ('this is the id (not an int)', 'this is the title', 'subject', 'this is not an int', 'art', 
'description is extremely extremely extremely long to the point in which it might go past the amount allocated
to this amount the brown fox jumped over the lazy dog the brown fox jumped over the lazy dog END','venue ID is not an int', 'source', 'license12345', 'myuploader@gmail.com', 'los123er', 'transferring99', '1234-12-12 23:22:10', 'asdf')");

mysql_query("INSERT INTO albums (id, title, subject, artist_id, art, description, venue_id, source, license_url, uploader_email, taper_name, transferer_name, created_at, modified_at)
VALUES ('this is the id (not an int)', 'this is the title', 'subject', 'this is not an int', 'art', 
'description is extremely extremely extremely long to the point in which it might go past the amount allocated
to this amount the brown fox jumped over the lazy dog the brown fox jumped over the lazy dog END','venue ID is not an int', 'source', 'license12345', 'myuploader@gmail.com', 'los123er', 'transferring99', '1234-12-12 23:22:10', 'asdf')");

mysql_query("INSERT INTO artists (id, name, genre_id, created_at, modified_at)
VALUES ('NOT ANT INT', 'myusername12355', 'not an int 123 INPUT','TIMESTAMP INPUT','12/23/1990')");

mysql_query("INSERT INTO users (first_name, last_name, username, password, password_salt)
VALUES ('IDENTICAL INPUT', 'IDENTICAL INPUT', 'IDENTICAL INPUT','IDENTICAL INPUT','OH YEAAAH')");

mysql_query("INSERT INTO users (first_name, last_name, username, password, password_salt)
VALUES ('IDENTICAL INPUT', 'IDENTICAL INPUT', 'IDENTICAL INPUT','IDENTICAL INPUT','OH YEAAAH')");

mysql_query("INSERT INTO users (first_name, last_name, username, password, password_salt)
VALUES ('IDENTICAL INPUT', 'IDENTICAL INPUT', 'IDENTICAL INPUT','IDENTICAL INPUT','OH YEAAAH')");

mysql_query("INSERT INTO users (first_name, last_name, username, password, password_salt)
VALUES ('IDENTICAL INPUT', 'IDENTICAL INPUT', 'IDENTICAL INPUT','IDENTICAL INPUT','OH YEAAAH')");

?>

<html>
<body>

<form action="insert.php" method="post">
Firstname: <input type="text" name="first_name" />
Lastname: <input type="text" name="last_name" />
Username: <input type="text" name="username" />
Password: <input type="text" name="password" />
<input type="submit" />
</form>

</body>
</html> 

<?php
//Username Stored for logging
define("USER", "user");

// Password Stored
define("PASS", "123456");

// Normal user section - Not logged ------
        if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
            {
                // Section for logging process -----------
                $user = trim($_REQUEST['username']);
                $pass = trim($_REQUEST['password']);
                if($user == USER && $pass == PASS)
                    {
                        // Successful login ------------------
                       
                        // Setting Session
                        $_SESSION['user'] = USER;
                       
                        // Redirecting to the logged page.
                        header("Location: index.php");
                    }
                else
                    {
                        // Wrong username or Password. Show error here.
                       
                    }
               
            }
?> 

</body>
</html> 