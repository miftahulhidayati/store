<?php $this->load->view('templates/header') ?>
<link href="<?php echo base_url(); ?>assets/libs/treeview/css/style.css" rel="stylesheet" type="text/css" />

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('templates/navbar') ?>
        <?php $this->load->view('templates/sidebar') ?>

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
                                <h4 class="mb-sm-0"><?php echo $menu_name ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a>
                                        </li>
                                        <li class="breadcrumb-item active">User Group Privilege</li>
                                        <li class="breadcrumb-item active"><?php echo $menu_name ?></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <div class="card">
                                    <div class="card-header">

                                        <h3 style="text-transform: capitalize;"><?php echo $uGroupName ?></h3>

                                    </div>
                                    <div class="card-body">
                                        <form id="frmsaveUGroupPrivilege">
                                            <input type="hidden" name="uGroupCBID" id="uGroupCBID">
                                            <!-- TREE VIEW -->
                                            <div id="containerbasicTree">
                                                <div id="basicTree"></div>
                                            </div>
                                            <!-- /TREE VIEW -->
                                            <div class="form-group mb-0 mt-3" id="btnformUGroupPrivilege"
                                                style="text-align: right;">
                                                <button class="btn btn-success waves-effect waves-light mr-1"
                                                    type="button" id="checkallCB" style="float: left"> Check/Uncheck
                                                    All</button>
                                                <button class="btn btn-primary waves-effect waves-light mr-1"
                                                    type="submit">
                                                    Submit</button>
                                                <a href="<?php echo $back; ?>"><button type="button"
                                                        class="btn btn-secondary waves-effect waves-light">
                                                        Cancel</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->


                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php $this->load->view('templates/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <?php $this->load->view('templates/script_bottom') ?>
    <script src="<?php echo base_url(); ?>assets/libs/treeview/js/jstree.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/treeview/js/jstreegrid.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/treeview/js/treebase.js"></script>

    <script>
    <?php if (!empty($id) && !empty($datatree)) { ?>

    $("#uGroupCBID").val(<?php echo $id ?>);
    $("#basicTree").jstree({
        plugins: ["core", "ui", "grid", "types"],
        grid: {
            columns: [{
                    width: "40%",
                    header: "Module Menu",
                    value: "ModuleMenu",
                    title: "Module Menu"
                },
                {
                    width: "10%",
                    header: "View",
                    value: "Read",
                    title: "Read"
                },
                {
                    width: "10%",
                    header: "Edit",
                    value: "Edit",
                    title: "Edit"
                },
                {
                    width: "10%",
                    header: "Delete",
                    value: "Delete",
                    title: "Delete"
                },
                {
                    width: "10%",
                    header: "Add",
                    value: "Add",
                    title: "Add"
                },
                {
                    width: "10%",
                    header: "Export",
                    value: "Export",
                    title: "Export"
                },
                {
                    width: "10%",
                    header: "Import",
                    value: "Import",
                    title: "Import"
                },
                {
                    width: "10%",
                    header: "Btn",
                    value: "Btn",
                    title: "Btn"
                }
            ],
            resizable: true,
            contextmenu: true
        },
        core: {
            themes: {
                responsive: !1
            },
            data: <?php echo json_encode($datatree['dataTree']) ?>

        },
        types: {
            default: {
                icon: "far fa-file"
            },
            file: {
                icon: "far fa-folder"
            }
        }
    });

    <?php } else { ?>
    $("#GroupPrivilegeEdit").html("");
    <?php } ?>
    // end init treebase
    // SAVE USER GROUP PRIIVILEGE
    $('#frmsaveUGroupPrivilege').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('user_group_p/saveCb'); ?>",
            data: $(this).serialize(),
            dataType: "JSON",
            type: 'POST',
            success: function(data) {
                console.log(data);
                if (!(data.indexOf("Failed") != -1)) {
                    Swal.fire({
                        icon: 'success',
                        title: data
                    }).then(function() {
                        var uri = "<?php echo base_url('user_group_p'); ?>";
                        window.location.href = uri;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data
                    }).then(function() {
                        location.realod();
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire(textStatus);
            },
            beforeSend: function() {
                $('#animatedPreloader').show();
            },
            complete: function() {
                $('#animatedPreloader').fadeOut();
            }
        });
    });
    // END SAVE USER GROUP PRIVILEGE
    </script>
</body>


</html>