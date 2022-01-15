<script>
    function validasiTanggal(no) {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#tanggal_d_' + no).attr('min', minDate);
        l
    }

    function validasiJumlah(urut) {
        harga = $("#harga_det_" + urut).val();
        beli = $("#jumlah_det_" + urut).val();

        if (beli > 0) {
            sum_total(urut);
            updateJumlahTiket(urut);
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Jumlah',
                text: 'Tidak kosong',
                width: '300px',
                height: '300px'
            })
            $("#jumlah_det_" + urut).val(1);
            sum_total(urut);
            updateJumlahTiket(urut);
        }

    }

    function validasiJumlahCem(no) {
        beli_cemilan = $("#jumlah_cem_" + no).val()
        harga_cemilan = $("#harga_cem_" + no).val()

        if (beli_cemilan > 0) {
            jumlah_total(no)
            jumlah_berat(no)
            updateJumlahCemilan(no)
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Jumlah',
                text: 'Tidak kosong',
                width: '300px',
                height: '300px'
            })
            $("#jumlah_cem_" + no).val(1)
            jumlah_total(no)
            jumlah_berat(no)
            updateJumlahCemilan(no)
        }
    }

    function updateTanggal(urut) {
        tanggal = $("#tanggal_d_" + urut).val();
        id_keranjang_tiket = $("#id_keranjang_tiket_" + urut).val()
        id_tiket = $("#id_tiket_" + urut).val()

        $.ajax({
            url: "<?= base_url('Keranjang/updateTanggal') ?>",
            type: "post",
            data: $("#keranjang_tiket").serialize() + "&tanggal_d=" + tanggal + "&id_keranjang_tiket_urut=" + id_keranjang_tiket + "&id_tiket_urut=" + id_tiket,
        })
    }

    function updateJam(no) {
        jam = $("#jam_" + no).val();
        id_keranjang_tiket = $("#id_keranjang_tiket_" + no).val()
        id_tiket = $("#id_tiket_" + no).val()

        $.ajax({
            url: "<?= base_url('Keranjang/updateJam') ?>",
            type: "post",
            data: $("#keranjang_tiket").serialize() + "&jam=" + jam + "&id_keranjang_tiket=" + id_keranjang_tiket + "&id_tiket=" + id_tiket,
        })
    }

    function sum_total(urut) {
        jumlah = $("#jumlah_det_" + urut).val()
        harga = $("#harga_det_" + urut).val()

        $.ajax({
            url: "<?= base_url('Keranjang/totalAll') ?>",
            type: "post",
            data: $("#keranjang_tiket").serialize() + "&jumlah_det_urut=" + jumlah + "&harga_det_urut=" + harga,
            dataType: "json",
            success: function(data) {
                $("#total_bayar_" + urut).val(data.total_bayar)
                get_total_all();
            }
        })
    }

    function get_total_all() {
        $.post("<?= base_url('keranjang/getTotalAll') ?>",
            $("#keranjang_tiket").serialize(),
            function(data) {
                $("#total_all").val(data.total_all);
            }, "json")
    }

    function updateJumlahTiket(urut) {
        jumlah = $("#jumlah_det_" + urut).val()
        id_keranjang_tiket = $("#id_keranjang_tiket_" + urut).val()
        id_tiket = $("#id_tiket_" + urut).val()
        harga = $("#harga_det_" + urut).val()

        $.ajax({
            url: "<?= base_url('Keranjang/updateJumlahTiket') ?>",
            type: "post",
            data: $("#keranjang_tiket").serialize() + "&jumlah_det_urut=" + jumlah + "&id_keranjang_tiket_urut=" + id_keranjang_tiket + "&id_tiket_urut=" + id_tiket + "&harga_det_urut=" + harga
        })
    }

    function updateJumlahCemilan(no) {
        jumlah_c = $("#jumlah_cem_" + no).val()
        harga_c = $("#harga_cem_" + no).val()
        id_keranjang_cemilan = $("#id_keranjang_cemilan_" + no).val()
        id_cemilan = $("#id_cemilan_" + no).val()

        $.ajax({
            url: "<?= base_url('Keranjang/updateJumlahCem') ?>",
            type: "post",
            data: $("#keranjang_cemilan").serialize() + "&jumlah_cem=" + jumlah_c + "&harga_cem=" + harga_c + "&id_keranjang_cem=" + id_keranjang_cemilan + "&id_cemilan=" + id_cemilan
        })
    }

    function hapus_keranjang_tiket(id_keranjang_tiket, id_tiket) {
        // confirm("Yakin data akan dihapus ?")
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Tiket akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url('Keranjang/hapusKeranjangTiket') ?>", {
                    id_keranjang_tiket: id_keranjang_tiket,
                    id_tiket: id_tiket
                }, function(data) {
                    if (data.pesan == "ok") {
                        // Swal.fire(
                        //     'Hapus!',
                        //     'Tiket berhasil dihapus.',
                        //     'success',
                        // )
                        // console.log(data.pesan)
                        reload();
                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tiket',
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
        // console.log("a")
        Swal.fire({
            icon: 'success',
            title: 'Hapus!',
            text: 'Tiket berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                // console.log("b")
                location.reload()

            }
        });
        // location.reload()
    }

    function hapus_keranjang_cemilan(id_keranjang_cemilan, id_cemilan) {
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
                $.post("<?= base_url('Keranjang/hapusKeranjangCemilan') ?>", {
                    id_keranjang_cemilan: id_keranjang_cemilan,
                    id_cemilan: id_cemilan
                }, function(data) {
                    if (data.pesan == "ok") {
                        // Swal.fire(
                        //     'Hapus!',
                        //     'Cemilan berhasil dihapus.',
                        //     'success',
                        // )
                        reloadd();
                    }
                }, "json").fail(function(data) {
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

    function reloadd() {
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

    function hapusPesananByToko($id_toko) {
        console.log($id_toko);
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
                $.post("<?= base_url('Keranjang/hapusPesananCemilanByidToko') ?>", {
                    id_toko: id_toko
                }, function(data) {
                    if (data.pesan == "ok") {
                        reloaddd();
                    }
                }, "json").fail(function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesanan',
                        text: 'Gagal di hapus',
                        width: '300px',
                        height: '300px'
                    })
                    return false;
                })
            }
        })
    }

    function reloaddd() {
        Swal.fire({
            icon: 'success',
            title: 'Hapus!',
            text: 'Pesanan berhasil dihapus.',
            width: '300px',
            height: '300px'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload()
            }
        });
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    function jumlah_total(no) {
        jumlah_c = $("#jumlah_cem_" + no).val()
        harga_c = $("#harga_cem_" + no).val()

        $.ajax({
            url: "<?= base_url('Keranjang/jumlahAll') ?>",
            type: "post",
            data: $("#keranjang_cemilan").serialize() + "&jumlah_cem=" + jumlah_c + "&harga_cem=" + harga_c,
            dataType: "json",
            success: function(data) {
                $("#total_bayarr_" + no).val(data.total_bayarr)
                jumlah_total_all();
                // eks();
            }
        })


    }

    function jumlah_total_all() {
        $.post("<?= base_url('Keranjang/jumlahTotalAll') ?>", $("#keranjang_cemilan").serialize(),
            function(data) {
                $("#jumlah_totall").val(data.jumlah_totall);
            }, "json")
    }

    function jumlah_berat(no) {
        jumlah_c = $("#jumlah_cem_" + no).val()
        berat_c = $("#berat_cem_" + no).val()

        $.ajax({
            url: "<?= base_url('Keranjang/jumlahBerat') ?>",
            type: "post",
            data: $("#keranjang_cemilan").serialize() + "&jumlah_cem=" + jumlah_c + "&berat_cem=" + berat_c,
            dataType: "json",
            success: function(data) {
                $("#sub_berat_" + no).val(data.sub_berat)
                jumlah_berat_all();
                get_ongkir(data.sub_berat)
            }
        })
    }

    // $("select[name=ekspedisi]").on("change", function() {
    function get_ongkir(berat) {
        // mendapatkan ekspedisi terpilih
        var ekspedisi_terpilih = $("select[name=ekspedisi]").val();

        // mendapatkan id kota tujuan
        var kota_tujuan = $("option:selected", "select[name=kota]").attr("id_kota");

        // mendapatkan data berat
        var berat_pengiriman = berat;
        // alert(berat_pengiriman);

        $.ajax({
            type: "post",
            url: "<?= base_url('RajaOngkir/paket') ?>",
            data: "ekspedisi=" + ekspedisi_terpilih + "&id_kota=" + kota_tujuan + "&berat=" + berat_pengiriman,
            success: function(hasil_paket) {
                $("select[name=jenis]").html(hasil_paket);
            }
        })

        $("#ongkir").val(0);
        $("#tot_bayar").val(0);


    }
    // });


    function jumlah_berat_all() {
        $.post("<?= base_url('Keranjang/jumlahBeratAll') ?>", $("#keranjang_cemilan").serialize(),
            function(data) {
                $("#jumlah_beratt").val(data.sub_berat);
            }, "json")
    }

    $(document).ready(function() {
        $.ajax({
            type: "post",
            url: "<?= base_url('RajaOngkir/provinsi') ?>",
            success: function(hasil_provinsi) {
                // console.log(hasil_provinsi);
                $("select[name=provinsi]").html(hasil_provinsi);
            }
        })

        $("select[name=provinsi]").on("change", function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

            $.ajax({
                type: "post",
                url: "<?= base_url('RajaOngkir/kota') ?>",
                data: "id_provinsi=" + id_provinsi_terpilih,
                success: function(hasil_kota) {
                    $("select[name=kota]").html(hasil_kota);
                }
            })
        });

        $("select[name=kota]").on("change", function() {
            $.ajax({
                type: "post",
                url: "<?= base_url('RajaOngkir/ekspedisi') ?>",
                success: function(hasil_ekspedisi) {
                    $("select[name=ekspedisi]").html(hasil_ekspedisi);
                }
            })
        });


        $("select[name=ekspedisi]").on("change", function() {
            // mendapatkan ekspedisi terpilih
            var ekspedisi_terpilih = $("select[name=ekspedisi]").val();

            // mendapatkan id kota tujuan
            var kota_tujuan = $("option:selected", "select[name=kota]").attr("id_kota");

            // mendapatkan data berat
            var berat_pengiriman = $("#jumlah_beratt").val();
            // alert(berat_pengiriman);

            $.ajax({
                type: "post",
                url: "<?= base_url('RajaOngkir/paket') ?>",
                data: "ekspedisi=" + ekspedisi_terpilih + "&id_kota=" + kota_tujuan + "&berat=" + berat_pengiriman,
                success: function(hasil_paket) {
                    $("select[name=jenis]").html(hasil_paket);
                }
            })
        });

        $("select[name=jenis]").on("change", function() {
            var data_ongkir = $("option:selected", this).attr("ongkir");
            // alert(data_ongkir);

            // var reverse = data_ongkir.toString().split('').reverse().join(''),
            //     ribuan = reverse.match(/\d{1,3}/g);
            // ribuan = ribuan.join(',').split('').reverse().join('');
            $("#ongkir").val(data_ongkir);

            var jumlah_bayar = $("#jumlah_totall").val();
            var total_bayar = parseInt(data_ongkir) + parseInt(jumlah_bayar)

            // var reverse = total_bayar.toString().split('').reverse().join(''),
            //     ribuan = reverse.match(/\d{1,3}/g);
            // ribuan = ribuan.join(',').split('').reverse().join('');

            $("#tot_bayar").val(total_bayar);
        });
    })
    // $(document).ready(function() {
    //     $('#example').DataTable();

    // });
</script>