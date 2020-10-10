<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['msuccess']))
{
    $sub=0;
	$id=strtoupper($_SESSION['mid']);
	$query1="select * from COMMENTS where S_ID in (select ID from STUDENT where MESS_NO=(select MESS_NO from MESS where MESS_ID='$id'))";
	$comments=mysql_query($query1);
	$row1=mysql_num_rows($comments);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Holiday List</title>
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
				<li><a href="m_home.php">Profile</a></li>
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
		<div id="content">
			<div class="holiday">
				<center>
				<?php 
				if($_GET['detail_flag'] == 'true')
				{
					//echo "Holiday List Page";
				?>
				
				<form action="m_update_holiday_list.php" method="POST">
				<h4><button name="add_holiday" type="submit" class="button button2" style="float:center; position: relative; ">Add Holiday</button></h4>
				</form>
				
				<div style = "height: 393px; overflow-y: auto;">
				<table border="2" id="menu_table">
					<tr>
						<th>OCCASION</th>
						<th>FROM</th>
						<th>TO</th>
					</tr>
					
					<?php
					    $q = "select * from HOLIDAYS";
					    $result = mysql_query($q);
					    $num_rows = mysql_num_rows($result);
					    //echo $num_rows;
						for($i=0;$i<$num_rows;$i++)
						{
							$row=mysql_fetch_array($result);
							$start_date=date_create($row['START_DATE']);
							$end_date=date_create($row['END_DATE']);
					?>	
							
							<tr>
							<td><?php echo $row['OCCASION']?></td>
							<td><?php echo date_format($start_date,"d-M-Y");?></td>
							<td><?php echo date_format($end_date,"d-M-Y");?></td>
							</tr>
					<?php		
						}
					?>
				</table>
				</div>
				<?php
				if(isset($_POST['add_holiday']))								//redirect to same page and unset a GET Global 
					{
						header('location: m_update_holiday_list.php');
						exit;
					}
				}
				else {
				?>
				<h2>Add Holiday</h2>
				<form action="m_update_holiday_list.php" method="POST">
				<table cellpadding="5">
				    <tr><th>OCCASION:</th><td><input type="text" name="occasion"></td>
					<tr><th>FROM:</th><td><input type="date" name="date_from"></td>
					<tr><th>TILL:</th><td><input type="date" name="date_till"></td>
				</table>	
					<button name="submit" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">Add</button><br>
					<br>
					<button name="holiday_list" type="submit" class="button button2" style="float:left; position: absolute; left: 336px;">Check Holiday List</button>
				</form>
				<br><br><br><br><br><br>
				<?php
				}
					if(isset($_POST['submit']))
					{
					    $occasion = $_POST['occasion'];
						$date_from=$_POST['date_from'];
						$date_till=$_POST['date_till'];
						
						$q1 = "select * from HOLIDAYS where OCCASION = '$id' and START_DATE = '$date_from' and END_DATE = '$date_till'";
						$result1 = mysql_query($q1);
						if(mysql_num_rows($result1) != 0)							//check if entry with same ID & DATE exists (which is not allowed)
						{
							echo "You have already added holiday with same occasion or dates starting from : ".$date_from." to : ".$date_till." .Please check Holiday List for more details.";
							exit;
						}
						if(!empty($date_from) && !empty($date_till) && !empty($occasion))
						{
							$query = "insert into HOLIDAYS(OCCASION,START_DATE,END_DATE) values('$occasion','$date_from','$date_till')";
							$result = mysql_query($query);
							if(!empty($result))
							{
								echo "Holiday for ".$occasion." from : ".$date_from." to : ".$date_from." has been added.";
							}
						}
						else {
							echo "Please fill in all the details before Adding Holiday.";
						}
					}
					if(isset($_POST['holiday_list']))								//redirect to same page and set a GET Global 
					{
						header('location: m_update_holiday_list.php?detail_flag=true');
						exit;
					}
				?>
				</center>
			
			</div>
		</div>
		
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<center><h2>Commments</h2></center>
				</div>
				<ul>
					<marquee style="height: 410px;" behavior="scroll" direction="up" scrollamount="2" onMouseOver="this.stop()" onMouseOut="this.start()">
						<?php
						for($i=0;$i<$row1;$i++)
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
}
else
{
		unset($_SESSION['msuccess']);
		session_destroy();
		header("location:index.php");
		exit;
}
?>