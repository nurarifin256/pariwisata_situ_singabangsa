<script>
    $(window).scroll(function() {
        var wScroll = $(this).scrollTop();

        if (wScroll > $(".tiket").offset().top - 350) {
            $(".tiket .img-tiket").each(function(i) {
                setTimeout(function() {
                    $(".tiket .img-tiket").eq(i).addClass("muncul");
                }, 400 * (i + 1));
            });
        }

        if (wScroll > $(".acara").offset().top - 350) {
            $(".acara .img-acara").addClass("acmuncul");
        }

        if (wScroll > $(".cemilan").offset().top - 300) {
            $(".cemilan .cdodol").addClass("cdmuncul");
        }

        if (wScroll > $(".cemilan").offset().top - 150) {
            $(".cemilan .ctalas").addClass("ctmuncul");
        }

        if (wScroll > $(".alamat").offset().top - 150) {
            $(".alamat .ralamat").addClass("rmuncul");
        }
    });

    const flashData = $('.flash-data').data('flashdata');

    if (flashData) {
        Swal.fire({
            icon: 'success',
            title: 'Pesan Berhasil ' + flashData,
            text: 'Balasan dari admin akan dikirim lewat WA'
        })
    }
</script>