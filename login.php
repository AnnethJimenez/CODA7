<?php
$con=mysqli_connect("localhost","root","","hospitalms");
$sql = "SELECT id FROM admintb WHERE username = 'SUPERADMIN'";
    $qry = mysqli_query($con,$sql);

    if (mysqli_num_rows($qry) < 1) {
        $sql2 = "INSERT INTO admintb (name,username,password,email) values ('Default','SUPERADMIN','superadmin','codadefense@gmail.com')";
        $qry2 = mysqli_query($con,$sql2);

        if ($qry2) exit('<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="DataTables/datatables.min.css" rel="stylesheet" type="text/css>
    
    

    <script src="https://kit.fontawesome.com/05913c85d8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="patient-login"><img src="logo.png" style="width: 37px" alt=""/> CODA DEFENSE SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
</head>
<body>
<div>
   <div class="container-fluid" style="margin-top:50px;">
      <div class="row">
        <div class="col-md-8" style="margin-top: 3%;margin-left: 15%;">
          <div class="tab-content" id="nav-tabContent" style="width: 100%;">
              <div class="row">
                <div class="container">
                  <div class="card">
                    <div class="card-header text-center" style="background-color: lightblue;">
                      <h1>Welcome to your system.</h1>
                    </div>
                    <div class="card-body">
                      Your default credentials is:<br>
                      username: <b>SUPERADMIN</b><br>
                      password: <b>superadmin</b><br>
                      E-mail: <b>codadef@gmail.com</b><br>
                      <br>
                      <br>
                      <p>Please Refresh your browser to continue.</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>');
        else exit('An error occured!');
    }
?>
<?php 
include('db.php');
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

  $filename = $_FILES['myfile']['name'];
  $destination = 'uploads/' . $filename;
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $file = $_FILES['myfile']['tmp_name'];
  $size = $_FILES['myfile']['size'];
  $latitude = htmlspecialchars(stripslashes(trim($_POST['latitude'])));
  $longtitude = htmlspecialchars(stripslashes(trim($_POST['longtitude'])));
   if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpg','doc','xlsx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        if (move_uploaded_file($file, $destination)) 
        {    
          $query="INSERT into doctb(doctorname,username,password,email,spec,docFees,haddress,descrip,htype,latitude,longtitude,rates,status,filenames,size)values('$doctorname','$doctor','$dpassword','$demail','$spec','$docFees','$haddress','$descrip','$htype','$latitude','$longtitude','0','Pending','$filename','$size')";
          $result=mysqli_query($con,$query);
          if($result)
          {
            echo "<script>alert('Hospital added successfully!');</script>";
            header("Location:hospital-login");
          }
        } else {
            echo "Failed to upload file";
        }
    }
}
?>
<html>
<head>
<title>Hospital Management System</title>
<link rel="stylesheet" type="text/css" href="style1.css">
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style >
     .form-control {
    border-radius: 0.75rem;
}
</style>
<!-- Patient -->
<script>
var check = function() 
{
  if (document.getElementById('password').value ==
        document.getElementById('cpassword').value) 
  {
    document.getElementById('message').style.color = '#5dd05d';
    document.getElementById('message').innerHTML = 'Matched';
  } 
  else 
  {
    document.getElementById('message').style.color = '#f55252';
    document.getElementById('message').innerHTML = 'Password fields does not match';
  }
}
var check2 = function() 
{
  if (document.getElementById('dpassword').value ==
        document.getElementById('dcpassword').value) 
  {
    document.getElementById('dmessage').style.color = '#5dd05d';
    document.getElementById('dmessage').innerHTML = 'Matched';
  } 
  else 
  {
    document.getElementById('dmessage').style.color = '#f55252';
    document.getElementById('dmessage').innerHTML = 'Password fields does not match';
  }
}
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 32);
};
function checklen()
{
    var pass1 = document.getElementById("password");  
    if(pass1.value.length<6)
    {  
        alert("Password must be at least 6 characters long. Try again!");  
        return false; 
    }
}
function checklen2()
{
    var pass2 = document.getElementById("dpassword");  
    if(pass2.value.length<6)
    {  
        alert("Password must be at least 6 characters long. Try again!");  
        return false;  
    }
}
</script>
</head>

<!------ Include the above in your HEAD tag ---------->
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" >
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="patient-login" style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;"><h4><img src="logo.png" style="width: 37px" alt=""/>&nbsp CODA DEFENSE SYSTEM</h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="patient-login" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>HOME</h6></a>
          </li>


          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>CONTACT</h6></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

	

