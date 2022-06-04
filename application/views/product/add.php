<?php $this->load->view('templates/header') ?>
<!-- Filepond css -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/libs/filepond/filepond.min.css" type="text/css" />
<link rel="stylesheet"
    href="<?php echo base_url() ?>assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">

<link href="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">

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
                                        <li class="breadcrumb-item"><a
                                                href="<?php echo $back ?>"><?php echo $menu_name ?></a>
                                        </li>
                                        <li class="breadcrumb-item active">Add <?php echo $menu_name ?></li>
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
                                    <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsaveProduct">
                                        <div class="card-header align-right">
                                            <label for="">Add Product</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Product Name<span style="color: orange">*</span></label>
                                                        <div class="form-group mb-0">
                                                            <input type="text" class="form-control"
                                                                parsley-trigger="change" name="product_name"
                                                                id="product_name" placeholder="Product Name"
                                                                data-parsley-trigger="focusin focusout" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Product Category<span
                                                                style="color: orange">*</span></label>
                                                        <select class="form-control select2" name="id_category_product"
                                                            data-parsley-errors-container="#validation-error-category"
                                                            id="id_category_product" required>
                                                            <option disabled selected>Select Category</option>
                                                            <?php foreach ($category as $valcategory) { ?>
                                                            <option
                                                                value="<?php echo $valcategory->ID_CATEGORY_PRODUCT; ?>">
                                                                <?php echo $valcategory->NAME; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="" id="validation-error-category"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Price<span style="color: orange">*</span></label>

                                                        <input type="text" class="form-control" name="priceV"
                                                            id="priceV" placeholder="Price" required=""
                                                            onkeyup="validate_number(this);changePrice(this, 'price')">
                                                        <input type="hidden" class="form-control" name="price"
                                                            id="price" placeholder="Price" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Description<span style="color: orange">*</span></label>
                                                        <textarea name="description" id="description"
                                                            data-parsley-errors-container="#validation-error-desc"
                                                            class="ckeditor-classic" cols="30" rows="10"
                                                            required></textarea>
                                                        <div class="" id="validation-error-desc"></div>

                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Upload Image<span style="color: orange">*</span></label>
                                                        <input type="file" class="filepond filepond-input-circle"
                                                            data-parsley-errors-container="#validation-error-image"
                                                            name="filepond" accept="image/png, image/jpeg, image/gif"
                                                            required />
                                                        <div class="" id="validation-error-image"></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="progress" style="display: none;">
                                                <div id="progressBar"
                                                    class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                    aria-valuemax="100" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <a href="<?php echo $back ?>"><button type="button"
                                                            class="btn btn-danger"> Cancel</button></a>
                                                    <button class="btn btn-primary" id="submit" type="submit">
                                                        Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="<?php echo base_url() ?>assets/libs/flatpickr/flatpickr.js"></script>
    <!-- filepond js -->
    <script src="<?php echo base_url() ?>assets/libs/filepond/filepond.min.js"></script>
    <script
        src="<?php echo base_url() ?>assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js">
    </script>
    <script
        src="<?php echo base_url() ?>assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="<?php echo base_url() ?>assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js">
    </script>
    <!-- ckeditor -->
    <script src="<?php echo base_url() ?>assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <script>
    var url = "<?php echo base_url() ?>";

    $('.select2').select2({
        width: '100%'
    });
    var ckClassicEditor = document.querySelectorAll(".ckeditor-classic");
    ckClassicEditor.forEach(function() {
        ClassicEditor.create(document.querySelector(".ckeditor-classic")).then(function(e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function(e) {
            console.error(e)
        })
    });


    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview
    );
    pond = FilePond.create(document.querySelector(".filepond-input-circle"), {
        labelIdle: 'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
        imagePreviewHeight: 170,
        imageCropAspectRatio: "1:1",
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        stylePanelLayout: "compact",
        styleLoadIndicatorPosition: "center bottom",
        styleProgressIndicatorPosition: "right bottom",
        styleButtonRemoveItemPosition: "left bottom",
        styleButtonProcessItemPosition: "right bottom",
    });

    //ADD PRODUCT
    $('#frmsaveProduct').on('submit', function(e) {
        e.preventDefault();
        if ($(this).parsley().isValid()) {
            var form = $(this)[0];
            var formData = new FormData(form);
            // append files array into the form data
            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                formData.append('img_product', pondFiles[i].file);
            }
            $(".progress").show();

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            var percent = Math.round((e.loaded / e.total) * 100);

                            $("#progressBar")
                                .attr("aria-valuenow", percent)
                                .css("width", percent + "%")
                                .text(percent + "%");
                        }
                    });
                    return xhr;
                },
                url: url + "product/create_action",
                data: formData,
                dataType: "JSON",
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (!(data.indexOf("Failed") != -1)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Add Product Sukses'
                        }).then(function() {
                            var uri = "<?php echo $back ?>"
                            window.location.href = uri;
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
    //END ADD PRODUCT
    </script>
</body>

</html>