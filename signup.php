<?php
	require_once("dbconfig.php");
?>


<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">

 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  

<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
</head>
<script>

	function chk(){
			if($('input[name=userid]').val().length==0){
				alert("아이디를 입력해주세요");
				return false;			
			}
			$.ajax({
				type:"POST",
				url : "idChk.php",
				data : {'id' : $('input[name=userid]').val()}
			}).done(function(data){
				if(data==0){
					alert("중복된 아이디가 존재합니다");
					return false;
				} else {
			
					alert("회원가입이 완료 되었습니다!");
					return true;
		
		}
			}
	)}

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
<form action = "insertInfo.php" method = "post" onsubmit="return chk();">
<fieldset>
<legend>로그인 정보</legend>
<ol>
  <li>
    <label for="userid">아이디</label>
    <input id="userid" name="userid" type="text" required autofocus>
  </li>
  <li>
    <label for="pwd1">비밀번호</label>
    <input id="pwd1" name="pwd1" type="password"  required>
  </li>


</ol>
</fieldset>
<fieldset>
<legend>개인 정보</legend>
<ol>
  <li>
    <label pwd="fullname">핸드폰</label>
    <input id="phone" name="phone" type="text" placeholder="-없이 숫자로만 입력해주세요" required>
  </li>
    <li>
    <label pwd="fullname">주소</label>
    <input id="addr" name="addr" type="text" required>
  </li>
    <li>
    <label pwd="fullname">이름</label>
    <input id="user_nm" name="user_nm" type="text" required>
  </li>
  <li>
    <label pwd="sex">성별</label>
    	<input type = "radio" name = "sex" value = "1"/> 남자
    	<input type = "radio" name = "sex" value = "2"/> 여자
  </li>
  <li>
    <label pwd="tel">생일 </label>
    <input id="birthday" name="birthday" type="text" placeholder="20001020 양식으로 입력해주세요" required>
  </li>  
</ol>
</fieldset>

<fieldset>
  <input type="submit" name ="submit" value = "가입"/> 
</fieldset>
</form>
</div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>