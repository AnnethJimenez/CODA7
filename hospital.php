<!DOCTYPE html>
<!-- Pagination of Hospital -->
<!-- Hospital Registry -->
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
  $descrip=$_POST['descrip'];
  $htype=$_POST['htype'];
  $latitude = htmlspecialchars(stripslashes(trim($_POST['latitude'])));
  $longtitude = htmlspecialchars(stripslashes(trim($_POST['longtitude'])));
  $query="INSERT into doctb(doctorname,username,password,email,spec,docFees,haddress,descrip,htype,latitude,longtitude,rates)values('$doctorname','$doctor','$dpassword','$demail','$spec','$docFees','$haddress','$descrip','$htype','$latitude','$longtitude','0')";
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
    <title>System Panel</title>
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
        <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-file-invoice"></i> Hospital and Patient Logs</a>
      </div>
    <br>
  </div>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 980px;">
      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-full bg-white" >
          <div>
            <!-- Table -->
            <table id='hospital-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                    <th scope="col">Hospital ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Description</th>
                    <th scope="col">Service</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Service Fee</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#hospital-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'hospital-backend-search.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Hospital name','sSearch': '' 
                },
                'columns': [
                    { data: 'id' },
                    { data: 'username' },
                    { data: 'doctorname' },
                    { data: 'descrip' },
                    { data: 'spec' },
                    { data: 'email' },
                    { data: 'docFees' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="hospital-view?id=' + row.id + '">View</a>';                    
                        }
                        return data;
                     }
                    }

                ]

            });
        });
        </script>
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
  </div>
</form>
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
    <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">
      <div class="col-md-8">
        <form class="form-group" action="patientsearch.php" method="post">
          <div class="row">
          <div class="col-md-10"><input type="text" name="patient_contact" placeholder="Enter Contact" class = "form-control"></div>
          <div class="col-md-2"><input type="submit" name="patient_search_submit" class="btn btn-primary" value="Search"></div></div>
        </form>
      </div>   
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Gender</th>
                      <th scope="col">Address</th>
                      <th scope="col">Contact</th>
                      <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","hospitalms");
                    global $con;
                    $query = "select * from patreg";
                    $result = mysqli_query($con,$query);
                    $cnt=1;
                    while ($row = mysqli_fetch_array($result)){
                      $pid = $row['pid'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $gender = $row['gender'];
                      $paddress = $row['paddress'];
                      $contact = $row['contact'];
                      $email = $row['email'];
                      
                      echo "<tr>
                        <td>$cnt</td>
                        <td>$fname $lname</td>
                        <td>$gender</td>
                        <td>$paddress</td>
                        <td>$contact</td>
                        <td>$email</td>
                      </tr>";
                  $cnt++;  }

                  ?>
                </tbody>
              </table>
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
       <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>
        <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
         <div class="col-md-8">
          <form class="form-group" action="messearch.php" method="post">
            <div class="row">
            <div class="col-md-10"><input type="text" name="mes_contact" placeholder="Enter Contact" class = "form-control"></div>
            <div class="col-md-2"><input type="submit" name="mes_search_submit" class="btn btn-primary" value="Search"></div></div>
          </form>
        </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Message</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","hospitalms");
                    global $con;
                    $query = "select * from contact;";
                    $result = mysqli_query($con,$query);
                    $cnt=1;
                    while ($row = mysqli_fetch_array($result)){
              
                      #$fname = $row['fname'];
                      #$lname = $row['lname'];
                      #$email = $row['email'];
                      #$contact = $row['contact'];
                  ?>
                      <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['message'];?></td>
                      </tr>
                <?php $cnt++; } 
                ?>
              </tbody>
            </table>
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
          <!-- User Account -->
        <br>
      </div>
<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
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
                  <div class="col-md-8"><input type="password" class="form-control"  onkeyup='check();' name="dpassword" id="dpassword"  required></div>
                  <br><br>
                  <div class="col-md-4"><label>Confirm Password:</label></div>
                  <div class="col-md-8"  id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span id='message'></span> </div><br><br>                
                </div>
          <input type="submit" name="docsub" value="Add Hospital" class="btn btn-primary">
        </form>
      </div>
<!-- USER LOG -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
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