<?php
require_once ("dbconfig.php");
$prdNo = $_GET['prdNo'];
$result = mysqli_query($conn, 'select * from product where prd_no = ' . $prdNo);
$row = mysqli_fetch_assoc($result);
session_start();

if (isset($_SESSION['user_id'])) {
    if (isset($_POST["addCart"])) {
        if (isset($_SESSION["cart"])) {
            $item_array = array_column($_SESSION["cart"], 'item_id');
            if (! in_array($_POST["prd_no"], $item_array)) {
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'item_id' => $_POST["prd_no"],
                    'item_name' => $_POST["prd_nm"],
                    'item_price' => $_POST["price"]
                );
                $_SESSION["cart"][$count] = $item_array;
            }
        } else {
            $item_array = array(
                'item_id' => $_POST["prd_no"],
                'item_name' => $_POST["prd_nm"],
                'item_price' => $_POST["price"]
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Shop Homepage</title>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="css/shop-homepage.css" rel="stylesheet">

<script src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>
<script>

function comma(num){
    var len, point, str; 
       
    num = num + ""; 
    point = num.length % 3 ;
    len = num.length; 
   
    str = num.substring(0, point); 
    while (point < len) { 
        if (str != "") str += ","; 
        str += num.substring(point, point + 3); 
        point += 3; 
    } 
    return str;
}

function selectColor(color_cat){
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "color.php",
		data : {'color_cat' : color_cat}
	}).done(function(data){

		var thumnail = "";
		for(var i = 0; i <data.length; i++){
			thumnail += "<div class='col-lg-4 col-md-6 mb-4'>";
			thumnail += "<div class='card h-100'>";
			thumnail += "<a href = '#' onclick='another("+ data[i].prd + ");'> <img class='card-img-top' src='img/" + data[i].prd + ".jpg'> </a>";
			thumnail += "</div>";
			thumnail += "</div>";
		}
		
		$('.text-warning').html(thumnail)
	})
}

function another(prd_no){
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "otherPrd.php",
		data : {'prd_no' : prd_no}
	}).done(function(data){
		console.log(data);
		var other = "";
		other += "<div class='card mt-4'>";
        other += "<img class='card-img-top img-fluid' src='img/" + data[0].prd + ".jpg'>";
        other += "<div class='card-body'>";
        other += "<h3 class='card-title'>" +  data[0].nm + "</h3>";
        other += "<h4> " + comma(data[0].price) + "원</h4>";
        other += "<p class='card-text'>" + data[0].des_1 + "</p>";
        other += "<hr/>";
        other += "<p class='card-text'>" + data[0].des_2 + "</p>";
        other += "</div>";
        other += "<form method='post'>";
        other += "<input type='hidden' name='prd_no' value='<?php echo $row['prd_no']?>'/>";
        other += "<input type='hidden' name='prd_nm' value='<?php echo $row['prd_nm']?>'/>";
        other += "<input type='hidden' name='price' value='<?php echo $row['price']?>'/>";
        other += "<input type='submit' value='장바구니 담기' name='addCart' onclick = 'orderAlert()'></form></div>";
        $('.col-lg-9').html(other);
})
}

function sessChk(){
	<?php if(!isset($_SESSION['user_id'])){?>
		alert("회원만 이용가능합니다");
		location.href="login.php";
		return false;
	<?php } else {?>
		return true;
		<?php } ?>
}

function orderAlert(){
	<?php if(!isset($_SESSION['user_id'])){?>
	alert("회원만 이용가능합니다");
	location.href="login.php";
	return false;
	<?php } else {?>
	alert("장바구니에 추가되었습니다! 장바구니를 확인해주세요.");
	<?php } ?>
}
</script>
<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="home.php">eSHOP</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarResponsive" aria-controls="navbarResponsive"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a class="nav-link" href="home.php">Home
							<span class="sr-only">(current)</span>
					</a></li>
					<li class="nav-item">
            <?php if(!isset($_SESSION['user_id'])){?>
              <a class="nav-link" href="login.php">Log In</a>
              <?php } else {?>
              <a class="nav-link" href="logout.php">Log Out</a>
              <?php } ?>
            </li>
					<li class="nav-item"><a class="nav-link" href="basket.php"
						onclick="return sessChk();">Basket</a></li>
					<li class="nav-item"><a class="nav-link" href="orderList.php"
						onclick="return sessChk();">OrderList</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">

		<div class="row">
			<div class="col-lg-3">
				<h1 class="my-4">eSHOP</h1>
				<div class="list-group">
            <a href="home.php?cateNo=1" class="list-group-item">Sunglass</a>
            <a href="home.php?cateNo=2" class="list-group-item">Glasses</a>
            <a href="home.php?cateNo=3" class="list-group-item">Bags</a>
				</div>

			</div>
			<!-- /.col-lg-3 -->

			<div class="col-lg-9">
				<div class="card mt-4">

					<img class="card-img-top img-fluid"
						src="img/<?= $row['prd_no']?>.jpg" alt="">
					<div class="card-body">
						<h3 class="card-title"><?= $row['prd_nm']?></h3>
						<h4><?=number_format($row['price']);?>원</h4>
						<p class="card-text"><?= $row['prd_des_1']?></p>
						<hr />
						<p class="card-text"><?= $row['prd_des_2']?></p>

					</div>

				</div>
				<form method="post">
					<input type="hidden" name="prd_no"
						value="<?php echo $row['prd_no']?>" /> <input type="hidden"
						name="prd_nm" value="<?php echo $row['prd_nm']?>" /> <input
						type="hidden" name="price" value="<?php echo $row['price']?>" /> <input
						type="submit" value="장바구니 담기" name="addCart"
						onclick="orderAlert()">
				</form>
			</div>

			<div class="col-foot">
				<div class="card mt-4">
					<div class="card-body">
						<span class="text-warning">
                   <?php
                $color = $row['color_cat'];
                echo ("<script>selectColor(\"$color\");</script>");
                ?>
                </span>
					</div>
				</div>
			</div>
			<!-- /.card -->

			<!-- /.col-lg-9 -->

		</div>

	</div>
	<!-- /.container -->
	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
