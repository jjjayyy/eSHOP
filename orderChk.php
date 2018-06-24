<?php
require_once ("dbconfig.php");
session_start();

$userInfo = mysqli_query($conn, "select * from user");

$id = "";
$user_nm = "";
$phone = 0;
$addr = "";

//주문한 회원 정보 저장하기 위해 불러옵니다.
while ($row = mysqli_fetch_assoc($userInfo)) {
    if($_SESSION['user_id']==$row['id']){
       $id = $row['id'];
       $user_nm = $row['user_nm'];
       $phone = $row['phone'];
       $addr = $row['addr'];  
    }
}

//주문자 정보 및 상품 정보 저장
if(isset($_SESSION['cart'])){ 
    if (!empty($_SESSION['cart'])){
        foreach ($_SESSION["cart"] as $keys => $values) {
            $prd_no = $values['item_id'];
            $price = $values['item_price'];
            $insertOrder = mysqli_query($conn, "insert into order_list (id, ord_price, user_nm, phone, addr, ord_date, prd_no) values ('$id','$price','$user_nm','$phone','$addr',curdate(),'$prd_no')");
        }
    }
}

unset($_SESSION['cart']);


echo("<script>alert('결제가 완료되었습니다. 주문내역 페이지로 이동합니다.');location.href='orderList.php';</script>"); 

?>