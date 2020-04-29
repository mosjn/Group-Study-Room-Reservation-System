<style>
            #hid{
            display:none;
        }

</style>

<?php
$user_name = $_GET['user_name'];
$question = $_GET['question'];
$answer= $_GET['answer'];

include 'ConnectDB.php';
mysqli_set_charset($con,"utf8");
 
$sql="SELECT * FROM `user` where user_name = '$user_name' and  question_id ='$question' and answer = '$answer' ";
$result = mysqli_query($con,$sql);
$row_query=mysqli_fetch_assoc($result);
$user=$row_query['user_name'];
$password=$row_query['password'];
if($row_query==null){
		echo '<br><label style="color:red;">กรอกข้อมูลไม่ถูกต้อง *</label><br>';
}else{
		echo '
            <form action="update_pass.php" method="post">
                <label >กรอกรหัสผ่านใหม่ *</label>
                 <input type="password" class="form-control" pattern="[A-Za-z0-9]{8,20}" maxlength="20" placeholder="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร" name="password"  required>
                 <label >ยืนยันรหัสผ่านใหม่อีกครั้ง *</label>
                 <input type="password" class="form-control" pattern="[A-Za-z0-9]{8,20}" maxlength="20" placeholder="รหัสผ่านต้องเป็นภาษาอังกฤษหรือตัวเลข มีความยาว 8-20 ตัวอักษร" name="confirm_password"  required><br>
                 <input type="hidden" value="'.$user_name.'" name="stu_id">
                 <button  class="btn btn-success form-control"  type="submit">ยืนยันเพื่อเปลี่ยนรหัสผ่าน</button>
             </form>    
                 <br><br>
			 ';

}

mysqli_close($con);
?>
