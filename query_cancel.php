
<?php
	session_start();
	if(!isset($_SESSION['login'])){ 
            echo 'กรุณาเข้าสู่ระบบก่อน';
	}else{
		

    include 'ConnectDB.php';
    mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");
	$user_name=$_SESSION['login'];

		


		
            if($_SESSION['status']=='2'){

                $booking_id = $_GET['id'];
                $query_booking = "update booking set booking_status = '3' where booking_id = '$booking_id'";
                $result2=mysqli_query($con,$query_booking);
                 echo 'ยกเลิกรายการเเล้ว';
           

                //ลูกค้า
            }else{
          

                $booking_id = $_GET['id'];
                $query_booking = "update booking set booking_status = '3' where booking_id = '$booking_id'";
                $result2=mysqli_query($con,$query_booking);
                 echo 'ยกเลิกรายการเเล้ว';
                

        }
    }
?>


