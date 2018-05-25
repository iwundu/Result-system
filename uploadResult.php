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
    $sname = checker($conn,$_POST['sname']);
    $class = checker($conn,$_POST['class']);
    $session = checker($conn,$_POST['session']);
    $term = checker($conn,$_POST['term']);
    
    //FILES TO UPLOAD STRINGS //
    $target_loc = "result/";
    $target_file = $_FILES['file']['name'];
    $target_dir = $_FILES['file']['tmp_name'];
    $location = $target_loc.$target_file;
    //error handler //
    
    if(empty($sname)){
        $error .= '<div class="alert alert-danger" role="alert"> Student name is Required!
</div>';
    }
    if(empty($term)){
        $error .= '<div class="alert alert-danger" role="alert"> Term can not be Empty!
</div>';
    }
    if(empty($session)){
        $error .= '<div class="alert alert-danger" role="alert"> Session can not be Empty!
</div>';
    }
    if(empty($class)){
        $error .= '<div class="alert alert-danger" role="alert"> A Class is Required!
</div>';
    }
    
    //image error handler //
    if(empty($target_file)){
        $error .= '<div class="alert alert-danger" role="alert"> Result File is Required!
</div>';
    }
    
    //check if there are errors in the form //
    if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"> There were error(s) in your Form!'.$error.
'</div>';
    }else{
        
        move_uploaded_file($target_dir,$location);     
        $query = "INSERT INTO result(sname,class,term,session,result)
        VALUES('$sname','$class','$term','$session','$target_file')";
        
        $result = mysqli_query($conn, $query);

        //check  if query was successful //
        
        if($result == false){
        $error = '<div class="alert alert-danger" role="alert"> Could not Upload Result - Please try again later.</div>';
        
    }else{
            $error = '<div class="alert alert-success" role="alert"> <a href="view_result.php">Result Uploaded Successfuly - Proceed to View Result </a></div>';
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

        <title>UploadResult</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style4.css">
        <link rel="stylesheet" href="styles2.css">
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
                            <li><a href="viewResult.php">View Results</a></li>
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
                <h1 class="display-4 text-center text-primary">UPLOAD RESULT</h1>
         <form method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-12">
      <label for="inputEmail4">Student Name</label>
      <input type="text" class="form-control" name="sname" placeholder="Student Name">
      </div>
    <div class="form-row">
        <div class="form-group col-md-3">
      <label for="inputZip">Class</label>
       <select class="form-control" id="exampleFormControlSelect1" name="class">
      <option>JS1A</option>
      <option>JS1B</option>
      <option>JS1C</option>
      <option>JS1D</option>
      <option>JS1E</option>
        <option>JS2A</option>
      <option>JS2B</option>
      <option>JS2C</option>
      <option>JS2D</option>
      <option>JS2E</option>
        <option>JS3A</option>
      <option>JS3B</option>
      <option>JS3C</option>
      <option>JS3D</option>
      <option>JS3E</option>
        <option>SS1A</option>
      <option>SS1B</option>
      <option>SS1C</option>
      <option>SS1D</option>
      <option>SS1E</option>
        <option>SS2A</option>
      <option>SS2B</option>
      <option>SS2C</option>
      <option>SS2D</option>
      <option>SS2E</option>
        <option>SS3A</option>
      <option>SS3B</option>
      <option>SS3C</option>
      <option>SS3D</option>
        </select>
    </div>
        <div class="form-group col-md-3">
      <label for="inputZip">Session</label>
      <input type="text" class="form-control" name="session">
    </div>

        <div class="form-group col-md-3">
      <label for="inputZip">Term</label>
       <select class="form-control" id="exampleFormControlSelect1" name="term">
      <option>1st Term</option>
      <option>2nd Term</option>
      <option>3rd Term</option>
        </select>
        </div>
        <div class="form-group col-md-3">
      <div class="form-group">
    <label for="exampleFormControlFile1">Result</label>
    <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
  </div> 
        </div>

  </div>
    </div>
  <button type="submit" class="btn btn-danger" name="submit">Upload Result</button>
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
