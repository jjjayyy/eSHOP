<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">

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
              <a class="nav-link" href="login.php">Log In</a>
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

<div class="layer">
<form method = "POST" action = "login_ok.php">
  <div id="wrap">
   <h1 class="member">member login</h1>
   <div class="form">
    <div class="form2">
     <div class="form3">
      <label for="user">아이디</label><input type="text" name="user_id">
      <div class="clear"></div>
      <label for="user">비밀번호</label><input type="password" name="user_pw">
     </div>
     <input type="submit" value="로그인하기">
     <div class="clear"></div>
     <div class="form4">
      <label><input type="checkbox">아이디저장</label> 
      <div class="clear"></div>
      <label><input type="button" onClick="location.href='signup.php'" value="회원가입"></label>
     </div>
    </div>
   </div>
  </div>
 </form>

</div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>