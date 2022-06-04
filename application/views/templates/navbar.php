<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?php echo base_url() ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo base_url() ?>assets/images/logo-square-color.png" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>assets/images/logo-color.png" alt="" height="50">
                        </span>
                    </a>

                    <a href="<?php echo base_url() ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo base_url() ?>assets/images/logo-square.png" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>assets/images/logo-white.png" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" avatar="<?php echo $_SESSION['name'] ?>"
                                alt="Avatar" />


                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $_SESSION['name'] ?></span>
                                <span
                                    class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?php echo $_SESSION['position'] ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo $_SESSION['name'] ?>!</h6>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="openEditData('<?php echo $_SESSION['iduser'] ?>')">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span>
                        </a>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalchPass"
                            href="javascript:void(0);"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Change Password</span></a>
                        <a class="dropdown-item" href="<?php echo base_url('login/sessDestroy') ?>"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- MODAL CHANGE PROFILE -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalchProfile" role="dialog"
    aria-labelledby="lblmodalchProfile" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalchProfile">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsavechProfile">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="chProfilenamee" class="form-control" parsley-trigger="change"
                            name="chProfilenamee" placeholder="Fullname" required="">
                        <input type="hidden" name="IDchProfile" id="IDchProfile" required="">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="chProfileemailAddress" class="form-control"
                                    parsley-trigger="change" name="chProfileemailAddress"
                                    placeholder="example@example.com" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" id="chProfilepositionUser" class="form-control"
                                    parsley-trigger="change" name="chProfilepositionUser" placeholder="Position"
                                    required="">
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger ml-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL CHANGE PROFILE -->

<!-- MODAL CHANGE PASS -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalchPass" role="dialog"
    aria-labelledby="lblmodalchPass" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblmodalchPass">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form class="parsleyy" data-parsley-validate="" novalidate="" id="frmsavechPass">

                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" id="chPass" class="form-control" parsley-trigger="change" name="chPass"
                            required="" placeholder="Old Password">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" id="NewchPass" class="form-control passwordvalidator"
                                    parsley-trigger="change" data-parsley-minlength="5" data-parsley-maxlength="12"
                                    data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1"
                                    data-parsley-special="1" name="NewchPass" required="" placeholder="New Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Repeat New Password</label>
                                <input type="password" id="RechPass" class="form-control passwordvalidator"
                                    parsley-trigger="change" data-parsley-equalto="#NewchPass"
                                    data-parsley-minlength="5" data-parsley-maxlength="12" data-parsley-uppercase="1"
                                    data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" required
                                    name="RechPass" placeholder="Re-enter New  Password">
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                    <div class="rows" style="float: right;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger ml-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL CHANGE PASS -->