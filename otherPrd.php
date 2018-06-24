<?php
require_once ("dbconfig.php");
$result = mysqli_query($conn, "select * from product where prd_no ='" . $_POST['prd_no'] . "'");

while ($row = mysqli_fetch_assoc($result)) {
    
    $obj = new stdClass();
    $obj -> prd = $row['prd_no'];
    $obj -> nm = $row['prd_nm'];
    $obj -> price = $row['price'];
    $obj -> des_1 = $row['prd_des_1'];
    $obj -> des_2 = $row['prd_des_2'];
    $prdArray[] = $obj;
    unset($obj);
}
    $data = json_encode($prdArray);

    echo $data;

?>