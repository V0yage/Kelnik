<?php
	include_once('general.php');
	
	$name = htmlspecialchars($_POST['name']);
	$text = htmlspecialchars($_POST['text']);
	
	$insertResult = mysqli_query($dbLink, "INSERT INTO posts(name, text) VALUES('$name', '$text')");
	
	$lastRecordId = mysqli_insert_id($dbLink);
	$lastRawRecord = mysqli_query($dbLink, "SELECT * FROM posts WHERE id='$lastRecordId'");
	$lastRecord = mysqli_fetch_assoc($lastRawRecord);
	
	if ($insertResult) {
		echo json_encode($lastRecord);
	}