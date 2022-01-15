<script>
    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Cemilan',
            text: 'Berhasil ' + flashData,
            width: '300px',
            height: '300px'
        })
    }

    const flashDataa = $('.flash-dataa').data('flashdataa');

    if (flashDataa) {
        Swal.fire({
            icon: 'success',
            title: 'No Resi',
            text: 'Berhasil ' + flashDataa,
            width: '300px',
            height: '300px'
        })
    }

    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>