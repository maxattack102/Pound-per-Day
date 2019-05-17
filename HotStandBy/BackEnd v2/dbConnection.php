<?php
    //Establishes connection to MySQL database
    function dbConnection(){
        
        $hostname  = "localhost"; // 192.168.2.142
        $username  = "daniel";
        $password  = "danielit490";
        $dbname    = "poundperday";
        
        $connection = mysqli_connect($hostname, $username, $password, $dbname);
        
        if (!$connection){
            echo "Error connecting to database -HotStanBy: ".$connection->connect_errno.PHP_EOL;
            exit(1);
        }
        //echo "Connection established to database".PHP_EOL;
        return $connection;
    }
?>
