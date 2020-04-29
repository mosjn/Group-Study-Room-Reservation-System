<?php 
	session_start();
	include 'ConnectDB.php';

$user_name = '';
$password = '';


if(isset($_POST['submit'])){
    if(isset($_POST['user_name'])){
        $user_name = $_POST['user_name'];  
    }   
    if(isset($_POST['password'])){
        $password = $_POST['password'];  
    }  
    $sql="SELECT * FROM `user` WHERE user_name='$user_name'"; 
    $result=mysqli_query($con,$sql);
    if($result){
        
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        /*echo '<script type="text/javascript">
            alert("'.$row['password'].'"); window.location="login.html"  
          
            </script>';*/
        if($row['password']==$password){
            $_SESSION['login']=$user_name;
			$_SESSION['status']=$row['status'];
			if($_SESSION['status']==0){
			echo '<script type="text/javascript">	
					window.location="index_today.php"  
            	</script>';	
				
			}else {
			echo '<script type="text/javascript">
					window.location="index_today.php"  
				</script>';		
			}
            
        }else{
            echo '<script type="text/javascript">
            alert("รหัสไม่ถูกต้อง"); window.location="login.php"  
          
            </script>';
        }
            
    }else{
        echo '<script type="text/javascript">
        
            alert("ชื่อผู้ใช้ไม่ถูกต้อง");  window.location="login.php"  
              </script>';
    }
}

?>
 