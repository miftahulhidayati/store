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
                                                        <th>Group Name</th>
                                                        <th>Created Date</th>
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
    <?php $this->load->view('usergroup/modal') ?>
    <script>
    var url = "<?php echo base_url() ?>";
    var isCreate = "<?php echo $isCreate ?>";
    var isEdit = "<?php echo $isEdit ?>";
    var isRead = "<?php echo $isRead ?>";
    var isDelete = "<?php echo $isDelete ?>";
    var isImp = "<?php echo $isImp ?>";
    var isExp = "<?php echo $isExp ?>";
    var arr = ['ID', 'USER_GROUP_NAME', 'CREATED_DATE'];
    var t = $("#dataTbl").DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        ajax: {
            url: url + "user_group/getDataTable",
            data: {
                tb: 'MS_USER_GROUP',
                arr: arr,
            },
        },
        deferRender: true,
        columnDefs: [{
                targets: [0],
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
                orderable: false,
                searchable: false,
                className: "all",
                render: function(data, type, row, meta) {
                    html = "";
                    htmledit =
                        '<div class="btn-group btn-sm" style="float: left; margin-right: 1px;">' +
                        '<a href="' + url + 'user_group_p/editprivilege/' + data[0] + '">' +
                        '<button data-toggle="tooltip" data-placement="top" title="Edit" type="button" class="btn light btn-primary btn-sm sharp mr-1"><i class="fas fa-pen"></i></button>' +
                        '</a>' +
                        '</div>';

                    html +=
                        "<td>" + '<div style="text-align: left; display: inline-flex;">';

                    html += htmledit;
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
                '<br><select onchange="changeSelectStatus(this)" class="form-control"  parsley-trigger="change"><option value="">All</option><option value="1">Active</option><option value="0">Not Active</option></select>'
            );
        }
    });

    // function changeSelectStatus(dis) {
    //     if (dis.value != "" && dis.value != null) {
    //         t.column(6).search(dis.value).draw();
    //     } else {
    //         t.column(6).search(dis.value).draw();
    //     }
    // }


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