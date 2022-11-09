<!DOCTYPE html>
<?php 
  include('func1.php');
  include('design-hospital.php');
  include('session-hospital.php');
  $con=mysqli_connect("localhost","root","","hospitalms");
  $dname = $_SESSION['dname'];
  $doctorname = $_SESSION['doctorname'];
  $email = $_SESSION['email'];
  $spec = $_SESSION['spec'];
  $haddress = $_SESSION['haddress'];
  $descrip = $_SESSION['descrip'];
  $htype = $_SESSION['htype'];
  $docFees = $_SESSION['docFees'];
  $status = $_SESSION['status'];
  $password = $_SESSION['password'];
  $id = $_SESSION['id'];

?>

<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointmenttb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $pid = $row['pid'];
    $aid = $row['aid'];
    if(isset($_GET['decline']))
      {
        $query=mysqli_query($con,"UPDATE appointmenttb set userStatus='Decline', doctorStatus='Decline' where id = '".$_GET['id']."'");
        if($query)
        {
          echo "<script>alert('You declined patient's appointment');</script>";
        }
      }
    if(isset($_GET['approve']))
      {
        $query=mysqli_query($con,"UPDATE appointmenttb set userStatus='Approve', doctorStatus='Approve' where id = '".$_GET['id']."' ");
        if($query)
        {
          echo "<script>alert('You approved patient's appointment');</script>";
        }
      }
    if(isset($_GET['approve']))
      {
        $query10=mysqli_query($con,"INSERT INTO patientnotif (id,pid,aid,doctorname,status,fname,lname,notif) VALUES ('$id','$pid','$aid','$dname','Approve','$fname','$lname','0')");
        if($query10)
        {
          echo "";
        }
      }
    if(isset($_GET['decline']))
      {
        $query1=mysqli_query($con,"INSERT INTO logs (pid,Hospital,status,patientname,patientlastname,aid) VALUES ('$pid','$dname','Decline','$fname','$lname','$aid')");
        if($query1)
        {
          echo "<script>alert('Your log has been inserted.');</script>";
        }
      }  
?>
<?php 
$con=mysqli_connect("localhost","root","","hospitalms");
$timesched1=$_POST['timesched1'];
$timesched2=$_POST['timesched2'];
$timesched3=$_POST['timesched3'];
$timesched4=$_POST['timesched4'];
$timeschedslot1=$_POST['timeschedslot1'];
$timeschedslot2=$_POST['timeschedslot2'];
$timeschedslot3=$_POST['timeschedslot3'];
$timeschedslot4=$_POST['timeschedslot4'];
$dname = $_SESSION['dname'];
$id = $_SESSION['id'];
if(isset($_POST['timeschedbutton']))
  {
    $query99=mysqli_query($con,"UPDATE doctb set timesched1='$timesched1', timesched2='$timesched2', timesched3='$timesched3', timesched4='$timesched4', timeschedslot1 = '$timeschedslot1', timeschedslot2 = '$timeschedslot2', timeschedslot3 = '$timeschedslot3', timeschedslot4 = '$timeschedslot4' where id = '$id'");
    if($query99)
    {
      echo "<script>alert('You updated the time schedule.');</script>";
    }
  }  
?>
<html lang="en">
  <head>
    <title><?php echo $dname ?> Portal</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="doctor-panel"><img src="logo.png" style="width: 37px" alt=""/></i> CODA DEFENSE SYSTEM <?php echo $dname; ?></a>
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
            <h5 class="dropdown-header"><b>Notification</b></h5>
            <ul class="notification-appointment "></ul>
            <div class="dropdown-divider"></div>
            <center><a class="dropdown-item" href="#">See all notification</a></center>
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
          <a href="#" class="dropdown-item"> Profile</a>
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
          <div class="dropdown-divider"></div>
          <a href="logout" class="dropdown-item"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </ul>
    </div>
  </nav>

