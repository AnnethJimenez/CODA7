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
    $ratesdoc = $row['rates'];
?>
<?php 
  include('session-patient.php');
  include('design-patient.php');
  include('db.php');
  include('newfunc.php');
  $pid = $_SESSION['pid'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $gender = $_SESSION['gender'];
  $lname = $_SESSION['lname'];
  $contact = $_SESSION['contact'];
?>
<?php 
include 'db.php';
if(isset($_POST['reviewsend']))
{
  $rates=$_POST['rates'];
  $subject=$_POST['subject'];
  $message = htmlspecialchars(stripslashes(trim($_POST['message'])));
          $query="INSERT into reviews (doctorname,fname,lname,message,subject,rates)values('$doctorname','$fname','$lname','$message','$subject','$rates')";
          $result=mysqli_query($con,$query);
          if($result)
          {
            echo "<script>alert('Thanks for the review!');</script>";
            
          }
}
if(isset($_POST['reviewsend']))
  {
    $newCount = $ratesdoc + $rates;
    $query3=mysqli_query($con,"UPDATE doctb set rates = '$newCount' where id = '$id'");
    if($query3)
    {
      echo "";
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
    <title><?php echo $doctorname;?> Viewing</title>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="admin-panel"><img src="logo.png" style="width: 37px" alt=""/>CODA DEFENSE SYSTEM</a>
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
            <h1>Review to <?php echo $doctorname ?></h1>          
        </div>
      <div class="card-body">
               <form method="post" action="" enctype="multipart/form-data">
                   <div class="row register-form">                               
                       <div class="col-md-6">
                           <div class="form-group">
                               <input type="text" class="form-control" placeholder="Subject" name="subject"  />
                           </div>
                           <div class="form-group">
                               <input type="text" name="message" class="form-control" placeholder="Write a review..." />
                           </div>                                 
                           <div class="form-group">
                               <select name="rates" class="form-control" id="rate" required="required">
                                 <option value="0" name="rates" disabled selected>Pick a rate 1 - 5</option>
                                 <option value="1" name="rates"><i class='bx bxs-star'></i>1</option>
                                 <option value="2" name="rates">2</option>
                                 <option value="3" name="rates">3</option>
                                 <option value="4" name="rates">4</option>
                                 <option value="5" name="rates">5</option>
                               </select>
                           </div>    
                       </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Hospital: </label>
                              <label><?php echo $doctorname; ?> </label>
                          </div>
                          <div class="form-group">
                              <label>Address:</label>
                              <label><?php echo $haddress; ?> </label>
                          </div>
                          <div class="form-group">
                              <label>Service:</label>
                              <label><?php echo $spec; ?> </label>
                          </div>
                        </div>               
               </div>
               <input type="submit" class="btnRegister btn btn-primary" name="reviewsend"  value="Submit a review" />
               <a href="admin-panel" class="btn btn-success">Back</a> 
           </form>   

      </div>
    </div>
  </div>
</div>
  </body>
<!-- Add Hospital -->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
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