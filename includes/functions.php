<?php


$conn = mysqli_connect("localhost", "root", "", "complete");

if (!$conn) 
{
    die("<script>alert('Connection Failed.')</script>");
}



function login($conn)
{
    if(isset($_SESSION['id'])) //tsekarei an exei dedomena
    {
        $id=$_SESSION['id'];
    
        $sql = " SELECT * FROM users WHERE users.id=$id "; //epilegei ton xrhsth pou eimaste sindedemenoi
        $result = mysqli_query($conn, $sql); // ektelei to erwtima sql
        if ($result->num_rows > 0) // an uparxei panw apo 0 seires diladi apotelesma
        {
            $row = mysqli_fetch_assoc($result); //pinaka me seira kai ton bazei se seira
            return $row;
        }
        else
        {
            return 0; // simainei den eimaste sindedemenei se xrhsth
        } 
    }
    else
    {
        return 0; // simainei den eimaste sindedemenei se xrhsth
    }
    
}


//for the cart
function cart()
{
    $total_price_cart = 0;
    
    global $conn;
    global $user;
    $user_id = $user['id'];
    
    $get_products = "SELECT * from cart where cart.user_id = $user_id order by id ";
    
    $run_products = mysqli_query($conn,$get_products);
    
    ?>
        <table id='customersTable'>
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Size</th>
                <th>Total Price</th>
                <th>Delete</th>
            </tr>
    <?php
    
    while($row_products=mysqli_fetch_array($run_products))
    {
        $pro_id = $row_products['p_id'];
        $select_pro = mysqli_query($conn,"SELECT * from products where products.product_id = $pro_id ");
        $result_cart = mysqli_fetch_array($select_pro);
        
        $product_id = $result_cart['product_id'];
        
        $pro_title = $result_cart['product_name'];
        
        $pro_price = $result_cart['product_price'];
        $pro_img1 = $result_cart['product_img1'];
        $pro_size = $row_products['size'];
        $pro_quantity = $row_products['quantity'];
        $pro_total_price = $pro_price * $pro_quantity;
        $total_price_cart = $total_price_cart + $pro_total_price;
        
        ?>
        <form action = 'cart.php' method = 'POST' >
            <tr id='customers'>
                <td><center><img class='img-responsive' src='img/<?=$pro_img1?>' alt='Product 1'></center></td>
                <td><?=$pro_title?></td>
                <td>
                    <div style="display:flex; align-items:center;justify-content:center;gap:3px;">
                            <button type="submit" name="RemQuan" value="<?=$pro_id?>" class="addRemButtons">-</button>
                            <?=$pro_quantity?>
                            <button type="submit" name="AddQuan" value="<?=$pro_id?>" class="addRemButtons">+</button>
                    </div>
                </td>
                <td><?php echo $pro_price; ?> €</td>
                <td><?php echo $pro_size; ?></td>
                <td><?php echo $pro_total_price;?> €</td>
                <td>
                    <button class='btn btn-primary' type = 'submit' name = 'delete' value = '<?php echo $product_id; ?>'>Delete</button>
                </td>
                
            </tr>
        </form>
        
        <?php
    }

    ?>
    </table>
    <div class = "total_price">Total Price: <?=$total_price_cart?> €</div>
        <div class="box-footer">
            <center><a href="store.php" class="btn btn-default" id="right" ><i class="fa fa-chevron-left"></i> Continue Shopping</a>
            <a href="cart.php" class="btn btn-default" id="right"><i class="fa fa-refresh"></i> Update Cart</a>
            <a href="#" class="btn btn-primary" id="right" >Proceed Checkout <i class="fa fa-chevron-right"></i></a></center>             
        </div>
    <?php
}


function add_cart()
{
    global $user;
    $user_id = $user['id'];
    global $conn;
    
    if(isset($_GET['add_cart']))
    {
        
        
        $p_id = $_GET['add_cart'];
        
        $product_qty = $_POST['product_qty'];
        
        $product_size = $_POST['product_size'];
        
        $check_product = "SELECT * FROM cart WHERE cart.p_id = $p_id AND cart.user_id = $user_id ";
        
        $run_check = mysqli_query($conn,$check_product);
        
        if(mysqli_num_rows($run_check)>0)
        {
            
            echo "<script>alert('This product has already added in cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }
        else
        {
            
            $query = "INSERT INTO cart (p_id,user_id,quantity,size) values ($p_id,$user_id,$product_qty,'$product_size')";
            
            $run_query = mysqli_query($conn,$query);
            echo "<script>alert('This product has added to your cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }
        
    }
    
}


function count_cart()
{
    global $user;
    $user_id = $user['id'];
    
    global $conn;
    
    $count = "SELECT * FROM cart WHERE user_id = $user_id ";
    
    
    $run_items = mysqli_query($conn,$count);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

?>