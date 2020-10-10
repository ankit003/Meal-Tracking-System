<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['success']))
{
	$id=strtoupper($_SESSION['sid']);
	$b = $l = $s = $d = 0;
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
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container_menu">
			<ul>
				<li><a href="s_home.php">Profile</a></li>
				<li class="current_page_item"><a href="s_enter_absence.php">Register Absence</a></li>
				<li><a href="show_menu.php">Menu</a></li>
				<li><a href="s_menu_vote.php">Vote for Menu</a></li>
				<li><a href="mc_application.php">Mess Committee</a></li>
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
				<h2>Register your Absence</h2>
				<form action="s_enter_absence.php" method="POST">
				<table cellpadding="5">
					<tr><th>DATE:</th><td><input type="date" name="date"  required ></td>
					<tr><th>TIME:</th><td><input type="checkbox" name="breakfast" value=1 >breakfast<tr><td></td><td><input type="checkbox" name="lunch" value=1>lunch</td><tr><td></td><td><input type="checkbox" name="snacks" value=1>snacks</td><tr><td></td><td><input type="checkbox" name="dinner" value=1>dinner</td>
				</table>	
					<button name="submit" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">Submit</button><br>
					<br>
					<button name="cancel_absence" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">Cancel Absence</button>
				</form>
				<br><hr><br><br><br><br>
				<?php
					if(isset($_POST['submit']))
					{
						$b=$_POST['breakfast'];
						$l=$_POST['lunch'];
						$s=$_POST['snacks'];
						$d=$_POST['dinner'];
						$date=$_POST['date'];
						/*echo "updated"; echo $b; echo $l; echo $s; echo $d; echo $date;*/
						$q1 = "select * from ABSENTEES where ID = '$id' and DATE = '$date'";
						$result1 = mysql_query($q1);
						if(mysql_num_rows($result1) != 0)							//check if entry with same ID & DATE exists (which is not allowed)
						{
							echo "You have already entered absence for ".$date.". Please cancel your absence for the given date first and try again.";
							exit;
						}
						if($b == 1 || $l == 1 || $s == 1 || $d == 1)
						{
							$query = "insert into ABSENTEES(ID,DATE,BREAKFAST,LUNCH,SNACKS,DINNER) values('$id','$date','$b','$l','$s','$d')";
							$result = mysql_query($query);
							if(!empty($result))
							{
								echo "Your upcoming absence for ".$date." has been saved.";
							}
						}
						else {
							echo "Please select atleast one meal you wish to be absent for.";
						}
					}
					if(isset($_POST['cancel_absence']))
					{
						$date = $_POST['date'];
						$q1 = "select * from ABSENTEES where ID = '$id' and DATE = '$date'";
						$result1 = mysql_query($q1);
						if(mysql_num_rows($result1) > 0)							//check if entry with same ID & DATE exists (which must satisfy)
						{
							$query = "delete from ABSENTEES where ID = '$id' and DATE = '$date'";
							mysql_query($query);
							if(mysql_affected_rows() > 0)
							{
								echo "Your absence for ".$date." has been cancelled.";
							}
						}
						else {
							echo "You have not entered absence for ".$date." yet.";
						}
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