<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['msuccess']))
{
	$id=strtoupper($_SESSION['mid']);
	$query="select * from MESS where MESS_ID='".$id."'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$manager=$row['MESS_MGR'];
	$mess=$row['MESS_NO'];
	$contact=$row['MESS_CONTACT'];
	$name=$row['MESS_MGR'];
	//$query1="select * from COMMENTS where S_ID in (select ID from STUDENT where MESS_NO=(select MESS_NO from MESS where MESS_ID='$id'))";
	//echo $query1;
	//$comments=mysql_query($query1);
	//$row1=mysql_num_rows($comments);
	
	//print_r($comments);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Donate to NGO</title>
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
</head>
<body style="font-family: 'Raleway', sans-serif;">
<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container_menu">
			<ul>
				<li class="current_page_item"><a href="m_home.php">Profile</a></li>
				<li>
					<div class="dropdown">
					  <button3 class="dropbtn">UPDATE</button3>
					  <div class="dropdown-content">
					    <a href="m_update_menu.php">Update Menu</a>
					    <a href="m_update_holiday_list.php">Holiday List</a>
					  </div>
					</div>
				</li>
				<li><a href="vote_result.php">Voting Result</a></li>
				<li><a href="m_make_announcement.php">Announce</a></li>
				<li>
					<div class="dropdown">
					  <button3 class="dropbtn">MESS COMMITTEE</button3>
					  <div class="dropdown-content">
					    <a href="m_comettimembers.php">Current Mess Committee</a>
					    <a href="m_select_mess_committee.php">Select Mess Committee</a>
					  </div>
					</div>
				</li>
                <li><a href="m_todayattendies.php">Today's Attendees</a></li>
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
		<div id="content" style="background-image: url(images/ngo.jpg);  background-size: cover !important;" >
			<?php 
			$list=mysql_query("select * from STUDENT where ID not in (select ID from ABSENTEES where START_DATE<CURDATE() or END_DATE>CURDATE() ) and MESS_NO='$mess'");
			$rows=mysql_num_rows($list);
			$pm=0;
			for($r=0;$r<$rows;$r++)
			{
				$temp='memberp'.$r;
				if(isset($_POST[$temp]))
					$pm++;
			}
			?>
			<center>
			<h1 > <?php echo "<font color=red>Donate Food to NGO</font>"; ?></h1>
			<h2 style="color:#16a085"><b>Food equivalent for <?php echo $rows-$pm." members"; ?> is wasted.</h2>
			<br>
			
			</center>
			</div>
			
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<center><h2>NGO'S</h2></center>
				</div>
				<ul>
					<marquee style="height: 410px;" behavior="scroll" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
						<?php
						$q1=mysql_query("select * from NGO");
						$row1=mysql_num_rows($q1);
						for($i=0;$i<$row1;$i++)
						{
							$list=mysql_fetch_array($q1);
						?>
						<li>
							<span> <?php echo "<b>".$list['NAME'];  ?></span>
							
							<br>
							<span> <?php echo  "Contact:"." ".$list['CONTACT'];  ?></span>
						</li> 
						<br>
						<?php
						}
						?>
						</marquee>
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
		
		unset($_SESSION['msuccess']);
		session_destroy();
		header("location:index.php");
		exit;
} 

//unset($_SESSION['success']);
//session_destroy();
?>