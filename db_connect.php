<?php
function dbConnect()
{
	$dbHost = "localhost";
	$dbName = "projectdatabase";
	$dbUser = "root";
	$dbPass = "";

	if(!($conn=mysqli_connect($dbHost, $dbUser, $dbPass)))
	{
		echo "Error on connect.";
	}
	else
	{
		if(!(mysqli_select_db($conn, $dbName)))
		{
			echo mysqli_error();
			echo "error on database connection. Check your settings.";
		} 
		else 
		{
			return $conn;
		}
	}
}
?>