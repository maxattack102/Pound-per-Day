<?php
/*	session_start();

	$servername = "localhost";
	$username   = "daniel";
	$password   = "danielit490";
	$dbname     = "poundperday";

	
	$conn = new mysqli($servername, $username, $password);
	
	
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
	
	// select database
	$db_selected = mysql_select_db('foo', $conn);
	if (!$db_selected)
	{
		die ('Can\'t use foo : ' . mysql_error());
	}

*/

    //Establishes connection to MySQL database
    function dbConnection(){
        
        $hostname  = "127.0.0.1";
        $username  = "daniel";
        $password  = "danielit490";
        $dbname    = "poundperday";
        
        $connection = mysqli_connect($hostname, $username, $password, $dbname);
        
        if (!$connection){
            echo "Error connecting to database: ".$connection->connect_errno.PHP_EOL;
            exit(1);
        }
        //echo "Connection established to database".PHP_EOL;
        return $connection;
    }

?>
