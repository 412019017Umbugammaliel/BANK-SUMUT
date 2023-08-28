<body class="login-page">
    <div class="login-box">
        <div style="color:#00a65a" class="login-logo">
            <img src="asset/image/banksumut.png" alt="Bank Sumatra Utara" width="200" height="200">
        </div><!-- /.login-logo -->
        <div class="row">
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">                        
                        <?php echo session()->getFlashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
             
            // $firstname = session()->getFlashdata('regfirstname');
            // $lastname =session()->getFlashdata('reglastname');
            // $email = session()->getFlashdata('regemail');
            // $password = session()->getFlashdata('regpassword');
            if(session()->getFlashdata('regusername')){
                $username = session()->getFlashdata('regusername');
            }else{
                $username = NULL;
            }
            if(session()->getFlashdata('regfirstname')){
                $firstname = session()->getFlashdata('regfirstname');
            }else{
                $firstname = NULL;
            }
            if(session()->getFlashdata('reglastname')){
                $lastname = session()->getFlashdata('reglastname');
            }else{
                $lastname = NULL;
            }
            if(session()->getFlashdata('regemail')){
                $email = session()->getFlashdata('regemail');
            }else{
                $email = NULL;
            }
            if(session()->getFlashdata('regpassword')){
                $password = session()->getFlashdata('regpassword');
            }else{
                $password = NULL;
            }
        ?>
        

        
        <div class="login-box-body">
            <p class="login-box-msg"><i class="fa fa-user"></i> Silahkan Registrasi</p>
            <br>
            <form action="<?php echo base_url('Home/register')?>" method="POST">
            <?= csrf_field(); ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo $username; ?>" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="spccode" placeholder="Special Code">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <br>
                <div class="row">
                    <div class="col-xs-12">
                    <input type="submit" class="btn btn-success btn-lg btn-block btn-flat" name="Registration" value="Submit">
                    </div><!-- /.col -->
                </div>
            </form>
            <br>
            <div class="text-center">
                <p>Have account? <a href="<?php echo base_url('/')?>">Login</a></p>
            </div>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>