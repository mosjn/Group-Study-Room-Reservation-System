
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




           

                //ลูกค้า
            }else{
                $room_id = $_GET['id'];
                $t = $_GET['ro'];
                $o = $_GET['o'];
                    $time_nows=date("d-m-Y");
					$date_n = new DateTime($time_nows);
					$start = new DateTimeImmutable($date_n->format('Y/m/d'));
					$datetime = $start->modify('+1 day');
                
                
              
                $query_booking = "SELECT * FROM `booking` where room_id = '$room_id' and booking_in = '$t' and booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking_status='1' or room_id = '$room_id' and booking_in = '$t' and booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking_status='2'";
                $result2=mysqli_query($con,$query_booking);
                $count_hr_admin=mysqli_num_rows($result2);
                
    
                            $query_room = "SELECT  admin_booking.stu_id FROM admin_booking inner join booking ON  booking.booking_id = admin_booking.booking_id AND booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' where booking.user_name = '$user_name' or admin_booking.stu_id = '$user_name' order by booking.booking_id";
                            $result_room=mysqli_query($con,$query_room);
                             $count_hr=mysqli_num_rows($result_room);

                
                if($count_hr_admin=='3'){
                     echo 'วันนี้คุณได้ทำการจองห้องกับเเอดมินครบ 3 ชั่วโมงเเล้ว';


                            
                        }else{
                                if($count_hr=='3'){
            /*                            $query_room1 = "SELECT * FROM `booking` where  booking_day LIKE '%".$time_now."%' and user_name = '$user_name' and booking_status='1' or booking_day LIKE '%".$time_now."%' and user_name = '$user_name' and booking_status='2'";
                                        $result_room1=mysqli_query($con,$query_room1);
                                        $row_room1=mysqli_fetch_array($result_room1,MYSQLI_ASSOC);
                                            if($row_room1==null){*/
                            echo 'วันนี้คุณได้ทำการจองห้องครบ 3 ชั่วโมงเเล้ว';

                                }else{
                                    $sql_booking = "INSERT INTO `booking` (`booking_id`, `room_id`, `booking_day`, `booking_in`, `booking_out`, `booking_date`, `booking_status`, `user_name`) VALUES (NULL, '$room_id', '".$datetime->format('Y-m-d')."',  '$t', '$o', Now(), '1', '$user_name');";
                                    $result_sql=mysqli_query($con,$sql_booking);
                                        echo 'ทำการจองสำเร็จ มารับกุญเเจที่เคาร์เตอร์ก่อนเข้าใช้งาน หากมาช้ากว่าเวลาที่จองไว้จะถือว่าสละสิทธิ์ ';     
                                    }
                           
                        }
                

        }
    }
?>


