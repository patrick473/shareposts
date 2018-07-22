<?php require APPROOT . '/views/includes/header.php';?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2> Create an Account</h2>
            <p>Please fill out this form to register</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="form-group">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">account_circle</i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid' :'';?>"
                            value="<?php echo $data['name']; ?>" placeholder="Name">
                        <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                    </div>
                </div>


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


                 <div class="form-group">
                    
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">check</i>
                            </span>
                        </div>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' :'';?>"
                            placeholder="Confirm password">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                    </div>
                   
                </div>
                <div class="form-group">
                    
                        <input type="submit" value="Register" class="btn btn-success">
                   
                    
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-primary "> Have an account? Login </a>
                   
                </div>
            </form>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/footer.php';?>