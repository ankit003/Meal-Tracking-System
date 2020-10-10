<?php 
    session_start();
    include "db_connect.php";
    echo "DELETING ABSENCE FROM DATABASE...<br><br>";
    $id = $_GET['id'];
    //$start_date = date('Y-m-d',strtotime($_GET['start_date']));
    //$end_date = date('Y-m-d',strtotime($_GET['end_date']));
    //$start_date1 = $_GET['start_date'];
    //$end_date1 = $_GET['end_date'];
    //$start_date=date_create($start_date1);
	//$end_date=date_create($start_date1);
	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];
    //echo $id;
    echo gettype($start_date);
    echo gettype($end_date);
    $query = "delete from ABSENTEES where ID = '".$id."' && START_DATE = '".$start_date."' && END_DATE = '".$end_date."'";
    $result = mysql_query($query);
    if($result)
    {
        echo "Success";
        header('location: s_enter_absence.php?detail_flag=true');
    }
    else
    {
        echo "Unsuccessful";
    }
    //echo STR_TO_DATE($end_date,'%Y-%m-%d')
?>