<?php 
	session_start();
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
	include 'menu_bar/library .php';
	?>
    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
    </style>
<script>
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</head>
<body>

<?php 
    
    include 'ConnectDB.php';
    include 'menu_bar/menu_bar.php';
   
    ?>
  

    <center>
        <div class="col-sm-6">
      
            <div class="login-page">
                    <h3 style="color:white;">เข้าสู่ระบบ</h3>
              <div class="form">

                <form class="login-form" action="loginphp.php" method="post">
                  <input type="text" placeholder="username" name="user_name" pattern="[a-z0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องตัวเลข มีความยาว 10 ตัวอักษร" required/>
                  <input type="password" placeholder="password" name="password" pattern="[A-Za-z0-9]{8,20}" maxlength="20" required title="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร" required/>
                  <button name="submit" value="submit">login</button>
                  <p class="message"><a href="remember_pass.php" style="color:#000000;">ลืมรหัสผ่าน</a> &nbsp;<a href="register.php">สมัครสมาชิก</a></p>
                </form>
              </div>
            </div>
            
        </div> 
        <div class="col-sm-6">
          
            <div class="login-page">
                  <h3 style="color:white;">ข้อควรปฏิบัติ *</h3>
                
            </div>
              <h4 style="color:white;">1. เมื่อจองเเล้วควรมายืนยันก่อนเวลาจอง หรือช้าไม่น้อยกว่า 15 นาที มิฉะนั้นจะถือว่าสละสิทธิ์</h4>
              <h4 style="color:white;">2. หนึ่งท่านสามารถจองได้ 1 ห้อง ห้องละ 3 ชั่วโมงต่อวันเท่านั้น ค่าปรับ ชั่วโมงละ 30 บาท (เกินกำหนด 15 นาที คิดเป็น 1 ชั่วโมง)</h4>
        </div>
    </center>



</body>
</html>
