function FormatTable() {
    var resultTable = $('#theTable').DataTable({
        searching: true,
        stripeClasses: ['even'],
        lengthChange: true,
        pageLength: 10,
        lengthMenu: [
            [5, 10, 15, 25, 50, -1],
            [5, 10, 15, 25, 50, 'All']
        ],
        order: [[1, 'asc']],
        columnDefs: [{
            orderable: false,
            targets: [0],
            className: "noVis"
        }],
        deferRender: true,
    });
};