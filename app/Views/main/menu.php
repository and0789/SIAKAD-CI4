<ul class="sidebar-menu">
<!--    <li class="menu-header">Dashboard</li>-->
<!--    <li class="dropdown">-->
<!--        <a href="--><?php //= base_url('admin') ?><!-- " class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>-->
<!--    </li>-->


    <?php if (session()->level == 1) : ?>
        <li class="menu-header">Master</li>
<!--        <li class="dropdown">-->
<!--            <a href="--><?php //= site_url('mahasiswa/index') ?><!-- " class="nav-link">-->
<!--                <i class="fas fa-users"></i><span>Mahasiswa</span></a>-->
<!--        </li>-->
        <li class="dropdown">
            <a href="<?= site_url('dosen/index') ?> " class="nav-link">
                <i class="fas fa-users"></i><span>Data Dosen</span></a>
        </li>

<!--        <li class="menu-header">Setting</li>-->
<!--        <li class="dropdown">-->
<!--            <a href="--><?php //= site_url('periode/index') ?><!-- " class="nav-link">-->
<!--                <i class="fas fa-calendar"></i><span>Periode Semester</span></a>-->
<!--        </li>-->
    <?php endif; ?>
</ul>