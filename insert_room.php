
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

              $room_name = $_POST['room_name'];
			  $room_status = $_POST['room_status'];
			  $room_type = $_POST['room_type'];


                    
                $query_booking = "INSERT INTO `room` (`room_id`, `room_name`, `room_status`,`room_type`) VALUES (NULL, '$room_name', '$room_status','$room_type');";
                $result2=mysqli_query($con,$query_booking);                  
                if($result2){
                    echo '<script type="text/javascript">
					  alert("เพิ่มสำเร็จ"); 
					  window.location="management_room.php";
						</script>';
                }else{
                    echo '<script type="text/javascript">
					  alert("ไม่สำเร็จ"); 
					  window.location="javascript:history.back(1)";
						</script>'; 
                }
                    

          
}

              
           

             

    
?>


