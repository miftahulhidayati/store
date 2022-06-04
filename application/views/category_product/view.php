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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Master Data</a>
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
                                    <div class="card-header align-right">

                                        <?php if ($isCreate) { ?>
                                        <button onclick="openModall()" type="button"
                                            class="btn btn-secondary float-right">Add
                                            Category Product
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
                                                        <th>Kode</th>
                                                        <th>Name</th>
                                                        <th>Tanggal Dibuat</th>
                                                        <th>Dibuat Oleh</th>
                                                        <th>Tanggal Diubah</th>
                                                        <th>Diubah Oleh</th>
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
    <?php $this->load->view('category_product/modal') ?>
    <script>
    var url = "<?php echo base_url() ?>";
    var isCreate = "<?php echo $isCreate ?>";
    var isEdit = "<?php echo $isEdit ?>";
    var isRead = "<?php echo $isRead ?>";
    var isDelete = "<?php echo $isDelete ?>";
    var isImp = "<?php echo $isImp ?>";
    var isExp = "<?php echo $isExp ?>";
    var arr = ['ID_CATEGORY_PRODUCT', 'CODE', 'NAME', 'CREATED_DATE', 'CREATED_BY', 'DATE_LOG', 'USER_LOG', 'STATUS',
        'STATUS'
    ];
    var t = $("#dataTbl").DataTable({
        // serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: url + "category_product/getDataTable",
            data: {
                tb: 'MS_CATEGORY_PRODUCT',
                arr: arr,
            },
        },
        deferRender: true,
        columnDefs: [{
                targets: [0, 8],
                orderable: true,
                searchable: true,
                visible: false,
            },
            {
                targets: [3],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = data[3] != '' ? moment(data[3], 'YYYY-MM-DD HH:mm:ss').format(
                        "DD MMMM YYYY HH:mm") : '';

                    return html;
                },
            },
            {
                targets: [5],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = data[5] != '' ? moment(data[5], 'YYYY-MM-DD HH:mm:ss').format(
                        "DD MMMM YYYY HH:mm") : '';

                    return html;
                },
            },
            {
                targets: [7],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    if (data[7] == 1)
                        html += "<span class='badge bg-primary'>Active</span>";
                    else if (data[7] == 0)
                        html += "<span class='badge bg-danger'>Not Active</span>";
                    else html += "<span class='badge bg-info'>" + data[7] + "</span>";
                    return html;
                },
            },
            {
                targets: [9],
                data: null,
                orderable: false,
                searchable: false,
                className: "all",
                render: function(data, type, row, meta) {
                    html = "";

                    htmledit =
                        '<div class="btn-group btn-sm"  style="float: left; margin-right: 1px;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="Edit"onclick="openEdit(\'' +
                        data[0] +
                        '\')" type="button" class="btn light btn-success btn-sm sharp mr-1"><i class="fas fa-pen"></i></button>' +
                        '</div>';


                    htmlstatus =
                        '<div class="btn-group btn-sm" style="float: left; margin-right: 1px;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="' +
                        (data[7] == 1 ? "Deactivate" : "Activate") +
                        '" onclick="' +
                        (data[7] == 1 ? "inactive" : "active") +
                        "('" +
                        data[0] +
                        '\')" type="button" class="btn btn-sm  btn-' +
                        (data[7] == 1 ? "danger" : "primary") +
                        '"><i class="fas fa-toggle-' +
                        (data[7] == 1 ? "on" : "off") +
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
        stripePangkates: [],
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
            t.column(8).search(dis.value).draw();
        } else {
            t.column(8).search(dis.value).draw();
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
        $('#modalCategoryProduct').modal('show');
    }
    $('.select2').select2({
        dropdownParent: $("#modalCategoryProduct")
    });
    $('.select22').select2({
        dropdownParent: $("#modalCategoryProductEdit")
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

    $('#modalCategoryProduct').on('hidden.bs.modal', function(e) {
        var Selectlength = $("#modalCategoryProduct select.select2").length;
        for (var i = 0; i < Selectlength; i++) {
            $("#modalCategoryProduct select.select2")[i].selectedIndex = 0;
        }
    });
    //ADD USER
    $('#frmsavePangkat').on('submit', function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            $.ajax({
                url: url + "category_product/create_action",
                data: $(this).serialize(),
                dataType: "JSON",
                type: 'POST',
                success: function(data) {
                    if (!(data.indexOf("Failed") != -1)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Add Category Product Success'
                        }).then(function() {
                            $('#modalCategoryProduct').modal('hide');

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
    $('#frmeditCategoryProduct').on('submit', function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            $.ajax({
                url: url + "category_product/update_action",
                data: $(this).serialize(),
                dataType: "JSON",
                type: 'POST',
                success: function(data) {
                    if (!(data.indexOf("Failed") != -1)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update Category Product Success'
                        }).then(function() {
                            t.ajax.reload(null, false);
                            document.getElementById("frmeditCategoryProduct").reset();
                            $('#modalCategoryProductEdit').modal('hide');
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
            url: url + "category_product/get_edit/" + id,
            dataType: "JSON",
            type: 'GET',
            success: function(data) {


                $("#code_classEdit").val(data.CODE);
                $("#name_classEdit").val(data.NAME);
                $("#IDEdit").val(id);
                $('#modalCategoryProductEdit').modal('show');
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
                    url: url + "category_product/activeAction/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Activate Category Product Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Activate Category Product Failed'
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
                    url: url + "category_product/inactiveAction/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Inactive Category Product Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Inactive Category Product Failed'
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