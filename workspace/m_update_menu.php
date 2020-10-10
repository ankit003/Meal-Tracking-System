<?php
session_start();
include "db_connect.php";
$day=array('FRI','MON','SAT','SUN','THU','TUES','WED');
if(isset($_SESSION['msuccess']))
{
    $flag=0;
	$mid=strtoupper($_SESSION['mid']);
	$q="select * from MESS where MESS_ID='$mid'";
	$result=mysql_query($q);
	$row=mysql_fetch_array($result);
	$mess=$row['MESS_NO'];
if(isset($_POST['breakfast0'])||isset($_POST['breakfast1'])||isset($_POST['breakfast2'])||isset($_POST['breakfast3'])||isset($_POST['breakfast4'])||isset($_POST['breakfast5'])||isset($_POST['breakfast6'])||isset($_POST['luch0'])||isset($_POST['luch1'])||isset($_POST['luch2'])||isset($_POST['luch3'])||isset($_POST['luch4'])||isset($_POST['luch5'])||isset($_POST['luch6'])||isset($_POST['snacks0'])||isset($_POST['snacks1'])||isset($_POST['snacks2'])||isset($_POST['snacks3'])||isset($_POST['snacks4'])||isset($_POST['snacks5'])||isset($_POST['snacks6'])&&isset($_POST['dinner0'])||isset($_POST['dinner1'])||isset($_POST['dinner2'])||isset($_POST['dinner3'])||isset($_POST['dinner4'])||isset($_POST['dinner5'])||isset($_POST['dinner6']))
	{
		$flag=0;
			$qw="select * from MENU where MESS_NO='$mess'";
			$r=mysql_query($qw);
			//$data=mysql_fetch_array($r);
			$n=mysql_num_rows($r);
			if($n==0)
			{
				for($i=0;$i<7;$i++)
				{
					$d=$day[$i];
					$BREAKFAST=$_POST['breakfast'.$i];
					$LUNCH=$_POST['lunch'.$i];
					$SNACKS=$_POST['snacks'.$i];
					$DINNER=$_POST['dinner'.$i];
					$query="insert into MENU values('$mess','$d','$BREAKFAST','$LUNCH','$SNACKS','$DINNER')";
					//echo $query;
					if(mysql_query($query))
						$flag=1;
				}
					
			}
			else
			{
				for($i=0;$i<7;$i++)
				{
					
					$query="update MENU set BREAKFAST='".$_POST['breakfast'.$i]."',LUNCH='".$_POST['lunch'.$i]."',SNACKS='".$_POST['snacks'.$i]."',DINNER='".$_POST['dinner'.$i]."' where DAY='".$day[$i]."' and MESS_NO='".$mess."'";
					//echo $query;
					if(mysql_query($query))
						$flag=1;
				}
			}
	}
$query="select * from MENU where MESS_NO='$mess'";
$result=mysql_query($query);
//echo $query;
//$rows=mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update_menu</title>
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
/*styling for input text box*/
input[type=text] {
    width: 100%;
    padding: 5px;
    margin: 5px;
    border-radius: 4px;
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
                <li><a href="s_comment.php">Today's Attendees</a></li>
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
		<div id="content" style="width:100%;height:880px;">
			<center>
				<h1>MENU</h1> 
				<?php if($flag==1) echo "<center><font color='green'>Updated Successfully</font>";?>
				<form action="m_update_menu.php" method="POST" id="usrform" >
                    <table border="2" id="menu_table">
                    	<tr>
                    		<th>DAYS</th>
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
                    			<td><input type="text" name="<?php echo"breakfast".$i; ?>" value="<?php echo $row['BREAKFAST'];?>" maxlength="30" required></td>
                    			<td><input type="text" name="<?php echo"lunch".$i; ?>" value="<?php echo $row['LUNCH'];?>" maxlength="30" required></td>
                    			<td><input type="text" name="<?php echo"snacks".$i; ?>" value="<?php echo $row['SNACKS'];?>"maxlength="30" required></td>
                    			<td><input type="text" name="<?php echo"dinner".$i; ?>" value="<?php echo $row['DINNER'];?>" maxlength="30" required></td>
                    			</tr>
                    	<?php		
                    		}
                    	?>
                    </table>
                    <br><button class="button button2" type="submit" form="usrform" value="Submit" >Update</button>
                    </form>

			</center>
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

//unset($_SESSION['loggged_in']);
//session_destroy();*/
?>