<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Category Lists');
define('PAGE', 'manageCategory');
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
    <p class=" bg-dark text-white p-2">List of Categories</p>
    <?php
      $sql = "SELECT * FROM category";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table">
       <thead>
        <tr>
         <th scope="col">ID</th>
         <th scope="col">Name</th>
         <th scope="col">Status</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["id"].'</th>';
          echo '<td>'. $row["categoryName"].'</td>';
          if($row["Status"] == 1){
            echo '<td><button class="btn btn-success" disabled>Active</button></td>';
          }
          if($row["Status"] == 0){
            echo '<td><button class="btn btn-danger" disabled>Inactive</button></td>';
          }
          echo '<td><form action="editcategory.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
          <form action="" method="POST" onclick="checker()" class="d-inline"><input type="hidden" name="id" value='. $row["id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
         </tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete'])){
       $sql = "DELETE FROM category WHERE id = {$_REQUEST['id']}";
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
 <div><a class="btn btn-danger box" href="./addCategory.php"><i class="fas fa-plus fa-2x"></i></a></div>
</div>  <!-- div Conatiner-fluid close from header -->






    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="../js/all.min.js"></script>

    <!-- Admin Ajax Call JavaScript -->
    <script type="text/javascript" src="..js/adminajaxrequest.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="../js/custom.js"></script>

    <script> 
      function checker(){
        var result = confirm("Do you really want to delete?");
        if(result == false){
          event.preventDefault();
        }
      }
    </script>
</body>

</html>