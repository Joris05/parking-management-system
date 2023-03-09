
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>401 Error - Parking Management System</title>
        <link rel="icon" href="<?php echo base_url('assets/img/icon.png');?>" type="image/x-icon" />
	    <link rel="icon" href="<?php echo base_url('assets/img/icon.png');?>" type="image/png" />
        <link href="<?php echo base_url('assets/css/styles.css');?>" rel="stylesheet" />
    </head>
    <body class="bg-white">
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <img class="img-fluid p-4" src="<?php echo base_url('assets/img/401-error-unauthorized.svg');?>" alt="" />
                                    <p class="lead">Access to this resource is denied.</p>
                                    <a class="text-arrow-icon" href="<?php echo base_url('dashboard'); ?>">
                                        <i class="ms-0 me-1" data-feather="arrow-left"></i>
                                        Return to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © Parking Management System <?php echo date('Y'); ?></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
</body>
</html>
