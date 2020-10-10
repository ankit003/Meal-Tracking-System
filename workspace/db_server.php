<?php
    session_start();
    
    $sid = "";
    $fname = "";
    $lname = "";
    $email = "";
    $password = "";
    $confirm_password = "";
    $mess = "";
    $branch = "";
    $contact = "";
    $gender = "";
    
    $errors = array();                                                                  //array for errors
    
    if(isset($_POST['s_register']))
    {
        $sid = mysql_real_escape_string($_POST['sid']);
        $fname = mysql_real_escape_string($_POST['fname']);
        $lname = mysql_real_escape_string($_POST['lname']);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $confirm_password = mysql_real_escape_string($_POST['confirm_password']);
        $mess = mysql_real_escape_string($_POST['mess']);
        $branch = mysql_real_escape_string($_POST['branch']);
        $contact = mysql_real_escape_string($_POST['contact']);
        $gender = mysql_real_escape_string($_POST['gender']);
        
                                                                                        //ensuring form fields are filled properly.
        
        if(empty($sid))
        {
            array_push($errors,"ID can't be left empty.");
        }
        if(empty($fname))
        {
            array_push($errors,"First Name is required.");
        }
        if(empty($lname))
        {
            array_push($errors,"Last Name is required.");
        }
        if(empty($email))
        {
            array_push($errors,"Email can't be left empty.");
        }
        if(empty($password))
        {
            array_push($errors,"Password can't be left empty.");
        }
        if(!empty($password) && (empty($confirm_password) || $confirm_password != $password))
        {
            array_push($errors,"Passwords don't match. Please enter again.");
        }
        
        $hostel = "NULL";                                                               //values to be decided.
        $balance = 10000;
        
        
                                                                                        //if there are no errors then add info to database.
        //echo $gender." ".$contact;
        if(count($errors) == 0)
        {
            $type=$_FILES['myfile']['type'];                                            //for uploading student profile photo
			if($type=='image/png' or $type=='image/jpeg' or $type=='image/jpg' )
			{
				$tmpfile=$_FILES['myfile']['tmp_name'];
				
				$location="uploads/".$sid;
				move_uploaded_file($tmpfile,$location.".jpeg");
				echo "<center><b>UPLOADED</b></center><br>";
				//$flag=0;
			}
			else
				echo '<center><font color="red">ERROR....UPLOAD .JPEG OR .PNG FRORMAT</font></center><br>';	
				
            $password = md5($password);                                                 //encrypting password.
            $sql = "INSERT INTO STUDENT(ID,FNAME,LNAME,CONTACT,EMAIL,GENDER,BALANCE,BRANCH,MESS_NO,PASSWORD) VALUES ('$sid','$fname','$lname','$contact','$email','$gender','$balance','$branch','$mess','$password')";
            mysql_query($sql);
            
            $_SESSION['sid'] = $sid;
            $_SESSION['success'] = "You are now logged in.";
            header("location: s_home.php");                                              //redirecting to home page.
        }
    }
    if(isset($_POST['s_login']))
    {
        $sid = mysql_real_escape_string($_POST['sid']);
        $password = mysql_real_escape_string($_POST['password']);
        
        if(empty($sid))
        {
            array_push($errors,"ID can't be left empty.");
        }
        if(empty($password))
        {
            array_push($errors,"Password can't be left empty.");
        }
        
        if(count($errors) == 0)
        {
            $password = md5($password);                                             //encrypt password before comparing with that in database.
            $query = "SELECT * FROM STUDENT WHERE ID='$sid' AND PASSWORD='$password'";
            $result = mysql_query($query);
            if(mysql_num_rows($result) == 1)
            {
                $_SESSION['sid'] = $sid;                                            //log user in.
                $_SESSION['success'] = "You are now logged in.";
                header("location: s_home.php");
            }
            else
            {
                array_push($errors,"Wrong UserID / Password combination.");
                //header("location: s_login.php");
            }
        }
    }
    
    if(isset($_GET['s_logout']))                                                      //student logout
    {
        session_destroy();
        unset($_SESSION['sid']);
        header('location: s_login.php');
    }
/***********************************************************************************************************************************/
    if(isset($_POST['m_register']))                                                     //for mess register
    {
        $mid = mysql_real_escape_string($_POST['mid']);
        $m_manager = mysql_real_escape_string($_POST['m_manager']);
        $m_password = mysql_real_escape_string($_POST['m_password']);
        $m_confirm_password = mysql_real_escape_string($_POST['m_confirm_password']);
        $mess = mysql_real_escape_string($_POST['mess']);
        $m_contact = mysql_real_escape_string($_POST['m_contact']);
        
                                                                                        //ensuring form fields are filled properly.
        
        if(empty($mid))
        {
            array_push($errors,"ID can't be left empty.");
        }
        if(empty($m_manager))
        {
            array_push($errors,"Manager Name is required.");
        }
        if(empty($m_password))
        {
            array_push($errors,"Password can't be left empty.");
        }
        if(!empty($m_password) && (empty($m_confirm_password) || $m_confirm_password != $m_password))
        {
            array_push($errors,"Passwords don't match. Please enter again.");
        }
        
                                                                                        //if there are no errors then add info to database.
        if(count($errors) == 0)
        {
            $name = $_FILES['myfile']['name'];
            $type=$_FILES['myfile']['type'];                                            //for uploading student profile photo
			if($type=='image/png' or $type=='image/jpeg' or $type=='image/jpg' )
			{
				$tmpfile=$_FILES['myfile']['tmp_name'];
				$location="uploads/".$mid;
				if(move_uploaded_file($tmpfile,$location.".jpeg"))
				    echo "<center><b>Uploaded</b></center><br>";
				else
				    echo "<center><b>Not Uploaded</b></center><br>";
				//$flag=0;
			}
			else
				echo '<center><font color="red">ERROR....UPLOAD .JPEG OR .PNG FRORMAT</font></center><br>';	
            $m_password = md5($m_password);                                                 //encrypting password.
            $sql = "INSERT INTO MESS(MESS_NO,MESS_MGR,MESS_ID,MESS_PASSWORD,MESS_CONTACT) VALUES ('$mess','$m_manager','$mid','$m_password','$m_contact')";
            //echo $sql;
            mysql_query($sql);
            
            $_SESSION['mid'] = $mid;
            $_SESSION['msuccess'] = "You are now logged in.";
            header("location: m_home.php");                                              //redirecting to home page.
        }
    }
    
    if(isset($_POST['m_login']))
    {
        $mid = mysql_real_escape_string($_POST['mid']);
        $m_password = mysql_real_escape_string($_POST['m_password']);
        
        if(empty($mid))
        {
            array_push($errors,"ID can't be left empty.");
        }
        if(empty($m_password))
        {
            array_push($errors,"Password can't be left empty.");
        }
        
        if(count($errors) == 0)
        {
            $m_password = md5($m_password);                                             //encrypt password before comparing with that in database.
            $query = "SELECT * FROM MESS WHERE MESS_ID='$mid' AND MESS_PASSWORD='$m_password'";
            $result = mysql_query($query);
            if(mysql_num_rows($result) == 1)
            {
                $_SESSION['mid'] = $mid;                                            //log user in.
                $_SESSION['msuccess'] = "You are now logged in.";
                header("location: m_home.php");
            }
            else
            {
                array_push($errors,"Wrong MessID / Password combination.");
                //header("location: m_login.php");
            }
        }
    }
    
    if(isset($_GET['m_logout']))                                                      //mess logout
    {
        session_destroy();
        unset($_SESSION['mid']);
        header('location: m_login.php');
    }
?>  
