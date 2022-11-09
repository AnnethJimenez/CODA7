<?php
include('db.php');
if(isset($_POST['view'])){
// $con = mysqli_connect("localhost", "root", "", "notif");
if($_POST["view"] != '')
{
   $update_query = "UPDATE patreg SET lname = 1 WHERE lname=0";
   mysqli_query($con, $update_query);
}
$query = "SELECT * FROM patreg ORDER BY lname DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <a href=patient-view?pid='.$row["pid"].' class="dropdown-item">
  <strong>'.$row["lname"].'</strong><br />
  <small><em>'.$row["fname"].'</em></small>
  </a>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}
$status_query = "SELECT * FROM patreg WHERE lname=0";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>