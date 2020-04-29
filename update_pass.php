
<?php
	session_start();

		

    include 'ConnectDB.php';
    mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");

		


		


                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
              $stu_id = $_POST['stu_id'];
                if($password==$confirm_password){
                    $pass_ok = $password;
                    
                $query_booking = "update user set password = '$pass_ok' where user_name = '$stu_id'";
                $result2=mysqli_query($con,$query_booking);                  
                if($result2){
                    echo '<script type="text/javascript">
					  alert("เเก้ไขรหัสผ่านเเล้ว"); 
					  window.location="index.php";
						</script>';
                }else{
                    echo '<script type="text/javascript">
					  alert("ไม่สำเร็จ"); 
					  window.location="javascript:history.back(1)";
						</script>'; 
                }
                    
                }else{
                    echo '<script type="text/javascript">
					  alert("รหัสผ่านไม่ตรงกัน"); 
					  window.location="javascript:history.back(1)";
						</script>';
                }
          
        

              
           

             

    
?>


