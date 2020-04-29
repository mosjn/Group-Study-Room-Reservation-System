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
    }

    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">ห้องติว</h1>

        </center> 

    </div>
        <div id="wss">
            <button onclick="document.getElementById('login').style.display='block'"  class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มห้องติว</button> <a href="javascript:history.back(1)" class="btn btn-primary">ย้อนกลับ</a>  <br><br>
            <?php 
                echo '<table class="table table-striped table-bordered"  id="example">
                        <thead>
                            <tr>
                                <th id="thh">ลำดับ</th>
                                <th id="thh">ชื่อห้องติว</th>
                                <th id="thh">สถานะ</th>
                                <th id="thh">เเก้ไข</th>
                            </tr>
                        </thead>
                        ';
                $i=0;
                $query_user_all = "select * from room ";
                 $result_room1=mysqli_query($con,$query_user_all);
                                        while($row_memeber=mysqli_fetch_array($result_room1,MYSQLI_ASSOC))
                                        {
                                         $i=$i+1;
                                          $room_id=$row_memeber['room_id'];
                                          $room_name=$row_memeber['room_name'];
                                          $room_status=$row_memeber['room_status'];
                                          
                                            echo  '<tr>
                                                     <td id="thh">'.$i.'</td>
                                                     <td id="thh">'.$room_name.'</td>';
                                            
                                          if($room_status=='0'){
                                             echo  '<td id="thh">เปิดใช้งาน</td>';
                                          }else{
                                               echo  '<td id="thh" style="color:red;">ปิดปรับปรุง</td>';
                                          }
                                            echo'
                                                     <td id="thh"><a href="edit_room.php?id='.$room_id.'" class="btn btn-warning">เเก้ไข</a></td>
                                                   </tr>  
                                                   ';
                                        }
            
                echo '</table>';
            ?>
        </div>
    
<div id="login" class="w3-modal">
<form action="insert_room.php" method="post">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white ">
      <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
      <h2 class="w3-wide">เพิ่มห้องติว</h2>
	<br>
 
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>ชื่อห้อง *</label>
                   <input type="text" class="form-control"   name="room_name" placeholder="กรุณากรอกชื่อห้อง" minlength="4" maxlength="50"  required title="กรุณาใส่ชื่อห้อง" >
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>สถานะห้องติว *</label>
                    <select class="form-control" name="room_status">
                       <option value="">เลือกสถานะห้องติว</option>
                       <option value="1">ปิดปรับปรุง</option> 
                       <option value="0">เปิดใช้งาน</option> 
                    </select>
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
              </div>
        <button   class="btn-lg btn-success">ยืนยัน</button> <a onclick="document.getElementById('login').style.display='none'" class="btn-lg btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
</div>
</body>
</html>
