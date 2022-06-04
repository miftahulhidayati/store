<!-- MODAL ADD CATEGORY PRODUCT -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalCategoryProduct" role="dialog"
    aria-labelledby="lblmodalCategoryProduct" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalCategoryProduct">Add Data Category Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsavePangkat">
                    <div class="form-group">
                        <label>Code<span style="color:red">*</span></label>
                        <input type="text" id="code" class="form-control" data-parsley-trigger="focusin focusout"
                            name="code" placeholder="Code Category Product" required="" onfocusout="upper(this)"
                            style="text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Name<span style="color:red">*</span></label>
                        <input type="text" id="name" class="form-control" data-parsley-trigger="focusin focusout"
                            name="name" placeholder="Name Category Product" required="">
                    </div>
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL ADD CATEGORY PRODUCT -->

<!-- MODAL EDIT CATEGORY PRODUCT -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalCategoryProductEdit" role="dialog"
    aria-labelledby="lblmodalCategoryProductEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalCategoryProductEdit">Update Data Category Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmeditCategoryProduct">
                    <input type="hidden" name="id_category_product" id="IDEdit" required="">
                    <div class="form-group">
                        <label>Code<span style="color:red">*</span></label>
                        <input type="text" id="code_classEdit" class="form-control"
                            data-parsley-trigger="focusin focusout" name="code" placeholder="Code Category Product"
                            required="" onfocusout="upper(this)" style="text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                        <label>Name<span style="color:red">*</span></label>
                        <input type="text" id="name_classEdit" class="form-control"
                            data-parsley-trigger="focusin focusout" name="name" placeholder="Name Category Product"
                            required="">
                    </div>
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL EDIT CATEGORY PRODUCT -->