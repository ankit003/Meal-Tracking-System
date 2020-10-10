<?php 
    include("db_connect.php");      //for connecting to database
    include("db_server.php");       //for functioning of registration & login
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Register</title>
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
            <h2>Student Register</h2>
        </div>
        <form method = "post" action = "s_register.php" enctype="multipart/form-data">
            
            <?php                                                                               //display validation errors
                include("errors.php");
            ?>
            
            <div class = "input-group">                                                         <!--fname-->
                <label>First Name</label></label>
                <input type="text" name="fname" value="<?php echo $fname ?>" required/>
            </div>
            <div class = "input-group">                                                         <!--lname-->
                <label>Last Name</label></label>
                <input type="text" name="lname" value="<?php echo $lname ?>" required/>
            </div>
            <div class = "input-group">                                                         <!--College ID / User ID (sid)-->
                <label>College ID</label></label>
                <input type="text" name="sid" value="<?php echo $sid ?>" required/>
            </div>
            <div class = "input-group">                                                         <!--email-->
                <label>Email</label></label>
                <input type="email" name="email" value="<?php echo $email ?>" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" required/>
            </div>
            <div class = "input-group">
                <label>Password</label></label>                                                 <!--password-->
                <input type="password" name="password" minlength = "8" required/>
            </div>
            <div class = "input-group">
                <label>Confirm Password</label></label>                                         <!--confirm_password-->
                <input type="password" name="confirm_password" minlength = "8" required/>
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
            <div class = "input-group">                                                         <!--branch-->
                <label>Branch</label></label>
                <select id="branch" name="branch">
                    <option style="display: none"></option>
                    <option value="cse">CSE</option>
                    <option value="ece">ECE</option>
                    <option value="eee">EEE</option>
                    <option value="mech">MECH</option>
                    <option value="civil">CIVIL</option>
                    <option value="chem">CHEM</option>
                    <option value="meta">META</option>
                    <option value="arch">ARCH</option>
                </select>
            </div>
            <div class = "input-group">                                                         <!--contact-->
                <label>Contact</label></label>
                <input type="number" name="contact" value="<?php echo $contact ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required/>
            </div>
            <div class = "input-group">                                                         <!--gender-->
                <label>Gender</label></label>
                <select id="gender" name="gender">
                    <option style="display: none"></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            
                Upload Photo: <br> <input type="file" name="myfile" value="<?php if(isset($_FILES['myfile'])) echo $_FILES['myfile']['name'];?>" required><br><br>	
            
            <div class = "input-group">
                <button type = "submit" name = "s_register" class = "btn">Register</button>
            </div>
            <p>
                <a href="index.php">Home</a>
            </p>
        </form>
    </body>
</html>