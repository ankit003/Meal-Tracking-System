<?php
session_start();
include "db_connect.php";
if(isset($_SESSION['success']))
{
	$sub=0;
	$id=strtoupper($_SESSION['sid']);
	if($flag!=1 && isset($_POST['update']))
	{
		$type=$_FILES['myfile']['type'];
		if($type=='image/png' or $type=='image/jpeg' or $type=='image/jpg' )
		{
			$tmpfile=$_FILES['myfile']['tmp_name'];
			$location="uploads/".$id;
			move_uploaded_file($tmpfile,$location.".jpeg");
			$flag=0;
			$sub=1;
		}
		else
			echo '<center><font color="red">ERROR....UPLOAD .JPEG OR .PNG FRORMAT</font></center><br>';	
		
		$query="update STUDENT set FNAME='".$_POST['fname']."',LNAME='".$_POST['lname']."', CONTACT='".$_POST['phone']."' ,EMAIL='".$_POST['email']."' where ID='".$id."'";
		mysql_query($query);
	}
	$query="select * from STUDENT where ID='$id'";
	//echo $query;
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$fname=$row['FNAME'];
	$lname=$row['LNAME'];
	$email=$row['EMAIL'];
	$mess=$row['MESS_NO'];
	$phone=$row['CONTACT'];
	
	$ann="select * from ANNOUNCEMENT where MESS_NO='$mess'";
	$annres=mysql_query($ann);
	$anncount=mysql_num_rows($annres);
							
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Info</title>
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
input[type=text] {
    width: 50%;
    padding: 4px;
    margin: 4px;
    border-radius: 4px;
    height:30px;
}
.button2{
	padding:6px 20px;
}
label{
	margin-left:75px;
}
</style>
</head>
<body style="font-family: 'Raleway', sans-serif;">
<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container_menu">
			<ul>
				<li class="current_page_item"><a href="s_home.php">Profile</a></li>
				<li><a href="s_enter_absence.php">Register Absence</a></li>
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
			<div height=400px width=600px style="border-radius:10px;">
					<center><h2>Update your Information</h2>
						<form method="POST" action="s_update_info.php" enctype="multipart/form-data" id="usrform">
							First Name:<br><input type="text" name="fname" value="<?php echo $fname;?>" required >
							<?php
								$flag=0;
								if(!empty($_POST["fname"]))
								{
									$fname=strtoupper($_POST["fname"]);
									if(!preg_match("/^[a-zA-Z ]*$/",$fname))
									{
										echo '<font color="red">Only letters and white space allowed</font><br>';
										$flag=1;		  
									}
								}	
							?>	
							Last Name:<br><input type="text" name="lname" value="<?php echo $lname;?>" required >
							<?php
								if(!empty($_POST["lname"]))
								{
									$name=strtoupper($_POST["lname"]);
									if(!preg_match("/^[a-zA-Z ]*$/",$lname))
									{
										echo '<font color="red">Only letters and white space allowed</font><br>';
										$flag=1;		  
									}
								}	
							?>	
							Contact:<br><input type="text" name="phone" value="<?php echo $phone;?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required>
							<?php
								if(!empty($_POST["phone"]))
								{
									$phone=$_POST["phone"];
									if(!preg_match("/[7-9]{1}[0-9]{9}/",$phone) )
									{
										echo '<font color="red">Enter a valid phone no.</font><br>';
										$flag=1;		  
									}
								}	
							?>
							EMAIL:<br><input type="text" name="email" value="<?php echo $email;?>" required>
							<?php
								if(!empty($_POST["email"]))
								{
									$email=$_POST["email"];
									if(!preg_match("/[a-zA-Z0-9]+@gmail.com/",$email) && !preg_match("/[a-zA-Z0-9]+@mnit.ac.in/",$email))
									{
										echo '<font color="red">Enter your gmail or institute mail.</font><br>';
										$flag=1;		  
									}
								}	
							?><br>
							<label>UPLOAD PHOTO: <input type="file" name="myfile" required><br><br></label>
						<button type="submit" class="button button2" name="update" form="usrform">Submit</button>
						</form>	
						<br>
						<?php
							if($sub==1)
								echo "<font color='Green'>Information Succesfully Updated...</font>";
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