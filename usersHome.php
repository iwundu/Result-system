<?php
session_start();
require("connection.php");
require("registeredUser.php");

//check if admin is logged  in or not //

if(isset($_SESSION['username']) == false){
    header("location:index.php");
    exit();
}
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Users</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style4.css">
        
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                   <img src="images/logo.jpg" class="img-circle img-responsive" width="60" height="50">
                </div>

                <ul class="list-unstyled components">
                     <li class="active">
                        <a href="usersHome.php">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>
                    </li>
                    
                    <li>
                        <a href="studentResult.php">
                            <i class="glyphicon glyphicon-user"></i>
                            View Results
                        </a>
                    </li>
                   
                    <li>
                        
                </ul>

                <ul class="list-unstyled CTAs">
                        <li><a href="logout.php" class="article">Logout</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <span class="glyphicon glyphicon-th-list"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                 <li><a href="#"><?php echo "<b style='color:green';>"; echo "Welcome ".$row['uname']."!"; echo "</b>"; ?></a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
<div class="container" style="padding-top:3rem; padding-bottom:1rem;" id="profile">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <thead><b class="lead" style="font-size:2rem">Users Details</b></thead>
                            <thead>
                
          </thead>
                        </tr>
              <tr>
                  <th>Full Name</th>
                  <td><?php echo $row['fname']; ?></td>
                        </tr>
                        <tr>
                  <th>Username</th>
                            <td><?php echo $row['uname']; ?></td>
                        </tr>
						<tr>
                              <th>Password</th>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                        
                        <tr>
                  <th>Email</th>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                   
                        <tr>
                  <th>Address</th>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                        <tr>
                  <th>Phone</th>
                            <td><?php echo $row['phone']; ?></td>
                        </tr>
                        </table>
                     </div>
                
                <div class="line"></div>
				                
				<div class="line"></div>

                <?php
                require("footer.php");
                ?>
            </div>
        </div>

        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
