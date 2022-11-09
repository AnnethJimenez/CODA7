<!DOCTYPE html>
<?php 
include('db.php');
if(isset($_GET['canceldoc']))
  {
    $query=mysqli_query($con,"UPDATE doctb set status = 'Declined' where id = '".$_GET['id']."'");
    if($query)
    {
      echo "<script>alert('You declined hospital requests.');</script>";
    }
  }
if(isset($_GET['updatedoc']))
  {
    $query5=mysqli_query($con,"UPDATE doctb set status = 'Approved' where id = '".$_GET['id']."'");
    if($query5)
    {
      echo "<script>alert('You approved hospital requests.');</script>";
    }
  }
if(isset($_GET['cancell']))
  {
    $query3=mysqli_query($con,"UPDATE patreg set status = 'Declined' where pid = '".$_GET['pid']."'");
    if($query3)
    {
      echo "<script>alert('You declined patient's request.);</script>";
    }
  }
if(isset($_GET['updatee']))
  {
    $query2=mysqli_query($con,"UPDATE patreg set status = 'Approved' where pid = '".$_GET['pid']."'");
    if($query2)
    {
      echo "<script>alert('You approved patient's request.);</script>";
    }
  }
?>
<?php
  if (isset($_GET['pageno'])) {
      $pageno = $_GET['pageno'];
  } else {
      $pageno = 1;
  }
  $no_of_records_per_page = 1;
  $offset = ($pageno-1) * $no_of_records_per_page;

  $conn=mysqli_connect("localhost","root","","hospitalms");
  // Check connection
  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      die();
  }

    $total_pages_sql = "SELECT COUNT(*) FROM doctb";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $sql = "SELECT * FROM doctb LIMIT $offset, $no_of_records_per_page";
    $res_data = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($res_data)){
  }
  mysqli_close($conn);
?>
<!-- Hospital Registry -->
<?php 
include('session.php');
include('db.php');
include('design.php');
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
if (isset($_POST['submitPassword'])) 
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


  <!-- Side Navigation -->
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:55px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> WELCOME, <?php echo strtoupper($name); ?>! </h3>
      <div class="row">
        <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
          <div class="list-group sidenav" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" id="list-dash-list"  href="#list-dash" role="tab" data-toggle="list"><i class='bx bx-grid-alt' ></i> Dashboard
            </a>
            <a class="list-group-item list-group-item-action" href="#hospital" role="tab" data-toggle="list" id="hospitals-list"><i class="fa fa-hospital"></i> Hospitals</a>
            <a class="list-group-item list-group-item-action" href="#hospital-requests" role="tab" id="hospital-requests-list" data-toggle="list"><i class="fa fa-file-import"></i> Hospital Requests</a>
            <a class="list-group-item list-group-item-action" href="#patient" role="tab" data-toggle="list" id="patients-list"><i class="fa fa-hospital-user"></i> Patients</a>
        <a class="list-group-item list-group-item-action" href="#reviews" role="tab" data-toggle="list"><i class="fa fa-file-pdf"></i> Reviews</a>
        <a class="list-group-item list-group-item-action" href="#user-accounts" id="list-app-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-user"></i> User Account</a>
        <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-settings1-list"  role="tab" data-toggle="list" aria-controls="home"><i class="fa fa-file-invoice"></i> Hospitals and Patients Logs</a>
      </div>
    <br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">

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

