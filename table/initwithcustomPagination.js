function FormatTable() {
    var resultTable = $('#theTable').DataTable({
        dom: 'rt',
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
        fnDrawCallback: function (oSettings) {
            var oTable = this;
            var totalPages = oTable.fnPagingInfo().iTotalPages;
            var currentPage = oTable.fnPagingInfo().iPage;

            $('#pagination-review').twbsPagination('destroy');
            if (totalPages > 0) {
                $('#pagination-review').twbsPagination({
                    first: "",
                    prev: "prev",
                    next: "next",
                    last: "",
                    paginationClass: 'pagination-custom',
                    nextClass: "page-item-custom next",
                    prevClass: 'page-item-custom prev',
                    lastClass: 'page-item-custom last',
                    firstClass: 'page-item-custom first',
                    pageClass: 'page-item-custom',
                    activeClass: 'active',
                    disabledClass: 'disabled',
                    anchorClass: 'page-link-custom',
                    startPage: currentPage + 1,
                    totalPages: totalPages,
                    visiblePages: 10,
                    initiateStartPageClick: false,
                    onPageClick: function (event, pageNumber) {
                        resultTable.page(pageNumber - 1).draw('page');
                    }
                });
            }

            setTimeout(function () {
                //refresh count of records displayed
                var restultInfo = resultTable.page.info();

                $("#recordsDisplayInfo").html(
                    'Showing ' + restultInfo.end + ' out of ' + restultInfo.recordsDisplay
                );
            }, 0);
        }
    });
};