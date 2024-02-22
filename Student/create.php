<?php
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
?>