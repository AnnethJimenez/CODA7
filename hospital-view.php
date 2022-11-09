<!DOCTYPE html>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $doctorname = $row['doctorname'];
    $htype = $row['htype'];
    $haddress = $row['haddress'];
    $descrip = $row['descrip'];
    $email = $row['email'];
    $username = $row['username'];
    $spec = $row['spec'];
    $docFees = $row['docFees'];
    $dpassword = $row['password'];
    $longtitude = $row['longtitude'];
    $latitude = $row['latitude'];
?>
<?php 
  include('session.php');
  include('design.php');
  include('db.php');
  include('newfunc.php');
  if(isset($_POST['addadmin']))
{
  $name=$_POST['name'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $email=$_POST['email'];
  $query="INSERT into admintb (name,username,password,email)values('$name','$username','$password','$email')";
  $result=mysqli_query($con,$query);
  if($result)
  {
        $_SESSION['fname'] = $_POST['username'];
        $_SESSION['lname'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
    echo "<script>alert('Superadmin added successfully!');</script>";
  }
}
      $id = $_SESSION['id'];
      $email = $_SESSION['email'];
      $name = $_SESSION['name'];
      $username = $_SESSION['username'];
?>
<!-- SUPERADMIN Session -->
<?php 
$username=$_SESSION["username"];
if (count($_POST) > 0) 
  {
      $result = mysqli_query($con, "SELECT * FROM admintb WHERE username='".$username."'");
      $row = mysqli_fetch_array($result);
      if ($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"])
        {
            mysqli_query($con, "UPDATE admintb set password='" . $_POST["newPassword"] . "' WHERE username=".$username."'");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
?>
<html lang="en">
  <head>
    <title><?php echo $doctorname;?> Viewing</title>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="admin-panel1"><img src="logo.png" style="width: 37px" alt=""/>CODA DEFENSE SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="admin-panel1"></a>
      </li>
    </ul>
     <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="#" style="color: black" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
       <i class="fa fa-user"></i> 
            <?php 
              echo $name;
            ?>
          </a>
      <!-- Upper right SUPERADMIN -->
        <div class="dropdown-menu dropdown-menu-end">          
          <a href="#" class="dropdown-item "><i class="fa fa-bell"></i> Notification</a>
          <a href="#" class="dropdown-item"> Profile</a>
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
          <a class="dropdown-item" href="#add-superadmin" data-toggle="list"><i class="fa fa-user-plus"></i></i> Add Superadmin</a>
          <div class="dropdown-divider"></div>
          <a href="logout1" class="dropdown-item"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        </div>
        <!--   -->
        </p>
      </li>
    </ul>
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <!-- Side Navigation -->
  <body style="padding-top:50px;">
   

   <?php

    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $doctorname = $row['doctorname'];
    $htype = $row['htype'];
    $haddress = $row['haddress'];
    $descrip = $row['descrip'];
    $email = $row['email'];
    $username = $row['username'];
    $spec = $row['spec'];
    $docFees = $row['docFees']; 
    $dpassword = $row['password'];
    $longtitude = $row['longtitude'];
    $latitude = $row['latitude'];
  ?>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;margin-left: 15%;">
    <center><div class="tab-content" id="nav-tabContent" style="width: 980px;"></center>
      <div class="card">
        <div class="card-header text-center" style="background-color: skyblue;">
            <h1><i class="fa fa-hospital"></i> <?php echo $doctorname ?></h1>
        </div>
      <div class="card-body">
        <form class="form-group center table-responsive" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Hospital Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$doctorname"; ?></u></div>
                  <div class="col-md-4"><label>Description:</label></div>
                  <div class="col-md-8"><u><?php echo "$descrip"; ?></u></div>
                  <div class="col-md-4"><label>Hospital Type:</label></div>
                  <div class="col-md-8"><?php echo "$htype"; ?></div>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><?php echo "$haddress"; ?></div>
                  <div class="col-md-4"><label>Username:</label></div>
                  <div class="col-md-8"><?php echo "$username"; ?></div>
                  <div class="col-md-4"><label>Service Type:</label></div>
                  <div class="col-md-8"><?php echo "$spec"; ?></div>
                  <div class="col-md-4"><label>Service Fee:</label></div>
                  <div class="col-md-8"><?php echo "$docFees"; ?></div>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><?php echo "$dpassword";?></div>
                  <div class="col-md-12">
            <!-- MAP -->
                  <style>
                    #map {
                      height: 400px;
                      width: 100%;
                    }
                  </style>
                  <script>
                  function initMap() 
                  {
                    const uluru = { lat: <?php echo $latitude; ?>, lng: <?php echo $longtitude; ?> };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: uluru,
                  });
                    const marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                  });
                  }
                  </script>                 
                  <h3>Location of <?php echo $doctorname; ?> Hospital</h3>
                  <div id="map"></div>
                    <script
                      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv5GLdJQde5DtUXkH4hFj4qTziyNk4pws&callback=initMap&v=weekly" async>        
                    </script>
                    <!-- end of MAP -->
          </div>
          </div>
         
        </form>
        <?php
          echo "<a href = hospital-edit?id={$row["id"]}/><button  class='btn btn-success'>Edit</button></a>";
        ?>
        <a href="admin-panel1"><button class="btn btn-danger">Back</button></a>
      </div>
    </div>
  </div>

        
      <!-- Change Password -->
      <div class="tab-pane fade" id="list-cpassword" role="tabpanel" aria-labelledby="list-cpassword-list">
        <div class="col-md-8">
          <div class="row">
            <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
              <div style="width:500px;">
                <div class="message">
                  <?php if(isset($message)) { echo $message; } ?>
                </div>
                <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                  <tr class="tableheader">
                    <td colspan="2">Change Password</td>
                  </tr>
                  <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="password" name="currentPassword" class="form-control"/><span id="currentPassword"  class="required"></span></td>
                  </tr>
                  <tr>
                  <td>
                    <label>New Password</label>
                  </td>
                  <td>
                    <input type="password" name="newPassword" class="form-control"/><span id="newPassword" class="required"></span>
                  </td>
                  </tr>
                  <td>
                    <label>Confirm Password</label>
                  </td>
                  <td>
                    <input type="password" name="confirmPassword" class="form-control"/><span id="confirmPassword" class="required"></span>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="2">
                    <input type="submit" name="submit" value="Submit" class="btnSubmit">
                  </td>

                </tr>
   
              </table>
            </div>
          </form>
        </div> 
      </form>
    </div>

              <!-- Script for changing SUPERADMIN Password. -->     
              <script>
                function validatePassword() 
                {
                  var currentPassword,newPassword,confirmPassword,output = true;

                  currentPassword = document.frmChange.currentPassword;
                  newPassword = document.frmChange.newPassword;
                  confirmPassword = document.frmChange.confirmPassword;

                if(!currentPassword.value) 
                {
                  currentPassword.focus();
                  document.getElementById("currentPassword").innerHTML = "required";
                  output = false;
                }
                  else if(!newPassword.value) {
                  newPassword.focus();
                  document.getElementById("newPassword").innerHTML = "required";
                  output = false;
                }
                  else if(!confirmPassword.value) {
                  confirmPassword.focus();
                  document.getElementById("confirmPassword").innerHTML = "required";
                  output = false;
                }
                if(newPassword.value != confirmPassword.value) 
                {
                  newPassword.value="";
                  confirmPassword.value="";
                  newPassword.focus();
                  document.getElementById("confirmPassword").innerHTML = "not same";
                  output = false;
                }   
                return output;
                }
              </script>
              <!-- end of script -->        
        <br>
      </div>
<!-- Add Hospital -->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
   <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
  </body>
</html>