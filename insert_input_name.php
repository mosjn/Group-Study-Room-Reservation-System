
<?php
	session_start();
	if(!isset($_SESSION['login'])){ 
                    echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="index.php";
						</script>';
	}else{
		

    include 'ConnectDB.php';
    mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");
	$user_name=$_SESSION['login'];

		


		
            if($_SESSION['status']=='2'){
                $query_user = "select * from user where status = '2'";
                $result_admin=mysqli_query($con,$query_user);
                $row_admin=mysqli_fetch_array($result_admin,MYSQLI_ASSOC);
                $user_admin = $row_admin['user_name'];
                    
                    
                $room_id = $_POST['room_id'];
                $time_now=date("Y-m-d");
                
                $t = $_POST['t_in'];
                $o = $_POST['t_out'];
                $user_name_st = $_POST['user_name'];
                $name= $_POST['name'];
                $faculty= $_POST['faculty_id'];
                $major= $_POST['major_id'];

			$sql2 = "SELECT * FROM faculty where faculty_id='$faculty'";
				$result_amphur=mysqli_query($con,$sql2); 
				$row_amphur=mysqli_fetch_assoc($result_amphur);
				$faculty_name = $row_amphur['faculty_name'];

			$sql3 = "SELECT * FROM major where major_id='$major'";
				$result_district=mysqli_query($con,$sql3); 
				$row_district=mysqli_fetch_assoc($result_district);
				$major_name = $row_district['major_name'];

                
        $check_time_admin = "SELECT  admin_booking.stu_id FROM admin_booking inner join booking ON  booking.booking_id = admin_booking.booking_id AND booking.booking_day LIKE '%".$time_now."%' where booking.user_name = '$user_name_st' and booking.booking_status='1' and booking.booking_in = '$t' or admin_booking.stu_id = '$user_name_st' and booking.booking_status='1' and booking.booking_in = '$t' or  booking.user_name = '$user_name_st' and booking.booking_status='2' and booking.booking_in = '$t'  or admin_booking.stu_id = '$user_name_st' and booking.booking_status='2' and booking.booking_in = '$t'";
        $result_check_time_admin=mysqli_query($con,$check_time_admin);      
        $count_check_time_admin=mysqli_num_rows($result_check_time_admin);              
        if($count_check_time_admin>='1'){
                                 echo '<script type="text/javascript">
                                  alert("ไม่สามารถจองได้มากกว่า 1 ห้องในเวลาเดียวกัน "); 
                                  window.location="javascript:history.back(1)";
                                    </script>';               
        }else{    
                
        $check_time = "SELECT * FROM `booking` where user_name = '$user_name_st' and booking_day='$time_now' and booking_status = '1' and booking_in = '$t' or user_name = '$user_name_st' and booking_day='$time_now' and booking_status = '2' and booking_in = '$t'";
        $result_check_time=mysqli_query($con,$check_time);      
        $count_check_time=mysqli_num_rows($result_check_time);
        if($count_check_time>='1'){
                               echo '<script type="text/javascript">
                                  alert("ไม่สามารถจองได้มากกว่า 1 ห้องในเวลาเดียวกัน "); 
                                  window.location="javascript:history.back(1)";
                                    </script>';          
        }else{
                
                $query_booking = "SELECT * FROM `booking` where user_name = '$user_name_st' and booking_day='$time_now' and booking_status = '1' or user_name = '$user_name_st' and booking_day='$time_now' and booking_status = '2'";
                $result2=mysqli_query($con,$query_booking);
                 $count_hr_admin=mysqli_num_rows($result2);
                    
                            $query_room = "SELECT  admin_booking.stu_id FROM admin_booking inner join booking ON  booking.booking_id = admin_booking.booking_id AND booking.booking_day LIKE '%".$time_now."%' where booking.user_name = '$user_name_st' and booking.booking_status='1' or admin_booking.stu_id = '$user_name_st' and booking.booking_status='1' or  booking.user_name = '$user_name_st' and booking.booking_status='2'  or admin_booking.stu_id = '$user_name_st' and booking.booking_status='2'  order by booking.booking_id";
                            $result_room=mysqli_query($con,$query_room);
                            $count_hr=mysqli_num_rows($result_room);
                
                $count_all = $count_hr_admin+$count_hr;
                
                if($count_all>='3'){
                             echo '<script type="text/javascript">
                                  alert("รหัสนิสิตนี้จองครบ 3 ชั่วโมงเเล้ว"); 
                                  window.location="javascript:history.back(1)";
                                    </script>';

                    }else{

                    
                    if($count_all>='3'){
                             echo '<script type="text/javascript">
                                  alert("รหัสนิสิตนี้ได้จองห้องครบ 3 ชั่วโมงเเล้ว "); 
                                  window.location="javascript:history.back(1)";
                                    </script>';
                            
                        }else{
/*
                            $query_room1 = "SELECT * FROM `booking` where  booking_day LIKE '%".$time_now."%' and user_name = '$user_name_st' and booking_status='1' or booking_day LIKE '%".$time_now."%' and user_name = '$user_name_st' and booking_status='2'";
                            $result_room1=mysqli_query($con,$query_room1);
                            $row_ss_room=mysqli_fetch_array($result_room1,MYSQLI_ASSOC);*/
                       /*     $count_hr1=mysqli_num_rows($result_room1);*/
                         
 /*                       
                         if($row_ss_room==null){*/
                            $sql_booking = "INSERT INTO `booking` (`booking_id`, `room_id`, `booking_day`, `booking_in`, `booking_out`, `booking_date`, `booking_status`, `user_name`) VALUES (NULL, '$room_id', '$time_now', '$t', '$o', Now(), '0', '$user_name');";
                            $result_sql=mysqli_query($con,$sql_booking);
/*
                         }else{
                            echo '<script type="text/javascript">
                                  alert("ไม่สำเร็จ "); 
                                 window.location="javascript:history.back(1)";
                                    </script>'; 
                         }*/
                        

                        
                          
                            if($result_sql){

                            $query_booking = "SELECT * FROM `booking` WHERE user_name = '$user_admin' and booking_status='0' order by booking_id asc";
                            $result_query_booking=mysqli_query($con, $query_booking);
                            $row_query_booking=mysqli_fetch_array($result_query_booking,MYSQLI_ASSOC);
                            $booking_id = $row_query_booking['booking_id'];
                                
                                
                        
                            $sql_insert_ad = "INSERT INTO `admin_booking` (`name`, `booking_id`, `stu_id`, `faculty`, `major`) VALUES ('$name', '$booking_id', '$user_name_st', '$faculty_name', '$major_name')";
                            $result_query_booking=mysqli_query($con, $sql_insert_ad);
                                
                                $sql_update = "update booking set booking_status = '1' where booking_id = '$booking_id'";
                                $result_query_update=mysqli_query($con, $sql_update);
                                
                                echo '<script type="text/javascript">
                                  alert("จองสำเร็จ"); 
                                 window.location="index.php";
                                    </script>';
                            }else{
                                   echo '<script type="text/javascript">
                                  alert("จองไม่สำเร็จ"); 
                                  window.location="javascript:history.back(1)";
                                    </script>';                          
                            }
                        
                        }
                    }
                }
        }
           

                //ลูกค้า
            }else{
                    echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="index.php";
						</script>';
                

        }
    }
?>


