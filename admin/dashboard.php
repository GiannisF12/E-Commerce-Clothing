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


    
                                    
    $countUsers;
    $countPro;
    $countCat;
    $queryCountUser = mysqli_query($conn,"SELECT COUNT(id) as total FROM users");
    $CountUserRes = mysqli_fetch_array($queryCountUser);
    $queryCountPro = mysqli_query($conn,"SELECT COUNT(product_id) as total FROM products");
    $CountProRes = mysqli_fetch_array($queryCountPro);
    $queryCountCat = mysqli_query($conn,"SELECT COUNT(p_cat_id) as total FROM product_cat");
    $CountCatRes = mysqli_fetch_array($queryCountCat);
    $countUsers = $CountUserRes['total'];     
    $countPro = $CountProRes['total'];                                
    $countCat = $CountCatRes['total'];     
                                 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <?php include 'includes/header.php'; ?>
    </head>
    <body>

        <?php
            include 'includes/navbar.php';
            include 'includes/sidebar.php'; 
        ?>
        
        <div class="content">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="view_users.php">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countUsers?> </div>
                                        <div> Users </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="view_products.php">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countPro?> </div>
                                        <div> Products </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="view_p_cat.php">
                        <div class="panel panel-orange">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tags fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $countCat ?> </div>
                                        <div> Product Categories </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo 0; ?> </div>
                                        <div> Orders </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>