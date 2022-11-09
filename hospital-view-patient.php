<!DOCTYPE html>
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
    $rates = $row['rates'];
?>
<?php 
  include('session-patient.php');
  include('design-patient.php');
  include('db.php');
?>
<html lang="en">
  <head>
    <title><?php echo $doctorname;?> Viewing</title>
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
  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <!-- Side Navigation -->
  <body style="padding-top:50px;">
   

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
  ?>
  <!-- Main -->
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 100%;margin-left: 25%">
      <div class="card">
        <div class="card-header text-center" style="background-color: skyblue;">
            <h1><i class="fa fa-hospital"></i> <?php echo $doctorname ?></h1>
        </div>
      <div class="card-body">
        <form class="form-group" method="post">
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
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><?php echo "$email"; ?></div><br><br>
                  <div class="col-md-4"><label>Ratings:</label></div>
                  <div class="col-md-8"><?php echo "$rates"; ?></div><br><br>
                  <div class="col-md-12"><!-- MAP -->
                  <div class="dropdown-divider"></div>
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
                        zoom: 18,
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
                <div class="dropdown-divider"></div>
                <div class="container-fluid container-full bg-white">
           <div>
            <div class="card" style="width: 100%;">
              <div class="card-header text-center" style="background-color: skyblue;">
                  <h1><i class="fa fa-book"></i> Reviews of <?php echo $doctorname ?></h1>
              </div>
            <div class="card-body">
              <table id='hospital-review-table' class='display dataTable table table-hover' style="width: 100%;">
                  <thead>
                  <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Subject</td>
                    <td>Message</td>
                    <td>Ratings 1-5</td>

                  </tr>
                  </thead>                
              </table>
            </div>
        <script>
        $(document).ready(function(){
          $.fn.DataTable.ext.classes.sFilterInput = "form-control";
            $('#hospital-review-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'hospital-view-patient-review?id=<?php echo $id;?>',                    
                },
                'language':{ 
                  'searchPlaceholder': 'Message, Subject, Ratings','sSearch': '' 
                },
                'columns': [
                    { data: 'fname' },
                    { data: 'lname' },
                    { data: 'subject' },
                    { data: 'message' },
                    { data: 'rates' }, 
                ]
            });
        });
        </script>
        </div>
      </div>
    </div>
        </form>
              <a href="admin-panel"><button class="btn btn-danger">Back</button></a>
              <a href="hospital-review?id=<?php echo $id; ?>"><button class="btn btn-primary">Submit a review</button></a>
      </div>
    </div>
  </div>
</div>
  </body>
<!-- Add Hospital -->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>