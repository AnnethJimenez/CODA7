<?php
include('db.php');
include('session-patient.php');
  $con=mysqli_connect("localhost","root","","hospitalms");
  $pid = $_SESSION['pid'];
if(isset($_POST['view'])){
// $con = mysqli_connect("localhost", "root", "", "notif");
if($_POST["view"] != '')
{
   $update_query = "UPDATE patientnotif  SET notif = 1 WHERE notif= 0 and pid = '$pid'";
   mysqli_query($con, $update_query);
}
$query = "SELECT * FROM patientnotif where pid = '$pid' ORDER BY pid desc LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <a href=admin-panel-view?id='.$row["id"].' class="dropdown-item">
  <strong>Appointment No. '.$row['aid'].' "'.$row["status"].'"</strong><br />
  <p>Your appointment was <br> '.$row['status'].'d by '.$row['doctorname'].'.</p>
  </a>
  ';
}
}
else{
    $output .= '<p>No Appointment Found.</p>';
}
$status_query = "SELECT * FROM patientnotif WHERE notif = 0 and pid = '$pid'";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>