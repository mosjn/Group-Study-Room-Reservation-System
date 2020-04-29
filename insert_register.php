 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
	include 'menu_bar/library .php';
	?>
<?php
        function resizeImage($resourceType, $image_width, $image_heigth){
           $resizeWidth= 250;
           $resizeHeight = 300;
           $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight );
           imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight,$image_width,$image_heigth);
        return $imageLayer;
        }
    
?>
<?php 
	session_start();
	include 'ConnectDB.php';
	mysqli_set_charset($con,"utf8");

	$user_name = mysqli_real_escape_string($con, $_POST['user_name']); 
	$name =  mysqli_real_escape_string($con, $_POST['name']); 
	$last_name = mysqli_real_escape_string($con, $_POST['last_name']); 	
	$phone  = mysqli_real_escape_string($con, $_POST['phone']); 
	$email =  mysqli_real_escape_string($con, $_POST['email']); 
	$password   = mysqli_real_escape_string($con, $_POST['password']); 
	$confirm_password   = mysqli_real_escape_string($con, $_POST['confirm_password']); 
	$question_id   = mysqli_real_escape_string($con, $_POST['question_id']); 
	$answer   = mysqli_real_escape_string($con, $_POST['answer']); 
	$faculty_id  = mysqli_real_escape_string($con, $_POST['faculty_id']); 
    $major_id   = mysqli_real_escape_string($con, $_POST['major_id']); 

			$sql2 = "SELECT * FROM faculty where faculty_id='$faculty_id'";
				$result_amphur=mysqli_query($con,$sql2); 
				$row_amphur=mysqli_fetch_assoc($result_amphur);
				$faculty_name = $row_amphur['faculty_name'];

			$sql3 = "SELECT * FROM major where major_id='$major_id'";
				$result_district=mysqli_query($con,$sql3); 
				$row_district=mysqli_fetch_assoc($result_district);
				$major_name = $row_district['major_name'];

			


	if($password==$confirm_password){
		
		$password_ok = $password;

        $images1 = $_FILES['images1']['name'];
                          
  if(isset($_POST["form_submit"])){
      $imageProcess = 0;
      if(is_array($_FILES)){
          
          $fileName = $_FILES['images1']['tmp_name'];
          $sourceProperties = getimagesize($fileName);
          $resizeFileName = time();
          $uploadPath = "images/profile/";
          $fileExt = pathinfo($_FILES['images1']['name'], PATHINFO_EXTENSION);
          $uploadImageType = $sourceProperties[2];
          $sourceImageWidth = $sourceProperties[0];
          $sourceImageHeight = $sourceProperties[1];
          switch($uploadImageType){
              case IMAGETYPE_JPEG:
                  $resourceType = imagecreatefromjpeg($fileName);
                  $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                  imagejpeg($imageLayer,$uploadPath."".$_FILES['images1']['name']); 
                  break;
              case IMAGETYPE_GIF:
                  $resourceType = imagecreatefromgif($fileName);
                  $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                  imagegif($imageLayer,$uploadPath."".$_FILES['images1']['name']); 
                  break;
              case IMAGETYPE_PNG:
                  $resourceType = imagecreatefrompng($fileName);
                  $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                  imagepng($imageLayer,$uploadPath."".$_FILES['images1']['name']); 
                  break;
              default:
                  $imageProcess = 0;
                  break;
                  
          }
    
      }
			
		$query_email = "select * from user where email = '$email'";
  		$result_email=mysqli_query($con,$query_email); 
        $count_email=mysqli_num_rows($result_email);    
        if($count_email>='1'){
                              echo '<script type="text/javascript">
                                  alert("อีเมลนี้ได้ทำการสมัครใช้งานไปแล้ว"); 
                                 window.location="javascript:history.back(1)";
                                    </script>';           
        }else{

		$sql4 = "INSERT INTO `user` (`user_name`, `password`, `name`, `last_name`, `status`, `email`, `phone`, `question_id`, `answer`, `faculty`, `major`, `img_pro`) VALUES ('$user_name', '$password_ok', '$name', '$last_name', '0', '$email', '$phone', '$question_id', '$answer', '$faculty_name', '$major_name', '$images1');";
		$result_address=mysqli_query($con,$sql4); 	
		if($result_address){
			
                            echo '<script type="text/javascript">
                                  alert("สมัครสำเร็จ"); 
                                 window.location="login.php";
                                    </script>'; 
		}else{
                            echo '<script type="text/javascript">
                                  alert("รหัสผู้ใช้นี้ได้ทำการสมัครใช้งานไปแล้ว"); 
                                 window.location="javascript:history.back(1)";
                                    </script>'; 
		  }
      }
	}else{
                            echo '<script type="text/javascript">
                                  alert("รหัสผ่านไม่ตรงกัน"); 
                                 window.location="javascript:history.back(1)";
                                    </script>'; 
			
	}

}

?>
