<?php include_once APPROOT . '/views/include/header.php' ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light">
                <h3 class="text-center">Login</h3>
                <p class="lead text-center">Please fill out this from to login</p>
                <form action="<?=URLROOT?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email">Email <sup class="text-danger">*</sup></label>
                        <input type="email" name="email" class="form-control <?=(isset($err['email'])) ? 'is-invalid' : ''?>" placeholder="Enter Email" value="<?=$email ?? ''?>" required>
                        <span class="invalid-feedback"><?=$err['email'] ?? ''?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <sup class="text-danger">*</sup></label>
                        <input type="password" name="pass" class="form-control <?=(isset($err['pass'])) ? 'is-invalid' : ''?>" placeholder="Enter Password" required>
                        <span class="invalid-feedback"><?=$err['pass'] ?? ''?></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                        <div class="col-md-6">
                            <a href="<?=URLROOT?>/users/register" class="btn btn-light btn-block">Register here</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include_once APPROOT . '/views/include/footer.php' ?>