<!DOCTYPE html>
<?php 
include('session-patient.php');  
include('newfunc.php');
include('design-patient.php');
$con=mysqli_connect("localhost","root","","hospitalms");


  $pid = $_SESSION['pid'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $gender = $_SESSION['gender'];
  $lname = $_SESSION['lname'];
  $contact = $_SESSION['contact'];


if(isset($_POST['app-submit']))
{
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $contact = $_SESSION['contact'];
  $doctor=$_POST['doctor'];
  $email=$_SESSION['email'];
  # $fees=$_POST['fees'];
  $docFees=$_POST['docFees'];
  $aid=rand(100,10000);
  $appdate=$_POST['appdate'];
  $apptime=$_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s");
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);
  
  if(date("Y-m-d",$appdate1)>=$cur_date){
    if((date("Y-m-d",$appdate1)==$cur_date and date("H:i:s",$apptime1)>$cur_time) or date("Y-m-d",$appdate1)>$cur_date) {
      $check_query = mysqli_query($con,"select apptime from appointmenttb where doctor='$doctor' and appdate='$appdate' and apptime='$apptime'");
        if(mysqli_num_rows($check_query)==0){
          $query=mysqli_query($con,"insert into appointmenttb(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus,aid,notif) values($pid,'$fname','$lname','$gender','$email','$contact','$doctor','$docFees','$appdate','$apptime','Approve','Pending','$aid','0')");

          if($query)
          {
            echo "";
          }
          else{
            echo "<script>alert('Unable to process your request. Please try again!');</script>";
          }
      }
      else{
        echo "<script>alert('We are sorry to inform that the doctor is not available in this time or date. Please choose different time or date!');</script>";
      }
    }
    else{
      echo "<script>alert('Select a time or date in the future!');</script>";
    }
  }
  else{
      echo "<script>alert('Select a time or date in the future!');</script>";
  }
}
?>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointmenttb where id='$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    if(isset($_GET['cancel']))
      {
        $query=mysqli_query($con,"UPDATE appointmenttb set userStatus='Decline', doctorStatus='Decline' where id = '".$_GET['id']."'");
        if($query)
        {
          echo "<script>alert('Your appointment successfully cancelled');</script>";
        }
      }
?>
<?php 
$con=mysqli_connect("localhost","root","","hospitalms");
if(isset($_POST['app-submit']))
  {
    $query1=mysqli_query($con,"INSERT INTO logs (pid,Hospital,status,patientname,patientlastname,aid) VALUES ('$pid','$doctor','Pending','$fname','$lname','$aid')");
    if($query1)
    {
      echo "<script>alert('Your log has been inserted.');</script>";
    }
  }  
?>
<?php 
$email = $_SESSION["email"];
if (isset($_POST['submitPassword'])) 
  {
      $result = mysqli_query($con, "SELECT * FROM patreg WHERE email='".$email."'");
      $row = mysqli_fetch_array($result);
      if ($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $_POST["confirmPassword"])
        {
            mysqli_query($con, "UPDATE patreg set password='" . $_POST["newPassword"] . "', cpassword='" . $_POST["newPassword"] . "' WHERE email='".$email."'");
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
  }
?>
<html lang="en">
  <head>
    <title><?php echo $lname ?>, <?php echo $fname ?>'s Panel <?php echo $pid;?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="admin-panel"><img src="logo.png" style="width: 37px" alt=""/></i> CODA DEFENSE SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="admin-panel"></a>
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
                echo $fname;
              ?>
            </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">          
          <a href="#" class="dropdown-item"> Profile</a>
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
          <div class="dropdown-divider"></div>
          <a href="logout" class="dropdown-item"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </ul>
    </div>
  </nav>
    <script>
  //Notification
  $(document).ready(function(){
  // updating the view with notifications using ajax
  function load_unseen_notification(view = '')
  {
   $.ajax({
    url:"patient-appointment-fetch.php",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
     $('.notification-appointment').html(data.notification);
     if(data.unseen_notification > 0)
     {
      $('.count').html(data.unseen_notification);
     }
    }
   });
  }
  load_unseen_notification();
  $(document).on('click', '.notification-appointment-toggle', function(){
   $('.count').html('');
   load_unseen_notification('yes');
  });
  setInterval(function(){
   load_unseen_notification();;
  }, 5000);
  });
