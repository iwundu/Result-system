<?php
session_start();
require("connection.php");
require("input_validation.php");
//check if admin is logged  in or not //

if(isset($_SESSION['username']) == false){
    header("location:index.php");
    exit();
}else{
$query = "SELECT * FROM admin WHERE uname = '".$_SESSION['username']."'";
$result = mysqli_query($conn,$query) or die("unable to query");
$row = mysqli_fetch_assoc($result);
}

$error = "";
if(isset($_POST['submit'])){
    
//INPUT STRINGS //
    $fname = checker($conn,$_POST['fname']);
    $uname = checker($conn,$_POST['uname']);
    $address = checker($conn,$_POST['address']);
    $phone = checker($conn,$_POST['phone']);
    $password = checker($conn,$_POST['password']);
    $email = checker($conn,$_POST['email']);
    
    //error handler //
    
    if(empty($fname)){
        $error .= '<div class="alert alert-danger" role="alert"> Full name is Required!
</div>';
    }
    if(empty($uname)){
        $error .= '<div class="alert alert-danger" role="alert"> Username is Required!
</div>';
    }
    if(empty($password)){
        $error .= '<div class="alert alert-danger" role="alert">  Password is Required!
</div>';
    }
    if(empty($email)){
        $error .= '<div class="alert alert-danger" role="alert"> Email is Required!
</div>';
    }
    if(empty($address)){
        $error .= '<div class="alert alert-danger" role="alert"> Address is Required!
</div>';
    }
    if(empty($phone)){
        $error .= '<div class="alert alert-danger" role="alert"> Phone Number is Required!
</div>';
    }
    
    //check if there are errors in the form //
    if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"> There were error(s) in your Form!'.$error.
'</div>';
    }else{
         
        $query = "INSERT INTO users(fname,uname,password,address,phone,email)
        VALUES('$fname','$uname','$password','$address','$phone','$email')";
        
        $result = mysqli_query($conn, $query);

        //check  if query was successful //
        
        if($result == false){
        $error = '<div class="alert alert-danger" role="alert"> Could not Register You - Please try again later.</div>';
        
    }else{
            $error = '<div class="alert alert-success" role="alert"> Registered Successfuly - Proceed to your profile </div>';
    }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Admin</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style4.css">
        <link rel="stylesheet" href="styles2.css">
    </head>
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
                        <a href="adminHome.php">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Academics
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="uploadResult.php">Results</a></li>
                            <li><a href="add_student.php">Student</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="add_user.php">
                            <i class="glyphicon glyphicon-user"></i>
                            Add User
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

                <div class="line"></div>
                <h1 class="display-4 text-center text-primary">USERS REGISTRATION</h1>
          <form method="post">
                  <div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" class="form-control" name="fname" id="Name" aria-describedby="emailHelp" placeholder="Enter Full Name">
      </div>
        <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" placeholder="Enter Username" name="uname">
            <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
      </div>
              <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
        <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Address..." name="address"></textarea>
  </div>
         <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" placeholder="Enter Phone Number" name="phone">
      </div>
                 
  <button type="submit" class="btn btn-primary btn-lg" name="submit">Register</button>
                  <?php echo $error; ?>
</form>

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
