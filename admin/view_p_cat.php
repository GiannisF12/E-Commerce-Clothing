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

    if(isset($_GET['delete_p_cat']))
    {
                    
        $delete_p_cat_id = $_GET['delete_p_cat'];

        $delete_p_cat = "delete from product_cat where p_cat_id='$delete_p_cat_id'";
        
        $run_delete = mysqli_query($conn,$delete_p_cat);
        
        if($run_delete){
            
            echo "<script>alert('One of your product has been Deleted')</script>";
            
            echo "<script>window.open('view_p_cat.php','_self')</script>";
            
        }
    }



?>
<html>
    <head>
        <title>Category List</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / View Product Categories
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags fa-fw"></i> View Product Categories
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Product Category ID </th>
                                            <th> Product Category Title </th>
                                            <th> Edit Product Category </th>
                                            <th> Delete Product Category </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                                            $i=0;
                                            $get_p_cats = "select * from product_cat";
                                            $run_p_cats = mysqli_query($conn,$get_p_cats);
                                            while($row_p_cats=mysqli_fetch_array($run_p_cats))
                                            {
                                                $p_cat_id = $row_p_cats['p_cat_id'];
                                                $p_cat_title = $row_p_cats['p_cat_name'];
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $p_cat_id; ?> </td>
                                                <td> <?php echo $p_cat_title; ?> </td>
                                                <td> 
                                                    <a href="view_p_cat.php?edit_p_cat= <?php echo $p_cat_id; ?> ">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </td>
                                                <td> 
                                                    <a href="view_p_cat.php?delete_p_cat= <?php echo $p_cat_id; ?> ">
                                                        <i class="fa fa-trash"></i> Delete
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
