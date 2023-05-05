<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aplikasi Siakad</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
          href="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.min.css">


    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/sweetalert/sweetalert.min.js"></script>


    <!-- JS Libraies -->
    <script src="<?= base_url() ?>assets/modules/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>


<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">


            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                class="fas fa-search"></i></a></li>
                </ul>


            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png"
                             class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">
                            Hi, <?= strtoupper(session()->get('nama')) ?>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Group : <?php
                            if (session()->get('level') == 1) {
                                echo 'ADMIN';
                            } elseif (session()->get('level') == 2) {
                                echo 'MAHASISWA';
                            } elseif (session()->get('level') == 3) {
                                echo 'DOSEN';
                            }
                            ?>  </div>

                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href=" <?= site_url('admin') ?> ">SIAKAD</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="<?= site_url('admin') ?> ">SIAK</a>
                </div>

                <?= $this->include('main/menu') ?>

            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>
                        <?= $this->renderSection('title') ?>
                    </h1>
                </div>

                <div class="section-body">

                    <?= $this->renderSection('content') ?>

                </div>
            </section>
        </div>


        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2023
                <div class="bullet"></div>
                Design By Andre Septian</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->

<script src="<?= base_url() ?>assets/modules/popper.js"></script>
<script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
<script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>
</html>