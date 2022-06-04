<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo base_url() ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>assets/images/logo-square-color.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>assets/images/logo-color.png" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo base_url() ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>assets/images/logo-square.png" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>assets/images/logo-white.png" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <?php
                if (isset($_SESSION['navMenu'])) { ?>
                <?php foreach ($_SESSION['navMenu'] as $row) { ?>

                <?php if ($row['CHILD'] != null) { ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#MENU<?php echo $row['ID'] ?>" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="MENU<?php echo $row['ID'] ?>">
                        <i class="<?php echo $row['ICON'] ?>"></i> <span
                            data-key="t-apps"><?php echo $row['NAME'] ?></span>
                    </a>

                    <div class="collapse menu-dropdown" id="MENU<?php echo $row['ID'] ?>">
                        <ul class="nav nav-sm flex-column">

                            <?php foreach ($row['CHILD'] as $MSM) { ?>
                            <?php if ($MSM['CHILD'] != null) { ?>
                            <!-- <div class="collapse menu-dropdown" id="MENU<?php echo $row['ID'] ?>"> -->
                            <!-- <ul class="nav nav-sm flex-column"> -->
                            <li class="nav-item">
                                <a href="#MENU<?php echo $MSM['ID'] ?>" class="nav-link third" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="MENU<?php echo $MSM['ID'] ?>"
                                    data-key="MENU<?php echo $MSM['ID'] ?>">
                                    <?php echo $MSM['NAME']; ?>
                                </a>
                                <div class="collapse menu-dropdown" id="MENU<?php echo $MSM['ID'] ?>">
                                    <ul class="nav nav-sm flex-column">
                                        <?php foreach ($MSM['CHILD'] as $SSM) { ?>
                                        <li class="nav-item"><a class="nav-link"
                                                href="<?php echo ($SSM['LINK'] == '#') ? '#' : base_url($SSM['LINK']); ?>"><?php echo $SSM['NAME'] ?></a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>

                            <?php } else { ?>
                            <li class="nav-item">
                                <a href="<?php echo ($MSM['LINK'] == '#') ? '#' : base_url($MSM['LINK']); ?>"
                                    class="nav-link" data-key="t-calendar"> <?php echo $MSM['NAME'] ?>
                                </a>
                            </li>


                            <?php } ?>
                            <?php } ?>

                        </ul>
                    </div>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link menu-link"
                        href="<?php echo ($row['LINK'] == '#') ? '#' : base_url($row['LINK']); ?>">
                        <i class="<?php echo $row['ICON'] ?>"></i> <span
                            data-key="t-widgets"><?php echo $row['NAME'] ?></span>
                    </a>
                </li>
                <?php } ?>

                <?php } ?>

                <?php } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>