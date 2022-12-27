<?php
  session_start();
  include 'includes/functions.php';
  $user = login($conn);

  if (!isset($_SESSION['id'])) 
  {
    header("Location: index.php");
  }



  if(isset($_GET['pro_id']))
  {
    
    $product_id = $_GET['pro_id'];
    
    $get_product = "select * from products where product_id='$product_id'";
    
    $run_product = mysqli_query($conn,$get_product);
    
    $row_product = mysqli_fetch_array($run_product);
    
    $p_cat_id = $row_product['p_cat_id'];
    
    $pro_title = $row_product['product_name'];
    
    $pro_price = $row_product['product_price'];
    
    $pro_img1 = $row_product['product_img1'];
    $pro_img2 = $row_product['product_img2'];
    $pro_img3 = $row_product['product_img3'];
    
    $get_p_cat = "select * from product_cat where p_cat_id='$p_cat_id'";
    

    

    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Details</title>
        <?php include 'includes/header.php' ?>
    </head>
    <body>
        
        <?php include 'includes/navbar.php' ?>

        <div id="content">
            <div class="container">
                <div class="col-md-9">
                    <div id="productMain" class="row">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active" ></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>
                                    
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <center><img class="img-responsive" src="img/<?php echo $pro_img1; ?>" alt="Product 3-a"></center>
                                        </div>
                                        <div class="item">
                                            <center><img class="img-responsive" src="img/<?php echo $pro_img2; ?>" alt="Product 3-b"></center>
                                        </div>
                                        <div class="item">
                                            <center><img class="img-responsive" src="img/<?php echo $pro_img3; ?>" alt="Product 3-c"></center>
                                        </div>
                                    </div>
                                    
                                    <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    
                                    <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="pro_title"> 
                                    <?php

                                    if(isset($_GET['pro_id']))
                                    {
                                        echo $pro_title; //gia na mhn emfanizei sfalma se periptwsh pou den exei oristei h metabliti eksetias ths taxititas ths GET[]
                                    }

                                  ?> 
                                </h1>
                                
                                <?php add_cart(); ?>
                                
                                <form action="details.php?add_cart=<?php echo $product_id; ?>" class="form-horizontal" method="POST"><!-- form-horizontal Begin -->
                                    <div class="form-group">
                                        <label for="" class="col-md-5 control-label">Products Quantity</label>
                                        
                                        <div class="col-md-7">
                                                <input type="number" name="product_qty" id="" class="form-control" value="1" min="1">

                                            </div>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Product Size</label>
                                        
                                        <div class="col-md-7">
                                            
                                            <select name="product_size" class="form-control" required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Must pick 1 size for the product')"><!-- form-control Begin -->
                                                <option value="Small">Small</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Large">Large</option>
                                                
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <label class="col-md-5 control-label" style="padding-top: 0;font-size:13pt;">Price</label>
                                    
                                    <p class="price"> <?php echo $pro_price; ?> €</p>
                                    
                                    <p class="text-center buttons"><button class="btn btn-primary i fa fa-shopping-cart"> Add to cart</button></p>
                                    
                                </form>
                                
                            </div>
                            
                            
                            
                        </div>
                        
                        
                    </div>
                    
                </div>
                
            </div>
        </div>


    </body>
</html>