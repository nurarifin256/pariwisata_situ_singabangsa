<script>
    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Acara',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    function hapusAcara(id_acara) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Acara akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url('Tambah/hapusAcara') ?>", {
                    id_acara: id_acara
                }, function(data) {
                    if (data.pesan == "ok") {
                        // Swal.fire(
                        //     'Hapus!',
                        //     'Acara berhasil dihapus.',
                        //     'success',
                        // )
                        reload()

                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acara',
                        text: 'Gagal di hapus',
                        width: '300px',
                        height: '300px'
                    })
                    return false;
                })
            }
        })
    }

    function reload() {
        Swal.fire({
            icon: 'success',
            title: 'Hapus!',
            text: 'Acara berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload()

            }
        });
        // location.reload()
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>