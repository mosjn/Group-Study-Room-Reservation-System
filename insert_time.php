
<?php
	session_start();

		

    include 'ConnectDB.php';
    mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");
	if(!isset($_SESSION['login'])){ 
                    echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="tomorrow.php";
						</script>';
	}else{

              $time_in = $_POST['time_in'];
              $time_out = $_POST['time_out'];
            


                    
                $query_booking = "INSERT INTO `time` (`time_id`, `time_in`, `time_out`, `time_status`) VALUES (NULL, '$time_in', '$time_out', '0');";
                $result2=mysqli_query($con,$query_booking);                  
                if($result2){
                    echo '<script type="text/javascript">
					  alert("เพิ่มสำเร็จ"); 
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


