<?php

function insertReview($album_id,$user_id,$subject,$body)
{
$query = "INSERT INTO reviews (album_id, user_id, subject, body) VALUES('$album_id','$user_id','$subject','$body')";
$result = mysql_query($query);
return $result;
}

function getReview($review_id)
{
$query = "SELECT album_id, user_id, subject, body FROM reviews WHERE id='$review_id'";
$result = mysql_query($query);
return $result;
}

function getAlbumReviews($album_id)
{
$query = "SELECT album_id, user_id, subject, body FROM reviews WHERE album_id='$album_id'";
$result = mysql_query($query);
return $result;
}

function deleteReview($id)
{
$query = "DELETE FROM reviews WHERE id = '$id'";
$result = mysql_query($query);
return $result;
}
?>