<?php
	require_once("dbconfig.php");
	session_start();
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
<script>
//로그인 여부 체크
	function sessChk(){
		<?php if(!isset($_SESSION['user_id'])){?>
			alert("회원만 이용가능합니다");
			location.href="login.php";
			return false;
		<?php } else {?>
			return true;
			<?php } ?>
	}

</script>
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

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="img/main1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/main2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="img/main3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

		<!-- 상품 리스트 -->
          <div class="row">
              	<?php

              	//카테고리 선택하면 해당 카테고리에 맞는 제품 리스트 출력
              	if(isset($_GET['cateNo'])){
              	    $result = mysqli_query($conn, "select * from product where cate_no =" . $_GET['cateNo'] . " " . "group by color_cat order by prd_no asc" );
              	} else {              	    
              	//전체 제품 리스트 출력
              	     $result = mysqli_query($conn, "select * from product group by color_cat order by prd_no asc");
              	}
              	     while ($row = mysqli_fetch_assoc($result)){
              	?>
              	
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="prdDetail.php?prdNo=<?= $row['prd_no']?>"><img class="card-img-top" src="img/<?= $row['prd_no']?>.jpg" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="prdDetail.php?prdNo=<?= $row['prd_no']?>"><?= $row['prd_nm']?></a>
                  </h4>
                  <h5><?= number_format($row['price']);?>원</h5>

                </div>
                <div class="card-footer">
                  <small class="text-muted">

                  	
                  </small>
                </div>
              </div>
            </div>
			<?php }?>
       
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  </body>

</html>