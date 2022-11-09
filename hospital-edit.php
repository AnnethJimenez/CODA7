<!DOCTYPE html>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $husername = $row['username'];
    $password = $row['password'];
    $doctorname = $row['doctorname'];
    $email = $row['email'];
    $spec = $row['spec'];
    $docFees = $row['docFees'];
    $haddress = $row['haddress'];
    $descrip = $row['descrip'];
    $htype = $row['htype'];
    $longtitude = $row['longtitude'];
    $latitude = $row['latitude'];
   if (isset($_POST['save'])) {
    $husername = $_POST['husername'];
    $password = $_POST['password'];
    $doctorname = $_POST['doctorname'];
    $email = $_POST['email'];
    $spec = $_POST['spec'];
    $docFees = $_POST['docFees'];
    $haddress = $_POST['haddress'];
    $descrip = $_POST['descrip'];
    $htype = $_POST['htype'];
    $latitude = htmlspecialchars(stripslashes(trim($_POST['latitude'])));
    $longtitude = htmlspecialchars(stripslashes(trim($_POST['longtitude'])));
    $sql ="SELECT * FROM doctb";
      $get = mysqli_query($con,$sql);
      if (mysqli_num_rows($get)!=0)
      {
      $sql="UPDATE doctb SET 
      username='$husername',
      password='$password',
      doctorname='$doctorname', 
      email='$email',
      spec='$spec',
      docFees='$docFees',
      haddress='$haddress',
      descrip='$descrip',
      htype='$htype',
      longtitude='$longtitude',
      latitude='$latitude' 
      WHERE id = '$id'"; 
        mysqli_query($con,$sql);
        header("Location:admin-panel1");
    }
  else
    {
      echo "Error";
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
      $id = $_SESSION['id'];
      $email = $_SESSION['email'];
      $name = $_SESSION['name'];
      $username = $_SESSION['username'];
?>
<?php 
include 'admin-header.php';
?>
  <body style="padding-top:50px;">
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 100%;margin-left: 25%;">
      <div class="card">
      <div class="card-header text-center" style="background-color: skyblue;">
          <h1><i class="fa fa-hospital"></i> <?php echo $doctorname ?></h1>
      </div>
      <div class="card-body">
        <form class="form-group" method="POST" enctype="multipart/form-data">
          <div class="row">
                  <div class="col-md-4"><label>Hospital Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="doctorname" value="<?php echo "$doctorname"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Description:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="descrip" value="<?php echo "$descrip"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Hospital Type:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="htype" value="<?php echo "$htype"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="haddress" value="<?php echo "$haddress"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Username:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="husername" value="<?php echo "$husername"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Service Type:</label></div>
                  <div class="col-md-8">
                   <select name="spec" class="form-control" id="special">
                      <option value="<?php echo "$spec"; ?>" name="spec" selected><?php echo "$spec"; ?></option>
                      <option value="RT-PCR (Nasal)" name="spec">RT-PCR (Nasal)</option>
                      <option value="Antibody Test (Blood)" name="spec">Antibody Test (Blood)</option>
                      <option value="RTK-Ag Test (Nasal)" name="spec">RTK-Ag Test (Nasal)</option>
                      <option value="Vaccine (Astra)" name="spec">Vaccine (Astra)</option>
                      <option value="Vaccine (Moderna)" name="spec">Vaccine (Moderna)</option>
                      <option value="Vaccine (Pfizer)" name="spec">Vaccine (Pfizer)</option>
                      <option value="Vaccine (Sinovac)" name="spec">Vaccine (Sinovac)</option>
                    </select>
                    </div><br><br>
                  <div class="col-md-4"><label>Service Fee:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="docFees"  value="<?php echo "$docFees"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="email" value="<?php echo "$email"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Latitude:</label></div>
                  <div class="col-md-8"><input type="latitude"  class="form-control" name="latitude" value="<?php echo "$latitude"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Longitude:</label></div>
                  <div class="col-md-8"><input type="longtitude"  class="form-control" name="longtitude" value="<?php echo "$longtitude"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="password" class="form-control"  onkeyup='check();' name="password" id="dpassword" value="<?php echo "$password";?>"></div><br><br>
                  <div class="col-md-4"><label>Confirm Password:</label></div>
                  <div class="col-md-8"  id='cpass'><input type="password" class="form-control" onkeyup='check();' name="password" id="cdpassword" value="<?php echo "$password";?>">&nbsp &nbsp<span id='message'></span> </div><br><br>
                </div>
          <input type="submit" name="save" value="Update" class="btn btn-primary">
          
        </form>
        <?php
            echo "<a href = admin-panel1><button  class='btn btn-success'>Back</button></a>";
          ?>
      </div>
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
        <br>
      </div>

  </body>
</html>