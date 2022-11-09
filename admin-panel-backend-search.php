<table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hospital</th>
                    <th scope="col">Fees</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th></th>

                  </tr>
                </thead>
                <tbody>
<?php
    include('design-patient.php');
    include('session-patient.php');
    $link = mysqli_connect("localhost", "root", "", "hospitalms");
    $email = $_SESSION['email'];
    if($link === false){
        die("ERROR: Could not connect. WOW " . mysqli_connect_error());
    } 
    if(isset($_REQUEST["term"])){
        $search = str_replace(",", "|", $_REQUEST["term"]); 
        $sql = "SELECT * FROM appointmenttb WHERE email REGEXP '".$search."' 
                 OR contact REGEXP '".$search."' 
                 OR lname REGEXP '".$search."' 
                 OR doctor REGEXP '".$search."'
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
                        <td>{$row['id']}</td>
                        <td>{$row['doctor']}</td>
                        <td>{$row['docFees']}</td>
                        <td>{$row['appdate']}</td>
                        <td>{$row['apptime']}:00</td>
                        <td>
                      ";
            ?>
            <?php
                    if(($row['userStatus']==0) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                    {
                      echo "Cancelled by you";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==1))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==2))  
                    {
                      echo "Pending";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==2))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==0))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0) && ($row['adminStatus']==1))  
                    {
                      echo "Declined";
                    }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==1))  
                    {
                      echo "Approved";
                    }
              ?> 
            </td>
            <td>
              <?php 
                if(($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==2))  
                { 
              ?>

            <a href="admin-panel.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
            </a>
          </td>
          <td>
            <?php
                }
              else
              {
                echo "";
              } 
            ?>
            <?php
              echo "</td>";
              echo "</tr>";
            } 
             ?>
             <?php
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