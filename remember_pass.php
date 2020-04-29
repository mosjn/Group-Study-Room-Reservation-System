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
                   


    
  ?>
    <div class="container">
        <center>
        <h1 id="headd" style="color:green">ลืมรหัสผ่าน</h1>

        </center> 

    </div>
   
        <div id="wss">
            	          <div class="form-group">
                <label>ชื่อรหัสผู้ใช้ *</label>
                <input type="text" class="form-control" placeholder="Username" id="user_name"  pattern="[0-9_]{10,20}" maxlength="10" required title="ชื่อไอดีต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 4-20 ตัวอักษร" >
              </div>
			<div class="form-group">
                <label>คำถามตอนสมัครสมาชิก *</label>
					<select class="form-control" name="question" id="question"   onchange="show_question(this.value)" required>
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
            
          <div class="form-group">  
          <label>คำตอบ *</label>
		<input   id="answer" name="answer" class="form-control" required title="กรุณากรอกคำตอบ"><br>
            </div>
            
			<div id="txtdist"><b></b></div>
			<div id="txtHint"><b></b></div>
	
		<button id="hid"  onclick="check_remember()"  class="btn btn-primary form-control">ยืนยัน</button>
        </div>
<script>
	function check_remember() {
		var question = document.getElementById("question").value;
		var user = document.getElementById("user_name").value;
		var answer = document.getElementById("answer").value;

		
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
	  xmlhttp.open("GET","search_remember_password.php?user_name="+user+"&question="+question+"&answer="+answer ,true);
	  xmlhttp.send();
	}		

	function show_question(str) {
	  if (str=="") {
		document.getElementById("txtdist").innerHTML="";
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
		  document.getElementById("txtdist").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("GET","search_question.php?q="+str,true);
	  xmlhttp.send();
	}	
</script>

</body>
</html>
