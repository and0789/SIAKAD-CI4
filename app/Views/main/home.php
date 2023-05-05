<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Welcome
<?= $this->endsection() ?>


<?= $this->section('content') ?>

<div class="alert alert-success">
    Selamat Datang <?= session()->get('nama_user') ?>
</div>

<?= $this->endsection() ?>
