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


                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="dataTbl" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Module Name</th>
                                                        <th>Created Date</th>
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
    <script>
    var url = "<?php echo base_url() ?>";
    var isCreate = "<?php echo $isCreate ?>";
    var isEdit = "<?php echo $isEdit ?>";
    var isRead = "<?php echo $isRead ?>";
    var isDelete = "<?php echo $isDelete ?>";
    var isImp = "<?php echo $isImp ?>";
    var isExp = "<?php echo $isExp ?>";
    var arr = ['ID', 'USER_GROUP_NAME', 'CREATED_DATE'];
    var arr = ['ID', 'MODULE_NAME', 'CREATED_DATE', 'ACTIVE', 'ACTIVE'];
    var t = $("#dataTbl").DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: url + "module_p/getDataTable",
            data: {
                tb: 'MS_MODULE_PREVILEGE',
                arr: arr,
            },
        },
        deferRender: true,
        columnDefs: [{
                targets: [0, 4, 5],
                orderable: true,
                searchable: true,
                visible: false,
            },
            {
                targets: [2],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    html += moment(data[2]).format("DD MMMM YYYY");
                    return html;
                },
            },
            {
                targets: [3],
                data: null,
                type: "html",
                orderable: false,
                render: function(data, type, row, meta) {
                    html = "";
                    if (data[3] == 1)
                        html += "<span class='badge bg-primary'>Active</span>";
                    else if (data[3] == 0)
                        html += "<span class='badge bg-danger'>Not Active</span>";
                    else html += "<span class='badge bg-info'>" + data[3] + "</span>";
                    return html;
                },
            },
            {
                targets: [5],
                data: null,
                orderable: false,
                searchable: false,
                className: "all",
                render: function(data, type, row, meta) {
                    html = "";
                    htmlstatus =
                        '<div style="float: left; margin-right: 2px;">' +
                        '<button data-toggle="tooltip" data-placement="top" title="' +
                        (data[3] == 1 ? "Deaktivasi" : "Aktivasi") +
                        '" onclick="' +
                        (data[3] == 1 ? "activeToggle" : "inactiveToggle") +
                        "('" +
                        data[0] +
                        '\')" type="button" class="btn btn-sm btn-' +
                        (data[3] == 1 ? "primary" : "danger") +
                        '"><i class="fas fa-toggle-' +
                        (data[3] == 1 ? "on" : "off") +
                        '"></i></button>' +
                        "</div>";

                    html +=
                        "<td>" + '<div style="text-align: left; display: inline-flex;">';

                    // html += htmledit;
                    // html += htmlstatus;
                    if (isEdit == 1) {}
                    if (isDelete == 1) {}
                    if (isRead == 1) {}
                    if (isExp == 1) {}

                    html += "</div>" + "</td>";

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
            t.column(4).search(dis.value).draw();
        } else {
            t.column(4).search(dis.value).draw();
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
    </script>
</body>


</html>