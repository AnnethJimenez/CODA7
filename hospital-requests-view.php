<!DOCTYPE html>
<?php 
include('db.php');
    $conn = mysqli_connect('localhost', 'root', '', 'hospitalms');
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($get);

if (isset($_GET['file_id'])) {
    $con = mysqli_connect('localhost', 'root', '', 'hospitalms');
    
    
    // fetch file to download from database
    $sql = "SELECT * FROM doctb WHERE id=$id";
    $get = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($get);
    $filepath = 'uploads/' . basename($row['filenames']);

    if (file_exists($filepath)) 
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        exit();
    }
}
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
    $status = $row['status'];
?>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 5%;">
    <div class="tab-content" id="nav-tabContent" style="width: 100%;margin-left: 25%;">
      <center><div class="tab-content" id="nav-tabContent" style="width: 100%;"></center>
      <div class="card">
        <div class="card-header text-center" style="background-color: skyblue;">
            <h1><i class="fa fa-hospital"></i> <?php echo $doctorname ?></h1>
        </div>
      <div class="card-body">      
        <form class="form-group center table-responsive" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Hospital Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$doctorname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Description:</label></div>
                  <div class="col-md-8"><?php echo "$descrip"; ?></div><br><br>
                  <div class="col-md-4"><label>Hospital Type:</label></div>
                  <div class="col-md-8"><?php echo "$htype"; ?></div><br><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><?php echo "$haddress"; ?></div><br><br>
                  <div class="col-md-4"><label>Username:</label></div>
                  <div class="col-md-8"><?php echo "$username"; ?></div><br><br>
                  <div class="col-md-4"><label>Service Type:</label></div>
                  <div class="col-md-8"><?php echo "$spec"; ?></div><br><br>
                  <div class="col-md-4"><label>Service Fee:</label></div>
                  <div class="col-md-8"><?php echo "$docFees"; ?></div><br><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8"><?php echo $status; ?></div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><?php echo "$dpassword";?></div><br><br>
                  <div class="col-md-4"><label>Attachment:</label></div>
                  <div class="col-md-8">

                    <?php echo $row['filenames']; ?>
                    <br>
                    <td><a class="btn btn-success" href="hospital-requests-view?id=<?php echo $id ?>&file_id">Download</a></td>
                  </div><br><br>
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
        
        <a href="admin-panel1?id=<?php echo $id;?>&updatedoc=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-info">Approve</button>              
            </a>
            <a href="admin-panel1?id=<?php echo $id;?>&canceldoc=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
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
  </body>
</html>