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
    }else{
        $time_id = $_GET['id_t'];
        $query_room = "select * from time where time_id = '$time_id'";
        $result_room=mysqli_query($con,$query_room);
        $row_room=mysqli_fetch_array($result_room,MYSQLI_ASSOC);
        $time_in = $row_room['time_in'];
        $time_out = $row_room['time_out'];
            $time_in_new = new DateTime($time_in);
            $time_out_new = new DateTime($time_out);
        $time_status = $row_room['time_status'];
        if($time_status=='0'){
            $time_status_l = 'เปิดบริการ';
        }else{
            $time_status_l = 'ปิดบริการ';
        }
    }

    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">เเก้ไขเวลาเข้าห้องติว </h1>

        </center> 

    </div>
        <div id="wss">
             <form action="query_update_time.php" method="post">
            <div class=" w3-container w3-half">      
                 <div class="form-group">
                    <label>รหัสเวลา *</label>
                    <input type="text" class="form-control"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $time_id; ?>" disabled>
                    <input type="hidden" class="form-control" name="time_id"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $time_id; ?>" >
                  </div>
                </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>สถานะห้องติว *</label>
                    <select class="form-control" name="time_status">
                       <option value="<?php echo $time_status; ?>"><?php echo $time_status_l; ?></option>
                       <option value="1">ปิดบริการ</option> 
                       <option value="0">เปิดบริการ</option> 
                    </select>
               </div>
              </div>
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เวลาเข้าห้องติว *</label>
                    <select class="form-control" name="time_in" required>
                       <option value="<?php echo $time_in; ?>"><?php echo $time_in_new->format('H:i'); ?></option>
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
                       <option value="<?php echo $time_out; ?>"><?php echo $time_out_new->format('H:i'); ?></option>
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


                <button   class="btn-lg btn-success">ยืนยัน</button> <a href="javascript:history.back(1)" class="btn-lg btn-primary">ย้อนกลับ</a>
        </form>    
        </div>

</body>
</html>
