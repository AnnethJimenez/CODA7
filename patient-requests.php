<!DOCTYPE html>
<?php 
include('db.php');
if(isset($_GET['cancel']))
  {
    $query=mysqli_query($con,"update appointmenttb set adminStatus='0' where id = '".$_GET['id']."'");
    if($query)
    {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
  }
if(isset($_GET['update']))
  {
    $query2=mysqli_query($con,"update appointmenttb set adminStatus='1' where id = '".$_GET['id']."'");
    if($query2)
    {
      echo "<script>alert('Your appointment successfully update');</script>";
    }
  }
?>
<?php 
include('session.php');
include('design.php');
include('db.php');
include('newfunc.php');
if(isset($_POST['docsub']))
{
  $doctorname=$_POST['doctorname'];
  $doctor=$_POST['doctor'];
  $dpassword=$_POST['dpassword'];
  $demail=$_POST['demail'];
  $spec=$_POST['special'];
  $docFees=$_POST['docFees'];
  $haddress=$_POST['haddress'];
  $latitude = htmlspecialchars(stripslashes(trim($_POST['latitude'])));
  $longtitude = htmlspecialchars(stripslashes(trim($_POST['longtitude'])));
  $query="INSERT into doctb(doctorname,username,password,email,spec,docFees,haddress,descrip,htype,latitude,longtitude,rates)values('$doctorname','$doctor','$dpassword','$demail','$spec','$docFees','$haddress','$descrip','$htype','$latitude','$longtitude','0')";
  $result=mysqli_query($con,$query);
  if($result)
  {
    echo "<script>alert('Hospital added successfully!');</script>";
  }
}
  if(isset($_POST['docsub1']))
  {
    $demail=$_POST['demail'];
    $query="delete from doctb where email='$demail';";
    $result=mysqli_query($con,$query);
    if($result)
      {
        echo "<script>alert('Hospital removed successfully!');</script>";
    }
    else{
      echo "<script>alert('Unable to delete!');</script>";
    }
  }
?>
<!-- SUPERADMIN Session -->
<?php 
$username=$_SESSION["username"];
if (count($_POST) > 0) 
  {
      $result = mysqli_query($con, "SELECT * FROM admintb WHERE username=MD5('".$username."')");
      $row = mysqli_fetch_array($result);
      if ($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"])
        {
            mysqli_query($con, "UPDATE admintb set password='" . $_POST["newPassword"] . "' WHERE username=MD5('".$username."')");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
?>
<html lang="en">
  <head>
    <title>Patient Requests</title>
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
              $string = 'SUPERADMIN';  
              if (md5($string) =='545514976ad64ba23911d485536249c9'){  
                  echo "SUPERADMIN";  
              }  
            ?>
          </a>
      <!-- Upper right SUPERADMIN -->
        <div class="dropdown-menu dropdown-menu-end">
          <a href="#" class="dropdown-item"><i class="fa fa-bell"></i> Notification</a>
          <a href="#" class="dropdown-item"> Profile</a>
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
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
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> WELCOME ADMINISTRATOR </h3>
       <div class="row">
        <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
          <div class="list-group sidenav" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" id="list-dash-list"  href="admin-panel1"><i class="fa fa-bars"></i> Menu
            </a>
            <button class="list-group-item list-group-item-action dropdown-btn">Hospital <i class="fa fa-caret-down"></i></button>
              <div class="dropdown-container">
                <a class="list-group-item list-group-item-action" href="hospital"><i class="fa fa-hospital"></i> Hospitals</a>
                <a class="list-group-item list-group-item-action" href="hospital-requests"><i class="fa fa-file-import"></i> Hospital Requests</a>
                <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-plus"></i> Add Hospital</a>
              </div>
            <button class="list-group-item list-group-item-action dropdown-btn"><i class="fa fa-hospital-user"></i> Patient <i class="fa fa-caret-down"></i></button>
              <div class="dropdown-container">
                <a class="list-group-item list-group-item-action" href="patient"><i class="fa fa-hospital-user"></i> Patients</a>
                <a class="list-group-item list-group-item-action" href="patient-requests"><i class="fa fa-copy"></i> Patient Request</a>
              </div>
        <a class="list-group-item list-group-item-action" href="reviews"><i class="fa fa-file-pdf"></i> Reviews</a>
        <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-user"></i> User Account</a>
        <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-file-invoice"></i> Hospital and Patients Logs</a>
      </div>
    <br>
  </div>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 980px;">
      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-full bg-white" >
          <!-- Live Search -->
          <div class="form-group">
            <div class="row">
              <div class="patient-requests-search-box">
                <input type="text" placeholder="Enter E-mail, Username" class = "form-control">
                <div class="patient-requests-result"></div>
              </div>
            </div>
          </div>
         <!-- -->
         <!-- Script Live Search -->
        <script>
          $(document).ready(function(){
              $('.patient-requests-search-box input[type="text"]').on("keyup input", function(){
                  /* Get input value on change */
                  var inputVal = $(this).val();
                  var resultDropdown = $(this).siblings(".patient-requests-result");
                  if(inputVal.length){
                      $.get("patient-requests-search.php", {term: inputVal}).done(function(data){
                          // Display the returned data in browser
                          resultDropdown.html(data);
                      });
                  } else{
                      resultDropdown.empty();
                  }
              });
              
              // Set search input value on click of result item
              $(document).on("click", ".patient-requests-result", function(){
                  $(this).parents(".patient-requests-search-box").find('input[type="text"]').val($(this).text());
                  $(this).parent(".patient-requests-result").empty();
              });
          });
          </script>
          <!-- Script Live Search -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Username</th>
                    <th scope="col">Fees</th>
                    <th scope="col">Time</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Option</th>
                    <th scope="col"></th>

                  </tr>
                </thead>
                <tbody>
  <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $con=mysqli_connect("localhost","root","","hospitalms");
        global $con;
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM appointmenttb";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM appointmenttb LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($res_data))
        {
            echo "
            <tr>
            <td>{$row['id']}</td>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['email']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['doctor']}</td>
            <td>P{$row['docFees']}</td>
            <td>{$row['apptime']}</td>
            <td>{$row['appdate']}</td>
            <td>
            ";
            ?>
            <?php
                    if(($row['userStatus']==0) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                    {
                      echo "Cancelled by you";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==1))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==2))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==2))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==1))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==1))  
                    {
                      echo "Approved";
                    }
              ?> 
            </td>
            <td>
              <?php 
                if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                { 
              ?>
             <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
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
                if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==2))  
                { 
              ?>
             <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
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
              if (($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==1)) 
              {
            ?>
              <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
            </a>
              </td>
              <?php
              }
            else 
            {
              ?>
              <a href="patient-view-requests.php?id=<?php echo $row['id']?>"><button class="btn btn-success">View</button></a>  
              <?php

            }
              echo "</td>";
              echo "</tr>";
            } 
             ?>
            <?php             
              mysqli_close($con);
            ?>
            <?php 
            $con=mysqli_connect("localhost","root","","hospitalms");
            $sql = "SELECT * FROM appointmenttb WHERE id";
            $res_data = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($res_data))
            {
              if(isset($_GET['update']))
                {
                  $query1=mysqli_query($con,"INSERT INTO logs (Hospital,status,patientname,patientlastname) VALUES ('SUPERADMIN','1','".$row['fname']."','".$row['lname']."')");
                  if($query1)
                  {
                    echo "<script>alert('Your log has been inserted.');</script>";
                  }
                  else
                  {
                    
                  }
                }
              if(isset($_GET['cancel']))
                {
                  $query1=mysqli_query($con,"INSERT INTO logs (Hospital,status,patientname,patientlastname) VALUES ('SUPERADMIN','0','".$row['fname']."','".$row['lname']."')");
                  if($query1)
                  {
                    echo "<script>alert('Your log has been inserted.');</script>";
                  }
                  else
                  {
                    
                  }
                }
            }
            ?>
            <ul class="pagination">
                <li>
                  <a href="?pageno=1">|<< &nbsp </a>
                </li>
                  <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"> < &nbsp </a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"> > &nbsp </a>
                </li>
                <li>
                  <a href="?pageno=<?php echo $total_pages; ?>"> >>| </a>
                </li>
            </ul>
            </tbody>
          </table>
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
      </div>
