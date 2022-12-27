<?php
ob_start();
session_start();
include 'includes/functions.php';
$user = login($conn);
?>

<!DOCTYPE >
<html lang="en">
    <head>
        <title>Home</title>
        <?php include 'includes/header.php' ?>
    </head>
    <body>
        
        <?php include 'includes/navbar.php' ?>

        <br>
        <h2>Latest Products</h2>
        

        <div id='content' class='container'>
            <?php
                $get_products = "SELECT * from products order by 1 DESC LIMIT 0,3";
                $run_products = mysqli_query($conn,$get_products);
                while($row_products=mysqli_fetch_array($run_products))
                {
                    $pro_id = $row_products['product_id'];
                    $pro_title = $row_products['product_name'];
                    $pro_price = $row_products['product_price'];
                    $pro_img1 = $row_products['product_img1'];
                
            ?>
                    <div class='col-sm-4 col-sm-6'>
                        <div class="product">
                            <img class="img-responsive" src="img/<?php echo $pro_img1 ?>" alt="Product"></img>
                            <div class="text">
                                <h3><?php echo $pro_title ?></h3>
                                <p class="price"><?php echo $pro_price ?> €</p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </body>
</html>
