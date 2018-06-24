<?php
require_once ("dbconfig.php");
//중복된 아이디 체크
$result = mysqli_query($conn, "select * from user");
   $id =  $_POST['id'];
   $chk = 0;
    
while ($row = mysqli_fetch_assoc($result)) {
    
    if($id == $row['id']){
        $chk = 0;
    } else {
        $chk = 1;
    }
}
    echo $chk;

?>