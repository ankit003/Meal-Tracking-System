<?php
session_start();
include "db_connect.php";
$day=array('FRI','MON','SAT','SUN','THU','TUES','WED');
if(isset($_SESSION['success']))
{
	$id = $_SESSION['sid'];
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
<title>Vote For Menu</title>
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
/*styling for radio buttons*/
label > input{ /* HIDE RADIO */
  visibility: hidden; /* Makes input not-clickable */
  position: absolute; /* Remove input from document flow */
}
label > input + i{ /* IMAGE STYLES */
  cursor:pointer;
}
label > input:checked + i{ /* (RADIO CHECKED) IMAGE STYLES */
  color:red;
}
#opt{
	float:right;
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
		<div id="content" style="width:100%;">
			<div style="height: 485px ; overflow:scroll;width:100%">
				<center>
					<h1>MENU</h1>
					<form action="s_menu_vote.php" method="POST" >
					<table border="2" id="menu_table">
						<tr>
							<th>DAY</th>
							<th>BREAKFAST</th>
							<th>LUNCH</th>
							<th>SNACKS</th>
							<th>DINNER</th>
						</tr>
						<?php
							for($i=0;$i<7;$i++)
							{
								$row=mysql_fetch_array($result);
						?>	
								
								<tr>
								<td><?php echo $day[$i];?></td>
								<td><?php echo $row['BREAKFAST'];?><div id="opt"> <label><input type="radio" name="<?php echo"b".$i; ?>" value=1 /><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="<?php echo"b".$i; ?>" value=-1 /><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></label><label><input type="radio" name="<?php echo"b".$i; ?>" value=0	 checked></label></div></td></div>
								<td><?php echo $row['LUNCH'];?> <div id="opt"><label><input type="radio" name="<?php echo"l".$i; ?>" value=1 /><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="<?php echo"l".$i; ?>" value=-1 /><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></label><label><input type="radio" name="<?php echo"l".$i; ?>" value=0	 checked></label></div></td></div>
								<td><?php echo $row['SNACKS'];?> <div id="opt"><label><input type="radio" name="<?php echo"s".$i; ?>" value=1 /><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="<?php echo"s".$i; ?>" value=-1 /><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></label><label><input type="radio" name="<?php echo"s".$i; ?>" value=0	 checked></label></div></td></div>
								<td><?php echo $row['DINNER'];?><div id="opt"><label><input type="radio" name="<?php echo"d".$i; ?>" value=1 /><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input type="radio" name="<?php echo"d".$i; ?>" value=-1 /><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></label><label><input type="radio" name="<?php echo"d".$i; ?>" value=0	 checked></label></div></td></div>
								
						<?php		
							}
						?>
					</table><br>
					<input type="submit" value="SUBMIT"></input>
					</form>
					<?php
					if(isset($_POST['b0'])||isset($_POST['b1'])||isset($_POST['b2'])||isset($_POST['b3'])||isset($_POST['b4'])||isset($_POST['b5'])||isset($_POST['b6'])||isset($_POST['l0'])||isset($_POST['l1'])||isset($_POST['l2'])||isset($_POST['l3'])||isset($_POST['l4'])||isset($_POST['l5'])||isset($_POST['l6'])||isset($_POST['s0'])||isset($_POST['s1'])||isset($_POST['s2'])||isset($_POST['s3'])||isset($_POST['s4'])||isset($_POST['s5'])||isset($_POST['s6'])&&isset($_POST['d0'])||isset($_POST['d1'])||isset($_POST['d2'])||isset($_POST['d3'])||isset($_POST['d4'])||isset($_POST['d5'])||isset($_POST['d6']))
						{
							//echo $id;
							$q="select * from STU_VOTE where ID='$id'";
							$result=mysql_query($q);
							$row=mysql_num_rows($result);
							//echo $row."<br>";
							if($row==0)
							{
								$qr="insert into STU_VOTE values ( '$id' )";
								//echo $qr."<br>";
								mysql_query($qr);
								$day=array('FRI','MON','THU','TUES','SAT','SUN','WED');
								for($i=0;$i<7;$i++)
								{
									$q="select * from VOTE_MENU where DAY='$day[$i]' && MESS_NO='$mess'";
									//echo"<br>".$q;
									$result=mysql_query($q);
									$row=mysql_fetch_array($result);
									//print_r($row);
									$query="update VOTE_MENU set BREAKFAST='".$row['BREAKFAST']=$row['BREAKFAST']+$_POST['b'.$i]."',LUNCH='".$row['LUNCH']=$row['LUNCH']+$_POST['l'.$i]."',SNACKS='".$row['SNACKS']=$row['SNACKS']+$_POST['s'.$i]."',DINNER='".$row['DINNER']=$row['DINNER']+$_POST['d'.$i]."' where DAY='".$day[$i]."' and MESS_NO='$mess'";
									//echo"<br>".$query;
									mysql_query($query);
								}				
							}
							else
							{
								echo "<center><font color='red'>Your vote has already been recorded.</font><br>";
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