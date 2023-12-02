<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
$connection = new mysqli('localhost:3307', '', '','etec_project');

if (!function_exists('register')) {
    session_start();
    function register() {
        global $connection;
        if(isset($_POST['btn_register'])){
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            $profile = $_FILES['profile']['name'];
            if(!empty($username) && !empty($email) && !empty($password) && !empty($profile)){
                $profile = date('dmyhis').'-'.$profile;
                $path = './assets/image/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'], $path);
                $password = md5($password);
                $sql = "INSERT INTO `user`(`username`, `email`, `password`, `profile`) 
                        VALUES ('$username','$email','$password','$profile')";
                $result = $connection->query($sql);
                if($result){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Register Successfully!",
                                text: "Data has been Insert.",
                                icon: "success",
                                button: "OK",
                              });
                        })
                    </script>
                    ';
                }
            }else{
                echo '
                <script>
                        $(document).ready(function(){
                            swal({
                                title: "Something went wrong!",
                                text: "Please fill all blank.",
                                icon: "error",
                                button: "OK",
                              });
                        })
                    </script>
                ';
            }
        }
    }
    register();


    //Login account

function login_acc(){
    global $connection;
    if(isset($_POST['btn_login'])){
       $name_email = $_POST['name_email'];
       $password = $_POST['password'];
       $password = md5($password);
       if(!empty($name_email) && !empty($password) ){
            $sql = "SELECT id FROM `user` WHERE (`username`='$name_email' OR `email`='$name_email') AND `password`='$password'";
            $result = $connection->query($sql);
            $row = mysqli_fetch_assoc($result);
              if(!empty($row)){
               $_SESSION['user'] = $row['id'];
               header('location: index.php');
              }else{
               echo '
               <script>
                       $(document).ready(function(){
                           swal({
                               title: "Something went wrong!",
                               text: "Please fill all blank.",
                               icon: "error",
                               button: "OK",
                             });
                       })
                   </script>
               ';
           }
       }
    }

}
login_acc();

function logout_acc(){
    global $connection;
    if(isset($_POST['accept_logout'])){
        unset($_SESSION['user']);
        header('location: login.php');
    }
}
logout_acc();


function addLogo(){
    global $connection;
    if(isset($_POST['save_logo'])){
        $show_on = $_POST['showOn'];
        $thumbnail = $_FILES['thumbnail']['name'];
        if(!empty($show_on) && !empty($thumbnail)){
            $thumbnail = date('dmyhis').'-'.$thumbnail;
            $path = './assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
            $sql = "INSERT INTO `logo`(`thumbnail`, `status`) VALUES ('$thumbnail','$show_on')";
            $result = $connection->query($sql);
            if($result){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Add Successfully!",
                            text: "Data has been Insert.",
                            icon: "success",
                            button: "OK",
                          });
                    })
                </script>
                ';
            }
        }
    }
}
addLogo();

function getProfile(){
    global $connection;
    $user_id = $_SESSION['user'];
    $sql ="SELECT * FROM `user` WHERE id ='$user_id'";
    $result = $connection->query($sql);
    if($row = $result->fetch_assoc()){
        $username = $row["username"];
        $profile = $row["profile"];
       echo '
            <img src="./assets/image/'.$profile.'" width="40px" height="40px" style="object-fit: cover" alt="">  
            <h6>Welcome Admin '.$username.'</h6>
       ';
    }
}



function getLogo(){
    global $connection;
    $sql = "SELECT * FROM `logo`";
    $result = $connection->query($sql); 
    while($row = mysqli_fetch_assoc($result)){
        $id = $row["id"];
        $status = $row["status"];
        $thumbnail = $row["thumbnail"];
        echo '
        <tr>
             <td>'.$id.'</td>
            <td>'.$status.'</td>
            <td>
                <img src="./assets/image/'.$thumbnail.'" width="50px" height="50px" style="object-fit: cover;" alt="">
            </td>
            
            <td width="150px">
                <a href="./update-logo.php?id='.$id.'" class="btn btn-primary">Update</a>
                <button name="deletelogo" type="button" remove-id="'.$id.'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Remove
                </button>
            </td>
        </tr>
            ';
    }
}

function deleteLogo(){
    global $connection;
    if(isset($_POST['accept_deletelogo'])){
       $id = $_POST['remove_id'];
       $sql = "DELETE FROM `logo` WHERE `id`=$id";
       $result = $connection->query($sql);
       if($result){
        echo '
        <script>
            $(document).ready(function(){
                swal({
                    title: "Deleted Successfully!",
                    text: "Data has been deleted.",
                    icon: "success",
                    button: "OK",
                  });
            })
        </script>
        ';
    }
    }
}
deleteLogo();

function updateLogo(){
    global $connection;
    if(isset($_POST['accept_update'])){
        $show_on = $_POST['showOn'];
        $thumbnail = $_FILES['thumbnail']['name'];
        $id = $_GET['id'];
        if(empty($thumbnail)){
            $thumbnail = $_POST['old_logo'];
        }else{
            $thumbnail = date('dmyhis').'-'.$thumbnail;
            $path = './assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
        }
        if(!empty($show_on) && !empty($thumbnail)){
            
            $sql = "UPDATE `logo` SET `thumbnail`='$thumbnail',`status`='$show_on' WHERE id=$id";
            $result = $connection->query($sql);
            if($result){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Updated Successfully!",
                            text: "Data has been Insert.",
                            icon: "success",
                            button: "OK",
                          });
                    })
                </script>
                ';
            }
        }
    }
}
updateLogo();


