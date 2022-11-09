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
                      Updated
                    </div>
                    <div class="card-body">
                      <?php
                      if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
                      {
                        include "db.php";
                        
                        $emailId = $_POST['email'];
                        $token = $_POST['reset_link_token'];
                        
                        $password = $_POST['password'];
                        $query = mysqli_query($con,"SELECT * FROM patreg WHERE `reset_link_token`='".$token."' and `email`='".$emailId."'");
                         $row = mysqli_num_rows($query);
                         if($row){
                             mysqli_query($con,"UPDATE patreg set  password='" . $password . "', cpassword='" . $password . "' , reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
                             echo '<p>Congratulations! Your password has been updated successfully.</p>';
                         }else{
                            echo "<p>Something goes wrong. Please try again</p>";
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