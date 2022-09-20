$('#fileMapper-search').on('keyup', function () {
    $('#theTable').DataTable().search($(this).val()).draw();
});