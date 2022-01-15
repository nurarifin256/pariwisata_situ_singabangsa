<script>
    function updateTanggal(urut) {
        tanggal = $("#tanggal_ked_" + urut).val();
        id_detail_pesanan_tiket = $("#id_detail_pesanan_tiket_" + urut).val()
        id_tiket = $("#id_tiket_" + urut).val()

        $.ajax({
            url: "<?= base_url('Pesanan/updateTanggal') ?>",
            type: "post",
            data: $("#pesanan_tiket").serialize() + "&tanggal_ked=" + tanggal + "&id_detail_pesanan_tiket_urut=" + id_detail_pesanan_tiket + "&id_tiket_urut=" + id_tiket,
        })
    }

    function updateJam(no) {
        jam = $("#jam_" + no).val();
        id_detail_pesanan_tiket = $("#id_detail_pesanan_tiket_" + no).val()
        id_tiket = $("#id_tiket_" + no).val()

        $.ajax({
            url: "<?= base_url('Pesanan/updateJam') ?>",
            type: "post",
            data: $("#pesanan_tiket").serialize() + "&jam=" + jam + "&id_detail_pesanan_tiket=" + id_detail_pesanan_tiket + "&id_tiket=" + id_tiket,
        })
    }

    $(document).ready(function() {
        $(".e-tiket").on('click', function() {
            const nama = $(this).data('nama');
            const nama_pembeli = $(this).data('nama-pembeli');
            const jumlah = $(this).data('jumlah');
            const foto = $(this).data('foto');
            const tanggal = $(this).data('tanggal');
            const jam = $(this).data('jam');
            const status = $(this).data('status');

            $('.nama').text(nama);
            $('.nama_pembeli').text(nama_pembeli);
            $('.jumlah').text(jumlah);
            $('.tanggal').text(tanggal);
            $('.jam').text(jam + " WIB");
            $('.status').text(status);
            $('#pict').attr("src", "<?= base_url() ?>assets/img/" + foto);
            // $('#exampleModal').modal('show');
        });
    });
</script>