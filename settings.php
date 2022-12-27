<?php 
    session_start();
    include 'includes/functions.php';
    $user = login($conn);

    if (!isset($_SESSION['id'])) 
    {
        header("Location: index.php");
    }

    if(isset($_GET['update_self']))
    {
        
        $edit_user = $_GET['update_self'];
        $get_user = "select * from users where id='$edit_user'";
        $run_user = mysqli_query($conn,$get_user);
        $row_user = mysqli_fetch_array($run_user);
        
        $user_id = $row_user['id'];
        $user_name = $row_user['username'];
        $user_pass = $row_user['password'];
        $user_email = $row_user['email'];
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Settings</title>
        <?php include 'includes/header.php' ?>
    </head>
    <body>
        
        <?php include 'includes/navbar.php' ?>
        
        <div class="profile">
            <h2>Profile Info</h2>
        </div>

        <div class="content"> 
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Username </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_name; ?>" name="username" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> E-mail </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_email; ?>"  name="email" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Password </label> 
                                    <div class="col-md-6">
                                        <input value="<?php echo $user_pass; ?>"  name="password" type="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="update" value="Update" type="submit" class="btn btn-primary form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php 

            if(isset($_POST['update']))
            {
                $user_name = $_POST['username'];
                $user_email = $_POST['email'];
                if($user_pass != $_POST['password'])
                {
                    $user_pass = md5($_POST['password']);
                }
                else
                {
                    $user_pass = $_POST['password'];
                }

            
                
                $update_user = "update users set username='$user_name',email='$user_email',password='$user_pass' where id='$user_id'";
                $run_user = mysqli_query($conn,$update_user);
                if($run_user)
                {
                    echo "<script>alert('User has been updated sucessfully')</script>";
                    echo "<script>window.open('settings.php','_self')</script>";
                }
                
            }
            ?>
        </div>


        
    </body>
</html>