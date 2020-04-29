<?php
	


if(isset($_SESSION["status"])){
		  if($_SESSION["status"]==2){
		
			  include "menu_bar/menu_admin.php";
		  }else if($_SESSION["status"]==0){
			   include "menu_bar/menu_cus.php";
			 
		  }
	  }else{
	
		   include "menu_guest.php";
	  }
	
?>

