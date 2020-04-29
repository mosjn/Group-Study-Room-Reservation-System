<?php

                    $query_check_time = "SELECT * FROM `booking` WHERE booking_status='1'";
                    $check_time=mysqli_query($con,$query_check_time);
                                        while($row_check_time2=mysqli_fetch_array($check_time,MYSQLI_ASSOC))
                                        {
                                           $time_now22=date("H:i:s");
                                           $time_nows22=date("Y-m-d");
                                            
                                           $book_in =  $row_check_time2['booking_in'];
                                           $book_out =  $row_check_time2['booking_out'];
                                           $book_day =  $row_check_time2['booking_day'];
                                           $book_id =  $row_check_time2['booking_id'];
                                          $date_end1=date("H:i:s",strtotime($book_out."  +1 minute"));
                                          

                                            if($time_now22>=$date_end1 and ($time_nows22==$book_day)){
    
                                                
                                                $sql_update_status = "update booking set booking_status = '3' where booking_id = '$book_id'";
                                                $check_time_update=mysqli_query($con,$sql_update_status);
                                                    echo '<script type="text/javascript">
                                                      alert("มีรายการยกเลิก"); 
                                                      window.location="history_booking.php";
                                                        </script>';
                                            }else{
                                             
                                            }  

                                          
                                        }



?>