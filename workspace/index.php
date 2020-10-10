<?php 
	include "db_connect.php";
?>
<html>
<head>
<title>Index</title>
<!--Custom Theme files-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Register Login Widget template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login Signup Responsive web template, SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="style2.css" rel="stylesheet" type="text/css" media="all" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Jura:400,300,500,600' rel='stylesheet' type='text/css'>
<!--//web-fonts-->
</head>
<body style = "background-image: url(background/background1.jpg); height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; ">
	<h1>Meal Tracking System for Mess</h1>
	<!-- main -->
	<div class="main">
		<!--login-profile-->
		
		<!--login-profile-->
		<!--signin-form-->
		<div class="w3">
			<div class="signin-form profile">
				<h3>STUDENT</h3>
					<div class="tp">
						<a href="s_login.php"><input type="submit" value="LOGIN NOW"></a>
						<a href="s_register.php"><input type="submit" value="REGISTER NOW"></a>
					</div>
				<br><br>
			</div>
		</div>
		<div class="agile">
			<div class="signin-form profile">
				<h3>MESS</h3>
				<div class="tp">
					<a href="m_login.php"><input type="submit" value="LOGIN NOW"></a>
					<a href="m_register.php"><input type="submit" value="REGISTER NOW"></a>
				</div>
				<br><br>
			</div>
		</div>
		<div class="clear"></div>
		<!--//signin-form-->	
	</div>
	<div class="copyright">
		<p> &copy; Meal Tracking System for Mess . All rights reserved | Developed by PSA</p>
	</div>
	<center>
		<div class="reset_balance">
		<form method="post" action="index.php">
			<button type="submit" name="Reset_Balance">Reset Balance</button>
		</form>
	</center>
	</div>
	<?php 
		if(isset($_POST['Reset_Balance']))
		{
			$query = "update STUDENT set BALANCE = 10000";
			$result = mysql_query($query);
			$query1 = "update ABSENTEES set STATUS = 0";
			$result1 = mysql_query($query1);
			exit;
		}
	?>
</body>
</html>
<?php
	if(date('j') == '13')
	{
		$curr_date = date("Y-m-d");
		$query = "select * from ABSENTEES where (DATEDIFF(CURDATE(),END_DATE)>0) and STATUS = 0";
		$result = mysql_query($query);
		$n = mysql_num_rows($result); //echo $n; echo "<br>";
		for($i = 0; $i < $n; $i++)										//for each absentee having end-date < curr-date
		{
			//echo "ABSENTEES :	";
			$row = mysql_fetch_array($result);
			//print_r($row);
			//echo "<br><br>";
			$id = $row['ID'];
			$a_sd = $row['START_DATE'];
			$a_ed = $row['END_DATE'];
			$q1 = "select * from HOLIDAYS where (START_DATE >= '$a_sd' and START_DATE <= '$a_ed') or (END_DATE >= '$a_sd' and END_DATE <= '$a_ed') or (START_DATE <= '$a_sd' and END_DATE >= '$a_ed')";
			$result1 = mysql_query($q1);					//overlapping absence dates for given id with holidays
			//echo mysql_num_rows($result1); echo "<br>";
			if(mysql_num_rows($result1) == 0)				//for no overlap
			{
				$a_sd=date_create($row['START_DATE']);
				$a_ed=date_create($row['END_DATE']);
				$diff = date_diff($a_ed,$a_sd);
				$refund = $diff->days*100;
			}
			else
			{
				$a_sd=date_create($row['START_DATE']);
				$a_ed=date_create($row['END_DATE']);
				$diff = date_diff($a_ed,$a_sd);
				$refund = $diff->days*100;
				for($j = 0; $j < mysql_num_rows($result1); $j++)		//check for each overlapping holiday dates
				{
					//echo "HOLIDAYS :	";
					$row1 = mysql_fetch_array($result1);
					//print_r($row1);
					//echo "<br<br>";
					$h_sd=date_create($row1['START_DATE']);
					$h_ed=date_create($row1['END_DATE']);
					if($h_sd >= $a_sd && $h_ed <= $a_ed)
					{
						$diff = date_diff($a_ed,$a_sd)->days - date_diff($h_ed,$h_sd)->days;			//non-overlapping dates
						$overlap = $refund - $diff*100;													//overlapping dates
						//echo "REFUND:	".date_diff($a_ed,$a_sd)->days." - ".date_diff($h_ed,$h_sd)->days." = ".$refund."<br><br>";
					}
					else if($h_sd >= $a_sd && $h_sd <= $a_ed && $h_ed >= $a_ed)
					{
						$diff = date_diff($h_sd,$a_sd)->days;											//non-overlapping dates
						$overlap = $refund - $diff*100;													//overlapping dates
						//echo "REFUND:	".$refund."<br><br>";
					}
					else if($h_sd <= $a_sd && $h_ed >= $a_sd && $h_ed <= $a_ed)
					{
						$diff = date_diff($a_ed,$h_ed)->days;											//non-overlapping dates
						$overlap = $refund - $diff*100;													//overlapping dates
						//echo "REFUND:	".$refund."<br><br>";
					}
					else if($h_sd <= $a_sd && $h_ed >= $a_ed)
					{
						$overlap = $refund;
						//echo "REFUND:	".$refund."<br><br>";
					}
					$refund = $refund - $overlap;
				}
			}
			//echo $refund."<br><br>";
			$q2 = "update STUDENT set BALANCE = BALANCE - $refund where ID = '$id'";
			$result2 = mysql_query($q2);
			//echo "STUDENT ROWS:	".mysql_affected_rows()."<br><br>";
			
			$a_sd=$a_sd->format('Y-m-d');
			$a_ed=$a_ed->format('Y-m-d');
			$q3 = "update ABSENTEES set STATUS = 1 where ID = '$id' and START_DATE = '$a_sd' and END_DATE = '$a_ed'";
			$result3 = mysql_query($q3);
			//echo "ABSENTEES ROWS:	".mysql_affected_rows()."<br><br>";
		}
	}
?>