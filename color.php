<?php
    
require_once("dbconfig.php");
//같은 제품의 다른 색상들을 Ajax로 넘겨주기 위한 php
    $resultColor = mysqli_query($conn, "select * from product where color_cat ='" . $_POST['color_cat'] . "'");
 
    $prdArray = array();
        while ($row = mysqli_fetch_assoc($resultColor)){
            
            $obj = new stdClass();
            $obj -> prd = $row['prd_no'];       
            $prdArray[] = $obj;
            unset($obj);
    }
        $data = json_encode($prdArray);
       
        echo $data;
     
?>


