<?php

  session_start();
  include 'includes/functions.php';
  $user = login($conn);
  $user_id = $user['id'];

  if (!isset($_SESSION['id'])) 
  {
      header("Location: index.php");
  }

  if(isset($_POST['delete']))
    {
                    
        $delete_id = $_POST['delete'];

        $delete_pro = "DELETE from cart where cart.p_id='$delete_id' and cart.user_id = $user_id";
        
        $run_delete = mysqli_query($conn,$delete_pro);
        
        if($run_delete)
        {
            
            echo "<script>alert('One of your product has been Deleted')</script>";
            
            echo "<script>window.open('cart.php','_self')</script>";
            
        }
    }
    if(isset($_POST['AddQuan'])){
        $Add_pro_ID = $_POST['AddQuan'];
        $queryRes = mysqli_query($conn,"SELECT * FROM cart WHERE cart.user_id = $user_id AND cart.p_id = $Add_pro_ID");
        $rowRes = mysqli_fetch_array($queryRes);
        $NewQuan = $rowRes['quantity']+1;
        $AddQuery = "UPDATE cart SET cart.quantity=$NewQuan WHERE cart.p_id = $Add_pro_ID AND cart.user_id = $user_id";
        mysqli_query($conn,$AddQuery);
        header("Location: cart.php");
    }

    if(isset($_POST['RemQuan'])){
        $delete_pro_ID = $_POST['RemQuan'];
        $queryRes = mysqli_query($conn,"SELECT * FROM cart WHERE cart.user_id = $user_id AND cart.p_id = $delete_pro_ID");
        $rowRes = mysqli_fetch_array($queryRes);
        $Quan = $rowRes['quantity'];
        if($Quan>1){
            $NewQuan = $rowRes['quantity']-1;
            $REMQuery = "UPDATE cart SET cart.quantity=$NewQuan WHERE cart.p_id = $delete_pro_ID AND cart.user_id = $user_id";
            mysqli_query($conn,$REMQuery);
        }else{
            $REMQuery = "DELETE FROM cart WHERE cart.p_id = $delete_pro_ID AND cart.user_id = $user_id";
            mysqli_query($conn,$REMQuery);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cart</title>
        <?php include 'includes/header.php' ?>
        
    </head>
    <body>
        
        <?php include 'includes/navbar.php' ?>
        <?php cart(); ?>
        
    </body>
</html>