function addNews(){
    global $connection;
    if(isset($_POST['accept_add'])){
        
         $title = $_POST['title'];
         $type = $_POST['type'];
         $category = $_POST['category'];
         $thumbnail = $_FILES['thumbnail']['name'];
         $banner = $_FILES['banner']['name'];
         $desc = $_POST['description'];
         $author = $_SESSION['user'];
        if(!empty($title) && !empty( $type) && !empty($category) && !empty($thumbnail) && !empty($banner) && !empty($desc)){
            
            $thumbnail = date('dmyhis').'-'.$thumbnail;
            $banner =date('dmyhis').'-'.$banner;
            $path_thumbnail = './assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path_thumbnail);
            $path_banner = './assets/image/'.$banner;
            move_uploaded_file($_FILES['banner']['tmp_name'], $path_banner);
            $sql = "INSERT INTO `news`( `author_id`, `banner`, `thumbnail`, `title`, `description`, `category`, `type`) 
                    VALUES ('$author','$banner','$thumbnail','$title','$desc','$category','$type')";
            $result = $connection->query($sql);
            if($result){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Add Successfully!",
                            text: "Data has been Insert.",
                            icon: "success",
                            button: "OK",
                          });
                    })
                </script>
                ';
            }
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "Add Failed!",
                        text: "Please fill all blanks.",
                        icon: "error",
                        button: "OK",
                      });
                })
            </script>
            ';
        }
    }

}
addNews();

function getNews(){
    global $connection;
    $sql = "SELECT * FROM `news` ORDER BY id";
    $result = $connection->query($sql);
    while($row = $result->fetch_assoc()){
        $id        = $row['id'];
        $title     = $row['title'];
        $type      = $row['type'];
        $category  = $row['category'];
        $thumbnail = $row['thumbnail'];
        $view      = $row['view'];
        $post_by   = $row['author_id'];
        $date      = $row['create_at'];
        echo '
            <tr>
                <td>'.$id.'</td>
                 <td>'.$title.'</td>
                 <td>'.$type.'</td>
                 <td>'.$category.'</td>
                 <td><img src="./assets/image/'.$thumbnail.'" width="60px" height="60px" style="object-fit: cover"></td>
                 <td>'.$view.'</td>
                 <td>'.$post_by.'</td>
                 <td>'.$date.'</td>
                 <td width="150px">
                     <a href="update-news.php?id='.$id.'"class="btn btn-primary">Update</a>
                     <button type="button" remove-id="'.$id.'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         Remove
                     </button>
                   </td>
             </tr>
        ';

    }
}


function deleteNews(){
    global $connection;
    if(isset($_POST['accept_delete'])){
       $delete_id = $_POST['remove_id'];
       $sql = "DELETE FROM `news` WHERE id = $delete_id";
       $result = $connection->query($sql);
       if($result){
        echo '
        <script>
            $(document).ready(function(){
                swal({
                    title: "Delete Successfully!",
                    text: "Data has been Deleted.",
                    icon: "success",
                    button: "OK",
                  });
            })
        </script>
        ';
    }else{
        echo '
        <script>
            $(document).ready(function(){
                swal({
                    title: "Delete failed! ",
                    text: "Try again.",
                    icon: "error",
                    button: "OK",
                  });
            })
        </script>
        ';
    
        }
}
}
deleteNews();

function updateNews(){
    global $connection;
    if(isset($_POST['accept_update_news'])){
        $title = $_POST['title'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $thumbnail = $_FILES['news_thumbnail']['name'];
        $banner = $_FILES['news_banner']['name'];
        $description = $_POST['description'];
        $id = $_GET['id'];
        if(empty($thumbnail)){
            $thumbnail = $_POST['old_news_thumbnail'];
        }else{
            $thumbnail = date('dmyhis').'-'.$thumbnail;
            $path_thumbnail = './assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['news_thumbnail']['tmp_name'], $path_thumbnail);
            
        }

        if(empty($banner)){
            $banner = $_POST['old_news_banner'];
        }else{
            $banner =date('dmyhis').'-'.$banner;
            $path_banner = './assets/image/'.$banner;
            move_uploaded_file($_FILES['news_banner']['tmp_name'], $path_banner);
        }

        if(!empty($title) && !empty($type) && !empty($category) && !empty($thumbnail) && !empty($banner) && !empty($description)){
            $sql = "UPDATE `news` SET `banner`='$banner',`thumbnail`='$thumbnail',`title`='$title',`description`='$description',`category`='$category',`type`='$type'WHERE id = '$id'";
            $result = $connection->query($sql);
            if($result){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Update Successfully!",
                            text: "Data has been Updated.",
                            icon: "success",
                            button: "OK",
                          });
                    })
                </script>
                ';
            }
        }else{
            echo '
            <script>
                $(document).ready(function(){
                    swal({
                        title: "Update Failed!",
                        text: "Please try again.",
                        icon: "error",
                        button: "OK",
                      });
                })
            </script>
            ';
        
        }
    }

}
updateNews();

}//exist_function avoid


















?>