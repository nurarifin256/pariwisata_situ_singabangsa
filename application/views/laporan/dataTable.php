<script>
    $(document).ready(function() {
        $('#example').DataTable();

    });

    function print_halaman(print_id) {
        printconten = document.getElementById(print_id).innerHTML;
        origin = document.body.innerHTML;
        document.body.innerHTML = printconten;
        window.print();
        document.body.innerHTML = origin;
    }
</script>