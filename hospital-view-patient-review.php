<?php
include 'db.php';
include('session-patient.php');
$con = mysqli_connect("localhost","root","","hospitalms");
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($get);
    $doctorname = $row['doctorname'];
## Read value

    
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
        subject like '%".$searchValue."%' or 
        message like '%".$searchValue."%'  ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from reviews where doctorname = '$doctorname' ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from reviews where doctorname = '$doctorname' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$patientQuery = "SELECT * from reviews WHERE doctorname = '$doctorname' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$patientRecords = mysqli_query($con, $patientQuery);
$data = array();

while ($row = mysqli_fetch_assoc($patientRecords)) {
    $data[] = array(
            "mid"=>$row['mid'],
            "fname"=>$row['fname'],
            "lname"=>$row['lname'],
            "message"=>$row['message'],
            "subject"=>$row['subject'],
            "rates"=>$row['rates'],
            "doctorname"=>$row['doctorname'],
            
            

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
