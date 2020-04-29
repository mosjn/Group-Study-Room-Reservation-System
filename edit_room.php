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
	function show_res_order(type){
			window.location = "index_today.php?y="+type;
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
        $room_id = $_GET['id'];
        $query_room = "select * from room where room_id = '$room_id'";
        $result_room=mysqli_query($con,$query_room);
        $row_room=mysqli_fetch_array($result_room,MYSQLI_ASSOC);
        $room_name = $row_room['room_name'];
        $room_status = $row_room['room_status'];
        if($room_status=='0'){
            $room_status_name = 'เปิดใช้งาน';
        }else{
            $room_status_name = 'ปิดปรับปรุง';
        }
    }

    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">เเก้ไขข้อมูลห้องติว <?php echo $room_name; ?></h1>

        </center> 

    </div>
        <div id="wss">
             <form action="query_update_room.php" method="post">
            <div class=" w3-container w3-half">      
                 <div class="form-group">
                    <label>รหัสห้องติว *</label>
                    <input type="text" class="form-control"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $room_id; ?>" disabled>
                    <input type="hidden" class="form-control" name="room_id"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $room_id; ?>" >
                  </div>
                </div>
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>ชื่อห้อง *</label>
                   <input type="text" class="form-control"   name="room_name" placeholder="กรุณากรอกชื่อห้อง" minlength="4" maxlength="50"  required title="กรุณาใส่ชื่อห้อง" value="<?php echo $room_name; ?>">
               </div>
              </div>
              <div class=" w3-container w3-half">
                   <div class="form-group"> 
                   <label>ชั้นและอาคาร *</label>
                    <select class="form-control" name="room_type">
                       <option value="">เลือกชั้นและอาคาร</option>
                       <option value="1"> ชั้น 1 อาคาร 1</option>
                       <option value="2"> ชั้น 1 อาคาร 2</option>
                       <option value="3"> ชั้น 2 อาคาร 2</option>
                    </select>
                    </div>
               </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>สถานะห้องติว *</label>
                    <select class="form-control" name="room_status">
                       <option value="<?php echo $room_status; ?>"><?php echo $room_status_name; ?></option>
                       <option value="1">ปิดปรับปรุง</option> 
                       <option value="0">เปิดใช้งาน</option> 
                    </select>
               </div>
              </div>


                <button   class="btn-lg btn-success">ยืนยัน</button> <a href="javascript:history.back(1)" class="btn-lg btn-primary">ย้อนกลับ</a>
        </form>    
        </div>

</body>
</html>
