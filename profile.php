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
        width: 800px;
        margin-left: auto;
        margin-right: auto;
    }  
    
    #con{
        width: 800px;

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
                   
if(!isset($_SESSION['login'])){ 
            echo 'กรุณาเข้าสู่ระบบก่อน';
	}
    $user_name=$_SESSION['login'];
    $query_user = "select * from user where user_name = '$user_name'";
    $result_user=mysqli_query($con,$query_user);
    $row_user=mysqli_fetch_array($result_user,MYSQLI_ASSOC);
    $name = $row_user['name'];
    $last_name = $row_user['last_name'];
    $email = $row_user['email'];
    $phone = $row_user['phone'];
    $faculty = $row_user['faculty'];
    $major = $row_user['major'];
    $img_pro = $row_user['img_pro'];
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">ข้อมูลส่วนตัว</h1>

        </center> 

    </div>
   
        <div id="wss">
             <center><img src="images/profile/<?php echo $img_pro; ?>"></center>
             <div class=" w3-container w3-col">
             <div class="form-group">
                <label>ชื่อรหัสผู้ใช้ *</label>
                <input type="text" class="form-control" placeholder="Username" name="user_name"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $user_name; ?>" disabled> 
              </div>
            </div>
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>ชื่อ *</label>
                   <input type="text" class="form-control"   name="name" placeholder="กรุณากรอกชื่อ" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่ชื่อ" value="<?php echo $name; ?>" disabled>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>นามสกุล *</label>
                  <input type="text" class="form-control"  name="last_name" placeholder="กรุณากรอกนามสกุล" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่นามสกุล" value="<?php echo $last_name; ?>" disabled>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>อีเมล *</label>
                   <input type="email" class="form-control"   name="email" placeholder="กรุณากรอกอีเมลล์" minlength="4" maxlength="50" required title="กรุณากรอกอีเมลล์" value="<?php echo $email; ?>" disabled>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เบอร์มือถือที่สามารถติดต่อได้ *</label>
                  <input type="text" class="form-control"  name="phone" placeholder="ตัวอย่าง 0851234567" pattern="[0-9_]{10,20}" maxlength="10" required title="กรุณาใส่เบอร์มือถือ" value="<?php echo $phone; ?>" disabled>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>คณะ *</label>
                  <input type="text" class="form-control"  name="phone" placeholder="ตัวอย่าง 0851234567" pattern="[0-9_]{10,20}" maxlength="10" required title="กรุณาใส่เบอร์มือถือ" value="<?php echo $faculty; ?>" disabled>
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>สาขา *</label>
                  <input type="text" class="form-control"  name="phone" placeholder="ตัวอย่าง 0851234567" pattern="[0-9_]{10,20}" maxlength="10" required title="กรุณาใส่เบอร์มือถือ" value="<?php echo $major; ?>" disabled>
               </div>
              </div>

                <button onclick="document.getElementById('login').style.display='block'"  class="btn-lg btn-success">เเก้ไขข้อมูล</button> <a href="javascript:history.back(1)" class="btn-lg btn-primary">ย้อนกลับ</a>    
        </div>
    
<div id="login" class="w3-modal">
<form action="query_profile_update.php" method="post" enctype="multipart/form-data">
 <div style="height:600px;">
  <div class="w3-modal-content w3-animate-zoom w3-padding-large">
    <div class="w3-container w3-white ">
      <i onclick="document.getElementById('login').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
      <h2 class="w3-wide">เเก้ไขข้อมูลส่วนตัว</h2>
	<br>
            <div class=" w3-container w3-half">
            <div class="form-group">
                <label>ชื่อรหัสผู้ใช้ *</label>
                <input type="text" class="form-control" placeholder="Username" name="user_name"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $user_name; ?>" disabled> 
                <input type="hidden" class="form-control" placeholder="Username" name="user_name"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" value="<?php echo $user_name; ?>" > 
              </div>
            </div>

                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>ชื่อ *</label>
                   <input type="text" class="form-control"   name="name" placeholder="กรุณากรอกชื่อ" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่ชื่อ" value="<?php echo $name; ?>" >
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>นามสกุล *</label>
                  <input type="text" class="form-control"  name="last_name" placeholder="กรุณากรอกนามสกุล" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่นามสกุล" value="<?php echo $last_name; ?>" >
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>อีเมล *</label>
                   <input type="email" class="form-control"   name="email" placeholder="กรุณากรอกอีเมลล์" minlength="4" maxlength="50" required title="กรุณากรอกอีเมลล์" value="<?php echo $email; ?>" >
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เบอร์มือถือที่สามารถติดต่อได้ *</label>
                  <input type="text" class="form-control"  name="phone" placeholder="ตัวอย่าง 0851234567" pattern="[0-9_]{10,20}" maxlength="10" required title="กรุณาใส่เบอร์มือถือ" value="<?php echo $phone; ?>" >
               </div>
              </div>
             <div class=" w3-container w3-half">
 			  <div class="form-group">
                <label>คณะ *</label>
                        <select class="form-control" name="faculty_id" id="faculty"   onchange="show_Amphur(this.value)" >
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
                    <div class=" w3-container w3-half">
                <div class="form-group">
                    <label>เปลี่ยนรูปนิสิต *</label>
                    <input type="file" name="images1" >
                </div> 
            </div>
</div>
        <button   class="btn-lg btn-success">ยืนยันการเเก้ไขข้อมูล</button> <a onclick="document.getElementById('login').style.display='none'" class="btn-lg btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
</div>
<script>
	$('document').ready(function() {
        document.getElementById("major").selectedIndex = "0";
        document.getElementById("faculty").selectedIndex = "0";
			});	
	
</script>
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
</body>
</html>
