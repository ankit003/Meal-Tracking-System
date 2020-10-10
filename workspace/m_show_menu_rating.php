<?php
session_start();
include "db_connect.php";
if(isset($_SESSION['msuccess']))
{
	$id=strtoupper($_SESSION['mid']);
	$query="select * from MESS where MESS_ID='".$id."'";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$manager=$row['MESS_MGR'];
	$mess=$row['MESS_NO'];
	$contact=$row['MESS_CONTACT'];
	$name=$row['MESS_MGR'];
	$query1="select * from MENU_RATING where ID in (select ID from STUDENT where MESS_NO='$mess')";
	//echo $query1;
	$comments=mysql_query($query1);
	$row1=mysql_num_rows($comments);
	$d=strtoupper(date('l'));
	if($d=='MONDAY') $d='MON';
	elseif($d=='TUESDAY') $d='TUES';
	elseif($d=='WEDNESDAY') $d='WED';
	elseif($d=='THURSDAY') $d='THU';
	elseif($d=='FRIDAY') $d='FRI';
	elseif($d=='SATURDAY') $d='SAT';
	elseif($d=='SUNDAY') $d='SUN';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Daily Meal Rating</title>
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
		<div id="content" style="width:100%;height:485px" style="overflow-y: scroll;">
			<center>
			<h3>RATING COUNT FOR <?php echo strtoupper(date('l'));?></h3>
			<table border="2" id="menu_table">
				<tr>
					<th>Rating</th>
					<th>BREAKFAST</th>
					<th>LUNCH</th>
					<th>SNACKS</th>
					<th>DINNER</th>
				</tr>
				<tr>
				    <td>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				    </td>
				    <?php
				        $qb = "select * from MENU_RATING where BREAKFAST_R = 5 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for breakfast with 5 star
				        $rb = mysql_query($qb);
				        $nb = mysql_num_rows($rb);                                                  //no. of students who gave 5 star to breakfast
				        
				        $ql = "select * from MENU_RATING where LUNCH_R = 5 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for lunch with 5 star
				        $rl = mysql_query($ql);
				        $nl = mysql_num_rows($rl);                                                  //no. of students who gave 5 star to breakfast
				        
				        $qs = "select * from MENU_RATING where SNACKS_R = 5 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for snacks with 5 star
				        $rs = mysql_query($qs);
				        $ns = mysql_num_rows($rs);                                                  //no. of students who gave 5 star to breakfast
				        
				        $qd = "select * from MENU_RATING where DINNER_R = 5 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for dinner with 5 star
				        $rd = mysql_query($qd);
				        $nd = mysql_num_rows($rd);                                                  //no. of students who gave 5 star to breakfast
				        ?>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nb;?></button>
                              <div id="id01" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('id01').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nb; $j++)
                                        {
                                            $ab = mysql_fetch_array($rb);
                                            echo $ab['ID']." :  ".$ab['BREAKFAST_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nl;?></button>
                              <div id="id02" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('id02').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nl; $j++)
                                        {
                                            $al = mysql_fetch_array($rl);
                                            echo $al['ID']." :  ".$al['LUNCH_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('3').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $ns;?></button>
                              <div id="3" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('3').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $ns; $j++)
                                        {
                                            $as = mysql_fetch_array($rs);
                                            echo $as['ID']." :  ".$as['SNACKS_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('4').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nd;?></button>
                              <div id="4" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('4').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nd; $j++)
                                        {
                                            $ad = mysql_fetch_array($rd);
                                            echo $ad['ID']." :  ".$ad['DINNER_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				</tr>
				<tr>
				    <td>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				    </td>
				    <?php
				        $qb = "select * from MENU_RATING where BREAKFAST_R = 4 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for breakfast with 4 star
				        $rb = mysql_query($qb);
				        $nb = mysql_num_rows($rb);                                                  //no. of students who gave 4 star to breakfast
				        
				        $ql = "select * from MENU_RATING where LUNCH_R = 4 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for lunch with 4 star
				        $rl = mysql_query($ql);
				        $nl = mysql_num_rows($rl);                                                  //no. of students who gave 4 star to breakfast
				        
				        $qs = "select * from MENU_RATING where SNACKS_R = 4 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for snacks with 4 star
				        $rs = mysql_query($qs);
				        $ns = mysql_num_rows($rs);                                                  //no. of students who gave 4 star to breakfast
				        
				        $qd = "select * from MENU_RATING where DINNER_R = 4 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for dinner with 4 star
				        $rd = mysql_query($qd);
				        $nd = mysql_num_rows($rd);                                                  //no. of students who gave 4 star to breakfast
				        ?>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('5').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nb;?></button>
                              <div id="5" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('5').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nb; $j++)
                                        {
                                            $ab = mysql_fetch_array($rb);
                                            echo $ab['ID']." :  ".$ab['BREAKFAST_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('6').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nl;?></button>
                              <div id="6" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('6').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nl; $j++)
                                        {
                                            $al = mysql_fetch_array($rl);
                                            echo $al['ID']." :  ".$al['LUNCH_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('7').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $ns;?></button>
                              <div id="7" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('7').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $ns; $j++)
                                        {
                                            $as = mysql_fetch_array($rs);
                                            echo $as['ID']." :  ".$as['SNACKS_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('8').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nd;?></button>
                              <div id="8" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('8').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nd; $j++)
                                        {
                                            $ad = mysql_fetch_array($rd);
                                            echo $ad['ID']." :  ".$ad['DINNER_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				</tr>
				<tr>
				    <td>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				    </td>
				    <?php
				        $qb = "select * from MENU_RATING where BREAKFAST_R = 3 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for breakfast with 3 star
				        $rb = mysql_query($qb);
				        $nb = mysql_num_rows($rb);                                                  //no. of students who gave 3 star to breakfast
				        
				        $ql = "select * from MENU_RATING where LUNCH_R = 3 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for lunch with 3 star
				        $rl = mysql_query($ql);
				        $nl = mysql_num_rows($rl);                                                  //no. of students who gave 3 star to breakfast
				        
				        $qs = "select * from MENU_RATING where SNACKS_R = 3 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for snacks with 3 star
				        $rs = mysql_query($qs);
				        $ns = mysql_num_rows($rs);                                                  //no. of students who gave 3 star to breakfast
				        
				        $qd = "select * from MENU_RATING where DINNER_R = 3 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for dinner with 3 star
				        $rd = mysql_query($qd);
				        $nd = mysql_num_rows($rd);                                                  //no. of students who gave 3 star to breakfast
				        ?>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('9').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nb;?></button>
                              <div id="9" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('9').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nb; $j++)
                                        {
                                            $ab = mysql_fetch_array($rb);
                                            echo $ab['ID']." :  ".$ab['BREAKFAST_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('10').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nl;?></button>
                              <div id="10" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('10').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nl; $j++)
                                        {
                                            $al = mysql_fetch_array($rl);
                                            echo $al['ID']." :  ".$al['LUNCH_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('11').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $ns;?></button>
                              <div id="11" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('11').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $ns; $j++)
                                        {
                                            $as = mysql_fetch_array($rs);
                                            echo $as['ID']." :  ".$as['SNACKS_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('12').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nd;?></button>
                              <div id="12" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('12').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nd; $j++)
                                        {
                                            $ad = mysql_fetch_array($rd);
                                            echo $ad['ID']." :  ".$ad['DINNER_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				</tr>
				<tr>
				    <td>
				        <span class="fa fa-star checked"></span>
				        <span class="fa fa-star checked"></span>
				    </td>
				    <?php
				        $qb = "select * from MENU_RATING where BREAKFAST_R = 2 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for breakfast with 2 star
				        $rb = mysql_query($qb);
				        $nb = mysql_num_rows($rb);                                                  //no. of students who gave 2 star to breakfast
				        
				        $ql = "select * from MENU_RATING where LUNCH_R = 2 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for lunch with 2 star
				        $rl = mysql_query($ql);
				        $nl = mysql_num_rows($rl);                                                  //no. of students who gave 2 star to breakfast
				        
				        $qs = "select * from MENU_RATING where SNACKS_R = 2 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for snacks with 2 star
				        $rs = mysql_query($qs);
				        $ns = mysql_num_rows($rs);                                                  //no. of students who gave 2 star to breakfast
				        
				        $qd = "select * from MENU_RATING where DINNER_R = 2 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for dinner with 2 star
				        $rd = mysql_query($qd);
				        $nd = mysql_num_rows($rd);                                                  //no. of students who gave 2 star to breakfast
				        ?>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('13').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nb;?></button>
                              <div id="13" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('13').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nb; $j++)
                                        {
                                            $ab = mysql_fetch_array($rb);
                                            echo $ab['ID']." :  ".$ab['BREAKFAST_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('14').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nl;?></button>
                              <div id="14" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('14').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nl; $j++)
                                        {
                                            $al = mysql_fetch_array($rl);
                                            echo $al['ID']." :  ".$al['LUNCH_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('15').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $ns;?></button>
                              <div id="15" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('15').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $ns; $j++)
                                        {
                                            $as = mysql_fetch_array($rs);
                                            echo $as['ID']." :  ".$as['SNACKS_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('16').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nd;?></button>
                              <div id="16" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('16').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nd; $j++)
                                        {
                                            $ad = mysql_fetch_array($rd);
                                            echo $ad['ID']." :  ".$ad['DINNER_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				</tr>
				<tr>
				    <td>
				        <span class="fa fa-star checked"></span>
				    </td>
				    <?php
				        $qb = "select * from MENU_RATING where BREAKFAST_R = 1 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for breakfast with 1 star
				        $rb = mysql_query($qb);
				        $nb = mysql_num_rows($rb);                                                  //no. of students who gave 1 star to breakfast
				        
				        $ql = "select * from MENU_RATING where LUNCH_R = 1 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for lunch with 1 star
				        $rl = mysql_query($ql);
				        $nl = mysql_num_rows($rl);                                                  //no. of students who gave 1 star to breakfast
				        
				        $qs = "select * from MENU_RATING where SNACKS_R = 1 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for snacks with 1 star
				        $rs = mysql_query($qs);
				        $ns = mysql_num_rows($rs);                                                  //no. of students who gave 1 star to breakfast
				        
				        $qd = "select * from MENU_RATING where DINNER_R = 1 and DAY = '$d' and ID in (select ID from STUDENT where MESS_NO='$mess')";                    //query for dinner with 1 star
				        $rd = mysql_query($qd);
				        $nd = mysql_num_rows($rd);                                                  //no. of students who gave 1 star to breakfast
				        ?>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('17').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nb;?></button>
                              <div id="17" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('17').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nb; $j++)
                                        {
                                            $ab = mysql_fetch_array($rb);
                                            echo $ab['ID']." :  ".$ab['BREAKFAST_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('18').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nl;?></button>
                              <div id="18" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('18').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nl; $j++)
                                        {
                                            $al = mysql_fetch_array($rl);
                                            echo $al['ID']." :  ".$al['LUNCH_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('19').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $ns;?></button>
                              <div id="19" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('19').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $ns; $j++)
                                        {
                                            $as = mysql_fetch_array($rs);
                                            echo $as['ID']." :  ".$as['SNACKS_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				        <td>
				            <div class="w3-container">
                              <button onclick="document.getElementById('20').style.display='block'" class="w3-button w3-teal w3-circle"><?php echo $nd;?></button>
                              <div id="20" class="w3-modal">
                                <div class="w3-modal-content w3-animate-zoom w3-card-4">
                                  <header class="w3-container w3-teal"> 
                                    <span onclick="document.getElementById('20').style.display='none'" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    <h2>Comments</h2>
                                  </header>
                                  <div class="w3-container" style="overflow-y: scroll;">
                                    <?php
                                        echo "<br>";
                                        for($j = 0; $j < $nd; $j++)
                                        {
                                            $ad = mysql_fetch_array($rd);
                                            echo $ad['ID']." :  ".$ad['DINNER_C']."<br><br>";
                                        }
                                    ?>
                                  </div>
                                </div>
                              </div>
                            </div>
				        </td>
				</tr>
			</table>
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