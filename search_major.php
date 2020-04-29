

<?php
$q = $_GET['q'];

include 'ConnectDB.php';
mysqli_set_charset($con,"utf8");

$sql="SELECT * FROM major where faculty_id = '$q'   ";
$result = mysqli_query($con,$sql);

echo "

<select name='major_id' id='major'  class='form-control'  required>";
	 echo "<option value=''>--เลือกหลักสูตร--</option>";
while($row = mysqli_fetch_array($result)) {

    echo "<option value='".$row['major_id']."'>" . $row['major_name'] . "</option>";   

}
echo "</select>";

mysqli_close($con);
?>
