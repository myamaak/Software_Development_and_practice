<?php
   //include('config.php');

   session_start();
   //if(!isset($_SESSION['login_user'])){  header("Location:login.php");}

   $db = new mysqli('localhost', 'root', '', 'proj');

   //$myusername = mysqli_real_escape_string($db,$_POST['username']);

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"SELECT userID FROM user WHERE userID = '$user_check' ");


   //$_SESSION['login_user'] = $myusername;

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['userID'];



   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>
