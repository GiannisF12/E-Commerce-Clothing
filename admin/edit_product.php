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
    
    if(isset($_GET['edit_product']))
    {
        
        $edit_id = $_GET['edit_product'];
        
        $get_p = "select * from products where product_id='$edit_id'";
        
        $run_edit = mysqli_query($conn,$get_p);
        
        $row_edit = mysqli_fetch_array($run_edit);
        
        $p_id = $row_edit['product_id'];
        
        $p_title = $row_edit['product_name'];
        
        $p_cat = $row_edit['p_cat_id'];
        
        $p_image1 = $row_edit['product_img1'];
        $p_image2 = $row_edit['product_img2'];
        $p_image3 = $row_edit['product_img3'];
        
        $p_size = $row_edit['product_size'];
        $p_price = $row_edit['product_price'];
        
        
    }
        
        
        $get_p_cat = "select * from product_cat where p_cat_id='$p_cat'";
        
        $run_p_cat = mysqli_query($conn,$get_p_cat);
        
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        
        $p_cat_title = $row_p_cat['p_cat_name'];

        $product_cat = $row_p_cat['p_cat_id'];
        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Product</title>
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
                                <i class="fa fa-money fa-fw"></i> Edit Product 
                            </h3>
                        </div>
                    
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Name </label> 
                                    <div class="col-md-6">
                                        <input name="product_title" type="text" class="form-control" required value="<?php echo $p_title; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Price </label> 
                                    <div class="col-md-6">
                                        <input name="product_price" type="text" class="form-control" required value="<?php echo $p_price; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Size </label> 
                                    <div class="col-md-6">
                                        <select name="product_size" type="text" class="form-control" required value="<?php echo $p_size; ?>">
                                            <option disabled value="Select Product Category">Select Product Size</option>
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
                                            <option disabled value="Select Product Category">Select Product Category</option>
                                            <option value="<?php echo $p_cat; ?>"> <?php echo $p_cat_title; ?> </option>
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
                                    <label class="col-md-3 control-label"> Product Image1 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img1" type="file" class="form-control" required>
                                        <img width="70" height="70" src="../img/<?php echo $p_image1; ?>" alt="<?php echo $p_image1; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Image2 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img2" type="file" class="form-control" required>
                                        <img width="70" height="70" src="../img/<?php echo $p_image2; ?>" alt="<?php echo $p_image2; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Product Image3 </label> 
                                    <div class="col-md-6">
                                        <input name="product_img3" type="file" class="form-control" required>
                                        <img width="70" height="70" src="../img/<?php echo $p_image3; ?>" alt="<?php echo $p_image3; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label> 
                                    <div class="col-md-6">
                                        <input name="update" value="Update Product" type="submit" class="btn btn-primary form-control">
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


<?php 

if(isset($_POST['update'])){
    
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];

    
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    
    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];
    $temp_name3 = $_FILES['product_img3']['tmp_name'];

    
    move_uploaded_file($temp_name,"../img/$product_img");

    
    $update_product = "update products set p_cat_id='$product_cat',product_name='$product_title',product_price='$product_price',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_size='$product_size' where product_id='$p_id'";
    
    $run_product = mysqli_query($conn,$update_product);
    
    if($run_product){
        
        echo "<script>alert('Product has been updated sucessfully')</script>";
        echo "<script>window.open('view_products.php','_self')</script>";
        
    }
    
}

?>

