<script>
    function hapus_user_pegawai(id_user) {
        // confirm("Yakin data akan dihapus ?")
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "User akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url('Auth/hapusUserPegawai') ?>", {
                    id_user: id_user
                }, function(data) {
                    if (data.pesan == "ok") {
                        Swal.fire(
                            'Hapus!',
                            'User berhasil dihapus.',
                            'success',
                        )
                        location.reload()

                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'User',
                        text: 'Gagal di hapus',
                        width: '300px',
                        height: '300px'
                    })
                    return false;
                })
            }
        })
    }

    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Tiket',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>