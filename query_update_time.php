
<?php
	session_start();

		

    include 'ConnectDB.php';
    mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");
	 if($_SESSION['status']!='2'){ 
                    echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="tomorrow.php";
						</script>';
	}else{

              $time_id = $_POST['time_id'];
              $time_in = $_POST['time_in'];
              $time_out = $_POST['time_out'];
              $time_status = $_POST['time_status'];


                    
                $query_booking = "update time set time_in = '$time_in', time_out='$time_out', time_status='$time_status' where time_id = '$time_id'";
                $result2=mysqli_query($con,$query_booking);                  
                if($result2){
                    echo '<script type="text/javascript">
					  alert("เเก้ไขสำเร็จ"); 
					  window.location="management_time.php";
						</script>';
                }else{
                    echo '<script type="text/javascript">
					  alert("ไม่สำเร็จ"); 
					  window.location="javascript:history.back(1)";
						</script>'; 
                }
                    

          
}

              
           

             

    
?>


