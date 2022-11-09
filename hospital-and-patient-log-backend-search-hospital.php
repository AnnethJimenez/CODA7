<table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Hospital</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date and Time</th>
                    <th></th>

                  </tr>
                </thead>
                <tbody>
<?php
    include('design.php');
    include('session-hospital.php');
    $link = mysqli_connect("localhost", "root", "", "hospitalms");
    if($link === false){
        die("ERROR: Could not connect. WOW " . mysqli_connect_error());
    } 
    if(isset($_REQUEST["term"])){
        $search = str_replace(",", "|", $_REQUEST["term"]);        
        $sql = "SELECT * FROM logs WHERE Hospital REGEXP '".$search."' 
                 OR patientname REGEXP '".$search."' 
                 OR patientlastname REGEXP '".$search."' 
                 OR status REGEXP '".$search."' 
                 ";
        if($stmt = mysqli_prepare($link, $sql)){
            $param_term = $_REQUEST["term"] . '%';
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "
                          <tr>
                          <td>{$row['Hospital']}</td>
                          
                          ";
                          ?>
                          <td>
                          <?php
                            if(($row['status']==1))  
                            {
                              echo "The {$row['Hospital']} has approved the request of patient {$row['patientname']} {$row['patientlastname']}.";
                            }
                            if(($row['status']==0))  
                            {
                              echo "The {$row['Hospital']} has declined the request of patient {$row['patientname']} {$row['patientlastname']}.";
                            }
                            if(($row['status']==2))  
                            {
                              echo "Patient ({$row['patientname']} {$row['patientlastname']}) has requested an appointment.";
                            }
                          ?>
                        </td>
                          <?php 
                            echo "<td>{$row['timestamp']}</td>";
                          ?>
                        <?php
              echo "</tr>";
            } 
          } 
        } 
            else
            {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
?>