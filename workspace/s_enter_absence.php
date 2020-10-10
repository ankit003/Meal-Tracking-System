<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['success']))
{
	$id=strtoupper($_SESSION['sid']);
	$query="select * from STUDENT where ID='".$id."'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$mess=$row['MESS_NO'];
	$ann="select * from ANNOUNCEMENT where MESS_NO='$mess'";
	$annres=mysql_query($ann);
	$anncount=mysql_num_rows($annres);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enter Absence</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Raleway:400,200,500,600,700,800,300" rel="stylesheet" />
<link href="style4.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style>
/*styling for show menu table*/
#menu_table
{
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 90%;
    padding:auto;
}
#menu_table td, #menu_table th {
    border: 1px solid #ddd;
    padding: 8px;
}

#menu_table tr:nth-child(even){background-color: #f2f2f2;}

#menu_table tr:hover {background-color: #ddd;}

#menu_table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #1abc9c;
    color: white;
}
</style>
</head>
<body style="font-family: 'Raleway', sans-serif;">
<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container_menu">
			<ul>
				<li><a href="s_home.php">Profile</a></li>
				<li class="current_page_item"><a href="s_enter_absence.php">Register Absence</a></li>
				<li><a href="show_menu.php">Menu</a></li>
				<li>
					<div class="dropdown">
					  <button3 class="dropbtn">VOTE FOR MENU</button3>
					  <div class="dropdown-content">
					    <a href="s_menu_vote.php">Monthly Vote</a>
					    <a href="s_menu_rating.php">Rate today's Meal</a>
					  </div>
					</div>
				</li>
				<li><div class="dropdown">
					  <button3 class="dropbtn">MESS COMMITTEE</button3>
					  <div class="dropdown-content">
					    <a href="s_committee.php">Current Mess Committee</a>
					    <a href="mc_application.php">Apply for Committee</a>
					  </div>
					</div></li>
                <li><a href="s_comment.php">Give Suggesions</a></li>
                <li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		<!-- end #menu --> 
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1><a href="#">Meal Tracking System for Mess</a></h1>
			</div>
		</div>
	</div>
	</div>
	<div id="page" class="container">
		<div id="content">
			<div class="absence">
				<center>
				<?php 
				if($_GET['detail_flag'] == 'true')
				{
				?>
				<h4>YOUR ABSENCE LIST</h4>
				<form action="s_enter_absence.php" method="POST">
				<h4><button name="enter_absence" type="submit" class="button button2" style="float:center; position: relative; ">Enter Absence</button></h4>
				</form>
				
				<div style = "height: 354px; overflow-y: auto;">
				<table border="2" id="menu_table">
					<tr>
						<th>START DATE</th>
						<th>END DATE</th>
						<th>REFUND AMOUNT</th>
						<th>DELETE</th>
					</tr>
					
					<?php
					    $q = "select * from ABSENTEES where ID = '$id'";
					    $result = mysql_query($q);
					    $num_rows = mysql_num_rows($result);
					    //echo $num_rows;
						for($i=0;$i<$num_rows;$i++)
						{
							$row=mysql_fetch_array($result);
							$start_date=date_create($row['START_DATE']);
							$end_date=date_create($row['END_DATE']);
							$diff = date_diff($end_date,$start_date);
							$refund = $diff->days*100;
					?>	
							
							<tr>
							<td><?php echo date_format($start_date,"d-M-Y");?></td>
							<td><?php echo date_format($end_date,"d-M-Y");?></td>
							<td><p>&#8377 <?php echo $refund;?></p></td>
							<td><a href=<?php echo 'delete.php?id='.$id.'&start_date='.date_format($start_date,'Y-m-d').'&end_date='.date_format($end_date,'Y-m-d');?> class="material-icons">delete</a></td>
							</tr>
					<?php		
						}
					?>
				</table>
				</div>
				
				<?php
				}
				else {
				?>
				<h2>Register your Absence</h2>
				<form action="s_enter_absence.php" method="POST">
				<table cellpadding="5">
					<tr><th>FROM:</th><td><input type="date" name="date_from" min="<?php //echo date('Y-m-d', strtotime("+5 days"));?>"></td>
					<tr><th>TILL:</th><td><input type="date" name="date_till" min="<?php //echo date('Y-m-d', strtotime("+5 days"));?>"></td>
				</table>	
					<button name="submit" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">Submit</button><br>
					<br>
					<button name="absence_detail" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">My Absence Details</button>
				</form>
				<br><br><br><br><br><br>
				<?php
				}
					if(isset($_POST['submit']))
					{
						$date_from=$_POST['date_from'];
						$date_till=$_POST['date_till'];
						
						$q1 = "select * from ABSENTEES where ID = '$id' and ((START_DATE >= '$date_from' and START_DATE <= '$date_till') or (END_DATE >= '$date_from' and END_DATE <= '$date_till') or (START_DATE <= '$date_from' and END_DATE >= '$date_till'))";
						//echo $q1;
						$result1 = mysql_query($q1);
						if(mysql_num_rows($result1) != 0)							//check if any absence overlaps with current entry (which is not allowed)
						{
							echo "<font color=red>Your absence entry starting from : ".$date_from." to : ".$date_till." overlaps with a previous entry. Please check your absence details for more information.</font>";
							//exit;
						}
						if(!empty($date_from) && !empty($date_till) && mysql_num_rows($result1) == 0)
						{
							$date1 = date_create($date_from);
							$date2 = date_create($date_till);
							$diff = date_diff($date2,$date1);
							if($diff->days < 4)
							{
								echo "<font color=red>Absence not registered. Absence interval must be greater than atleast 4 days.</font>"; //echo $diff->days;
								/*$message = "Absence not registered. Absence interval must be greater than atleast 4 days.";
								echo "<script type='text/javascript'>alert('$message');</script>";*/
							}
							else
							{
								$query = "insert into ABSENTEES(ID,START_DATE,END_DATE) values('$id','$date_from','$date_till')";
								$result = mysql_query($query);
								if(!empty($result))
								{
									echo "<font color=green>Your absence detail from : ".$date_from." to : ".$date_till." has been recorded.<font color=red>";
								}
							}
						}
						else if(empty($date_from) || empty($date_till)){
							echo "<font color=red>Please specify the starting & ending dates of your absence schedule.</font>";
						}
					}
					if(isset($_POST['absence_detail']))								//redirect to same page and set a GET Global 
					{
						header('location: s_enter_absence.php?detail_flag=true');
					}
				?>
				<br><br><br>
				<?php 
					if($_GET['detail_flag'] != 'true')
					{
				?>
				<h6 style="font-size: 14px; position: absolute;">Note: Absence interval specified must be greater than 4 days.</h6><br>
				<h6 style="font-size: 14px; position: absolute;">Also note that you will be refunded only for absence dates not conflicting with holidays.</h6>
				<?php 
					}
				?>
				</center>
			</div>
			
		</div>
		
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<center><h2>Announcement</h2></center>
				</div>
				<ul>
					<marquee style="height: 410px;" behavior="scroll" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
						<li>
							<?php
							for($i=0;$i<$anncount;$i++)
							{
							$row1=mysql_fetch_array($annres);
							?> 
							<span><?php echo $row1['DATE'];  ?></span>
							<h4> <?php echo $row1['HEADING']; ?>  </h4>
							<p>
								 <?php echo $row1['ANNOUNCEMENT']   ?>
							</p>
						</li> 
						<?php
						}     
						?>
				</marquee>	
				</ul>
			</div>
		</div>
	</div>
</div>
	

<div id="footer-wrapper">
	<div id="footer" class="container">
		<div id="box1">
			<div class="title">
				<h2>Developed By - </h2>
			</div>
			<ul class="style1">
				<li>Prince</li>
                <li>Shashank</li>
                <li>Ankit</li>
			</ul>
		</div>
		<div id="box2">
			<div class="title">
                <h2>Contact Us</h2>
			</div>
			<ul class="style1">
				<li>Mobile Number</li>
			</ul>
		</div>
		<div id="box3">
			<div class="title">
				<h2>Follow Us</h2>
			</div>
			<ul class="contact">
				<li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>
				<li><a href="#" class="icon icon-facebook"><span>Facebook</span></a></li>
				<li><a href="#" class="icon icon-dribbble"><span>Dribbble</span></a></li>
				<li><a href="#" class="icon icon-tumblr"><span>Tumblr</span></a></li>
				<li><a href="#" class="icon icon-rss"><span>Pinterest</span></a></li>
            </ul>
		</div>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Meal Tracking System for Mess. All rights reserved. | Designed & Developed by PSA.</p>
</div>
</body>
</html>
<?php
}
else
{
		unset($_SESSION['success']);
		session_destroy();
		header("location:index.php");
		exit;
}
?>