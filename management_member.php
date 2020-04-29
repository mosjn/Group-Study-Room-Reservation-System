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
        width: 1400px;
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
        <h1 id="headd" style="color:green">ข้อมูลสมาชิก</h1>

        </center> 

    </div>
        <div id="wss">
            <?php 
                echo '<table class="table table-striped table-bordered"  id="example">
                        <thead>
                            <tr>
                                <th id="thh">ลำดับ</th>
                                <th id="thh">รูปนิสิต</th>
                                <th id="thh">รหัสนิสิต</th>
                                <th id="thh">ชื่อ-นามสกุล</th>
                                <th id="thh">คณะ</th>
                                <th id="thh">สาขา</th>
                                <th id="thh">อีเมล</th>
                                <th id="thh">เบอร์มือถือ</th>
                            </tr>
                        </thead>
                        ';
                $i=0;
                $query_user_all = "select * from user where status= '0'";
                 $result_room1=mysqli_query($con,$query_user_all);
                                        while($row_memeber=mysqli_fetch_array($result_room1,MYSQLI_ASSOC))
                                        {
                                         $i=$i+1;
                                          $member_id=$row_memeber['user_name'];
                                          $name=$row_memeber['name'];
                                          $last_name=$row_memeber['last_name'];
                                          $email=$row_memeber['email'];
                                          $phone=$row_memeber['phone'];
                                          
                                          $faculty =$row_memeber['faculty'];
                                          $major =$row_memeber['major'];
                                          $img_pro =$row_memeber['img_pro'];
                                            echo  '<tr>
                                                     <td id="thh">'.$i.'</td>
                                                     <td id="thh"><img src="images/profile/'.$img_pro.'" width="100px;"></td>
                                                     <td id="thh">'.$member_id.'</td>
                                                     <td id="thh">'.$name.' '.$last_name.'</td>
                                                     <td id="thh">'.$faculty.' </td>
                                                     <td id="thh">'.$major.' </td>
                                                     <td id="thh">'.$email.'</td>
                                                     <td id="thh">'.$phone.'</td>
                                                   </tr>  
                                                   ';
                                        }
            
                echo '</table>';
            ?>
        </div>

</body>
</html>