</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <script>
    function clickDiv(id) {
      document.querySelector(id).click();
    }
  </script>   
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;">&nbsp<?php echo $_SESSION['doctorname'] ?> System Panel  </h3>
    <div class="row">
  <div class="col-md-4" style="max-width:18%;margin-top: 3%;">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">Dashboard</a>
      <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Appointments & Appointment History</a>
      <!--<a class="list-group-item list-group-item-action" href="#list-settings1" id="list-settings1-list" role="tab" data-toggle="list" aria-controls="home">Logs</a> -->
      <a class="list-group-item list-group-item-action" href="#user-account" id="list-ddoc-list" role="tab" data-toggle="list" aria-controls="home">User Account</a>
       <a class="list-group-item list-group-item-action" href="#time-sched" id="list-timesched-list" role="tab" data-toggle="list" aria-controls="home">Set Time Schedules</a>
      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">
      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-app-list">
         <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Appointments</div>
            <div class="number">
            <?php 
              $sql = "SELECT * FROM appointmenttb";
              if ($result=mysqli_query($con,$sql)) {
                  $rowcount=mysqli_num_rows($result);
              }
              echo $rowcount; 
            ?>
            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#list-app" class="list-group-item-action" onclick="clickDiv('#list-app-list')">View Appointments</a>
            </div>
          </div>
          <h1><i class='bx bx-plus-medical'></i></h1>
        </div>

        <div class="box">
          <div class="right-side">
            <div class="box-topic">Logs</div>
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
            <div class="box-topic">User Account</div>
            <div class="number">

            </div>
            <div class="indicator">
              <i class="fa fa-link"></i>
              <a href="#user-account" class="list-group-item-action" onclick="clickDiv('#list-ddoc-list') ">User <?php echo $dname?></a>
            </div>
          </div>
          <h1><i class="fa fa-user"></i></h1>
        </div>
      </div>
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-clock"></i> Logs</h1>
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
                          'searchPlaceholder': 'Enter Last Name, E-mail, Contact','sSearch': '' 
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
        <div class="top-sales box">
            <h5 class="dropdown-header">Notification</h5>
            <ul class="notification-appointment "></ul>
            <div class="dropdown-divider"></div>
            <center><a class="dropdown-item" href="#">See all notification</a></center>
        </div>
      </div>

    </div>
      </div>
    <div class="tab-pane fade" id="user-account" role="tabpanel" aria-labelledby="list-settings1-list">
        <div class="container-fluid container-full bg-white">
           <div>
            <div class="card">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-clock"></i> User Account</h1>
              </div>
            <div class="card-body">
              <div class="col-md-4"><label>Hospital Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$doctorname"; ?></u></u></div><br> 
                  <div class="col-md-4"><label>Description:</label></div>
                  <div class="col-md-8"><u><?php echo "$descrip"; ?></u></div><br>
                  <div class="col-md-4"><label>Hospital Type:</label></div>
                  <div class="col-md-8"><u><?php echo "$htype"; ?></u></div><br>
                  <div class="col-md-4"><label>Address:</label></div>
                  <div class="col-md-8"><u><?php echo "$haddress"; ?></u></div><br>
                  <div class="col-md-4"><label>Username:</label></div>
                  <div class="col-md-8"><u><?php echo "$dname"; ?></u></div><br>
                  <div class="col-md-4"><label>Service Type:</label></div>
                  <div class="col-md-8"><u><?php echo "$spec"; ?></u></div><br>
                  <div class="col-md-4"><label>Service Fee:</label></div>
                  <div class="col-md-8"><u><?php echo "$docFees"; ?></u></div><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8"><u><?php echo $status; ?></u></div><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><u><?php echo "$email"; ?></u></div><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><u><?php echo "$password";?></u></div><br>
            </div>
        </div>
      </div>
    </div>
  </div>  
    <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-home-list">
         <div class="container-fluid container-full bg-white">
           <div>
            <div class="card" style="width: 100%;">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-book"></i> Appointments <?php echo $aid ?></h1>
              </div>
            <div class="card-body">
              <table id='appointment-table' class='display dataTable table table-hover' style="width: 100%;">
                  <thead>
                  <tr>
                    <th scope="col">Appointment No.</th>
                    <th scope="col">Patient No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Contact</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                  </tr>
                  </thead>                
              </table>
            </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#appointment-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'doctor-panel-appointment.php',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Enter Last Name, E-mail, Contact','sSearch': '' 
                },
                'columns': [
                    { data: 'aid'},
                    { data: 'pid' },
                    { data: 'fname',
                        render: function ( data, type, row ) {
                            return row.lname + ', ' + row.fname + '';
                        }
                    },
                    { data: 'gender' },
                    { data: 'contact' },
                    { data: 'email' },
                    { data: 'doctorStatus' },
                    { 
                     "data": null,
                     "render": function(data, type, row, meta)
                     {
                        if(type === 'display')
                        {
                            data = '<a class="btn btn-success" href="doctor-panel-appointment-view?id=' + row.id + '">View</a>';                    
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
            <!-- Set Schedule -->
        <div class="tab-pane fade" id="time-sched" role="tabpanel" aria-labelledby="list-home-list">
         
          <div class="container-fluid container-full bg-white">
            <div class="card" style="width: 100%;">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-book"></i> Set time Schedule</h1>
              </div>
            <div class="card-body">
              <form class="form-group" method="post" action="doctor-panel">
                <div class="row">                 
                    <div class="col-md-4">
                      <label for="spec">Sched Time No. 1:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control timepicker" value="<?php echo $timesched1; ?>" name="timesched1">
                    </div><br>
                    <div class="col-md-4">
                      <label for="spec">Slot no:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control timepicker" value="<?php echo $timeschedslot1; ?>" name="timeschedslot1">
                    </div>
                </div>
                <div class="row">                 
                    <div class="col-md-4">
                      <label for="spec">Sched Time No. 2:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" value="<?php echo $timesched2; ?>" name="timesched2">
                    </div>
                    <div class="col-md-4">
                      <label for="spec">Slot no:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control timepicker" value="<?php echo $timeschedslot2; ?>" name="timeschedslot2">
                    </div>
                </div>
                <div class="row">                 
                    <div class="col-md-4">
                      <label for="spec">Sched Time No. 3:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" value="<?php echo $timesched3; ?>" name="timesched3">
                    </div>
                    <div class="col-md-4">
                      <label for="spec">Slot no:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control timepicker" value="<?php echo $timeschedslot3; ?>" name="timeschedslot3">
                    </div>
                </div>
                <div class="row">                 
                    <div class="col-md-4">
                      <label for="spec">Sched Time No. 4:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" value="<?php echo $timesched4; ?>" name="timesched4">
                    </div>
                    <div class="col-md-4">
                      <label for="spec">Slot no:</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control timepicker" value="<?php echo $timeschedslot4; ?>" name="timeschedslot4">
                    </div>
                </div>
                <input type="submit" name="timeschedbutton" value="Update" class="btn btn-primary">
              </form>
          </div>
        </div>
      </div>
    </div>
    
            <!-- USER LOG -->
        <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
         
    </div>
        </div>
<!-- USER LOG -->
          </div>
<!-- USER LOG -->






      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="admin-panel1.php">
          <div class="row">
                  <div class="col-md-4"><label>Doctor Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="doctor" required></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="password" class="form-control"  name="dpassword" required></div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="demail" required></div><br><br>
                  <div class="col-md-4"><label>Consultancy Fees:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="docFees" required></div><br><br>
                </div>
          <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
        </form>
      </div>
       <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...</div>
    </div>
  </div>
</div>
   </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>