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
        font-size: 25px;
       text-align: center;
    }
    
    #wss{
        width: 500px;
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
        width:220px;
        margin-left: auto;
        margin-right: auto;
    }

         
        #thh{
            font-size: 15px;
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
                $room_id = $_GET['id'];
                $t = $_GET['ro'];
                $o = $_GET['o'];
                $time_now=date("Y-m-d");
        $date_t = new DateTime($t);
    
        $sql_room = "select * from room where room_id = '$room_id'";
        $result_room=mysqli_query($con,$sql_room);
        $row=mysqli_fetch_array($result_room,MYSQLI_ASSOC);
        $room_name = $row['room_name'];
    
        
    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green"> จอง<?php echo $room_name; ?> เวลา <?php echo $date_t->format('H:i'); ?> น.</h1>

        </center> 

    </div>
 
            <form action="insert_input_name.php" method="post">
       <div id="wss" >
           <div style="height:250px;">
                <div class="form-group">
                    <label>ชื่อ-นามสกุล *</label>
                 <input type="text" class="form-control"  id="name" name="name" placeholder="กรุณากรอกชื่อ-นามสกุล" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่ชื่อ-นามสกุล">
              </div>   
       
                  <div class="form-group">
                <label>รหัสนิสิต *</label>
                <input type="text" class="form-control" placeholder="ตัวอย่าง 5845851887"  name="user_name" maxlength="10" pattern="[A-Za-z0-9_]{10,20}" required title="ชื่อไอดีต้องเป็นตัวเลข มีความยาว 10 ตัวอักษร" >
              </div>

             <div class=" w3-container w3-half">
 			  <div class="form-group">
                <label>คณะที่เรียน *</label>
                        <select class="form-control" name="faculty_id"   onchange="show_Amphur(this.value)" required>
                            <option value="">--คณะที่เรียน--</option>
                        <?php 
                            include 'ConnectDB.php';
                            mysqli_set_charset($con,"utf8");
                            $sql ="SELECT * FROM `faculty` order by faculty_name ASC";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)) {
                                    echo "<option value='".$row['faculty_id']."'>" . $row['faculty_name'] . "</option>";   
                            }


                        ?>
                        </select>
              </div>
            </div>
             <div class=" w3-container w3-half">
 			  <div class="form-group">
                <label>สาขา *</label>
                <div id="txtHint"><b></b></div>
              </div>
            </div>
              <input type="hidden" name="t_in" value="<?php echo  $t; ?>">
              <input type="hidden" name="t_out" value="<?php echo $o; ?>">
              <input type="hidden" name="room_id" value="<?php echo $room_id; ?>"><br>
            </div>  
           <button   class="btn-lg btn-success">ยืนยัน</button> <a href="javascript:history.back(1)" class="btn-lg btn-primary">ย้อนกลับ</a>
      </div>
                
            </form>            
    

</body>
<script>
	function show_Amphur(str) {
	  if (str=="") {
		document.getElementById("txtHint").innerHTML="";
		return;
	  } 
	  if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
		  document.getElementById("txtHint").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("GET","search_major.php?q="+str,true);
	  xmlhttp.send();
	}    
</script>
</html>
