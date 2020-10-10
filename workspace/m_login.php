<?php 
    include("db_connect.php");      //for connecting to database
    include("db_server.php");       //for functioning of registration & login
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mess Login</title>
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
    <body style="font-family: 'Raleway', sans-serif; background-image: url(background/background5.jpg);  height: 600px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover !important;">
        <div class = "header">
            <h2>Mess Login</h2>
        </div>
        <form method = "post" action = "m_login.php">
            <?php                                                                               //display validation errors
                include("errors.php");
            ?>
            
            <div class = "input-group">
                <label>Mess ID</label></label>
                <input type="text" name="mid" required/>
            </div>
            <div class = "input-group">
                <label>Password</label></label>
                <input type="password" name="m_password" required/>
            </div>
            <div class = "input-group">
                <button type = "submit" name = "m_login" class = "btn">Login</button>
            </div>
            <p>
                <a href="index.php">Home</a>
            </p>
        </form>
    </body>
</html>