<script>
    function hapusCemilan(id_cemilan) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Cemilan akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url('Toko2/hapusCemilanByIdToko') ?>", {
                    id_cemilan: id_cemilan,
                }, function(data) {
                    if (data.pesan == "ok") {
                        console.log(data.pesan)
                        reload();
                    }
                }, "json").fail(function(data) {
                    console.log(data.pesan);
                    Swal.fire({
                        icon: 'error',
                        title: 'Cemilan',
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
            text: 'Cemilan berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload()

            }
        });
    }

    function previewImg() {
        const sampul = document.querySelector('#sampul');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Profil Toko',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    const flashDataa = $('.flash-dataa').data('flashdata');

    if (flashDataa) {
        Swal.fire({
            icon: 'success',
            title: 'Cemilan',
            text: 'Berhasil ' + flashDataa,
            width: '300px',
            height: '300px'
        })
    }

    const flashDataaa = $('.flash-dataaa').data('flashdata');

    if (flashDataaa) {
        Swal.fire({
            icon: 'success',
            title: 'Pesanan',
            text: 'Berhasil ' + flashDataaa,
            width: '300px',
            height: '300px'
        })
    }


    const flashDataaaa = $('.flash-dataaaa').data('flashdata');

    if (flashDataaaa) {
        Swal.fire({
            icon: 'success',
            title: 'No Resi',
            text: 'Berhasil ' + flashDataaaa,
            width: '300px',
            height: '300px'
        })
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>