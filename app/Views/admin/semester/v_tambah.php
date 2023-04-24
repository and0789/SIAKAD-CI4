<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <br>
</section>

<div class="row">
    <div class="col-sm-12">

        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <a href="<?= base_url('semester') ?>" class="btn btn-warning btn-sm"> <i
                                class="fa fa-backward"></i> Kembali</a>
                        <small class="pull-right">Date: <?php echo date('l, d / M / y') ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tambah Data Semester</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">

                                <?php
                                if (session()->getFlashdata('pesan')) {
                                    echo '<div class="alert alert-success" role="alert">';
                                    echo session()->getFlashdata('pesan');
                                    echo '</div>';
                                }
                                ?>

                                <?php echo form_open('semester/save') ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Semester</label>
                                    <input type="text" name="kode_semester" class="form-control
                                        <?= (session()->getFlashdata('errorKodeSemester')) ? 'is-invalid' : '' ?>"
                                           placeholder="Ex: 202301" value="<?= old('kode_semester') ?>" autofocus>
                                    <?= (session()->getFlashdata('errorKodeSemester')) ?
                                        "<div class='invalid-feedback'>" .
                                        session()->getFlashData('errorKodeSemester') . "</div>" : ''; ?>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Semester</label>
                                    <input type="text" name="nama_semester" class="form-control
                                        <?= (session()->getFlashdata('errorNamaSemester')) ? 'is-invalid' : '' ?>"
                                           placeholder="Ex: Ganjil 2022/2023" value="<?= old('nama_semester') ?>" >
                                    <?= (session()->getFlashdata('errorNamaSemester')) ?
                                        "<div class='invalid-feedback'>" .
                                        session()->getFlashData('errorNamaSemester') . "</div>" : ''; ?>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="mulai_semester" class="form-control
                                            <?= (session()->getFlashdata('errorMulaiSemester')) ? 'is-invalid' : '' ?>"
                                               placeholder="" value="<?= old('mulai_semester') ?>">
                                        <?= (session()->getFlashdata('errorMulaiSemester')) ?
                                            "<div class='invalid-feedback'>" .
                                            session()->getFlashData('errorMulaiSemester') . "</div>" : ''; ?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Tanggal Selesai</label>
                                        <input type="date" name="akhir_semester" class="form-control
                                            <?= (session()->getFlashdata('errorAkhirSemester')) ? 'is-invalid' : '' ?>"
                                               placeholder="" value="<?= old('akhir_semester') ?>">
                                        <?= (session()->getFlashdata('errorAkhirSemester')) ?
                                            "<div class='invalid-feedback'>" .
                                            session()->getFlashData('errorAkhirSemester') . "</div>" : ''; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
        </section>

    </div>
</div>

