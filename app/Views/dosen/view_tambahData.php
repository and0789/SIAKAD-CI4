<div class="card animate__animated animate__zoomIn">
    <div class="card-header">
        <button type="button" class="btn btn-warning" id="btnKembali">
            <i class="fas fa-arrow-left"></i> Kembali
        </button>
    </div>
    <div class="card-body">

        <?= form_open('dosen/save', [
            'id' => 'formDosen'
        ]) ?>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Kode Dosen</label>
            <div class="col-sm-6">
                <input type="text"
                       class="form-control"
                       id="kode_dosen"
                       name="kode_dosen"
                       placeholder="000001"
                       autofocus
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
                    <option value="">--Pilih--</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
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
                    name="alamat_dosen"
                ></textarea>
                <div class="invalid-feedback error_alamatDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">No Telp/WA</label>
            <div class="col-sm-6">
                <input type="text"
                       class="form-control"
                       id="telp_dosen"
                       name="telp_dosen"
                >
                <div class="invalid-feedback error_telpDosen">

                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="button btn-primary" id="btnSave">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>

        <?= form_close() ?>

    </div>
</div>

<script>
    $(function () {
        $('#btnKembali').click(function (e) {
            e.preventDefault();
            $('#cardTambahData').hide();
            $('#cardTampilData').show();
        });

        $('#formDosen').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",

                beforeSend: function () {
                    $('#btnSave')
                        .html('<i class="fas fa-spin fa-spinner"></i> Tunggu')
                        .prop('disable', true);
                },

                complete: function () {
                    $('#btnSave')
                        .html('<i class="fas fa-save"></i> Simpan')
                        .prop('disable', false);
                },

                success: function (response) {
                    if (response.error) {
                        let err = response.error;

                        if (err.error_kodeDosen) {
                            $('.error_kodeDosen').html(err.error_kodeDosen);
                            $('#kode_dosen').addClass('is-invalid');
                        } else {
                            $('.error_kodeDosen').html(err.error_kodeDosen);
                            $('#kode_dosen').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (err.error_namaDosen) {
                            $('.error_namaDosen').html(err.error_namaDosen);
                            $('#nama_dosen').addClass('is-invalid');
                        } else {
                            $('.error_namaDosen').html(err.error_namaDosen);
                            $('#nama_dosen').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (err.error_alamatDosen) {
                            $('.error_alamatDosen').html(err.error_alamatDosen);
                            $('#alamat_dosen').addClass('is-invalid');
                        } else {
                            $('.error_alamatDosen').html(err.error_alamatDosen);
                            $('#alamat_dosen').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (err.error_jkDosen) {
                            $('.error_jkDosen').html(err.error_jkDosen);
                            $('#jk_dosen').addClass('is-invalid');
                        } else {
                            $('.error_jkDosen').html(err.error_jkDosen);
                            $('#jk_dosen').removeClass('is-invalid').addClass('is-valid');
                        }

                        if (err.error_telpDosen) {
                            $('.error_telpDosen').html(err.error_telpDosen);
                            $('#telp_dosen').addClass('is-invalid');
                        } else {
                            $('.error_telpDosen').html(err.error_telpDosen);
                            $('#telp_dosen').removeClass('is-invalid').addClass('is-valid');
                        }
                    }

                    if (response.success) {
                        swal({
                            title: "Berhasil",
                            text: response.success,
                            icon: "success"
                        }).then((value) => {
                            $('#cardTambahData').hide();
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
