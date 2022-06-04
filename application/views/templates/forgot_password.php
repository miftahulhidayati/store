<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title>Reset Password | Agrinesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Forgot Password" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="<?php echo base_url() ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo base_url() ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


</head>
<style>
.dataTables_filter {
    display: none;
}

.form-control.parsley-error {
    border-color: #ea3a3a;
}


ul.parsley-errors-list li {
    color: #fd0d0d;
    list-style: none;
    margin-top: 0.25rem;
    font-size: 90%;
}
</style>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index-2.html" class="d-inline-block auth-logo">
                                    <img src="<?php echo base_url() ?>assets/images/logo.png" alt="" height="50">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Agrinesia</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Forgot Password?</h5>
                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                        colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>
                                </div>
                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form method="POST" action="#" class="needs-validation" novalidate=""
                                        id="forgotForm">
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" required id="email"
                                                name="emailaddress" placeholder="Enter Email">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="text-muted">Back to <a href="<?php echo base_url(); ?>" class="text-muted ml-1"><b
                                        class="font-weight-semibold">Log in</b></a></p>

                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy; <script>
                                document.write(new Date().getFullYear())
                                </script> Miftahulhdyt. Crafted with <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/parsleyjs/init_parsley.js"></script>

    <!-- particles js -->
    <script src="<?php echo base_url() ?>assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="<?php echo base_url() ?>assets/js/pages/particles.app.js"></script>
    <!-- Sweet Alerts js -->
    <script src="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#forgotForm').on('submit', function(e) {
            e.preventDefault();
            if ($(this).parsley().isValid()) {
                $.ajax({
                    url: "<?php echo base_url('api/forgot_password'); ?>",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data.status) {
                            Swal.fire({
                                icon: 'success',
                                title: data.msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: data.msg.replace("Failed: ", "")
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire(textStatus);
                    }
                });
            }
        });
    })
    </script>

</body>


</html>