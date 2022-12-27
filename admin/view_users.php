<?php 
    session_start();
    include 'includes/functions.php';
    $user = login($conn);

    if (!isset($_SESSION['id'])) 
    {
        header("Location: ../index.php");
    }

    if(($user['access'] != 'Admin') && ($user['access'] != 'Owner'))
    {
        header("Location: ../index.php");
    }

    //delete user

    if(isset($_GET['delete_user']))
    {
        $delete_user_id = $_GET['delete_user'];
        $delete_user = "delete from users where id='$delete_user_id'";
        $run_delete = mysqli_query($conn,$delete_user);
        if($run_delete){
            echo "<script>alert('User has been Deleted')</script>";
            echo "<script>window.open('view_users.php','_self')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User List</title>
        <?php include 'includes/header.php'; ?>
    </head>
    <body>
        <div>
            <?php
                include 'includes/navbar.php';
                include 'includes/sidebar.php'; 
            ?>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard / View Users
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags"></i>  View Users
                            </h3>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> ID: </th>
                                            <th> User Name: </th>
                                            <th> User Email: </th>
                                            <th> User Password: </th>
                                            <th> User Access: </th>
                                            <th> Date: </th>
                                            <th> Edit: </th>
                                            <th> Delete: </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $i=0;
                                            $get_users = "select * from users";
                                            $run_users = mysqli_query($conn,$get_users);

                                            while($row_users=mysqli_fetch_array($run_users))
                                            {
                                                $user_id = $row_users['id'];
                                                $user_name = $row_users['username'];
                                                $user_email = $row_users['email'];
                                                $user_pass = $row_users['password'];
                                                $user_access = $row_users['access'];
                                                $user_date = $row_users['date'];
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $user_id; ?> </td>
                                                <td> <?php echo $user_name; ?> </td>
                                                <td> <?php echo $user_email; ?> </td>
                                                <td> <?php echo $user_pass; ?></td>
                                                <td> <?php echo $user_access; ?> </td>
                                                <td> <?php echo $user_date; ?> </td>
                                                <td>    
                                                    <a href="edit_user.php?edit_user=<?php echo $user_id; ?>">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a> 
                                                </td>
                                                <td> 
                                                    <a href="view_users.php?delete_user=<?php echo $user_id; ?>">
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a> 
                                                </td>
                                            </tr>
                                        
                                        <?php } ?>
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
