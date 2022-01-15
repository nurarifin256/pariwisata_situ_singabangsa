<script>
    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Toko',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>