<html>
<head>
</head>
<body>
<?php

$indb = new mysqli("localhost", "root", "", "proj");
if ($indb->connect_error) {
  die("Connection failed: " . $indb->connect_error);
}
   if(isset($_POST['mid'])&&isset($_POST['mtitle'])&&isset($_POST['upload'])){

        $dday = date('Y-m-d');
        $intitle = $indb->real_escape_string($_POST['mtitle']);
        $inID =$indb->real_escape_string($_POST['mid']);//아이디는 가입된 유저니까 $_SESSION['login_user']요거 구냥 받아오자!
        $inmail = $indb->real_escape_string($_POST['mmail']);
        $incontents = $indb->real_escape_string($_POST['mcontents']);
        if(!isset($intitle)){
          echo "<script> alert('you need a title for your document!'); </script>";
        }
        $s = "INSERT INTO userdocument(userID, doctitle, contents, Fdate,email) VALUES ('$inID', '$intitle', '$incontents', '$dday', '$inmail')";
        $r = $indb->query($s);
        if(!$r){echo "INSERT failed: $s <br>".$indb->error ."<br><br>";
        }else{
          echo "<script> alert('you are done writing.'); </script>";
          echo "<script> alert('document $intitle is successfully uploaded!'); </script>";
            header("location: success.php");
        }

      }
      ?>
    </body>
    </html>
