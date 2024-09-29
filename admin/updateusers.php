 <?php
    // include "./inc/connect.php";
  
    $select_query = "SELECT * from login_logs";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $user_id = $row_fetch['user_id'];
    $ip = $row_fetch['ip_address'];
    $device = $row_fetch['device_use'];
    $date = $row_fetch['date_logs'];
    ?>
 <div class="col-md-4 mb-3">
     <label for="">Login Information *</label>
     <div class="table-responsive my-2">
         <table class="table table-bordered text-white my-3" style="font-size: small;" id="myTable1">
             <thead>
                 <tr>
                     <th class="text-center">번호</th>
                     <th class="text-center">연결</th>
                     <th class="text-center">기기 사용</th>
                     <th class="text-center">상황.</th>
                 </tr>
             </thead>
             <tbody>
                 <td>₩ <?php  echo $user_id ?> </td>
                 <td>₩ <?php  echo $ip ?> </td>
                 <td>₩ <?php echo $device?> </td>
                 <td><?php echo $date?></td>
             </tbody>
         </table>
     </div>
 </div>