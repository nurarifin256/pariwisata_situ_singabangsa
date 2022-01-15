<script>
    $(document).ready(function() {
        $('#example').DataTable();

    });

    function hapusPesan(id_pesan) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Pesan akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url('Pesan/hapusPesan') ?>", {
                    id_pesan: id_pesan
                }, function(data) {
                    if (data.pesan == "ok") {
                        // Swal.fire(
                        //     'Hapus!',
                        //     'Cemilan berhasil dihapus.',
                        //     'success',
                        // )
                        reload();

                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesan',
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
            text: 'Pesan berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload()

            }
        });
    }
</script>