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

    //delete product

    if(isset($_GET['delete_product']))
    {
                    
        $delete_id = $_GET['delete_product'];

        $delete_pro = "DELETE from products where product_id='$delete_id'";
        
        $run_delete = mysqli_query($conn,$delete_pro);

        //delete product from cart too

        $delete_cart = "DELETE from cart where p_id = '$delete_id' ";
        $run_delete_cart = mysqli_query($conn,$delete_cart);
        
        if($run_delete)
        {
            
            echo "<script>alert('One of your product has been Deleted')</script>";
            
            echo "<script>window.open('view_products.php','_self')</script>";
            
        }
    }


?>
<html>
    <head>
        <title>Product List</title>
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
                            <i class="fa fa-dashboard"></i> Dashboard / View Products
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-tags"></i>  View Products
                            </h3> 
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th> Product ID: </th>
                                            <th> Product Name: </th>
                                            <th> Product Image: </th>
                                            <th> Product Image: </th>
                                            <th> Product Image: </th>
                                            <th> Product Price: </th>
                                            <th> Product Category: </th>
                                            <th> Date: </th>
                                            <th> Product Delete: </th>
                                            <th> Product Edit: </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php 
                    
                                            $i=0;
                                            $get_pro = "SELECT * FROM products";
                                            $run_pro = mysqli_query($conn,$get_pro);
                    
                                            while($row_pro=mysqli_fetch_array($run_pro)){
                                                
                                                $pro_id = $row_pro['product_id'];
                                                $pro_title = $row_pro['product_name'];
                                                $pro_img1 = $row_pro['product_img1'];
                                                $pro_img2 = $row_pro['product_img2'];
                                                $pro_img3 = $row_pro['product_img3'];
                                                $pro_price = $row_pro['product_price'];
                                                $pro_cat = $row_pro['p_cat_id'];
                                                $pro_date = $row_pro['date'];
                                                $querry = mysqli_query($conn,"SELECT * FROM product_cat WHERE p_cat_id='$pro_cat'");
                                                $querry2 = mysqli_fetch_array($querry); 
                                        
                                        ?>
                                        
                                            <tr>
                                                <td> <?php echo $pro_id; ?> </td>
                                                <td> <?php echo $pro_title; ?> </td>
                                                <td> <img src="../img/<?php echo $pro_img1; ?>" width="60" height="auto"></td>
                                                <td> <img src="../img/<?php echo $pro_img2; ?>" width="60" height="auto"></td>
                                                <td> <img src="../img/<?php echo $pro_img3; ?>" width="60" height="auto"></td>
                                                <td> <?php echo $pro_price; ?> €</td>
                                                <td> 
                                                    <?php echo $querry2['p_cat_name']; ?>
                                                </td>
                                                <td> <?php echo $pro_date; ?></td>
                                                <td> 
                                                    <a href="view_products.php?delete_product=<?php echo $pro_id; ?>">
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a> 
                                                </td>
                                                <td>
                                                    <a href="edit_product.php?edit_product=<?php echo $pro_id; ?>">
                                                        <i class="fa fa-pencil"></i> Edit
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
