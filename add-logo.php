<?php 
    include('sidebar.php');
    include('function.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label>Show on</label>
                                        <select name="showOn" class="form-select">
                                            <option value="Header">Header</option>
                                            <option value="Footer">Footer</option>
                                        </select>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label>File</label>
                                        <input name="thumbnail" type="file" class="form-control">
                                    </div>
                                   
                                    <div class="form-group">
                                        <button name="save_logo" type="submit" class="btn btn-primary">Save</button>
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