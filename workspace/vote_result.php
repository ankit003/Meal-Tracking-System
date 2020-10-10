<?php
session_start();
include "db_connect.php";
$day=array('FRI','MON','SAT','SUN','THU','TUES','WED');
if(isset($_SESSION['msuccess']))
{
	$mid=strtoupper($_SESSION['mid']);
	$q="select * from MESS where MESS_ID='$mid'";
	$result=mysql_query($q);
	$row=mysql_fetch_array($result);
	$mess=$row['MESS_NO'];
//	echo $mess;
	$query="select * from STU_VOTE where ID in (select ID from STUDENT where MESS_NO='$mess') ";
	$result=mysql_query($query);
	$n1=mysql_num_rows($result);
//	echo $n1;
	$query="select * from MENU where MESS_NO='$mess'";
	$result=mysql_query($query);
//	$rows=mysql_num_rows($result);
	$q="select * from VOTE_MENU where MESS_NO='$mess'";
	$r=mysql_query($q);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monthly Voting Result</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Raleway:400,200,500,600,700,800,300" rel="stylesheet" />
<link href="style4.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
				<li ><a href="m_home.php">Profile</a></li>
				<li>
					<div class="dropdown">
					  <button3 class="dropbtn">UPDATE</button3>
					  <div class="dropdown-content">
					    <a href="m_update_menu.php">Update Menu</a>
					    <a href="m_update_holiday_list.php">Holiday List</a>
					  </div>
					</div>
				</li>
				<li>
					<div class="dropdown">
					  <button3 class="dropbtn">VOTING RESULT</button3>
					  <div class="dropdown-content">
					    <a href="vote_result.php">MONTHLY VOTE RESULT</a>
					    <a href="m_show_menu_rating.php">DAILY VOTE RESULT</a>
					  </div>
					</div>
				</li>
				<li><a href="m_make_announcement.php">Announce</a></li>
				<li><div class="dropdown">
					  <button3 class="dropbtn">MESS COMMITTEE</button3>
					  <div class="dropdown-content">
					    <a href="m_comettimembers.php">Current Mess Committee</a>
					    <a href="m_select_mess_committee.php">Select Mess Committee</a>
					  </div>
					</div></li>
                <li><a href="s_comment.php">Today's Attendees</a></li>
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
	<div id="page" class="container" >
		<div id="content" style="width:100%;height:600px">
			<center>
			<h3>MONTHLY VOTING RESULT</h3>
			<table border="2" id="menu_table">
				<tr>
					<th>DAYS</th>
					<th>BREAKFAST</th>
					<th>LUNCH</th>
					<th>SNACKS</th>
					<th>DINNER</th>
				</tr>
				<?php
					for($i=0;$i<7;$i++)
					{
						$row=mysql_fetch_array($result);
						$temp=mysql_fetch_array($r);
				?>	
						
						<tr>
						<td><?php echo $day[$i];?></td>
						<td><?php echo $row['BREAKFAST'];?><br><?php if($n1!=0)$t=round((($temp['BREAKFAST']+$n1)/$n1)*50);if($n1==0) echo "0%";elseif($t<50)echo"<font color='red'>". $t."%</font>";else echo"<font color='green'>". $t."%</font>"; ?>
						<td><?php echo $row['LUNCH'];?><br><?php if($n1!=0)$t=round((($temp['LUNCH']+$n1)/$n1)*50);if($n1==0) echo "0%";elseif($t<50)echo"<font color='red'>". $t."%</font>";else echo"<font color='green'>". $t."%</font>"; ?>
						<td><?php echo $row['SNACKS'];?><br><?php if($n1!=0)$t=round((($temp['SNACKS']+$n1)/$n1)*50);if($n1==0) echo "0%";elseif($t<50)echo"<font color='red'>". $t."%</font>";else echo"<font color='green'>". $t."%</font>"; ?>
						<td><?php echo $row['DINNER'];?><br><?php if($n1!=0)$t=round((($temp['DINNER']+$n1)/$n1)*50);if($n1==0) echo "0%";elseif($t<50)echo"<font color='red'>". $t."%</font>";else echo"<font color='green'>". $t."%</font>"; ?>
						
				<?php		
					}
				?>
			</table>
			</center>
								
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
		
		unset($_SESSION['msuccess']);
		session_destroy();
		header("location:index.php");
		exit;
} 

//unset($_SESSION['loggged_in']);
//session_destroy();*/
?>