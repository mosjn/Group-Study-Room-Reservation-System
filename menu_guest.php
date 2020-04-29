<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
	a,p,th,th,button{
		font-family: 'Pridi', serif;
		font-size: 14px;
        padding: 0;
	}	

</style>


<!-- Navbar -->
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>



<div id="login" class="w3-modal">
<form action="loginphp.php" method="post">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
      <h2 class="w3-wide" style="color:white;">ผู้ดูเเลระบบ</h2>
	<br>
      <p><input class="w3-input w3-border"placeholder="Username "  name="user_name" maxlength="20" pattern="[A-Za-z0-9_]{4,30}" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-30 ตัวอักษร"><br>
		<input class="w3-input w3-border" type="password" placeholder="Password"  id="password" name="password" pattern="[A-Za-z0-9]{8,20}" maxlength="20" required title="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร"></p>
      <button type="submit" name="submit"  value="submit" class="w3-button w3-padding-large w3-blue w3-margin-bottom" style="font-size:20px;">เข้าสู่ระบบ</button>
    </div>
  </div>
</form>
</div>
