<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Feedback');
define('PAGE', 'feedback');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>
  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Feedbacks</p>
    <?php
      $sql = "SELECT * FROM feedback";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table">
       <thead>
        <tr>
         <th scope="col">Feedback ID</th>
         <th scope="col">Content</th>
         <th scope="col">Student ID</th>
         <th scope="col">Status</th></th>

         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["f_id"].'</th>';
          echo '<td>'. $row["f_content"].'</td>';
          echo '<td>'.$row["stu_id"].'</td>';
          echo '<td>'.$row["status"].'</td>';
          if($row["status"] == 0){
            echo '<td><form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["f_id"] .'><button type="submit" class="btn btn-success" name="delete" value="1"><i class="fas fa-thumbs-up"></i></button></form></td>';
          }
          if($row["status"] == 1){
            echo '<td><form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["f_id"] .'><button type="submit" class="btn btn-danger" name="delete" value="0"><i class="fas fa-thumbs-down"></i></button></form></td>';
          }
          echo '</tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete']) && $_REQUEST['delete']==1){
       $sql = "UPDATE feedback SET status = 1 WHERE f_id = {$_REQUEST['id']}";
       if($conn->query($sql) === TRUE){
         // echo "Record Deleted Successfully";
         // below code will refresh the page after deleting the record
         echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
         } else {
           echo "Unable to Delete Data";
         }
      }

      if(isset($_REQUEST['delete']) && $_REQUEST['delete']==0){
        $sql = "UPDATE feedback SET status = 0 WHERE f_id = {$_REQUEST['id']}";
        if($conn->query($sql) === TRUE){
          // echo "Record Deleted Successfully";
          // below code will refresh the page after deleting the record
          echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
          } else {
            echo "Unable to Delete Data";
          }
       }
     ?>
  </div>
 </div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>