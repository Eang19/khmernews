<?php 
    include('sidebar.php');
    include('function.php');
    $id = $_GET['id'];
    $sql ="SELECT * FROM `logo` WHERE `id`=$id";
    $result = $connection->query($sql);
    $row = mysqli_fetch_assoc($result);
    $Header = '';
    $Footer = '';
    if ($row['status'] == 'Header'){
        $Header = 'selected';
    }else{
        $Footer = 'selected';
    }

    $thumbnail = $row['thumbnail'];
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label>Show on</label>
                                        <select name="showOn" class="form-select">
                                            <option value="Header" <?php echo $Header?>>Header</option>
                                            <option value="Footer" <?php echo $Footer?>>Footer</option>
                                        </select>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label>File</label>
                                        <input name="thumbnail" type="file" class="form-control">
                                        <img src="./assets/image/<?php echo $thumbnail?>" alt="" width="60px" height="60px" style="object-fit: cover">
                                        <input type="hidden" name="old_logo" id="old_thumbnail" value="<?php echo $thumbnail?>">
                                     </div>
                                    <div class="form-group">
                                        <button name="accept_update" type="submit" class="btn btn-primary">Update</button>
                                        <a href="index.php" type="submit" class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>