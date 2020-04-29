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
        font-size: 20px;
       text-align: center;
    }
    
    #wss{
        width: 800px;
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
        <h1 id="headd" style="color:green">เวลาเข้าห้อง - เวลาออกห้อง</h1>
          
        </center> 

    </div>
        <div id="wss">
             <button onclick="document.getElementById('login').style.display='block'"  class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มเวลาเข้าห้อง - เวลาออกห้อง</button> <a href="javascript:history.back(1)" class="btn btn-primary">ย้อนกลับ</a>  <br><br> 
            <?php 
                echo '<table class="table table-striped table-bordered"  id="example">
                        <thead>
                            <tr>
                                <th id="thh">ลำดับ</th>
                                <th id="thh">เวลาเข้าห้อง</th>
                                <th id="thh">เวลาออกห้อง</th>
                                <th id="thh">สถานะ</th>
                                <th id="thh">เเก้ไข</th>
                            </tr>
                        </thead>
                        ';
                $i=0;
                $query_user_all = "select * from time ";
                 $result_room1=mysqli_query($con,$query_user_all);
                                        while($row_memeber=mysqli_fetch_array($result_room1,MYSQLI_ASSOC))
                                        {
                                         $i=$i+1;
                                          $time_id=$row_memeber['time_id'];
                                          $time_in=$row_memeber['time_in'];
                                          $time_out=$row_memeber['time_out'];
                                          $time_status=$row_memeber['time_status'];
                                          $time_in_new = new DateTime($time_in);
                                          $time_out_new = new DateTime($time_out);
                                            echo  '<tr>
                                                     <td id="thh">'.$i.'</td>
                                                     <td id="thh">'.$time_in_new->format('H:i').'</td>
                                                     <td id="thh">'.$time_out_new->format('H:i').'</td>';
                                            
                                          if($time_status=='0'){
                                             echo  '<td id="thh">เปิดใช้งาน</td>';
                                          }else{
                                               echo  '<td id="thh" style="color:red;">ปิดปรับปรุง</td>';
                                          }
                                            echo'
                                                     <td id="thh"><a href="edit_time.php?id_t='.$time_id.'" class="btn btn-warning">เเก้ไข</a></td>
                                                   </tr>  
                                                   ';
                                        }
            
                echo '</table>';
            ?>
        </div>
    
<div id="login" class="w3-modal">
<form action="insert_time.php" method="post">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white ">
      <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
      <h2 class="w3-wide">เพิ่มเวลาเข้าห้อง - เวลาออกห้อง</h2>
	<br>
 
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เวลาเข้าห้องติว *</label>
                    <select class="form-control" name="time_in" required>
                       <option value="">เลือกเวลาเข้าห้อง</option>
                       <option value="00:00:00">00:00</option> 
                       <option value="01:00:00">01:00</option> 
                       <option value="02:00:00">02:00</option> 
                       <option value="03:00:00">03:00</option> 
                       <option value="04:00:00">04:00</option> 
                       <option value="05:00:00">05:00</option> 
                       <option value="06:00:00">06:00</option> 
                       <option value="08:00:00">08:00</option> 
                       <option value="09:00:00">09:00</option> 
                       <option value="10:00:00">10:00</option> 
                       <option value="11:00:00">11:00</option> 
                       <option value="12:00:00">12:00</option> 
                       <option value="13:00:00">13:00</option> 
                       <option value="14:00:00">14:00</option> 
                       <option value="15:00:00">15:00</option> 
                       <option value="16:00:00">16:00</option> 
                       <option value="17:00:00">17:00</option> 
                       <option value="18:00:00">18:00</option> 
                       <option value="19:00:00">19:00</option> 
                       <option value="20:00:00">20:00</option> 
                       <option value="21:00:00">21:00</option> 
                       <option value="22:00:00">22:00</option> 
                       <option value="23:00:00">23:00</option> 
                    </select>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เวลาออกห้องติว *</label>
                    <select class="form-control" name="time_out" required>
                       <option value="">เลือกเวลาออกห้อง</option>
                       <option value="00:00:00">00:00</option> 
                       <option value="01:00:00">01:00</option> 
                       <option value="02:00:00">02:00</option> 
                       <option value="03:00:00">03:00</option> 
                       <option value="04:00:00">04:00</option> 
                       <option value="05:00:00">05:00</option> 
                       <option value="06:00:00">06:00</option> 
                       <option value="08:00:00">08:00</option> 
                       <option value="09:00:00">09:00</option> 
                       <option value="10:00:00">10:00</option> 
                       <option value="11:00:00">11:00</option> 
                       <option value="12:00:00">12:00</option> 
                       <option value="13:00:00">13:00</option> 
                       <option value="14:00:00">14:00</option> 
                       <option value="15:00:00">15:00</option> 
                       <option value="16:00:00">16:00</option> 
                       <option value="17:00:00">17:00</option> 
                       <option value="18:00:00">18:00</option> 
                       <option value="19:00:00">19:00</option> 
                       <option value="20:00:00">20:00</option> 
                       <option value="21:00:00">21:00</option> 
                       <option value="22:00:00">22:00</option> 
                       <option value="23:00:00">23:00</option> 
                    </select>
               </div>
              </div>
        <button   class="btn-lg btn-success">ยืนยัน</button> <a onclick="document.getElementById('login').style.display='none'" class="btn-lg btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
</div>
</body>
</html>
