<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['success']))
{
	$id=strtoupper($_SESSION['sid']);
	$query="select * from STUDENT where ID='".$id."'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$name=$row['FNAME'];
	$lname = $row['LNAME'];
	$branch=$row['BRANCH'];
	$mess=$row['MESS_NO'];
	$email = $row['EMAIL'];
	$contact = $row['CONTACT'];
	$balance = $row['BALANCE'];
	$ann="select * from ANNOUNCEMENT where MESS_NO='$mess'";
	
	$annres=mysql_query($ann);
	$anncount=mysql_num_rows($annres);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Home</title>
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
				<li class="current_page_item"><a href="s_home.php">Profile</a></li>
				<li><a href="s_enter_absence.php">Register Absence</a></li>
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
			<div class="pic"  id="info1">
				<img src="uploads/<?php echo $id.'.jpeg';?>" style=" max-width: 100%;max-height: 100%;height:150px;width:150px;border-radius:10px">
				<h2><?php echo" ".$name." ".$lname;?></h2>
			</div>
			
			<div class="w3-display-container">
              <!--<img src="/w3images/avatar_hat.jpg" style="width:100%" alt="Avatar">-->

            </div>
            <div class="w3-container" id="info">
              <p><i class="fa fa-id-badge fa-fw w3-margin-right w3-large w3-text-teal"></i><b>ID : </b><?php echo " ".$id;?></p>
              <p><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-large w3-text-teal"></i><b>BRANCH : </b><?php echo" ". $branch;?></p>
              <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><b>MESS : </b><?php echo " ".$mess;?></p>
              <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><b>EMAIL : </b><?php echo " ".$email;?></p>
              <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><b>CONTACT : </b><?php echo " ".$contact;?></p>
              <p><i class="fa fa-money fa-fw w3-margin-right w3-large w3-text-teal"></i><b>BALANCE : </b><?php echo " ".$balance;?></p>
              <a href="s_update_info.php"><button class="button button2">UPDATE INFO</button></a>
              <hr>
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

//unset($_SESSION['success']);
//session_destroy();
?>