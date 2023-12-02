<?php 
    
    include('sidebar.php');
    include('function.php');
    $news_id = $_GET['id'];
    $sql = "SELECT * FROM `news` WHERE id = '$news_id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $select_national='';
    $select_international='';
    $select_sport='';
    $select_social='';
    $select_entertainment='';
    if($row['type']== 'National'){
        $select_national= 'selected';
    }else{
        $select_international= 'selected';
    }

    if($row['category']== 'Sport'){
        $select_sport= 'selected';
    }else if($row['category']== 'Social'){
        $select_social= 'selected';
    }else{
        $select_entertainment= 'selected';
    }

    $thumbnail = $row['thumbnail'];
    $banner = $row['banner'];
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo $row['title']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" class="form-select">
                                            <option value="National" <?php echo $select_national?>>National</option>
                                            <option value="Internation" <?php echo $select_international?>>International</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-select">
                                            <option value="Sport" <?php echo $select_sport?>>Sport</option>
                                            <option value="Social" <?php echo $select_social?>>Social </option>
                                            <option value="Entertainment" <?php echo $select_entertainment?>>Entertainment</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input name="news_thumbnail" type="file" class="form-control">
                                        <img src="./assets/image/<?php echo $row['thumbnail']?>" width="80px" height="80px" alt="">
                                        <input type="hidden" name="old_news_thumbnail" id="old_thumbnail" value="<?php echo $thumbnail?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner</label>
                                        <input name="news_banner" type="file" class="form-control">
                                        <img src="./assets/image/<?php echo $row['banner']?>" width="80px" height="80px" alt="">
                                        <input type="hidden" name="old_news_banner" id="old_banner" value="<?php echo $banner?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="accept_add" class="btn btn-primary">Add News</button>
                                        <button type="submit" name="accept_update_news" class="btn btn-success">Update</button>
                                        <button type="submit" class="btn btn-danger">Danger</button>
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