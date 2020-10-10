<?php 
    include("db_connect.php");      //for connecting to database
    include("db_server.php");       //for functioning of registration & login
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mess Register</title>
        <link rel="stylesheet" href="style1.css" type="text/css" />
        <style>
            a:link, a:visited {
                background-color: #f44336;
                color: white;
                padding: 10px 18px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
            }
            
            
            a:hover, a:active {
                background-color: red;
            }
        </style>
    </head>
    <body style="font-family: 'Raleway', sans-serif; background-image: url(background/background5.jpg);  height: 1100px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover !important;">
        <div class = "header">
            <h2>Register</h2>
        </div>
        <form method = "post" action = "m_register.php" enctype="multipart/form-data">
            
            <?php                                                                               //display validation errors
                include("errors.php");
            ?>
            
            <div class = "input-group">                                                         <!--mid-->
                <label>Mess ID</label></label>
                <input type="text" name="mid" value="<?php echo $mid ?>" required/>
            </div>
            <div class = "input-group">                                                         <!--m_manager-->
                <label>Manager Name</label></label>
                <input type="text" name="m_manager" value="<?php echo $m_manager ?>" required/>
            </div>
            <div class = "input-group">
                <label>Password</label></label>                                                 <!--password-->
                <input type="password" name="m_password" required/>
            </div>
            <div class = "input-group">
                <label>Confirm Password</label></label>                                         <!--confirm_password-->
                <input type="password" name="m_confirm_password" required/>
            </div>
            <div class = "input-group">                                                         <!--mess-->
                <label>Mess</label></label>
                <select id="mess" name="mess" disable selected value/>
                    <option style="display: none"></option>                                     
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="6">Six</option>
                    <option value="7">Seven</option>
                    <option value="8">Eight</option>
                    <option value="9">Nine</option>
                    <option value="10">Gargi</option>
                </select>
            </div>
            <div class = "input-group">                                                         <!--contact-->
                <label>Contact</label></label>
                <input type="text" name="m_contact" value="<?php echo $m_contact ?>" maxlength="10" required/>
            </div>
                Upload Photo: <br> <input type="file" name="myfile" value="<?php if(isset($_FILES['myfile'])) echo $_FILES['myfile']['name'];?>" required><br><br>	
            <div class = "input-group" >
                <button type = "submit" name = "m_register" class = "btn">Register</button>
            </div>
            <p>
                <a href="index.php">Home</a>
            </p>
        </form>
    </body>
</html>