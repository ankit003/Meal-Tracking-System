<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['msuccess']))
{
	$id=strtoupper($_SESSION['mid']);
		
	$temp=mysql_query("select * from MESS where MESS_ID='$id'");	
	$row=mysql_fetch_array($temp);
	$mess=$row['MESS_NO'];
		
	$query1="select * from COMMENTS where S_ID in (select ID from STUDENT where MESS_NO=(select MESS_NO from MESS where MESS_ID='$id'))";
	$comments=mysql_query($query1);
	$row2=mysql_num_rows($comments);
?>
<?php
if(isset($_POST['comment']))
{
	$description=$_POST['comment'];
	$heading=$_POST['heading'];
	$query="insert into ANNOUNCEMENT values ('$mess',NOW(),'$heading','$description')";
	//echo $query;
	if(mysql_query($query)){
	$flag=1;
	}
	else
		$error=1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Announcement</title>
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
				<li  class="current_page_item"><a href="m_make_announcement.php">Announce</a></li>
				<li><div class="dropdown">
					  <button3 class="dropbtn">MESS COMMITTEE</button3>
					  <div class="dropdown-content">
					    <a href="m_comettimembers.php">Current Mess Committee</a>
					    <a href="m_select_mess_committee.php">Select Mess Committee</a>
					  </div>
					</div></li>
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
		<div id="content">
			<div class="featured">
				<div>
					<center>
						<br>
					     <br>
					     <form action="m_make_announcement.php" id="usrform" method="post">
					     Enter Heading:
					     <input type="text" name="heading" placeholder="Write headind here..." required>
					     <br>
						 Enter Announcement:
						 <br>
						 <br>
						<textarea rows="4" cols="50"  name="comment" form="usrform" placeholder="Write Description here" required></textarea>
						
						 <br>
						  <button class="button button2" type="submit" form="usrform" value="Submit" >Submit</button>
						</form>
						<br>
						<?php
						if($flag==1){
							echo"<font color='Green'>Announcement has been successfully Posted !!!</font>";
						}
						?>
					</center>
				</div>
			</div> 
		</div>
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<center><h2>COMMENTS</h2></center>
				</div>
				<ul>
					<marquee style="height: 410px;" behavior="scroll" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
						<?php
						for($i=0;$i<$row2;$i++)
						{
							$list=mysql_fetch_array($comments);
						?>
						<li>
							<span> <?php echo $list['S_ID'];  ?></span>
							
							<?php
								$tempname=$list['S_ID'];
								$name=mysql_query("select * from STUDENT where ID='$tempname'"); 
								$namerow=mysql_fetch_array($name);
							?>
							<br>
							<span> <?php echo  $namerow['FNAME']." ".$namerow['LNAME'];  ?></span>
							<h4> <?php  echo $list['ABOUT']; ?>      </h4>
							<p>
								<?php echo $list['COMMENT'];  ?>
							</p>
						</li> 
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
//echo $query;	
}
else
{
		
		unset($_SESSION['msuccess']);
		session_destroy();
		header("location:index.php");
		exit;
} 
?>