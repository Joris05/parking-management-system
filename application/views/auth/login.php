<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Parking Management System</title>

    <link rel="icon" href="<?php echo base_url('assets/img/icon.png');?>" type="image/x-icon" />
	<link rel="icon" href="<?php echo base_url('assets/img/icon.png');?>" type="image/png" />

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/fonts.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6 mt-xl-5">
                                <div class="mt-xl-5"></div>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="<?php echo base_url('auth/check_login') ?>">
                                        <div class="form-group">
                                            <input
                                              type="email"
                                              name="email"
                                              autocomplete="off"
                                              class="form-control form-control-user"
                                              required="true"
                                              autofocus="true"
                                              placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <input
                                              type="password"
                                              name="password"
                                              required="true"
                                              class="form-control form-control-user"
                                              placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <?php
                                         if(validation_errors()){
                                            echo '<div class="alert alert-danger mt-2 text-center" role="alert">'.validation_errors().'</div>';
                                        }
                                    ?>
                                    <?php if(!empty($errors)) {
                                        echo '<div class="alert alert-danger mt-2 text-center" role="alert">'.$errors.'</div>';
                                    } ?>
                                </div>
                                <div class="mt-xl-5"><br></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('aseets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>

</html>