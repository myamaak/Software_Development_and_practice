<?php
   include"session.php";

?>
<html>

   <head>
      <title> Welcome </title>
      <h1>Welcome <?=$_SESSION['login_user']?></h1>

      <h2>user documents list</h2>
      <?php
      //all document of every user
      //document, fdate, userid, useremail
      //link to user document
      $newdb = new mysqli('localhost', 'root', '', 'proj');
      if ($newdb->connect_error) {
        die("Connection failed: " . $newdb->connect_error);
      }

      $doclist = mysqli_query($newdb, "SELECT contents, doctitle, userID, Fdate, email FROM userdocument");

      if ($doclist->num_rows > 0) {
        // output data of each row
        while($doc = $doclist->fetch_assoc()) {
        echo ($doc['doctitle']."|| ". $doc['contents'] ."|| ". $doc['userID'] ."|| ". $doc['Fdate'] ."|| ". $doc['email']."<br/>");
      }
    } else {
      echo "0 results";
    }
    //$conn->close();
    //  $doctitle=$doc['doctitle'];
    //  $userID=$doc['userID'];
    //  $Fdate=$doc['Fdate'];
    //  $email=$doc['email'];

         ?>

         <a href="document.php"> <button type="button"> modify </button> </a>


      <h3><a href = "logout.php">Sign Out</a></h3>
      <?php
      	if (time() > $_SESSION['expire']) {
            echo "Your session has expired!";
            session_destroy();
               header("Location: login.php");
            }


      ?>


   </body>

</html>
