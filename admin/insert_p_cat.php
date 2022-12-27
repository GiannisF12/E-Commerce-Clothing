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
    

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Insert Product Category</title>
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
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard / Insert Product Category
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Insert Product Category
                            </h3>
                        </div>
                        
                        <div class="panel-body">
                            <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label col-md-3">Product Category Title </label>
                                    <div class="col-md-6">
                                        <input name="p_cat_title" type="text" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="control-label col-md-3"></label>
                                    <div class="col-md-6">
                                        <input name="insert_p_cat" value="Insert" type="submit" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php insert_p_cat(); ?>
            
        </div>
    </body>
</html>
