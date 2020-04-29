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
    #ima{
        width:  180px;
        height: 180px;
        
        
    }  
    
    #ima1{
        
        width:  160px;
        height: 160px;
        
        
    }
    
    #headd{
       font-size: 35px; 
    }
    
    #thh{
        font-size: 16px;
       text-align: center;
    }
    
    #wss{
        width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

     @media screen and (min-width:300px) and (max-width:600px){
         #ima{
            width:  50px;
            height: 50px;
            font-size: 10px;    
        }  
         
    #ima1{
        
        width:  40px;
        height: 40px;
        
        
    }

    #wss{
        width:420px;
        margin-left: auto;
        margin-right: auto;
    }

         
        #thh{
            font-size: 12px;
           text-align: center;
        }

        #headd{
           font-size: 15px; 
        }
         
    }
    
    td{
       font-size: 16px;
       text-align: center;
       
    }


	
</style>
<script language="JavaScript">
	function onDelete()
	{
		
		
		if(confirm('ต้องการจองในเวลาดังกล่าวใช่หรือไม่')==true)
		{
			
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

<script>
        $(document).ready(function() {
        $('#example').DataTable();
    } );
	
</script>
	<script>
        var xmlHttp = new XMLHttpRequest();
            function confirmss(id,name,time) {					
                if (confirm("ยืนยัน"+name+ " เวลา"+time+ " หรือไม่")) {
                    if (xmlHttp != null) {
                        xmlHttp.open("GET", "query_confirm.php?id="+id , true);
                        xmlHttp.send();
                        xmlHttp.onreadystatechange = function() {
                            if (xmlHttp.readyState == 4) {
                                alert(xmlHttp.responseText);
                                location.reload();
                            }
                        }
                    }
                }
            }		
	</script>	
    <script>
        var xmlHttp = new XMLHttpRequest();
            function delete1(id,name,time) {					
                if (confirm("ยกเลิก"+name+ " เวลา"+time+ " หรือไม่")) {
                    if (xmlHttp != null) {
                        xmlHttp.open("GET", "query_cancel.php?id="+id , true);
                        xmlHttp.send();
                        xmlHttp.onreadystatechange = function() {
                            if (xmlHttp.readyState == 4) {
                                alert(xmlHttp.responseText);
                                location.reload();
                            }
                        }
                    }
                }
            }		
	</script>
</head>
<body>

<?php 
    
    include 'ConnectDB.php';
     mysqli_set_charset($con,"utf8");
     date_default_timezone_set("Asia/Bangkok");
    include 'menu_bar/menu_bar.php';
    $id = $_GET['id'];
    $time_nows=date("d-m-Y");
					$date_n = new DateTime($time_nows);
      include 'query_check_time.php';
                   
    if($_SESSION['status']!='2'){ 
         echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="index.php";
						</script>';
    }
    
                        $query_admin = "SELECT  * FROM admin_booking  where stu_id = '$id' order by booking_id desc  ";
                        $result_query_admin=mysqli_query($con,$query_admin);
                        $row_query_admin=mysqli_fetch_array($result_query_admin,MYSQLI_ASSOC); 
                        $count_report=mysqli_num_rows($result_query_admin); 
                        if($count_report<='0'){
                                          $query_user = "select * from user where user_name='$id'";
                                          $result_query_user=mysqli_query($con,$query_user);
                                          $row_query_user=mysqli_fetch_array($result_query_user,MYSQLI_ASSOC);  
                                          $faculty =$row_query_user['faculty'];
                                          $major =$row_query_user['major'];
                                          $name =$row_query_user['name'];
                                          $last_name =$row_query_user['last_name'];                      
                                          $user_stu =$row_query_user['user_name'];  
                                          $name = $name .' '. $last_name;
                                          $img_pro = $row_query_user['img_pro'];
                        }else{
                            $user_stu = $row_query_admin['stu_id'];    
                            $name = $row_query_admin['name'];    
                            $faculty =$row_query_admin['faculty'];
                            $major =$row_query_admin['major'];
                            
                        }
    
            
 

    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">ประวัติการจอง</h1>
        
        </center> 

    </div>
   
        <div id="wss">
            
            <?php 
                echo '<h2>รหัสนิสิต : '.$user_stu.'</h2>';
                echo '<h2>ชื่อ-นามสกุล : '.$name.' </h2>';
                echo '<h2>คณะ : '.$faculty.' </h2>';
                echo '<h2>สาขา: '.$major.' </h2>';
                echo '<table class="table table-striped table-bordered"  id="example">
                        <thead>
                            <tr>
                                <th id="thh">ลำดับ</th>
                                <th id="thh">วัน/เดือน/ปี ที่จอง</th>
                                <th id="thh">ห้องที่จอง</th>  
                                <th id="thh">เวลาที่เข้าห้อง</th>
                                <th id="thh">เวลาที่ออกห้อง</th>
                                <th id="thh">สถานะใช้งาน</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
        if($count_report<='0'){
  $i=0;
                $query_user_all = "SELECT * FROM `booking` where user_name = '$user_stu'  order by booking_day desc";
                 $result_room1=mysqli_query($con,$query_user_all);
                                        while($row_memeber=mysqli_fetch_array($result_room1,MYSQLI_ASSOC))
                                        {
                                            
                                         $i=$i+1;
                                          $booking_id=$row_memeber['booking_id'];
                                          $room_id=$row_memeber['room_id'];
                                          $booking_day=$row_memeber['booking_day'];
                                          $date_n = new DateTime($booking_day);  
                                            
                                          $booking_in=$row_memeber['booking_in'];
                                          $booking_out=$row_memeber['booking_out'];
                                          $stu_id=$row_memeber['user_name'];
                                          $booking_status=$row_memeber['booking_status'];
                                             $time_in_new = new DateTime($booking_in);
                                          $time_out_new = new DateTime($booking_out);
                                            
                                          $query_room = "select * from room where room_id = '$room_id'";  
                                          $result_room=mysqli_query($con,$query_room);
                                          $row_room=mysqli_fetch_array($result_room,MYSQLI_ASSOC);  
                                          $room_name  = $row_room['room_name'];
                                        
                                         

                                            
                                          if($stu_id=='adminadmin'){
                                              $query_stu = "SELECT * FROM `admin_booking` where booking_id = '$booking_id'";
                                               $result_stu=mysqli_query($con,$query_stu);
                                               $row_stu=mysqli_fetch_array($result_stu,MYSQLI_ASSOC);
                                               $stu_id = $row_stu['stu_id'];
                                               $faculty =$row_stu['faculty'];
                                               $major =$row_stu['major'];
                                                
                                               
                                               


                                                  
                                          }else{
                                              
                                          }

                                            echo  '
                                                        <tr>
                                                         <td id="thh">'.$i.'</td>
                                                         <td id="thh">'.$date_n->format('d/m/Y').'</td>
                                                         <td id="thh">'.$room_name.'</td>
                                                         
                                                         <td id="thh">'.$time_in_new->format('H:i').'</td>
                                                         <td id="thh">'.$time_out_new->format('H:i').'</td>';
                                         
                                           if($booking_status=='1'){
                                               echo '<td id="thh">รอรับกุญเเจเเละเข้าห้อง</td>';
                                           }else if($booking_status=='2'){
                                               echo '<td id="thh">ใช้งานเเล้ว</td>';
                                           }else{
                                               echo '<td id="thh">ยกเลิกการจองเเล้ว</td>';
                                           }
                                                        

                                                      
                                                    
                                                   
                                        }
            
                echo '</tbody>
                </table>';           
        }else{
             $i=0;
      $query_user_all = "SELECT *
FROM admin_booking
LEFT JOIN booking
ON admin_booking.booking_id = booking.booking_id
WHERE admin_booking.stu_id = '$user_stu'";
                 $result_room1=mysqli_query($con,$query_user_all);
                                        while($row_memeber=mysqli_fetch_array($result_room1,MYSQLI_ASSOC))
                                        {
                                            
                                         $i=$i+1;
                                          $booking_id=$row_memeber['booking_id'];
                                          $room_id=$row_memeber['room_id'];
                                          $booking_day=$row_memeber['booking_day'];
                                          $date_n = new DateTime($booking_day);  
                                            
                                          $booking_in=$row_memeber['booking_in'];
                                          $booking_out=$row_memeber['booking_out'];
                                          $stu_id=$row_memeber['user_name'];
                                          $booking_status=$row_memeber['booking_status'];
                                             $time_in_new = new DateTime($booking_in);
                                          $time_out_new = new DateTime($booking_out);
                                            
                                          $query_room = "select * from room where room_id = '$room_id'";  
                                          $result_room=mysqli_query($con,$query_room);
                                          $row_room=mysqli_fetch_array($result_room,MYSQLI_ASSOC);  
                                          $room_name  = $row_room['room_name'];
                                        
                                          

                                            
                                          if($stu_id=='adminadmin'){
                                              $query_stu = "SELECT * FROM `admin_booking` where booking_id = '$booking_id'";
                                               $result_stu=mysqli_query($con,$query_stu);
                                               $row_stu=mysqli_fetch_array($result_stu,MYSQLI_ASSOC);
                                               $stu_id = $row_stu['stu_id'];
                                               $faculty =$row_stu['faculty'];
                                               $major =$row_stu['major'];

                                              /* $query_user = "select * from user where user_name='$stu_id'";
                                               $result_query_user=mysqli_query($con,$query_user);
                                               $row_query_user=mysqli_fetch_array($result_query_user,MYSQLI_ASSOC);
                                              // $img_pro = $row_query_user['img_pro'];
                                               
                                               if($row_query_user==null){
                                                   $img_pro="white.jpg";
                                               }else{
                                                $img_pro = $row_query_user['img_pro'];
                                               }*/
                                               
                                                  
                                          }else{
                                              
                                          }

                                            echo  '
                                                        <tr>
                                                         <td id="thh">'.$i.'</td>
                                                         <td id="thh">'.$date_n->format('d/m/Y').'</td>
                                                         <td id="thh">'.$room_name.'</td>                                                         
                                                         <td id="thh">'.$time_in_new->format('H:i').'</td>
                                                         <td id="thh">'.$time_out_new->format('H:i').'</td>';
                                         
                                           if($booking_status=='1'){
                                               echo '<td id="thh">รอรับกุญเเจเเละเข้าห้อง</td>';
                                           }else if($booking_status=='2'){
                                               echo '<td id="thh">ใช้งานเเล้ว</td>';
                                           }else{
                                               echo '<td id="thh">ยกเลิกการจองเเล้ว</td>';
                                           }
                                                                            
                                                    
                                                   
                                        }
            
                echo '</tbody>
                </table>';                    
        }

            ?>
        </div>

</body>
</html>
