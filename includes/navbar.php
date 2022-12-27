

<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-th-list"></span> Adidas Store</a>
                </div>
                

                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <?php if($user!=0): ?>
                        <li><a href="store.php"><span class="glyphicon glyphicon-th-list"></span> Products</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="store.php"><span class="glyphicon glyphicon-search"></span> Product Categories<span class="caret"></span></a>
                            <ul class="dropdown-menu">

                                <?php
                                    $get_cat = "SELECT * from product_cat ";
                                    $run_cat = mysqli_query($conn,$get_cat);
                                    while($row_cat=mysqli_fetch_array($run_cat))
                                    {
                                        $cat_name = $row_cat['p_cat_name'];
                                        $cat_id = $row_cat['p_cat_id'];
                                ?>

                                        <li><a href="store.php?cat=<?php echo $cat_id ?>"><?php echo $cat_name ?></a></li>
                                <?php } ?>


                            </ul>
                        </li>
                    <?php endif ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if($user!=0): ?>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo " " . $user['username']; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                            <?php 
                                $user_id = $user['id'];
                                $user_name = $user['username'];
                                $user_email = $user['email'];
                                $user_pass = $user['password'];
                            ?>
                                        
                            <li><a href="settings.php?update_self=<?php echo $user_id; ?>">Settings</a></li>
                                
                                <?php if(($user['access'] == 'Admin') || ($user['access'] == 'Owner')): ?>
                                    <li><a href="admin/dashboard.php">Admin</a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                        <li><a href="includes/logout.php"><span class="glyphicon glyphicon-log-in"></span>  Logout</a></li>
                        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart [ <?php echo count_cart(); ?> ]</a></li>
                    <?php else: ?>
                        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>  Login</a></li>
                        <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                    <?php endif ?>
                </ul>
            </div>
            <div class="background"></div>
</nav>