<script>
  //Notification
  $(document).ready(function(){
  // updating the view with notifications using ajax
  function load_unseen_notification(view = '')
  {
   $.ajax({
    url:"appointment-fetch.php",
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
<script>
  function clickDiv(id) {
    document.querySelector(id).click();
  }
</script> 
    <!-- End Test Code -->
    <!-- Menu Dashboard -->
    <div class="tab-content" id="nav-tabContent" style="width: 100%;">
      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Hospital</div>
            <div class="number">
            <?php 
              $sql = "SELECT * FROM doctb";
              if ($result=mysqli_query($con,$sql)) {
                  $rowcount=mysqli_num_rows($result);
              }
              echo $rowcount; 
            ?>
            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#hospital" class="list-group-item-action" onclick="clickDiv('#hospitals-list')">View Hospitals</a>
            </div>
          </div>
          <h1><i class='bx bx-plus-medical'></i></h1>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Patient</div>
            <div class="number">
              <?php 
                $sql = "SELECT * FROM patreg";
                if ($result=mysqli_query($con,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                }
                echo $rowcount; 
              ?>
            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#patient" class="list-group-item-action" onclick="clickDiv('#patients-list') ">View Patients</a>
            </div>
          </div>
          <h1><i class='bx bx-user-circle'></i></h1>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Hospital and Patient logs</div>
            <div class="number">
              <?php 
                $sql = "SELECT * FROM logs";
                if ($result=mysqli_query($con,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                }
                echo $rowcount; 
              ?>
            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#list-settings1"  class="list-group-item-action" onclick="clickDiv('#list-settings1-list')">Logs</a>
            </div>
          </div>
          <h1><i class="fa fa-clock"></i></h1>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">User Accounts</div>
            <div class="number">
              <?php 
                $sql = "SELECT * FROM admintb";
                if ($result=mysqli_query($con,$sql)) {
                    $rowcount=mysqli_num_rows($result);
                }
                echo $rowcount; 
              ?>
            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#patient" class="list-group-item-action" onclick="clickDiv('#list-app-list') ">Users</a>
            </div>
          </div>
          <h1><i class="fa fa-users"></i></h1>
        </div>
      </div>

       <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: lightblue;">
                  <h1>Patient Request</h1>
              </div>
            <div class="card-body">
            <table id='patient-requests-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                   
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#patient-requests-table').DataTable({
                'scrollY': true,
                'scrollX': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'patient-requests-search.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Patient Name','sSearch': '' 
                },
                'lengthMenu': [5],
                'columns': [
                    { data: 'lname' },
                    { data: 'fname' },
                    { data: 'gender' },
                    { data: 'contact' },
                    { data: 'email' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="patient-requests-view?pid=' + row.pid + '">View</a>';                    
                        }
                        return data;
                     }
                    },
                    { data: 'status' }
                ]

            });
        });
        </script>
        </div>
      </div>
    </div>
        </div>
        <div class="top-sales box">
            <h5 class="dropdown-header">Notification</h5>
            <ul class="notification-appointment "></ul>
            <div class="dropdown-divider"></div>
            <center><a class="dropdown-item" href="#">See all notification</a></center>
        </div>
      </div>
    </div>
  </div>
<!-- rviews -->
<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="list-settings1-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-clock"></i> Reviews</h1>
              </div>
            <div class="card-body">
              <table id='reviews-table' class='display dataTable table table-hover' style="width: 100%;">
                  <thead>
                  <tr>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>Subject</td>
                    <td>Message</td>
                    <td>Rates</td>
                    <td>Hospital</td>
                  </tr>
                  </thead>                
              </table>
            </div>
        <script>
        $(document).ready(function(){
                  $.fn.DataTable.ext.classes.sFilterInput = "form-control";
                    $('#reviews-table').DataTable({
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                        'ajax': {
                            'url':'reviews-superadmin.php',                    
                        },
                        'language':{ 
                          'searchPlaceholder': 'Subject, Hospital','sSearch': '' 
                        },
                        'columns': [
                            { data: 'fname' },
                            { data: 'lname' },
                            { data: 'subject' },
                            { data: 'message' },
                            { data: 'rates' },
                            { data: 'doctorname' },
                        ]
                    });
                });
        </script>
        </div>
      </div>
    </div>
  </div>
  <!-- reviews -->
      <!-- Menu Dashboard -->
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
                  <tr>
                  <td colspan="2">
                    <input type="submit" name="submitPassword" value="Submit" class="btnSubmit">
                  </td>
                </tr>
              </table>
            </div>
          </form>
        </div> 
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
<!-- USER LOG -->
      <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-clock"></i> Hospital and Patient logs</h1>
              </div>
            <div class="card-body">
              <table id='user-log' class='display dataTable table table-hover' style="width: 100%;">
                  <thead>
                  <tr>
                    <th>Message</th>
                    <th>Date and Time</th>
                  </tr>
                  </thead>                
              </table>
            </div>
        <script>
        $(document).ready(function(){
                  $.fn.DataTable.ext.classes.sFilterInput = "form-control";
                    $('#user-log').DataTable({
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                        'ajax': {
                            'url':'user-log-search.php',                    
                        },
                        'language':{ 
                          'searchPlaceholder': 'Enter Appointment No., Last Name','sSearch': '' 
                        },
                        'columns': [
                            { data: 'status',
                                render: function ( data, type, row ) {
                                   if(row.status === 'Pending')
                                   {
                                    return 'Patient '+row.pid+' '+row.patientlastname+', '+row.patientname+' have new <word style="color: green;">appointment</word> to <word style="color: green;">'+row.Hospital+'</word>. Appointment No: '+row.aid+'';
                                   }
                                   if(row.status === 'Decline')
                                   {
                                    return 'Patient '+row.pid+' '+row.patientlastname+', '+row.patientname+' has been <word style="color: red;">declined</word> by <word style="color: green;">'+row.Hospital+'</word>. Appointment No: '+row.aid+'';
                                   }
                                   if(row.status === 'Approve')
                                   {
                                    return 'Patient '+row.pid+' '+row.patientlastname+', '+row.patientname+' has been <word style="color: blue;">approved</word> by <word style="color: green;">'+row.Hospital+'</word>. Appointment No: '+row.aid+'';
                                   }
                                }
                            },
                            { data: 'timestamp' },
                        ]
                    });
                });
        </script>
        </div>
      </div>
    </div>
  </div>
