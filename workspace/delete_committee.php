<?php 
    session_start();
    include "db_connect.php";
    echo "DELETING ABSENCE FROM DATABASE...<br><br>";
    $id = strtoupper($_GET['id']);
	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];
    //echo $id;
    echo gettype($start_date);
    echo gettype($end_date);
    $query = "delete from MESS_COMMITTEE where S_ID='$id'";
    $result = mysql_query($query);
    if($result)
    {
        echo "Success";
        header('location: m_comettimembers.php?detail_flag=true');
    }
    else
    {
        echo "Unsuccessful";
    }
    //echo STR_TO_DATE($end_date,'%Y-%m-%d')
?>