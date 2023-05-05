<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Manajemen Data Dosen
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card animate__animated animate__fadeIn" id="cardTampilData">
    <div class="card-header">
        <button type="button" class="btn btn-primary" id="btnTambah">
            <i class="fas fa-plus-circle"></i> Tambah Data
        </button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped" id="dataDosen">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Dosen</th>
                <th>Nama Dosen</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Telp/Hp</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<div id="cardTambahData" style="display: none;"></div>
<div id="cardEditData" style="display: none;"></div>

<script>
    $(document).ready(function () {
        $('#dataDosen').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= site_url('dosen/getData') ?>',
            ordered: [],
            columnDefs: [{
                targets: 0,
                orderable: false
            },]
        });

        $('#btnTambah').click(function (e) {
            e.preventDefault();
            $('#cardTampilData').hide();
            showFormTambah();
        });
    });

    function showFormTambah() {
        $.ajax({
            type: "get",
            url: '<?= site_url('dosen/formTambah') ?>',
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    $('#cardTambahData').html(response.data).show();
                }
            },
            error: function (e) {
                alert('Error \n' + e.responseText)
            }
        });
    }

    function hapusData(kode, nama) {
        swal({
            title: "Hapus data dosen",
            text: "Yakin menghapus data dosen dengan nama : " + nama + " ? ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "delete",
                        url: "<?= site_url('dosen/delete/') ?>" + kode,
                        dataType: "json",
                        success: function (response) {
                            if (response.error) {
                                swal({
                                    title: "Error",
                                    text: response.error,
                                    icon: "error",
                                });
                            }

                            if (response.success) {
                                swal({
                                    title: "Berhasil",
                                    text: response.success,
                                    icon: "success",
                                }).then((value) => {
                                    $('#dataDosen').DataTable().ajax.reload();
                                });
                            }
                        },
                        error: function (err) {
                            alert("Error : \n " + err.responseText);
                        }
                    });
                } else {
                    swal("Data Batal dihapus")
                }
            });
    }

    function editData(kode) {
        $('#cardTampilData').hide();
        $.ajax({
            type: "get",
            url: '<?= site_url('dosen/formEdit/') ?>' + kode,
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    $('#cardEditData').html(response.data).show();
                }
            },
            error: function (e) {
                alert('Error \n' + e.responseText)
            }
        });

    }

</script>

<?= $this->endSection() ?>
