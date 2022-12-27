<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "complete";

$conn = mysqli_connect($server, $user, $pass, $database);

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

function insert_user() //insert_user.php
{
    global $conn;

    if(isset($_POST['insert_user']))
    {
        $user_name = $_POST['username'];
        $user_email = $_POST['email'];
        $user_pass = md5($_POST['password']);
        $user_access = $_POST['access'];
                
        $insert_user = "insert into users (username,email,password,access,date) values ('$user_name','$user_email','$user_pass','$user_access',NOW() )";
        $run_user = mysqli_query($conn,$insert_user);
        if($run_user)
        {
            echo "<script>alert('New User has been inserted sucessfully')</script>";
            echo "<script>window.open('view_users.php','_self')</script>";
        }
                
    }
}


function insert_product() //insert_product.php
{
    global $conn;

    if(isset($_POST['insert_product']))
    {
        $product_title = $_POST['product_title'];
        $product_price = $_POST['product_price'];
        $product_size = $_POST['product_size'];
        $product_cat = $_POST['product_cat'];

        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        $temp_name3 = $_FILES['product_img3']['tmp_name'];

        move_uploaded_file($temp_name1,"../img/$product_img1");

        $insert_product = "insert into products (p_cat_id,product_name,product_price,product_size,product_img1,product_img2,product_img3,date) values ('$product_cat','$product_title','$product_price','$product_size','$product_img1','$product_img2','$product_img3',NOW() )";
        
        $run_product = mysqli_query($conn,$insert_product);
        
        if($run_product)
        {
            
            echo "<script>alert('Product has been inserted sucessfully')</script>";
            echo "<script>window.open('view_products.php','_self')</script>";
            
        }
    
    }
}

function insert_p_cat() //insert_p_cat.php
{
    global $conn;

    if(isset($_POST['insert_p_cat']))
    {
        $p_cat_title = $_POST['p_cat_title'];
        $insert_p_cat = "insert into product_cat (p_cat_name) values ('$p_cat_title')";
        $run_p_cat = mysqli_query($conn,$insert_p_cat);
        if($run_p_cat)
        {
            echo "<script>alert('Your New Product Category Has Been Inserted')</script>";
            echo "<script>window.open('view_p_cat.php','_self')</script>";
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