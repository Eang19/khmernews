<?php 
    
    include('sidebar.php');
    include('function.php');
    
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
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" class="form-select">
                                            <option value="National">National</option>
                                            <option value="Internation">International</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-select">
                                            <option value="Sport">Sport</option>
                                            <option value="Social">Social </option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Contact">Contact</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <input name="thumbnail" type="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner</label>
                                        <input name="banner" type="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="accept_add" class="btn btn-primary">Add News</button>
                                        <button type="submit" class="btn btn-success">Success</button>
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