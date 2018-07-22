<?php include APPROOT . '/views/includes/header.php';?>


    <a href="<?php echo URLROOT;?>/posts" class="btn btn-lg btn-primary pullright text-center"> <i class="material-icons pull-left">undo</i> Go back</a>
    <div class="card card-body bg-light mt-5">
        <?php //flash('register_success') ?>
        <h2> Create post</h2>
        
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">
        
        <div class="form-group">
                <div class="input-group input-group-lg">
                    
                    <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' :'';?>"
                            value="<?php echo $data['title']; ?>" placeholder="Title">
                            <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
                </div>
            </div>

                <div class="form-group">
                <div class="input-group input-group-lg">
                    
                    <textarea  name="body" class="form-control form-control-lg <?php echo (!empty($data['body_error'])) ? 'is-invalid' :'';?>"
                            placeholder="Password"><?php echo $data['body']; ?></textarea>
                            <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
                </div>
            </div>

            
            <div class="form-group">
                
                    <input type="submit" value="Create" class="btn btn-success">
                
                
                    
                
            </div>
        </form>
    </div>




<?php include APPROOT . '/views/includes/footer.php';?>