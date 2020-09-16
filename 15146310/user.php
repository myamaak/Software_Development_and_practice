
<?php
//search valid user
function searchinput(){
  $conn = mysqli_connect("localhost", "root", "", "proj");
  if ($conn->connect_error) die($conn->connect_error);
    $term = $_GET['input'];
    $term = mysqli_real_escape_string($conn,$term);
    if(strlen($term)>0){
    $query = "SELECT userID, username, password, email, phonenum FROM user
    WHERE userID LIKE '%$term%' OR phonenum LIKE '%$term%'";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j){
      $result->data_seek($j);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      echo "userID:".$row['userID']. "<br/>";
      echo "username:".$row['username']. "<br/>";
      echo "password:".$row['password']. "<br/>";
      echo "email:".$row['email']. "<br/>";
      echo "phone number:".$row['phonenum']. "<br/>";
      }
    }else{
      echo"<script> alert('no input.'); </script>";

    }
  }

  if(isset($_GET['search']))
  {
     searchinput();
   }
     ?>

<html>

<head>

  <title>user management</title>

</head>

<body>

<!--search user-->

        <form method='GET' action="user.php">
        Search user: <input type="text" name=input size="30" placeholder="userID or phonenumber">
        <input type="submit" name="search" value="search">
        </form>

<!--update user-->

      <form method='GET' action"user.php">
        <h2>Update user information</h2>
        userID: <input type="text" id=id name=id size="30">
        password: <input type="text" id=pw name=pw size="30">
        <input type="submit" name="confirm" value="confirm">
      </form>

        <?php

        $conn = mysqli_connect("localhost", "root", "", "proj");
          if ($conn->connect_error) die($conn->connect_error);
          if(isset($_GET['confirm']) && isset($_GET['id']) && isset($_GET['pw'])){
            $userid = $conn->real_escape_string($_GET['id']);
            $psword = $conn->real_escape_string($_GET['pw']);
            $query = "SELECT * FROM user WHERE userID ='$userid' AND password='$psword'";
            $result = $conn->query($query);
            if (!$result) die ("Database access failed: " . $conn->error);
            $rows = $result->num_rows;
            for ($i = 0 ; $i < $rows ; ++$i){
              $result->data_seek($i);
              $row = $result->fetch_array(MYSQLI_NUM);
             echo<<<HTML
              <form action="user.php" method="POST">
             <lable> user ID   : </lable> <input type=text placeholder="$userid" name=uid id=uid> </br>
             <lable> user name : </lable> <input type=text name=un id=un></br>
             <lable> password  : </lable> <input type=text placeholder="$psword" name=psw id=psw> </br>
             <lable> email     : </lable> <input type=text name=ue id=ue> </br>
             <lable> phone#    : </lable> <input type=text name=up id=up> </br>

             <input type="hidden" name="update" value="yes">
           </br>
           <h4>confirm original user information</h4>
             <input type=hidden value="$row[0]" name=userid id=userid>
             <input type=hidden value="$row[2]" name=psword id=psword>
             <input type="submit" name="update" value="update">
           </form></br>
HTML;
}
}
//여기서부터!!!!!!!!!!!!!!!!!!
            $db = new mysqli("localhost", "root", "", "proj");
              if (mysqli_connect_errno()) {
              printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
              }
                if (isset($_POST['update']))
                {
                  $userid = $db->real_escape_string($_POST['userid']);
                  $psword = $db->real_escape_string($_POST['psword']);

                  $id = $db->real_escape_string($_POST['uid']);
                  $name = $db->real_escape_string($_POST['un']);
                  $pw = $db->real_escape_string($_POST['psw']);
                  $e = $db->real_escape_string($_POST['ue']);
                  $num = $db->real_escape_string($_POST['up']);


                  $upsql="UPDATE user SET userID='$id', username='$name', password='$pw', email='$e', phonenum='$num' WHERE  userID ='$userid' && password='$psword'";
                  $newresult = $db->query($upsql);
                  echo"user information is successfully modified.";
                  if (!$newresult) echo " update failed: $upsql<br>" .$db->error . "<br><br>";

              }


                //여기까찌!!!!!!!!!!!!!!!!!!!!!!!!!!!
?>

<!--insert,delete user-->

        <?php
        $conn = mysqli_connect("localhost", "root", "", "proj");
        if ($conn->connect_error) die($conn->connect_error);
        if ( isset($_POST['delete']) && isset($_POST['userID']) )
        {
          $userID = get_post($conn, 'userID');
          $query = "DELETE FROM user WHERE userID='$userID'";
          $result = $conn->query($query);
          if (!$result) echo " DELETE failed: $query<br>" .$conn->error . "<br><br>";
        }

        if (isset($_POST['userID']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phonenum']))
        {
         $userID = get_post($conn, 'userID');
         $username = get_post($conn, 'username');
         $password = get_post($conn, 'password');
         $email = get_post($conn, 'email');
         $phonenum = get_post($conn, 'phonenum');

         $query = "INSERT INTO  user(userID, username, password, email, phonenum) VALUES('$userID', '$username','$password','$email','$phonenum')";
         $result = $conn->query($query);
         if (!$result) echo "INSERT failed: $query<br>" .$conn->error . "<br><br>";
         }
         echo<<<HTML
         <h2>insert user information</h2>
              <form action="user.php" method="post">
                <pre>
                <table border="1">
                <tr>
                  <td>user ID</td>
                  <td><input type="text" size="30" name=userID></td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td><input type="password" size="30" name=password></td>
                </tr>
                <tr>
                  <td>name</td>
                  <td><input type="text" size="12" maxlength="10" name=username></td>
                </tr>
                <tr>
                  <td>phone number</td>
                  <td><input type="text" size="30" name=phonenum></td>
                </tr>
                <tr>
                  <td>email</td>
                  <td><input type="text" size="30" name=email></td>
                </tr>
               </table>
              <input type="submit" value="insert">
              </pre></form>
HTML;
       echo "<h2>delete user information</h2>";
        $query = "SELECT * FROM user";
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);

        $rows = $result->num_rows;
        for ($i = 0 ; $i < $rows ; ++$i)
        {
          $result->data_seek($i);
          $row = $result->fetch_array(MYSQLI_NUM);
          echo<<<HTML
          <pre>
          user ID: $row[0]
          username: $row[1]
          password: $row[2]
          email: $row[3]
          phone number: $row[4]
        </pre>
        <form action="user.php" method="post">
        <input type="hidden" name="delete" value="yes">
        <input type=text name="userID" value="$row[0]">
        <input type="submit" name="delete" value="delete">
      </form>
HTML;
        }
        $result->close();
        $conn->close();

        function get_post($conn, $var)
        {
          return $conn->real_escape_string($_POST[$var]);
        }
        ?>

      </body>
</html>
