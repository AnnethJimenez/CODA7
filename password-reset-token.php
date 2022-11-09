<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="patient-login"><img src="logo.png" style="width: 37px" alt=""/> CODA DEFENSE SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <style >
      .btn-outline-light:hover{
        color: #25bef7;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
      }
    </style>
  <style >
    .bg-primary {
      background: #F0F2F0;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #000C40, #F0F2F0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.list-group-item.active {
  z-index: 2;
    color: #fff;
    background: #F0F2F0; 
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);
    background: linear-gradient(to right, #000C40, #F0F2F0);
    border-color: #c3c3c3;
}
.text-primary {
    color: #342ac1!important;
}
  </style>
</nav>
</head>
<body>
<div>
   <div class="container-fluid" style="margin-top:50px;">
      <div class="row">
        <div class="col-md-8" style="margin-top: 3%;">
          <div class="tab-content" id="nav-tabContent" style="width: 980px;">
            <div class="row">
              <div class="container">
                <div class="card">
                  <div class="card-header text-center">
                    Your E-mail has been sent!
                  </div>
                    <div class="card-body">
                <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;
                  require 'PHPMailer/src/Exception.php';
                  require 'PHPMailer/src/PHPMailer.php';
                  require 'PHPMailer/src/SMTP.php';
              if(isset($_POST['password-reset-token']) && $_POST['email'])
              {
                  include "db.php";  
                  $emailId = $_POST['email'];
                  $result = mysqli_query($con,"SELECT * FROM patreg WHERE email='" . $emailId . "'");
                  $row= mysqli_fetch_array($result);
                if($row)
                { 
                   $token = md5($emailId).rand(10,9999);
                   $expFormat = mktime(
                   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                   );
                  $expDate = date("Y-m-d H:i:s",$expFormat);
                  $update = mysqli_query($con,"UPDATE patreg set  reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");
                  $link = "<a href='http://codadef.com/CODA/reset-password-patient.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";  
                  $mail = new PHPMailer();
                  $mail->CharSet =  "utf-8"; 
                  $mail->IsSMTP();
                  $mail->SMTPAuth = true;                  
                  $mail->Username = "oneentis";
                  $mail->Password = "184323472163!Aa";
                  $mail->SMTPSecure = "ssl";  
                  $mail->Host = "smtp.gmail.com";
                  $mail->Port = "465";
                  $mail->From='oneentis@gmail.com';
                  $mail->FromName='J Francis';
                  $mail->AddAddress($_POST['email'], 'Francis');
                  $mail->Subject  =  'Reset Password';
                  $mail->IsHTML(true);
                  $mail->Body    = 'Reset Link '.$link.'';
                  if($mail->Send())
                  {
                    echo "<div class='col-md-4'><label>Check Your Email provider and Click on the link sent to your email.</label></div>";
                  }
                  else
                  {
                    echo "Mail Error - >".$mail->ErrorInfo;
                  }
                }else{
                  echo "Invalid Email Address. Go back";
                }
              }
              ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

