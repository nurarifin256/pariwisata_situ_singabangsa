<script>
    function validasiTanggal() {
        // var dtToday = new Date();
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#txtDate').attr('min', minDate);
        l
    }

    $('document').ready(function() {
        var harga = <?= $tiket["harga"] ?>;

        $("#jumlah").on('keyup', function() {

            var beli = $("#jumlah").val();
            if (beli > 0) {
                var total_bayar = (beli * harga);

                // var reverse = total_bayar.toString().split('').reverse().join(''),
                //     ribuan = reverse.match(/\d{1,3}/g);
                // ribuan = ribuan.join('.').split('').reverse().join('');

                $("#total_bayar").val(total_bayar);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jumlah',
                    text: 'Tidak boleh minus atau kosong',
                    width: '300px',
                    height: '300px'
                })
                beli = $("#jumlah").val(1);

                $("#total_bayar").val(harga);
            }
        })


    })
</script>