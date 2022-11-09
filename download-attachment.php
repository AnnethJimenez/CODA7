<?php 
include('db.php');
    $conn = mysqli_connect('localhost', 'root', '', 'hospitalms');
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctb WHERE id = '$id'";
    $get = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($get);

if (isset($_GET['file_id'])) {
    $con = mysqli_connect('localhost', 'root', '', 'hospitalms');
    
    
    // fetch file to download from database
    $sql = "SELECT * FROM doctb WHERE id=$id";
    $get = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($get);
    $filepath = 'uploads/' . basename($row['filenames']);

    if (file_exists($filepath)) 
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        exit();
    }
}
?>