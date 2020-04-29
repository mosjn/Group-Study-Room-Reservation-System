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
        font-size: 18px;
       text-align: center;
    }
    
    #wss{
        width: 1450px;
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
       font-size: 18px;
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
    $time_nows=date("d-m-Y");
					$date_n = new DateTime($time_nows);
                   
    if($_SESSION['status']!='2'){ 
         echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="index.php";
						</script>';
    }

    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">ยืนยันเเละรับกุญเเจ</h1>

        </center> 

    </div>
   
        <div id="wss">
            <?php 
                echo '<table class="table table-striped table-bordered"  id="example">
                        <thead>
                            <tr>
                                <th id="thh">ลำดับ</th>
                                
                                <th id="thh">รหัสนิสิต</th>
                                <th id="thh">ชื่อ-นามสกุล</th>
                                <th id="thh">คณะ</th>
                                <th id="thh">สาขา</th>
                                <th id="thh">ห้องที่จอง</th>
                                <th id="thh">วัน/เดือน/ปี ที่จอง</th>
                                <th id="thh">เวลาที่เข้าห้อง</th>
                                <th id="thh">ยืนยัน</th>
                                <th id="thh">ยกเลิก</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                $i=0;
                $query_user_all = "SELECT * FROM `booking` where booking_status = '1'";
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
                                         $time_in_new = new DateTime($booking_in);
                                          $time_out_new = new DateTime($booking_out);
                                            
                                          $query_room = "select * from room where room_id = '$room_id'";  
                                          $result_room=mysqli_query($con,$query_room);
                                          $row_room=mysqli_fetch_array($result_room,MYSQLI_ASSOC);  
                                          $room_name  = $row_room['room_name'];

                                          $query_user = "select * from user where user_name='$stu_id'";
                                          $result_query_user=mysqli_query($con,$query_user);
                                          $row_query_user=mysqli_fetch_array($result_query_user,MYSQLI_ASSOC);  
                                          $faculty =$row_query_user['faculty'];
                                          $major =$row_query_user['major'];
                                          $name =$row_query_user['name'];
                                          $last_name =$row_query_user['last_name'];
                                          $img_pro = $row_query_user['img_pro'];
                                            
                                          if($stu_id=='adminadmin'){
                                              $query_stu = "SELECT * FROM `admin_booking` where booking_id = '$booking_id'";
                                               $result_stu=mysqli_query($con,$query_stu);
                                               $row_stu=mysqli_fetch_array($result_stu,MYSQLI_ASSOC);
                                               $stu_id = $row_stu['stu_id'];
                                               $faculty =$row_stu['faculty'];
                                               $major =$row_stu['major'];
                                               $name =$row_stu['name'];

                                               /*$query_user = "select * from user where user_name='$stu_id'";
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
                                                         
                                                         <td id="thh">'.$stu_id.'</td>
                                                         <td id="thh">'.$name.' '.$last_name.'</td>
                                                         <td id="thh">'.$faculty.'</td>
                                                         <td id="thh">'.$major.'</td>
                                                         <td id="thh">'.$room_name.'</td>
                                                         <td id="thh">'.$date_n->format('d/m/Y').'</td>
                                                         <td id="thh">'.$time_in_new->format('H:i').'</td>';
                                         
                                            echo  "<td><button class='btn btn-success' onclick=".'"'."confirmss('".$booking_id."', '".$room_name."', '".$booking_in."' )".'"'." type='submit'  >ยืนยัน</button></td>
                                                   <td><button class='btn btn-danger' onclick=".'"'."delete1('".$booking_id."', '".$room_name."', '".$booking_in."' )".'"'." type='submit'  >ยกเลิก</button></td>
                                               </tr>  
                                            ";
                                                        

                                                      
                                                    
                                                   
                                        }
            
                echo '</tbody>
                </table>';
            ?>
        </div>

</body>
</html>
