<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <br>
</section>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"> Data Semester</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" onclick="window.location='semester/formtambah' ">
                        <i class="fa fa-plus"></i>
                        <b> Tambah</b>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="50px" class="text-center">No</th>
                        <th>Kode Semester</th>
                        <th>Nama Semester</th>
                        <th>Tgl. Mulai</th>
                        <th>Tgl. Seelsai</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                    foreach ($data_semester as $key => $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['kode_semester'] ?></td>
                            <td><?= $value['nama_semester'] ?></td>
                            <td><?= $value['mulai_semester'] ?></td>
                            <td><?= $value['akhir_semester'] ?></td>
                            <td>
                                <?php if ($value['aktif_semester'] == 'Y') : ?>
                                    <span class="btn btn-success btn-sm">Aktif</span>
                                <?php else : ?>
                                    <span class="btn btn-danger btn-sm">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">

                                <button class="btn btn-warning btn-sm btn-flat"
                                        data-toggle="modal"
                                        data-target="#edit<?= $value['id_semester'] ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-flat"
                                        data-toggle="modal"
                                        data-target="#delete<?= $value['id_semester'] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>



 Modal DELETE
<?php foreach ($data_semester as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_semester'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Semester</h4>
                </div>
                <div class="modal-body">

                    Apakah Anda Yankin Ingin Menghapus <?= $title ?> <b><?= $value['nama_semester'] ?> ? </b>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('semester/delete/' . $value['id_semester']) ?>"
                       class="btn btn-success">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>


<!-- Modal EDIT -->
<?php foreach ($data_semester as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_semester'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Gedung</h4>
                </div>
                <div class="modal-body">

                    <?php
                    echo form_open('semester/edit/'. $value['id_semester'])
                    ?>

                    <div class="form-group">

                        <label>Kode Semester</label>
                        <input type="text" name="kode_semester" value="<?= $value['kode_semester'] ?>"
                               class="form-control"  required>

                        <label>Nama Semester</label>
                        <input type="text" name="nama_semester" value="<?= $value['nama_semester'] ?>"
                               class="form-control"  required>

                        <label>Awal Semester</label>
                        <input type="date" name="mulai_semester" value="<?= $value['mulai_semester'] ?>"
                               class="form-control"  required>

                        <label>Akhir Semester</label>
                        <input type="date" name="akhir_semester" value="<?= $value['akhir_semester'] ?>"
                               class="form-control"  required>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

                <?php echo form_close() ?>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
