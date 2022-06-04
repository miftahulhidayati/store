<!-- MODAL ADD USERS -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUsers2" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsaveUser">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username<span style="color:red">*</span></label>
                                <input type="text" id="uname" class="form-control" parsley-trigger="change" name="uname"
                                    placeholder="Username" required="" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name<span style="color:red">*</span></label>
                                <input type="text" id="namee" class="form-control" parsley-trigger="change" name="namee"
                                    placeholder="Fullname" required="" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<span style="color:red">*</span></label>
                                <input type="email" id="emailAddress" class="form-control" parsley-trigger="change"
                                    name="emailAddress" placeholder="example@example.com" required=""
                                    onfocusout="upper(this)" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" id="positionUser" class="form-control" parsley-trigger="change"
                                    name="positionUser" placeholder="Position" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Group<span style="color:red">*</span></label>
                                <select id="groupUser" class="form-control mb-3 select2"
                                    style="width: 100%; line-height:1.5;"
                                    data-parsley-errors-container="#validation-error-usergroup" parsley-trigger="change"
                                    name="groupUser" required="">
                                    <option selected disabled>Select Option</option>
                                    <?php
                                    foreach ($uGroup as $row) { ?>
                                    <option value="<?php echo $row->ID ?>"><?php echo $row->USER_GROUP_NAME; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="" id="validation-error-usergroup"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password<span style="color:red">*</span></label>
                                <input type="password" id="inputPassword32" class="form-control passwordvalidator"
                                    parsley-trigger="change" data-parsley-minlength="5" data-parsley-maxlength="12"
                                    data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1"
                                    data-parsley-special="1" name="password" required="" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Re-enter Password<span style="color:red">*</span></label>
                                <input type="password" id="repassword" class="form-control passwordvalidator"
                                    parsley-trigger="change" data-parsley-equalto="#inputPassword32"
                                    data-parsley-minlength="5" data-parsley-maxlength="12" data-parsley-uppercase="1"
                                    data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1"
                                    name="retypepassword" required placeholder="Re-enter Password">
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-soft-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-soft-secondary ml-2 btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL ADD USERS -->

<!-- MODAL EDIT USERS -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalEditUser" role="dialog"
    aria-labelledby="lblmodalUsersEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalUsersEdit">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmeditUser">
                    <input type="hidden" name="IDUserEdit" id="IDUserEdit" required="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username<span style="color:red">*</span></label>
                                <input type="text" id="unameEdit" class="form-control" parsley-trigger="change"
                                    name="uname" placeholder="Username" required="" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name<span style="color:red">*</span></label>
                                <input type="text" id="nameeEdit" class="form-control" parsley-trigger="change"
                                    name="namee" placeholder="Fullname" required="" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email<span style="color:red">*</span></label>
                                <input type="email" id="emailAddressEdit" class="form-control" parsley-trigger="change"
                                    name="emailAddress" placeholder="example@example.com" required=""
                                    onfocusout="upper(this)" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" id="positionUserEdit" class="form-control" parsley-trigger="change"
                                    name="positionUser" placeholder="Position" onfocusout="upper(this)"
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Group<span style="color:red">*</span></label>
                                <select id="groupUserEdit" class="form-control select22 mb-3"
                                    style="width: 100%; line-height:1.5;"
                                    data-parsley-errors-container="#validation-error-usergroup-edit"
                                    parsley-trigger="change" name="groupUser" required="">
                                    <?php foreach ($uGroup as $row) { ?>
                                    <option value="<?php echo $row->ID ?>"><?php echo $row->USER_GROUP_NAME; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="" id="validation-error-usergroup-edit"></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="inputPassword32Edit" data-parsley-equalto="#repasswordEdit"
                                    class="form-control passwordvalidator" parsley-trigger="change"
                                    data-parsley-minlength="5" data-parsley-maxlength="12" data-parsley-uppercase="1"
                                    data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1"
                                    name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Re-enter Password</label>
                                <input type="password" id="repasswordEdit" class="form-control" parsley-trigger="change"
                                    data-parsley-equalto="#inputPassword32Edit" data-parsley-minlength="5"
                                    data-parsley-maxlength="12" data-parsley-uppercase="1" data-parsley-lowercase="1"
                                    data-parsley-number="1" data-parsley-special="1" name="retypepassword"
                                    placeholder="Re-enter Password">
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-soft-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-soft-secondary btn-sm ml-2"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL EDIT USERS -->