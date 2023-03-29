var Index = (function () {
    const csrf_token = $('meta[name="_token"]').attr("content");
    var table;

    var handleDataTransaksi = function () {
        table = $("#tableTransaksi").DataTable({
            responsive: false,
            autoWidth: false,
            pageLength: 5,
            searching: true,
            paging: true,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100],
            ],
            language: {
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                infoFiltered: "",
                zeroRecords: "Data tidak di temukan",
                loadingRecords: "Loading...",
                processing: "Processing...",
            },
            columnsDefs: [
                { searchable: false, target: [0, 1] },
                { orderable: false, target: [0, 1] },
            ],
            order: [[1, "asc"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: HomeUrl + "/sales/transaksiall",
                type: "POST",
                data: {
                    _token: csrf_token,
                },
            },
            columns: [
                { data: "cbox", orderable: false },
                { data: "rnum", orderable: false },
                { data: "trno" },
                { data: "tgl" },
                { data: "pembeli" },
                { data: "total" },
            ],
        });
        $(".tfoot-seacrh").on("change", function () {
            var data_index = $(this).attr("data-index");
            table.columns(data_index).search($(this).val()).draw();
            table.ajax.reload(null, false);
        });
    };

    return {
        init: function () {
            handleDataTransaksi();
            filter();
        },
    };
})();

$(document).ready(function () {
    Index.init();
    customFilter();
});
