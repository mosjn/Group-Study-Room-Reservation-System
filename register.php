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
         document.getElementById("plan").selectedIndex = "0";
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
                   


    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">สมัครสมาชิก</h1>

        </center> 

    </div>
     
        <div id="wss">
            <form action="insert_register.php" method="post" enctype="multipart/form-data">
 <div style="height:580px;">
            <div class=" w3-container w3-col">      
                 <div class="form-group">
                    <label>ชื่อรหัสผู้ใช้ * (รหัสนิสิต เช่น 59xxxxxxxx)</label>
                    <input type="text" class="form-control" placeholder="5912345678" name="user_name"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" >
                  </div>
                </div>
                <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>ชื่อ *</label>
                   <input type="text" class="form-control"   name="name" placeholder="กรุณากรอกชื่อ" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่ชื่อ">
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>นามสกุล *</label>
                  <input type="text" class="form-control"  name="last_name" placeholder="กรุณากรอกนามสกุล" minlength="4" maxlength="50" pattern="[ A-Za-zก-ฮะ-์]{4,50}" required title="กรุณาใส่นามสกุล">
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>อีเมล *</label>
                   <input type="email" class="form-control"   name="email" placeholder="กรุณากรอกอีเมลล์" minlength="4" maxlength="50" required title="กรุณากรอกอีเมลล์">
               </div>
              </div>
            <div class=" w3-container w3-half">
                   <div class="form-group"> 
                     <label>เบอร์มือถือที่สามารถติดต่อได้ *</label>
                  <input type="text" class="form-control"  name="phone" placeholder="ตัวอย่าง 0851234567" pattern="[0-9_]{10,20}" maxlength="10" required title="กรุณาใส่เบอร์มือถือ">
               </div>
              </div>
             <div class=" w3-container w3-half">
 			  <div class="form-group">
                <label>รหัสผ่าน *</label>
              <input type="password"  class="form-control" placeholder="ภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร"  id="password" name="password" pattern="[A-Za-z0-9]{8,20}" maxlength="20" required title="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร">
              </div>
            </div>
             <div class=" w3-container w3-half">
			  <div class="form-group">
                <label>ยืนยันรหัสผ่าน *</label>
              <input type="password"  class="form-control" placeholder="ภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร"  id="password" name="confirm_password" pattern="[A-Za-z0-9]{8,20}" maxlength="20" required title="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร">
              </div>    
            </div>
            <div class=" w3-container w3-half">
                <div class="form-group">
                    <label>คำถามลืมรหัสผ่าน *</label>
                        <select class="form-control" name="question_id" id="question"   onchange="show_question(this.value)" required>
                            <option value="">--เลือกคำถาม--</option>
                        <?php 
                            include 'ConnectDB.php';
                            mysqli_set_charset($con,"utf8");
                            $sql ="SELECT * FROM question order by question_id ASC";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result)) {
                                    echo "<option value='".$row['question_id']."'>" . $row['question_name'] . "</option>";   
                            }


                        ?>
                        </select>
                  </div>
            </div>
             <div class=" w3-container w3-half">
              <div class="form-group">  
              <label>คำตอบ *</label>
            <input   id="answer" name="answer" class="form-control" required title="กรุณากรอกคำตอบ"><br>
                </div>
            </div>
          <div class=" w3-container w3-half" style="margin-top:-20px;">
             <div class="form-group">  
                <label>เลือกรูปนิสิต * (ข้อมูลแสดงความเป็นนิสิต เช่น บัตรนิสิต) </label>
                <input type="file" name="images1" required>
            </div>  
        </div>                 
             <div class=" w3-container w3-half" style="margin-top:-20px;">
 			  <div class="form-group">
                <label>คณะ *</label>
                        <select class="form-control" name="faculty_id"  id="plan"  onchange="show_Amphur(this.value)" required>
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
 
</div>
                <button  name="form_submit"  class="btn-lg btn-success">ยืนยัน</button> <a href="javascript:history.back(1)" class="btn-lg btn-primary">ย้อนกลับ</a>
        </form>    
    
  </div>  	
        
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
