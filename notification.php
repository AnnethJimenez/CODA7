 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      //here goes the data
  }
  mysqli_close($conn);
?>
<!-- Hospital Registry -->
<?php 
include('session.php');
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
  $query="insert into doctb(doctorname,username,password,email,spec,docFees,haddress,descrip,htype)values('$doctorname','$doctor','$dpassword','$demail','$spec','$docFees','$haddress','$descrip','$htype')";
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
</style>
    <div>
        <a href="#" class="notification-appointment-toggle dropdown-toggle ex3" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <i class="fa fa-bell"></i> Notification</a>
        <ul class="notification-appointment">
          <li>asd</li>
        </ul>
        <li>
            <a href="notification">See all Notification</a>
        </li>
    </div>
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
$('#appointment-notification').on('submit', function(event){
 event.preventDefault();
 if($('#subject').val() != '' && $('#comment').val() != '')
 {
  var form_data = $(this).serialize();
  $.ajax({
   url:"admin-panel.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#appointment-notification')[0].reset();
    load_unseen_notification();
   }
  });
 }
 else
 {
  alert("Both Fields are Required");
 }
});
$(document).on('click', '.notification-appointment-toggle', function(){
 $('.count').html('');
 load_unseen_notification('yes');
});
setInterval(function(){
 load_unseen_notification();;
}, 5000);
});
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>