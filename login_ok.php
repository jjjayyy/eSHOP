<?php
require_once ("dbconfig.php");
//로그인 시 ID와 PW 확인
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

$result = mysqli_query($conn, "select * from user where id = '$user_id' and pw = '$user_pw' ");
$cnt = mysqli_num_rows($result);

if($cnt == 1) {
    session_start();
    $_SESSION['user_id'] = $user_id;
    echo("<script>location.href='home.php';</script>"); 
} else {
    
    echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
    exit;
}


?>