<!-- Add Hospital -->
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="admin-panel1.php">
          <div class="row">
                  <div class="col-md-4"><label>Hospital Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="doctorname" required></div><br><br>
                  <div class="col-md-4"><label>Description:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="descrip" required></div><br><br>
                  <div class="col-md-4"><label>Hospital Type:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="htype" required></div><br><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="haddress" required></div><br><br>
                  <div class="col-md-4"><label>Username:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="doctor" required></div><br><br>
                  <div class="col-md-4"><label>Service Type:</label></div>
                  <div class="col-md-8">
                   <select name="special" class="form-control" id="special" required="required">
                      <option value="head" name="spec" disabled selected>Select Service</option>
                      <option value="RT-PCR (Nasal)" name="spec">RT-PCR (Nasal)</option>
                      <option value="Antibody Test (Blood)" name="spec">Antibody Test (Blood)</option>
                      <option value="RTK-Ag Test (Nasal)">RTK-Ag Test (Nasal)</option>
                      <option value="Vaccine (Astra)" name="spec">Vaccine (Astra)</option>
                      <option value="Vaccine (Moderna)">Vaccine (Moderna)</option>
                      <option value="Vaccine (Pfizer)" name="spec">Vaccine (Pfizer)</option>
                      <option value="Vaccine (Sinovac)" name="spec">Vaccine (Sinovac)</option>
                    </select>
                    </div><br><br>
                  <div class="col-md-4"><label>Service Fee:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="docFees" required></div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="demail" required></div><br><br>
                  <div class="col-md-4"><label>Latitude:</label></div>
                  <div class="col-md-8"><input type="text"  class="form-control" name="latitude" required></div><br><br>
                  <div class="col-md-4"><label>Longtitude:</label></div>
                  <div class="col-md-8"><input type="text"  class="form-control" name="longtitude" required></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="password" class="form-control"  onkeyup='check();' name="dpassword" id="dpassword"  required></div><br><br>
                  <div class="col-md-4"><label>Confirm Password:</label></div>
                  <div class="col-md-8"  id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span id='message'></span> </div><br><br>
                </div>
          <input type="submit" name="docsub" value="Add Hospital" class="btn btn-primary">
        </form>
      </div>
          <!-- USER LOG -->
 <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
          <!-- Live Search -->
          <div class="form-group">
            <div class="row">
              <div class="hospital-and-patient-box">
                <input type="text" placeholder="Enter E-mail, Username" class = "form-control">
                <div class="hospital-and-patient-result"></div>
              </div>
            </div>
          </div>
         <!-- -->
         <!-- Script Live Search -->
        <script>
          $(document).ready(function(){
              $('.hospital-and-patient-box input[type="text"]').on("keyup input", function(){
                  /* Get input value on change */
                  var inputVal = $(this).val();
                  var resultDropdown = $(this).siblings(".hospital-and-patient-result");
                  if(inputVal.length){
                      $.get("hospital-and-patient-log-backend-search.php", {term: inputVal}).done(function(data){
                          // Display the returned data in browser
                          resultDropdown.html(data);
                      });
                  } else{
                      resultDropdown.empty();
                  }
              });
              
              // Set search input value on click of result item
              $(document).on("click", ".hospital-and-patient-result", function(){
                  $(this).parents(".hospital-and-patient-box").find('input[type="text"]').val($(this).text());
                  $(this).parent(".hospital-and-patient-result").empty();
              });
          });
          </script>
          <!-- Script Live Search -->   
              <table class="table table-hover">
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","hospitalms");
                    global $con;
                    $query = "SELECT * FROM logs ORDER BY id DESC;";
                    $result = mysqli_query($con,$query);
                    $cnt=1;
                    while ($row = mysqli_fetch_array($result)){
                  ?>
                      <tr>
                        <td><?php echo $row['Hospital'];?></td>
                        <td>
                          <?php
                            if(($row['status']==1))  
                            {
                              echo "The {$row['Hospital']} has approved the request of patient {$row['patientname']} {$row['patientlastname']}.";
                            }
                            if(($row['status']==0))  
                            {
                              echo "The {$row['Hospital']} has declined the request of patient {$row['patientname']} {$row['patientlastname']}.";
                            }
                            if(($row['status']==2))  
                            {
                              echo "Patient ({$row['patientname']} {$row['patientlastname']}) has requested an appointment.";
                            }
                          ?>
                        </td>
                        <td><?php echo $row['timestamp'];?></td>
                      </tr>
                    <?php $cnt++; } ?>
                </tbody>
              </table>
            <br>
          </div>
<!-- USER LOG -->
<!-- User Account -->
      <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">
       <div>
            <!-- Table -->
            <table id='patient-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#patient-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'patient-backend-search.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Enter Last Name, E-mail, Contact','sSearch': '' 
                },
                'columns': [
                    { data: 'pid' },
                    { data: 'fname' },
                    { data: 'lname' },
                    { data: 'gender' },
                    { data: 'contact' },
                    { data: 'email' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="patient-view?pid=' + row.pid + '">View</a>';                    
                        }
                        return data;
                     }
                    }
                ]

            });
        });
        </script>
      </div>
          <!-- User Account -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
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
  </body>
</html>