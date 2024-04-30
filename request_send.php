<?php
 
$full_name  = $_SESSION["full_name"];
$usermail = $_SESSION["user_mail"];
$meeting_id = $_SESSION["meeting_id"];
$room_name = $_SESSION["room_name"];
$meeting_title = $_SESSION["meeting_title"];
 
$mdate = $_SESSION["mdate"];
$room_name = $_SESSION["room_name"];
$join_people = $_SESSION["join_people"];
$rid = $_SESSION["rid"];
 
 
 
//echo "$usermail";


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail->CharSet = 'UTF-8';
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.kplaocompany.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    //$mail->Username = 'tuidev1919@gmail.com';             // SMTP username
   // $mail->Password = 'tui@Dev2020';                           // SMTP password
    $mail->Username = 'ict-noreply@kplaocompany.com';             // SMTP username
    $mail->Password = 'INoRePly@ict20';
    $mail->SMTPSecure = 'Auto';                            // Enable SSL encryption, TLS also accepted with port 465
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ict-noreply@kplaocompany.com', 'ICT Meeting Room Request');          //This is the email your form sends From
    $mail->addAddress($usermail); // Add a recipient address
	
	$mail->AddCC('hr@kplaocompany.com');  // Add a recipient CC
	$mail->AddCC('hradmin@kplaocompany.com');  // Add a recipient CC 
	$mail->AddCC('hrm_recuitment@kplaocompany.com');  // Add a recipient CC 
 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = " ຄຳຂໍເລກທີ : $meeting_id  ";
    $mail->Body    = " 
 
	<div> ຫົວຂໍ້ປະຊຸມ: $meeting_title </div> 
	<div> ຊື່ຜູ້ຂໍ:$full_name  ພະແນກ/ໜ່ວຍງານ : $depart_name </div> 
	<div> ວັນທີ່ນຳໃຊ້: $mdate </div> 
	<div> ນຳໃຊ້ຫ້ອງປະຊຸມ: $room_name </div> 
	<div> ມີຜູ້ເຂົ້າຮ່ວມ: $join_people ຄົນ </div> 
  
	https://kplaocompany.com/Meetingroom/Login.php
	
	";
  

    $mail->send();
	
 
  
	 
 
?>