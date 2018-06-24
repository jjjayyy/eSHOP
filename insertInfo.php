<?php
require_once ("dbconfig.php");
//회원가입 정보 DB 저장
$id = $_POST['userid'];
$pw = $_POST['pwd1'];
$phone = $_POST['phone'];
$sex = $_POST['sex'];
$birthday = $_POST['birthday'];
$user_nm = $_POST['user_nm'];
$addr = $_POST['addr'];

$result = mysqli_query($conn, "insert into user (id, phone, pw, sex, birthday, reg_date, user_nm, addr) values ('$id','$phone','$pw','$sex','$birthday',curdate(),'$user_nm','$addr')");

echo("<script>location.href='login.php';</script>"); 

?>