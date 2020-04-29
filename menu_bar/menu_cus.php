<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
	a,p,th,th,button{
		font-family: 'Pridi', serif;
		font-size: 14px;
        padding: 0;
	}	

</style>

<?php
                    $now_y =  date('Y-m-d');
                    $date_yy = new DateTime($now_y);
                    $now_y1 =  date('Y');
                    if($date_yy->format('m-d')>='10-01' and $date_yy->format('m-d')<='12-31')
                    {
                        $now_y_l=$now_y1+1;
                    }else{
                      $now_y_l=  $now_y1;
                    }

                   $user_name=$_SESSION['login'];
                   $sql_report = "SELECT * from booking where booking_status = '1' and user_name = '$user_name'";
	               $result_report = mysqli_query($con, $sql_report);
	               $count_report=mysqli_num_rows($result_report);               

                   $sql_report1 = "SELECT  admin_booking.stu_id FROM admin_booking inner join booking ON  booking.booking_id = admin_booking.booking_id WHERE booking.booking_status='1' and admin_booking.stu_id='$user_name' order by booking.booking_id";
	               $result_report1 = mysqli_query($con, $sql_report1);
	               $count_report1=mysqli_num_rows($result_report1);

                    $count = $count_report+$count_report1;
?>
<!-- Navbar -->
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">KU Library</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index_today.php">Home</a> </li>

        <li><a href="profile.php">ข้อมูลส่วนตัว</a></li>
        <li><a href="history_stu.php">ประวัติจองห้อง</a></li>
        <li><a href="list_booking.php">รายการจองห้อง <span class="w3-badge w3-red" style="font-size:16px;"><?php if($count>0) { echo $count; } ?></span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li><a onclick="logout()" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
      </ul>
    </div>
  </div>
</nav>


