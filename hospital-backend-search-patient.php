<table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Hospital Name</th>
                    <th scope="col">Hospital Type</th>
                    <th scope="col">Address</th>
                    <th scope="col">Description</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Service</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
<?php
    include('design.php');
    $link = mysqli_connect("localhost", "root", "", "hospitalms");
    if($link === false){
        die("ERROR: Could not connect. WOW " . mysqli_connect_error());
    } 
    if(isset($_REQUEST["term"])){
         $search = str_replace(",", "|", $_REQUEST["term"]);
        $sql = "SELECT * FROM doctb WHERE username REGEXP '".$search."' 
                 OR doctorname REGEXP '".$search."' 
                 OR email REGEXP '".$search."' 
                 OR spec REGEXP '".$search."' 
                 ";
        if($stmt = mysqli_prepare($link, $sql)){
            $param_term = $_REQUEST["term"] . '%';
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["doctorname"]."</td>";
                        echo "<td>".$row["htype"]."</td>";
                        echo "<td>".$row["haddress"]."</td>";
                        echo "<td>".$row["descrip"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["username"]."</td>";
                        echo "<td>".$row["spec"]."</td>";
                        echo "<td>P".$row["docFees"]."</td>";
                        echo "<td><a href = hospital-view-patient?id={$row["id"]}><button  class='btn btn-primary'>View</button></a>";
                        echo "</tr>";  
                    }
                } else{
                    echo "<td>No matches found</td>";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
?>