<?php 
    session_start();
    if(isset($_GET["y"])){
        $y= $_GET['y'];
        $po = "and room_type='$y' "; 
    }else{
            
       $po = ""; 
    }        
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
	include 'menu_bar/library .php';
	?>
<style>

  
    #ima{
        width:  40px;
        height: 40px;    
        
    }  
    
    #ima1{
        
        width:  40px;
        height: 40px;
      
    }
    
    #headd{
       font-size: 18px; 
    }
    
    #thh{
        font-size: 12.5px;
       text-align: center;
    }

     @media screen and (min-width:300px) and (max-width:600px){
            #ima{
            width:  15px;
            height: 15px;
            font-size: 2px;    
        }  
         
    #ima1{
        
        width:  15px;
        height: 15px;
        
        
    }
         
        #thh{
            font-size: 2px;
           text-align: center;
        }

        #headd{
           font-size: 2px; 
        }
         
    }
    
    td{
       font-size: 2px;
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
	function show_res_order(type){
			window.location = "tomorrow.php?y="+type;
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
					$start = new DateTimeImmutable($date_n->format('Y/m/d'));
					$datetime = $start->modify('+1 day');
                   
    if(!isset($_SESSION['login'])){ 
  ?>
  <div class="container">
    <center>
        <h3 id="headd"> <label style="color:red;">หมายเหตุ :</label> <label style="color:#1E8449"> สีเขียว = สามารถจองได้</label> <label style="color:red">| สีเเดง = ไม่สามารถจองได้ </label> <label style="color:#8E44AD">| สีม่วง = รอการยืนยันการจองห้อง </label> <label style="color:#6699FF">| สีฟ้า= ยืนยันการจองห้อง </label><!--<label style="color:orange"> | Waiting Confirm = รอเวลา Confirm </label> --></h3>
         <a href="index_today.php" id="headd" class="btn btn-primary">วันที่ : <?php echo $datetime->format('d-m-Y'); ?> จองวันนี้ >>คลิก>></a>
         <center><br>
        <select onchange="show_res_order(this.value)">
            <option value="">เลือกชั้น</option>
            <option value="1"> ชั้น 1 อาคาร 1</option>
            <option value="2"> ชั้น 1 อาคาร 2</option>
            <option value="3"> ชั้น 2 อาคาร 2</option>
            <option value="100">ทั้งหมด</option>
        </select>
    </center><br>
<input type="hidden" value="<?php echo $total_count_hr; ?>" id="dd"><br><br>
        
                <table class="table table-bordered">
                       <thead>
                            <tr class="primary">
                                 <th id="thh">ห้อง/เวลา</th>
                                 <?php 
                                     $sql_time = "SELECT * FROM `time` where time_status='0' order by time_in asc";
                                     $time2=mysqli_query($con,$sql_time);
                                        while($row_time2=mysqli_fetch_array($time2,MYSQLI_ASSOC))
                                        {
                                            $time_select_in  = $row_time2['time_in'];
                                            $time_in_new = new DateTime($time_select_in);
                                            $time_select_out = $row_time2['time_out'];
                                             $time_out_new = new DateTime($time_select_out);
                                            echo  '<th id="thh">'.$time_in_new->format('H:i').'-'.$time_out_new->format('H:i').'</th>';
                                        }
                          
                                 ?>
                                 
    
                            </tr>
                        </thead>
              <tbody>
                <?php 
                    $sql2 = "SELECT * FROM `room` where room_status= '0' $po";
                         $result2=mysqli_query($con,$sql2);
                          while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
                          {
                              $room_id = $row2['room_id'];
                              $room_name = $row2['room_name'];

                        $time_now=date("H:i:s");
                    echo ' <tr>';
                    echo '<th id="thh">'.$room_name.'</th>';          
                        $sql1 ="SELECT  booking.booking_date, booking.booking_id, booking.user_name, booking.booking_in, booking.booking_out, time.time_in, time.time_out FROM time LEFT join booking ON   
                        time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='1'  
                        or    time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='2'  where time.time_status='0' order by time.time_in asc

                        ";
                         $result=mysqli_query($con,$sql1);
                         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                         {
                            $time_now=date("H:i:s");
                             $booking_date = $row['booking_date'];
                              $booking_id = $row['booking_id'];
                             $booking_in = $row['booking_in'];
                             $booking_out = $row['booking_out'];
                             $time_in = $row['time_in'];
                             $time_out = $row['time_out'];
                             $book_user = $row['user_name'];
                             if($book_user=='adminadmin'){
                                 $sql_book_user = "select * from admin_booking where booking_id = '$booking_id'";
                                 $result_book_user=mysqli_query($con,$sql_book_user);
                                 $row_book_user=mysqli_fetch_array($result_book_user,MYSQLI_ASSOC);
                                 $book_user = $row_book_user['stu_id'];
                             }else{
                                 
                                 
                             }
                                if($booking_date==null){
                                    

                                        echo "<td id='thh' style='background-color: #1E8449;cursor:pointer;' onclick=".'"'."deleteData1('".$room_id."' ,'".$room_name."', '".$time_in."', '".$time_out."')".'"'."> ว่าง</td>";
                         

                                }else{
                                     echo "<td id='thh' style='background-color: #8E44AD;cursor:pointer;' >จองเเล้ว <br></td>";
                                }


                         }
                              echo ' <tr>';
                     }
                ?>
                    </tbody>
          </table>
    </center>
</div>  
    
  <?php }else{
     $st_u=$_SESSION['status'];
    if($st_u=='0'){
      
        
    $user_name=$_SESSION['login'];       
    $query_count_hr = "SELECT * FROM `booking` where user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '1' or  user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '2'";
    $result_count_hr=mysqli_query($con,$query_count_hr);
    $count_hr=mysqli_num_rows($result_count_hr);
        
 
    $query_booking_day = "SELECT * FROM `booking` where user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '1' or  user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '2' order by booking_id asc";
    $result_booking_day=mysqli_query($con,$query_booking_day);
    $row_booking_day=mysqli_fetch_array($result_booking_day,MYSQLI_ASSOC);
    if($row_booking_day>='1'){
        $booking_id_check =  $row_booking_day['booking_in'];    
    }else{
          $booking_id_check =  '00:00:00';  
    }   

    $query_booking_day2 = "SELECT * FROM `booking` where user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '1' or  user_name = '$user_name' and booking_day='".$datetime->format('Y-m-d')."' and  booking_status= '2' order by booking_id desc";
    $result_booking_day2=mysqli_query($con,$query_booking_day2);
    $row_booking_day2=mysqli_fetch_array($result_booking_day2,MYSQLI_ASSOC);
    if($row_booking_day2>='1'){
        $booking_id_check2 =  $row_booking_day2['booking_in'];   
    }else{
       $booking_id_check2 =  '00:00:00';  
    }     
        
        $query_room = "SELECT  admin_booking.stu_id FROM admin_booking inner join booking ON  booking.booking_id = admin_booking.booking_id AND booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' where booking.user_name = '$user_name' and booking.booking_status='1' or admin_booking.stu_id = '$user_name' and booking.booking_status='1' or  booking.user_name = '$user_name' and booking.booking_status='2'  or admin_booking.stu_id = '$user_name' and booking.booking_status='2'  order by booking.booking_id";
                $result_room=mysqli_query($con,$query_room);
                $count_hr2=mysqli_num_rows($result_room);     
        $count_all = $count_hr+$count_hr2;
        $total_count_hr = 3 - $count_all;   
    ?>
  
<div class="container">
    <center>
        <h3 id="headd"> <label style="color:red;">หมายเหตุ :</label> <label style="color:#1E8449"> สีเขียว = สามารถจองได้</label> <label style="color:red">| สีเเดง = ไม่สามารถจองได้ </label> <label style="color:#8E44AD">| สีม่วง = รอการยืนยันการจองห้อง </label> <label style="color:#6699FF">| สีฟ้า= ยืนยันการจองห้อง </label><!--<label style="color:orange"> | Waiting Confirm = รอเวลา Confirm </label> --></h3>
         <a href="index_today.php" id="headd" class="btn btn-primary">วันที่ : <?php echo $datetime->format('d-m-Y'); ?> จองวันนี้ >>คลิก>></a>
         <center><br>
        <select onchange="show_res_order(this.value)">
            <option value="">เลือกชั้น</option>
            <option value="1"> ชั้น 1 อาคาร 1</option>
            <option value="2"> ชั้น 1 อาคาร 2</option>
            <option value="3"> ชั้น 2 อาคาร 2</option>
            <option value="100">ทั้งหมด</option>
        </select>
    </center><br>
      <input type="hidden" value="<?php echo $total_count_hr; ?>" id="dd"><br><br>
      <input type="hidden" value="<?php echo $booking_id_check; ?>" id="b_in">
      <input type="hidden" value="<?php echo $booking_id_check2; ?>" id="b_in2">
                <table class="table table-bordered">
                       <thead>
                            <tr class="success">
                                 <th id="thh">ห้อง/เวลา</th>
                                 <?php 
                                     $sql_time = "SELECT * FROM `time` where time_status='0' order by time_in asc";
                                     $time2=mysqli_query($con,$sql_time);
                                        while($row_time2=mysqli_fetch_array($time2,MYSQLI_ASSOC))
                                        {
                                            $time_select_in  = $row_time2['time_in'];
                                            $time_in_new = new DateTime($time_select_in);
                                            $time_select_out = $row_time2['time_out'];
                                             $time_out_new = new DateTime($time_select_out);
                                            echo  '<th id="thh">'.$time_in_new->format('H:i').'-'.$time_out_new->format('H:i').'</th>';
                                        }
                          
                                 ?>
                                 
    
                            </tr>
                        </thead>
              <tbody>
                <?php 
                   $sql2 = "SELECT * FROM `room` where room_status= '0' $po";
                         $result2=mysqli_query($con,$sql2);
                          while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
                          {
                              $room_id = $row2['room_id'];
                              $room_name = $row2['room_name'];

                        $time_now=date("H:i:s");
                    echo ' <tr>';
                    echo '<th id="thh">'.$room_name.'</th>';          
                        $sql1 ="SELECT  booking.booking_date, booking.booking_id,  booking.user_name, booking.booking_in, booking.booking_out, time.time_in, time.time_out FROM time LEFT join booking ON   
                         time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='1'  
                        or    time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='2'  where time.time_status='0'  order by time.time_in asc

                        ";
                         $result=mysqli_query($con,$sql1);
                         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                         {
                            $time_now=date("H:i:s");
                             $booking_date = $row['booking_date'];
                             $booking_id = $row['booking_id'];
                             $booking_in = $row['booking_in'];
                             $booking_out = $row['booking_out'];
                             $time_in = $row['time_in'];
                             $time_out = $row['time_out'];
                             $book_user = $row['user_name'];
                             if($book_user=='adminadmin'){
                                 $sql_book_user = "select * from admin_booking where booking_id = '$booking_id'";
                                 $result_book_user=mysqli_query($con,$sql_book_user);
                                 $row_book_user=mysqli_fetch_array($result_book_user,MYSQLI_ASSOC);
                                 $book_user = $row_book_user['stu_id'];
                             }else{
                                 
                                 
                             }
                             
                             
                                if($booking_date==null){
                                    

                                       /* echo ' <td>ว่าง  <input onclick="deleteData('."$room_id".', '.$time_in.')" id="ima" type="image" alt="Submit" src="images/available.png" name="room_id1" >  </td>';*/
                                       echo "<td id='thh' style='background-color: #1E8449;cursor:pointer;' onclick=".'"'."deleteData('".$room_id."' ,'".$room_name."', '".$time_in."', '".$time_out."')".'"'." >ว่าง </td>";


                                }else{
                                   if($user_name==$book_user){
                                         echo "<td id='thh' style='background-color: #8E44AD;cursor:pointer;' >".$book_user." <br></td>";
                                    }else{
                                          echo "<td id='thh' style='background-color: #8E44AD;cursor:pointer;' >จองเเล้ว <br></td>";
                                    }


                                }
                         }
                              echo ' <tr>';
                     }
                ?>
                    </tbody>
          </table>
    </center>
</div>

<?php }else { ?>
<div class="container">
    <center>
        <h3 id="headd"> <label style="color:red;">หมายเหตุ :</label> <label style="color:#1E8449"> สีเขียว = สามารถจองได้</label> <label style="color:red">| สีเเดง = ไม่สามารถจองได้ </label> <label style="color:#8E44AD">| สีม่วง = รอการยืนยันการจองห้อง </label> <label style="color:#6699FF">| สีฟ้า= ยืนยันการจองห้อง </label><!--<label style="color:orange"> | Waiting Confirm = รอเวลา Confirm </label> --></h3>
         <a href="index_today.php" id="headd" class="btn btn-primary">วันที่ : <?php echo $datetime->format('d-m-Y'); ?> จองวันนี้ >>คลิก>></a>
         <center><br>
        <select onchange="show_res_order(this.value)">
            <option value="">เลือกชั้น</option>
            <option value="1"> ชั้น 1 อาคาร 1</option>
            <option value="2"> ชั้น 1 อาคาร 2</option>
            <option value="3"> ชั้น 2 อาคาร 2</option>
            <option value="100">ทั้งหมด</option>
        </select>
    </center><br>
      <input type="hidden" value="<?php echo $total_count_hr; ?>" id="dd"><br><br>
                <table class="table table-bordered">
                       <thead>
                             <tr class="success">
                                 <th id="thh">ห้อง/เวลา</th>
                                 <?php 
                                     $sql_time = "SELECT * FROM `time` where time_status='0' order by time_in asc";
                                     $time2=mysqli_query($con,$sql_time);
                                        while($row_time2=mysqli_fetch_array($time2,MYSQLI_ASSOC))
                                        {
                                            $time_select_in  = $row_time2['time_in'];
                                            $time_in_new = new DateTime($time_select_in);
                                            $time_select_out = $row_time2['time_out'];
                                             $time_out_new = new DateTime($time_select_out);
                                            echo  '<th id="thh">'.$time_in_new->format('H:i').'-'.$time_out_new->format('H:i').'</th>';
                                        }
                          
                                 ?>
                                 
    
                            </tr>
                        </thead>
              <tbody>
                <?php 
                    $sql2 = "SELECT * FROM `room` where room_status= '0' $po";
                         $result2=mysqli_query($con,$sql2);
                          while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
                          {
                              $room_id = $row2['room_id'];
                              $room_name = $row2['room_name'];

                        $time_now=date("H:i:s");
                    echo ' <tr>';
                    echo '<th id="thh">'.$room_name.'</th>';          
                        $sql1 ="SELECT  booking.booking_date, booking.booking_id, booking.user_name, booking.booking_in, booking.booking_out, time.time_in, time.time_out FROM time LEFT join booking ON  
                        time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='1'  
                        or    time.time_in = booking.booking_in and booking.room_id = '$room_id' and booking.booking_day LIKE '%".$datetime->format('Y-m-d')."%' and booking.booking_status='2'  where time.time_status='0'  order by time.time_in asc

                        ";
                         $result=mysqli_query($con,$sql1);
                         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                         {
                            $time_now=date("H:i:s");
                             $booking_date = $row['booking_date'];
                             $booking_id = $row['booking_id'];
                             $booking_in = $row['booking_in'];
                             $booking_out = $row['booking_out'];
                             $time_in = $row['time_in'];
                             $time_out = $row['time_out'];
                             $book_user = $row['user_name'];
                             
                             if($book_user=='adminadmin'){
                                 $sql_book_user = "select * from admin_booking where booking_id = '$booking_id'";
                                 $result_book_user=mysqli_query($con,$sql_book_user);
                                 $row_book_user=mysqli_fetch_array($result_book_user,MYSQLI_ASSOC);
                                 $book_user = $row_book_user['stu_id'];
                             }else{
                                 
                                 
                             }
                                if($booking_date==null){
                                    

                                       /* echo ' <td>ว่าง  <input onclick="deleteData('."$room_id".', '.$time_in.')" id="ima" type="image" alt="Submit" src="images/available.png" name="room_id1" >  </td>';*/
                                        echo "<td id='thh'  style='background-color: #1E8449;cursor:pointer;' onclick=".'"'."deleteData1('".$room_id."' ,'".$room_name."', '".$time_in."', '".$time_out."')".'"'.">ว่าง</td>";
                               

                                }else{
                                      echo "<td id='thh'  style='background-color: #8E44AD;cursor:pointer;' >".$book_user." <br></td>";
                                }


                         }
                        echo ' <tr>';
                     }
                ?>
                    </tbody>
          </table>
    </center>
</div>    
    
<?php } }?>
	<script>

        var xmlHttp = new XMLHttpRequest();
            function deleteData(id,name,t,o) {
        var xx  = document.getElementById("dd").value;
        var b_in  = document.getElementById("b_in").value;
        var b_in2  = document.getElementById("b_in2").value;
          if(b_in==t){
                alert('ไม่สามารถจองได้มากกว่า 1 ห้องในเวลาเดียวกัน');
                window.location.reload(false); 
                return false;               
             }else{      
            if(b_in2==t){
                alert('ไม่สามารถจองได้มากกว่า 1 ห้องในเวลาเดียวกัน');
                window.location.reload(false); 
                return false;    
              }else{    
        if(xx==0){
            alert('1 วัน สามารถจองได้สูงสุด 3 ชม กรุณาตรวจสอบการจองของท่านในประวัติการจอง');
            window.location.reload(false); 
            return false;       
        }else{
                 if (confirm("ยืนยันที่จะจองห้อง " +name+ " เวลา " +t+ " หรือไม่")) {
                    if (xmlHttp != null) {
                        xmlHttp.open("GET", "insert_book_tomorrow.php?id="+id+"&ro="+t+"&o="+o , true);
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
         }
    }
 }
	</script>
	<script>
       
            function deleteData1(id,t,o) {		
                window.location = "input_name_tomorrow.php?id="+id+"&ro="+t+"&o="+o;
            }
	
	</script>


</body>
</html>
