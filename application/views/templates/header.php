<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title><?php echo $menu_name ?> | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin" name="description" />
    <meta content="Miftahul Hidayati" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo-square.png">
    <!-- Sweet Alert css-->
    <link href="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/libs/font-awesome/css/all.min.css" />


    <link rel="stylesheet" href="<?php echo base_url() ?>assets/libs/select2/css/select2.min.css">

    <!--Swiper slider css-->
    <link href="<?php echo base_url() ?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="<?php echo base_url() ?>assets/libs/datatables/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url() ?>assets/libs/datatables/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?php echo base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
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

th {
    background: var(--vz-header-bg-table-dark) !important;
}


.animated {
    -webkit-animation-duration: .5s;
    animation-duration: .5s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    -webkit-animation-iteration-count: infinite;
}

@-webkit-keyframes bounce {

    0%,
    100% {
        -webkit-transform: translateY(0);
    }

    50% {
        -webkit-transform: translateY(-15px);
    }
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px);
    }
}

@-webkit-keyframes bounceShadow {

    0%,
    100% {
        -webkit-transform: rotate3d(100, 1, 1, 45deg);
    }

    50% {
        -webkit-transform: rotate3d(100, 1, 1, 60deg);
    }
}

@keyframes bounceShadow {

    0%,
    100% {
        transform: rotate3d(100, 1, 1, 45deg);
    }

    50% {
        transform: rotate3d(100, 1, 1, 60deg);
    }
}

.bounce {
    -webkit-animation-name: bounce;
    animation-name: bounce;
}

.shadowBounce {
    -webkit-animation-name: bounceShadow;
    animation-name: bounceShadow;
}

#animatedPreloader {
    width: 100%;
    height: 120%;
    z-index: 9999;
    position: fixed;
    top: 0;
    left: 0;
    /* background: rgb(174, 238, 237); */
    background: radial-gradient(circle, rgba(174, 238, 237, 0.39539565826330536) 0%, rgba(148, 187, 233, 0.5718662464985995) 100%);
}

#animatedPreloader img {
    position: relative;
    top: 35%;
    left: 47%;
}
</style>