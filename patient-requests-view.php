<!DOCTYPE html>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM patreg WHERE pid = '$pid'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $gender = $row['gender'];
    $email = $row['email'];
    $contact = $row['contact'];
    $password = $row['password'];
    $cpassword = $row['cpassword'];
    $paddress = $row['paddress'];
    $status = $row['status'];
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
            mysqli_query($con, "UPDATE admintb set password='" . $_POST["newPassword"] . "' WHERE username='".$username."'");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
?>
<?php 
include 'admin-header.php';
?>
  <body style="padding-top:50px;">
      <?php
        $con = mysqli_connect("localhost","root","","hospitalms");
        $pid = $_GET['pid'];
        $sql = "SELECT * FROM patreg WHERE pid = '$pid'";
        $get = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($get);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $gender = $row['gender'];
        $email = $row['email'];
        $contact = $row['contact'];
        $password = $row['password'];
        $cpassword = $row['cpassword'];
        $paddress = $row['paddress'];
        $status = $row['status'];
      ?>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 100%;margin-left: 15%;">
      <div class="card">
        <div class="card-header text-center" style="background-color: skyblue;">
            <h1><i class="fa fa-user"></i> <?php echo $lname ?>, <?php echo $fname ?></h1>
        </div>
        <div class="card-body">
        <form class="form-group center table-responsive" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Last Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$lname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>First Name:</label></div>
                  <div class="col-md-8"><?php echo "$fname"; ?></div><br><br>
                  <div class="col-md-4"><label>Gender:</label></div>
                  <div class="col-md-8"><?php echo "$gender"; ?></div><br><br>
                  <div class="col-md-4"><label>Contact:</label></div>
                  <div class="col-md-8"><?php echo "$contact"; ?></div><br><br>
                  <div class="col-md-4"><label>E-mail:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div><br><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><?php echo "$paddress"; ?></div><br><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8"><?php echo "$status"; ?></div><br><br>
                  <div class="col-md-8"></div>
          </div>
        </form>
         <a href="admin-panel1?pid=<?php echo $pid;?>&updatee=update" 
              onClick="return confirm('Are you sure you want to approve this request?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-info">Approve</button>              
            </a>
            <a href="admin-panel1?pid=<?php echo $pid;?>&cancell=update" 
              onClick="return confirm('Are you sure you want to decline this request?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Decline</button>              
            </a>
            <a href="admin-panel1"><button class="btn btn-primary">Back</button></a>
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
  </body>
</html>