<?php

function addUser($first_name,$last_name,$username,$password,$password_salt,$email)
{
preg_replace('@^([^\?]+)(\?.*)$@','',$username);
$emailFilter = filter_var($email,FILTER_SANITIZE_EMAIL);
$query = "INSERT INTO users (first_name, last_name, username, password, password_salt) VALUES ('$first_name','$last_name','$username','$password','$password_salt','$emailFilter')";
$result = mysql_query($query);
return $result;
}

function getUser($user_id)
{
$query = "SELECT first_name, last_name, username FROM users WHERE user_id = '$user_id'";
$result = mysql_query($query);

return $result;
}

function deleteUser($user_id)
{
$query = "DELETE FROM users WHERE id = '$user_id'";
$result = mysql_query($query);

return $result;
}

function updateUser($first_name,$last_name,$username,$pw,$user_id)
{
$query = "UPDATE users SET first_name = '$first_name', last_name =' $last_name', username = '$username', password='$pw' WHERE id = '$user_id'";
$result = mysql_query($query);

return $result;
}

?>