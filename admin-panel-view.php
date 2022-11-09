<!DOCTYPE html>
<?php 
include('design-patient.php');

?>
<?php 
    $con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointmenttb where id='$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $lname = $row['lname'];
    $fname = $row['fname'];
    $gender = $row['gender'];
    $email = $row['email'];
    $contact = $row['contact'];
    $appdate = $row['appdate'];
    $apptime = $row['apptime'];
    $aid = $row['aid'];
    $doctor = $row['doctor'];
    $timestamp = $row['timestamp'];
?>
<?php 
include('db.php');
if(isset($_GET['cancel']))
  {
    $query=mysqli_query($con,"UPDATE appointmenttb set userStatus='Decline', doctorStatus='Decline' where id = '".$_GET['id']."'");
    if($query)
    {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
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
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <div class="row">
 <div class="col-md-8" style="margin-top: 3%; margin-left: 15%;">
  <div class="card">
    <div class="card-header text-center" style="background-color: skyblue;">
        <h1><i class="fa fa-clock"></i> Your appointment</h1>
    </div>
  <div class="card-body">
    <div class="tab-content" id="nav-tabContent" style="width: 980px;">
        <form class="form-group" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Appointment Number:</label></div>
                  <div class="col-md-8"><u><?php echo "$aid"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$fname"; ?> <?php echo "$lname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Gender:</label></div>
                  <div class="col-md-8"><?php echo "$gender"; ?></div><br><br>
                  <div class="col-md-4"><label>E-mail:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div><br><br>
                  <div class="col-md-4"><label>Contact No:</label></div>
                  <div class="col-md-8"><?php echo "$contact"; ?></div><br><br>
                  <div class="col-md-4"><label>Appointment Date:</label></div>
                  <div class="col-md-8"><?php echo "$appdate"; ?></div><br><br>
                  <div class="col-md-4"><label>Appointment Time:</label></div>
                  <div class="col-md-8"><?php echo date('h:ia', strtotime($apptime)); ?></div><br><br>
                  <div class="col-md-4"><label>Date and Time:</label></div>
                  <div class="col-md-8"><?php echo "$timestamp"; ?>:00</div><br><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8">
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
                
              </div><br><br>
          </div>
        </form>
        <?php
          echo "<a href=admin-panel><button  class='btn btn-warning'>Back</button></a>";
        ?>
        <?php 
                if(($row['userStatus']=='Approve') && ($row['doctorStatus']=='Pending'))  
                { 
              ?>
            <td>
            <a href="admin-panel.php?id=<?php echo $row['id']?>&cancel=update" 
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
            



      <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">        
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Consultancy Fees</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $con=mysqli_connect("localhost","root","","hospitalms");
                    global $con;

                    $query = "select * from appointmenttb;";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
              
                      #$fname = $row['fname'];
                      #$lname = $row['lname'];
                      #$email = $row['email'];
                      #$contact = $row['contact'];
                  ?>
                      <tr>
                        <td><?php echo $row['fname'];?></td>
                        <td><?php echo $row['lname'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['doctor'];?></td>
                        <td><?php echo $row['docFees'];?></td>
                        <td><?php echo $row['appdate'];?></td>
                        <td><?php echo $row['apptime'];?></td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>

        <br>
      </div>





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

  </body>
</html>