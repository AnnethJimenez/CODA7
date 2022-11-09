<!DOCTYPE html>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointmenttb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $gender = $row['gender'];
    $email = $row['email'];
    $contact = $row['contact'];
    $doctor = $row['doctor'];
    $docFees = $row['docFees'];
    $doctorStatus = $row['doctorStatus'];
    $aid = $row['aid'];
?>
<?php 
include('db.php');
$id = $_GET['id'];
if(isset($_GET['approve']))
  {
    $query=mysqli_query($con,"UPDATE appointmenttb set  doctorStatus='Approve' where id = '$id'");
    if($query)
    {
      echo "<script>alert('You approved patient's appointment.);</script>";
    }
  }
if(isset($_GET['decline']))
  {
    $query2=mysqli_query($con,"UPDATE appointmenttb set  doctorStatus='Decline' where id = '$id'");
    if($query2)
    {
      echo "<script>alert('You decline patient's appointment.);</script>";
    }
  } 
?>
<?php 
  include('session-hospital.php');
  include('design-hospital.php');
  include('db.php');
  $dname = $_SESSION['dname'];
?>
<!-- SUPERADMIN Session -->
<?php 
$dname = $_SESSION['dname'];
if (count($_POST) > 0) 
  {
      $result = mysqli_query($con, "SELECT * FROM admintb WHERE username='".$dname."'");
      $row = mysqli_fetch_array($result);
      if ($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"])
        {
            mysqli_query($con, "UPDATE admintb set password='" . $_POST["newPassword"] . "' WHERE username='".$dname."'");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
?>
<html lang="en">
  <head>
    <title>System Panel</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
      <div class="dropdown">
        <a href="#" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="color: black;" class="nav-link notification-appointment-toggle dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <i class="fa fa-bell"></i></a>
          <div class="dropdown-menu "aria-labelledby="dropdownMenuButton"> 
            <ul class="notification-appointment "></ul>
          </div>
      </div>
    </ul>
     <ul class="navbar-nav mr-auto">
      <div class="dropdown">
            <a href="#" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="color: black" class="nav-link dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-user"></i> 
              <?php 
                echo $dname;
              ?>
            </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">          
          <a href="#" class="dropdown-item "><i class="fa fa-bell"></i> Notification</a>
          <a href="#" class="dropdown-item"> Profile</a>
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
          <a class="dropdown-item" href="#add-superadmin" data-toggle="list"><i class="fa fa-user-plus"></i></i> Add Superadmin</a>
          <div class="dropdown-divider"></div>
          <a href="logout1" class="dropdown-item"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </ul>
  </div>
</nav>
<script>
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
<!-- Test Code -->

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
        $sql = "SELECT * FROM appointmenttb WHERE id = '$id'";
        $get = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($get);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $gender = $row['gender'];
        $email = $row['email'];
        $contact = $row['contact'];
        $doctor = $row['doctor'];
        $docFees = $row['docFees'];
        $doctorStatus = $row['doctorStatus'];
      ?>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 980px;margin-left: auto;">
      <div class="card">
        <div class="card-header text-center" style="background-color: skyblue;">
          <h1><i class="fa fa-user"></i> <?php echo $lname ?>, <?php echo $fname?></h1>
      </div>
      <div class="card-body">
        <form class="form-group" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Appointment Number:</label></div>
                  <div class="col-md-8"><u><?php echo "$aid"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Last Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$lname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>First Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$fname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Gender:</label></div>
                  <div class="col-md-8"><u><?php echo "$gender"; ?></u></div><br><br>
                  <div class="col-md-4"><label>E-mail:</label></div>
                  <div class="col-md-8"><u><?php echo "$email"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Contact:</label></div>
                  <div class="col-md-8"><u><?php echo "$contact"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Doctor:</label></div>
                  <div class="col-md-8"><u><?php echo "$doctor"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Fee:</label></div>
                  <div class="col-md-8"><u><?php echo "$docFees"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8"><u>
                    <?php
                    if(($row['userStatus']=='Decline') && ($row['doctorStatus']=='Pending'))  
                    {
                      echo "Cancelled by you";
                    }
                    if(($row['userStatus']=='Approve') && ($row['doctorStatus']=='Pending'))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']=='Approve') && ($row['doctorStatus']=='Decline'))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']=='Decline') && ($row['doctorStatus']=='Decline'))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']=='Approve') && ($row['doctorStatus']=='Approve'))  
                    {
                      echo "Approved";
                    }
                  ?>                 
                  </u></div><br><br>
          </div>
        </form>
        <?php
          echo "<a href=doctor-panel><button  class='btn btn-warning'>Back</button></a>";
        ?>

        

        <?php 
                if(($row['userStatus']=='Approve') && ($row['doctorStatus']=='Pending'))  
                { 
              ?>
            <td>
            <a href="doctor-panel?id=<?php echo $row['id']?>&approve=update" onClick="return confirm('Are you sure you want to approve this appointment?')" name="approve-submit" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-info">Approve</button>              
            </a>
          </td>
          <td>
            <?php
                }
            else
            {
              echo "";
            } 
            ?>
            <?php
              if (($row['userStatus']=='Approve') && ($row['doctorStatus']=='Pending')) 
              {
            ?>
            </td>
            <a href="doctor-panel?id=<?php echo $row['id']?>&decline=update" onClick="return confirm('Are you sure you want to decline this appointment?')" name="decline-submit" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-warning">Decline</button>              
            </a>
              </td>
              <?php
              }
              ?>
              <a href=doctor-panel-view-delete?id=<?php echo $id; ?>><button  class='btn btn-danger'>Delete</button></a>
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
            
  </body>
</html>