<?php
include 'db.php';
include('session-hospital.php');
## Read value

    
$dname = $_SESSION['dname'];
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
    $searchQuery = " and (fname like '%".$searchValue."%' or 
        lname like '%".$searchValue."%' or 
        email like '%".$searchValue."%' or 
        aid like '%".$searchValue."%' or
        contact like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from appointmenttb where doctor = '$dname'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from appointmenttb where doctor = '$dname' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$patientQuery = "SELECT * from appointmenttb WHERE doctor = '$dname' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$patientRecords = mysqli_query($con, $patientQuery);
$data = array();

while ($row = mysqli_fetch_assoc($patientRecords)) {
    $data[] = array(
            "aid"=>$row['aid'],
            "id"=>$row['id'],
            "pid"=>$row['pid'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "gender"=>$row['gender'],
            "contact"=>$row['contact'],
            "email"=>$row['email'],
            "doctor"=>$row['doctor'],
            "docFees"=>$row['docFees'],
            "doctorStatus"=>$row['doctorStatus'],
            

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
