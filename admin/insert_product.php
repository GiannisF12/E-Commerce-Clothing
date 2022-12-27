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
        <title>Insert Product</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / Insert Products
                        </li>
                    </ol>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i> Insert Product 
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Name </label> 
                                    <div class="col-md-6">
                                        <input name="product_title" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Price </label> 
                                    <div class="col-md-6">
                                        <input name="product_price" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Size </label> 
                                    <div class="col-md-6">
                                        <select name="product_size" class="form-control">
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Category </label> 
                                    <div class="col-md-6">
                                        <select name="product_cat" class="form-control">
                                            <?php

                                                $get_p_cats = "select * from product_cat";
                                                $run_p_cats = mysqli_query($conn,$get_p_cats);
                                                
                                                while ($row_p_cats=mysqli_fetch_array($run_p_cats))
                                                {
                                                    $p_cat_id = $row_p_cats['p_cat_id'];
                                                    $p_cat_title = $row_p_cats['p_cat_name'];
                                                    echo "<option value='$p_cat_id'> $p_cat_title </option>";
                                                }

                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Image 1 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img1" type="file" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Image 2 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img2" type="file" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Image 3 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img3" type="file" class="form-control" required>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="insert_product" value="Insert Product" type="submit" class="btn btn-primary form-control">
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<?php insert_product(); ?>

