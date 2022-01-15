<script>
    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: flashData + ' Berhasil',
            text: 'Ditambahkan ke keranjang',
            width: '300px',
            height: '300px'
        })
    }
</script>