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
        <h1 id="headd" ><img src="images/ku.png" style="width:80px;"> สำนักหอสมุดกำเเพงเเสน</h1>       </center> 
        <table class="table ">
           <thead>
                <tr class="danger">
                    <th id="thh">อาคาร</th>
                    <th id="thh">ชั้น</th>
                    <th id="thh">ห้องศึกษาเเบบกลุ่ม</th>
                </tr>
           </thead>
           <tbody>
                <tr>
                    <td id="thh">1</td>
                    <td id="thh">1</td>
                    <td id="thh">1 ห้อง (สำหรับ 6 คน)</td>
               </tr> 
               <tr>
                    <td id="thh">1</td>
                    <td id="thh">2</td>
                    <td id="thh">5 ห้อง (สำหรับ 6-10 คน)</td>
               </tr>
               <tr>
                    <td id="thh">2</td>
                    <td id="thh">2</td>
                    <td id="thh">6 ห้อง (สำหรับ 6-10 คน)</td>
               </tr>
            
           </tbody>
        </table>
            <h3>ขั้นตอนการใช้บริการห้องศึกษาเเบบกลุ่ม</h3>
            <h4>สิทธิ์การใช้งาน นิสิตระดับปริญญาตรี บัณทิตศึกษา</h4>
            <h4>1. จองห้องที่ <a style="font-size:20px;color:blue;" href="http://127.0.0.1/mo/index_today.php">http://127.0.0.1/mo/index_today.php</a> โดยเลือกหมายเลขห้องเเละเวลาที่ต้องการ</h4>
            <h4>2. รับกุญเเจห้องก่อนเวลาจอง หรือช้าไม่น้อยกว่า 15 นาที มิฉะนั้นจะถือว่าสละสิทธิ์</h4>
            <h4 style="color:red;"> หมายเหตุ กรุณาเเสดงบัตรนิสิตเเละรับกุญเเจห้องที่เคาน์เตอร์ยืม - คืน ชั้น 1 อาคาร 2 เเละเเสดงตัวพร้อมกัน 6 ท่านขึ้นไป</h4>
            
 

    </div>
        

    
  


</body>
</html>
