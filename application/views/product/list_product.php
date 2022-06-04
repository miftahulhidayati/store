<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">


<head>

    <meta charset="utf-8" />
    <title>List Product | Majoo Teknologi Indonesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Website" name="description" />
    <meta content="Miftahulhdyt" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo-square.png">

    <!-- plugin css -->
    <link href="<?php echo base_url() ?>assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet"
        type="text/css" />

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


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="horizontal-logo">
                            <a href="<?php echo base_url() ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url() ?>assets/images/logo-square-color.png" alt=""
                                        height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url() ?>assets/images/logo-color.png" alt="" height="50">
                                </span>
                            </a>

                            <a href="<?php echo base_url() ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url() ?>assets/images/logo-square.png" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url() ?>assets/images/logo-white.png" alt="" height="50">
                                </span>
                            </a>
                        </div>



                    </div>

                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?php echo base_url() ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>assets/images/logo-square-color.png" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>assets/images/logo-color.png" alt="" height="50">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?php echo base_url() ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>assets/images/logo-square.png" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>assets/images/logo-white.png" alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>

                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Product</h4>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="row h-100">
                                <?php foreach ($products as $key => $product) { ?>

                                <div class="col-lg-3">
                                    <div class="card pricing-box card-height-100">
                                        <div class="card-body p-4 m-2">
                                            <div class="text-center">
                                                <img src="<?php echo base_url() . $product['IMAGE_URL'] ?>" alt=""
                                                    class="img-fluid">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fw-semibold"><?php echo $product['NAME'] ?></h5>
                                                </div>

                                            </div>
                                            <div class="pt-4 text-center">
                                                <h2><sup><small>Rp</small></sup><?php echo number_format($product['PRICE']) ?>
                                                </h2>
                                            </div>
                                            <hr class="my-4 text-muted">
                                            <div>

                                                <div class="mt-4">
                                                    <p>
                                                        <?php echo $product['DESCRIPTION'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="border-top:none;">
                                            <div class="mt-4">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-soft-success w-100 waves-effect waves-light">Buy</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <?php } ?>

                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                            document.write(new Date().getFullYear())
                            </script> © miftahulhdyt
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design by Majoo
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->





    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="<?php echo base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="<?php echo base_url() ?>assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
    <script src="<?php echo base_url() ?>assets/js/pages/dashboard-analytics.init.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
</body>



</html>