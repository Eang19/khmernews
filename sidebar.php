<!DOCTYPE html>
<?php include('function.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- @tinyACE -->
    <script src="https://cdn.tiny.cloud/1/5gqcgv8u6c8ejg1eg27ziagpv8d8uricc4gc9rhkbasi2nc4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        
                        <div class="wrap-center">
                           <!-- <img src="./assets/image/'.$pic.'" width="40px" height="40px" style="object-fit: cover" alt="">  
                           <h6>Welcome Admin '.$name.'</h6> -->
                           <?php getProfile()?>
                              
                       </div>
                       
                        <div class="wrap-bottom">
                            <ul>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>LOGO</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-logo.php">View Post</a>
                                            <a href="add-logo.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Add New Content</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-news.php">View Post</a>
                                            <a href="add-news.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="parent">
                                    <a class="parent" href="logout.php">
                                        <span>LOGOUT</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               