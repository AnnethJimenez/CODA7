<?php
include('db.php');
include('session-hospital.php');
  $con=mysqli_connect("localhost","root","","hospitalms");
  $dname = $_SESSION['dname'];
if(isset($_POST['view'])){
// $con = mysqli_connect("localhost", "root", "", "notif");
if($_POST["view"] != '')
{
   $update_query = "UPDATE appointmenttb  SET notif = 1 WHERE notif= 0 and doctor = '$dname'";
   mysqli_query($con, $update_query);
}
$query = "SELECT * FROM appointmenttb where doctor = '$dname' ORDER BY id asc LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <a href=doctor-panel-appointment-view?id='.$row["id"].' class="dropdown-item">
  <strong>Patient '.$row["pid"].'</strong><br />
  <p>New appointment from <br> ('.$row['lname'].', '.$row['fname'].')</p>
  </a>
  ';
}
}
else{
    $output .= '<p>No Appointment Found.</p>';
}
$status_query = "SELECT * FROM appointmenttb WHERE notif = 0 and doctor = '$dname'";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>