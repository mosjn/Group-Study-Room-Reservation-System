 
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
	date_default_timezone_set("Asia/Bangkok");
	if(!isset($_SESSION['login'])){ 
                    echo '<script type="text/javascript">
					  alert("กรุณาเข้าสู่ระบบ"); 
					  window.location="tomorrow.php";
						</script>';
	}else{
	$stu_id = mysqli_real_escape_string($con, $_POST['user_name']); 
	$name =  mysqli_real_escape_string($con, $_POST['name']); 
	$last_name = mysqli_real_escape_string($con, $_POST['last_name']); 	
	$phone  = mysqli_real_escape_string($con, $_POST['phone']); 
	$email =  mysqli_real_escape_string($con, $_POST['email']); 
	$faculty_id  = mysqli_real_escape_string($con, $_POST['faculty_id']); 
    $images1 = $_FILES['images1']['name'];      
      
 if($images1==''){
     
 }else{
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
                $query_img = "update user set img_pro = '$images1' where user_name = '$stu_id'";
                $result_img=mysqli_query($con,$query_img);        
     
    }
      if($faculty_id==''){
                 $query_booking = "update user set name = '$name', last_name='$last_name', email='$email', phone='$phone' where user_name = '$stu_id'";
                $result2=mysqli_query($con,$query_booking);             
      }else{
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

                $query_booking = "update user set name = '$name', last_name='$last_name', email='$email', phone='$phone', major = '$major_name', faculty = '$faculty_name'  where user_name = '$stu_id'";
                $result2=mysqli_query($con,$query_booking);    
      }
                    
              
                if($result2){
                    echo '<script type="text/javascript">
					  alert("เเก้ไขสำเร็จ"); 
					  window.location="javascript:history.back(1)";
						</script>';
                }else{
                    echo '<script type="text/javascript">
					  alert("ไม่สำเร็จ"); 
					  window.location="javascript:history.back(1)";
						</script>'; 
                }
                    

          
}

              
           

             

    
?>


