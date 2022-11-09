<?php
include('db.php');
if(isset($_POST['view'])){
// $con = mysqli_connect("localhost", "root", "", "notif");
if($_POST["view"] != '')
{
   $update_query = "UPDATE doctb SET notif = 1 WHERE notif=0";
   mysqli_query($con, $update_query);
}
$query = "SELECT * FROM doctb ORDER BY id DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
  $output .= '
  <a href=hospital-requests-view?id='.$row["id"].' class="dropdown-item">
  <strong>'.$row["doctorname"].'</strong><br />
  <p>New Registered Hospital.</p>
  </a>
  ';
}
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}
$status_query = "SELECT * FROM doctb WHERE notif=0";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>