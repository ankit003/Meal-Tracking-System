<?php
session_start();
include "db_connect.php";
$day=array('FRI','MON','SAT','SUN','THU','TUES','WED');
if(isset($_SESSION['success']))
{
    $rate="breakfast";
	$id=strtoupper($_SESSION['sid']);
	//echo $id;
	$query="select MESS_NO from STUDENT where ID = '$id'";
	//echo $query;
	$result=mysql_query($query);
	$rows=mysql_fetch_array($result);
	$mess = $rows['MESS_NO'];
	//echo $mess;
	$query="select * from MENU where MESS_NO='$mess'";
	$result=mysql_query($query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rate today's Meal</title>
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
/*styling for vote menu table*/
#menu_table
{
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 90%;
    margin-left:10px;
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

/*styling for rating star*/
	.star-rating {
    direction: rtl;
    display: inline-block;
}

.star-rating input[type=radio] {
    display: none
}

.star-rating label {
    color: #bbb;
    font-size: 18px;
    padding: 0;
    cursor: pointer;
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type=radio]:checked ~ label {
    color: #f2b600
}
/*for text area*/
textarea{
    width:250px;
}
</style>
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
                <li><a href="s_menu_rating.php">Give Suggesions</a></li>
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
		<div id="content" style="width:100%;">
			<div style="height: 484px ; width: 100%; overflow-y: scroll;">
				<center>
					<h3>RATE TODAY'S MEAL</h3>
					<form action="s_menu_rating.php" method="POST" id="usrform" >
					<table border="2" id="menu_table">
						<tr>
							<th>DAY</th>
							<th>BREAKFAST</th>
							<th>LUNCH</th>
							<th>SNACKS</th>
							<th>DINNER</th>
						</tr>
						<?php
							$d=strtoupper(date('l'));
							if($d=='MONDAY') $d='MON';
							elseif($d=='TUESDAY') $d='TUES';
							elseif($d=='WEDNESDAY') $d='WED';
							elseif($d=='THURSDAY') $d='THU';
							elseif($d=='FRIDAY') $d='FRI';
							elseif($d=='SATURDAY') $d='SAT';
							elseif($d=='SUNDAY') $d='SUN';
							$q1="select * from MENU where DAY='$d' and MESS_NO='$mess' ";
							//echo $q1;
							$result1=mysql_query($q1);
							$row1=mysql_fetch_array($result1);
							//print_r($row1);
						?>
						<tr>
						    <td><?php echo$row1['DAY'];?></td>
						    <td><?php echo$row1['BREAKFAST'];?></td>
						    <td><?php echo$row1['LUNCH'];?></td>
						    <td><?php echo$row1['SNACKS'];?></td>
						    <td><?php echo$row1['DINNER'];?></td>
						</tr>
						<tr>
						    <td>Rating</td>    
						    <td><?php $i=1; $rate='breakfast'; include's_stars.php';?></td>
						    <td><?php $i++; $rate='lunch'; include's_stars.php';?></td>
						    <td><?php $i++; $rate='snacks'; include's_stars.php';?></td>
						    <td><?php $i++; $rate='dinner'; include's_stars.php';?></td>
						</tr>    
						<tr>
						    <td>Comments</td>
						    <td><textarea rows="4" cols="15"  name="b_comment" form="usrform" placeholder="Write Suggesion here..."></textarea></td>
						    <td><textarea rows="4" cols="15"  name="l_comment" form="usrform" placeholder="Write Suggesion here..."></textarea></td>
						    <td><textarea rows="4" cols="15"  name="s_comment" form="usrform" placeholder="Write Suggesion here..."></textarea></td>
						    <td><textarea rows="4" cols="15"  name="d_comment" form="usrform" placeholder="Write Suggesion here..."></textarea></td>						</tr>
						
					</table><br>
					<input type="submit" value="SUBMIT" name="submit"></input>
					</form>
					<?php 
					    if(isset($_POST['submit'])) 
					    {
					        $q="select * from MENU_RATING where DAY='$d' and ID='$id'";
					    	$result=mysql_query($q);
					        //echo (mysql_num_rows($result));
					        if(mysql_num_rows($result)==0)
    					    {
    					        //echo mysql_num_rows($row);
    					        //echo $_POST['breakfast']." ". $_POST['lunch']." ". $_POST['snacks']." ". $_POST['dinner'];
        					    $breakfast_rating=$_POST['breakfast'];
        					    $lunch_rating=$_POST['lunch'];
        					    $snacks_rating=$_POST['snacks'];
        					    $dinner_rating=$_POST['dinner'];
        					    $b_comment=$_POST['b_comment'];
        					    $l_comment=$_POST['l_comment'];
        					    $s_comment=$_POST['s_comment'];
        					    $d_comment=$_POST['d_comment'];
        					    $q="insert into MENU_RATING values('$id','$d','$breakfast_rating','$lunch_rating','$snacks_rating','$dinner_rating','$b_comment','$l_comment','$s_comment','$d_comment')";
    					    	//echo $q;
    					    	if(mysql_query($q))
    					    	echo "<font color='green'>Successfully Rated Today's Meal</font>";
    					    }
    					    else
    					    {
    					    	echo "<font color='red'>Already Rated Today's Meal</font>";
    					    }
					        
					    }
					    
					?>
				</center>
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