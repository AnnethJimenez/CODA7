<!DOCTYPE html>
<?php 
include('design.php');
include('session.php');
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
    if(isset($_GET['update']))
    {
      $query1=mysqli_query($con,"INSERT INTO logs (Hospital,status,patientname,patientlastname) VALUES ('$doctor','1','".$row['fname']."','".$row['lname']."')");
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
      $query1=mysqli_query($con,"INSERT INTO logs (Hospital,status,patientname,patientlastname) VALUES ('$doctor','0','".$row['fname']."','".$row['lname']."')");
      if($query1)
      {
        echo "<script>alert('Your log has been inserted.');</script>";
      }
      else
      {
        
      }
    }
?>
<?php 
              
            
            ?>
<html lang="en">
  <head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#"><img src="logo.png" style="width: 37px" alt=""/> CODA DEFENSE SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <style >
      .btn-outline-light:hover{
        color: #25bef7;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
      }
    </style>

  <style >
    .bg-primary {
      background: #F0F2F0;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #000C40, #F0F2F0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.list-group-item.active {
  z-index: 2;
    color: #fff;
    background: #F0F2F0; 
    background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);
    background: linear-gradient(to right, #000C40, #F0F2F0);
    border-color: #c3c3c3;
}
.text-primary {
    color: #342ac1!important;
}
  </style>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="logout1.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
      <input type="submit" class="btn btn-primary" id="inputbtn" name="search_submit" value="Search">
    </form>
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $row['lname'] ?>  </h3>
    <div class="row">
 <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 980px;">
        <form class="form-group" method="post">
          <div class="row">
                  <div class="col-md-4"><label>Name:</label></div>
                  <div class="col-md-8"><u><?php echo "$fname"; ?> <?php echo "$lname"; ?></u></div><br><br>
                  <div class="col-md-4"><label>Gender:</label></div>
                  <div class="col-md-8"><?php echo "$gender"; ?></div><br><br>
                  <div class="col-md-4"><label>E-mail:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div><br><br>
                  <div class="col-md-4"><label>Contact No:</label></div>
                  <div class="col-md-8"><?php echo "$contact"; ?></div><br><br>
                  <div class="col-md-4"><label>Date:</label></div>
                  <div class="col-md-8"><?php echo "$appdate"; ?></div><br><br>
                  <div class="col-md-4"><label>Time:</label></div>
                  <div class="col-md-8"><?php echo "$apptime"; ?>:00</div><br><br>
                  <div class="col-md-4"><label>Status:</label></div>
                  <div class="col-md-8"><?php
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
              ?></div><br><br>
          </div>
        </form>
        <?php
          echo "<a href=patient-requests><button  class='btn btn-warning'>Back</button></a>";
        ?>
        <?php 
                if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==2))  
                { 
              ?>
             <a href="admin-panel1.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="admin-panel1.php?id=<?php echo $row['id']?>&cancel=update" 
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
              <a href="doctor-panel.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="doctor-panel.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
            </a>
              </td>
              <?php
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>