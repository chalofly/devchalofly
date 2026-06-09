<?php
ob_start();
session_start();
function db() {
	static $conn;
		if ($conn===NULL){ 
			$servername = "localhost";
			$username = "chalofly_chalofly";
			$password = "admin@3214";
			$dbname = "chalofly_chalofly";
			$conn = mysqli_connect($servername, $username, $password, $dbname);
		}
	return $conn;
}
date_default_timezone_set('Asia/Calcutta');



?>