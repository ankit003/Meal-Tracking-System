<?php
session_start();
include "db_connect.php";
if(!empty($_SESSION['msuccess']))
{
	
	$flag=0;
	$id=strtoupper($_SESSION['mid']);
	$app="select * from MC_APPLICATIONS where ID in (select ID from STUDENT where MESS_NO in (select distinct MESS_NO from MESS where MESS_ID='$id'))";
	$resapp=mysql_query($app);
	$row1=mysql_num_rows($resapp);
	
	
	$query1="select * from COMMENTS where S_ID in (select ID from STUDENT where MESS_NO=(select MESS_NO from MESS where MESS_ID='$id'))";
	$comments=mysql_query($query1);
	$row2=mysql_num_rows($comments);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mess Committee</title>
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
		<div id="content" style="overflow:scroll">
			<center>
				<form method="POST">
							<h1>Make Selections:</h1> 
							<table border="2" id="menu_table">
								<tr>
									<th>Photo</th>
									<th>Details</th>
									<th>Description</th>
								</tr>
								<?php
									for($i=0;$i<$row1;$i++)
									{
										$row=mysql_fetch_array($resapp);
										$temp=$row['ID'];
										$name=mysql_query("select * from STUDENT where ID='$temp'");
										$details=mysql_fetch_array($name);
								?>	
										
										<tr>
										<td width="150"><center><img src="uploads/<?php echo $temp.'.jpeg';?>" style=" max-width: 100%;max-height: 100%;height:100px;width:100px;border-radius:10px"></center></td>
										<td><label><input type="checkbox"  name=<?php echo"member".$i; ?> value=<?php echo $temp; ?>></label><?php echo "  ".$details['FNAME']." "; echo $details['LNAME'];?>
										<br><?php echo $details['ID'];?></td>
										<td><?php echo "CGPA: ".$row['CGPA']; ?> <br> <?php echo "Score: ".$row['SCORE']; ?> <br> <?php echo $row['DES1']; ?> <br> <?php echo $row['DES2'];?> </td>
										</tr>
								<?php		
									}
								?>
							</table>
							<button name="submit" class="button button2" type="submit"  value="1" >Submit</button>
				</form>
			
		<?php
			$count=0;
			if(isset($_POST['submit']))
			{
				$flag=1;
			}
			for($i=0;$i<$row1;$i++)
			{
				$mem='member'.$i;
				if(!empty($_POST[$mem]))
					$count++;
			}
			$alr=mysql_query("select * from MESS_COMMITTEE where S_ID in (select ID from STUDENT where MESS_NO in (select distinct MESS_NO from MESS where MESS_ID='$id'))");
			$count1=mysql_num_rows($alr);
			$count=$count+$count1;
			if($count<5)
			{
				if(isset($_POST['submit']))
				{
					$tempp=mysql_query("select * from MC_APPLICATIONS where ID in (select ID from STUDENT where MESS_NO in (select distinct MESS_NO from MESS where MESS_ID='$id'))");
					$row1=mysql_num_rows($tempp);
					for($i=0;$i<$row1;$i++)
					{
						$mem='member'.$i;
						
						if(!empty($_POST[$mem]))
						{
							$tem=$_POST[$mem];
							
							$det=mysql_query("select * from MC_APPLICATIONS where ID='$tem'");
							$details=mysql_fetch_array($det);
							$tmp1=$details['CGPA'];
							$tmp2=$details['DES2'];
							$results=mysql_query("insert into MESS_COMMITTEE values ('$tem' ,'$tmp1','$tmp2')");
							mysql_query("delete from MC_APPLICATIONS where ID='$tem'");
							header('location: m_select_mess_committee.php');
						}
					
					}
					
						echo "<br><font color=green>Selection Successful</font>";
					
				}
			}
			else if($flag==1)
			{
				echo "<br><font color=red>More than five members are not allowed</font>";
			}
		?>
		</center>
		</div>
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<center><h2>Commments</h2></center>
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