</script>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
  
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $lname ?>, <?php echo $fname ?> 
   </h3>
    <div class="row">
  <div class="col-md-4" style="max-width:25%; margin-top: 3%">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
            <a class="list-group-item list-group-item-action" href="#hospital-list" id="hospitals-lists"  role="tab" aria-controls="home" data-toggle="list">View Hospitals</a>
      <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Book Appointment</a>
      <a class="list-group-item list-group-item-action" href="#list-cpassword" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Change Password</a>
      

      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">


      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="home-content">
      <div class="overview-boxes">
      </div>

       <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h4><i class="fa fa-clock"></i> Appointment History</h4>
              </div>
            <div class="card-body">
            <table id='appointment-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                   <td>Appointment Number</td>
                   <td>Name</td>
                   <td>Hospital</td>
                   <td>Fee</td>
                   <td>Status</td>
                   <td>Time and Date</td>
                   <td></td>
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function()
        {
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#appointment-table').DataTable(
            {
                'scrollY': true,
                'scrollX': true,
                'dom': 'rtip',
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'lengthMenu': [5],
                'ajax': {
                    'url':'patient-appointment-history.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Hospital name','sSearch': '' 
                },
                'columns': [
                    { data: 'aid' },
                    { data: 'fname',
                        render: function ( data, type, row ) {
                            return row.lname + ', ' + row.fname + '';
                        }
                    },
                    { data: 'doctor' },
                    { data: 'docFees' },
                    { data: 'doctorStatus' },
                    { data: 'timestamp' },
                    { 
                      data: null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="admin-panel-view?id=' + row.id + '">View</a>';                    
                        }
                        return data;
                     }
                    }
                ]
            }
            );
        });
        </script>
        </div>
      </div>
    </div>
  </div>
        <div class="top-sales box">
          <div class="card-header text-center" style="background-color: skyblue;">
                  <h6>Top Rated Hospitals</h6>
              </div>
          <table id='top5ratedhospital' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>

                   <td>Rates</td>
                   <td>Hospitals</td>
                </tr>
                </thead>                
            </table>
            <script>
        $(document).ready(function()
        {
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#top5ratedhospital').DataTable(
            {

                
                'dom': 'ttip',
                
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'lengthMenu': [5],
                'ajax': {
                    'url':'top5ratedhospital.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Hospital name','sSearch': '' 
                },
                'columns': [
                    { data: 'rates' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a style="color:black;" href="hospital-view-patient?id=' + row.id + '">'+row.doctorname+'</a>';                    
                        }
                        return data;
                     }
                    },
                    
                ]
            }
            );
        });
        </script>
        </div>
      </div>
    </div>
      </div>
      <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-book"></i> Book Appointment</h1>
              </div>
            <div class="card-body">
              <form class="form-group" method="post" action="admin-panel.php" id="appointment-notification">
                <div class="row">                 
                    <div class="col-md-4">
                          <label for="spec">Service:</label>
                        </div>
                        <div class="col-md-8">
                          <select name="spec" class="form-control" id="spec">
                              <option value="" disabled selected>Select Service</option>
                              <?php 
                              display_specs();
                              ?>
                          </select>
                        </div>
                        <br><br>
                  <script>
                      document.getElementById('spec').onchange = function foo() {
                        let spec = this.value;   
                        console.log(spec)
                        let docs = [...document.getElementById('doctor').options];                       
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != spec ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };
                  </script>
              <div class="col-md-4"><label for="doctor">Hospitals:</label></div>
                <div class="col-md-8">
                    <select name="doctor" class="form-control" id="doctor" required="required">
                      <option value="" disabled selected>Select Hospitals</option>                
                      <?php display_docs(); ?>
                    </select>
                  </div><br/><br/> 


                        <script>
                          document.getElementById('doctor').onchange = function updateFees(e) {
                            var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                            document.getElementById('docFees').value = selection;
                          };
                        </script>
                              <div class="col-md-4"><label for="consultancyfees">
                                Service Fee
                              </label></div>
                              <div class="col-md-8">
                              <!-- <div id="docFees">Select a doctor</div> -->
                              <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly"/>
                  </div><br><br>

                  <div class="col-md-4"><label>Appointment Date</label></div>
                  <div class="col-md-8"><input type="date" class="form-control datepicker" name="appdate"></div><br><br>

                  <div class="col-md-4"><label>Appointment Time</label></div>
                  <div class="col-md-8">
                    <!-- <input type="time" class="form-control" name="apptime"> -->
                    <select name="apptime" class="form-control" id="apptime" required="required">
                      <option value="" disabled selected>Select your desired hospital.</option>
                      <?php display_timesched(); ?>
                    </select>
                  <script>
                      document.getElementById('apptime').onchange = function wew() {
                        let apptime = this.value;   
                        console.log(apptime)
                        let docs = [...document.getElementById('doctor').options];                       
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("value") != apptime ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };
                  </script>
                  </div><br><br>

                  <div class="col-md-4">
                    <center><input type="submit" name="app-submit" value="Book" class="btn btn-primary" id="inputbtn"></center>
                  </div>
                  <div class="col-md-8"></div>                  
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>
       <!-- Appointment History 
      <div class="tab-pane fade" id="appointment-history" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-clock"></i> Appointment History</h1>
              </div>
            <div class="card-body">
            <table id='appointment-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                   <td>Appointment Number</td>
                   <td>Name</td>
                   <td>Hospital</td>
                   <td>Fee</td>
                   <td>Status</td>
                   <td></td>
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function()
        {
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#appointment-table').DataTable(
            {
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'patient-appointment-history.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Hospital name','sSearch': '' 
                },
                'columns': [
                    { data: 'aid' },
                    { data: 'fname',
                        render: function ( data, type, row ) {
                            return row.lname + ', ' + row.fname + '';
                        }
                    },
                    { data: 'doctor' },
                    { data: 'docFees' },
                    { data: 'doctorStatus' },
                    { 
                      data: null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="admin-panel-view?id=' + row.id + '">View</a>';                    
                        }
                        return data;
                     }
                    }

                ]
            }
            );
        });
        </script>
        </div>
      </div>
    </div>
  </div> -->
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
                  document.getElementById("confirmPassword").innerHTML = "New password are not same.";
                  output = false;
                }   
                return output;
                }
              </script>
              <!-- end of script -->
      <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <center><h4>Book Appointment</h4></center><br>
              <form class="form-group" method="post" action="admin-panel.php">
                <div class="row">
                    <div class="col-md-4">
                          <label for="spec">Service:</label>
                        </div>
                        <div class="col-md-8">
                          <select name="spec" class="form-control" id="spec">
                              <option value="" disabled selected>Select Service</option>
                              <?php 
                              display_specs();
                              ?>
                          </select>
                        </div>

                        <br><br>

                        <script>
                      document.getElementById('spec').onchange = function foo() {
                        let spec = this.value;   
                        console.log(spec)
                        let docs = [...document.getElementById('doctor').options];
                        
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != spec ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };
                  </script>
              <div class="col-md-4"><label for="doctor">Hospitals:</label></div>
                <div class="col-md-8">
                    <select name="doctor" class="form-control" id="doctor" required="required">
                      <option value="" disabled selected>Select Hospitals</option>               
                      <?php display_docs(); ?>
                    </select>
                    <script>
                      document.getElementById('apptime').onchange = function wew() {
                        let apptime = this.value;   
                        console.log(apptime)
                        let docs = [...document.getElementById('doctor').options];                       
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != apptime ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };
                  </script>
                  </div><br/><br/> 
                    <script>
                      document.getElementById('doctor').onchange = function updateFees(e)
                      {
                        var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                        document.getElementById('docFees').value = selection;
                      };
                    </script>
                  <div class="col-md-4">
                    <label for="consultancyfees">
                      Service Fee
                    </label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly"/>
                  </div><br><br>
                  <div class="col-md-4"><label>Appointment Date</label></div>
                  <div class="col-md-8"><input type="date" class="form-control datepicker" name="appdate"></div><br><br>

                  <div class="col-md-4"><label>Appointment Time</label></div>
                  <div class="col-md-8">
                    <!-- <input type="time" class="form-control" name="apptime"> -->
                    <select name="apptime" class="form-control" id="apptime" required="required">
                      <option value="" disabled selected>Select Time</option>
                      <option value="08:00:00">8:00 AM</option>
                      <option value="10:00:00">10:00 AM</option>
                      <option value="12:00:00">12:00 PM</option>
                      <option value="14:00:00">2:00 PM</option>
                      <option value="16:00:00">4:00 PM</option>
                    </select>

                  </div><br><br>

                  <div class="col-md-4">
                    <center><input type="submit" name="app-submit" value="Book" class="btn btn-primary" id="inputbtn"></center>
                  </div>
                  <div class="col-md-8"></div>                  
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>    
 <!-- Hospital List -->
      <div class="tab-pane fade " id="hospital-list" role="tabpanel" aria-labelledby="list-pat-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-hospital"></i> Hospitals</h1>
              </div>
            <div class="card-body">
              <table id='patient-table' class='display dataTable table table-hover' style="width: 100%;">
                  <thead>
                  <tr>
                      <th scope="col">Hospital ID</th>
                      <th scope="col">Hospital</th>
                      <th scope="col">username</th>
                      <th scope="col">Description</th>
                      <th scope="col">Service</th>
                      <th scope="col">Fee</th>
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
                'scrollY': true,
                'scrollX': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'patient-hospital-backend-search.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Enter Last Name, E-mail, Contact','sSearch': '' 
                },
                'columns': [
                    { data: 'id' },
                    { data: 'doctorname' },
                    { data: 'username' },
                    { data: 'descrip' },
                    { data: 'spec' },
                    { data: 'docFees' },
                    { data: 'email' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="hospital-view-patient?id=' + row.id + '">View</a>';                    
                        }
                        return data;
                     }
                    },
                ]

            });
        });
        </script>
        </div>
      </div>
    </div>
  </div>
       <!-- Change Password -->
      <div class="tab-pane fade" id="list-cpassword" role="tabpanel" aria-labelledby="list-cpassword-list">
        <div class="col-md-8" style="margin-left:25%;">
          <div class="row">
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-unlock"></i> Change Password</h1>
              </div>
            <div class="card-body">
            <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
              <div style="width:100%;">
                <div class="message">
                  <?php if(isset($message)) { echo $message; } ?>
                </div>
                <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                  <tr>
                    <td width="40%"><label>Current Password:</label></td>
                    <td width="60%"><input type="password" name="currentPassword" class="form-control"/><span id="currentPassword"  class="required"></span></td>
                  </tr>
                  <tr>
                  <td>
                    <label>New Password:</label>
                  </td>
                  <td>
                    <input type="password" name="newPassword" class="form-control"/><span id="newPassword" class="required"></span>
                  </td>
                  </tr>
                  <td>
                    <label>Confirm Password:</label>
                  </td>
                  <td>
                    <input type="password" name="confirmPassword" class="form-control"/><span id="confirmPassword" class="required"></span>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="2">
                    <input type="submit" name="submitPassword" value="Change Password" class="btnSubmit btn btn-info">
                  </td>
                </tr>
              </table>
            </div>
          </form>
        </div> 
      </form>
    </div>
  </div>
</div>
  </body>
</html>
