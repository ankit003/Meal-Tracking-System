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
<title>Apply for Committee</title>
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
				<li><a href="s_home.php">Profile</a></li>
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
		<div id="content" style="overflow:scroll;padding:30px;">
		 
					<h2>Fill out given form to apply to Mess Committee</h2><br> 
				
					<form method="POST">
				    <h3>1. Previous experience in mess comettiee</h3>
				    
				    <div>
				        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="4" />
				        <label for="question-1-answers-A"> 2 years </label>
				    </div>
				    
				    <div>
				        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="3" />
				        <label for="question-1-answers-B"> 1 year</label>
				    </div>
				    
				    <div>
				        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="1" checked="checked"  />
				        <label for="question-1-answers-C"> no experience</label>
				    </div>
				    
				    <br>
				    <h3>2. Why do you want to join Mess comettiee</h3>
				    
				    <div>
				        <input type="radio" name="question-2-answers" id="question-2-answers-A" value="4" />
				        <label for="question-1-answers-A"> U want to make good changes</label>
				    </div>
				    
				    <div>
				        <input type="radio" name="question-2-answers" id="question-2-answers-B" value="3"  />
				        <label for="question-1-answers-B"> beacuse u are currently a member</label>
				    </div>
				    
				    <div>
				        <input type="radio" name="question-2-answers" id="question-2-answers-C" value="1" checked="checked"  />
				        <label for="question-1-answers-C"> Just for interest</label>
				    </div>
				    
				    
				    
				    <br>
				    
				    <h3>3. what is your Cgpa (must be greater then 4.5)</h3>
				    <input type="text" name="cgpa" placeholder="Write here..." required style="float:left;">
				    <br>
				    <br><br><br>
				    <center>
				    <button name="submit" type="submit" class="button button2" value="1">Apply</button></center>
					</form>
					
			<?php
			if(isset($_POST['submit']))
			{
				if($_POST['cgpa']>4.5 && $_POST['cgpa']<=10.0)
				{
				$chk=mysql_query("select ID from MC_APPLICATIONS where ID='$id'");
				if(mysql_num_rows($chk)!=0)
				{
					echo "<font color=red>You have already applied...</font>";
					//header( "refresh:5;url=s_home.php" );
				}
				else{
				echo "<font color=green>you have successfully Applied</font>";
				$score=$_POST['question-2-answers']+$_POST['question-1-answers']+$_POST['cgpa'];
				$des1='Interest in Mess comettiee';
				$des2='No Experience';
				if($_POST['question-2-answers']==4)
					{$des2='Want to make changes';}
				elseif ($_POST['question-2-answers']==3) {
					$des2='Previous Member';
				}
				if($_POST['question-1-answers']==4)
					{$des2="2 Years Experience";}
				elseif ($_POST['question-1-answers']==3) {
					$des2="1 Year Experience";
				}
				$des11=mysql_real_escape_string($des1);
				$des12=mysql_real_escape_string($des2);
				$cg= $_POST['cgpa'];
				mysql_query("insert into MC_APPLICATIONS values ('$id','$score','$des11','$des12','$cg')");
				//header( "refresh:5;url=s_home.php" );
				}
				}
				else
				{
					echo "<font color=red><br>Cgpa is not valid</font>";
				}
			}
			?>
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

//unset($_SESSION['loggged_in']);
//session_destroy();
?>