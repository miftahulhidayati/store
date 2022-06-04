<?php $this->load->view('templates/header') ?>

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

                                        <?php if ($isCreate) { ?>
                                        <button onclick="openModall()" type="button"
                                            class="btn btn-secondary float-right">Add
                                            User
                                            <span class="btn-icon-right"><i class="fas fa-plus-circle"></i></span>
                                        </button>

                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTbl" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Name</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Group</th>
                                                        <th>Position</th>
                                                        <th>Status</th>
                                                        <th>sts</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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
    <?php $this->load->view('users/modal') ?>
    <script>
    var url = "<?php echo base_url() ?>";
    var isCreate = "<?php echo $isCreate ?>";
    var isEdit = "<?php echo $isEdit ?>";
    var isRead = "<?php echo $isRead ?>";
    var isDelete = "<?php echo $isDelete ?>";
    var isImp = "<?php echo $isImp ?>";
    var isExp = "<?php echo $isExp ?>";
    var arr = ['ID', 'NAME', 'USERNAME', 'EMAIL', 'USER_GROUP_NAME', 'POSITION', 'STATUS', 'STATUS'];
    var t = $("#dataTbl").DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: url + "users/getDataTable",
            data: {
                tb: 'MS_USERS',
                arr: arr,
            },
        },
        deferRender: true,
        columnDefs: [{
                targets: [0, 7],
                orderable: true,
                searchable: true,
                visible: false,
            },
            {
                targets: [6],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    if (data[6] == 1)
                        html += "<span class='badge bg-primary'>Active</span>";
                    else if (data[6] == 0)
                        html += "<span class='badge bg-danger'>Not Active</span>";
                    else html += "<span class='badge bg-info'>" + data[6] + "</span>";
                    return html;
                },
            },
            {
                targets: [8],
                data: null,
                orderable: false,
                searchable: false,
                className: "all",
                render: function(data, type, row, meta) {
                    html = "";
                    htmledit =
                        '<div style="float: left; margin-right: 1px;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="Edit"onclick="openEdit(\'' +
                        data[0] +
                        '\')" type="button" class="btn light btn-success btn-sm sharp mr-1"><i class="fas fa-pen"></i></button>' +
                        '</div>';

                    htmlstatus =
                        '<div style="float: left; margin-right: 2px;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="' +
                        (data[6] == 1 ? "Deactivate" : "Activate") +
                        '" onclick="' +
                        (data[6] == 1 ? "inactive" : "active") +
                        "('" +
                        data[0] +
                        '\')" type="button" class="btn btn-sm sharp btn-' +
                        (data[6] == 1 ? "danger" : "primary") +
                        '"><i class="fas fa-toggle-' +
                        (data[6] == 1 ? "on" : "off") +
                        '"></i></button>' +
                        "</div>";


                    html += "<td>";
                    html += '<div class="d-flex">';


                    if (isEdit == 1) {
                        html += htmledit;
                        html += htmlstatus;

                    }
                    if (isDelete == 1) {}
                    if (isRead == 1) {}
                    if (isExp == 1) {}
                    html += '</div>';

                    html += "</td>";

                    return html;
                },
            },
        ],
        keys: !0,
        order: [0, 'desc'],
        autofill: true,
        select: true,
        responsive: true,
        buttons: true,
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 5
    });

    $('#dataTbl thead th').each(function() {
        var title = $(this).text();
        if (title != "Actions" && title != "Status" && title != "Image") {
            $(this).append(
                '<input type="text" class="form-control form-control-sm" style="margin-top: 5px;"  aria-controls="tickets-table" placeholder="Search Here..">'
            );
        }
        if (title == "Status") {
            $(this).append(
                '<br><select onchange="changeSelectStatus(this)" class="form-control"  parsley-trigger="change"><option value="">Semua</option><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select>'
            );
        }
    });

    function changeSelectStatus(dis) {
        if (dis.value != "" && dis.value != null) {
            t.column(7).search(dis.value).draw();
        } else {
            t.column(7).search(dis.value).draw();
        }
    }


    t.columns().every(function() {
        var that = this;

        $('input', this.header()).on('keyup', function(e) {
            if (event.keyCode === 8) {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            } else {
                if (this.value.length >= 3) {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                }
            }
        });
    });

    $('#dataTbl thead input').on('click', function(e) {
        e.stopPropagation();
    });

    function openModall() {
        $('#modalUsers2').modal('show');
    }
    $('.select2').select2({
        dropdownParent: $("#modalUsers2")
    });
    $('.select22').select2({
        dropdownParent: $("#modalEditUser")
    });

    $('.modal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        var Selectlength = $('.parsleyy').length;
        for (var i = 0; i < Selectlength; i++) {
            $('.parsleyy').parsley()[i].reset();
        }
    });

    $('#modalUsers2').on('hidden.bs.modal', function(e) {
        var Selectlength = $("#modalUsers2 select.select2").length;
        for (var i = 0; i < Selectlength; i++) {
            $("#modalUsers2 select.select2")[i].selectedIndex = 0;
        }
    });
    //ADD USER
    $('#frmsaveUser').on('submit', function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            $.ajax({
                url: url + "users/create_action",
                data: $(this).serialize(),
                dataType: "JSON",
                type: 'POST',
                success: function(data) {
                    if (!(data.indexOf("Failed") != -1)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tambah User Sukses'
                        }).then(function() {
                            $('#modalUsers2').modal('hide');

                            t.ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data
                        });
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(errorThrown);
                },
                beforeSend: function() {
                    $('#animatedPreloader').show();
                },
                complete: function() {
                    $('#animatedPreloader').fadeOut();
                }
            });
        }
    });
    //END ADD USER

    //EDIT USER
    $('#frmeditUser').on('submit', function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            $.ajax({
                url: url + "users/update_action",
                data: $(this).serialize(),
                dataType: "JSON",
                type: 'POST',
                success: function(data) {
                    if (!(data.indexOf("Failed") != -1)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ubah User Berhasil'
                        }).then(function() {
                            t.ajax.reload(null, false);
                            document.getElementById("frmeditUser").reset();
                            $('#modalEditUser').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data
                        }).then(function() {
                            // t.ajax.reload(null, false);
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(textStatus).then(function() {
                        // t.ajax.reload(null, false);
                    });
                },
                beforeSend: function() {
                    $('#animatedPreloader').show();
                },
                complete: function() {
                    $('#animatedPreloader').fadeOut();
                }
            });
        }
    });
    //END EDIT USER
    //Open Edit Form
    function openEdit(id) {
        $.ajax({
            url: url + "users/get_edit/" + id,
            dataType: "JSON",
            type: 'GET',
            success: function(data) {


                $("#unameEdit").val(data.USERNAME);
                $("#nameeEdit").val(data.NAME);
                $("#id_store_edit").val(data.ID_STORE).trigger('change');
                $("#emailAddressEdit").val(data.EMAIL);
                $("#groupUserEdit").val(data.GROUP_ID).trigger('change');
                $("#city_codeEdit").val(data.CITY_CODE).trigger('change');
                $("#positionUserEdit").val(data.POSITION);
                $("#officeUserEdit").val(data.ID_ODP);
                $("#IDUserEdit").val(id);
                $('#modalEditUser').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire(textStatus);
                // document.getElementById("frmeditUser").reset();
            },
            beforeSend: function() {
                $('#animatedPreloader').show();
            },
            complete: function() {
                $('#animatedPreloader').fadeOut();
            }
        });
    }
    //END Open Edit Form

    //Open Change Status
    function active(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, Activate!",
            cancelButtonText: "No, Cancel!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url + "users/activeuser/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Activeate User Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Activeate User Failed'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            textStatus
                        }).then(function() {
                            t.ajax.reload(null, false);
                        });
                    },
                    beforeSend: function() {
                        $('#animatedPreloader').show();
                    },
                    complete: function() {
                        $('#animatedPreloader').fadeOut();
                    }
                });
            }
        });
    }
    //END Change Status

    //Open Change Status
    function inactive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, Inactive!",
            cancelButtonText: "No, Cancel!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url + "users/inactiveuser/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Inactive User Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Inactive User Failed'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            textStatus
                        }).then(function() {
                            t.ajax.reload(null, false);
                        });
                    },
                    beforeSend: function() {
                        $('#animatedPreloader').show();
                    },
                    complete: function() {
                        $('#animatedPreloader').fadeOut();
                    }
                });
            }
        });
    }
    //END Change Status
    </script>
</body>


</html>