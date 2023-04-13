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
                <h3 class="box-title"> Data <?= $title ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#add">
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
                        <th>Gedung</th>
                        <th width="150px" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                    foreach ($gedung as $key => $value) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['gedung'] ?></td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-sm btn-flat"
                                    data-toggle="modal"
                                    data-target="#edit<?= $value['id_gedung'] ?>">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-flat"
                                    data-toggle="modal"
                                    data-target="#delete<?= $value['id_gedung'] ?>">
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

<!-- Modal ADD -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Gedung</h4>
            </div>
            <div class="modal-body">

                <?php echo form_open('gedung/add') ?>

                <div class="form-group">
                    <label>Gedung</label>
                    <input type="text" name="gedung" class="form-control" placeholder="Gedung" required>
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

<!-- Modal EDIT -->
<?php foreach ($gedung as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value['id_gedung'] ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Gedung</h4>
            </div>
            <div class="modal-body">

                <?php
                    echo form_open('gedung/edit/'. $value['id_gedung'])
                ?>

                <div class="form-group">
                    <label>Gedung</label>
                    <input type="text" name="gedung" value="<?= $value['gedung'] ?>"
                           class="form-control" placeholder="Gedung" required>
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


<!-- Modal DELETE -->
<?php foreach ($gedung as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_gedung'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Gedung</h4>
                </div>
                <div class="modal-body">

                    Apakah Anda Yankin Ingin Menghapus <?= $title ?> <b><?= $value['gedung'] ?> ? </b>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gedung/delete/' . $value['id_gedung']) ?>"
                       class="btn btn-success">Delete</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>
