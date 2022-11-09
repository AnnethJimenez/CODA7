<html lang="en">
  <head>
    <title>System Panel</title>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="admin-panel1"><img src="logo.png" style="width: 37px" alt=""/>CODA DEFENSE SYSTEM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
        <a class="nav-link" href="admin-panel1"></a>
      </li>
    </ul>
    <!-- Notification -->
    <ul class="navbar-nav ml-auto">
      <div class="dropdown">
        <a href="#" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="color: black;" class="nav-link notification-appointment-toggle dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <i class="fa fa-bell"></i></a>
          <div class="dropdown-menu "aria-labelledby="dropdownMenuButton"> 
            <h5 class="dropdown-header">Notification</h5>
            <ul class="notification-appointment "></ul>
            <div class="dropdown-divider"></div>
            <center><a class="dropdown-item" href="#">See all notification</a></center>
          </div>
      </div>
    </ul>
    <!-- Admin panel -->
     <ul class="navbar-nav mr-auto">
      <div class="dropdown">
            <a href="#" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="color: black" class="nav-link dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-user"></i> 
              <?php 
                echo $name;
              ?>
            </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">          
          <a class="dropdown-item" href="#list-cpassword" data-toggle="list"><i class="fa fa-key"></i> Change Password</a>
          <a class="dropdown-item" href="#add-superadmin" data-toggle="list"><i class="fa fa-user-plus"></i></i> Add Superadmin</a>
          <div class="dropdown-divider"></div>
          <a href="logout1" class="dropdown-item"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </ul>

  </div>
</nav>
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
<script>
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;
  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    } else {
    dropdownContent.style.display = "block";
    }
    });
  }
</script>
<!-- Test Code -->

<script>
  //Notification
  $(document).ready(function(){
  // updating the view with notifications using ajax
  function load_unseen_notification(view = '')
  {
   $.ajax({
    url:"appointment-fetch.php",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
     $('.notification-appointment').html(data.notification);
     if(data.unseen_notification > 0)
     {
      $('.count').html(data.unseen_notification);
     }
    }
   });
  }
  load_unseen_notification();
  $(document).on('click', '.notification-appointment-toggle', function(){
   $('.count').html('');
   load_unseen_notification('yes');
  });
  setInterval(function(){
   load_unseen_notification();;
  }, 5000);
  });
</script>

