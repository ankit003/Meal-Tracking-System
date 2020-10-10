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
	$query1="select * from COMMENTS where S_ID in (select ID from STUDENT where MESS_NO=(select MESS_NO from MESS where MESS_ID='$id'))";
	//echo $query1;
	$comments=mysql_query($query1);
	$row1=mysql_num_rows($comments);
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Today's Attendies</title>
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
				<li>	<div class="dropdown">
					  <button3 class="dropbtn">MESS COMMITTEE</button3>
					  <div class="dropdown-content">
					    <a href="m_comettimembers.php">Current Mess Committee</a>
					    <a href="m_select_mess_committee.php">Select Mess Committee</a>
					  </div>
					</div></li>
                <li class="current_page_item"><a href="m_todayattendies.php">Today's Attendees</a></li>
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
	<?php
	if(!isset($_POST['getlist']))
	{
		?>
	<div id="page" class="container">
		<div id="content" style="padding:100px;">
		<center>
			<h2>Select atleast one option</h2>
			<form id="form" action="m_todayattendies.php" method="POST">
				<table cellpadding="5">
			<tr><td><input type="radio" name="BREAKFAST" value="BREAKFAST" >Breakfast</tr></tr><td><input type="radio" name="BREAKFAST" value="LUNCH" >Lunch</td><tr><td><input type="radio" name="BREAKFAST" value="SNACKS" >Snacks</td><tr><td><input type="radio" name="BREAKFAST" value="DINNER" >Dinner</td>
				</table>
			</form>
			<button form="form" class="button button2" name="getlist" value="1">GetList</button>
			
		</center>
		</div>
		<?php
		
	}
	else
	{
		if(empty($_POST['BREAKFAST']) && empty($_POST['LUNCH']) && empty($_POST['SNACKS']) && empty($_POST['DINNER']))
			{
				unset($_POST['getlist']);
				$flag=1;
				header("location: m_todayattendies.php");
			}
		?>
			<div id="page" class="container">
				<div id="content" style="overflow:scroll">
				<center>
					<?php
					if($_POST['BREAKFAST']=='BREAKFAST' || $_POST['BREAKFAST']=='LUNCH' || $_POST['BREAKFAST']=='SNACKS' || $_POST['BREAKFAST']=='DINNER')
						{
							$time=$_POST['BREAKFAST'];
							$list=mysql_query("select * from STUDENT where ID not in (select ID from ABSENTEES where START_DATE<CURDATE() or END_DATE>CURDATE() ) and MESS_NO='$mess'");
							$rows=mysql_num_rows($list);
							
							?>
								<h2>Present Students in <?php echo $_POST['BREAKFAST'] ?>:</h2> 
								<form method="POST" action="ngo.php">
									<table border="2" id="menu_table">
										<tr>
											<th>NAME</th>
											<th>ID</th>
										</tr>
										<?php
											for($i=0;$i<$rows;$i++)
											{
												$row=mysql_fetch_array($list);
										?>	
												
												<tr>
												<td><input type="checkbox"  name=<?php echo"memberp".$i; ?> value=<?php echo $temp; ?>>
												<?php echo $row['FNAME']."  ".$row['LNAME'];?></td>
												<td><?php echo $row['ID'];?></td>
												</tr>
										<?php		
											}
										?>
									</table>
									<button name="submitatt" class="button button2" type="submit"  value="1" >Submit attendence</button>
									</form>
							<?php
						}
					?>
				</center>
				</div>
			
		<?php
	}
	?>
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

//unset($_SESSION['success']);
//session_destroy();
?>