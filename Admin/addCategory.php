<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/adminCategoryStyle.css">
    <script src="https://kit.fontawesome.com/3135f90fa0.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <header>
            <a href="adminDashboard.php" class="headlink">
                <p><span class="learn">E-Learning</span> Admin Area</p>
            </a>
        </header>
        <aside>
            <a href="adminDashboard.php">
                <div class="aisdeCon">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </div>
            </a>
            <a href="courses.php">
                <div class="aisdeCon">
                    <i class="fab fa-accessible-icon"></i>
                    Courses
                </div>
            </a>
            <a href="lessons.php">
                <div class="asideCon">
                    <i class="fab fa-accessible-icon"></i>
                    Lessons
                </div>
            </a>
            <a href="students.php">
                <div class="asideCon">
                    <i class="fas fa-users"></i>
                    Students
                </div>
            </a>
            <a href="addCategory.php">
                <div class="asideCon active">
                    <i class="fas fa-bars"></i>
                    Add Category
                </div>
            </a>
            <a href="categoryList.php">
                <div class="asideCon">
                    <i class="fas fa-bars"></i>
                    Manage Category
                </div>
            </a>
            <a href="sellReport.php">
                <div class="asideCon">
                    <i class="fas fa-table"></i>
                    Sell Report
                </div>
            </a>
            <a href="adminPaymentStatus.php">
                <div class="asideCon">
                    <i class="fas fa-table"></i>
                    Payment Status
                </div>
            </a>
            
            <a href="./stream/index.html" target="_blank">
                <div class="asideCon">
                <i class="fab fa-accessible-icon"></i>
                    Start Stream
                </div>
            </a>
            <a href="feedback.php">
                <div class="asideCon">
                    <i class="fab fa-accessible-icon"></i>
                    Feedback
                </div>
            </a>
            <a href="adminChangePass.php">
                <div class="asideCon">
                    <i class="fas fa-key"></i>
                    Change Password
                </div>
            </a>
            <a href="../logout.php">
                <div class="asideCon">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </div>
            </a>
        </aside>
        <main>
            <h4 class="category_header">ADD CATEGORY</h4>
            <form action="manageCategory.php" method="POST">
                <div class="box">
                    <p class="categoryInfo">Category Info</p>
                    <div class="search">
                        <div class="boxtext">
                            Category Name:
                        </div>
                        <div class="searchBar">
                            <input type="text" name="category">
                        </div>

                        <?php if (isset($_SESSION['categoryErr'])) { ?>
                            <div class="categoryErr"><?php echo $_SESSION['categoryErr']; unset($_SESSION['categoryErr']) ?></div>
                        <?php } ?>

                        <label class="boxtext">Status:</label>
                        <div class="radio">
                            <label class="status">
                                <input type="radio" name="status" id="status" value="1" checked="checked"> Active
                            </label>
                        </div>
                        <div class="radio">
                            <label class="status">
                                <input type="radio" name="status" id="status" value="0"> Inactive
                            </label>
                        </div>
                        <input type="submit" name="submit" value="Create">
                    </div>
                </div>
            </form>
        </main>


        <?php if (isset($_SESSION['validres'])) : ?>
            <div class="validPopup">
                <i class="fa-solid fa-circle-check"></i>
                <?php
                echo $_SESSION['validres'];
                unset($_SESSION['validres']);
                ?>
            </div>
        <?php endif; ?>


        <?php if (isset($_SESSION['invalidres'])) : ?>
            <div class="invalidPopup">
                <i class="fa-solid fa-circle-xmark" style="color: rgb(245, 163, 169);"></i>
                <?php
                echo $_SESSION['invalidres'];
                unset($_SESSION['invalidres']);
                ?>
            </div>
        <?php endif; ?>




    </div>
</body>

</html>