<!-- USER LOG -->
      <!-- Patients -->
      <div class="tab-pane fade show" id="patient" role="tabpanel" aria-labelledby="list-pat-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-user"></i> Patient</h1>
              </div>
            <div class="card-body">
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
                      <th scope="col"></th>
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
                    },
                    { 
                     data: null,
                     render: function(data, type, row, meta)
                     {
                        if(type == 'display')
                        {
                            data = '<a class="btn btn-danger" href="patient-delete?pid=' + row.pid + '">Remove</a>';                  
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
    </div>
  </div>
       <!-- User Account -->
      <div class="tab-pane fade show" id="user-accounts" role="tabpanel" aria-labelledby="list-pat-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-users"></i> Administrators</h1>
              </div>
            <div class="card-body">
            <table id='super-admin-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Option</th>
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#super-admin-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'superadmin-list.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Enter Name, Username or E-mail','sSearch': '' 
                },
                'columns': [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'username' },
                    { data: 'email' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="superadmin-view?id=' + row.id + '">View</a>';                    
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
      <!-- Hospital -->
      <div class="tab-pane fade show" id="hospital" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-hospital"></i> Hospitals</h1>
              </div>
            <div class="card-body" style="width: 100%;">
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
                    <th scope="col"></th>
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
                            data = '<a class="btn btn-info" href="hospital-edit?id=' + row.id + '">Edit</a>';                    
                        }
                        return data;
                     }
                    },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = "<a href='hospital-delete?id="+ row.id +"&cancel=update' onClick='return confirm('Are you sure you want to cancel this appointment?')' title='Cancel Appointment' tooltip-placement='top' tooltip='Remove'><button class='btn btn-danger'>Delete</button></a>";                    
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
    </div>
  </div>
      <!-- Hospital -->
      <!-- Hospital Requests -->
      <div class="tab-pane fade show" id="hospital-requests" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-hospital-user"></i> Hospital Requests</h1>
              </div>
            <div class="card-body">
            <table id='hospital-requests-table' class='display dataTable table table-hover' style="width: 100%;">
                <thead>
                <tr>
                   
                </tr>
                </thead>                
            </table>
        </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#hospital-requests-table').DataTable({
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
                            data = '<a class="btn btn-success" href="hospital-requests-view?id=' + row.id + '">View</a>';                    
                        }
                        return data;
                     }
                    },
                    { data: 'status' }
                ]

            });
        });
        </script>
        </div>
      </div>
    </div>
  </div>
      <!-- Hospital Requests -->

      <!-- Hospital Requests -->
      <!-- Add SUperadmin -->
  
    <div class="tab-pane fade" id="add-superadmin" role="tabpanel" aria-labelledby="list-messages-list">
      <div class="container-fluid container-full bg-white">
          <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1>Add Superadmin</h1>
              </div>
            <div class="card-body">
            <form method="post" action="admin-panel1.php">
              <div class="form-group">
                  <input type="text" class="form-control"  placeholder="Name" name="name"   required/>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control"  placeholder="Username" name="username" required/>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="E-mail" name="email"  />
              </div>
              <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password"  />
              </div>                                 
               <input type="submit" class="btn btn-info" name="addadmin"  value="Register" />
            </form>
      </div>  
    </div>
  </div>
</div>   
  
      <!-- User Account -->
<div class="tab-pane fade " id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
<!-- USER LOG -->
      <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
      </div>
    </div>
    </div>
  </div>
</div>
   </div>
  </body>
</html>