<?php
include 'db.php';

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
    $searchQuery = " and (username like '%".$searchValue."%' or 
        doctorname like '%".$searchValue."%' or 
        spec like '%".$searchValue."%' or 
        email like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from doctb");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"SELECT count(*) as allcount from doctb WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$hospitalQuery = "SELECT * from doctb WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$hospitalRecords = mysqli_query($con, $hospitalQuery);
$data = array();

while ($row = mysqli_fetch_assoc($hospitalRecords)) {
    $data[] = array(
            "id"=>$row['id'],
            "username"=>$row['username'],
            "doctorname"=>$row['doctorname'],
            "descrip"=>$row['descrip'],
            "spec"=>$row['spec'],
            "email"=>$row['email'],
            "docFees"=>$row['docFees'],

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