<?php
require_once("dbconfig.php");
session_start();
$id = $_SESSION['user_id'];
//$callOrderList = mysqli_query($conn, "select * from product where prd_no = ANY(select prd_no from order_list where id='$id')");  --> 서브 쿼리 사용하려 했지만 prd_no가 중복되면 에러가 났습니다.
$callOrderList = mysqli_query($conn, "select prd_no from order_list where id='$id'");
?>
<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	margin : auto;
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
            <?php if(!isset($_SESSION['user_id'])){?>
              <a class="nav-link" href="login.php">Log In</a>
              <?php } else {?>
              <a class="nav-link" href="logout.php" >Log Out</a>
              <?php } ?>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="basket.php" onclick = "return sessChk();">Basket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="orderList.php" onclick = "return sessChk();">OrderList</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->

		<table border="1" class="type09">
			<thead>
				<tr>
					<th>제품</th>
					<th>품명</th>
					<th>가격</th>
				</tr>
			</thead>
			<tbody>
			<?php while ($row = mysqli_fetch_assoc($callOrderList)) { 
			    $callProductList = mysqli_query($conn, "select * from product where prd_no='".$row['prd_no']."'");
			    while($row = mysqli_fetch_assoc($callProductList)){?>
				<tr>
					<th><img class="card-img-top"
						src="img/<?= $row["prd_no"]?>.jpg" /></th>
					<td><?php echo $row["prd_nm"];?></td>
					<td><?php echo number_format($row["price"]);?></td>
				</tr>
				<?php }}?>
			</tbody>
		</table>

            <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  </body>

</html>