<?php
  session_start();
  include 'includes/functions.php';
  $user = login($conn);

  if (!isset($_SESSION['id'])) 
  {
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Store</title>
        <?php include 'includes/header.php' ?>
    </head>
    <body>
        
        <?php include 'includes/navbar.php' ?>

            <div id='content' class='container'>
                <?php
                    if(!isset($_GET['cat']))
                    {
                        $get_products = "SELECT * from products ";
                    }
                    else
                    {
                        $category_id = $_GET['cat']; //apo to navbar
                        $get_products = "SELECT * from products where p_cat_id = $category_id ";
                    }
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
                                    <p class='button'>
                                        <a href='details.php?pro_id=<?php echo $pro_id?>' class='btn btn-primary'>
                                            <i class='fa fa-shopping-cart'>Add To Cart</i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                <?php } ?>
        </div>
    </body>
</html>