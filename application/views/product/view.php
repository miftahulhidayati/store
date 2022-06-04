<?php $this->load->view('templates/header') ?>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('templates/navbar') ?>
        <?php $this->load->view('templates/sidebar') ?>
        <link href="<?php echo base_url(); ?>assets/libs/fancybox/jquery.fancybox.min.css" rel="stylesheet"
            type="text/css" />

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
                                        <a href="<?php echo base_url('product/add') ?>">
                                            <button type="button" class="btn btn-secondary float-right">Add
                                                Product
                                                <span class="btn-icon-right"><i class="fas fa-plus-circle"></i></span>
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTbl" class="table table-responsive"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
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
    <script src="<?php echo base_url(); ?>assets/libs/fancybox/jquery.fancybox.min.js"></script>

    <script>
    var url = "<?php echo base_url() ?>";
    var isCreate = "<?php echo $isCreate ?>";
    var isEdit = "<?php echo $isEdit ?>";
    var isRead = "<?php echo $isRead ?>";
    var isDelete = "<?php echo $isDelete ?>";
    var isImp = "<?php echo $isImp ?>";
    var isExp = "<?php echo $isExp ?>";

    function init() {
        // Image lightbox
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    }

    var arr = ['ID_PRODUCT', 'IMAGE_URL', 'NAME', 'CATEGORY_NAME', 'PRICE', 'STATUS', 'STATUS'];
    var t = $("#dataTbl").DataTable({
        initComplete: function(settings, json) {
            init()
        },
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: url + "product/getDataTable",
            data: {
                tb: 'MS_PRODUCT',
                arr: arr,
            },
        },
        deferRender: true,
        columnDefs: [{
                targets: [0, 6],
                orderable: true,
                searchable: true,
                visible: false,
            },
            {
                targets: [1],
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    html += "<a href='" + url + data[1] + "' data-popup='lightbox' data-fancybox>" +
                        "<img src='" + url + data[1] +
                        "' class='img-thumbnail' width='80px' heigh='80px'>" +
                        "</a>";

                    return html;
                }
            },

            {
                targets: [5],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    if (data[5] == 1)
                        html += "<span class='badge bg-primary'>Active</span>";
                    else if (data[5] == 0)
                        html += "<span class='badge bg-danger'>Not Active</span>";
                    else html += "<span class='badge bg-info'>" + data[5] + "</span>";
                    return html;
                },
            },
            {
                targets: [7],
                data: null,
                orderable: false,
                searchable: false,
                className: "all",
                render: function(data, type, row, meta) {
                    html = "";
                    htmledit =
                        '<div style="float: left;">' +
                        '<a href="' + url + 'product/edit/' + data[0] + '">' +
                        '<button data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn btn-md btn-secondary btn-icon waves-effect waves-light"><i class="fas fa-pen"></i></button>' +
                        '</a>' +
                        '</div>';

                    htmlstatus =
                        '<div   style="float: left;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="' +
                        (data[5] == 1 ? "Deactivate" : "Activate") +
                        '" onclick="' +
                        (data[5] == 1 ? "inactive" : "active") +
                        "('" +
                        data[0] +
                        '\')" type="button" class="btn btn-md btn-icon waves-effect waves-light btn-' +
                        (data[5] == 1 ? "danger" : "primary") +
                        '"><i class="fas fa-toggle-' +
                        (data[5] == 1 ? "on" : "off") +
                        '"></i></button>' +
                        "</div>";
                    html += "<td>";
                    html += '<div class="hstack gap-1">';
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
                    url: url + "product/activeAction/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Activate Product Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Activate Product Failed'
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
                    url: url + "product/inactiveAction/" + id,
                    dataType: "JSON",
                    type: 'POST',
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Inactive Product Success'
                            }).then(function() {
                                t.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Inactive Product Failed'
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