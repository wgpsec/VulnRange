<?php header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启 ?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>水平越权</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<main>
  <form class="form" action="login.php" method="post">
  	<input type="text" name="login" style="display: none;"/>
    <div class="form__cover"></div>
    <div class="form__loader">
      <div class="spinner active">
        <svg class="spinner__circular" viewBox="25 25 50 50">
          <circle class="spinner__path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
        </svg>
      </div>
    </div>
    <div class="form__content">
      <h1>请登录</h1>
      <h4 style="color: white">测试用户：test/test</h4>
      <div class="styled-input">
        <input type="text" class="styled-input__input" name="username">
        <div class="styled-input__placeholder"> 
          <span class="styled-input__placeholder-text">用户名</span> 
        </div>
        <div class="styled-input__circle"></div>
      </div>
      <div class="styled-input">
        <input type="text" class="styled-input__input" name="password">
        <div class="styled-input__placeholder"> <span class="styled-input__placeholder-text">密码</span> </div>
        <div class="styled-input__circle"></div>
      </div>
      <button type="submit" class="styled-button"> <span class="styled-button__real-text-holder"> <span class="styled-button__real-text">登录</span> <span class="styled-button__moving-block face"> <span class="styled-button__text-holder"> <span class="styled-button__text">登录</span> </span> </span><span class="styled-button__moving-block back"> <span class="styled-button__text-holder"> <span class="styled-button__text">登录</span> </span> </span> </span> </button>
    </div>
  </form>
</main>
<script  src="js/index.js"></script>
</body>
</html>
