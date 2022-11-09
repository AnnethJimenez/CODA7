<!--<table class="table table-hover">
                <thead>
                  <tr>
                   
                  </tr>
                </thead>
                <tbody>

<?php
/*
    include('design.php');
    $link = mysqli_connect("localhost", "root", "", "hospitalms");
    if($link === false){
        die("ERROR: Could not connect. WOW " . mysqli_connect_error());
    } 
    if(isset($_REQUEST["term"])){
         $search = str_replace(",", "|", $_REQUEST["term"]);
        $sql = "SELECT * FROM appointmenttb WHERE doctor REGEXP '".$search."' 
                 OR contact REGEXP '".$search."' 
                 OR email REGEXP '".$search."' 
                 OR lname REGEXP '".$search."' 
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
                            <td>{$row['fname']}</td>
                            <td>{$row['lname']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['contact']}</td>
                            <td>{$row['doctor']}</td>
                            <td>P{$row['docFees']}</td>
                            <td>{$row['apptime']}</td>
                            <td>{$row['appdate']}</td>
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
             <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
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
                if(($row['userStatus']==1) && ($row['doctorStatus']==1) && ($row['adminStatus']==2))  
                { 
              ?>
             <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
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
              if (($row['userStatus']==1) && ($row['doctorStatus']==2) && ($row['adminStatus']==1)) 
              {
            ?>
              <a href="patient-requests.php?id=<?php echo $row['id']?>&update=update" 
              onClick="return confirm('Are you sure you want to update this appointment?')"
              title="Update Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Update</button>              
            </a>
            <td>
            <a href="patient-requests.php?id=<?php echo $row['id']?>&cancel=update" 
              onClick="return confirm('Are you sure you want to cancel this appointment?')"
              title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger">Cancel</button>              
            </a>
              </td>
              <?php
              }
            else 
            {
              echo "Done";
            }
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
*/?>
-->