<?php
//Connect to database
//Written by EnterSoft Systems
//Year 2017
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

require '../PHPMailer/PHPMailerAutoload.php';

///Login
if (isset($_POST['loginButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db->login($username, $password);
}
//Forgot Password
if (isset($_POST['forgotPasswordButton'])) {
    $email = $_POST['email'];

    $checkEmail = $db->checkEmailIfExist($email);
    if ($checkEmail->rowCount() > 0) {
        $rw = $checkEmail->fetch();
        $userid = $rw['user_id'];
        $keyGen = $rw['keyGen'];
        $username = $rw['username'];

        //Send Email
        $emailAddress = $email;
        $sendTo = array();
        $sendTo[] = "sirmido4@gmail.com";
        $sendTo[] = $emailAddress;

        $from = "info@mct.go.tz";
        $headers = 'From:info@tiis.go.tz';
        $url = "http://tiis.go.tz/wao_v4/login/changepassword.php?keygen=" . $keyGen; //Change login url
        $subject = "Notification from WAO Application";
        $msg = "Hellow" . ' ' . addslashes(ucwords(strtolower($username))) . ",<br/><br/>
         Someone requested to change your WAO password. Follow the link below so as to change your password.
		 <br/><br/>
		 <a href=" . $url . ">Click here to change your password</a><br/><br/>
         
         Thank You<br/><br/>
         ";

        /* foreach($sendTo as $email)
         {
          mail($email,$subject,$msg,$headers);//send email
          $confirm="Notification to WAO";
	     } */

        foreach ($sendTo as $email) {
            $mail = new PHPMailer();
            $mail->IsSMTP();                        // set mailer to use SMTP
            $mail->Host = "xterra.websitewelcome.com";         // specify main and backup server
            $mail->SMTPAuth = true;        // turn on SMTP authentication
            $mail->Username = 'noreply@tiis.go.tz';    // SMTP username
            $mail->Password = 'medel2018';    // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->From = 'info@tiis.go.tz';

            $GLOBEmailOn = true;


            $mail->FromName = $headers;
            $mail->AddAddress($email, $name);
            $mail->AddReplyTo('info@tiis.go.tz');
            $mail->IsHTML(true);                    // set email format to HTML
            $mail->WordWrap = 100;                   // set word wrap to 50 characters

            $mail->Subject = $subject;
            $mail->Body = $msg;

            $mail->Body = $mail->Body;

            if ($GLOBEmailOn == true) {
                // attempt to send the email
                $mail->Send();
            }
        }

        echo '<script language="javascript">';
        echo 'alert("Email with a link to change password is sent to your email. Open your email so as to change password")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/forgotpassword.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: No such email in our database.')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/forgotpassword.php"';
        echo '</script>';
    }
}
//Password Reset
if (isset($_POST['passResetButton'])) {
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $key = $_POST['key'];

    //Check if password match
    if ($password != $password1) {
        echo '<script language="javascript">';
        echo "alert('Error: Passwords do not match')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/changepassword.php?keygen=' . $key . '"';
        echo '</script>';
    } else {
        $changeP = $db->changePassword($password, $key);
        if (isset($changeP)) {
            echo '<script language="javascript">';
            echo "alert('Password changed sucessfully, now you can log in')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../login/"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Password not changed')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../login/changepassword.php"';
            echo '</script>';
        }
    }
}
        elseif (isset($_POST['addvehicle']))
{
    $regn = $_POST['regn'];
    $date = $_POST['date'];
    $nida = $_POST['nida'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $db->addvehicle($regn,$date,$nida,$mobile,$location);
            echo '<script language="javascript">';
            echo 'location.href = "../page/vehicleManage.php"';
            echo '</script>';
}

    elseif (isset($_POST['editvehicle']))
{
    $regn = $_POST['regn'];
    $date = $_POST['date'];
    $nida = $_POST['nida'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];
    $id = $_POST['id'];
    $db->editvehicle($regn,$date,$nida,$mobile,$location,$id);
            echo '<script language="javascript">';
            echo 'location.href = "../page/vehicleManage.php"';
            echo '</script>';
}

elseif (isset($_POST['deletevehicle']))
{
    $id = $_POST['vehicleid'];
    $res = $db->deletevehicle($id);
            echo '<script language="javascript">';
            echo 'location.href = "../page/vehicleManage.php"';
            echo '</script>';
}

    elseif (isset($_POST['addbill']))
{
    $bid = $_POST['bid'];
    $veid = $_POST['veid'];
    $amount = $_POST['amount'];
    $penalty = $_POST['penalty'];
    $status = $_POST['status'];
    $db->addbill($bid,$veid,$amount,$penalty,$status);
            echo '<script language="javascript">';
            echo 'location.href = "../page/BillsManage.php"';
            echo '</script>';
}

    elseif (isset($_POST['editbill']))
{
    $bid = $_POST['bid'];
    $veid = $_POST['veid'];
    $amount = $_POST['amount'];
    $penalty = $_POST['penalty'];
    $status = $_POST['status'];
    $db->editbill($bid,$veid,$amount,$penalty,$status);
            echo '<script language="javascript">';
            echo 'location.href = "../page/BillsManage.php"';
            echo '</script>';
}

elseif (isset($_POST['deletebill']))
{
    $bid = $_POST['billid'];
    $res = $db->deletebill($bid);
            echo '<script language="javascript">';
            echo 'location.href = "../page/BillsManage.php"';
            echo '</script>';
}
?>