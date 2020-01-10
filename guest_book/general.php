<?php
	$config = include_once('config.php');
	$dbConfig = $config['database'];
	$GLOBALS['dbLink'] = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['db_name']);