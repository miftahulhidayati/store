<!-- MODAL ADD USER GROUP -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUserGroup" role="dialog"
    aria-labelledby="lblmodalUserGroup" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalUserGroup">Add New User Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsaveUserGroup">
                    <div class="form-group">
                        <label>User Group<span style="color:red">*</span></label>
                        <input type="text" id="UgroupName" class="form-control" data-parsley-trigger="focusin focusout"
                            name="UgroupName" placeholder="User Group Name" required="" onfocusout="upper(this)"
                            style="text-transform: uppercase;">
                    </div>
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL ADD USER GROUP -->

<!-- MODAL EDIT USER GROUP -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUserGroupEdit" role="dialog"
    aria-labelledby="lblmodalUserGroupEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalUserGroupEdit">Edit User Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmeditUserGroup">
                    <input type="hidden" name="IDUserGroupEdit" id="IDUserGroupEdit" required="">
                    <div class="form-group">
                        <label>User Group<span style="color:red">*</span></label>
                        <input type="text" id="UgroupNameEdit" class="form-control" parsley-trigger="change"
                            name="UgroupName" placeholder="User Group Name" required="" onfocusout="upper(this)"
                            style="text-transform: uppercase;">
                    </div>
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary ml-2" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL EDIT USER GROUP -->