<?php
if (!isset($_SESSION)) {
   session_start();
}
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
   $stuEmail = $_SESSION['stuLogEmail'];
} else {
   echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['jpg'])) {
   //Create Portion
   $image = imagecreatefromjpeg("certificate.jpg");

   $sqll = "SELECT stu_name FROM student WHERE stu_email='$stuEmail'";
   $resultt = $conn->query($sqll);
   $a = $resultt->fetch_assoc();
   $name = $a['stu_name'];

   $namecolor = imagecolorallocate($image, 102, 102, 102);
   $namefont = 'EmbassyBT.ttf';

   imagettftext($image, 190, 0, 1000, 1300, $namecolor, $namefont, $name);
   $filepathjpg = "files/" . $name . ".jpg";

   $datecolor = imagecolorallocate($image, 97, 95, 94);
   $datefont = 'Montserrat-Bold.ttf';
   date_default_timezone_set("Asia/Dhaka");
   $date = date("d-M-Y");
   imagettftext($image, 70, 0, 1350, 1880, $datecolor, $datefont, $date);
   $filepathpdf = "files/" . $name . ".pdf";


   imagejpeg($image, $filepathjpg);
   imagedestroy($image);

   //PDF:
   require('fpdf.php');
   $pdf = new FPDF();
   $pdf->Addpage();
   $pdf->Image($filepathjpg, 0, 0, 210, 150);
   $pdf->Output($filepathpdf, "F");
   //Create Portion

   $filename = $name . ".jpg";
   $filepath = $filepathjpg;
   if (file_exists($filepath)) {
      header("Cache-Control: public");
      header("Content-Description: FILE Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/zip");
      header("Content-Transfer-Encoding: binary");

      readfile($filepath);
      exit;
   }
}
if (isset($_REQUEST['pdf'])) {

   //Create Portion
   $image = imagecreatefromjpeg("certificate.jpg");

   $sqll = "SELECT stu_name FROM student WHERE stu_email='$stuEmail'";
   $resultt = $conn->query($sqll);
   $a = $resultt->fetch_assoc();
   $name = $a['stu_name'];

   $namecolor = imagecolorallocate($image, 102, 102, 102);
   $namefont = 'EmbassyBT.ttf';

   imagettftext($image, 190, 0, 1000, 1300, $namecolor, $namefont, $name);
   $filepathjpg = "files/" . $name . ".jpg";

   $datecolor = imagecolorallocate($image, 97, 95, 94);
   $datefont = 'Montserrat-Bold.ttf';
   date_default_timezone_set("Asia/Dhaka");
   $date = date("d-M-Y");
   imagettftext($image, 70, 0, 1350, 1880, $datecolor, $datefont, $date);
   $filepathpdf = "files/" . $name . ".pdf";

   imagejpeg($image, $filepathjpg);
   imagedestroy($image);

   //PDF:
   require('fpdf.php');
   $pdf = new FPDF();
   $pdf->Addpage();
   $pdf->Image($filepathjpg, 0, 0, 210, 150);
   $pdf->Output($filepathpdf, "F");
   //Create Portion
   $pfname = $name . ".pdf";
   $pfpath = $filepathpdf;
   if (file_exists($pfpath)) {
      header("Cache-Control: public");
      header("Content-Description: FILE Transfer");
      header("Content-Disposition: attachment; filename=$pfname");
      header("Content-Type: application/zip");
      header("Content-Transfer-Encoding: binary");

      readfile($pfpath);
      exit;
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Watch Course</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="../css/bootstrap.min.css">

   <!-- Font Awesome CSS -->
   <link rel="stylesheet" href="../css/all.min.css">

   <!-- Google Font -->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/stustyle.css">
</head>

<body>

   <div class="container-fluid bg-primary p-2">
      <h3 style="color: white; font-weight:bold;">Welcome to E-Learning</h3>
      <a class="btn btn-dark" href="./myCourse.php">My Courses</a>
   </div>

   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-3 border-right">
            <h4 class="text-center" style="background-color: #00FFFF; padding: 1rem; border-radius:10px; margin-top: 1rem;">Lessons</h4>
            <ul id="playlist" class="nav flex-column">
               <?php
               if (isset($_GET['course_id'])) {
                  $course_id = $_GET['course_id'];
                  $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo '<li class="nav-item border-bottom py-2" movieurl=' . $row['lesson_link'] . ' style="cursor: pointer;">' . $row['lesson_name'] . '</li>';
                     }
                  }
               }
               ?>
            </ul><br>

            <span style=" font-family: Ubuntu, sans-serif; font-size: 1.3em;">
               <form action="" method="POST">
                  <input type="submit" name="submit" value="Get Certificate" style="width: 100%; background-color:black; color:white; border: white solid 5px; border-radius: 15px; ">
                  <?php
                  if (isset($_REQUEST['submit'])) {
                     echo '<input type="submit" name="jpg" value="Jpg" style="width: 50%; background-color:rgb(107, 107, 107); color:white; border: white solid 5px; border-radius: 10px;">';
                     echo '<input type="submit" name="pdf" value="Pdf" style="width: 50%; background-color:rgb(107, 107, 107); color:white; border: white solid 5px; border-radius: 10px;">';
                  }
                  ?>
               </form>
            </span>



         </div>
         <div class="col-sm-8">
            <video id="videoarea" src="" class="mt-5 w-75 ml-2" controls style="border: 5px solid black; border-radius:5px;">
            </video>
         </div>
      </div>
   </div>




   <!-- Jquery and Boostrap JavaScript -->
   <script type="text/javascript" src="../js/jquery.min.js"></script>
   <script type="text/javascript" src="../js/popper.min.js"></script>
   <script type="text/javascript" src="../js/bootstrap.min.js"></script>

   <!-- Font Awesome JS -->
   <script type="text/javascript" src="../js/all.min.js"></script>

   <!-- Ajax Call JavaScript -->
   <!-- <script type="text/javascript" src="..js/ajaxrequest.js"></script> -->

   <!-- Custom JavaScript -->
   <script type="text/javascript" src="../js/custom.js"></script>
</body>

</html>