<script>
    function hapusWahana(id_tiket) {
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
                $.post("<?= base_url('Wahana/hapusWahana') ?>", {
                    id_tiket: id_tiket
                }, function(data) {
                    if (data.pesan == "ok") {
                        // Swal.fire(
                        //     'Hapus!',
                        //     'Wahana berhasil dihapus.',
                        //     'success',
                        // )
                        reload()

                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Wahana',
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
            text: 'Wahana berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload()

            }
        });
        // location.reload()
    }

    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Wahana',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>