<div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
                <div class="row">
                    <div class="col-md-3 register-left" style="margin-top: 10%;right: 0%">            
                    </div>
                    <div class="col-md-9 register-right" style="margin-top: 40px;right: 150px; border-top-right-radius: 5%; border-bottom-right-radius: 5%;  border-top-left-radius: 5%; border-bottom-left-radius: 5%;">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="width: 40%;">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Patient</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hospital</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                            </li>
                        </ul>
                        <!-- Register Patient -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register as Patient</h3>
                                    <form method="post" action="func2.php">
                                        <div class="row register-form">                               
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  placeholder="First Name" name="fname"  onkeydown="return alphaOnly(event);" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Your Email" name="email"  />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="paddress" class="form-control" placeholder="Address"  />
                                                </div>                                 
                                                <div class="form-group">
                                                    <div class="maxl">
                                                        <label class="radio inline"> 
                                                            <input type="radio" name="gender" value="Male">
                                                            <span> Male </span> 
                                                        </label>
                                                        <label class="radio inline"> 
                                                            <input type="radio" name="gender" value="Female">
                                                            <span>Female </span> 
                                                        </label>
                                                    </div>
                                                    <a href="patient-login">Already have an account? Login Now</a>
                                                    <br>
                                                    <a href="forgot-password">Forgot password?</a>                                        
                                                </div>
                                            </div>                           
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name" name="lname" onkeydown="return alphaOnly(event);" required/>
                                            </div>                                       
                                            <div class="form-group">
                                                <input type="tel" minlength="11" maxlength="11" name="contact" class="form-control" placeholder="Contact"  />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" onkeyup='check();' required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"  id="cpassword" placeholder="Confirm Password" name="cpassword"  onkeyup='check();' required/><span id='message'></span>
                                            </div>
                                            <input type="submit" class="btnRegister" name="patsub1" onclick="return checklen();" value="Register"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Register Patient -->
                            <!-- Register Hospital -->
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3 class="register-heading">Register as Hospital</h3>
                                    <form method="post" action="login.php" enctype="multipart/form-data">
                                        <div class="row register-form">                               
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  placeholder="Hospital Name" name="doctorname"  onkeydown="return alphaOnly(event);" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  placeholder="Username" name="doctor"  onkeydown="return alphaOnly(event);" required/>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Description" name="descrip"  />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="haddress" class="form-control" placeholder="Hospital Address"  />
                                                </div>                                 
                                                <div class="form-group">
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
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Service Fee" name="docFees"  />
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="demail" class="form-control" placeholder="Hospital E-mail"  />
                                                </div>         
                                            </div>                           
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Hospital Type" name="htype"  required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password" id="dpassword" name="dpassword" onkeyup='check2();' required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"  id="dcpassword" placeholder="Confirm Password" name="dcpassword"  onkeyup='check2();' required/><span id='dmessage'></span>
                                            </div>                                      
                                            <div class="form-group">
                                                <label>Coordinate of Hospital</label>
                                                <input type="text" minlength="11" maxlength="11" name="latitude" class="form-control" placeholder="Latitude"  />
                                            </div>
                                             <div class="form-group">
                                                <input type="text" minlength="11" maxlength="11" name="longtitude" class="form-control" placeholder="Longitude"  />
                                            </div>
                                            <div class="form-group">
                                                <label>Hospital File</label>
                                                <input type="file" class="form-control" name="myfile" required>
                                            </div>                                       
                                            <input type="submit" class="btnRegister" name="docsub"  value="Register" onclick="return checklen2();" />
                                                    <a href="hospital-login">Already have an account? Login Now</a>
                                                    <br>
                                                    <a href="forgot-password">Forgot password?</a> 
                                        </div>
                                    </div>
                                </form>
                        </div>
                            <!-- Register Hospital -->
                            <!-- Admin Login -->
                            <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">ADMINISTRATOR</h3>
                                <form method="post" action="func3.php">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Username" name="username1" onkeydown="return alphaOnly(event);" required/>
                                        </div>                                      
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" name="password2" required/>
                                        </div>
                                        <a href="superadmin-forgot-password">Forgot Password?</a>
                                        <input type="submit" class="btnRegister" name="adsub" value="Login"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <!-- Admin Login -->
                    </div>

                    </div>
                </div>

            </div>
<script type="text/javascript">
  function cap(){
    var alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'
                 ,'W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
                 'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!','@','#','$','%','^','&','*','+'];
                 var a = alpha[Math.floor(Math.random()*71)];
                 var b = alpha[Math.floor(Math.random()*71)];
                 var c = alpha[Math.floor(Math.random()*71)];
                 var d = alpha[Math.floor(Math.random()*71)];
                 var e = alpha[Math.floor(Math.random()*71)];
                 var f = alpha[Math.floor(Math.random()*71)];

                 var final = a+b+c+d+e+f;
                 document.getElementById("capt").value=final;
               }
               function validcap(){
                var stg1 = document.getElementById('capt').value;
                var stg2 = document.getElementById('textinput').value;
                if(stg1==stg2){
                  alert("Form is validated Succesfully");
                  return true;
                }else{
                  alert("Please enter a valid captcha");
                  return false;
                }
               }
</script>
    </body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </html>

  