<?php
    $conn_error = 'Could not connect.';
    $host = 'localhost';
    $user = 'psadbms';
    $pass = 'dbms_project';
    $db = 'psadbms';
    if(!mysql_connect($host,$user,$pass) || !mysql_select_db($db))
    {
        die($conn_error);
    }
    else 
    {
        //echo "OK!";  
    }
?>