<?php
require_once ("dbconfig.php");
session_start();

//삭제 버튼 클릭시 해당 제품 세션(장바구니 목록)에서 삭제
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("삭제 되었습니다!")</script>';
                echo '<script>window.location="basket.php"</script>';
            }
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
<style>
table.type09 {
	border-collapse: collapse;
	text-align: left;
	line-height: 1.5;
	margin: auto;
}

table.type09 thead th {
	padding: 10px;
	font-weight: bold;
	vertical-align: top;
	color: #369;
	border-bottom: 3px solid #036;
}

table.type09 tbody th {
	width: 150px;
	padding: 10px;
	font-weight: bold;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
	background: #f3f6f7;
}

table.type09 td {
	width: 350px;
	padding: 10px;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
}
</style>
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

	<!-- 장바구니 리스트 -->
			<?php if (! empty($_SESSION["cart"])) {$total = 0;?>
	<form action="orderChk.php">
		<table border="1" class="type09">
			<thead>
				<tr>
					<th>제품</th>
					<th>품명</th>
					<th>가격</th>
					<th>취소</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($_SESSION["cart"] as $keys => $values) { ?>
				<tr>
					<th><img class="card-img-top"
						src="img/<?= $values["item_id"]?>.jpg" /></th>
					<td><?php echo $values["item_name"];?></td>
					<td><?php echo number_format($values["item_price"]);?></td>
					<td><a
						href="basket.php?action=delete&id=<?php echo $values["item_id"]?>">삭제</a></td>
				</tr>
				<?php $total = $total + $values['item_price'];}   ?>
				<tr>
					<td colspan="2">총금액</td>
					<td colspan="2"><?php echo number_format($total);?></td>
				</tr>
			</tbody>
		</table>
		<input type="submit" value="결제하기">
	</form>
	<?php } else {?>
	<h2>주문하신 상품이 없습니다.</h2>
	<?php }?>


	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>