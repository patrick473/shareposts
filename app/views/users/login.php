<?php require APPROOT . '/views/includes/header.php';?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success') ?>
            <h2> Log in</h2>
           
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
            
            <div class="form-group">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">email</i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' :'';?>"
                             value="<?php echo $data['email']; ?>" placeholder="Email">
                             <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">lock</i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' :'';?>"
                             value="<?php echo $data['password']; ?>" placeholder="Password">
                             <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                    </div>
                </div>

                <?php echo (!empty($data['combination_error'])) ? ' <div class="alert alert-danger">'.$data['combination_error'].'</div>' : '' ; ?>
                <div class="form-group">
                    
                        <input type="submit" value="Login" class="btn btn-success">
                   
                    
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary "> No account? Register </a>
                   
                </div>
            </form>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/footer.php';?>