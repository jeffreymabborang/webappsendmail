<?php
    require "vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "vendor/phpmailer/phpmailer/src/SMTP.php";
    require "vendor/phpmailer/phpmailer/src/Exception.php";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    if (isset($_POST['submit'])) {
        $mail=new PHPMailer();
        $mail->isSMTP();

        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth="true";
        $mail->SMTPSecure="tls";
        $mail->Port="587";
        $mail->Username="jeffrey.mabborang0717@gmail.com";
        $mail->Password="j3ffreymabbor4ng_17";
        $mail->setFrom("jeffrey.mabborang0717@gmail.com",);
   
		$user_image = $_FILES['attachment']['name'];
        $user_image_tmp = $_FILES['attachment']['tmp_name'];
        $uploads_folder="./uploads/";
        move_uploaded_file($user_image_tmp,$uploads_folder.$user_image);
       
        //     // Add attachments
        $mail->addAttachment('./uploads/'.$user_image);
        // $mail->addAttachment('files/codexworld.docx');
        // $mail->addAttachment('images/codexworld.png', 'new-name.png'); //set new name
        if($_POST['info']!="")
        {
            $mail->Body=$_POST['info'];
        }
        $mail->addAddress($_POST['gmail2']);

        if ($mail->Send()) {
            echo "Email Sent!";
        }
        else
        {
            echo "Error!";
        }




    
        $mail->smtpClose();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test:Sending Text and File</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        To:   <input type="email" name="gmail2" required/><br>
        Additional Text: <input type="text" name="info" id=""><br>
        File: <input type="file" name="attachment" required/><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
