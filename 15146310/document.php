<?php
   include"session.php";


$db = new mysqli("localhost","root","","proj");
   if ($db->connect_error) {
     die("Connection failed: " . $db->connect_error);
   }

//for variables
function get_post($db, $var)
{
  return $db->real_escape_string($_POST[$var]);
}

?>

<html>
<head>
  <title>user document management</title>
</head>

<body>
  <h1>Document List</h1>
  <h4>you are free to access documents.</h4>
  <a href='success.php'> return to login page </a><br/>
    <?php
    //list all the document!!!!!!!!!!

    $showsql = " SELECT * FROM userdocument ";
    $res = $db->query($showsql);
    if (!$res) die ("Database access failed: " . $db->error);
      while($board = $res->fetch_array()){
        $title=$board["doctitle"];
					if(strlen($title)>30){
						$title=str_replace($board["doctitle"],mb_substr($board["doctitle"],0,30,"utf-8")."...",$board["doctitle"]);
					}
      $rows = $res->num_rows;
          for ($i = 0 ; $i < $rows ; ++$i)
          {
            $res->data_seek($i);
            $row = $res->fetch_array(MYSQLI_NUM);
          echo<<<HTML
         <form action="document.php" method="post">
           <table border="1">
             <tr>
               <td>Document number</br>
HTML;
            if($row[0]==$_SESSION['login_user']){
                     $loginid = $_SESSION['login_user'];
                     $etitle=$row[1];
                     $econ=$row[2];
                     $uremail=$row[4];
                     $urdate= $row[3];
                     //로그인된유저
                   echo<<<HTML

                   <input type="submit" name="deletethis" value="delete" id="deletethis">
                   <input type="submit" name="editthis" value="edit" id="editthis">
HTML;
                 }else{
                   echo"</br>".""."</br>";
                 }
            echo<<<HTML
          </td>
                   <td><input type="text" size="50" name="thisdn" value="$row[5]" id="thisdn"></td>
                 </tr>
               <tr>
                 <td>user ID</td>
                 <td><input type="text" size="50" name="userID" value="$row[0]"></td>
               </tr>
               <tr>
                 <td>Title</td>
                 <td><input type="text" size="50" name="doctitle" value="$row[1]"></td>
               </tr>
               <tr>
                 <td>Contents</td>
                 <td><input type="text" size="50" name=contents value="$row[2]"></td>
               </tr>
               <tr>
                 <td>Date</td>
                 <td><input type="text" size="50" name="date" value="$row[3]"></td>
               </tr>
               <tr>
                 <td>E-mail</td>
                 <td><input type="text" size="50" name=email value="$row[4]"></td>
               </tr>
               </table>
             </form>
             <!--<input type="submit" value="read" name="read" id="read"/> button to read document!!!!!!!!!!!!!-->

HTML;

      }
//only allowed to delete or edit document when it is their own

         echo<<<HTML
          <form action="document.php" method="POST">
            <input type="submit" value="new document" name="write" id="write">
        </form>
HTML;

  }

  //delete!!!!!!!!!!!!!!!!!!!!!1댓ㅅ음
  if (isset($loginid)&&isset($_POST['deletethis'])){
    $dud= get_post($db, 'thisdn');
    $dquery = "DELETE FROM userdocument WHERE dn='$dud'";
    $dresult = $db->query($dquery);
      echo "<script> alert('document is successfully deleted!'); </script>";
      ?>
      <meta http-equiv="refresh" content='0; url=success.php'>
      <?php
    if (!$dresult) {echo " DELETE failed: $dquery<br>" .$db->error . "<br><br>";
}
  }




  if(isset($_POST['write'])){
    $loginid=$_SESSION['login_user'];
    $qemail = "SELECT * FROM user WHERE userID='$loginid'";
    $remail = $db->query($qemail);
    if (!$remail) die($db->error);
      $romail = $remail->fetch_assoc();
      $uremail=$romail['email'];


    echo<<<HTML
    <!--- insert document -->
              <h3>write new document</h3>
              <a href='document.php'> return to document lists </a>
            	<form name="f" action="writepost.php" method="POST">
            		<table border="2">
                  <tr>
            				<td>Title</td>
            				<td><input type="text" name="mtitle" placeholder="title" id="mtitle"></td>
            			</tr>
            			<tr>
            				<td>User ID</td>
            				<td><input type="text" name="mid" value="$loginid" id="mid"></td>
            			</tr>
            			<tr>
            				<td>User E-mail</td>
            				<td><input type="text" name="mmail" value="$uremail" id="mmail"></td>
            			</tr>
            			<tr>
            				<td colspan=2>document contents</td>
            			</tr>
            			<tr>
            				<td colspan=2><textarea rows="30" cols="40" name="mcontents" placeholder="write anything in your mind" id="mcontents"></textarea></td>
            			</tr>
            			<tr>
            				<td colspan=2><input type="submit" value="upload" name="upload" id="upload">
            				<input type="reset" value="reset document"></td>
            			</tr>
            		</table>
            	</form>

HTML;

}

//modify!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
        if(isset($loginid)&&isset($_POST['editthis'])){
              $eud= $db->real_escape_string($_POST['thisdn']);
              $q = "SELECT * FROM userdocument WHERE dn='$eud'";
              $r = $db->query($q);
              if (!$r) die($db->error);
                $ro = $r->fetch_assoc();
                $nt=$ro['doctitle'];
                $nm=$ro['email'];
                $ncontents=$ro['contents'];

           echo<<<HTML
           <h3>edit document</h3>
           <form name="ff" action="document.php" method="POST">
             <table border="2">
               <tr>
                 <td>Title</td>
                 <td><input type="text" placeholder="$nt" name="utitle" id="utitle"></td>
               </tr>
               <tr>
                 <td>User ID</td>
                 <td><input type="text" name="uid" value="$loginid" id="uid"></td>
               </tr>
               <tr>
                 <td>User E-mail</td>
                 <td><input type="text" name="umail" value="$nm" id="umail"></td>
               </tr>
               <tr>
                 <td colspan=2>"edit document"</td>
               </tr>
               <tr>
                 <td colspan=2><textarea rows="30" cols="40" name="ucontents" id="ucontents" > $ncontents </textarea></td>
               </tr>
               <tr>
                 <td colspan=2><input type="submit" value="edit complete" name="edited" id="edited">
                 <input type="reset" value="reset document"></td>
               </tr>
             </table>
             <input type="hidden" value="$eud" id="eedn" name="eedn">
             <input type="hidden" name="update" value="yes">
           </form>
HTML;
}
          $newdb = new mysqli("localhost", "root", "", "proj");
          if ($newdb->connect_error) {
            die("Connection failed: " . $newdb->connect_error);
          }
              if (isset($_POST['edited']))
              {
                $myid= $_SESSION['login_user'];
                $newday = date('Y-m-d');

                $eud = $newdb->real_escape_string($_POST['eedn']);
                $ut = $newdb->real_escape_string($_POST['utitle']);
                $uc = $newdb->real_escape_string($_POST['ucontents']);
                $um = $newdb->real_escape_string($_POST['umail']);

                $upsql="UPDATE userdocument SET doctitle='$ut', contents='$uc', email='$um', Fdate='$newday' WHERE dn='$eud'";
                $newresult = $db->query($upsql);
                echo "<script> alert('document is edited.'); </script>";
                ?>
                <meta http-equiv="refresh" content='0; url=success.php'>
                <?php

                if (!$newresult) echo " update failed: $upsql<br>" .$db->error . "<br><br>";
            }


?>


<!--- modify document -->


</body>

</html>
