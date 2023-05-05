<div class="card animate__animated animate__zoomIn">
    <div class="card-header">
        <button type="button" class="btn btn-warning" id="tombolKembali">
            <i class="fas fa-arrow-left"></i> Kembali
        </button>
    </div>
    <div class="card-body">


        <?= form_open('dosen/update', [
            'id' => 'formEditDosen'
        ])
        ?>

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Kode Dosen</label>
            <div class="col-sm-6">
                <input type="text"
                       class="form-control"
                       id="kode_dosen"
                       name="kode_dosen" placeholder="Ex: 000001"
                       value="<?= $kode_dosen ?>"
                       readonly
                >
                <div class="invalid-feedback error_kodeDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nama Dosen</label>
            <div class="col-sm-6">
                <input type="text"
                       class="form-control"
                       id="nama_dosen"
                       name="nama_dosen"
                       value="<?= $nama_dosen ?>"
                >
                <div class="invalid-feedback error_namaDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-4">
                <select class="form-control"
                        name="jk_dosen"
                        id="jk_dosen">
                    <option value="L"
                        <?= ($jk_dosen == 'L') ? 'selected' : '' ?>
                    >Laki-laki
                    </option>
                    <option value="P"
                        <?= ($jk_dosen == 'P') ? 'selected' : '' ?>
                    >Perempuan
                    </option>
                </select>
                <div class="invalid-feedback error_jkDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-6">
                <textarea
                    class="form-control"
                    id="alamat_dosen"
                    name="alamat_dosen"><?= $alamat_dosen ?>
                </textarea>
                <div class="invalid-feedback error_alamatDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">No. Telp/HP</label>
            <div class="col-sm-6">
                <input type="text"
                       class="form-control"
                       id="telp_dosen"
                       name="telp_dosen"
                       value="<?= $telp_dosen ?>"
                >
                <div class="invalid-feedback error_telpDosen">

                </div>
            </div>
        </div>


        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success" id="btnUpdate">
                    <i class="fas fa-save"> </i> Update
                </button>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>

<script>
    $(function () {

        $('#tombolKembali').click(function (e) {
            e.preventDefault();
            $('#cardEditData').hide();
            $('#cardTampilData').show();
        });

        $('#formEditDosen').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('#btnUpdate')
                        .html('<i class="fas fa-spin fa-spinner"></i> Tunggu')
                        .prop('disable', true);
                },
                complete: function () {
                    $('#btnUpdate').html('<i class="fas fa-edit"> </i> Update')
                        .prop('disable', false);
                },
                success: function (response) {
                    if (response.error) {
                        let err = response.error;


                        if (err.error_namaDosen) {
                            $('.error_namaDosen')
                                .html(err.error_namaDosen);
                            $('#nama_dosen')
                                .addClass('is-invalid');
                        } else {
                            $('.error_namaDosen')
                                .html(err.error_namaDosen);
                            $('#nama_dosen')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }

                        if (err.error_alamatDosen) {
                            $('.error_alamatDosen')
                                .html(err.error_alamatDosen);
                            $('#alamat_dosen')
                                .addClass('is-invalid');
                        } else {
                            $('.error_alamatDosen')
                                .html(err.error_alamatDosen);
                            $('#alamat_dosen')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }

                        if (err.error_telpDosen) {
                            $('.error_telpDosen')
                                .html(err.error_telpDosen);
                            $('#telp_dosen')
                                .addClass('is-invalid');
                        } else {
                            $('.error_telpDosen')
                                .html(err.error_telpDosen);
                            $('#telp_dosen')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }

                        if (err.error_jkDosen) {
                            $('.error_jkDosen')
                                .html(err.error_jkDosen);
                            $('#jk_dosen')
                                .addClass('is-invalid');
                        } else {
                            $('.error_jkDosen')
                                .html(err.error_jkDosen);
                            $('#jk_dosen')
                                .removeClass('is-invalid')
                                .addClass('is-valid');
                        }
                    }

                    if (response.success) {
                        swal({
                            title: "Berhasil!",
                            text: response.success,
                            icon: "success",
                        }).then((value) => {
                            $('#cardEditData').hide();
                            $('#cardTampilData').show();
                            $('#dataDosen').DataTable().ajax.reload();
                        });
                    }
                },
                error: function (e) {
                    alert('Error \n' + e.responseText);
                }
            });

            return false;
        });

    });
</script>