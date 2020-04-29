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
        <li class="active"><a href="index_today.php">หน้าเเรก</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">รายงาน <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="confirm_booking.php">ยืนยันเข้าห้อง</a></li>
            <li><a href="history_booking.php">ประวัติการจอง</a></li>           
            <li><a href="management_member.php">ข้อมูลสมาชิก</a></li>
          </ul>
        </li>
        <li><a href="management_room.php">จัดการห้องติว</a></li>
        <li><a href="management_time.php">จัดการเวลาจอง</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a onclick="logout()" style="cursor:pointer;"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
      </ul>
    </div>
  </div>
</nav>


