<?php
   //include("config.php");
   $db = new mysqli('localhost', 'root', '', 'proj');
   session_start();
   $error = "";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $myuserid = mysqli_real_escape_string($db,$_POST['userID']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $query = mysqli_query($db, "SELECT * FROM user WHERE userID = '$myuserid' and password = '$mypassword'");
      //$result = mysqli_query($db,$sql);
      $row = mysqli_fetch_assoc($query);
      $count = mysqli_num_rows($query);

      //$active = $row["active"];

      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['login_user'] = $myuserid;
         $_SESSION['expire'] = time() + $active;
         header("location: success.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }

   }



?>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>User ID  :</label><input type = "text" name = "userID" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               <!--link to user management page-->
               <a href="user.php"> <button type="button"> user management </button> </a>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>
