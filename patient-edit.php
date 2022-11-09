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
   if (isset($_POST['save'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $paddress = $_POST['paddress'];
    $sql ="SELECT * FROM patreg";
      $get = mysqli_query($con,$sql);
      if (mysqli_num_rows($get)!=0)
      {
      $sql="UPDATE patreg SET 
      fname='$fname',
      lname='$lname',
      gender='$gender', 
      contact='$contact',
      password='$password',
      cpassword='$cpassword',
      paddress='$paddress'
      WHERE pid = '$pid'"; 
        mysqli_query($con,$sql);
        header("Location:admin-panel1?status=2");
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
          <h1><i class="fa fa-user"></i> <?php echo $lname ?>, <?php echo $fname?></h1>
      </div>
      <div class="card-body">
        <form class="form-group" method="POST" enctype="multipart/form-data">
          <div class="row">
                  <div class="col-md-4"><label>Last Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="lname" value="<?php echo "$lname"; ?>"></div><br><br>
                  <div class="col-md-4"><label>First Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="fname" value="<?php echo "$fname"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Gender:</label></div>
                  <div class="col-md-8">
                    <div class="maxl">
                        <label class="radio inline"> 
                            <input type="radio" name="gender" value="Male">
                            <span> Male </span> 
                        </label>
                        <label class="radio inline"> 
                            <input type="radio" name="gender" value="Female">
                            <span>Female </span> 
                        </label>
                    </div></div><br><br>
                  <div class="col-md-4"><label>E-mail:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="email" value="<?php echo "$email"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Contact:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="contact" value="<?php echo "$contact"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="password" value="<?php echo "$password"; ?>"></div><br><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="paddress" value="<?php echo "$paddress"; ?>"></div><br><br>
                </div>
          <input type="submit" name="save" value="Update" class="btn btn-primary">&nbsp&nbsp&nbsp&nbsp
          <a href="patient-view?pid=<?php echo $pid; ?>" class="btn btn-warning">Back</a>
        </form>
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