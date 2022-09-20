$(window).resize(function () {
    if ($(this).height() >= 1080){
        // change the dataTable pageLength in here
        $('#dataTable').DataTable().page.len(50).draw();
    } else {
        // default pageLength
        $('#dataTable').DataTable().page.len(35).draw();
    }
});