<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Edit Category');
define('PAGE', 'categoryEdit');
include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
// Update
if (isset($_REQUEST['requpdate'])) {
    // Checking for Empty Fields
    if (($_REQUEST['id'] == "") || ($_REQUEST['categoryName'] == "") || ($_REQUEST['Status'] == "")) {
        // msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
        // Assigning User Values to Variable
        $cid = $_REQUEST['id'];
        $cname = $_REQUEST['categoryName'];
        $cstatus = $_REQUEST['Status'];

        $sql = "UPDATE category SET id = '$cid', categoryName = '$cname', Status = '$cstatus' WHERE id = '$cid'";
        if ($conn->query($sql) == TRUE) {
            // below msg display on form submit success
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        } else {
            // below msg display on form submit failed
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
        }
    }
}
?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
    <h3 class="text-center">Update Category Details</h3>
    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM category WHERE id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" id="id" name="id" value="<?php if (isset($row['id'])) {
                                                                                    echo $row['id'];
                                                                                } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php if (isset($row['categoryName'])) {
                                                                                                        echo $row['categoryName'];
                                                                                  } ?>">
        </div>


        <div class="form-group">
            <label for="Status">Status: </label>
            <input type="radio" name="Status" id="Status" value="1" checked="checked"> Active
            <input type="radio" name="Status" id="Status" value="0"> Inactive
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="categoryList.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php');
?>