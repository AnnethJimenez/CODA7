<?php
include 'db.php';
include 'session-patient.php';
## Read value
$pid = $_SESSION['pid'];
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and (doctorStatus like '%".$searchValue."%' or 
        doctor like '%".$searchValue."%' or 
        docFees like '%".$searchValue."%' or
        aid like '%".$searchValue."%' or 
        userStatus like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from appointmenttb where pid = '$pid'");
$records = mysqli_fetch_array($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from appointmenttb WHERE pid = ".$pid." ".$searchQuery);
$records = mysqli_fetch_array($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$hospitalQuery = "SELECT * from appointmenttb WHERE pid = ".$pid." ".$searchQuery." order by timestamp desc limit ".$row.",".$rowperpage;
$hospitalRecords = mysqli_query($con, $hospitalQuery);
$data = array();
while ($row = mysqli_fetch_array($hospitalRecords)) 
{
    $data[] = array(
            "id"=>$row['id'],
            "pid"=>$row['pid'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "doctor"=>$row['doctor'],
            "userStatus"=>$row['userStatus'],
            "doctorStatus"=>$row['doctorStatus'],
            "docFees"=>$row['docFees'],
            "aid"=>$row['aid'],
            "timestamp"=>$row['timestamp'],
        );
}
## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);